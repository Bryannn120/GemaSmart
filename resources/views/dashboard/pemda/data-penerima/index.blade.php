@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Data Penerima (CPCL)</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Calon KeluargaPenerima Calon Lokasi (CPCL) yang telah divalidasi dan ditetapkan sebagai penerima bantuan.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <a href="{{ route('pemda.data-penerima.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add</span>
                <span>Tambah Penerima</span>
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
                <span class="material-symbols-outlined text-[24px]">group</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Total Terdaftar</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $keluarga_penerimas->count() }} KK</span>
            </div>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-status-warning-surface flex items-center justify-center text-status-warning">
                <span class="material-symbols-outlined text-[24px]">pending_actions</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Menunggu Validasi</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $keluarga_penerimas->whereIn('status_validasi', ['menunggu_validasi', 'proses_lapangan'])->count() }} KK</span>
            </div>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-status-verified-surface flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-[24px]">verified_user</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Terverifikasi Valid</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $keluarga_penerimas->where('status_validasi', 'valid')->count() }} KK</span>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">NIK & Kepala Keluarga KK</th>
                        <th class="py-3 px-4 font-semibold">No. KK</th>
                        <th class="py-3 px-4 font-semibold">Wilayah</th>
                        <th class="py-3 px-4 font-semibold">Program Bantuan</th>
                        <th class="py-3 px-4 font-semibold">Status Validasi</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($keluarga_penerimas as $keluarga_penerima)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4">
                            <span class="font-semibold text-text-primary block">{{ $keluarga_penerima->kepala_keluarga }}</span>
                            <span class="text-text-tertiary font-code-dense text-[12px]">{{ $keluarga_penerima->nik }}</span>
                        </td>
                        <td class="py-3.5 px-4 text-text-primary">{{ $keluarga_penerima->no_kk ?? '-' }}</td>
                        <td class="py-3.5 px-4 text-text-primary">{{ $keluarga_penerima->wilayah->nama ?? '-' }}</td>
                        <td class="py-3.5 px-4 text-text-primary">{{ $keluarga_penerima->programBantuan->nama_program ?? '-' }}</td>
                        <td class="py-3.5 px-4">
                            @if ($keluarga_penerima->status_validasi == 'valid')
                                <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-verified-surface text-primary font-bold">Valid</span>
                            @elseif ($keluarga_penerima->status_validasi == 'anomali')
                                <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-fraud-surface text-status-fraud font-bold">Anomali</span>
                            @else
                                <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-warning-surface text-status-warning font-bold">Proses</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('pemda.data-penerima.show', $keluarga_penerima->id) }}" class="p-1.5 text-text-secondary hover:text-primary hover:bg-status-info-surface rounded-lg transition-colors" title="Lihat">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <a href="{{ route('pemda.data-penerima.edit', $keluarga_penerima->id) }}" class="p-1.5 text-text-secondary hover:text-primary hover:bg-status-verified-surface rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('pemda.data-penerima.destroy', $keluarga_penerima->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus penerima ini?');">
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
                            <p class="font-body-md">Belum ada data penerima.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
