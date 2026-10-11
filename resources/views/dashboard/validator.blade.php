@extends('layouts.validator')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Halo, {{ Auth::user()->name }} 🕵️‍♀️</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Periksa antrean laporan survei dan CPCL dari pendamping lapangan untuk diverifikasi sebelum dikirim ke Pemda.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <a href="{{ route('validator.antrean.index') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">domain_verification</span>
                <span>Buka Semua Antrean ({{ $totalAntrean }})</span>
            </a>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
        <a href="{{ route('validator.antrean.index') }}" class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-center hover:border-primary/50 hover:shadow transition-all group">
            <div class="flex items-center justify-between mb-2">
                <span class="font-label-md text-label-md text-text-secondary uppercase group-hover:text-primary transition-colors">Antrean Verifikasi</span>
                <span class="material-symbols-outlined text-status-warning group-hover:scale-110 transition-transform">pending_actions</span>
            </div>
            <span class="font-headline-xl text-headline-xl text-status-warning font-bold">{{ $totalAntrean }} Laporan</span>
            <div class="flex items-center justify-between mt-1">
                <span class="text-label-sm text-text-secondary">Laporan dari Pendamping menunggu direview</span>
                <span class="text-xs text-primary font-semibold flex items-center gap-0.5">Buka Antrean <span class="material-symbols-outlined text-[14px]">arrow_forward</span></span>
            </div>
        </a>
        <a href="{{ route('validator.riwayat.index') }}" class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-center hover:border-primary/50 hover:shadow transition-all group">
            <div class="flex items-center justify-between mb-2">
                <span class="font-label-md text-label-md text-text-secondary uppercase group-hover:text-primary transition-colors">Selesai Diverifikasi</span>
                <span class="material-symbols-outlined text-status-verified group-hover:scale-110 transition-transform">verified_user</span>
            </div>
            <span class="font-headline-xl text-headline-xl text-status-verified font-bold">{{ $totalSelesai }} Laporan</span>
            <div class="flex items-center justify-between mt-1">
                <span class="text-label-sm text-text-secondary">Riwayat validasi yang telah diproses</span>
                <span class="text-xs text-primary font-semibold flex items-center gap-0.5">Lihat Riwayat <span class="material-symbols-outlined text-[14px]">arrow_forward</span></span>
            </div>
        </a>
    </div>

    <!-- Review Tasks List -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light p-space-lg">
        <div class="flex items-center justify-between mb-space-md pb-2 border-b border-border-light">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[24px]">assignment_late</span>
                <h2 class="font-headline-sm text-headline-sm text-text-primary font-bold">Daftar Antrean Validasi Siap Direview</h2>
            </div>
            <a href="{{ route('validator.antrean.index') }}" class="text-xs text-primary font-semibold hover:underline flex items-center gap-0.5">
                Lihat Selengkapnya <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
            </a>
        </div>

        <div class="flex flex-col gap-space-sm">
            @forelse ($antreans as $antrean)
            <div class="p-space-md rounded-xl bg-surface-container/60 hover:bg-surface-container border border-border-light flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm transition-colors">
                <a href="{{ route('validator.antrean.edit', $antrean->id) }}" class="flex items-start gap-3 flex-1 min-w-0">
                    <div class="w-10 h-10 rounded-full bg-status-info-surface text-status-info flex items-center justify-center shrink-0 mt-0.5">
                        <span class="material-symbols-outlined">rule</span>
                    </div>
                    <div class="min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="font-label-md text-text-primary font-bold text-sm hover:text-primary transition-colors">
                                Survei: {{ $antrean->keluarga_penerima->kepala_keluarga ?? $antrean->keluarga_penerima->nama ?? 'Calon Penerima' }}
                            </span>
                            <span class="inline-flex px-2 py-0.5 rounded text-[11px] font-bold bg-status-warning-surface text-status-warning">
                                Menunggu Review
                            </span>
                        </div>
                        <span class="text-body-sm text-text-secondary block mt-0.5">
                            Wilayah: {{ $antrean->keluarga_penerima->wilayah->nama ?? 'Sumbawa' }} • Surveyor: <strong class="text-text-primary">{{ $antrean->pendamping->name ?? 'Pendamping Lapangan' }}</strong>
                        </span>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xs text-text-tertiary">Tgl Survei: {{ \Carbon\Carbon::parse($antrean->tgl_survei)->format('d M Y') }}</span>
                            @if($antrean->foto_lahan_url)
                                <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded bg-surface-container-high text-text-secondary text-[10px] font-semibold">
                                    <span class="material-symbols-outlined text-[12px]">photo_camera</span> Foto Terlampir
                                </span>
                            @endif
                            @if($antrean->catatan)
                                <span class="text-xs text-text-secondary italic truncate max-w-[280px]">"{{ $antrean->catatan }}"</span>
                            @endif
                        </div>
                    </div>
                </a>
                <div class="flex items-center gap-2 shrink-0 sm:self-center">
                    <a href="{{ route('validator.antrean.show', $antrean->id) }}" class="px-3 py-1.5 bg-surface-container-high text-text-primary hover:bg-surface-variant font-label-sm text-xs rounded-lg border border-border-light transition-colors flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">visibility</span>
                        <span>Detail</span>
                    </a>
                    <a href="{{ route('validator.antrean.edit', $antrean->id) }}" class="px-3.5 py-1.5 bg-primary-container text-on-primary hover:bg-gov-green-dark font-label-sm text-xs font-semibold rounded-lg shadow-sm transition-colors flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">fact_check</span>
                        <span>Review Sekarang</span>
                    </a>
                </div>
            </div>
            @empty
            <div class="text-center py-12 text-text-secondary">
                <span class="material-symbols-outlined text-[48px] text-border-medium mb-2 block">task_alt</span>
                <p class="font-body-md text-text-primary font-semibold mb-1">Semua Selesai!</p>
                <p class="font-body-md text-xs text-text-tertiary mb-3">Tidak ada antrean validasi yang perlu direview saat ini.</p>
                <a href="{{ route('validator.riwayat.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-primary hover:underline">
                    Lihat Riwayat Hasil Validasi <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
