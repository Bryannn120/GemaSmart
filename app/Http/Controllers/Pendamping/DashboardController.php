<?php

namespace App\Http\Controllers\Pendamping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KeluargaPenerima;
use App\Models\LaporanTumbuhKembang;
use App\Models\PenilaianKemandirian;
use App\Models\PenyaluranBantuan;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Statistik Utama
        $totalBinaan = KeluargaPenerima::penerimaAktif()->count();
        $totalMandiri = KeluargaPenerima::mandiri()->count();
        $totalPenilaian = PenilaianKemandirian::where('pendamping_id', $userId)->count();
        if ($totalPenilaian === 0) {
            $totalPenilaian = PenilaianKemandirian::count(); // Fallback jika belum di-assign spesifik
        }
        $totalLaporanKirim = LaporanTumbuhKembang::where('pendamping_id', $userId)->count();
        if ($totalLaporanKirim === 0) {
            $totalLaporanKirim = LaporanTumbuhKembang::count();
        }

        // Statistik Penyaluran Bantuan oleh Pendamping
        $penyaluranQuery = PenyaluranBantuan::where('pendamping_id', $userId);
        if ($penyaluranQuery->count() === 0) {
            $penyaluranQuery = PenyaluranBantuan::query();
        }
        $totalPenyaluran = $penyaluranQuery->count();
        $totalUangDisalurkan = (clone $penyaluranQuery)->where('jenis', 'uang')->sum('nominal_uang') ?? 0;
        $totalBibitDisalurkan = (clone $penyaluranQuery)->where('jenis', 'bibit')->sum('jumlah') ?? 0;
        $totalBarangDisalurkan = (clone $penyaluranQuery)->where('jenis', 'barang')->sum('jumlah') ?? 0;

        // Riwayat Penyaluran Bantuan Terbaru
        $penyaluranTerbaru = (clone $penyaluranQuery)
            ->with(['keluargaPenerima.wilayah', 'programBantuan', 'itemBantuan'])
            ->latest('tgl_penyaluran')
            ->latest('id')
            ->take(5)
            ->get();

        // Riwayat Penilaian Desil Terakhir oleh Pendamping
        $penilaianQuery = PenilaianKemandirian::with(['keluargaPenerima.wilayah']);
        if (PenilaianKemandirian::where('pendamping_id', $userId)->exists()) {
            $penilaianQuery->where('pendamping_id', $userId);
        }
        $penilaianTerbaru = $penilaianQuery->latest()->take(5)->get();

        // Keluarga Binaan untuk Akses Cepat Penilaian (Hanya yang masih aktif / butuh intervensi)
        $keluargaBinaanCepat = KeluargaPenerima::penerimaAktif()
            ->with('wilayah')
            ->latest()
            ->take(5)
            ->get();

        // Aktivitas Terakhir Laporan Tumbuh Kembang
        $laporQuery = LaporanTumbuhKembang::with('keluarga_penerima');
        if (LaporanTumbuhKembang::where('pendamping_id', $userId)->exists()) {
            $laporQuery->where('pendamping_id', $userId);
        }
        $aktivitasTerakhir = $laporQuery->latest()->take(5)->get();

        return view('dashboard.pendamping', compact(
            'totalBinaan',
            'totalMandiri',
            'totalPenilaian',
            'totalLaporanKirim',
            'totalPenyaluran',
            'totalUangDisalurkan',
            'totalBibitDisalurkan',
            'totalBarangDisalurkan',
            'penyaluranTerbaru',
            'penilaianTerbaru',
            'keluargaBinaanCepat',
            'aktivitasTerakhir'
        ));
    }
}
