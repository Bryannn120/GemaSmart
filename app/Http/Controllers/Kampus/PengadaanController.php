<?php

namespace App\Http\Controllers\Kampus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spj;
use App\Models\KampusMitra;

class PengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kampus = KampusMitra::where('user_id', auth()->id())->first();
        $spjs = $kampus ? Spj::where('kampus_id', $kampus->id)->latest()->get() : collect();
        return view('dashboard.kampus.pengadaan.index', compact('spjs', 'kampus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.kampus.pengadaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kampus = KampusMitra::where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'nomor_spj' => 'required|string|max:255|unique:spjs,nomor_spj',
            'tgl_pengajuan' => 'required|date',
            'uraian' => 'required|string',
            'nominal' => 'required|numeric|min:0',
            'status' => 'required|in:diajukan,review,disetujui,ditolak',
            'dokumen_spj_url' => 'nullable|string',
        ]);

        $validated['kampus_id'] = $kampus->id;

        Spj::create($validated);

        return redirect()->route('kampus.pengadaan.index')->with('success', 'SPJ berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $spj = Spj::with('kampus')->findOrFail($id);
        return view('dashboard.kampus.pengadaan.show', compact('spj'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $spj = Spj::findOrFail($id);
        return view('dashboard.kampus.pengadaan.edit', compact('spj'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $spj = Spj::findOrFail($id);

        $validated = $request->validate([
            'nomor_spj' => 'required|string|max:255|unique:spjs,nomor_spj,' . $id,
            'tgl_pengajuan' => 'required|date',
            'uraian' => 'required|string',
            'nominal' => 'required|numeric|min:0',
            'status' => 'required|in:diajukan,review,disetujui,ditolak',
            'dokumen_spj_url' => 'nullable|string',
        ]);

        $spj->update($validated);

        return redirect()->route('kampus.pengadaan.index')->with('success', 'SPJ berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $spj = Spj::findOrFail($id);
        $spj->delete();

        return redirect()->route('kampus.pengadaan.index')->with('success', 'SPJ berhasil dihapus.');
    }
}
