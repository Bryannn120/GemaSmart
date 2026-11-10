<?php

namespace App\Http\Controllers\Pendamping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\KeluargaPenerima;
use App\Models\Wilayah;
use App\Models\ProgramBantuan;
use App\Models\User;
use App\Models\AuditLog;
use App\Services\DataPenerimaExportImportService;

class KeluargaPenerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $desaIds = $user->getAssignedDesaIds();
        $search = $request->query('search');
        $tab = $request->query('tab', 'aktif'); // 'aktif' atau 'mandiri'

        $baseQuery = KeluargaPenerima::with(['wilayah.parent', 'programBantuan']);

        // Scope hanya keluarga di wilayah binaan pendamping ini
        if (!empty($desaIds)) {
            $baseQuery->where(function($q) use ($user, $desaIds) {
                $q->where('pendamping_id', $user->id)
                  ->orWhereIn('wilayah_id', $desaIds);
            });
        } else {
            $baseQuery->where('pendamping_id', $user->id);
        }

        if ($request->filled('search')) {
            $searchTerm = trim($search);
            $baseQuery->where(function($q) use ($searchTerm) {
                $q->where('kepala_keluarga', 'like', "%{$searchTerm}%")
                    ->orWhere('nik', 'like', "%{$searchTerm}%")
                    ->orWhere('no_kk', 'like', "%{$searchTerm}%")
                    ->orWhere('alamat', 'like', "%{$searchTerm}%")
                    ->orWhereHas('wilayah', function ($w) use ($searchTerm) {
                        $w->where('nama', 'like', "%{$searchTerm}%")
                            ->orWhereHas('parent', function ($p) use ($searchTerm) {
                                $p->where('nama', 'like', "%{$searchTerm}%");
                            });
                    });
            });
        }

        $countAktif = (clone $baseQuery)->penerimaAktif()->count();
        $countMandiri = (clone $baseQuery)->mandiri()->count();

        $query = clone $baseQuery;
        if ($tab === 'mandiri') {
            $query->mandiri();
        } else {
            // Otomatis hilangkan penerima yang sudah mandiri
            $query->penerimaAktif();
        }

        $keluarga_penerimas = $query->latest('id')->get();
        return view('dashboard.pendamping.keluarga_penerima.index', compact(
            'keluarga_penerimas',
            'search',
            'tab',
            'countAktif',
            'countMandiri'
        ));
    }

    /**
     * Ekspor Data Keluarga Penerima Binaan ke Excel (.xlsx), CSV (.csv), atau PDF (.pdf).
     */
    public function export(Request $request, DataPenerimaExportImportService $service)
    {
        $user = Auth::user();
        $format = $request->query('format', 'xlsx');
        $tab = $request->query('tab', 'aktif');
        $search = $request->query('search');

        $context = [
            'role' => 'pendamping',
            'pendamping_id' => $user->id,
            'pendamping_name' => $user->name,
            'kampus_id' => $user->kampus_id,
            'assigned_desa_ids' => $user->getAssignedDesaIds(),
        ];

        return $service->export($format, $tab, null, null, $search, $context);
    }

    /**
     * Download Template Impor Penerima Bantuan untuk Pendamping.
     */
    public function downloadTemplate(Request $request, DataPenerimaExportImportService $service)
    {
        $user = Auth::user();
        $format = $request->query('format', 'xlsx');

        $context = [
            'role' => 'pendamping',
            'pendamping_id' => $user->id,
            'pendamping_name' => $user->name,
            'kampus_id' => $user->kampus_id,
            'assigned_desa_ids' => $user->getAssignedDesaIds(),
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

        $user = Auth::user();
        $context = [
            'role' => 'pendamping',
            'pendamping_id' => $user->id,
            'pendamping_name' => $user->name,
            'kampus_id' => $user->kampus_id,
            'assigned_desa_ids' => $user->getAssignedDesaIds(),
        ];

        $result = $service->import($request->file('file'), $request->duplicate_mode, $context);

        if ($result['success']) {
            return redirect()->route('pendamping.keluarga_penerima.index')
                ->with('success', $result['message'])
                ->with('import_errors', $result['stats']['errors'] ?? []);
        }

        return redirect()->route('pendamping.keluarga_penerima.index')
            ->with('error', $result['message'])
            ->with('import_errors', $result['stats']['errors'] ?? []);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $desaIds = $user->getAssignedDesaIds();

        $wilayahsQuery = Wilayah::with('parent')->where('is_aktif', true)->where('jenis', 'desa');
        if (!empty($desaIds)) {
            $wilayahsQuery->whereIn('id', $desaIds);
        }
        $wilayahs = $wilayahsQuery->orderBy('nama')->get();
        $programs = ProgramBantuan::where('status', 'aktif')->orderBy('nama_program')->get();

        return view('dashboard.pendamping.keluarga_penerima.create', compact('wilayahs', 'programs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Sanitasi NIK dan No KK (hanya angka)
        $cleanNik = preg_replace('/\D/', '', (string)$request->input('nik'));
        $cleanNoKk = preg_replace('/\D/', '', (string)$request->input('no_kk'));
        $request->merge([
            'nik' => $cleanNik,
            'no_kk' => $cleanNoKk,
        ]);

        // Cek duplikasi NIK dan KK secara ketat (termasuk trashed)
        $existingNik = KeluargaPenerima::withTrashed()->with('wilayah')->where('nik', $cleanNik)->first();
        if ($existingNik) {
            $desa = $existingNik->wilayah ? $existingNik->wilayah->nama : 'Sumbawa';
            return back()->withInput()->withErrors([
                'nik' => "NIK {$cleanNik} sudah terdaftar atas nama {$existingNik->kepala_keluarga} (Desa {$desa}). Data penerima tidak boleh ganda!"
            ]);
        }

        $existingKk = KeluargaPenerima::withTrashed()->with('wilayah')->where('no_kk', $cleanNoKk)->first();
        if ($existingKk) {
            $desa = $existingKk->wilayah ? $existingKk->wilayah->nama : 'Sumbawa';
            return back()->withInput()->withErrors([
                'no_kk' => "Nomor KK {$cleanNoKk} sudah terdaftar atas nama {$existingKk->kepala_keluarga} (Desa {$desa}). Setiap KK hanya boleh terdaftar satu kali!"
            ]);
        }

        $validated = $request->validate([
            'no_kk' => 'required|string|size:16|unique:keluarga_penerimas,no_kk',
            'kepala_keluarga' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:keluarga_penerimas,nik',
            'alamat' => 'nullable|string|max:255',
            'desil' => 'required|integer|min:1|max:10',
            'penghasilan_perbulan' => 'nullable|numeric|min:0',
            'wilayah_id' => 'required|exists:wilayahs,id',
            'program_bantuan_id' => 'required|exists:program_bantuans,id',
            'status_validasi' => 'nullable|in:menunggu_validasi,proses_lapangan,valid,anomali',
        ], [
            'no_kk.required' => 'Nomor Kartu Keluarga (KK) wajib diisi.',
            'no_kk.size' => 'Nomor KK harus 16 digit angka.',
            'no_kk.unique' => 'Nomor KK ini sudah terdaftar dalam sistem.',
            'kepala_keluarga.required' => 'Nama kepala keluarga wajib diisi.',
            'nik.required' => 'NIK kepala keluarga wajib diisi.',
            'nik.size' => 'NIK harus 16 digit angka.',
            'nik.unique' => 'NIK ini sudah terdaftar dalam sistem.',
            'desil.required' => 'Indikator kemandirian awal wajib ditentukan.',
            'wilayah_id.required' => 'Wilayah desa/kelurahan wajib dipilih.',
            'program_bantuan_id.required' => 'Program bantuan bibit wajib dipilih.',
        ]);

        // Buat atau hubungkan akun user penerima otomatis
        $user = User::firstOrCreate(
            ['email' => $validated['nik'] . '@penerima.com'],
            [
                'name' => $validated['kepala_keluarga'],
                'password' => Hash::make($validated['no_kk']),
                'role' => 'penerima',
            ]
        );

        $validated['user_id'] = $user->id;
        $validated['pendamping_id'] = Auth::id();
        $validated['kampus_id'] = Auth::user()->kampus_id ?? null;
        $validated['penghasilan_perbulan'] = $validated['penghasilan_perbulan'] ?? 0;
        $validated['status_validasi'] = $validated['status_validasi'] ?? 'valid';
        
        // Status kemandirian: Indikator Kemandirian tingkat 6 ke atas = Mandiri, 1-5 = Tahap Kemandirian
        $validated['status_kemandirian'] = ($validated['desil'] >= 6) ? 'Mandiri' : 'Tahap Kemandirian';

        $penerima = KeluargaPenerima::create($validated);

        // Catat Audit Trail
        AuditLog::record(
            'Pendamping Menambahkan Data Keluarga Penerima Bantuan',
            'KeluargaPenerima',
            $penerima->id,
            null,
            $validated
        );

        return redirect()->route('pendamping.keluarga_penerima.index')
            ->with('success', "Keluarga penerima {$penerima->kepala_keluarga} berhasil ditambahkan tanpa duplikasi.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $keluarga_penerima = KeluargaPenerima::with([
            'wilayah', 
            'programBantuan', 
            'kampusMitra', 
            'penilaianKemandirians' => function($q) {
                $q->with('pendamping')->latest();
            },
            'penyaluranBantuans' => function($q) {
                $q->with(['programBantuan', 'itemBantuan', 'pendamping'])->latest('tgl_penyaluran')->latest('id');
            }
        ])->findOrFail($id);
        return view('dashboard.pendamping.keluarga_penerima.show', compact('keluarga_penerima'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $keluarga_penerima = KeluargaPenerima::findOrFail($id);
        $wilayahs = Wilayah::with('parent')->where('is_aktif', true)->orderBy('nama')->get();
        $programs = ProgramBantuan::where('status', 'aktif')->orderBy('nama_program')->get();

        return view('dashboard.pendamping.keluarga_penerima.edit', compact('keluarga_penerima', 'wilayahs', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $keluarga_penerima = KeluargaPenerima::findOrFail($id);

        // Sanitasi NIK dan No KK (hanya angka)
        $cleanNik = preg_replace('/\D/', '', (string)$request->input('nik'));
        $cleanNoKk = preg_replace('/\D/', '', (string)$request->input('no_kk'));
        $request->merge([
            'nik' => $cleanNik,
            'no_kk' => $cleanNoKk,
        ]);

        // Cek duplikasi NIK dan KK terhadap data penerima lain (termasuk trashed)
        $existingNik = KeluargaPenerima::withTrashed()
            ->with('wilayah')
            ->where('nik', $cleanNik)
            ->where('id', '!=', $id)
            ->first();

        if ($existingNik) {
            $desa = $existingNik->wilayah ? $existingNik->wilayah->nama : 'Sumbawa';
            return back()->withInput()->withErrors([
                'nik' => "NIK {$cleanNik} sudah terdaftar atas nama {$existingNik->kepala_keluarga} (Desa {$desa}). NIK tidak boleh ganda!"
            ]);
        }

        $existingKk = KeluargaPenerima::withTrashed()
            ->with('wilayah')
            ->where('no_kk', $cleanNoKk)
            ->where('id', '!=', $id)
            ->first();

        if ($existingKk) {
            $desa = $existingKk->wilayah ? $existingKk->wilayah->nama : 'Sumbawa';
            return back()->withInput()->withErrors([
                'no_kk' => "Nomor KK {$cleanNoKk} sudah terdaftar atas nama {$existingKk->kepala_keluarga} (Desa {$desa}). Nomor KK tidak boleh ganda!"
            ]);
        }

        $validated = $request->validate([
            'no_kk' => 'required|string|size:16|unique:keluarga_penerimas,no_kk,' . $id,
            'kepala_keluarga' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:keluarga_penerimas,nik,' . $id,
            'alamat' => 'nullable|string|max:255',
            'desil' => 'required|integer|min:1|max:10',
            'penghasilan_perbulan' => 'nullable|numeric|min:0',
            'wilayah_id' => 'required|exists:wilayahs,id',
            'program_bantuan_id' => 'required|exists:program_bantuans,id',
            'status_validasi' => 'nullable|in:menunggu_validasi,proses_lapangan,valid,anomali',
        ], [
            'no_kk.required' => 'Nomor Kartu Keluarga (KK) wajib diisi.',
            'no_kk.size' => 'Nomor KK harus 16 digit angka.',
            'no_kk.unique' => 'Nomor KK ini sudah digunakan keluarga lain.',
            'kepala_keluarga.required' => 'Nama kepala keluarga wajib diisi.',
            'nik.required' => 'NIK kepala keluarga wajib diisi.',
            'nik.size' => 'NIK harus 16 digit angka.',
            'nik.unique' => 'NIK ini sudah digunakan penerima lain.',
            'desil.required' => 'Indikator kemandirian wajib dipilih.',
            'wilayah_id.required' => 'Wilayah desa/kelurahan wajib dipilih.',
            'program_bantuan_id.required' => 'Program bantuan bibit wajib dipilih.',
        ]);

        $dataLama = $keluarga_penerima->toArray();

        // Update status kemandirian berdasarkan indikator baru jika belum ada penilaian penurunan
        if ($validated['desil'] >= 6) {
            $validated['status_kemandirian'] = 'Mandiri';
        } else {
            if ($keluarga_penerima->status_kemandirian !== 'Penurunan Desil' && $keluarga_penerima->status_kemandirian !== 'Butuh Perhatian Khusus') {
                $validated['status_kemandirian'] = 'Tahap Kemandirian';
            }
        }

        $keluarga_penerima->update($validated);

        // Update user account jika ada
        if ($keluarga_penerima->user) {
            $keluarga_penerima->user->update([
                'name' => $validated['kepala_keluarga'],
                'email' => $validated['nik'] . '@penerima.com',
            ]);
        }

        // Catat Audit Trail
        AuditLog::record(
            'Pendamping Memperbarui Data Keluarga Penerima Bantuan',
            'KeluargaPenerima',
            $keluarga_penerima->id,
            $dataLama,
            $keluarga_penerima->fresh()->toArray()
        );

        return redirect()->route('pendamping.keluarga_penerima.show', $keluarga_penerima->id)
            ->with('success', "Data keluarga {$keluarga_penerima->kepala_keluarga} berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $keluarga_penerima = KeluargaPenerima::findOrFail($id);
        $nama = $keluarga_penerima->kepala_keluarga;
        $dataLama = $keluarga_penerima->toArray();

        // Hapus akun user penerima jika ada
        if ($keluarga_penerima->user) {
            $keluarga_penerima->user->delete();
        }

        $keluarga_penerima->delete();

        // Catat Audit Trail
        AuditLog::create([
            'user_id' => Auth::id(),
            'aksi' => 'Hapus Data Keluarga Penerima Bantuan',
            'model' => 'KeluargaPenerima',
            'model_id' => (int) $id,
            'data_lama' => $dataLama,
            'data_baru' => null,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('pendamping.keluarga_penerima.index')
            ->with('success', "Data keluarga penerima {$nama} berhasil dihapus dari sistem.");
    }
}
