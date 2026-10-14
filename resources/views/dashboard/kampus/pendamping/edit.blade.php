@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <a href="{{ route('kampus.pendamping.index') }}" class="inline-flex items-center gap-1 text-xs text-text-secondary hover:text-primary transition-colors font-medium">
                    <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                    <span>Kembali ke Tim Pendamping</span>
                </a>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Edit Pendamping: {{ $pendamping->name }}</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Perbarui identitas profil, wilayah penugasan, atau ubah password login akun pendamping.
            </p>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 p-space-md rounded-2xl flex flex-col gap-1 shadow-sm">
            <div class="flex items-center gap-2 font-bold text-sm">
                <span class="material-symbols-outlined text-[20px] text-red-600">error</span>
                <span>Terdapat kesalahan pengisian data:</span>
            </div>
            <ul class="list-disc list-inside text-xs mt-1 space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kampus.pendamping.update', $pendamping->id) }}" method="POST" class="flex flex-col gap-6">
        @csrf
        @method('PUT')

        <!-- Card 1: Data Identitas Akademik -->
        <div class="bg-canvas-bg rounded-2xl p-space-lg shadow-sm border border-border-light flex flex-col gap-5">
            <div class="flex items-center gap-2.5 pb-3 border-b border-border-light">
                <span class="p-2 rounded-xl bg-gov-green-surface text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px]">person</span>
                </span>
                <div>
                    <h2 class="font-bold text-base text-text-primary">1. Identitas &amp; Profil Akademik</h2>
                    <p class="text-xs text-text-secondary">Informasi mahasiswa atau tenaga pendamping</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nama Lengkap -->
                <div class="md:col-span-2">
                    <label for="name" class="block text-xs font-bold text-text-primary mb-1">
                        Nama Lengkap Pendamping <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $pendamping->name) }}" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle text-text-primary text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                </div>

                <!-- NIM / NIP -->
                <div>
                    <label for="nim_nip" class="block text-xs font-bold text-text-primary mb-1">
                        NIM / NIP Mahasiswa
                    </label>
                    <input type="text" name="nim_nip" id="nim_nip" value="{{ old('nim_nip', $pendamping->nim_nip) }}"
                        placeholder="Contoh: 2021010054"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle text-text-primary text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                </div>

                <!-- Fakultas / Program Studi -->
                <div>
                    <label for="fakultas_prodi" class="block text-xs font-bold text-text-primary mb-1">
                        Fakultas / Program Studi
                    </label>
                    <input type="text" name="fakultas_prodi" id="fakultas_prodi" value="{{ old('fakultas_prodi', $pendamping->fakultas_prodi) }}"
                        placeholder="Contoh: Pertanian / Agroteknologi"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle text-text-primary text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                </div>

                <!-- No. HP / WhatsApp -->
                <div class="md:col-span-2">
                    <label for="no_hp" class="block text-xs font-bold text-text-primary mb-1">
                        Nomor HP / WhatsApp Aktif
                    </label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $pendamping->no_hp) }}"
                        placeholder="Contoh: 081234567890"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle text-text-primary text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                </div>
            </div>
        </div>

        <!-- Card 2: Akun Login Sistem (Email & Ubah Password) -->
        <div class="bg-canvas-bg rounded-2xl p-space-lg shadow-sm border border-border-light flex flex-col gap-5">
            <div class="flex items-center gap-2.5 pb-3 border-b border-border-light">
                <span class="p-2 rounded-xl bg-gold-surface text-secondary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px]">lock</span>
                </span>
                <div>
                    <h2 class="font-bold text-base text-text-primary">2. Akun Login &amp; Password</h2>
                    <p class="text-xs text-text-secondary">Ubah alamat email login atau atur password baru pendamping</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Email Login -->
                <div>
                    <label for="email" class="block text-xs font-bold text-text-primary mb-1">
                        Email Login <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-tertiary text-[18px]">mail</span>
                        <input type="email" name="email" id="email" value="{{ old('email', $pendamping->email) }}" required
                            class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle text-text-primary text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    </div>
                </div>

                <!-- Password Baru (Opsional) -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="text-xs font-bold text-text-primary">
                            Password Baru (Opsional)
                        </label>
                        <button type="button" onclick="generateRandomPassword()" class="text-[11px] text-primary hover:underline font-semibold flex items-center gap-0.5">
                            <span class="material-symbols-outlined text-[14px]">autorenew</span>
                            Generate Acak
                        </button>
                    </div>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-tertiary text-[18px]">key</span>
                        <input type="password" name="password" id="passwordInput" minlength="6"
                            placeholder="Kosongkan jika tidak diubah"
                            class="w-full pl-9 pr-10 py-2.5 rounded-xl border border-border-medium bg-surface-subtle text-text-primary text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all font-mono">
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute right-3 top-1/2 -translate-y-1/2 text-text-tertiary hover:text-text-primary">
                            <span class="material-symbols-outlined text-[18px]" id="eyeIcon">visibility</span>
                        </button>
                    </div>
                    <span class="text-[11px] text-text-tertiary mt-1 block">Biarkan kosong jika tetap menggunakan password yang lama.</span>
                </div>
            </div>
        </div>

        <!-- Card 3: Ploting & Penugasan Wilayah -->
        <div class="bg-canvas-bg rounded-2xl p-space-lg shadow-sm border border-border-light flex flex-col gap-5">
            <div class="flex items-center gap-2.5 pb-3 border-b border-border-light">
                <span class="p-2 rounded-xl bg-blue-100 text-blue-800 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px]">location_on</span>
                </span>
                <div>
                    <h2 class="font-bold text-base text-text-primary">3. Penugasan Wilayah &amp; Status Keaktifan</h2>
                    <p class="text-xs text-text-secondary">Atur status keaktifan dan lokasi desa penugasan lapangan</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Status Keaktifan -->
                <div>
                    <label for="status_keaktifan" class="block text-xs font-bold text-text-primary mb-1">
                        Status Keaktifan <span class="text-red-500">*</span>
                    </label>
                    <select name="status_keaktifan" id="status_keaktifan" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle text-text-primary text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all cursor-pointer">
                        <option value="aktif" {{ old('status_keaktifan', $pendamping->status_keaktifan) === 'aktif' ? 'selected' : '' }}>🟢 Aktif di Lapangan</option>
                        <option value="nonaktif" {{ old('status_keaktifan', $pendamping->status_keaktifan) === 'nonaktif' ? 'selected' : '' }}>⚪ Nonaktif / Cuti</option>
                    </select>
                </div>

                <!-- Desa Penugasan -->
                <div>
                    <label for="desa_penugasan" class="block text-xs font-bold text-text-primary mb-1">
                        Desa / Wilayah Penugasan
                    </label>
                    <input type="text" name="desa_penugasan" id="desa_penugasan" list="desaList" value="{{ old('desa_penugasan', $pendamping->desa_penugasan) }}"
                        placeholder="Pilih atau ketik nama desa dampingan..."
                        class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle text-text-primary text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    <datalist id="desaList">
                        @foreach($desas as $desa)
                            <option value="Desa {{ $desa->nama }} (Kec. {{ $desa->parent ? $desa->parent->nama : '-' }})">
                        @endforeach
                    </datalist>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Form -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('kampus.pendamping.index') }}" class="px-5 py-2.5 rounded-xl border border-border-medium text-text-secondary hover:text-text-primary hover:bg-surface-subtle font-semibold text-xs transition-colors">
                Batal
            </a>
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-primary text-white font-bold text-xs hover:bg-gov-green-dark transition-all shadow-md hover:shadow-lg">
                <span class="material-symbols-outlined text-[18px]">save</span>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </form>
</div>

<script>
function generateRandomPassword() {
    const chars = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789!@#$';
    let result = '';
    for (let i = 0; i < 8; i++) {
        result += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    document.getElementById('passwordInput').value = result;
    document.getElementById('passwordInput').type = 'text';
    document.getElementById('eyeIcon').textContent = 'visibility_off';
}

function togglePasswordVisibility() {
    const input = document.getElementById('passwordInput');
    const icon = document.getElementById('eyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = 'visibility_off';
    } else {
        input.type = 'password';
        icon.textContent = 'visibility';
    }
}
</script>
@endsection
