@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Data Keluarga Penerima Binaan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Daftar keluarga penerima manfaat bantuan bibit yang didampingi oleh kampus berdasarkan Surat Keputusan (SK).
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-gov-green-surface text-primary">
                Total: {{ $keluarga_penerimas->count() }} Keluarga
            </span>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-container-low text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Nama Kepala Keluarga</th>
                        <th class="py-3 px-4 font-semibold">No. KK & NIK</th>
                        <th class="py-3 px-4 font-semibold">Desa / Wilayah</th>
                        <th class="py-3 px-4 font-semibold">Desil</th>
                        <th class="py-3 px-4 font-semibold">Pendamping Lapangan</th>
                        <th class="py-3 px-4 font-semibold">Program Bantuan</th>
                        <th class="py-3 px-4 font-semibold">Status Validasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light">
                    @forelse ($keluarga_penerimas as $kp)
                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                        <td class="py-3.5 px-4 font-semibold text-text-primary">
                            {{ $kp->kepala_keluarga }}
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="font-mono text-text-primary block font-medium">{{ $kp->no_kk }}</span>
                            <span class="text-text-tertiary font-mono text-[11px]">NIK: {{ $kp->nik }}</span>
                        </td>
                        <td class="py-3.5 px-4 text-text-primary">
                            {{ $kp->wilayah->nama ?? '-' }}
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="inline-block px-2 py-0.5 rounded text-xs font-bold bg-status-info-surface text-status-info">
                                Desil {{ $kp->desil }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-text-primary">
                            @if ($kp->pendamping)
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-primary">support_agent</span>
                                    <span>{{ $kp->pendamping->name }}</span>
                                </div>
                            @else
                                <span class="text-text-tertiary italic text-xs">Belum ditugaskan</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-text-primary">
                            {{ $kp->programBantuan->nama_program ?? '-' }}
                        </td>
                        <td class="py-3.5 px-4">
                            @if ($kp->status_validasi == 'valid')
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-bold bg-status-verified-surface text-primary">Valid</span>
                            @elseif ($kp->status_validasi == 'anomali')
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-bold bg-status-fraud-surface text-status-fraud">Anomali</span>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-bold bg-status-warning-surface text-status-warning">Proses</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-text-secondary">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[48px] text-border-medium">group_off</span>
                                <p class="text-base font-semibold">Belum ada data keluarga penerima binaan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
