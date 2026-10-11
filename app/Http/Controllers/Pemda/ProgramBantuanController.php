<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgramBantuan;

class ProgramBantuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = ProgramBantuan::all();
        return view('dashboard.pemda.program-bantuan.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pemda.program-bantuan.create');
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
            'target_kk' => 'required|integer|min:0',
            'tahun_anggaran' => 'required|integer|min:2000',
            'status' => 'required|in:draf,aktif,selesai',
        ]);

        ProgramBantuan::create($validated);

        return redirect()->route('pemda.program-bantuan.index')->with('success', 'Program Bantuan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $program = ProgramBantuan::findOrFail($id);
        return view('dashboard.pemda.program-bantuan.edit', compact('program'));
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
            'target_kk' => 'required|integer|min:0',
            'tahun_anggaran' => 'required|integer|min:2000',
            'status' => 'required|in:draf,aktif,selesai',
        ]);

        $program->update($validated);

        return redirect()->route('pemda.program-bantuan.index')->with('success', 'Program Bantuan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $program = ProgramBantuan::findOrFail($id);
        $program->delete();

        return redirect()->route('pemda.program-bantuan.index')->with('success', 'Program Bantuan berhasil dihapus.');
    }
}
