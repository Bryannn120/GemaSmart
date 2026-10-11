@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full">
<!-- Page Header & Operational Metadata -->
<div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-space-lg mb-space-2xl">
<div class="flex flex-col gap-space-xs">
<div class="flex flex-wrap items-center gap-space-sm mb-1">
<span class="inline-flex items-center gap-1.5 px-space-md py-0.5 rounded-full bg-gov-green-surface text-gov-green-dark font-label-sm text-label-sm font-semibold shadow-sm">
<span class="w-2 h-2 rounded-full bg-status-verified"></span>
          Universitas Teknologi Sumbawa (UTS) • No. MoU: 034/MoU/DISPERTAN/2025
        </span>
<span class="inline-flex items-center px-space-sm py-0.5 rounded-full bg-surface-container-high text-on-surface-variant font-code-dense text-code-dense font-medium">
          Cluster II: Utan - Alas - Rhee
        </span>
</div>
<h1 class="font-headline-xl text-headline-xl text-on-background tracking-tight">
        Dashboard Koordinator Kampus
      </h1>
<p class="font-body-md text-body-md text-text-secondary max-w-4xl">
        Monitoring real-time alokasi pagu dana, realisasi SPJ pengadaan bibit, dan progres pendamping lapangan Universitas Teknologi Sumbawa.
      </p>
</div>
<!-- Top Global Actions -->
<div class="flex items-center gap-space-sm self-start xl:self-auto shrink-0">
<a href="{{ route('kampus.laporan.pdf') }}" target="_blank" class="inline-flex items-center gap-space-xs px-space-lg py-space-sm rounded-lg bg-surface-container-lowest text-text-primary font-label-lg text-label-lg shadow-sm hover:bg-surface-container-low transition-all">
<span class="material-symbols-outlined text-[18px] text-text-secondary">file_download</span>
<span>Unduh Laporan Internal (PDF)</span>
</a>
<button class="inline-flex items-center gap-space-xs px-space-lg py-space-sm rounded-lg bg-primary-container text-on-primary font-label-lg text-label-lg shadow-md hover:bg-primary transition-all" type="button">
<span class="material-symbols-outlined text-[18px]">add_circle</span>
<span>+ Ajukan SPJ Baru</span>
</button>
</div>
</div>
<!-- Row 1: 4 Key Metric Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-lg mb-space-2xl">
<!-- Card 1: Alokasi Dana -->
<div class="p-space-xl rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between">
<div>
<div class="flex items-center justify-between mb-space-md">
<span class="font-label-md text-label-md uppercase tracking-wider text-text-secondary">Alokasi Dana</span>
<div class="w-10 h-10 rounded-lg bg-gov-green-surface flex items-center justify-center">
<span class="material-symbols-outlined text-primary-container text-[22px]">account_balance_wallet</span>
</div>
</div>
<div class="font-headline-xl text-headline-xl text-text-primary tracking-tight">
          Rp 500.000.000
        </div>
