<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeluargaPenerima;
use App\Models\Wilayah;
use App\Models\ProgramBantuan;
use App\Models\User;
use App\Models\AuditLog;
use App\Services\DataPenerimaExportImportService;
use Illuminate\Support\Facades\Hash;

class DataPenerimaController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'aktif'); // 'aktif', 'mandiri', 'semua'
        $search = $request->query('search');
        $wilayahId = $request->query('wilayah_id');
        $programId = $request->query('program_bantuan_id');
        $pendampingFilter = $request->query('pendamping_filter');

        $query = KeluargaPenerima::with(['wilayah.parent', 'programBantuan', 'user', 'pendamping.kampus']);

        if ($tab === 'mandiri') {
            // Warga yang telah mandiri atau mencapai desil 6 ke atas (Lulus Bantuan)
            $query->mandiri();
        } elseif ($tab === 'aktif') {
            // Default: Penerima Bantuan Aktif (Otomatis menghilangkan yang sudah mandiri atau desil 6+)
            $query->penerimaAktif();
        }

        if ($request->filled('search')) {
            $term = trim($search);
            $query->where(function ($q) use ($term) {
                $q->where('kepala_keluarga', 'like', "%{$term}%")
                  ->orWhere('nik', 'like', "%{$term}%")
                  ->orWhere('no_kk', 'like', "%{$term}%")
                  ->orWhere('alamat', 'like', "%{$term}%")
                  ->orWhereHas('pendamping', function($pq) use ($term) {
                      $pq->where('name', 'like', "%{$term}%");
                  });
            });
        }

        if ($request->filled('wilayah_id')) {
            $query->where('wilayah_id', $wilayahId);
        }

        if ($request->filled('program_bantuan_id')) {
            $query->where('program_bantuan_id', $programId);
        }

        if ($request->filled('pendamping_filter')) {
            if ($pendampingFilter === 'sudah') {
                $query->whereNotNull('pendamping_id');
            } elseif ($pendampingFilter === 'belum') {
                $query->whereNull('pendamping_id');
            } elseif (is_numeric($pendampingFilter)) {
                $query->where('pendamping_id', $pendampingFilter);
            }
        }

        $keluarga_penerimas = $query->latest('id')->paginate(20)->withQueryString();

        $countAktif = KeluargaPenerima::penerimaAktif()->count();
        $countMandiri = KeluargaPenerima::mandiri()->count();
        $totalSemua = KeluargaPenerima::count();
        $countWithPendamping = KeluargaPenerima::whereNotNull('pendamping_id')->count();

        $wilayahs = Wilayah::where('jenis', 'desa')->where('is_aktif', true)->orderBy('nama')->get();
        $programs = ProgramBantuan::where('status', 'aktif')->orderBy('nama_program')->get();
        $pendampings = User::where('role', 'pendamping')->with('kampus')->orderBy('name')->get();

        return view('dashboard.pemda.data-penerima.index', compact(
            'keluarga_penerimas',
            'tab',
            'countAktif',
            'countMandiri',
            'totalSemua',
            'countWithPendamping',
            'wilayahs',
            'programs',
            'pendampings',
            'search',
            'wilayahId',
            'programId',
            'pendampingFilter'
        ));
    }

    /**
     * Ekspor Data Penerima Bantuan ke Excel (.xlsx) atau CSV (.csv).
     */
    public function export(Request $request, DataPenerimaExportImportService $service)
    {
        $format = $request->query('format', 'xlsx');
        $tab = $request->query('tab', 'aktif');
        $wilayahId = $request->query('wilayah_id');
        $programId = $request->query('program_bantuan_id');
        $search = $request->query('search');

        return $service->export($format, $tab, $wilayahId, $programId, $search);
    }

    /**
     * Download Template Impor Penerima Bantuan (.xlsx / .csv).
     */
    public function downloadTemplate(Request $request, DataPenerimaExportImportService $service)
    {
        $format = $request->query('format', 'xlsx');
        return $service->downloadTemplate($format);
    }

    /**
     * Impor Data Penerima Bantuan dari file Excel atau CSV.
     */
    public function import(Request $request, DataPenerimaExportImportService $service)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
            'duplicate_mode' => 'required|in:update,skip',
        ], [
            'file.required' => 'Silakan pilih file Excel (.xlsx) atau CSV (.csv) untuk diunggah.',
            'file.max' => 'Ukuran file maksimal adalah 10 MB.',
            'duplicate_mode.required' => 'Pilih mode penanganan jika data NIK sudah terdaftar.',
        ]);

        $result = $service->import($request->file('file'), $request->duplicate_mode);

        if ($result['success']) {
            return redirect()->route('pemda.data-penerima.index')
                ->with('success', $result['message'])
                ->with('import_errors', $result['stats']['errors'] ?? []);
        }

        return redirect()->route('pemda.data-penerima.index')
            ->with('error', $result['message'])
            ->with('import_errors', $result['stats']['errors'] ?? []);
    }

    public function create()
    {
        $wilayahs = Wilayah::with('parent')->where('is_aktif', true)->orderBy('nama')->get();
        $programs = ProgramBantuan::where('status', 'aktif')->get();
        $pendampings = User::where('role', 'pendamping')->with('kampus')->orderBy('name')->get();
        return view('dashboard.pemda.data-penerima.create', compact('wilayahs', 'programs', 'pendampings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_kk' => 'required|string|size:16|unique:keluarga_penerimas,no_kk',
            'kepala_keluarga' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:keluarga_penerimas,nik',
            'alamat' => 'nullable|string|max:255',
            'desil' => 'required|integer|min:1|max:10',
            'wilayah_id' => 'required|exists:wilayahs,id',
            'program_bantuan_id' => 'required|exists:program_bantuans,id',
            'pendamping_id' => 'nullable|exists:users,id',
            'status_validasi' => 'required|in:menunggu_validasi,proses_lapangan,valid,anomali',
        ]);

        // Create User account automatically
        $user = User::create([
            'name' => $validated['kepala_keluarga'],
            'email' => $validated['nik'] . '@penerima.com',
            'password' => Hash::make($validated['no_kk']),
            'role' => 'penerima',
        ]);

        $validated['user_id'] = $user->id;
        $validated['status_kemandirian'] = ($validated['desil'] >= 6) ? 'Mandiri' : 'Belum Dinilai';

        $penerima = KeluargaPenerima::create($validated);

        // Audit Trail
        AuditLog::record(
            'Pemda Menambahkan Data Penerima Bantuan',
            'KeluargaPenerima',
            $penerima->id,
            null,
            [
                'kepala_keluarga' => $penerima->kepala_keluarga,
                'no_kk' => $penerima->no_kk,
                'nik' => $penerima->nik,
                'desil' => $penerima->desil,
                'status_validasi' => $penerima->status_validasi,
            ]
        );

        return redirect()->route('pemda.data-penerima.index')->with('success', 'Data penerima berhasil ditambahkan & Akun berhasil dibuat.');
    }

    public function show(string $id)
    {
        $keluarga_penerima = KeluargaPenerima::with([
            'wilayah.parent', 
            'programBantuan', 
            'user', 
            'penilaianKemandirians', 
            'laporanPenerimas', 
            'pendamping.kampus'
        ])->findOrFail($id);
        return view('dashboard.pemda.data-penerima.show', compact('keluarga_penerima'));
    }

    public function edit(string $id)
    {
        $keluarga_penerima = KeluargaPenerima::with('pendamping')->findOrFail($id);
        $wilayahs = Wilayah::with('parent')->where('is_aktif', true)->orderBy('nama')->get();
        $programs = ProgramBantuan::where('status', 'aktif')->get();
        $pendampings = User::where('role', 'pendamping')->with('kampus')->orderBy('name')->get();
        return view('dashboard.pemda.data-penerima.edit', compact('keluarga_penerima', 'wilayahs', 'programs', 'pendampings'));
    }

    public function update(Request $request, string $id)
    {
        $keluarga_penerima = KeluargaPenerima::findOrFail($id);
        $dataLama = $keluarga_penerima->toArray();

        $validated = $request->validate([
            'no_kk' => 'required|string|size:16|unique:keluarga_penerimas,no_kk,' . $id,
            'kepala_keluarga' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:keluarga_penerimas,nik,' . $id,
            'alamat' => 'nullable|string|max:255',
            'desil' => 'required|integer|min:1|max:10',
            'wilayah_id' => 'required|exists:wilayahs,id',
            'program_bantuan_id' => 'required|exists:program_bantuans,id',
            'pendamping_id' => 'nullable|exists:users,id',
            'status_validasi' => 'required|in:menunggu_validasi,proses_lapangan,valid,anomali',
        ]);

        if ($validated['desil'] >= 6) {
            $validated['status_kemandirian'] = 'Mandiri';
        } elseif ($keluarga_penerima->status_kemandirian === 'Mandiri') {
            $validated['status_kemandirian'] = 'Tahap Kemandirian';
        }

        $keluarga_penerima->update($validated);
        
        if ($keluarga_penerima->user) {
            $keluarga_penerima->user->update([
                'name' => $validated['kepala_keluarga'],
                'email' => $validated['nik'] . '@penerima.com',
            ]);
        }

        // Audit Trail
        AuditLog::record(
            'Pemda Memperbarui Data Penerima Bantuan',
            'KeluargaPenerima',
            $keluarga_penerima->id,
            $dataLama,
            $keluarga_penerima->fresh()->toArray()
        );

        return redirect()->route('pemda.data-penerima.index')->with('success', 'Data penerima berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $keluarga_penerima = KeluargaPenerima::findOrFail($id);
        $dataLama = $keluarga_penerima->toArray();
        $nama = $keluarga_penerima->kepala_keluarga;

        if ($keluarga_penerima->user) {
            $keluarga_penerima->user->delete();
        }
        $keluarga_penerima->delete();

        // Audit Trail
        AuditLog::record(
            'Pemda Menghapus Data Penerima Bantuan',
            'KeluargaPenerima',
            (int) $id,
            $dataLama,
            null
        );

        return redirect()->route('pemda.data-penerima.index')->with('success', 'Data penerima berhasil dihapus.');
    }
}
