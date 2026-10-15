@extends($layout)

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Pengaturan Akun</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Kelola informasi akun dan keamanan kata sandi Anda.
            </p>
        </div>
    </div>

    @if (session('success'))
    <div class="bg-status-verified-surface border border-status-verified text-status-verified p-4 rounded-lg flex items-center gap-2">
        <span class="material-symbols-outlined">check_circle</span>
        <span class="font-body-md">{{ session('success') }}</span>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-space-xl items-start">
        <!-- Kolom Kiri: Informasi Profil & Wilayah Dampingan -->
        <div class="flex flex-col gap-space-lg lg:col-span-1">
            <!-- Card 1: Informasi Profil Akun -->
            <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col gap-space-md">
                <h2 class="font-headline-md text-headline-md text-text-primary border-b border-border-light pb-space-sm font-bold">Profil Pengguna</h2>
                <div class="flex items-center gap-space-md mt-space-sm">
                    <div class="w-14 h-14 rounded-2xl bg-gov-green-surface text-primary flex items-center justify-center shrink-0 border border-primary/20 shadow-xs">
                        <span class="material-symbols-outlined text-[30px]">badge</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-base text-text-primary">{{ auth()->user()->name }}</span>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-gov-green-surface text-primary uppercase">
                                {{ auth()->user()->role === 'pendamping' ? 'Kader Pendamping' : auth()->user()->role }}
                            </span>
                            @if(auth()->user()->role === 'pendamping')
                                <span class="inline-flex items-center gap-1 text-[11px] text-emerald-600 font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span>Aktif</span>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="divide-y divide-border-light text-xs mt-1">
                    <div class="py-2.5 flex items-center justify-between">
                        <span class="text-text-secondary font-medium">Email Akun</span>
                        <span class="font-bold text-text-primary text-right">{{ auth()->user()->email }}</span>
                    </div>
                    @if(auth()->user()->nim_nip)
                        <div class="py-2.5 flex items-center justify-between">
                            <span class="text-text-secondary font-medium">NIM / NIP</span>
                            <span class="font-bold text-text-primary text-right">{{ auth()->user()->nim_nip }}</span>
                        </div>
                    @endif
                    @if(auth()->user()->fakultas_prodi)
                        <div class="py-2.5 flex items-center justify-between">
                            <span class="text-text-secondary font-medium">Fakultas / Prodi</span>
                            <span class="font-bold text-text-primary text-right">{{ auth()->user()->fakultas_prodi }}</span>
                        </div>
                    @endif
                    @if(auth()->user()->no_hp)
                        <div class="py-2.5 flex items-center justify-between">
                            <span class="text-text-secondary font-medium">No. Handphone</span>
                            <span class="font-bold text-text-primary text-right">{{ auth()->user()->no_hp }}</span>
                        </div>
                    @endif
                    @if(auth()->user()->kampus)
                        <div class="py-2.5 flex items-center justify-between">
                            <span class="text-text-secondary font-medium">Kampus Mitra</span>
                            <span class="font-bold text-primary text-right">{{ auth()->user()->kampus->nama_universitas }}</span>
                        </div>
                    @endif
                </div>

                <div class="p-3 bg-surface-muted rounded-xl border border-border-light text-[11px] text-text-secondary leading-relaxed">
                    <span class="material-symbols-outlined text-[15px] inline-block align-text-bottom text-primary mr-1">info</span>
                    Perubahan data diri dikoordinasikan langsung melalui Kampus Mitra atau Pemda.
                </div>
            </div>

            <!-- Card 2: Daerah yang Didampingi (Khusus Pendamping) -->
            @if(auth()->user()->role === 'pendamping')
                @php
                    $desasBinaan = isset($assignedDesas) && $assignedDesas->isNotEmpty() 
                        ? $assignedDesas 
                        : auth()->user()->getAssignedDesasCollection();
                    $totalBinaanCount = isset($totalBinaan) ? $totalBinaan : auth()->user()->keluargaPenerimas()->count();
                @endphp
                <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col gap-space-md">
                    <div class="flex items-center justify-between border-b border-border-light pb-space-sm">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-800 flex items-center justify-center">
                                <span class="material-symbols-outlined text-[18px]">location_on</span>
                            </div>
                            <h2 class="font-bold text-base text-text-primary">Wilayah Tugas Dampingan</h2>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                            Terisolasi
                        </span>
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="text-[11px] text-text-tertiary uppercase tracking-wider font-semibold">Wilayah / Klaster Penugasan</span>
                        <span class="font-bold text-sm text-text-primary">
                            {{ auth()->user()->assigned_wilayah_label ?: 'Wilayah Kabupaten Sumbawa' }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded-xl bg-surface-subtle border border-border-light">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[18px]">family_restroom</span>
                            <span class="text-xs font-semibold text-text-primary">Total Keluarga Penerima Bantuan</span>
                        </div>
                        <span class="font-bold text-sm text-primary">{{ $totalBinaanCount }} KK Penerima Bantuan</span>
                    </div>

                    <div class="flex flex-col gap-1.5 mt-1">
                        <span class="text-[11px] text-text-tertiary uppercase tracking-wider font-semibold">
                            Daftar Desa / Kelurahan Binaan ({{ $desasBinaan->count() }} Desa):
                        </span>
                        @if($desasBinaan->isNotEmpty())
                            <div class="flex flex-col gap-1.5 mt-0.5 max-h-64 overflow-y-auto pr-1">
                                @foreach($desasBinaan as $desa)
                                    <div class="flex items-center justify-between px-3 py-2 rounded-lg bg-surface-muted border border-border-light text-xs hover:border-primary/30 transition-colors">
                                        <div class="flex items-center gap-1.5">
                                             <span class="material-symbols-outlined text-[15px] text-primary">pin_drop</span>
                                            <span class="font-bold text-text-primary">Desa {{ $desa->nama }}</span>
                                        </div>
                                        <span class="text-[10px] text-text-tertiary font-medium">Kec. {{ $desa->parent ? $desa->parent->nama : '-' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <span class="text-xs text-text-tertiary italic">Belum ada desa yang teralokasi ke akun ini.</span>
                        @endif
                    </div>

                    <div class="p-3 bg-gradient-to-r from-amber-500/10 to-orange-500/10 rounded-xl border border-amber-300 text-[11px] text-amber-950 leading-relaxed">
                        <div class="flex items-center gap-1.5 font-bold mb-0.5 text-amber-900">
                            <span class="material-symbols-outlined text-[15px]">verified_user</span>
                            <span>Akses Wilayah Terkunci</span>
                        </div>
                        Akun pendamping Anda hanya memiliki hak akses untuk memantau, menyalurkan bantuan, dan memperbarui data keluarga penerima bantuan di wilayah desa terdaftar di atas.
                    </div>
                </div>
            @endif
        </div>

        <!-- Form Ubah Password -->
        <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light lg:col-span-2">
            <h2 class="font-headline-md text-headline-md text-text-primary border-b border-border-light pb-space-sm mb-space-md">Ubah Password</h2>
            
            <form action="{{ route('profile.password.update') }}" method="POST" class="flex flex-col gap-space-lg">
                @csrf
                @method('PUT')
                
                <div class="flex flex-col gap-space-xs">
                    <label class="font-label-md text-text-primary">Password Saat Ini <span class="text-error">*</span></label>
                    <input type="password" name="current_password" required class="w-full px-space-md py-space-sm rounded-lg bg-surface-muted border {{ $errors->has('current_password') ? 'border-error focus:border-error focus:ring-error/20' : 'border-border-light focus:border-primary focus:ring-primary/20' }} text-text-primary font-body-md transition-all outline-none focus:ring-2" placeholder="Masukkan password lama Anda">
                    @error('current_password')
                        <span class="font-label-sm text-error flex items-center gap-1 mt-1"><span class="material-symbols-outlined text-[14px]">error</span>{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                    <div class="flex flex-col gap-space-xs">
                        <label class="font-label-md text-text-primary">Password Baru <span class="text-error">*</span></label>
                        <input type="password" name="password" required minlength="8" class="w-full px-space-md py-space-sm rounded-lg bg-surface-muted border {{ $errors->has('password') ? 'border-error focus:border-error focus:ring-error/20' : 'border-border-light focus:border-primary focus:ring-primary/20' }} text-text-primary font-body-md transition-all outline-none focus:ring-2" placeholder="Minimal 8 karakter">
                        @error('password')
                            <span class="font-label-sm text-error flex items-center gap-1 mt-1"><span class="material-symbols-outlined text-[14px]">error</span>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-space-xs">
                        <label class="font-label-md text-text-primary">Konfirmasi Password Baru <span class="text-error">*</span></label>
                        <input type="password" name="password_confirmation" required minlength="8" class="w-full px-space-md py-space-sm rounded-lg bg-surface-muted border border-border-light focus:border-primary focus:ring-primary/20 text-text-primary font-body-md transition-all outline-none focus:ring-2" placeholder="Ketik ulang password baru">
                    </div>
                </div>

                <div class="flex items-center justify-end gap-space-sm mt-space-sm pt-space-md border-t border-border-light">
                    <button type="reset" class="px-space-md py-space-sm rounded-lg font-label-lg text-text-secondary hover:bg-surface-muted hover:text-text-primary transition-colors">
                        Reset Form
                    </button>
                    <button type="submit" class="px-space-md py-space-sm rounded-lg bg-primary text-on-primary font-label-lg hover:bg-primary-container transition-colors shadow-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">save</span> Simpan Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
