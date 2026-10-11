@extends('layouts.pemda')

@section('content')
            <div class="flex flex-col w-full gap-space-xl">
                <!-- Top Command & Action Bar -->
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
                    <div class="flex flex-col max-w-2xl">
                        <div class="flex items-center gap-space-sm mb-space-xs">
                            <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
                                <span class="material-symbols-outlined text-[14px] mr-1">check_circle</span>
                                SINKRONISASI REAL-TIME
                            </span>
                            <span class="text-text-tertiary text-body-sm font-body-sm">Pembaruan: Hari ini, 09:42 WITA</span>
                        </div>
                        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Dashboard Monitoring Penyaluran Bibit</h1>
                        <p class="font-body-md text-text-secondary mt-1">
                            Monitoring real-time distribusi bibit pertanian, progres konversi SPJ, dan tingkat kelangsungan hidup (survival rate) se-Kabupaten Sumbawa.
                        </p>
                    </div>
                    <!-- Controls -->
                    <div class="flex flex-wrap items-center gap-space-sm">
                        <div class="relative bg-canvas-bg rounded-xl shadow-sm">
                            <select class="appearance-none font-label-md text-label-md text-text-primary bg-transparent pl-space-md pr-8 py-2 rounded-xl cursor-pointer focus:outline-none focus:bg-surface-subtle">
                                <option>Tahun Anggaran 2026</option>
                                <option>Tahun Anggaran 2025</option>
                                <option>Tahun Anggaran 2024</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-2 top-2.5 text-text-secondary text-[18px] pointer-events-none">expand_more</span>
                        </div>
                        <div class="relative bg-canvas-bg rounded-xl shadow-sm">
                            <select class="appearance-none font-label-md text-label-md text-text-primary bg-transparent pl-space-md pr-8 py-2 rounded-xl cursor-pointer focus:outline-none focus:bg-surface-subtle">
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
                            <span class="material-symbols-outlined absolute right-2 top-2.5 text-text-secondary text-[18px] pointer-events-none">expand_more</span>
                        </div>
                        <a href="{{ route('pemda.laporan.pdf') }}" target="_blank" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                            <span class="material-symbols-outlined text-[18px]">download</span>
                            <span>Unduh Ringkasan PDF</span>
                        </a>
                    </div>
                </div>

                <!-- KPI Cards Grid (4 Columns) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-space-lg">
                    <!-- Card 1 -->
                    <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm flex flex-col justify-between relative overflow-hidden">
                        <div class="flex items-start justify-between">
                            <div class="w-10 h-10 rounded-xl bg-status-verified-surface flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-[24px]">account_balance_wallet</span>
                            </div>
                            <span class="inline-flex items-center gap-0.5 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
                                <span class="material-symbols-outlined text-[14px]">trending_up</span>
                                +12.5% vs TA 2025
                            </span>
                        </div>
                        <div class="mt-space-md">
                            <span class="font-label-md text-label-md text-text-secondary block">Total Pagu Anggaran Bantuan</span>
                            <span class="font-headline-xl text-headline-xl text-text-primary font-bold tracking-tight block mt-1">Rp 4.850.000.000</span>
                        </div>
                        <div class="mt-space-md pt-space-sm bg-surface-subtle -mx-space-lg -mb-space-lg p-space-md">
                            <div class="flex justify-between items-center text-text-secondary font-body-sm text-body-sm">
                                <span>Realisasi SPJ: <strong class="text-text-primary font-semibold">78.4%</strong></span>
                                <span class="font-code-dense text-code-dense text-text-primary font-medium">Rp 3.802.400.000</span>
                            </div>
                            <div class="w-full bg-surface-container rounded-full h-1.5 mt-2 overflow-hidden">
                                <div class="bg-primary-container h-1.5 rounded-full" style="width: 78.4%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card 2 -->
                    <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm flex flex-col justify-between relative overflow-hidden">
                        <div class="flex items-start justify-between">
                            <div class="w-10 h-10 rounded-xl bg-gold-surface flex items-center justify-center text-secondary">
                                <span class="material-symbols-outlined text-[24px]">groups</span>
                            </div>
                            <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
                                On Track
                            </span>
                        </div>
                        <div class="mt-space-md">
                            <span class="font-label-md text-label-md text-text-secondary block">Bibit Tersalurkan (KK)</span>
                            <span class="font-headline-xl text-headline-xl text-text-primary font-bold tracking-tight block mt-1">14.280 KK</span>
                        </div>
                        <div class="mt-space-md pt-space-sm bg-surface-subtle -mx-space-lg -mb-space-lg p-space-md">
                            <div class="flex justify-between items-center text-text-secondary font-body-sm text-body-sm">
                                <span>Target: 18.000 KK</span>
                                <span>Capaian: <strong class="text-text-primary font-semibold">79.3%</strong></span>
                            </div>
                            <div class="w-full bg-surface-container rounded-full h-1.5 mt-2 overflow-hidden">
                                <div class="bg-secondary-container h-1.5 rounded-full" style="width: 79.3%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm flex flex-col justify-between relative overflow-hidden">
                        <div class="flex items-start justify-between">
                            <div class="w-10 h-10 rounded-xl bg-status-verified-surface flex items-center justify-center text-status-verified">
                                <span class="material-symbols-outlined text-[24px]">potted_plant</span>
                            </div>
                            <span class="inline-flex items-center gap-1 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-status-verified font-bold">
                                <span class="material-symbols-outlined text-[13px]">eco</span>
                                Sehat & Tumbuh
                            </span>
                        </div>
                        <div class="mt-space-md">
                            <span class="font-label-md text-label-md text-text-secondary block">Survival Rate (Bulan ke-3)</span>
                            <div class="flex items-baseline gap-2 mt-1">
                                <span class="font-headline-xl text-headline-xl text-text-primary font-bold tracking-tight">84.2%</span>
                                <span class="font-label-sm text-label-sm text-status-verified font-semibold">+14.2% di atas target</span>
                            </div>
                        </div>
                        <div class="mt-space-md pt-space-sm bg-surface-subtle -mx-space-lg -mb-space-lg p-space-md">
                            <div class="flex justify-between items-center text-text-secondary font-body-sm text-body-sm">
                                <span>Target min: 70.0%</span>
                                <span><strong class="text-text-primary font-semibold">42.150</strong> bibit dipantau</span>
                            </div>
                            <div class="w-full bg-surface-container rounded-full h-1.5 mt-2 overflow-hidden">
                                <div class="bg-status-verified h-1.5 rounded-full" style="width: 84.2%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm flex flex-col justify-between relative overflow-hidden">
                        <div class="flex items-start justify-between">
                            <div class="w-10 h-10 rounded-xl bg-status-info-surface flex items-center justify-center text-status-info">
                                <span class="material-symbols-outlined text-[24px]">verified</span>
                            </div>
                            <span class="inline-flex items-center gap-1 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-warning-surface text-secondary font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-status-warning"></span>
                                14 Verifikasi Pending
                            </span>
                        </div>
                        <div class="mt-space-md">
                            <span class="font-label-md text-label-md text-text-secondary block">Uji Petik & Validasi Lapangan</span>
                            <span class="font-headline-xl text-headline-xl text-text-primary font-bold tracking-tight block mt-1">1.512 / 1.428</span>
                        </div>
                        <div class="mt-space-md pt-space-sm bg-surface-subtle -mx-space-lg -mb-space-lg p-space-md">
                            <div class="flex justify-between items-center text-text-secondary font-body-sm text-body-sm">
                                <span>Target audit: ≥10%</span>
                                <span class="text-error font-semibold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[13px]">gavel</span>
                                    2 Kasus Fraud
                                </span>
                            </div>
                            <div class="w-full bg-surface-container rounded-full h-1.5 mt-2 overflow-hidden">
                                <div class="bg-status-info h-1.5 rounded-full" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Analytical Section: 2 Columns (7 cols : 5 cols) -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg">
                    <!-- Left Column (7 cols): Map & Regional Cluster Breakdown -->
                    <div class="lg:col-span-7 flex flex-col gap-space-lg">
                        <div class="bg-canvas-bg rounded-xl shadow-sm p-space-lg flex flex-col">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm pb-space-md">
                                <div class="flex items-center gap-space-sm">
                                    <div class="w-8 h-8 rounded-lg bg-surface-muted flex items-center justify-center text-primary-container">
                                        <span class="material-symbols-outlined text-[20px]">map</span>
                                    </div>
                                    <div>
                                        <h2 class="font-headline-sm text-headline-sm text-text-primary font-bold">Peta Sebaran & Distribusi Kecamatan</h2>
                                        <span class="font-body-sm text-body-sm text-text-secondary">Monitoring geolokasi penyaluran bibit & survival rate 24 kecamatan</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1 font-label-sm text-label-sm text-text-secondary">
                                        <span class="w-2.5 h-2.5 rounded-full bg-status-verified"></span> Aman (>80%)
                                    </span>
                                    <span class="inline-flex items-center gap-1 font-label-sm text-label-sm text-text-secondary">
                                        <span class="w-2.5 h-2.5 rounded-full bg-status-warning"></span> Perhatian
                                    </span>
                                    <span class="inline-flex items-center gap-1 font-label-sm text-label-sm text-text-secondary">
                                        <span class="w-2.5 h-2.5 rounded-full bg-error"></span> Anomali
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Interactive GIS Visual Map Canvas -->
                            <div class="relative w-full h-72 rounded-xl overflow-hidden bg-surface-muted flex items-center justify-center shadow-inner">
                                <div class="w-full h-full bg-cover bg-center" data-location="Kabupaten Sumbawa, NTB, Indonesia" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDUy5A14lej1Z07vzdRd2HsyKYue4NZ_ZyWhhhKAR4wuUhqTxQhxkrfJUAvR3E5juh8zfXGsm4XoK7F-_ekZhoUkjAIe2saZifqjavrZUFuZp17D7QCTpbNcwQHTCjn9jGG0A94FbTo9cAMg5ysgEVYom5YEqJuNOL1jzt8DKAnioEEya1zdWn3mOwUGKiK6EGQIYgRQwdbE3NGJ_cHiRZSSMy35v0n1gJoxnEvoiqDNRPuMMUpP46Grw')"></div>
                                <!-- Overlay Administrative Pins -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-black/10 pointer-events-none"></div>
                                
                                <!-- Pinned locations -->
                                <div class="absolute top-1/4 left-1/3 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-105 transition-transform">
                                    <span class="w-2 h-2 rounded-full bg-status-verified animate-ping"></span>
                                    <span class="font-label-sm text-label-sm font-bold text-text-primary">Sumbawa Kota (92%)</span>
                                </div>
                                <div class="absolute top-1/2 left-1/4 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-105 transition-transform">
                                    <span class="w-2 h-2 rounded-full bg-status-verified"></span>
                                    <span class="font-label-sm text-label-sm font-bold text-text-primary">Utan (78%)</span>
                                </div>
                                <div class="absolute top-1/3 right-1/4 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-105 transition-transform">
                                    <span class="w-2 h-2 rounded-full bg-status-warning"></span>
                                    <span class="font-label-sm text-label-sm font-bold text-text-primary">Plampang (64%)</span>
                                </div>
                                <div class="absolute bottom-1/4 right-1/3 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-105 transition-transform">
                                    <span class="w-2 h-2 rounded-full bg-status-verified"></span>
                                    <span class="font-label-sm text-label-sm font-bold text-text-primary">Empang (88%)</span>
                                </div>
                                <div class="absolute top-16 right-12 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-105 transition-transform">
                                    <span class="w-2 h-2 rounded-full bg-error"></span>
                                    <span class="font-label-sm text-label-sm font-bold text-error">Lab. Burung (46.2%)</span>
                                </div>
                                
                                <!-- Bottom map controls -->
                                <div class="absolute bottom-3 left-3 bg-canvas-bg/90 backdrop-blur-md px-3 py-1.5 rounded-lg shadow flex items-center gap-3 text-text-secondary font-label-sm text-label-sm">
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">satellite_alt</span> Citra Satelit</span>
                                    <span class="h-3 w-px bg-border-medium"></span>
                                    <span>24 Titik Pantau Aktif</span>
                                </div>
                            </div>
                            
                            <!-- Top Distribution Clusters Table -->
                            <div class="mt-space-md">
                                <div class="flex items-center justify-between mb-space-sm">
                                    <span class="font-label-lg text-label-lg text-text-primary">Kluster Wilayah Prioritas Penyaluran</span>
                                    <a class="text-primary font-label-sm text-label-sm hover:underline font-semibold flex items-center" href="{{ route('pemda.master-data.wilayah.index') }}">
                                        Lihat 24 Kecamatan
                                        <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                    </a>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left font-body-sm text-body-sm">
                                        <thead class="bg-surface-subtle text-text-secondary font-label-md text-label-md">
                                            <tr>
                                                <th class="py-2.5 px-3">Kecamatan</th>
                                                <th class="py-2.5 px-3">Alokasi KK</th>
                                                <th class="py-2.5 px-3">Bibit Terkirim</th>
                                                <th class="py-2.5 px-3">Survival Rate</th>
                                                <th class="py-2.5 px-3">Status Evaluasi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-surface-muted font-body-md text-body-md">
                                            <tr class="hover:bg-surface-subtle/70 transition-colors">
                                                <td class="py-3 px-3 font-semibold text-text-primary flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-primary-container text-[18px]">location_on</span>
                                                    Kecamatan Sumbawa
                                                </td>
                                                <td class="py-3 px-3 font-code-dense text-code-dense">1.450 KK</td>
                                                <td class="py-3 px-3">
                                                    <span class="font-semibold text-text-primary">1.410 KK</span>
                                                    <span class="text-text-tertiary font-body-sm text-body-sm block">97.2%</span>
                                                </td>
                                                <td class="py-3 px-3 font-semibold text-status-verified">92.4%</td>
                                                <td class="py-3 px-3">
                                                    <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">Aman</span>
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-surface-subtle/70 transition-colors">
                                                <td class="py-3 px-3 font-semibold text-text-primary flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-primary-container text-[18px]">location_on</span>
                                                    Kecamatan Moyo Hilir
                                                </td>
                                                <td class="py-3 px-3 font-code-dense text-code-dense">1.200 KK</td>
                                                <td class="py-3 px-3">
                                                    <span class="font-semibold text-text-primary">1.150 KK</span>
                                                    <span class="text-text-tertiary font-body-sm text-body-sm block">95.8%</span>
                                                </td>
                                                <td class="py-3 px-3 font-semibold text-status-verified">86.1%</td>
                                                <td class="py-3 px-3">
                                                    <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">Aman</span>
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-surface-subtle/70 transition-colors">
                                                <td class="py-3 px-3 font-semibold text-text-primary flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-primary-container text-[18px]">location_on</span>
                                                    Kecamatan Moyo Utara
                                                </td>
                                                <td class="py-3 px-3 font-code-dense text-code-dense">980 KK</td>
                                                <td class="py-3 px-3">
                                                    <span class="font-semibold text-text-primary">890 KK</span>
                                                    <span class="text-text-tertiary font-body-sm text-body-sm block">90.8%</span>
                                                </td>
                                                <td class="py-3 px-3 font-semibold text-secondary">78.5%</td>
                                                <td class="py-3 px-3">
                                                    <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-warning-surface text-secondary font-bold">Perhatian</span>
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-surface-subtle/70 transition-colors">
                                                <td class="py-3 px-3 font-semibold text-text-primary flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-primary-container text-[18px]">location_on</span>
                                                    Kecamatan Utan
                                                </td>
                                                <td class="py-3 px-3 font-code-dense text-code-dense">1.100 KK</td>
                                                <td class="py-3 px-3">
                                                    <span class="font-semibold text-text-primary">820 KK</span>
                                                    <span class="text-text-tertiary font-body-sm text-body-sm block">74.5%</span>
                                                </td>
                                                <td class="py-3 px-3 font-semibold text-error">46.2%</td>
                                                <td class="py-3 px-3">
                                                    <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-fraud-surface text-error font-bold">Anomali</span>
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-surface-subtle/70 transition-colors">
                                                <td class="py-3 px-3 font-semibold text-text-primary flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-primary-container text-[18px]">location_on</span>
                                                    Kecamatan Plampang
                                                </td>
                                                <td class="py-3 px-3 font-code-dense text-code-dense">1.050 KK</td>
                                                <td class="py-3 px-3">
                                                    <span class="font-semibold text-text-primary">690 KK</span>
                                                    <span class="text-text-tertiary font-body-sm text-body-sm block">65.7%</span>
                                                </td>
                                                <td class="py-3 px-3 font-semibold text-secondary">64.0%</td>
                                                <td class="py-3 px-3">
                                                    <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-warning-surface text-secondary font-bold">Perhatian</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column (5 cols): Alerts & Seed Composition -->
                    <div class="lg:col-span-5 flex flex-col gap-space-lg">
                        <!-- FR-24 Alerts Card -->
                        <div class="bg-canvas-bg rounded-xl shadow-sm p-space-lg flex flex-col">
                            <div class="flex items-center justify-between pb-space-md">
                                <div class="flex items-center gap-space-sm">
                                    <div class="w-8 h-8 rounded-lg bg-status-fraud-surface flex items-center justify-center text-error">
                                        <span class="material-symbols-outlined text-[20px]">warning</span>
                                    </div>
                                    <div>
                                        <h2 class="font-headline-sm text-headline-sm text-text-primary font-bold">Alert Sistem & Prioritas</h2>
                                        <span class="font-body-sm text-body-sm text-text-secondary">Kepatuhan protokol tata kelola bantuan (FR-24)</span>
                                    </div>
                                </div>
                                <span class="font-label-sm text-label-sm px-space-sm py-0.5 rounded-full bg-status-fraud-surface text-error font-bold">3 Kasus</span>
                            </div>
                            
                            <div class="flex flex-col gap-space-md">
                                <!-- Alert 1 (Merah/Danger) -->
                                <div class="p-space-md rounded-xl bg-status-fraud-surface/60 flex items-start gap-space-sm hover:bg-status-fraud-surface transition-colors">
                                    <span class="material-symbols-outlined text-error text-[20px] shrink-0 mt-0.5">error</span>
                                    <div class="flex flex-col flex-1">
                                        <div class="flex items-center justify-between">
                                            <span class="font-label-md text-label-md text-error font-bold uppercase tracking-wider">Anomali Survival Rendah</span>
                                            <span class="font-label-sm text-label-sm text-text-secondary">Hari Ini</span>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-text-primary mt-1">
                                            <strong>Desa Labuhan Burung (Utan):</strong> Survival rate <strong>46.2%</strong> (&lt;50%) akibat serangan hama wereng. Dibutuhkan penyuluhan & penanganan darurat POPT.
                                        </p>
                                        <div class="mt-2 flex items-center gap-2">
                                            <a href="{{ route('pemda.penyaluran-bibit.index') }}" class="px-2 py-1 bg-error text-on-error rounded font-label-sm text-label-sm font-bold hover:bg-error/90 transition-colors">Tugaskan PPL</a>
                                            <a href="{{ route('pemda.laporan.index') }}" class="px-2 py-1 bg-canvas-bg text-text-primary rounded font-label-sm text-label-sm font-semibold hover:bg-surface-subtle transition-colors border border-border-light">Buka Berkas</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Alert 2 (Oranye/Warning) -->
                                <div class="p-space-md rounded-xl bg-status-warning-surface/60 flex items-start gap-space-sm hover:bg-status-warning-surface transition-colors">
                                    <span class="material-symbols-outlined text-status-warning text-[20px] shrink-0 mt-0.5">warning</span>
                                    <div class="flex flex-col flex-1">
                                        <div class="flex items-center justify-between">
                                            <span class="font-label-md text-label-md text-secondary font-bold uppercase tracking-wider">Gap Penyerapan & Distribusi</span>
                                            <span class="font-label-sm text-label-sm text-text-secondary">Kemarin</span>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-text-primary mt-1">
                                            <strong>Kampus Mitra B (UNSA):</strong> Penyerapan dana <strong>82.0%</strong> namun penyaluran fisik baru mencapai <strong>44.1%</strong>. Memerlukan rekonsiliasi SPJ fisik.
                                        </p>
                                        <div class="mt-2 flex items-center gap-2">
                                            <a href="{{ route('pemda.laporan.index') }}" class="px-2 py-1 bg-secondary text-on-secondary rounded font-label-sm text-label-sm font-bold hover:bg-secondary/90 transition-colors">Kirim Notifikasi SPJ</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Alert 3 (Kuning/Info) -->
                                <div class="p-space-md rounded-xl bg-status-info-surface/60 flex items-start gap-space-sm hover:bg-status-info-surface transition-colors">
                                    <span class="material-symbols-outlined text-status-info text-[20px] shrink-0 mt-0.5">hourglass_empty</span>
                                    <div class="flex flex-col flex-1">
                                        <div class="flex items-center justify-between">
                                            <span class="font-label-md text-label-md text-status-info font-bold uppercase tracking-wider">Audit Tertunda (>14 Hari)</span>
                                            <span class="font-label-sm text-label-sm text-text-secondary">2 Hari Lalu</span>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-text-primary mt-1">
                                            <strong>Kecamatan Plampang:</strong> 18 serah terima bibit >14 hari belum dilakukan uji petik sampling oleh tim pendamping lapangan.
                                        </p>
                                        <div class="mt-2 flex items-center gap-2">
                                            <a href="{{ route('pemda.validasi-lapangan.index') }}" class="px-2 py-1 bg-status-info text-on-primary rounded font-label-sm text-label-sm font-bold hover:bg-status-info/90 transition-colors">Jadwalkan Uji Petik</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Seed Composition Progress -->
                        <div class="bg-canvas-bg rounded-xl shadow-sm p-space-lg flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between pb-space-sm">
                                    <div class="flex items-center gap-space-sm">
                                        <div class="w-8 h-8 rounded-lg bg-surface-muted flex items-center justify-center text-primary-container">
                                            <span class="material-symbols-outlined text-[20px]">pie_chart</span>
                                        </div>
                                        <div>
                                            <h2 class="font-headline-sm text-headline-sm text-text-primary font-bold">Komposisi Bibit Tersalurkan</h2>
                                            <span class="font-body-sm text-body-sm text-text-secondary">Berdasarkan komoditas unggulan TA 2026</span>
                                        </div>
                                    </div>
                                    <span class="font-label-md text-label-md font-bold text-text-primary">14.280 KK</span>
                                </div>
                                <div class="flex flex-col gap-space-md mt-space-md">
                                    <!-- Jagung Hibrida -->
                                    <div class="flex flex-col gap-1">
                                        <div class="flex justify-between items-center">
                                            <span class="font-label-md text-label-md font-semibold text-text-primary flex items-center gap-1.5">
                                                <span class="w-2.5 h-2.5 rounded-full bg-gold-accent"></span> Jagung Hibrida (Bisi-18 / Pioneer)
                                            </span>
                                            <span class="font-label-md text-label-md font-bold text-text-primary">45% <span class="text-text-secondary font-normal font-body-sm text-body-sm">(6.426 KK)</span></span>
                                        </div>
                                        <div class="w-full bg-surface-container rounded-full h-2 overflow-hidden">
                                            <div class="bg-gold-accent h-2 rounded-full" style="width: 45%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Bibit Padi Ciherang -->
                                    <div class="flex flex-col gap-1">
                                        <div class="flex justify-between items-center">
                                            <span class="font-label-md text-label-md font-semibold text-text-primary flex items-center gap-1.5">
                                                <span class="w-2.5 h-2.5 rounded-full bg-primary-container"></span> Bibit Padi Ciherang &amp; Inpari 32
                                            </span>
                                            <span class="font-label-md text-label-md font-bold text-text-primary">30% <span class="text-text-secondary font-normal font-body-sm text-body-sm">(4.284 KK)</span></span>
                                        </div>
                                        <div class="w-full bg-surface-container rounded-full h-2 overflow-hidden">
                                            <div class="bg-primary-container h-2 rounded-full" style="width: 30%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Kopi Robusta -->
                                    <div class="flex flex-col gap-1">
                                        <div class="flex justify-between items-center">
                                            <span class="font-label-md text-label-md font-semibold text-text-primary flex items-center gap-1.5">
                                                <span class="w-2.5 h-2.5 rounded-full bg-secondary"></span> Kopi Robusta Batulanteh
                                            </span>
                                            <span class="font-label-md text-label-md font-bold text-text-primary">15% <span class="text-text-secondary font-normal font-body-sm text-body-sm">(2.142 KK)</span></span>
                                        </div>
                                        <div class="w-full bg-surface-container rounded-full h-2 overflow-hidden">
                                            <div class="bg-secondary h-2 rounded-full" style="width: 15%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Hortikultura Cabe/Bawang -->
                                    <div class="flex flex-col gap-1">
                                        <div class="flex justify-between items-center">
                                            <span class="font-label-md text-label-md font-semibold text-text-primary flex items-center gap-1.5">
                                                <span class="w-2.5 h-2.5 rounded-full bg-status-info"></span> Hortikultura (Cabe Rawit &amp; Bawang Merah)
                                            </span>
                                            <span class="font-label-md text-label-md font-bold text-text-primary">10% <span class="text-text-secondary font-normal font-body-sm text-body-sm">(1.428 KK)</span></span>
                                        </div>
                                        <div class="w-full bg-surface-container rounded-full h-2 overflow-hidden">
                                            <div class="bg-status-info h-2 rounded-full" style="width: 10%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-space-lg pt-space-md bg-surface-subtle -mx-space-lg -mb-space-lg p-space-md rounded-b-xl flex items-center justify-between text-text-secondary font-body-sm text-body-sm">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px] text-primary">verified_user</span> Sertifikasi Balai Pengawasan &amp; Sertifikasi Benih (BPSB)
                                </span>
                                <span class="font-semibold text-text-primary">100% Terverifikasi</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section: Live Activity & Field Audit Log -->
                <div class="bg-canvas-bg rounded-xl shadow-sm p-space-lg flex flex-col">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm pb-space-md">
                        <div class="flex items-center gap-space-sm">
                            <div class="w-8 h-8 rounded-lg bg-surface-muted flex items-center justify-center text-primary-container">
                                <span class="material-symbols-outlined text-[20px]">assignment_turned_in</span>
                            </div>
                            <div>
                                <h2 class="font-headline-sm text-headline-sm text-text-primary font-bold">Aktivitas Terkini &amp; Log Audit Lapangan</h2>
                                <span class="font-body-sm text-body-sm text-text-secondary">Riwayat entri validasi berkas, geotagging, dan peninjauan fisik lapangan</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-space-sm">
                            <div class="relative">
                                <input class="font-body-sm text-body-sm pl-8 pr-3 py-1.5 rounded-lg bg-surface-subtle text-text-primary focus:outline-none focus:bg-canvas-bg shadow-sm w-52 sm:w-64" placeholder="Cari NIK / Petugas / Desa..." type="text"/>
                                <span class="material-symbols-outlined absolute left-2 top-2 text-text-secondary text-[16px]">search</span>
                            </div>
                            <button class="p-1.5 bg-surface-subtle text-text-secondary rounded-lg hover:text-text-primary hover:bg-surface-muted transition-colors" title="Filter Riwayat">
                                <span class="material-symbols-outlined text-[20px]">tune</span>
                            </button>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left font-body-sm text-body-sm">
                            <thead class="bg-surface-subtle text-text-secondary font-label-md text-label-md">
                                <tr>
                                    <th class="py-3 px-4">Waktu</th>
                                    <th class="py-3 px-4">Pendamping / Petugas</th>
                                    <th class="py-3 px-4">Kegiatan</th>
                                    <th class="py-3 px-4">Wilayah</th>
                                    <th class="py-3 px-4">Status Verifikasi</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-surface-muted font-body-md text-body-md">
                                <!-- Row 1 -->
                                <tr class="hover:bg-surface-subtle/80 transition-colors">
                                    <td class="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary whitespace-nowrap">
                                        09:38 WITA <span class="block text-[11px] text-text-tertiary">26 Feb 2026</span>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-gov-green-surface text-primary flex items-center justify-center font-bold text-xs">FA</div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-text-primary">Fajar Maulana, S.P.</span>
                                                <span class="text-text-tertiary font-body-sm text-body-sm">PPL Wilbin Alas</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-1.5 text-text-primary">
                                            <span class="material-symbols-outlined text-primary text-[18px]">photo_camera</span>
                                            <span>Upload Foto Geotagging Penanaman (5 KK)</span>
                                        </div>
                                        <span class="text-text-secondary font-code-dense text-[11px] block">Lat: -8.5124, Long: 117.0211</span>
                                    </td>
                                    <td class="py-3.5 px-4 text-text-primary">
                                        <span class="font-medium">Desa Luar</span>
                                        <span class="text-text-secondary font-body-sm text-body-sm block">Kec. Alas</span>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <span class="inline-flex items-center gap-1 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
                                            <span class="material-symbols-outlined text-[13px]">verified_user</span> Geotag Verified
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                        <a href="{{ route('pemda.validasi-lapangan.index') }}" class="px-2.5 py-1 text-primary hover:bg-gov-green-surface rounded-lg font-label-sm text-label-sm font-semibold transition-colors">Detail</a>
                                    </td>
                                </tr>
                                
                                <!-- Row 2 -->
                                <tr class="hover:bg-surface-subtle/80 transition-colors">
                                    <td class="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary whitespace-nowrap">
                                        09:15 WITA <span class="block text-[11px] text-text-tertiary">26 Feb 2026</span>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-gold-surface text-secondary flex items-center justify-center font-bold text-xs">RN</div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-text-primary">Rian Nurdin</span>
                                                <span class="text-text-tertiary font-body-sm text-body-sm">Fasilitator UNSA</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-1.5 text-text-primary">
                                            <span class="material-symbols-outlined text-secondary text-[18px]">draw</span>
                                            <span>BAST Elektronik &amp; Tanda Tangan Penerima</span>
                                        </div>
                                        <span class="text-text-secondary font-code-dense text-[11px] block">NIK: 520412******0004 (A. Karim)</span>
                                    </td>
                                    <td class="py-3.5 px-4 text-text-primary">
                                        <span class="font-medium">Desa Baru</span>
                                        <span class="text-text-secondary font-body-sm text-body-sm block">Kec. Moyo Utara</span>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <span class="inline-flex items-center gap-1 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
                                            <span class="material-symbols-outlined text-[13px]">check_circle</span> e-Sign Sah
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                        <a href="{{ route('pemda.validasi-lapangan.index') }}" class="px-2.5 py-1 text-primary hover:bg-gov-green-surface rounded-lg font-label-sm text-label-sm font-semibold transition-colors">Detail</a>
                                    </td>
                                </tr>
                                
                                <!-- Row 3 -->
                                <tr class="hover:bg-surface-subtle/80 transition-colors">
                                    <td class="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary whitespace-nowrap">
                                        08:45 WITA <span class="block text-[11px] text-text-tertiary">26 Feb 2026</span>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-status-info-surface text-status-info flex items-center justify-center font-bold text-xs">HS</div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-text-primary">Hendri Setiawan, S.ST</span>
                                                <span class="text-text-tertiary font-body-sm text-body-sm">Auditor Dispertan</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-1.5 text-text-primary">
                                            <span class="material-symbols-outlined text-status-info text-[18px]">fact_check</span>
                                            <span>Uji Petik Fisik Sampling Lapangan (10%)</span>
                                        </div>
                                        <span class="text-text-secondary font-code-dense text-[11px] block">Survival Rate Realita: 89.2%</span>
                                    </td>
                                    <td class="py-3.5 px-4 text-text-primary">
                                        <span class="font-medium">Desa Kerato</span>
                                        <span class="text-text-secondary font-body-sm text-body-sm block">Kec. Unter Iwes</span>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <span class="inline-flex items-center gap-1 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-info-surface text-status-info font-bold">
                                            <span class="material-symbols-outlined text-[13px]">rule</span> Sesuai Spesifikasi
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                        <a href="{{ route('pemda.validasi-lapangan.index') }}" class="px-2.5 py-1 text-primary hover:bg-gov-green-surface rounded-lg font-label-sm text-label-sm font-semibold transition-colors">Detail</a>
                                    </td>
                                </tr>
                                
                                <!-- Row 4 -->
                                <tr class="hover:bg-surface-subtle/80 transition-colors">
                                    <td class="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary whitespace-nowrap">
                                        08:12 WITA <span class="block text-[11px] text-text-tertiary">26 Feb 2026</span>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-status-fraud-surface text-error flex items-center justify-center font-bold text-xs">DK</div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-text-primary">Dina Kartika</span>
                                                <span class="text-text-tertiary font-body-sm text-body-sm">Admin Verifikasi Data</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-1.5 text-text-primary">
                                            <span class="material-symbols-outlined text-error text-[18px]">badge</span>
                                            <span>Pengecekan NIK Ganda (Dukcapil Sumbawa)</span>
                                        </div>
                                        <span class="text-error font-body-sm text-[11px] block font-semibold">Duplikasi Terdeteksi: 1 NIK 2 Poktan</span>
                                    </td>
                                    <td class="py-3.5 px-4 text-text-primary">
                                        <span class="font-medium">Desa Labuhan Burung</span>
                                        <span class="text-text-secondary font-body-sm text-body-sm block">Kec. Utan</span>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <span class="inline-flex items-center gap-1 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-fraud-surface text-error font-bold">
                                            <span class="material-symbols-outlined text-[13px]">gavel</span> Ditolak Sistem
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                        <a href="{{ route('pemda.validasi-lapangan.index') }}" class="px-2.5 py-1 text-error hover:bg-status-fraud-surface rounded-lg font-label-sm text-label-sm font-semibold transition-colors inline-block">Investigasi</a>
                                    </td>
                                </tr>
                                
                                <!-- Row 5 -->
                                <tr class="hover:bg-surface-subtle/80 transition-colors">
                                    <td class="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary whitespace-nowrap">
                                        Kemarin, 16:40 <span class="block text-[11px] text-text-tertiary">25 Feb 2026</span>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-gov-green-surface text-primary flex items-center justify-center font-bold text-xs">AZ</div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-text-primary">Ahmad Zulkarnain</span>
                                                <span class="text-text-tertiary font-body-sm text-body-sm">PPL Plampang</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-1.5 text-text-primary">
                                            <span class="material-symbols-outlined text-secondary text-[18px]">pending_actions</span>
                                            <span>Pengajuan Konfirmasi Serah Terima Bibit Jagung</span>
                                        </div>
                                        <span class="text-text-secondary font-code-dense text-[11px] block">Total: 450 Kg Jagung Hibrida</span>
                                    </td>
                                    <td class="py-3.5 px-4 text-text-primary">
                                        <span class="font-medium">Desa Sepakat</span>
                                        <span class="text-text-secondary font-body-sm text-body-sm block">Kec. Plampang</span>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <span class="inline-flex items-center gap-1 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-warning-surface text-secondary font-bold">
                                            <span class="material-symbols-outlined text-[13px]">pending</span> Menunggu Uji Petik
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                        <a href="{{ route('pemda.validasi-lapangan.index') }}" class="px-2.5 py-1 text-primary hover:bg-gov-green-surface rounded-lg font-label-sm text-label-sm font-semibold transition-colors inline-block">Validasi</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Table Footer Pagination -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-space-sm pt-space-md mt-space-sm text-text-secondary font-body-sm text-body-sm">
                        <span>Menampilkan <strong>5</strong> dari <strong>1.512</strong> entri audit lapangan</span>
                        <div class="flex items-center gap-1">
                            <button class="px-3 py-1.5 rounded-lg bg-surface-subtle hover:bg-surface-muted disabled:opacity-50 text-text-secondary" disabled="">Sebelumnya</button>
                            <button class="px-3 py-1.5 rounded-lg bg-primary text-on-primary font-semibold">1</button>
                            <button class="px-3 py-1.5 rounded-lg bg-surface-subtle hover:bg-surface-muted text-text-primary">2</button>
                            <button class="px-3 py-1.5 rounded-lg bg-surface-subtle hover:bg-surface-muted text-text-primary">3</button>
                            <span class="px-2">...</span>
                            <button class="px-3 py-1.5 rounded-lg bg-surface-subtle hover:bg-surface-muted text-text-primary">302</button>
                            <button class="px-3 py-1.5 rounded-lg bg-surface-subtle hover:bg-surface-muted text-text-primary">Selanjutnya</button>
                        </div>
                    </div>
                </div>
            </div>
@endsection
