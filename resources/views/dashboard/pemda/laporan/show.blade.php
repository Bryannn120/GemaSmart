@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-lg">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-text-secondary font-label-md text-label-md">
        <a href="{{ route('pemda.laporan.index') }}" class="hover:text-primary transition-colors">Laporan & Statistik</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <span class="text-text-primary font-semibold">Detail Laporan Penerima</span>
    </div>

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-gov-green-surface text-primary uppercase tracking-wider">
                    Laporan Masuk #{{ $laporan->id }}
                </span>
                <span class="text-text-secondary text-xs">
                    {{ $laporan->created_at->format('d M Y, H:i:s') }}
                </span>
            </div>
            <h1 class="font-headline-lg text-headline-lg font-bold text-text-primary mt-1">
                Laporan dari {{ $laporan->keluargaPenerima->kepala_keluarga ?? 'Warga Penerima' }}
            </h1>
        </div>
        <div>
            <a href="{{ route('pemda.laporan.index') }}" class="flex items-center gap-2 px-space-md py-space-sm rounded-lg bg-surface-container hover:bg-surface-container-high text-text-primary font-label-md font-semibold transition-colors">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                <span>Kembali ke Daftar</span>
            </a>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left: Isi Laporan & Data Penerima -->
        <div class="lg:col-span-2 flex flex-col gap-6">
            <!-- Pesan / Isi Laporan -->
            <div class="bg-canvas-bg rounded-xl p-6 shadow-sm border border-border-light">
                <h3 class="font-headline-sm font-bold text-text-primary flex items-center gap-2 mb-4 pb-3 border-b border-border-light">
                    <span class="material-symbols-outlined text-primary text-[22px]">chat</span>
                    Isi Laporan / Kendala yang Disampaikan Warga
                </h3>
                <div class="bg-surface-subtle p-5 rounded-xl border border-border-light text-text-primary text-base leading-relaxed whitespace-pre-line">
                    {{ $laporan->laporan_teks }}
                </div>
                @if ($laporan->foto)
                <div class="mt-4">
                    <span class="font-label-md text-text-secondary block mb-2">Lampiran Foto:</span>
                    <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Lampiran Laporan" class="max-h-72 rounded-lg border border-border-light object-cover"/>
                </div>
                @endif
            </div>

            <!-- Detail Identitas Keluarga Penerima -->
            <div class="bg-canvas-bg rounded-xl p-6 shadow-sm border border-border-light">
                <h3 class="font-headline-sm font-bold text-text-primary flex items-center gap-2 mb-4 pb-3 border-b border-border-light">
                    <span class="material-symbols-outlined text-primary text-[22px]">badge</span>
                    Profil Keluarga Penerima Bantuan
                </h3>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <dt class="text-text-secondary font-label-md">Kepala Keluarga</dt>
                        <dd class="text-text-primary font-bold text-base mt-0.5">{{ $laporan->keluargaPenerima->kepala_keluarga ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-text-secondary font-label-md">Nomor KK</dt>
                        <dd class="text-text-primary font-mono font-semibold mt-0.5">{{ $laporan->keluargaPenerima->no_kk ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-text-secondary font-label-md">NIK</dt>
                        <dd class="text-text-primary font-mono font-semibold mt-0.5">{{ $laporan->keluargaPenerima->nik ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-text-secondary font-label-md">Desil Kemiskinan</dt>
                        <dd class="text-text-primary font-semibold mt-0.5">
                            <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold bg-status-info-surface text-status-info">
                                Desil {{ $laporan->keluargaPenerima->desil ?? '-' }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-text-secondary font-label-md">Wilayah / Desa</dt>
                        <dd class="text-text-primary font-semibold mt-0.5">
                            {{ $laporan->keluargaPenerima->wilayah->nama ?? '-' }}
                            @if(isset($laporan->keluargaPenerima->wilayah->parent))
                                <span class="text-text-secondary font-normal text-xs">(Kec. {{ $laporan->keluargaPenerima->wilayah->parent->nama }})</span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-text-secondary font-label-md">Alamat Lengkap</dt>
                        <dd class="text-text-primary mt-0.5">{{ $laporan->keluargaPenerima->alamat ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-text-secondary font-label-md">Program Bantuan</dt>
                        <dd class="text-text-primary font-semibold mt-0.5">{{ $laporan->keluargaPenerima->programBantuan->nama_program ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-text-secondary font-label-md">Status Validasi / Kemandirian</dt>
                        <dd class="text-text-primary font-semibold mt-0.5">
                            <span class="inline-block px-2 py-0.5 rounded text-xs font-bold bg-gov-green-surface text-primary">
                                {{ ucfirst($laporan->keluargaPenerima->status_validasi ?? 'Belum') }}
                            </span>
                            <span class="inline-block px-2 py-0.5 rounded text-xs font-bold bg-surface-container text-text-primary ml-1">
                                {{ $laporan->keluargaPenerima->status_kemandirian ?? 'Belum Dinilai' }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Right: Penanggung Jawab (Pendamping & Kampus) -->
        <div class="flex flex-col gap-6">
            <!-- Card Pendamping Lapangan -->
            <div class="bg-canvas-bg rounded-xl p-6 shadow-sm border border-border-light">
                <div class="flex items-center gap-3 pb-3 border-b border-border-light mb-4">
                    <div class="w-10 h-10 rounded-full bg-gov-green-surface text-primary flex items-center justify-center font-bold">
                        <span class="material-symbols-outlined text-[22px]">support_agent</span>
                    </div>
                    <div>
                        <h3 class="font-headline-sm font-bold text-text-primary">Pendamping Bertanggung Jawab</h3>
                        <p class="font-label-sm text-text-secondary text-xs">Petugas Lapangan Wilayah</p>
                    </div>
                </div>

                @php
                    $pendamping = $laporan->keluargaPenerima->pendamping ?? null;
                @endphp

                @if($pendamping)
                <div class="flex flex-col gap-3 text-sm">
                    <div>
                        <span class="text-text-secondary text-xs block">Nama Lengkap</span>
                        <span class="text-text-primary font-bold text-base block mt-0.5">{{ $pendamping->name }}</span>
                    </div>
                    <div>
                        <span class="text-text-secondary text-xs block">Email Petugas</span>
                        <span class="text-text-primary font-medium block mt-0.5">{{ $pendamping->email }}</span>
                    </div>
                    <div>
                        <span class="text-text-secondary text-xs block">Peran Sistem</span>
                        <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold bg-status-verified-surface text-primary mt-1">
                            Pendamping Lapangan
                        </span>
                    </div>
                </div>
                @else
                <div class="p-4 bg-status-warning-surface/30 rounded-lg text-text-secondary text-xs flex items-center gap-2">
                    <span class="material-symbols-outlined text-status-warning text-[20px]">warning</span>
                    <span>Belum ada pendamping spesifik yang ditugaskan ke keluarga ini.</span>
                </div>
                @endif
            </div>

            <!-- Card Kampus Mitra -->
            <div class="bg-canvas-bg rounded-xl p-6 shadow-sm border border-border-light">
                <div class="flex items-center gap-3 pb-3 border-b border-border-light mb-4">
                    <div class="w-10 h-10 rounded-full bg-status-info-surface text-status-info flex items-center justify-center font-bold">
                        <span class="material-symbols-outlined text-[22px]">school</span>
                    </div>
                    <div>
                        <h3 class="font-headline-sm font-bold text-text-primary">Kampus Mitra Pelaksana</h3>
                        <p class="font-label-sm text-text-secondary text-xs">Perguruan Tinggi Pembina</p>
                    </div>
                </div>

                @php
                    $kampus = $laporan->keluargaPenerima->kampusMitra ?? ($pendamping->kampus ?? null);
                @endphp

                @if($kampus)
                <div class="flex flex-col gap-3 text-sm">
                    <div>
                        <span class="text-text-secondary text-xs block">Nama Universitas</span>
                        <span class="text-text-primary font-bold text-base block mt-0.5">{{ $kampus->nama_universitas }}</span>
                    </div>
                    <div>
                        <span class="text-text-secondary text-xs block">Koordinator / PIC</span>
                        <span class="text-text-primary font-medium block mt-0.5">{{ $kampus->pic_name }}</span>
                    </div>
                    <div>
                        <span class="text-text-secondary text-xs block">Kontak PIC</span>
                        <span class="text-text-primary font-medium block mt-0.5">{{ $kampus->pic_contact ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-text-secondary text-xs block">Wilayah Binaan Kampus</span>
                        <span class="text-text-primary font-semibold block mt-0.5">{{ $kampus->wilayah_binaan ?? 'Seluruh Sumbawa' }}</span>
                    </div>
                    <div>
                        <span class="text-text-secondary text-xs block">Status Kemitraan</span>
                        <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold {{ $kampus->status_mou == 'aktif' ? 'bg-status-verified-surface text-primary' : 'bg-status-warning-surface text-status-warning' }} mt-1">
                            MoU {{ ucfirst($kampus->status_mou) }}
                        </span>
                    </div>
                </div>
                @else
                <div class="p-4 bg-status-warning-surface/30 rounded-lg text-text-secondary text-xs flex items-center gap-2">
                    <span class="material-symbols-outlined text-status-warning text-[20px]">info</span>
                    <span>Informasi kampus mitra belum terhubung secara spesifik.</span>
                </div>
                @endif
            </div>

            <!-- Card Info Pengaduan -->
            <div class="bg-gov-green-dark text-on-primary rounded-xl p-5 shadow-sm">
                <span class="text-xs uppercase font-bold tracking-wider text-primary-fixed-dim block mb-1">Status Penanganan</span>
                <p class="text-sm font-semibold text-white">Laporan telah tercatat di basis data Pemda</p>
                <p class="text-xs text-primary-fixed-dim mt-2 leading-relaxed">
                    Pemda dapat langsung menginstruksikan kepada Pendamping ({{ $pendamping->name ?? 'Petugas Lapangan' }}) atau Kampus Mitra terkait untuk melakukan tindak lanjut di lokasi penerima.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
