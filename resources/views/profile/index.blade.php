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
        <!-- Informasi Profil -->
        <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col gap-space-md lg:col-span-1">
            <h2 class="font-headline-md text-headline-md text-text-primary border-b border-border-light pb-space-sm">Profil Pengguna</h2>
            <div class="flex items-center gap-space-md mt-space-sm">
                <div class="w-16 h-16 rounded-full bg-primary-fixed flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-primary text-[32px]">person</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-headline-sm text-text-primary">{{ auth()->user()->name }}</span>
                    <span class="font-label-md text-text-secondary capitalize">Role: {{ auth()->user()->role }}</span>
                </div>
            </div>
            <div class="flex flex-col gap-1 mt-space-md">
                <span class="font-label-sm text-text-tertiary uppercase tracking-wider">Email Akun</span>
                <span class="font-body-md text-text-primary">{{ auth()->user()->email }}</span>
            </div>
            <div class="mt-space-sm p-3 bg-surface-muted rounded-lg border border-border-light">
                <p class="font-label-sm text-text-secondary leading-relaxed">
                    <span class="material-symbols-outlined text-[16px] inline-block align-text-bottom text-status-info mr-1">info</span>
                    Untuk mengubah Nama atau Email, silakan hubungi Administrator Sistem Pemda.
                </p>
            </div>
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
