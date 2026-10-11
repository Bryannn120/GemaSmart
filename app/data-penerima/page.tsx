
export default function DataPenerima() {
  return (
    <>
      <aside className="fixed left-0 top-0 h-full w-[260px] bg-primary-container text-on-primary z-50 flex flex-col justify-between shadow-[0_1px_8px_rgba(0,0,0,0.04)]"><div className="flex flex-col"><div className="px-space-lg pt-space-lg pb-space-md"><div className="flex items-center gap-space-sm"><div className="w-9 h-9 rounded-xl bg-gold-accent flex items-center justify-center text-text-primary shadow-sm"><span className="material-symbols-outlined text-[22px]">eco</span></div><div className="flex flex-col"><span className="font-headline-sm text-headline-sm text-on-primary font-bold tracking-tight leading-tight">Gema Smart Sumbawa</span><span className="font-label-sm text-label-sm text-primary-fixed-dim leading-none mt-space-xs">Dinas Pertanian Kab. Sumbawa</span></div></div><div className="mt-space-md p-space-sm rounded-xl bg-gov-green-dark/60 flex items-center gap-space-sm"><div className="w-8 h-8 rounded-full bg-primary flex items-center justify-center shrink-0"><span className="material-symbols-outlined text-on-primary text-[18px]">person</span></div><div className="flex flex-col min-w-0 flex-1"><span className="font-label-md text-label-md text-on-primary truncate font-semibold">Ir. H. Syamsuddin, M.Si</span><div className="flex items-center mt-space-xs"><span className="bg-gold-accent text-text-primary font-label-sm text-label-sm px-space-sm py-0.5 rounded-full font-bold uppercase tracking-wider">Super Admin</span></div></div></div></div><nav className="flex flex-col gap-1 px-space-sm mt-space-xs overflow-y-auto max-h-[calc(100vh-270px)]" data-active-classes="bg-gov-green-dark text-on-primary font-semibold shadow-inner"><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="dashboard" href="/dashboard"><span className="material-symbols-outlined text-[20px]">dashboard</span><span className="font-label-lg text-label-lg">Dashboard</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="program-bantuan" href="/program-bantuan"><span className="material-symbols-outlined text-[20px]">folder_open</span><span className="font-label-lg text-label-lg">Program Bantuan</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="kampus-mitra" href="/kampus-mitra"><span className="material-symbols-outlined text-[20px]">school</span><span className="font-label-lg text-label-lg">Kampus Mitra</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="data-penerima" href="/data-penerima"><span className="material-symbols-outlined text-[20px]">group</span><span className="font-label-lg text-label-lg">Data Penerima</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="penyaluran-bibit" href="/penyaluran-bibit"><span className="material-symbols-outlined text-[20px]">potted_plant</span><span className="font-label-lg text-label-lg">Penyaluran Bibit</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="monitoring" href="/monitoring"><span className="material-symbols-outlined text-[20px]">assignment_turned_in</span><span className="font-label-lg text-label-lg">Monitoring</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="validasi-lapangan" href="/validasi-lapangan"><span className="material-symbols-outlined text-[20px]">verified_user</span><span className="font-label-lg text-label-lg">Validasi Lapangan</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="laporan" href="/laporan"><span className="material-symbols-outlined text-[20px]">description</span><span className="font-label-lg text-label-lg">Laporan</span></a><div className="flex flex-col gap-1"><a className="flex items-center justify-between px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="master-data" href="/master-data"><div className="flex items-center gap-space-sm"><span className="material-symbols-outlined text-[20px]">database</span><span className="font-label-lg text-label-lg">Master Data</span></div><span className="material-symbols-outlined text-[16px]">expand_more</span></a><div className="pl-8 flex flex-col gap-1"><a className="px-space-md py-space-xs rounded-lg text-primary-fixed-dim font-label-md text-label-md hover:bg-gov-green-dark/50 hover:text-on-primary transition-colors" data-path="master-data-wilayah" href="/master-data-wilayah">Wilayah</a><a className="px-space-md py-space-xs rounded-lg text-primary-fixed-dim font-label-md text-label-md hover:bg-gov-green-dark/50 hover:text-on-primary transition-colors" data-path="master-data-jenis-bibit" href="/master-data-jenis-bibit">Jenis Bibit</a></div></div><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="audit-log" href="/audit-log"><span className="material-symbols-outlined text-[20px]">receipt_long</span><span className="font-label-lg text-label-lg">Audit Log</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="pengaturan" href="/pengaturan"><span className="material-symbols-outlined text-[20px]">settings</span><span className="font-label-lg text-label-lg">Pengaturan</span></a></nav></div><div className="p-space-md bg-gov-green-dark/40 flex flex-col gap-space-sm"><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-error-container hover:bg-error/20 hover:text-on-primary transition-colors" data-path="login" href="/login"><span className="material-symbols-outlined text-[20px]">logout</span><span className="font-label-lg text-label-lg font-semibold">Keluar</span></a><div className="flex items-center justify-between px-space-xs pt-space-xs border-t border-white/10"><span className="font-label-sm text-label-sm text-primary-fixed-dim">Gema Smart Enterprise</span><span className="font-label-sm text-label-sm text-gold-accent font-semibold">v2.0</span></div></div></aside><div className="pl-[260px]"><header className="fixed top-0 left-[260px] right-0 h-16 bg-canvas-bg/95 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-40 flex items-center justify-between px-6"><div className="flex items-center gap-space-md"><div className="flex items-center gap-space-xs text-text-secondary font-label-md text-label-md"><span className="material-symbols-outlined text-[18px]">home</span><span>Beranda</span><span className="material-symbols-outlined text-[14px]">chevron_right</span><span className="text-text-primary font-semibold">Dashboard Eksekutif</span></div><span className="bg-gold-surface text-secondary font-label-sm text-label-sm px-space-sm py-0.5 rounded-full font-bold border border-gold-accent/40">TA 2026</span></div><div className="flex items-center gap-space-md"><div className="hidden md:flex items-center gap-space-xs bg-status-verified-surface text-primary px-space-md py-1 rounded-full font-label-sm text-label-sm font-semibold"><span className="w-2 h-2 rounded-full bg-status-verified animate-pulse"></span><span>Server Aktif: Sumbawa-Node-01</span></div><button aria-label="Notifikasi" className="relative p-space-sm rounded-lg text-text-secondary hover:bg-surface-subtle hover:text-text-primary transition-colors"><span className="material-symbols-outlined text-[22px]">notifications</span><span className="absolute top-1.5 right-1.5 w-4 h-4 rounded-full bg-error text-on-error font-label-sm text-label-sm flex items-center justify-center font-bold text-[10px]">3</span></button><div className="h-6 w-px bg-border-medium hidden sm:block"></div><div className="flex items-center gap-space-sm cursor-pointer"><div className="w-8 h-8 rounded-full bg-primary flex items-center justify-center"><span className="material-symbols-outlined text-on-primary text-[18px]">person</span></div><span className="material-symbols-outlined text-text-secondary text-[20px]">keyboard_arrow_down</span></div></div></header><main className="relative pt-16 bg-surface-muted min-h-screen p-6"><div className="flex flex-col w-full gap-space-xl">
{/* Sub-Header Area */}
<div className="flex flex-col lg:flex-row lg:items-center justify-between gap-space-md">
<div className="flex flex-col gap-space-xs">
<div className="flex items-center gap-space-xs text-text-secondary font-label-md text-label-md">
<span>Beranda</span>
<span className="material-symbols-outlined text-[14px]">chevron_right</span>
<span>Penerima Manfaat</span>
<span className="material-symbols-outlined text-[14px]">chevron_right</span>
<span className="text-primary font-semibold">Daftar Penerima</span>
</div>
<div className="flex items-center gap-space-sm mt-1">
<h1 className="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Data Penerima Manfaat</h1>
<span className="bg-gov-green-surface text-primary font-label-sm text-label-sm px-space-sm py-0.5 rounded-full font-bold flex items-center gap-1 shadow-sm">
<span className="material-symbols-outlined text-[13px]">lock</span>
          PDP Encrypted
        </span>
</div>
<p className="font-body-md text-body-md text-text-secondary">
        Basis data Calon KeluargaPenerima Calon Lokasi (CPCL) &amp; penerima bantuan bibit tersertifikasi terenkripsi UU PDP No. 27/2022.
      </p>
</div>
{/* Action Buttons Group */}
<div className="flex flex-wrap items-center gap-space-sm">
<div className="flex items-center bg-surface-container-lowest rounded-xl shadow-sm p-1 gap-1">
<button className="flex items-center gap-space-xs px-space-md py-2 rounded-lg bg-canvas-bg hover:bg-surface-subtle text-text-primary font-label-md text-label-md transition-colors shadow-sm" type="button">
<span className="material-symbols-outlined text-status-verified text-[18px]">table_view</span>
<span>Export Excel</span>
</button>
<button className="flex items-center gap-space-xs px-space-md py-2 rounded-lg bg-canvas-bg hover:bg-surface-subtle text-text-primary font-label-md text-label-md transition-colors shadow-sm" type="button">
<span className="material-symbols-outlined text-status-fraud text-[18px]">picture_as_pdf</span>
<span>Export PDF</span>
</button>
</div>
<div className="flex items-center gap-space-sm">
<button className="flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-surface-container-high hover:bg-surface-dim text-text-primary font-label-md text-label-md font-semibold transition-colors shadow-sm" type="button">
<span className="material-symbols-outlined text-[18px]">upload_file</span>
<span>Import CSV</span>
</button>
<button className="flex items-center gap-space-xs px-space-lg py-2 rounded-xl bg-primary-container hover:bg-gov-green-dark text-on-primary font-label-md text-label-md font-semibold transition-all shadow-md" type="button">
<span className="material-symbols-outlined text-[18px]">person_add</span>
<span>+ Daftarkan Penerima</span>
</button>
</div>
</div>
</div>
{/* KPI Metrics Bar */}
<div className="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-space-md">
{/* Card 1 */}
<div className="bg-surface-container-lowest rounded-xl p-space-lg flex flex-col justify-between shadow-sm relative overflow-hidden">
<div className="flex items-center justify-between">
<span className="font-label-md text-label-md text-text-secondary uppercase tracking-wider">Total Penerima Terdaftar</span>
<div className="w-9 h-9 rounded-lg bg-status-info-surface text-status-info flex items-center justify-center">
<span className="material-symbols-outlined text-[20px]">groups</span>
</div>
</div>
<div className="mt-space-md flex items-baseline gap-space-sm">
<span className="font-headline-xl text-headline-xl text-text-primary font-bold">2.840</span>
<span className="font-label-md text-label-md text-text-secondary">KK</span>
</div>
<div className="mt-space-xs flex items-center gap-1 text-primary text-label-sm font-label-sm">
<span className="material-symbols-outlined text-[14px]">domain_verification</span>
<span>Terverifikasi NIK &amp; Titik Koordinat</span>
</div>
<div className="absolute -right-3 -bottom-3 w-16 h-16 bg-status-info/5 rounded-full blur-xl pointer-events-none"></div>
</div>
{/* Card 2 */}
<div className="bg-surface-container-lowest rounded-xl p-space-lg flex flex-col justify-between shadow-sm relative overflow-hidden">
<div className="flex items-center justify-between">
<span className="font-label-md text-label-md text-text-secondary uppercase tracking-wider">Penerima Aktif</span>
<div className="w-9 h-9 rounded-lg bg-gov-green-surface text-status-verified flex items-center justify-center">
<span className="material-symbols-outlined text-[20px]">check_circle</span>
</div>
</div>
<div className="mt-space-md flex items-baseline gap-space-sm">
<span className="font-headline-xl text-headline-xl text-primary font-bold">2.765</span>
<span className="font-label-md text-label-md text-text-secondary">KK</span>
</div>
<div className="mt-space-xs flex items-center justify-between">
<span className="font-label-sm text-label-sm text-status-verified font-semibold">97,4% dari kuota program</span>
<span className="font-label-sm text-label-sm text-text-tertiary">TA 2026</span>
</div>
<div className="w-full bg-surface-container-high h-1.5 rounded-full mt-2 overflow-hidden">
<div className="bg-primary-container h-full rounded-full" style={{"width": "97.4%"}}></div>
</div>
</div>
{/* Card 3 */}
<div className="bg-surface-container-lowest rounded-xl p-space-lg flex flex-col justify-between shadow-sm relative overflow-hidden">
<div className="flex items-center justify-between">
<span className="font-label-md text-label-md text-text-secondary uppercase tracking-wider">Penerima Nonaktif / Diganti</span>
<div className="w-9 h-9 rounded-lg bg-status-fraud-surface text-status-fraud flex items-center justify-center">
<span className="material-symbols-outlined text-[20px]">person_off</span>
</div>
</div>
<div className="mt-space-md flex items-baseline gap-space-sm">
<span className="font-headline-xl text-headline-xl text-text-primary font-bold">75</span>
<span className="font-label-md text-label-md text-text-secondary">KK</span>
</div>
<div className="mt-space-xs flex items-center gap-1 text-text-secondary text-label-sm font-label-sm">
<span className="material-symbols-outlined text-[14px]">sync_problem</span>
<span>Anomali iklim &amp; alih fungsi</span>
</div>
<div className="absolute -right-3 -bottom-3 w-16 h-16 bg-status-fraud/5 rounded-full blur-xl pointer-events-none"></div>
</div>
{/* Card 4 (Target KPI PRD-3) */}
<div className="bg-surface-container-lowest rounded-xl p-space-lg flex flex-col justify-between shadow-sm relative overflow-hidden">
<div className="flex items-center justify-between">
<span className="font-label-md text-label-md text-text-secondary uppercase tracking-wider">Rata-rata Survival Rate</span>
<div className="w-9 h-9 rounded-lg bg-gold-surface text-secondary flex items-center justify-center">
<span className="material-symbols-outlined text-[20px]">potted_plant</span>
</div>
</div>
<div className="mt-space-md flex items-baseline gap-space-sm">
<span className="font-headline-xl text-headline-xl text-status-verified font-bold">78.4%</span>
<span className="bg-gov-green-surface text-primary font-label-sm text-label-sm px-1.5 py-0.5 rounded font-bold">+8.4% vs KPI</span>
</div>
<div className="mt-space-xs flex items-center justify-between text-label-sm font-label-sm">
<span className="text-text-secondary">Target PRD KPI-3: Ã¢â€°Â¥70%</span>
<span className="text-status-verified font-semibold">Tercapai</span>
</div>
<div className="w-full bg-surface-container-high h-1.5 rounded-full mt-2 overflow-hidden">
<div className="bg-status-verified h-full rounded-full" style={{"width": "78.4%"}}></div>
</div>
</div>
</div>
{/* Filter Bar */}
<div className="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm flex flex-col gap-space-md">
<div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-space-sm items-center">
{/* Search */}
<div className="lg:col-span-4 relative">
<span className="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-tertiary text-[20px]">search</span>
<input className="w-full h-10 pl-10 pr-space-md bg-surface-subtle text-text-primary rounded-lg font-body-md text-body-md focus:bg-canvas-bg focus:outline-none shadow-sm placeholder:text-text-tertiary" id="searchInput" placeholder="Cari nama keluarga_penerima, NIK, atau nomor KK..." type="text"/>
</div>
{/* Program Dropdown */}
<div className="lg:col-span-2 relative">
<select className="w-full h-10 px-space-sm pr-8 bg-surface-subtle text-text-primary rounded-lg font-label-md text-label-md focus:bg-canvas-bg focus:outline-none appearance-none cursor-pointer">
<option value="semua">Semua Program</option>
<option value="jagung">Program Benih Jagung Hibrida 2026</option>
<option value="padi">Bibit Padi Inpari 32</option>
<option value="kopi">Kopi Robusta Sumbawa</option>
</select>
<span className="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-text-secondary text-[18px] pointer-events-none">expand_more</span>
</div>
{/* Kecamatan Dropdown */}
<div className="lg:col-span-2 relative">
<select className="w-full h-10 px-space-sm pr-8 bg-surface-subtle text-text-primary rounded-lg font-label-md text-label-md focus:bg-canvas-bg focus:outline-none appearance-none cursor-pointer">
<option value="semua">Semua Kecamatan</option>
<option value="labuhan-badas">Labuhan Badas</option>
<option value="alas">Alas</option>
<option value="alas-barat">Alas Barat</option>
<option value="utan">Utan</option>
<option value="buer">Buer</option>
</select>
<span className="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-text-secondary text-[18px] pointer-events-none">expand_more</span>
</div>
{/* Desa Dropdown */}
<div className="lg:col-span-2 relative">
<select className="w-full h-10 px-space-sm pr-8 bg-surface-subtle text-text-primary rounded-lg font-label-md text-label-md focus:bg-canvas-bg focus:outline-none appearance-none cursor-pointer">
<option value="semua">Semua Desa</option>
<option value="desa-labuhan-badas">Desa Labuhan Badas</option>
<option value="desa-kalimango">Desa Kalimango</option>
<option value="desa-marente">Desa Marente</option>
<option value="desa-labuhan-burung">Desa Labuhan Burung</option>
</select>
<span className="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-text-secondary text-[18px] pointer-events-none">expand_more</span>
</div>
{/* Status Dropdown */}
<div className="lg:col-span-2 relative">
<select className="w-full h-10 px-space-sm pr-8 bg-surface-subtle text-text-primary rounded-lg font-label-md text-label-md focus:bg-canvas-bg focus:outline-none appearance-none cursor-pointer">
<option value="semua">Semua Status</option>
<option value="aktif">Aktif</option>
<option value="nonaktif">Nonaktif</option>
</select>
<span className="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-text-secondary text-[18px] pointer-events-none">expand_more</span>
</div>
</div>
{/* Filter Action Buttons & Badge Meta */}
<div className="flex flex-wrap items-center justify-between gap-space-sm pt-2">
<div className="flex items-center gap-2">
<span className="font-label-sm text-label-sm text-text-tertiary">Filter Cepat:</span>
<button className="bg-surface-subtle hover:bg-surface-dim text-text-primary px-space-sm py-1 rounded-full font-label-sm text-label-sm transition-colors" type="button">Survival Rate &lt; 70%</button>
<button className="bg-surface-subtle hover:bg-surface-dim text-text-primary px-space-sm py-1 rounded-full font-label-sm text-label-sm transition-colors" type="button">Jagung BISI-18</button>
<button className="bg-surface-subtle hover:bg-surface-dim text-text-primary px-space-sm py-1 rounded-full font-label-sm text-label-sm transition-colors" type="button">Plampang &amp; Alas</button>
</div>
<div className="flex items-center gap-space-sm">
<button className="px-space-lg py-2 rounded-lg bg-surface-container hover:bg-surface-dim text-text-primary font-label-md text-label-md font-semibold transition-colors" type="button">
          Reset Filter
        </button>
<button className="px-space-xl py-2 rounded-lg bg-primary-container hover:bg-gov-green-dark text-on-primary font-label-md text-label-md font-semibold transition-all shadow-sm flex items-center gap-1.5" type="button">
<span className="material-symbols-outlined text-[18px]">filter_alt</span>
<span>Terapkan Filter</span>
</button>
</div>
</div>
</div>
{/* Data Table Section */}
<div className="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col">
{/* Table Header Info Bar */}
<div className="px-space-lg py-space-md bg-surface-container-low flex items-center justify-between">
<div className="flex items-center gap-space-sm">
<span className="font-label-lg text-label-lg text-text-primary font-semibold">Tabel CPCL Penerima Bantuan</span>
<span className="font-label-sm text-label-sm text-text-secondary bg-surface-subtle px-2 py-0.5 rounded-full">Kecamatan Se-Kab. Sumbawa</span>
</div>
<div className="flex items-center gap-space-xs text-text-secondary font-label-sm text-label-sm">
<span className="material-symbols-outlined text-[16px] text-status-verified">verified</span>
<span>Data Tersinkronisasi SISKEUDES &amp; Simluhtan</span>
</div>
</div>
{/* Table Responsive Scroller */}
<div className="overflow-x-auto w-full">
<table className="w-full text-left font-body-md text-body-md border-collapse">
<thead>
<tr className="bg-surface-subtle text-text-secondary font-label-md text-label-md">
<th className="py-3 px-4 font-semibold text-center w-12">No</th>
<th className="py-3 px-4 font-semibold">Nama KK</th>
<th className="py-3 px-4 font-semibold">NIK (PDP Masked)</th>
<th className="py-3 px-4 font-semibold">Nomor KK</th>
<th className="py-3 px-4 font-semibold">Desa</th>
<th className="py-3 px-4 font-semibold">Kecamatan</th>
<th className="py-3 px-4 font-semibold">Bibit Diterima</th>
<th className="py-3 px-4 font-semibold min-w-[160px]">Survival Rate</th>
<th className="py-3 px-4 font-semibold text-center">Status</th>
<th className="py-3 px-4 font-semibold text-center w-28">Aksi</th>
</tr>
</thead>
<tbody className="text-text-primary">
{/* Row 1 */}
<tr className="hover:bg-surface-subtle transition-colors group">
<td className="py-3.5 px-4 text-center text-text-secondary font-label-md text-label-md">1</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Ahmad Sudirman</span>
<span className="font-label-sm text-label-sm text-text-secondary">Poktan Samawa Berdaya</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-1.5 font-code-dense text-code-dense text-text-primary bg-surface-container-low px-2 py-1 rounded w-fit">
<span>520410Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢1234</span>
<span className="material-symbols-outlined text-[14px] text-text-tertiary">lock</span>
</div>
</td>
<td className="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary">520410Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢0089</td>
<td className="py-3.5 px-4 font-body-md text-body-md">Desa Labuhan Badas</td>
<td className="py-3.5 px-4 font-body-md text-body-md">Labuhan Badas</td>
<td className="py-3.5 px-4">
<span className="font-semibold text-primary">Jagung BISI-18</span>
<span className="text-text-secondary text-body-sm block">(25 Sak / 125 Kg)</span>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center justify-between text-label-sm font-label-sm mb-1">
<span className="font-semibold text-status-verified">88%</span>
<span className="text-text-tertiary">Optimal</span>
</div>
<div className="w-full bg-surface-container-high h-2 rounded-full overflow-hidden">
<div className="bg-status-verified h-full rounded-full" style={{"width": "88%"}}></div>
</div>
</td>
<td className="py-3.5 px-4 text-center">
<span className="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-gov-green-surface text-primary font-label-sm text-label-sm font-bold">
<span className="w-1.5 h-1.5 rounded-full bg-status-verified"></span>
                Aktif
              </span>
</td>
<td className="py-3.5 px-4 text-center">
<div className="flex items-center justify-center gap-1">
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-container-high text-primary flex items-center justify-center transition-colors" title="Detail Penerima &amp; BAST">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-container-high text-status-info flex items-center justify-center transition-colors" title="Titik Koordinat PostGIS">
<span className="material-symbols-outlined text-[18px]">location_on</span>
</button>
</div>
</td>
</tr>
{/* Row 2 */}
<tr className="hover:bg-surface-subtle transition-colors group bg-canvas-bg">
<td className="py-3.5 px-4 text-center text-text-secondary font-label-md text-label-md">2</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Hasanuddin</span>
<span className="font-label-sm text-label-sm text-text-secondary">Poktan Batu Ringgit</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-1.5 font-code-dense text-code-dense text-text-primary bg-surface-container-low px-2 py-1 rounded w-fit">
<span>520405Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢5678</span>
<span className="material-symbols-outlined text-[14px] text-text-tertiary">lock</span>
</div>
</td>
<td className="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary">520405Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢0142</td>
<td className="py-3.5 px-4 font-body-md text-body-md">Desa Kalimango</td>
<td className="py-3.5 px-4 font-body-md text-body-md">Alas</td>
<td className="py-3.5 px-4">
<span className="font-semibold text-primary">Kopi Robusta</span>
<span className="text-text-secondary text-body-sm block">(50 Polybag)</span>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center justify-between text-label-sm font-label-sm mb-1">
<span className="font-semibold text-status-verified">92%</span>
<span className="text-text-tertiary">Sangat Baik</span>
</div>
<div className="w-full bg-surface-container-high h-2 rounded-full overflow-hidden">
<div className="bg-status-verified h-full rounded-full" style={{"width": "92%"}}></div>
</div>
</td>
<td className="py-3.5 px-4 text-center">
<span className="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-gov-green-surface text-primary font-label-sm text-label-sm font-bold">
<span className="w-1.5 h-1.5 rounded-full bg-status-verified"></span>
                Aktif
              </span>
</td>
<td className="py-3.5 px-4 text-center">
<div className="flex items-center justify-center gap-1">
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-container-high text-primary flex items-center justify-center transition-colors" title="Detail Penerima &amp; BAST">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-container-high text-status-info flex items-center justify-center transition-colors" title="Titik Koordinat PostGIS">
<span className="material-symbols-outlined text-[18px]">location_on</span>
</button>
</div>
</td>
</tr>
{/* Row 3 */}
<tr className="hover:bg-surface-subtle transition-colors group">
<td className="py-3.5 px-4 text-center text-text-secondary font-label-md text-label-md">3</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">M. Saleh Dahlan</span>
<span className="font-label-sm text-label-sm text-text-secondary">Gapoktan Subur Makmur</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-1.5 font-code-dense text-code-dense text-text-primary bg-surface-container-low px-2 py-1 rounded w-fit">
<span>520406Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢9012</span>
<span className="material-symbols-outlined text-[14px] text-text-tertiary">lock</span>
</div>
</td>
<td className="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary">520406Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢0031</td>
<td className="py-3.5 px-4 font-body-md text-body-md">Desa Marente</td>
<td className="py-3.5 px-4 font-body-md text-body-md">Alas Barat</td>
<td className="py-3.5 px-4">
<span className="font-semibold text-primary">Padi Inpari 32</span>
<span className="text-text-secondary text-body-sm block">(40 Sak / 200 Kg)</span>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center justify-between text-label-sm font-label-sm mb-1">
<span className="font-semibold text-status-verified">76%</span>
<span className="text-text-tertiary">Standar</span>
</div>
<div className="w-full bg-surface-container-high h-2 rounded-full overflow-hidden">
<div className="bg-status-verified h-full rounded-full" style={{"width": "76%"}}></div>
</div>
</td>
<td className="py-3.5 px-4 text-center">
<span className="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-gov-green-surface text-primary font-label-sm text-label-sm font-bold">
<span className="w-1.5 h-1.5 rounded-full bg-status-verified"></span>
                Aktif
              </span>
</td>
<td className="py-3.5 px-4 text-center">
<div className="flex items-center justify-center gap-1">
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-container-high text-primary flex items-center justify-center transition-colors" title="Detail Penerima &amp; BAST">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-container-high text-status-info flex items-center justify-center transition-colors" title="Titik Koordinat PostGIS">
<span className="material-symbols-outlined text-[18px]">location_on</span>
</button>
</div>
</td>
</tr>
{/* Row 4 (Warning / Nonaktif) */}
<tr className="hover:bg-status-fraud-surface/40 transition-colors group bg-status-fraud-surface/10">
<td className="py-3.5 px-4 text-center text-text-secondary font-label-md text-label-md">4</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Burhanuddin</span>
<span className="font-label-sm text-label-sm text-status-fraud">Anomali Kekeringan Ekstrem</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-1.5 font-code-dense text-code-dense text-text-primary bg-surface-container-low px-2 py-1 rounded w-fit">
<span>520407Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢3456</span>
<span className="material-symbols-outlined text-[14px] text-text-tertiary">lock</span>
</div>
</td>
<td className="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary">520407Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢0019</td>
<td className="py-3.5 px-4 font-body-md text-body-md">Desa Labuhan Burung</td>
<td className="py-3.5 px-4 font-body-md text-body-md">Buer</td>
<td className="py-3.5 px-4">
<span className="font-semibold text-text-secondary line-through">Jagung BISI-18</span>
<span className="text-text-secondary text-body-sm block">(30 Sak)</span>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center justify-between text-label-sm font-label-sm mb-1">
<span className="font-semibold text-status-fraud">42%</span>
<span className="text-status-fraud text-[11px] font-bold">&lt; Ambang Batas</span>
</div>
<div className="w-full bg-surface-container-high h-2 rounded-full overflow-hidden">
<div className="bg-status-fraud h-full rounded-full" style={{"width": "42%"}}></div>
</div>
</td>
<td className="py-3.5 px-4 text-center">
<span className="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-surface-container-high text-text-secondary font-label-sm text-label-sm font-bold">
<span className="w-1.5 h-1.5 rounded-full bg-text-tertiary"></span>
                Nonaktif (Diganti)
              </span>
</td>
<td className="py-3.5 px-4 text-center">
<div className="flex items-center justify-center gap-1">
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-container-high text-primary flex items-center justify-center transition-colors" title="Detail Penerima &amp; BAST">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-container-high text-status-info flex items-center justify-center transition-colors" title="Titik Koordinat PostGIS">
<span className="material-symbols-outlined text-[18px]">location_on</span>
</button>
</div>
</td>
</tr>
{/* Row 5 (Warning Moderate) */}
<tr className="hover:bg-surface-subtle transition-colors group">
<td className="py-3.5 px-4 text-center text-text-secondary font-label-md text-label-md">5</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Nurhayati</span>
<span className="font-label-sm text-label-sm text-secondary font-semibold">KWT Melati Indah</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-1.5 font-code-dense text-code-dense text-text-primary bg-surface-container-low px-2 py-1 rounded w-fit">
<span>520408Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢7890</span>
<span className="material-symbols-outlined text-[14px] text-text-tertiary">lock</span>
</div>
</td>
<td className="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary">520408Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢0055</td>
<td className="py-3.5 px-4 font-body-md text-body-md">Desa Utan</td>
<td className="py-3.5 px-4 font-body-md text-body-md">Utan</td>
<td className="py-3.5 px-4">
<span className="font-semibold text-primary">Cabai Rawit</span>
<span className="text-text-secondary text-body-sm block">(100 Tray Bibit)</span>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center justify-between text-label-sm font-label-sm mb-1">
<span className="font-semibold text-secondary">65%</span>
<span className="text-secondary text-[11px]">Butuh Pupuk</span>
</div>
<div className="w-full bg-surface-container-high h-2 rounded-full overflow-hidden">
<div className="bg-secondary-container h-full rounded-full" style={{"width": "65%"}}></div>
</div>
</td>
<td className="py-3.5 px-4 text-center">
<span className="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-gov-green-surface text-primary font-label-sm text-label-sm font-bold">
<span className="w-1.5 h-1.5 rounded-full bg-status-verified"></span>
                Aktif
              </span>
</td>
<td className="py-3.5 px-4 text-center">
<div className="flex items-center justify-center gap-1">
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-container-high text-primary flex items-center justify-center transition-colors" title="Detail Penerima &amp; BAST">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-container-high text-status-info flex items-center justify-center transition-colors" title="Titik Koordinat PostGIS">
<span className="material-symbols-outlined text-[18px]">location_on</span>
</button>
</div>
</td>
</tr>
{/* Row 6 */}
<tr className="hover:bg-surface-subtle transition-colors group bg-canvas-bg">
<td className="py-3.5 px-4 text-center text-text-secondary font-label-md text-label-md">6</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Lalu Abdul Wahab</span>
<span className="font-label-sm text-label-sm text-text-secondary">Poktan Harapan Jaya</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-1.5 font-code-dense text-code-dense text-text-primary bg-surface-container-low px-2 py-1 rounded w-fit">
<span>520410Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢2345</span>
<span className="material-symbols-outlined text-[14px] text-text-tertiary">lock</span>
</div>
</td>
<td className="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary">520410Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢0211</td>
<td className="py-3.5 px-4 font-body-md text-body-md">Desa Karang Dima</td>
<td className="py-3.5 px-4 font-body-md text-body-md">Labuhan Badas</td>
<td className="py-3.5 px-4">
<span className="font-semibold text-primary">Mangga Arumanis</span>
<span className="text-text-secondary text-body-sm block">(20 Batang Okulasi)</span>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center justify-between text-label-sm font-label-sm mb-1">
<span className="font-semibold text-status-verified">85%</span>
<span className="text-text-tertiary">Pertumbuhan Subur</span>
</div>
<div className="w-full bg-surface-container-high h-2 rounded-full overflow-hidden">
<div className="bg-status-verified h-full rounded-full" style={{"width": "85%"}}></div>
</div>
</td>
<td className="py-3.5 px-4 text-center">
<span className="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-gov-green-surface text-primary font-label-sm text-label-sm font-bold">
<span className="w-1.5 h-1.5 rounded-full bg-status-verified"></span>
                Aktif
              </span>
</td>
<td className="py-3.5 px-4 text-center">
<div className="flex items-center justify-center gap-1">
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-container-high text-primary flex items-center justify-center transition-colors" title="Detail Penerima &amp; BAST">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-container-high text-status-info flex items-center justify-center transition-colors" title="Titik Koordinat PostGIS">
<span className="material-symbols-outlined text-[18px]">location_on</span>
</button>
</div>
</td>
</tr>
{/* Row 7 (Warning Moderate) */}
<tr className="hover:bg-surface-subtle transition-colors group">
<td className="py-3.5 px-4 text-center text-text-secondary font-label-md text-label-md">7</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Siti Aminah</span>
<span className="font-label-sm text-label-sm text-text-secondary">Poktan Karya Bhakti</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-1.5 font-code-dense text-code-dense text-text-primary bg-surface-container-low px-2 py-1 rounded w-fit">
<span>520405Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢6789</span>
<span className="material-symbols-outlined text-[14px] text-text-tertiary">lock</span>
</div>
</td>
<td className="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary">520405Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢0098</td>
<td className="py-3.5 px-4 font-body-md text-body-md">Desa Baru</td>
<td className="py-3.5 px-4 font-body-md text-body-md">Alas</td>
<td className="py-3.5 px-4">
<span className="font-semibold text-primary">Jagung Pioneer</span>
<span className="text-text-secondary text-body-sm block">(25 Sak / 125 Kg)</span>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center justify-between text-label-sm font-label-sm mb-1">
<span className="font-semibold text-secondary">58%</span>
<span className="text-secondary text-[11px]">Kenaikan Hama</span>
</div>
<div className="w-full bg-surface-container-high h-2 rounded-full overflow-hidden">
<div className="bg-secondary-container h-full rounded-full" style={{"width": "58%"}}></div>
</div>
</td>
<td className="py-3.5 px-4 text-center">
<span className="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-gov-green-surface text-primary font-label-sm text-label-sm font-bold">
<span className="w-1.5 h-1.5 rounded-full bg-status-verified"></span>
                Aktif
              </span>
</td>
<td className="py-3.5 px-4 text-center">
<div className="flex items-center justify-center gap-1">
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-container-high text-primary flex items-center justify-center transition-colors" title="Detail Penerima &amp; BAST">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-container-high text-status-info flex items-center justify-center transition-colors" title="Titik Koordinat PostGIS">
<span className="material-symbols-outlined text-[18px]">location_on</span>
</button>
</div>
</td>
</tr>
{/* Row 8 */}
<tr className="hover:bg-surface-subtle transition-colors group bg-canvas-bg">
<td className="py-3.5 px-4 text-center text-text-secondary font-label-md text-label-md">8</td>
<td className="py-3.5 px-4">
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Dedi Supriyadi</span>
<span className="font-label-sm text-label-sm text-text-secondary">Poktan Tani Makmur</span>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-1.5 font-code-dense text-code-dense text-text-primary bg-surface-container-low px-2 py-1 rounded w-fit">
<span>520406Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢0123</span>
<span className="material-symbols-outlined text-[14px] text-text-tertiary">lock</span>
</div>
</td>
<td className="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary">520406Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢Ã¢â‚¬Â¢0432</td>
<td className="py-3.5 px-4 font-body-md text-body-md">Desa Usar</td>
<td className="py-3.5 px-4 font-body-md text-body-md">Plampang</td>
<td className="py-3.5 px-4">
<span className="font-semibold text-primary">Padi Inpari 32</span>
<span className="text-text-secondary text-body-sm block">(40 Sak / 200 Kg)</span>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center justify-between text-label-sm font-label-sm mb-1">
<span className="font-semibold text-status-verified">95%</span>
<span className="text-text-tertiary">Sangat Baik</span>
</div>
<div className="w-full bg-surface-container-high h-2 rounded-full overflow-hidden">
<div className="bg-status-verified h-full rounded-full" style={{"width": "95%"}}></div>
</div>
</td>
<td className="py-3.5 px-4 text-center">
<span className="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-gov-green-surface text-primary font-label-sm text-label-sm font-bold">
<span className="w-1.5 h-1.5 rounded-full bg-status-verified"></span>
                Aktif
              </span>
</td>
<td className="py-3.5 px-4 text-center">
<div className="flex items-center justify-center gap-1">
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-container-high text-primary flex items-center justify-center transition-colors" title="Detail Penerima &amp; BAST">
<span className="material-symbols-outlined text-[18px]">visibility</span>
</button>
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-container-high text-status-info flex items-center justify-center transition-colors" title="Titik Koordinat PostGIS">
<span className="material-symbols-outlined text-[18px]">location_on</span>
</button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
{/* Pagination & Footer Bar */}
<div className="px-space-lg py-space-md bg-surface-container-lowest flex flex-col md:flex-row items-center justify-between gap-space-md">
{/* Showing Entries Count */}
<div className="flex items-center gap-space-md">
<span className="font-body-sm text-body-sm text-text-secondary">
          Menampilkan <strong className="text-text-primary">1-8</strong> dari <strong className="text-text-primary">2.840</strong> data penerima
        </span>
<div className="flex items-center gap-2">
<span className="font-body-sm text-body-sm text-text-tertiary">Tampilkan:</span>
<select className="h-8 px-2 bg-surface-subtle text-text-primary font-body-sm text-body-sm rounded-lg border-none focus:outline-none cursor-pointer">
<option selected value="8">8 per halaman</option>
<option value="10">10 per halaman</option>
<option value="25">25 per halaman</option>
<option value="50">50 per halaman</option>
</select>
</div>
</div>
{/* Pagination Buttons */}
<div className="flex items-center gap-1">
<button className="px-space-md py-1.5 rounded-lg bg-surface-container-low text-text-tertiary font-label-md text-label-md cursor-not-allowed flex items-center gap-1" disabled type="button">
<span className="material-symbols-outlined text-[16px]">chevron_left</span>
<span>Sebelumnya</span>
</button>
<button className="w-8 h-8 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-bold flex items-center justify-center shadow-sm" type="button">
          1
        </button>
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-dim text-text-primary font-label-md text-label-md flex items-center justify-center transition-colors" type="button">
          2
        </button>
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-dim text-text-primary font-label-md text-label-md flex items-center justify-center transition-colors" type="button">
          3
        </button>
<span className="px-2 text-text-tertiary font-body-sm text-body-sm">...</span>
<button className="w-8 h-8 rounded-lg bg-surface-subtle hover:bg-surface-dim text-text-primary font-label-md text-label-md flex items-center justify-center transition-colors" type="button">
          355
        </button>
<button className="px-space-md py-1.5 rounded-lg bg-surface-subtle hover:bg-surface-dim text-text-primary font-label-md text-label-md flex items-center gap-1 transition-colors" type="button">
<span>Selanjutnya</span>
<span className="material-symbols-outlined text-[16px]">chevron_right</span>
</button>
</div>
</div>
</div>
{/* Compliance & Legal Footer Note */}
<div className="bg-gov-green-surface rounded-xl p-space-md flex items-center gap-space-md shadow-sm">
<div className="w-10 h-10 rounded-lg bg-primary-container text-on-primary flex items-center justify-center shrink-0">
<span className="material-symbols-outlined text-[22px]">security</span>
</div>
<div className="flex flex-col">
<span className="font-label-md text-label-md text-primary font-bold">Kepatuhan UU Pelindungan Data Pribadi (UU PDP No. 27/2022)</span>
<p className="font-body-sm text-body-sm text-on-primary-fixed-variant mt-0.5">
        Data NIK, Nomor Kartu Keluarga, dan nomor telepon keluarga_penerima terlindungi menggunakan algoritma enkripsi standar AES-256 GCM. Akses visual lengkap hanya dibuka melalui mekanisme otorisasi dua langkah dan seluruh pembukaan data tercatat pada Immutable Audit Trail Dinas Pertanian Kabupaten Sumbawa.
      </p>
</div>
</div>
</div></main></div>
    </>
  );
}
  