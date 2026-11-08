<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeluargaPenerima;
use App\Models\LaporanPenerima;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Log;

class PublicLaporanController extends Controller
{
    /**
     * Menyimpan laporan mandiri dari masyarakat / penerima bantuan tanpa perlu login.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'nullable|string|max:20',
            'nama_pengirim' => 'nullable|string|max:150',
            'no_hp' => 'nullable|string|max:25',
            'laporan_teks' => 'required|string|min:5|max:2000',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ], [
            'laporan_teks.required' => 'Isi laporan tidak boleh kosong.',
            'laporan_teks.min' => 'Isi laporan minimal 5 karakter.',
            'foto.image' => 'Berkas foto harus berupa gambar.',
            'foto.max' => 'Ukuran foto maksimal 5 MB.',
        ]);

        $cleanNik = $request->nik ? preg_replace('/\D/', '', $request->nik) : null;
        $cleanPhone = $request->no_hp ? preg_replace('/\D/', '', $request->no_hp) : null;

        // Normalisasi nomor HP ke format 62xxx
        if ($cleanPhone) {
            if (str_starts_with($cleanPhone, '08')) {
                $cleanPhone = '62' . substr($cleanPhone, 1);
            }
        }

        // Pencarian Keluarga Penerima Bantuan
        $keluarga = null;
        if (!empty($cleanNik)) {
            $keluarga = KeluargaPenerima::with(['wilayah.parent', 'pendamping'])
                ->where('nik', $cleanNik)
                ->orWhere('no_kk', $cleanNik)
                ->first();
        }

        // Jika NIK belum ada atau tidak ditemukan, coba cari lewat nomor HP
        if (!$keluarga && !empty($cleanPhone)) {
            $keluarga = KeluargaPenerima::with(['wilayah.parent', 'pendamping'])
                ->where('no_hp', $cleanPhone)
                ->orWhere('no_hp', '0' . substr($cleanPhone, 2))
                ->first();
        }

        // Auto-link nomor HP jika keluarga ditemukan dan no_hp masih kosong
        if ($keluarga && !empty($cleanPhone) && empty($keluarga->no_hp)) {
            $keluarga->update(['no_hp' => $cleanPhone]);
        }

        // Upload Foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            try {
                $file = $request->file('foto');
                $filename = 'lapor_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('laporan_foto', $filename, 'public');
                $fotoPath = '/storage/' . $path;
            } catch (\Throwable $e) {
                Log::warning("Gagal mengunggah foto laporan publik: " . $e->getMessage());
            }
        }

        $namaPengirim = $keluarga 
            ? $keluarga->kepala_keluarga 
            : ($request->nama_pengirim ?: ($cleanPhone ? 'Warga (' . $cleanPhone . ')' : 'Masyarakat Umum'));

        // Simpan ke database laporan_penerimas
        $laporan = LaporanPenerima::create([
            'keluarga_penerima_id' => $keluarga ? $keluarga->id : null,
            'pengirim_nama' => $namaPengirim,
            'laporan_teks' => $request->laporan_teks,
            'foto' => $fotoPath,
            'sumber' => 'portal',
            'wa_sender' => $cleanPhone,
            'status_laporan' => 'menunggu',
            'is_read_by_pemda' => false,
            'is_read_by_kampus' => false,
            'is_read_by_pendamping' => false,
        ]);

        // Catat Audit Log
        try {
            AuditLog::create([
                'user_id' => $keluarga ? $keluarga->user_id : null,
                'action' => 'PUBLIC_REPORT_SUBMITTED',
                'description' => "Laporan publik mandiri dari {$namaPengirim} (Tiket #LAP-{$laporan->id})",
                'ip_address' => $request->ip() ?: '127.0.0.1',
                'user_agent' => $request->userAgent() ?: 'Public-Web-Report',
            ]);
        } catch (\Throwable $e) {
            // Lanjutkan jika audit log gagal
        }

        $nomorTiket = "#LAP-{$laporan->id}";

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'status' => 'success',
                'message' => 'Laporan Anda berhasil dikirim ke sistem GemaSmart.',
                'nomor_tiket' => $nomorTiket,
                'data' => [
                    'id' => $laporan->id,
                    'nomor_tiket' => $nomorTiket,
                    'pengirim' => $namaPengirim,
                    'terdaftar' => $keluarga !== null,
                    'desa' => $keluarga && $keluarga->wilayah ? $keluarga->wilayah->nama : null,
                    'kecamatan' => $keluarga && $keluarga->wilayah && $keluarga->wilayah->parent ? $keluarga->wilayah->parent->nama : null,
                    'waktu' => $laporan->created_at->format('d/m/Y H:i'),
                ]
            ]);
        }

        return redirect()->to(url('/#lapor'))
            ->with('laporan_sukses', true)
            ->with('nomor_tiket', $nomorTiket)
            ->with('nama_pengirim', $namaPengirim)
            ->with('is_terdaftar', $keluarga !== null);
    }

    /**
     * Endpoint API cepat untuk mengecek NIK pada form publik (Live verification)
     */
    public function cekNik(Request $request)
    {
        $nik = preg_replace('/\D/', '', $request->get('nik', ''));

        if (strlen($nik) < 15) {
            return response()->json(['found' => false]);
        }

        $keluarga = KeluargaPenerima::with(['wilayah.parent', 'programBantuan'])
            ->where('nik', $nik)
            ->orWhere('no_kk', $nik)
            ->first();

        if ($keluarga) {
            return response()->json([
                'found' => true,
                'nama' => $keluarga->kepala_keluarga,
                'desa' => $keluarga->wilayah ? $keluarga->wilayah->nama : '-',
                'kecamatan' => ($keluarga->wilayah && $keluarga->wilayah->parent) ? $keluarga->wilayah->parent->nama : '-',
                'program' => $keluarga->programBantuan ? $keluarga->programBantuan->nama_program : 'Program Bantuan Bibit',
                'desil' => $keluarga->desil ? 'Desil ' . $keluarga->desil : null,
            ]);
        }

        return response()->json(['found' => false]);
    }

