<?php

namespace App\Http\Controllers\Pendamping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanTumbuhKembang;
use App\Models\KeluargaPenerima;

class LaporController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = LaporanTumbuhKembang::with(['keluarga_penerima.wilayah'])
            ->where('pendamping_id', auth()->id())
            ->latest()
            ->get();
        return view('dashboard.pendamping.lapor.index', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $keluarga_penerimas = KeluargaPenerima::where('status_validasi', 'valid')->get();
        return view('dashboard.pendamping.lapor.create', compact('keluarga_penerimas'));
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

        LaporanTumbuhKembang::create($validated);

        return redirect()->route('pendamping.lapor.index')->with('success', 'Laporan tumbuh kembang berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $laporan = LaporanTumbuhKembang::with(['keluarga_penerima.wilayah'])->findOrFail($id);
        return view('dashboard.pendamping.lapor.show', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $laporan = LaporanTumbuhKembang::with('keluarga_penerima')->findOrFail($id);
        $keluarga_penerimas = KeluargaPenerima::where('status_validasi', 'valid')->get();
        return view('dashboard.pendamping.lapor.edit', compact('laporan', 'keluarga_penerimas'));
    }

    /**
     * Update the specified resource in storage.
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

        $laporan->update($validated);

        return redirect()->route('pendamping.lapor.index')->with('success', 'Laporan berhasil diperbarui.');
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
