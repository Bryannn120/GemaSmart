<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wilayah;

class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wilayahs = Wilayah::all();
        return view('dashboard.pemda.master-data.wilayah.index', compact('wilayahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Wilayah::where('jenis', 'kecamatan')->get();
        return view('dashboard.pemda.master-data.wilayah.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_wilayah' => 'required|string|max:50|unique:wilayahs,kode_wilayah',
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:kecamatan,desa',
            'parent_id' => 'nullable|exists:wilayahs,id',
            'is_aktif' => 'boolean',
        ]);

        $validated['is_aktif'] = $request->has('is_aktif');

        Wilayah::create($validated);

        return redirect()->route('pemda.master-data.wilayah.index')->with('success', 'Wilayah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $wilayah = Wilayah::with('keluarga_penerimas')->findOrFail($id);
        return view('dashboard.pemda.master-data.wilayah.show', compact('wilayah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $wilayah = Wilayah::findOrFail($id);
        $parents = Wilayah::where('jenis', 'kecamatan')->where('id', '!=', $id)->get();
        return view('dashboard.pemda.master-data.wilayah.edit', compact('wilayah', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $wilayah = Wilayah::findOrFail($id);

        $validated = $request->validate([
            'kode_wilayah' => 'required|string|max:50|unique:wilayahs,kode_wilayah,' . $id,
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:kecamatan,desa',
            'parent_id' => 'nullable|exists:wilayahs,id',
            'is_aktif' => 'boolean',
        ]);

        $validated['is_aktif'] = $request->has('is_aktif');

        $wilayah->update($validated);

        return redirect()->route('pemda.master-data.wilayah.index')->with('success', 'Wilayah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wilayah = Wilayah::findOrFail($id);
        $wilayah->delete();

        return redirect()->route('pemda.master-data.wilayah.index')->with('success', 'Wilayah berhasil dihapus.');
    }
}
