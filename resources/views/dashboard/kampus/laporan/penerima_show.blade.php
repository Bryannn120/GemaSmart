@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-lg">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-text-secondary font-label-md text-label-md">
        <a href="{{ route('kampus.laporan.index') }}" class="hover:text-primary transition-colors">Laporan Kampus</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <span class="text-text-primary font-semibold">Detail Laporan Warga Penerima</span>
    </div>

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <div class="flex items-center gap-2 flex-wrap">
                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-gov-green-surface text-primary uppercase tracking-wider">
                    Laporan Penerima Binaan #{{ $laporan->id }}
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
                Laporan dari {{ $laporan->keluargaPenerima->kepala_keluarga ?? ($laporan->pengirim_nama ?: 'Warga Binaan') }}
            </h1>
        </div>
        <div class="flex items-center gap-2 flex-wrap">
            @if($laporan->wa_sender)
            <a href="https://wa.me/{{ preg_replace('/\D/', '', $laporan->wa_sender) }}?text=Halo%20Bpk%2FIbu%20{{ urlencode($laporan->keluargaPenerima->kepala_keluarga ?? $laporan->pengirim_nama ?? 'Warga') }}%2C%20dari%20Tim%20Kampus%20Mitra%20GemaSmart%20menanggapi%20laporan%20Anda%20(Tiket%20%23LAP-{{ $laporan->id }})%3A%20" target="_blank" class="flex items-center gap-2 px-space-md py-space-sm rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-label-md font-semibold transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">chat</span>
                <span>Balas via WhatsApp</span>
            </a>
            @endif
            <a href="{{ route('kampus.laporan.index') }}" class="flex items-center gap-2 px-space-md py-space-sm rounded-lg bg-surface-container hover:bg-surface-container-high text-text-primary font-label-md font-semibold transition-colors">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                <span>Kembali ke Laporan</span>
            </a>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left: Isi Laporan & Data Penerima -->
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
                    <span class="font-label-md text-text-secondary block mb-2 font-semibold">Lampiran Foto Lapangan:</span>
                    <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Lampiran Laporan" class="max-h-80 rounded-xl border border-border-light object-cover shadow-sm"/>
                </div>
                @endif
            </div>

            <!-- Detail Identitas Keluarga Penerima -->
            <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-border-light">
                <h3 class="font-headline-sm font-bold text-text-primary flex items-center gap-2 mb-4 pb-3 border-b border-border-light">
                    <span class="material-symbols-outlined text-primary text-[22px]">badge</span>
                    Profil Keluarga Penerima Bantuan
                </h3>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <dt class="text-text-secondary font-label-md text-xs">Kepala Keluarga</dt>
                        <dd class="text-text-primary font-bold text-base mt-0.5">{{ $laporan->keluargaPenerima->kepala_keluarga ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-text-secondary font-label-md text-xs">Nomor Kartu Keluarga (KK)</dt>
                        <dd class="text-text-primary font-mono font-semibold mt-0.5">{{ $laporan->keluargaPenerima->no_kk ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-text-secondary font-label-md text-xs">NIK</dt>
                        <dd class="text-text-primary font-mono font-semibold mt-0.5">{{ $laporan->keluargaPenerima->nik ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-text-secondary font-label-md text-xs">Indikator Kemandirian</dt>
                        <dd class="text-text-primary font-semibold mt-0.5">
                            <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold bg-gov-green-surface text-primary border border-primary/20">
                                {{ $laporan->keluargaPenerima->status_kemandirian ?? ($laporan->keluargaPenerima ? 'Tingkat ' . $laporan->keluargaPenerima->desil : '-') }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-text-secondary font-label-md text-xs">Desa / Wilayah Binaan</dt>
                        <dd class="text-text-primary font-semibold mt-0.5">
                            {{ $laporan->keluargaPenerima->wilayah->nama ?? '-' }}
                            @if(isset($laporan->keluargaPenerima->wilayah->parent))
                                <span class="text-text-secondary font-normal text-xs">(Kec. {{ $laporan->keluargaPenerima->wilayah->parent->nama }})</span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-text-secondary font-label-md text-xs">Alamat Lengkap</dt>
                        <dd class="text-text-primary mt-0.5">{{ $laporan->keluargaPenerima->alamat ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-text-secondary font-label-md text-xs">Program Bantuan</dt>
                        <dd class="text-text-primary font-semibold mt-0.5">{{ $laporan->keluargaPenerima->programBantuan->nama_program ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-text-secondary font-label-md text-xs">Status Kemandirian</dt>
                        <dd class="text-text-primary font-semibold mt-0.5">
                            <span class="inline-block px-2 py-0.5 rounded text-xs font-bold bg-surface-container text-text-primary">
                                {{ $laporan->keluargaPenerima->status_kemandirian ?? 'Belum Dinilai' }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Right: Pendamping & Tindak Lanjut Kampus -->
        <div class="flex flex-col gap-6">
            <!-- Card Pendamping Lapangan -->
            <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-border-light">
                <div class="flex items-center gap-3 pb-3 border-b border-border-light mb-4">
                    <div class="w-10 h-10 rounded-full bg-gov-green-surface text-primary flex items-center justify-center font-bold">
                        <span class="material-symbols-outlined text-[22px]">support_agent</span>
                    </div>
                    <div>
                        <h3 class="font-headline-sm font-bold text-text-primary">Pendamping Lapangan</h3>
                        <p class="font-label-sm text-text-secondary text-xs">Mahasiswa / Kader Pendamping</p>
                    </div>
                </div>

                @php
                    $pendamping = $laporan->keluargaPenerima->pendamping ?? null;
                @endphp

                @if($pendamping)
                <div class="flex flex-col gap-3 text-sm">
                    <div>
                        <span class="text-text-secondary text-xs block">Nama Mahasiswa / Pendamping</span>
                        <span class="text-text-primary font-bold text-base block mt-0.5">{{ $pendamping->name }}</span>
                    </div>
                    <div>
                        <span class="text-text-secondary text-xs block">NIM / NIP</span>
                        <span class="text-text-primary font-medium block mt-0.5">{{ $pendamping->nim_nip ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-text-secondary text-xs block">Fakultas / Program Studi</span>
                        <span class="text-text-primary font-medium block mt-0.5">{{ $pendamping->fakultas_prodi ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-text-secondary text-xs block">Nomor Kontak / WhatsApp</span>
                        <span class="text-text-primary font-medium block mt-0.5">{{ $pendamping->no_hp ?? '-' }}</span>
                    </div>
                </div>
                @else
                <div class="p-4 bg-status-warning-surface/30 rounded-lg text-text-secondary text-xs flex items-center gap-2">
                    <span class="material-symbols-outlined text-status-warning text-[20px]">warning</span>
                    <span>Belum ada pendamping spesifik yang ditugaskan.</span>
                </div>
                @endif
            </div>

            <!-- Card Instruksi Tindak Lanjut -->
            <div class="bg-gov-green-dark text-on-primary rounded-xl p-5 shadow-sm">
                <span class="text-xs uppercase font-bold tracking-wider text-primary-fixed-dim block mb-1">Peran Kampus Mitra</span>
                <p class="text-sm font-semibold text-white">Laporan Warga Siap Ditindaklanjuti</p>
                <p class="text-xs text-primary-fixed-dim mt-2 leading-relaxed">
                    Koordinator kampus dapat menginstruksikan mahasiswa/pendamping terkait untuk melakukan kunjungan monitoring langsung ke lokasi penerima untuk memberikan pendampingan teknis dan solusi bibit.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