</div>
<div class="mt-space-lg pt-space-sm flex items-center gap-1.5 text-text-secondary font-body-sm text-body-sm">
<span class="material-symbols-outlined text-[16px] text-primary-container">verified</span>
<span>Pagu Kontrak Pemda TA 2026</span>
</div>
</div>
<!-- Card 2: Dana Terpakai -->
<div class="p-space-xl rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between">
<div>
<div class="flex items-center justify-between mb-space-md">
<span class="font-label-md text-label-md uppercase tracking-wider text-text-secondary">Dana Terpakai</span>
<div class="w-10 h-10 rounded-lg bg-status-info-surface flex items-center justify-center">
<span class="material-symbols-outlined text-status-info text-[22px]">trending_up</span>
</div>
</div>
<div class="flex items-baseline gap-space-xs">
<span class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Rp 435.000.000</span>
<span class="font-label-md text-label-md text-status-info font-bold">87%</span>
</div>
<!-- Progress Bar -->
<div class="w-full bg-surface-container-high rounded-full h-2 mt-space-md overflow-hidden">
<div class="bg-status-info h-2 rounded-full" style="width: 87%"></div>
</div>
</div>
<div class="mt-space-md flex items-center justify-between text-text-secondary font-body-sm text-body-sm">
<span>Sisa Pagu Kas:</span>
<span class="font-label-md text-label-md text-text-primary font-bold">Rp 65.000.000</span>
</div>
</div>
<!-- Card 3: Bibit Tersalurkan -->
<div class="p-space-xl rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between">
<div>
<div class="flex items-center justify-between mb-space-md">
<span class="font-label-md text-label-md uppercase tracking-wider text-text-secondary">Bibit Tersalurkan</span>
<div class="w-10 h-10 rounded-lg bg-gov-green-surface flex items-center justify-center">
<span class="material-symbols-outlined text-status-verified text-[22px]">psychiatry</span>
</div>
</div>
<div class="flex items-baseline gap-space-xs">
<span class="font-headline-xl text-headline-xl text-text-primary tracking-tight">4.200</span>
<span class="font-body-md text-body-md text-text-secondary">/ 5.500 unit</span>
<span class="ml-auto font-label-md text-label-md text-status-verified font-bold">76%</span>
</div>
<!-- Progress Bar -->
<div class="w-full bg-surface-container-high rounded-full h-2 mt-space-md overflow-hidden">
<div class="bg-status-verified h-2 rounded-full" style="width: 76%"></div>
</div>
</div>
<div class="mt-space-md flex items-center justify-between text-text-secondary font-body-sm text-body-sm">
<span>Target Sasaran:</span>
<span class="font-label-md text-label-md text-text-primary font-bold">2.800 KK Tani</span>
</div>
</div>
<!-- Card 4: Pendamping Aktif -->
<div class="p-space-xl rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between">
<div>
<div class="flex items-center justify-between mb-space-md">
<span class="font-label-md text-label-md uppercase tracking-wider text-text-secondary">Pendamping Aktif</span>
<div class="w-10 h-10 rounded-lg bg-secondary-fixed/50 flex items-center justify-center">
<span class="material-symbols-outlined text-secondary text-[22px]">how_to_reg</span>
</div>
</div>
<div class="flex items-baseline gap-space-xs">
<span class="font-headline-xl text-headline-xl text-text-primary tracking-tight">12</span>
<span class="font-body-lg text-body-lg text-text-secondary">Orang</span>
</div>
</div>
<div class="mt-space-lg pt-space-sm flex items-center gap-1.5 text-text-secondary font-body-sm text-body-sm">
<span class="w-2 h-2 rounded-full bg-status-verified"></span>
<span class="font-semibold text-text-primary">100% bertugas</span>
<span>di 3 kecamatan dampingan</span>
</div>
</div>
</div>
<!-- Row 2: 2 Column Visual Analytics Split -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg mb-space-2xl">
<!-- Left Column: Status Pengajuan SPJ Kampus (5 cols) -->
<div class="lg:col-span-5 p-space-xl rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between">
<div>
<div class="flex items-center justify-between mb-space-lg">
<div>
<h2 class="font-headline-md text-headline-md text-text-primary">Status Pengajuan SPJ Kampus</h2>
<p class="font-body-sm text-body-sm text-text-secondary">Realisasi berkas pertanggungjawaban dana</p>
</div>
<span class="px-space-sm py-0.5 rounded bg-surface-container-high text-text-secondary font-code-dense text-code-dense">5 Berkas</span>
</div>
<!-- Donut & Legend Horizontal Layout -->
<div class="flex flex-col sm:flex-row items-center gap-space-xl my-space-md">
<!-- Inline SVG Donut Chart -->
<div class="relative w-44 h-44 shrink-0 flex items-center justify-center">
<svg class="w-full h-full -rotate-90" viewbox="0 0 100 100">
<!-- Background Ring -->
<circle cx="50" cy="50" fill="transparent" r="38" stroke="#E5E7EB" stroke-width="12"></circle>
<!-- Approved: 320/475 = 67.4% -> stroke-dasharray="160.9 238.7" offset="0" -->
<circle class="transition-all duration-500 hover:opacity-90" cx="50" cy="50" fill="transparent" r="38" stroke="#2e7d32" stroke-dasharray="160.9 238.7" stroke-dashoffset="0" stroke-width="12"></circle>
<!-- Submitted: 115/475 = 24.2% -> stroke-dasharray="57.8 238.7" offset="-160.9" -->
<circle class="transition-all duration-500 hover:opacity-90" cx="50" cy="50" fill="transparent" r="38" stroke="#f59e0b" stroke-dasharray="57.8 238.7" stroke-dashoffset="-160.9" stroke-width="12"></circle>
<!-- Draft: 40/475 = 8.4% -> stroke-dasharray="20.0 238.7" offset="-218.7" -->
<circle class="transition-all duration-500 hover:opacity-90" cx="50" cy="50" fill="transparent" r="38" stroke="#9ca3af" stroke-dasharray="20.0 238.7" stroke-dashoffset="-218.7" stroke-width="12"></circle>
</svg>
<div class="absolute flex flex-col items-center justify-center text-center">
<span class="font-headline-sm text-headline-sm text-text-primary font-bold">Rp 475M</span>
<span class="font-label-sm text-label-sm text-text-secondary uppercase">Total Terproses</span>
</div>
</div>
<!-- Legend details -->
<div class="flex flex-col gap-space-sm flex-1 w-full">
<div class="p-space-sm rounded-lg bg-surface-container-low flex items-center justify-between">
<div class="flex items-center gap-space-sm">
<span class="w-3 h-3 rounded-full bg-[#2e7d32]"></span>
<div>
<div class="font-label-md text-label-md text-text-primary">Approved (Disetujui)</div>
<div class="font-body-sm text-body-sm text-text-secondary">3 Berkas</div>
</div>
</div>
<div class="text-right">
<div class="font-label-md text-label-md text-text-primary font-semibold">Rp 320.000.000</div>
<div class="font-label-sm text-label-sm text-status-verified font-bold">67.4%</div>
</div>
</div>
<div class="p-space-sm rounded-lg bg-surface-container-low flex items-center justify-between">
<div class="flex items-center gap-space-sm">
<span class="w-3 h-3 rounded-full bg-[#f59e0b]"></span>
<div>
<div class="font-label-md text-label-md text-text-primary">Submitted (Review)</div>
<div class="font-body-sm text-body-sm text-text-secondary">1 Berkas</div>
</div>
</div>
<div class="text-right">
<div class="font-label-md text-label-md text-text-primary font-semibold">Rp 115.000.000</div>
<div class="font-label-sm text-label-sm text-secondary font-bold">24.2%</div>
</div>
</div>
<div class="p-space-sm rounded-lg bg-surface-container-low flex items-center justify-between">
<div class="flex items-center gap-space-sm">
<span class="w-3 h-3 rounded-full bg-[#9ca3af]"></span>
<div>
<div class="font-label-md text-label-md text-text-primary">Draft (Penyusunan)</div>
<div class="font-body-sm text-body-sm text-text-secondary">1 Berkas</div>
</div>
</div>
<div class="text-right">
<div class="font-label-md text-label-md text-text-primary font-semibold">Rp 40.000.000</div>
<div class="font-label-sm text-label-sm text-text-secondary font-bold">8.4%</div>
</div>
</div>
<div class="p-space-sm rounded-lg bg-surface-container-low flex items-center justify-between opacity-50">
<div class="flex items-center gap-space-sm">
<span class="w-3 h-3 rounded-full bg-[#ef4444]"></span>
<div>
<div class="font-label-md text-label-md text-text-primary">Rejected (Ditolak)</div>
<div class="font-body-sm text-body-sm text-text-secondary">0 Berkas</div>
</div>
</div>
<div class="text-right">
<div class="font-label-md text-label-md text-text-primary font-semibold">Rp 0</div>
<div class="font-label-sm text-label-sm text-error font-bold">0%</div>
</div>
</div>
</div>
</div>
</div>
<!-- Regulatory Notification Footer -->
<div class="mt-space-lg pt-space-md p-space-sm rounded-lg bg-gold-surface flex items-start gap-space-sm text-text-primary">
<span class="material-symbols-outlined text-secondary text-[20px] shrink-0 mt-0.5">info</span>
<p class="font-body-sm text-body-sm leading-relaxed">
<span class="font-semibold text-secondary">Ketentuan SOP Pemda:</span> Batas maksimal verifikasi dan review berkas SPJ oleh Bappeda Kabupaten Sumbawa adalah <strong>7 hari kerja</strong> (PRD FR-03).
        </p>
