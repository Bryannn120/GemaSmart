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
     * Display a listing of the resource with per-desa separation, per-program separation, and search.
     */
    public function index(Request $request)
    {
        $pendampingId = auth()->id();
        $search = $request->query('search');
        $desaId = $request->query('desa_id');
        $programFilter = $request->query('program_id');
        $statusKondisi = $request->query('status_kondisi');

        $user = auth()->user();
        $desaIds = $user->getAssignedDesaIds();

        // Ambil ID laporan KUNJUNGAN TERAKHIR per (keluarga_penerima_id, program_bantuan_id)
        // Ter-scope ke wilayah penugasan pendamping yang sedang login
        $latestQuery = LaporanTumbuhKembang::query();
        if (!empty($desaIds)) {
            $latestQuery->where(function($q) use ($user, $desaIds) {
                $q->where('pendamping_id', $user->id)
                  ->orWhereHas('keluarga_penerima', fn($kp) => $kp->whereIn('wilayah_id', $desaIds));
            });
        } else {
            $latestQuery->where('pendamping_id', $user->id);
        }

        $latestReportIds = $latestQuery
            ->selectRaw('MAX(id) as id')
            ->groupBy('keluarga_penerima_id', DB::raw('COALESCE(program_bantuan_id, 0)'))
            ->pluck('id')
            ->toArray();

        // Query Laporan Tumbuh Kembang Terakhir per Program per Keluarga
        $query = LaporanTumbuhKembang::with([
                'keluarga_penerima.wilayah.parent',
                'keluarga_penerima.laporanTumbuhKembangs',
                'programBantuan.kampusMitra',
                'penyaluranBantuan.itemBantuan',
                'penyaluranBantuan.programBantuan',
                'pendamping'
            ])
            ->whereIn('id', $latestReportIds);

        // Filter Program Bantuan
        if ($request->filled('program_id')) {
            $query->where('program_bantuan_id', $programFilter);
        }

        // Filter Status Kondisi
        if ($request->filled('status_kondisi')) {
            $query->where('status_kondisi', $statusKondisi);
        }

        // Filter pencarian berdasarkan nama penerima, NIK, atau wilayah
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
                })
                ->orWhereHas('programBantuan', function($pb) use ($searchTerm) {
                    $pb->where('nama_program', 'like', "%{$searchTerm}%");
                })
                ->orWhere('catatan', 'like', "%{$searchTerm}%");
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

        // Ambil daftar desa binaan pendamping ini
        $desasQuery = Wilayah::with('parent')->where('jenis', 'desa');
        if (!empty($desaIds)) {
            $desasQuery->whereIn('id', $desaIds);
        }
        $desas = $desasQuery->orderBy('nama')->get();

        // Daftar program untuk filter per program
        $programs = \App\Models\ProgramBantuan::where('status', 'aktif')->orderBy('nama_program')->get();

        // Total laporan aktif
        $totalSemuaLaporan = count($latestReportIds);
        $laporanCountPerDesa = [];

        // Data grup per desa untuk tampilan terpisah
        $laporansPerDesa = $laporans->groupBy(function ($lap) {
            return $lap->keluarga_penerima->wilayah->nama ?? 'Wilayah Belum Ditentukan';
        });

        // Bantuan yang sudah disalurkan dan dapat dipantau perkembangannya (ter-scope ke pendamping)
        $bantuanTersalurkanQuery = \App\Models\PenyaluranBantuan::with([
                'keluargaPenerima.wilayah',
                'itemBantuan',
                'programBantuan.kampusMitra',
                'latestPerkembangan'
            ])
            ->where('status', '!=', 'batal');

        if (!empty($desaIds)) {
            $bantuanTersalurkanQuery->where(function($q) use ($user, $desaIds) {
                $q->where('pendamping_id', $user->id)
                  ->orWhereHas('keluargaPenerima', fn($kp) => $kp->whereIn('wilayah_id', $desaIds));
            });
        } else {
            $bantuanTersalurkanQuery->where('pendamping_id', $user->id);
        }

        $bantuansTersalurkan = $bantuanTersalurkanQuery
            ->latest('tgl_penyaluran')
            ->get();

        return view('dashboard.pendamping.lapor.index', compact(
            'laporans',
            'bantuansTersalurkan',
            'desas',
            'programs',
            'laporanCountPerDesa',
            'totalSemuaLaporan',
            'laporansPerDesa',
            'search',
            'desaId',
            'programFilter',
            'statusKondisi',
            'periode',
            'periodInfo'
        ));
    }

    /**
     * Show the form for creating a new resource, with program-first selection.
     */
    public function create(Request $request)
    {
        $user = auth()->user();
        $desaIds = $user->getAssignedDesaIds();

        $selectedProgramId = $request->query('program_id');
        $selectedPenyaluranId = $request->query('penyaluran_id');
        $selectedKeluargaId = $request->query('keluarga_id');

        $selectedPenyaluran = null;
        if ($selectedPenyaluranId) {
            $selectedPenyaluran = \App\Models\PenyaluranBantuan::with([
                'keluargaPenerima.wilayah',
                'programBantuan.kampusMitra',
                'itemBantuan',
                'laporanTumbuhKembangs'
            ])->find($selectedPenyaluranId);

            if ($selectedPenyaluran) {
                $selectedKeluargaId = $selectedPenyaluran->keluarga_penerima_id;
                $selectedProgramId = $selectedPenyaluran->program_bantuan_id;
            }
        }

        // Ambil daftar seluruh program aktif kampus mitra
        $programs = \App\Models\ProgramBantuan::with(['kampusMitra', 'itemBantuans'])
            ->where('status', 'aktif')
            ->orderBy('nama_program')
            ->get();

        // Ambil daftar bantuan tersalurkan di wilayah pendamping
        $penyaluranQuery = \App\Models\PenyaluranBantuan::with([
                'keluargaPenerima.wilayah',
                'programBantuan.kampusMitra',
                'itemBantuan',
                'latestPerkembangan'
            ])
            ->where('status', '!=', 'batal');

        if (!empty($desaIds)) {
            $penyaluranQuery->where(function($q) use ($user, $desaIds) {
                $q->where('pendamping_id', $user->id)
                  ->orWhereHas('keluargaPenerima', fn($kp) => $kp->whereIn('wilayah_id', $desaIds));
            });
        } else {
            $penyaluranQuery->where('pendamping_id', $user->id);
        }
        $penyalurans = $penyaluranQuery->latest('tgl_penyaluran')->get();

        // Keluarga penerima bantuan aktif di wilayah pendamping
        $keluargaQuery = KeluargaPenerima::penerimaAktif()
            ->with(['wilayah', 'programBantuan', 'penyaluranBantuans.programBantuan'])
            ->where('status_validasi', 'valid');

        if (!empty($desaIds)) {
            $keluargaQuery->where(function($q) use ($user, $desaIds) {
                $q->where('pendamping_id', $user->id)
                  ->orWhereIn('wilayah_id', $desaIds);
            });
        } else {
            $keluargaQuery->where('pendamping_id', $user->id);
        }
        $keluarga_penerimas = $keluargaQuery->get();

        return view('dashboard.pendamping.lapor.create', compact(
            'programs',
            'keluarga_penerimas',
            'penyalurans',
            'selectedProgramId',
            'selectedKeluargaId',
            'selectedPenyaluranId',
            'selectedPenyaluran'
        ));
    }

    /**
     * Store a newly created resource in storage, explicitly tying to a program.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_bantuan_id' => 'required|exists:program_bantuans,id',
            'keluarga_penerima_id' => 'required|exists:keluarga_penerimas,id',
            'penyaluran_bantuan_id' => 'nullable|exists:penyaluran_bantuans,id',
            'tanggal_lapor' => 'required|date',
            'status_kondisi' => 'required|in:normal,hama,gagal',
            'catatan' => 'required|string',
            'foto_url' => 'nullable|string',
        ], [
            'program_bantuan_id.required' => 'Pilih jenis program bantuan yang sedang dipantau agar laporan tidak menindih program lain.',
            'keluarga_penerima_id.required' => 'Keluarga penerima bantuan wajib dipilih.',
            'tanggal_lapor.required' => 'Tanggal kunjungan lapangan wajib diisi.',
            'status_kondisi.required' => 'Status kondisi perkembangan wajib dipilih.',
            'catatan.required' => 'Catatan perkembangan lapangan wajib diisi.',
        ]);

        // Jika penyaluran_bantuan_id diisi, pastikan keluarga_penerima_id dan program_bantuan_id selaras
        if (!empty($validated['penyaluran_bantuan_id'])) {
            $penyaluran = \App\Models\PenyaluranBantuan::find($validated['penyaluran_bantuan_id']);
            if ($penyaluran) {
                $validated['keluarga_penerima_id'] = $penyaluran->keluarga_penerima_id;
                $validated['program_bantuan_id'] = $penyaluran->program_bantuan_id;
            }
        }

        $validated['pendamping_id'] = auth()->id();

        $laporan = LaporanTumbuhKembang::create($validated);

        // Catat ke audit log sebagai riwayat kunjungan
        try {
            DB::table('audit_logs')->insert([
                'user_id' => auth()->id(),
                'aksi' => 'Pendamping Update Perkembangan Bantuan Berdasarkan Program',
                'model' => 'LaporanTumbuhKembang',
                'model_id' => $laporan->id,
                'data_lama' => null,
                'data_baru' => json_encode($laporan->toArray()),
                'ip_address' => $request->ip(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Exception $e) {
            // Silently continue
        }

        $namaProgram = $laporan->programBantuan->nama_program ?? 'Program';
        $namaKeluarga = $laporan->keluarga_penerima->kepala_keluarga ?? 'Keluarga';

        return redirect()->route('pendamping.lapor.show', $laporan->id)
            ->with('success', "Laporan perkembangan untuk program {$namaProgram} pada keluarga {$namaKeluarga} berhasil dicatat dan tersimpan terpisah.");
    }

    /**
     * Display the specified resource along with visit history for this specific program and audit logs.
     */
    public function show(string $id)
    {
        $laporan = LaporanTumbuhKembang::with([
                'keluarga_penerima.wilayah.parent',
                'keluarga_penerima.programBantuan',
                'programBantuan.kampusMitra',
                'penyaluranBantuan.itemBantuan',
                'penyaluranBantuan.programBantuan',
                'pendamping'
            ])
            ->findOrFail($id);

        // Ambil riwayat seluruh kunjungan KHUSUS untuk program ini pada keluarga ini
        $riwayatKunjungan = LaporanTumbuhKembang::with([
                'pendamping',
                'keluarga_penerima.wilayah',
                'penyaluranBantuan.itemBantuan',
                'programBantuan'
            ])
            ->where('keluarga_penerima_id', $laporan->keluarga_penerima_id)
            ->where(function($q) use ($laporan) {
                if ($laporan->program_bantuan_id) {
                    $q->where('program_bantuan_id', $laporan->program_bantuan_id);
                } elseif ($laporan->penyaluran_bantuan_id) {
                    $q->where('penyaluran_bantuan_id', $laporan->penyaluran_bantuan_id);
                }
            })
            ->orderBy('tanggal_lapor', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        // Laporan program lainnya untuk keluarga ini (sebagai informasi bahwa program lain tidak tertindih)
        $laporanProgramLain = LaporanTumbuhKembang::with([
                'pendamping',
                'penyaluranBantuan.itemBantuan',
                'programBantuan'
            ])
            ->where('keluarga_penerima_id', $laporan->keluarga_penerima_id)
            ->where('program_bantuan_id', '!=', $laporan->program_bantuan_id)
            ->orderBy('tanggal_lapor', 'desc')
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

        return view('dashboard.pendamping.lapor.show', compact('laporan', 'riwayatKunjungan', 'laporanProgramLain', 'auditLogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $laporan = LaporanTumbuhKembang::with([
            'keluarga_penerima.wilayah',
            'programBantuan.kampusMitra',
            'penyaluranBantuan.itemBantuan'
        ])->findOrFail($id);

        $programs = \App\Models\ProgramBantuan::where('status', 'aktif')->orderBy('nama_program')->get();
        $keluarga_penerimas = KeluargaPenerima::where(function($q) use ($laporan) {
            $q->penerimaAktif()->orWhere('id', $laporan->keluarga_penerima_id);
        })->with('wilayah')->where('status_validasi', 'valid')->get();

        return view('dashboard.pendamping.lapor.edit', compact('laporan', 'programs', 'keluarga_penerimas'));
    }

    /**
     * Update the specified resource in storage when a visit is conducted.
     */
    public function update(Request $request, string $id)
    {
        $laporan = LaporanTumbuhKembang::findOrFail($id);

        $validated = $request->validate([
            'program_bantuan_id' => 'nullable|exists:program_bantuans,id',
            'penyaluran_bantuan_id' => 'nullable|exists:penyaluran_bantuans,id',
            'keluarga_penerima_id' => 'required|exists:keluarga_penerimas,id',
            'tanggal_lapor' => 'required|date',
            'status_kondisi' => 'required|in:normal,hama,gagal',
            'catatan' => 'required|string',
            'foto_url' => 'nullable|string',
        ]);

        if (empty($validated['program_bantuan_id']) && !empty($validated['penyaluran_bantuan_id'])) {
            $pen = \App\Models\PenyaluranBantuan::find($validated['penyaluran_bantuan_id']);
            if ($pen) {
                $validated['program_bantuan_id'] = $pen->program_bantuan_id;
            }
        }

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
