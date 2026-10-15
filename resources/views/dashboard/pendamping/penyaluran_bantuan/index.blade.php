@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <div class="flex items-center gap-space-sm mb-space-xs">
                <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-gov-green-surface text-primary font-bold">
                    <span class="material-symbols-outlined text-[14px] mr-1">volunteer_activism</span>
                    TUGAS PENYALURAN PENDAMPING
                </span>
                <span class="text-text-tertiary text-body-sm font-body-sm">Penyaluran Bantuan dari Kampus Mitra</span>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Penyaluran Bantuan ke Keluarga Penerima Bantuan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Salurkan bantuan yang telah ditentukan oleh kampus mitra (uang modal, alat usaha/kompor, atau bibit tanaman) ke setiap keluarga penerima bantuan dan catat peruntukannya.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <a href="{{ route('pendamping.penyaluran-bantuan.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2.5 rounded-xl bg-primary text-on-primary font-label-md text-label-md font-bold hover:bg-gov-green-dark transition-all shadow-md hover:shadow-lg">
                <span class="material-symbols-outlined text-[18px]">add_circle</span>
                <span>+ Salurkan Bantuan Baru</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20 flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Banner Penjelasan Peran & Alur Bantuan -->
    <div class="bg-gradient-to-r from-gov-green-dark to-primary text-white rounded-2xl p-space-lg shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-start md:items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-white/10 backdrop-blur-md flex items-center justify-center shrink-0 border border-white/20">
                <span class="material-symbols-outlined text-[28px] text-white">info</span>
            </div>
            <div>
                <h3 class="font-bold text-base text-white">Alur Distribusi Bantuan Kampus & Pendamping</h3>
                <p class="text-xs text-white/85 mt-0.5 max-w-3xl leading-relaxed">
                    Program dan jenis bantuan (bibit, uang, atau barang/alat) ditetapkan oleh <strong>Kampus Mitra</strong>. Kader Pendamping bertugas menyalurkan secara tepat sasaran ke setiap KK binaan, mencatat rincian jumlah bantuan yang diterima, serta memastikan peruntukan dana uang tunai digunakan untuk modal produktif.
                </p>
            </div>
        </div>
    </div>

    <!-- 4 KPI Cards Ringkasan Penyaluran -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-lg">
        <!-- KPI 1: Uang -->
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-gold-surface flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined text-[26px]">payments</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-semibold">Total Uang Disalurkan</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">
                    Rp {{ number_format($totalNominalUang, 0, ',', '.') }}
                </span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Bantuan Tunai Modal</span>
            </div>
        </div>

        <!-- KPI 2: Alat / Barang -->
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center text-amber-800">
                <span class="material-symbols-outlined text-[26px]">home_repair_service</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-semibold">Alat / Barang Disalurkan</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">
                    {{ number_format($totalAlatUnit) }} Unit
                </span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Kompor, Sprayer, dll</span>
            </div>
        </div>

        <!-- KPI 3: Bibit Tanaman -->
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-gov-green-surface flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-[26px]">potted_plant</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-semibold">Bibit Disalurkan</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">
                    {{ number_format($totalBibitDisalurkan) }} Polybag/Kg
                </span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Tanaman Produktif</span>
            </div>
        </div>

        <!-- KPI 4: KK Tersalurkan -->
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-800">
                <span class="material-symbols-outlined text-[26px]">diversity_3</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-semibold">Keluarga Penerima</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">
                    {{ number_format($totalKkMenerima) }} KK
                </span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Keluarga Penerima Bantuan</span>
            </div>
        </div>
    </div>

    <!-- FILTER PERIODE WAKTU (Hari, Minggu, Bulan, Tahun, Rentang Kustom) -->
    <x-period-filter :periodInfo="$periodInfo" label="Pilih Periode Penyaluran:" />

    <!-- TAB NAVIGASI ANTARA SELURUH PENYALURAN & BELUM DIKUNJUNGI -->
    @php
        $unvisitedCountBanner = \App\Models\KeluargaPenerima::whereHas('penyaluranBantuans', function($q) {
            $q->where('status', '!=', 'batal')->whereDoesntHave('laporanTumbuhKembangs');
        })->count();
    @endphp
    <div class="flex items-center gap-2 border-b border-border-light pb-2 overflow-x-auto">
        <a href="{{ route('pendamping.penyaluran-bantuan.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold bg-primary text-white shadow-xs">
            <span class="material-symbols-outlined text-[15px]">list_alt</span>
            <span>Semua Penyaluran ({{ $totalKkMenerima }} KK)</span>
        </a>
        <a href="{{ route('pendamping.pantau-penyaluran.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold bg-amber-500/15 text-amber-950 border border-amber-300 hover:bg-amber-600 hover:text-white transition-all shadow-xs">
            <span class="material-symbols-outlined text-[15px]">tour</span>
            <span>Belum Dikunjungi ({{ $unvisitedCountBanner }} KK)</span>
            <span class="material-symbols-outlined text-[13px]">arrow_forward</span>
        </a>
    </div>

    <!-- Filter & Search Section -->
    <div class="bg-canvas-bg rounded-2xl p-space-md shadow-sm border border-border-light flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3">
        <form action="{{ route('pendamping.penyaluran-bantuan.index') }}" method="GET" class="flex flex-wrap items-center gap-3 flex-1">
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
            <!-- Search -->
            <div class="relative flex-1 min-w-[220px]">
                <span class="material-symbols-outlined absolute left-3 top-2.5 text-text-tertiary text-[18px]">search</span>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari kepala keluarga, NIK, nama bibit/alat..."
                    class="w-full pl-9 pr-3 py-2 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm focus:border-primary focus:bg-canvas-bg focus:outline-none transition-all">
            </div>

            <!-- Filter Jenis -->
            <select name="jenis" onchange="this.form.submit()" class="px-3 py-2 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm focus:border-primary focus:outline-none transition-all">
                <option value="">Semua Jenis Bantuan</option>
                <option value="bibit" {{ request('jenis') === 'bibit' ? 'selected' : '' }}>🌱 Bibit Tanaman</option>
                <option value="uang" {{ request('jenis') === 'uang' ? 'selected' : '' }}>💵 Uang Tunai Modal</option>
                <option value="barang" {{ request('jenis') === 'barang' ? 'selected' : '' }}>🛠️ Barang / Alat Usaha</option>
            </select>

            <!-- Filter Program -->
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

            @if(request()->anyFilled(['search', 'jenis', 'program_id']))
                <a href="{{ route('pendamping.penyaluran-bantuan.index') }}" class="px-3 py-2 text-text-secondary hover:text-text-primary font-label-sm text-label-sm">
                    Reset
                </a>
            @endif
        </form>

        <a href="{{ route('pendamping.penyaluran-bantuan.create') }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl bg-primary text-on-primary font-label-sm text-label-sm font-bold hover:bg-gov-green-dark transition-all shrink-0">
            <span class="material-symbols-outlined text-[16px]">add</span>
            <span>+ Salurkan Bantuan</span>
        </a>
    </div>

    <!-- Tabel Daftar Penyaluran (Tersatukan per Keluarga Penerima) -->
    <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Keluarga Penerima</th>
                        <th class="py-3 px-4 font-semibold">Program Kampus yang Didapat</th>
                        <th class="py-3 px-4 font-semibold">Rincian Paket Bantuan Diterima</th>
                        <th class="py-3 px-4 font-semibold">Penyaluran Terakhir</th>
                        <th class="py-3 px-4 font-semibold">Monitoring Perkembangan</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($penerimas as $keluarga)
                        @php
                            $bantuans = $keluarga->penyaluranBantuans;
                            $progs = $bantuans->map(fn($p) => $p->programBantuan)->filter()->unique('id');
                            $uangTotal = $bantuans->where('jenis', 'uang')->sum('nominal_uang');
                            $bibitTotal = $bantuans->where('jenis', 'bibit')->sum('jumlah');
                            $alatTotal = $bantuans->where('jenis', 'barang')->sum('jumlah');
                            $latestPenyaluran = $bantuans->first();
                            $latestMonitoring = $bantuans->map(fn($b) => $b->latestPerkembangan)->filter()->sortByDesc('tanggal_lapor')->first();
                            $totalKunjungan = $bantuans->sum(fn($b) => $b->laporan_tumbuh_kembangs_count ?? ($b->laporanTumbuhKembangs ? $b->laporanTumbuhKembangs->count() : 0));
                        @endphp
                        <tr class="hover:bg-surface-subtle transition-colors group">
                            <!-- Keluarga Penerima -->
                            <td class="py-3.5 px-4">
                                <a href="{{ route('pendamping.penyaluran-bantuan.show', [$keluarga->id, 'type' => 'keluarga']) }}" class="font-bold text-text-primary hover:text-primary transition-colors block text-sm">
                                    {{ $keluarga->kepala_keluarga }}
                                </a>
                                <div class="text-[11px] text-text-tertiary flex flex-wrap items-center gap-1.5 mt-0.5">
                                    <span>NIK: {{ $keluarga->nik }}</span>
                                    <span>•</span>
                                    <span class="text-text-secondary font-medium">Desa {{ $keluarga->wilayah->nama ?? '-' }}</span>
                                    <span>•</span>
                                    <span class="px-1.5 py-0.2 rounded bg-blue-50 text-blue-700 font-bold text-[10px]">Desil {{ $keluarga->desil ?? '-' }}</span>
                                </div>
                            </td>

                            <!-- Program Kampus yang Didapat -->
                            <td class="py-3.5 px-4 max-w-xs">
                                <div class="flex flex-col gap-1">
                                    @forelse($progs as $prog)
                                        <div class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-lg text-xs font-semibold bg-surface-muted text-text-primary border border-border-light w-fit" title="{{ $prog->nama_program }}">
                                            <span class="material-symbols-outlined text-[13px] text-primary">school</span>
                                            <span class="truncate max-w-[180px]">{{ $prog->nama_program }}</span>
                                        </div>
                                    @empty
                                        <span class="text-xs text-text-tertiary">-</span>
                                    @endforelse
                                </div>
                            </td>

                            <!-- Rincian Paket Bantuan Diterima -->
                            <td class="py-3.5 px-4">
                                <div class="flex flex-col gap-1">
                                    <span class="font-bold text-xs text-text-primary">
                                        {{ $bantuans->count() }} Jenis Bantuan Diterima
                                    </span>
                                    <div class="flex flex-wrap items-center gap-1.5 mt-0.5">
                                        @if($uangTotal > 0)
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-bold bg-gold-surface text-secondary border border-secondary/20">
                                                <span class="material-symbols-outlined text-[12px]">payments</span>
                                                <span>Rp {{ number_format($uangTotal, 0, ',', '.') }}</span>
                                            </span>
                                        @endif
                                        @if($bibitTotal > 0)
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-bold bg-gov-green-surface text-primary border border-primary/20">
                                                <span class="material-symbols-outlined text-[12px]">potted_plant</span>
                                                <span>{{ number_format($bibitTotal) }} Bibit</span>
                                            </span>
                                        @endif
                                        @if($alatTotal > 0)
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-bold bg-amber-100 text-amber-800 border border-amber-300">
                                                <span class="material-symbols-outlined text-[12px]">home_repair_service</span>
                                                <span>{{ number_format($alatTotal) }} Unit Alat</span>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Penyaluran Terakhir -->
                            <td class="py-3.5 px-4 whitespace-nowrap text-xs text-text-secondary">
                                <span class="font-bold text-text-primary block">
                                    {{ $latestPenyaluran ? \Carbon\Carbon::parse($latestPenyaluran->tgl_penyaluran)->translatedFormat('d M Y') : '-' }}
                                </span>
                                <span class="text-[11px] text-text-tertiary block mt-0.5">
                                    Petugas: {{ $latestPenyaluran && $latestPenyaluran->pendamping ? $latestPenyaluran->pendamping->name : 'Pendamping' }}
                                </span>
                            </td>

                            <!-- Monitoring Perkembangan -->
                            <td class="py-3.5 px-4">
                                @if($latestMonitoring)
                                    @if($latestMonitoring->status_kondisi === 'normal')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-gov-green-surface text-primary border border-primary/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                                            Normal / Produktif
                                        </span>
                                    @elseif($latestMonitoring->status_kondisi === 'hama')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-300">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Ada Kendala / Hama
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-red-50 text-red-700 border border-red-300">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Gagal / Rusak
                                        </span>
                                    @endif
                                    <span class="text-[10px] text-text-tertiary block mt-0.5">
                                        {{ $totalKunjungan }}x Kunjungan ({{ \Carbon\Carbon::parse($latestMonitoring->tanggal_lapor)->format('d/m/Y') }})
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-surface-subtle text-text-tertiary border border-border-light">
                                        <span class="w-1.5 h-1.5 rounded-full bg-text-tertiary"></span>
                                        Belum Ada Kunjungan
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- Aksi Detail Utama: Melihat apa saja bantuan dan program yang didapat -->
                                    <a href="{{ route('pendamping.penyaluran-bantuan.show', [$keluarga->id, 'type' => 'keluarga']) }}" 
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-primary text-on-primary hover:bg-gov-green-dark transition-all text-xs font-bold shadow-sm"
                                       title="Lihat Detail Program & Seluruh Bantuan yang Didapat">
                                        <span class="material-symbols-outlined text-[16px]">visibility</span>
                                        <span>Lihat Detail</span>
                                    </a>

                                    <!-- Update Perkembangan -->
                                    <a href="{{ route('pendamping.lapor.create', ['keluarga_id' => $keluarga->id]) }}" 
                                       class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-xl bg-gov-green-surface text-primary hover:bg-primary hover:text-on-primary transition-all text-xs font-bold border border-primary/20 shadow-xs"
                                       title="Update Perkembangan / Catat Kunjungan">
                                        <span class="material-symbols-outlined text-[15px]">edit_note</span>
                                        <span>Update</span>
                                    </a>

                                    <!-- Salurkan Lagi -->
                                    <a href="{{ route('pendamping.penyaluran-bantuan.create', ['keluarga_id' => $keluarga->id]) }}" 
                                       class="p-1.5 text-text-tertiary hover:text-primary hover:bg-surface-subtle rounded-lg transition-colors"
                                       title="Salurkan Bantuan Baru ke Keluarga Ini">
                                        <span class="material-symbols-outlined text-[18px]">add_circle</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 px-4 text-center text-text-tertiary">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-[40px] text-text-tertiary/60">volunteer_activism</span>
                                    <p class="font-body-md text-text-secondary font-medium">Belum ada keluarga penerima bantuan yang tercatat.</p>
                                    <p class="text-xs text-text-tertiary">Klik tombol di bawah untuk mencatat penyaluran bantuan bibit, uang modal, atau alat ke keluarga penerima bantuan.</p>
                                    <a href="{{ route('pendamping.penyaluran-bantuan.create') }}" class="mt-2 inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-primary text-on-primary font-label-sm text-label-sm font-bold hover:bg-gov-green-dark transition-all">
                                        <span class="material-symbols-outlined text-[18px]">add_circle</span>
                                        <span>+ Salurkan Bantuan Baru</span>
                                    </a>
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
