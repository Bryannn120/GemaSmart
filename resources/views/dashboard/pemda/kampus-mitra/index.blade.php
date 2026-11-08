@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-space-md">
        <div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Kampus Mitra (Perguruan Tinggi)</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Kelola perguruan tinggi mitra kolaborasi pendampingan program bantuan sosial Kabupaten Sumbawa.
            </p>
        </div>
        <div>
            <a href="{{ route('pemda.kampus-mitra.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2.5 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-all shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add</span>
                <span>Tambah Kampus Mitra</span>
            </a>
        </div>
    </div>

    <!-- Alert Sukses / Error -->
    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20 flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Summary Cards (Operational Metrics) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-lg">
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-primary-fixed flex items-center justify-center text-on-primary-fixed-variant">
                <span class="material-symbols-outlined text-[24px]">school</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Kampus Mitra</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $kampusMitras->count() }} Mitra</span>
            </div>
        </div>

        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-700">
                <span class="material-symbols-outlined text-[24px]">verified</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">MoU Aktif</span>
                <span class="font-headline-md text-headline-md text-emerald-700 font-bold block">{{ $kampusMitras->where('status_mou', 'aktif')->count() }} Kampus Aktif</span>
            </div>
        </div>

        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-700">
                <span class="material-symbols-outlined text-[24px]">map</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Kecamatan Binaan</span>
                <span class="font-headline-md text-headline-md text-blue-700 font-bold block">
                    {{ $kampusMitras->sum(fn($km) => $km->wilayahs ? $km->wilayahs->count() : 0) ?: 24 }} Kecamatan
                </span>
            </div>
        </div>

        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-gov-green-surface flex items-center justify-center text-gov-green-dark">
                <span class="material-symbols-outlined text-[24px]">groups</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Penerima Binaan</span>
                <span class="font-headline-md text-headline-md text-gov-green-dark font-bold block">{{ \App\Models\KeluargaPenerima::count() }} Keluarga</span>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3.5 px-4 font-semibold">Nama Universitas</th>
                        <th class="py-3.5 px-4 font-semibold">PIC / Koordinator</th>
                        <th class="py-3.5 px-4 font-semibold">Wilayah / Kecamatan Binaan</th>
                        <th class="py-3.5 px-4 font-semibold">Status Kemitraan (MoU)</th>
                        <th class="py-3.5 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($kampusMitras as $km)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4">
                            <span class="font-bold text-text-primary block">{{ $km->nama_universitas }}</span>
                            <span class="text-xs text-text-tertiary">Terdaftar di Ekosistem GemaSmart</span>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="font-medium text-text-primary block">{{ $km->pic_name }}</span>
                            <span class="text-text-tertiary text-xs">{{ $km->pic_contact }}</span>
                        </td>
                        <td class="py-3.5 px-4">
                            @if($km->wilayahs && $km->wilayahs->isNotEmpty())
                                <div class="flex flex-wrap gap-1">
                                    @foreach($km->wilayahs as $w)
                                        <span class="inline-flex items-center gap-0.5 text-[11px] font-semibold bg-gov-green-surface text-primary border border-primary/20 px-2 py-0.5 rounded-md">
                                            <span class="material-symbols-outlined text-[12px]">location_on</span>
                                            <span>Kec. {{ $w->nama }}</span>
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-xs text-text-secondary font-medium">{{ $km->wilayah_binaan ?? 'Seluruh Wilayah Sumbawa' }}</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @if ($km->status_mou == 'aktif')
                                <span class="inline-flex px-space-sm py-0.5 rounded-full text-label-sm bg-status-verified-surface text-primary font-bold">Aktif</span>
                            @else
                                <span class="inline-flex px-space-sm py-0.5 rounded-full text-label-sm bg-status-warning-surface text-status-warning font-bold">Tidak Aktif</span>
                            @endif
                            <span class="text-[11px] text-text-tertiary block mt-0.5">s/d {{ $km->mou_berlaku_sampai ? \Carbon\Carbon::parse($km->mou_berlaku_sampai)->format('d M Y') : '-' }}</span>
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('pemda.kampus-mitra.show', $km->id) }}" class="p-1.5 text-text-secondary hover:text-primary hover:bg-status-info-surface rounded-lg transition-colors" title="Lihat Profil Kampus">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <a href="{{ route('pemda.kampus-mitra.edit', $km->id) }}" class="p-1.5 text-text-secondary hover:text-primary hover:bg-status-verified-surface rounded-lg transition-colors" title="Edit Data Kampus">
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
                        <td colspan="5" class="py-12 text-center text-text-secondary">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[48px] text-border-medium">domain_disabled</span>
                                <p class="text-base font-semibold">Belum ada data kampus mitra terdaftar.</p>
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
