@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-lg">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-text-secondary font-label-md text-label-md">
        <a href="{{ route('pendamping.laporan-penerima.index') }}" class="hover:text-primary transition-colors">Laporan Warga Binaan</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <span class="text-text-primary font-semibold">Detail Laporan #{{ $laporan->id }}</span>
    </div>

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <div class="flex items-center gap-2 flex-wrap">
                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-gov-green-surface text-primary uppercase tracking-wider">
                    Laporan Warga #{{ $laporan->id }}
                </span>
                @if($laporan->is_whatsapp || $laporan->sumber === 'whatsapp')
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-300 flex items-center gap-1.5 shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span>
                        <span>WhatsApp API ({{ $laporan->formatted_wa_sender }})</span>
                    </span>
                @else
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">language</span>
                        <span>Portal Web</span>
                    </span>
                @endif
                <span class="text-text-secondary text-xs">
                    {{ $laporan->created_at->format('d M Y, H:i:s') }} WITA
                </span>
            </div>
            <h1 class="font-headline-lg text-headline-lg font-bold text-text-primary mt-1">
                Laporan dari {{ $laporan->keluargaPenerima->kepala_keluarga ?? ($laporan->pengirim_nama ?: 'Warga Penerima') }}
            </h1>
        </div>
        <div class="flex items-center gap-2 flex-wrap">
            @if($laporan->wa_sender)
            <a href="https://wa.me/{{ preg_replace('/\D/', '', $laporan->wa_sender) }}?text=Halo%20Bpk%2FIbu%20{{ urlencode($laporan->keluargaPenerima->kepala_keluarga ?? $laporan->pengirim_nama ?? 'Warga') }}%2C%20saya%20Pendamping%20Lapangan%20GemaSmart%20menanggapi%20laporan%20Anda%20(Tiket%20%23LAP-{{ $laporan->id }})%3A%20" target="_blank" class="flex items-center gap-2 px-space-md py-space-sm rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-label-md font-semibold transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">chat</span>
                <span>Balas via WhatsApp</span>
            </a>
            @endif
            <a href="{{ route('pendamping.laporan-penerima.index') }}" class="flex items-center gap-2 px-space-md py-space-sm rounded-lg bg-surface-container hover:bg-surface-container-high text-text-primary font-label-md font-semibold transition-colors">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                <span>Kembali ke Daftar</span>
            </a>
            @if($laporan->keluargaPenerima)
            <a href="{{ route('pendamping.keluarga_penerima.show', $laporan->keluargaPenerima->id) }}" class="flex items-center gap-2 px-space-md py-space-sm rounded-lg bg-primary text-white font-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">visibility</span>
                <span>Buka Profil KK</span>
            </a>
            @endif
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left: Isi Laporan & Tindak Lanjut -->
        <div class="lg:col-span-2 flex flex-col gap-6">
            <!-- Pesan / Isi Laporan -->
            <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-border-light">
                <h3 class="font-headline-sm font-bold text-text-primary flex items-center gap-2 mb-4 pb-3 border-b border-border-light">
                    <span class="material-symbols-outlined text-primary text-[22px]">chat</span>
                    Isi Laporan / Kendala yang Disampaikan Warga
                </h3>
                <div class="bg-surface-subtle p-5 rounded-xl border border-border-light text-text-primary text-base leading-relaxed whitespace-pre-line font-medium">
                    {{ $laporan->laporan_teks }}
                </div>
                @if ($laporan->foto)
                <div class="mt-4">
                    <span class="font-label-md text-text-secondary block mb-2 font-semibold">Foto Lampiran dari Warga:</span>
                    <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Lampiran Laporan" class="max-h-80 rounded-xl border border-border-light object-cover shadow-sm"/>
                </div>
                @endif
            </div>

            <!-- Tindak Lanjut Kunjungan Lapangan -->
            <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-border-light flex flex-col gap-4">
                <h3 class="font-headline-sm font-bold text-text-primary flex items-center gap-2 pb-3 border-b border-border-light">
                    <span class="material-symbols-outlined text-primary text-[22px]">assignment_turned_in</span>
                    Tindak Lanjut Pendamping
                </h3>
                <p class="text-xs text-text-secondary leading-relaxed">
                    Sebagai pendamping wilayah, Anda dapat langsung melakukan verifikasi atau kunjungan monitoring tumbuh kembang tanaman bibit ke rumah keluarga untuk membantu mengatasi kendala yang dilaporkan.
                </p>
                <div class="flex flex-wrap gap-2 pt-2">
                    <a href="{{ route('pendamping.lapor.create', ['keluarga_id' => $laporan->keluargaPenerima->id]) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary text-white font-semibold text-xs hover:bg-gov-green-dark transition-all shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">add_a_photo</span>
                        <span>Buat Laporan Kunjungan Monitoring</span>
                    </a>
                    <a href="{{ route('pendamping.keluarga_penerima.penilaian.create', $laporan->keluargaPenerima->id) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gov-green-surface text-primary border border-primary/20 font-semibold text-xs hover:bg-primary hover:text-white transition-all shadow-xs">
                        <span class="material-symbols-outlined text-[18px]">rate_review</span>
                        <span>Evaluasi Tolak Ukur Kemandirian</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right: Identitas KK & Kontak -->
        <div class="flex flex-col gap-6">
            <!-- Profil Singkat KK -->
            <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-border-light">
                <div class="flex items-center gap-3 pb-3 border-b border-border-light mb-4">
                    <div class="w-10 h-10 rounded-full bg-gov-green-surface text-primary flex items-center justify-center font-bold">
                        <span class="material-symbols-outlined text-[22px]">person</span>
                    </div>
                    <div>
                        <h3 class="font-headline-sm font-bold text-text-primary">{{ $laporan->keluargaPenerima->kepala_keluarga ?? '-' }}</h3>
                        <p class="font-label-sm text-text-secondary text-xs">Penerima Bantuan Binaan</p>
                    </div>
                </div>

                <div class="flex flex-col gap-3 text-sm">
                    <div>
                        <span class="text-text-secondary text-xs block">Nomor KK</span>
                        <span class="text-text-primary font-mono font-semibold block mt-0.5">{{ $laporan->keluargaPenerima->no_kk ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-text-secondary text-xs block">NIK</span>
                        <span class="text-text-primary font-mono font-semibold block mt-0.5">{{ $laporan->keluargaPenerima->nik ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-text-secondary text-xs block">Status Kemandirian</span>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="px-2 py-0.5 rounded text-xs font-bold {{ ($laporan->keluargaPenerima->status_kemandirian ?? '') === 'Mandiri' ? 'bg-green-100 text-green-800' : 'bg-gov-green-surface text-primary' }}">
                                {{ $laporan->keluargaPenerima->status_kemandirian ?? 'Tahap Kemandirian' }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <span class="text-text-secondary text-xs block">Wilayah / Desa</span>
                        <span class="text-text-primary font-medium block mt-0.5">
                            {{ $laporan->keluargaPenerima->wilayah->nama ?? '-' }}
                            @if(isset($laporan->keluargaPenerima->wilayah->parent))
                                (Kec. {{ $laporan->keluargaPenerima->wilayah->parent->nama }})
                            @endif
                        </span>
                    </div>
                    <div>
                        <span class="text-text-secondary text-xs block">Alamat Lengkap</span>
                        <span class="text-text-primary text-xs block mt-0.5">{{ $laporan->keluargaPenerima->alamat ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-text-secondary text-xs block">Program Bantuan</span>
                        <span class="text-text-primary font-medium block mt-0.5">{{ $laporan->keluargaPenerima->programBantuan->nama_program ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Kampus Pembina -->
            @if($laporan->keluargaPenerima->kampusMitra)
            <div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm border border-border-light text-xs">
                <span class="text-text-tertiary block font-semibold uppercase mb-1">Kampus Mitra Pembina</span>
                <span class="font-bold text-text-primary block text-sm">{{ $laporan->keluargaPenerima->kampusMitra->nama_universitas }}</span>
                <span class="text-text-secondary block mt-0.5">Koordinator: {{ $laporan->keluargaPenerima->kampusMitra->pic_name }}</span>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