</div>
</div>
<!-- Right Column: Distribusi Bibit per Desa (Top 5) (7 cols) -->
<div class="lg:col-span-7 p-space-xl rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between">
<div>
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm mb-space-lg">
<div>
<h2 class="font-headline-md text-headline-md text-text-primary">Distribusi Bibit per Desa</h2>
<p class="font-body-sm text-body-sm text-text-secondary">Top 5 desa dampingan UTS (Kecamatan Utan, Alas, &amp; Rhee)</p>
</div>
<div class="text-right">
<span class="font-label-lg text-label-lg font-bold text-primary-container">4.200 / 5.500 Unit</span>
<div class="font-label-sm text-label-sm text-text-secondary">Tercapai 76.4% dari total alokasi</div>
</div>
</div>
<!-- Horizontal Bar Charts -->
<div class="flex flex-col gap-space-lg my-space-md">
<!-- Desa 1: Motong -->
<div class="flex flex-col gap-1">
<div class="flex items-center justify-between font-label-md text-label-md">
<div class="flex items-center gap-space-xs">
<span class="font-bold text-text-primary">1. Desa Motong</span>
<span class="text-text-secondary font-body-sm text-body-sm">(Kec. Utan)</span>
</div>
<div class="flex items-center gap-space-md">
<span class="font-code-dense text-code-dense text-text-secondary">1.150 / 1.300 unit</span>
<span class="font-bold text-status-verified w-12 text-right">88.5%</span>
</div>
</div>
<div class="w-full bg-surface-container-high rounded-full h-3 overflow-hidden">
<div class="bg-gov-green-dark h-3 rounded-full transition-all duration-500" style="width: 88.5%"></div>
</div>
</div>
<!-- Desa 2: Labuhan Burung -->
<div class="flex flex-col gap-1">
<div class="flex items-center justify-between font-label-md text-label-md">
<div class="flex items-center gap-space-xs">
<span class="font-bold text-text-primary">2. Desa Labuhan Burung</span>
<span class="text-text-secondary font-body-sm text-body-sm">(Kec. Utan)</span>
</div>
<div class="flex items-center gap-space-md">
<span class="font-code-dense text-code-dense text-text-secondary">980 / 1.200 unit</span>
<span class="font-bold text-status-verified w-12 text-right">81.7%</span>
</div>
</div>
<div class="w-full bg-surface-container-high rounded-full h-3 overflow-hidden">
<div class="bg-primary-container h-3 rounded-full transition-all duration-500" style="width: 81.7%"></div>
</div>
</div>
<!-- Desa 3: Kalimango -->
<div class="flex flex-col gap-1">
<div class="flex items-center justify-between font-label-md text-label-md">
<div class="flex items-center gap-space-xs">
<span class="font-bold text-text-primary">3. Desa Kalimango</span>
<span class="text-text-secondary font-body-sm text-body-sm">(Kec. Alas)</span>
</div>
<div class="flex items-center gap-space-md">
<span class="font-code-dense text-code-dense text-text-secondary">850 / 1.100 unit</span>
<span class="font-bold text-status-verified w-12 text-right">77.3%</span>
</div>
</div>
<div class="w-full bg-surface-container-high rounded-full h-3 overflow-hidden">
<div class="bg-primary-container h-3 rounded-full transition-all duration-500" style="width: 77.3%"></div>
</div>
</div>
<!-- Desa 4: Marente -->
<div class="flex flex-col gap-1">
<div class="flex items-center justify-between font-label-md text-label-md">
<div class="flex items-center gap-space-xs">
<span class="font-bold text-text-primary">4. Desa Marente</span>
<span class="text-text-secondary font-body-sm text-body-sm">(Kec. Alas)</span>
</div>
<div class="flex items-center gap-space-md">
<span class="font-code-dense text-code-dense text-text-secondary">720 / 1.000 unit</span>
<span class="font-bold text-primary-container w-12 text-right">72.0%</span>
</div>
</div>
<div class="w-full bg-surface-container-high rounded-full h-3 overflow-hidden">
<div class="bg-primary-container/80 h-3 rounded-full transition-all duration-500" style="width: 72.0%"></div>
</div>
</div>
<!-- Desa 5: Sampe -->
<div class="flex flex-col gap-1">
<div class="flex items-center justify-between font-label-md text-label-md">
<div class="flex items-center gap-space-xs">
<span class="font-bold text-text-primary">5. Desa Sampe</span>
<span class="text-text-secondary font-body-sm text-body-sm">(Kec. Rhee)</span>
</div>
<div class="flex items-center gap-space-md">
<span class="font-code-dense text-code-dense text-text-secondary">500 / 900 unit</span>
<span class="font-bold text-secondary w-12 text-right">55.6%</span>
</div>
</div>
<div class="w-full bg-surface-container-high rounded-full h-3 overflow-hidden">
<div class="bg-secondary-container h-3 rounded-full transition-all duration-500" style="width: 55.6%"></div>
</div>
</div>
</div>
</div>
<!-- Quick summary badge & link -->
<div class="mt-space-lg pt-space-md flex items-center justify-between">
<span class="font-body-sm text-body-sm text-text-secondary">
          Komoditas Dominan: <strong>Bibit Jagung Hibrida JH-37</strong> • Hortikultura Cabai Rawit
        </span>
