"use client";

export default function ProgramBantuan() {
  return (
    <>
      <aside className="fixed left-0 top-0 h-full w-[260px] bg-primary-container text-on-primary z-50 flex flex-col justify-between shadow-[0_1px_8px_rgba(0,0,0,0.04)]"><div className="flex flex-col"><div className="px-space-lg pt-space-lg pb-space-md"><div className="flex items-center gap-space-sm"><div className="w-9 h-9 rounded-xl bg-gold-accent flex items-center justify-center text-text-primary shadow-sm"><span className="material-symbols-outlined text-[22px]">eco</span></div><div className="flex flex-col"><span className="font-headline-sm text-headline-sm text-on-primary font-bold tracking-tight leading-tight">Gema Smart Sumbawa</span><span className="font-label-sm text-label-sm text-primary-fixed-dim leading-none mt-space-xs">Dinas Pertanian Kab. Sumbawa</span></div></div><div className="mt-space-md p-space-sm rounded-xl bg-gov-green-dark/60 flex items-center gap-space-sm"><div className="w-8 h-8 rounded-full bg-primary flex items-center justify-center shrink-0"><span className="material-symbols-outlined text-on-primary text-[18px]">person</span></div><div className="flex flex-col min-w-0 flex-1"><span className="font-label-md text-label-md text-on-primary truncate font-semibold">Ir. H. Syamsuddin, M.Si</span><div className="flex items-center mt-space-xs"><span className="bg-gold-accent text-text-primary font-label-sm text-label-sm px-space-sm py-0.5 rounded-full font-bold uppercase tracking-wider">Super Admin</span></div></div></div></div><nav className="flex flex-col gap-1 px-space-sm mt-space-xs overflow-y-auto max-h-[calc(100vh-270px)]" data-active-classes="bg-gov-green-dark text-on-primary font-semibold shadow-inner"><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="dashboard" href="/dashboard"><span className="material-symbols-outlined text-[20px]">dashboard</span><span className="font-label-lg text-label-lg">Dashboard</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="program-bantuan" href="/program-bantuan"><span className="material-symbols-outlined text-[20px]">folder_open</span><span className="font-label-lg text-label-lg">Program Bantuan</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="kampus-mitra" href="/kampus-mitra"><span className="material-symbols-outlined text-[20px]">school</span><span className="font-label-lg text-label-lg">Kampus Mitra</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="data-penerima" href="/data-penerima"><span className="material-symbols-outlined text-[20px]">group</span><span className="font-label-lg text-label-lg">Data Penerima</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="penyaluran-bibit" href="/penyaluran-bibit"><span className="material-symbols-outlined text-[20px]">potted_plant</span><span className="font-label-lg text-label-lg">Penyaluran Bibit</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="monitoring" href="/monitoring"><span className="material-symbols-outlined text-[20px]">assignment_turned_in</span><span className="font-label-lg text-label-lg">Monitoring</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="validasi-lapangan" href="/validasi-lapangan"><span className="material-symbols-outlined text-[20px]">verified_user</span><span className="font-label-lg text-label-lg">Validasi Lapangan</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="laporan" href="/laporan"><span className="material-symbols-outlined text-[20px]">description</span><span className="font-label-lg text-label-lg">Laporan</span></a><div className="flex flex-col gap-1"><a className="flex items-center justify-between px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="master-data" href="/master-data"><div className="flex items-center gap-space-sm"><span className="material-symbols-outlined text-[20px]">database</span><span className="font-label-lg text-label-lg">Master Data</span></div><span className="material-symbols-outlined text-[16px]">expand_more</span></a><div className="pl-8 flex flex-col gap-1"><a className="px-space-md py-space-xs rounded-lg text-primary-fixed-dim font-label-md text-label-md hover:bg-gov-green-dark/50 hover:text-on-primary transition-colors" data-path="master-data-wilayah" href="/master-data-wilayah">Wilayah</a><a className="px-space-md py-space-xs rounded-lg text-primary-fixed-dim font-label-md text-label-md hover:bg-gov-green-dark/50 hover:text-on-primary transition-colors" data-path="master-data-jenis-bibit" href="/master-data-jenis-bibit">Jenis Bibit</a></div></div><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="audit-log" href="/audit-log"><span className="material-symbols-outlined text-[20px]">receipt_long</span><span className="font-label-lg text-label-lg">Audit Log</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="pengaturan" href="/pengaturan"><span className="material-symbols-outlined text-[20px]">settings</span><span className="font-label-lg text-label-lg">Pengaturan</span></a></nav></div><div className="p-space-md bg-gov-green-dark/40 flex flex-col gap-space-sm"><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-error-container hover:bg-error/20 hover:text-on-primary transition-colors" data-path="login" href="/login"><span className="material-symbols-outlined text-[20px]">logout</span><span className="font-label-lg text-label-lg font-semibold">Keluar</span></a><div className="flex items-center justify-between px-space-xs pt-space-xs border-t border-white/10"><span className="font-label-sm text-label-sm text-primary-fixed-dim">Gema Smart Enterprise</span><span className="font-label-sm text-label-sm text-gold-accent font-semibold">v2.0</span></div></div></aside><div className="pl-[260px]"><header className="fixed top-0 left-[260px] right-0 h-16 bg-canvas-bg/95 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-40 flex items-center justify-between px-6"><div className="flex items-center gap-space-md"><div className="flex items-center gap-space-xs text-text-secondary font-label-md text-label-md"><span className="material-symbols-outlined text-[18px]">home</span><span>Beranda</span><span className="material-symbols-outlined text-[14px]">chevron_right</span><span className="text-text-primary font-semibold">Dashboard Eksekutif</span></div><span className="bg-gold-surface text-secondary font-label-sm text-label-sm px-space-sm py-0.5 rounded-full font-bold border border-gold-accent/40">TA 2026</span></div><div className="flex items-center gap-space-md"><div className="hidden md:flex items-center gap-space-xs bg-status-verified-surface text-primary px-space-md py-1 rounded-full font-label-sm text-label-sm font-semibold"><span className="w-2 h-2 rounded-full bg-status-verified animate-pulse"></span><span>Server Aktif: Sumbawa-Node-01</span></div><button aria-label="Notifikasi" className="relative p-space-sm rounded-lg text-text-secondary hover:bg-surface-subtle hover:text-text-primary transition-colors"><span className="material-symbols-outlined text-[22px]">notifications</span><span className="absolute top-1.5 right-1.5 w-4 h-4 rounded-full bg-error text-on-error font-label-sm text-label-sm flex items-center justify-center font-bold text-[10px]">3</span></button><div className="h-6 w-px bg-border-medium hidden sm:block"></div><div className="flex items-center gap-space-sm cursor-pointer"><div className="w-8 h-8 rounded-full bg-primary flex items-center justify-center"><span className="material-symbols-outlined text-on-primary text-[18px]">person</span></div><span className="material-symbols-outlined text-text-secondary text-[20px]">keyboard_arrow_down</span></div></div></header><main className="relative pt-16 bg-surface-muted min-h-screen p-6"><div className="flex flex-col w-full">
{/* Interactive Toast Notification Placeholder */}
<div className="fixed bottom-6 right-6 z-50 transform translate-y-20 opacity-0 transition-all duration-300 pointer-events-none flex items-center gap-space-sm px-space-md py-space-sm rounded-lg bg-surface-container-lowest text-text-primary shadow-xl" id="toastNotification">
<span className="material-symbols-outlined text-primary text-[20px]" id="toastIcon">check_circle</span>
<span className="font-label-md text-label-md font-semibold" id="toastMsg">Status program diperbarui</span>
</div>
{/* Page Header */}
<div className="flex flex-col md:flex-row md:items-center justify-between gap-space-md pb-space-xl">
<div className="flex flex-col">
<div className="flex items-center gap-space-sm">
<h1 className="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Program Bantuan</h1>
<span className="bg-gov-green-surface text-primary font-label-sm text-label-sm px-space-sm py-0.5 rounded-full font-bold uppercase tracking-wider">TA 2026 Aktif</span>
</div>
<p className="font-body-md text-body-md text-text-secondary mt-space-xs max-w-2xl">
        Pengelolaan alokasi pagu anggaran dan pengawasan distribusi program bantuan bibit per tahun anggaran di Kabupaten Sumbawa.
      </p>
</div>
{/* CTA Create Program */}
<div className="flex items-center gap-space-sm shrink-0">
<button className="flex items-center gap-space-xs bg-primary-container text-on-primary px-space-lg py-space-sm rounded-lg font-label-lg text-label-lg shadow-sm hover:bg-gov-green-dark transition-colors cursor-pointer" onClick={() => {}}>
<span className="material-symbols-outlined text-[20px]">add</span>
<span>Buat Program Baru</span>
</button>
</div>
</div>
{/* Summary KPI Mini Cards */}
<div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-md mb-space-xl">
{/* Card 1: Total Program */}
<div className="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col justify-between">
<div className="flex items-start justify-between">
<div className="flex flex-col">
<span className="font-label-md text-label-md text-text-secondary uppercase tracking-wider">Total Program</span>
<span className="font-headline-xl text-headline-xl text-text-primary font-bold mt-1">24</span>
</div>
<div className="w-10 h-10 rounded-lg bg-gov-green-surface text-primary flex items-center justify-center">
<span className="material-symbols-outlined text-[22px]">folder_open</span>
</div>
</div>
<div className="mt-space-md pt-space-xs flex items-center gap-space-xs text-text-secondary font-label-sm text-label-sm">
<span className="font-semibold text-primary">18 Aktif</span>
<span>â€¢</span>
<span className="font-semibold text-status-info">4 Selesai</span>
<span>â€¢</span>
<span className="font-semibold text-status-fraud">2 Dibekukan</span>
</div>
</div>
{/* Card 2: Total Pagu Berjalan */}
<div className="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col justify-between">
<div className="flex items-start justify-between">
<div className="flex flex-col">
<span className="font-label-md text-label-md text-text-secondary uppercase tracking-wider">Total Pagu Berjalan</span>
<span className="font-headline-lg text-headline-lg text-text-primary font-bold mt-1">Rp 6.250.000.000</span>
</div>
<div className="w-10 h-10 rounded-lg bg-gold-surface text-secondary flex items-center justify-center">
<span className="material-symbols-outlined text-[22px]">account_balance_wallet</span>
</div>
</div>
<div className="mt-space-md pt-space-xs flex items-center gap-1 font-label-sm text-label-sm text-text-secondary">
<span className="material-symbols-outlined text-primary text-[14px]">arrow_upward</span>
<span className="text-primary font-semibold">+12.4%</span>
<span>dari alokasi TA 2025</span>
</div>
</div>
{/* Card 3: Rata-rata Penyerapan */}
<div className="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col justify-between">
<div className="flex items-start justify-between">
<div className="flex flex-col">
<span className="font-label-md text-label-md text-text-secondary uppercase tracking-wider">Rata-rata Penyerapan</span>
<span className="font-headline-xl text-headline-xl text-text-primary font-bold mt-1">76.8%</span>
</div>
<div className="w-10 h-10 rounded-lg bg-status-info-surface text-status-info flex items-center justify-center">
<span className="material-symbols-outlined text-[22px]">trending_up</span>
</div>
</div>
<div className="mt-space-md pt-space-xs w-full">
<div className="w-full bg-surface-container-high rounded-full h-1.5 overflow-hidden">
<div className="bg-status-info h-1.5 rounded-full" style={{"width": "76.8%"}}></div>
</div>
</div>
</div>
{/* Card 4: Bibit Tersalurkan */}
<div className="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col justify-between">
<div className="flex items-start justify-between">
<div className="flex flex-col">
<span className="font-label-md text-label-md text-text-secondary uppercase tracking-wider">Bibit Tersalurkan</span>
<span className="font-headline-xl text-headline-xl text-text-primary font-bold mt-1">48.920 <span className="font-label-lg text-label-lg text-text-secondary font-normal">Unit</span></span>
</div>
<div className="w-10 h-10 rounded-lg bg-gov-green-surface text-primary flex items-center justify-center">
<span className="material-symbols-outlined text-[22px]">yard</span>
</div>
</div>
<div className="mt-space-md pt-space-xs flex items-center justify-between font-label-sm text-label-sm text-text-secondary">
<span>Target: 62.500 Unit</span>
<span className="text-primary font-semibold">78.2%</span>
</div>
</div>
</div>
{/* Filter & Control Panel */}
<div className="bg-surface-container-lowest p-space-md rounded-xl shadow-sm mb-space-lg">
<div className="flex flex-col lg:flex-row lg:items-center justify-between gap-space-md">
{/* Search Input & Filters Left Group */}
<div className="flex flex-wrap items-center gap-space-sm flex-1">
{/* Search Input */}
<div className="relative min-w-[280px] flex-1 sm:flex-initial">
<span className="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary text-[20px]">search</span>
<input className="w-full pl-10 pr-3 py-2 bg-surface-subtle text-text-primary font-body-md text-body-md rounded-lg focus:outline-none focus:bg-surface-container-lowest transition-colors" id="searchInput" placeholder="Cari nama program, komoditas, atau nomor SK..." type="text"/>
</div>
{/* Dropdown Tahun Anggaran */}
<div className="relative">
<select className="appearance-none pl-3 pr-8 py-2 bg-surface-subtle text-text-primary font-label-md text-label-md rounded-lg focus:outline-none focus:bg-surface-container-lowest transition-colors cursor-pointer" id="filterTahun">
<option value="ALL">Semua Tahun</option>
<option selected value="2026">TA 2026 (Berjalan)</option>
<option value="2025">TA 2025</option>
<option value="2024">TA 2024</option>
</select>
<span className="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-text-secondary text-[18px] pointer-events-none">expand_more</span>
</div>
{/* Dropdown Status */}
<div className="relative">
<select className="appearance-none pl-3 pr-8 py-2 bg-surface-subtle text-text-primary font-label-md text-label-md rounded-lg focus:outline-none focus:bg-surface-container-lowest transition-colors cursor-pointer" id="filterStatus">
<option value="ALL">Semua Status</option>
<option value="DRAFT">DRAFT</option>
<option value="AKTIF">AKTIF</option>
<option value="SELESAI">SELESAI</option>
<option value="DIBEKUKAN">DIBEKUKAN</option>
</select>
<span className="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-text-secondary text-[18px] pointer-events-none">expand_more</span>
</div>
{/* Action Filter Buttons */}
<button className="bg-primary text-on-primary px-space-md py-2 rounded-lg font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors cursor-pointer shadow-sm" onClick={() => {}}>
          Terapkan
        </button>
<button className="bg-surface-subtle text-text-secondary hover:text-text-primary px-space-md py-2 rounded-lg font-label-md text-label-md font-semibold hover:bg-surface-muted transition-colors cursor-pointer" onClick={() => {}}>
          Reset
        </button>
</div>
{/* Export Data Actions */}
<div className="flex items-center gap-space-xs shrink-0 self-end lg:self-center">
<button className="flex items-center gap-space-xs px-space-md py-2 bg-surface-subtle hover:bg-surface-muted text-text-primary rounded-lg font-label-md text-label-md font-semibold transition-colors cursor-pointer" onClick={() => {}}>
<span className="material-symbols-outlined text-[18px] text-primary">table_view</span>
<span>Ekspor Excel</span>
</button>
<button className="flex items-center gap-space-xs px-space-md py-2 bg-surface-subtle hover:bg-surface-muted text-text-primary rounded-lg font-label-md text-label-md font-semibold transition-colors cursor-pointer" onClick={() => {}}>
<span className="material-symbols-outlined text-[18px] text-error">picture_as_pdf</span>
<span>Cetak PDF</span>
</button>
</div>
</div>
</div>
{/* Main Data Table Container */}
<div className="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col">
<div className="overflow-x-auto">
<table className="w-full text-left" id="programTable">
<thead className="bg-surface-subtle text-text-secondary font-label-md text-label-md">
<tr>
<th className="py-space-md px-space-md text-center w-12">No</th>
<th className="py-space-md px-space-md w-20">Tahun</th>
<th className="py-space-md px-space-md min-w-[280px]">Nama Program</th>
<th className="py-space-md px-space-md min-w-[150px]">Total Pagu</th>
<th className="py-space-md px-space-md min-w-[190px]">Dana Terserap</th>
<th className="py-space-md px-space-md min-w-[180px]">Bibit Tersalurkan</th>
<th className="py-space-md px-space-md w-32 text-center">Status</th>
<th className="py-space-md px-space-md w-36 text-center">Aksi</th>
</tr>
</thead>
<tbody className="divide-y-0 text-text-primary font-body-md text-body-md">
{/* Row 1: Jagung Hibrida (AKTIF) */}
<tr className="hover:bg-surface-subtle transition-colors group">
<td className="py-space-lg px-space-md text-center font-label-sm text-text-secondary">1</td>
<td className="py-space-lg px-space-md font-label-md text-text-primary font-semibold">2026</td>
<td className="py-space-lg px-space-md">
<div className="flex flex-col">
<span className="font-label-lg text-label-lg text-text-primary font-semibold group-hover:text-primary transition-colors">
                  Bantuan Bibit Jagung Hibrida Bisi-18 &amp; NK-212 Musim Tanam I
                </span>
<span className="font-label-sm text-label-sm text-text-secondary mt-0.5">
                  Komoditas Pangan â€¢ 12 Kecamatan Prioritas
                </span>
</div>
</td>
<td className="py-space-lg px-space-md">
<span className="font-label-md text-label-md font-semibold text-text-primary">Rp 2.450.000.000</span>
</td>
<td className="py-space-lg px-space-md">
<div className="flex flex-col gap-1">
<div className="flex items-center justify-between font-label-sm text-label-sm">
<span className="font-semibold text-text-primary">Rp 1.870.000.000</span>
<span className="text-primary font-bold">76.3%</span>
</div>
<div className="w-full bg-surface-container-high rounded-full h-1.5 overflow-hidden">
<div className="bg-primary-container h-1.5 rounded-full" style={{"width": "76.3%"}}></div>
</div>
</div>
</td>
<td className="py-space-lg px-space-md">
<div className="flex flex-col gap-1">
<div className="flex items-center justify-between font-label-sm text-label-sm">
<span className="text-text-primary">12.450 / 16.000 Unit</span>
<span className="text-text-secondary font-medium">77.8%</span>
</div>
<div className="w-full bg-surface-container-high rounded-full h-1.5 overflow-hidden">
<div className="bg-secondary-container h-1.5 rounded-full" style={{"width": "77.8%"}}></div>
</div>
</div>
</td>
<td className="py-space-lg px-space-md text-center">
<span className="inline-flex items-center gap-1 bg-gov-green-surface text-primary-container font-label-sm text-label-sm px-space-md py-1 rounded-full font-bold uppercase tracking-wider">
<span className="w-1.5 h-1.5 rounded-full bg-primary-container"></span>
                AKTIF
              </span>
</td>
<td className="py-space-lg px-space-md text-center">
<div className="flex items-center justify-center gap-1">
<button className="p-1.5 rounded-lg text-text-secondary hover:text-primary hover:bg-gov-green-surface transition-colors" onClick={() => {}} title="Lihat Detail Program">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="p-1.5 rounded-lg text-text-secondary hover:text-secondary hover:bg-gold-surface transition-colors" onClick={() => {}} title="Edit Rincian Program">
<span className="material-symbols-outlined text-[18px]">edit</span>
</button>
<button className="p-1.5 rounded-lg text-text-secondary hover:text-status-fraud hover:bg-status-fraud-surface transition-colors" onClick={() => {}} title="Bekukan Program (Freeze)">
<span className="material-symbols-outlined text-[18px]">lock_open</span>
</button>
</div>
</td>
</tr>
{/* Row 2: Kopi Robusta (AKTIF) */}
<tr className="hover:bg-surface-subtle transition-colors group">
<td className="py-space-lg px-space-md text-center font-label-sm text-text-secondary">2</td>
<td className="py-space-lg px-space-md font-label-md text-text-primary font-semibold">2026</td>
<td className="py-space-lg px-space-md">
<div className="flex flex-col">
<span className="font-label-lg text-label-lg text-text-primary font-semibold group-hover:text-primary transition-colors">
                  Program Revitalisasi Bibit Kopi Robusta Batulanteh Agroforestry
                </span>
<span className="font-label-sm text-label-sm text-text-secondary mt-0.5">
                  Komoditas Perkebunan â€¢ 6 Kecamatan Hulu
                </span>
</div>
</td>
<td className="py-space-lg px-space-md">
<span className="font-label-md text-label-md font-semibold text-text-primary">Rp 1.600.000.000</span>
</td>
<td className="py-space-lg px-space-md">
<div className="flex flex-col gap-1">
<div className="flex items-center justify-between font-label-sm text-label-sm">
<span className="font-semibold text-text-primary">Rp 820.000.000</span>
<span className="text-status-info font-bold">51.2%</span>
</div>
<div className="w-full bg-surface-container-high rounded-full h-1.5 overflow-hidden">
<div className="bg-status-info h-1.5 rounded-full" style={{"width": "51.2%"}}></div>
</div>
</div>
</td>
<td className="py-space-lg px-space-md">
<div className="flex flex-col gap-1">
<div className="flex items-center justify-between font-label-sm text-label-sm">
<span className="text-text-primary">8.200 / 15.000 Unit</span>
<span className="text-text-secondary font-medium">54.6%</span>
</div>
<div className="w-full bg-surface-container-high rounded-full h-1.5 overflow-hidden">
<div className="bg-status-info h-1.5 rounded-full" style={{"width": "54.6%"}}></div>
</div>
</div>
</td>
<td className="py-space-lg px-space-md text-center">
<span className="inline-flex items-center gap-1 bg-gov-green-surface text-primary-container font-label-sm text-label-sm px-space-md py-1 rounded-full font-bold uppercase tracking-wider">
<span className="w-1.5 h-1.5 rounded-full bg-primary-container"></span>
                AKTIF
              </span>
</td>
<td className="py-space-lg px-space-md text-center">
<div className="flex items-center justify-center gap-1">
<button className="p-1.5 rounded-lg text-text-secondary hover:text-primary hover:bg-gov-green-surface transition-colors" onClick={() => {}} title="Lihat Detail Program">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="p-1.5 rounded-lg text-text-secondary hover:text-secondary hover:bg-gold-surface transition-colors" onClick={() => {}} title="Edit Rincian Program">
<span className="material-symbols-outlined text-[18px]">edit</span>
</button>
<button className="p-1.5 rounded-lg text-text-secondary hover:text-status-fraud hover:bg-status-fraud-surface transition-colors" onClick={() => {}} title="Bekukan Program (Freeze)">
<span className="material-symbols-outlined text-[18px]">lock_open</span>
</button>
</div>
</td>
</tr>
{/* Row 3: Bibit Padi Ciherang (SELESAI) */}
<tr className="hover:bg-surface-subtle transition-colors group">
<td className="py-space-lg px-space-md text-center font-label-sm text-text-secondary">3</td>
<td className="py-space-lg px-space-md font-label-md text-text-primary font-semibold">2025</td>
<td className="py-space-lg px-space-md">
<div className="flex flex-col">
<span className="font-label-lg text-label-lg text-text-primary font-semibold group-hover:text-primary transition-colors">
                  Penyaluran Bibit Padi Ciherang &amp; Inpari 32 Ketahanan Pangan TA 2025
                </span>
<span className="font-label-sm text-label-sm text-text-secondary mt-0.5">
                  Komoditas Pangan â€¢ 24 Kecamatan Tuntas
                </span>
</div>
</td>
<td className="py-space-lg px-space-md">
<span className="font-label-md text-label-md font-semibold text-text-primary">Rp 3.100.000.000</span>
</td>
<td className="py-space-lg px-space-md">
<div className="flex flex-col gap-1">
<div className="flex items-center justify-between font-label-sm text-label-sm">
<span className="font-semibold text-text-primary">Rp 3.085.000.000</span>
<span className="text-status-info font-bold">99.5%</span>
</div>
<div className="w-full bg-surface-container-high rounded-full h-1.5 overflow-hidden">
<div className="bg-status-info h-1.5 rounded-full" style={{"width": "99.5%"}}></div>
</div>
</div>
</td>
<td className="py-space-lg px-space-md">
<div className="flex flex-col gap-1">
<div className="flex items-center justify-between font-label-sm text-label-sm">
<span className="text-text-primary">25.000 / 25.000 Unit</span>
<span className="text-primary font-semibold">100%</span>
</div>
<div className="w-full bg-surface-container-high rounded-full h-1.5 overflow-hidden">
<div className="bg-primary h-1.5 rounded-full" style={{"width": "100%"}}></div>
</div>
</div>
</td>
<td className="py-space-lg px-space-md text-center">
<span className="inline-flex items-center gap-1 bg-status-info-surface text-status-info font-label-sm text-label-sm px-space-md py-1 rounded-full font-bold uppercase tracking-wider">
<span className="material-symbols-outlined text-[14px]">done_all</span>
                SELESAI
              </span>
</td>
<td className="py-space-lg px-space-md text-center">
<div className="flex items-center justify-center gap-1">
<button className="p-1.5 rounded-lg text-text-secondary hover:text-primary hover:bg-gov-green-surface transition-colors" onClick={() => {}} title="Lihat Detail Program">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="p-1.5 rounded-lg text-text-tertiary cursor-not-allowed opacity-50" disabled title="Terkunci: Program Telah Selesai">
<span className="material-symbols-outlined text-[18px]">edit_off</span>
</button>
<button className="p-1.5 rounded-lg text-text-tertiary cursor-not-allowed opacity-50" disabled title="Program Sudah Final (SPJ Selesai)">
<span className="material-symbols-outlined text-[18px]">lock</span>
</button>
</div>
</td>
</tr>
{/* Row 4: Hortikultura (DRAFT) */}
<tr className="hover:bg-surface-subtle transition-colors group">
<td className="py-space-lg px-space-md text-center font-label-sm text-text-secondary">4</td>
<td className="py-space-lg px-space-md font-label-md text-text-primary font-semibold">2026</td>
<td className="py-space-lg px-space-md">
<div className="flex flex-col">
<span className="font-label-lg text-label-lg text-text-primary font-semibold group-hover:text-primary transition-colors">
                  Bantuan Bibit Hortikultura Cabai Rawit &amp; Bawang Merah Dataran Rendah
                </span>
<span className="font-label-sm text-label-sm text-text-secondary mt-0.5">
                  Komoditas Hortikultura â€¢ Tahap Review Dinas
                </span>
</div>
</td>
<td className="py-space-lg px-space-md">
<span className="font-label-md text-label-md font-semibold text-text-primary">Rp 950.000.000</span>
</td>
<td className="py-space-lg px-space-md">
<div className="flex flex-col gap-1">
<div className="flex items-center justify-between font-label-sm text-label-sm">
<span className="font-semibold text-text-secondary">Rp 0</span>
<span className="text-text-tertiary">0%</span>
</div>
<div className="w-full bg-surface-container-high rounded-full h-1.5 overflow-hidden">
<div className="bg-surface-dim h-1.5 rounded-full" style={{"width": "0%"}}></div>
</div>
</div>
</td>
<td className="py-space-lg px-space-md">
<div className="flex flex-col gap-1">
<div className="flex items-center justify-between font-label-sm text-label-sm">
<span className="text-text-secondary">0 / 8.000 Unit</span>
<span className="text-text-tertiary">0%</span>
</div>
<div className="w-full bg-surface-container-high rounded-full h-1.5 overflow-hidden">
<div className="bg-surface-dim h-1.5 rounded-full" style={{"width": "0%"}}></div>
</div>
</div>
</td>
<td className="py-space-lg px-space-md text-center">
<span className="inline-flex items-center gap-1 bg-surface-muted text-text-secondary font-label-sm text-label-sm px-space-md py-1 rounded-full font-bold uppercase tracking-wider">
<span className="w-1.5 h-1.5 rounded-full bg-text-tertiary"></span>
                DRAFT
              </span>
</td>
<td className="py-space-lg px-space-md text-center">
<div className="flex items-center justify-center gap-1">
<button className="p-1.5 rounded-lg text-text-secondary hover:text-primary hover:bg-gov-green-surface transition-colors" onClick={() => {}} title="Lihat Detail Program">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="p-1.5 rounded-lg text-text-secondary hover:text-secondary hover:bg-gold-surface transition-colors" onClick={() => {}} title="Edit Rincian Program">
<span className="material-symbols-outlined text-[18px]">edit</span>
</button>
<button className="p-1.5 rounded-lg text-text-secondary hover:text-text-primary hover:bg-surface-muted transition-colors" onClick={() => {}} title="Program Masih Berupa Draf">
<span className="material-symbols-outlined text-[18px]">lock_open</span>
</button>
</div>
</td>
</tr>
{/* Row 5: Kedelai Anjasmoro (DIBEKUKAN) */}
<tr className="hover:bg-surface-subtle transition-colors group bg-status-fraud-surface/20">
<td className="py-space-lg px-space-md text-center font-label-sm text-text-secondary">5</td>
<td className="py-space-lg px-space-md font-label-md text-text-primary font-semibold">2025</td>
<td className="py-space-lg px-space-md">
<div className="flex flex-col">
<div className="flex items-center gap-1.5">
<span className="material-symbols-outlined text-status-fraud text-[16px]">lock</span>
<span className="font-label-lg text-label-lg text-text-primary font-semibold group-hover:text-status-fraud transition-colors">
                    Bantuan Bibit Kedelai Anjasmoro Kluster Wilayah Alas Barat
                  </span>
</div>
<span className="font-label-sm text-label-sm text-status-fraud mt-0.5 font-medium">
                  Penundaan Anggaran â€¢ Audit Inspektorat Daerah
                </span>
</div>
</td>
<td className="py-space-lg px-space-md">
<span className="font-label-md text-label-md font-semibold text-text-primary">Rp 750.000.000</span>
</td>
<td className="py-space-lg px-space-md">
<div className="flex flex-col gap-1">
<div className="flex items-center justify-between font-label-sm text-label-sm">
<span className="font-semibold text-status-fraud">Rp 120.000.000</span>
<span className="text-status-fraud font-bold">16.0%</span>
</div>
<div className="w-full bg-surface-container-high rounded-full h-1.5 overflow-hidden">
<div className="bg-status-fraud h-1.5 rounded-full" style={{"width": "16.0%"}}></div>
</div>
</div>
</td>
<td className="py-space-lg px-space-md">
<div className="flex flex-col gap-1">
<div className="flex items-center justify-between font-label-sm text-label-sm">
<span className="text-text-primary">1.100 / 7.500 Unit</span>
<span className="text-status-fraud font-medium">14.6%</span>
</div>
<div className="w-full bg-surface-container-high rounded-full h-1.5 overflow-hidden">
<div className="bg-status-fraud h-1.5 rounded-full" style={{"width": "14.6%"}}></div>
</div>
</div>
</td>
<td className="py-space-lg px-space-md text-center">
<span className="inline-flex items-center gap-1 bg-status-fraud-surface text-status-fraud font-label-sm text-label-sm px-space-md py-1 rounded-full font-bold uppercase tracking-wider">
<span className="material-symbols-outlined text-[14px]">warning</span>
                DIBEKUKAN
              </span>
</td>
<td className="py-space-lg px-space-md text-center">
<div className="flex items-center justify-center gap-1">
<button className="p-1.5 rounded-lg text-text-secondary hover:text-primary hover:bg-gov-green-surface transition-colors" onClick={() => {}} title="Lihat Detail Program &amp; Berkas Audit">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="p-1.5 rounded-lg text-text-tertiary cursor-not-allowed opacity-50" disabled title="Terkunci: Program Dibekukan FR-04">
<span className="material-symbols-outlined text-[18px]">edit_off</span>
</button>
<button className="p-1.5 rounded-lg text-status-fraud hover:bg-status-fraud-surface transition-colors" onClick={() => {}} title="Buka Pembekuan Program (Unfreeze SK)">
<span className="material-symbols-outlined text-[18px]">lock</span>
</button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
{/* Table Pagination Footer */}
<div className="px-space-lg py-space-md bg-surface-subtle flex flex-col sm:flex-row items-center justify-between gap-space-md">
<div className="flex items-center gap-space-md">
<span className="font-body-sm text-body-sm text-text-secondary">
          Menampilkan <span className="font-semibold text-text-primary">1-5</span> dari <span className="font-semibold text-text-primary">24</span> program
        </span>
<div className="flex items-center gap-1">
<span className="font-body-sm text-body-sm text-text-secondary">Baris:</span>
<select className="bg-surface-container-lowest text-text-primary font-label-sm text-label-sm py-1 px-2 rounded-lg focus:outline-none cursor-pointer">
<option value="10">10 / halaman</option>
<option value="25">25 / halaman</option>
<option value="50">50 / halaman</option>
</select>
</div>
</div>
{/* Pagination Buttons */}
<div className="flex items-center gap-1">
<button className="px-space-sm py-1 rounded-lg text-text-tertiary hover:text-text-primary hover:bg-surface-muted text-label-sm font-semibold flex items-center gap-0.5 cursor-pointer">
<span className="material-symbols-outlined text-[16px]">chevron_left</span>
<span>Sebelumnya</span>
</button>
<button className="w-8 h-8 rounded-lg bg-primary-container text-on-primary font-label-sm text-label-sm font-bold flex items-center justify-center shadow-sm">
          1
        </button>
<button className="w-8 h-8 rounded-lg text-text-secondary hover:text-text-primary hover:bg-surface-muted font-label-sm text-label-sm font-semibold flex items-center justify-center transition-colors cursor-pointer">
          2
        </button>
<button className="w-8 h-8 rounded-lg text-text-secondary hover:text-text-primary hover:bg-surface-muted font-label-sm text-label-sm font-semibold flex items-center justify-center transition-colors cursor-pointer">
          3
        </button>
<button className="px-space-sm py-1 rounded-lg text-text-secondary hover:text-text-primary hover:bg-surface-muted text-label-sm font-semibold flex items-center gap-0.5 transition-colors cursor-pointer">
<span>Selanjutnya</span>
<span className="material-symbols-outlined text-[16px]">chevron_right</span>
</button>
</div>
</div>
</div>
{/* Regulatory Compliance Banner (FR-04) */}
<div className="mt-space-lg p-space-md rounded-xl bg-status-info-surface/60 flex items-start gap-space-sm">
<span className="material-symbols-outlined text-status-info text-[20px] shrink-0 mt-0.5">policy</span>
<div className="flex flex-col">
<span className="font-label-md text-label-md font-bold text-text-primary">Catatan Regulasi Tata Kelola (FR-04 PRD Gema Smart)</span>
<p className="font-body-sm text-body-sm text-text-secondary mt-0.5 leading-relaxed">
        Sesuai dengan ketentuan regulasi administrasi pengadaan bibit Pemkab Sumbawa, program dengan status <strong className="text-text-primary">DIBEKUKAN</strong> atau <strong className="text-text-primary">SELESAI</strong> dikunci secara otomatis dari proses modifikasi alokasi pagu dan penambahan kelompok tani penerima guna menjamin integritas rekam jejak audit Inspektorat Daerah dan laporan pertanggungjawaban (SPJ).
      </p>
</div>
</div>
{/* Interactive Modal: Create Program */}
<div className="fixed inset-0 z-50 flex items-center justify-center bg-inverse-surface/50 backdrop-blur-xs opacity-0 pointer-events-none transition-opacity duration-200 p-4" id="modalCreateProgram">
<div className="bg-surface-container-lowest w-full max-w-2xl rounded-xl shadow-2xl overflow-hidden transform scale-95 transition-transform duration-200">
{/* Modal Header */}
<div className="px-space-xl py-space-lg bg-surface-subtle flex items-center justify-between">
<div className="flex items-center gap-space-sm">
<div className="w-8 h-8 rounded-lg bg-gov-green-surface text-primary flex items-center justify-center">
<span className="material-symbols-outlined text-[20px]">add_box</span>
</div>
<div className="flex flex-col">
<h3 className="font-headline-sm text-headline-sm text-text-primary font-bold">Buat Program Bantuan Baru</h3>
<span className="font-label-sm text-label-sm text-text-secondary">Pendaftaran Master Program Alokasi TA 2026</span>
</div>
</div>
<button className="text-text-secondary hover:text-text-primary p-1 rounded-lg" onClick={() => {}}>
<span className="material-symbols-outlined text-[20px]">close</span>
</button>
</div>
{/* Modal Body Form */}
<form className="p-space-xl flex flex-col gap-space-md" id="createProgramForm" onSubmit={(e) => e.preventDefault()}>
<div className="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
<div className="flex flex-col gap-1">
<label className="font-label-sm text-label-sm font-semibold text-text-primary">Tahun Anggaran</label>
<input className="px-3 py-2 bg-surface-subtle text-text-primary font-body-md text-body-md rounded-lg focus:outline-none focus:bg-surface-container-lowest" required type="number" value="2026"/>
</div>
<div className="flex flex-col gap-1">
<label className="font-label-sm text-label-sm font-semibold text-text-primary">Nomor SK Penetapan Bupati</label>
<input className="px-3 py-2 bg-surface-subtle text-text-primary font-body-md text-body-md rounded-lg focus:outline-none focus:bg-surface-container-lowest" placeholder="Contoh: SK.520/142/DISTAN/2026" required type="text"/>
</div>
</div>
<div className="flex flex-col gap-1">
<label className="font-label-sm text-label-sm font-semibold text-text-primary">Nama Program Bantuan</label>
<input className="px-3 py-2 bg-surface-subtle text-text-primary font-body-md text-body-md rounded-lg focus:outline-none focus:bg-surface-container-lowest" placeholder="Masukkan nama program bantuan selengkapnya..." required type="text"/>
</div>
<div className="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
<div className="flex flex-col gap-1">
<label className="font-label-sm text-label-sm font-semibold text-text-primary">Kategori Komoditas</label>
<select className="px-3 py-2 bg-surface-subtle text-text-primary font-body-md text-body-md rounded-lg focus:outline-none focus:bg-surface-container-lowest">
<option value="pangan">Tanaman Pangan (Padi/Jagung/Kedelai)</option>
<option value="perkebunan">Perkebunan (Kopi/Kakao/Kelapa)</option>
<option value="hortikultura">Hortikultura (Cabai/Bawang/Buah)</option>
</select>
</div>
<div className="flex flex-col gap-1">
<label className="font-label-sm text-label-sm font-semibold text-text-primary">Total Alokasi Pagu (Rupiah)</label>
<input className="px-3 py-2 bg-surface-subtle text-text-primary font-body-md text-body-md rounded-lg focus:outline-none focus:bg-surface-container-lowest" placeholder="Contoh: 1500000000" required type="number"/>
</div>
</div>
<div className="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
<div className="flex flex-col gap-1">
<label className="font-label-sm text-label-sm font-semibold text-text-primary">Target Volume Bibit (Unit)</label>
<input className="px-3 py-2 bg-surface-subtle text-text-primary font-body-md text-body-md rounded-lg focus:outline-none focus:bg-surface-container-lowest" placeholder="Contoh: 20000" required type="number"/>
</div>
<div className="flex flex-col gap-1">
<label className="font-label-sm text-label-sm font-semibold text-text-primary">Status Awal</label>
<select className="px-3 py-2 bg-surface-subtle text-text-primary font-body-md text-body-md rounded-lg focus:outline-none focus:bg-surface-container-lowest">
<option value="DRAFT">DRAFT (Penyusunan Usulan)</option>
<option value="AKTIF">AKTIF (Ditetapkan &amp; Siap Salur)</option>
</select>
</div>
</div>
<div className="flex items-center justify-end gap-space-sm pt-space-md mt-space-sm">
<button className="px-space-lg py-2 rounded-lg font-label-md text-label-md text-text-secondary hover:bg-surface-muted transition-colors cursor-pointer" onClick={() => {}} type="button">
            Batal
          </button>
<button className="px-space-xl py-2 bg-primary-container text-on-primary font-label-md text-label-md font-semibold rounded-lg hover:bg-gov-green-dark transition-colors cursor-pointer shadow-sm" type="submit">
            Simpan Program
          </button>
</div>
</form>
</div>
</div>
{/* Interactive Modal: Detail Program Preview */}
<div className="fixed inset-0 z-50 flex items-center justify-center bg-inverse-surface/50 backdrop-blur-xs opacity-0 pointer-events-none transition-opacity duration-200 p-4" id="modalDetailProgram">
<div className="bg-surface-container-lowest w-full max-w-xl rounded-xl shadow-2xl overflow-hidden transform scale-95 transition-transform duration-200">
<div className="px-space-xl py-space-lg bg-gov-green-surface flex items-center justify-between">
<div className="flex items-center gap-space-sm">
<span className="material-symbols-outlined text-primary text-[24px]">folder_special</span>
<div>
<h3 className="font-headline-sm text-headline-sm text-text-primary font-bold" id="detailTitle">Rincian Program</h3>
<span className="font-label-sm text-label-sm text-primary font-semibold">Gema Smart Kabupaten Sumbawa</span>
</div>
</div>
<button className="text-text-secondary hover:text-text-primary p-1 rounded-lg" onClick={() => {}}>
<span className="material-symbols-outlined text-[20px]">close</span>
</button>
</div>
<div className="p-space-xl flex flex-col gap-space-md font-body-md text-body-md text-text-primary">
<div className="p-space-md bg-surface-subtle rounded-lg flex flex-col gap-1">
<span className="font-label-xs text-text-secondary uppercase">Nomor SK Bupati</span>
<span className="font-label-md text-label-md font-semibold text-text-primary">SK.520/098/DISTAN-SBW/2026</span>
</div>
<div className="grid grid-cols-2 gap-space-sm text-body-sm">
<div className="p-space-sm bg-surface-subtle rounded-lg">
<span className="text-text-secondary">PIC Pengawas Lapangan:</span>
<div className="font-semibold text-text-primary mt-1">Ahmad Zulkarnain, S.P.</div>
</div>
<div className="p-space-sm bg-surface-subtle rounded-lg">
<span className="text-text-secondary">Kampus Mitra Verifikator:</span>
<div className="font-semibold text-text-primary mt-1">Universitas Samawa (UNSA)</div>
</div>
</div>
<div className="p-space-md rounded-lg bg-gold-surface flex items-start gap-space-xs">
<span className="material-symbols-outlined text-secondary text-[18px] shrink-0 mt-0.5">verified_user</span>
<p className="font-body-sm text-body-sm text-secondary">
            Data alokasi program terintegrasi secara langsung dengan sistem NIK Dukcapil &amp; Geospasial Polygon Lahan Poktan Sumbawa.
          </p>
</div>
<div className="flex justify-end pt-space-xs">
<button className="px-space-lg py-2 bg-surface-muted hover:bg-surface-dim rounded-lg font-label-md text-label-md text-text-primary font-semibold transition-colors cursor-pointer" onClick={() => {}}>
            Tutup Pratinjau
          </button>
</div>
</div>
</div>
</div>
</div>
</main></div>
    </>
  );
}
  