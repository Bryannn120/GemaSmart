<?php

namespace App\Http\Controllers\Pendamping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanTumbuhKembang;
use App\Models\KeluargaPenerima;
use App\Models\Wilayah;
use Illuminate\Support\Facades\DB;

class LaporController extends Controller
{
    /**
     * Display a listing of the resource with per-desa separation and search by name/region.
     */
    public function index(Request $request)
    {
        $pendampingId = auth()->id();
        $search = $request->query('search');
        $desaId = $request->query('desa_id');
        $statusKondisi = $request->query('status_kondisi');

        // Hanya ambil ID laporan KUNJUNGAN TERAKHIR per keluarga penerima (kunjungan lama tampil di histori)
        $latestReportIds = LaporanTumbuhKembang::where('pendamping_id', $pendampingId)
            ->selectRaw('MAX(id) as id')
            ->groupBy('keluarga_penerima_id')
            ->pluck('id')
            ->toArray();

        // Query Laporan Tumbuh Kembang (Kunjungan Terakhir per Keluarga Penerima)
        $query = LaporanTumbuhKembang::with([
                'keluarga_penerima.wilayah.parent',
                'keluarga_penerima.laporanTumbuhKembangs',
                'pendamping'
            ])
            ->whereIn('id', $latestReportIds);

        // Filter pencarian berdasarkan nama penerima atau nama wilayah (desa/kecamatan)
        if ($request->filled('search')) {
            $searchTerm = trim($search);
            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('keluarga_penerima', function ($kp) use ($searchTerm) {
                    $kp->where('kepala_keluarga', 'like', "%{$searchTerm}%")
                        ->orWhere('nik', 'like', "%{$searchTerm}%")
                        ->orWhere('no_kk', 'like', "%{$searchTerm}%")
                        ->orWhereHas('wilayah', function ($w) use ($searchTerm) {
                            $w->where('nama', 'like', "%{$searchTerm}%")
                                ->orWhereHas('parent', function ($p) use ($searchTerm) {
                                    $p->where('nama', 'like', "%{$searchTerm}%");
                                });
                        });
                })->orWhere('catatan', 'like', "%{$searchTerm}%");
            });
        }

        // Filter dipisah per desa
        if ($request->filled('desa_id')) {
            $query->whereHas('keluarga_penerima', function ($kp) use ($desaId) {
                $kp->where('wilayah_id', $desaId);
            });
        }

        // Filter periode waktu (hari, minggu, bulan, tahun, rentang tanggal kustom)
        $periodInfo = \App\Services\PeriodFilterHelper::parseRequest($request);
        $periode = $periodInfo['periode'] ?? 'semua';
        \App\Services\PeriodFilterHelper::applyDateFilter($query, $periodInfo, 'tanggal_lapor');

        $laporans = $query->latest('tanggal_lapor')->latest('id')->get();

        // Ambil daftar seluruh desa untuk tab & dropdown pemisahan per desa
        $desas = Wilayah::with('parent')->where('jenis', 'desa')->orderBy('nama')->get();

        // Hitung jumlah penerima kunjungan terakhir per desa
        $laporanCountPerDesa = [];
        foreach ($desas as $d) {
            $laporanCountPerDesa[$d->id] = LaporanTumbuhKembang::whereIn('id', $latestReportIds)
                ->whereHas('keluarga_penerima', function ($kp) use ($d) {
                    $kp->where('wilayah_id', $d->id);
                })->count();
        }

        $totalSemuaLaporan = count($latestReportIds);

        // Data grup per desa untuk tampilan terpisah
        $laporansPerDesa = $laporans->groupBy(function ($lap) {
            return $lap->keluarga_penerima->wilayah->nama ?? 'Wilayah Belum Ditentukan';
        });

        return view('dashboard.pendamping.lapor.index', compact(
            'laporans',
            'desas',
            'laporanCountPerDesa',
            'totalSemuaLaporan',
            'laporansPerDesa',
            'search',
            'desaId',
            'statusKondisi',
            'periode',
            'periodInfo'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $selectedKeluargaId = $request->query('keluarga_id');
        $keluarga_penerimas = KeluargaPenerima::penerimaAktif()->with('wilayah')->where('status_validasi', 'valid')->get();
        return view('dashboard.pendamping.lapor.create', compact('keluarga_penerimas', 'selectedKeluargaId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'keluarga_penerima_id' => 'required|exists:keluarga_penerimas,id',
            'tanggal_lapor' => 'required|date',
            'status_kondisi' => 'required|in:normal,hama,gagal',
            'catatan' => 'required|string',
            'foto_url' => 'nullable|string',
        ]);

        $validated['pendamping_id'] = auth()->id();

        $laporan = LaporanTumbuhKembang::create($validated);

        // Catat ke audit log sebagai riwayat kunjungan pertama
        try {
            DB::table('audit_logs')->insert([
                'user_id' => auth()->id(),
                'aksi' => 'create',
                'model' => 'LaporanTumbuhKembang',
                'model_id' => $laporan->id,
                'data_lama' => null,
                'data_baru' => json_encode($laporan->toArray()),
                'ip_address' => $request->ip(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Exception $e) {
            // Silently continue if audit log table fails
        }

        return redirect()->route('pendamping.lapor.show', $laporan->id)
            ->with('success', 'Laporan kunjungan tumbuh kembang baru berhasil dicatat dan masuk ke histori.');
    }

    /**
     * Display the specified resource along with full visit history and audit logs.
     */
    public function show(string $id)
    {
        $laporan = LaporanTumbuhKembang::with(['keluarga_penerima.wilayah.parent', 'keluarga_penerima.programBantuan', 'pendamping'])
            ->findOrFail($id);

        // Ambil riwayat seluruh kunjungan untuk keluarga penerima ini
        $riwayatKunjungan = LaporanTumbuhKembang::with(['pendamping', 'keluarga_penerima.wilayah'])
            ->where('keluarga_penerima_id', $laporan->keluarga_penerima_id)
            ->orderBy('tanggal_lapor', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        // Ambil histori update dari audit logs jika ada
        $auditLogs = [];
        try {
            $auditLogs = DB::table('audit_logs')
                ->where('model', 'LaporanTumbuhKembang')
                ->where('model_id', $laporan->id)
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            $auditLogs = collect();
        }

        return view('dashboard.pendamping.lapor.show', compact('laporan', 'riwayatKunjungan', 'auditLogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $laporan = LaporanTumbuhKembang::with(['keluarga_penerima.wilayah'])->findOrFail($id);
        $keluarga_penerimas = KeluargaPenerima::where(function($q) use ($laporan) {
            $q->penerimaAktif()->orWhere('id', $laporan->keluarga_penerima_id);
        })->with('wilayah')->where('status_validasi', 'valid')->get();
        return view('dashboard.pendamping.lapor.edit', compact('laporan', 'keluarga_penerimas'));
    }

    /**
     * Update the specified resource in storage when a visit is conducted.
     */
    public function update(Request $request, string $id)
    {
        $laporan = LaporanTumbuhKembang::findOrFail($id);

        $validated = $request->validate([
            'keluarga_penerima_id' => 'required|exists:keluarga_penerimas,id',
            'tanggal_lapor' => 'required|date',
            'status_kondisi' => 'required|in:normal,hama,gagal',
            'catatan' => 'required|string',
            'foto_url' => 'nullable|string',
        ]);

        $oldData = $laporan->toArray();

        $laporan->update($validated);

        // Catat update ke audit_logs agar histori update dapat ditelusuri
        try {
            DB::table('audit_logs')->insert([
                'user_id' => auth()->id(),
                'aksi' => 'update',
                'model' => 'LaporanTumbuhKembang',
                'model_id' => $laporan->id,
                'data_lama' => json_encode($oldData),
                'data_baru' => json_encode($laporan->fresh()->toArray()),
                'ip_address' => $request->ip(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Exception $e) {
            // Silently continue
        }

        return redirect()->route('pendamping.lapor.show', $laporan->id)
            ->with('success', 'Laporan tumbuh kembang berhasil di-update saat kunjungan dan tercatat di histori.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $laporan = LaporanTumbuhKembang::findOrFail($id);
        $laporan->delete();

        return redirect()->route('pendamping.lapor.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
