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

        $laporan = LaporanPenerima::create([
            'keluarga_penerima_id' => $keluarga->id,
            'laporan_teks' => $request->laporan_teks,
            'is_read_by_pemda' => false,
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Laporan berhasil dikirim dan disinkronkan ke server Pemda.',
                'laporan' => [
                    'id' => $laporan->id,
                    'laporan_teks' => $laporan->laporan_teks,
                    'created_at' => $laporan->created_at->format('d M Y, H:i'),
                ]
            ]);
        }

        return back()->with('success', 'Laporan/feedback Anda berhasil dikirim ke Pemda.');
    }
}
