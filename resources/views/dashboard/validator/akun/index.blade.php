@extends('layouts.validator')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Akun Saya (Validator)</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Ubah informasi profil, kata sandi, dan status ketersediaan Anda untuk menerima tugas validasi baru.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <button class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">save</span>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </div>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col gap-space-lg">
        <h3 class="font-headline-sm font-semibold text-text-primary border-b border-border-light pb-2">Pengaturan Profil</h3>
        
        <div class="flex flex-col gap-2">
            <label class="font-label-md text-text-secondary">Nama Lengkap</label>
            <input class="w-full sm:max-w-md font-body-md py-2 px-3 rounded-lg bg-surface-container-lowest border border-border-medium text-text-primary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary shadow-sm" type="text" value="Siti Validator"/>
        </div>
        
        <div class="flex flex-col gap-2">
            <label class="font-label-md text-text-secondary">Area Penugasan Utama</label>
            <input class="w-full sm:max-w-md font-body-md py-2 px-3 rounded-lg bg-surface-container-low border border-border-medium text-text-secondary shadow-sm" type="text" value="Kabupaten Sumbawa (General)" readonly/>
        </div>
        
        <div class="flex flex-col gap-2 mt-4">
            <label class="font-label-md text-text-secondary">Status Ketersediaan</label>
            <div class="flex items-center gap-4">
                <select class="w-full sm:max-w-md font-body-md py-2 px-3 rounded-lg bg-surface-container-lowest border border-border-medium text-text-primary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary shadow-sm">
                    <option selected>Siap Bertugas</option>
                    <option>Cuti / Izin</option>
                    <option>Sedang Sibuk (Tunda Antrean)</option>
                </select>
            </div>
        </div>
    </div>
</div>
@endsection
