@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Laporan Kampus</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Unduh rekapitulasi data mahasiswa pendamping, SPJ, dan serapan anggaran untuk arsip akademik.
            </p>
        </div>
    </div>

    <!-- Reports Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-space-md">
        <!-- Card 1 -->
        <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light hover:border-primary transition-colors cursor-pointer group">
            <div class="w-12 h-12 rounded-xl bg-status-verified-surface text-primary flex items-center justify-center mb-space-md">
                <span class="material-symbols-outlined text-[24px]">description</span>
            </div>
            <h3 class="font-headline-sm font-semibold text-text-primary group-hover:text-primary transition-colors">Rekapitulasi SPJ</h3>
            <p class="font-body-sm text-text-secondary mt-1 mb-space-md">Data SPJ yang telah di-approved oleh Pemda.</p>
            <button class="w-full py-2 bg-surface-container rounded-lg text-text-primary font-label-md font-semibold group-hover:bg-primary group-hover:text-on-primary transition-colors">Generate PDF</button>
        </div>

        <!-- Card 2 -->
        <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light hover:border-primary transition-colors cursor-pointer group">
            <div class="w-12 h-12 rounded-xl bg-status-info-surface text-status-info flex items-center justify-center mb-space-md">
                <span class="material-symbols-outlined text-[24px]">how_to_reg</span>
            </div>
            <h3 class="font-headline-sm font-semibold text-text-primary group-hover:text-primary transition-colors">Log Harian Pendamping</h3>
            <p class="font-body-sm text-text-secondary mt-1 mb-space-md">Kompilasi aktivitas mahasiswa di lapangan.</p>
            <button class="w-full py-2 bg-surface-container rounded-lg text-text-primary font-label-md font-semibold group-hover:bg-primary group-hover:text-on-primary transition-colors">Generate PDF</button>
        </div>
    </div>
</div>
@endsection
