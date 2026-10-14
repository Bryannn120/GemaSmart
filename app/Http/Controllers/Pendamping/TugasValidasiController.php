<?php

namespace App\Http\Controllers\Pendamping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ValidasiCpcl;
use App\Models\KeluargaPenerima;

class TugasValidasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = ValidasiCpcl::with(['keluarga_penerima.wilayah.parent', 'validator'])
            ->where('pendamping_id', auth()->id());

        if ($request->filled('search')) {
            $searchTerm = trim($search);
            $query->whereHas('keluarga_penerima', function ($kp) use ($searchTerm) {
                $kp->where('kepala_keluarga', 'like', "%{$searchTerm}%")
                    ->orWhere('nik', 'like', "%{$searchTerm}%")
                    ->orWhere('no_kk', 'like', "%{$searchTerm}%")
                    ->orWhereHas('wilayah', function ($w) use ($searchTerm) {
                        $w->where('nama', 'like', "%{$searchTerm}%")
                            ->orWhereHas('parent', function ($p) use ($searchTerm) {
                                $p->where('nama', 'like', "%{$searchTerm}%");
                            });
                    });
            });
        }

        $validasis = $query->latest('tgl_survei')->latest('id')->get();
        return view('dashboard.pendamping.tugas-validasi.index', compact('validasis', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $keluarga_penerimas = KeluargaPenerima::where('status_validasi', 'menunggu_validasi')->get();
        return view('dashboard.pendamping.tugas-validasi.create', compact('keluarga_penerimas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'keluarga_penerima_id' => 'required|exists:keluarga_penerimas,id',
            'tgl_survei' => 'required|date',
            'status_kelayakan' => 'required|in:layak,tidak_layak,review',
            'catatan' => 'nullable|string',
            'foto_lahan_url' => 'nullable|string',
        ]);

        $validated['pendamping_id'] = auth()->id();
        $validated['status_approval_pemda'] = 'menunggu';

        ValidasiCpcl::create($validated);

        // Update status keluarga_penerima
        KeluargaPenerima::where('id', $validated['keluarga_penerima_id'])->update(['status_validasi' => 'proses_lapangan']);

        return redirect()->route('pendamping.tugas-validasi.index')->with('success', 'Validasi lapangan berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('pendamping.tugas-validasi.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $validasi = ValidasiCpcl::with('keluarga_penerima')->findOrFail($id);
        return view('dashboard.pendamping.tugas-validasi.edit', compact('validasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = ValidasiCpcl::findOrFail($id);

        $validated = $request->validate([
            'tgl_survei' => 'required|date',
            'status_kelayakan' => 'required|in:layak,tidak_layak,review',
            'catatan' => 'nullable|string',
            'foto_lahan_url' => 'nullable|string',
        ]);

        $validasi->update($validated);

        return redirect()->route('pendamping.tugas-validasi.index')->with('success', 'Data validasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $validasi = ValidasiCpcl::findOrFail($id);
        $validasi->delete();

        return redirect()->route('pendamping.tugas-validasi.index')->with('success', 'Data validasi berhasil dihapus.');
    }
}
