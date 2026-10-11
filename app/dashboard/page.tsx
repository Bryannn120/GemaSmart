
export default function Dashboard() {
  return (
    <>
      <aside className="fixed left-0 top-0 h-full w-[260px] bg-primary-container text-on-primary z-50 flex flex-col justify-between shadow-[0_1px_8px_rgba(0,0,0,0.04)]"><div className="flex flex-col"><div className="px-space-lg pt-space-lg pb-space-md"><div className="flex items-center gap-space-sm"><div className="w-9 h-9 rounded-xl bg-gold-accent flex items-center justify-center text-text-primary shadow-sm"><span className="material-symbols-outlined text-[22px]">eco</span></div><div className="flex flex-col"><span className="font-headline-sm text-headline-sm text-on-primary font-bold tracking-tight leading-tight">Gema Smart Sumbawa</span><span className="font-label-sm text-label-sm text-primary-fixed-dim leading-none mt-space-xs">Dinas Pertanian Kab. Sumbawa</span></div></div><div className="mt-space-md p-space-sm rounded-xl bg-gov-green-dark/60 flex items-center gap-space-sm"><div className="w-8 h-8 rounded-full bg-primary flex items-center justify-center shrink-0"><span className="material-symbols-outlined text-on-primary text-[18px]">person</span></div><div className="flex flex-col min-w-0 flex-1"><span className="font-label-md text-label-md text-on-primary truncate font-semibold">Ir. H. Syamsuddin, M.Si</span><div className="flex items-center mt-space-xs"><span className="bg-gold-accent text-text-primary font-label-sm text-label-sm px-space-sm py-0.5 rounded-full font-bold uppercase tracking-wider">Super Admin</span></div></div></div></div><nav className="flex flex-col gap-1 px-space-sm mt-space-xs overflow-y-auto max-h-[calc(100vh-270px)]" data-active-classes="bg-gov-green-dark text-on-primary font-semibold shadow-inner"><a aria-current="page" className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg transition-colors bg-gov-green-dark text-on-primary font-semibold shadow-inner" data-path="dashboard" href="/dashboard"><span className="material-symbols-outlined text-[20px]">dashboard</span><span className="font-label-lg text-label-lg">Dashboard</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="program-bantuan" href="/program-bantuan"><span className="material-symbols-outlined text-[20px]">folder_open</span><span className="font-label-lg text-label-lg">Program Bantuan</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="kampus-mitra" href="/kampus-mitra"><span className="material-symbols-outlined text-[20px]">school</span><span className="font-label-lg text-label-lg">Kampus Mitra</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="data-penerima" href="/data-penerima"><span className="material-symbols-outlined text-[20px]">group</span><span className="font-label-lg text-label-lg">Data Penerima</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="penyaluran-bibit" href="/penyaluran-bibit"><span className="material-symbols-outlined text-[20px]">potted_plant</span><span className="font-label-lg text-label-lg">Penyaluran Bibit</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="monitoring" href="/monitoring"><span className="material-symbols-outlined text-[20px]">assignment_turned_in</span><span className="font-label-lg text-label-lg">Monitoring</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="validasi-lapangan" href="/validasi-lapangan"><span className="material-symbols-outlined text-[20px]">verified_user</span><span className="font-label-lg text-label-lg">Validasi Lapangan</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="laporan" href="/laporan"><span className="material-symbols-outlined text-[20px]">description</span><span className="font-label-lg text-label-lg">Laporan</span></a><div className="flex flex-col gap-1"><a className="flex items-center justify-between px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="master-data" href="/master-data"><div className="flex items-center gap-space-sm"><span className="material-symbols-outlined text-[20px]">database</span><span className="font-label-lg text-label-lg">Master Data</span></div><span className="material-symbols-outlined text-[16px]">expand_more</span></a><div className="pl-8 flex flex-col gap-1"><a className="px-space-md py-space-xs rounded-lg text-primary-fixed-dim font-label-md text-label-md hover:bg-gov-green-dark/50 hover:text-on-primary transition-colors" data-path="master-data-wilayah" href="/master-data-wilayah">Wilayah</a><a className="px-space-md py-space-xs rounded-lg text-primary-fixed-dim font-label-md text-label-md hover:bg-gov-green-dark/50 hover:text-on-primary transition-colors" data-path="master-data-jenis-bibit" href="/master-data-jenis-bibit">Jenis Bibit</a></div></div><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="audit-log" href="/audit-log"><span className="material-symbols-outlined text-[20px]">receipt_long</span><span className="font-label-lg text-label-lg">Audit Log</span></a><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors" data-path="pengaturan" href="/pengaturan"><span className="material-symbols-outlined text-[20px]">settings</span><span className="font-label-lg text-label-lg">Pengaturan</span></a></nav></div><div className="p-space-md bg-gov-green-dark/40 flex flex-col gap-space-sm"><a className="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-error-container hover:bg-error/20 hover:text-on-primary transition-colors" data-path="login" href="/login"><span className="material-symbols-outlined text-[20px]">logout</span><span className="font-label-lg text-label-lg font-semibold">Keluar</span></a><div className="flex items-center justify-between px-space-xs pt-space-xs border-t border-white/10"><span className="font-label-sm text-label-sm text-primary-fixed-dim">Gema Smart Enterprise</span><span className="font-label-sm text-label-sm text-gold-accent font-semibold">v2.0</span></div></div></aside><div className="pl-[260px]"><header className="fixed top-0 left-[260px] right-0 h-16 bg-canvas-bg/95 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-40 flex items-center justify-between px-6"><div className="flex items-center gap-space-md"><div className="flex items-center gap-space-xs text-text-secondary font-label-md text-label-md"><span className="material-symbols-outlined text-[18px]">home</span><span>Beranda</span><span className="material-symbols-outlined text-[14px]">chevron_right</span><span className="text-text-primary font-semibold">Dashboard Eksekutif</span></div><span className="bg-gold-surface text-secondary font-label-sm text-label-sm px-space-sm py-0.5 rounded-full font-bold border border-gold-accent/40">TA 2026</span></div><div className="flex items-center gap-space-md"><div className="hidden md:flex items-center gap-space-xs bg-status-verified-surface text-primary px-space-md py-1 rounded-full font-label-sm text-label-sm font-semibold"><span className="w-2 h-2 rounded-full bg-status-verified animate-pulse"></span><span>Server Aktif: Sumbawa-Node-01</span></div><button aria-label="Notifikasi" className="relative p-space-sm rounded-lg text-text-secondary hover:bg-surface-subtle hover:text-text-primary transition-colors"><span className="material-symbols-outlined text-[22px]">notifications</span><span className="absolute top-1.5 right-1.5 w-4 h-4 rounded-full bg-error text-on-error font-label-sm text-label-sm flex items-center justify-center font-bold text-[10px]">3</span></button><div className="h-6 w-px bg-border-medium hidden sm:block"></div><div className="flex items-center gap-space-sm cursor-pointer"><div className="w-8 h-8 rounded-full bg-primary flex items-center justify-center"><span className="material-symbols-outlined text-on-primary text-[18px]">person</span></div><span className="material-symbols-outlined text-text-secondary text-[20px]">keyboard_arrow_down</span></div></div></header><main className="relative pt-16 bg-surface-muted min-h-screen p-6"><div className="flex flex-col w-full gap-space-xl">
{/* Top Command & Action Bar */}
<div className="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
<div className="flex flex-col max-w-2xl">
<div className="flex items-center gap-space-sm mb-space-xs">
<span className="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
<span className="material-symbols-outlined text-[14px] mr-1">check_circle</span>
          SINKRONISASI REAL-TIME
        </span>
<span className="text-text-tertiary text-body-sm font-body-sm">Pembaruan: Hari ini, 09:42 WITA</span>
</div>
<h1 className="font-headline-xl text-headline-xl text-text-primary tracking-tight">Dashboard Monitoring Penyaluran Bibit</h1>
<p className="font-body-md text-text-secondary mt-1">
        Monitoring real-time distribusi bibit pertanian, progres konversi SPJ, dan tingkat kelangsungan hidup (survival rate) se-Kabupaten Sumbawa.
      </p>
</div>
{/* Controls */}
<div className="flex flex-wrap items-center gap-space-sm">
<div className="relative bg-canvas-bg rounded-xl shadow-sm">
<select className="appearance-none font-label-md text-label-md text-text-primary bg-transparent pl-space-md pr-8 py-2 rounded-xl cursor-pointer focus:outline-none focus:bg-surface-subtle">
<option>Tahun Anggaran 2026</option>
<option>Tahun Anggaran 2025</option>
<option>Tahun Anggaran 2024</option>
</select>
<span className="material-symbols-outlined absolute right-2 top-2.5 text-text-secondary text-[18px] pointer-events-none">expand_more</span>
</div>
<div className="relative bg-canvas-bg rounded-xl shadow-sm">
<select className="appearance-none font-label-md text-label-md text-text-primary bg-transparent pl-space-md pr-8 py-2 rounded-xl cursor-pointer focus:outline-none focus:bg-surface-subtle">
<option>Semua Kecamatan (24)</option>
<option>Kecamatan Sumbawa</option>
<option>Kecamatan Moyo Hilir</option>
<option>Kecamatan Moyo Utara</option>
<option>Kecamatan Alas</option>
<option>Kecamatan Utan</option>
<option>Kecamatan Labuhan Badas</option>
<option>Kecamatan Plampang</option>
<option>Kecamatan Empang</option>
</select>
<span className="material-symbols-outlined absolute right-2 top-2.5 text-text-secondary text-[18px] pointer-events-none">expand_more</span>
</div>
<button className="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
<span className="material-symbols-outlined text-[18px]">download</span>
<span>Unduh Ringkasan PDF</span>
</button>
</div>
</div>
{/* KPI Cards Grid (4 Columns) */}
<div className="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-space-lg">
{/* Card 1 */}
<div className="bg-canvas-bg rounded-xl p-space-lg shadow-sm flex flex-col justify-between relative overflow-hidden">
<div className="flex items-start justify-between">
<div className="w-10 h-10 rounded-xl bg-status-verified-surface flex items-center justify-center text-primary">
<span className="material-symbols-outlined text-[24px]">account_balance_wallet</span>
</div>
<span className="inline-flex items-center gap-0.5 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
<span className="material-symbols-outlined text-[14px]">trending_up</span>
          +12.5% vs TA 2025
        </span>
</div>
<div className="mt-space-md">
<span className="font-label-md text-label-md text-text-secondary block">Total Pagu Anggaran Bantuan</span>
<span className="font-headline-xl text-headline-xl text-text-primary font-bold tracking-tight block mt-1">Rp 4.850.000.000</span>
</div>
<div className="mt-space-md pt-space-sm bg-surface-subtle -mx-space-lg -mb-space-lg p-space-md">
<div className="flex justify-between items-center text-text-secondary font-body-sm text-body-sm">
<span>Realisasi SPJ: <strong className="text-text-primary font-semibold">78.4%</strong></span>
<span className="font-code-dense text-code-dense text-text-primary font-medium">Rp 3.802.400.000</span>
</div>
<div className="w-full bg-surface-container rounded-full h-1.5 mt-2 overflow-hidden">
<div className="bg-primary-container h-1.5 rounded-full" style={{"width": "78.4%"}}></div>
</div>
</div>
</div>
{/* Card 2 */}
<div className="bg-canvas-bg rounded-xl p-space-lg shadow-sm flex flex-col justify-between relative overflow-hidden">
<div className="flex items-start justify-between">
<div className="w-10 h-10 rounded-xl bg-gold-surface flex items-center justify-center text-secondary">
<span className="material-symbols-outlined text-[24px]">groups</span>
</div>
<span className="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
          On Track
        </span>
</div>
<div className="mt-space-md">
<span className="font-label-md text-label-md text-text-secondary block">Bibit Tersalurkan (KK)</span>
<span className="font-headline-xl text-headline-xl text-text-primary font-bold tracking-tight block mt-1">14.280 KK</span>
</div>
<div className="mt-space-md pt-space-sm bg-surface-subtle -mx-space-lg -mb-space-lg p-space-md">
<div className="flex justify-between items-center text-text-secondary font-body-sm text-body-sm">
<span>Target: 18.000 KK</span>
<span>Capaian: <strong className="text-text-primary font-semibold">79.3%</strong></span>
</div>
<div className="w-full bg-surface-container rounded-full h-1.5 mt-2 overflow-hidden">
<div className="bg-secondary-container h-1.5 rounded-full" style={{"width": "79.3%"}}></div>
</div>
</div>
</div>
{/* Card 3 */}
<div className="bg-canvas-bg rounded-xl p-space-lg shadow-sm flex flex-col justify-between relative overflow-hidden">
<div className="flex items-start justify-between">
<div className="w-10 h-10 rounded-xl bg-status-verified-surface flex items-center justify-center text-status-verified">
<span className="material-symbols-outlined text-[24px]">potted_plant</span>
</div>
<span className="inline-flex items-center gap-1 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-status-verified font-bold">
<span className="material-symbols-outlined text-[13px]">eco</span>
          Sehat & Tumbuh
        </span>
</div>
<div className="mt-space-md">
<span className="font-label-md text-label-md text-text-secondary block">Survival Rate (Bulan ke-3)</span>
<div className="flex items-baseline gap-2 mt-1">
<span className="font-headline-xl text-headline-xl text-text-primary font-bold tracking-tight">84.2%</span>
<span className="font-label-sm text-label-sm text-status-verified font-semibold">+14.2% di atas target</span>
</div>
</div>
<div className="mt-space-md pt-space-sm bg-surface-subtle -mx-space-lg -mb-space-lg p-space-md">
<div className="flex justify-between items-center text-text-secondary font-body-sm text-body-sm">
<span>Target min: 70.0%</span>
<span><strong className="text-text-primary font-semibold">42.150</strong> bibit dipantau</span>
</div>
<div className="w-full bg-surface-container rounded-full h-1.5 mt-2 overflow-hidden">
<div className="bg-status-verified h-1.5 rounded-full" style={{"width": "84.2%"}}></div>
</div>
</div>
</div>
{/* Card 4 */}
<div className="bg-canvas-bg rounded-xl p-space-lg shadow-sm flex flex-col justify-between relative overflow-hidden">
<div className="flex items-start justify-between">
<div className="w-10 h-10 rounded-xl bg-status-info-surface flex items-center justify-center text-status-info">
<span className="material-symbols-outlined text-[24px]">verified</span>
</div>
<span className="inline-flex items-center gap-1 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-warning-surface text-secondary font-bold">
<span className="w-1.5 h-1.5 rounded-full bg-status-warning"></span>
          14 Verifikasi Pending
        </span>
</div>
<div className="mt-space-md">
<span className="font-label-md text-label-md text-text-secondary block">Uji Petik & Validasi Lapangan</span>
<span className="font-headline-xl text-headline-xl text-text-primary font-bold tracking-tight block mt-1">1.512 / 1.428</span>
</div>
<div className="mt-space-md pt-space-sm bg-surface-subtle -mx-space-lg -mb-space-lg p-space-md">
<div className="flex justify-between items-center text-text-secondary font-body-sm text-body-sm">
<span>Target audit: â‰¥10%</span>
<span className="text-error font-semibold flex items-center gap-1">
<span className="material-symbols-outlined text-[13px]">gavel</span>
            2 Kasus Fraud
          </span>
</div>
<div className="w-full bg-surface-container rounded-full h-1.5 mt-2 overflow-hidden">
<div className="bg-status-info h-1.5 rounded-full" style={{"width": "100%"}}></div>
</div>
</div>
</div>
</div>
{/* Analytical Section: 2 Columns (7 cols : 5 cols) */}
<div className="grid grid-cols-1 lg:grid-cols-12 gap-space-lg">
{/* Left Column (7 cols): Map & Regional Cluster Breakdown */}
<div className="lg:col-span-7 flex flex-col gap-space-lg">
<div className="bg-canvas-bg rounded-xl shadow-sm p-space-lg flex flex-col">
<div className="flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm pb-space-md">
<div className="flex items-center gap-space-sm">
<div className="w-8 h-8 rounded-lg bg-surface-muted flex items-center justify-center text-primary-container">
<span className="material-symbols-outlined text-[20px]">map</span>
</div>
<div>
<h2 className="font-headline-sm text-headline-sm text-text-primary font-bold">Peta Sebaran & Distribusi Kecamatan</h2>
<span className="font-body-sm text-body-sm text-text-secondary">Monitoring geolokasi penyaluran bibit & survival rate 24 kecamatan</span>
</div>
</div>
<div className="flex items-center gap-2">
<span className="inline-flex items-center gap-1 font-label-sm text-label-sm text-text-secondary">
<span className="w-2.5 h-2.5 rounded-full bg-status-verified"></span> Aman (&gt;80%)
            </span>
<span className="inline-flex items-center gap-1 font-label-sm text-label-sm text-text-secondary">
<span className="w-2.5 h-2.5 rounded-full bg-status-warning"></span> Perhatian
            </span>
<span className="inline-flex items-center gap-1 font-label-sm text-label-sm text-text-secondary">
<span className="w-2.5 h-2.5 rounded-full bg-error"></span> Anomali
            </span>
</div>
</div>
{/* Interactive GIS Visual Map Canvas */}
<div className="relative w-full h-72 rounded-xl overflow-hidden bg-surface-muted flex items-center justify-center shadow-inner">
<div className="w-full h-full bg-cover bg-center" data-location="Kabupaten Sumbawa, NTB, Indonesia" style={{"backgroundImage": "url('https"}}></div>
{/* Overlay Administrative Pins */}
<div className="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-black/10 pointer-events-none"></div>
{/* Pinned locations */}
<div className="absolute top-1/4 left-1/3 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-105 transition-transform">
<span className="w-2 h-2 rounded-full bg-status-verified animate-ping"></span>
<span className="font-label-sm text-label-sm font-bold text-text-primary">Sumbawa Kota (92%)</span>
</div>
<div className="absolute top-1/2 left-1/4 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-105 transition-transform">
<span className="w-2 h-2 rounded-full bg-status-verified"></span>
<span className="font-label-sm text-label-sm font-bold text-text-primary">Utan (78%)</span>
</div>
<div className="absolute top-1/3 right-1/4 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-105 transition-transform">
<span className="w-2 h-2 rounded-full bg-status-warning"></span>
<span className="font-label-sm text-label-sm font-bold text-text-primary">Plampang (64%)</span>
</div>
<div className="absolute bottom-1/4 right-1/3 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-105 transition-transform">
<span className="w-2 h-2 rounded-full bg-status-verified"></span>
<span className="font-label-sm text-label-sm font-bold text-text-primary">Empang (88%)</span>
</div>
<div className="absolute top-16 right-12 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-105 transition-transform">
<span className="w-2 h-2 rounded-full bg-error"></span>
<span className="font-label-sm text-label-sm font-bold text-error">Lab. Burung (46.2%)</span>
</div>
{/* Bottom map controls */}
<div className="absolute bottom-3 left-3 bg-canvas-bg/90 backdrop-blur-md px-3 py-1.5 rounded-lg shadow flex items-center gap-3 text-text-secondary font-label-sm text-label-sm">
<span className="flex items-center gap-1"><span className="material-symbols-outlined text-[14px]">satellite_alt</span> Citra Satelit</span>
<span className="h-3 w-px bg-border-medium"></span>
<span>24 Titik Pantau Aktif</span>
</div>
</div>
{/* Top Distribution Clusters Table */}
<div className="mt-space-md">
<div className="flex items-center justify-between mb-space-sm">
<span className="font-label-lg text-label-lg text-text-primary">Kluster Wilayah Prioritas Penyaluran</span>
<a className="text-primary font-label-sm text-label-sm hover:underline font-semibold flex items-center" href="#">
              Lihat 24 Kecamatan
              <span className="material-symbols-outlined text-[14px]">arrow_forward</span>
</a>
</div>
<div className="overflow-x-auto">
<table className="w-full text-left font-body-sm text-body-sm">
<thead className="bg-surface-subtle text-text-secondary font-label-md text-label-md">
<tr>
<th className="py-2.5 px-3">Kecamatan</th>
<th className="py-2.5 px-3">Alokasi KK</th>
<th className="py-2.5 px-3">Bibit Terkirim</th>
<th className="py-2.5 px-3">Survival Rate</th>
<th className="py-2.5 px-3">Status Evaluasi</th>
</tr>
</thead>
<tbody className="divide-y divide-surface-muted font-body-md text-body-md">
<tr className="hover:bg-surface-subtle/70 transition-colors">
<td className="py-3 px-3 font-semibold text-text-primary flex items-center gap-2">
<span className="material-symbols-outlined text-primary-container text-[18px]">location_on</span>
                    Kecamatan Sumbawa
                  </td>
<td className="py-3 px-3 font-code-dense text-code-dense">1.450 KK</td>
<td className="py-3 px-3">
<span className="font-semibold text-text-primary">1.410 KK</span>
<span className="text-text-tertiary font-body-sm text-body-sm block">97.2%</span>
</td>
<td className="py-3 px-3 font-semibold text-status-verified">92.4%</td>
<td className="py-3 px-3">
<span className="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
                      Aman
                    </span>
</td>
</tr>
<tr className="hover:bg-surface-subtle/70 transition-colors">
<td className="py-3 px-3 font-semibold text-text-primary flex items-center gap-2">
<span className="material-symbols-outlined text-primary-container text-[18px]">location_on</span>
                    Kecamatan Moyo Hilir
                  </td>
<td className="py-3 px-3 font-code-dense text-code-dense">1.200 KK</td>
<td className="py-3 px-3">
<span className="font-semibold text-text-primary">1.150 KK</span>
<span className="text-text-tertiary font-body-sm text-body-sm block">95.8%</span>
</td>
<td className="py-3 px-3 font-semibold text-status-verified">86.1%</td>
<td className="py-3 px-3">
<span className="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
                      Aman
                    </span>
</td>
</tr>
<tr className="hover:bg-surface-subtle/70 transition-colors">
<td className="py-3 px-3 font-semibold text-text-primary flex items-center gap-2">
<span className="material-symbols-outlined text-primary-container text-[18px]">location_on</span>
                    Kecamatan Moyo Utara
                  </td>
<td className="py-3 px-3 font-code-dense text-code-dense">980 KK</td>
<td className="py-3 px-3">
<span className="font-semibold text-text-primary">890 KK</span>
<span className="text-text-tertiary font-body-sm text-body-sm block">90.8%</span>
</td>
<td className="py-3 px-3 font-semibold text-secondary">78.5%</td>
<td className="py-3 px-3">
<span className="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-warning-surface text-secondary font-bold">
                      Perhatian
                    </span>
</td>
</tr>
<tr className="hover:bg-surface-subtle/70 transition-colors">
<td className="py-3 px-3 font-semibold text-text-primary flex items-center gap-2">
<span className="material-symbols-outlined text-primary-container text-[18px]">location_on</span>
                    Kecamatan Utan
                  </td>
<td className="py-3 px-3 font-code-dense text-code-dense">1.100 KK</td>
<td className="py-3 px-3">
<span className="font-semibold text-text-primary">820 KK</span>
<span className="text-text-tertiary font-body-sm text-body-sm block">74.5%</span>
</td>
<td className="py-3 px-3 font-semibold text-error">46.2%</td>
<td className="py-3 px-3">
<span className="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-fraud-surface text-error font-bold">
                      Anomali
                    </span>
</td>
</tr>
<tr className="hover:bg-surface-subtle/70 transition-colors">
<td className="py-3 px-3 font-semibold text-text-primary flex items-center gap-2">
<span className="material-symbols-outlined text-primary-container text-[18px]">location_on</span>
                    Kecamatan Plampang
                  </td>
<td className="py-3 px-3 font-code-dense text-code-dense">1.050 KK</td>
<td className="py-3 px-3">
<span className="font-semibold text-text-primary">690 KK</span>
<span className="text-text-tertiary font-body-sm text-body-sm block">65.7%</span>
</td>
<td className="py-3 px-3 font-semibold text-secondary">64.0%</td>
<td className="py-3 px-3">
<span className="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-warning-surface text-secondary font-bold">
                      Perhatian
                    </span>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
{/* Right Column (5 cols): Alerts & Seed Composition */}
<div className="lg:col-span-5 flex flex-col gap-space-lg">
{/* FR-24 Alerts Card */}
<div className="bg-canvas-bg rounded-xl shadow-sm p-space-lg flex flex-col">
<div className="flex items-center justify-between pb-space-md">
<div className="flex items-center gap-space-sm">
<div className="w-8 h-8 rounded-lg bg-status-fraud-surface flex items-center justify-center text-error">
<span className="material-symbols-outlined text-[20px]">warning</span>
</div>
<div>
<h2 className="font-headline-sm text-headline-sm text-text-primary font-bold">Alert Sistem & Prioritas</h2>
<span className="font-body-sm text-body-sm text-text-secondary">Kepatuhan protokol tata kelola bantuan (FR-24)</span>
</div>
</div>
<span className="font-label-sm text-label-sm px-space-sm py-0.5 rounded-full bg-status-fraud-surface text-error font-bold">3 Kasus</span>
</div>
<div className="flex flex-col gap-space-md">
{/* Alert 1 (Merah/Danger) */}
<div className="p-space-md rounded-xl bg-status-fraud-surface/60 flex items-start gap-space-sm hover:bg-status-fraud-surface transition-colors">
<span className="material-symbols-outlined text-error text-[20px] shrink-0 mt-0.5">error</span>
<div className="flex flex-col flex-1">
<div className="flex items-center justify-between">
<span className="font-label-md text-label-md text-error font-bold uppercase tracking-wider">Anomali Survival Rendah</span>
<span className="font-label-sm text-label-sm text-text-secondary">Hari Ini</span>
</div>
<p className="font-body-sm text-body-sm text-text-primary mt-1">
<strong>Desa Labuhan Burung (Utan):</strong> Survival rate <strong>46.2%</strong> (&lt;50%) akibat serangan hama wereng. Dibutuhkan penyuluhan & penanganan darurat POPT.
              </p>
<div className="mt-2 flex items-center gap-2">
<button className="px-2 py-1 bg-error text-on-error rounded font-label-sm text-label-sm font-bold hover:bg-error/90 transition-colors">
                  Tugaskan PPL
                </button>
<button className="px-2 py-1 bg-canvas-bg text-text-primary rounded font-label-sm text-label-sm font-semibold hover:bg-surface-subtle transition-colors">
                  Buka Berkas
                </button>
</div>
</div>
</div>
{/* Alert 2 (Oranye/Warning) */}
<div className="p-space-md rounded-xl bg-status-warning-surface/60 flex items-start gap-space-sm hover:bg-status-warning-surface transition-colors">
<span className="material-symbols-outlined text-status-warning text-[20px] shrink-0 mt-0.5">warning</span>
<div className="flex flex-col flex-1">
<div className="flex items-center justify-between">
<span className="font-label-md text-label-md text-secondary font-bold uppercase tracking-wider">Gap Penyerapan & Distribusi</span>
<span className="font-label-sm text-label-sm text-text-secondary">Kemarin</span>
</div>
<p className="font-body-sm text-body-sm text-text-primary mt-1">
<strong>Kampus Mitra B (UNSA):</strong> Penyerapan dana <strong>82.0%</strong> namun penyaluran fisik baru mencapai <strong>44.1%</strong>. Memerlukan rekonsiliasi SPJ fisik.
              </p>
<div className="mt-2 flex items-center gap-2">
<button className="px-2 py-1 bg-secondary text-on-secondary rounded font-label-sm text-label-sm font-bold hover:bg-secondary/90 transition-colors">
                  Kirim Notifikasi SPJ
                </button>
</div>
</div>
</div>
{/* Alert 3 (Kuning/Info) */}
<div className="p-space-md rounded-xl bg-status-info-surface/60 flex items-start gap-space-sm hover:bg-status-info-surface transition-colors">
<span className="material-symbols-outlined text-status-info text-[20px] shrink-0 mt-0.5">hourglass_empty</span>
<div className="flex flex-col flex-1">
<div className="flex items-center justify-between">
<span className="font-label-md text-label-md text-status-info font-bold uppercase tracking-wider">Audit Tertunda (&gt;14 Hari)</span>
<span className="font-label-sm text-label-sm text-text-secondary">2 Hari Lalu</span>
</div>
<p className="font-body-sm text-body-sm text-text-primary mt-1">
<strong>Kecamatan Plampang:</strong> 18 serah terima bibit &gt;14 hari belum dilakukan uji petik sampling oleh tim pendamping lapangan.
              </p>
<div className="mt-2 flex items-center gap-2">
<button className="px-2 py-1 bg-status-info text-on-primary rounded font-label-sm text-label-sm font-bold hover:bg-status-info/90 transition-colors">
                  Jadwalkan Uji Petik
                </button>
</div>
</div>
</div>
</div>
</div>
{/* Seed Composition Progress */}
<div className="bg-canvas-bg rounded-xl shadow-sm p-space-lg flex flex-col justify-between">
<div>
<div className="flex items-center justify-between pb-space-sm">
<div className="flex items-center gap-space-sm">
<div className="w-8 h-8 rounded-lg bg-surface-muted flex items-center justify-center text-primary-container">
<span className="material-symbols-outlined text-[20px]">pie_chart</span>
</div>
<div>
<h2 className="font-headline-sm text-headline-sm text-text-primary font-bold">Komposisi Bibit Tersalurkan</h2>
<span className="font-body-sm text-body-sm text-text-secondary">Berdasarkan komoditas unggulan TA 2026</span>
</div>
</div>
<span className="font-label-md text-label-md font-bold text-text-primary">14.280 KK</span>
</div>
<div className="flex flex-col gap-space-md mt-space-md">
{/* Jagung Hibrida */}
<div className="flex flex-col gap-1">
<div className="flex justify-between items-center">
<span className="font-label-md text-label-md font-semibold text-text-primary flex items-center gap-1.5">
<span className="w-2.5 h-2.5 rounded-full bg-gold-accent"></span>
                  Jagung Hibrida (Bisi-18 / Pioneer)
                </span>
<span className="font-label-md text-label-md font-bold text-text-primary">45% <span className="text-text-secondary font-normal font-body-sm text-body-sm">(6.426 KK)</span></span>
</div>
<div className="w-full bg-surface-container rounded-full h-2 overflow-hidden">
<div className="bg-gold-accent h-2 rounded-full" style={{"width": "45%"}}></div>
</div>
</div>
{/* Bibit Padi Ciherang */}
<div className="flex flex-col gap-1">
<div className="flex justify-between items-center">
<span className="font-label-md text-label-md font-semibold text-text-primary flex items-center gap-1.5">
<span className="w-2.5 h-2.5 rounded-full bg-primary-container"></span>
                  Bibit Padi Ciherang & Inpari 32
                </span>
<span className="font-label-md text-label-md font-bold text-text-primary">30% <span className="text-text-secondary font-normal font-body-sm text-body-sm">(4.284 KK)</span></span>
</div>
<div className="w-full bg-surface-container rounded-full h-2 overflow-hidden">
<div className="bg-primary-container h-2 rounded-full" style={{"width": "30%"}}></div>
</div>
</div>
{/* Kopi Robusta */}
<div className="flex flex-col gap-1">
<div className="flex justify-between items-center">
<span className="font-label-md text-label-md font-semibold text-text-primary flex items-center gap-1.5">
<span className="w-2.5 h-2.5 rounded-full bg-secondary"></span>
                  Kopi Robusta Batulanteh
                </span>
<span className="font-label-md text-label-md font-bold text-text-primary">15% <span className="text-text-secondary font-normal font-body-sm text-body-sm">(2.142 KK)</span></span>
</div>
<div className="w-full bg-surface-container rounded-full h-2 overflow-hidden">
<div className="bg-secondary h-2 rounded-full" style={{"width": "15%"}}></div>
</div>
</div>
{/* Hortikultura Cabe/Bawang */}
<div className="flex flex-col gap-1">
<div className="flex justify-between items-center">
<span className="font-label-md text-label-md font-semibold text-text-primary flex items-center gap-1.5">
<span className="w-2.5 h-2.5 rounded-full bg-status-info"></span>
                  Hortikultura (Cabe Rawit & Bawang Merah)
                </span>
<span className="font-label-md text-label-md font-bold text-text-primary">10% <span className="text-text-secondary font-normal font-body-sm text-body-sm">(1.428 KK)</span></span>
</div>
<div className="w-full bg-surface-container rounded-full h-2 overflow-hidden">
<div className="bg-status-info h-2 rounded-full" style={{"width": "10%"}}></div>
</div>
</div>
</div>
</div>
<div className="mt-space-lg pt-space-md bg-surface-subtle -mx-space-lg -mb-space-lg p-space-md rounded-b-xl flex items-center justify-between text-text-secondary font-body-sm text-body-sm">
<span className="flex items-center gap-1">
<span className="material-symbols-outlined text-[16px] text-primary">verified_user</span>
            Sertifikasi Balai Pengawasan & Sertifikasi Benih (BPSB)
          </span>
<span className="font-semibold text-text-primary">100% Terverifikasi</span>
</div>
</div>
</div>
</div>
{/* Bottom Section: Live Activity & Field Audit Log */}
<div className="bg-canvas-bg rounded-xl shadow-sm p-space-lg flex flex-col">
<div className="flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm pb-space-md">
<div className="flex items-center gap-space-sm">
<div className="w-8 h-8 rounded-lg bg-surface-muted flex items-center justify-center text-primary-container">
<span className="material-symbols-outlined text-[20px]">assignment_turned_in</span>
</div>
<div>
<h2 className="font-headline-sm text-headline-sm text-text-primary font-bold">Aktivitas Terkini & Log Audit Lapangan</h2>
<span className="font-body-sm text-body-sm text-text-secondary">Riwayat entri validasi berkas, geotagging, dan peninjauan fisik lapangan</span>
</div>
</div>
<div className="flex items-center gap-space-sm">
<div className="relative">
<input className="font-body-sm text-body-sm pl-8 pr-3 py-1.5 rounded-lg bg-surface-subtle text-text-primary focus:outline-none focus:bg-canvas-bg shadow-sm w-52 sm:w-64" placeholder="Cari NIK / Petugas / Desa..." type="text"/>
<span className="material-symbols-outlined absolute left-2 top-2 text-text-secondary text-[16px]">search</span>
</div>
<button className="p-1.5 bg-surface-subtle text-text-secondary rounded-lg hover:text-text-primary hover:bg-surface-muted transition-colors" title="Filter Riwayat">
<span className="material-symbols-outlined text-[20px]">tune</span>
</button>
</div>
</div>
<div className="overflow-x-auto">
<table className="w-full text-left font-body-sm text-body-sm">
<thead className="bg-surface-subtle text-text-secondary font-label-md text-label-md">
<tr>
<th className="py-3 px-4">Waktu</th>
<th className="py-3 px-4">Pendamping / Petugas</th>
<th className="py-3 px-4">Kegiatan</th>
<th className="py-3 px-4">Wilayah</th>
<th className="py-3 px-4">Status Verifikasi</th>
<th className="py-3 px-4 text-right">Aksi</th>
</tr>
</thead>
<tbody className="divide-y divide-surface-muted font-body-md text-body-md">
{/* Row 1 */}
<tr className="hover:bg-surface-subtle/80 transition-colors">
<td className="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary whitespace-nowrap">
              09:38 WITA <span className="block text-[11px] text-text-tertiary">26 Feb 2026</span>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-2">
<div className="w-7 h-7 rounded-full bg-gov-green-surface text-primary flex items-center justify-center font-bold text-xs">
                  FA
                </div>
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Fajar Maulana, S.P.</span>
<span className="text-text-tertiary font-body-sm text-body-sm">PPL Wilbin Alas</span>
</div>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-1.5 text-text-primary">
<span className="material-symbols-outlined text-primary text-[18px]">photo_camera</span>
<span>Upload Foto Geotagging Penanaman (5 KK)</span>
</div>
<span className="text-text-secondary font-code-dense text-[11px] block">Lat: -8.5124, Long: 117.0211</span>
</td>
<td className="py-3.5 px-4 text-text-primary">
<span className="font-medium">Desa Luar</span>
<span className="text-text-secondary font-body-sm text-body-sm block">Kec. Alas</span>
</td>
<td className="py-3.5 px-4">
<span className="inline-flex items-center gap-1 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
<span className="material-symbols-outlined text-[13px]">verified_user</span>
                Geotag Verified
              </span>
</td>
<td className="py-3.5 px-4 text-right whitespace-nowrap">
<button className="px-2.5 py-1 text-primary hover:bg-gov-green-surface rounded-lg font-label-sm text-label-sm font-semibold transition-colors">
                Detail
              </button>
</td>
</tr>
{/* Row 2 */}
<tr className="hover:bg-surface-subtle/80 transition-colors">
<td className="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary whitespace-nowrap">
              09:15 WITA <span className="block text-[11px] text-text-tertiary">26 Feb 2026</span>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-2">
<div className="w-7 h-7 rounded-full bg-gold-surface text-secondary flex items-center justify-center font-bold text-xs">
                  RN
                </div>
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Rian Nurdin</span>
<span className="text-text-tertiary font-body-sm text-body-sm">Fasilitator UNSA</span>
</div>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-1.5 text-text-primary">
<span className="material-symbols-outlined text-secondary text-[18px]">draw</span>
<span>BAST Elektronik & Tanda Tangan Penerima</span>
</div>
<span className="text-text-secondary font-code-dense text-[11px] block">NIK: 520412******0004 (A. Karim)</span>
</td>
<td className="py-3.5 px-4 text-text-primary">
<span className="font-medium">Desa Baru</span>
<span className="text-text-secondary font-body-sm text-body-sm block">Kec. Moyo Utara</span>
</td>
<td className="py-3.5 px-4">
<span className="inline-flex items-center gap-1 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
<span className="material-symbols-outlined text-[13px]">check_circle</span>
                e-Sign Sah
              </span>
</td>
<td className="py-3.5 px-4 text-right whitespace-nowrap">
<button className="px-2.5 py-1 text-primary hover:bg-gov-green-surface rounded-lg font-label-sm text-label-sm font-semibold transition-colors">
                Detail
              </button>
</td>
</tr>
{/* Row 3 */}
<tr className="hover:bg-surface-subtle/80 transition-colors">
<td className="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary whitespace-nowrap">
              08:45 WITA <span className="block text-[11px] text-text-tertiary">26 Feb 2026</span>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-2">
<div className="w-7 h-7 rounded-full bg-status-info-surface text-status-info flex items-center justify-center font-bold text-xs">
                  HS
                </div>
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Hendri Setiawan, S.ST</span>
<span className="text-text-tertiary font-body-sm text-body-sm">Auditor Dispertan</span>
</div>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-1.5 text-text-primary">
<span className="material-symbols-outlined text-status-info text-[18px]">fact_check</span>
<span>Uji Petik Fisik Sampling Lapangan (10%)</span>
</div>
<span className="text-text-secondary font-code-dense text-[11px] block">Survival Rate Realita: 89.2%</span>
</td>
<td className="py-3.5 px-4 text-text-primary">
<span className="font-medium">Desa Kerato</span>
<span className="text-text-secondary font-body-sm text-body-sm block">Kec. Unter Iwes</span>
</td>
<td className="py-3.5 px-4">
<span className="inline-flex items-center gap-1 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-info-surface text-status-info font-bold">
<span className="material-symbols-outlined text-[13px]">rule</span>
                Sesuai Spesifikasi
              </span>
</td>
<td className="py-3.5 px-4 text-right whitespace-nowrap">
<button className="px-2.5 py-1 text-primary hover:bg-gov-green-surface rounded-lg font-label-sm text-label-sm font-semibold transition-colors">
                Detail
              </button>
</td>
</tr>
{/* Row 4 */}
<tr className="hover:bg-surface-subtle/80 transition-colors">
<td className="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary whitespace-nowrap">
              08:12 WITA <span className="block text-[11px] text-text-tertiary">26 Feb 2026</span>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-2">
<div className="w-7 h-7 rounded-full bg-status-fraud-surface text-error flex items-center justify-center font-bold text-xs">
                  DK
                </div>
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Dina Kartika</span>
<span className="text-text-tertiary font-body-sm text-body-sm">Admin Verifikasi Data</span>
</div>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-1.5 text-text-primary">
<span className="material-symbols-outlined text-error text-[18px]">badge</span>
<span>Pengecekan NIK Ganda (Dukcapil Sumbawa)</span>
</div>
<span className="text-error font-body-sm text-[11px] block font-semibold">Duplikasi Terdeteksi: 1 NIK 2 Poktan</span>
</td>
<td className="py-3.5 px-4 text-text-primary">
<span className="font-medium">Desa Labuhan Burung</span>
<span className="text-text-secondary font-body-sm text-body-sm block">Kec. Utan</span>
</td>
<td className="py-3.5 px-4">
<span className="inline-flex items-center gap-1 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-fraud-surface text-error font-bold">
<span className="material-symbols-outlined text-[13px]">gavel</span>
                Ditolak Sistem
              </span>
</td>
<td className="py-3.5 px-4 text-right whitespace-nowrap">
<button className="px-2.5 py-1 text-error hover:bg-status-fraud-surface rounded-lg font-label-sm text-label-sm font-semibold transition-colors">
                Investigasi
              </button>
</td>
</tr>
{/* Row 5 */}
<tr className="hover:bg-surface-subtle/80 transition-colors">
<td className="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary whitespace-nowrap">
              Kemarin, 16:40 <span className="block text-[11px] text-text-tertiary">25 Feb 2026</span>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-2">
<div className="w-7 h-7 rounded-full bg-gov-green-surface text-primary flex items-center justify-center font-bold text-xs">
                  AZ
                </div>
<div className="flex flex-col">
<span className="font-semibold text-text-primary">Ahmad Zulkarnain</span>
<span className="text-text-tertiary font-body-sm text-body-sm">PPL Plampang</span>
</div>
</div>
</td>
<td className="py-3.5 px-4">
<div className="flex items-center gap-1.5 text-text-primary">
<span className="material-symbols-outlined text-secondary text-[18px]">pending_actions</span>
<span>Pengajuan Konfirmasi Serah Terima Bibit Jagung</span>
</div>
<span className="text-text-secondary font-code-dense text-[11px] block">Total: 450 Kg Jagung Hibrida</span>
</td>
<td className="py-3.5 px-4 text-text-primary">
<span className="font-medium">Desa Sepakat</span>
<span className="text-text-secondary font-body-sm text-body-sm block">Kec. Plampang</span>
</td>
<td className="py-3.5 px-4">
<span className="inline-flex items-center gap-1 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-warning-surface text-secondary font-bold">
<span className="material-symbols-outlined text-[13px]">pending</span>
                Menunggu Uji Petik
              </span>
</td>
<td className="py-3.5 px-4 text-right whitespace-nowrap">
<button className="px-2.5 py-1 text-primary hover:bg-gov-green-surface rounded-lg font-label-sm text-label-sm font-semibold transition-colors">
                Validasi
              </button>
</td>
</tr>
</tbody>
</table>
</div>
{/* Table Footer Pagination */}
<div className="flex flex-col sm:flex-row items-center justify-between gap-space-sm pt-space-md mt-space-sm text-text-secondary font-body-sm text-body-sm">
<span>Menampilkan <strong>5</strong> dari <strong>1.512</strong> entri audit lapangan</span>
<div className="flex items-center gap-1">
<button className="px-3 py-1.5 rounded-lg bg-surface-subtle hover:bg-surface-muted disabled:opacity-50 text-text-secondary" disabled>
          Sebelumnya
        </button>
<button className="px-3 py-1.5 rounded-lg bg-primary text-on-primary font-semibold">1</button>
<button className="px-3 py-1.5 rounded-lg bg-surface-subtle hover:bg-surface-muted text-text-primary">2</button>
<button className="px-3 py-1.5 rounded-lg bg-surface-subtle hover:bg-surface-muted text-text-primary">3</button>
<span className="px-2">...</span>
<button className="px-3 py-1.5 rounded-lg bg-surface-subtle hover:bg-surface-muted text-text-primary">302</button>
<button className="px-3 py-1.5 rounded-lg bg-surface-subtle hover:bg-surface-muted text-text-primary">
          Selanjutnya
        </button>
</div>
</div>
</div>
</div></main></div>
    </>
  );
}
  