<?php

namespace App\Http\Controllers\Kampus;

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
        $kampus = \App\Models\KampusMitra::where('user_id', \Illuminate\Support\Facades\Auth::id())->first();
        
        $query = KeluargaPenerima::with(['wilayah', 'programBantuan', 'pendamping']);
        if ($kampus) {
            $query->where(function($q) use ($kampus) {
                $q->where('kampus_id', $kampus->id)
                  ->orWhereHas('wilayah', function($w) use ($kampus) {
                      $w->where('nama', $kampus->wilayah_binaan);
                  });
            });
        }
        
        $keluarga_penerimas = $query->get();
        // Jika belum ada data filter wilayah khusus, tampilkan semua keluarga penerima
        if ($keluarga_penerimas->isEmpty()) {
            $keluarga_penerimas = KeluargaPenerima::with(['wilayah', 'programBantuan', 'pendamping'])->get();
        }

        return view('dashboard.kampus.keluarga_penerima.index', compact('keluarga_penerimas'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $keluarga_penerima = KeluargaPenerima::with(['wilayah', 'programBantuan'])->findOrFail($id);
        return view('dashboard.kampus.keluarga_penerima.show', compact('keluarga_penerima'));
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
