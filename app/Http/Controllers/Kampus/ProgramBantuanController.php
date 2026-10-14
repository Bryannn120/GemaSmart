<?php

namespace App\Http\Controllers\Kampus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProgramBantuan;
use App\Models\ItemBantuan;
use App\Models\KampusMitra;
use App\Models\AuditLog;

class ProgramBantuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $kampusId = $user->kampus_id ?? KampusMitra::first()->id ?? 1;

        $query = ProgramBantuan::with(['itemBantuans', 'penyaluranBantuans', 'kampusMitra'])
            ->withCount(['itemBantuans', 'penyaluranBantuans']);

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where('nama_program', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $programs = $query->latest()->get();

        // Stats
        $totalPrograms = $programs->count();
        $totalPagu = $programs->sum('pagu_anggaran');
        $totalTargetKK = $programs->sum('target_kk');
        $totalItemBantuan = ItemBantuan::count();
        $totalPenyaluran = \App\Models\PenyaluranBantuan::where('status', '!=', 'batal')->count();

        return view('dashboard.kampus.program-bantuan.index', compact(
            'programs',
            'totalPrograms',
            'totalPagu',
            'totalTargetKK',
            'totalItemBantuan',
            'totalPenyaluran'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.kampus.program-bantuan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'pagu_anggaran' => 'required|numeric|min:0',
            'target_kk' => 'required|integer|min:1',
            'tahun_anggaran' => 'required|integer|min:2020|max:2099',
            'jenis_subsidi' => 'nullable|array',
            'status' => 'required|in:draf,aktif,selesai',
        ], [
            'nama_program.required' => 'Nama program bantuan wajib diisi.',
            'pagu_anggaran.required' => 'Pagu anggaran program wajib diisi.',
            'target_kk.required' => 'Target jumlah keluarga penerima wajib diisi.',
            'tahun_anggaran.required' => 'Tahun anggaran wajib diisi.',
        ]);

        $user = Auth::user();
        $kampusId = $user->kampus_id ?? KampusMitra::first()->id ?? 1;

        $validated['kampus_id'] = $kampusId;
        $validated['jenis_subsidi'] = !empty($request->jenis_subsidi) ? implode(',', $request->jenis_subsidi) : 'bibit,uang,barang';

        $program = ProgramBantuan::create($validated);

        // Optional: otomatis buatkan item bantuan awal jika diinput di form
        if ($request->filled('initial_item_nama')) {
            ItemBantuan::create([
                'program_bantuan_id' => $program->id,
                'jenis' => $request->initial_item_jenis ?? 'bibit',
                'nama_item' => $request->initial_item_nama,
                'satuan' => $request->initial_item_satuan ?? 'unit',
                'nominal_satuan' => $request->initial_item_nominal ?? 0,
                'total_stok' => $request->initial_item_stok ?? 100,
                'deskripsi' => $request->initial_item_deskripsi,
            ]);
        }

        // Catat Audit Trail
        AuditLog::create([
            'user_id' => Auth::id(),
            'aksi' => 'Kampus Membuat Program Bantuan Baru',
            'model' => 'ProgramBantuan',
            'model_id' => $program->id,
            'data_lama' => null,
            'data_baru' => $program->toArray(),
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('kampus.program-bantuan.show', $program->id)
            ->with('success', "Program Bantuan {$program->nama_program} berhasil dibuat oleh Kampus. Silakan tambahkan rincian jenis bantuan (bibit, uang, atau barang).");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $program = ProgramBantuan::with([
            'kampusMitra',
            'itemBantuans' => function($q) {
                $q->withCount('penyaluranBantuans')->orderBy('jenis')->orderBy('nama_item');
            },
            'penyaluranBantuans' => function($q) {
                $q->with(['keluargaPenerima.wilayah', 'itemBantuan', 'pendamping'])->latest();
            }
        ])->findOrFail($id);

        $itemsByJenis = [
            'bibit' => $program->itemBantuans->where('jenis', 'bibit'),
            'uang' => $program->itemBantuans->where('jenis', 'uang'),
            'barang' => $program->itemBantuans->where('jenis', 'barang'),
        ];

        // Total uang disalurkan
        $totalUangDisalurkan = $program->penyaluranBantuans->where('jenis', 'uang')->sum('nominal_uang');
        $totalAlatDisalurkan = $program->penyaluranBantuans->where('jenis', 'barang')->sum('jumlah');
        $totalBibitDisalurkan = $program->penyaluranBantuans->where('jenis', 'bibit')->sum('jumlah');

        return view('dashboard.kampus.program-bantuan.show', compact(
            'program',
            'itemsByJenis',
            'totalUangDisalurkan',
            'totalAlatDisalurkan',
            'totalBibitDisalurkan'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $program = ProgramBantuan::findOrFail($id);
        return view('dashboard.kampus.program-bantuan.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $program = ProgramBantuan::findOrFail($id);

        $validated = $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'pagu_anggaran' => 'required|numeric|min:0',
            'target_kk' => 'required|integer|min:1',
            'tahun_anggaran' => 'required|integer|min:2020|max:2099',
            'jenis_subsidi' => 'nullable|array',
            'status' => 'required|in:draf,aktif,selesai',
        ]);

        $dataLama = $program->toArray();

        $validated['jenis_subsidi'] = !empty($request->jenis_subsidi) ? implode(',', $request->jenis_subsidi) : $program->jenis_subsidi;

        $program->update($validated);

        // Catat Audit Trail
        AuditLog::create([
            'user_id' => Auth::id(),
            'aksi' => 'Kampus Mengupdate Program Bantuan',
            'model' => 'ProgramBantuan',
            'model_id' => $program->id,
            'data_lama' => $dataLama,
            'data_baru' => $program->toArray(),
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('kampus.program-bantuan.show', $program->id)
            ->with('success', "Data Program Bantuan {$program->nama_program} berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $program = ProgramBantuan::findOrFail($id);
        $nama = $program->nama_program;
        $dataLama = $program->toArray();

        $program->delete();

        // Catat Audit Trail
        AuditLog::create([
            'user_id' => Auth::id(),
            'aksi' => 'Kampus Menghapus Program Bantuan',
            'model' => 'ProgramBantuan',
            'model_id' => (int) $id,
            'data_lama' => $dataLama,
            'data_baru' => null,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('kampus.program-bantuan.index')
            ->with('success', "Program Bantuan {$nama} berhasil dihapus.");
    }

    /**
     * Store a new aid item (Bibit, Uang, Barang) into the program.
     */
    public function storeItem(Request $request, string $id)
    {
        $program = ProgramBantuan::findOrFail($id);

        $validated = $request->validate([
            'jenis' => 'required|in:bibit,uang,barang',
            'nama_item' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'nominal_satuan' => 'nullable|numeric|min:0',
            'total_stok' => 'nullable|numeric|min:0',
        ], [
            'jenis.required' => 'Kategori jenis bantuan (bibit, uang, atau barang) wajib dipilih.',
            'nama_item.required' => 'Nama bantuan wajib diisi (misal: Kompor Gas, Bibit Cabai, dll).',
            'satuan.required' => 'Satuan wajib diisi (misal: unit, batang, rupiah, kg).',
        ]);

        $validated['program_bantuan_id'] = $program->id;
        $validated['nominal_satuan'] = $validated['nominal_satuan'] ?? 0;
        $validated['total_stok'] = $validated['total_stok'] ?? 100;

        $item = ItemBantuan::create($validated);

        return redirect()->route('kampus.program-bantuan.show', $program->id)
            ->with('success', "Jenis bantuan {$item->nama_item} ({$item->jenis}) berhasil ditambahkan ke program.");
    }

    /**
     * Remove an aid item.
     */
    public function destroyItem(Request $request, string $programId, string $itemId)
    {
        $program = ProgramBantuan::findOrFail($programId);
        $item = ItemBantuan::where('program_bantuan_id', $programId)->findOrFail($itemId);
        $namaItem = $item->nama_item;

        $item->delete();

        return redirect()->route('kampus.program-bantuan.show', $program->id)
            ->with('success', "Item bantuan {$namaItem} berhasil dihapus dari program.");
    }
}
