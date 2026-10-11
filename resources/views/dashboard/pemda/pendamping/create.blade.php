@extends('layouts.pemda')

@section('content')
<div class="flex flex-col gap-space-md">
    <div class="flex items-center gap-2 text-text-secondary font-label-md text-label-md">
        <a href="{{ route('pemda.pendamping.index') }}" class="hover:text-primary transition-colors">Data Pendamping</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <span class="text-text-primary font-semibold">Tambah Baru</span>
    </div>

    <div>
        <h1 class="font-headline-lg text-headline-lg font-bold text-text-primary">Tambah Pendamping</h1>
        <p class="font-body-md text-body-md text-text-secondary mt-1">Lengkapi form di bawah untuk menambahkan akun pendamping baru.</p>
    </div>

    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg">
        <form action="{{ route('pemda.pendamping.store') }}" method="POST" class="flex flex-col gap-space-md max-w-2xl">
            @csrf
            
            <div class="flex flex-col gap-2">
                <label for="name" class="font-label-md text-label-md font-semibold text-text-primary">Nama Pendamping <span class="text-error">*</span></label>
                <input type="text" id="name" name="name" required class="px-space-md py-space-sm border border-border-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary font-body-md text-body-md" placeholder="Masukkan nama pendamping">
            </div>

            <div class="flex flex-col gap-2">
                <label for="email" class="font-label-md text-label-md font-semibold text-text-primary">Email <span class="text-error">*</span></label>
                <input type="email" id="email" name="email" required class="px-space-md py-space-sm border border-border-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary font-body-md text-body-md" placeholder="Masukkan alamat email">
            </div>

            <div class="flex flex-col gap-2">
                <label for="password" class="font-label-md text-label-md font-semibold text-text-primary">Password <span class="text-error">*</span></label>
                <input type="password" id="password" name="password" required class="px-space-md py-space-sm border border-border-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary font-body-md text-body-md" placeholder="Masukkan password (minimal 8 karakter)">
            </div>

            <div class="flex items-center gap-space-sm mt-space-sm pt-space-md border-t border-border-light">
                <a href="{{ route('pemda.pendamping.index') }}" class="px-space-md py-space-sm rounded-lg font-label-lg text-label-lg font-semibold text-text-secondary hover:bg-surface-subtle transition-colors">Batal</a>
                <button type="submit" class="px-space-md py-space-sm rounded-lg font-label-lg text-label-lg font-semibold bg-primary text-on-primary hover:bg-primary-container transition-colors shadow-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
