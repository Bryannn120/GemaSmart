@extends('layouts.pendamping')

@push('styles')
<style>
@media print {
    /* Sembunyikan elemen dashboard & navigasi */
    #sidebar, #sidebar-overlay, header, .print\:hidden {
        display: none !important;
    }

    body {
        background-color: #ffffff !important;
        color: #000000 !important;
        font-family: 'Times New Roman', Times, serif !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    main {
        padding: 0 !important;
        margin: 0 !important;
        max-width: 100% !important;
        background: transparent !important;
    }

    .lg\:pl-\[260px\] {
        padding-left: 0 !important;
    }

    #surat-bukti-serah-terima {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        box-shadow: none !important;
        border: none !important;
        border-radius: 0 !important;
        page-break-after: avoid;
        page-break-inside: avoid;
    }

    table.bast-table {
        border-collapse: collapse !important;
        width: 100% !important;
    }

    table.bast-table th, table.bast-table td {
        border: 1px solid #000000 !important;
        color: #000000 !important;
        padding: 4px 6px !important;
    }

    table.bast-table thead th {
        background-color: #f1f5f9 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    @page {
        size: A4 portrait;
        margin: 12mm 15mm;
    }
}
</style>
@endpush

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-6xl mx-auto pb-12">
    <!-- Top Action & Navigation (Hidden on Print) -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-body-sm font-body-sm text-text-tertiary print:hidden">
        <div class="flex items-center gap-space-sm flex-wrap">
            <a href="{{ route('pendamping.penyaluran-bantuan.index') }}" class="hover:text-primary transition-colors flex items-center gap-1 font-medium">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                <span>Kembali ke Daftar Penyaluran</span>
            </a>
            <span>/</span>
            <span class="text-text-primary font-semibold">Detail Bantuan: {{ $keluarga->kepala_keluarga }}</span>
        </div>
        <div class="flex items-center gap-2 flex-wrap">
            <a href="{{ route('pendamping.lapor.create', ['keluarga_id' => $keluarga->id]) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-gov-green-surface text-primary border border-primary/20 hover:bg-primary hover:text-on-primary text-xs font-bold transition-all shadow-xs">
                <span class="material-symbols-outlined text-[16px]">edit_note</span>
                <span>+ Catat Kunjungan / Update</span>
            </a>
            <a href="{{ route('pendamping.penyaluran-bantuan.create', ['keluarga_id' => $keluarga->id]) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-primary text-on-primary hover:bg-gov-green-dark text-xs font-bold transition-all shadow-sm">
                <span class="material-symbols-outlined text-[16px]">add_circle</span>
                <span>+ Salurkan Bantuan Baru</span>
            </a>
            <button type="button" onclick="window.print()" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl border border-primary/20 bg-gov-green-surface hover:bg-primary hover:text-white text-primary text-xs font-bold shadow-sm transition-all">
                <span class="material-symbols-outlined text-[16px]">print</span>
                <span>Cetak Bukti BAST</span>
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20 flex items-center gap-2 shadow-sm print:hidden">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- 1. HEADER RINGKASAN KELUARGA PENERIMA & STATISTIK BANTUAN -->
    <div class="bg-canvas-bg rounded-2xl border border-border-light shadow-sm overflow-hidden flex flex-col print:hidden">
        <!-- Banner Title -->
        <div class="p-space-lg sm:p-space-xl bg-gradient-to-r from-gov-green-dark via-primary to-emerald-800 text-white flex flex-col md:flex-row md:items-center justify-between gap-space-md">
            <div class="flex items-start sm:items-center gap-3">
                <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center shrink-0 border border-white/20">
                    <span class="material-symbols-outlined text-[32px] text-white">diversity_3</span>
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-white/20 text-white backdrop-blur-xs">
                            PROFIL KELUARGA BINAAN
                        </span>
                        @if($keluarga->is_mandiri)
                            <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-400 text-slate-900">
                                Sudah Mandiri (Lulus)
                            </span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-400 text-slate-900">
                                Penerima Aktif Binaan
                            </span>
                        @endif
                    </div>
                    <h1 class="font-headline-lg text-headline-lg font-bold text-white mt-1">
                        {{ $keluarga->kepala_keluarga }}
                    </h1>
                    <p class="text-xs text-white/85 flex flex-wrap items-center gap-x-3 gap-y-1 mt-1">
                        <span><strong>NIK:</strong> {{ $keluarga->nik }}</span>
                        <span>•</span>
                        <span><strong>No. KK:</strong> {{ $keluarga->no_kk }}</span>
                        <span>•</span>
                        <span><strong>Desa:</strong> {{ $keluarga->wilayah->nama ?? '-' }}</span>
                        <span>•</span>
                        <span><strong>Desil Kemiskinan:</strong> Desil {{ $keluarga->desil ?? '-' }}</span>
                    </p>
                </div>
            </div>

            <!-- Total Bantuan Diterima (KPI Mini) -->
            <div class="flex items-center gap-2 self-start md:self-auto bg-black/15 backdrop-blur-sm p-3 rounded-xl border border-white/10">
                <div class="text-right">
                    <span class="text-[11px] text-white/80 block">Total Paket Bantuan</span>
                    <span class="text-xl font-bold text-white block">{{ $keluarga->penyaluranBantuans->count() }} Bantuan</span>
                </div>
                <div class="w-9 h-9 rounded-lg bg-white/20 flex items-center justify-center text-white">
                    <span class="material-symbols-outlined text-[20px]">inventory_2</span>
                </div>
            </div>
        </div>

        <!-- 3 Kartu Ringkasan Akumulasi Bantuan -->
        <div class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-border-light bg-surface-subtle">
            <!-- Tunai Modal -->
            <div class="p-4 sm:p-5 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gold-surface text-secondary flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[24px]">payments</span>
                </div>
                <div>
                    <span class="text-[11px] font-semibold text-text-secondary uppercase">Bantuan Uang Modal</span>
                    <span class="text-base sm:text-lg font-bold text-emerald-700 block">
                        Rp {{ number_format($totalNominalUang, 0, ',', '.') }}
                    </span>
                    <span class="text-[11px] text-text-tertiary">Modal usaha produktif keluarga</span>
                </div>
            </div>

            <!-- Bibit Tanaman -->
            <div class="p-4 sm:p-5 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gov-green-surface text-primary flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[24px]">potted_plant</span>
                </div>
                <div>
                    <span class="text-[11px] font-semibold text-text-secondary uppercase">Bantuan Bibit Tanaman</span>
                    <span class="text-base sm:text-lg font-bold text-text-primary block">
                        {{ number_format($totalBibit) }} Bibit/Polybag
                    </span>
                    <span class="text-[11px] text-text-tertiary">Tanaman pangan & pekarangan</span>
                </div>
            </div>

            <!-- Alat / Sarana -->
            <div class="p-4 sm:p-5 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[24px]">home_repair_service</span>
                </div>
                <div>
                    <span class="text-[11px] font-semibold text-text-secondary uppercase">Alat / Sarana Usaha</span>
                    <span class="text-base sm:text-lg font-bold text-text-primary block">
                        {{ number_format($totalBarang) }} Unit Alat
                    </span>
                    <span class="text-[11px] text-text-tertiary">Peralatan pendukung usaha</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. PROGRAM-PROGRAM KAMPUS YANG DIDAPAT KELUARGA INI -->
    <div class="bg-canvas-bg rounded-2xl border border-border-light shadow-sm overflow-hidden flex flex-col print:hidden">
        <div class="p-space-md sm:p-space-lg border-b border-border-light bg-surface-subtle flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-blue-100 text-blue-800 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[20px]">school</span>
                </div>
                <div>
                    <h2 class="font-title-md text-title-md font-bold text-text-primary">Program Bantuan Kampus yang Didapat</h2>
                    <p class="text-xs text-text-secondary">Daftar program resmi dari Perguruan Tinggi / Kampus Mitra tempat keluarga ini terdaftar sebagai penerima manfaat.</p>
                </div>
            </div>
            <span class="px-2.5 py-1 rounded-lg bg-surface-muted text-text-secondary font-semibold text-xs border border-border-light self-start sm:self-auto">
                {{ $programsReceived->count() }} Program Terkait
            </span>
        </div>

        <div class="p-space-md sm:p-space-lg grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse($programsReceived as $prog)
                @php
                    $itemsFromProg = $keluarga->penyaluranBantuans->where('program_bantuan_id', $prog->id);
                @endphp
                <div class="p-4 rounded-xl border border-border-light bg-surface-subtle hover:border-primary/40 transition-all flex flex-col justify-between gap-3">
                    <div class="flex flex-col gap-2">
                        <div class="flex items-start justify-between gap-2">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                <span class="material-symbols-outlined text-[13px]">verified</span>
                                {{ $prog->kampusMitra->nama_universitas ?? $prog->kampusMitra->nama_kampus ?? 'Kampus Mitra' }}
                            </span>
                            <span class="text-[11px] text-text-tertiary font-semibold">
                                TA {{ $prog->tahun_anggaran ?? '-' }}
                            </span>
                        </div>
                        <h3 class="font-bold text-text-primary text-base">
                            {{ $prog->nama_program }}
                        </h3>
                        @if($prog->deskripsi)
                            <p class="text-xs text-text-secondary line-clamp-2">
                                {{ $prog->deskripsi }}
                            </p>
                        @endif
                    </div>

                    <!-- Ringkasan Bantuan dari Program ini -->
                    <div class="pt-3 border-t border-border-light flex items-center justify-between text-xs gap-2">
                        <div class="flex items-center gap-1.5">
                            <span class="text-text-tertiary">Bantuan:</span>
                            @if($itemsFromProg->count() > 0)
                                <span class="px-2 py-0.5 rounded bg-gov-green-surface text-primary text-[11px] font-bold">
                                    {{ $itemsFromProg->count() }} Item
                                </span>
                            @else
                                <span class="text-text-tertiary italic text-[11px]">Belum disalurkan</span>
                            @endif
                        </div>
                        <a href="{{ route('pendamping.lapor.create', ['keluarga_id' => $keluarga->id, 'program_id' => $prog->id]) }}" 
                           class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-primary text-white text-[11px] font-bold hover:bg-gov-green-dark transition-all shadow-xs"
                           title="Update Perkembangan Khusus Program Ini">
                            <span class="material-symbols-outlined text-[14px]">edit_note</span>
                            <span>Update Program Ini</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-2 py-6 text-center text-text-tertiary">
                    <p class="text-sm">Belum ada data program kampus yang terkait langsung.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- 3. TABEL LENGKAP RINCIAN BANTUAN YANG DITERIMA (Inti Permintaan User) -->
    <div class="bg-canvas-bg rounded-2xl border border-border-light shadow-sm overflow-hidden flex flex-col print:hidden">
        <div class="p-space-md sm:p-space-lg border-b border-border-light bg-surface-subtle flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-gov-green-surface text-primary flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[20px]">volunteer_activism</span>
                </div>
                <div>
                    <h2 class="font-title-md text-title-md font-bold text-text-primary">Daftar Seluruh Bantuan yang Diterima</h2>
                    <p class="text-xs text-text-secondary">Rincian setiap jenis bantuan, nominal/jumlah, peruntukan modal, dan status perkembangan lapangannya.</p>
                </div>
            </div>
            <a href="{{ route('pendamping.penyaluran-bantuan.create', ['keluarga_id' => $keluarga->id]) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-primary text-on-primary text-xs font-bold hover:bg-gov-green-dark transition-all shadow-sm shrink-0">
                <span class="material-symbols-outlined text-[16px]">add</span>
                <span>+ Tambah Bantuan</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Tgl Penyaluran</th>
                        <th class="py-3 px-4 font-semibold">Program Kampus</th>
                        <th class="py-3 px-4 font-semibold">Jenis & Item Bantuan</th>
                        <th class="py-3 px-4 font-semibold">Jumlah / Nilai</th>
                        <th class="py-3 px-4 font-semibold">Peruntukan / Catatan</th>
                        <th class="py-3 px-4 font-semibold">Monitoring Terkini</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse($keluarga->penyaluranBantuans as $item)
                        @php
                            $latestMon = $item->latestPerkembangan;
                            $countKunjungan = $item->laporanTumbuhKembangs ? $item->laporanTumbuhKembangs->count() : 0;
                        @endphp
                        <tr class="hover:bg-surface-subtle transition-colors {{ isset($penyaluranSpesifik) && $penyaluranSpesifik->id == $item->id ? 'bg-amber-50/50 border-l-4 border-l-primary' : '' }}">
                            <!-- Tgl Penyaluran -->
                            <td class="py-3 px-4 whitespace-nowrap text-xs">
                                <span class="font-bold text-text-primary block">
                                    {{ \Carbon\Carbon::parse($item->tgl_penyaluran)->translatedFormat('d M Y') }}
                                </span>
                                <span class="text-[11px] text-text-tertiary block mt-0.5">
                                    Oleh: {{ $item->pendamping->name ?? 'Pendamping' }}
                                </span>
                            </td>

                            <!-- Program Kampus -->
                            <td class="py-3 px-4 max-w-xs text-xs">
                                <span class="font-semibold text-text-primary block truncate" title="{{ $item->programBantuan->nama_program ?? '-' }}">
                                    {{ $item->programBantuan->nama_program ?? '-' }}
                                </span>
                                <span class="text-[11px] text-text-tertiary block">
                                    {{ $item->programBantuan->kampusMitra->nama_universitas ?? $item->programBantuan->kampusMitra->nama_kampus ?? 'Kampus Mitra' }}
                                </span>
                            </td>

                            <!-- Jenis & Item Bantuan -->
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg {{ $item->jenis === 'uang' ? 'bg-amber-100 text-amber-800' : ($item->jenis === 'bibit' ? 'bg-gov-green-surface text-primary' : 'bg-blue-100 text-blue-800') }} flex items-center justify-center shrink-0">
                                        @if($item->jenis === 'bibit')
                                            <span class="material-symbols-outlined text-[18px]">potted_plant</span>
                                        @elseif($item->jenis === 'uang')
                                            <span class="material-symbols-outlined text-[18px]">payments</span>
                                        @else
                                            <span class="material-symbols-outlined text-[18px]">home_repair_service</span>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="font-bold text-xs text-text-primary block">
                                            {{ $item->itemBantuan->nama_item ?? '-' }}
                                        </span>
                                        <span class="text-[10px] font-semibold uppercase px-1.5 py-0.2 rounded {{ $item->jenis === 'uang' ? 'bg-amber-50 text-amber-700' : ($item->jenis === 'bibit' ? 'bg-emerald-50 text-emerald-700' : 'bg-blue-50 text-blue-700') }}">
                                            {{ $item->jenis }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <!-- Jumlah / Nilai -->
                            <td class="py-3 px-4 whitespace-nowrap">
                                @if($item->jenis === 'uang')
                                    <span class="font-bold text-emerald-700 text-xs block">
                                        Rp {{ number_format($item->nominal_uang ?? $item->jumlah, 0, ',', '.') }}
                                    </span>
                                    <span class="text-[10px] text-text-tertiary">Uang Modal</span>
                                @else
                                    <span class="font-bold text-text-primary text-xs block">
                                        {{ number_format($item->jumlah) }} {{ $item->satuan }}
                                    </span>
                                    <span class="text-[10px] text-text-tertiary">Fisik Diserahkan</span>
                                @endif
                            </td>

                            <!-- Peruntukan / Catatan -->
                            <td class="py-3 px-4 text-xs max-w-xs text-text-secondary">
                                @if($item->peruntukan)
                                    <div class="font-medium text-text-primary truncate" title="{{ $item->peruntukan }}">
                                        🎯 {{ $item->peruntukan }}
                                    </div>
                                @endif
                                @if($item->keterangan)
                                    <div class="text-[11px] text-text-tertiary truncate mt-0.5" title="{{ $item->keterangan }}">
                                        📝 {{ $item->keterangan }}
                                    </div>
                                @endif
                                @if(!$item->peruntukan && !$item->keterangan)
                                    <span class="text-text-tertiary">-</span>
                                @endif
                            </td>

                            <!-- Monitoring Terkini -->
                            <td class="py-3 px-4 whitespace-nowrap text-xs">
                                @if($latestMon)
                                    @if($latestMon->status_kondisi === 'normal')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-bold bg-gov-green-surface text-primary border border-primary/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                                            Normal / Subur
                                        </span>
                                    @elseif($latestMon->status_kondisi === 'hama')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-300">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Ada Kendala / Hama
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-bold bg-red-50 text-red-700 border border-red-300">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Gagal / Rusak
                                        </span>
                                    @endif
                                    <span class="text-[10px] text-text-tertiary block mt-0.5">
                                        {{ $countKunjungan }}x Kunjungan ({{ \Carbon\Carbon::parse($latestMon->tanggal_lapor)->format('d/m/Y') }})
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-medium bg-surface-subtle text-text-tertiary border border-border-light">
                                        Belum Dimonitor
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi Per Item -->
                            <td class="py-3 px-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- Update Perkembangan Item Ini -->
                                    <a href="{{ route('pendamping.lapor.create', ['program_id' => $item->program_bantuan_id, 'penyaluran_id' => $item->id, 'keluarga_id' => $keluarga->id]) }}" 
                                       class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-gov-green-surface text-primary hover:bg-primary hover:text-on-primary transition-all text-xs font-bold border border-primary/20"
                                       title="Catat Kunjungan & Perkembangan untuk Bantuan Ini">
                                        <span class="material-symbols-outlined text-[14px]">edit_note</span>
                                        <span>Update</span>
                                    </a>

                                    <!-- Batalkan / Hapus Item -->
                                    <form action="{{ route('pendamping.penyaluran-bantuan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan penyaluran item bantuan ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 text-text-tertiary hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Batalkan Item Ini">
                                            <span class="material-symbols-outlined text-[16px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 px-4 text-center text-text-tertiary">
                                Belum ada rincian bantuan yang disalurkan kepada keluarga ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 4. RIWAYAT MONITORING & KUNJUNGAN LAPANGAN (LAPORAN KUNJUNGAN) -->
    <div class="bg-canvas-bg rounded-2xl border border-border-light shadow-sm overflow-hidden flex flex-col print:hidden">
        <div class="p-space-md sm:p-space-lg border-b border-border-light bg-surface-subtle flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-gov-green-surface text-primary flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[20px]">assignment</span>
                </div>
                <div>
                    <h2 class="font-title-md text-title-md font-bold text-text-primary">Riwayat Laporan Kunjungan Lapangan</h2>
                    <p class="text-xs text-text-secondary">Catatan berkala hasil laporan kunjungan pendamping untuk memantau kemajuan, kondisi tanaman/ternak, dan usaha keluarga penerima bantuan.</p>
                </div>
            </div>
            <a href="{{ route('pendamping.lapor.create', ['keluarga_id' => $keluarga->id]) }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-primary text-on-primary text-xs font-bold hover:bg-gov-green-dark transition-all shadow-sm shrink-0">
                <span class="material-symbols-outlined text-[16px]">edit_note</span>
                <span>+ Catat Kunjungan Baru</span>
            </a>
        </div>

        <div class="p-space-md sm:p-space-lg flex flex-col gap-3">
            @forelse($riwayatLaporan as $laporan)
                <div class="p-4 rounded-xl border border-border-light bg-surface-subtle flex flex-col gap-2.5 hover:border-primary/40 transition-all">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div class="flex items-center gap-2 flex-wrap">
                            @if($laporan->status_kondisi === 'normal')
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-gov-green-surface text-primary border border-primary/20">
                                    Normal / Produktif / Subur
                                </span>
                            @elseif($laporan->status_kondisi === 'hama')
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-300">
                                    Hama / Kendala Usaha
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-300">
                                    Gagal / Rusak / Mati
                                </span>
                            @endif

                            @if($laporan->penyaluranBantuan && $laporan->penyaluranBantuan->itemBantuan)
                                <span class="text-xs px-2 py-0.5 rounded bg-canvas-bg font-semibold text-text-primary border border-border-light">
                                    📦 {{ $laporan->penyaluranBantuan->itemBantuan->nama_item }}
                                </span>
                            @endif

                            <span class="text-xs text-text-tertiary">
                                Tgl: <strong class="text-text-primary">{{ \Carbon\Carbon::parse($laporan->tanggal_lapor)->translatedFormat('d F Y') }}</strong>
                            </span>
                        </div>

                        <div class="flex items-center gap-2 text-xs text-text-secondary">
                            <span>Petugas: {{ $laporan->pendamping->name ?? 'Pendamping' }}</span>
                            <a href="{{ route('pendamping.lapor.show', $laporan->id) }}" class="text-primary hover:underline font-bold ml-1">
                                Lihat Laporan →
                            </a>
                        </div>
                    </div>

                    <div class="text-xs text-text-primary bg-canvas-bg p-3 rounded-lg border border-border-light leading-relaxed">
                        <strong class="text-text-secondary">Catatan Perkembangan Lapangan:</strong> {{ $laporan->catatan }}
                    </div>

                    @if($laporan->foto_url)
                        <div class="flex items-center gap-2 text-xs text-primary pt-1">
                            <span class="material-symbols-outlined text-[16px]">photo_camera</span>
                            <a href="{{ $laporan->foto_url }}" target="_blank" class="hover:underline font-medium truncate max-w-md">
                                Lihat Foto Dokumentasi Kunjungan
                            </a>
                        </div>
                    @endif
                </div>
            @empty
                <div class="py-8 text-center text-text-tertiary flex flex-col items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[36px] text-text-tertiary/50">update_disabled</span>
                    <p class="font-bold text-sm text-text-secondary">Belum Ada Catatan Kunjungan untuk Keluarga Ini</p>
                    <p class="text-xs text-text-tertiary max-w-md">Lakukan kunjungan lapangan ke keluarga binaan dan laporkan perkembangan berkala terhadap bantuan yang sudah disalurkan.</p>
                    <a href="{{ route('pendamping.lapor.create', ['keluarga_id' => $keluarga->id]) }}" class="mt-2 inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-primary text-on-primary text-xs font-bold hover:bg-gov-green-dark transition-all shadow-sm">
                        <span class="material-symbols-outlined text-[16px]">edit_note</span>
                        <span>+ Catat Kunjungan Pertama</span>
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- 5. TANDA TERIMA / BERITA ACARA SERAH TERIMA (DAPAT DICETAK LANGSUNG) -->
    <div class="flex flex-col gap-4">
        <!-- Action Header Bar (Tampil di Layar Monitor) -->
        <div class="bg-surface-subtle border border-border-light rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 print:hidden shadow-xs">
            <div class="flex items-start sm:items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-primary text-on-primary flex items-center justify-center shrink-0 shadow-xs">
                    <span class="material-symbols-outlined text-[24px]">assignment_turned_in</span>
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h2 class="font-bold text-text-primary text-base">Surat Bukti Berita Acara Serah Terima (BAST)</h2>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-gov-green-surface text-primary border border-primary/20">
                            Format Resmi Standar Pemkab & Kampus
                        </span>
                    </div>
                    <p class="text-xs text-text-secondary mt-0.5">
                        Dokumen sah tanda bukti serah terima bantuan antara kader pendamping lapangan dan keluarga penerima manfaat.
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary hover:bg-gov-green-dark text-on-primary text-xs font-bold transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">print</span>
                    <span>Cetak Surat Bukti (BAST)</span>
                </button>
            </div>
        </div>

        <!-- Lembar Fisik Surat Resmi BAST (Tampil di Layar & Dicetak ke Kertas) -->
        <div id="surat-bukti-serah-terima" class="bg-white text-slate-900 border border-slate-300 rounded-2xl p-6 sm:p-12 shadow-sm font-serif print:border-none print:shadow-none print:p-0 print:m-0 print:rounded-none max-w-4xl mx-auto w-full">
            
            <!-- KOP SURAT RESMI PEMDA SUMBAWA & GEMA SMART -->
            <div class="flex items-center justify-between gap-4 pb-2 border-b-[3px] border-double border-slate-900 mb-6">
                <div class="shrink-0 flex items-center justify-center">
                    <img src="{{ asset('gemas.jpg') }}" alt="Logo Gema Smart Sumbawa" class="h-20 w-auto object-contain">
                </div>
                <div class="text-center flex-1 pr-4 sm:pr-8">
                    <h2 class="text-sm sm:text-base font-bold tracking-wider uppercase text-slate-900 font-sans leading-tight">
                        PEMERINTAH KABUPATEN SUMBAWA
                    </h2>
                    <h3 class="text-xs sm:text-sm font-bold uppercase text-slate-800 font-sans leading-tight mt-0.5">
                        DINAS PEMBERDAYAAN MASYARAKAT DAN DESA
                    </h3>
                    <h4 class="text-xs sm:text-sm font-extrabold uppercase text-emerald-800 font-sans leading-tight mt-0.5">
                        PROGRAM PEMBERDAYAAN MASYARAKAT "GEMA SMART"
                    </h4>
                    <p class="text-[10px] sm:text-[11px] text-slate-600 font-sans leading-tight mt-0.5">
                        Kolaborasi Pemerintah Daerah Kabupaten Sumbawa Bersama Perguruan Tinggi Mitra
                    </p>
                    <p class="text-[9px] sm:text-[10px] text-slate-500 font-sans italic leading-tight mt-1">
                        Sekretariat: Jl. Garuda No. 1 Sumbawa Besar, NTB (84311) | Email: gemasmart@sumbawakab.go.id
                    </p>
                </div>
            </div>

            <!-- JUDUL & NOMOR SURAT -->
            <div class="text-center mb-6">
                <h1 class="text-base sm:text-lg font-bold uppercase tracking-wider underline underline-offset-4 text-slate-900 font-sans">
                    BERITA ACARA SERAH TERIMA BANTUAN (BAST)
                </h1>
                <p class="text-xs font-mono font-semibold text-slate-700 mt-1">
                    Nomor: {{ date('Y') }}/BAST-GS/{{ $keluarga->wilayah->kode_wilayah ?? '52.04' }}/{{ str_pad($keluarga->id, 4, '0', STR_PAD_LEFT) }}
                </p>
            </div>

            <!-- MUKADIMAH HARI & TANGGAL -->
            <div class="text-xs text-slate-800 leading-relaxed text-justify mb-4">
                Pada hari ini, <strong class="capitalize">{{ \Carbon\Carbon::now()->isoFormat('dddd') }}</strong> tanggal <strong>{{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</strong>, bertempat di <strong>{{ $keluarga->alamat ? $keluarga->alamat . ', ' : '' }}Desa/Kelurahan {{ $keluarga->wilayah->nama ?? 'Sumbawa' }}</strong>, Kecamatan {{ $keluarga->wilayah->parent->nama ?? 'Sumbawa' }}, Kabupaten Sumbawa, Provinsi Nusa Tenggara Barat, kami yang bertanda tangan di bawah ini:
            </div>

            <!-- KOMPARISI PARA PIHAK -->
            <div class="text-xs text-slate-800 mb-4 flex flex-col gap-3">
                <!-- PIHAK PERTAMA -->
                <div class="pl-2">
                    <div class="font-bold uppercase text-[11px] tracking-wide mb-1 text-slate-900">
                        I. PIHAK PERTAMA (Yang Menyerahkan):
                    </div>
                    <table class="w-full text-xs">
                        <tr>
                            <td class="w-36 py-0.5 text-slate-600">Nama Petugas</td>
                            <td class="w-3 text-center py-0.5">:</td>
                            <td class="py-0.5 font-bold text-slate-900">{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <td class="py-0.5 text-slate-600">NIP / NIM</td>
                            <td class="text-center py-0.5">:</td>
                            <td class="py-0.5 font-mono">{{ Auth::user()->nim_nip ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="py-0.5 text-slate-600">Jabatan</td>
                            <td class="text-center py-0.5">:</td>
                            <td class="py-0.5">Kader Pendamping Lapangan Program Gema Smart</td>
                        </tr>
                        <tr>
                            <td class="py-0.5 text-slate-600">Wilayah Tugas</td>
                            <td class="text-center py-0.5">:</td>
                            <td class="py-0.5">{{ Auth::user()->assigned_wilayah_label ?? 'Kabupaten Sumbawa' }}</td>
                        </tr>
                    </table>
                    <p class="text-[11px] text-slate-600 italic mt-0.5">
                        Bertindak untuk dan atas nama Tim Pendamping Program Gema Smart, yang selanjutnya disebut sebagai <strong>PIHAK PERTAMA</strong>.
                    </p>
                </div>

                <!-- PIHAK KEDUA -->
                <div class="pl-2 pt-2 border-t border-slate-200">
                    <div class="font-bold uppercase text-[11px] tracking-wide mb-1 text-slate-900">
                        II. PIHAK KEDUA (Yang Menerima):
                    </div>
                    <table class="w-full text-xs">
                        <tr>
                            <td class="w-36 py-0.5 text-slate-600">Nama Kepala Keluarga</td>
                            <td class="w-3 text-center py-0.5">:</td>
                            <td class="py-0.5 font-bold text-slate-900">{{ $keluarga->kepala_keluarga }}</td>
                        </tr>
                        <tr>
                            <td class="py-0.5 text-slate-600">No. Kartu Keluarga (KK)</td>
                            <td class="text-center py-0.5">:</td>
                            <td class="py-0.5 font-mono">{{ $keluarga->no_kk }}</td>
                        </tr>
                        <tr>
                            <td class="py-0.5 text-slate-600">NIK Kepala Keluarga</td>
                            <td class="text-center py-0.5">:</td>
                            <td class="py-0.5 font-mono">{{ $keluarga->nik }}</td>
                        </tr>
                        <tr>
                            <td class="py-0.5 text-slate-600">Alamat Domisili</td>
                            <td class="text-center py-0.5">:</td>
                            <td class="py-0.5">{{ $keluarga->alamat ?? '-' }}, Desa {{ $keluarga->wilayah->nama ?? '-' }}, Kec. {{ $keluarga->wilayah->parent->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="py-0.5 text-slate-600">Tingkat Kesejahteraan</td>
                            <td class="text-center py-0.5">:</td>
                            <td class="py-0.5 font-semibold text-slate-900">Desil {{ $keluarga->desil ?? '-' }} ({{ $keluarga->status_kemandirian ?? 'Tahap Kemandirian' }})</td>
                        </tr>
                    </table>
                    <p class="text-[11px] text-slate-600 italic mt-0.5">
                        Bertindak selaku Kepala Keluarga Penerima Manfaat Bantuan, yang selanjutnya disebut sebagai <strong>PIHAK KEDUA</strong>.
                    </p>
                </div>
            </div>

            <!-- KLAUSUL KESEPAKATAN -->
            <div class="text-xs text-slate-800 leading-relaxed text-justify mb-3">
                Kedua belah pihak telah bersepakat bahwa <strong>PIHAK PERTAMA</strong> telah menyerahkan bantuan dan <strong>PIHAK KEDUA</strong> menyatakan telah menerima secara langsung, lengkap, dan dalam kondisi baik tanpa dipungut biaya apapun (gratis 100%), dengan rincian paket bantuan sebagai berikut:
            </div>

            <!-- TABEL RINCIAN SERAH TERIMA BARANG / UANG -->
            <table class="bast-table w-full text-xs text-left border border-slate-800 mb-4">
                <thead class="bg-slate-100 font-bold border-b border-slate-800 text-slate-900">
                    <tr>
                        <th class="p-2 border-r border-slate-800 w-8 text-center">No</th>
                        <th class="p-2 border-r border-slate-800">Program Bantuan Kampus</th>
                        <th class="p-2 border-r border-slate-800">Nama Item & Spesifikasi Bantuan</th>
                        <th class="p-2 border-r border-slate-800 text-center">Kategori</th>
                        <th class="p-2 border-r border-slate-800 text-center">Jumlah / Vol</th>
                        <th class="p-2 border-r border-slate-800 text-right">Nilai / Nominal</th>
                        <th class="p-2">Peruntukan Dana / Keperluan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse($keluarga->penyaluranBantuans as $idx => $item)
                        <tr>
                            <td class="p-2 border-r border-slate-800 text-center font-semibold">{{ $idx + 1 }}</td>
                            <td class="p-2 border-r border-slate-800">{{ $item->programBantuan->nama_program ?? 'Program Gema Smart' }}</td>
                            <td class="p-2 border-r border-slate-800 font-bold text-slate-900">
                                {{ $item->itemBantuan->nama_item ?? '-' }}
                            </td>
                            <td class="p-2 border-r border-slate-800 text-center uppercase text-[10px] font-semibold">
                                @if($item->jenis === 'bibit')
                                    Bibit Tanaman
                                @elseif($item->jenis === 'uang')
                                    Uang Tunai Modal
                                @else
                                    Alat / Sarana
                                @endif
                            </td>
                            <td class="p-2 border-r border-slate-800 text-center font-semibold">
                                @if($item->jenis === 'uang')
                                    1 Paket
                                @else
                                    {{ number_format($item->jumlah) }} {{ $item->satuan }}
                                @endif
                            </td>
                            <td class="p-2 border-r border-slate-800 text-right font-mono font-bold">
                                @if($item->jenis === 'uang')
                                    Rp {{ number_format($item->nominal_uang ?? $item->jumlah, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="p-2 text-slate-700">
                                {{ $item->peruntukan ?? ($item->keterangan ?? 'Pemberdayaan produktif keluarga') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-4 text-center text-slate-500 italic">Belum ada rincian paket bantuan yang tercatat disalurkan.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-slate-50 font-bold border-t-2 border-slate-800 text-slate-900">
                    <tr>
                        <td colspan="4" class="p-2 border-r border-slate-800 text-right uppercase text-[11px]">
                            Akumulasi Bantuan Diserahkan:
                        </td>
                        <td class="p-2 border-r border-slate-800 text-center font-mono">
                            {{ number_format($totalBibit) }} Bibit & {{ number_format($totalBarang) }} Alat
                        </td>
                        <td class="p-2 border-r border-slate-800 text-right font-mono text-emerald-800">
                            Rp {{ number_format($totalNominalUang, 0, ',', '.') }}
                        </td>
                        <td class="p-2 text-[11px] text-slate-600 font-normal">
                            Sah diserahkan 100%
                        </td>
                    </tr>
                </tfoot>
            </table>

            <!-- KETENTUAN DAN KEWAJIBAN -->
            <div class="text-xs text-slate-800 leading-relaxed mb-6 space-y-1 text-justify">
                <p><strong>Ketentuan dan Kewajiban Penerima Bantuan:</strong></p>
                <ol class="list-decimal pl-5 space-y-0.5 text-[11px]">
                    <li>PIHAK KEDUA berkewajiban merawat, mengelola, dan membudidayakan bantuan yang diterima untuk menunjang peningkatan produktivitas serta taraf ekonomi keluarga.</li>
                    <li>Bantuan yang diterima tidak diperbolehkan untuk dipindahtangankan, dialihkan, atau diperjualbelikan kepada pihak lain dalam bentuk apapun.</li>
                    <li>PIHAK KEDUA bersedia menerima pendampingan dan kunjungan pemantauan berkala (*laporan kunjungan lapangan*) dari PIHAK PERTAMA untuk evaluasi perkembangan kemandirian.</li>
                </ol>
                <p class="text-[11px] pt-1">
                    Demikian Berita Acara Serah Terima ini dibuat dengan sebenarnya dalam rangkap secukupnya dan ditandatangani oleh para pihak dengan penuh rasa tanggung jawab.
                </p>
            </div>

            <!-- TANGGAL DAN KOLOM TANDA TANGAN (3 PIHAK) -->
            <div class="text-xs text-slate-900">
                <div class="text-right mb-4 text-slate-800 text-xs">
                    Sumbawa, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}
                </div>

                <div class="grid grid-cols-3 gap-4 text-center">
                    <!-- PIHAK KEDUA -->
                    <div class="flex flex-col justify-between h-36">
                        <div>
                            <span class="font-bold uppercase text-[11px] block">PIHAK KEDUA</span>
                            <span class="text-slate-600 text-[10px] block">Yang Menerima Bantuan</span>
                        </div>
                        <div>
                            <strong class="underline block font-bold text-slate-900 uppercase tracking-wide">
                                {{ $keluarga->kepala_keluarga }}
                            </strong>
                            <span class="text-slate-600 text-[10px] font-mono block">NIK: {{ $keluarga->nik }}</span>
                        </div>
                    </div>

                    <!-- MENGETAHUI KEPALA DESA / DPL -->
                    <div class="flex flex-col justify-between h-36">
                        <div>
                            <span class="font-bold uppercase text-[11px] block">MENGETAHUI / MENGESAHKAN</span>
                            <span class="text-slate-600 text-[10px] block">Kepala Desa / Koordinator Tim</span>
                        </div>
                        <div>
                            <span class="underline block font-bold text-slate-900">
                                ( ...................................................... )
                            </span>
                            <span class="text-slate-600 text-[10px] block">NIP/Jabatan: ................................</span>
                        </div>
                    </div>

                    <!-- PIHAK PERTAMA -->
                    <div class="flex flex-col justify-between h-36">
                        <div>
                            <span class="font-bold uppercase text-[11px] block">PIHAK PERTAMA</span>
                            <span class="text-slate-600 text-[10px] block">Yang Menyerahkan Bantuan</span>
                        </div>
                        <div>
                            <strong class="underline block font-bold text-slate-900 uppercase tracking-wide">
                                {{ Auth::user()->name }}
                            </strong>
                            <span class="text-slate-600 text-[10px] font-mono block">NIP/NIM: {{ Auth::user()->nim_nip ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOOTER OTENTIKASI & KEAMANAN SISTEM -->
            <div class="mt-8 pt-3 border-t border-slate-300 flex flex-col sm:flex-row sm:items-center justify-between text-[10px] text-slate-500 font-sans gap-2">
                <div class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px] text-emerald-700">verified</span>
                    <span>Dokumen Sah Sistem Informasi Gema Smart Kab. Sumbawa</span>
                </div>
                <div class="font-mono text-slate-600">
                    ID Transaksi: GS-BAST-{{ strtoupper(substr(hash('sha256', $keluarga->id . $keluarga->nik . 'BAST'), 0, 14)) }}
                </div>
                <div>
                    Waktu Cetak: {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y, HH:mm') }} WITA
                </div>
            </div>
        </div>

        <!-- Tombol Cetak Bawah (Layar Saja) -->
        <div class="flex justify-end print:hidden pt-2">
            <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary hover:bg-gov-green-dark text-on-primary text-xs font-bold transition-all shadow-md">
                <span class="material-symbols-outlined text-[18px]">print</span>
                <span>Cetak Dokumen BAST Ini (Ukuran A4)</span>
            </button>
        </div>
    </div>
</div>
@endsection
