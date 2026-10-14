@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <!-- Breadcrumb & Back -->
    <div class="flex items-center justify-between text-body-sm font-body-sm text-text-tertiary">
        <div class="flex items-center gap-space-sm">
            <a href="{{ route('pendamping.penyaluran-bantuan.index') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                <span>Kembali ke Daftar Penyaluran</span>
            </a>
            <span>/</span>
            <span class="text-text-primary font-medium">Tanda Terima Penyaluran #{{ $penyaluran->id }}</span>
        </div>
        <button type="button" onclick="window.print()" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl border border-border-light bg-surface-subtle hover:bg-canvas-bg text-text-primary text-xs font-semibold shadow-sm transition-all">
            <span class="material-symbols-outlined text-[16px]">print</span>
            <span>Cetak Tanda Terima</span>
        </button>
    </div>

    <!-- Tanda Terima Card -->
    <div class="bg-canvas-bg rounded-2xl border border-border-light shadow-sm overflow-hidden flex flex-col">
        <!-- Header Bukti -->
        <div class="p-space-xl bg-gradient-to-r from-gov-green-surface to-surface-subtle border-b border-border-light flex flex-col sm:flex-row sm:items-center justify-between gap-space-md">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-primary text-on-primary flex items-center justify-center shrink-0 shadow-sm">
                    <span class="material-symbols-outlined text-[26px]">receipt_long</span>
                </div>
                <div>
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Tanda Terima Penyaluran Bantuan</span>
                    <h1 class="font-headline-md text-headline-md font-bold text-text-primary">
                        Bukti Serah Terima #PENY-{{ str_pad($penyaluran->id, 5, '0', STR_PAD_LEFT) }}
                    </h1>
                </div>
            </div>
            <div class="flex flex-col items-start sm:items-end">
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-status-verified-surface text-primary border border-primary/20">
                    <span class="material-symbols-outlined text-[14px]">check_circle</span>
                    STATUS: DITERIMA
                </span>
                <span class="text-xs text-text-tertiary mt-1">
                    Tanggal: {{ \Carbon\Carbon::parse($penyaluran->tgl_penyaluran)->translatedFormat('l, d F Y') }}
                </span>
            </div>
        </div>

        <!-- Body Bukti -->
        <div class="p-space-xl flex flex-col gap-space-xl">
            <!-- 2 Kolom: Data Penerima & Data Program Kampus -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <!-- Data Keluarga Penerima -->
                <div class="p-space-lg rounded-xl border border-border-light bg-surface-subtle flex flex-col gap-2">
                    <span class="text-xs font-bold text-text-tertiary uppercase tracking-wider flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px] text-primary">person</span>
                        Keluarga Penerima Manfaat
                    </span>
                    <h3 class="font-title-md text-title-md font-bold text-text-primary">
                        {{ $penyaluran->keluargaPenerima->kepala_keluarga ?? '-' }}
                    </h3>
                    <div class="text-xs text-text-secondary flex flex-col gap-1 mt-1">
                        <div>NIK: <strong class="text-text-primary">{{ $penyaluran->keluargaPenerima->nik ?? '-' }}</strong></div>
                        <div>No. KK: <strong class="text-text-primary">{{ $penyaluran->keluargaPenerima->no_kk ?? '-' }}</strong></div>
                        <div>Wilayah/Desa: <strong class="text-text-primary">{{ $penyaluran->keluargaPenerima->wilayah->nama ?? '-' }}</strong></div>
                        <div>Desil Kemiskinan: <strong class="text-text-primary">Desil {{ $penyaluran->keluargaPenerima->desil ?? '-' }}</strong></div>
                    </div>
                </div>

                <!-- Data Program Bantuan Kampus -->
                <div class="p-space-lg rounded-xl border border-border-light bg-surface-subtle flex flex-col gap-2">
                    <span class="text-xs font-bold text-text-tertiary uppercase tracking-wider flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px] text-primary">school</span>
                        Program Kampus Penyelenggara
                    </span>
                    <h3 class="font-title-md text-title-md font-bold text-text-primary">
                        {{ $penyaluran->programBantuan->nama_program ?? '-' }}
                    </h3>
                    <div class="text-xs text-text-secondary flex flex-col gap-1 mt-1">
                        <div>Kampus: <strong class="text-text-primary">{{ $penyaluran->programBantuan->kampusMitra->nama_universitas ?? $penyaluran->programBantuan->kampusMitra->nama_kampus ?? 'Kampus Mitra' }}</strong></div>
                        <div>Tahun Anggaran: <strong class="text-text-primary">{{ $penyaluran->programBantuan->tahun_anggaran ?? '-' }}</strong></div>
                        <div>Kategori Bantuan: <strong class="text-text-primary uppercase">{{ $penyaluran->jenis }}</strong></div>
                    </div>
                </div>
            </div>

            <!-- Detail Spesifik Bantuan yang Disalurkan -->
            <div class="flex flex-col gap-space-sm">
                <span class="text-xs font-bold text-text-tertiary uppercase tracking-wider">Rincian Bantuan yang Diserahkan</span>
                <div class="p-space-lg rounded-xl border-2 {{ $penyaluran->jenis === 'uang' ? 'border-amber-300 bg-amber-50/40' : ($penyaluran->jenis === 'bibit' ? 'border-gov-green-surface bg-gov-green-surface/30' : 'border-blue-200 bg-blue-50/30') }} flex flex-col gap-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl {{ $penyaluran->jenis === 'uang' ? 'bg-amber-100 text-amber-800' : ($penyaluran->jenis === 'bibit' ? 'bg-gov-green-surface text-primary' : 'bg-blue-100 text-blue-800') }} flex items-center justify-center shrink-0">
                                @if($penyaluran->jenis === 'bibit')
                                    <span class="material-symbols-outlined text-[28px]">potted_plant</span>
                                @elseif($penyaluran->jenis === 'uang')
                                    <span class="material-symbols-outlined text-[28px]">payments</span>
                                @else
                                    <span class="material-symbols-outlined text-[28px]">home_repair_service</span>
                                @endif
                            </div>
                            <div>
                                <span class="text-xs uppercase font-bold text-text-tertiary">Jenis: {{ $penyaluran->jenis }}</span>
                                <h2 class="text-lg font-bold text-text-primary">{{ $penyaluran->itemBantuan->nama_item ?? '-' }}</h2>
                                @if($penyaluran->itemBantuan->deskripsi)
                                    <p class="text-xs text-text-secondary mt-0.5">{{ $penyaluran->itemBantuan->deskripsi }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="text-left sm:text-right">
                            <span class="text-xs text-text-tertiary block">Jumlah yang Diterima</span>
                            @if($penyaluran->jenis === 'uang')
                                <span class="text-2xl font-bold text-emerald-700 block">
                                    Rp {{ number_format($penyaluran->nominal_uang ?? $penyaluran->jumlah, 0, ',', '.') }}
                                </span>
                            @else
                                <span class="text-2xl font-bold text-text-primary block">
                                    {{ number_format($penyaluran->jumlah) }} {{ $penyaluran->satuan }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Peruntukan Khusus jika Bantuan Uang -->
                    @if($penyaluran->jenis === 'uang' || $penyaluran->peruntukan)
                        <div class="p-3 rounded-lg bg-canvas-bg border border-border-light flex flex-col gap-1">
                            <span class="text-xs font-bold text-secondary uppercase flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">target</span>
                                Peruntukan Penggunaan Dana Bantuan:
                            </span>
                            <p class="text-sm font-semibold text-text-primary">
                                {{ $penyaluran->peruntukan ?? 'Modal produktif usaha tani / ternak keluarga' }}
                            </p>
                        </div>
                    @endif

                    @if($penyaluran->keterangan)
                        <div class="p-3 rounded-lg bg-canvas-bg border border-border-light text-xs text-text-secondary">
                            <strong class="text-text-primary">Catatan Penyerahan:</strong> {{ $penyaluran->keterangan }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Tanda Tangan & Petugas Pendamping -->
            <div class="pt-space-lg border-t border-border-light grid grid-cols-2 gap-space-lg text-center text-xs">
                <div>
                    <span class="text-text-tertiary block mb-12">Penerima Bantuan,</span>
                    <strong class="text-text-primary underline block">{{ $penyaluran->keluargaPenerima->kepala_keluarga ?? 'Penerima' }}</strong>
                    <span class="text-text-tertiary">Kepala Keluarga</span>
                </div>
                <div>
                    <span class="text-text-tertiary block mb-12">Kader Pendamping Penyalur,</span>
                    <strong class="text-text-primary underline block">{{ $penyaluran->pendamping->name ?? 'Pendamping' }}</strong>
                    <span class="text-text-tertiary">Petugas Penyalur Bantuan Lapangan</span>
                </div>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="p-space-lg bg-surface-subtle border-t border-border-light flex items-center justify-between">
            <a href="{{ route('pendamping.penyaluran-bantuan.index') }}" class="px-4 py-2 rounded-xl border border-border-light text-text-secondary text-xs font-semibold hover:bg-canvas-bg transition-all">
                ← Kembali ke Daftar Penyaluran
            </a>
            <div class="flex items-center gap-2">
                <form action="{{ route('pendamping.penyaluran-bantuan.destroy', $penyaluran->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan penyaluran ini?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-2 rounded-xl text-red-600 hover:bg-red-50 text-xs font-semibold transition-all">
                        Batalkan Penyaluran
                    </button>
                </form>
                <button type="button" onclick="window.print()" class="px-4 py-2 rounded-xl bg-primary text-on-primary text-xs font-bold hover:bg-gov-green-dark transition-all shadow-sm">
                    Cetak Lembar Tanda Terima
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
