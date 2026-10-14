@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <div class="flex items-center gap-space-sm mb-space-xs">
                <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-gov-green-surface text-primary font-bold">
                    <span class="material-symbols-outlined text-[14px] mr-1">school</span>
                    WEWENANG KAMPUS MITRA
                </span>
                <span class="text-text-tertiary text-body-sm font-body-sm">Penerbitan & Desain Subsidi Program</span>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Program Bantuan Kampus</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Rancang dan kelola program bantuan subsidi (bibit tanaman produktif, dana modal uang tunai, atau alat/barang) untuk disalurkan oleh kader pendamping lapangan.
            </p>
        </div>
        <!-- Controls -->
        <div class="flex flex-wrap items-center gap-space-sm">
            <a href="{{ route('kampus.program-bantuan.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2.5 rounded-xl bg-primary text-on-primary font-label-md text-label-md font-bold hover:bg-gov-green-dark transition-all shadow-md hover:shadow-lg">
                <span class="material-symbols-outlined text-[18px]">add</span>
                <span>+ Buat Program Bantuan Baru</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20 flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-lg">
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-primary-fixed flex items-center justify-center text-on-primary-fixed-variant">
                <span class="material-symbols-outlined text-[24px]">folder</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Total Program</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $totalPrograms }}</span>
            </div>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-gold-surface flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined text-[24px]">account_balance_wallet</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Total Pagu Anggaran</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">Rp {{ number_format($totalPagu, 0, ',', '.') }}</span>
            </div>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-800">
                <span class="material-symbols-outlined text-[24px]">category</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Item Subsidi (Bibit/Uang/Alat)</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $totalItemBantuan }} Jenis</span>
            </div>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-status-verified-surface flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-[24px]">volunteer_activism</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Total Disalurkan</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $totalPenyaluran }} Paket</span>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Nama Program</th>
                        <th class="py-3 px-4 font-semibold">Tahun & Pagu</th>
                        <th class="py-3 px-4 font-semibold">Target KK</th>
                        <th class="py-3 px-4 font-semibold">Rincian Subsidi Item</th>
                        <th class="py-3 px-4 font-semibold">Status</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($programs as $program)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4 font-semibold text-text-primary">
                            <a href="{{ route('kampus.program-bantuan.show', $program->id) }}" class="hover:text-primary transition-colors flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-gov-green-surface text-primary flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[18px]">inventory_2</span>
                                </div>
                                <span class="text-sm font-bold">{{ $program->nama_program }}</span>
                            </a>
                            <p class="text-text-tertiary text-xs mt-0.5 line-clamp-1 pl-10">{{ $program->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="font-bold font-mono text-text-primary block">Rp {{ number_format($program->pagu_anggaran, 0, ',', '.') }}</span>
                            <span class="text-text-tertiary text-xs">Tahun {{ $program->tahun_anggaran }}</span>
                        </td>
                        <td class="py-3.5 px-4 font-mono text-xs">
                            <span class="font-bold text-text-primary">{{ number_format($program->target_kk) }} KK</span>
                            <span class="text-text-tertiary block font-sans">Keluarga Sasaran</span>
                        </td>
                        <td class="py-3.5 px-4">
                            <div class="flex flex-wrap gap-1">
                                <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-green-100 text-green-800">
                                    {{ $program->itemBantuans->where('jenis', 'bibit')->count() }} Bibit
                                </span>
                                <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-amber-100 text-amber-800">
                                    {{ $program->itemBantuans->where('jenis', 'uang')->count() }} Uang
                                </span>
                                <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-blue-100 text-blue-800">
                                    {{ $program->itemBantuans->where('jenis', 'barang')->count() }} Alat
                                </span>
                            </div>
                            <span class="text-text-tertiary text-[11px] block mt-1">Total: {{ $program->item_bantuans_count ?? $program->itemBantuans->count() }} item</span>
                        </td>
                        <td class="py-3.5 px-4">
                            @if ($program->status == 'aktif')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-status-verified-surface text-primary border border-primary/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary"></span> Aktif
                                </span>
                            @elseif ($program->status == 'draf')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-status-warning-surface text-status-warning border border-status-warning/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-status-warning"></span> Draf
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-status-info-surface text-status-info border border-status-info/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-status-info"></span> Selesai
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5">
                                <a href="{{ route('kampus.program-bantuan.show', $program->id) }}" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-gov-green-surface hover:bg-gov-green text-primary hover:text-white font-label-md text-xs font-semibold transition-colors border border-primary/20" title="Kelola Item Bantuan">
                                    <span class="material-symbols-outlined text-[15px]">list_alt</span>
                                    <span>Kelola Item</span>
                                </a>
                                <a href="{{ route('kampus.program-bantuan.edit', $program->id) }}" class="inline-flex items-center gap-1 px-2 py-1.5 rounded-lg bg-surface-container-high hover:bg-surface-container-highest text-text-secondary hover:text-text-primary text-xs font-semibold transition-colors border border-border-light" title="Edit Program">
                                    <span class="material-symbols-outlined text-[15px]">edit</span>
                                </a>
                                <form action="{{ route('kampus.program-bantuan.destroy', $program->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus program bantuan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-2 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 font-label-md text-xs font-semibold transition-colors border border-red-200" title="Hapus Program">
                                        <span class="material-symbols-outlined text-[15px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-text-secondary">
                            <span class="material-symbols-outlined text-4xl mb-2 text-text-tertiary block">folder_off</span>
                            <p class="font-body-md font-medium">Belum ada program bantuan yang dibuat oleh Kampus.</p>
                            <a href="{{ route('kampus.program-bantuan.create') }}" class="inline-flex items-center gap-1 mt-3 px-4 py-2 rounded-xl bg-primary text-white text-xs font-bold hover:bg-gov-green-dark transition-colors shadow-sm">
                                <span class="material-symbols-outlined text-[16px]">add</span>
                                <span>Buat Program Sekarang</span>
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
