<?php

namespace App\Http\Controllers\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ValidasiCpcl;

class DashboardController extends Controller
{
    public function index()
    {
        $antreans = ValidasiCpcl::with(['keluarga_penerima.wilayah', 'pendamping'])
            ->where(function ($q) {
                $q->where('status_kelayakan', 'review')
                  ->orWhereNull('validator_id');
            })
            ->latest()
            ->take(10)
            ->get();

        $totalAntrean = ValidasiCpcl::where(function ($q) {
            $q->where('status_kelayakan', 'review')
              ->orWhereNull('validator_id');
        })->count();

        $totalSelesai = ValidasiCpcl::whereIn('status_kelayakan', ['layak', 'tidak_layak'])->count();

        return view('dashboard.validator', compact('antreans', 'totalAntrean', 'totalSelesai'));
    }
}
