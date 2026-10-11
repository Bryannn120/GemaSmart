@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Keluarga Penerima Binaan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Daftar keluarga penerima manfaat program bantuan bibit yang berada dalam wilayah binaan dan pendampingan Anda di lapangan.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-gov-green-surface text-primary border border-primary/20">
                Total: {{ $keluarga_penerimas->count() }} Keluarga Binaan
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Card -->
    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Nama Kepala Keluarga</th>
                        <th class="py-3 px-4 font-semibold">No. KK & NIK</th>
                        <th class="py-3 px-4 font-semibold">Wilayah / Alamat</th>
                        <th class="py-3 px-4 font-semibold">Desil</th>
                        <th class="py-3 px-4 font-semibold">Program Bantuan</th>
                        <th class="py-3 px-4 font-semibold">Status Validasi</th>
                        <th class="py-3 px-4 font-semibold">Kemandirian</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($keluarga_penerimas as $kp)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4 font-semibold text-text-primary">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gov-green-surface text-primary flex items-center justify-center font-bold text-xs">
                                    {{ strtoupper(substr($kp->kepala_keluarga, 0, 1)) }}
                                </div>
                                <span>{{ $kp->kepala_keluarga }}</span>
                            </div>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="font-mono text-text-primary block font-medium">{{ $kp->no_kk }}</span>
                            <span class="text-text-tertiary font-mono text-[11px]">NIK: {{ $kp->nik }}</span>
                        </td>
                        <td class="py-3.5 px-4 text-text-primary">
                            <div>{{ $kp->wilayah->nama ?? 'Sumbawa' }}</div>
                            <span class="text-text-tertiary text-xs">{{ $kp->alamat }}</span>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="inline-block px-2 py-0.5 rounded text-xs font-bold bg-status-info-surface text-status-info">
                                Desil {{ $kp->desil }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-text-primary font-medium">
                            {{ $kp->programBantuan->nama_program ?? '-' }}
                        </td>
                        <td class="py-3.5 px-4">
                            @if ($kp->status_validasi == 'valid')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-status-verified-surface text-status-verified">
                                    <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                    Valid
                                </span>
                            @elseif ($kp->status_validasi == 'menunggu_validasi')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-status-warning-surface text-status-warning">
                                    <span class="material-symbols-outlined text-[14px]">hourglass_empty</span>
                                    Menunggu
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-status-fraud-surface text-status-fraud">
                                    <span class="material-symbols-outlined text-[14px]">cancel</span>
                                    Tidak Valid
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            @if ($kp->status_kemandirian == 'Mandiri')
                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-bold bg-green-100 text-green-800">
                                    Mandiri
                                </span>
                            @elseif ($kp->status_kemandirian == 'Berkembang')
                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-bold bg-blue-100 text-blue-800">
                                    Berkembang
                                </span>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-bold bg-gray-100 text-gray-700">
                                    {{ $kp->status_kemandirian ?? 'Belum Dinilai' }}
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <a href="{{ route('pendamping.keluarga_penerima.show', $kp->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-surface-container-low hover:bg-gov-green-surface text-primary font-label-md text-label-md font-semibold transition-colors border border-border-light">
                                <span class="material-symbols-outlined text-[16px]">visibility</span>
                                <span>Detail</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-12 text-text-tertiary">
                            <span class="material-symbols-outlined text-4xl block mb-2 text-text-tertiary">group_off</span>
                            Belum ada data keluarga penerima binaan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
