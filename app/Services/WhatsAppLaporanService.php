<?php

namespace App\Services;

use App\Models\KeluargaPenerima;
use App\Models\LaporanPenerima;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Log;

class WhatsAppLaporanService
{
    /**
     * Memproses payload pesan masuk dari gateway WhatsApp (Fonnte, Wablas, Twilio, UltraMsg, Baileys, webhook generik).
     *
     * @param array $payload
     * @return array
     */
    public function processIncomingMessage(array $payload): array
    {
        // Mendukung payload langsung maupun pembungkus nested 'data' (BalesOtomatis, n8n, CRM)
        $inner = (isset($payload['data']) && is_array($payload['data'])) ? $payload['data'] : [];

        // Abaikan webhook pesan keluar dari perangkat sendiri untuk mencegah pengulangan (loop)
        if (($payload['type'] ?? '') === 'outgoing_chat' || !empty($inner['is_from_me']) || !empty($payload['is_from_me'])) {
            return [
                'success' => true,
                'status' => 'ignored',
                'message' => 'Pesan keluar (outgoing) dari perangkat sendiri diabaikan.',
            ];
        }

        // Abaikan pesan grup untuk menjaga privasi laporan warga
        if (!empty($inner['is_group']) || !empty($payload['is_group'])) {
            return [
                'success' => true,
                'status' => 'ignored',
                'message' => 'Pesan dari grup WhatsApp diabaikan.',
            ];
        }

        // 1. Ekstraksi nomor pengirim dari berbagai format gateway (BalesOtomatis, Fonnte, Wablas, Twilio, dll)
        $rawSender = $payload['sender'] 
            ?? $payload['phone_no'] 
            ?? $payload['phone_number'] 
            ?? $payload['phone'] 
            ?? $payload['from'] 
            ?? $payload['wa_number'] 
            ?? $payload['From'] 
            ?? $payload['source'] 
            ?? ($inner['phone_number'] ?? null)
            ?? ($inner['phone_no'] ?? null)
            ?? ($inner['phone'] ?? null)
            ?? ($inner['sender_phone'] ?? null)
            ?? ($inner['sender'] ?? null)
            ?? ($inner['from'] ?? null)
            ?? ($inner['wa_id'] ?? null);

        // 2. Ekstraksi pesan teks
        $rawMessage = $payload['message'] 
            ?? $payload['message_body'] 
            ?? $payload['text'] 
            ?? $payload['body'] 
            ?? $payload['pesan'] 
            ?? $payload['chat'] 
            ?? $payload['Body'] 
            ?? ($inner['message_body'] ?? null)
            ?? ($inner['message'] ?? null)
            ?? ($inner['text'] ?? null)
            ?? ($inner['body'] ?? null)
            ?? ($inner['chat'] ?? null)
            ?? '';

        // 3. Ekstraksi nama pengirim jika tersedia dari profil WhatsApp
        $senderName = $payload['pushName'] 
            ?? $payload['name'] 
            ?? $payload['sender_name'] 
            ?? $payload['ProfileName'] 
            ?? ($inner['name'] ?? null)
            ?? ($inner['pushName'] ?? null);

        // 4. Ekstraksi media / foto jika ada
        $mediaUrl = $payload['media_url'] 
            ?? $payload['image'] 
            ?? $payload['foto'] 
            ?? $payload['url'] 
            ?? $payload['MediaUrl0'] 
            ?? ($inner['media_url'] ?? null)
            ?? ($inner['image'] ?? null)
            ?? null;

        // 5. Ekstraksi Message ID dari gateway
        $messageId = $payload['id'] 
            ?? $payload['message_id'] 
            ?? $payload['wa_message_id'] 
            ?? $payload['SmsMessageSid'] 
            ?? ($inner['message_id'] ?? null)
            ?? ($inner['id'] ?? null)
            ?? null;

        if (empty($rawSender) || empty(trim($rawMessage))) {
            return [
                'success' => false,
                'status' => 'error',
                'message' => 'Nomor pengirim (sender) dan isi pesan (message) tidak boleh kosong.',
                'auto_reply' => 'Format laporan tidak valid. Pastikan pesan berisi teks laporan.',
            ];
        }

        $senderClean = $this->cleanPhoneNumber($rawSender);
        $phoneVariants = $this->getPhoneVariants($senderClean);

        // 6. Pencocokan Cerdas Penerima Bantuan (Smart Matching)
        $keluarga = null;
        $cleanReportText = trim($rawMessage);
        $matchedMethod = 'unknown';

        // METODE A: Format Tag Terstruktur #LAPOR#[NIK]#[Pesan] atau LAPOR#[NIK]#[Pesan]
        if (preg_match('/^#?LAPOR\s*#?\s*([0-9]{15,18})\s*#?\s*(.+)$/is', $rawMessage, $matches)) {
            $extractedId = trim($matches[1]);
            $cleanReportText = trim($matches[2]);

            $keluarga = KeluargaPenerima::with(['wilayah.parent', 'pendamping'])
                ->where('nik', $extractedId)
                ->orWhere('no_kk', $extractedId)
                ->first();

            if ($keluarga) {
                $matchedMethod = 'nik_hashtag';
                // Hubungkan nomor WhatsApp ini secara permanen ke profil keluarga penerima
                $keluarga->update(['no_hp' => $senderClean]);
                if ($keluarga->user && empty($keluarga->user->no_hp)) {
                    $keluarga->user->update(['no_hp' => $senderClean]);
                }
            }
        }

        // METODE B: Deteksi 16 Digit NIK/No. KK di dalam pesan teks biasa
        if (!$keluarga && preg_match('/\b(52\d{14}|\d{16})\b/', $rawMessage, $digitMatches)) {
            $extractedNik = $digitMatches[1];
            $keluarga = KeluargaPenerima::with(['wilayah.parent', 'pendamping'])
                ->where('nik', $extractedNik)
                ->orWhere('no_kk', $extractedNik)
                ->first();

            if ($keluarga) {
                $matchedMethod = 'nik_inline';
                // Hubungkan nomor WhatsApp ini secara permanen ke profil keluarga penerima
                $keluarga->update(['no_hp' => $senderClean]);
                if ($keluarga->user && empty($keluarga->user->no_hp)) {
                    $keluarga->user->update(['no_hp' => $senderClean]);
                }
            }
        }

        // METODE C: Pencocokan Nomor Telepon WhatsApp Terdaftar
        if (!$keluarga) {
            $keluarga = KeluargaPenerima::with(['wilayah.parent', 'pendamping'])
                ->where(function ($q) use ($phoneVariants) {
                    $q->whereIn('no_hp', $phoneVariants)
                      ->orWhereHas('user', function ($u) use ($phoneVariants) {
                          $u->whereIn('no_hp', $phoneVariants);
                      });
                })
                ->first();

            if ($keluarga) {
                $matchedMethod = 'phone_number';
            }
        }

        // METODE D: Riwayat Laporan Sebelumnya dari Nomor WhatsApp Ini (Memory Continuity)
        if (!$keluarga) {
            $prevReport = LaporanPenerima::where(function ($q) use ($phoneVariants) {
                    $q->whereIn('wa_sender', $phoneVariants);
                })
                ->whereNotNull('keluarga_penerima_id')
                ->latest('id')
                ->first();

            if ($prevReport && $prevReport->keluarga_penerima_id) {
                $keluarga = KeluargaPenerima::with(['wilayah.parent', 'pendamping'])
                    ->find($prevReport->keluarga_penerima_id);

                if ($keluarga) {
                    $matchedMethod = 'previous_report_history';
                    // Sinkronkan nomor HP ke profil keluarga
                    $keluarga->update(['no_hp' => $senderClean]);
                }
            }
        }

        // 7. Simpan Laporan ke Tabel laporan_penerimas
        $laporan = LaporanPenerima::create([
            'keluarga_penerima_id' => $keluarga ? $keluarga->id : null,
            'pengirim_nama' => $keluarga ? $keluarga->kepala_keluarga : ($senderName ?: 'Warga (' . $senderClean . ')'),
            'laporan_teks' => $cleanReportText,
            'foto' => $mediaUrl,
            'sumber' => 'whatsapp',
            'wa_sender' => $senderClean,
            'wa_message_id' => $messageId,
            'status_laporan' => 'menunggu',
            'is_read_by_pemda' => false,
            'is_read_by_kampus' => false,
            'is_read_by_pendamping' => false,
        ]);

        // 8. Buat Pesan Balasan Otomatis WhatsApp (Auto-Reply)
        if ($keluarga) {
            $desaName = $keluarga->wilayah ? $keluarga->wilayah->nama : 'Sumbawa';
            $kecName = ($keluarga->wilayah && $keluarga->wilayah->parent) ? $keluarga->wilayah->parent->nama : 'Sumbawa';
            $namaKepala = $keluarga->kepala_keluarga ?: 'Bpk/Ibu';

            $autoReply = "Halo Bpk/Ibu {$namaKepala} ({$desaName}, Kec. {$kecName}).\n\n"
                       . "✅ Laporan Anda telah berhasil diterima dan tercatat di sistem *GemaSmart Bappeda Sumbawa*.\n"
                       . "📋 *Nomor Tiket:* #LAP-{$laporan->id}\n"
                       . "🕒 *Waktu Terima:* " . $laporan->created_at->format('d/m/Y H:i') . " WITA\n\n"
                       . "Laporan Anda akan segera ditinjau oleh Tim Pendamping Lapangan dan Pemerintah Daerah. Terima kasih atas partisipasi aktif Anda!";
        } else {
            $autoReply = "Halo! Terima kasih telah menghubungi Layanan Aduan Warga *GemaSmart Sumbawa*.\n\n"
                       . "✅ Pesan Anda telah kami catat dengan nomor tiket: *#LAP-{$laporan->id}*.\n\n"
                       . "ℹ️ *Penting:* Nomor WhatsApp Anda belum terhubung dengan data NIK penerima bantuan. Agar laporan langsung terhubung dengan data profil bantuan Anda, mohon kirimkan balasan dengan format:\n\n"
                       . "*#LAPOR#[NIK 16 Digit]#[Isi Laporan/Kendala]*\n\n"
                       . "Contoh:\n"
                       . "#LAPOR#5204011203850001#Bantuan bibit sudah kami terima dan mulai disemai di kebun.";
        }

        // 9. Pencatatan Audit Log Sistem
        try {
            AuditLog::record(
                'WHATSAPP_REPORT_RECEIVED',
                'LaporanPenerima',
                $laporan->id,
                null,
                [
                    'pengirim' => $senderClean,
                    'tiket' => "#LAP-{$laporan->id}",
                    'metode' => $matchedMethod,
                ],
                $keluarga ? $keluarga->user_id : null
            );
        } catch (\Throwable $e) {
            Log::warning("Gagal menulis audit log WhatsApp: " . $e->getMessage());
        }

        // Kirim pesan balasan WhatsApp aktif via API Gateway (BalesOtomatis/Fonnte/Wablas)
        $outboundResult = null;
        if (!empty(config('services.whatsapp.api_token'))) {
            $outboundResult = $this->sendOutgoingMessage($senderClean, $autoReply);
        }

        return [
            'success' => true,
            'status' => 'success',
            'message' => 'Laporan WhatsApp dari penerima bantuan berhasil dicatat di API sistem GemaSmart.',
            'data' => [
                'laporan_id' => $laporan->id,
                'nomor_tiket' => "#LAP-{$laporan->id}",
                'matched_method' => $matchedMethod,
                'teridentifikasi' => $keluarga !== null,
                'penerima' => $keluarga ? [
                    'id' => $keluarga->id,
                    'kepala_keluarga' => $keluarga->kepala_keluarga,
                    'nik' => $keluarga->nik,
                    'no_kk' => $keluarga->no_kk,
                    'desa' => $keluarga->wilayah ? $keluarga->wilayah->nama : null,
                    'kecamatan' => ($keluarga->wilayah && $keluarga->wilayah->parent) ? $keluarga->wilayah->parent->nama : null,
                    'pendamping' => $keluarga->pendamping ? $keluarga->pendamping->name : null,
                ] : null,
                'laporan_teks' => $laporan->laporan_teks,
                'wa_sender' => $laporan->wa_sender,
                'sumber' => $laporan->sumber,
                'created_at' => $laporan->created_at->format('Y-m-d H:i:s'),
            ],
            // Format auto_reply yang siap dikirim langsung oleh WhatsApp Gateway (Fonnte/Wablas/UltraMsg)
            'reply' => $autoReply,
            'auto_reply' => $autoReply,
            'outbound_api_sent' => $outboundResult ? ($outboundResult['success'] ?? false) : false,
            'outbound_response' => $outboundResult,
        ];
    }

