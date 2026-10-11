@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Penyaluran Bibit Kampus</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Lacak pengiriman bibit dari pihak kampus ke gudang desa atau langsung ke keluarga penerima bantuan.
            </p>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-container-low text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">BAST Pengiriman</th>
                        <th class="py-3 px-4 font-semibold">Tujuan Penerima</th>
                        <th class="py-3 px-4 font-semibold">Bibit & Kuantitas</th>
                        <th class="py-3 px-4 font-semibold">Tanggal Kirim</th>
                        <th class="py-3 px-4 font-semibold">Status Diterima</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light">
                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                        <td class="py-3.5 px-4 font-code-dense font-semibold text-text-primary">BAST/UTS/02/001</td>
                        <td class="py-3.5 px-4 text-text-primary">Keluarga Penerima (Desa Motong)</td>
                        <td class="py-3.5 px-4 text-text-primary">Jagung Bisi-18 - 500 Zak</td>
                        <td class="py-3.5 px-4 text-text-primary">15 Feb 2026</td>
                        <td class="py-3.5 px-4"><span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-verified-surface text-status-verified font-bold">Diterima Warga</span></td>
                    </tr>
                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                        <td class="py-3.5 px-4 font-code-dense font-semibold text-text-primary">BAST/UTS/02/002</td>
                        <td class="py-3.5 px-4 text-text-primary">Keluarga Penerima (Desa Sampe)</td>
                        <td class="py-3.5 px-4 text-text-primary">Padi Ciherang - 300 Karung</td>
                        <td class="py-3.5 px-4 text-text-primary">16 Feb 2026</td>
                        <td class="py-3.5 px-4"><span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-warning-surface text-status-warning font-bold">Proses Kirim</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
