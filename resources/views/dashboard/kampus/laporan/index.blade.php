@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Laporan &amp; Rekapitulasi Kampus</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Laporan pelaksanaan program bantuan bibit tanaman produktif, sarana pendukung, log monitoring pendamping, serta laporan &amp; kendala langsung dari warga penerima.
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

        <div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-3">
            <div class="w-11 h-11 rounded-lg bg-purple-50 text-purple-700 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[22px]">contact_support</span>
            </div>
            <div>
                <span class="text-xs text-text-secondary font-medium block">Laporan Warga Penerima</span>
                <span class="text-base font-bold text-purple-700 block mt-0.5">{{ $totalLaporanPenerima ?? 0 }} Laporan</span>
                <span class="text-[10px] text-text-tertiary">{{ $periodInfo['label'] }}</span>
            </div>
        </div>
    </div>

    <!-- TABEL 1: LAPORAN & KELUHAN DARI PENERIMA BANTUAN (Requirement 1) -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="p-space-lg border-b border-border-light flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-surface-subtle">
            <div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-[22px]">mark_email_unread</span>
                    <h2 class="font-headline-sm font-bold text-text-primary">Laporan &amp; Keluhan dari Warga Penerima Bantuan</h2>
                </div>
                <p class="font-body-sm text-text-secondary mt-0.5">Keluhan kendala bibit, hama, atau kondisi lapangan yang dilaporkan langsung oleh keluarga binaan kampus.</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-primary text-on-primary">
                {{ $laporanPenerimas->count() }} Laporan Ditemukan
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3.5 px-4 font-semibold">Tgl / Waktu</th>
                        <th class="py-3.5 px-4 font-semibold">Warga Penerima (KK)</th>
                        <th class="py-3.5 px-4 font-semibold">Kanal</th>
                        <th class="py-3.5 px-4 font-semibold">Desa / Wilayah</th>
                        <th class="py-3.5 px-4 font-semibold">Isi Laporan / Kendala</th>
                        <th class="py-3.5 px-4 font-semibold">Pendamping Bertugas</th>
                        <th class="py-3.5 px-4 font-semibold">Status Dilihat</th>
                        <th class="py-3.5 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-surface-container-lowest">
                    @forelse ($laporanPenerimas as $lap)
                    <tr class="hover:bg-surface-subtle transition-colors {{ !$lap->is_read_by_kampus ? 'bg-emerald-50/50 font-medium' : '' }}">
                        <td class="py-3.5 px-4 whitespace-nowrap text-xs text-text-secondary">
                            {{ $lap->created_at->format('d M Y') }}<br/>
                            <span class="text-text-tertiary">{{ $lap->created_at->format('H:i') }} WITA</span>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="font-bold text-text-primary block">{{ $lap->keluargaPenerima->kepala_keluarga ?? ($lap->pengirim_nama ?: '-') }}</span>
                            <span class="text-text-tertiary font-mono text-[11px]">
                                @if($lap->keluargaPenerima)
                                    No KK: {{ $lap->keluargaPenerima->no_kk }}
                                @else
                                    WA: {{ $lap->wa_sender ?? '-' }}
                                @endif
                            </span>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @if($lap->is_whatsapp || $lap->sumber === 'whatsapp')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-300 shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                    <span>WhatsApp</span>
                                </span>
                                @if($lap->wa_sender)
                                    <span class="block text-[10px] text-emerald-700 font-mono mt-0.5">{{ $lap->formatted_wa_sender }}</span>
                                @endif
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                    <span class="material-symbols-outlined text-[13px]">language</span>
                                    <span>Portal Web</span>
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="text-text-primary block">{{ $lap->keluargaPenerima->wilayah->nama ?? '-' }}</span>
                            <span class="text-text-tertiary text-xs">{{ isset($lap->keluargaPenerima->wilayah->parent) ? 'Kec. ' . $lap->keluargaPenerima->wilayah->parent->nama : '-' }}</span>
                        </td>
                        <td class="py-3.5 px-4 max-w-xs">
                            <p class="truncate text-text-primary text-sm" title="{{ $lap->laporan_teks }}">
                                {{ $lap->laporan_teks }}
                            </p>
                            @if($lap->foto)
                                <span class="inline-flex items-center gap-1 text-[11px] text-primary font-semibold mt-0.5">
                                    <span class="material-symbols-outlined text-[13px]">image</span>
                                    Ada Foto Lampiran
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap text-xs text-text-secondary">
                            {{ $lap->keluargaPenerima->pendamping->name ?? 'Belum Ditugaskan' }}
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @if($lap->is_read_by_kampus)
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-bold bg-surface-container text-text-secondary">
                                    Sudah Dilihat
                                </span>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 animate-pulse">
                                    Baru Masuk
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <a href="{{ route('kampus.laporan.penerima.show', $lap->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary text-on-primary hover:bg-gov-green-dark rounded-lg font-label-sm text-xs font-semibold transition-colors shadow-sm">
                                <span class="material-symbols-outlined text-[16px]">visibility</span>
                                <span>Lihat Detail</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-10 text-center text-text-secondary">
                            <span class="material-symbols-outlined text-[40px] text-border-medium mb-1 block">inbox</span>
                            <p class="font-body-md font-semibold text-text-primary">Belum ada laporan dari warga binaan kampus.</p>
                            <p class="text-xs text-text-tertiary mt-0.5">Laporan keluhan yang dikirimkan warga penerima akan otomatis muncul di sini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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
            <h3 class="font-headline-sm font-semibold text-text-primary group-hover:text-primary transition-colors">Rekapitulasi Program &amp; Penyaluran Bibit</h3>
            <p class="font-body-sm text-text-secondary mt-1 mb-space-md">Laporan lengkap program subsidi bibit, sarana pendukung, dan daftar penerima binaan.</p>
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

    <!-- TABEL 2: Realisasi Penyaluran Bibit & Sarana Sesuai Periode -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="p-space-lg border-b border-border-light flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-surface-subtle">
            <div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-[22px]">volunteer_activism</span>
                    <h2 class="font-headline-sm font-bold text-text-primary">Data Realisasi Penyaluran Bibit &amp; Sarana</h2>
                </div>
                <p class="font-body-sm text-text-secondary mt-0.5">Distribusi bantuan bibit dan sarana produktif pada {{ $periodInfo['label'] }}.</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-primary text-on-primary">
                {{ $penyalurans->count() }} Data Penyaluran
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Tgl Penyaluran</th>
                        <th class="py-3 px-4 font-semibold">Warga Penerima</th>
                        <th class="py-3 px-4 font-semibold">Program Bantuan</th>
                        <th class="py-3 px-4 font-semibold">Item &amp; Kuantitas Bantuan</th>
                        <th class="py-3 px-4 font-semibold">Pendamping Bertugas</th>
                        <th class="py-3 px-4 font-semibold">Status</th>
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
                            <span class="text-xs font-semibold text-primary">{{ number_format($pen->jumlah, 0) }} {{ $pen->satuan }}</span>
                        </td>
                        <td class="py-3 px-4 whitespace-nowrap text-xs text-text-secondary">
                            {{ $pen->pendamping->name ?? '-' }}
                        </td>
                        <td class="py-3 px-4 whitespace-nowrap">
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-bold bg-gov-green-surface text-primary">
                                {{ ucfirst($pen->status ?? 'Tersalurkan') }}
                            </span>
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
