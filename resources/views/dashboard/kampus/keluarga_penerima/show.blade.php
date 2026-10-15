@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <div class="flex items-center gap-2 mb-1">
                <a href="{{ route('kampus.keluarga_penerima.index') }}" class="text-text-secondary hover:text-primary transition-colors flex items-center gap-1 font-body-sm text-sm">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    <span>Kembali ke Daftar Penerima Bantuan</span>
                </a>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Detail Keluarga Penerima Bantuan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Informasi profil penerima bantuan, status desil, dan rekam jejak pembinaan oleh kampus.
            </p>
        </div>
        <div class="flex items-center gap-space-sm">
            @if($keluarga_penerima->is_mandiri)
                <span class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-100 text-emerald-800 font-label-md text-xs font-bold border border-emerald-300">
                    <span class="material-symbols-outlined text-[18px]">workspace_premium</span>
                    <span>Telah Lulus Mandiri (Desil {{ $keluarga_penerima->desil }})</span>
                </span>
            @else
                <span class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-gov-green-surface text-primary font-label-md text-xs font-bold border border-primary/20">
                    <span class="material-symbols-outlined text-[18px]">verified</span>
                    <span>Penerima Bantuan Aktif (Desil {{ $keluarga_penerima->desil }})</span>
                </span>
            @endif
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-space-lg">
        <!-- Kolom Kiri: Profil Singkat KK -->
        <div class="lg:col-span-1 flex flex-col gap-space-md">
            <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col items-center text-center">
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
                    @elseif ($keluarga_penerima->status_validasi == 'anomali')
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-status-fraud-surface text-status-fraud flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">cancel</span>
                            Anomali
                        </span>
                    @else
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-status-warning-surface text-status-warning flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">hourglass_empty</span>
                            Proses
                        </span>
                    @endif
                </div>

                <div class="w-full border-t border-border-light my-4"></div>

                <div class="w-full text-left flex flex-col gap-3 text-sm">
                    <div>
                        <span class="text-text-tertiary text-xs uppercase font-semibold block">Penghasilan Terkini</span>
                        <span class="text-text-primary font-bold text-base font-mono">
                            @if(($keluarga_penerima->penghasilan_perbulan ?? 0) > 0)
                                Rp {{ number_format($keluarga_penerima->penghasilan_perbulan, 0, ',', '.') }} <span class="text-xs font-normal text-text-secondary">/bln</span>
                            @else
                                <span class="text-text-tertiary font-normal text-xs">Belum diinput</span>
                            @endif
                        </span>
                    </div>

                    <div>
                        <span class="text-text-tertiary text-xs uppercase font-semibold block">Status Kemandirian</span>
                        <span class="text-text-primary font-semibold text-sm">
                            {{ $keluarga_penerima->status_kemandirian ?? 'Belum Dinilai' }}
                        </span>
                    </div>

                    <div>
                        <span class="text-text-tertiary text-xs uppercase font-semibold block">Pendamping Bertugas</span>
                        <span class="text-text-primary font-semibold text-sm">
                            {{ $keluarga_penerima->pendamping->name ?? 'Belum ditugaskan' }}
                        </span>
                    </div>

                    <div>
                        <span class="text-text-tertiary text-xs uppercase font-semibold block">Desa / Wilayah</span>
                        <span class="text-text-primary font-semibold text-sm">
                            {{ $keluarga_penerima->wilayah->nama ?? '-' }}
                        </span>
                    </div>

                    <div>
                        <span class="text-text-tertiary text-xs uppercase font-semibold block">Alamat Lengkap</span>
                        <span class="text-text-secondary text-xs">
                            {{ $keluarga_penerima->alamat ?? '-' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Rincian Program & Penyaluran Bantuan -->
        <div class="lg:col-span-2 flex flex-col gap-space-lg">
            <!-- Program Bantuan -->
            <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col gap-3">
                <div class="flex items-center gap-2 border-b border-border-light pb-3">
                    <span class="material-symbols-outlined text-primary text-[22px]">inventory_2</span>
                    <h3 class="font-headline-sm font-bold text-text-primary">Program Bantuan Diikuti</h3>
                </div>
                @if($keluarga_penerima->programBantuan)
                    <div class="bg-surface-container-low/50 rounded-xl p-4 border border-border-light flex flex-col gap-1">
                        <span class="text-xs font-bold text-primary uppercase tracking-wider">Tahun Anggaran {{ $keluarga_penerima->programBantuan->tahun_anggaran }}</span>
                        <h4 class="text-base font-bold text-text-primary">{{ $keluarga_penerima->programBantuan->nama_program }}</h4>
                        <p class="text-sm text-text-secondary mt-1">{{ $keluarga_penerima->programBantuan->deskripsi ?? 'Program bantuan peningkatan ekonomi masyarakat berbasis bibit produktif.' }}</p>
                    </div>
                @else
                    <p class="text-sm text-text-tertiary italic">Belum terhubung ke program bantuan spesifik.</p>
                @endif
            </div>

            <!-- Riwayat Penyaluran Bantuan -->
            <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col gap-3">
                <div class="flex items-center justify-between border-b border-border-light pb-3">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-emerald-700 text-[22px]">volunteer_activism</span>
                        <h3 class="font-headline-sm font-bold text-text-primary">Riwayat Penyaluran Bantuan</h3>
                    </div>
                    <span class="text-xs text-text-secondary font-medium">
                        {{ $keluarga_penerima->penyaluranBantuans ? $keluarga_penerima->penyaluranBantuans->count() : 0 }} Penyaluran
                    </span>
                </div>

                @if($keluarga_penerima->penyaluranBantuans && $keluarga_penerima->penyaluranBantuans->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left font-body-sm text-sm">
                            <thead class="bg-surface-container-low text-text-secondary text-xs">
                                <tr>
                                    <th class="py-2.5 px-3">Tanggal</th>
                                    <th class="py-2.5 px-3">Bantuan</th>
                                    <th class="py-2.5 px-3">Jenis</th>
                                    <th class="py-2.5 px-3">Jumlah / Nilai</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border-light">
                                @foreach($keluarga_penerima->penyaluranBantuans as $pb)
                                <tr>
                                    <td class="py-2.5 px-3 text-xs text-text-secondary whitespace-nowrap">{{ $pb->tgl_penyaluran ? \Carbon\Carbon::parse($pb->tgl_penyaluran)->translatedFormat('d M Y') : '-' }}</td>
                                    <td class="py-2.5 px-3 font-semibold text-text-primary">{{ $pb->itemBantuan->nama_item ?? 'Bantuan' }}</td>
                                    <td class="py-2.5 px-3 capitalize text-xs">{{ $pb->jenis }}</td>
                                    <td class="py-2.5 px-3 font-bold text-emerald-700">
                                        @if($pb->jenis === 'uang')
                                            Rp {{ number_format($pb->nominal_uang ?? $pb->jumlah, 0, ',', '.') }}
                                        @else
                                            {{ $pb->jumlah }} {{ $pb->satuan }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-sm text-text-tertiary italic text-center py-6">Belum ada riwayat bantuan yang disalurkan.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
