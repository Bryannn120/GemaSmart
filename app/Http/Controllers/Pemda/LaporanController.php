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

use App\Services\PeriodFilterHelper;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource with period filter (hari, minggu, bulan, tahun).
     */
    public function index(Request $request)
    {
        $periodInfo = PeriodFilterHelper::parseRequest($request);

        $programQuery = ProgramBantuan::query();
        $penerimaQuery = KeluargaPenerima::query();
        $penyaluranQuery = Penyaluran::query();
        $validasiQuery = ValidasiCpcl::query();
        $tumbuhKembangQuery = LaporanTumbuhKembang::query();
        $wargaQuery = LaporanPenerima::with([
            'keluargaPenerima.wilayah.parent',
            'keluargaPenerima.programBantuan',
            'keluargaPenerima.pendamping.kampus',
            'keluargaPenerima.kampusMitra'
        ]);

        if ($periodInfo['start'] && $periodInfo['end']) {
            $penyaluranQuery->whereBetween('created_at', [$periodInfo['start'], $periodInfo['end']]);
            $validasiQuery->whereBetween('created_at', [$periodInfo['start'], $periodInfo['end']]);
            $tumbuhKembangQuery->whereBetween('created_at', [$periodInfo['start'], $periodInfo['end']]);
            $wargaQuery->whereBetween('created_at', [$periodInfo['start'], $periodInfo['end']]);
        }

        $totalProgram = $programQuery->count();
        $totalKeluargaPenerima = $penerimaQuery->count();
        $totalPenyaluran = $penyaluranQuery->count();
        $totalValidasi = $validasiQuery->count();
        $totalLaporan = $tumbuhKembangQuery->count();
        $totalLaporanWarga = (clone $wargaQuery)->count();

        $keluarga_penerimaByStatus = KeluargaPenerima::selectRaw('status_validasi, count(*) as total')->groupBy('status_validasi')->get();
        $penyaluranByStatus = (clone $penyaluranQuery)->selectRaw('status, count(*) as total')->groupBy('status')->get();
        $laporanByKondisi = (clone $tumbuhKembangQuery)->selectRaw('status_kondisi, count(*) as total')->groupBy('status_kondisi')->get();

        // Mengambil Laporan / Feedback dari Penerima sesuai periode
        $laporanWargas = $wargaQuery->latest()->get();
        $filterParams = $request->only(['start_date', 'end_date', 'periode', 'bulan', 'tahun']);

        return view('dashboard.pemda.laporan.index', compact(
            'totalProgram', 'totalKeluargaPenerima', 'totalPenyaluran', 'totalValidasi', 'totalLaporan', 'totalLaporanWarga',
            'keluarga_penerimaByStatus', 'penyaluranByStatus', 'laporanByKondisi', 'laporanWargas',
            'periodInfo', 'filterParams'
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
     * Export dashboard summary to PDF with period filter.
     */
    public function cetakPdf(Request $request)
    {
        $periodInfo = PeriodFilterHelper::parseRequest($request);

        $penyaluranQuery = Penyaluran::query();
        $validasiQuery = ValidasiCpcl::query();
        $tumbuhKembangQuery = LaporanTumbuhKembang::query();

        if ($periodInfo['start'] && $periodInfo['end']) {
            $penyaluranQuery->whereBetween('created_at', [$periodInfo['start'], $periodInfo['end']]);
            $validasiQuery->whereBetween('created_at', [$periodInfo['start'], $periodInfo['end']]);
            $tumbuhKembangQuery->whereBetween('created_at', [$periodInfo['start'], $periodInfo['end']]);
        }

        $totalProgram = ProgramBantuan::count();
        $totalKeluargaPenerima = KeluargaPenerima::count();
        $totalPenyaluran = $penyaluranQuery->count();
        $totalValidasi = $validasiQuery->count();
        $totalLaporan = $tumbuhKembangQuery->count();

        $keluarga_penerimaByStatus = KeluargaPenerima::selectRaw('status_validasi, count(*) as total')->groupBy('status_validasi')->get();
        $penyaluranByStatus = $penyaluranQuery->selectRaw('status, count(*) as total')->groupBy('status')->get();
        $laporanByKondisi = $tumbuhKembangQuery->selectRaw('status_kondisi, count(*) as total')->groupBy('status_kondisi')->get();

        $pdf = Pdf::loadView('dashboard.pemda.laporan.pdf', compact(
            'totalProgram', 'totalKeluargaPenerima', 'totalPenyaluran', 'totalValidasi', 'totalLaporan',
            'keluarga_penerimaByStatus', 'penyaluranByStatus', 'laporanByKondisi', 'periodInfo'
        ));
        
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan_Rekapitulasi_Gema_Smart_' . ($periodInfo['start_date'] ?? 'all') . '.pdf');
    }

    /**
     * Export Laporan Penyaluran Bibit ke PDF with period filter
     */
    public function penyaluranPdf(Request $request)
    {
        $periodInfo = PeriodFilterHelper::parseRequest($request);

        $query = Penyaluran::with(['wilayah', 'jenisBibit']);
        if ($periodInfo['start'] && $periodInfo['end']) {
            $query->whereBetween('created_at', [$periodInfo['start'], $periodInfo['end']]);
        }
        $penyalurans = $query->latest()->get();
        $totalKuantitas = $penyalurans->sum('kuantitas');

        $pdf = Pdf::loadView('dashboard.pemda.laporan.penyaluran_pdf', compact('penyalurans', 'totalKuantitas', 'periodInfo'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan_Penyaluran_Bibit_Pemda_' . ($periodInfo['start_date'] ?? 'all') . '.pdf');
    }

    /**
     * Export Statistik Tumbuh Kembang ke PDF with period filter
     */
    public function tumbuhKembangPdf(Request $request)
    {
        $periodInfo = PeriodFilterHelper::parseRequest($request);

        $query = LaporanTumbuhKembang::with(['keluarga_penerima', 'pendamping']);
        if ($periodInfo['start'] && $periodInfo['end']) {
            $query->whereBetween('created_at', [$periodInfo['start'], $periodInfo['end']]);
        }
        $laporans = $query->latest()->get();
        $laporanByKondisi = (clone $query)->selectRaw('status_kondisi, count(*) as total')->groupBy('status_kondisi')->get();

        $pdf = Pdf::loadView('dashboard.pemda.laporan.tumbuh_kembang_pdf', compact('laporans', 'laporanByKondisi', 'periodInfo'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan_Statistik_Tumbuh_Kembang_' . ($periodInfo['start_date'] ?? 'all') . '.pdf');
    }

    /**
     * Export Laporan Validasi Lapangan ke PDF with period filter
     */
    public function validasiPdf(Request $request)
    {
        $periodInfo = PeriodFilterHelper::parseRequest($request);

        $query = ValidasiCpcl::with(['keluarga_penerima', 'pendamping', 'validator']);
        if ($periodInfo['start'] && $periodInfo['end']) {
            $query->whereBetween('created_at', [$periodInfo['start'], $periodInfo['end']]);
        }
        $validasis = $query->latest()->get();
        $keluarga_penerimaByStatus = KeluargaPenerima::selectRaw('status_validasi, count(*) as total')->groupBy('status_validasi')->get();

        $pdf = Pdf::loadView('dashboard.pemda.laporan.validasi_pdf', compact('validasis', 'keluarga_penerimaByStatus', 'periodInfo'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan_Validasi_Lapangan_' . ($periodInfo['start_date'] ?? 'all') . '.pdf');
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
