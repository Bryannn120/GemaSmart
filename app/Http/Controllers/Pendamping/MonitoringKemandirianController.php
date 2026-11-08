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
     * Tampilkan halaman monitoring kemandirian berdasarkan indikator penilaian, pendapatan, dan pengeluaran.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $statusFilter = $request->query('status'); // all, mandiri, tahap_kemandirian, defisit
        $wilayahId = $request->query('wilayah_id');

        $user = auth()->user();

        // 1. Data Statistik Utama & Agregasi (Ter-scope hanya keluarga binaan yang didampingi pendamping yang login)
        $baseKeluarga = KeluargaPenerima::where('pendamping_id', $user->id);

        $totalBinaan = (clone $baseKeluarga)->count();
        $totalMandiri = (clone $baseKeluarga)->where(function($q) {
            $q->where('status_kemandirian', 'Mandiri')
              ->orWhere('desil', '>=', 6);
        })->count();

        $totalTahap = (clone $baseKeluarga)->where(function($q) {
            $q->where('status_kemandirian', 'Tahap Kemandirian')
              ->orWhere(function($sub) {
                  $sub->where('desil', '<', 6)
                      ->where('status_kemandirian', '!=', 'Penurunan Desil');
              });
        })->count();

        $totalDefisit = (clone $baseKeluarga)->where(function($q) {
            $q->where('status_kemandirian', 'like', '%Penurunan%')
              ->orWhere('penghasilan_bersih', '<', 0);
        })->count();

        $totalKunjungan = PenilaianKemandirian::where('pendamping_id', $user->id)->count();

        $persenMandiri = $totalBinaan > 0 ? round(($totalMandiri / $totalBinaan) * 100, 1) : 0;
        $persenTahap = $totalBinaan > 0 ? round(($totalTahap / $totalBinaan) * 100, 1) : 0;
        $persenDefisit = $totalBinaan > 0 ? round(($totalDefisit / $totalBinaan) * 100, 1) : 0;

        // Rata-rata Pendapatan, Pengeluaran, dan Surplus per Bulan
        $rataRataPendapatan = (clone $baseKeluarga)->where(function($q) {
            $q->where('pendapatan_perbulan', '>', 0)->orWhere('penghasilan_perbulan', '>', 0);
        })->selectRaw('AVG(CASE WHEN pendapatan_perbulan > 0 THEN pendapatan_perbulan ELSE penghasilan_perbulan END) as avg_inc')->value('avg_inc') ?? 0;

        $rataRataPengeluaran = (clone $baseKeluarga)->where('pengeluaran_perbulan', '>', 0)->avg('pengeluaran_perbulan') ?? 0;
        $rataRataSurplus = $rataRataPendapatan - $rataRataPengeluaran;

        // 2. Data Grafik: Distribusi Berdasarkan Indikator Penilaian Kemandirian
        // Mengelompokkan keluarga berdasarkan skor indikator penilaian (0-100)
        $allBinaan = (clone $baseKeluarga)->with(['penilaianKemandirians' => function($q) {
            $q->latest();
        }])->get();

        $distribusiIndikator = [
            'perlu_intervensi' => 0, // Skor 0 - 40 / Defisit
            'tahap_awal'       => 0, // Skor 41 - 55
            'berkembang'       => 0, // Skor 56 - 70
            'mandiri_madya'    => 0, // Skor 71 - 85
            'mandiri_utama'    => 0, // Skor 86 - 100
        ];

        foreach ($allBinaan as $b) {
            $latest = $b->penilaianKemandirians->first();
            $skor = $latest ? (int)$latest->total_skor : (int)($b->desil ? $b->desil * 10 : 30);
            
            if ($skor <= 40 || ($b->penghasilan_bersih < 0)) {
                $distribusiIndikator['perlu_intervensi']++;
            } elseif ($skor <= 55) {
                $distribusiIndikator['tahap_awal']++;
            } elseif ($skor <= 70) {
                $distribusiIndikator['berkembang']++;
            } elseif ($skor <= 85) {
                $distribusiIndikator['mandiri_madya']++;
            } else {
                $distribusiIndikator['mandiri_utama']++;
            }
        }

        // B. Tren Evaluasi Indikator Penilaian
        $trenKunjungan = PenilaianKemandirian::select(
                'periode',
                DB::raw('COUNT(*) as total_asesmen'),
                DB::raw('AVG(total_skor) as avg_skor'),
                DB::raw('AVG(COALESCE(NULLIF(pendapatan_perbulan, 0), penghasilan_perbulan, 0)) as avg_pendapatan'),
                DB::raw('AVG(COALESCE(pengeluaran_perbulan, 0)) as avg_pengeluaran'),
                DB::raw('AVG(COALESCE(penghasilan_bersih, 0)) as avg_surplus')
            )
            ->where('pendamping_id', $user->id)
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
                $keluargaQuery->where(function($q) {
                    $q->where('status_kemandirian', 'Mandiri')
                      ->orWhere('desil', '>=', 6);
                });
            } elseif ($statusFilter === 'tahap_kemandirian') {
                $keluargaQuery->where(function($q) {
                    $q->where('status_kemandirian', 'Tahap Kemandirian')
                      ->orWhere(function($sub) {
                          $sub->where('desil', '<', 6)
                              ->where('status_kemandirian', '!=', 'Penurunan Desil');
                      });
                });
            } elseif ($statusFilter === 'defisit' || $statusFilter === 'penurunan') {
                $keluargaQuery->where(function($q) {
                    $q->where('status_kemandirian', 'like', '%Penurunan%')
                      ->orWhere('penghasilan_bersih', '<', 0);
                });
            }
        }

        $keluargaList = $keluargaQuery->latest('id')->get();

        // 4. Tabel 2: Riwayat Indikator Penilaian Kunjungan Lapangan Ter-scope
        $historiKunjungan = PenilaianKemandirian::with(['keluargaPenerima.wilayah', 'pendamping'])
            ->where('pendamping_id', $user->id)
            ->latest()
            ->take(30)
            ->get();

        // Daftar Wilayah untuk filter (desa dari keluarga binaan pendamping)
        $desaIdsBinaan = (clone $baseKeluarga)->pluck('wilayah_id')->filter()->unique();
        $wilayahs = Wilayah::with('parent')
            ->where('jenis', 'desa')
            ->whereIn('id', $desaIdsBinaan)
            ->orderBy('nama')
            ->get();

        return view('dashboard.pendamping.kemandirian.index', compact(
            'totalBinaan',
            'totalMandiri',
            'totalTahap',
            'totalDefisit',
            'totalKunjungan',
            'persenMandiri',
            'persenTahap',
            'persenDefisit',
            'rataRataPendapatan',
            'rataRataPengeluaran',
            'rataRataSurplus',
            'distribusiIndikator',
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
