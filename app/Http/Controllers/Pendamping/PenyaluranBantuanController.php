<?php

namespace App\Http\Controllers\Pendamping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PenyaluranBantuan;
use App\Models\KeluargaPenerima;
use App\Models\ProgramBantuan;
use App\Models\ItemBantuan;
use App\Models\AuditLog;

class PenyaluranBantuanController extends Controller
{
    /**
     * Display a listing of assistance distributed by pendamping to recipients.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $jenisFilter = $request->query('jenis'); // bibit, uang, barang
        $programFilter = $request->query('program_id');

        $query = PenyaluranBantuan::with([
            'keluargaPenerima.wilayah.parent',
            'programBantuan',
            'itemBantuan',
            'pendamping'
        ]);

        if ($request->filled('search')) {
            $term = trim($search);
            $query->where(function($q) use ($term) {
                $q->whereHas('keluargaPenerima', function($kp) use ($term) {
                    $kp->where('kepala_keluarga', 'like', "%{$term}%")
                       ->orWhere('nik', 'like', "%{$term}%")
                       ->orWhere('no_kk', 'like', "%{$term}%");
                })
                ->orWhereHas('itemBantuan', function($ib) use ($term) {
                    $ib->where('nama_item', 'like', "%{$term}%");
                })
                ->orWhere('peruntukan', 'like', "%{$term}%")
                ->orWhere('keterangan', 'like', "%{$term}%");
            });
        }

        $periodInfo = \App\Services\PeriodFilterHelper::parseRequest($request);
        $periode = $periodInfo['periode'] ?? 'semua';

        if ($request->filled('jenis')) {
            $query->where('jenis', $jenisFilter);
        }

        if ($request->filled('program_id')) {
            $query->where('program_bantuan_id', $programFilter);
        }

        \App\Services\PeriodFilterHelper::applyDateFilter($query, $periodInfo, 'tgl_penyaluran');

        $penyalurans = $query->latest('tgl_penyaluran')->latest('id')->paginate(15)->withQueryString();

        // Rekapitulasi Statistik Penyaluran
        $allPenyaluran = PenyaluranBantuan::where('status', '!=', 'batal');
        \App\Services\PeriodFilterHelper::applyDateFilter($allPenyaluran, $periodInfo, 'tgl_penyaluran');
        $totalNominalUang = (clone $allPenyaluran)->where('jenis', 'uang')->sum('nominal_uang');
        $totalAlatUnit = (clone $allPenyaluran)->where('jenis', 'barang')->sum('jumlah');
        $totalBibitDisalurkan = (clone $allPenyaluran)->where('jenis', 'bibit')->sum('jumlah');
        $totalKkMenerima = (clone $allPenyaluran)->distinct('keluarga_penerima_id')->count('keluarga_penerima_id');

        $programs = ProgramBantuan::where('status', 'aktif')->orderBy('nama_program')->get();

        return view('dashboard.pendamping.penyaluran_bantuan.index', compact(
            'penyalurans',
            'totalNominalUang',
            'totalAlatUnit',
            'totalBibitDisalurkan',
            'totalKkMenerima',
            'programs',
            'search',
            'jenisFilter',
            'programFilter',
            'periode',
            'periodInfo'
        ));
    }

    /**
     * Show form for distributing assistance to recipient families.
     */
    public function create(Request $request)
    {
        $selectedKeluargaId = $request->query('keluarga_id');
        $selectedKeluarga = $selectedKeluargaId ? KeluargaPenerima::penerimaAktif()->with(['wilayah', 'programBantuan'])->find($selectedKeluargaId) : null;

        // Otomatis kecualikan keluarga yang sudah mandiri atau mencapai desil 6 ke atas
        $keluarga_penerimas = KeluargaPenerima::penerimaAktif()
            ->with(['wilayah.parent', 'programBantuan'])
            ->orderBy('kepala_keluarga')
            ->get();

        $programs = ProgramBantuan::with(['itemBantuans' => function($q) {
            $q->orderBy('jenis')->orderBy('nama_item');
        }])->where('status', 'aktif')->orderBy('nama_program')->get();

        return view('dashboard.pendamping.penyaluran_bantuan.create', compact(
            'keluarga_penerimas',
            'programs',
            'selectedKeluargaId',
            'selectedKeluarga'
        ));
    }

