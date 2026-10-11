@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Laporan & Pengaduan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Pantau laporan kendala langsung dari warga penerima bantuan, statistik program, dan rekapitulasi data.
            </p>
        </div>
        <div>
            <a href="{{ route('pemda.laporan.pdf') }}" target="_blank" class="px-space-md py-space-sm rounded-lg bg-status-fraud text-on-error font-label-lg hover:bg-red-800 transition-colors shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">picture_as_pdf</span> Cetak PDF Keseluruhan
            </a>
        </div>
    </div>

    <!-- TABEL UTAMA: Laporan & Kendala dari Penerima Bantuan -->
    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="p-space-lg border-b border-border-light flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-surface-subtle">
            <div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-[24px]">mark_email_unread</span>
                    <h2 class="font-headline-sm font-bold text-text-primary">Laporan &amp; Kendala dari Penerima Bantuan</h2>
                </div>
                <p class="font-body-sm text-text-secondary mt-0.5">Daftar keluhan, kendala bibit, dan feedback yang dikirim langsung oleh warga penerima.</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-primary text-on-primary">
                    Total: {{ $laporanWargas->count() }} Laporan
                </span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3.5 px-4 font-semibold">Tgl / Waktu</th>
                        <th class="py-3.5 px-4 font-semibold">Warga Penerima (KK)</th>
                        <th class="py-3.5 px-4 font-semibold">Wilayah / Desa</th>
                        <th class="py-3.5 px-4 font-semibold">Isi Laporan / Kendala</th>
                        <th class="py-3.5 px-4 font-semibold">Pendamping Lapangan</th>
                        <th class="py-3.5 px-4 font-semibold">Kampus Mitra</th>
                        <th class="py-3.5 px-4 font-semibold">Status</th>
                        <th class="py-3.5 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($laporanWargas as $lap)
                    <tr class="hover:bg-surface-subtle transition-colors group {{ !$lap->is_read_by_pemda ? 'bg-gov-green-surface/20 font-medium' : '' }}">
                        <td class="py-3.5 px-4 text-text-secondary whitespace-nowrap text-xs">
                            {{ $lap->created_at->format('d M Y') }}<br/>
                            <span class="text-text-tertiary">{{ $lap->created_at->format('H:i') }} WITA</span>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="font-bold text-text-primary block">{{ $lap->keluargaPenerima->kepala_keluarga ?? 'Tidak Diketahui' }}</span>
                            <span class="text-text-tertiary font-mono text-[11px]">No. KK: {{ $lap->keluargaPenerima->no_kk ?? '-' }}</span>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="text-text-primary block">{{ $lap->keluargaPenerima->wilayah->nama ?? '-' }}</span>
                            <span class="text-text-tertiary text-xs">
                                {{ isset($lap->keluargaPenerima->wilayah->parent) ? 'Kec. ' . $lap->keluargaPenerima->wilayah->parent->nama : '-' }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 max-w-xs">
                            <p class="truncate text-text-primary text-sm" title="{{ $lap->laporan_teks }}">
                                {{ $lap->laporan_teks }}
                            </p>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @php
                                $p = $lap->keluargaPenerima->pendamping ?? null;
                            @endphp
                            @if ($p)
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[18px] text-primary">support_agent</span>
                                    <div>
                                        <span class="font-semibold text-text-primary block text-xs">{{ $p->name }}</span>
                                        <span class="text-text-tertiary text-[11px] block">{{ $p->email }}</span>
                                    </div>
                                </div>
                            @else
                                <span class="text-text-tertiary italic text-xs">Belum ditugaskan</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @php
                                $k = $lap->keluargaPenerima->kampusMitra ?? ($p->kampus ?? null);
                            @endphp
                            @if ($k)
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[18px] text-status-info">school</span>
                                    <span class="font-semibold text-text-primary text-xs">{{ $k->nama_universitas }}</span>
                                </div>
                            @else
                                <span class="text-text-tertiary italic text-xs">-</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @if ($lap->is_read_by_pemda)
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-bold bg-surface-container text-text-secondary">
                                    Sudah Dilihat
                                </span>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-bold bg-status-warning-surface text-status-warning animate-pulse">
                                    Baru Masuk
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <a href="{{ route('pemda.laporan.show', $lap->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary text-on-primary hover:bg-primary-container rounded-lg font-label-sm text-xs font-semibold transition-colors shadow-sm">
                                <span class="material-symbols-outlined text-[16px]">visibility</span>
                                <span>Lihat Detail</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-12 text-center text-text-secondary">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[48px] text-border-medium">inbox</span>
                                <p class="text-base font-semibold">Belum ada laporan atau kendala dari warga.</p>
                                <p class="text-xs text-text-tertiary">Laporan yang dikirim melalui dashboard akun warga penerima akan tampil di sini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Reports Grid / Statistik Dokumen -->
    <div class="flex flex-col gap-3">
        <h2 class="font-headline-sm font-bold text-text-primary">Dokumen Rekapitulasi & Statistik</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-space-md">
            <!-- Card 1 -->
            <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light hover:border-primary transition-colors cursor-pointer group">
                <div class="w-12 h-12 rounded-xl bg-status-verified-surface text-primary flex items-center justify-center mb-space-md">
                    <span class="material-symbols-outlined text-[24px]">description</span>
                </div>
                <h3 class="font-headline-sm font-semibold text-text-primary group-hover:text-primary transition-colors">Laporan Penyaluran Bibit</h3>
                <p class="font-body-sm text-text-secondary mt-1 mb-space-md">Total data penyaluran bibit: {{ $totalPenyaluran }} transaksi.</p>
                <a href="{{ route('pemda.laporan.pdf') }}" target="_blank" class="w-full block text-center py-2 bg-surface-container rounded-lg text-text-primary font-label-md font-semibold group-hover:bg-primary group-hover:text-on-primary transition-colors">Unduh PDF</a>
            </div>

            <!-- Card 2 -->
            <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light hover:border-primary transition-colors cursor-pointer group">
                <div class="w-12 h-12 rounded-xl bg-status-info-surface text-status-info flex items-center justify-center mb-space-md">
                    <span class="material-symbols-outlined text-[24px]">pie_chart</span>
                </div>
                <h3 class="font-headline-sm font-semibold text-text-primary group-hover:text-primary transition-colors">Statistik Tumbuh Kembang</h3>
                <p class="font-body-sm text-text-secondary mt-1 mb-space-md">Laporan pengamatan tumbuh kembang: {{ $totalLaporan }} data.</p>
                <a href="{{ route('pemda.laporan.pdf') }}" target="_blank" class="w-full block text-center py-2 bg-surface-container rounded-lg text-text-primary font-label-md font-semibold group-hover:bg-primary group-hover:text-on-primary transition-colors">Unduh PDF</a>
            </div>
            
            <!-- Card 3 -->
            <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light hover:border-primary transition-colors cursor-pointer group">
                <div class="w-12 h-12 rounded-xl bg-status-warning-surface text-status-warning flex items-center justify-center mb-space-md">
                    <span class="material-symbols-outlined text-[24px]">rule</span>
                </div>
                <h3 class="font-headline-sm font-semibold text-text-primary group-hover:text-primary transition-colors">Laporan Validasi Lapangan</h3>
                <p class="font-body-sm text-text-secondary mt-1 mb-space-md">Total validasi CPCL lapangan: {{ $totalValidasi }} data keluarga.</p>
                <a href="{{ route('pemda.laporan.pdf') }}" target="_blank" class="w-full block text-center py-2 bg-surface-container rounded-lg text-text-primary font-label-md font-semibold group-hover:bg-primary group-hover:text-on-primary transition-colors">Unduh PDF</a>
            </div>
        </div>
    </div>
</div>
@endsection
