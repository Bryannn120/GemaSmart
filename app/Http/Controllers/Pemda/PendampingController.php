<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\KampusMitra;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Hash;

class PendampingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $kampusId = $request->query('kampus_id');
        $status = $request->query('status');

        $query = User::where('role', 'pendamping')
            ->with(['kampus', 'wilayahPenugasan'])
            ->withCount(['keluargaPenerimas']);

        if ($request->filled('search')) {
            $term = trim($search);
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                    ->orWhere('email', 'like', "%{$term}%")
                    ->orWhere('nim_nip', 'like', "%{$term}%")
                    ->orWhere('fakultas_prodi', 'like', "%{$term}%")
                    ->orWhere('desa_penugasan', 'like', "%{$term}%");
            });
        }

        if ($request->filled('kampus_id')) {
            $query->where('kampus_id', $kampusId);
        }

        if ($request->filled('status')) {
            $query->where('status_keaktifan', $status);
        }

        $pendampings = $query->latest('id')->get();

        // Statistik Cepat
        $totalPendamping = User::where('role', 'pendamping')->count();
        $totalAktif = User::where('role', 'pendamping')->where('status_keaktifan', 'aktif')->count();
        $totalKampusMitra = KampusMitra::count();
        $totalKampusTerlibat = User::where('role', 'pendamping')->whereNotNull('kampus_id')->distinct('kampus_id')->count('kampus_id');

        $kampusList = KampusMitra::orderBy('nama_universitas')->get();

        return view('dashboard.pemda.pendamping.index', compact(
            'pendampings',
            'kampusList',
            'totalPendamping',
            'totalAktif',
            'totalKampusMitra',
            'totalKampusTerlibat',
            'search',
            'kampusId',
            'status'
        ));
    }

    public function create()
    {
        $kampusList = KampusMitra::orderBy('nama_universitas')->get();
        return view('dashboard.pemda.pendamping.create', compact('kampusList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'kampus_id' => 'nullable|exists:kampus_mitras,id',
            'nim_nip' => 'nullable|string|max:50',
            'fakultas_prodi' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:30',
            'status_keaktifan' => 'nullable|in:aktif,nonaktif',
            'desa_penugasan' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama pendamping wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar di sistem.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'kampus_id.exists' => 'Kampus mitra yang dipilih tidak valid.',
        ]);

        $validated['role'] = 'pendamping';
        $validated['password'] = Hash::make($validated['password']);
        $validated['status_keaktifan'] = $validated['status_keaktifan'] ?? 'aktif';

        $pendamping = User::create($validated);

        AuditLog::record(
            'Pemda Menambahkan Pendamping Baru',
            'User',
            $pendamping->id,
            null,
            [
                'name' => $pendamping->name,
                'email' => $pendamping->email,
                'kampus_id' => $pendamping->kampus_id,
            ]
        );

        return redirect()->route('pemda.pendamping.index')->with('success', 'Pendamping berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $pendamping = User::where('role', 'pendamping')
            ->with(['kampus', 'wilayahPenugasan', 'keluargaPenerimas.wilayah'])
            ->withCount(['keluargaPenerimas', 'laporanTumbuhKembangs', 'penyaluranBantuans'])
            ->findOrFail($id);

        return view('dashboard.pemda.pendamping.show', compact('pendamping'));
    }

    public function edit(string $id)
    {
        $pendamping = User::where('role', 'pendamping')->with('kampus')->findOrFail($id);
        $kampusList = KampusMitra::orderBy('nama_universitas')->get();
        return view('dashboard.pemda.pendamping.edit', compact('pendamping', 'kampusList'));
    }

    public function update(Request $request, string $id)
    {
        $pendamping = User::where('role', 'pendamping')->findOrFail($id);
        $oldData = $pendamping->toArray();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $pendamping->id,
            'password' => 'nullable|string|min:8',
            'kampus_id' => 'nullable|exists:kampus_mitras,id',
            'nim_nip' => 'nullable|string|max:50',
            'fakultas_prodi' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:30',
            'status_keaktifan' => 'nullable|in:aktif,nonaktif',
            'desa_penugasan' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama pendamping wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar di akun lain.',
            'password.min' => 'Password minimal 8 karakter.',
            'kampus_id.exists' => 'Kampus mitra yang dipilih tidak valid.',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $pendamping->update($validated);

        AuditLog::record(
            'Pemda Memperbarui Data Pendamping',
            'User',
            $pendamping->id,
            $oldData,
            $pendamping->toArray()
        );

        return redirect()->route('pemda.pendamping.index')->with('success', 'Data pendamping berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $pendamping = User::where('role', 'pendamping')->findOrFail($id);
        
        AuditLog::record(
            'Pemda Menghapus Pendamping',
            'User',
            $pendamping->id,
            $pendamping->toArray(),
            null
        );
        
        $pendamping->delete();

        return redirect()->route('pemda.pendamping.index')->with('success', 'Pendamping berhasil dihapus.');
    }
}
