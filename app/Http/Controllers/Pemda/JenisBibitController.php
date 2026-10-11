<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisBibit;

class JenisBibitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisBibits = JenisBibit::all();
        return view('dashboard.pemda.master-data.jenis-bibit.index', compact('jenisBibits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pemda.master-data.jenis-bibit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_bibit' => 'required|string|max:50|unique:jenis_bibits,kode_bibit',
            'kategori' => 'required|string|max:255',
            'nama_varian' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
        ]);

        JenisBibit::create($validated);

        return redirect()->route('pemda.master-data.jenis-bibit.index')->with('success', 'Jenis bibit berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jenisBibit = JenisBibit::findOrFail($id);
        return view('dashboard.pemda.master-data.jenis-bibit.show', compact('jenisBibit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jenisBibit = JenisBibit::findOrFail($id);
        return view('dashboard.pemda.master-data.jenis-bibit.edit', compact('jenisBibit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jenisBibit = JenisBibit::findOrFail($id);

        $validated = $request->validate([
            'kode_bibit' => 'required|string|max:50|unique:jenis_bibits,kode_bibit,' . $id,
            'kategori' => 'required|string|max:255',
            'nama_varian' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
        ]);

        $jenisBibit->update($validated);

        return redirect()->route('pemda.master-data.jenis-bibit.index')->with('success', 'Jenis bibit berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisBibit = JenisBibit::findOrFail($id);
        $jenisBibit->delete();

        return redirect()->route('pemda.master-data.jenis-bibit.index')->with('success', 'Jenis bibit berhasil dihapus.');
    }
}
