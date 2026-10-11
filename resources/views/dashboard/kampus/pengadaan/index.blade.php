@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Pengadaan & SPJ</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Kelola Surat Pertanggungjawaban (SPJ) pengadaan barang dan operasional.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <a href="{{ route('kampus.pengadaan.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add</span>
                <span>Buat SPJ Baru</span>
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
                        <th class="py-3 px-4 font-semibold">Nomor SPJ</th>
                        <th class="py-3 px-4 font-semibold">Tgl Pengajuan</th>
                        <th class="py-3 px-4 font-semibold">Uraian / Deskripsi</th>
                        <th class="py-3 px-4 font-semibold">Nominal (Rp)</th>
                        <th class="py-3 px-4 font-semibold">Status</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($spjs as $spj)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4 font-code-dense font-semibold text-text-primary">{{ $spj->nomor_spj }}</td>
                        <td class="py-3.5 px-4 text-text-primary">{{ \Carbon\Carbon::parse($spj->tgl_pengajuan)->format('d M Y') }}</td>
                        <td class="py-3.5 px-4 text-text-primary truncate max-w-[200px]" title="{{ $spj->uraian }}">{{ Str::limit($spj->uraian, 50) }}</td>
                        <td class="py-3.5 px-4 font-medium text-text-primary">{{ number_format($spj->nominal, 0, ',', '.') }}</td>
                        <td class="py-3.5 px-4">
                            @if ($spj->status == 'disetujui')
                                <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-verified-surface text-primary font-bold">Disetujui</span>
                            @elseif ($spj->status == 'ditolak')
                                <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-fraud-surface text-status-fraud font-bold">Ditolak</span>
                            @elseif ($spj->status == 'review')
                                <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-warning-surface text-status-warning font-bold">Sedang Direview</span>
                            @else
                                <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-surface-variant text-text-secondary font-bold">Diajukan</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('kampus.pengadaan.edit', $spj->id) }}" class="p-1.5 text-text-secondary hover:text-primary hover:bg-status-verified-surface rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('kampus.pengadaan.destroy', $spj->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus SPJ ini?');">
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
                            <span class="material-symbols-outlined text-[48px] text-border-medium mb-2 block">receipt_long</span>
                            <p class="font-body-md">Belum ada data pengajuan SPJ.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
