@extends('layouts.pemda')

@section('content')
<div class="flex flex-col gap-space-md max-w-4xl mx-auto w-full">
    <div class="flex items-center gap-2 text-text-secondary font-label-md text-label-md">
        <a href="{{ route('pemda.pendamping.index') }}" class="hover:text-primary transition-colors">Data Pendamping</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <span class="text-text-primary font-semibold">Detail</span>
    </div>

    <div class="flex justify-between items-center">
        <div>
            <h1 class="font-headline-lg text-headline-lg font-bold text-text-primary">Detail Pendamping Lapangan</h1>
            <p class="font-body-md text-body-md text-text-secondary mt-1">Informasi lengkap profil pendamping dan asal perguruan tinggi mitra.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('pemda.pendamping.edit', $pendamping->id) }}" class="flex items-center gap-2 bg-primary text-on-primary px-space-md py-space-sm rounded-lg hover:bg-gov-green-dark transition-colors shadow-sm font-label-md text-label-md font-semibold">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                <span>Edit Profil</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-space-lg">
        <!-- Left: Profil Ringkas -->
        <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col items-center text-center">
            <div class="w-20 h-20 rounded-full bg-status-info-surface text-status-info flex items-center justify-center font-bold text-3xl mb-3 shadow-inner">
                {{ strtoupper(substr($pendamping->name, 0, 1)) }}
            </div>
            <h3 class="font-headline-sm text-headline-sm font-bold text-text-primary">{{ $pendamping->name }}</h3>
            <p class="text-xs text-text-secondary mt-0.5">{{ $pendamping->email }}</p>
            
            <div class="mt-3">
                @if(($pendamping->status_keaktifan ?? 'aktif') === 'aktif')
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Aktif Bertugas</span>
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                        <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                        <span>Nonaktif</span>
                    </span>
                @endif
            </div>

            <div class="w-full mt-6 pt-4 border-t border-border-light flex flex-col gap-3 text-left">
                <div>
                    <span class="text-xs text-text-tertiary block font-semibold uppercase">Nomor Kontak / WhatsApp</span>
                    @if($pendamping->no_hp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pendamping->no_hp) }}" target="_blank" class="text-sm font-bold text-emerald-700 hover:underline flex items-center gap-1 mt-0.5">
                            <span class="material-symbols-outlined text-[16px]">call</span>
                            <span>{{ $pendamping->no_hp }}</span>
                        </a>
                    @else
                        <span class="text-sm text-text-primary font-medium mt-0.5 block">-</span>
                    @endif
                </div>

                <div>
                    <span class="text-xs text-text-tertiary block font-semibold uppercase">NIM / NIP</span>
                    <span class="text-sm text-text-primary font-mono font-medium block mt-0.5">{{ $pendamping->nim_nip ?: '-' }}</span>
                </div>

                <div>
                    <span class="text-xs text-text-tertiary block font-semibold uppercase">Fakultas / Program Studi</span>
                    <span class="text-sm text-text-primary font-medium block mt-0.5">{{ $pendamping->fakultas_prodi ?: '-' }}</span>
                </div>

                <div>
                    <span class="text-xs text-text-tertiary block font-semibold uppercase">Terdaftar Pada</span>
                    <span class="text-sm text-text-primary font-medium block mt-0.5">{{ $pendamping->created_at ? $pendamping->created_at->format('d M Y H:i') : '-' }}</span>
                </div>
            </div>
        </div>

        <!-- Right: Asal Kampus Mitra & Wilayah Penugasan -->
        <div class="md:col-span-2 flex flex-col gap-space-lg">
            <!-- Card Asal Kampus Mitra -->
            <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg">
                <div class="flex items-center justify-between pb-3 border-b border-border-light">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[24px]">school</span>
                        <h4 class="font-headline-sm text-base font-bold text-text-primary">Asal Perguruan Tinggi (Kampus Mitra)</h4>
                    </div>
                    @if($pendamping->kampus)
                        <a href="{{ route('pemda.kampus-mitra.show', $pendamping->kampus->id) }}" class="text-xs font-bold text-primary hover:underline flex items-center gap-0.5">
                            <span>Lihat Kampus</span>
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                    @endif
                </div>

                <div class="mt-4">
                    @if($pendamping->kampus)
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-4 rounded-xl bg-blue-50/60 border border-blue-200">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-xl shrink-0 shadow-sm">
                                    <span class="material-symbols-outlined text-[26px]">apartment</span>
                                </div>
                                <div>
                                    <h5 class="text-base font-bold text-blue-950">{{ $pendamping->kampus->nama_universitas }}</h5>
                                    <p class="text-xs text-blue-800 mt-0.5">
                                        Koordinator/PIC: <strong>{{ $pendamping->kampus->pic_name }}</strong> ({{ $pendamping->kampus->pic_contact ?: 'Tanpa kontak' }})
                                    </p>
                                </div>
                            </div>
                            <div class="shrink-0">
                                @if($pendamping->kampus->status_mou === 'aktif')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                        <span class="material-symbols-outlined text-[14px]">verified</span>
                                        <span>MoU Aktif</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-300">
                                        <span>MoU Tidak Aktif</span>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-3">
                            <div class="p-3 rounded-lg bg-surface-subtle border border-border-light">
                                <span class="text-xs text-text-tertiary block">Email Kampus:</span>
                                <span class="text-sm font-semibold text-text-primary block mt-0.5">{{ $pendamping->kampus->user ? $pendamping->kampus->user->email : '-' }}</span>
                            </div>
                            <div class="p-3 rounded-lg bg-surface-subtle border border-border-light">
                                <span class="text-xs text-text-tertiary block">Wilayah Binaan Kampus:</span>
                                <span class="text-sm font-semibold text-text-primary block mt-0.5">{{ $pendamping->kampus->wilayah_binaan ?: '-' }}</span>
                            </div>
                        </div>
                    @else
                        <div class="p-6 text-center rounded-xl bg-surface-subtle border border-border-light text-text-secondary flex flex-col items-center gap-2">
                            <span class="material-symbols-outlined text-[36px] text-border-medium">domain_disabled</span>
                            <p class="text-sm font-semibold">Belum terafiliasi dengan Kampus Mitra.</p>
                            <p class="text-xs text-text-tertiary">Klik tombol "Edit Profil" untuk memilih kampus mitra tempat mahasiswa ini berasal.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Card Wilayah Penugasan & Keluarga Dampingan -->
            <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col gap-4">
                <div class="flex items-center gap-2 pb-3 border-b border-border-light">
                    <span class="material-symbols-outlined text-primary text-[24px]">pin_drop</span>
                    <h4 class="font-headline-sm text-base font-bold text-text-primary">Wilayah Penugasan &amp; Penerima Binaan</h4>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-3 rounded-xl bg-surface-subtle border border-border-light">
                        <span class="text-xs text-text-tertiary block font-semibold uppercase">Wilayah / Desa Penugasan</span>
                        <div class="flex items-center gap-1.5 mt-1 font-bold text-text-primary text-sm">
                            <span class="material-symbols-outlined text-[18px] text-primary">location_on</span>
                            <span>{{ $pendamping->assigned_wilayah_label ?: ($pendamping->desa_penugasan ?: 'Belum Ada Penugasan') }}</span>
                        </div>
                    </div>

                    <div class="p-3 rounded-xl bg-surface-subtle border border-border-light">
                        <span class="text-xs text-text-tertiary block font-semibold uppercase">Keluarga Penerima Bantuan (KK)</span>
                        <div class="flex items-center gap-1.5 mt-1 font-bold text-text-primary text-sm">
                            <span class="material-symbols-outlined text-[18px] text-blue-600">group</span>
                            <span>{{ $pendamping->keluarga_penerimas_count ?? 0 }} KK Terdaftar</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
