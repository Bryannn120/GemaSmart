<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penyaluran;
use App\Models\Wilayah;
use App\Models\JenisBibit;

class PenyaluranBibitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyalurans = Penyaluran::with(['wilayah', 'jenisBibit'])->get();
        return view('dashboard.pemda.penyaluran-bibit.index', compact('penyalurans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wilayahs = Wilayah::where('is_aktif', true)->get();
        $jenisBibits = JenisBibit::all();
        return view('dashboard.pemda.penyaluran-bibit.create', compact('wilayahs', 'jenisBibits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_bast' => 'required|string|max:255|unique:penyalurans,nomor_bast',
            'tgl_kirim' => 'required|date',
            'wilayah_id' => 'required|exists:wilayahs,id',
            'jenis_bibit_id' => 'required|exists:jenis_bibits,id',
            'kuantitas' => 'required|integer|min:1',
            'status' => 'required|in:disiapkan,dikirim,diterima',
            'dokumen_bast_url' => 'nullable|string',
        ]);

        Penyaluran::create($validated);

        return redirect()->route('pemda.penyaluran-bibit.index')->with('success', 'Penyaluran bibit berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penyaluran = Penyaluran::with(['wilayah', 'jenisBibit'])->findOrFail($id);
        return view('dashboard.pemda.penyaluran-bibit.show', compact('penyaluran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penyaluran = Penyaluran::findOrFail($id);
        $wilayahs = Wilayah::where('is_aktif', true)->get();
        $jenisBibits = JenisBibit::all();
        return view('dashboard.pemda.penyaluran-bibit.edit', compact('penyaluran', 'wilayahs', 'jenisBibits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penyaluran = Penyaluran::findOrFail($id);

        $validated = $request->validate([
            'nomor_bast' => 'required|string|max:255|unique:penyalurans,nomor_bast,' . $id,
            'tgl_kirim' => 'required|date',
            'wilayah_id' => 'required|exists:wilayahs,id',
            'jenis_bibit_id' => 'required|exists:jenis_bibits,id',
            'kuantitas' => 'required|integer|min:1',
            'status' => 'required|in:disiapkan,dikirim,diterima',
            'dokumen_bast_url' => 'nullable|string',
        ]);

        $penyaluran->update($validated);

        return redirect()->route('pemda.penyaluran-bibit.index')->with('success', 'Penyaluran bibit berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penyaluran = Penyaluran::findOrFail($id);
        $penyaluran->delete();

        return redirect()->route('pemda.penyaluran-bibit.index')->with('success', 'Penyaluran bibit berhasil dihapus.');
    }
}
