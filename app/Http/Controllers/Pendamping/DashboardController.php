<?php

namespace App\Http\Controllers\Pendamping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KeluargaPenerima;
use App\Models\ValidasiCpcl;
use App\Models\LaporanTumbuhKembang;
class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Statistik Utama
        $totalBinaan = KeluargaPenerima::count();
        $totalValidasi = ValidasiCpcl::where('pendamping_id', $userId)->count();
        $totalLaporanKirim = LaporanTumbuhKembang::where('pendamping_id', $userId)->count();

        // Tugas Validasi Mendesak
        $validasiMendesak = ValidasiCpcl::with('keluarga_penerima.wilayah')
            ->where('pendamping_id', $userId)
            ->where('status_approval_pemda', 'menunggu')
            ->latest()
            ->take(5)
            ->get();

        // Aktivitas Terakhir Laporan Tumbuh Kembang
        $aktivitasTerakhir = LaporanTumbuhKembang::with('keluarga_penerima')
            ->where('pendamping_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.pendamping', compact(
            'totalBinaan',
            'totalValidasi',
            'totalLaporanKirim',
            'validasiMendesak',
            'aktivitasTerakhir'
        ));
    }
}
