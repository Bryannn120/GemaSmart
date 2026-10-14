@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Penyaluran Bantuan Lapangan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Monitoring penyaluran item bantuan (bibit, uang usaha, barang/alat) dari program kampus yang didistribusikan oleh kader pendamping kepada keluarga penerima.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1 bg-gov-green-surface text-primary font-semibold text-xs rounded-full">
                Total: {{ $penyalurans->total() }} Penyaluran Terlaksana
            </span>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-container-low text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Tgl Penyaluran</th>
                        <th class="py-3 px-4 font-semibold">Keluarga Penerima</th>
                        <th class="py-3 px-4 font-semibold">Program & Item Bantuan</th>
                        <th class="py-3 px-4 font-semibold">Jenis / Jumlah Diterima</th>
                        <th class="py-3 px-4 font-semibold">Pendamping Penyalur</th>
                        <th class="py-3 px-4 font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light">
                    @forelse($penyalurans as $pen)
                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                        <td class="py-3.5 px-4 font-code-dense font-medium text-text-secondary whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($pen->tgl_penyaluran)->format('d M Y') }}
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="font-semibold text-text-primary block">{{ $pen->keluargaPenerima->kepala_keluarga ?? $pen->keluargaPenerima->nama ?? 'Penerima' }}</span>
                            <span class="text-xs text-text-tertiary">Desa {{ $pen->keluargaPenerima->wilayah->nama ?? '-' }}</span>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="font-medium text-text-primary block">{{ $pen->itemBantuan->nama_item ?? '-' }}</span>
                            <span class="text-xs text-primary font-medium">{{ $pen->programBantuan->nama_program ?? '-' }}</span>
                        </td>
                        <td class="py-3.5 px-4">
                            @if($pen->jenis === 'uang')
                                <span class="font-bold text-emerald-600 block">Rp {{ number_format($pen->nominal_uang, 0, ',', '.') }}</span>
                                <span class="text-xs text-text-tertiary">Peruntukan: {{ $pen->peruntukan ?? '-' }}</span>
                            @elseif($pen->jenis === 'barang')
                                <span class="font-bold text-amber-700 block">{{ number_format($pen->jumlah, 0) }} {{ $pen->satuan }}</span>
                                <span class="text-xs text-text-tertiary">Alat / Fasilitas</span>
                            @else
                                <span class="font-bold text-gov-green-dark block">{{ number_format($pen->jumlah, 0) }} {{ $pen->satuan }}</span>
                                <span class="text-xs text-text-tertiary">Bibit Pertanian</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-text-secondary">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px] text-text-tertiary">person</span>
                                <span>{{ $pen->pendamping->name ?? 'Kader Lapangan' }}</span>
                            </div>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="inline-flex px-2 py-0.5 rounded-full text-xs bg-status-verified-surface text-primary font-bold">
                                {{ ucfirst($pen->status ?? 'Tersalurkan') }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-text-tertiary">
                            Belum ada riwayat penyaluran bantuan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($penyalurans->hasPages())
        <div class="p-4 border-t border-border-light">
            {{ $penyalurans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
