<?php

namespace App\Http\Controllers\Kampus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KeluargaPenerima;
use App\Models\KampusMitra;
use App\Services\DataPenerimaExportImportService;

class KeluargaPenerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'aktif'); // 'aktif' atau 'mandiri'
        $search = $request->query('search');
        $kampus = KampusMitra::where('user_id', Auth::id())->first() ?? KampusMitra::first();
        
        $baseQuery = KeluargaPenerima::with([
            'wilayah',
            'programBantuan',
            'pendamping',
            'penilaianKemandirians' => function ($q) {
                $q->latest('id');
            },
        ]);
        if ($kampus) {
            $baseQuery->where(function($q) use ($kampus) {
                $q->where('kampus_id', $kampus->id)
                  ->orWhereHas('wilayah', function($w) use ($kampus) {
                      $w->where('nama', $kampus->wilayah_binaan);
                  });
            });
        }

        if ($request->filled('search')) {
            $term = trim($search);
            $baseQuery->where(function ($q) use ($term) {
                $q->where('kepala_keluarga', 'like', "%{$term}%")
                  ->orWhere('nik', 'like', "%{$term}%")
                  ->orWhere('no_kk', 'like', "%{$term}%")
                  ->orWhere('alamat', 'like', "%{$term}%");
            });
        }

        // Hitung statistik
        $countAktif = (clone $baseQuery)->penerimaAktif()->count();
        $countMandiri = (clone $baseQuery)->mandiri()->count();

        $query = clone $baseQuery;
        if ($tab === 'mandiri') {
            $query->mandiri();
        } else {
            $query->penerimaAktif();
        }
        
        $keluarga_penerimas = $query->latest('id')->paginate(20)->withQueryString();

        return view('dashboard.kampus.keluarga_penerima.index', compact(
            'keluarga_penerimas',
            'tab',
            'search',
            'countAktif',
            'countMandiri',
            'kampus'
        ));
    }

    /**
     * Ekspor Data Penerima Binaan Kampus ke Excel (.xlsx), CSV (.csv), atau PDF (.pdf).
     */
    public function export(Request $request, DataPenerimaExportImportService $service)
    {
        $format = $request->query('format', 'xlsx');
        $tab = $request->query('tab', 'aktif');
        $search = $request->query('search');

        $kampus = KampusMitra::where('user_id', Auth::id())->first() ?? KampusMitra::first();

        $context = [
            'role' => 'kampus',
            'kampus_id' => $kampus ? $kampus->id : null,
            'kampus_name' => $kampus ? $kampus->nama_universitas : 'Mitra',
            'wilayah_binaan' => $kampus ? $kampus->wilayah_binaan : null,
        ];

        return $service->export($format, $tab, null, null, $search, $context);
    }

    /**
     * Download Template Impor Penerima Binaan Kampus.
     */
    public function downloadTemplate(Request $request, DataPenerimaExportImportService $service)
    {
        $format = $request->query('format', 'xlsx');
        $kampus = KampusMitra::where('user_id', Auth::id())->first() ?? KampusMitra::first();

        $context = [
            'role' => 'kampus',
            'kampus_id' => $kampus ? $kampus->id : null,
            'kampus_name' => $kampus ? $kampus->nama_universitas : 'Mitra',
        ];

        return $service->downloadTemplate($format, $context);
    }

    /**
     * Impor Data Penerima Bantuan dari Excel/CSV dengan Proteksi Anti-Duplikasi.
     */
    public function import(Request $request, DataPenerimaExportImportService $service)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
            'duplicate_mode' => 'required|in:update,skip',
        ], [
            'file.required' => 'Pilih file Excel (.xlsx) atau CSV (.csv) untuk diunggah.',
            'file.max' => 'Ukuran file maksimal adalah 10 MB.',
            'duplicate_mode.required' => 'Pilih mode penanganan jika data NIK sudah terdaftar.',
        ]);

        $kampus = KampusMitra::where('user_id', Auth::id())->first() ?? KampusMitra::first();

        $context = [
            'role' => 'kampus',
            'kampus_id' => $kampus ? $kampus->id : null,
            'kampus_name' => $kampus ? $kampus->nama_universitas : 'Mitra',
        ];

        $result = $service->import($request->file('file'), $request->duplicate_mode, $context);

        if ($result['success']) {
            return redirect()->route('kampus.keluarga_penerima.index')
                ->with('success', $result['message'])
                ->with('import_errors', $result['stats']['errors'] ?? []);
        }

        return redirect()->route('kampus.keluarga_penerima.index')
            ->with('error', $result['message'])
            ->with('import_errors', $result['stats']['errors'] ?? []);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $keluarga_penerima = KeluargaPenerima::with(['wilayah', 'programBantuan', 'pendamping', 'penyaluranBantuans.itemBantuan'])->findOrFail($id);
        return view('dashboard.kampus.keluarga_penerima.show', compact('keluarga_penerima'));
    }
}
