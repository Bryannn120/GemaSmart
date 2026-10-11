"use client";

export default function PenyaluranBibit() {
  return (
    <>
      <aside className="fixed left-0 top-0 h-screen w-72 bg-gov-green-dark text-on-primary z-50 flex flex-col justify-between overflow-y-auto shadow-[0_1px_8px_rgba(0,0,0,0.04)]"><div className="flex flex-col"><div className="h-16 flex items-center gap-3 px-space-xl bg-primary-container"><span className="material-symbols-outlined text-primary-fixed text-[28px]">eco</span><div className="flex flex-col"><span className="font-headline-sm text-headline-sm font-bold text-on-primary tracking-tight leading-none">Gema Smart Sumbawa</span><span className="font-label-sm text-label-sm text-primary-fixed-dim uppercase tracking-wider mt-1">Dinas Pertanian Kab. Sumbawa</span></div></div><div className="px-space-md py-space-sm"><div className="px-space-md py-space-xs"><span className="font-label-sm text-label-sm uppercase tracking-wider text-primary-fixed-dim opacity-75">Menu Utama</span></div></div><nav className="flex flex-col gap-1 px-space-md" data-active-classes="bg-primary-container text-on-primary font-bold shadow-sm"><a className="flex items-center gap-3 px-space-md py-space-sm rounded text-white/80 hover:bg-primary hover:text-on-primary transition-colors" data-path="dashboard" href="/dashboard"><span className="material-symbols-outlined text-[20px]">grid_view</span><span className="font-label-lg text-label-lg">Dashboard</span></a><a className="flex items-center gap-3 px-space-md py-space-sm rounded text-white/80 hover:bg-primary hover:text-on-primary transition-colors" data-path="program-bantuan" href="/program-bantuan"><span className="material-symbols-outlined text-[20px]">assignment</span><span className="font-label-lg text-label-lg">Program Bantuan</span></a><a className="flex items-center gap-3 px-space-md py-space-sm rounded text-white/80 hover:bg-primary hover:text-on-primary transition-colors" data-path="kampus-mitra" href="/kampus-mitra"><span className="material-symbols-outlined text-[20px]">school</span><span className="font-label-lg text-label-lg">Kampus Mitra</span></a><a className="flex items-center gap-3 px-space-md py-space-sm rounded text-white/80 hover:bg-primary hover:text-on-primary transition-colors" data-path="data-penerima" href="/data-penerima"><span className="material-symbols-outlined text-[20px]">groups</span><span className="font-label-lg text-label-lg">Data Penerima</span></a><a aria-current="page" className="flex items-center gap-3 px-space-md py-space-sm rounded transition-colors bg-primary-container text-on-primary font-bold shadow-sm" data-path="penyaluran-bibit" href="/penyaluran-bibit"><span className="material-symbols-outlined text-[20px]">local_shipping</span><span className="font-label-lg text-label-lg">Penyaluran Bibit</span></a><a className="flex items-center gap-3 px-space-md py-space-sm rounded text-white/80 hover:bg-primary hover:text-on-primary transition-colors" data-path="monitoring" href="/monitoring"><span className="material-symbols-outlined text-[20px]">insights</span><span className="font-label-lg text-label-lg">Monitoring</span></a><a className="flex items-center gap-3 px-space-md py-space-sm rounded text-white/80 hover:bg-primary hover:text-on-primary transition-colors" data-path="validasi-lapangan" href="/validasi-lapangan"><span className="material-symbols-outlined text-[20px]">fact_check</span><span className="font-label-lg text-label-lg">Validasi Lapangan</span></a><a className="flex items-center gap-3 px-space-md py-space-sm rounded text-white/80 hover:bg-primary hover:text-on-primary transition-colors" data-path="laporan" href="/laporan"><span className="material-symbols-outlined text-[20px]">description</span><span className="font-label-lg text-label-lg">Laporan</span></a><details className="group"><summary className="flex items-center justify-between px-space-md py-space-sm rounded text-white/80 hover:bg-primary hover:text-on-primary cursor-pointer transition-colors list-none"><div className="flex items-center gap-3"><span className="material-symbols-outlined text-[20px]">database</span><span className="font-label-lg text-label-lg">Master Data</span></div><span className="material-symbols-outlined text-[18px] transition-transform group-open:rotate-180">expand_more</span></summary><div className="flex flex-col pl-9 pr-space-xs pt-1 pb-1 gap-1"><a className="flex items-center px-space-md py-space-xs rounded text-white/70 hover:bg-primary hover:text-on-primary font-label-md text-label-md transition-colors" data-path="master-data-wilayah" href="/master-data-wilayah">Wilayah</a><a className="flex items-center px-space-md py-space-xs rounded text-white/70 hover:bg-primary hover:text-on-primary font-label-md text-label-md transition-colors" data-path="master-data-jenis-bibit" href="/master-data-jenis-bibit">Jenis Bibit</a></div></details><div className="px-space-md py-space-xs mt-2"><span className="font-label-sm text-label-sm uppercase tracking-wider text-primary-fixed-dim opacity-75">Sistem</span></div><a className="flex items-center gap-3 px-space-md py-space-sm rounded text-white/80 hover:bg-primary hover:text-on-primary transition-colors" data-path="audit-log" href="/audit-log"><span className="material-symbols-outlined text-[20px]">history</span><span className="font-label-lg text-label-lg">Audit Log</span></a><a className="flex items-center gap-3 px-space-md py-space-sm rounded text-white/80 hover:bg-primary hover:text-on-primary transition-colors" data-path="pengaturan" href="/pengaturan"><span className="material-symbols-outlined text-[20px]">settings</span><span className="font-label-lg text-label-lg">Pengaturan</span></a></nav></div><div className="p-space-md bg-black/20"><div className="flex items-center gap-2 px-space-sm py-1 bg-primary/40 rounded"><span className="h-2 w-2 rounded-full bg-status-verified animate-pulse"></span><span className="font-code-dense text-code-dense text-primary-fixed">Server Aktif: Sumbawa-Node-01</span></div></div></aside><div className="pl-72 flex flex-col min-h-screen"><header className="fixed top-0 left-72 right-0 h-16 bg-surface-container-lowest/90 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-40 flex items-center justify-between px-gutter-lg"><div className="flex items-center gap-space-md"><nav className="flex items-center gap-2 text-text-secondary font-label-md text-label-md"><span className="flex items-center gap-1 hover:text-primary transition-colors cursor-pointer"><span className="material-symbols-outlined text-[16px]">home</span>Beranda</span><span className="material-symbols-outlined text-[14px] text-outline-variant">chevron_right</span><span className="text-on-surface font-semibold">Penyaluran Bibit</span></nav><div className="h-4 w-[1px] bg-border-light mx-space-xs"></div><div className="inline-flex items-center gap-1.5 px-space-sm py-0.5 bg-gov-green-surface rounded"><span className="material-symbols-outlined text-primary-container text-[14px]">calendar_today</span><span className="font-label-sm text-label-sm text-primary-container font-semibold tracking-wide">TA 2026</span></div></div><div className="flex items-center gap-space-lg"><div className="hidden md:flex items-center gap-2 px-space-md py-1 bg-surface-container-low rounded font-code-dense text-code-dense text-text-secondary"><span className="w-2 h-2 rounded-full bg-status-verified"></span><span>Sumbawa-Node-01 (Online)</span></div><div className="relative"><button className="relative p-space-xs text-on-surface-variant hover:text-primary transition-colors rounded-full focus:outline-none" type="button"><span className="material-symbols-outlined text-[24px]">notifications</span><span className="absolute top-0.5 right-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-status-fraud text-on-primary font-label-sm text-[10px] leading-none font-bold ring-2 ring-surface-container-lowest">3</span></button></div><div className="h-8 w-[1px] bg-border-light"></div><div className="flex items-center gap-3 pl-space-xs"><div className="flex flex-col text-right"><span className="font-label-lg text-label-lg text-text-primary leading-tight">Ir. H. Syamsuddin, M.Si</span><span className="font-label-sm text-label-sm text-gold-accent font-bold tracking-wider leading-none mt-0.5">SUPER ADMIN</span></div><div className="w-8 h-8 rounded-full bg-primary flex items-center justify-center ring-2 ring-primary-fixed"><span className="material-symbols-outlined text-on-primary text-[18px]">person</span></div></div></div></header><main className="w-full pt-16 bg-surface-subtle min-h-screen px-gutter-lg py-space-xl"><div className="flex flex-col w-full gap-space-xl">
{/* Page Header & Action Bar */}
<div className="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-md">
<div className="flex flex-col gap-1">
<div className="flex items-center gap-2">
<h1 className="font-headline-lg text-headline-lg text-text-primary tracking-tight">Penyaluran Bibit</h1>
<span className="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-status-info-surface text-status-info font-label-sm text-label-sm border border-status-info/20">
<span className="material-symbols-outlined text-[14px]">terminal</span>
          PRD v2.0 FR-12 â€¢ distributions
        </span>
</div>
<p className="font-body-md text-body-md text-text-secondary">
        Rekapitulasi pencatatan distribusi bibit fisik, verifikasi BAST digital, dan status audit lapangan di Kabupaten Sumbawa.
      </p>
</div>
{/* Action Buttons */}
<div className="flex items-center gap-space-sm self-start lg:self-center">
<button className="inline-flex items-center gap-2 px-space-md py-2 bg-surface-container-lowest text-text-primary hover:bg-surface-muted rounded-lg font-label-lg text-label-lg shadow-sm transition-colors cursor-pointer" type="button">
<span className="material-symbols-outlined text-primary-container text-[18px]">table_view</span>
<span>Export Excel</span>
</button>
<button className="inline-flex items-center gap-2 px-space-md py-2 bg-primary-container hover:bg-primary text-on-primary rounded-lg font-label-lg text-label-lg shadow-sm transition-colors cursor-pointer" type="button">
<span className="material-symbols-outlined text-on-primary text-[18px]">picture_as_pdf</span>
<span>Export PDF</span>
</button>
</div>
</div>
{/* Statistical KPI Cards Grid */}
<div className="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-space-lg">
{/* Card 1: Total Distribusi */}
<div className="flex flex-col justify-between p-space-xl bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
<div className="absolute top-0 left-0 right-0 h-1 bg-primary-container"></div>
<div className="flex items-start justify-between">
<div className="flex flex-col">
<span className="font-label-md text-label-md text-text-secondary uppercase tracking-wider">Total Distribusi</span>
<span className="font-headline-xl text-headline-xl text-text-primary mt-1 font-bold">1.245</span>
</div>
<div className="p-2.5 rounded-lg bg-gov-green-surface text-primary-container">
<span className="material-symbols-outlined text-[26px]">potted_plant</span>
</div>
</div>
<div className="flex items-center gap-1.5 mt-space-md pt-space-sm border-t border-border-light text-text-secondary font-body-sm text-body-sm">
<span className="material-symbols-outlined text-primary-container text-[16px]">inventory_2</span>
<span>156.400 unit bibit terdata fisik</span>
</div>
</div>
{/* Card 2: Verified */}
<div className="flex flex-col justify-between p-space-xl bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
<div className="absolute top-0 left-0 right-0 h-1 bg-status-verified"></div>
<div className="flex items-start justify-between">
<div className="flex flex-col">
<div className="flex items-center gap-2">
<span className="font-label-md text-label-md text-text-secondary uppercase tracking-wider">Verified</span>
<span className="px-2 py-0.5 rounded-full bg-status-verified-surface text-status-verified font-label-sm text-label-sm font-bold">72%</span>
</div>
<span className="font-headline-xl text-headline-xl text-text-primary mt-1 font-bold">892</span>
</div>
<div className="p-2.5 rounded-lg bg-status-verified-surface text-status-verified">
<span className="material-symbols-outlined text-[26px]">verified</span>
</div>
</div>
<div className="flex items-center gap-1.5 mt-space-md pt-space-sm border-t border-border-light text-text-secondary font-body-sm text-body-sm">
<span className="material-symbols-outlined text-status-verified text-[16px]">task_alt</span>
<span>Lolos uji petik &amp; BAST sah</span>
</div>
</div>
{/* Card 3: Menunggu Validasi */}
<div className="flex flex-col justify-between p-space-xl bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
<div className="absolute top-0 left-0 right-0 h-1 bg-status-warning"></div>
<div className="flex items-start justify-between">
<div className="flex flex-col">
<div className="flex items-center gap-2">
<span className="font-label-md text-label-md text-text-secondary uppercase tracking-wider">Menunggu Validasi</span>
<span className="px-2 py-0.5 rounded-full bg-status-warning-surface text-status-warning font-label-sm text-label-sm font-bold">24%</span>
</div>
<span className="font-headline-xl text-headline-xl text-text-primary mt-1 font-bold">298</span>
</div>
<div className="p-2.5 rounded-lg bg-status-warning-surface text-status-warning">
<span className="material-symbols-outlined text-[26px]">pending_actions</span>
</div>
</div>
<div className="flex items-center gap-1.5 mt-space-md pt-space-sm border-t border-border-light text-text-secondary font-body-sm text-body-sm">
<span className="material-symbols-outlined text-status-warning text-[16px]">schedule</span>
<span>Dalam antrean sampling auditor</span>
</div>
</div>
{/* Card 4: Flagged / Fraud */}
<div className="flex flex-col justify-between p-space-xl bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
<div className="absolute top-0 left-0 right-0 h-1 bg-status-fraud"></div>
<div className="flex items-start justify-between">
<div className="flex flex-col">
<div className="flex items-center gap-2">
<span className="font-label-md text-label-md text-text-secondary uppercase tracking-wider">Flagged / Fraud</span>
<span className="px-2 py-0.5 rounded-full bg-status-fraud-surface text-status-fraud font-label-sm text-label-sm font-bold">0.4%</span>
</div>
<span className="font-headline-xl text-headline-xl text-text-primary mt-1 font-bold">5</span>
</div>
<div className="p-2.5 rounded-lg bg-status-fraud-surface text-status-fraud">
<span className="material-symbols-outlined text-[26px]">gavel</span>
</div>
</div>
<div className="flex items-center gap-1.5 mt-space-md pt-space-sm border-t border-border-light text-text-secondary font-body-sm text-body-sm">
<span className="material-symbols-outlined text-status-fraud text-[16px]">warning</span>
<span>Perlu investigasi khusus Pemda</span>
</div>
</div>
</div>
{/* Filter Console Module */}
<div className="flex flex-col bg-surface-container-lowest rounded-xl p-space-xl shadow-sm gap-space-lg">
{/* Search Bar */}
<div className="relative w-full">
<span className="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-tertiary text-[20px]">search</span>
<input className="w-full pl-10 pr-4 py-2.5 bg-surface-subtle focus:bg-surface-container-lowest rounded-lg font-body-md text-body-md text-text-primary placeholder:text-text-tertiary focus:outline-none focus:ring-2 focus:ring-primary-container/30 transition-all" placeholder="Cari nama penerima, nomor distribusi (#DIST), atau NIK (16 digit)..." type="text"/>
</div>
{/* Dropdown Filters Multi-Row Grid */}
<div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-space-md">
{/* Filter Program */}
<div className="flex flex-col gap-1">
<label className="font-label-sm text-label-sm text-text-secondary uppercase">Program</label>
<div className="relative">
<select className="w-full appearance-none pl-3 pr-8 py-2 bg-surface-subtle hover:bg-surface-muted rounded-lg font-body-md text-body-md text-text-primary focus:outline-none focus:ring-2 focus:ring-primary-container/30 cursor-pointer">
<option selected>Semua Program</option>
<option>Bantuan Jagung Hibrida 2026</option>
<option>Hortikultura Cabai Rawit 2026</option>
<option>Kopi Robusta Tambora 2025</option>
</select>
<span className="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-text-tertiary pointer-events-none text-[18px]">expand_more</span>
</div>
</div>
{/* Filter Kampus Mitra */}
<div className="flex flex-col gap-1">
<label className="font-label-sm text-label-sm text-text-secondary uppercase">Kampus Mitra</label>
<div className="relative">
<select className="w-full appearance-none pl-3 pr-8 py-2 bg-surface-subtle hover:bg-surface-muted rounded-lg font-body-md text-body-md text-text-primary focus:outline-none focus:ring-2 focus:ring-primary-container/30 cursor-pointer">
<option selected>Semua Kampus</option>
<option>Univ. Teknologi Sumbawa (UTS)</option>
<option>Univ. Samawa (UNSA)</option>
<option>IISBUD Samawa Rea</option>
<option>Politani Mataram</option>
</select>
<span className="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-text-tertiary pointer-events-none text-[18px]">expand_more</span>
</div>
</div>
{/* Filter Kecamatan */}
<div className="flex flex-col gap-1">
<label className="font-label-sm text-label-sm text-text-secondary uppercase">Kecamatan</label>
<div className="relative">
<select className="w-full appearance-none pl-3 pr-8 py-2 bg-surface-subtle hover:bg-surface-muted rounded-lg font-body-md text-body-md text-text-primary focus:outline-none focus:ring-2 focus:ring-primary-container/30 cursor-pointer">
<option selected>Semua Kecamatan</option>
<option>Labuhan Badas</option>
<option>Alas</option>
<option>Moyo Hulu</option>
<option>Utan</option>
<option>Buer</option>
</select>
<span className="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-text-tertiary pointer-events-none text-[18px]">expand_more</span>
</div>
</div>
{/* Filter Desa */}
<div className="flex flex-col gap-1">
<label className="font-label-sm text-label-sm text-text-secondary uppercase">Desa</label>
<div className="relative">
<select className="w-full appearance-none pl-3 pr-8 py-2 bg-surface-subtle hover:bg-surface-muted rounded-lg font-body-md text-body-md text-text-primary focus:outline-none focus:ring-2 focus:ring-primary-container/30 cursor-pointer">
<option selected>Semua Desa</option>
<option>Karang Dima</option>
<option>Labuhan Badas</option>
<option>Desa Baru</option>
<option>Desa Marente</option>
<option>Desa Jurata</option>
</select>
<span className="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-text-tertiary pointer-events-none text-[18px]">expand_more</span>
</div>
</div>
{/* Filter Status */}
<div className="flex flex-col gap-1">
<label className="font-label-sm text-label-sm text-text-secondary uppercase">Status Distribusi</label>
<div className="relative">
<select className="w-full appearance-none pl-3 pr-8 py-2 bg-surface-subtle hover:bg-surface-muted rounded-lg font-body-md text-body-md text-text-primary focus:outline-none focus:ring-2 focus:ring-primary-container/30 cursor-pointer">
<option selected>Semua Status</option>
<option>DRAFT</option>
<option>SUBMITTED</option>
<option>VERIFIED</option>
<option>REVISION_REQUIRED</option>
<option>FLAGGED</option>
<option>CONFIRMED_FRAUD</option>
<option>CLEARED</option>
</select>
<span className="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-text-tertiary pointer-events-none text-[18px]">expand_more</span>
</div>
</div>
{/* Date Range Picker */}
<div className="flex flex-col gap-1">
<label className="font-label-sm text-label-sm text-text-secondary uppercase">Rentang Tanggal</label>
<div className="relative">
<input className="w-full pl-3 pr-8 py-2 bg-surface-subtle rounded-lg font-body-md text-body-md text-text-primary focus:outline-none focus:ring-2 focus:ring-primary-container/30 cursor-pointer" type="text" value="01 Mar 2026 - 20 Sep 2026"/>
<span className="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-text-tertiary pointer-events-none text-[18px]">date_range</span>
</div>
</div>
</div>
{/* Filter Bottom Action Bar */}
<div className="flex items-center justify-between pt-space-sm border-t border-border-light">
<div className="flex items-center gap-2 text-text-secondary font-body-sm text-body-sm">
<span className="material-symbols-outlined text-[16px] text-text-tertiary">tune</span>
<span>Filter aktif: <strong>Kabupaten Sumbawa â€¢ TA 2026</strong></span>
</div>
<div className="flex items-center gap-space-sm">
<button className="inline-flex items-center gap-1.5 px-space-md py-1.5 bg-surface-muted hover:bg-surface-container text-text-secondary rounded-lg font-label-md text-label-md transition-colors cursor-pointer" type="button">
<span className="material-symbols-outlined text-[16px]">restart_alt</span>
<span>Reset Filter</span>
</button>
<button className="inline-flex items-center gap-1.5 px-space-lg py-1.5 bg-primary-container hover:bg-primary text-on-primary rounded-lg font-label-md text-label-md shadow-sm transition-colors cursor-pointer" type="button">
<span className="material-symbols-outlined text-on-primary text-[16px]">filter_alt</span>
<span>Terapkan Filter</span>
</button>
</div>
</div>
</div>
{/* Data Table Section */}
<div className="flex flex-col bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
{/* Header Controls in Table Card */}
<div className="flex flex-col sm:flex-row sm:items-center justify-between p-space-xl border-b border-border-light gap-space-sm">
<div className="flex items-center gap-3">
<h2 className="font-headline-sm text-headline-sm text-text-primary font-bold">Daftar Transaksi Distribusi Bibit</h2>
<span className="px-2.5 py-0.5 rounded-full bg-gov-green-surface text-primary-container font-label-sm text-label-sm font-bold">
          Batch 04 â€¢ 1.245 Transaksi
        </span>
</div>
<div className="flex items-center gap-space-sm">
<button className="inline-flex items-center gap-1.5 p-2 bg-surface-muted hover:bg-surface-container text-text-secondary rounded-lg text-body-sm transition-colors cursor-pointer" title="Muat Ulang Data" type="button">
<span className="material-symbols-outlined text-[18px]">refresh</span>
<span className="font-label-md text-label-md hidden sm:inline">Refresh Data</span>
</button>
</div>
</div>
{/* Table Container */}
<div className="w-full overflow-x-auto">
<table className="w-full text-left border-collapse min-w-[1100px]">
<thead>
<tr className="bg-surface-subtle border-b border-border-light text-text-secondary font-label-md text-label-md uppercase">
<th className="py-3 px-4 font-semibold text-center w-12">No</th>
<th className="py-3 px-4 font-semibold">Tanggal &amp; ID</th>
<th className="py-3 px-4 font-semibold">Penerima &amp; Poktan</th>
<th className="py-3 px-4 font-semibold">Lokasi (Desa/Kec)</th>
<th className="py-3 px-4 font-semibold">Jenis Bibit</th>
<th className="py-3 px-4 font-semibold">Volume</th>
<th className="py-3 px-4 font-semibold">Pendamping Lapangan</th>
<th className="py-3 px-4 font-semibold text-center">Mitra</th>
<th className="py-3 px-4 font-semibold text-center">Status</th>
<th className="py-3 px-4 font-semibold text-right">Aksi</th>
</tr>
</thead>
<tbody className="divide-y divide-border-light font-body-md text-body-md text-text-primary">
{/* Row 1: VERIFIED */}
<tr className="hover:bg-surface-subtle transition-colors">
<td className="py-3.5 px-4 text-center text-text-secondary font-code-dense text-code-dense">1</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">15 Mar 2026</span>
<span className="font-code-dense text-code-dense text-text-secondary">#DIST-2026-089</span>
<span className="font-label-sm text-label-sm text-text-tertiary">09:15 WITA</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Ahmad Sudirman</span>
<span className="font-code-dense text-code-dense text-text-secondary">520410â€¢â€¢â€¢â€¢â€¢â€¢1234</span>
<span className="font-body-sm text-body-sm text-primary-container font-medium">Poktan Samawa Berdaya</span>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Labuhan Badas</span>
<span className="font-body-sm text-body-sm text-text-secondary">Kec. Labuhan Badas</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-2">
<span className="material-symbols-outlined text-primary-container text-[18px]">grain</span>
<div className="flex flex-col">
<span className="font-medium">Jagung Hibrida BISI-18</span>
<span className="font-body-sm text-body-sm text-text-secondary">Sertifikasi BPSB-TPH</span>
</div>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<span className="font-semibold text-text-primary">50 Sak</span>
<span className="block font-body-sm text-body-sm text-text-secondary">125 Kg</span>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Fajar Maulana, S.P.</span>
<span className="font-body-sm text-body-sm text-text-secondary">Pendamping Teknis</span>
</div>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-block px-2.5 py-1 rounded bg-surface-muted font-label-sm text-label-sm font-bold text-text-secondary">
                UTS
              </span>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-status-verified-surface text-status-verified font-label-sm text-label-sm font-bold">
<span className="material-symbols-outlined text-[14px]">check_circle</span>
                VERIFIED
              </span>
</td>
<td className="py-3.5 px-4 text-right whitespace-nowrap">
<div className="inline-flex items-center gap-1">
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Lihat Detail BAST" type="button">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Geotagging Peta" type="button">
<span className="material-symbols-outlined text-[18px]">pin_drop</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Menu Lainnya" type="button">
<span className="material-symbols-outlined text-[18px]">more_vert</span>
</button>
</div>
</td>
</tr>
{/* Row 2: REVISION_REQUIRED */}
<tr className="hover:bg-surface-subtle transition-colors">
<td className="py-3.5 px-4 text-center text-text-secondary font-code-dense text-code-dense">2</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">16 Mar 2026</span>
<span className="font-code-dense text-code-dense text-text-secondary">#DIST-2026-090</span>
<span className="font-label-sm text-label-sm text-text-tertiary">11:00 WITA</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Siti Aminah</span>
<span className="font-code-dense text-code-dense text-text-secondary">520410â€¢â€¢â€¢â€¢â€¢â€¢5678</span>
<span className="font-body-sm text-body-sm text-primary-container font-medium">Poktan Tunas Makmur</span>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Karang Dima</span>
<span className="font-body-sm text-body-sm text-text-secondary">Kec. Labuhan Badas</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-2">
<span className="material-symbols-outlined text-primary-container text-[18px]">grain</span>
<div className="flex flex-col">
<span className="font-medium">Jagung Hibrida BISI-18</span>
<span className="font-body-sm text-body-sm text-text-secondary">Sertifikasi BPSB-TPH</span>
</div>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<span className="font-semibold text-text-primary">50 Sak</span>
<span className="block font-body-sm text-body-sm text-text-secondary">125 Kg</span>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Dr. Budi Santoso</span>
<span className="font-body-sm text-body-sm text-text-secondary">Dosen Pembimbing</span>
</div>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-block px-2.5 py-1 rounded bg-surface-muted font-label-sm text-label-sm font-bold text-text-secondary">
                UTS
              </span>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-status-warning-surface text-secondary font-label-sm text-label-sm font-bold">
<span className="material-symbols-outlined text-[14px]">report_problem</span>
                REVISION
              </span>
</td>
<td className="py-3.5 px-4 text-right whitespace-nowrap">
<div className="inline-flex items-center gap-1">
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Lihat Detail BAST" type="button">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Geotagging Peta" type="button">
<span className="material-symbols-outlined text-[18px]">pin_drop</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Menu Lainnya" type="button">
<span className="material-symbols-outlined text-[18px]">more_vert</span>
</button>
</div>
</td>
</tr>
{/* Row 3: FLAGGED */}
<tr className="hover:bg-surface-subtle transition-colors">
<td className="py-3.5 px-4 text-center text-text-secondary font-code-dense text-code-dense">3</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">18 Mar 2026</span>
<span className="font-code-dense text-code-dense text-text-secondary">#DIST-2026-091</span>
<span className="font-label-sm text-label-sm text-text-tertiary">14:20 WITA</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Burhanuddin</span>
<span className="font-code-dense text-code-dense text-text-secondary">520412â€¢â€¢â€¢â€¢â€¢â€¢9012</span>
<span className="font-body-sm text-body-sm text-primary-container font-medium">Poktan Sejahtera Buer</span>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Desa Buin Baru</span>
<span className="font-body-sm text-body-sm text-text-secondary">Kec. Buer</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-2">
<span className="material-symbols-outlined text-secondary text-[18px]">coffee</span>
<div className="flex flex-col">
<span className="font-medium">Kopi Robusta Tambora</span>
<span className="font-body-sm text-body-sm text-text-secondary">Klon Batang Stek Unggul</span>
</div>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<span className="font-semibold text-text-primary">100 Batang</span>
<span className="block font-body-sm text-body-sm text-text-secondary">Siap Tanam</span>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Hendra Saputra, M.Si</span>
<span className="font-body-sm text-body-sm text-text-secondary">Fasilitator Lapangan</span>
</div>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-block px-2.5 py-1 rounded bg-surface-muted font-label-sm text-label-sm font-bold text-text-secondary">
                UTS
              </span>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-status-fraud-surface text-status-fraud font-label-sm text-label-sm font-bold">
<span className="material-symbols-outlined text-[14px]">flag</span>
                FLAGGED
              </span>
</td>
<td className="py-3.5 px-4 text-right whitespace-nowrap">
<div className="inline-flex items-center gap-1">
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Lihat Detail BAST" type="button">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Geotagging Peta" type="button">
<span className="material-symbols-outlined text-[18px]">pin_drop</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Menu Lainnya" type="button">
<span className="material-symbols-outlined text-[18px]">more_vert</span>
</button>
</div>
</td>
</tr>
{/* Row 4: CONFIRMED_FRAUD */}
<tr className="hover:bg-surface-subtle transition-colors bg-status-fraud-surface/20">
<td className="py-3.5 px-4 text-center text-text-secondary font-code-dense text-code-dense">4</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">19 Mar 2026</span>
<span className="font-code-dense text-code-dense text-text-secondary">#DIST-2026-092</span>
<span className="font-label-sm text-label-sm text-text-tertiary">08:45 WITA</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-status-fraud">Mahsun Mansyur</span>
<span className="font-code-dense text-code-dense text-text-secondary">520408â€¢â€¢â€¢â€¢â€¢â€¢3456</span>
<span className="font-body-sm text-body-sm text-text-secondary font-medium">Poktan Subur Abadi</span>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Desa Marente</span>
<span className="font-body-sm text-body-sm text-text-secondary">Kec. Alas</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-2">
<span className="material-symbols-outlined text-status-fraud text-[18px]">spa</span>
<div className="flex flex-col">
<span className="font-medium">Bibit Cabai Rawit Hiyung</span>
<span className="font-body-sm text-body-sm text-text-secondary">Persemaian Polybag</span>
</div>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<span className="font-semibold text-text-primary">30 Tray</span>
<span className="block font-body-sm text-body-sm text-text-secondary">2.100 Bibit</span>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Ir. Sri Wahyuni, M.P.</span>
<span className="font-body-sm text-body-sm text-text-secondary">Supervisor Lapangan</span>
</div>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-block px-2.5 py-1 rounded bg-surface-muted font-label-sm text-label-sm font-bold text-text-secondary">
                UNSA
              </span>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-status-fraud text-on-primary font-label-sm text-label-sm font-bold shadow-sm">
<span className="material-symbols-outlined text-[14px]">gavel</span>
                FRAUD
              </span>
</td>
<td className="py-3.5 px-4 text-right whitespace-nowrap">
<div className="inline-flex items-center gap-1">
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Lihat Detail BAST" type="button">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Geotagging Peta" type="button">
<span className="material-symbols-outlined text-[18px]">pin_drop</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Menu Lainnya" type="button">
<span className="material-symbols-outlined text-[18px]">more_vert</span>
</button>
</div>
</td>
</tr>
{/* Row 5: VERIFIED */}
<tr className="hover:bg-surface-subtle transition-colors">
<td className="py-3.5 px-4 text-center text-text-secondary font-code-dense text-code-dense">5</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">20 Mar 2026</span>
<span className="font-code-dense text-code-dense text-text-secondary">#DIST-2026-093</span>
<span className="font-label-sm text-label-sm text-text-tertiary">08:00 WITA</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Ruslan Effendi</span>
<span className="font-code-dense text-code-dense text-text-secondary">520409â€¢â€¢â€¢â€¢â€¢â€¢7890</span>
<span className="font-body-sm text-body-sm text-primary-container font-medium">Poktan Tani Jaya</span>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Desa Motong</span>
<span className="font-body-sm text-body-sm text-text-secondary">Kec. Utan</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-2">
<span className="material-symbols-outlined text-primary-container text-[18px]">grain</span>
<div className="flex flex-col">
<span className="font-medium">Jagung Hibrida BISI-18</span>
<span className="font-body-sm text-body-sm text-text-secondary">Sertifikasi BPSB-TPH</span>
</div>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<span className="font-semibold text-text-primary">50 Sak</span>
<span className="block font-body-sm text-body-sm text-text-secondary">125 Kg</span>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Dr. Hendra Gunawan</span>
<span className="font-body-sm text-body-sm text-text-secondary">Koordinator Riset</span>
</div>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-block px-2.5 py-1 rounded bg-surface-muted font-label-sm text-label-sm font-bold text-text-secondary">
                POLITANI
              </span>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-status-verified-surface text-status-verified font-label-sm text-label-sm font-bold">
<span className="material-symbols-outlined text-[14px]">check_circle</span>
                VERIFIED
              </span>
</td>
<td className="py-3.5 px-4 text-right whitespace-nowrap">
<div className="inline-flex items-center gap-1">
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Lihat Detail BAST" type="button">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Geotagging Peta" type="button">
<span className="material-symbols-outlined text-[18px]">pin_drop</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Menu Lainnya" type="button">
<span className="material-symbols-outlined text-[18px]">more_vert</span>
</button>
</div>
</td>
</tr>
{/* Row 6: SUBMITTED */}
<tr className="hover:bg-surface-subtle transition-colors">
<td className="py-3.5 px-4 text-center text-text-secondary font-code-dense text-code-dense">6</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">20 Mar 2026</span>
<span className="font-code-dense text-code-dense text-text-secondary">#DIST-2026-094</span>
<span className="font-label-sm text-label-sm text-text-tertiary">09:30 WITA</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Nurul Hidayati</span>
<span className="font-code-dense text-code-dense text-text-secondary">520407â€¢â€¢â€¢â€¢â€¢â€¢2345</span>
<span className="font-body-sm text-body-sm text-primary-container font-medium">Poktan Harapan Baru</span>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Desa Berora</span>
<span className="font-body-sm text-body-sm text-text-secondary">Kec. Lopok</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-2">
<span className="material-symbols-outlined text-primary-fixed-dim text-[18px]">park</span>
<div className="flex flex-col">
<span className="font-medium">Bibit Alpukat Mentega</span>
<span className="font-body-sm text-body-sm text-text-secondary">Okulasi Siap Salur</span>
</div>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<span className="font-semibold text-text-primary">25 Batang</span>
<span className="block font-body-sm text-body-sm text-text-secondary">Polybag Besar</span>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">H. M. Ilham Akbar, S.Sos</span>
<span className="font-body-sm text-body-sm text-text-secondary">Penyuluh Ahli</span>
</div>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-block px-2.5 py-1 rounded bg-surface-muted font-label-sm text-label-sm font-bold text-text-secondary">
                IISBUD
              </span>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-status-info-surface text-status-info font-label-sm text-label-sm font-bold">
<span className="material-symbols-outlined text-[14px]">send</span>
                SUBMITTED
              </span>
</td>
<td className="py-3.5 px-4 text-right whitespace-nowrap">
<div className="inline-flex items-center gap-1">
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Lihat Detail BAST" type="button">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Geotagging Peta" type="button">
<span className="material-symbols-outlined text-[18px]">pin_drop</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Menu Lainnya" type="button">
<span className="material-symbols-outlined text-[18px]">more_vert</span>
</button>
</div>
</td>
</tr>
{/* Row 7: DRAFT */}
<tr className="hover:bg-surface-subtle transition-colors">
<td className="py-3.5 px-4 text-center text-text-secondary font-code-dense text-code-dense">7</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">20 Mar 2026</span>
<span className="font-code-dense text-code-dense text-text-secondary">#DIST-2026-095</span>
<span className="font-label-sm text-label-sm text-text-tertiary">10:15 WITA</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Lalu Abdul Kadir</span>
<span className="font-code-dense text-code-dense text-text-secondary">520402â€¢â€¢â€¢â€¢â€¢â€¢6789</span>
<span className="font-body-sm text-body-sm text-primary-container font-medium">Poktan Samapuin Indah</span>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Desa Samapuin</span>
<span className="font-body-sm text-body-sm text-text-secondary">Kec. Sumbawa</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-2">
<span className="material-symbols-outlined text-primary-container text-[18px]">grain</span>
<div className="flex flex-col">
<span className="font-medium">Jagung Hibrida BISI-18</span>
<span className="font-body-sm text-body-sm text-text-secondary">Sertifikasi BPSB-TPH</span>
</div>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<span className="font-semibold text-text-primary">50 Sak</span>
<span className="block font-body-sm text-body-sm text-text-secondary">125 Kg</span>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Fajar Maulana, S.P.</span>
<span className="font-body-sm text-body-sm text-text-secondary">Pendamping Teknis</span>
</div>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-block px-2.5 py-1 rounded bg-surface-muted font-label-sm text-label-sm font-bold text-text-secondary">
                UTS
              </span>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-surface-muted text-text-secondary font-label-sm text-label-sm font-bold">
<span className="material-symbols-outlined text-[14px]">edit_note</span>
                DRAFT
              </span>
</td>
<td className="py-3.5 px-4 text-right whitespace-nowrap">
<div className="inline-flex items-center gap-1">
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Lihat Detail BAST" type="button">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Geotagging Peta" type="button">
<span className="material-symbols-outlined text-[18px]">pin_drop</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Menu Lainnya" type="button">
<span className="material-symbols-outlined text-[18px]">more_vert</span>
</button>
</div>
</td>
</tr>
{/* Row 8: CLEARED */}
<tr className="hover:bg-surface-subtle transition-colors">
<td className="py-3.5 px-4 text-center text-text-secondary font-code-dense text-code-dense">8</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">19 Mar 2026</span>
<span className="font-code-dense text-code-dense text-text-secondary">#DIST-2026-096</span>
<span className="font-label-sm text-label-sm text-text-tertiary">13:40 WITA</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Zulkifli Haris</span>
<span className="font-code-dense text-code-dense text-text-secondary">520411â€¢â€¢â€¢â€¢â€¢â€¢4321</span>
<span className="font-body-sm text-body-sm text-primary-container font-medium">Poktan Bina Tani</span>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Desa Batu Tering</span>
<span className="font-body-sm text-body-sm text-text-secondary">Kec. Moyo Hulu</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-2">
<span className="material-symbols-outlined text-secondary text-[18px]">coffee</span>
<div className="flex flex-col">
<span className="font-medium">Kopi Robusta Tambora</span>
<span className="font-body-sm text-body-sm text-text-secondary">Klon Batang Stek Unggul</span>
</div>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<span className="font-semibold text-text-primary">80 Batang</span>
<span className="block font-body-sm text-body-sm text-text-secondary">Siap Tanam</span>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Siti Rahmawati, S.Pt.</span>
<span className="font-body-sm text-body-sm text-text-secondary">Auditor Lapangan</span>
</div>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-block px-2.5 py-1 rounded bg-surface-muted font-label-sm text-label-sm font-bold text-text-secondary">
                UTS
              </span>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-status-verified-surface text-primary-container font-label-sm text-label-sm font-bold">
<span className="material-symbols-outlined text-[14px]">shield</span>
                CLEARED
              </span>
</td>
<td className="py-3.5 px-4 text-right whitespace-nowrap">
<div className="inline-flex items-center gap-1">
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Lihat Detail BAST" type="button">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Geotagging Peta" type="button">
<span className="material-symbols-outlined text-[18px]">pin_drop</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Menu Lainnya" type="button">
<span className="material-symbols-outlined text-[18px]">more_vert</span>
</button>
</div>
</td>
</tr>
{/* Row 9: VERIFIED */}
<tr className="hover:bg-surface-subtle transition-colors">
<td className="py-3.5 px-4 text-center text-text-secondary font-code-dense text-code-dense">9</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">18 Mar 2026</span>
<span className="font-code-dense text-code-dense text-text-secondary">#DIST-2026-097</span>
<span className="font-label-sm text-label-sm text-text-tertiary">15:10 WITA</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Ismail Marzuki</span>
<span className="font-code-dense text-code-dense text-text-secondary">520405â€¢â€¢â€¢â€¢â€¢â€¢8765</span>
<span className="font-body-sm text-body-sm text-primary-container font-medium">Poktan Pangan Mandiri</span>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Desa Uma Sima</span>
<span className="font-body-sm text-body-sm text-text-secondary">Kec. Sumbawa</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-2">
<span className="material-symbols-outlined text-status-fraud text-[18px]">spa</span>
<div className="flex flex-col">
<span className="font-medium">Bibit Cabai Rawit Hiyung</span>
<span className="font-body-sm text-body-sm text-text-secondary">Persemaian Polybag</span>
</div>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<span className="font-semibold text-text-primary">20 Tray</span>
<span className="block font-body-sm text-body-sm text-text-secondary">1.400 Bibit</span>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Ir. Dwi Kurniawan</span>
<span className="font-body-sm text-body-sm text-text-secondary">Koordinator Wilayah</span>
</div>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-block px-2.5 py-1 rounded bg-surface-muted font-label-sm text-label-sm font-bold text-text-secondary">
                UTS
              </span>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-status-verified-surface text-status-verified font-label-sm text-label-sm font-bold">
<span className="material-symbols-outlined text-[14px]">check_circle</span>
                VERIFIED
              </span>
</td>
<td className="py-3.5 px-4 text-right whitespace-nowrap">
<div className="inline-flex items-center gap-1">
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Lihat Detail BAST" type="button">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Geotagging Peta" type="button">
<span className="material-symbols-outlined text-[18px]">pin_drop</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Menu Lainnya" type="button">
<span className="material-symbols-outlined text-[18px]">more_vert</span>
</button>
</div>
</td>
</tr>
{/* Row 10: SUBMITTED */}
<tr className="hover:bg-surface-subtle transition-colors">
<td className="py-3.5 px-4 text-center text-text-secondary font-code-dense text-code-dense">10</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">17 Mar 2026</span>
<span className="font-code-dense text-code-dense text-text-secondary">#DIST-2026-098</span>
<span className="font-label-sm text-label-sm text-text-tertiary">16:05 WITA</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Dewi Sartika</span>
<span className="font-code-dense text-code-dense text-text-secondary">520414â€¢â€¢â€¢â€¢â€¢â€¢1122</span>
<span className="font-body-sm text-body-sm text-primary-container font-medium">Poktan Wanita Tani</span>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Desa Kerato</span>
<span className="font-body-sm text-body-sm text-text-secondary">Kec. Unter Iwes</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-2">
<span className="material-symbols-outlined text-primary-container text-[18px]">grain</span>
<div className="flex flex-col">
<span className="font-medium">Jagung Hibrida BISI-18</span>
<span className="font-body-sm text-body-sm text-text-secondary">Sertifikasi BPSB-TPH</span>
</div>
</div>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<span className="font-semibold text-text-primary">40 Sak</span>
<span className="block font-body-sm text-body-sm text-text-secondary">100 Kg</span>
</td>
<td className="py-3.5 px-4 whitespace-nowrap">
<div className="flex flex-col">
<span className="font-medium text-text-primary">Ir. Sri Wahyuni, M.P.</span>
<span className="font-body-sm text-body-sm text-text-secondary">Supervisor Lapangan</span>
</div>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-block px-2.5 py-1 rounded bg-surface-muted font-label-sm text-label-sm font-bold text-text-secondary">
                UNSA
              </span>
</td>
<td className="py-3.5 px-4 text-center whitespace-nowrap">
<span className="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-status-info-surface text-status-info font-label-sm text-label-sm font-bold">
<span className="material-symbols-outlined text-[14px]">send</span>
                SUBMITTED
              </span>
</td>
<td className="py-3.5 px-4 text-right whitespace-nowrap">
<div className="inline-flex items-center gap-1">
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Lihat Detail BAST" type="button">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Geotagging Peta" type="button">
<span className="material-symbols-outlined text-[18px]">pin_drop</span>
</button>
<button className="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-muted rounded-lg transition-colors cursor-pointer" title="Menu Lainnya" type="button">
<span className="material-symbols-outlined text-[18px]">more_vert</span>
</button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
{/* Pagination & Entries Module */}
<div className="flex flex-col md:flex-row md:items-center md:justify-between p-space-md border-t border-border-light gap-space-md bg-surface-subtle/50">
<div className="flex items-center gap-3 text-text-secondary font-body-sm text-body-sm">
<span>Menampilkan <strong>1 - 10</strong> dari <strong>1.245</strong> transaksi distribusi</span>
<span className="text-text-tertiary">â€¢</span>
<div className="flex items-center gap-1">
<span>Per halaman:</span>
<select className="px-2 py-1 bg-surface-container-lowest border border-border-light rounded text-text-primary text-body-sm focus:outline-none">
<option selected>10</option>
<option>25</option>
<option>50</option>
<option>100</option>
</select>
</div>
</div>
{/* Pagination Buttons */}
<div className="flex items-center gap-1">
<button className="px-2.5 py-1.5 rounded text-text-tertiary bg-surface-container-lowest border border-border-light cursor-not-allowed font-label-md text-label-md" disabled type="button">
          Sebelumnya
        </button>
<button className="px-3 py-1.5 rounded bg-primary-container text-on-primary font-bold font-label-md text-label-md" type="button">
          1
        </button>
<button className="px-3 py-1.5 rounded bg-surface-container-lowest hover:bg-surface-muted text-text-primary border border-border-light font-label-md text-label-md" type="button">
          2
        </button>
<button className="px-3 py-1.5 rounded bg-surface-container-lowest hover:bg-surface-muted text-text-primary border border-border-light font-label-md text-label-md" type="button">
          3
        </button>
<span className="px-2 text-text-tertiary">...</span>
<button className="px-3 py-1.5 rounded bg-surface-container-lowest hover:bg-surface-muted text-text-primary border border-border-light font-label-md text-label-md" type="button">
          125
        </button>
<button className="px-2.5 py-1.5 rounded text-text-primary hover:bg-surface-muted bg-surface-container-lowest border border-border-light font-label-md text-label-md cursor-pointer" type="button">
          Selanjutnya
        </button>
</div>
</div>
</div>
{/* Security, Geotagging & Compliance Signoff Box */}
<div className="flex flex-col sm:flex-row sm:items-center justify-between p-space-md bg-surface-container-lowest rounded-xl shadow-sm gap-space-sm">
<div className="flex items-center gap-3">
<div className="p-2 rounded-lg bg-gov-green-surface text-primary-container">
<span className="material-symbols-outlined text-[20px]">verified_user</span>
</div>
<p className="font-body-sm text-body-sm text-text-secondary leading-relaxed">
        Seluruh rekaman penyaluran terhubung otomatis dengan modul <strong>GPS Geotagging</strong> titik serah terima, foto dokumentasi bercap waktu (timestamp), serta <strong>BAST Digital</strong> berotentikasi kriptografis SHA-256. Memenuhi regulasi Perbup Sumbawa No. 14 Tahun 2026 dan ketentuan UU PDP No. 27 Tahun 2022.
      </p>
</div>
<div className="flex items-center gap-2 self-end sm:self-center shrink-0">
<span className="inline-flex items-center gap-1 font-code-dense text-code-dense px-2 py-1 bg-surface-muted text-text-secondary rounded">
<span className="h-1.5 w-1.5 rounded-full bg-status-verified"></span>
        SSL 256-bit Encrypted
      </span>
</div>
</div>
</div></main></div>
    </>
  );
}
  