@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Master Data: Wilayah</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Kelola data wilayah kecamatan dan desa/kelurahan di Kabupaten Sumbawa.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <a href="{{ route('pemda.master-data.wilayah.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add</span>
                <span>Tambah Wilayah</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Kode Wilayah</th>
                        <th class="py-3 px-4 font-semibold">Nama Wilayah</th>
                        <th class="py-3 px-4 font-semibold">Tingkat</th>
                        <th class="py-3 px-4 font-semibold">Parent / Induk</th>
                        <th class="py-3 px-4 font-semibold">Status</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($wilayahs as $wilayah)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4 font-code-dense text-text-primary">{{ $wilayah->kode_wilayah }}</td>
                        <td class="py-3.5 px-4 font-semibold text-text-primary">{{ $wilayah->nama }}</td>
                        <td class="py-3.5 px-4 capitalize text-text-primary">{{ $wilayah->jenis }}</td>
                        <td class="py-3.5 px-4 text-text-primary">{{ $wilayah->parent->nama ?? '-' }}</td>
                        <td class="py-3.5 px-4">
                            @if ($wilayah->is_aktif)
                                <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-verified-surface text-primary font-bold">Aktif</span>
                            @else
                                <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-surface-variant text-text-secondary font-bold">Non-aktif</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('pemda.master-data.wilayah.edit', $wilayah->id) }}" class="p-1.5 text-text-secondary hover:text-primary hover:bg-status-verified-surface rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('pemda.master-data.wilayah.destroy', $wilayah->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus wilayah ini?');">
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
                            <span class="material-symbols-outlined text-[48px] text-border-medium mb-2 block">location_off</span>
                            <p class="font-body-md">Belum ada data wilayah.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
