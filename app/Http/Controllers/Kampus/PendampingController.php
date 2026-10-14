<?php

namespace App\Http\Controllers\Kampus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\KampusMitra;
use App\Models\Wilayah;
use App\Models\KeluargaPenerima;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Hash;

class PendampingController extends Controller
{
    /**
     * Display a listing of pendamping users for the current campus.
     */
    public function index(Request $request)
    {
        $kampus = KampusMitra::where('user_id', auth()->id())->first() ?? KampusMitra::first();
        $kampusId = $kampus ? $kampus->id : null;

        $search = $request->query('search');
        $statusFilter = $request->query('status');

        $query = User::where('role', 'pendamping')
            ->when($kampusId, function ($q) use ($kampusId) {
                $q->where('kampus_id', $kampusId);
            })
            ->withCount(['keluargaPenerimas', 'laporanTumbuhKembangs', 'penyaluranBantuans'])
            ->with(['keluargaPenerimas.wilayah']);

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

        if ($request->filled('status')) {
            $query->where('status_keaktifan', $statusFilter);
        }

        $pendampings = $query->latest('id')->paginate(12)->withQueryString();

        // Statistik Cepat
        $totalPendamping = User::where('role', 'pendamping')
            ->when($kampusId, function ($q) use ($kampusId) {
                $q->where('kampus_id', $kampusId);
            })->count();

        $totalAktif = User::where('role', 'pendamping')
            ->when($kampusId, function ($q) use ($kampusId) {
                $q->where('kampus_id', $kampusId);
            })
            ->where('status_keaktifan', 'aktif')->count();

        $totalBinaan = KeluargaPenerima::when($kampusId, function ($q) use ($kampusId) {
            $q->where('kampus_id', $kampusId);
        })->whereNotNull('pendamping_id')->count();

        return view('dashboard.kampus.pendamping.index', compact(
            'pendampings',
            'kampus',
            'totalPendamping',
            'totalAktif',
            'totalBinaan',
            'search',
            'statusFilter'
        ));
    }

    /**
     * Show the form for creating a new pendamping.
     */
    public function create()
    {
        $kampus = KampusMitra::where('user_id', auth()->id())->first() ?? KampusMitra::first();
        $desas = Wilayah::where('jenis', 'desa')->with('parent')->orderBy('nama')->get();

        return view('dashboard.kampus.pendamping.create', compact('kampus', 'desas'));
    }