    /**
     * Store a newly created assistance distribution in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'keluarga_penerima_id' => 'required|exists:keluarga_penerimas,id',
            'program_bantuan_id' => 'required|exists:program_bantuans,id',
            'tgl_penyaluran' => 'required|date',
            'catatan_umum' => 'nullable|string',

            // Multi-item / Paket Penyaluran
            'items' => 'required|array|min:1',
            'items.*.item_bantuan_id' => 'required|exists:item_bantuans,id',
            'items.*.jumlah' => 'required|numeric|min:0.01',
            'items.*.satuan' => 'nullable|string|max:50',
            'items.*.nominal_uang' => 'nullable|numeric|min:0',
            'items.*.peruntukan' => 'nullable|string|max:255',
            'items.*.keterangan' => 'nullable|string|max:255',
        ], [
            'keluarga_penerima_id.required' => 'Keluarga penerima bantuan wajib dipilih.',
            'program_bantuan_id.required' => 'Program bantuan wajib dipilih.',
            'tgl_penyaluran.required' => 'Tanggal penyaluran bantuan wajib diisi.',
            'items.required' => 'Pilih minimal satu item bantuan untuk disalurkan.',
        ]);

        $keluarga = KeluargaPenerima::findOrFail($validated['keluarga_penerima_id']);
        if ($keluarga->is_mandiri) {
            return back()->withInput()->withErrors([
                'keluarga_penerima_id' => 'Keluarga ' . $keluarga->kepala_keluarga . ' telah berstatus Mandiri (Desil ' . $keluarga->desil . ') dan telah lulus dari daftar penerima bantuan.'
            ]);
        }
        $pendampingId = Auth::id();
        $savedRecords = [];

        foreach ($validated['items'] as $itemData) {
            $itemBantuan = ItemBantuan::findOrFail($itemData['item_bantuan_id']);

            $penyaluran = PenyaluranBantuan::create([
                'keluarga_penerima_id' => $keluarga->id,
                'program_bantuan_id' => $validated['program_bantuan_id'],
                'item_bantuan_id' => $itemBantuan->id,
                'pendamping_id' => $pendampingId,
                'jenis' => $itemBantuan->jenis,
                'jumlah' => $itemData['jumlah'],
                'satuan' => !empty($itemData['satuan']) ? $itemData['satuan'] : $itemBantuan->satuan,
                'nominal_uang' => ($itemBantuan->jenis === 'uang') ? ($itemData['nominal_uang'] ?? $itemData['jumlah']) : null,
                'peruntukan' => $itemData['peruntukan'] ?? null,
                'keterangan' => $itemData['keterangan'] ?? $request->catatan_umum,
                'tgl_penyaluran' => $validated['tgl_penyaluran'],
                'status' => 'diterima',
            ]);

            $savedRecords[] = $penyaluran;
        }

        // Catat Audit Trail
        AuditLog::create([
            'user_id' => Auth::id(),
            'aksi' => 'Pendamping Menyalurkan Bantuan ke Keluarga Penerima',
            'model' => 'PenyaluranBantuan',
            'model_id' => $keluarga->id,
            'data_lama' => null,
            'data_baru' => [
                'keluarga' => $keluarga->kepala_keluarga,
                'total_items' => count($savedRecords),
                'tanggal' => $validated['tgl_penyaluran'],
            ],
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('pendamping.penyaluran-bantuan.index')
            ->with('success', "Bantuan berhasil disalurkan kepada keluarga {$keluarga->kepala_keluarga} sebanyak " . count($savedRecords) . " rincian bantuan.");
    }

    /**
     * Display the specified distribution details.
     */
    public function show(string $id)
    {
        $penyaluran = PenyaluranBantuan::with([
            'keluargaPenerima.wilayah.parent',
            'programBantuan.kampusMitra',
            'itemBantuan',
            'pendamping'
        ])->findOrFail($id);

        return view('dashboard.pendamping.penyaluran_bantuan.show', compact('penyaluran'));
    }

    /**
     * Remove or cancel distribution record.
     */
    public function destroy(Request $request, string $id)
    {
        $penyaluran = PenyaluranBantuan::findOrFail($id);
        $namaItem = $penyaluran->itemBantuan->nama_item ?? 'Bantuan';
        $penerima = $penyaluran->keluargaPenerima->kepala_keluarga ?? 'Penerima';

        $penyaluran->delete();

        return redirect()->back()
            ->with('success', "Catatan penyaluran {$namaItem} untuk {$penerima} berhasil dibatalkan.");
    }

    /**
     * API: Get assistance items for a selected program (grouped by jenis: bibit, uang, barang).
     */
    public function getItemsByProgram(string $programId)
    {
        $items = ItemBantuan::where('program_bantuan_id', $programId)
            ->orderBy('jenis')
            ->orderBy('nama_item')
            ->get();

        return response()->json([
            'status' => 'success',
            'items' => $items,
            'grouped' => [
                'bibit' => $items->where('jenis', 'bibit')->values(),
                'uang' => $items->where('jenis', 'uang')->values(),
                'barang' => $items->where('jenis', 'barang')->values(),
            ]
        ]);
    }
}
