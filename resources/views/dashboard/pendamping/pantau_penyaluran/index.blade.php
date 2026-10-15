@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <div class="flex items-center gap-space-sm mb-space-xs">
                <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-amber-500/15 text-amber-900 font-bold border border-amber-300">
                    <span class="material-symbols-outlined text-[15px] mr-1">pending_actions</span>
                    AGENDA PEMANTAUAN LAPANGAN
                </span>
                <span class="text-text-tertiary text-body-sm font-body-sm">Antrean Kunjungan Lapangan</span>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Pantau Penyaluran (Belum Dikunjungi)</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Daftar keluarga binaan yang telah menerima bantuan (bibit tanaman, uang modal, atau peralatan usaha) tetapi <strong>belum pernah dilakukan kunjungan pemantauan</strong> tumbuh kembang oleh pendamping.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <a href="{{ route('pendamping.penyaluran-bantuan.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-surface-subtle text-text-primary font-label-md text-label-md font-semibold border border-border-light hover:bg-surface-muted transition-all">
                <span class="material-symbols-outlined text-[18px]">volunteer_activism</span>
                <span>Semua Data Penyaluran</span>
            </a>
            <a href="{{ route('pendamping.lapor.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-primary text-on-primary font-label-md text-label-md font-bold hover:bg-gov-green-dark transition-all shadow-sm">
                <span class="material-symbols-outlined text-[18px]">assignment</span>
                <span>Laporan Kunjungan</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20 flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Alert Edukasi / Petunjuk Kunjungan -->
    <div class="bg-gradient-to-r from-amber-500/15 via-amber-50 to-orange-50 border border-amber-300/80 rounded-2xl p-space-lg shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-start md:items-center gap-3.5">
            <div class="w-11 h-11 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-sm">
                <span class="material-symbols-outlined text-[24px]">tour</span>
            </div>
            <div>
                <h3 class="font-bold text-sm sm:text-base text-amber-950">Petunjuk Tugas Kunjungan & Monitoring</h3>
                <p class="text-xs text-amber-900/90 mt-0.5 max-w-3xl leading-relaxed">
                    Setiap bantuan yang disalurkan wajib dipantau kondisi dan pemanfaatannya di lapangan. Klik tombol <strong>"Lakukan Kunjungan"</strong> pada keluarga di bawah untuk langsung mencatat kondisi perkembangan (bibit tumbuh, modal usaha produktif, atau alat berfungsi) sesuai peruntukannya.
                </p>
            </div>
        </div>
    </div>

    <!-- 4 KPI Cards Ringkasan Pantauan -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-lg">
        <!-- KPI 1: Total KK Belum Dipantau -->
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center text-amber-800">
                <span class="material-symbols-outlined text-[26px]">family_restroom</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-semibold">KK Belum Dikunjungi</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">
                    {{ $totalKkBelumDipantau }} KK
                </span>
                <span class="font-label-xs text-label-xs text-amber-800 font-medium">Perlu Kunjungan Lapangan</span>
            </div>
        </div>

        <!-- KPI 2: Total Item Bantuan Menunggu Pantauan -->
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-800">
                <span class="material-symbols-outlined text-[26px]">inventory_2</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-semibold">Bantuan Belum Dipantau</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">
                    {{ $totalItemBelumDipantau }} Paket
                </span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Bibit, Uang, & Alat</span>
            </div>
        </div>

        <!-- KPI 3: Prioritas Tinggi (Belum Pernah Dikunjungi Sama Sekali) -->
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center text-red-700">
                <span class="material-symbols-outlined text-[26px]">emergency</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-semibold">Prioritas Utama (0 Visit)</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block text-red-700">
                    {{ $totalKkBelumPernahDikunjungi }} KK
                </span>
                <span class="font-label-xs text-label-xs text-red-600 font-medium">Belum Pernah Dikunjungi</span>
            </div>
        </div>

        <!-- KPI 4: Kunjungan Bantuan Baru -->
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-gov-green-surface flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-[26px]">new_releases</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-semibold">Bantuan Baru Tersalur</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">
                    {{ $totalKkBantuanBaru }} KK
                </span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Bantuan Lanjutan</span>
            </div>
        </div>
    </div>

    <!-- FILTER PERIODE WAKTU -->
    <x-period-filter :periodInfo="$periodInfo" label="Pilih Periode Penyaluran Bantuan:" />

    <!-- TAB KATEGORI ANTREAN PANTAUAN -->
    <div class="flex items-center gap-2 border-b border-border-light pb-2 overflow-x-auto">
        <a href="{{ route('pendamping.pantau-penyaluran.index', array_merge(request()->query(), ['tab' => 'semua'])) }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap {{ ($tab === 'semua' || !$tab) ? 'bg-primary text-white shadow-xs' : 'bg-surface-subtle text-text-secondary hover:text-text-primary hover:bg-surface-muted' }}">
            <span>Semua Belum Dipantau</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ ($tab === 'semua' || !$tab) ? 'bg-white/20 text-white' : 'bg-border-light text-text-secondary' }}">
                {{ $totalKkBelumDipantau }}
            </span>
        </a>
        <a href="{{ route('pendamping.pantau-penyaluran.index', array_merge(request()->query(), ['tab' => 'belum_pernah'])) }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap {{ $tab === 'belum_pernah' ? 'bg-red-600 text-white shadow-xs' : 'bg-surface-subtle text-text-secondary hover:text-text-primary hover:bg-surface-muted' }}">
            <span class="material-symbols-outlined text-[14px]">priority_high</span>
            <span>Belum Pernah Dikunjungi Sama Sekali</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $tab === 'belum_pernah' ? 'bg-white/20 text-white' : 'bg-red-100 text-red-800' }}">
                {{ $totalKkBelumPernahDikunjungi }}
            </span>
        </a>
        <a href="{{ route('pendamping.pantau-penyaluran.index', array_merge(request()->query(), ['tab' => 'bantuan_baru'])) }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap {{ $tab === 'bantuan_baru' ? 'bg-primary text-white shadow-xs' : 'bg-surface-subtle text-text-secondary hover:text-text-primary hover:bg-surface-muted' }}">
            <span>Bantuan Baru Belum Dipantau</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $tab === 'bantuan_baru' ? 'bg-white/20 text-white' : 'bg-border-light text-text-secondary' }}">
                {{ $totalKkBantuanBaru }}
            </span>
        </a>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-canvas-bg rounded-2xl p-space-md shadow-sm border border-border-light flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3">
        <form action="{{ route('pendamping.pantau-penyaluran.index') }}" method="GET" class="flex flex-wrap items-center gap-3 flex-1">
            <input type="hidden" name="tab" value="{{ $tab }}">
            @if(request('start_date'))
                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
            @endif
            @if(request('end_date'))
                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
            @endif
            @if(request('periode'))
                <input type="hidden" name="periode" value="{{ request('periode') }}">
            @endif
            @if(request('bulan'))
                <input type="hidden" name="bulan" value="{{ request('bulan') }}">
            @endif
            @if(request('tahun'))
                <input type="hidden" name="tahun" value="{{ request('tahun') }}">
            @endif

            <!-- Search Input -->
            <div class="relative flex-1 min-w-[220px]">
                <span class="material-symbols-outlined absolute left-3 top-2.5 text-text-tertiary text-[18px]">search</span>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama kepala keluarga, NIK, bibit, atau desa..."
                    class="w-full pl-9 pr-3 py-2 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm focus:border-primary focus:bg-canvas-bg focus:outline-none transition-all">
            </div>

            <!-- Filter Desa -->
            <select name="desa_id" onchange="this.form.submit()" class="px-3 py-2 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm focus:border-primary focus:outline-none transition-all max-w-[200px]">
                <option value="">Semua Wilayah Desa</option>
                @foreach ($desas as $d)
                    <option value="{{ $d->id }}" {{ request('desa_id') == $d->id ? 'selected' : '' }}>
                        Desa {{ $d->nama }}
                    </option>
                @endforeach
            </select>

            <!-- Filter Program Kampus -->
            <select name="program_id" onchange="this.form.submit()" class="px-3 py-2 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm focus:border-primary focus:outline-none transition-all max-w-xs truncate">
                <option value="">Semua Program Kampus</option>
                @foreach ($programs as $prog)
                    <option value="{{ $prog->id }}" {{ request('program_id') == $prog->id ? 'selected' : '' }}>
                        {{ $prog->nama_program }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="px-4 py-2 bg-primary text-on-primary rounded-xl font-label-sm text-label-sm font-semibold hover:bg-gov-green-dark transition-all">
                Filter
            </button>

            @if(request()->anyFilled(['search', 'desa_id', 'program_id']))
                <a href="{{ route('pendamping.pantau-penyaluran.index', ['tab' => $tab]) }}" class="px-3 py-2 text-text-secondary hover:text-text-primary font-label-sm text-label-sm">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- TABEL DAFTAR KELUARGA BELUM DIKUNJUNGI -->
    <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Keluarga Penerima</th>
                        <th class="py-3 px-4 font-semibold">Bantuan yang Harus Dipantau</th>
                        <th class="py-3 px-4 font-semibold">Waktu Penyaluran</th>
                        <th class="py-3 px-4 font-semibold">Riwayat Kunjungan</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi Kunjungan Lapangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($penerimas as $keluarga)
                        @php
                            $unvisitedBantuans = $keluarga->penyaluranBantuans;
                            $latestPenyaluran = $unvisitedBantuans->first();
                            $daysAgo = $latestPenyaluran ? \Carbon\Carbon::parse($latestPenyaluran->tgl_penyaluran)->diffInDays(now()) : 0;
                            $totalKunjunganSebelumnya = $keluarga->laporanTumbuhKembangs ? $keluarga->laporanTumbuhKembangs->count() : 0;
                            $kunjunganTerakhir = $keluarga->laporanTumbuhKembangs ? $keluarga->laporanTumbuhKembangs->first() : null;
                        @endphp
                        <tr class="hover:bg-amber-50/30 transition-colors group">
                            <!-- Keluarga Penerima -->
                            <td class="py-3.5 px-4 align-top">
                                <a href="{{ route('pendamping.penyaluran-bantuan.show', [$keluarga->id, 'type' => 'keluarga']) }}" class="font-bold text-text-primary hover:text-primary transition-colors block text-sm">
                                    {{ $keluarga->kepala_keluarga }}
                                </a>
                                <div class="text-[11px] text-text-tertiary flex flex-col gap-0.5 mt-1">
                                    <div class="flex items-center gap-1.5">
                                        <span>NIK: {{ $keluarga->nik }}</span>
                                        <span>•</span>
                                        <span class="px-1.5 py-0.2 rounded bg-blue-50 text-blue-700 font-bold text-[10px]">Desil {{ $keluarga->desil ?? '-' }}</span>
                                    </div>
                                    <div class="text-text-secondary font-medium flex items-center gap-1 mt-0.5">
                                        <span class="material-symbols-outlined text-[13px] text-primary">location_on</span>
                                        <span>{{ $keluarga->alamat ?? ('Desa ' . ($keluarga->wilayah->nama ?? '-')) }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Bantuan yang Harus Dipantau -->
                            <td class="py-3.5 px-4 align-top max-w-md">
                                <div class="flex flex-col gap-2">
                                    @foreach($unvisitedBantuans as $bantuan)
                                        <div class="p-2.5 rounded-xl bg-surface-subtle border border-border-light flex flex-col gap-1">
                                            <div class="flex items-center justify-between gap-2">
                                                <div class="flex items-center gap-1.5">
                                                    @if($bantuan->jenis === 'uang')
                                                        <span class="material-symbols-outlined text-[15px] text-amber-700">payments</span>
                                                        <span class="font-bold text-xs text-amber-900">Uang Tunai: Rp {{ number_format($bantuan->nominal_uang ?? 0, 0, ',', '.') }}</span>
                                                    @elseif($bantuan->jenis === 'bibit')
                                                        <span class="material-symbols-outlined text-[15px] text-primary">potted_plant</span>
                                                        <span class="font-bold text-xs text-primary">{{ number_format($bantuan->jumlah) }} {{ $bantuan->satuan }} {{ $bantuan->itemBantuan->nama_item ?? 'Bibit' }}</span>
                                                    @else
                                                        <span class="material-symbols-outlined text-[15px] text-blue-700">home_repair_service</span>
                                                        <span class="font-bold text-xs text-blue-900">{{ number_format($bantuan->jumlah) }} {{ $bantuan->satuan }} {{ $bantuan->itemBantuan->nama_item ?? 'Alat Usaha' }}</span>
                                                    @endif
                                                </div>
                                                <span class="text-[10px] px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 font-bold">
                                                    Belum Dipantau
                                                </span>
                                            </div>
                                            <div class="text-[11px] text-text-tertiary flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[12px]">school</span>
                                                <span class="truncate">{{ $bantuan->programBantuan->nama_program ?? 'Program Kampus' }}</span>
                                            </div>
                                            @if($bantuan->peruntukan)
                                                <div class="text-[11px] text-text-secondary bg-canvas-bg px-2 py-1 rounded border border-border-light/60 mt-0.5 italic">
                                                    Target pantau: {{ $bantuan->peruntukan }}
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </td>

                            <!-- Waktu Penyaluran -->
                            <td class="py-3.5 px-4 align-top whitespace-nowrap text-xs">
                                <span class="font-bold text-text-primary block">
                                    {{ $latestPenyaluran ? \Carbon\Carbon::parse($latestPenyaluran->tgl_penyaluran)->translatedFormat('d M Y') : '-' }}
                                </span>
                                @if($daysAgo > 30)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-red-100 text-red-800 mt-1">
                                        <span class="material-symbols-outlined text-[11px]">alarm</span>
                                        <span>{{ $daysAgo }} hari lalu (Urgent)</span>
                                    </span>
                                @elseif($daysAgo > 14)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-800 mt-1">
                                        <span class="material-symbols-outlined text-[11px]">schedule</span>
                                        <span>{{ $daysAgo }} hari lalu</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-700 mt-1">
                                        <span>{{ $daysAgo }} hari lalu</span>
                                    </span>
                                @endif
                                <span class="text-[11px] text-text-tertiary block mt-1">
                                    Disalurkan oleh: {{ $latestPenyaluran && $latestPenyaluran->pendamping ? $latestPenyaluran->pendamping->name : 'Pendamping' }}
                                </span>
                            </td>

                            <!-- Riwayat Kunjungan -->
                            <td class="py-3.5 px-4 align-top whitespace-nowrap text-xs">
                                @if($totalKunjunganSebelumnya === 0)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-red-100 text-red-800 border border-red-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                                        <span>Belum Pernah Dikunjungi</span>
                                    </span>
                                    <span class="text-[10px] text-text-tertiary block mt-1">
                                        0 riwayat kunjungan lapangan
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                        <span class="material-symbols-outlined text-[13px]">history</span>
                                        <span>Pernah Dikunjungi ({{ $totalKunjunganSebelumnya }}x)</span>
                                    </span>
                                    <span class="text-[10px] text-text-tertiary block mt-1">
                                        Terakhir: {{ \Carbon\Carbon::parse($kunjunganTerakhir->tanggal_lapor)->format('d/m/Y') }}
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi Lapangan -->
                            <td class="py-3.5 px-4 align-top text-right whitespace-nowrap">
                                <div class="flex flex-col items-end gap-1.5">
                                    @php
                                        $primaryBantuan = $unvisitedBantuans->first();
                                    @endphp
                                    <!-- Tombol Utama: Langsung Catat Kunjungan untuk Bantuan Ini -->
                                    <a href="{{ route('pendamping.lapor.create', [
                                            'keluarga_id' => $keluarga->id,
                                            'penyaluran_id' => $primaryBantuan ? $primaryBantuan->id : null,
                                            'program_id' => $primaryBantuan ? $primaryBantuan->program_bantuan_id : null
                                        ]) }}" 
                                       class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-primary text-white hover:bg-gov-green-dark transition-all text-xs font-bold shadow-sm hover:shadow">
                                        <span class="material-symbols-outlined text-[16px]">pin_drop</span>
                                        <span>Lakukan Kunjungan</span>
                                    </a>

                                    <!-- Tombol Sekunder: Lihat Detail Bantuan -->
                                    <a href="{{ route('pendamping.penyaluran-bantuan.show', [$keluarga->id, 'type' => 'keluarga']) }}" 
                                       class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-xl bg-surface-subtle text-text-secondary hover:text-text-primary hover:bg-surface-muted transition-all text-xs font-semibold border border-border-light">
                                        <span class="material-symbols-outlined text-[14px]">visibility</span>
                                        <span>Detail Bantuan</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-14 px-4 text-center">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="w-16 h-16 rounded-full bg-gov-green-surface flex items-center justify-center text-primary shadow-xs">
                                        <span class="material-symbols-outlined text-[36px]">verified</span>
                                    </div>
                                    <h3 class="font-headline-sm text-headline-sm text-text-primary font-bold">
                                        Luar Biasa! Semua Bantuan Telah Dikunjungi & Dipantau
                                    </h3>
                                    <p class="text-sm text-text-secondary max-w-md">
                                        Tidak ada keluarga penerima bantuan yang tertinggal dalam antrean kunjungan. Seluruh bantuan yang disalurkan telah memiliki catatan monitoring perkembangan lapangan.
                                    </p>
                                    <div class="flex items-center gap-2 mt-2">
                                        <a href="{{ route('pendamping.penyaluran-bantuan.index') }}" class="px-4 py-2 rounded-xl bg-surface-subtle text-text-primary text-xs font-bold border border-border-light hover:bg-surface-muted transition-all">
                                            Lihat Semua Penyaluran
                                        </a>
                                        <a href="{{ route('pendamping.lapor.index') }}" class="px-4 py-2 rounded-xl bg-primary text-white text-xs font-bold hover:bg-gov-green-dark transition-all">
                                            Lihat Laporan Kunjungan
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($penerimas->hasPages())
            <div class="p-space-md border-t border-border-light bg-surface-subtle">
                {{ $penerimas->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
