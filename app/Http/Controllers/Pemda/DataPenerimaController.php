<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeluargaPenerima;
use App\Models\Wilayah;
use App\Models\ProgramBantuan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DataPenerimaController extends Controller
{
    public function index()
    {
        $keluarga_penerimas = KeluargaPenerima::with(['wilayah', 'programBantuan', 'user'])->get();
        return view('dashboard.pemda.data-penerima.index', compact('keluarga_penerimas'));
    }

    public function create()
    {
        $wilayahs = Wilayah::where('is_aktif', true)->get();
        $programs = ProgramBantuan::where('status', 'aktif')->get();
        return view('dashboard.pemda.data-penerima.create', compact('wilayahs', 'programs'));
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
        $validated['status_kemandirian'] = 'Belum Dinilai';

        KeluargaPenerima::create($validated);

        return redirect()->route('pemda.data-penerima.index')->with('success', 'Data penerima berhasil ditambahkan & Akun berhasil dibuat.');
    }

    public function show(string $id)
    {
        $keluarga_penerima = KeluargaPenerima::with(['wilayah', 'programBantuan', 'user', 'penilaianKemandirians', 'laporanPenerimas'])->findOrFail($id);
        return view('dashboard.pemda.data-penerima.show', compact('keluarga_penerima'));
    }

    public function edit(string $id)
    {
        $keluarga_penerima = KeluargaPenerima::findOrFail($id);
        $wilayahs = Wilayah::where('is_aktif', true)->get();
        $programs = ProgramBantuan::where('status', 'aktif')->get();
        return view('dashboard.pemda.data-penerima.edit', compact('keluarga_penerima', 'wilayahs', 'programs'));
    }

    public function update(Request $request, string $id)
    {
        $keluarga_penerima = KeluargaPenerima::findOrFail($id);

        $validated = $request->validate([
            'no_kk' => 'required|string|size:16|unique:keluarga_penerimas,no_kk,' . $id,
            'kepala_keluarga' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:keluarga_penerimas,nik,' . $id,
            'alamat' => 'nullable|string|max:255',
            'desil' => 'required|integer|min:1|max:10',
            'wilayah_id' => 'required|exists:wilayahs,id',
            'program_bantuan_id' => 'required|exists:program_bantuans,id',
            'status_validasi' => 'required|in:menunggu_validasi,proses_lapangan,valid,anomali',
        ]);

        $keluarga_penerima->update($validated);
        
        if ($keluarga_penerima->user) {
            $keluarga_penerima->user->update([
                'name' => $validated['kepala_keluarga'],
                'email' => $validated['nik'] . '@penerima.com',
            ]);
        }

        return redirect()->route('pemda.data-penerima.index')->with('success', 'Data penerima berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $keluarga_penerima = KeluargaPenerima::findOrFail($id);
        if ($keluarga_penerima->user) {
            $keluarga_penerima->user->delete();
        }
        $keluarga_penerima->delete();

        return redirect()->route('pemda.data-penerima.index')->with('success', 'Data penerima berhasil dihapus.');
    }
}
