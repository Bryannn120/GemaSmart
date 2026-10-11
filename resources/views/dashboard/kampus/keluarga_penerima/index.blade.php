@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Data KeluargaPenerima Binaan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Data kelompok tani yang didampingi oleh kampus berdasarkan Surat Keputusan.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <button class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-surface-container-high text-text-primary font-label-md text-label-md font-semibold hover:bg-surface-variant transition-colors border border-border-medium shadow-sm">
                <span class="material-symbols-outlined text-[18px]">download</span>
                <span>Export Data</span>
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-container-low text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Nama Kelompok Tani</th>
                        <th class="py-3 px-4 font-semibold">Ketua / Kontak</th>
                        <th class="py-3 px-4 font-semibold">Desa / Kecamatan</th>
                        <th class="py-3 px-4 font-semibold">Total Anggota (KK)</th>
                        <th class="py-3 px-4 font-semibold">Pendamping UTS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light">
                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                        <td class="py-3.5 px-4 font-semibold text-text-primary">KT. Mekar Jaya</td>
                        <td class="py-3.5 px-4 text-text-primary">Pak Burhan (0812xxx)</td>
                        <td class="py-3.5 px-4 text-text-primary">Desa Motong / Utan</td>
                        <td class="py-3.5 px-4 font-semibold text-text-primary">24 KK</td>
                        <td class="py-3.5 px-4 text-text-primary">Fajar Maulana</td>
                    </tr>
                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                        <td class="py-3.5 px-4 font-semibold text-text-primary">KT. Tani Subur</td>
                        <td class="py-3.5 px-4 text-text-primary">Pak Agus (0853xxx)</td>
                        <td class="py-3.5 px-4 text-text-primary">Desa Sampe / Rhee</td>
                        <td class="py-3.5 px-4 font-semibold text-text-primary">18 KK</td>
                        <td class="py-3.5 px-4 text-text-primary">Siti Rahmawati</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
