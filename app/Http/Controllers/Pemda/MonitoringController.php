<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeluargaPenerima;
use App\Models\LaporanPenerima;
use App\Models\Wilayah;

class MonitoringController extends Controller
{
    public function index(Request $request)
    {
        $kecamatans = Wilayah::where('jenis', 'kecamatan')->orderBy('nama')->get();
        $selectedKecamatan = $request->query('kecamatan_id');

        $laporanQuery = LaporanPenerima::with(['keluargaPenerima.wilayah']);
        $penerimaQuery = KeluargaPenerima::with('wilayah.parent');

        if ($selectedKecamatan) {
            $laporanQuery->whereHas('keluargaPenerima.wilayah', function($q) use ($selectedKecamatan) {
                $q->where('parent_id', $selectedKecamatan)->orWhere('id', $selectedKecamatan);
            });
            $penerimaQuery->whereHas('wilayah', function($q) use ($selectedKecamatan) {
                $q->where('parent_id', $selectedKecamatan)->orWhere('id', $selectedKecamatan);
            });
        }

        $laporans = $laporanQuery->latest()->get();
        
        $sebaranDesa = $penerimaQuery->get()
            ->groupBy('wilayah_id')
            ->map(function ($items) {
                $desa = $items->first()->wilayah;
                return [
                    'desa' => $desa ? $desa->nama : 'Tidak Diketahui',
                    'kecamatan' => $desa && $desa->parent ? $desa->parent->nama : '-',
                    'total_penerima' => $items->count(),
                    'desil' => [
                        '1' => $items->where('desil', 1)->count(),
                        '2' => $items->where('desil', 2)->count(),
                        '3' => $items->where('desil', 3)->count(),
                        '4' => $items->where('desil', 4)->count(),
                        '5' => $items->where('desil', 5)->count(),
                        '>5' => $items->where('desil', '>', 5)->count(),
                    ]
                ];
            })
            ->values()
            ->sortByDesc('total_penerima');

        return view('dashboard.pemda.monitoring.index', compact('laporans', 'sebaranDesa', 'kecamatans', 'selectedKecamatan'));
    }

    public function show(string $id)
    {
        $laporan = LaporanPenerima::with(['keluargaPenerima.wilayah'])->findOrFail($id);
        return view('dashboard.pemda.monitoring.show', compact('laporan'));
    }

    public function getKecamatanDetail($id)
    {
        $kecamatan = Wilayah::where('jenis', 'kecamatan')->findOrFail($id);
        
        $penerimas = KeluargaPenerima::with('wilayah')
            ->whereHas('wilayah', function($q) use ($id) {
                $q->where('parent_id', $id)->orWhere('id', $id);
            })
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'no_kk' => $item->no_kk,
                    'nik' => $item->nik_kepala_keluarga,
                    'nama' => $item->kepala_keluarga,
                    'desa' => $item->wilayah ? $item->wilayah->nama : '-',
                    'desil' => $item->desil,
                    'status_kemandirian' => $item->status_kemandirian ?? '-',
                    'alamat' => $item->alamat_detail,
                ];
            });

        return response()->json([
            'kecamatan' => $kecamatan->nama,
            'total_kk' => $penerimas->count(),
            'penerimas' => $penerimas
        ]);
    }

}
