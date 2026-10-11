@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Halo, {{ Auth::user()->name }} 👋</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Selamat bertugas! Kelola pendampingan keluarga binaan, lapor tumbuh kembang bibit, dan selesaikan validasi lapangan.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <a href="{{ route('pendamping.lapor.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">eco</span>
                <span>Buat Laporan Baru</span>
            </a>
            <a href="{{ route('pendamping.tugas-validasi.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-surface-container-high hover:bg-surface-container-highest text-text-primary font-label-md text-label-md font-semibold transition-colors border border-border-light shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add_task</span>
                <span>Input Validasi CPCL</span>
            </a>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-md">
        <a href="{{ route('pendamping.keluarga_penerima.index') }}" class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-center hover:border-primary/40 transition-colors">
            <div class="flex items-center justify-between mb-2">
                <span class="font-label-md text-label-md text-text-secondary uppercase">Keluarga Binaan</span>
                <span class="material-symbols-outlined text-primary">groups</span>
            </div>
            <span class="font-headline-xl text-headline-xl text-text-primary font-bold">{{ $totalBinaan ?? 0 }} KK</span>
            <span class="text-label-sm text-text-secondary mt-1">Penerima Bantuan Aktif</span>
        </a>

        <a href="{{ route('pendamping.tugas-validasi.index') }}" class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-center hover:border-primary/40 transition-colors">
            <div class="flex items-center justify-between mb-2">
                <span class="font-label-md text-label-md text-text-secondary uppercase">Tugas Validasi CPCL</span>
                <span class="material-symbols-outlined text-status-warning">assignment_late</span>
            </div>
            <span class="font-headline-xl text-headline-xl text-status-warning font-bold">{{ $totalValidasi ?? 0 }} Tugas</span>
            <span class="text-label-sm text-text-secondary mt-1">Survei Lapangan</span>
        </a>

        <a href="{{ route('pendamping.lapor.index') }}" class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-center hover:border-primary/40 transition-colors">
            <div class="flex items-center justify-between mb-2">
                <span class="font-label-md text-label-md text-text-secondary uppercase">Laporan Tumbuh Bibit</span>
                <span class="material-symbols-outlined text-status-verified">send</span>
            </div>
            <span class="font-headline-xl text-headline-xl text-status-verified font-bold">{{ $totalLaporanKirim ?? 0 }} Dikirim</span>
            <span class="text-label-sm text-text-secondary mt-1">Monitoring Berkala</span>
        </a>
    </div>

    <!-- Feed Tugas Lapangan & Aktivitas -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-space-lg">
        <!-- Tugas Validasi Mendesak -->
        <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col">
            <div class="flex items-center justify-between mb-space-md pb-2 border-b border-border-light">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-status-warning text-[22px]">assignment_late</span>
                    <h2 class="font-headline-sm text-headline-sm text-text-primary font-bold">Tugas Validasi CPCL</h2>
                </div>
                <a href="{{ route('pendamping.tugas-validasi.index') }}" class="text-xs text-primary font-semibold hover:underline">
                    Lihat Semua
                </a>
            </div>

            <div class="flex flex-col divide-y divide-border-light flex-1">
                @forelse ($validasiMendesak as $val)
                <div class="py-3 flex items-center justify-between gap-3 first:pt-0 last:pb-0">
                    <div>
                        <span class="font-semibold text-text-primary text-sm block">{{ $val->keluarga_penerima->kepala_keluarga ?? 'Calon Penerima' }}</span>
                        <span class="text-xs text-text-secondary">Desa {{ $val->keluarga_penerima->wilayah->nama ?? 'Sumbawa' }}</span>
                        <span class="text-[11px] text-text-tertiary block mt-0.5">Survei: {{ \Carbon\Carbon::parse($val->tgl_survei)->format('d M Y') }}</span>
                    </div>
                    <a href="{{ route('pendamping.tugas-validasi.show', $val->id) }}" class="px-3 py-1.5 bg-surface-container-low hover:bg-surface-container-high text-primary font-label-md text-label-md font-semibold rounded-lg border border-border-light transition-colors text-xs">
                        Periksa
                    </a>
                </div>
                @empty
                <div class="text-center py-8 text-text-tertiary text-sm">
                    <span class="material-symbols-outlined text-3xl block mb-1">task_alt</span>
                    Tidak ada tugas validasi tertunda.
                </div>
                @endforelse
            </div>
        </div>

        <!-- Aktivitas Laporan Tumbuh Kembang -->
        <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col">
            <div class="flex items-center justify-between mb-space-md pb-2 border-b border-border-light">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-[22px]">history</span>
                    <h2 class="font-headline-sm text-headline-sm text-text-primary font-bold">Laporan Tumbuh Kembang Terakhir</h2>
                </div>
                <a href="{{ route('pendamping.lapor.index') }}" class="text-xs text-primary font-semibold hover:underline">
                    Kelola Laporan
                </a>
            </div>

            <div class="flex flex-col divide-y divide-border-light flex-1">
                @forelse ($aktivitasTerakhir as $akt)
                <div class="py-3 flex items-start gap-3 first:pt-0 last:pb-0">
                    <div class="w-8 h-8 rounded-full bg-gov-green-surface text-primary flex items-center justify-center shrink-0 mt-0.5">
                        <span class="material-symbols-outlined text-[16px]">eco</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-text-primary text-sm truncate">{{ $akt->keluarga_penerima->kepala_keluarga ?? 'Penerima' }}</span>
                            <span class="text-[11px] text-text-tertiary">{{ \Carbon\Carbon::parse($akt->tanggal_lapor)->format('d M Y') }}</span>
                        </div>
                        <span class="text-xs font-bold inline-block {{ $akt->status_kondisi == 'normal' ? 'text-primary' : ($akt->status_kondisi == 'hama' ? 'text-status-warning' : 'text-status-fraud') }}">
                            Kondisi: {{ ucfirst($akt->status_kondisi) }}
                        </span>
                        <p class="text-xs text-text-secondary truncate mt-0.5">{{ $akt->catatan ?? '-' }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-text-tertiary text-sm">
                    <span class="material-symbols-outlined text-3xl block mb-1">pending_actions</span>
                    Belum ada riwayat laporan tumbuh kembang.
                </div>
                @endforelse
            </div>

            <div class="mt-4 pt-3 border-t border-border-light flex justify-between items-center">
                <span class="text-xs text-text-secondary">Siap melakukan monitoring lapangan?</span>
                <a href="{{ route('pendamping.lapor.create') }}" class="text-xs font-bold text-primary hover:underline">
                    + Input Laporan Tumbuh Kembang
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
