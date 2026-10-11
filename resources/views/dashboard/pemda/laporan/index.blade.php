@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Laporan & Statistik</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Unduh laporan berkala terkait program bantuan, penyerapan anggaran, dan distribusi.
            </p>
        </div>
        <div>
            <a href="{{ route('pemda.laporan.pdf') }}" target="_blank" class="px-space-md py-space-sm rounded-lg bg-status-fraud text-on-error font-label-lg hover:bg-red-800 transition-colors shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">picture_as_pdf</span> Cetak PDF Keseluruhan
            </a>
        </div>
    </div>

    <!-- Reports Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-space-md">
        <!-- Card 1 -->
        <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light hover:border-primary transition-colors cursor-pointer group">
            <div class="w-12 h-12 rounded-xl bg-status-verified-surface text-primary flex items-center justify-center mb-space-md">
                <span class="material-symbols-outlined text-[24px]">description</span>
            </div>
            <h3 class="font-headline-sm font-semibold text-text-primary group-hover:text-primary transition-colors">Laporan Penyaluran Bibit</h3>
            <p class="font-body-sm text-text-secondary mt-1 mb-space-md">Rekapitulasi pengiriman dan BAST yang telah ditandatangani.</p>
            <button class="w-full py-2 bg-surface-container rounded-lg text-text-primary font-label-md font-semibold group-hover:bg-primary group-hover:text-on-primary transition-colors">Generate PDF</button>
        </div>

        <!-- Card 2 -->
        <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light hover:border-primary transition-colors cursor-pointer group">
            <div class="w-12 h-12 rounded-xl bg-status-info-surface text-status-info flex items-center justify-center mb-space-md">
                <span class="material-symbols-outlined text-[24px]">pie_chart</span>
            </div>
            <h3 class="font-headline-sm font-semibold text-text-primary group-hover:text-primary transition-colors">Statistik Tumbuh Kembang</h3>
            <p class="font-body-sm text-text-secondary mt-1 mb-space-md">Analisis perkembangan bibit di berbagai kecamatan dan desa.</p>
            <button class="w-full py-2 bg-surface-container rounded-lg text-text-primary font-label-md font-semibold group-hover:bg-primary group-hover:text-on-primary transition-colors">Generate PDF</button>
        </div>
        
        <!-- Card 3 -->
        <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light hover:border-primary transition-colors cursor-pointer group">
            <div class="w-12 h-12 rounded-xl bg-status-warning-surface text-status-warning flex items-center justify-center mb-space-md">
                <span class="material-symbols-outlined text-[24px]">rule</span>
            </div>
            <h3 class="font-headline-sm font-semibold text-text-primary group-hover:text-primary transition-colors">Laporan Validasi Lapangan</h3>
            <p class="font-body-sm text-text-secondary mt-1 mb-space-md">Data CPCL yang valid vs yang bermasalah (anomali) di lapangan.</p>
            <button class="w-full py-2 bg-surface-container rounded-lg text-text-primary font-label-md font-semibold group-hover:bg-primary group-hover:text-on-primary transition-colors">Generate PDF</button>
        </div>
    </div>
</div>
@endsection