<button class="inline-flex items-center gap-1 text-primary-container font-label-md text-label-md hover:underline font-semibold" type="button">
<span>Lihat Semua 18 Desa</span>
<span class="material-symbols-outlined text-[16px]">arrow_forward</span>
</button>
</div>
</div>
</div>
<!-- Row 3: Comprehensive Table - Pendamping & Progres Lapangan -->
<div class="rounded-xl bg-surface-container-lowest shadow-sm flex flex-col mb-space-2xl overflow-hidden">
<!-- Table Toolbar Header -->
<div class="p-space-xl flex flex-col md:flex-row md:items-center md:justify-between gap-space-md bg-surface-container-lowest">
<div class="flex items-center gap-space-md">
<div>
<div class="flex items-center gap-space-sm">
<h2 class="font-headline-md text-headline-md text-text-primary">Pendamping &amp; Progres Lapangan</h2>
<span class="px-space-sm py-0.5 rounded-full bg-gov-green-surface text-gov-green-dark font-label-sm text-label-sm font-semibold">
              12 Pendamping Terdaftar
            </span>
</div>
<p class="font-body-sm text-body-sm text-text-secondary">Kader agronom UTS penanggung jawab verifikasi fisik lapangan</p>
</div>
</div>
<!-- Search & Filters -->
<div class="flex items-center gap-space-sm">
<div class="relative w-72">
<span class="material-symbols-outlined absolute left-3 top-2.5 text-[20px] text-text-secondary">search</span>
<input class="w-full pl-10 pr-4 py-2 text-text-primary placeholder:text-text-secondary text-body-sm font-body-md rounded-lg bg-surface-container-low focus:outline-none focus:bg-surface-container-lowest" placeholder="Cari pendamping, desa, NIK..." type="text"/>
</div>
<button class="p-2 rounded-lg bg-surface-container-low text-text-secondary hover:bg-surface-container-high transition-colors" title="Filter Kecamatan" type="button">
<span class="material-symbols-outlined text-[20px]">filter_list</span>
</button>
</div>
</div>
<!-- Data Table Container -->
<div class="w-full overflow-x-auto">
<table class="w-full text-left">
<thead>
<tr class="bg-surface-container-low text-text-secondary font-label-md text-label-md uppercase tracking-wider">
<th class="py-space-md px-space-xl" scope="col">Nama Pendamping</th>
<th class="py-space-md px-space-md" scope="col">Wilayah Tugas</th>
<th class="py-space-md px-space-md" scope="col">KK Terdaftar</th>
<th class="py-space-md px-space-md" scope="col">Bibit Disalurkan</th>
<th class="py-space-md px-space-md" scope="col">Monitoring Terakhir</th>
<th class="py-space-md px-space-xl text-right" scope="col">Aksi</th>
</tr>
</thead>
<tbody class="font-body-md text-body-md divide-y-0">
<!-- Row 1: Fajar Maulana -->
<tr class="hover:bg-surface-container-low/60 transition-colors">
<td class="py-space-md px-space-xl">
<div class="flex items-center gap-space-sm">
<div class="w-9 h-9 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold text-label-md">
                  FM
                </div>
