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
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'aktif'); // 'aktif' atau 'mandiri'
        $kampus = \App\Models\KampusMitra::where('user_id', \Illuminate\Support\Facades\Auth::id())->first() ?? \App\Models\KampusMitra::first();
        
        $baseQuery = KeluargaPenerima::with(['wilayah', 'programBantuan', 'pendamping']);
        if ($kampus) {
            $baseQuery->where(function($q) use ($kampus) {
                $q->where('kampus_id', $kampus->id)
                  ->orWhereHas('wilayah', function($w) use ($kampus) {
                      $w->where('nama', $kampus->wilayah_binaan);
                  });
            });
        }

        // Hitung statistik
        $countAktif = (clone $baseQuery)->penerimaAktif()->count();
        $countMandiri = (clone $baseQuery)->mandiri()->count();

        $query = clone $baseQuery;
        if ($tab === 'mandiri') {
            $query->mandiri();
        } else {
            // Otomatis hilangkan penerima yang sudah mandiri atau mencapai desil 6 ke atas
            $query->penerimaAktif();
        }
        
        $keluarga_penerimas = $query->latest('id')->get();

        return view('dashboard.kampus.keluarga_penerima.index', compact(
            'keluarga_penerimas',
            'tab',
            'countAktif',
            'countMandiri'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $keluarga_penerima = KeluargaPenerima::with(['wilayah', 'programBantuan', 'pendamping', 'penyaluranBantuans.itemBantuan'])->findOrFail($id);
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
