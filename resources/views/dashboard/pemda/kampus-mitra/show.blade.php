@extends('layouts.pemda')

@section('content')
<div class="flex flex-col gap-space-md">
    <div class="flex items-center gap-2 text-text-secondary font-label-md text-label-md">
        <a href="{{ route('pemda.kampus-mitra.index') }}" class="hover:text-primary transition-colors">Kampus Mitra</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <span class="text-text-primary font-semibold">Detail</span>
    </div>

    <div class="flex justify-between items-center">
        <div>
            <h1 class="font-headline-lg text-headline-lg font-bold text-text-primary">Detail Kampus Mitra</h1>
            <p class="font-body-md text-body-md text-text-secondary mt-1">Informasi lengkap data kerja sama perguruan tinggi.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('pemda.kampus-mitra.edit', $kampusMitra->id) }}" class="flex items-center gap-2 bg-primary text-on-primary px-space-md py-space-sm rounded-lg hover:bg-primary-container transition-colors shadow-sm font-label-lg text-label-lg font-semibold">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                <span>Edit</span>
            </a>
        </div>
    </div>

    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg max-w-2xl">
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-4 border-b border-border-light pb-4">
                <div class="w-16 h-16 rounded-full bg-status-verified-surface text-primary flex items-center justify-center font-bold text-2xl">
                    <span class="material-symbols-outlined text-[32px]">school</span>
                </div>
                <div>
                    <h3 class="font-headline-sm text-headline-sm font-bold text-text-primary">{{ $kampusMitra->nama_universitas }}</h3>
                    @if ($kampusMitra->status_mou == 'aktif')
                        <span class="inline-block px-2 py-0.5 rounded text-label-sm bg-status-verified-surface text-primary font-bold mt-1">MoU Aktif</span>
                    @else
                        <span class="inline-block px-2 py-0.5 rounded text-label-sm bg-status-warning-surface text-status-warning font-bold mt-1">MoU Tidak Aktif</span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <span class="text-text-secondary font-label-md text-label-md block">PIC / Koordinator</span>
                    <span class="text-text-primary font-semibold block mt-1">{{ $kampusMitra->pic_name }}</span>
                </div>
                <div>
                    <span class="text-text-secondary font-label-md text-label-md block">Kontak PIC</span>
                    <span class="text-text-primary font-semibold block mt-1">{{ $kampusMitra->pic_contact ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-text-secondary font-label-md text-label-md block">Email Akun</span>
                    <span class="text-text-primary font-semibold block mt-1">{{ $kampusMitra->user ? $kampusMitra->user->email : '-' }}</span>
                </div>
                <div>
                    <span class="text-text-secondary font-label-md text-label-md block">Wilayah Binaan</span>
                    <span class="text-text-primary font-semibold block mt-1">{{ $kampusMitra->wilayah_binaan ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-text-secondary font-label-md text-label-md block">MoU Berlaku Sampai</span>
                    <span class="text-text-primary font-semibold block mt-1">{{ $kampusMitra->mou_berlaku_sampai ? \Carbon\Carbon::parse($kampusMitra->mou_berlaku_sampai)->format('d M Y') : '-' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
