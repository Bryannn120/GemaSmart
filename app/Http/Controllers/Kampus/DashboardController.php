<?php

namespace App\Http\Controllers\Kampus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgramBantuan;
use App\Models\ItemBantuan;
use App\Models\PenyaluranBantuan;
use App\Models\KeluargaPenerima;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. KPI Metrik Utama Kampus
        $totalProgram = ProgramBantuan::count();
        $totalItem = ItemBantuan::count();
        $totalPenyaluran = PenyaluranBantuan::count();
        $totalUangDisalurkan = PenyaluranBantuan::where('jenis', 'uang')->sum('nominal_uang') ?? 0;
        $totalBibitDisalurkan = PenyaluranBantuan::where('jenis', 'bibit')->sum('jumlah') ?? 0;
        $totalBarangDisalurkan = PenyaluranBantuan::where('jenis', 'barang')->sum('jumlah') ?? 0;
        $totalPenerima = KeluargaPenerima::penerimaAktif()->count();
        $totalMandiri = KeluargaPenerima::mandiri()->count();
        $totalPendamping = User::where('role', 'pendamping')->count();

        // 2. Daftar Program & Item Bantuan Kampus
        $programs = ProgramBantuan::with(['itemBantuans.penyaluranBantuans'])
            ->latest()
            ->get();

        // 3. Penyaluran Bantuan Terkini oleh Pendamping Lapangan
        $penyaluranTerbaru = PenyaluranBantuan::with(['keluargaPenerima.wilayah', 'programBantuan', 'itemBantuan', 'pendamping'])
            ->latest('tgl_penyaluran')
            ->latest('id')
            ->take(8)
            ->get();

        // 4. Tim Pendamping Lapangan
        $pendampingList = User::where('role', 'pendamping')->take(6)->get();

        // 5. Data Keuangan Dana dari Bappeda ke Kampus
        $kampus = \App\Models\KampusMitra::where('user_id', auth()->id())->first() ?? \App\Models\KampusMitra::first();
        $danaBappeda = $kampus ? (float)$kampus->dana_bappeda : 0;
        $danaTerpakai = $kampus ? (float)$kampus->total_penggunaan_dana : 0;
        $sisaDana = $kampus ? (float)$kampus->sisa_dana : 0;
        $persenSerapan = $kampus ? (float)$kampus->persentase_penggunaan : 0;

        return view('dashboard.kampus', compact(
            'totalProgram',
            'totalItem',
            'totalPenyaluran',
            'totalUangDisalurkan',
            'totalBibitDisalurkan',
            'totalBarangDisalurkan',
            'totalPenerima',
            'totalMandiri',
            'totalPendamping',
            'programs',
            'penyaluranTerbaru',
            'pendampingList',
            'kampus',
            'danaBappeda',
            'danaTerpakai',
            'sisaDana',
            'persenSerapan'
        ));
    }
}
