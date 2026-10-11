@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Halo, Budi Pendamping ðŸ‘‹</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Selamat bertugas! Berikut adalah ringkasan tugas validasi dan monitoring harian Anda di wilayah Kecamatan Utan.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <button class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add_a_photo</span>
                <span>Buat Laporan Baru</span>
            </button>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-md">
        <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-center">
            <div class="flex items-center justify-between mb-2">
                <span class="font-label-md text-label-md text-text-secondary uppercase">KeluargaPenerima Binaan</span>
                <span class="material-symbols-outlined text-primary">groups</span>
            </div>
            <span class="font-headline-xl text-headline-xl text-text-primary font-bold">24 KK</span>
            <span class="text-label-sm text-text-secondary mt-1">Desa Motong, Kec. Utan</span>
        </div>
        <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-center">
            <div class="flex items-center justify-between mb-2">
                <span class="font-label-md text-label-md text-text-secondary uppercase">Tugas Validasi CPCL</span>
                <span class="material-symbols-outlined text-status-warning">assignment_late</span>
            </div>
            <span class="font-headline-xl text-headline-xl text-status-warning font-bold">5 Antrean</span>
            <span class="text-label-sm text-text-secondary mt-1">Harus diselesaikan minggu ini</span>
        </div>
        <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-center">
            <div class="flex items-center justify-between mb-2">
                <span class="font-label-md text-label-md text-text-secondary uppercase">Laporan Terkirim</span>
                <span class="material-symbols-outlined text-status-verified">send</span>
            </div>
            <span class="font-headline-xl text-headline-xl text-status-verified font-bold">12 Laporan</span>
            <span class="text-label-sm text-text-secondary mt-1">Bulan Oktober 2026</span>
        </div>
    </div>

    <!-- Quick Actions & Tasks -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-space-lg">
        <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light p-space-lg">
            <h2 class="font-headline-sm text-headline-sm text-text-primary mb-space-md">Tugas Hari Ini</h2>
            <div class="flex flex-col gap-space-sm">
                <div class="p-space-md rounded-lg bg-status-warning-surface border border-status-warning/20 flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm">
                    <div>
                        <span class="font-label-md text-text-primary block">Validasi CPCL: Lahan Pak Hasan</span>
                        <span class="text-body-sm text-text-secondary">Desa Motong â€¢ Jadwal: 10:00 WITA</span>
                    </div>
                    <button class="px-3 py-1 bg-status-warning text-white font-label-sm rounded-md shadow-sm">Mulai Validasi</button>
                </div>
                <div class="p-space-md rounded-lg bg-surface-container border border-border-light flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm">
                    <div>
                        <span class="font-label-md text-text-primary block">Monitoring Umur 30 Hari: Lahan Pak Joko</span>
                        <span class="text-body-sm text-text-secondary">Desa Motong â€¢ Jagung Hibrida</span>
                    </div>
                    <button class="px-3 py-1 bg-primary text-white font-label-sm rounded-md shadow-sm">Kirim Log</button>
                </div>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light p-space-lg">
            <h2 class="font-headline-sm text-headline-sm text-text-primary mb-space-md">Aktivitas Terakhir Saya</h2>
            <div class="flex flex-col gap-space-md">
                <div class="flex gap-space-md">
                    <div class="w-8 h-8 rounded-full bg-status-verified-surface text-status-verified flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[16px]">check_circle</span>
                    </div>
                    <div>
                        <span class="font-label-md text-text-primary block">Menyelesaikan Validasi Lahan Pak Budi</span>
                        <span class="text-body-sm text-text-secondary">Kemarin, 14:30 WITA</span>
                    </div>
                </div>
                <div class="flex gap-space-md">
                    <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[16px]">eco</span>
                    </div>
                    <div>
                        <span class="font-label-md text-text-primary block">Mengirim Laporan Tumbuh Kembang (Hama 0%)</span>
                        <span class="text-body-sm text-text-secondary">Kemarin, 10:15 WITA</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
