@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Laporan &amp; Pengaduan Warga Binaan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Daftar kendala, keluhan, dan pesan WhatsApp yang dikirimkan langsung oleh keluarga penerima bantuan yang Anda dampingi.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <div class="px-3.5 py-1.5 rounded-xl bg-gov-green-surface text-primary border border-primary/20 flex items-center gap-2 text-xs font-bold">
                <span class="material-symbols-outlined text-[18px]">support_agent</span>
                <span>Wilayah: {{ auth()->user()->assigned_wilayah_label }}</span>
            </div>
        </div>
    </div>

    <!-- Summary Filter Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-md">
        <a href="{{ route('pendamping.laporan-penerima.index') }}" class="p-4 rounded-xl border {{ empty($filterStatus) ? 'border-primary bg-gov-green-surface/30' : 'border-border-light bg-surface-container-lowest hover:border-primary/50' }} transition-all flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">inbox</span>
                </div>
                <div>
                    <span class="text-xs text-text-secondary block font-medium">Semua Laporan</span>
                    <span class="text-lg font-bold text-text-primary">{{ $countTotal }}</span>
                </div>
            </div>
            <span class="material-symbols-outlined text-text-tertiary text-[18px]">chevron_right</span>
        </a>

        <a href="{{ route('pendamping.laporan-penerima.index', ['status' => 'unread']) }}" class="p-4 rounded-xl border {{ $filterStatus === 'unread' ? 'border-amber-500 bg-amber-50' : 'border-border-light bg-surface-container-lowest hover:border-amber-300' }} transition-all flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">mark_email_unread</span>
                </div>
                <div>
                    <span class="text-xs text-text-secondary block font-medium">Belum Dilihat</span>
                    <span class="text-lg font-bold text-amber-700">{{ $countUnread }}</span>
                </div>
            </div>
            <span class="material-symbols-outlined text-text-tertiary text-[18px]">chevron_right</span>
        </a>

        <a href="{{ route('pendamping.laporan-penerima.index', ['status' => 'read']) }}" class="p-4 rounded-xl border {{ $filterStatus === 'read' ? 'border-emerald-500 bg-emerald-50' : 'border-border-light bg-surface-container-lowest hover:border-emerald-300' }} transition-all flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">done_all</span>
                </div>
                <div>
                    <span class="text-xs text-text-secondary block font-medium">Sudah Dilihat</span>
                    <span class="text-lg font-bold text-emerald-700">{{ $countRead }}</span>
                </div>
            </div>
            <span class="material-symbols-outlined text-text-tertiary text-[18px]">chevron_right</span>
        </a>
    </div>

    <!-- Search Bar -->
    <div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm border border-border-light flex flex-col sm:flex-row items-center justify-between gap-3">
        <form action="{{ route('pendamping.laporan-penerima.index') }}" method="GET" class="w-full sm:w-96 flex items-center gap-2">
            @if($filterStatus)
                <input type="hidden" name="status" value="{{ $filterStatus }}">
            @endif
            <div class="relative w-full">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-tertiary text-[18px]">search</span>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama warga, KK, atau isi kendala..." class="w-full pl-9 pr-3.5 py-2 rounded-lg border border-border-medium bg-surface-subtle focus:bg-white text-xs text-text-primary focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
            </div>
            <button type="submit" class="px-3.5 py-2 rounded-lg bg-primary hover:bg-gov-green-dark text-white font-semibold text-xs transition-colors shrink-0">
                Cari
            </button>
            @if($search)
                <a href="{{ route('pendamping.laporan-penerima.index', ['status' => $filterStatus]) }}" class="px-2.5 py-2 rounded-lg bg-surface-container hover:bg-surface-container-high text-text-secondary text-xs font-semibold transition-colors">
                    Reset
                </a>
            @endif
        </form>
        <span class="text-xs text-text-secondary">Menampilkan {{ $laporanPenerimas->total() }} laporan</span>
    </div>

    <!-- Table Laporan Warga -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3.5 px-4 font-semibold">Tgl / Waktu</th>
                        <th class="py-3.5 px-4 font-semibold">Warga Penerima (KK)</th>
                        <th class="py-3.5 px-4 font-semibold">Kanal</th>
                        <th class="py-3.5 px-4 font-semibold">Desa / Wilayah</th>
                        <th class="py-3.5 px-4 font-semibold">Isi Laporan / Kendala</th>
                        <th class="py-3.5 px-4 font-semibold">Status</th>
                        <th class="py-3.5 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-surface-container-lowest">
                    @forelse ($laporanPenerimas as $lap)
                    <tr class="hover:bg-surface-subtle transition-colors {{ !$lap->is_read_by_pendamping ? 'bg-amber-50/40 font-medium' : '' }}">
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
                        <td class="py-3.5 px-4 max-w-sm">
                            <p class="truncate text-text-primary text-sm" title="{{ $lap->laporan_teks }}">
                                {{ $lap->laporan_teks }}
                            </p>
                            @if($lap->foto)
                                <span class="inline-flex items-center gap-1 text-[11px] text-primary font-semibold mt-0.5">
                                    <span class="material-symbols-outlined text-[13px]">photo_camera</span>
                                    Ada Lampiran Foto
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @if($lap->is_read_by_pendamping)
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-bold bg-surface-container text-text-secondary">
                                    Sudah Dilihat
                                </span>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800 animate-pulse">
                                    Baru Masuk
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <a href="{{ route('pendamping.laporan-penerima.show', $lap->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary text-on-primary hover:bg-gov-green-dark rounded-lg font-label-sm text-xs font-semibold transition-colors shadow-sm">
                                <span class="material-symbols-outlined text-[16px]">visibility</span>
                                <span>Lihat Detail</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-text-secondary">
                            <span class="material-symbols-outlined text-[48px] text-border-medium mb-2 block">inbox</span>
                            <p class="text-base font-semibold text-text-primary">Tidak ada laporan kendala dari warga binaan.</p>
                            <p class="text-xs text-text-tertiary mt-0.5">Laporan kendala atau masukan yang dikirim warga binaan akan muncul di sini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($laporanPenerimas->hasPages())
        <div class="p-4 border-t border-border-light bg-surface-subtle">
            {{ $laporanPenerimas->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
