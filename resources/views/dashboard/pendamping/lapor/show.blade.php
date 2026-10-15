@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-6xl mx-auto">
    <!-- Top Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-space-md">
        <div class="flex flex-col">
            <a href="{{ route('pendamping.lapor.index') }}" class="inline-flex items-center gap-1 text-text-secondary hover:text-primary mb-2 font-label-md transition-colors w-fit">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                <span>Kembali ke Laporan Kunjungan</span>
            </a>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Histori Laporan Kunjungan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Laporan kunjungan keluarga penerima bantuan: <span class="font-semibold text-text-primary">{{ $laporan->keluarga_penerima->kepala_keluarga ?? '-' }}</span>
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <a href="{{ route('pendamping.lapor.create', ['program_id' => $laporan->program_bantuan_id, 'penyaluran_id' => $laporan->penyaluran_bantuan_id, 'keluarga_id' => $laporan->keluarga_penerima_id]) }}" class="inline-flex items-center gap-space-xs px-space-md py-2.5 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add_location_alt</span>
                <span>+ Catat Kunjungan Baru Program Ini</span>
            </a>
            <a href="{{ route('pendamping.lapor.edit', $laporan->id) }}" class="inline-flex items-center gap-space-xs px-space-md py-2.5 rounded-xl bg-surface-container-high hover:bg-surface-container-highest text-text-primary font-label-md text-label-md font-semibold transition-colors border border-border-light shadow-sm">
                <span class="material-symbols-outlined text-[18px]">edit_note</span>
                <span>Update Laporan Ini</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20 flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Info Banner Keluarga Penerima -->
    <div class="bg-canvas-bg rounded-2xl p-space-lg shadow-sm border border-border-light grid grid-cols-1 md:grid-cols-3 gap-space-lg">
        <div class="flex items-start gap-space-md">
            <div class="w-12 h-12 rounded-2xl bg-gov-green-surface text-primary flex items-center justify-center font-bold text-lg shrink-0 border border-primary/20">
                {{ strtoupper(substr($laporan->keluarga_penerima->kepala_keluarga ?? 'P', 0, 1)) }}
            </div>
            <div class="flex flex-col min-w-0">
                <span class="font-label-sm text-text-secondary uppercase tracking-wider text-[11px]">Keluarga Penerima</span>
                <h3 class="font-headline-sm font-bold text-text-primary truncate">{{ $laporan->keluarga_penerima->kepala_keluarga ?? '-' }}</h3>
                <span class="font-mono text-xs text-text-secondary mt-0.5">NIK: {{ $laporan->keluarga_penerima->nik ?? '-' }}</span>
                <span class="font-mono text-[11px] text-text-tertiary">No. KK: {{ $laporan->keluarga_penerima->no_kk ?? '-' }}</span>
            </div>
        </div>

        <div class="flex items-start gap-space-md border-t md:border-t-0 md:border-l border-border-light md:pl-space-lg pt-space-md md:pt-0">
            <div class="w-10 h-10 rounded-xl bg-surface-muted text-text-secondary flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[22px]">location_on</span>
            </div>
            <div class="flex flex-col min-w-0">
                <span class="font-label-sm text-text-secondary uppercase tracking-wider text-[11px]">Wilayah Desa</span>
                <span class="font-semibold text-text-primary text-sm">
                    Desa {{ $laporan->keluarga_penerima->wilayah->nama ?? '-' }}
                </span>
                <span class="text-xs text-text-secondary mt-0.5">
                    Kec. {{ $laporan->keluarga_penerima->wilayah->parent->nama ?? 'Sumbawa' }}
                </span>
                <span class="text-[11px] text-text-tertiary mt-0.5 truncate">{{ $laporan->keluarga_penerima->alamat ?? '-' }}</span>
            </div>
        </div>

        <div class="flex items-start gap-space-md border-t md:border-t-0 md:border-l border-border-light md:pl-space-lg pt-space-md md:pt-0">
            <div class="w-10 h-10 rounded-xl bg-secondary-fixed/50 text-secondary flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[22px]">volunteer_activism</span>
            </div>
            <div class="flex flex-col min-w-0">
                <span class="font-label-sm text-text-secondary uppercase tracking-wider text-[11px]">Bantuan yang Dipantau</span>
                @if($laporan->penyaluranBantuan)
                    <span class="font-bold text-text-primary text-sm truncate">
                        {{ $laporan->penyaluranBantuan->itemBantuan->nama_item ?? 'Bantuan' }}
                    </span>
                    <span class="text-xs text-text-secondary">
                        Program: {{ $laporan->penyaluranBantuan->programBantuan->nama_program ?? '-' }}
                    </span>
                    <div class="flex items-center gap-2 mt-1">
                        <a href="{{ route('pendamping.penyaluran-bantuan.show', $laporan->penyaluran_bantuan_id) }}" class="text-[11px] text-primary hover:underline font-bold flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">receipt_long</span>
                            <span>Tanda Terima Penyaluran</span>
                        </a>
                    </div>
                @else
                    <span class="font-semibold text-text-primary text-sm truncate">
                        {{ $laporan->keluarga_penerima->programBantuan->nama_program ?? 'Bantuan Kampus' }}
                    </span>
                    <div class="flex items-center gap-1.5 mt-1">
                        <span class="inline-block px-2 py-0.5 rounded text-[11px] font-bold bg-status-info-surface text-status-info">
                            Desil {{ $laporan->keluarga_penerima->desil ?? '-' }}
                        </span>
                    </div>
                @endif
                <div class="flex items-center gap-1.5 mt-1">
                    <span class="inline-block px-2 py-0.5 rounded text-[11px] font-bold bg-gov-green-surface text-primary">
                        Total Kunjungan: {{ $riwayatKunjungan->count() }}x
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content: Detail Kunjungan Aktif & Timeline Seluruh Kunjungan -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-space-lg">
        
        <!-- Left: Detail Laporan yang Dipilih -->
        <div class="lg:col-span-1 flex flex-col gap-space-md">
            <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light p-space-lg flex flex-col gap-space-md">
                <div class="flex items-center justify-between border-b border-border-light pb-3">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[20px]">assignment</span>
                        <h2 class="font-headline-sm text-text-primary font-bold text-sm">Laporan Kunjungan Ini</h2>
                    </div>
                    <span class="text-[11px] text-text-tertiary font-mono">ID #{{ $laporan->id }}</span>
                </div>

                <div class="flex flex-col gap-1">
                    <span class="font-label-sm text-text-secondary text-xs">Tanggal Kunjungan / Lapor</span>
                    <span class="font-semibold text-text-primary text-sm flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px] text-text-secondary">calendar_today</span>
                        {{ \Carbon\Carbon::parse($laporan->tanggal_lapor)->format('d F Y') }}
                    </span>
                </div>

                <div class="flex flex-col gap-1">
                    <span class="font-label-sm text-text-secondary text-xs">Kondisi Tumbuh Kembang</span>
                    <div>
                        @if ($laporan->status_kondisi == 'normal')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs bg-status-verified-surface text-primary font-bold border border-primary/20">
                                <span class="material-symbols-outlined text-[15px]">check_circle</span>
                                Normal / Sehat
                            </span>
                        @elseif ($laporan->status_kondisi == 'hama')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs bg-status-warning-surface text-status-warning font-bold border border-status-warning/20">
                                <span class="material-symbols-outlined text-[15px]">pest_control</span>
                                Terkena Hama
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs bg-status-fraud-surface text-status-fraud font-bold border border-status-fraud/20">
                                <span class="material-symbols-outlined text-[15px]">cancel</span>
                                Gagal / Mati
                            </span>
                        @endif
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <span class="font-label-sm text-text-secondary text-xs">Catatan Hasil Kunjungan</span>
                    <div class="p-3 bg-surface-subtle rounded-xl text-text-primary text-xs leading-relaxed border border-border-light whitespace-pre-line">
                        {{ $laporan->catatan }}
                    </div>
                </div>

                @if($laporan->foto_url)
                <div class="flex flex-col gap-1">
                    <span class="font-label-sm text-text-secondary text-xs">Foto Bukti Lapangan</span>
                    <a href="{{ $laporan->foto_url }}" target="_blank" class="block rounded-xl overflow-hidden border border-border-light hover:opacity-90 transition-opacity">
                        <img src="{{ $laporan->foto_url }}" alt="Dokumentasi Bibit" class="w-full h-40 object-cover bg-surface-muted" onerror="this.src='https://placehold.co/400x200?text=Foto+Kunjungan';"/>
                    </a>
                </div>
                @endif

                <div class="pt-3 border-t border-border-light flex flex-col gap-1 text-[11px] text-text-tertiary">
                    <div class="flex justify-between">
                        <span>Diinput pada:</span>
                        <span class="font-medium text-text-secondary">{{ $laporan->created_at->format('d M Y H:i') }}</span>
                    </div>
                    @if($laporan->updated_at && $laporan->updated_at != $laporan->created_at)
                    <div class="flex justify-between text-primary font-medium">
                        <span>Pembaruan terakhir:</span>
                        <span>{{ $laporan->updated_at->format('d M Y H:i') }}</span>
                    </div>
                    @endif
                </div>

                <div class="mt-2 flex gap-2">
                    <a href="{{ route('pendamping.lapor.edit', $laporan->id) }}" class="w-full text-center py-2 px-3 rounded-xl bg-primary text-white font-label-md font-semibold text-xs hover:bg-gov-green-dark transition-colors shadow-sm">
                        Edit Laporan Ini
                    </a>
                </div>
            </div>

            <!-- Riwayat Audit Update Log -->
            @if(count($auditLogs) > 0)
            <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light p-space-md flex flex-col gap-space-sm">
                <div class="flex items-center gap-2 border-b border-border-light pb-2">
                    <span class="material-symbols-outlined text-text-secondary text-[18px]">history_edu</span>
                    <h3 class="font-label-md font-bold text-text-primary text-xs">Riwayat Modifikasi Data (Audit)</h3>
                </div>
                <div class="flex flex-col divide-y divide-border-light">
                    @foreach($auditLogs as $log)
                    <div class="py-2 flex flex-col gap-1 text-xs">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-text-primary capitalize">{{ $log->aksi }}</span>
                            <span class="text-[10px] text-text-tertiary">{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y H:i') }}</span>
                        </div>
                        <span class="text-[11px] text-text-secondary">Oleh Petugas ID #{{ $log->user_id }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Right: Timeline Seluruh Histori Kunjungan untuk Keluarga Penerima Ini -->
        <div class="lg:col-span-2 flex flex-col gap-space-md">
            <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light p-space-lg flex flex-col">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 border-b border-border-light pb-space-md mb-space-lg">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[24px]">timeline</span>
                        <div>
                            <h2 class="font-headline-sm font-bold text-text-primary">Kronologi Riwayat Kunjungan</h2>
                            <p class="text-xs text-text-secondary mt-0.5">Daftar rekaman perkembangan bibit dari seluruh kunjungan lapangan.</p>
                        </div>
                    </div>
                    <a href="{{ route('pendamping.lapor.create', ['keluarga_id' => $laporan->keluarga_penerima_id]) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gov-green-surface hover:bg-primary-container text-primary hover:text-white font-label-md text-xs font-semibold transition-colors border border-primary/20 w-fit">
                        <span class="material-symbols-outlined text-[16px]">add</span>
                        <span>Tambah Kunjungan</span>
                    </a>
                </div>

                <!-- Timeline List -->
                <div class="relative pl-6 sm:pl-8 flex flex-col gap-space-xl before:content-[''] before:absolute before:left-3 sm:before:left-4 before:top-3 before:bottom-3 before:w-0.5 before:bg-border-medium">
                    @forelse ($riwayatKunjungan as $idx => $hist)
                    <div class="relative flex flex-col gap-2 {{ $hist->id == $laporan->id ? 'p-space-md rounded-2xl bg-gov-green-surface/40 border border-primary/30' : '' }}">
                        <!-- Dot Icon -->
                        <div class="absolute -left-[30px] sm:-left-[38px] top-1 w-6 h-6 rounded-full flex items-center justify-center {{ $hist->status_kondisi == 'normal' ? 'bg-primary text-white' : ($hist->status_kondisi == 'hama' ? 'bg-status-warning text-white' : 'bg-status-fraud text-white') }} shadow-sm">
                            <span class="material-symbols-outlined text-[14px]">
                                {{ $hist->status_kondisi == 'normal' ? 'check' : ($hist->status_kondisi == 'hama' ? 'warning' : 'close') }}
                            </span>
                        </div>

                        <!-- Header Kunjungan -->
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-text-primary text-sm">
                                    Kunjungan #{{ $riwayatKunjungan->count() - $idx }}
                                </span>
                                <span class="text-xs text-text-secondary">•</span>
                                <span class="text-xs font-medium text-text-secondary">
                                    {{ \Carbon\Carbon::parse($hist->tanggal_lapor)->format('d F Y') }}
                                </span>
                                @if($hist->id == $laporan->id)
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-primary text-white">Sedang Dibuka</span>
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                @if ($hist->status_kondisi == 'normal')
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-[11px] font-bold bg-status-verified-surface text-primary">Normal</span>
                                @elseif ($hist->status_kondisi == 'hama')
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-[11px] font-bold bg-status-warning-surface text-status-warning">Hama</span>
                                @else
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-[11px] font-bold bg-status-fraud-surface text-status-fraud">Gagal</span>
                                @endif

                                <div class="flex items-center gap-1">
                                    <a href="{{ route('pendamping.lapor.show', $hist->id) }}" class="p-1 text-text-secondary hover:text-primary rounded hover:bg-surface-muted" title="Buka Detail">
                                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                                    </a>
                                    <a href="{{ route('pendamping.lapor.edit', $hist->id) }}" class="p-1 text-text-secondary hover:text-primary rounded hover:bg-surface-muted" title="Edit Kunjungan">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Isi Catatan -->
                        <div class="bg-surface-subtle p-3 rounded-xl border border-border-light text-text-primary text-xs leading-relaxed">
                            <p class="whitespace-pre-line">{{ $hist->catatan }}</p>
                            @if($hist->foto_url)
                            <div class="mt-2 pt-2 border-t border-border-light flex items-center gap-2 text-primary">
                                <span class="material-symbols-outlined text-[16px]">photo</span>
                                <a href="{{ $hist->foto_url }}" target="_blank" class="hover:underline font-semibold text-[11px]">Lihat Foto Lapangan Terlampir</a>
                            </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-between text-[11px] text-text-tertiary">
                            <span>Dicatat oleh: <strong>{{ $hist->pendamping->name ?? 'Pendamping' }}</strong></span>
                            @if($hist->updated_at && $hist->updated_at != $hist->created_at)
                            <span class="text-text-secondary italic">Telah di-update: {{ $hist->updated_at->diffForHumans() }}</span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-text-secondary">
                        <span class="material-symbols-outlined text-3xl block mb-1">pending_actions</span>
                        Belum ada riwayat kunjungan tercatat.
                    </div>
                    @endforelse
                </div>
            </div>

            @if(isset($laporanProgramLain) && $laporanProgramLain->isNotEmpty())
            <!-- Bukti Program Lain Tidak Ditindih: Daftar Laporan Program Lainnya -->
            <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light overflow-hidden flex flex-col mt-4">
                <div class="p-space-md bg-surface-subtle border-b border-border-light flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-700 text-[20px]">layers</span>
                        <div>
                            <h3 class="font-bold text-xs text-text-primary">Laporan Program Lainnya pada Keluarga Ini (Tersimpan Terpisah)</h3>
                            <p class="text-[11px] text-text-tertiary">Setiap program memiliki riwayat perkembangan independen dan tidak saling menindih.</p>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded bg-blue-50 text-blue-800 text-[11px] font-bold">
                        {{ $laporanProgramLain->count() }} Laporan Program Lain
                    </span>
                </div>
                <div class="divide-y divide-border-light p-2">
                    @foreach($laporanProgramLain as $lapLain)
                        <div class="p-3 flex items-center justify-between hover:bg-surface-subtle transition-colors rounded-xl">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-text-tertiary text-[20px]">school</span>
                                <div>
                                    <span class="font-bold text-xs text-text-primary block">
                                        {{ $lapLain->programBantuan->nama_program ?? 'Program Bantuan' }}
                                    </span>
                                    <span class="text-[11px] text-text-tertiary">
                                        Item: {{ $lapLain->penyaluranBantuan->itemBantuan->nama_item ?? 'Bantuan' }} • Kunjungan: {{ \Carbon\Carbon::parse($lapLain->tanggal_lapor)->format('d/m/Y') }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                @if($lapLain->status_kondisi === 'normal')
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-gov-green-surface text-primary">Normal</span>
                                @elseif($lapLain->status_kondisi === 'hama')
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700">Hama</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-50 text-red-700">Gagal</span>
                                @endif
                                <a href="{{ route('pendamping.lapor.show', $lapLain->id) }}" class="px-2.5 py-1 text-xs font-semibold text-primary hover:underline">
                                    Lihat Detail →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

    </div>
</div>
@endsection
