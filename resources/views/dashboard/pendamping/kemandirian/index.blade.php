@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header Navigasi & Judul Halaman -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Monitoring Kemandirian & Perkembangan Desil</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Pantau progres kemandirian keluarga binaan (Desil 6+), proses keluarga menuju mandiri, serta deteksi penurunan tingkat desil dan pendapatan.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <a href="{{ route('pendamping.keluarga_penerima.index') }}" class="inline-flex items-center gap-space-xs px-space-md py-2.5 rounded-xl bg-primary text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">rate_review</span>
                <span>+ Input Penilaian Baru</span>
            </a>
        </div>
    </div>

    <!-- Alert / Banner Aturan Desil Kemandirian -->
    <div class="bg-gradient-to-r from-gov-green-dark to-primary text-white rounded-2xl p-space-lg shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-start md:items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-white/10 backdrop-blur-md flex items-center justify-center shrink-0 border border-white/20">
                <span class="material-symbols-outlined text-[28px] text-white">workspace_premium</span>
            </div>
            <div>
                <h3 class="font-bold text-base text-white">Standar Batas Kemandirian: Desil 6 ke Atas</h3>
                <p class="text-xs text-white/85 mt-0.5 max-w-2xl">
                    Keluarga penerima bantuan bibit dinyatakan <strong>Sudah Mandiri</strong> apabila telah berhasil meningkatkan pendapatan dan aset hingga mencapai <strong>Desil 6 ke atas (Desil 6–10)</strong>. Keluarga pada Desil 1–5 berada dalam <strong>Tahap Kemandirian</strong>.
                </p>
            </div>
        </div>
        <div class="flex items-center gap-3 bg-white/10 backdrop-blur-md px-4 py-2.5 rounded-xl border border-white/15 shrink-0">
            <div class="text-right">
                <span class="text-[11px] text-white/70 block uppercase font-semibold">Tingkat Kemandirian</span>
                <span class="text-lg font-bold text-white">{{ $persenMandiri }}% Mandiri</span>
            </div>
            <div class="w-px h-8 bg-white/20"></div>
            <div class="text-left">
                <span class="text-[11px] text-white/70 block uppercase font-semibold">Total Kunjungan</span>
                <span class="text-sm font-semibold text-white/95">{{ $totalKunjungan }} Evaluasi</span>
            </div>
        </div>
    </div>

    <!-- 4 KPI Cards Ringkasan Kemandirian -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-md">
        <!-- Card 1: Sudah Mandiri -->
        <a href="{{ route('pendamping.kemandirian.index', ['status' => 'mandiri']) }}" class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-between hover:border-green-500/50 transition-colors {{ request('status') === 'mandiri' ? 'ring-2 ring-green-500' : '' }}">
            <div class="flex items-center justify-between mb-2">
                <span class="font-label-md text-label-md text-text-secondary uppercase">Sudah Mandiri</span>
                <div class="w-8 h-8 rounded-lg bg-green-100 text-green-700 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px]">verified</span>
                </div>
            </div>
            <div>
                <div class="flex items-baseline gap-2">
                    <span class="font-headline-xl text-headline-xl text-green-700 font-bold">{{ $totalMandiri }} KK</span>
                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-0.5 rounded-full">{{ $persenMandiri }}%</span>
                </div>
                <span class="text-label-sm text-text-secondary mt-1 block">Tingkatan Desil 6 s.d. 10</span>
            </div>
        </a>

        <!-- Card 2: Dalam Tahap Kemandirian -->
        <a href="{{ route('pendamping.kemandirian.index', ['status' => 'tahap_kemandirian']) }}" class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-between hover:border-blue-500/50 transition-colors {{ request('status') === 'tahap_kemandirian' ? 'ring-2 ring-blue-500' : '' }}">
            <div class="flex items-center justify-between mb-2">
                <span class="font-label-md text-label-md text-text-secondary uppercase">Tahap Kemandirian</span>
                <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px]">trending_up</span>
                </div>
            </div>
            <div>
                <div class="flex items-baseline gap-2">
                    <span class="font-headline-xl text-headline-xl text-blue-700 font-bold">{{ $totalTahap }} KK</span>
                    <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">{{ $persenTahap }}%</span>
                </div>
                <span class="text-label-sm text-text-secondary mt-1 block">Tingkatan Desil 1 s.d. 5 (Berproses)</span>
            </div>
        </a>

        <!-- Card 3: Penurunan / Kemunduran Desil -->
        <a href="{{ route('pendamping.kemandirian.index', ['status' => 'penurunan']) }}" class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-between hover:border-amber-500/50 transition-colors {{ request('status') === 'penurunan' ? 'ring-2 ring-amber-500' : '' }}">
            <div class="flex items-center justify-between mb-2">
                <span class="font-label-md text-label-md text-text-secondary uppercase">Penurunan Desil</span>
                <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px]">warning</span>
                </div>
            </div>
            <div>
                <div class="flex items-baseline gap-2">
                    <span class="font-headline-xl text-headline-xl text-amber-700 font-bold">{{ $totalPenurunan }} KK</span>
                    <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full">{{ $persenPenurunan }}%</span>
                </div>
                <span class="text-label-sm text-text-secondary mt-1 block">Taraf Ekonomi Menurun</span>
            </div>
        </a>

        <!-- Card 4: Rata-rata Pendapatan Bulanan -->
        <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-between">
            <div class="flex items-center justify-between mb-2">
                <span class="font-label-md text-label-md text-text-secondary uppercase">Rata-rata Pendapatan</span>
                <div class="w-8 h-8 rounded-lg bg-gov-green-surface text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px]">payments</span>
                </div>
            </div>
            <div>
                <span class="font-headline-xl text-headline-xl text-text-primary font-bold">
                    Rp {{ number_format($rataRataPenghasilan, 0, ',', '.') }}
                </span>
                <span class="text-label-sm text-text-secondary mt-1 block">Per Bulan / Keluarga Binaan</span>
            </div>
        </div>
    </div>

    <!-- Section Grafik Interaktif (Chart.js) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg">
        <!-- Grafik 1: Proporsi Status Kemandirian (Doughnut Chart) -->
        <div class="lg:col-span-5 bg-canvas-bg rounded-2xl shadow-sm border border-border-light p-space-lg flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-3 border-b border-border-light mb-4">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[20px]">pie_chart</span>
                        <h2 class="font-bold text-text-primary text-base">Proporsi Status Kemandirian</h2>
                    </div>
                    <span class="text-[11px] text-text-tertiary">Total: {{ $totalBinaan }} KK</span>
                </div>
                <div class="relative flex items-center justify-center h-64">
                    <canvas id="chart-proporsi-kemandirian"></canvas>
                </div>
            </div>
            <!-- Custom Legend -->
            <div class="mt-4 pt-3 border-t border-border-light grid grid-cols-3 gap-2 text-center text-xs">
                <div class="p-2 rounded-lg bg-green-50">
                    <span class="text-green-800 font-bold block text-sm">{{ $totalMandiri }} KK</span>
                    <span class="text-[11px] text-green-700">Sudah Mandiri</span>
                </div>
                <div class="p-2 rounded-lg bg-blue-50">
                    <span class="text-blue-800 font-bold block text-sm">{{ $totalTahap }} KK</span>
                    <span class="text-[11px] text-blue-700">Tahap Mandiri</span>
                </div>
                <div class="p-2 rounded-lg bg-amber-50">
                    <span class="text-amber-800 font-bold block text-sm">{{ $totalPenurunan }} KK</span>
                    <span class="text-[11px] text-amber-700">Penurunan Desil</span>
                </div>
            </div>
        </div>

        <!-- Grafik 2: Distribusi Jumlah Keluarga per Tingkat Desil (Bar Chart) -->
        <div class="lg:col-span-7 bg-canvas-bg rounded-2xl shadow-sm border border-border-light p-space-lg flex flex-col justify-between">
            <div>
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-3 border-b border-border-light mb-4 gap-2">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary text-[20px]">bar_chart</span>
                        <h2 class="font-bold text-text-primary text-base">Distribusi Tingkat Desil Keluarga Binaan</h2>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <span class="inline-flex items-center gap-1 text-blue-600 font-medium">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-500 inline-block"></span>
                            Desil 1–5: Tahap Kemandirian
                        </span>
                        <span class="inline-flex items-center gap-1 text-green-600 font-semibold">
                            <span class="w-2.5 h-2.5 rounded-full bg-green-600 inline-block"></span>
                            Desil 6–10: Sudah Mandiri
                        </span>
                    </div>
                </div>
                <div class="relative h-64">
                    <canvas id="chart-distribusi-desil"></canvas>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-border-light flex items-center justify-between text-xs text-text-secondary">
                <span>Garis pemisah: Desil 6 adalah ambang batas keluarga lulus (graduasi) dari kemiskinan.</span>
                <span class="font-semibold text-primary">Standar Kemensos / BPS</span>
            </div>
        </div>
    </div>

    <!-- Section Tabel 1: Rekapitulasi Status Kemandirian Keluarga Binaan -->
    <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light p-space-lg flex flex-col gap-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 pb-3 border-b border-border-light">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[22px]">groups</span>
                <div>
                    <h2 class="font-bold text-text-primary text-base">Rekapitulasi Status Kemandirian Keluarga Binaan</h2>
                    <span class="text-xs text-text-secondary">Daftar keluarga dengan klasifikasi tingkat kemandirian terkini</span>
                </div>
            </div>

            <!-- Filter Status Tab -->
            <div class="flex flex-wrap items-center gap-1.5 p-1 rounded-xl bg-surface-subtle border border-border-light text-xs font-semibold">
                <a href="{{ route('pendamping.kemandirian.index', array_merge(request()->query(), ['status' => null])) }}"
                    class="px-3 py-1.5 rounded-lg transition-colors {{ empty(request('status')) ? 'bg-primary text-white shadow-sm' : 'text-text-secondary hover:text-text-primary' }}">
                    Semua ({{ $totalBinaan }})
                </a>
                <a href="{{ route('pendamping.kemandirian.index', array_merge(request()->query(), ['status' => 'mandiri'])) }}"
                    class="px-3 py-1.5 rounded-lg transition-colors {{ request('status') === 'mandiri' ? 'bg-green-600 text-white shadow-sm' : 'text-green-700 hover:bg-green-50' }}">
                    Sudah Mandiri ({{ $totalMandiri }})
                </a>
                <a href="{{ route('pendamping.kemandirian.index', array_merge(request()->query(), ['status' => 'tahap_kemandirian'])) }}"
                    class="px-3 py-1.5 rounded-lg transition-colors {{ request('status') === 'tahap_kemandirian' ? 'bg-blue-600 text-white shadow-sm' : 'text-blue-700 hover:bg-blue-50' }}">
                    Tahap Mandiri ({{ $totalTahap }})
                </a>
                <a href="{{ route('pendamping.kemandirian.index', array_merge(request()->query(), ['status' => 'penurunan'])) }}"
                    class="px-3 py-1.5 rounded-lg transition-colors {{ request('status') === 'penurunan' ? 'bg-amber-600 text-white shadow-sm' : 'text-amber-700 hover:bg-amber-50' }}">
                    Penurunan Desil ({{ $totalPenurunan }})
                </a>
            </div>
        </div>

        <!-- Search & Filter Bar -->
        <form action="{{ route('pendamping.kemandirian.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif

            <div class="flex-1 relative w-full">
                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-text-secondary text-[20px]">search</span>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama kepala keluarga, NIK, No. KK..."
                    class="w-full pl-11 pr-4 py-2 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-xs focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                @if(request('search'))
                    <a href="{{ route('pendamping.kemandirian.index', request()->except('search')) }}" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-text-tertiary hover:text-text-primary">
                        <span class="material-symbols-outlined text-[16px]">close</span>
                    </a>
                @endif
            </div>

            <div class="w-full sm:w-64 shrink-0">
                <select name="wilayah_id" onchange="this.form.submit()" class="searchable-select w-full px-3 py-2 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-xs focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    <option value="">Semua Wilayah Desa</option>
                    @foreach($wilayahs as $w)
                        <option value="{{ $w->id }}" 
                            data-subtext="{{ $w->parent ? 'Kec. ' . $w->parent->nama : '' }}"
                            {{ request('wilayah_id') == $w->id ? 'selected' : '' }}>
                            Desa {{ $w->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="px-4 py-2 rounded-xl bg-primary text-white text-xs font-semibold hover:bg-gov-green-dark transition-colors shrink-0 flex items-center gap-1 shadow-sm">
                <span class="material-symbols-outlined text-[16px]">filter_alt</span>
                <span>Terapkan</span>
            </button>
            @if(request()->hasAny(['search', 'wilayah_id', 'status']))
                <a href="{{ route('pendamping.kemandirian.index') }}" class="px-3 py-2 rounded-xl bg-surface-container-high hover:bg-surface-container-highest text-text-secondary hover:text-text-primary text-xs font-semibold transition-colors shrink-0 flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">refresh</span>
                    <span>Reset</span>
                </a>
            @endif
        </form>

        <!-- Tabel Rekapitulasi -->
        <div class="overflow-x-auto rounded-xl border border-border-light">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Kepala Keluarga</th>
                        <th class="py-3 px-4 font-semibold">Wilayah / Desa</th>
                        <th class="py-3 px-4 font-semibold">Penghasilan/Bln</th>
                        <th class="py-3 px-4 font-semibold">Tingkat Desil</th>
                        <th class="py-3 px-4 font-semibold">Status Kemandirian</th>
                        <th class="py-3 px-4 font-semibold">Perkembangan</th>
                        <th class="py-3 px-4 font-semibold">Evaluasi Terakhir</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($keluargaList as $kl)
                    @php
                        $latestNilai = $kl->penilaianKemandirians->first();
                    @endphp
                    <tr class="hover:bg-surface-subtle transition-colors">
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gov-green-surface text-primary flex items-center justify-center font-bold text-xs shrink-0">
                                    {{ strtoupper(substr($kl->kepala_keluarga, 0, 1)) }}
                                </div>
                                <div>
                                    <span class="font-semibold text-text-primary block text-sm">{{ $kl->kepala_keluarga }}</span>
                                    <span class="text-text-tertiary font-mono text-[11px]">NIK: {{ $kl->nik }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-text-primary text-xs">
                            <div>{{ $kl->wilayah->nama ?? 'Sumbawa' }}</div>
                            <span class="text-text-tertiary text-[11px]">{{ $kl->alamat }}</span>
                        </td>
                        <td class="py-3 px-4 font-mono text-xs">
                            @if(($kl->penghasilan_perbulan ?? 0) > 0)
                                <span class="font-bold text-text-primary">Rp {{ number_format($kl->penghasilan_perbulan, 0, ',', '.') }}</span>
                            @else
                                <span class="text-text-tertiary italic">Belum dinilai</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-block px-2.5 py-0.5 rounded text-xs font-bold {{ $kl->desil >= 6 ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                Desil {{ $kl->desil }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            @if ($kl->desil >= 6 || $kl->status_kemandirian == 'Mandiri')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                    <span class="material-symbols-outlined text-[14px]">verified</span>
                                    Sudah Mandiri
                                </span>
                            @elseif ($kl->status_kemandirian == 'Penurunan Desil')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                    <span class="material-symbols-outlined text-[14px]">trending_down</span>
                                    Penurunan Desil
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                    <span class="material-symbols-outlined text-[14px]">hourglass_top</span>
                                    Tahap Kemandirian
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            @if ($latestNilai && $latestNilai->status_perkembangan == 'Maju')
                                <span class="inline-flex items-center gap-0.5 text-green-700 text-xs font-bold">
                                    <span class="material-symbols-outlined text-[15px]">trending_up</span>
                                    Maju
                                </span>
                            @elseif ($latestNilai && $latestNilai->status_perkembangan == 'Mundur')
                                <span class="inline-flex items-center gap-0.5 text-amber-700 text-xs font-bold">
                                    <span class="material-symbols-outlined text-[15px]">trending_down</span>
                                    Mundur
                                </span>
                            @else
                                <span class="inline-flex items-center gap-0.5 text-blue-700 text-xs font-semibold">
                                    <span class="material-symbols-outlined text-[15px]">trending_flat</span>
                                    Tetap
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-xs text-text-secondary whitespace-nowrap">
                            @if($latestNilai)
                                <span>{{ \Carbon\Carbon::parse($latestNilai->created_at)->format('d M Y') }}</span>
                                <span class="text-text-tertiary block text-[11px]">{{ $latestNilai->periode }}</span>
                            @else
                                <span class="text-text-tertiary italic">-</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-right whitespace-nowrap">
                            <div class="inline-flex items-center gap-1">
                                <a href="{{ route('pendamping.keluarga_penerima.penilaian.create', $kl->id) }}" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-gov-green-surface hover:bg-gov-green text-primary hover:text-white font-label-md text-xs font-semibold transition-colors border border-primary/20" title="Input Penilaian Baru">
                                    <span class="material-symbols-outlined text-[14px]">rate_review</span>
                                    <span>Nilai Desil</span>
                                </a>
                                <a href="{{ route('pendamping.keluarga_penerima.show', $kl->id) }}" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-surface-container-low hover:bg-surface-container-high text-text-secondary hover:text-text-primary font-label-md text-xs font-semibold transition-colors border border-border-light" title="Detail Profil">
                                    <span class="material-symbols-outlined text-[14px]">visibility</span>
                                    <span>Detail</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-10 text-text-tertiary">
                            <span class="material-symbols-outlined text-4xl block mb-2 text-text-tertiary">group_off</span>
                            Tidak ada data keluarga yang sesuai dengan kriteria filter.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Section Tabel 2: Histori Penilaian Desil Dari Tiap Kunjungan -->
    <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light p-space-lg flex flex-col gap-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-3 border-b border-border-light gap-2">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-secondary text-[22px]">history_edu</span>
                <div>
                    <h2 class="font-bold text-text-primary text-base">Histori Penilaian Desil & Update Tiap Kunjungan</h2>
                    <span class="text-xs text-text-secondary">Log lengkap evaluasi lapangan yang telah diinputkan oleh pendamping</span>
                </div>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-gov-green-surface text-primary border border-primary/20 self-start sm:self-auto">
                Total: {{ $historiKunjungan->count() }} Kunjungan Tercatat
            </span>
        </div>

        <div class="overflow-x-auto rounded-xl border border-border-light">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Tanggal & Periode</th>
                        <th class="py-3 px-4 font-semibold">Penerima Bantuan</th>
                        <th class="py-3 px-4 font-semibold">Pendamping Penilai</th>
                        <th class="py-3 px-4 font-semibold">Penghasilan & Kapita</th>
                        <th class="py-3 px-4 font-semibold">Rincian Aset</th>
                        <th class="py-3 px-4 font-semibold">Perubahan Desil</th>
                        <th class="py-3 px-4 font-semibold">Status Hasil</th>
                        <th class="py-3 px-4 font-semibold">Catatan Kunjungan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($historiKunjungan as $hk)
                    <tr class="hover:bg-surface-subtle transition-colors">
                        <td class="py-3 px-4 whitespace-nowrap">
                            <span class="font-bold text-text-primary block text-xs">{{ \Carbon\Carbon::parse($hk->created_at)->format('d M Y, H:i') }}</span>
                            <span class="text-text-tertiary text-[11px]">{{ $hk->periode }}</span>
                        </td>
                        <td class="py-3 px-4">
                            <a href="{{ route('pendamping.keluarga_penerima.show', $hk->keluarga_penerima_id) }}" class="font-semibold text-primary hover:underline text-xs block">
                                {{ $hk->keluargaPenerima->kepala_keluarga ?? $hk->keluargaPenerima->nama ?? 'Penerima Bantuan' }}
                            </a>
                            <span class="text-text-tertiary text-[11px]">Desa {{ $hk->keluargaPenerima->wilayah->nama ?? 'Sumbawa' }}</span>
                        </td>
                        <td class="py-3 px-4 text-xs text-text-secondary">
                            {{ $hk->pendamping->name ?? 'Pendamping Lapangan' }}
                        </td>
                        <td class="py-3 px-4 font-mono text-xs">
                            <span class="font-bold text-text-primary block">Rp {{ number_format($hk->penghasilan_perbulan ?? 0, 0, ',', '.') }}</span>
                            @if(($hk->pendapatan_per_kapita ?? 0) > 0)
                                <span class="text-[11px] text-primary">Rp {{ number_format($hk->pendapatan_per_kapita, 0, ',', '.') }}/kapita</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-xs text-text-secondary">
                            <div class="flex flex-col gap-0.5">
                                <span><strong>Rumah:</strong> {{ str_replace('_', ' ', $hk->aset_rumah ?? 'Semi Permanen') }}</span>
                                <span><strong>Lahan:</strong> {{ str_replace('_', ' ', $hk->aset_tanah ?? '-') }}</span>
                                <span><strong>Kendaraan:</strong> {{ str_replace('_', ' ', $hk->aset_kendaraan ?? '-') }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-4 whitespace-nowrap">
                            <div class="flex items-center gap-1.5">
                                @if($hk->desil_sebelumnya)
                                    <span class="px-2 py-0.5 rounded text-[11px] font-semibold bg-gray-100 text-gray-700">
                                        Desil {{ $hk->desil_sebelumnya }}
                                    </span>
                                    <span class="material-symbols-outlined text-[14px] text-text-tertiary">arrow_forward</span>
                                @endif
                                <span class="px-2 py-0.5 rounded text-[11px] font-bold {{ ($hk->desil_hasil ?? 1) >= 6 ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    Desil {{ $hk->desil_hasil ?? '-' }}
                                </span>
                            </div>
                            <span class="text-[10px] text-text-tertiary block mt-0.5">Skor: {{ $hk->total_skor ?? 0 }}/100</span>
                        </td>
                        <td class="py-3 px-4 whitespace-nowrap">
                            @if ($hk->status_perkembangan == 'Maju')
                                <span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded text-xs font-bold bg-green-100 text-green-800">
                                    <span class="material-symbols-outlined text-[14px]">trending_up</span>
                                    Maju
                                </span>
                            @elseif ($hk->status_perkembangan == 'Mundur')
                                <span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded text-xs font-bold bg-amber-100 text-amber-800">
                                    <span class="material-symbols-outlined text-[14px]">trending_down</span>
                                    Mundur
                                </span>
                            @else
                                <span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded text-xs font-semibold bg-blue-100 text-blue-800">
                                    <span class="material-symbols-outlined text-[14px]">trending_flat</span>
                                    Tetap
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-xs text-text-secondary max-w-xs">
                            <p class="truncate" title="{{ $hk->catatan }}">{{ $hk->catatan ?? '-' }}</p>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-10 text-text-tertiary">
                            <span class="material-symbols-outlined text-4xl block mb-2 text-text-tertiary">history_toggle_off</span>
                            Belum ada histori kunjungan penilaian yang tercatat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- CDN Chart.js & Script Pengendali Grafik Interaktif -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Inisialisasi Doughnut Chart: Proporsi Kemandirian
        const ctxProporsi = document.getElementById('chart-proporsi-kemandirian').getContext('2d');
        new Chart(ctxProporsi, {
            type: 'doughnut',
            data: {
                labels: ['Sudah Mandiri (Desil 6+)', 'Tahap Kemandirian (Desil 1–5)', 'Penurunan Desil'],
                datasets: [{
                    data: [{{ $totalMandiri }}, {{ $totalTahap }}, {{ $totalPenurunan }}],
                    backgroundColor: ['#16a34a', '#2563eb', '#d97706'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = {{ max(1, $totalBinaan) }};
                                const value = context.parsed;
                                const percentage = Math.round((value / total) * 100);
                                return ' ' + context.label + ': ' + value + ' KK (' + percentage + '%)';
                            }
                        }
                    }
                },
                cutout: '68%'
            }
        });

        // 2. Inisialisasi Bar Chart: Distribusi per Tingkat Desil (Desil 1 s/d 10)
        const ctxDesil = document.getElementById('chart-distribusi-desil').getContext('2d');
        const labelsDesil = ['Desil 1', 'Desil 2', 'Desil 3', 'Desil 4', 'Desil 5', 'Desil 6', 'Desil 7', 'Desil 8', 'Desil 9', 'Desil 10'];
        const dataDesil = [
            {{ $distribusiDesil[1] ?? 0 }},
            {{ $distribusiDesil[2] ?? 0 }},
            {{ $distribusiDesil[3] ?? 0 }},
            {{ $distribusiDesil[4] ?? 0 }},
            {{ $distribusiDesil[5] ?? 0 }},
            {{ $distribusiDesil[6] ?? 0 }},
            {{ $distribusiDesil[7] ?? 0 }},
            {{ $distribusiDesil[8] ?? 0 }},
            {{ $distribusiDesil[9] ?? 0 }},
            {{ $distribusiDesil[10] ?? 0 }}
        ];

        // Warna bar: Biru untuk Desil 1-5 (Tahap Kemandirian), Hijau untuk Desil 6-10 (Sudah Mandiri)
        const barColors = dataDesil.map((val, idx) => idx < 5 ? '#3b82f6' : '#16a34a');

        new Chart(ctxDesil, {
            type: 'bar',
            data: {
                labels: labelsDesil,
                datasets: [{
                    label: 'Jumlah Keluarga Binaan',
                    data: dataDesil,
                    backgroundColor: barColors,
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            afterLabel: function(context) {
                                return context.dataIndex >= 5 ? 'Status: Sudah Mandiri' : 'Status: Tahap Kemandirian';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        },
                        grid: {
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
