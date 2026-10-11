<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgramBantuan;
use App\Models\KeluargaPenerima;
use App\Models\Penyaluran;
use App\Models\ValidasiCpcl;
use App\Models\LaporanTumbuhKembang;
use App\Models\LaporanPenerima;
use App\Models\KampusMitra;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalProgram = ProgramBantuan::count();
        $totalKeluargaPenerima = KeluargaPenerima::count();
        $totalPenyaluran = Penyaluran::count();
        $totalValidasi = ValidasiCpcl::count();
        $totalLaporan = LaporanTumbuhKembang::count();
        $totalLaporanWarga = LaporanPenerima::count();

        $keluarga_penerimaByStatus = KeluargaPenerima::selectRaw('status_validasi, count(*) as total')->groupBy('status_validasi')->get();
        $penyaluranByStatus = Penyaluran::selectRaw('status, count(*) as total')->groupBy('status')->get();
        $laporanByKondisi = LaporanTumbuhKembang::selectRaw('status_kondisi, count(*) as total')->groupBy('status_kondisi')->get();

        // Mengambil seluruh Laporan / Feedback dari Penerima beserta relasinya
        $laporanWargas = LaporanPenerima::with([
            'keluargaPenerima.wilayah.parent',
            'keluargaPenerima.programBantuan',
            'keluargaPenerima.pendamping.kampus',
            'keluargaPenerima.kampusMitra'
        ])->latest()->get();

        return view('dashboard.pemda.laporan.index', compact(
            'totalProgram', 'totalKeluargaPenerima', 'totalPenyaluran', 'totalValidasi', 'totalLaporan', 'totalLaporanWarga',
            'keluarga_penerimaByStatus', 'penyaluranByStatus', 'laporanByKondisi', 'laporanWargas'
        ));
    }

    /**
     * Detail laporan penerima warga
     */
    public function show(string $id)
    {
        $laporan = LaporanPenerima::with([
            'keluargaPenerima.wilayah.parent',
            'keluargaPenerima.programBantuan',
            'keluargaPenerima.pendamping.kampus',
            'keluargaPenerima.kampusMitra'
        ])->findOrFail($id);

        // Tandai sudah dibaca oleh pemda
        if (!$laporan->is_read_by_pemda) {
            $laporan->update(['is_read_by_pemda' => true]);
        }

        return view('dashboard.pemda.laporan.show', compact('laporan'));
    }

    /**
     * Export dashboard summary to PDF.
     */
    public function cetakPdf()
    {
        $totalProgram = ProgramBantuan::count();
        $totalKeluargaPenerima = KeluargaPenerima::count();
        $totalPenyaluran = Penyaluran::count();
        $totalValidasi = ValidasiCpcl::count();
        $totalLaporan = LaporanTumbuhKembang::count();

        $keluarga_penerimaByStatus = KeluargaPenerima::selectRaw('status_validasi, count(*) as total')->groupBy('status_validasi')->get();
        $penyaluranByStatus = Penyaluran::selectRaw('status, count(*) as total')->groupBy('status')->get();
        $laporanByKondisi = LaporanTumbuhKembang::selectRaw('status_kondisi, count(*) as total')->groupBy('status_kondisi')->get();

        $pdf = Pdf::loadView('dashboard.pemda.laporan.pdf', compact(
            'totalProgram', 'totalKeluargaPenerima', 'totalPenyaluran', 'totalValidasi', 'totalLaporan',
            'keluarga_penerimaByStatus', 'penyaluranByStatus', 'laporanByKondisi'
        ));
        
        // Atur ukuran kertas
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan_Rekapitulasi_Gema Smart.pdf');
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
