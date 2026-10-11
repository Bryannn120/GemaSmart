@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Kampus Mitra</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Kelola universitas yang bekerja sama dalam pengerahan mahasiswa pendamping.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <a href="{{ route('pemda.kampus-mitra.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add</span>
                <span>Tambah Kampus</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20">
            {{ session('success') }}
        </div>
    @endif

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-lg">
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-primary-fixed flex items-center justify-center text-on-primary-fixed-variant">
                <span class="material-symbols-outlined text-[24px]">school</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Total Kampus Mitra</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $kampusMitras->count() }} Universitas</span>
            </div>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-status-verified-surface flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-[24px]">workspace_premium</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">MoU Aktif</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $kampusMitras->where('status_mou', 'aktif')->count() }} MoU Aktif</span>
            </div>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-status-warning-surface flex items-center justify-center text-status-warning">
                <span class="material-symbols-outlined text-[24px]">warning</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">MoU Tidak Aktif</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $kampusMitras->where('status_mou', 'tidak_aktif')->count() }}</span>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Nama Universitas</th>
                        <th class="py-3 px-4 font-semibold">PIC / Koordinator</th>
                        <th class="py-3 px-4 font-semibold">Wilayah Binaan</th>
                        <th class="py-3 px-4 font-semibold">MoU Berlaku s/d</th>
                        <th class="py-3 px-4 font-semibold">Status MoU</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($kampusMitras as $km)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4 font-semibold text-text-primary">{{ $km->nama_universitas }}</td>
                        <td class="py-3.5 px-4">{{ $km->pic_name }}<br/><span class="text-text-tertiary">{{ $km->pic_contact }}</span></td>
                        <td class="py-3.5 px-4 text-text-primary">{{ $km->wilayah_binaan ?? '-' }}</td>
                        <td class="py-3.5 px-4 text-text-primary">{{ $km->mou_berlaku_sampai ? \Carbon\Carbon::parse($km->mou_berlaku_sampai)->format('d M Y') : '-' }}</td>
                        <td class="py-3.5 px-4">
                            @if ($km->status_mou == 'aktif')
                                <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-verified-surface text-primary font-bold">Aktif</span>
                            @else
                                <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-warning-surface text-status-warning font-bold">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('pemda.kampus-mitra.show', $km->id) }}" class="p-1.5 text-text-secondary hover:text-primary hover:bg-status-info-surface rounded-lg transition-colors" title="Lihat">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <a href="{{ route('pemda.kampus-mitra.edit', $km->id) }}" class="p-1.5 text-text-secondary hover:text-primary hover:bg-status-verified-surface rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('pemda.kampus-mitra.destroy', $km->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kampus mitra ini?');">
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
                            <p class="font-body-md">Belum ada data kampus mitra.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="flex items-center justify-between p-space-md border-t border-border-light bg-surface-subtle">
            <span class="text-text-secondary font-body-sm text-body-sm">Menampilkan <strong>{{ $kampusMitras->count() }}</strong> data kampus mitra</span>
        </div>
    </div>
</div>
@endsection
