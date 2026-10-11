@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Penyaluran Bibit</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Monitor status pengiriman dan Berita Acara Serah Terima (BAST) bibit ke keluarga penerima bantuan.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <a href="{{ route('pemda.penyaluran-bibit.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add</span>
                <span>Buat BAST Baru</span>
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
                        <th class="py-3 px-4 font-semibold">No BAST / Tgl Kirim</th>
                        <th class="py-3 px-4 font-semibold">Tujuan (Kecamatan/Desa)</th>
                        <th class="py-3 px-4 font-semibold">Jenis Bibit</th>
                        <th class="py-3 px-4 font-semibold">Kuantitas</th>
                        <th class="py-3 px-4 font-semibold">Status</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($penyalurans as $penyaluran)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4">
                            <span class="font-semibold font-code-dense text-text-primary block">{{ $penyaluran->nomor_bast }}</span>
                            <span class="text-text-tertiary">{{ \Carbon\Carbon::parse($penyaluran->tgl_kirim)->format('d M Y') }}</span>
                        </td>
                        <td class="py-3.5 px-4 text-text-primary">{{ $penyaluran->wilayah->nama ?? '-' }}</td>
                        <td class="py-3.5 px-4 text-text-primary">{{ $penyaluran->jenisBibit->nama_varian ?? '-' }}</td>
                        <td class="py-3.5 px-4 font-medium text-text-primary">{{ number_format($penyaluran->kuantitas, 0, ',', '.') }} {{ $penyaluran->jenisBibit->satuan ?? '' }}</td>
                        <td class="py-3.5 px-4">
                            @if ($penyaluran->status == 'diterima')
                                <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-verified-surface text-primary font-bold">Diterima</span>
                            @elseif ($penyaluran->status == 'dikirim')
                                <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-info-surface text-status-info font-bold">Sedang Dikirim</span>
                            @else
                                <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-warning-surface text-status-warning font-bold">Disiapkan</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('pemda.penyaluran-bibit.edit', $penyaluran->id) }}" class="p-1.5 text-text-secondary hover:text-primary hover:bg-status-verified-surface rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('pemda.penyaluran-bibit.destroy', $penyaluran->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus penyaluran ini?');">
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
                            <p class="font-body-md">Belum ada data penyaluran bibit.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
