@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Halo, {{ Auth::user()->name }} 👋</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Selamat bertugas! Salurkan bantuan program kampus (uang modal, alat, bibit), pantau keluarga penerima bantuan, buat laporan kunjungan, dan evaluasi desil kemandirian.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <a href="{{ route('pendamping.penyaluran-bantuan.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">volunteer_activism</span>
                <span>+ Salurkan Bantuan</span>
            </a>
            <a href="{{ route('pendamping.lapor.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-surface-container-high hover:bg-surface-container-highest text-text-primary font-label-md text-label-md font-semibold transition-colors border border-border-light shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add_location_alt</span>
                <span>+ Buat Laporan Kunjungan</span>
            </a>
            <a href="{{ route('pendamping.kemandirian.index') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-surface-container-high hover:bg-surface-container-highest text-text-primary font-label-md text-label-md font-semibold transition-colors border border-border-light shadow-sm">
                <span class="material-symbols-outlined text-[18px]">query_stats</span>
                <span>Monitoring Kemandirian</span>
            </a>
        </div>
    </div>

    <!-- BANNER WILAYAH DAMPINGAN (DAERAH YANG DIDAMPINGI) -->
    @php
        $currPendamping = Auth::user();
        $assignedDesas = $currPendamping->getAssignedDesasCollection();
        $totalKkWilayah = $currPendamping->keluargaPenerimas()->count();
    @endphp
    <div class="bg-gradient-to-r from-gov-green-dark via-primary to-emerald-900 text-white rounded-2xl p-space-lg shadow-md flex flex-col lg:flex-row lg:items-center justify-between gap-4 border border-white/10">
        <div class="flex items-start sm:items-center gap-3.5">
            <div class="w-12 h-12 rounded-xl bg-white/15 backdrop-blur-md flex items-center justify-center shrink-0 border border-white/20 shadow-xs">
                <span class="material-symbols-outlined text-[28px] text-white">location_on</span>
            </div>
            <div class="flex flex-col">
                <div class="flex flex-wrap items-center gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded-full bg-white/20 text-white text-[11px] font-bold uppercase tracking-wider backdrop-blur-sm border border-white/20">
                        Wilayah Tugas Dampingan
                    </span>
                    <span class="inline-flex items-center gap-1 text-[11px] text-emerald-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Aktif Bertugas</span>
                    </span>
                </div>
                <h3 class="font-bold text-base sm:text-lg text-white tracking-tight">
                    {{ $currPendamping->assigned_wilayah_label ?: 'Wilayah Kabupaten Sumbawa' }}
                </h3>
                @if($assignedDesas->isNotEmpty())
                    <div class="flex flex-wrap items-center gap-1.5 mt-2">
                        <span class="text-xs text-white/80 mr-1 font-medium">Desa Binaan:</span>
                        @foreach($assignedDesas as $d)
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-lg bg-white/15 text-white text-[11px] font-semibold border border-white/20 backdrop-blur-xs">
                                <span class="material-symbols-outlined text-[12px] text-emerald-300">pin_drop</span>
                                <span>Desa {{ $d->nama }}</span>
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="flex items-center gap-3 self-start lg:self-auto shrink-0 bg-white/10 backdrop-blur-md px-4 py-2.5 rounded-xl border border-white/15">
            <div class="text-right">
                <span class="text-[11px] text-white/80 block font-medium">Beban Dampingan</span>
                <span class="text-base font-bold text-white">{{ $totalKkWilayah }} Keluarga Penerima Bantuan</span>
            </div>
            <a href="{{ route('pendamping.keluarga_penerima.index') }}" class="p-2 rounded-lg bg-white text-primary hover:bg-emerald-50 transition-colors shadow-sm" title="Lihat Daftar Keluarga Penerima Bantuan di Wilayah Ini">
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </div>

    @php
        $desaIds = $currPendamping->getAssignedDesaIds();
        $unvisitedKkCount = \App\Models\KeluargaPenerima::where(function($q) use ($currPendamping, $desaIds) {
            $q->where('pendamping_id', $currPendamping->id);
            if (!empty($desaIds)) {
                $q->orWhereIn('wilayah_id', $desaIds);
            }
        })->whereHas('penyaluranBantuans', function($q) {
            $q->where('status', '!=', 'batal')->whereDoesntHave('laporanTumbuhKembangs');
        })->count();
    @endphp

    @if($unvisitedKkCount > 0)
        <!-- Alert Tugas: Bantuan Belum Pernah Dikunjungi -->
        <div class="bg-gradient-to-r from-amber-500/15 via-amber-50 to-orange-50 border border-amber-300 rounded-2xl p-space-md shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-xs">
                    <span class="material-symbols-outlined text-[22px]">tour</span>
                </div>
                <div>
                    <h4 class="font-bold text-sm text-amber-950">
                        {{ $unvisitedKkCount }} Keluarga Baru Disalurkan Bantuan & Belum Pernah Dikunjungi
                    </h4>
                    <p class="text-xs text-amber-800">
                        Segera jadwalkan kunjungan pertama untuk memantau kondisi bantuan yang telah diserahkan di lapangan.
                    </p>
                </div>
            </div>
            <a href="{{ route('pendamping.pantau-penyaluran.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold transition-all shrink-0 self-start sm:self-auto shadow-sm">
                <span>Pantau Penyaluran</span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>
    @endif

    <!-- 4 KPI Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-md">
        <!-- Card 1: Keluarga Binaan -->
        <a href="{{ route('pendamping.keluarga_penerima.index') }}" class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-between hover:border-primary/40 transition-colors">
            <div>
                <div class="flex items-center justify-between mb-2">
                    <span class="font-label-md text-label-md text-text-secondary uppercase">Penerima Bantuan Aktif</span>
                    <span class="material-symbols-outlined text-primary">groups</span>
                </div>
                <span class="font-headline-xl text-headline-xl text-text-primary font-bold">{{ $totalBinaan ?? 0 }} KK</span>
            </div>
            <div class="text-xs text-text-secondary mt-2 flex items-center justify-between">
                <span>Desil 1 - 5</span>
                @if(isset($totalMandiri) && $totalMandiri > 0)
                    <span class="text-emerald-700 font-semibold bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">{{ $totalMandiri }} Mandiri (Lulus)</span>
                @endif
            </div>
        </a>

        <!-- Card 2: Penyaluran Bantuan -->
        <a href="{{ route('pendamping.penyaluran-bantuan.index') }}" class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-between hover:border-primary/40 transition-colors">
            <div>
                <div class="flex items-center justify-between mb-2">
                    <span class="font-label-md text-label-md text-text-secondary uppercase">Penyaluran Bantuan</span>
                    <span class="material-symbols-outlined text-emerald-600">volunteer_activism</span>
                </div>
                <span class="font-headline-xl text-headline-xl text-emerald-700 font-bold">{{ $totalPenyaluran ?? 0 }} Transaksi</span>
            </div>
            <div class="text-xs text-text-secondary mt-2 flex flex-col gap-0.5">
                @if(($totalUangDisalurkan ?? 0) > 0)
                    <span class="font-semibold text-emerald-600">Rp {{ number_format($totalUangDisalurkan, 0, ',', '.') }}</span>
                @endif
                <span class="text-text-tertiary">{{ $totalBarangDisalurkan ?? 0 }} Alat • {{ $totalBibitDisalurkan ?? 0 }} Bibit</span>
            </div>
        </a>

        <!-- Card 3: Evaluasi Desil Kemandirian -->
        <a href="{{ route('pendamping.kemandirian.index') }}" class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-between hover:border-primary/40 transition-colors">
            <div>
                <div class="flex items-center justify-between mb-2">
                    <span class="font-label-md text-label-md text-text-secondary uppercase">Monitoring Desil</span>
                    <span class="material-symbols-outlined text-secondary">trending_up</span>
                </div>
                <span class="font-headline-xl text-headline-xl text-secondary font-bold">{{ $totalPenilaian ?? 0 }} Asesmen</span>
            </div>
            <span class="text-label-sm text-text-secondary mt-2">Penilaian Kemandirian Ekonomi</span>
        </a>

        <!-- Card 4: Laporan Kunjungan -->
        <a href="{{ route('pendamping.lapor.index') }}" class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-between hover:border-primary/40 transition-colors">
            <div>
                <div class="flex items-center justify-between mb-2">
                    <span class="font-label-md text-label-md text-text-secondary uppercase">Laporan Kunjungan</span>
                    <span class="material-symbols-outlined text-status-verified">assignment</span>
                </div>
                <span class="font-headline-xl text-headline-xl text-status-verified font-bold">{{ $totalLaporanKirim ?? 0 }} Kunjungan</span>
            </div>
            <span class="text-label-sm text-text-secondary mt-2">Monitoring Rutin Lapangan</span>
        </a>
    </div>

    <!-- Feed Penyaluran Bantuan Terkini -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col">
        <div class="flex items-center justify-between mb-space-md pb-2 border-b border-border-light">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-600 text-[22px]">volunteer_activism</span>
                <h2 class="font-headline-sm text-headline-sm text-text-primary font-bold">Penyaluran Bantuan Terakhir</h2>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('pendamping.penyaluran-bantuan.create') }}" class="text-xs text-primary font-bold hover:underline flex items-center gap-1">
                    <span class="material-symbols-outlined text-[15px]">add</span>
                    <span>Salurkan Baru</span>
                </a>
                <span class="text-border-light">|</span>
                <a href="{{ route('pendamping.penyaluran-bantuan.index') }}" class="text-xs text-text-secondary font-semibold hover:underline">
                    Lihat Semua
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-container-low text-text-secondary font-label-md text-label-md">
                    <tr>
                        <th class="py-2.5 px-3">Tanggal</th>
                        <th class="py-2.5 px-3">Keluarga Penerima</th>
                        <th class="py-2.5 px-3">Item Bantuan</th>
                        <th class="py-2.5 px-3">Jenis & Jumlah Bantuan</th>
                        <th class="py-2.5 px-3">Peruntukan / Keterangan</th>
                        <th class="py-2.5 px-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light">
                    @forelse ($penyaluranTerbaru as $pen)
                    <tr class="hover:bg-surface-container-low/50 transition-colors">
                        <td class="py-3 px-3 font-code-dense text-xs text-text-secondary whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($pen->tgl_penyaluran)->format('d M Y') }}
                        </td>
                        <td class="py-3 px-3 font-semibold text-text-primary">
                            <div>{{ $pen->keluargaPenerima->kepala_keluarga ?? $pen->keluargaPenerima->nama ?? '-' }}</div>
                            <span class="text-[11px] text-text-tertiary font-normal">Desa {{ $pen->keluargaPenerima->wilayah->nama ?? '-' }}</span>
                        </td>
                        <td class="py-3 px-3 text-text-secondary">
                            <span class="font-medium text-text-primary">{{ $pen->itemBantuan->nama_item ?? '-' }}</span>
                            <span class="text-[11px] text-text-tertiary block">{{ $pen->programBantuan->nama_program ?? '-' }}</span>
                        </td>
                        <td class="py-3 px-3">
                            @if($pen->jenis === 'uang')
                                <span class="font-bold text-emerald-600 block">Rp {{ number_format($pen->nominal_uang, 0, ',', '.') }}</span>
                                <span class="text-[11px] text-text-tertiary">Uang Tunai Usaha</span>
                            @elseif($pen->jenis === 'barang')
                                <span class="font-bold text-amber-700 block">{{ number_format($pen->jumlah, 0) }} {{ $pen->satuan }}</span>
                                <span class="text-[11px] text-text-tertiary">Alat / Perlengkapan</span>
                            @else
                                <span class="font-bold text-gov-green-dark block">{{ number_format($pen->jumlah, 0) }} {{ $pen->satuan }}</span>
                                <span class="text-[11px] text-text-tertiary">Bibit Pertanian</span>
                            @endif
                        </td>
                        <td class="py-3 px-3 text-xs text-text-secondary max-w-xs truncate">
                            {{ $pen->peruntukan ?? $pen->keterangan ?? '-' }}
                        </td>
                        <td class="py-3 px-3 text-right">
                            <a href="{{ route('pendamping.penyaluran-bantuan.show', $pen->id) }}" class="inline-flex items-center gap-1 px-2.5 py-1 bg-surface-container-high hover:bg-surface-container-highest text-primary font-label-md text-xs font-semibold rounded-lg transition-colors border border-border-light">
                                <span class="material-symbols-outlined text-[14px]">receipt</span>
                                <span>Bukti</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-text-tertiary">
                            Belum ada penyaluran bantuan yang tercatat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Feed Tugas Lapangan & Aktivitas (2 Columns) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-space-lg">
        <!-- Perkembangan Desil & Penilaian Kemandirian -->
        <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col">
            <div class="flex items-center justify-between mb-space-md pb-2 border-b border-border-light">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary text-[22px]">trending_up</span>
                    <h2 class="font-headline-sm text-headline-sm text-text-primary font-bold">Penilaian Desil & Kemandirian</h2>
                </div>
                <a href="{{ route('pendamping.kemandirian.index') }}" class="text-xs text-primary font-semibold hover:underline">
                    Monitoring Lengkap
                </a>
            </div>

            <div class="flex flex-col divide-y divide-border-light flex-1">
                @forelse ($penilaianTerbaru as $pen)
                <div class="py-3 flex items-center justify-between gap-3 first:pt-0 last:pb-0">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-semibold text-text-primary text-sm">{{ $pen->keluargaPenerima->kepala_keluarga ?? $pen->keluargaPenerima->nama ?? 'Penerima Bantuan' }}</span>
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-gov-green-surface text-primary border border-primary/20">
                                Desil {{ $pen->desil_hasil }}
                            </span>
                        </div>
                        <span class="text-xs text-text-secondary block">
                            Penghasilan: Rp {{ number_format($pen->penghasilan_perbulan, 0, ',', '.') }}/bln
                            @if($pen->pendapatan_per_kapita > 0)
                                <span class="text-text-tertiary">(Rp {{ number_format($pen->pendapatan_per_kapita, 0, ',', '.') }}/kapita)</span>
                            @endif
                        </span>
                        <div class="flex items-center gap-2 mt-0.5">
                            <span class="text-[11px] text-text-tertiary">Periode: {{ $pen->periode }}</span>
                            <span class="text-[11px] font-semibold {{ $pen->status_perkembangan == 'Maju' ? 'text-green-600' : ($pen->status_perkembangan == 'Tetap' ? 'text-blue-600' : 'text-amber-600') }}">
                                • Status: {{ $pen->status_perkembangan ?? 'Tetap' }}
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('pendamping.keluarga_penerima.show', $pen->keluarga_penerima_id) }}" class="px-3 py-1.5 bg-surface-container-low hover:bg-surface-container-high text-primary font-label-md text-label-md font-semibold rounded-lg border border-border-light transition-colors text-xs shrink-0">
                        Detail
                    </a>
                </div>
                @empty
                    @forelse($keluargaBinaanCepat as $kb)
                    <div class="py-3 flex items-center justify-between gap-3 first:pt-0 last:pb-0">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-text-primary text-sm">{{ $kb->kepala_keluarga ?? $kb->nama }}</span>
                                <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-status-info-surface text-status-info">
                                    Desil {{ $kb->desil }}
                                </span>
                            </div>
                            <span class="text-xs text-text-secondary">Desa {{ $kb->wilayah->nama ?? 'Sumbawa' }}</span>
                            <span class="text-[11px] text-text-tertiary block mt-0.5">Kemandirian: {{ $kb->status_kemandirian ?? 'Belum Dinilai' }}</span>
                        </div>
                        <a href="{{ route('pendamping.keluarga_penerima.penilaian.create', $kb->id) }}" class="px-3 py-1.5 bg-gov-green-surface hover:bg-gov-green text-primary hover:text-white font-label-md text-label-md font-semibold rounded-lg border border-primary/20 transition-colors text-xs shrink-0 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">rate_review</span>
                            <span>Nilai Desil</span>
                        </a>
                    </div>
                    @empty
                    <div class="text-center py-8 text-text-tertiary text-sm">
                        <span class="material-symbols-outlined text-3xl block mb-1">query_stats</span>
                        Belum ada riwayat penilaian desil.
                    </div>
                    @endforelse
                @endforelse
            </div>

            <div class="mt-4 pt-3 border-t border-border-light flex justify-between items-center">
                <span class="text-xs text-text-secondary">Evaluasi perkembangan ekonomi binaan</span>
                <a href="{{ route('pendamping.keluarga_penerima.index') }}" class="text-xs font-bold text-primary hover:underline">
                    + Input Penilaian Keluarga
                </a>
            </div>
        </div>

        <!-- Aktivitas Laporan Kunjungan -->
        <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col">
            <div class="flex items-center justify-between mb-space-md pb-2 border-b border-border-light">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-[22px]">assignment</span>
                    <h2 class="font-headline-sm text-headline-sm text-text-primary font-bold">Laporan Kunjungan Terakhir</h2>
                </div>
                <a href="{{ route('pendamping.lapor.index') }}" class="text-xs text-primary font-semibold hover:underline">
                    Kelola Laporan
                </a>
            </div>

            <div class="flex flex-col divide-y divide-border-light flex-1">
                @forelse ($aktivitasTerakhir as $akt)
                <div class="py-3 flex items-start gap-3 first:pt-0 last:pb-0">
                    <div class="w-8 h-8 rounded-full bg-gov-green-surface text-primary flex items-center justify-center shrink-0 mt-0.5">
                        <span class="material-symbols-outlined text-[16px]">location_on</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-text-primary text-sm truncate">{{ $akt->keluarga_penerima->kepala_keluarga ?? $akt->keluarga_penerima->nama ?? $akt->keluargaPenerima->kepala_keluarga ?? $akt->keluargaPenerima->nama ?? 'Penerima' }}</span>
                            <span class="text-[11px] text-text-tertiary">{{ \Carbon\Carbon::parse($akt->tanggal_lapor)->format('d M Y') }}</span>
                        </div>
                        <span class="text-xs font-bold inline-block {{ $akt->status_kondisi == 'normal' ? 'text-primary' : ($akt->status_kondisi == 'hama' ? 'text-status-warning' : 'text-status-fraud') }}">
                            Kondisi: {{ ucfirst($akt->status_kondisi) }}
                        </span>
                        <p class="text-xs text-text-secondary truncate mt-0.5">{{ $akt->catatan ?? '-' }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-text-tertiary text-sm">
                    <span class="material-symbols-outlined text-3xl block mb-1">pending_actions</span>
                    Belum ada riwayat laporan kunjungan.
                </div>
                @endforelse
            </div>

            <div class="mt-4 pt-3 border-t border-border-light flex justify-between items-center">
                <span class="text-xs text-text-secondary">Siap melakukan monitoring lapangan?</span>
                <a href="{{ route('pendamping.lapor.create') }}" class="text-xs font-bold text-primary hover:underline">
                    + Input Laporan Kunjungan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
