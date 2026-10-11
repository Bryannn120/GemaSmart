<?php

namespace App\Http\Controllers\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ValidasiCpcl;

class AntreanController extends Controller
{
    /**
     * Display a listing of the resource â€” pending validations.
     */
    public function index()
    {
        $antreans = ValidasiCpcl::with(['keluarga_penerima.wilayah', 'pendamping'])
            ->whereIn('status_kelayakan', ['review'])
            ->whereNull('validator_id')
            ->orWhere('validator_id', auth()->id())
            ->latest()
            ->get();
        return view('dashboard.validator.antrean.index', compact('antreans'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $antrean = ValidasiCpcl::with(['keluarga_penerima.wilayah', 'pendamping'])->findOrFail($id);
        return view('dashboard.validator.antrean.show', compact('antrean'));
    }

    /**
     * Show the form for editing â€” review form.
     */
    public function edit(string $id)
    {
        $antrean = ValidasiCpcl::with(['keluarga_penerima.wilayah', 'pendamping'])->findOrFail($id);
        return view('dashboard.validator.antrean.edit', compact('antrean'));
    }

    /**
     * Update â€” approve or reject validation.
     */
    public function update(Request $request, string $id)
    {
        $validasi = ValidasiCpcl::findOrFail($id);

        $validated = $request->validate([
            'status_kelayakan' => 'required|in:layak,tidak_layak,review',
            'catatan' => 'nullable|string',
        ]);

        $validated['validator_id'] = auth()->id();

        $validasi->update($validated);

        return redirect()->route('validator.antrean.index')->with('success', 'Validasi berhasil diproses.');
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
        //
    }
}
