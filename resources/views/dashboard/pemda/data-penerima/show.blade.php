@extends('layouts.pemda')

@section('content')
<div class="flex flex-col gap-space-md">
    <div class="flex items-center gap-2 text-text-secondary font-label-md text-label-md">
        <a href="{{ route('pemda.data-penerima.index') }}" class="hover:text-primary transition-colors">Data Penerima</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <span class="text-text-primary font-semibold">Detail</span>
    </div>

    <div class="flex justify-between items-center">
        <div>
            <h1 class="font-headline-lg text-headline-lg font-bold text-text-primary">Detail Penerima Bantuan</h1>
            <p class="font-body-md text-body-md text-text-secondary mt-1">Informasi lengkap profil dan status penerima bantuan.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('pemda.data-penerima.edit', $keluarga_penerima->id) }}" class="flex items-center gap-2 bg-primary text-on-primary px-space-md py-space-sm rounded-lg hover:bg-primary-container transition-colors shadow-sm font-label-lg text-label-lg font-semibold">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                <span>Edit</span>
            </a>
        </div>
    </div>

    <div class="bg-canvas-bg rounded-xl border border-border-light shadow-sm p-space-lg">
        <div class="flex flex-col md:flex-row gap-6">
            <div class="flex-1">
                <h3 class="font-headline-sm text-headline-sm font-bold text-text-primary mb-4 pb-2 border-b border-border-light">Data Pribadi & Identitas</h3>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-label-md text-text-secondary">Nama Kepala Keluarga</dt>
                        <dd class="text-body-md text-text-primary font-semibold mt-1">{{ $keluarga_penerima->kepala_keluarga }}</dd>
                    </div>
                    <div>
                        <dt class="text-label-md text-text-secondary">NIK</dt>
                        <dd class="text-body-md text-text-primary font-mono mt-1">{{ $keluarga_penerima->nik }}</dd>
                    </div>
                    <div>
                        <dt class="text-label-md text-text-secondary">Nomor Kartu Keluarga (KK)</dt>
                        <dd class="text-body-md text-text-primary font-mono mt-1">{{ $keluarga_penerima->no_kk }}</dd>
                    </div>
                    <div>
                        <dt class="text-label-md text-text-secondary">Desil Kemiskinan</dt>
                        <dd class="text-body-md text-text-primary mt-1 font-semibold">Desil {{ $keluarga_penerima->desil }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-label-md text-text-secondary">Alamat</dt>
                        <dd class="text-body-md text-text-primary mt-1">{{ $keluarga_penerima->alamat ?? '-' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="w-full md:w-1/3 flex flex-col gap-4 border-t md:border-t-0 md:border-l border-border-light md:pl-6 pt-4 md:pt-0">
                <h3 class="font-headline-sm text-headline-sm font-bold text-text-primary mb-2">Status & Program</h3>
                
                <div>
                    <span class="text-label-md text-text-secondary block">Program Bantuan</span>
                    <span class="text-body-md text-text-primary font-semibold mt-1 block">{{ $keluarga_penerima->programBantuan->nama_program ?? '-' }}</span>
                </div>

                <div>
                    <span class="text-label-md text-text-secondary block">Wilayah / Desa</span>
                    <span class="text-body-md text-text-primary font-semibold mt-1 block">{{ $keluarga_penerima->wilayah->nama ?? '-' }}</span>
                </div>

                <div>
                    <span class="text-label-md text-text-secondary block">Status Validasi</span>
                    <div class="mt-1">
                        @if ($keluarga_penerima->status_validasi == 'valid')
                            <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-verified-surface text-primary font-bold">Valid</span>
                        @elseif ($keluarga_penerima->status_validasi == 'anomali')
                            <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-fraud-surface text-status-fraud font-bold">Anomali</span>
                        @else
                            <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-warning-surface text-status-warning font-bold">Menunggu Validasi</span>
                        @endif
                    </div>
                </div>

                <div>
                    <span class="text-label-md text-text-secondary block">Status Kemandirian</span>
                    <span class="text-body-md text-text-primary font-semibold mt-1 block">{{ $keluarga_penerima->status_kemandirian ?? 'Belum Dinilai' }}</span>
                </div>

                <div class="pt-3 border-t border-border-light">
                    <span class="text-label-md text-text-secondary block font-bold mb-1.5 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[18px] text-primary">support_agent</span>
                        <span>Pendamping Lapangan</span>
                    </span>
                    @if ($keluarga_penerima->pendamping)
                        <div class="p-3 rounded-xl bg-blue-50/70 border border-blue-200 flex flex-col gap-1">
                            <a href="{{ route('pemda.pendamping.show', $keluarga_penerima->pendamping->id) }}" class="font-bold text-sm text-blue-950 hover:underline">
                                {{ $keluarga_penerima->pendamping->name }}
                            </a>
                            @if($keluarga_penerima->pendamping->kampus)
                                <span class="text-xs text-blue-800 flex items-center gap-1 font-semibold">
                                    <span class="material-symbols-outlined text-[14px]">school</span>
                                    <span>{{ $keluarga_penerima->pendamping->kampus->nama_universitas }}</span>
                                </span>
                            @endif
                            @if($keluarga_penerima->pendamping->no_hp)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $keluarga_penerima->pendamping->no_hp) }}" target="_blank" class="text-xs text-emerald-700 hover:underline flex items-center gap-1 mt-0.5 font-medium">
                                    <span class="material-symbols-outlined text-[14px]">call</span>
                                    <span>{{ $keluarga_penerima->pendamping->no_hp }}</span>
                                </a>
                            @endif
                            <span class="text-[11px] text-text-secondary mt-0.5">
                                {{ $keluarga_penerima->pendamping->email }}
                            </span>
                        </div>
                    @else
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded text-xs font-medium bg-surface-muted text-text-tertiary italic">
                            <span class="material-symbols-outlined text-[14px]">person_off</span>
                            <span>Belum Ada Pendamping</span>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
