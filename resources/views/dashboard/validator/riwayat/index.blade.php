@extends('layouts.validator')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Riwayat &amp; Laporan Validasi Lapangan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Log pemeriksaan dan verifikasi CPCL yang telah selesai Anda proses (Layak atau Tidak Layak).
            </p>
        </div>
        <div>
            <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-gov-green-surface text-primary border border-primary/20">
                Total: {{ $riwayats->count() }} Data Diproses
            </span>
        </div>
    </div>

    <!-- FILTER PERIODE WAKTU (Hari, Minggu, Bulan, Tahun, Rentang Kustom) -->
    <x-period-filter :periodInfo="$periodInfo" label="Pilih Periode Validasi:" />

    <!-- Table -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="p-space-md border-b border-border-light flex items-center justify-between bg-surface-subtle">
            <span class="text-xs font-bold text-text-primary uppercase tracking-wider">
                Daftar Hasil Validasi — {{ $periodInfo['label'] }}
            </span>
            <span class="text-xs text-text-secondary font-medium">
                {{ $riwayats->count() }} Terverifikasi
            </span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-container-low text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Tgl Validasi</th>
                        <th class="py-3 px-4 font-semibold">Calon Penerima (KK)</th>
                        <th class="py-3 px-4 font-semibold">Wilayah / Desa</th>
                        <th class="py-3 px-4 font-semibold">Surveyor (Pendamping)</th>
                        <th class="py-3 px-4 font-semibold">Hasil Keputusan</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light">
                    @forelse ($riwayats as $rw)
                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                        <td class="py-3.5 px-4 text-xs text-text-secondary whitespace-nowrap">
                            {{ $rw->tgl_survei ? \Carbon\Carbon::parse($rw->tgl_survei)->format('d M Y') : $rw->created_at->format('d M Y') }}
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="font-bold text-text-primary block">{{ $rw->keluarga_penerima->kepala_keluarga ?? '-' }}</span>
                            <span class="text-xs text-text-tertiary">NIK: {{ $rw->keluarga_penerima->nik ?? '-' }}</span>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="text-text-primary block">{{ $rw->keluarga_penerima->wilayah->nama ?? '-' }}</span>
                            <span class="text-xs text-text-tertiary">{{ $rw->keluarga_penerima->wilayah->parent ? 'Kec. ' . $rw->keluarga_penerima->wilayah->parent->nama : '' }}</span>
                        </td>
                        <td class="py-3.5 px-4 text-text-secondary">
                            {{ $rw->pendamping->name ?? '-' }}
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @if ($rw->status_kelayakan === 'layak')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs bg-status-verified-surface text-status-verified font-bold">
                                    <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                    <span>Layak (Disetujui)</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs bg-status-fraud-surface text-status-fraud font-bold">
                                    <span class="material-symbols-outlined text-[14px]">cancel</span>
                                    <span>Tidak Layak</span>
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right">
                            <a href="{{ route('validator.riwayat.show', $rw->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-surface-container border border-border-light text-text-secondary hover:text-primary font-label-sm text-xs rounded-lg hover:bg-surface-variant transition-colors">
                                <span class="material-symbols-outlined text-[16px]">visibility</span>
                                <span>Detail</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-10 text-center text-text-secondary">
                            <span class="material-symbols-outlined text-[40px] text-border-medium mb-1 block">history</span>
                            <p class="font-body-md font-semibold">Belum ada riwayat validasi pada {{ $periodInfo['label'] }}.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
