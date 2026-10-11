@extends('layouts.validator')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Halo, Siti Validator 🕵️‍♀️</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Periksa antrean laporan lapangan dari pendamping untuk diverifikasi sebelum dikirim ke Pemda.
            </p>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
        <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-center">
            <div class="flex items-center justify-between mb-2">
                <span class="font-label-md text-label-md text-text-secondary uppercase">Antrean Verifikasi</span>
                <span class="material-symbols-outlined text-status-warning">pending_actions</span>
            </div>
            <span class="font-headline-xl text-headline-xl text-status-warning font-bold">18 Laporan</span>
            <span class="text-label-sm text-text-secondary mt-1">Laporan dari Pendamping menunggu direview</span>
        </div>
        <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-center">
            <div class="flex items-center justify-between mb-2">
                <span class="font-label-md text-label-md text-text-secondary uppercase">Selesai Diverifikasi (Hari ini)</span>
                <span class="material-symbols-outlined text-status-verified">verified_user</span>
            </div>
            <span class="font-headline-xl text-headline-xl text-status-verified font-bold">4 Laporan</span>
            <span class="text-label-sm text-text-secondary mt-1">Diteruskan ke dashboard Pemda</span>
        </div>
    </div>

    <!-- Review Tasks -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light p-space-lg">
        <h2 class="font-headline-sm text-headline-sm text-text-primary mb-space-md">Antrean Terbaru</h2>
        <div class="flex flex-col gap-space-sm">
            
            <div class="p-space-md rounded-lg bg-surface-container border border-border-light flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full bg-status-info-surface text-status-info flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined">description</span>
                    </div>
                    <div>
                        <span class="font-label-md text-text-primary block">Laporan Kunjungan Lahan - Fajar Maulana</span>
                        <span class="text-body-sm text-text-secondary">Desa Kalimango • CPCL Lahan Pak Budi</span>
                        <span class="inline-flex px-2 py-0.5 mt-1 rounded bg-surface-container-high text-text-secondary font-code-dense text-[11px]">Ada Lampiran Foto</span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button class="px-3 py-1.5 bg-surface-container-high text-text-primary hover:bg-surface-variant font-label-sm rounded-md shadow-sm transition-colors">Tolak/Revisi</button>
                    <button class="px-3 py-1.5 bg-status-info text-white font-label-sm rounded-md shadow-sm">Review Sekarang</button>
                </div>
            </div>
            
            <div class="p-space-md rounded-lg bg-surface-container border border-border-light flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full bg-status-info-surface text-status-info flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined">eco</span>
                    </div>
                    <div>
                        <span class="font-label-md text-text-primary block">Monitoring Tumbuh Kembang - Rian Nurdin</span>
                        <span class="text-body-sm text-text-secondary">Desa Motong • Perkembangan Hama Minggu 2</span>
                        <span class="inline-flex px-2 py-0.5 mt-1 rounded bg-status-warning-surface text-status-warning font-code-dense text-[11px]">Indikasi Anomali</span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button class="px-3 py-1.5 bg-surface-container-high text-text-primary hover:bg-surface-variant font-label-sm rounded-md shadow-sm transition-colors">Tolak/Revisi</button>
                    <button class="px-3 py-1.5 bg-status-info text-white font-label-sm rounded-md shadow-sm">Review Sekarang</button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
