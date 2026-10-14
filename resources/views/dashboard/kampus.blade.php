@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Page Header & Operational Metadata -->
    <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-space-lg">
        <div class="flex flex-col gap-space-xs max-w-3xl">
            <div class="flex flex-wrap items-center gap-space-sm mb-1">
                <span class="inline-flex items-center gap-1.5 px-space-md py-0.5 rounded-full bg-gov-green-surface text-gov-green-dark font-label-sm text-label-sm font-semibold shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-status-verified"></span>
                    Universitas Teknologi Sumbawa (UTS) &amp; Mitra Kampus
                </span>
                <span class="inline-flex items-center px-space-sm py-0.5 rounded-full bg-surface-container-high text-on-surface-variant font-code-dense text-code-dense font-medium">
                    TA 2026 Aktif
                </span>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-on-background tracking-tight font-bold">
                Dashboard Koordinator Kampus Mitra
            </h1>
            <p class="font-body-md text-body-md text-text-secondary">
                Kelola program subsidi bantuan (bibit pertanian, bantuan tunai usaha, dan fasilitas/alat), pantau realisasi penyaluran kader pendamping, dan monitoring dampak keluarga binaan.
            </p>
        </div>
        <!-- Top Global Actions -->
        <div class="flex flex-wrap items-center gap-space-sm shrink-0">
            <a href="{{ route('kampus.program-bantuan.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-all shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add_circle</span>
                <span>+ Program Bantuan Baru</span>
            </a>
            <a href="{{ route('kampus.penyaluran.index') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-surface-container-lowest text-text-primary font-label-md text-label-md font-semibold border border-border-light hover:bg-surface-container-low transition-all shadow-sm">
                <span class="material-symbols-outlined text-[18px] text-primary">volunteer_activism</span>
                <span>Penyaluran Bantuan</span>
            </a>
            <a href="{{ route('kampus.laporan.pdf') }}" target="_blank" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-surface-container-lowest text-text-secondary hover:text-text-primary font-label-md text-label-md font-semibold border border-border-light transition-all shadow-sm">
                <span class="material-symbols-outlined text-[18px]">file_download</span>
                <span>Cetak PDF</span>
            </a>
        </div>
    </div>

    <!-- FINANCIAL OVERVIEW: Dana Bappeda ke Kampus & Pengurangan Penggunaan -->
    <div class="p-space-lg rounded-2xl bg-gradient-to-r from-gov-green-dark via-primary-container to-primary text-white shadow-md relative overflow-hidden">
        <div class="absolute -right-12 -bottom-12 opacity-10 pointer-events-none">
            <span class="material-symbols-outlined text-[240px]">account_balance</span>
        </div>
        <div class="relative z-10 flex flex-col gap-space-md">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 border-b border-white/20 pb-space-sm">
                <div class="flex items-center gap-2">
                    <span class="p-2 rounded-lg bg-white/20 backdrop-blur-md flex items-center justify-center">
                        <span class="material-symbols-outlined text-white text-[22px]">account_balance_wallet</span>
                    </span>
                    <div>
                        <h2 class="text-base font-bold text-white tracking-tight">Alokasi Kas &amp; Dana Program dari Bappeda ke Kampus</h2>
                        <p class="text-xs text-white/80">Anggaran resmi yang diberikan oleh Bappeda Kab. Sumbawa kepada {{ $kampus->nama_universitas ?? 'Kampus Mitra' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/20 text-white backdrop-blur-md">
                        Serapan: {{ $persenSerapan }}%
                    </span>
                </div>
            </div>

            <!-- 3 Financial Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
                <!-- 1. Dana Bappeda -->
                <div class="p-space-md rounded-xl bg-white/10 backdrop-blur-md border border-white/15 flex flex-col justify-between">
                    <div>
                        <span class="text-xs text-white/75 font-medium uppercase tracking-wider block">1. Dana Diberikan Bappeda</span>
                        <div class="text-2xl lg:text-3xl font-extrabold text-white mt-1 tracking-tight">
                            Rp {{ number_format($danaBappeda, 0, ',', '.') }}
                        </div>
                    </div>
                    <span class="text-[11px] text-white/70 mt-2 block">Pagu hibah operasional &amp; bantuan</span>
                </div>

                <!-- 2. Penggunaan Dana -->
                <div class="p-space-md rounded-xl bg-white/10 backdrop-blur-md border border-white/15 flex flex-col justify-between">
                    <div>
                        <span class="text-xs text-amber-200 font-medium uppercase tracking-wider block flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">trending_down</span>
                            <span>2. Total Penggunaan Dana (-)</span>
                        </span>
                        <div class="text-2xl lg:text-3xl font-extrabold text-amber-300 mt-1 tracking-tight">
                            Rp {{ number_format($danaTerpakai, 0, ',', '.') }}
                        </div>
                    </div>
                    <span class="text-[11px] text-white/70 mt-2 block">Realisasi uang tunai + nilai bibit &amp; barang tersalur</span>
                </div>

                <!-- 3. Sisa Saldo Kas -->
                <div class="p-space-md rounded-xl bg-white/20 backdrop-blur-md border border-white/30 flex flex-col justify-between shadow-inner">
                    <div>
                        <span class="text-xs text-emerald-200 font-bold uppercase tracking-wider block flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">savings</span>
                            <span>3. Sisa Saldo Kas Kampus (=)</span>
                        </span>
                        <div class="text-2xl lg:text-3xl font-extrabold text-white mt-1 tracking-tight">
                            Rp {{ number_format($sisaDana, 0, ',', '.') }}
                        </div>
                    </div>
                    <span class="text-[11px] text-emerald-100 mt-2 font-medium block">Siap dialokasikan untuk penyaluran berikutnya</span>
                </div>
            </div>

            <!-- Progress Bar Serapan -->
            <div class="flex flex-col gap-1.5 pt-1">
                <div class="flex items-center justify-between text-xs text-white/90">
                    <span>Realisasi Penggunaan Anggaran:</span>
                    <span class="font-bold">Rp {{ number_format($danaTerpakai, 0, ',', '.') }} / Rp {{ number_format($danaBappeda, 0, ',', '.') }} ({{ $persenSerapan }}%)</span>
                </div>
                <div class="w-full bg-black/20 rounded-full h-2.5 overflow-hidden p-0.5">
                    <div class="bg-emerald-300 h-full rounded-full transition-all duration-700 shadow-sm" style="width: {{ $persenSerapan }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4 Key Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-lg">
        <!-- Card 1: Program Bantuan -->
        <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm border border-border-light flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-space-sm">
                    <span class="font-label-md text-label-md uppercase tracking-wider text-text-secondary">Program Bantuan</span>
                    <div class="w-10 h-10 rounded-lg bg-gov-green-surface flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined text-[22px]">inventory_2</span>
                    </div>
                </div>
                <div class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">
                    {{ $totalProgram ?? 0 }} Program
                </div>
            </div>
            <div class="mt-space-md pt-space-xs flex items-center justify-between text-text-secondary font-body-sm text-xs border-t border-border-light">
                <span>Total Item Subsidi:</span>
                <span class="font-bold text-primary">{{ $totalItem ?? 0 }} Item Terdaftar</span>
            </div>
        </div>

        <!-- Card 2: Bantuan Dana Usaha -->
        <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm border border-border-light flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-space-sm">
                    <span class="font-label-md text-label-md uppercase tracking-wider text-text-secondary">Dana Tersalurkan</span>
                    <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[22px]">account_balance_wallet</span>
                    </div>
                </div>
                <div class="font-headline-xl text-headline-xl text-emerald-700 tracking-tight font-bold">
                    Rp {{ number_format($totalUangDisalurkan ?? 0, 0, ',', '.') }}
                </div>
            </div>
            <div class="mt-space-md pt-space-xs flex items-center justify-between text-text-secondary font-body-sm text-xs border-t border-border-light">
                <span>Peruntukan:</span>
                <span class="font-semibold text-text-primary">Modal Usaha Tani Tunai</span>
            </div>
        </div>

        <!-- Card 3: Bantuan Fisik & Bibit -->
        <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm border border-border-light flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-space-sm">
                    <span class="font-label-md text-label-md uppercase tracking-wider text-text-secondary">Barang &amp; Bibit</span>
                    <div class="w-10 h-10 rounded-lg bg-status-verified-surface text-status-verified flex items-center justify-center">
                        <span class="material-symbols-outlined text-[22px]">psychiatry</span>
                    </div>
                </div>
                <div class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">
                    {{ number_format($totalBarangDisalurkan ?? 0) }} <span class="text-sm font-normal text-text-secondary">Alat</span> • {{ number_format($totalBibitDisalurkan ?? 0) }} <span class="text-sm font-normal text-text-secondary">Bibit</span>
                </div>
            </div>
            <div class="mt-space-md pt-space-xs flex items-center justify-between text-text-secondary font-body-sm text-xs border-t border-border-light">
                <span>Realisasi Penyaluran:</span>
                <span class="font-bold text-status-verified">{{ $totalPenyaluran ?? 0 }} Transaksi Lapangan</span>
            </div>
        </div>

        <!-- Card 4: Jangkauan Kader & Binaan -->
        <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm border border-border-light flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-space-sm">
                    <span class="font-label-md text-label-md uppercase tracking-wider text-text-secondary">Penerima Bantuan Aktif</span>
                    <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[22px]">groups</span>
                    </div>
                </div>
                <div class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">
                    {{ $totalPenerima ?? 0 }} KK <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">({{ $totalMandiri ?? 0 }} Mandiri)</span>
                </div>
            </div>
            <div class="mt-space-md pt-space-xs flex items-center justify-between text-text-secondary font-body-sm text-xs border-t border-border-light">
                <span>Tim Pendamping:</span>
                <a href="{{ route('kampus.pendamping.index') }}" class="font-bold text-primary hover:underline flex items-center gap-0.5">
                    <span>{{ $totalPendamping ?? 0 }} Kader Bertugas</span>
                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 2 Column Layout: Program Bantuan (Left) & Live Penyaluran (Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg">
        <!-- Left: Daftar Program Bantuan & Item Subsidi (7 Cols) -->
        <div class="lg:col-span-7 bg-surface-container-lowest rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-space-md border-b border-border-light mb-space-md">
                    <div class="flex items-center gap-space-sm">
                        <div class="w-8 h-8 rounded-lg bg-gov-green-surface flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-[20px]">folder_special</span>
                        </div>
                        <div>
                            <h2 class="font-headline-sm text-headline-sm text-text-primary font-bold">Program Bantuan Kampus</h2>
                            <p class="font-body-sm text-body-sm text-text-secondary">Program dan rincian item subsidi yang ditentukan oleh kampus</p>
                        </div>
                    </div>
                    <a href="{{ route('kampus.program-bantuan.index') }}" class="text-xs font-bold text-primary hover:underline flex items-center gap-1">
                        <span>Kelola Program</span>
                        <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                    </a>
                </div>

                <div class="flex flex-col gap-space-md">
                    @forelse($programs as $p)
                    <div class="p-space-md rounded-xl bg-surface-container-low border border-border-light flex flex-col gap-2">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                            <div>
                                <a href="{{ route('kampus.program-bantuan.show', $p->id) }}" class="font-semibold text-text-primary text-base hover:text-primary transition-colors">
                                    {{ $p->nama_program }}
                                </a>
                                <span class="text-xs text-text-tertiary block">
                                    Tahun: {{ $p->tahun_anggaran }} • Status: <span class="font-bold text-emerald-700 capitalize">{{ $p->status }}</span>
                                </span>
                            </div>
                            <span class="px-2.5 py-1 bg-surface-container-lowest text-text-primary font-bold text-xs rounded-lg border border-border-light w-fit">
                                {{ $p->itemBantuans->count() }} Item Subsidi
                            </span>
                        </div>

                        <!-- Sub-items list -->
                        @if($p->itemBantuans->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-1">
                            @foreach($p->itemBantuans->take(4) as $item)
                            <div class="p-2 rounded-lg bg-surface-container-lowest border border-border-light/70 flex items-center justify-between text-xs">
                                <div class="min-w-0 pr-2">
                                    <span class="font-medium text-text-primary truncate block">{{ $item->nama_item }}</span>
                                    <span class="text-[10px] uppercase font-bold {{ $item->jenis == 'uang' ? 'text-emerald-600' : ($item->jenis == 'barang' ? 'text-amber-700' : 'text-gov-green-dark') }}">
                                        {{ $item->jenis }}
                                    </span>
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="font-bold text-text-primary">{{ number_format($item->total_stok, 0) }} {{ $item->satuan }}</span>
                                    <span class="text-[10px] text-text-tertiary block">Stok</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if($p->itemBantuans->count() > 4)
                            <div class="text-right">
                                <a href="{{ route('kampus.program-bantuan.show', $p->id) }}" class="text-[11px] text-primary font-semibold hover:underline">
                                    + {{ $p->itemBantuans->count() - 4 }} item lainnya...
                                </a>
                            </div>
                        @endif
                        @else
                        <p class="text-xs text-text-tertiary italic">Belum ada item subsidi pada program ini. Silakan tambahkan item.</p>
                        @endif
                    </div>
                    @empty
                    <div class="text-center py-8 text-text-tertiary text-sm">
                        Belum ada program bantuan yang dibuat.
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-space-lg pt-space-md border-t border-border-light flex justify-between items-center text-xs text-text-secondary">
                <span>Penentuan jenis &amp; item bantuan sepenuhnya dikontrol oleh Kampus.</span>
                <a href="{{ route('kampus.program-bantuan.create') }}" class="font-bold text-primary hover:underline">
                    + Tambah Program Baru
                </a>
            </div>
        </div>

        <!-- Right: Penyaluran Terakhir oleh Pendamping (5 Cols) -->
        <div class="lg:col-span-5 bg-surface-container-lowest rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-space-md border-b border-border-light mb-space-md">
                    <div class="flex items-center gap-space-sm">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-700">
                            <span class="material-symbols-outlined text-[20px]">volunteer_activism</span>
                        </div>
                        <div>
                            <h2 class="font-headline-sm text-headline-sm text-text-primary font-bold">Penyaluran Bantuan Terkini</h2>
                            <p class="font-body-sm text-body-sm text-text-secondary">Distribusi real-time kader pendamping ke warga</p>
                        </div>
                    </div>
                    <a href="{{ route('kampus.penyaluran.index') }}" class="text-xs font-bold text-primary hover:underline flex items-center gap-1">
                        <span>Semua</span>
                        <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                    </a>
                </div>

                <div class="flex flex-col divide-y divide-border-light">
                    @forelse($penyaluranTerbaru as $pen)
                    <div class="py-3 flex items-start justify-between gap-3 first:pt-0 last:pb-0">
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-text-primary text-sm truncate">{{ $pen->keluargaPenerima->kepala_keluarga ?? $pen->keluargaPenerima->nama ?? 'Penerima' }}</span>
                                <span class="text-[10px] px-1.5 py-0.5 rounded font-bold uppercase {{ $pen->jenis == 'uang' ? 'bg-emerald-50 text-emerald-700' : ($pen->jenis == 'barang' ? 'bg-amber-50 text-amber-700' : 'bg-gov-green-surface text-primary') }}">
                                    {{ $pen->jenis }}
                                </span>
                            </div>
                            <span class="text-xs text-text-secondary block mt-0.5">
                                {{ $pen->itemBantuan->nama_item ?? '-' }}
                                @if($pen->jenis === 'uang')
                                    <strong class="text-emerald-700 font-bold block">Rp {{ number_format($pen->nominal_uang, 0, ',', '.') }}</strong>
                                @else
                                    <strong class="text-text-primary font-bold block">{{ number_format($pen->jumlah, 0) }} {{ $pen->satuan }}</strong>
                                @endif
                            </span>
                            <span class="text-[11px] text-text-tertiary block mt-0.5">
                                Pendamping: {{ $pen->pendamping->name ?? '-' }} • {{ \Carbon\Carbon::parse($pen->tgl_penyaluran)->format('d M Y') }}
                            </span>
                        </div>
                        <span class="px-2 py-0.5 bg-gov-green-surface text-primary font-bold text-[11px] rounded shrink-0">
                            Tersalur
                        </span>
                    </div>
                    @empty
                    <div class="text-center py-8 text-text-tertiary text-sm">
                        Belum ada data penyaluran bantuan.
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-space-lg pt-space-md border-t border-border-light flex justify-between items-center text-xs text-text-secondary">
                <span>Kader menyalurkan bantuan sesuai kuantitas yang diterima.</span>
                <a href="{{ route('kampus.penyaluran.index') }}" class="font-bold text-primary hover:underline">
                    Lihat Buku Penyaluran
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
