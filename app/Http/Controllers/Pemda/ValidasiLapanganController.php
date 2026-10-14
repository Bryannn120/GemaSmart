<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ValidasiCpcl;

class ValidasiLapanganController extends Controller
{
    /**
     * Validasi lapangan pada akun Pemda dinonaktifkan.
     * Dialihkan ke halaman Monitoring.
     */
    public function index()
    {
        return redirect()->route('pemda.monitoring.index');
    }

    public function show(string $id)
    {
        return redirect()->route('pemda.monitoring.index');
    }

    public function edit(string $id)
    {
        return redirect()->route('pemda.monitoring.index');
    }

    public function update(Request $request, string $id)
    {
        return redirect()->route('pemda.monitoring.index');
    }

    public function destroy(string $id)
    {
        return redirect()->route('pemda.monitoring.index');
    }
}
