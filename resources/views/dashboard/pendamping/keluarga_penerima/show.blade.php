@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <div class="flex items-center gap-2 mb-1">
                <a href="{{ route('pendamping.keluarga_penerima.index') }}" class="text-text-secondary hover:text-primary transition-colors flex items-center gap-1 font-body-sm text-sm">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    <span>Kembali ke Daftar Binaan</span>
                </a>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Detail Keluarga Penerima Binaan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Informasi profil lengkap, status bantuan bibit, dan riwayat pendampingan lapangan.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            @if(!$keluarga_penerima->is_mandiri)
                <a href="{{ route('pendamping.penyaluran-bantuan.create', ['keluarga_id' => $keluarga_penerima->id]) }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary text-on-primary font-label-md text-label-md font-bold hover:bg-gov-green-dark transition-colors shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">volunteer_activism</span>
                    <span>+ Salurkan Bantuan</span>
                </a>
            @else
                <span class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-emerald-100 text-emerald-800 font-label-md text-xs font-bold border border-emerald-300">
                    <span class="material-symbols-outlined text-[16px]">workspace_premium</span>
                    <span>Telah Lulus Mandiri</span>
                </span>
            @endif
            <a href="{{ route('pendamping.keluarga_penerima.penilaian.create', $keluarga_penerima->id) }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-secondary hover:bg-secondary/90 text-on-secondary font-label-md text-label-md font-semibold transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">rate_review</span>
                <span>+ Input Penilaian Desil</span>
            </a>
            <a href="{{ route('pendamping.lapor.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">eco</span>
                <span>Lapor Tumbuh Kembang</span>
            </a>
            <a href="{{ route('pendamping.keluarga_penerima.edit', $keluarga_penerima->id) }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-surface-container-high hover:bg-surface-container-highest text-text-primary font-label-md text-label-md font-semibold transition-colors border border-border-light shadow-sm">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                <span>Edit</span>
            </a>
            <form action="{{ route('pendamping.keluarga_penerima.destroy', $keluarga_penerima->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data penerima binaan ini? Tindakan ini tidak dapat dibatalkan.');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-red-50 hover:bg-red-100 text-red-700 font-label-md text-label-md font-semibold transition-colors border border-red-200 shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">delete</span>
                    <span>Hapus</span>
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20 flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Main Grid Profile -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-space-lg">
        <!-- Kolom Kiri: Kartu Profil KK -->
        <div class="lg:col-span-1 flex flex-col gap-space-md">
            <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col items-center text-center">
                <div class="w-20 h-20 rounded-full bg-gov-green-surface text-primary flex items-center justify-center font-bold text-3xl mb-3 shadow-inner">
                    {{ strtoupper(substr($keluarga_penerima->kepala_keluarga, 0, 1)) }}
                </div>
                <h2 class="text-lg font-bold text-text-primary">{{ $keluarga_penerima->kepala_keluarga }}</h2>
                <span class="text-text-secondary text-sm font-mono mt-0.5">NIK: {{ $keluarga_penerima->nik }}</span>
                <span class="text-text-tertiary text-xs font-mono">No KK: {{ $keluarga_penerima->no_kk }}</span>

                <div class="mt-4 flex flex-wrap gap-2 justify-center">
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-gov-green-surface text-primary border border-primary/20">
                        Desil {{ $keluarga_penerima->desil }}
                    </span>
                    @if ($keluarga_penerima->status_validasi == 'valid')
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-status-verified-surface text-status-verified flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">check_circle</span>
                            Valid
                        </span>
                    @elseif ($keluarga_penerima->status_validasi == 'menunggu_validasi')
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-status-warning-surface text-status-warning flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">hourglass_empty</span>
                            Menunggu
                        </span>
                    @else
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-status-fraud-surface text-status-fraud flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">cancel</span>
                            Tidak Valid
                        </span>
                    @endif
                </div>

                <div class="w-full border-t border-border-light my-4"></div>

                <div class="w-full text-left flex flex-col gap-3 text-sm">
                    <div>
                        <span class="text-text-tertiary text-xs uppercase font-semibold block">Penghasilan Terkini</span>
                        <span class="text-text-primary font-bold text-base font-mono">
                            @if($keluarga_penerima->penghasilan_perbulan > 0)
                                Rp {{ number_format($keluarga_penerima->penghasilan_perbulan, 0, ',', '.') }} <span class="text-xs font-normal text-text-secondary">/bulan</span>
                            @else
                                <span class="text-text-tertiary font-normal text-xs">Belum diinput asesmen</span>
                            @endif
                        </span>
                    </div>

                    <div>
                        <span class="text-text-tertiary text-xs uppercase font-semibold block">Status Kemandirian</span>
                        @if ($keluarga_penerima->desil >= 6 || $keluarga_penerima->status_kemandirian == 'Mandiri')
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 mt-1 rounded text-xs font-bold bg-green-100 text-green-800">
                                <span class="material-symbols-outlined text-[14px]">verified</span>
                                Sudah Mandiri
                            </span>
                        @elseif ($keluarga_penerima->status_kemandirian == 'Penurunan Desil')
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 mt-1 rounded text-xs font-bold bg-amber-100 text-amber-800">
                                <span class="material-symbols-outlined text-[14px]">trending_down</span>
                                Penurunan Desil
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 mt-1 rounded text-xs font-bold bg-blue-100 text-blue-800">
                                <span class="material-symbols-outlined text-[14px]">hourglass_top</span>
                                Tahap Kemandirian
                            </span>
                        @endif
                    </div>

                    <div>
                        <span class="text-text-tertiary text-xs uppercase font-semibold block">Wilayah & Alamat</span>
                        <span class="text-text-primary font-medium">{{ $keluarga_penerima->wilayah->nama ?? 'Sumbawa' }}</span>
                        <p class="text-text-secondary text-xs mt-0.5">{{ $keluarga_penerima->alamat ?? '-' }}</p>
                    </div>

                    @if($keluarga_penerima->kampusMitra)
                    <div>
                        <span class="text-text-tertiary text-xs uppercase font-semibold block">Kampus Pendamping</span>
                        <span class="text-text-primary font-medium">{{ $keluarga_penerima->kampusMitra->nama_kampus }}</span>
                    </div>
                    @endif
                </div>

                <div class="w-full mt-4 pt-3 border-t border-border-light">
                    <a href="{{ route('pendamping.keluarga_penerima.penilaian.create', $keluarga_penerima->id) }}" class="w-full py-2.5 rounded-xl bg-gov-green-surface hover:bg-gov-green text-primary hover:text-white font-label-md text-xs font-bold transition-all border border-primary/20 flex items-center justify-center gap-1.5 shadow-sm">
                        <span class="material-symbols-outlined text-[16px]">rate_review</span>
                        <span>Evaluasi Desil & Penghasilan</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Rincian Bantuan & Riwayat -->
        <div class="lg:col-span-2 flex flex-col gap-space-lg">
            <!-- Kartu Program Bantuan -->
            <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-primary text-[22px]">inventory_2</span>
                    <h3 class="font-bold text-text-primary text-base">Program Bantuan Bibit</h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div class="p-3 bg-surface-muted rounded-lg">
                        <span class="text-text-tertiary text-xs block">Nama Program</span>
                        <span class="text-text-primary font-semibold">{{ $keluarga_penerima->programBantuan->nama_program ?? 'Program Bantuan Bibit Sumbawa' }}</span>
                    </div>
                    <div class="p-3 bg-surface-muted rounded-lg">
                        <span class="text-text-tertiary text-xs block">Tahun Anggaran</span>
                        <span class="text-text-primary font-semibold">{{ $keluarga_penerima->programBantuan->tahun_anggaran ?? '2026' }}</span>
                    </div>
                    <div class="sm:col-span-2 p-3 bg-surface-muted rounded-lg">
                        <span class="text-text-tertiary text-xs block">Deskripsi & Target Sasaran</span>
                        <p class="text-text-secondary text-xs mt-0.5">{{ $keluarga_penerima->programBantuan->deskripsi ?? 'Bantuan bibit tanaman produktif untuk peningkatan pendapatan per bulan, peningkatan desil, dan pengentasan kemiskinan keluarga binaan.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Kartu Bantuan yang Telah Diterima Keluarga (Uang, Alat, Bibit) -->
            <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col gap-space-md">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-3 border-b border-border-light gap-2">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[24px]">volunteer_activism</span>
                        <div>
                            <h3 class="font-bold text-text-primary text-base">Riwayat Bantuan Diterima (Bibit, Uang & Alat)</h3>
                            <span class="text-xs text-text-secondary">Daftar bantuan yang telah disalurkan oleh pendamping ke keluarga ini</span>
                        </div>
                    </div>
                    <a href="{{ route('pendamping.penyaluran-bantuan.create', ['keluarga_id' => $keluarga_penerima->id]) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary hover:bg-gov-green-dark text-on-primary font-label-md text-xs font-bold transition-all shadow-sm shrink-0">
                        <span class="material-symbols-outlined text-[16px]">add_circle</span>
                        <span>+ Salurkan Bantuan</span>
                    </a>
                </div>

                @php
                    $bantuanList = $keluarga_penerima->penyaluranBantuans ?? collect();
                    $uangDiterima = $bantuanList->where('jenis', 'uang')->sum('nominal_uang');
                    $alatDiterima = $bantuanList->where('jenis', 'barang')->sum('jumlah');
                    $bibitDiterima = $bantuanList->where('jenis', 'bibit')->sum('jumlah');
                @endphp

                <!-- Mini KPI Ringkasan Bantuan Keluarga Ini -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="p-3 rounded-xl bg-gold-surface/60 border border-secondary/20 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-secondary text-on-secondary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px]">payments</span>
                        </div>
                        <div>
                            <span class="text-[11px] font-semibold text-text-secondary block">Total Uang Modal</span>
                            <span class="text-sm font-bold text-text-primary">Rp {{ number_format($uangDiterima, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="p-3 rounded-xl bg-amber-50 border border-amber-200 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-amber-600 text-white flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px]">home_repair_service</span>
                        </div>
                        <div>
                            <span class="text-[11px] font-semibold text-text-secondary block">Barang / Alat Usaha</span>
                            <span class="text-sm font-bold text-text-primary">{{ number_format($alatDiterima) }} Unit</span>
                        </div>
                    </div>

                    <div class="p-3 rounded-xl bg-gov-green-surface border border-primary/20 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-primary text-on-primary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px]">potted_plant</span>
                        </div>
                        <div>
                            <span class="text-[11px] font-semibold text-text-secondary block">Bibit Tanaman</span>
                            <span class="text-sm font-bold text-text-primary">{{ number_format($bibitDiterima) }} Bibit</span>
                        </div>
                    </div>
                </div>

                <!-- Tabel Rincian Bantuan -->
                @if($bantuanList->count() > 0)
                <div class="overflow-x-auto border border-border-light rounded-xl">
                    <table class="w-full text-left font-body-sm text-xs">
                        <thead class="bg-surface-muted text-text-secondary font-semibold border-b border-border-light">
                            <tr>
                                <th class="py-2.5 px-3">Tgl Salur</th>
                                <th class="py-2.5 px-3">Item Bantuan</th>
                                <th class="py-2.5 px-3">Jumlah / Nilai</th>
                                <th class="py-2.5 px-3">Peruntukan Dana / Keperluan</th>
                                <th class="py-2.5 px-3">Penyalur</th>
                                <th class="py-2.5 px-3 text-right">Tanda Terima</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-light bg-canvas-bg">
                            @foreach ($bantuanList as $bantuan)
                            <tr class="hover:bg-surface-subtle transition-colors">
                                <td class="py-2.5 px-3 whitespace-nowrap text-text-secondary">
                                    {{ \Carbon\Carbon::parse($bantuan->tgl_penyaluran)->translatedFormat('d M Y') }}
                                </td>
                                <td class="py-2.5 px-3">
                                    <div class="flex items-center gap-1.5">
                                        @if($bantuan->jenis === 'bibit')
                                            <span class="p-0.5 rounded bg-gov-green-surface text-primary">
                                                <span class="material-symbols-outlined text-[14px]">potted_plant</span>
                                            </span>
                                        @elseif($bantuan->jenis === 'uang')
                                            <span class="p-0.5 rounded bg-gold-surface text-secondary">
                                                <span class="material-symbols-outlined text-[14px]">payments</span>
                                            </span>
                                        @else
                                            <span class="p-0.5 rounded bg-amber-100 text-amber-800">
                                                <span class="material-symbols-outlined text-[14px]">home_repair_service</span>
                                            </span>
                                        @endif
                                        <span class="font-bold text-text-primary">{{ $bantuan->itemBantuan->nama_item ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="py-2.5 px-3 font-semibold">
                                    @if($bantuan->jenis === 'uang')
                                        <span class="text-emerald-700">Rp {{ number_format($bantuan->nominal_uang ?? $bantuan->jumlah, 0, ',', '.') }}</span>
                                    @else
                                        <span>{{ number_format($bantuan->jumlah) }} {{ $bantuan->satuan }}</span>
                                    @endif
                                </td>
                                <td class="py-2.5 px-3">
                                    @if($bantuan->peruntukan)
                                        <span class="font-semibold text-blue-700 block">{{ $bantuan->peruntukan }}</span>
                                    @endif
                                    @if($bantuan->keterangan)
                                        <span class="text-text-tertiary block">{{ $bantuan->keterangan }}</span>
                                    @endif
                                    @if(!$bantuan->peruntukan && !$bantuan->keterangan)
                                        <span class="text-text-tertiary">-</span>
                                    @endif
                                </td>
                                <td class="py-2.5 px-3 text-text-secondary">
                                    {{ $bantuan->pendamping->name ?? 'Pendamping' }}
                                </td>
                                <td class="py-2.5 px-3 text-right">
                                    <a href="{{ route('pendamping.penyaluran-bantuan.show', $bantuan->id) }}" class="inline-flex items-center gap-1 px-2 py-1 rounded bg-surface-muted hover:bg-surface-subtle text-primary font-semibold text-[11px] transition-colors">
                                        <span class="material-symbols-outlined text-[14px]">receipt_long</span>
                                        <span>Bukti</span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="p-6 rounded-xl border border-dashed border-border-light text-center flex flex-col items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[32px] text-text-tertiary">inventory_2</span>
                    <p class="text-xs text-text-secondary font-medium">Belum ada bantuan yang tercatat disalurkan ke keluarga ini.</p>
                    <a href="{{ route('pendamping.penyaluran-bantuan.create', ['keluarga_id' => $keluarga_penerima->id]) }}" class="mt-1 inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary text-on-primary font-label-sm text-xs font-bold hover:bg-gov-green-dark transition-all">
                        <span class="material-symbols-outlined text-[14px]">add</span>
                        <span>Salurkan Bantuan (Bibit, Uang, atau Alat)</span>
                    </a>
                </div>
                @endif
            </div>

            <!-- Kartu Perkembangan Kemandirian & Riwayat Desil -->
            <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-3 border-b border-border-light gap-2 mb-4">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary text-[22px]">analytics</span>
                        <div>
                            <h3 class="font-bold text-text-primary text-base">Riwayat Penilaian Desil & Kemandirian</h3>
                            <span class="text-xs text-text-secondary">Catatan evaluasi peningkatan pendapatan dan taraf hidup</span>
                        </div>
                    </div>
                    <a href="{{ route('pendamping.keluarga_penerima.penilaian.create', $keluarga_penerima->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary hover:bg-gov-green-dark text-white font-label-md text-xs font-semibold transition-colors shadow-sm shrink-0">
                        <span class="material-symbols-outlined text-[14px]">add</span>
                        <span>Input Penilaian Baru</span>
                    </a>
                </div>

                @if($keluarga_penerima->penilaianKemandirians->count() > 0)
                <div class="flex flex-col divide-y divide-border-light">
                    @foreach($keluarga_penerima->penilaianKemandirians as $nilai)
                    <div class="py-4 first:pt-0 last:pb-0 flex flex-col gap-3">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-text-primary text-sm">{{ $nilai->periode }}</span>
                                <span class="text-text-tertiary text-xs">• {{ \Carbon\Carbon::parse($nilai->created_at)->format('d M Y, H:i') }}</span>
                                @if($nilai->pendamping)
                                    <span class="text-text-tertiary text-[11px]">(Oleh: {{ $nilai->pendamping->name }})</span>
                                @endif
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded text-xs font-bold bg-gov-green-surface text-primary border border-primary/20">
                                    Desil {{ $nilai->desil_hasil ?? $keluarga_penerima->desil }}
                                </span>
                                @if($nilai->status_perkembangan == 'Maju')
                                    <span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded text-xs font-bold bg-green-100 text-green-800">
                                        <span class="material-symbols-outlined text-[14px]">trending_up</span>
                                        Maju
                                    </span>
                                @elseif($nilai->status_perkembangan == 'Tetap')
                                    <span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded text-xs font-bold bg-blue-100 text-blue-800">
                                        <span class="material-symbols-outlined text-[14px]">trending_flat</span>
                                        Tetap
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded text-xs font-bold bg-amber-100 text-amber-800">
                                        <span class="material-symbols-outlined text-[14px]">trending_down</span>
                                        Mundur
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Parameter Indikator Sosial Ekonomi -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-xs">
                            <div class="p-2.5 rounded-lg bg-surface-muted">
                                <span class="text-text-tertiary text-[11px] block">Penghasilan / bln:</span>
                                <span class="font-bold text-text-primary font-mono">
                                    Rp {{ number_format($nilai->penghasilan_perbulan ?? 0, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="p-2.5 rounded-lg bg-surface-muted">
                                <span class="text-text-tertiary text-[11px] block">Pendapatan / kapita:</span>
                                <span class="font-bold text-primary font-mono">
                                    Rp {{ number_format($nilai->pendapatan_per_kapita ?? 0, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="p-2.5 rounded-lg bg-surface-muted">
                                <span class="text-text-tertiary text-[11px] block">Kondisi Rumah:</span>
                                <span class="font-semibold text-text-primary capitalize">
                                    {{ str_replace('_', ' ', $nilai->aset_rumah ?? 'Semi Permanen') }}
                                </span>
                            </div>
                            <div class="p-2.5 rounded-lg bg-surface-muted">
                                <span class="text-text-tertiary text-[11px] block">Skor Sistem:</span>
                                <span class="font-bold text-secondary">
                                    {{ $nilai->total_skor ?? 0 }} / 100
                                </span>
                            </div>
                        </div>

                        <!-- Rincian Tambahan Aset & Catatan -->
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-text-secondary">
                            <span><strong class="text-text-primary">Tanggungan Anak:</strong> {{ $nilai->jumlah_anak ?? '-' }} anak</span>
                            <span>•</span>
                            <span><strong class="text-text-primary">Kepemilikan Lahan:</strong> {{ str_replace('_', ' ', $nilai->aset_tanah ?? '-') }}</span>
                            <span>•</span>
                            <span><strong class="text-text-primary">Kendaraan:</strong> {{ str_replace('_', ' ', $nilai->aset_kendaraan ?? '-') }}</span>
                        </div>

                        @if($nilai->catatan)
                        <div class="p-2.5 rounded-lg bg-surface-subtle text-xs text-text-secondary border-l-2 border-primary">
                            <span class="font-semibold text-text-primary block mb-0.5">Catatan Pendamping:</span>
                            <p class="italic">{{ $nilai->catatan }}</p>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-10 text-text-tertiary text-sm flex flex-col items-center">
                    <span class="material-symbols-outlined text-4xl block mb-2 text-text-tertiary">query_stats</span>
                    <p class="font-semibold text-text-secondary">Belum ada penilaian subjektif desil untuk keluarga ini.</p>
                    <p class="text-xs text-text-tertiary mt-1 max-w-md">
                        Lakukan penginputan indikator pendapatan bulanan, jumlah anak, dan aset untuk mengetahui desil terkini sesuai peraturan standar.
                    </p>
                    <a href="{{ route('pendamping.keluarga_penerima.penilaian.create', $keluarga_penerima->id) }}" class="mt-4 px-4 py-2 rounded-xl bg-primary hover:bg-gov-green-dark text-white font-label-md text-xs font-semibold transition-colors shadow-sm flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">rate_review</span>
                        <span>Mulai Penilaian Desil Sekarang</span>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