<div>
<div class="font-label-lg text-label-lg text-text-primary font-semibold">Fajar Maulana, S.P.</div>
<div class="font-code-dense text-code-dense text-text-secondary">NIP-UTS: 2024.08.109</div>
</div>
</div>
</td>
<td class="py-space-md px-space-md">
<div class="text-text-primary font-medium">Desa Kalimango &amp; Marente</div>
<div class="font-body-sm text-body-sm text-text-secondary">Kec. Alas</div>
</td>
<td class="py-space-md px-space-md text-text-primary font-semibold">
              260 KK
            </td>
<td class="py-space-md px-space-md">
<div class="font-label-md text-label-md text-text-primary">580 / 700 Unit</div>
<div class="w-24 bg-surface-container-high rounded-full h-1.5 mt-1 overflow-hidden">
<div class="bg-status-verified h-1.5 rounded-full" style="width: 82%"></div>
</div>
</td>
<td class="py-space-md px-space-md">
<div class="flex items-center gap-1.5 text-text-primary font-medium">
<span class="material-symbols-outlined text-[16px] text-status-verified">check_circle</span>
<span>26 Feb 2026</span>
</div>
<span class="inline-block mt-0.5 px-space-xs py-0.5 rounded-full bg-status-verified-surface text-gov-green-dark font-label-sm text-label-sm">
                2 hari lalu (Aman)
              </span>
