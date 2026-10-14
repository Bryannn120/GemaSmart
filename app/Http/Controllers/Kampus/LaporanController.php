<?php

namespace App\Http\Controllers\Kampus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeluargaPenerima;
use App\Models\Penyaluran;
use App\Models\LaporanTumbuhKembang;
use App\Models\Spj;
use App\Models\KampusMitra;
use App\Models\ProgramBantuan;
use App\Models\ItemBantuan;
use App\Models\PenyaluranBantuan;
use App\Services\PeriodFilterHelper;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource with period filter (hari, minggu, bulan, tahun).
     */
    public function index(Request $request)
    {
        $periodInfo = PeriodFilterHelper::parseRequest($request);

        $kampus = KampusMitra::where('user_id', auth()->id())->first() ?? KampusMitra::first();
        $kampusId = $kampus ? $kampus->id : null;

        // Query Penyaluran Bantuan Binaan Kampus
        $penyaluranQuery = PenyaluranBantuan::with(['keluargaPenerima.wilayah', 'programBantuan', 'itemBantuan', 'pendamping'])
            ->where('status', '!=', 'batal')
            ->when($kampusId, function($q) use ($kampusId) {
                $q->whereHas('programBantuan', function($pb) use ($kampusId) {
                    $pb->where('kampus_id', $kampusId);
                });
            });

        // Query Laporan Tumbuh Kembang Lapangan
        $laporanQuery = LaporanTumbuhKembang::with(['keluarga_penerima.wilayah', 'pendamping'])
            ->when($kampusId, function($q) use ($kampusId) {
                $q->whereHas('pendamping', function($p) use ($kampusId) {
                    $p->where('kampus_id', $kampusId);
                });
            });

        // Terapkan Filter Tanggal Periode
        if ($periodInfo['start'] && $periodInfo['end']) {
            $penyaluranQuery->whereBetween('tgl_penyaluran', [$periodInfo['start']->toDateString(), $periodInfo['end']->toDateString()]);
            $laporanQuery->whereBetween('tanggal_lapor', [$periodInfo['start']->toDateString(), $periodInfo['end']->toDateString()]);
        }

        $penyalurans = (clone $penyaluranQuery)->latest('tgl_penyaluran')->latest('id')->take(20)->get();
        $laporans = (clone $laporanQuery)->latest('tanggal_lapor')->latest('id')->take(20)->get();

        $totalPenyaluran = (clone $penyaluranQuery)->count();
        $totalNominalUang = (clone $penyaluranQuery)->where('jenis', 'uang')->sum('nominal_uang');
        $totalBarangDisalurkan = (clone $penyaluranQuery)->where('jenis', 'barang')->sum('jumlah');
        $totalBibitDisalurkan = (clone $penyaluranQuery)->where('jenis', 'bibit')->sum('jumlah');
        $totalKkTerlayani = (clone $penyaluranQuery)->distinct('keluarga_penerima_id')->count('keluarga_penerima_id');
        $totalLaporan = (clone $laporanQuery)->count();

        // Data Program Bantuan
        $programs = ProgramBantuan::with('itemBantuans')
            ->when($kampusId, function($q) use ($kampusId) {
                $q->where('kampus_id', $kampusId);
            })->latest()->get();

        return view('dashboard.kampus.laporan.index', compact(
            'kampus',
            'programs',
            'penyalurans',
            'laporans',
            'totalPenyaluran',
            'totalNominalUang',
            'totalBarangDisalurkan',
            'totalBibitDisalurkan',
            'totalKkTerlayani',
            'totalLaporan',
            'periodInfo'
        ));
    }

    /**
     * Export Ringkasan Laporan Kampus ke PDF with period filter.
     */
    public function cetakPdf(Request $request)
    {
        $periodInfo = PeriodFilterHelper::parseRequest($request);

        $kampus = KampusMitra::where('user_id', auth()->id())->first() ?? KampusMitra::first();
        $kampusId = $kampus ? $kampus->id : null;

        $penyaluranQuery = PenyaluranBantuan::with(['keluargaPenerima.wilayah', 'programBantuan', 'itemBantuan', 'pendamping'])
            ->where('status', '!=', 'batal')
            ->when($kampusId, function($q) use ($kampusId) {
                $q->whereHas('programBantuan', function($pb) use ($kampusId) {
                    $pb->where('kampus_id', $kampusId);
                });
            });

        if ($periodInfo['start'] && $periodInfo['end']) {
            $penyaluranQuery->whereBetween('tgl_penyaluran', [$periodInfo['start']->toDateString(), $periodInfo['end']->toDateString()]);
        }

        $penyalurans = $penyaluranQuery->latest('tgl_penyaluran')->get();

        $pendampings = \App\Models\User::where('role', 'pendamping')
            ->when($kampus, function($q) use ($kampus) {
                $q->where('kampus_id', $kampus->id);
            })->get();

        $keluargas = KeluargaPenerima::with(['wilayah', 'pendamping'])
            ->when($kampus, function($q) use ($kampus) {
                $q->where('kampus_id', $kampus->id);
            })->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('dashboard.kampus.laporan.ringkasan_pdf', compact('kampus', 'penyalurans', 'pendampings', 'keluargas', 'periodInfo'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan_Program_Kampus_' . ($kampus ? str_replace(' ', '_', $kampus->nama_universitas) : 'Mitra') . '_' . ($periodInfo['start_date'] ?? 'all') . '.pdf');
    }

    /**
     * Export Log Harian Pendamping ke PDF with period filter.
     */
    public function logPendampingPdf(Request $request)
    {
        $periodInfo = PeriodFilterHelper::parseRequest($request);

        $kampus = KampusMitra::where('user_id', auth()->id())->first() ?? KampusMitra::first();
        $pendampings = \App\Models\User::where('role', 'pendamping')
            ->when($kampus, function($q) use ($kampus) {
                $q->where('kampus_id', $kampus->id);
            })->get();

        $laporanQuery = LaporanTumbuhKembang::with(['keluarga_penerima', 'pendamping']);
        if ($periodInfo['start'] && $periodInfo['end']) {
            $laporanQuery->whereBetween('tanggal_lapor', [$periodInfo['start']->toDateString(), $periodInfo['end']->toDateString()]);
        }
        $laporans = $laporanQuery->latest('tanggal_lapor')->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('dashboard.kampus.laporan.log_pendamping_pdf', compact('kampus', 'pendampings', 'laporans', 'periodInfo'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan_Log_Pendamping_' . ($periodInfo['start_date'] ?? 'all') . '.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
