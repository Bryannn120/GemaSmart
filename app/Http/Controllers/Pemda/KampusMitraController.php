<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KampusMitra;
use App\Models\User;
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
        ]);

        // Create User account automatically for the new Kampus
        $user = User::create([
            'name' => $validated['nama_universitas'],
            'email' => $validated['email_kampus'],
            'password' => Hash::make('password123'), // Default password
            'role' => 'kampus',
        ]);

        $validated['user_id'] = $user->id;

        KampusMitra::create($validated);

        return redirect()->route('pemda.kampus-mitra.index')->with('success', 'Kampus Mitra dan Akun User berhasil ditambahkan (Password default: password123).');
    }

    public function show(string $id)
    {
        $kampusMitra = KampusMitra::with('user')->findOrFail($id);
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

        $validated = $request->validate([
            'nama_universitas' => 'required|string|max:255',
            'email_kampus' => 'required|email|unique:users,email,' . $kampusMitra->user_id,
            'pic_name' => 'required|string|max:255',
            'pic_contact' => 'nullable|string|max:255',
            'wilayah_binaan' => 'nullable|string|max:255',
            'mou_berlaku_sampai' => 'nullable|date',
            'status_mou' => 'required|in:aktif,tidak_aktif',
        ]);

        $kampusMitra->update($validated);
        
        if ($kampusMitra->user) {
            $kampusMitra->user->update([
                'name' => $validated['nama_universitas'],
                'email' => $validated['email_kampus'],
            ]);
        }

        return redirect()->route('pemda.kampus-mitra.index')->with('success', 'Kampus Mitra berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $kampusMitra = KampusMitra::findOrFail($id);
        if ($kampusMitra->user) {
            $kampusMitra->user->delete();
        }
        $kampusMitra->delete();

        return redirect()->route('pemda.kampus-mitra.index')->with('success', 'Kampus Mitra berhasil dihapus.');
    }
}
