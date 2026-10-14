@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Top Command & Action Bar -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <div class="flex items-center gap-space-sm mb-space-xs">
                <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
                    <span class="material-symbols-outlined text-[14px] mr-1">folder_open</span>
                    MONITORING PROGRAM
                </span>
                <span class="text-text-tertiary text-body-sm font-body-sm">Pemberdayaan & Subsidi Masyarakat</span>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Program Bantuan Daerah</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Daftar program bantuan subsidi (bibit, uang, atau barang) yang dirancang dan diterbitkan oleh Kampus Mitra untuk pengentasan kemiskinan di Kabupaten Sumbawa.
            </p>
        </div>
        <!-- Controls -->
        <div class="flex flex-wrap items-center gap-space-sm">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-blue-50 text-blue-800 border border-blue-200 font-label-md text-xs font-bold shadow-sm">
                <span class="material-symbols-outlined text-[18px]">school</span>
                <span>Wewenang Pembuatan: Kampus Mitra</span>
            </span>
        </div>
    </div>

    @if(session('info'))
        <div class="bg-blue-50 text-blue-800 p-space-md rounded-xl font-body-sm border border-blue-200 flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px]">info</span>
            <span>{{ session('info') }}</span>
        </div>
    @endif

    <!-- Info Banner -->
    <div class="bg-surface-subtle p-space-md rounded-2xl border border-border-light flex items-center gap-3 shadow-sm">
        <div class="w-10 h-10 rounded-xl bg-gov-green-surface text-primary flex items-center justify-center shrink-0">
            <span class="material-symbols-outlined text-[22px]">policy</span>
        </div>
        <div class="flex flex-col text-xs text-text-secondary">
            <span class="font-bold text-text-primary text-sm">Transparansi Kebijakan Bantuan</span>
            <span>Program bantuan, pagu anggaran, serta penentuan jenis subsidi bantuan (bibit tanaman, bantuan uang tunai, atau alat/barang) dibuat langsung oleh pihak Kampus Mitra. Pemda bertindak sebagai pengawas dan monitoring daerah.</span>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-space-lg">
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-primary-fixed flex items-center justify-center text-on-primary-fixed-variant">
                <span class="material-symbols-outlined text-[24px]">folder</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Total Program</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $programs->count() }}</span>
            </div>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-status-verified-surface flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-[24px]">check_circle</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Program Aktif</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $programs->where('status', 'aktif')->count() }}</span>
            </div>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-gold-surface flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined text-[24px]">account_balance_wallet</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Total Pagu Anggaran</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">Rp {{ number_format($programs->where('status', 'aktif')->sum('pagu_anggaran'), 0, ',', '.') }}</span>
            </div>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-800">
                <span class="material-symbols-outlined text-[24px]">inventory_2</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Total Item Bantuan</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $programs->sum('item_bantuans_count') }} Item</span>
            </div>
        </div>
    </div>

    <!-- Data Table Section -->
    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Nama Program</th>
                        <th class="py-3 px-4 font-semibold">Kampus Penerbit</th>
                        <th class="py-3 px-4 font-semibold">Pagu & Target</th>
                        <th class="py-3 px-4 font-semibold">Bentuk Subsidi</th>
                        <th class="py-3 px-4 font-semibold">Status</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($programs as $program)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4">
                            <span class="font-bold text-text-primary block">{{ $program->nama_program }}</span>
                            <span class="text-text-tertiary text-xs">Tahun Anggaran {{ $program->tahun_anggaran }}</span>
                        </td>
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-1.5 font-medium text-text-primary text-xs">
                                <span class="material-symbols-outlined text-[16px] text-primary">school</span>
                                <span>{{ $program->kampusMitra->nama_kampus ?? 'Kampus Mitra Sumbawa' }}</span>
                            </div>
                        </td>
                        <td class="py-3.5 px-4 font-mono text-xs">
                            <span class="font-bold text-text-primary block">Rp {{ number_format($program->pagu_anggaran, 0, ',', '.') }}</span>
                            <span class="text-text-tertiary font-sans">Target: {{ number_format($program->target_kk) }} KK</span>
                        </td>
                        <td class="py-3.5 px-4">
                            <div class="flex flex-wrap gap-1">
                                <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-green-100 text-green-800">
                                    Bibit
                                </span>
                                <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-amber-100 text-amber-800">
                                    Uang Tunai
                                </span>
                                <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-blue-100 text-blue-800">
                                    Alat/Barang
                                </span>
                            </div>
                            <span class="text-[11px] text-text-tertiary mt-1 block">{{ $program->item_bantuans_count ?? $program->itemBantuans->count() }} item bantuan terdaftar</span>
                        </td>
                        <td class="py-3.5 px-4">
                            @if ($program->status == 'aktif')
                                <span class="inline-flex items-center gap-1 px-space-sm py-1 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary"></span> Aktif
                                </span>
                            @elseif ($program->status == 'draf')
                                <span class="inline-flex items-center gap-1 px-space-sm py-1 rounded-full font-label-sm text-label-sm bg-status-warning-surface text-status-warning font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-status-warning"></span> Draf
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-space-sm py-1 rounded-full font-label-sm text-label-sm bg-status-info-surface text-status-info font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-status-info"></span> Selesai
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <a href="{{ route('pemda.program-bantuan.show', $program->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-surface-container-high hover:bg-surface-container-highest text-text-primary text-xs font-semibold transition-colors border border-border-light shadow-sm">
                                <span class="material-symbols-outlined text-[16px]">visibility</span>
                                <span>Detail & Item</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-text-secondary">
                            <span class="material-symbols-outlined text-[48px] text-border-medium mb-2 block">folder_off</span>
                            <p class="font-body-md font-medium">Belum ada program bantuan yang diterbitkan oleh Kampus Mitra.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Footer -->
        <div class="flex items-center justify-between p-space-md border-t border-border-light bg-surface-subtle">
            <span class="text-text-secondary font-body-sm text-body-sm">Total <strong>{{ $programs->count() }}</strong> program bantuan terdaftar</span>
        </div>
    </div>
</div>
@endsection
