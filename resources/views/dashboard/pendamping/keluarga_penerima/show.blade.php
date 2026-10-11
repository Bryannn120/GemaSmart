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
            <a href="{{ route('pendamping.lapor.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">eco</span>
                <span>Lapor Tumbuh Kembang</span>
            </a>
        </div>
    </div>

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
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-status-info-surface text-status-info">
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
                        <span class="text-text-tertiary text-xs uppercase font-semibold block">Wilayah & Alamat</span>
                        <span class="text-text-primary font-medium">{{ $keluarga_penerima->wilayah->nama ?? 'Sumbawa' }}</span>
                        <p class="text-text-secondary text-xs mt-0.5">{{ $keluarga_penerima->alamat ?? '-' }}</p>
                    </div>

                    <div>
                        <span class="text-text-tertiary text-xs uppercase font-semibold block">Status Kemandirian</span>
                        <span class="inline-flex px-2 py-0.5 mt-1 rounded text-xs font-bold {{ $keluarga_penerima->status_kemandirian == 'Mandiri' ? 'bg-green-100 text-green-800' : ($keluarga_penerima->status_kemandirian == 'Berkembang' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-700') }}">
                            {{ $keluarga_penerima->status_kemandirian ?? 'Belum Dinilai' }}
                        </span>
                    </div>

                    @if($keluarga_penerima->kampusMitra)
                    <div>
                        <span class="text-text-tertiary text-xs uppercase font-semibold block">Kampus Pendamping</span>
                        <span class="text-text-primary font-medium">{{ $keluarga_penerima->kampusMitra->nama_kampus }}</span>
                    </div>
                    @endif
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
                        <span class="text-text-tertiary text-xs block">Deskripsi</span>
                        <p class="text-text-secondary text-xs mt-0.5">{{ $keluarga_penerima->programBantuan->deskripsi ?? 'Bantuan bibit tanaman produktif untuk peningkatan ekonomi dan kemandirian keluarga binaan.' }}</p>
                    </div>
                </div>
            </div>


            <!-- Kartu Perkembangan Kemandirian -->
            <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-primary text-[22px]">trending_up</span>
                    <h3 class="font-bold text-text-primary text-base">Riwayat Penilaian Kemandirian</h3>
                </div>

                @if($keluarga_penerima->penilaianKemandirians->count() > 0)
                <div class="flex flex-col divide-y divide-border-light">
                    @foreach($keluarga_penerima->penilaianKemandirians as $nilai)
                    <div class="py-3 flex items-center justify-between">
                        <div>
                            <span class="font-semibold text-text-primary block text-sm">Periode: {{ $nilai->periode }}</span>
                            <span class="text-xs text-text-tertiary">Status: {{ $nilai->status_perkembangan ?? 'Dalam Pendampingan' }}</span>
                        </div>
                        <div class="text-right">
                            <span class="font-bold text-lg text-primary">{{ $nilai->total_skor ?? 0 }}</span>
                            <span class="text-xs text-text-tertiary block">Skor Kemandirian</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-6 text-text-tertiary text-sm">
                    <span class="material-symbols-outlined text-3xl block mb-1">query_stats</span>
                    Belum ada penilaian berkala untuk keluarga penerima ini.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
