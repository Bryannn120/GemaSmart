<?php

namespace App\Http\Controllers\Pendamping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeluargaPenerima;
use App\Models\PenilaianKemandirian;
use App\Models\Wilayah;
use Illuminate\Support\Facades\DB;

class MonitoringKemandirianController extends Controller
{
    /**
     * Tampilkan halaman monitoring kemandirian, distribusi desil, dan riwayat kunjungan penilaian.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $statusFilter = $request->query('status'); // all, mandiri, tahap_kemandirian, penurunan
        $wilayahId = $request->query('wilayah_id');

        $user = auth()->user();
        $desaIds = $user->getAssignedDesaIds();

        // 1. Data Statistik Utama & Agregasi (Ter-scope ke wilayah binaan pendamping)
        $baseKeluarga = KeluargaPenerima::query();
        if (!empty($desaIds)) {
            $baseKeluarga->where(function($q) use ($user, $desaIds) {
                $q->where('pendamping_id', $user->id)
                  ->orWhereIn('wilayah_id', $desaIds);
            });
        } else {
            $baseKeluarga->where('pendamping_id', $user->id);
        }

        $totalBinaan = (clone $baseKeluarga)->count();
        $totalMandiri = (clone $baseKeluarga)->where('desil', '>=', 6)->count();
        $totalTahap = (clone $baseKeluarga)->where('desil', '<', 6)
            ->where('status_kemandirian', '!=', 'Penurunan Desil')
            ->count();
        $totalPenurunan = (clone $baseKeluarga)->where('status_kemandirian', 'Penurunan Desil')->count();

        $totalKunjungan = PenilaianKemandirian::where(function($q) use ($user, $desaIds) {
            $q->where('pendamping_id', $user->id);
            if (!empty($desaIds)) {
                $q->orWhereHas('keluargaPenerima', fn($kp) => $kp->whereIn('wilayah_id', $desaIds));
            }
        })->count();

        $persenMandiri = $totalBinaan > 0 ? round(($totalMandiri / $totalBinaan) * 100, 1) : 0;
        $persenTahap = $totalBinaan > 0 ? round(($totalTahap / $totalBinaan) * 100, 1) : 0;
        $persenPenurunan = $totalBinaan > 0 ? round(($totalPenurunan / $totalBinaan) * 100, 1) : 0;

        $rataRataPenghasilan = (clone $baseKeluarga)->where('penghasilan_perbulan', '>', 0)->avg('penghasilan_perbulan') ?? 0;

        // 2. Data Grafik (Ter-scope)
        $distribusiDesil = [];
        for ($d = 1; $d <= 10; $d++) {
            $distribusiDesil[$d] = (clone $baseKeluarga)->where('desil', $d)->count();
        }

        // B. Tren Kunjungan Evaluasi
        $trenKunjungan = PenilaianKemandirian::select(
                'periode',
                DB::raw('COUNT(*) as total_asesmen'),
                DB::raw('AVG(total_skor) as avg_skor'),
                DB::raw('AVG(penghasilan_perbulan) as avg_penghasilan')
            )
            ->where(function($q) use ($user, $desaIds) {
                $q->where('pendamping_id', $user->id);
                if (!empty($desaIds)) {
                    $q->orWhereHas('keluargaPenerima', fn($kp) => $kp->whereIn('wilayah_id', $desaIds));
                }
            })
            ->groupBy('periode')
            ->orderByRaw('MIN(created_at) ASC')
            ->take(8)
            ->get();

        // 3. Tabel 1: Rekapitulasi Status Kemandirian Keluarga Binaan Ter-scope
        $keluargaQuery = (clone $baseKeluarga)->with([
            'wilayah.parent',
            'programBantuan',
            'penilaianKemandirians' => function($q) {
                $q->latest();
            }
        ]);

        if ($request->filled('search')) {
            $term = trim($search);
            $keluargaQuery->where(function($q) use ($term) {
                $q->where('kepala_keluarga', 'like', "%{$term}%")
                    ->orWhere('nik', 'like', "%{$term}%")
                    ->orWhere('no_kk', 'like', "%{$term}%")
                    ->orWhereHas('wilayah', function($w) use ($term) {
                        $w->where('nama', 'like', "%{$term}%");
                    });
            });
        }

        if ($request->filled('wilayah_id')) {
            $keluargaQuery->where('wilayah_id', $wilayahId);
        }

        if ($request->filled('status')) {
            if ($statusFilter === 'mandiri') {
                $keluargaQuery->where('desil', '>=', 6);
            } elseif ($statusFilter === 'tahap_kemandirian') {
                $keluargaQuery->where('desil', '<', 6)->where('status_kemandirian', '!=', 'Penurunan Desil');
            } elseif ($statusFilter === 'penurunan') {
                $keluargaQuery->where('status_kemandirian', 'Penurunan Desil');
            }
        }

        $keluargaList = $keluargaQuery->latest('id')->get();

        // 4. Tabel 2: Riwayat Penilaian Desil Ter-scope
        $historiKunjungan = PenilaianKemandirian::with(['keluargaPenerima.wilayah', 'pendamping'])
            ->where(function($q) use ($user, $desaIds) {
                $q->where('pendamping_id', $user->id);
                if (!empty($desaIds)) {
                    $q->orWhereHas('keluargaPenerima', fn($kp) => $kp->whereIn('wilayah_id', $desaIds));
                }
            })
            ->latest()
            ->take(30)
            ->get();

        // Daftar Wilayah untuk filter (terbatas pada desa binaan)
        $wilayahsQuery = Wilayah::with('parent')->where('jenis', 'desa');
        if (!empty($desaIds)) {
            $wilayahsQuery->whereIn('id', $desaIds);
        }
        $wilayahs = $wilayahsQuery->orderBy('nama')->get();

        return view('dashboard.pendamping.kemandirian.index', compact(
            'totalBinaan',
            'totalMandiri',
            'totalTahap',
            'totalPenurunan',
            'totalKunjungan',
            'persenMandiri',
            'persenTahap',
            'persenPenurunan',
            'rataRataPenghasilan',
            'distribusiDesil',
            'trenKunjungan',
            'keluargaList',
            'historiKunjungan',
            'wilayahs',
            'search',
            'statusFilter',
            'wilayahId'
        ));
    }
}