    /**
     * Store a newly created pendamping in storage with their generated password.
     */
    public function store(Request $request)
    {
        $kampus = KampusMitra::where('user_id', auth()->id())->first() ?? KampusMitra::first();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nim_nip' => 'nullable|string|max:50',
            'fakultas_prodi' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'no_hp' => 'nullable|string|max:30',
            'password' => 'required|string|min:6',
            'status_keaktifan' => 'required|in:aktif,nonaktif',
            'desa_penugasan' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama lengkap pendamping wajib diisi.',
            'email.required' => 'Email login pendamping wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar di sistem. Gunakan email lain.',
            'password.required' => 'Password akun pendamping wajib ditentukan.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
        ]);

        $pendamping = User::create([
            'name' => $validated['name'],
            'nim_nip' => $validated['nim_nip'] ?? null,
            'fakultas_prodi' => $validated['fakultas_prodi'] ?? null,
            'email' => strtolower(trim($validated['email'])),
            'no_hp' => $validated['no_hp'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'pendamping',
            'kampus_id' => $kampus ? $kampus->id : null,
            'status_keaktifan' => $validated['status_keaktifan'] ?? 'aktif',
            'desa_penugasan' => $validated['desa_penugasan'] ?? null,
        ]);

        // Audit Trail
        AuditLog::record(
            'Kampus Mendaftarkan Tenaga Pendamping Baru',
            'User',
            $pendamping->id,
            null,
            [
                'name' => $pendamping->name,
                'email' => $pendamping->email,
                'nim_nip' => $pendamping->nim_nip,
                'fakultas_prodi' => $pendamping->fakultas_prodi,
                'desa_penugasan' => $pendamping->desa_penugasan,
                'kampus' => $kampus->nama_universitas ?? 'Kampus Mitra',
            ]
        );

        return redirect()->route('kampus.pendamping.index')
            ->with('success', "Pendamping {$pendamping->name} berhasil ditambahkan! Akun login telah dibuat (Email: {$pendamping->email}).");
    }

    /**
     * Display the specified pendamping.
     */
    public function show(string $id)
    {
        $kampus = KampusMitra::where('user_id', auth()->id())->first() ?? KampusMitra::first();
        $kampusId = $kampus ? $kampus->id : null;

        $pendamping = User::where('role', 'pendamping')
            ->when($kampusId, function ($q) use ($kampusId) {
                $q->where('kampus_id', $kampusId);
            })
            ->with([
                'kampus',
                'keluargaPenerimas.wilayah.parent',
                'laporanTumbuhKembangs.keluarga_penerima',
                'penyaluranBantuans.itemBantuan'
            ])
            ->findOrFail($id);

        return view('dashboard.kampus.pendamping.show', compact('pendamping'));
    }

    /**
     * Show the form for editing the specified pendamping.
     */
    public function edit(string $id)
    {
        $kampus = KampusMitra::where('user_id', auth()->id())->first() ?? KampusMitra::first();
        $kampusId = $kampus ? $kampus->id : null;

        $pendamping = User::where('role', 'pendamping')
            ->when($kampusId, function ($q) use ($kampusId) {
                $q->where('kampus_id', $kampusId);
            })
            ->findOrFail($id);

        $desas = Wilayah::where('jenis', 'desa')->with('parent')->orderBy('nama')->get();

        return view('dashboard.kampus.pendamping.edit', compact('pendamping', 'desas'));
    }

    /**
     * Update the specified pendamping in storage.
     */
    public function update(Request $request, string $id)
    {
        $kampus = KampusMitra::where('user_id', auth()->id())->first() ?? KampusMitra::first();
        $kampusId = $kampus ? $kampus->id : null;

        $pendamping = User::where('role', 'pendamping')
            ->when($kampusId, function ($q) use ($kampusId) {
                $q->where('kampus_id', $kampusId);
            })
            ->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nim_nip' => 'nullable|string|max:50',
            'fakultas_prodi' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $pendamping->id,
            'no_hp' => 'nullable|string|max:30',
            'password' => 'nullable|string|min:6',
            'status_keaktifan' => 'required|in:aktif,nonaktif',
            'desa_penugasan' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama lengkap pendamping wajib diisi.',
            'email.required' => 'Email login pendamping wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar oleh pengguna lain.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
        ]);

        $dataLama = $pendamping->only(['name', 'nim_nip', 'fakultas_prodi', 'email', 'no_hp', 'status_keaktifan', 'desa_penugasan']);

        $updateData = [
            'name' => $validated['name'],
            'nim_nip' => $validated['nim_nip'] ?? null,
            'fakultas_prodi' => $validated['fakultas_prodi'] ?? null,
            'email' => strtolower(trim($validated['email'])),
            'no_hp' => $validated['no_hp'] ?? null,
            'status_keaktifan' => $validated['status_keaktifan'] ?? 'aktif',
            'desa_penugasan' => $validated['desa_penugasan'] ?? null,
        ];

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $pendamping->update($updateData);

        // Audit Trail
        AuditLog::record(
            'Kampus Memperbarui Data Tenaga Pendamping',
            'User',
            $pendamping->id,
            $dataLama,
            $pendamping->only(['name', 'nim_nip', 'fakultas_prodi', 'email', 'no_hp', 'status_keaktifan', 'desa_penugasan'])
        );

        return redirect()->route('kampus.pendamping.index')
            ->with('success', "Data pendamping {$pendamping->name} berhasil diperbarui.");
    }

    /**
     * Remove the specified pendamping from storage.
     */
    public function destroy(string $id)
    {
        $kampus = KampusMitra::where('user_id', auth()->id())->first() ?? KampusMitra::first();
        $kampusId = $kampus ? $kampus->id : null;

        $pendamping = User::where('role', 'pendamping')
            ->when($kampusId, function ($q) use ($kampusId) {
                $q->where('kampus_id', $kampusId);
            })
            ->findOrFail($id);

        $dataLama = $pendamping->only(['name', 'nim_nip', 'fakultas_prodi', 'email', 'no_hp', 'status_keaktifan', 'desa_penugasan']);

        // Lepaskan penugasan keluarga penerima yang dibina (set pendamping_id null)
        KeluargaPenerima::where('pendamping_id', $pendamping->id)->update(['pendamping_id' => null]);

        $name = $pendamping->name;
        $pendamping->delete();

        // Audit Trail
        AuditLog::record(
            'Kampus Menghapus Tenaga Pendamping',
            'User',
            (int) $id,
            $dataLama,
            null
        );

        return redirect()->route('kampus.pendamping.index')
            ->with('success', "Pendamping {$name} berhasil dihapus dari sistem.");
    }
}
