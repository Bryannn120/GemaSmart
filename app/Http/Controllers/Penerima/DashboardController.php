<?php

namespace App\Http\Controllers\Penerima;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KeluargaPenerima;
use App\Models\LaporanPenerima;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $keluarga = KeluargaPenerima::with(['wilayah', 'programBantuan', 'laporanPenerimas', 'penilaianKemandirians'])
            ->where('user_id', $user->id)
            ->first();

        return view('dashboard.penerima', compact('user', 'keluarga'));
    }

    public function kirimLaporan(Request $request)
    {
        $request->validate([
            'laporan_teks' => 'required|string|max:1000',
        ]);

        $user = Auth::user();
        $keluarga = KeluargaPenerima::where('user_id', $user->id)->firstOrFail();

        LaporanPenerima::create([
            'keluarga_penerima_id' => $keluarga->id,
            'laporan_teks' => $request->laporan_teks,
            'is_read_by_pemda' => false,
        ]);

        return back()->with('success', 'Laporan/feedback Anda berhasil dikirim ke Pemda.');
    }
}
