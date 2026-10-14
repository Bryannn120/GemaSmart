@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Top Command & Action Bar -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <div class="flex items-center gap-2 mb-1">
                <a href="{{ route('pemda.program-bantuan.index') }}" class="text-text-secondary hover:text-primary transition-colors flex items-center gap-1 font-body-sm text-sm">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    <span>Kembali ke Daftar Program</span>
                </a>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">{{ $program->nama_program }}</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Rincian alokasi subsidi, daftar item bantuan (bibit, uang, barang), dan rekapitulasi penyaluran oleh pendamping lapangan.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-blue-50 text-blue-800 border border-blue-200">
                <span class="material-symbols-outlined text-[16px]">school</span>
                <span>Diterbitkan: {{ $program->kampusMitra->nama_kampus ?? 'Kampus Mitra' }}</span>
            </span>
        </div>
    </div>

    <!-- Summary KPI -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <div class="bg-canvas-bg rounded-xl p-space-md border border-border-light shadow-sm">
            <span class="text-xs text-text-tertiary block font-semibold uppercase">Pagu Anggaran</span>
            <span class="text-lg font-bold text-text-primary font-mono mt-1 block">Rp {{ number_format($program->pagu_anggaran, 0, ',', '.') }}</span>
            <span class="text-[11px] text-text-secondary">Tahun {{ $program->tahun_anggaran }}</span>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md border border-border-light shadow-sm">
            <span class="text-xs text-text-tertiary block font-semibold uppercase">Target Penerima</span>
            <span class="text-lg font-bold text-text-primary font-mono mt-1 block">{{ number_format($program->target_kk) }} KK</span>
            <span class="text-[11px] text-text-secondary">Keluarga Binaan</span>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md border border-border-light shadow-sm">
            <span class="text-xs text-text-tertiary block font-semibold uppercase">Item Bantuan Terdaftar</span>
            <span class="text-lg font-bold text-text-primary font-mono mt-1 block">{{ $program->itemBantuans->count() }} Item</span>
            <span class="text-[11px] text-text-secondary">Bibit, Uang & Barang</span>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md border border-border-light shadow-sm">
            <span class="text-xs text-text-tertiary block font-semibold uppercase">Total Penyaluran</span>
            <span class="text-lg font-bold text-primary font-mono mt-1 block">{{ $program->penyaluranBantuans->count() }} Transaksi</span>
            <span class="text-[11px] text-text-secondary">Oleh Kader Pendamping</span>
        </div>
    </div>

    <!-- Daftar Item Bantuan (Bibit, Uang, Barang) -->
    <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light p-space-lg flex flex-col gap-4">
        <div class="flex items-center justify-between pb-3 border-b border-border-light">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[24px]">inventory_2</span>
                <h3 class="font-bold text-text-primary text-base">Daftar Item Bantuan yang Disubsidikan</h3>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Kolom 1: Bantuan Bibit -->
            <div class="p-4 rounded-xl border border-border-light bg-surface-subtle flex flex-col gap-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-green-700 text-[20px]">eco</span>
                        <h4 class="font-bold text-text-primary text-sm">Bantuan Bibit</h4>
                    </div>
                    <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-green-100 text-green-800">
                        {{ $program->itemBantuans->where('jenis', 'bibit')->count() }} Item
                    </span>
                </div>
                <div class="flex flex-col gap-2">
                    @forelse ($program->itemBantuans->where('jenis', 'bibit') as $ib)
                        <div class="p-3 bg-white rounded-lg border border-border-light text-xs">
                            <span class="font-bold text-text-primary block">{{ $ib->nama_item }}</span>
                            <span class="text-text-secondary block mt-0.5">Alokasi: {{ number_format($ib->total_stok) }} {{ $ib->satuan }}</span>
                            @if($ib->deskripsi)
                                <p class="text-[11px] text-text-tertiary mt-1">{{ $ib->deskripsi }}</p>
                            @endif
                        </div>
                    @empty
                        <span class="text-xs text-text-tertiary italic">Tidak ada item bibit.</span>
                    @endforelse
                </div>
            </div>

            <!-- Kolom 2: Bantuan Uang Tunai -->
            <div class="p-4 rounded-xl border border-border-light bg-surface-subtle flex flex-col gap-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-amber-700 text-[20px]">payments</span>
                        <h4 class="font-bold text-text-primary text-sm">Bantuan Uang Tunai</h4>
                    </div>
                    <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-amber-100 text-amber-800">
                        {{ $program->itemBantuans->where('jenis', 'uang')->count() }} Item
                    </span>
                </div>
                <div class="flex flex-col gap-2">
                    @forelse ($program->itemBantuans->where('jenis', 'uang') as $iu)
                        <div class="p-3 bg-white rounded-lg border border-border-light text-xs">
                            <span class="font-bold text-text-primary block">{{ $iu->nama_item }}</span>
                            <span class="text-text-secondary block mt-0.5 font-mono">Nominal Standar: Rp {{ number_format($iu->nominal_satuan, 0, ',', '.') }}</span>
                            @if($iu->deskripsi)
                                <p class="text-[11px] text-text-tertiary mt-1">Peruntukan: {{ $iu->deskripsi }}</p>
                            @endif
                        </div>
                    @empty
                        <span class="text-xs text-text-tertiary italic">Tidak ada item bantuan uang.</span>
                    @endforelse
                </div>
            </div>

            <!-- Kolom 3: Bantuan Barang / Alat -->
            <div class="p-4 rounded-xl border border-border-light bg-surface-subtle flex flex-col gap-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-700 text-[20px]">precision_manufacturing</span>
                        <h4 class="font-bold text-text-primary text-sm">Bantuan Barang & Alat</h4>
                    </div>
                    <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-blue-100 text-blue-800">
                        {{ $program->itemBantuans->where('jenis', 'barang')->count() }} Item
                    </span>
                </div>
                <div class="flex flex-col gap-2">
                    @forelse ($program->itemBantuans->where('jenis', 'barang') as $iba)
                        <div class="p-3 bg-white rounded-lg border border-border-light text-xs">
                            <span class="font-bold text-text-primary block">{{ $iba->nama_item }}</span>
                            <span class="text-text-secondary block mt-0.5">Alokasi: {{ number_format($iba->total_stok) }} {{ $iba->satuan }}</span>
                            @if($iba->deskripsi)
                                <p class="text-[11px] text-text-tertiary mt-1">{{ $iba->deskripsi }}</p>
                            @endif
                        </div>
                    @empty
                        <span class="text-xs text-text-tertiary italic">Tidak ada item bantuan barang/alat.</span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
