<?php

namespace App\Http\Controllers\Kampus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeluargaPenerima;
use App\Models\Penyaluran;
use App\Models\LaporanTumbuhKembang;
use App\Models\Spj;
use App\Models\KampusMitra;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kampus = KampusMitra::where('user_id', auth()->id())->first();
        $totalKeluargaPenerima = KeluargaPenerima::count();
        $totalPenyaluran = Penyaluran::count();
        $totalLaporan = LaporanTumbuhKembang::count();
        $totalSpj = $kampus ? Spj::where('kampus_id', $kampus->id)->count() : 0;

        return view('dashboard.kampus.laporan.index', compact(
            'totalKeluargaPenerima', 'totalPenyaluran', 'totalLaporan', 'totalSpj'
        ));
    }

    /**
     * Export Ringkasan Laporan Kampus ke PDF
     */
    public function cetakPdf()
    {
        $kampus = KampusMitra::where('user_id', auth()->id())->first();
        $spjs = $kampus ? Spj::where('kampus_id', $kampus->id)->get() : collect();
        $pendampings = \App\Models\User::where('role', 'pendamping')
            ->when($kampus, function($q) use ($kampus) {
                $q->where('kampus_id', $kampus->id);
            })->get();
        $keluargas = KeluargaPenerima::with(['wilayah', 'pendamping'])
            ->when($kampus, function($q) use ($kampus) {
                $q->where('kampus_id', $kampus->id);
            })->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('dashboard.kampus.laporan.ringkasan_pdf', compact('kampus', 'spjs', 'pendampings', 'keluargas'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan_Internal_Kampus_' . ($kampus ? str_replace(' ', '_', $kampus->nama_universitas) : 'Mitra') . '.pdf');
    }

    /**
     * Export Rekapitulasi SPJ Kampus ke PDF
     */
    public function spjPdf()
    {
        $kampus = KampusMitra::where('user_id', auth()->id())->first();
        $spjs = $kampus ? Spj::where('kampus_id', $kampus->id)->latest()->get() : Spj::latest()->get();
        $totalNominal = $spjs->sum('nominal');

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('dashboard.kampus.laporan.spj_pdf', compact('kampus', 'spjs', 'totalNominal'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan_Rekapitulasi_SPJ_Kampus.pdf');
    }

    /**
     * Export Log Harian Pendamping ke PDF
     */
    public function logPendampingPdf()
    {
        $kampus = KampusMitra::where('user_id', auth()->id())->first();
        $pendampings = \App\Models\User::where('role', 'pendamping')
            ->when($kampus, function($q) use ($kampus) {
                $q->where('kampus_id', $kampus->id);
            })->get();
        $laporans = LaporanTumbuhKembang::with(['keluarga_penerima', 'pendamping'])->latest()->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('dashboard.kampus.laporan.log_pendamping_pdf', compact('kampus', 'pendampings', 'laporans'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan_Log_Pendamping_Lapangan.pdf');
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
