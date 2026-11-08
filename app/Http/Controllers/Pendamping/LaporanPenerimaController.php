<?php

namespace App\Http\Controllers\Pendamping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LaporanPenerima;
use App\Models\KeluargaPenerima;

class LaporanPenerimaController extends Controller
{
    /**
     * Tampilkan daftar laporan & keluhan dari keluarga penerima binaan pendamping.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $desaIds = $user->getAssignedDesaIds();
        $filterStatus = $request->query('status'); // 'unread', 'read', 'all'
        $search = $request->query('search');

        $query = LaporanPenerima::with([
            'keluargaPenerima.wilayah.parent',
            'keluargaPenerima.programBantuan'
        ])->whereHas('keluargaPenerima', function ($q) use ($user) {
            $q->where('pendamping_id', $user->id);
        });

        if ($filterStatus === 'unread') {
            $query->where('is_read_by_pendamping', false);
        } elseif ($filterStatus === 'read') {
            $query->where('is_read_by_pendamping', true);
        }

        if ($request->filled('search')) {
            $term = trim($search);
            $query->where(function ($q) use ($term) {
                $q->where('laporan_teks', 'like', "%{$term}%")
                  ->orWhereHas('keluargaPenerima', function ($kp) use ($term) {
                      $kp->where('kepala_keluarga', 'like', "%{$term}%")
                         ->orWhere('no_kk', 'like', "%{$term}%")
                         ->orWhere('nik', 'like', "%{$term}%")
                         ->orWhere('alamat', 'like', "%{$term}%");
                  });
            });
        }

        $laporanPenerimas = $query->latest('id')->paginate(15)->withQueryString();

        // Hitung statistik (hanya keluarga yang didampingi oleh pendamping yang login)
        $baseCountQuery = LaporanPenerima::whereHas('keluargaPenerima', function ($q) use ($user) {
            $q->where('pendamping_id', $user->id);
        });

        $countTotal = (clone $baseCountQuery)->count();
        $countUnread = (clone $baseCountQuery)->where('is_read_by_pendamping', false)->count();
        $countRead = (clone $baseCountQuery)->where('is_read_by_pendamping', true)->count();

        return view('dashboard.pendamping.laporan_penerima.index', compact(
            'laporanPenerimas',
            'countTotal',
            'countUnread',
            'countRead',
            'filterStatus',
            'search'
        ));
    }

    /**
     * Tampilkan detail laporan dari keluarga penerima binaan dan tandai telah dibaca.
     */
    public function show(string $id)
    {
        $user = Auth::user();

        $laporan = LaporanPenerima::with([
            'keluargaPenerima.wilayah.parent',
            'keluargaPenerima.programBantuan',
            'keluargaPenerima.pendamping',
            'keluargaPenerima.kampusMitra'
        ])->whereHas('keluargaPenerima', function ($q) use ($user) {
            $q->where('pendamping_id', $user->id);
        })->findOrFail($id);

        // Tandai sudah dibaca oleh pendamping
        if (!$laporan->is_read_by_pendamping) {
            $laporan->update(['is_read_by_pendamping' => true]);
        }

        return view('dashboard.pendamping.laporan_penerima.show', compact('laporan'));
    }
}
