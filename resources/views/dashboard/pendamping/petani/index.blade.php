@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Keluarga Penerima Bantuan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Daftar kelompok tani dan nomor kontak yang menjadi tanggung jawab pendampingan Anda di lapangan.
            </p>
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
                        <th class="py-3 px-4 font-semibold">Desa / Dusun</th>
                        <th class="py-3 px-4 font-semibold">Komoditas Binaan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light">
                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                        <td class="py-3.5 px-4 font-semibold text-text-primary">KT. Mekar Jaya</td>
                        <td class="py-3.5 px-4 text-text-primary">Pak Burhan<br><span class="text-text-tertiary">08123456789</span></td>
                        <td class="py-3.5 px-4 text-text-primary">Desa Motong</td>
                        <td class="py-3.5 px-4"><span class="inline-flex px-2 py-1 rounded bg-secondary-container text-on-secondary-container text-[11px] font-bold">Jagung Hibrida</span></td>
                    </tr>
                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                        <td class="py-3.5 px-4 font-semibold text-text-primary">KT. Tani Mandiri</td>
                        <td class="py-3.5 px-4 text-text-primary">Pak Hasan<br><span class="text-text-tertiary">08523344556</span></td>
                        <td class="py-3.5 px-4 text-text-primary">Desa Motong, Dusun Timur</td>
                        <td class="py-3.5 px-4"><span class="inline-flex px-2 py-1 rounded bg-primary-container text-on-primary-container text-[11px] font-bold">Padi Ciherang</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
