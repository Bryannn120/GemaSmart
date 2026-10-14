@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Laporan &amp; Rekapitulasi Kampus</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Laporan pelaksanaan program bantuan, realisasi penyaluran dana tunai &amp; bibit/barang, serta log monitoring pendamping lapangan.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('kampus.laporan.pdf', request()->all()) }}" target="_blank" class="px-space-md py-space-sm rounded-lg bg-primary text-on-primary font-label-lg hover:bg-gov-green-dark transition-colors shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">download</span>
                <span>Cetak Rekap Program PDF</span>
            </a>
        </div>
    </div>

    <!-- FILTER PERIODE WAKTU (Hari, Minggu, Bulan, Tahun, Rentang Tanggal Kustom) -->
    <x-period-filter :periodInfo="$periodInfo" label="Pilih Periode Laporan:" />

    <!-- Summary Metrics Sesuai Periode -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-md">
        <div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-3">
            <div class="w-11 h-11 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[22px]">payments</span>
            </div>
            <div>
                <span class="text-xs text-text-secondary font-medium block">Dana Bantuan Tunai</span>
                <span class="text-base font-bold text-emerald-700 block mt-0.5">Rp {{ number_format($totalNominalUang ?? 0, 0, ',', '.') }}</span>
                <span class="text-[10px] text-text-tertiary">{{ $periodInfo['label'] }}</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-3">
            <div class="w-11 h-11 rounded-lg bg-gov-green-surface text-primary flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[22px]">psychiatry</span>
            </div>
            <div>
                <span class="text-xs text-text-secondary font-medium block">Bibit Pertanian</span>
                <span class="text-base font-bold text-text-primary block mt-0.5">{{ number_format($totalBibitDisalurkan ?? 0) }} Batang/Kg</span>
                <span class="text-[10px] text-text-tertiary">{{ $periodInfo['label'] }}</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-3">
            <div class="w-11 h-11 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[22px]">hardware</span>
            </div>
            <div>
                <span class="text-xs text-text-secondary font-medium block">Sarana &amp; Alat Bantu</span>
                <span class="text-base font-bold text-text-primary block mt-0.5">{{ number_format($totalBarangDisalurkan ?? 0) }} Unit</span>
                <span class="text-[10px] text-text-tertiary">{{ $periodInfo['label'] }}</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-3">
            <div class="w-11 h-11 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[22px]">group</span>
            </div>
            <div>
                <span class="text-xs text-text-secondary font-medium block">KK Tani Terlayani</span>
                <span class="text-base font-bold text-text-primary block mt-0.5">{{ $totalKkTerlayani ?? 0 }} Kepala Keluarga</span>
                <span class="text-[10px] text-text-tertiary">{{ $totalPenyaluran ?? 0 }} Penyaluran</span>
            </div>
        </div>
    </div>

    <!-- Reports Grid / Unduh PDF -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
        <!-- Card 1 -->
        <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light hover:border-primary transition-colors group">
            <div class="flex items-center justify-between mb-space-md">
                <div class="w-12 h-12 rounded-xl bg-status-verified-surface text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[24px]">description</span>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-gov-green-surface text-primary border border-primary/20">
                    {{ $periodInfo['label'] }}
                </span>
            </div>
            <h3 class="font-headline-sm font-semibold text-text-primary group-hover:text-primary transition-colors">Rekapitulasi Program &amp; Penyaluran</h3>
            <p class="font-body-sm text-text-secondary mt-1 mb-space-md">Laporan lengkap program subsidi, rincian barang/dana, dan daftar penerima pada periode terpilih.</p>
            <a href="{{ route('kampus.laporan.pdf', request()->all()) }}" target="_blank" class="w-full block text-center py-2 bg-surface-container rounded-lg text-text-primary font-label-md font-semibold group-hover:bg-primary group-hover:text-on-primary transition-colors">Unduh Rekapitulasi PDF</a>
        </div>

        <!-- Card 2 -->
        <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light hover:border-primary transition-colors group">
            <div class="flex items-center justify-between mb-space-md">
                <div class="w-12 h-12 rounded-xl bg-status-info-surface text-status-info flex items-center justify-center">
                    <span class="material-symbols-outlined text-[24px]">how_to_reg</span>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                    {{ $periodInfo['label'] }}
                </span>
            </div>
            <h3 class="font-headline-sm font-semibold text-text-primary group-hover:text-primary transition-colors">Log Harian Mahasiswa / Pendamping</h3>
            <p class="font-body-sm text-text-secondary mt-1 mb-space-md">Kompilasi aktivitas monitoring tumbuh kembang tanaman dan catatan lapangan.</p>
            <a href="{{ route('kampus.laporan.log-pendamping-pdf', request()->all()) }}" target="_blank" class="w-full block text-center py-2 bg-surface-container rounded-lg text-text-primary font-label-md font-semibold group-hover:bg-primary group-hover:text-on-primary transition-colors">Unduh Log PDF</a>
        </div>
    </div>

    <!-- TABEL 1: Realisasi Penyaluran Bantuan Sesuai Periode -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="p-space-lg border-b border-border-light flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-surface-subtle">
            <div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-[22px]">volunteer_activism</span>
                    <h2 class="font-headline-sm font-bold text-text-primary">Data Realisasi Penyaluran Bantuan</h2>
                </div>
                <p class="font-body-sm text-text-secondary mt-0.5">Transaksi bantuan bibit, modal uang, dan sarana pada {{ $periodInfo['label'] }}.</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-primary text-on-primary">
                {{ $penyalurans->count() }} Data Ditemukan
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Tgl Penyaluran</th>
                        <th class="py-3 px-4 font-semibold">Warga Penerima</th>
                        <th class="py-3 px-4 font-semibold">Program</th>
                        <th class="py-3 px-4 font-semibold">Item &amp; Jumlah Bantuan</th>
                        <th class="py-3 px-4 font-semibold">Nilai / Nominal</th>
                        <th class="py-3 px-4 font-semibold">Pendamping</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-surface-container-lowest">
                    @forelse ($penyalurans as $pen)
                    <tr class="hover:bg-surface-subtle transition-colors">
                        <td class="py-3 px-4 whitespace-nowrap text-xs text-text-secondary">
                            {{ \Carbon\Carbon::parse($pen->tgl_penyaluran)->format('d M Y') }}
                        </td>
                        <td class="py-3 px-4 whitespace-nowrap">
                            <span class="font-bold text-text-primary block">{{ $pen->keluargaPenerima->kepala_keluarga ?? '-' }}</span>
                            <span class="text-xs text-text-tertiary">{{ $pen->keluargaPenerima->wilayah->nama ?? '-' }}</span>
                        </td>
                        <td class="py-3 px-4 whitespace-nowrap text-xs text-text-primary">
                            {{ $pen->programBantuan->nama_program ?? '-' }}
                        </td>
                        <td class="py-3 px-4 whitespace-nowrap">
                            <span class="font-medium text-text-primary block">{{ $pen->itemBantuan->nama_item ?? '-' }}</span>
                            <span class="text-xs text-text-secondary">{{ number_format($pen->jumlah, 0) }} {{ $pen->satuan }}</span>
                        </td>
                        <td class="py-3 px-4 whitespace-nowrap">
                            @if($pen->jenis === 'uang')
                                <span class="font-bold text-emerald-700">Rp {{ number_format($pen->nominal_uang, 0, ',', '.') }}</span>
                            @else
                                <span class="font-bold text-text-primary">Rp {{ number_format($pen->jumlah * ($pen->itemBantuan->nominal_satuan ?? 0), 0, ',', '.') }}</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 whitespace-nowrap text-xs text-text-secondary">
                            {{ $pen->pendamping->name ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-text-secondary">
                            <span class="material-symbols-outlined text-[40px] text-border-medium mb-1 block">inbox</span>
                            <p class="font-body-md">Tidak ada data penyaluran pada {{ $periodInfo['label'] }}.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
