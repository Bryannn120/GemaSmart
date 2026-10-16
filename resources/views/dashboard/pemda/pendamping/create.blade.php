@extends('layouts.pemda')

@section('content')
<div class="flex flex-col gap-space-md max-w-4xl mx-auto w-full">
    <div class="flex items-center gap-2 text-text-secondary font-label-md text-label-md">
        <a href="{{ route('pemda.pendamping.index') }}" class="hover:text-primary transition-colors">Data Pendamping</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <span class="text-text-primary font-semibold">Tambah Baru</span>
    </div>

    <div>
        <h1 class="font-headline-lg text-headline-lg font-bold text-text-primary">Tambah Pendamping Lapangan</h1>
        <p class="font-body-md text-body-md text-text-secondary mt-1">Daftarkan akun mahasiswa pendamping baru beserta keterangan asal kampus mitranya.</p>
    </div>

    @if ($errors->any())
        <div class="bg-error-container text-on-error-container p-space-md rounded-xl font-body-sm border border-error/20">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-xl">
        <form action="{{ route('pemda.pendamping.store') }}" method="POST" class="flex flex-col gap-space-lg">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                <div class="flex flex-col gap-1.5">
                    <label for="name" class="font-label-md text-text-primary font-semibold">Nama Lengkap Pendamping <span class="text-error">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                        class="px-space-md py-2.5 border border-border-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary font-body-md bg-surface-subtle" 
                        placeholder="Contoh: Bryan Oktoviano S.Kom.">
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="email" class="font-label-md text-text-primary font-semibold">Email Login <span class="text-error">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                        class="px-space-md py-2.5 border border-border-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary font-body-md bg-surface-subtle" 
                        placeholder="Contoh: pendamping@kampus.ac.id">
                </div>
            </div>

            <!-- Keterangan Asal Kampus Mitra -->
            <div class="flex flex-col gap-1.5 p-space-md rounded-xl bg-blue-50/50 border border-blue-200">
                <label for="kampus_id" class="font-label-md text-blue-950 font-bold flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[20px] text-blue-700">school</span>
                    <span>Asal Perguruan Tinggi (Kampus Mitra) <span class="text-error">*</span></span>
                </label>
                <p class="text-xs text-text-secondary">Pilih universitas mitra tempat pendamping ini berasal.</p>
                <div class="relative mt-1">
                    <select id="kampus_id" name="kampus_id" required 
                        class="appearance-none w-full px-space-md py-2.5 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary font-body-md bg-white cursor-pointer text-text-primary font-semibold">
                        <option value="">-- Pilih Kampus Mitra --</option>
                        @foreach($kampusList as $km)
                            <option value="{{ $km->id }}" {{ old('kampus_id') == $km->id ? 'selected' : '' }}>
                                {{ $km->nama_universitas }} (MoU: {{ ucfirst($km->status_mou) }} - Wilayah: {{ $km->wilayah_binaan ?: 'Belum ada' }})
                            </option>
                        @endforeach
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-2.5 text-text-secondary pointer-events-none">expand_more</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                <div class="flex flex-col gap-1.5">
                    <label for="nim_nip" class="font-label-md text-text-primary font-semibold">NIM / NIP Mahasiswa</label>
                    <input type="text" id="nim_nip" name="nim_nip" value="{{ old('nim_nip') }}" 
                        class="px-space-md py-2.5 border border-border-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary font-body-md bg-surface-subtle" 
                        placeholder="Contoh: 2101010045">
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="fakultas_prodi" class="font-label-md text-text-primary font-semibold">Fakultas / Program Studi</label>
                    <input type="text" id="fakultas_prodi" name="fakultas_prodi" value="{{ old('fakultas_prodi') }}" 
                        class="px-space-md py-2.5 border border-border-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary font-body-md bg-surface-subtle" 
                        placeholder="Contoh: Fakultas Pertanian - Agroteknologi">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
                <div class="flex flex-col gap-1.5">
                    <label for="no_hp" class="font-label-md text-text-primary font-semibold">No. HP / WhatsApp</label>
                    <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" 
                        class="px-space-md py-2.5 border border-border-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary font-body-md bg-surface-subtle" 
                        placeholder="Contoh: 081234567890">
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="status_keaktifan" class="font-label-md text-text-primary font-semibold">Status Keaktifan</label>
                    <div class="relative">
                        <select id="status_keaktifan" name="status_keaktifan" 
                            class="appearance-none w-full px-space-md py-2.5 border border-border-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary font-body-md bg-surface-subtle cursor-pointer">
                            <option value="aktif" {{ old('status_keaktifan', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status_keaktifan') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-2.5 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="password" class="font-label-md text-text-primary font-semibold">Password Akun <span class="text-error">*</span></label>
                    <input type="password" id="password" name="password" required 
                        class="px-space-md py-2.5 border border-border-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary font-body-md bg-surface-subtle" 
                        placeholder="Minimal 8 karakter">
                </div>
            </div>

            <div class="flex flex-col gap-1.5">
                <label for="desa_penugasan" class="font-label-md text-text-primary font-semibold">Catatan Wilayah / Desa Penugasan</label>
                <input type="text" id="desa_penugasan" name="desa_penugasan" value="{{ old('desa_penugasan') }}" 
                    class="px-space-md py-2.5 border border-border-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary font-body-md bg-surface-subtle" 
                    placeholder="Contoh: Desa Lape, Desa Dete (Kecamatan Lape)">
            </div>

            <div class="flex items-center justify-end gap-space-sm pt-space-lg border-t border-border-light">
                <a href="{{ route('pemda.pendamping.index') }}" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold text-text-secondary hover:bg-surface-variant transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold bg-primary-container text-on-primary hover:bg-gov-green-dark transition-colors shadow-sm">
                    Simpan Pendamping
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
