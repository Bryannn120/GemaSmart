<?php

namespace App\Http\Controllers\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ValidasiCpcl;

class RiwayatController extends Controller
{
    /**
     * Display a listing of completed validations.
     */
    public function index()
    {
        $riwayats = ValidasiCpcl::with(['keluarga_penerima.wilayah', 'pendamping'])
            ->where('validator_id', auth()->id())
            ->whereIn('status_kelayakan', ['layak', 'tidak_layak'])
            ->latest()
            ->get();
        return view('dashboard.validator.riwayat.index', compact('riwayats'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $riwayat = ValidasiCpcl::with(['keluarga_penerima.wilayah', 'pendamping'])->findOrFail($id);
        return view('dashboard.validator.riwayat.show', compact('riwayat'));
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
