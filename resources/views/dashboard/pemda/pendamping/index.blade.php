@extends('layouts.pemda')

@section('content')
<div class="flex flex-col gap-space-md">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="font-headline-lg text-headline-lg font-bold text-text-primary">Data Pendamping</h1>
            <p class="font-body-md text-body-md text-text-secondary mt-1">Kelola data akun Pendamping Lapangan.</p>
        </div>
        <div class="flex items-center gap-space-sm w-full md:w-auto">
            <a href="{{ route('pemda.pendamping.create') }}" class="flex-1 md:flex-none flex items-center justify-center gap-2 bg-primary text-on-primary px-space-md py-space-sm rounded-lg hover:bg-primary-container transition-colors shadow-sm font-label-lg text-label-lg font-semibold">
                <span class="material-symbols-outlined text-[20px]">add</span>
                <span>Tambah Pendamping</span>
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-canvas-bg p-space-md rounded-xl shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-full bg-status-info-surface text-status-info flex items-center justify-center">
                <span class="material-symbols-outlined text-[24px]">support_agent</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Total Pendamping</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $pendampings->count() }}</span>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Nama</th>
                        <th class="py-3 px-4 font-semibold">Email</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($pendampings as $p)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4 font-semibold text-text-primary">{{ $p->name }}</td>
                        <td class="py-3.5 px-4 text-text-primary">{{ $p->email }}</td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('pemda.pendamping.show', $p->id) }}" class="p-1.5 text-text-secondary hover:text-primary hover:bg-status-info-surface rounded-lg transition-colors" title="Lihat">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <a href="{{ route('pemda.pendamping.edit', $p->id) }}" class="p-1.5 text-text-secondary hover:text-primary hover:bg-status-verified-surface rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('pemda.pendamping.destroy', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pendamping ini?');">
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
                        <td colspan="3" class="py-8 text-center text-text-secondary">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[48px] text-border-medium">person_off</span>
                                <p>Belum ada data pendamping.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
