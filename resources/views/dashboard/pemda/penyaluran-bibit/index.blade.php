@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <div class="flex items-center gap-space-sm mb-space-xs">
                <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
                    <span class="material-symbols-outlined text-[14px] mr-1">local_shipping</span>
                    LOGISTIK DAERAH
                </span>
                <span class="text-text-tertiary text-body-sm font-body-sm">Pemantauan Pengiriman Wilayah</span>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Monitoring Penyaluran Bibit</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Monitor status pengiriman dan Berita Acara Serah Terima (BAST) bibit ke wilayah desa/kecamatan di Kabupaten Sumbawa.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-blue-50 text-blue-800 border border-blue-200 font-label-md text-xs font-bold shadow-sm">
                <span class="material-symbols-outlined text-[18px]">verified</span>
                <span>Monitoring Terpusat</span>
            </span>
        </div>
    </div>

    @if(session('info'))
        <div class="bg-blue-50 text-blue-800 p-space-md rounded-xl font-body-sm border border-blue-200 flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px]">info</span>
            <span>{{ session('info') }}</span>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20 flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">No BAST / Tgl Kirim</th>
                        <th class="py-3 px-4 font-semibold">Tujuan (Kecamatan/Desa)</th>
                        <th class="py-3 px-4 font-semibold">Jenis Bibit</th>
                        <th class="py-3 px-4 font-semibold">Kuantitas</th>
                        <th class="py-3 px-4 font-semibold">Status Pengiriman</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($penyalurans as $penyaluran)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4">
                            <span class="font-semibold font-code-dense text-text-primary block">{{ $penyaluran->nomor_bast }}</span>
                            <span class="text-text-tertiary text-xs">{{ \Carbon\Carbon::parse($penyaluran->tgl_kirim)->format('d M Y') }}</span>
                        </td>
                        <td class="py-3.5 px-4 text-text-primary font-medium">{{ $penyaluran->wilayah->nama ?? '-' }}</td>
                        <td class="py-3.5 px-4 text-text-primary">{{ $penyaluran->jenisBibit->nama_varian ?? '-' }}</td>
                        <td class="py-3.5 px-4 font-bold text-text-primary">{{ number_format($penyaluran->kuantitas, 0, ',', '.') }} {{ $penyaluran->jenisBibit->satuan ?? '' }}</td>
                        <td class="py-3.5 px-4">
                            @if ($penyaluran->status == 'diterima')
                                <span class="inline-flex items-center gap-1 px-space-sm py-1 rounded-full text-label-sm bg-status-verified-surface text-primary font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                                    Diterima
                                </span>
                            @elseif ($penyaluran->status == 'dikirim')
                                <span class="inline-flex items-center gap-1 px-space-sm py-1 rounded-full text-label-sm bg-status-info-surface text-status-info font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-status-info"></span>
                                    Sedang Dikirim
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-space-sm py-1 rounded-full text-label-sm bg-status-warning-surface text-status-warning font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-status-warning"></span>
                                    Disiapkan
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-text-secondary">
                            <span class="material-symbols-outlined text-[48px] text-border-medium mb-2 block">inbox</span>
                            <p class="font-body-md">Belum ada data penyaluran logistik bibit.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
