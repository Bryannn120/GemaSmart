<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KampusMitra;
use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Hash;

class KampusMitraController extends Controller
{
    public function index()
    {
        $kampusMitras = KampusMitra::with('user')->get();
        return view('dashboard.pemda.kampus-mitra.index', compact('kampusMitras'));
    }

    public function create()
    {
        return view('dashboard.pemda.kampus-mitra.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_universitas' => 'required|string|max:255',
            'email_kampus' => 'required|email|unique:users,email',
            'pic_name' => 'required|string|max:255',
            'pic_contact' => 'nullable|string|max:255',
            'wilayah_binaan' => 'nullable|string|max:255',
            'mou_berlaku_sampai' => 'nullable|date',
            'status_mou' => 'required|in:aktif,tidak_aktif',
            'dana_bappeda' => 'nullable|numeric|min:0',
        ]);

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
            ]
        );

        return redirect()->route('pemda.kampus-mitra.index')->with('success', 'Kampus Mitra dan Akun User berhasil ditambahkan (Password default: password123).');
    }

    public function show(string $id)
    {
        $kampusMitra = KampusMitra::with(['user', 'programBantuans'])->findOrFail($id);
        return view('dashboard.pemda.kampus-mitra.show', compact('kampusMitra'));
    }

    public function edit(string $id)
    {
        $kampusMitra = KampusMitra::findOrFail($id);
        return view('dashboard.pemda.kampus-mitra.edit', compact('kampusMitra'));
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
            'wilayah_binaan' => 'nullable|string|max:255',
            'mou_berlaku_sampai' => 'nullable|date',
            'status_mou' => 'required|in:aktif,tidak_aktif',
            'dana_bappeda' => 'nullable|numeric|min:0',
        ]);

        $validated['dana_bappeda'] = $validated['dana_bappeda'] ?? 0;

        $kampusMitra->update($validated);
        
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