</td>
<td class="py-space-md px-space-xl text-right">
<button class="px-space-md py-1.5 rounded-md bg-surface-container-high text-text-primary hover:bg-surface-container-highest font-label-md text-label-md font-semibold transition-colors" type="button">
                Lihat Rincian
              </button>
</td>
</tr>
<!-- Row 2: Rian Nurdin -->
<tr class="hover:bg-surface-container-low/60 transition-colors">
<td class="py-space-md px-space-xl">
<div class="flex items-center gap-space-sm">
<div class="w-9 h-9 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold text-label-md">
                  RN
                </div>
<div>
<div class="font-label-lg text-label-lg text-text-primary font-semibold">Rian Nurdin, S.Tr.P.</div>
<div class="font-code-dense text-code-dense text-text-secondary">NIP-UTS: 2023.04.054</div>
</div>
</div>
</td>
<td class="py-space-md px-space-md">
<div class="text-text-primary font-medium">Desa Motong</div>
<div class="font-body-sm text-body-sm text-text-secondary">Kec. Utan</div>
</td>
<td class="py-space-md px-space-md text-text-primary font-semibold">
              310 KK
            </td>
<td class="py-space-md px-space-md">
<div class="font-label-md text-label-md text-text-primary">720 / 800 Unit</div>
<div class="w-24 bg-surface-container-high rounded-full h-1.5 mt-1 overflow-hidden">
<div class="bg-status-verified h-1.5 rounded-full" style="width: 90%"></div>
</div>
</td>
<td class="py-space-md px-space-md">
<div class="flex items-center gap-1.5 text-text-primary font-medium">
<span class="material-symbols-outlined text-[16px] text-status-verified">check_circle</span>
<span>24 Feb 2026</span>
</div>
<span class="inline-block mt-0.5 px-space-xs py-0.5 rounded-full bg-status-verified-surface text-gov-green-dark font-label-sm text-label-sm">
                4 hari lalu (Aman)
              </span>
</td>
<td class="py-space-md px-space-xl text-right">
<button class="px-space-md py-1.5 rounded-md bg-surface-container-high text-text-primary hover:bg-surface-container-highest font-label-md text-label-md font-semibold transition-colors" type="button">
                Lihat Rincian
              </button>
</td>
</tr>
<!-- Row 3: Siti Rahmawati -->
<tr class="hover:bg-surface-container-low/60 transition-colors">
<td class="py-space-md px-space-xl">
<div class="flex items-center gap-space-sm">
<div class="w-9 h-9 rounded-full bg-secondary text-on-secondary flex items-center justify-center font-bold text-label-md">
                  SR
                </div>
