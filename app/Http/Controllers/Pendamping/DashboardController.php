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
        $user = Auth::user();
        $desaIds = $user->getAssignedDesaIds();

        // Scope keluarga binaan pendamping
        $keluargaScope = KeluargaPenerima::query();
        if (!empty($desaIds)) {
            $keluargaScope->where(function($q) use ($user, $desaIds) {
                $q->where('pendamping_id', $user->id)
                  ->orWhereIn('wilayah_id', $desaIds);
            });
        } else {
            $keluargaScope->where('pendamping_id', $user->id);
        }

        $totalBinaan = (clone $keluargaScope)->penerimaAktif()->count();
        $totalMandiri = (clone $keluargaScope)->mandiri()->count();

        // Statistik Penilaian Kemandirian
        $penilaianQuery = PenilaianKemandirian::with(['keluargaPenerima.wilayah'])->where(function($q) use ($user, $desaIds) {
            $q->where('pendamping_id', $user->id);
            if (!empty($desaIds)) {
                $q->orWhereHas('keluargaPenerima', fn($kp) => $kp->whereIn('wilayah_id', $desaIds));
            }
        });
        $totalPenilaian = (clone $penilaianQuery)->count();
        $penilaianTerbaru = (clone $penilaianQuery)->latest()->take(5)->get();

        // Statistik Laporan Tumbuh Kembang
        $laporQuery = LaporanTumbuhKembang::with('keluarga_penerima.wilayah')->where(function($q) use ($user, $desaIds) {
            $q->where('pendamping_id', $user->id);
            if (!empty($desaIds)) {
                $q->orWhereHas('keluarga_penerima', fn($kp) => $kp->whereIn('wilayah_id', $desaIds));
            }
        });
        $totalLaporanKirim = (clone $laporQuery)->count();
        $aktivitasTerakhir = (clone $laporQuery)->latest()->take(5)->get();

        // Statistik Penyaluran Bantuan
        $penyaluranQuery = PenyaluranBantuan::where(function($q) use ($user, $desaIds) {
            $q->where('pendamping_id', $user->id);
            if (!empty($desaIds)) {
                $q->orWhereHas('keluargaPenerima', fn($kp) => $kp->whereIn('wilayah_id', $desaIds));
            }
        });

        $totalPenyaluran = (clone $penyaluranQuery)->count();
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

        // Keluarga Binaan untuk Akses Cepat Penilaian (Hanya yang masih aktif / butuh intervensi)
        $keluargaBinaanCepat = (clone $keluargaScope)->penerimaAktif()
            ->with('wilayah')
            ->latest()
            ->take(5)
            ->get();

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
