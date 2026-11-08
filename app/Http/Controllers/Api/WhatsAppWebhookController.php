<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\WhatsAppLaporanService;
use App\Models\LaporanPenerima;
use App\Models\KeluargaPenerima;

class WhatsAppWebhookController extends Controller
{
    protected WhatsAppLaporanService $waService;

    public function __construct(WhatsAppLaporanService $waService)
    {
        $this->waService = $waService;
    }

    /**
     * Endpoint Webhook Utama untuk menerima pesan WhatsApp dari Gateway.
     * Mendukung format JSON, Form-Data, x-www-form-urlencoded dari berbagai provider:
     * - Fonnte (sender, message)
     * - Wablas (phone, message, pushName)
     * - Twilio (From, Body, MediaUrl0)
     * - UltraMsg (from, body)
     * - Meta WhatsApp Cloud API / Generic Bot
     */
    public function webhook(Request $request)
    {
        // Handshake verification jika gateway melakukan request GET (e.g. Meta Cloud API / Ping)
        if ($request->isMethod('get')) {
            if ($request->has('hub_challenge')) {
                return response($request->get('hub_challenge'), 200)
                    ->header('Content-Type', 'text/plain');
            }

            return response()->json([
                'status' => 'online',
                'app' => 'GemaSmart Sumbawa WhatsApp Webhook Gateway',
                'version' => '1.0',
                'endpoints' => [
                    'webhook_post' => url('/api/v1/whatsapp/webhook'),
                    'simulator_post' => url('/api/v1/whatsapp/simulator'),
                ],
                'format_laporan' => '#LAPOR#[NIK]#[Pesan Kendala/Feedback]',
                'server_time' => now()->toIso8601String(),
            ]);
        }

        // Verifikasi token keamanan Webhook jika dikonfigurasi di .env (Opsional)
        $webhookSecret = config('services.whatsapp.webhook_secret');
        if (!empty($webhookSecret)) {
            $providedToken = $request->header('X-Webhook-Token') 
                ?? $request->header('Authorization') 
                ?? $request->get('token') 
                ?? $request->get('secret');

            if ($providedToken && str_starts_with($providedToken, 'Bearer ')) {
                $providedToken = substr($providedToken, 7);
            }

            if (!$providedToken || !hash_equals((string)$webhookSecret, (string)$providedToken)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized: Token autentikasi webhook tidak cocok.'
                ], 401);
            }
        }

        // Ambil seluruh payload (JSON atau Form Data)
        $payload = $request->all();

        // Dukungan khusus untuk format payload ter-nesting milik Meta Cloud API
        if (isset($payload['entry'][0]['changes'][0]['value']['messages'][0])) {
            $metaMsg = $payload['entry'][0]['changes'][0]['value']['messages'][0];
            $payload['sender'] = $metaMsg['from'] ?? null;
            $payload['message'] = $metaMsg['text']['body'] ?? '';
            $payload['id'] = $metaMsg['id'] ?? null;
        }

        $result = $this->waService->processIncomingMessage($payload);

        if (!$result['success']) {
            return response()->json($result, 422);
        }

        return response()->json($result, 200);
    }

    /**
     * Endpoint Simulator untuk pengujian langsung dari dashboard admin
     * tanpa perlu koneksi gateway WhatsApp sungguhan.
     */
    public function simulator(Request $request)
    {
        $request->validate([
            'sender' => 'required|string',
            'pesan' => 'required|string',
            'nik' => 'nullable|string',
        ]);

        $pesan = $request->pesan;
        if (!empty($request->nik) && !str_contains($pesan, '#LAPOR#')) {
            $pesan = "#LAPOR#" . trim($request->nik) . "#" . $pesan;
        }

        $payload = [
            'sender' => $request->sender,
            'message' => $pesan,
            'pushName' => $request->push_name ?: 'Simulasi Warga',
            'id' => 'SIM-' . time(),
        ];

        $result = $this->waService->processIncomingMessage($payload);

        return response()->json($result, $result['success'] ? 200 : 422);
    }

    /**
     * Info & Panduan Format WhatsApp API
     */
    public function info()
    {
        $totalLaporanWa = LaporanPenerima::where('sumber', 'whatsapp')->count();
        $totalPenerimaDenganHp = KeluargaPenerima::whereNotNull('no_hp')->count();

        return response()->json([
            'service' => 'GemaSmart WhatsApp Reporting Gateway',
            'webhook_url' => url('/api/v1/whatsapp/webhook'),
            'hotline_wa' => config('services.whatsapp.hotline', '0852-3891-2026'),
            'provider' => config('services.whatsapp.provider', 'fonnte'),
            'api_token_terpasang' => !empty(config('services.whatsapp.api_token')),
            'webhook_secret_aktif' => !empty(config('services.whatsapp.webhook_secret')),
            'instruksi_masyarakat' => [
                'format' => '#LAPOR#[NIK 16 Digit]#[Isi Laporan]',
                'contoh' => '#LAPOR#5204011203850001#Bibit jagung bantuan kami terima 50 bungkus, kondisi baik dan mulai ditanam.',
                'penjelasan_nomor_wa' => 'Nomor WA penerima TIDAK WAJIB terdaftar sebelumnya. Saat warga melapor pertama kali dengan NIK, sistem otomatis menyimpan nomor HP tersebut ke profil penerima (auto-link).',
            ],
            'statistik' => [
                'total_laporan_whatsapp' => $totalLaporanWa,
                'total_penerima_bernomor_hp' => $totalPenerimaDenganHp,
            ]
        ]);
    }
}