<div>
<div class="font-label-lg text-label-lg text-text-primary font-semibold">Siti Rahmawati, M.Si</div>
<div class="font-code-dense text-code-dense text-text-secondary">NIP-UTS: 2022.11.021</div>
</div>
</div>
</td>
<td class="py-space-md px-space-md">
<div class="text-text-primary font-medium">Desa Sampe</div>
<div class="font-body-sm text-body-sm text-text-secondary">Kec. Rhee</div>
</td>
<td class="py-space-md px-space-md text-text-primary font-semibold">
              190 KK
            </td>
<td class="py-space-md px-space-md">
<div class="font-label-md text-label-md text-text-primary">380 / 600 Unit</div>
<div class="w-24 bg-surface-container-high rounded-full h-1.5 mt-1 overflow-hidden">
<div class="bg-secondary-container h-1.5 rounded-full" style="width: 63%"></div>
</div>
</td>
<td class="py-space-md px-space-md">
<div class="flex items-center gap-1.5 text-text-primary font-medium">
<span class="material-symbols-outlined text-[16px] text-status-warning">schedule</span>
<span>18 Feb 2026</span>
</div>
<span class="inline-block mt-0.5 px-space-xs py-0.5 rounded-full bg-status-warning-surface text-secondary font-label-sm text-label-sm font-semibold">
                10 hari lalu (Perhatian)
              </span>
</td>
<td class="py-space-md px-space-xl text-right">
<button class="px-space-md py-1.5 rounded-md bg-surface-container-high text-text-primary hover:bg-surface-container-highest font-label-md text-label-md font-semibold transition-colors" type="button">
                Lihat Rincian
              </button>
</td>
</tr>
<!-- Row 4: Hendra Saputra (CRITICAL OVERDUE) -->
<tr class="bg-status-fraud-surface/40 hover:bg-status-fraud-surface/70 transition-colors">
<td class="py-space-md px-space-xl">
<div class="flex items-center gap-space-sm">
<div class="w-9 h-9 rounded-full bg-status-fraud text-on-error flex items-center justify-center font-bold text-label-md">
                  HS
                </div>
<div>
<div class="font-label-lg text-label-lg text-status-fraud font-semibold">Hendra Saputra, S.P.</div>
<div class="font-code-dense text-code-dense text-text-secondary">NIP-UTS: 2024.01.077</div>
</div>
</div>
</td>
<td class="py-space-md px-space-md">
<div class="text-text-primary font-medium">Desa Labuhan Burung</div>
<div class="font-body-sm text-body-sm text-text-secondary">Kec. Utan</div>
</td>
<td class="py-space-md px-space-md text-text-primary font-semibold">
              240 KK
            </td>
<td class="py-space-md px-space-md">
<div class="font-label-md text-label-md text-text-primary">450 / 600 Unit</div>
<div class="w-24 bg-surface-container-high rounded-full h-1.5 mt-1 overflow-hidden">
<div class="bg-status-verified h-1.5 rounded-full" style="width: 75%"></div>
</div>
</td>
<td class="py-space-md px-space-md">
<div class="flex items-center gap-1.5 text-status-fraud font-semibold">
<span class="material-symbols-outlined text-[16px] text-status-fraud">error</span>
<span>08 Feb 2026</span>
</div>
<span class="inline-block mt-0.5 px-space-xs py-0.5 rounded-full bg-status-fraud-surface text-status-fraud font-label-sm text-label-sm font-bold">
                20 hari lalu (&gt; 14 Hari)
              </span>
</td>
<td class="py-space-md px-space-xl text-right">
<button class="px-space-md py-1.5 rounded-md bg-status-fraud text-on-error hover:bg-on-error-container font-label-md text-label-md font-semibold transition-colors shadow-sm" type="button">
                Kirim Peringatan
              </button>
</td>
</tr>
<!-- Row 5: Dian Anggraini (CRITICAL OVERDUE) -->
<tr class="bg-status-fraud-surface/40 hover:bg-status-fraud-surface/70 transition-colors">
<td class="py-space-md px-space-xl">
<div class="flex items-center gap-space-sm">
<div class="w-9 h-9 rounded-full bg-status-fraud text-on-error flex items-center justify-center font-bold text-label-md">
                  DA
                </div>
