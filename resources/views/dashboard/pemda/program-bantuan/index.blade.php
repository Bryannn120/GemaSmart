@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Top Command & Action Bar -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <div class="flex items-center gap-space-sm mb-space-xs">
                <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
                    <span class="material-symbols-outlined text-[14px] mr-1">folder_open</span>
                    DATA MASTER
                </span>
                <span class="text-text-tertiary text-body-sm font-body-sm">Kelola Program Bantuan</span>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Program Bantuan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Manajemen daftar program bantuan bibit dan alokasi anggaran tahunan.
            </p>
        </div>
        <!-- Controls -->
        <div class="flex flex-wrap items-center gap-space-sm">
            <a href="{{ route('pemda.program-bantuan.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add</span>
                <span>Tambah Program</span>
            </a>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-lg">
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
                <span class="font-label-md text-label-md text-text-secondary">Total Anggaran (Aktif)</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">Rp {{ number_format($programs->where('status', 'aktif')->sum('pagu_anggaran'), 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Data Table Section -->
    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm p-space-md border-b border-border-light bg-surface-subtle">
            <div class="relative w-full sm:w-72">
                <input class="w-full font-body-sm text-body-sm pl-9 pr-3 py-2 rounded-lg bg-canvas-bg border border-border-medium text-text-primary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary shadow-sm" placeholder="Cari program..." type="text"/>
                <span class="material-symbols-outlined absolute left-2.5 top-2 text-text-secondary text-[20px]">search</span>
            </div>
            <div class="flex items-center gap-space-sm">
                <div class="relative bg-canvas-bg border border-border-medium rounded-lg shadow-sm">
                    <select class="appearance-none font-label-sm text-label-sm text-text-primary bg-transparent pl-space-md pr-8 py-2 cursor-pointer focus:outline-none focus:border-primary rounded-lg">
                        <option>Semua Status</option>
                        <option>Aktif</option>
                        <option>Draf</option>
                        <option>Selesai</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-2 top-2 text-text-secondary text-[18px] pointer-events-none">expand_more</span>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Nama Program</th>
                        <th class="py-3 px-4 font-semibold">Pagu Anggaran</th>
                        <th class="py-3 px-4 font-semibold">Target (KK)</th>
                        <th class="py-3 px-4 font-semibold">Tahun</th>
                        <th class="py-3 px-4 font-semibold">Status</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($programs as $program)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4">
                            <div class="flex flex-col">
                                <span class="font-semibold text-text-primary text-body-md">{{ $program->nama_program }}</span>
                                <span class="text-text-tertiary text-body-sm truncate max-w-xs" title="{{ $program->deskripsi }}">{{ Str::limit($program->deskripsi, 50) }}</span>
                            </div>
                        </td>
                        <td class="py-3.5 px-4 font-code-dense text-text-primary">
                            Rp {{ number_format($program->pagu_anggaran, 0, ',', '.') }}
                        </td>
                        <td class="py-3.5 px-4 font-code-dense text-text-primary">
                            {{ number_format($program->target_kk, 0, ',', '.') }} KK
                        </td>
                        <td class="py-3.5 px-4 text-text-primary font-medium">
                            {{ $program->tahun_anggaran }}
                        </td>
                        <td class="py-3.5 px-4">
                            @if ($program->status == 'aktif')
                                <span class="inline-flex items-center gap-1 px-space-sm py-1 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-status-verified"></span> Aktif
                                </span>
                            @elseif ($program->status == 'draf')
                                <span class="inline-flex items-center gap-1 px-space-sm py-1 rounded-full font-label-sm text-label-sm bg-surface-variant text-text-secondary font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-text-tertiary"></span> Draf
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-space-sm py-1 rounded-full font-label-sm text-label-sm bg-status-info-surface text-status-info font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-status-info"></span> Selesai
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('pemda.program-bantuan.edit', $program->id) }}" class="p-1.5 text-text-secondary hover:text-primary hover:bg-status-verified-surface rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('pemda.program-bantuan.destroy', $program->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus program ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-text-secondary hover:text-error hover:bg-status-fraud-surface rounded-lg transition-colors" title="Hapus">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-text-secondary">
                            <span class="material-symbols-outlined text-[48px] text-border-medium mb-2 block">inbox</span>
                            <p class="font-body-md">Belum ada data program bantuan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Footer / Pagination -->
        <div class="flex items-center justify-between p-space-md border-t border-border-light bg-surface-subtle">
            <span class="text-text-secondary font-body-sm text-body-sm">Menampilkan <strong>{{ $programs->count() }}</strong> data program</span>
        </div>
    </div>
</div>
@endsection
