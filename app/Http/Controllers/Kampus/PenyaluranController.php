<?php

namespace App\Http\Controllers\Kampus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenyaluranBantuan;

class PenyaluranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyalurans = PenyaluranBantuan::with(['keluargaPenerima.wilayah', 'programBantuan', 'itemBantuan', 'pendamping'])
            ->latest('tgl_penyaluran')
            ->latest('id')
            ->paginate(15);

        return view('dashboard.kampus.penyaluran.index', compact('penyalurans'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penyaluran = PenyaluranBantuan::with(['keluargaPenerima.wilayah', 'programBantuan', 'itemBantuan', 'pendamping'])
            ->findOrFail($id);

        return view('dashboard.kampus.penyaluran.show', compact('penyaluran'));
    }
}
