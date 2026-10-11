@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Pengaturan Sistem</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Konfigurasi aplikasi, manajemen pengguna, dan pengaturan notifikasi.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <button class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">save</span>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-space-lg">
        <!-- Settings Sidebar -->
        <div class="flex flex-col gap-2">
            <a href="#" class="px-space-md py-space-sm rounded-lg bg-surface-container-high text-text-primary font-label-md font-semibold border-l-4 border-l-primary shadow-sm">Profil & Akun</a>
            <a href="#" class="px-space-md py-space-sm rounded-lg text-text-secondary hover:bg-surface-subtle font-label-md transition-colors">Akses & Peran (Role)</a>
            <a href="#" class="px-space-md py-space-sm rounded-lg text-text-secondary hover:bg-surface-subtle font-label-md transition-colors">Tahun Anggaran</a>
            <a href="#" class="px-space-md py-space-sm rounded-lg text-text-secondary hover:bg-surface-subtle font-label-md transition-colors">Keamanan</a>
        </div>
        
        <!-- Settings Form -->
        <div class="md:col-span-3 bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col gap-space-lg">
            <h3 class="font-headline-sm font-semibold text-text-primary border-b border-border-light pb-2">Informasi Instansi</h3>
            
            <div class="flex flex-col gap-2">
                <label class="font-label-md text-text-secondary">Nama Instansi</label>
                <input class="w-full sm:max-w-md font-body-md py-2 px-3 rounded-lg bg-canvas-bg border border-border-medium text-text-primary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary shadow-sm" type="text" value="Bappeda Kabupaten Sumbawa"/>
            </div>
            
            <div class="flex flex-col gap-2">
                <label class="font-label-md text-text-secondary">Alamat</label>
                <textarea class="w-full sm:max-w-md font-body-md py-2 px-3 rounded-lg bg-canvas-bg border border-border-medium text-text-primary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary shadow-sm" rows="3">Jl. Garuda No. 100, Sumbawa Besar</textarea>
            </div>
            
            <div class="flex flex-col gap-2 mt-4">
                <label class="font-label-md text-text-secondary">Logo Instansi</label>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('gemas.jpg') }}" alt="Logo" class="w-16 h-16 object-contain bg-surface-muted rounded-lg p-2 border border-border-medium"/>
                    <button class="px-4 py-1.5 rounded-lg border border-border-medium text-text-secondary hover:bg-surface-variant text-label-md font-semibold transition-colors">Ganti Logo</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
