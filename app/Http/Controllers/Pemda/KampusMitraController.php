<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KampusMitra;
use App\Models\User;
use App\Models\Wilayah;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class KampusMitraController extends Controller
{
    public function index()
    {
        $kampusMitras = KampusMitra::with(['user', 'wilayahs'])->get();
        return view('dashboard.pemda.kampus-mitra.index', compact('kampusMitras'));
    }

    public function create()
    {
        $kecamatans = Wilayah::where('jenis', 'kecamatan')
            ->where('is_aktif', true)
            ->with(['children' => function($q) {
                $q->where('jenis', 'desa')->select('id', 'parent_id', 'nama')->orderBy('nama');
            }])
            ->orderBy('nama')
            ->get();

        // Ambil pemetaan wilayah yang sudah dibina oleh kampus mitra lain
        $takenWilayahs = DB::table('kampus_wilayahs')
            ->join('kampus_mitras', 'kampus_wilayahs.kampus_mitra_id', '=', 'kampus_mitras.id')
            ->whereNull('kampus_mitras.deleted_at')
            ->select('kampus_wilayahs.wilayah_id', 'kampus_mitras.id as kampus_id', 'kampus_mitras.nama_universitas')
            ->get()
            ->keyBy('wilayah_id');

        return view('dashboard.pemda.kampus-mitra.create', compact('kecamatans', 'takenWilayahs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_universitas' => 'required|string|max:255',
            'email_kampus' => 'required|email|unique:users,email',
            'pic_name' => 'required|string|max:255',
            'pic_contact' => 'nullable|string|max:255',
            'wilayah_ids' => 'required|array|min:1',
            'wilayah_ids.*' => 'exists:wilayahs,id',
            'mou_berlaku_sampai' => 'nullable|date',
            'status_mou' => 'required|in:aktif,tidak_aktif',
            'dana_bappeda' => 'nullable|numeric|min:0',
        ], [
            'nama_universitas.required' => 'Nama universitas / perguruan tinggi wajib diisi.',
            'email_kampus.required' => 'Email login kampus wajib diisi.',
            'email_kampus.unique' => 'Email ini sudah digunakan oleh akun lain.',
            'pic_name.required' => 'Nama PIC / Koordinator wajib diisi.',
            'wilayah_ids.required' => 'Wajib memilih minimal satu wilayah binaan kecamatan untuk kampus mitra ini.',
            'wilayah_ids.min' => 'Wajib memilih minimal satu wilayah binaan kecamatan untuk kampus mitra ini.',
        ]);

        // Cek konflik wilayah: pastikan wilayah yang dipilih belum pernah dibina oleh kampus mitra lain
        $alreadyTaken = DB::table('kampus_wilayahs')
            ->join('kampus_mitras', 'kampus_wilayahs.kampus_mitra_id', '=', 'kampus_mitras.id')
            ->join('wilayahs', 'kampus_wilayahs.wilayah_id', '=', 'wilayahs.id')
            ->whereNull('kampus_mitras.deleted_at')
            ->whereIn('kampus_wilayahs.wilayah_id', $validated['wilayah_ids'])
            ->select('wilayahs.nama as nama_wilayah', 'kampus_mitras.nama_universitas')
            ->get();

        if ($alreadyTaken->isNotEmpty()) {
            $conflictList = $alreadyTaken->map(fn($item) => "Kec. {$item->nama_wilayah} (sudah dibina oleh {$item->nama_universitas})")->implode(', ');
            throw ValidationException::withMessages([
                'wilayah_ids' => "Wilayah berikut tidak dapat dipilih karena sudah menjadi binaan kampus mitra lain: {$conflictList}."
            ]);
        }

        // Susun nama wilayah binaan untuk kompatibilitas data
        $selectedKecamatans = Wilayah::whereIn('id', $validated['wilayah_ids'])->orderBy('nama')->get();
        $validated['wilayah_binaan'] = $selectedKecamatans->map(fn($k) => 'Kec. ' . $k->nama)->implode(', ');

        // Create User account automatically for the new Kampus
        $user = User::create([
            'name' => $validated['nama_universitas'],
            'email' => $validated['email_kampus'],
            'password' => Hash::make('password123'), // Default password
            'role' => 'kampus',
        ]);

        $validated['user_id'] = $user->id;
        $validated['dana_bappeda'] = $validated['dana_bappeda'] ?? 0;

        $kampus = KampusMitra::create($validated);
        $kampus->wilayahs()->sync($validated['wilayah_ids']);

        // Audit Trail
        AuditLog::record(
            'Pemda Menambahkan Kampus Mitra Baru',
            'KampusMitra',
            $kampus->id,
            null,
            [
                'nama_universitas' => $kampus->nama_universitas,
                'email' => $validated['email_kampus'],
                'pic_name' => $kampus->pic_name,
                'dana_bappeda' => $kampus->dana_bappeda,
                'wilayah_binaan' => $validated['wilayah_binaan'],
            ]
        );

        return redirect()->route('pemda.kampus-mitra.index')->with('success', 'Kampus Mitra dan Akun User berhasil ditambahkan (Password default: password123).');
    }

    public function show(string $id)
    {
        $kampusMitra = KampusMitra::with(['user', 'programBantuans', 'wilayahs.children'])->findOrFail($id);
        return view('dashboard.pemda.kampus-mitra.show', compact('kampusMitra'));
    }

    public function edit(string $id)
    {
        $kampusMitra = KampusMitra::with('wilayahs')->findOrFail($id);
        $selectedWilayahIds = $kampusMitra->wilayahs->pluck('id')->toArray();

        // Fallback jika belum pernah tersimpan di pivot
        if (empty($selectedWilayahIds) && $kampusMitra->wilayah_binaan) {
            $selectedWilayahIds = Wilayah::where('jenis', 'kecamatan')
                ->where(function($q) use ($kampusMitra) {
                    $cleaned = str_replace(['Kec.', 'Kecamatan'], '', $kampusMitra->wilayah_binaan);
                    foreach (explode(',', $cleaned) as $part) {
                        $name = trim($part);
                        if ($name) $q->orWhere('nama', 'like', "%{$name}%");
                    }
                })->pluck('id')->toArray();
        }

        $kecamatans = Wilayah::where('jenis', 'kecamatan')
            ->where('is_aktif', true)
            ->with(['children' => function($q) {
                $q->where('jenis', 'desa')->select('id', 'parent_id', 'nama')->orderBy('nama');
            }])
            ->orderBy('nama')
            ->get();

        // Wilayah yang sudah dibina oleh kampus mitra LAIN (kecuali kampus ini)
        $takenWilayahs = DB::table('kampus_wilayahs')
            ->join('kampus_mitras', 'kampus_wilayahs.kampus_mitra_id', '=', 'kampus_mitras.id')
            ->whereNull('kampus_mitras.deleted_at')
            ->where('kampus_mitras.id', '!=', $kampusMitra->id)
            ->select('kampus_wilayahs.wilayah_id', 'kampus_mitras.id as kampus_id', 'kampus_mitras.nama_universitas')
            ->get()
            ->keyBy('wilayah_id');

        return view('dashboard.pemda.kampus-mitra.edit', compact('kampusMitra', 'kecamatans', 'takenWilayahs', 'selectedWilayahIds'));
    }

    public function update(Request $request, string $id)
    {
        $kampusMitra = KampusMitra::findOrFail($id);
        $dataLama = $kampusMitra->toArray();

        $validated = $request->validate([
            'nama_universitas' => 'required|string|max:255',
            'email_kampus' => 'required|email|unique:users,email,' . $kampusMitra->user_id,
            'pic_name' => 'required|string|max:255',
            'pic_contact' => 'nullable|string|max:255',
            'wilayah_ids' => 'required|array|min:1',
            'wilayah_ids.*' => 'exists:wilayahs,id',
            'mou_berlaku_sampai' => 'nullable|date',
            'status_mou' => 'required|in:aktif,tidak_aktif',
            'dana_bappeda' => 'nullable|numeric|min:0',
        ], [
            'nama_universitas.required' => 'Nama universitas / perguruan tinggi wajib diisi.',
            'email_kampus.required' => 'Email login kampus wajib diisi.',
            'email_kampus.unique' => 'Email ini sudah digunakan oleh akun lain.',
            'pic_name.required' => 'Nama PIC / Koordinator wajib diisi.',
            'wilayah_ids.required' => 'Wajib memilih minimal satu wilayah binaan kecamatan untuk kampus mitra ini.',
            'wilayah_ids.min' => 'Wajib memilih minimal satu wilayah binaan kecamatan untuk kampus mitra ini.',
        ]);

        // Cek konflik wilayah: pastikan wilayah yang dipilih belum pernah dibina oleh kampus mitra lain
        $alreadyTaken = DB::table('kampus_wilayahs')
            ->join('kampus_mitras', 'kampus_wilayahs.kampus_mitra_id', '=', 'kampus_mitras.id')
            ->join('wilayahs', 'kampus_wilayahs.wilayah_id', '=', 'wilayahs.id')
            ->whereNull('kampus_mitras.deleted_at')
            ->where('kampus_mitras.id', '!=', $kampusMitra->id)
            ->whereIn('kampus_wilayahs.wilayah_id', $validated['wilayah_ids'])
            ->select('wilayahs.nama as nama_wilayah', 'kampus_mitras.nama_universitas')
            ->get();

        if ($alreadyTaken->isNotEmpty()) {
            $conflictList = $alreadyTaken->map(fn($item) => "Kec. {$item->nama_wilayah} (sudah dibina oleh {$item->nama_universitas})")->implode(', ');
            throw ValidationException::withMessages([
                'wilayah_ids' => "Wilayah berikut tidak dapat dipilih karena sudah menjadi binaan kampus mitra lain: {$conflictList}."
            ]);
        }

        // Susun nama wilayah binaan
        $selectedKecamatans = Wilayah::whereIn('id', $validated['wilayah_ids'])->orderBy('nama')->get();
        $validated['wilayah_binaan'] = $selectedKecamatans->map(fn($k) => 'Kec. ' . $k->nama)->implode(', ');
        $validated['dana_bappeda'] = $validated['dana_bappeda'] ?? 0;

        $kampusMitra->update($validated);
        $kampusMitra->wilayahs()->sync($validated['wilayah_ids']);
        
        if ($kampusMitra->user) {
            $kampusMitra->user->update([
                'name' => $validated['nama_universitas'],
                'email' => $validated['email_kampus'],
            ]);
        }

        // Audit Trail
        AuditLog::record(
            'Pemda Memperbarui Data Kampus Mitra',
            'KampusMitra',
            $kampusMitra->id,
            $dataLama,
            $kampusMitra->fresh()->toArray()
        );

        return redirect()->route('pemda.kampus-mitra.index')->with('success', 'Kampus Mitra berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $kampusMitra = KampusMitra::findOrFail($id);
        $dataLama = $kampusMitra->toArray();

        if ($kampusMitra->user) {
            $kampusMitra->user->delete();
        }
        $kampusMitra->delete();

        // Audit Trail
        AuditLog::record(
            'Pemda Menghapus Kampus Mitra',
            'KampusMitra',
            (int) $id,
            $dataLama,
            null
        );

        return redirect()->route('pemda.kampus-mitra.index')->with('success', 'Kampus Mitra berhasil dihapus.');
    }

    /**
     * Tambah atau sesuaikan alokasi dana dari Bappeda ke Kampus Mitra.
     */
    public function tambahDana(Request $request, string $id)
    {
        $kampus = KampusMitra::findOrFail($id);

        $request->validate([
            'tipe' => 'required|in:tambah,set',
            'nominal' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string|max:255',
        ], [
            'nominal.required' => 'Nominal dana wajib diisi.',
            'nominal.numeric' => 'Nominal dana harus berupa angka.',
            'nominal.min' => 'Nominal dana minimal Rp 1.',
        ]);

        $nominal = (float) $request->nominal;
        $danaLama = (float) $kampus->dana_bappeda;

        if ($request->tipe === 'tambah') {
            $kampus->dana_bappeda = $danaLama + $nominal;
            $pesan = 'Berhasil menambahkan dana sebesar Rp ' . number_format($nominal, 0, ',', '.') . ' untuk ' . $kampus->nama_universitas . '. Total pagu kini menjadi Rp ' . number_format($kampus->dana_bappeda, 0, ',', '.') . '.';
        } else {
            $kampus->dana_bappeda = $nominal;
            $pesan = 'Pagu alokasi dana ' . $kampus->nama_universitas . ' berhasil diperbarui menjadi Rp ' . number_format($nominal, 0, ',', '.') . '.';
        }

        $kampus->save();

        // Audit Trail
        AuditLog::record(
            'Bappeda Menyesuaikan Alokasi Dana Kampus Mitra',
            'KampusMitra',
            $kampus->id,
            ['dana_bappeda' => $danaLama],
            [
                'kampus' => $kampus->nama_universitas,
                'tipe' => $request->tipe,
                'nominal_transaksi' => $nominal,
                'dana_bappeda_baru' => $kampus->dana_bappeda,
                'keterangan' => $request->keterangan ?? '-',
            ]
        );

        return back()->with('success', $pesan);
    }
}