    /**
     * Endpoint live verification untuk mendeteksi duplikasi NIK dan No. KK secara real-time pada formulir input.
     */
    public function cekDuplikasiPenerima(Request $request)
    {
        $nik = preg_replace('/\D/', '', $request->get('nik', ''));
        $noKk = preg_replace('/\D/', '', $request->get('no_kk', ''));
        $excludeId = $request->get('exclude_id');

        if (!empty($nik) && strlen($nik) >= 12) {
            $query = KeluargaPenerima::withTrashed()->where('nik', $nik);
            if (!empty($excludeId)) {
                $query->where('id', '!=', $excludeId);
            }
            $existing = $query->with('wilayah')->first();

            if ($existing) {
                $desa = $existing->wilayah ? $existing->wilayah->nama : 'Sumbawa';
                return response()->json([
                    'duplicate' => true,
                    'field' => 'nik',
                    'message' => "NIK {$nik} sudah terdaftar atas nama {$existing->kepala_keluarga} (Desa {$desa}). Data tidak boleh ganda!",
                    'existing' => [
                        'id' => $existing->id,
                        'kepala_keluarga' => $existing->kepala_keluarga,
                        'nik' => $existing->nik,
                        'no_kk' => $existing->no_kk,
                        'desa' => $desa,
                        'is_deleted' => $existing->trashed(),
                    ]
                ]);
            }
        }

        if (!empty($noKk) && strlen($noKk) >= 12) {
            $queryKk = KeluargaPenerima::withTrashed()->where('no_kk', $noKk);
            if (!empty($excludeId)) {
                $queryKk->where('id', '!=', $excludeId);
            }
            $existingKk = $queryKk->with('wilayah')->first();

            if ($existingKk) {
                $desa = $existingKk->wilayah ? $existingKk->wilayah->nama : 'Sumbawa';
                return response()->json([
                    'duplicate' => true,
                    'field' => 'no_kk',
                    'message' => "Nomor KK {$noKk} sudah terdaftar atas nama {$existingKk->kepala_keluarga} (Desa {$desa}). Setiap KK hanya boleh terdaftar satu kali!",
                    'existing' => [
                        'id' => $existingKk->id,
                        'kepala_keluarga' => $existingKk->kepala_keluarga,
                        'nik' => $existingKk->nik,
                        'no_kk' => $existingKk->no_kk,
                        'desa' => $desa,
                        'is_deleted' => $existingKk->trashed(),
                    ]
                ]);
            }
        }

        return response()->json([
            'duplicate' => false,
            'message' => 'NIK dan No. KK tersedia (belum terdaftar).'
        ]);
    }
}
