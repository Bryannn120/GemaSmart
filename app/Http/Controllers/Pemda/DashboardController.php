<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgramBantuan;
use App\Models\KeluargaPenerima;
use App\Models\PenyaluranBantuan;
use App\Models\PenilaianKemandirian;
use App\Models\LaporanTumbuhKembang;
use App\Models\Wilayah;
use App\Models\KampusMitra;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. KPI Metrik Utama (Penerima Aktif vs Telah Mandiri)
        $totalProgram = ProgramBantuan::count();
        $totalPenerima = KeluargaPenerima::penerimaAktif()->count();
        $totalMandiri = KeluargaPenerima::mandiri()->count();
        $totalPenyaluran = PenyaluranBantuan::count();
        $totalUangDisalurkan = PenyaluranBantuan::where('jenis', 'uang')->sum('nominal_uang') ?? 0;
        $totalBibitDisalurkan = PenyaluranBantuan::where('jenis', 'bibit')->sum('jumlah') ?? 0;
        $totalBarangDisalurkan = PenyaluranBantuan::where('jenis', 'barang')->sum('jumlah') ?? 0;
        $totalAsesmen = PenilaianKemandirian::count();
        $totalLaporanKembang = LaporanTumbuhKembang::count();
        $totalKampus = KampusMitra::count();
        $totalPendamping = User::where('role', 'pendamping')->count();

        // 2. Data Wilayah Kecamatan
        $kecamatans = Wilayah::where('jenis', 'kecamatan')->orderBy('nama')->get();

        // 3. Sebaran per Kecamatan
        $sebaranKecamatan = $kecamatans->map(function ($kec) {
            $desaIds = Wilayah::where('parent_id', $kec->id)->pluck('id')->push($kec->id);
            $penerimas = KeluargaPenerima::penerimaAktif()->whereIn('wilayah_id', $desaIds)->get();
            $totalKk = $penerimas->count();
            $penerimaIds = $penerimas->pluck('id');
            $penyaluranKec = PenyaluranBantuan::whereIn('keluarga_penerima_id', $penerimaIds)->count();
            
            return [
                'id' => $kec->id,
                'nama' => $kec->nama,
                'total_kk' => $totalKk,
                'total_penyaluran' => $penyaluranKec,
                'status' => $totalKk > 0 ? 'Aktif' : 'Tersedia'
            ];
        })->sortByDesc('total_kk')->values();

        // 4. Komposisi Bantuan Terdistribusi
        $komposisiUang = PenyaluranBantuan::where('jenis', 'uang')->count();
        $komposisiBarang = PenyaluranBantuan::where('jenis', 'barang')->count();
        $komposisiBibit = PenyaluranBantuan::where('jenis', 'bibit')->count();
        $totalItemTransaksi = $komposisiUang + $komposisiBarang + $komposisiBibit;

        $persenUang = $totalItemTransaksi > 0 ? round(($komposisiUang / $totalItemTransaksi) * 100, 1) : 0;
        $persenBarang = $totalItemTransaksi > 0 ? round(($komposisiBarang / $totalItemTransaksi) * 100, 1) : 0;
        $persenBibit = $totalItemTransaksi > 0 ? round(($komposisiBibit / $totalItemTransaksi) * 100, 1) : 0;

        // 5. Program Bantuan Aktif
        $programs = ProgramBantuan::with(['kampusMitra', 'itemBantuans'])
            ->latest()
            ->take(5)
            ->get();

        // 6. Aktivitas Terkini Penyaluran Bantuan
        $penyaluranTerbaru = PenyaluranBantuan::with(['keluargaPenerima.wilayah', 'programBantuan', 'itemBantuan', 'pendamping'])
            ->latest('tgl_penyaluran')
            ->latest('id')
            ->take(8)
            ->get();

        // 7. Evaluasi Desil Terbaru
        $asesmenTerbaru = PenilaianKemandirian::with(['keluargaPenerima.wilayah', 'pendamping'])
            ->latest()
            ->take(5)
            ->get();

        // 8. Keuangan Dana Bappeda yang Diberikan ke Kampus & Pengurangan Penggunaannya
        $totalDanaBappeda = KampusMitra::sum('dana_bappeda');
        $totalDanaTerpakai = KampusMitra::get()->sum('total_penggunaan_dana');
        $totalSisaDana = max(0, $totalDanaBappeda - $totalDanaTerpakai);
        $persenSerapanBappeda = $totalDanaBappeda > 0 ? min(100, round(($totalDanaTerpakai / $totalDanaBappeda) * 100, 1)) : 0;

        return view('dashboard.pemda', compact(
            'totalProgram',
            'totalPenerima',
            'totalMandiri',
            'totalPenyaluran',
            'totalUangDisalurkan',
            'totalBibitDisalurkan',
            'totalBarangDisalurkan',
            'totalAsesmen',
            'totalLaporanKembang',
            'totalKampus',
            'totalPendamping',
            'kecamatans',
            'sebaranKecamatan',
            'komposisiUang',
            'komposisiBarang',
            'komposisiBibit',
            'persenUang',
            'persenBarang',
            'persenBibit',
            'programs',
            'penyaluranTerbaru',
            'asesmenTerbaru',
            'totalDanaBappeda',
            'totalDanaTerpakai',
            'totalSisaDana',
            'persenSerapanBappeda'
        ));
    }
}
