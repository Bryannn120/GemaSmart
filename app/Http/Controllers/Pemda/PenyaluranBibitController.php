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
     * Display a listing of the resource (Read-only monitoring for Pemda).
     */
    public function index()
    {
        $penyalurans = Penyaluran::with(['wilayah', 'jenisBibit'])->latest('tgl_kirim')->get();
        return view('dashboard.pemda.penyaluran-bibit.index', compact('penyalurans'));
    }

    /**
     * Creation of BAST by Pemda is removed.
     */
    public function create()
    {
        return redirect()->route('pemda.penyaluran-bibit.index')
            ->with('info', 'Penyaluran bantuan dilakukan secara langsung oleh Kampus Mitra dan Kader Pendamping Lapangan.');
    }

    public function store(Request $request)
    {
        return redirect()->route('pemda.penyaluran-bibit.index')
            ->with('info', 'Penyaluran bantuan dilakukan secara langsung oleh Kampus Mitra dan Kader Pendamping Lapangan.');
    }

    public function show(string $id)
    {
        $penyaluran = Penyaluran::with(['wilayah', 'jenisBibit'])->findOrFail($id);
        return redirect()->route('pemda.penyaluran-bibit.index');
    }

    public function edit(string $id)
    {
        return redirect()->route('pemda.penyaluran-bibit.index')
            ->with('info', 'Penyaluran bantuan dikelola oleh Kampus Mitra dan Kader Pendamping.');
    }

    public function update(Request $request, string $id)
    {
        return redirect()->route('pemda.penyaluran-bibit.index')
            ->with('info', 'Penyaluran bantuan dikelola oleh Kampus Mitra dan Kader Pendamping.');
    }

    public function destroy(string $id)
    {
        return redirect()->route('pemda.penyaluran-bibit.index')
            ->with('info', 'Penyaluran bantuan dikelola oleh Kampus Mitra dan Kader Pendamping.');
    }
}