    /**
     * Membersihkan nomor telepon menjadi digit saja (misal: +62812-3456 -> 08123456 atau 628123456)
     */
    public function cleanPhoneNumber(?string $phone): string
    {
        if (!$phone) {
            return '';
        }

        $clean = preg_replace('/\D/', '', $phone);

        // Jika diawali 08..., biarkan atau ubah
        if (str_starts_with($clean, '628')) {
            return $clean;
        }

        if (str_starts_with($clean, '08')) {
            return '62' . substr($clean, 1);
        }

        return $clean;
    }

    /**
     * Menghasilkan variasi format nomor untuk pencarian database yang fleksibel (08xx, 628xx, +628xx)
     */
    public function getPhoneVariants(string $cleanPhone): array
    {
        $variants = [$cleanPhone];

        if (str_starts_with($cleanPhone, '62')) {
            $local = '0' . substr($cleanPhone, 2);
            $variants[] = $local;
            $variants[] = '+' . $cleanPhone;
        } elseif (str_starts_with($cleanPhone, '0')) {
            $intl = '62' . substr($cleanPhone, 1);
            $variants[] = $intl;
            $variants[] = '+' . $intl;
        }

        return array_unique($variants);
    }

    /**
     * Mengirim pesan keluar (outbound) ke nomor WhatsApp target menggunakan API Gateway (Fonnte/Wablas/Generic).
     *
     * @param string $targetPhone Nomor WhatsApp tujuan (misal: 0812xxxx atau 62812xxxx)
     * @param string $message Isi pesan yang akan dikirim
     * @return array Status pengiriman
     */
    public function sendOutgoingMessage(string $targetPhone, string $message): array
    {
        $apiToken = config('services.whatsapp.api_token');
        $provider = config('services.whatsapp.provider', 'balesotomatis');
        $defaultUrl = ($provider === 'balesotomatis') 
            ? 'https://api.balesotomatis.id/public/v1/send-message' 
            : 'https://api.fonnte.com/send';
        $gatewayUrl = config('services.whatsapp.gateway_url') ?: $defaultUrl;
        $cleanTarget = $this->cleanPhoneNumber($targetPhone);

        if (empty($apiToken)) {
            Log::info("WhatsApp API Token belum diatur (WHATSAPP_API_TOKEN di .env). Pesan ke {$cleanTarget} tidak dikirim via HTTP API langsung.");
            return [
                'success' => false,
                'status' => 'token_not_configured',
                'message' => 'API Token WhatsApp belum dikonfigurasi pada .env (WHATSAPP_API_TOKEN). Respon tetap dikembalikan via Webhook response.',
                'target' => $cleanTarget,
            ];
        }

        try {
            $cleanToken = trim(str_replace('Bearer ', '', $apiToken));
            $headers = ['Authorization' => $apiToken];
            $body = [];

            if ($provider === 'balesotomatis') {
                $numberId = config('services.whatsapp.number_id') ?: env('WHATSAPP_NUMBER_ID', 'BO-YIBjr5L99cI5Iluh');
                $headers = [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ];
                $body = [
                    'api_key' => $cleanToken,
                    'number_id' => $numberId,
                    'phone_no' => $cleanTarget,
                    'message' => $message,
                ];
            } elseif ($provider === 'fonnte') {
                $headers = ['Authorization' => $cleanToken];
                $body = [
                    'target' => $cleanTarget,
                    'message' => $message,
                ];
            } elseif ($provider === 'wablas') {
                $headers = ['Authorization' => $cleanToken];
                $body = [
                    'phone' => $cleanTarget,
                    'message' => $message,
                ];
            } else {
                $headers = ['Authorization' => 'Bearer ' . $cleanToken];
                $body = [
                    'phone' => $cleanTarget,
                    'to' => $cleanTarget,
                    'message' => $message,
                ];
            }

            $response = \Illuminate\Support\Facades\Http::timeout(10)
                ->withHeaders($headers)
                ->post($gatewayUrl, $body);

            $resJson = $response->json();
            $isSuccess = $response->successful() && (!isset($resJson['code']) || $resJson['code'] == '200' || ($resJson['type'] ?? '') == 'successfully');

            Log::info("WhatsApp Outbound response [{$provider}] ke {$cleanTarget}: " . $response->body());

            return [
                'success' => $isSuccess,
                'status' => $response->status(),
                'provider' => $provider,
                'response' => $resJson ?? $response->body(),
            ];
        } catch (\Throwable $e) {
            Log::error("Gagal mengirim pesan WhatsApp keluar: " . $e->getMessage());
            return [
                'success' => false,
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
    }
}
