<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ValidasiCpcl;
use App\Models\KeluargaPenerima;
use App\Models\User;

class ValidasiLapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $validasis = ValidasiCpcl::with(['keluarga_penerima', 'pendamping', 'validator'])->get();
        return view('dashboard.pemda.validasi-lapangan.index', compact('validasis'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $validasi = ValidasiCpcl::with(['keluarga_penerima.wilayah', 'pendamping', 'validator'])->findOrFail($id);
        return view('dashboard.pemda.validasi-lapangan.show', compact('validasi'));
    }

    /**
     * Show the form for editing the specified resource (approval).
     */
    public function edit(string $id)
    {
        $validasi = ValidasiCpcl::with(['keluarga_penerima', 'pendamping', 'validator'])->findOrFail($id);
        return view('dashboard.pemda.validasi-lapangan.edit', compact('validasi'));
    }

    /**
     * Update the specified resource in storage (approve/reject).
     */
    public function update(Request $request, string $id)
    {
        $validasi = ValidasiCpcl::findOrFail($id);

        $validated = $request->validate([
            'status_approval_pemda' => 'required|in:menunggu,disetujui,ditolak',
            'catatan' => 'nullable|string',
        ]);

        $validasi->update($validated);

        // Jika disetujui, update status keluarga_penerima menjadi valid
        if ($validated['status_approval_pemda'] === 'disetujui') {
            $validasi->keluarga_penerima->update(['status_validasi' => 'valid']);
        }

        return redirect()->route('pemda.validasi-lapangan.index')->with('success', 'Status validasi berhasil diperbarui.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $validasi = ValidasiCpcl::findOrFail($id);
        $validasi->delete();

        return redirect()->route('pemda.validasi-lapangan.index')->with('success', 'Data validasi berhasil dihapus.');
    }
}
