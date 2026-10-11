<?php

namespace App\Http\Controllers\Pendamping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeluargaPenerima;

class KeluargaPenerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keluarga_penerimas = KeluargaPenerima::with(['wilayah', 'programBantuan'])->get();
        return view('dashboard.pendamping.keluarga_penerima.index', compact('keluarga_penerimas'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $keluarga_penerima = KeluargaPenerima::with([
            'wilayah', 
            'programBantuan', 
            'kampusMitra', 
            'penilaianKemandirians' => function($q) {
                $q->latest();
            }
        ])->findOrFail($id);
        return view('dashboard.pendamping.keluarga_penerima.show', compact('keluarga_penerima'));
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
