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
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Penyaluran Bantuan Keluarga Binaan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Salurkan bantuan yang telah ditentukan oleh kampus mitra (uang modal, alat usaha/kompor, atau bibit tanaman) ke setiap keluarga penerima binaan dan catat peruntukannya.
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
                <span class="font-label-xs text-label-xs text-text-tertiary">Keluarga Binaan</span>
            </div>
        </div>
    </div>

    <!-- FILTER PERIODE WAKTU (Hari, Minggu, Bulan, Tahun, Rentang Kustom) -->
    <x-period-filter :periodInfo="$periodInfo" label="Pilih Periode Penyaluran:" />

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

    <!-- Tabel Daftar Penyaluran -->
    <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Tgl Serah</th>
                        <th class="py-3 px-4 font-semibold">Keluarga Penerima</th>
                        <th class="py-3 px-4 font-semibold">Program Kampus</th>
                        <th class="py-3 px-4 font-semibold">Jenis & Item Bantuan</th>
                        <th class="py-3 px-4 font-semibold">Jumlah / Nominal</th>
                        <th class="py-3 px-4 font-semibold">Peruntukan / Penggunaan</th>
                        <th class="py-3 px-4 font-semibold">Pendamping Penyalur</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($penyalurans as $penyaluran)
                        <tr class="hover:bg-surface-subtle transition-colors group">
                            <!-- Tanggal -->
                            <td class="py-3.5 px-4 text-text-secondary whitespace-nowrap text-xs font-medium">
                                {{ \Carbon\Carbon::parse($penyaluran->tgl_penyaluran)->translatedFormat('d M Y') }}
                            </td>

                            <!-- Penerima -->
                            <td class="py-3.5 px-4">
                                @if($penyaluran->keluargaPenerima)
                                    <a href="{{ route('pendamping.keluarga_penerima.show', $penyaluran->keluarga_penerima_id) }}" class="font-bold text-text-primary hover:text-primary transition-colors block text-sm">
                                        {{ $penyaluran->keluargaPenerima->kepala_keluarga }}
                                    </a>
                                    <div class="text-[11px] text-text-tertiary flex items-center gap-1.5 mt-0.5">
                                        <span>NIK: {{ $penyaluran->keluargaPenerima->nik }}</span>
                                        <span>•</span>
                                        <span class="text-text-secondary">{{ $penyaluran->keluargaPenerima->wilayah->nama ?? 'Desa' }}</span>
                                    </div>
                                @else
                                    <span class="text-text-tertiary italic">Data Penerima Dihapus</span>
                                @endif
                            </td>

                            <!-- Program -->
                            <td class="py-3.5 px-4">
                                <span class="font-medium text-text-primary block text-xs line-clamp-1">
                                    {{ $penyaluran->programBantuan->nama_program ?? '-' }}
                                </span>
                                <span class="text-[11px] text-text-tertiary block">
                                    Tahun {{ $penyaluran->programBantuan->tahun_anggaran ?? '-' }}
                                </span>
                            </td>

                            <!-- Jenis & Item Bantuan -->
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-2">
                                    @if($penyaluran->jenis === 'bibit')
                                        <span class="p-1 rounded-lg bg-gov-green-surface text-primary shrink-0" title="Bibit">
                                            <span class="material-symbols-outlined text-[16px]">potted_plant</span>
                                        </span>
                                    @elseif($penyaluran->jenis === 'uang')
                                        <span class="p-1 rounded-lg bg-gold-surface text-secondary shrink-0" title="Uang Tunai">
                                            <span class="material-symbols-outlined text-[16px]">payments</span>
                                        </span>
                                    @else
                                        <span class="p-1 rounded-lg bg-amber-100 text-amber-800 shrink-0" title="Barang / Alat">
                                            <span class="material-symbols-outlined text-[16px]">home_repair_service</span>
                                        </span>
                                    @endif
                                    <div>
                                        <span class="font-bold text-text-primary block text-xs">
                                            {{ $penyaluran->itemBantuan->nama_item ?? '-' }}
                                        </span>
                                        <span class="text-[10px] uppercase font-semibold text-text-tertiary">
                                            {{ $penyaluran->jenis }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <!-- Jumlah / Nominal -->
                            <td class="py-3.5 px-4">
                                @if($penyaluran->jenis === 'uang')
                                    <div class="font-bold text-emerald-700 text-sm">
                                        Rp {{ number_format($penyaluran->nominal_uang ?? $penyaluran->jumlah, 0, ',', '.') }}
                                    </div>
                                    <span class="text-[10px] text-text-tertiary">Dana Tunai</span>
                                @else
                                    <div class="font-bold text-text-primary text-sm">
                                        {{ number_format($penyaluran->jumlah) }} {{ $penyaluran->satuan }}
                                    </div>
                                    <span class="text-[10px] text-text-tertiary">Barang/Bibit Fisik</span>
                                @endif
                            </td>

                            <!-- Peruntukan -->
                            <td class="py-3.5 px-4 max-w-xs">
                                @if($penyaluran->peruntukan)
                                    <span class="inline-block px-2 py-0.5 rounded bg-blue-50 text-blue-700 text-xs font-semibold mb-0.5">
                                        {{ $penyaluran->peruntukan }}
                                    </span>
                                @endif
                                @if($penyaluran->keterangan)
                                    <p class="text-xs text-text-secondary line-clamp-1">{{ $penyaluran->keterangan }}</p>
                                @endif
                                @if(!$penyaluran->peruntukan && !$penyaluran->keterangan)
                                    <span class="text-text-tertiary text-xs">-</span>
                                @endif
                            </td>

                            <!-- Pendamping Penyalur -->
                            <td class="py-3.5 px-4 text-xs text-text-secondary">
                                <div class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px] text-text-tertiary">support_agent</span>
                                    <span>{{ $penyaluran->pendamping->name ?? 'Pendamping' }}</span>
                                </div>
                            </td>

                            <!-- Aksi -->
                            <td class="py-3.5 px-4 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('pendamping.penyaluran-bantuan.show', $penyaluran->id) }}" class="p-1.5 text-text-tertiary hover:text-primary hover:bg-gov-green-surface rounded-lg transition-colors" title="Lihat Tanda Terima">
                                        <span class="material-symbols-outlined text-[18px]">receipt_long</span>
                                    </a>
                                    <form action="{{ route('pendamping.penyaluran-bantuan.destroy', $penyaluran->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan/menghapus catatan penyaluran ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-text-tertiary hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Batalkan Penyaluran">
                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 px-4 text-center text-text-tertiary">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-[40px] text-text-tertiary/60">volunteer_activism</span>
                                    <p class="font-body-md text-text-secondary font-medium">Belum ada catatan penyaluran bantuan.</p>
                                    <p class="text-xs text-text-tertiary">Klik tombol di bawah untuk mencatat penyaluran bantuan bibit, uang modal, atau alat ke keluarga binaan.</p>
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

        @if ($penyalurans->hasPages())
            <div class="p-space-md border-t border-border-light bg-surface-subtle">
                {{ $penyalurans->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