<div>
<div class="font-label-lg text-label-lg text-status-fraud font-semibold">Dian Anggraini, S.P.</div>
<div class="font-code-dense text-code-dense text-text-secondary">NIP-UTS: 2023.09.088</div>
</div>
</div>
</td>
<td class="py-space-md px-space-md">
<div class="text-text-primary font-medium">Desa Luk</div>
<div class="font-body-sm text-body-sm text-text-secondary">Kec. Rhee</div>
</td>
<td class="py-space-md px-space-md text-text-primary font-semibold">
              180 KK
            </td>
<td class="py-space-md px-space-md">
<div class="font-label-md text-label-md text-text-primary">320 / 530 Unit</div>
<div class="w-24 bg-surface-container-high rounded-full h-1.5 mt-1 overflow-hidden">
<div class="bg-secondary-container h-1.5 rounded-full" style="width: 60%"></div>
</div>
</td>
<td class="py-space-md px-space-md">
<div class="flex items-center gap-1.5 text-status-fraud font-semibold">
<span class="material-symbols-outlined text-[16px] text-status-fraud">error</span>
<span>05 Feb 2026</span>
</div>
<span class="inline-block mt-0.5 px-space-xs py-0.5 rounded-full bg-status-fraud-surface text-status-fraud font-label-sm text-label-sm font-bold">
                23 hari lalu (&gt; 14 Hari)
              </span>
</td>
<td class="py-space-md px-space-xl text-right">
<button class="px-space-md py-1.5 rounded-md bg-status-fraud text-on-error hover:bg-on-error-container font-label-md text-label-md font-semibold transition-colors shadow-sm" type="button">
                Kirim Peringatan
              </button>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Table Footer & System Reminder Notice -->
<div class="p-space-lg bg-surface-container-low flex flex-col md:flex-row md:items-center md:justify-between gap-space-md">
<div class="flex items-center gap-space-sm text-text-secondary font-body-sm text-body-sm">
<span class="material-symbols-outlined text-[18px] text-secondary">warning</span>
<span>
<strong>SOP Pendampingan:</strong> Pendamping wajib melakukan pembaruan monitoring kondisi tanaman minimal setiap <strong>14 hari sekali</strong>. Notifikasi otomatis dikirimkan via SMS/WhatsApp Gateway.
        </span>
</div>
<!-- Pagination controls -->
<div class="flex items-center gap-space-md self-end md:self-auto shrink-0">
<span class="font-body-sm text-body-sm text-text-secondary">
          Menampilkan <strong>1-5</strong> dari <strong>12</strong> Pendamping
        </span>
<div class="inline-flex items-center gap-1">
<button class="p-1 rounded bg-surface-container-high text-text-tertiary cursor-not-allowed" disabled="" type="button">
<span class="material-symbols-outlined text-[18px]">chevron_left</span>
</button>
<button class="px-space-sm py-1 rounded bg-primary-container text-on-primary font-label-sm text-label-sm font-bold" type="button">
            1
          </button>
<button class="px-space-sm py-1 rounded bg-surface-container-lowest text-text-primary hover:bg-surface-container-high font-label-sm text-label-sm transition-colors" type="button">
            2
          </button>
<button class="px-space-sm py-1 rounded bg-surface-container-lowest text-text-primary hover:bg-surface-container-high font-label-sm text-label-sm transition-colors" type="button">
            3
          </button>
<button class="p-1 rounded bg-surface-container-lowest text-text-primary hover:bg-surface-container-high transition-colors" type="button">
<span class="material-symbols-outlined text-[18px]">chevron_right</span>
</button>
</div>
</div>
</div>
</div>
</div>
<script>
  // Simple toast feedback for Send Warning buttons
  document.querySelectorAll('button').forEach(button => {
    if (button.textContent.includes('Kirim Peringatan')) {
      button.addEventListener('click', function() {
        const row = this.closest('tr');
        const name = row ? row.querySelector('.font-semibold').innerText : 'Pendamping';
        this.innerHTML = '<span class="material-symbols-outlined text-[16px] animate-spin">refresh</span> Mengirim...';
        this.disabled = true;
        setTimeout(() => {
          this.innerHTML = '<span class="material-symbols-outlined text-[16px]">done</span> Terkirim';
          this.className = 'px-space-md py-1.5 rounded-md bg-status-verified text-on-primary font-label-md text-label-md font-semibold';
        }, 800);
      });
    }
  });
</script>
@endsection
