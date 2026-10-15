@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Data Keluarga Penerima Bantuan</h1>
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

    <!-- Tabs & Filter Status -->
    <div class="flex items-center gap-2 border-b border-border-light pb-2">
        <a href="{{ route('kampus.keluarga_penerima.index', ['tab' => 'aktif']) }}" 
           class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 {{ $tab !== 'mandiri' ? 'bg-primary text-white shadow-sm' : 'bg-surface-subtle text-text-secondary hover:text-text-primary' }}">
            <span class="material-symbols-outlined text-[16px]">verified</span>
            <span>Penerima Bantuan Aktif</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $tab !== 'mandiri' ? 'bg-white/20 text-white' : 'bg-primary/10 text-primary font-bold' }}">{{ $countAktif }}</span>
        </a>
        <a href="{{ route('kampus.keluarga_penerima.index', ['tab' => 'mandiri']) }}" 
           class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 {{ $tab === 'mandiri' ? 'bg-emerald-700 text-white shadow-sm' : 'bg-surface-subtle text-text-secondary hover:text-text-primary' }}">
            <span class="material-symbols-outlined text-[16px]">workspace_premium</span>
            <span>Lulus Mandiri (Desil 6+)</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $tab === 'mandiri' ? 'bg-white/20 text-white' : 'bg-emerald-100 text-emerald-800 font-bold' }}">{{ $countMandiri }}</span>
        </a>
    </div>

    <!-- Table -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="p-space-md border-b border-border-light bg-surface-subtle flex items-center justify-between">
            <span class="text-xs font-bold text-text-primary uppercase tracking-wider">
                {{ $tab === 'mandiri' ? 'Keluarga Binaan Telah Mandiri / Lulus (Desil 6 ke atas)' : 'Daftar Penerima Bantuan Aktif Binaan Kampus (Desil 1 s/d 5)' }}
            </span>
            <span class="text-xs text-text-secondary font-medium">
                {{ $keluarga_penerimas->count() }} Data Ditampilkan
            </span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-container-low text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Nama Kepala Keluarga</th>
                        <th class="py-3 px-4 font-semibold">No. KK &amp; NIK</th>
                        <th class="py-3 px-4 font-semibold">Desa / Wilayah</th>
                        <th class="py-3 px-4 font-semibold">Desil &amp; Kemandirian</th>
                        <th class="py-3 px-4 font-semibold">Pendamping Lapangan</th>
                        <th class="py-3 px-4 font-semibold">Program Bantuan</th>
                        <th class="py-3 px-4 font-semibold">Status Validasi</th>
                        <th class="py-3 px-4 font-semibold text-right">Aksi</th>
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
                            @if($kp->desil >= 6 || strtolower($kp->status_kemandirian ?? '') === 'mandiri')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                    Desil {{ $kp->desil }} • Mandiri
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-gov-green-surface text-primary border border-primary/20">
                                    Desil {{ $kp->desil }} • Aktif
                                </span>
                            @endif
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
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <a href="{{ route('kampus.keluarga_penerima.show', $kp->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-surface-container-low hover:bg-surface-container-high text-text-secondary hover:text-text-primary text-xs font-semibold border border-border-light transition-colors" title="Lihat Profil Binaan">
                                <span class="material-symbols-outlined text-[16px]">visibility</span>
                                <span>Detail</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-12 text-center text-text-secondary">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[48px] text-border-medium">group_off</span>
                                <p class="text-base font-semibold">Belum ada data keluarga penerima bantuan.</p>
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
