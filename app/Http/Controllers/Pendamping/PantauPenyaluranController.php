<?php

namespace App\Http\Controllers\Pendamping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeluargaPenerima;
use App\Models\PenyaluranBantuan;
use App\Models\ProgramBantuan;
use App\Models\Wilayah;
use App\Services\PeriodFilterHelper;

class PantauPenyaluranController extends Controller
{
    /**
     * Tampilkan daftar keluarga binaan yang bantuannya BELUM pernah dikunjungi / dipantau.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $desaId = $request->query('desa_id');
        $programFilter = $request->query('program_id');
        $tab = $request->query('tab', 'semua'); // 'semua', 'belum_pernah', 'bantuan_baru'

        $periodInfo = PeriodFilterHelper::parseRequest($request);
        $periode = $periodInfo['periode'] ?? 'semua';

        // Query Keluarga Penerima yang memiliki bantuan tersalurkan yang BELUM pernah dikunjungi/dipantau
        $query = KeluargaPenerima::with([
            'wilayah.parent',
            'penyaluranBantuans' => function($q) use ($programFilter, $periodInfo, $request) {
                $q->where('status', '!=', 'batal')
                  ->whereDoesntHave('laporanTumbuhKembangs');

                if ($request->filled('program_id')) {
                    $q->where('program_bantuan_id', $programFilter);
                }

                PeriodFilterHelper::applyDateFilter($q, $periodInfo, 'tgl_penyaluran');

                $q->with(['programBantuan.kampusMitra', 'itemBantuan', 'pendamping'])
                  ->orderBy('tgl_penyaluran', 'desc')
                  ->orderBy('id', 'desc');
            },
            'laporanTumbuhKembangs' => function($q) {
                $q->latest('tanggal_lapor');
            }
        ])->whereHas('penyaluranBantuans', function($q) use ($programFilter, $periodInfo, $request) {
            $q->where('status', '!=', 'batal')
              ->whereDoesntHave('laporanTumbuhKembangs');

            if ($request->filled('program_id')) {
                $q->where('program_bantuan_id', $programFilter);
            }

            PeriodFilterHelper::applyDateFilter($q, $periodInfo, 'tgl_penyaluran');
        });

        // Filter Tab Kategori:
        // - 'belum_pernah': Keluarga yang belum pernah dilakukan kunjungan sama sekali (0 riwayat kunjungan)
        // - 'bantuan_baru': Keluarga yang sudah pernah dikunjungi di program lain/masa lalu, namun ada bantuan baru yang belum dipantau
        if ($tab === 'belum_pernah') {
            $query->whereDoesntHave('laporanTumbuhKembangs');
        } elseif ($tab === 'bantuan_baru') {
            $query->whereHas('laporanTumbuhKembangs');
        }

        // Filter Desa
        if ($request->filled('desa_id')) {
            $query->where('wilayah_id', $desaId);
        }

        $user = auth()->user();
        $desaIds = $user->getAssignedDesaIds();

        // Scope Territory ke wilayah binaan pendamping yang sedang login
        if (!empty($desaIds)) {
            $query->where(function($q) use ($user, $desaIds) {
                $q->where('pendamping_id', $user->id)
                  ->orWhereIn('wilayah_id', $desaIds);
            });
        } else {
            $query->where('pendamping_id', $user->id);
        }

        // Search
        if ($request->filled('search')) {
            $term = trim($search);
            $query->where(function($q) use ($term) {
                $q->where('kepala_keluarga', 'like', "%{$term}%")
                  ->orWhere('nik', 'like', "%{$term}%")
                  ->orWhere('no_kk', 'like', "%{$term}%")
                  ->orWhereHas('wilayah', function($w) use ($term) {
                      $w->where('nama', 'like', "%{$term}%");
                  })
                  ->orWhereHas('penyaluranBantuans.itemBantuan', function($ib) use ($term) {
                      $ib->where('nama_item', 'like', "%{$term}%");
                  });
            });
        }

        $penerimas = $query->paginate(15)->withQueryString();

        // Rekapitulasi Statistik untuk KPI Cards dan Tab Badges (Ter-scope ke wilayah pendamping)
        $baseQuery = KeluargaPenerima::whereHas('penyaluranBantuans', function($q) {
            $q->where('status', '!=', 'batal')
              ->whereDoesntHave('laporanTumbuhKembangs');
        });

        if (!empty($desaIds)) {
            $baseQuery->where(function($q) use ($user, $desaIds) {
                $q->where('pendamping_id', $user->id)
                  ->orWhereIn('wilayah_id', $desaIds);
            });
        } else {
            $baseQuery->where('pendamping_id', $user->id);
        }

        $totalKkBelumDipantau = (clone $baseQuery)->count();
        $totalKkBelumPernahDikunjungi = (clone $baseQuery)->whereDoesntHave('laporanTumbuhKembangs')->count();
        $totalKkBantuanBaru = (clone $baseQuery)->whereHas('laporanTumbuhKembangs')->count();

        $totalItemBelumDipantau = PenyaluranBantuan::where('status', '!=', 'batal')
            ->whereDoesntHave('laporanTumbuhKembangs')
            ->where(function($q) use ($user, $desaIds) {
                $q->where('pendamping_id', $user->id);
                if (!empty($desaIds)) {
                    $q->orWhereHas('keluargaPenerima', fn($kp) => $kp->whereIn('wilayah_id', $desaIds));
                }
            })
            ->count();

        // Filter desa terbatas pada desa binaan pendamping
        $desasQuery = Wilayah::with('parent')->where('jenis', 'desa');
        if (!empty($desaIds)) {
            $desasQuery->whereIn('id', $desaIds);
        }
        $desas = $desasQuery->orderBy('nama')->get();
        $programs = ProgramBantuan::where('status', 'aktif')->orderBy('nama_program')->get();

        return view('dashboard.pendamping.pantau_penyaluran.index', compact(
            'penerimas',
            'totalKkBelumDipantau',
            'totalKkBelumPernahDikunjungi',
            'totalKkBantuanBaru',
            'totalItemBelumDipantau',
            'desas',
            'programs',
            'search',
            'desaId',
            'programFilter',
            'tab',
            'periode',
            'periodInfo'
        ));
    }
}
