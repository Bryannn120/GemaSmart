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
                            <select id="select-kecamatan-quick" onchange="if(this.value && this.value !== 'Semua') openKecamatanModal(this.value)" class="appearance-none font-label-md text-label-md text-text-primary bg-transparent pl-space-md pr-8 py-2 rounded-xl cursor-pointer focus:outline-none focus:bg-surface-subtle">
                                <option value="Semua">-- Pilih Kecamatan untuk Lihat Grafik --</option>
                                <option value="Kecamatan Sumbawa">Kecamatan Sumbawa</option>
                                <option value="Kecamatan Moyo Hilir">Kecamatan Moyo Hilir</option>
                                <option value="Kecamatan Moyo Utara">Kecamatan Moyo Utara</option>
                                <option value="Kecamatan Alas">Kecamatan Alas</option>
                                <option value="Kecamatan Utan">Kecamatan Utan</option>
                                <option value="Kecamatan Labuhan Badas">Kecamatan Labuhan Badas</option>
                                <option value="Kecamatan Plampang">Kecamatan Plampang</option>
                                <option value="Kecamatan Empang">Kecamatan Empang</option>
                                <option value="Kecamatan Moyo Hulu">Kecamatan Moyo Hulu</option>
                                <option value="Kecamatan Lunyuk">Kecamatan Lunyuk</option>
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
                                
                                <!-- Pinned locations (Clickable to show Graphs) -->
                                <button type="button" onclick="openKecamatanModal('Kecamatan Sumbawa')" class="absolute top-1/4 left-1/3 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-110 hover:shadow-lg hover:ring-2 hover:ring-primary transition-all text-left group">
                                    <span class="w-2.5 h-2.5 rounded-full bg-status-verified animate-ping"></span>
                                    <span class="font-label-sm text-label-sm font-bold text-text-primary group-hover:text-primary">Sumbawa (92.4%)</span>
                                    <span class="material-symbols-outlined text-[14px] text-primary">bar_chart</span>
                                </button>
                                <button type="button" onclick="openKecamatanModal('Kecamatan Utan')" class="absolute top-1/2 left-1/4 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-110 hover:shadow-lg hover:ring-2 hover:ring-error transition-all text-left group">
                                    <span class="w-2.5 h-2.5 rounded-full bg-error"></span>
                                    <span class="font-label-sm text-label-sm font-bold text-error">Utan (46.2%)</span>
                                    <span class="material-symbols-outlined text-[14px] text-error">bar_chart</span>
                                </button>
                                <button type="button" onclick="openKecamatanModal('Kecamatan Plampang')" class="absolute top-1/3 right-1/4 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-110 hover:shadow-lg hover:ring-2 hover:ring-secondary transition-all text-left group">
                                    <span class="w-2.5 h-2.5 rounded-full bg-status-warning"></span>
                                    <span class="font-label-sm text-label-sm font-bold text-text-primary group-hover:text-secondary">Plampang (64%)</span>
                                    <span class="material-symbols-outlined text-[14px] text-secondary">bar_chart</span>
                                </button>
                                <button type="button" onclick="openKecamatanModal('Kecamatan Empang')" class="absolute bottom-1/4 right-1/3 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-110 hover:shadow-lg hover:ring-2 hover:ring-primary transition-all text-left group">
                                    <span class="w-2.5 h-2.5 rounded-full bg-status-verified"></span>
                                    <span class="font-label-sm text-label-sm font-bold text-text-primary group-hover:text-primary">Empang (88%)</span>
                                    <span class="material-symbols-outlined text-[14px] text-primary">bar_chart</span>
                                </button>
                                <button type="button" onclick="openKecamatanModal('Kecamatan Alas')" class="absolute top-16 left-12 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-110 hover:shadow-lg hover:ring-2 hover:ring-primary transition-all text-left group">
                                    <span class="w-2.5 h-2.5 rounded-full bg-status-verified"></span>
                                    <span class="font-label-sm text-label-sm font-bold text-text-primary group-hover:text-primary">Alas (81%)</span>
                                    <span class="material-symbols-outlined text-[14px] text-primary">bar_chart</span>
                                </button>
                                <button type="button" onclick="openKecamatanModal('Kecamatan Moyo Hilir')" class="absolute top-16 right-16 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-110 hover:shadow-lg hover:ring-2 hover:ring-primary transition-all text-left group">
                                    <span class="w-2.5 h-2.5 rounded-full bg-status-verified"></span>
                                    <span class="font-label-sm text-label-sm font-bold text-text-primary group-hover:text-primary">Moyo Hilir (86%)</span>
                                    <span class="material-symbols-outlined text-[14px] text-primary">bar_chart</span>
                                </button>
                                
                                <!-- Bottom map controls & click guidance -->
                                <div class="absolute bottom-3 left-3 bg-canvas-bg/90 backdrop-blur-md px-3 py-1.5 rounded-lg shadow flex items-center gap-3 text-text-secondary font-label-sm text-label-sm">
                                    <span class="flex items-center gap-1 text-primary font-semibold"><span class="material-symbols-outlined text-[15px]">touch_app</span> Klik pin untuk lihat grafik</span>
                                    <span class="h-3 w-px bg-border-medium"></span>
                                    <span>24 Titik Pantau Aktif</span>
                                </div>
                                <div class="absolute bottom-3 right-3">
                                    <a href="{{ route('pemda.monitoring.index') }}" class="px-2.5 py-1 rounded-lg bg-primary-container text-white text-xs font-semibold hover:bg-gov-green-dark transition-colors shadow flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">map</span>
                                        <span>Buka Peta GIS</span>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Top Distribution Clusters Table -->
                            <div class="mt-space-md">
                                <div class="flex items-center justify-between mb-space-sm">
                                    <div class="flex items-center gap-2">
                                        <span class="font-label-lg text-label-lg text-text-primary font-bold">Kluster Wilayah Prioritas Penyaluran</span>
                                        <span class="text-xs text-text-tertiary">(Klik baris untuk buka grafik)</span>
                                    </div>
                                    <a class="text-primary font-label-sm text-label-sm hover:underline font-semibold flex items-center" href="{{ route('pemda.monitoring.index') }}">
                                        Monitoring Lengkap
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
                                                <th class="py-2.5 px-3 text-right">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-surface-muted font-body-md text-body-md">
                                            <tr onclick="openKecamatanModal('Kecamatan Sumbawa')" class="hover:bg-gov-green-surface/40 cursor-pointer transition-colors group">
                                                <td class="py-3 px-3 font-semibold text-text-primary flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-primary-container text-[18px]">location_on</span>
                                                    <span class="group-hover:text-primary transition-colors">Kecamatan Sumbawa</span>
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
                                                <td class="py-3 px-3 text-right">
                                                    <button type="button" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-gov-green-surface text-primary hover:bg-primary hover:text-white font-label-sm text-xs font-semibold transition-colors shadow-sm">
                                                        <span class="material-symbols-outlined text-[15px]">bar_chart</span>
                                                        <span>Lihat Grafik</span>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr onclick="openKecamatanModal('Kecamatan Moyo Hilir')" class="hover:bg-gov-green-surface/40 cursor-pointer transition-colors group">
                                                <td class="py-3 px-3 font-semibold text-text-primary flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-primary-container text-[18px]">location_on</span>
                                                    <span class="group-hover:text-primary transition-colors">Kecamatan Moyo Hilir</span>
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
                                                <td class="py-3 px-3 text-right">
                                                    <button type="button" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-gov-green-surface text-primary hover:bg-primary hover:text-white font-label-sm text-xs font-semibold transition-colors shadow-sm">
                                                        <span class="material-symbols-outlined text-[15px]">bar_chart</span>
                                                        <span>Lihat Grafik</span>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr onclick="openKecamatanModal('Kecamatan Moyo Utara')" class="hover:bg-gov-green-surface/40 cursor-pointer transition-colors group">
                                                <td class="py-3 px-3 font-semibold text-text-primary flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-primary-container text-[18px]">location_on</span>
                                                    <span class="group-hover:text-secondary transition-colors">Kecamatan Moyo Utara</span>
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
                                                <td class="py-3 px-3 text-right">
                                                    <button type="button" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-status-warning-surface text-secondary hover:bg-secondary hover:text-white font-label-sm text-xs font-semibold transition-colors shadow-sm">
                                                        <span class="material-symbols-outlined text-[15px]">bar_chart</span>
                                                        <span>Lihat Grafik</span>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr onclick="openKecamatanModal('Kecamatan Utan')" class="hover:bg-status-fraud-surface/40 cursor-pointer transition-colors group">
                                                <td class="py-3 px-3 font-semibold text-text-primary flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-error text-[18px]">location_on</span>
                                                    <span class="group-hover:text-error transition-colors">Kecamatan Utan</span>
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
                                                <td class="py-3 px-3 text-right">
                                                    <button type="button" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-status-fraud-surface text-error hover:bg-error hover:text-white font-label-sm text-xs font-semibold transition-colors shadow-sm">
                                                        <span class="material-symbols-outlined text-[15px]">bar_chart</span>
                                                        <span>Lihat Grafik</span>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr onclick="openKecamatanModal('Kecamatan Plampang')" class="hover:bg-gov-green-surface/40 cursor-pointer transition-colors group">
                                                <td class="py-3 px-3 font-semibold text-text-primary flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-primary-container text-[18px]">location_on</span>
                                                    <span class="group-hover:text-secondary transition-colors">Kecamatan Plampang</span>
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
                                                <td class="py-3 px-3 text-right">
                                                    <button type="button" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-status-warning-surface text-secondary hover:bg-secondary hover:text-white font-label-sm text-xs font-semibold transition-colors shadow-sm">
                                                        <span class="material-symbols-outlined text-[15px]">bar_chart</span>
                                                        <span>Lihat Grafik</span>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr onclick="openKecamatanModal('Kecamatan Empang')" class="hover:bg-gov-green-surface/40 cursor-pointer transition-colors group">
                                                <td class="py-3 px-3 font-semibold text-text-primary flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-primary-container text-[18px]">location_on</span>
                                                    <span class="group-hover:text-primary transition-colors">Kecamatan Empang</span>
                                                </td>
                                                <td class="py-3 px-3 font-code-dense text-code-dense">880 KK</td>
                                                <td class="py-3 px-3">
                                                    <span class="font-semibold text-text-primary">780 KK</span>
                                                    <span class="text-text-tertiary font-body-sm text-body-sm block">88.6%</span>
                                                </td>
                                                <td class="py-3 px-3 font-semibold text-status-verified">88.5%</td>
                                                <td class="py-3 px-3">
                                                    <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">Aman</span>
                                                </td>
                                                <td class="py-3 px-3 text-right">
                                                    <button type="button" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-gov-green-surface text-primary hover:bg-primary hover:text-white font-label-sm text-xs font-semibold transition-colors shadow-sm">
                                                        <span class="material-symbols-outlined text-[15px]">bar_chart</span>
                                                        <span>Lihat Grafik</span>
                                                    </button>
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
                                        <span class="text-error font-body-sm text-[11px] block font-semibold">Duplikasi Terdeteksi: 1 NIK Terdaftar Ganda</span>
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

            <!-- MODAL DETAIL & GRAFIK SEBARAN KECAMATAN -->
            <div id="modal-kecamatan-grafik" class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-5 bg-black/60 backdrop-blur-sm transition-all duration-300 opacity-0 pointer-events-none">
                <div id="modal-kecamatan-card" class="relative w-full max-w-5xl max-h-[92vh] overflow-y-auto bg-canvas-bg rounded-2xl shadow-2xl border border-surface-subtle p-5 sm:p-7 flex flex-col gap-6 transform scale-95 transition-all duration-300">
                    
                    <!-- Header Modal -->
                    <div class="flex items-start justify-between border-b border-surface-subtle pb-4">
                        <div class="flex items-center gap-3">
                            <div id="modal-icon-container" class="w-12 h-12 rounded-xl bg-gov-green-surface text-primary flex items-center justify-center shadow-sm">
                                <span class="material-symbols-outlined text-[28px]">explore</span>
                            </div>
                            <div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 id="modal-kecamatan-title" class="font-headline-md text-headline-sm sm:text-headline-md font-bold text-text-primary">Kecamatan Sumbawa</h3>
                                    <span id="modal-kecamatan-badge" class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-status-verified-surface text-primary border border-primary/20">Status: Aman</span>
                                </div>
                                <p id="modal-kecamatan-subtitle" class="text-text-secondary font-body-sm text-xs sm:text-sm mt-0.5">Analisis Sebaran Realisasi Bibit, Survival Rate & Profil Penerima Manfaat</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('pemda.monitoring.index') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-surface-subtle hover:bg-surface-muted text-text-secondary hover:text-text-primary font-label-sm text-xs font-medium transition-colors">
                                <span class="material-symbols-outlined text-[16px]">map</span>
                                <span>Buka Peta GIS</span>
                            </a>
                            <button type="button" onclick="closeKecamatanModal()" class="w-9 h-9 rounded-lg flex items-center justify-center bg-surface-subtle hover:bg-surface-muted text-text-secondary hover:text-text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">close</span>
                            </button>
                        </div>
                    </div>

                    <!-- 4 Kartu KPI Metrik Cepat -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
                        <div class="p-3.5 rounded-xl bg-surface-subtle/70 border border-surface-subtle flex flex-col">
                            <div class="flex items-center justify-between text-text-tertiary mb-1">
                                <span class="text-xs font-semibold">Alokasi Kuota</span>
                                <span class="material-symbols-outlined text-[18px]">groups</span>
                            </div>
                            <span id="stat-kuota" class="text-xl font-bold font-code-dense text-text-primary">1.450 KK</span>
                            <span class="text-[11px] text-text-tertiary mt-0.5">Target SK Bupati 2026</span>
                        </div>

                        <div class="p-3.5 rounded-xl bg-surface-subtle/70 border border-surface-subtle flex flex-col">
                            <div class="flex items-center justify-between text-text-tertiary mb-1">
                                <span class="text-xs font-semibold">Bibit Tersalur</span>
                                <span class="material-symbols-outlined text-[18px]">local_shipping</span>
                            </div>
                            <span id="stat-realisasi" class="text-xl font-bold font-code-dense text-text-primary">1.410 KK</span>
                            <span id="stat-persen-realisasi" class="text-[11px] font-semibold text-primary mt-0.5">97.2% Terpenuhi</span>
                        </div>

                        <div class="p-3.5 rounded-xl bg-surface-subtle/70 border border-surface-subtle flex flex-col">
                            <div class="flex items-center justify-between text-text-tertiary mb-1">
                                <span class="text-xs font-semibold">Survival Rate</span>
                                <span class="material-symbols-outlined text-[18px]">eco</span>
                            </div>
                            <span id="stat-survival" class="text-xl font-bold font-code-dense text-status-verified">92.4%</span>
                            <span id="stat-status-tanaman" class="text-[11px] font-semibold text-primary mt-0.5">Tumbuh Optimal</span>
                        </div>

                        <div class="p-3.5 rounded-xl bg-surface-subtle/70 border border-surface-subtle flex flex-col">
                            <div class="flex items-center justify-between text-text-tertiary mb-1">
                                <span class="text-xs font-semibold">Kluster Dampingan</span>
                                <span class="material-symbols-outlined text-[18px]">hub</span>
                            </div>
                            <span id="stat-poktan" class="text-xl font-bold font-code-dense text-text-primary">18 Titik Dampingan</span>
                            <span id="stat-desa-count" class="text-[11px] text-text-tertiary mt-0.5">8 Desa Terjangkau</span>
                        </div>
                    </div>

                    <!-- Row Grafik Utama: Bar vs Doughnut -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
                        <!-- Grafik 1: Tren Realisasi Bulanan (7 cols) -->
                        <div class="lg:col-span-7 p-4 sm:p-5 rounded-xl bg-surface-subtle/40 border border-surface-subtle flex flex-col">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <h4 class="font-bold text-sm sm:text-base text-text-primary flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-primary text-[18px]">analytics</span>
                                        Progres Distribusi Bulanan (Jan - Jun 2026)
                                    </h4>
                                    <span class="text-xs text-text-tertiary">Perbandingan target kuota alokasi vs bibit terdistribusi (Kg/Pcs)</span>
                                </div>
                            </div>
                            <div class="w-full h-[220px] sm:h-[240px] relative">
                                <canvas id="chart-tren-bulanan"></canvas>
                            </div>
                        </div>

                        <!-- Grafik 2: Komposisi Komoditas (5 cols) -->
                        <div class="lg:col-span-5 p-4 sm:p-5 rounded-xl bg-surface-subtle/40 border border-surface-subtle flex flex-col">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <h4 class="font-bold text-sm sm:text-base text-text-primary flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-secondary text-[18px]">pie_chart</span>
                                        Proporsi Komoditas Bibit
                                    </h4>
                                    <span class="text-xs text-text-tertiary">Jenis varietas tanaman terdistribusi</span>
                                </div>
                            </div>
                            <div class="w-full h-[220px] sm:h-[240px] relative flex items-center justify-center">
                                <canvas id="chart-komposisi-komoditas"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Row Grafik Bawah: Profil Kemiskinan Desil & Daftar Desa -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
                        <!-- Grafik 3: Sebaran Desil Penerima Manfaat (6 cols) -->
                        <div class="lg:col-span-6 p-4 sm:p-5 rounded-xl bg-surface-subtle/40 border border-surface-subtle flex flex-col">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <h4 class="font-bold text-sm sm:text-base text-text-primary flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-primary text-[18px]">bar_chart</span>
                                        Sebaran Desil Kesejahteraan (P3KE / DTKS)
                                    </h4>
                                    <span class="text-xs text-text-tertiary">Prioritas sasaran kemiskinan ekstrem & pencegahan stunting</span>
                                </div>
                            </div>
                            <div class="w-full h-[180px] sm:h-[200px] relative">
                                <canvas id="chart-desil-kesejahteraan"></canvas>
                            </div>
                        </div>

                        <!-- Ringkasan Sebaran Titik Desa Binaan (6 cols) -->
                        <div class="lg:col-span-6 p-4 sm:p-5 rounded-xl bg-surface-subtle/40 border border-surface-subtle flex flex-col">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <h4 class="font-bold text-sm sm:text-base text-text-primary flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-primary text-[18px]">holiday_village</span>
                                        Sampel Desa & Status Audit Terkini
                                    </h4>
                                    <span class="text-xs text-text-tertiary">Hasil verifikasi lapangan pendamping & validator</span>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-xs border-collapse">
                                    <thead>
                                        <tr class="border-b border-surface-subtle text-text-secondary">
                                            <th class="py-2 px-2.5">Desa</th>
                                            <th class="py-2 px-2.5">Kluster / Dusun Dampingan</th>
                                            <th class="py-2 px-2.5">Alokasi</th>
                                            <th class="py-2 px-2.5 text-right">Status Audit</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-desa-list" class="divide-y divide-surface-subtle">
                                        <!-- Diisi secara dinamis -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Modal -->
                    <div class="flex items-center justify-between pt-3 border-t border-surface-subtle">
                        <div class="flex items-center gap-2 text-xs text-text-tertiary">
                            <span class="material-symbols-outlined text-[16px] text-primary">verified</span>
                            <span>Data tersinkronisasi otomatis dengan SIG Geotagging & e-Walidata Pemkab Sumbawa</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <button type="button" onclick="closeKecamatanModal()" class="px-4 py-2 rounded-xl bg-surface-subtle hover:bg-surface-muted text-text-primary font-label-md text-xs sm:text-sm font-semibold transition-colors">
                                Tutup
                            </button>
                            <a href="{{ route('pemda.monitoring.index') }}" class="px-4 py-2 rounded-xl bg-primary hover:bg-gov-green text-on-primary font-label-md text-xs sm:text-sm font-semibold transition-colors flex items-center gap-1.5 shadow-sm">
                                <span class="material-symbols-outlined text-[18px]">satellite_alt</span>
                                <span>Analisis Spasial GIS</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- CDN Chart.js & Script Pengendali Grafik Interaktif -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // Database Statistik Interaktif Kecamatan se-Kabupaten Sumbawa
                const kecamatanDatabase = {
                    'Kecamatan Sumbawa': {
                        kuota: '1.450 KK',
                        realisasi: '1.410 KK',
                        persenRealisasi: '97.2% Terpenuhi',
                        survival: '92.4%',
                        statusTanaman: 'Tumbuh Optimal',
                        status: 'Aman',
                        statusClass: 'bg-status-verified-surface text-primary border-primary/20',
                        survivalColor: 'text-status-verified',
                        iconBg: 'bg-gov-green-surface text-primary',
                        titikDampingan: '18 Titik Dampingan',
                        desaCount: '8 Desa Terjangkau',
                        trenLabels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                        trenTarget: [250, 500, 750, 1050, 1300, 1450],
                        trenRealisasi: [240, 490, 760, 1030, 1280, 1410],
                        komoditasLabels: ['Jagung Hibrida', 'Padi Gogo', 'Cabai Rawit', 'Bawang Merah', 'Kedelai'],
                        komoditasData: [45, 25, 15, 10, 5],
                        desilData: [480, 520, 310, 120, 20],
                        desaList: [
                            { desa: 'Brang Bara', kluster: 'Dusun Brang Bara (45 KK Binaan)', alokasi: '350 KK', status: 'Terverifikasi 100%' },
                            { desa: 'Lempeh', kluster: 'Dusun Lempeh Selatan (52 KK Binaan)', alokasi: '420 KK', status: 'Terverifikasi 100%' },
                            { desa: 'Seketi', kluster: 'Dusun Seketi Baru (40 KK Binaan)', alokasi: '380 KK', status: 'Monitoring Lapangan' },
                            { desa: 'Uma Sima', kluster: 'Dusun Uma Sima (35 KK Binaan)', alokasi: '260 KK', status: 'Terverifikasi 100%' }
                        ]
                    },
                    'Kecamatan Moyo Hilir': {
                        kuota: '1.200 KK',
                        realisasi: '1.150 KK',
                        persenRealisasi: '95.8% Terpenuhi',
                        survival: '86.1%',
                        statusTanaman: 'Kondisi Baik',
                        status: 'Aman',
                        statusClass: 'bg-status-verified-surface text-primary border-primary/20',
                        survivalColor: 'text-status-verified',
                        iconBg: 'bg-gov-green-surface text-primary',
                        titikDampingan: '15 Titik Dampingan',
                        desaCount: '7 Desa Terjangkau',
                        trenLabels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                        trenTarget: [200, 420, 650, 880, 1050, 1200],
                        trenRealisasi: [190, 410, 630, 850, 1010, 1150],
                        komoditasLabels: ['Jagung Hibrida', 'Padi Sawah', 'Kacang Tanah', 'Cabai Rawit', 'Bawang Merah'],
                        komoditasData: [50, 30, 10, 6, 4],
                        desilData: [390, 450, 220, 75, 15],
                        desaList: [
                            { desa: 'Kakiang', kluster: 'Dusun Kakiang Bawah (40 KK Binaan)', alokasi: '320 KK', status: 'Terverifikasi 100%' },
                            { desa: 'Serading', kluster: 'Dusun Serading (38 KK Binaan)', alokasi: '290 KK', status: 'Monitoring Lapangan' },
                            { desa: 'Poto', kluster: 'Dusun Poto Timur (42 KK Binaan)', alokasi: '310 KK', status: 'Terverifikasi 100%' },
                            { desa: 'Berare', kluster: 'Dusun Berare Mandiri (30 KK Binaan)', alokasi: '230 KK', status: 'Uji Petik Lapangan' }
                        ]
                    },
                    'Kecamatan Moyo Utara': {
                        kuota: '980 KK',
                        realisasi: '890 KK',
                        persenRealisasi: '90.8% Terpenuhi',
                        survival: '78.5%',
                        statusTanaman: 'Perlu Pengawasan',
                        status: 'Perhatian',
                        statusClass: 'bg-status-warning-surface text-secondary border-secondary/20',
                        survivalColor: 'text-secondary',
                        iconBg: 'bg-status-warning-surface text-secondary',
                        titikDampingan: '12 Titik Dampingan',
                        desaCount: '6 Desa Terjangkau',
                        trenLabels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                        trenTarget: [180, 360, 540, 720, 880, 980],
                        trenRealisasi: [150, 310, 480, 660, 800, 890],
                        komoditasLabels: ['Padi Gogo', 'Jagung Hibrida', 'Bawang Merah', 'Semangka', 'Kacang Hijau'],
                        komoditasData: [40, 35, 12, 8, 5],
                        desilData: [340, 320, 160, 55, 15],
                        desaList: [
                            { desa: 'Sebewe', kluster: 'Dusun Sebewe (32 KK Binaan)', alokasi: '240 KK', status: 'Monitoring Intensif' },
                            { desa: 'Kukin', kluster: 'Dusun Kukin Pesisir (28 KK Binaan)', alokasi: '220 KK', status: 'Menunggu Validasi' },
                            { desa: 'Baru Tahan', kluster: 'Dusun Baru Tahan (36 KK Binaan)', alokasi: '260 KK', status: 'Monitoring Lapangan' },
                            { desa: 'Songkar', kluster: 'Dusun Songkar (24 KK Binaan)', alokasi: '170 KK', status: 'Terverifikasi 100%' }
                        ]
                    },
                    'Kecamatan Utan': {
                        kuota: '1.100 KK',
                        realisasi: '820 KK',
                        persenRealisasi: '74.5% Tersendat',
                        survival: '46.2%',
                        statusTanaman: 'Anomali Pertumbuhan',
                        status: 'Anomali',
                        statusClass: 'bg-status-fraud-surface text-error border-error/20',
                        survivalColor: 'text-error',
                        iconBg: 'bg-status-fraud-surface text-error',
                        titikDampingan: '14 Titik Dampingan',
                        desaCount: '6 Desa Terdampak',
                        trenLabels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                        trenTarget: [200, 400, 620, 820, 980, 1100],
                        trenRealisasi: [160, 320, 470, 610, 740, 820],
                        komoditasLabels: ['Jagung Hibrida', 'Cabai Rawit', 'Bawang Merah', 'Padi', 'Tomat'],
                        komoditasData: [60, 20, 10, 6, 4],
                        desilData: [410, 260, 110, 30, 10],
                        desaList: [
                            { desa: 'Labuhan Burung', kluster: 'Dusun Burung Pesisir (36 KK Binaan)', alokasi: '280 KK', status: 'Investigasi Lapangan' },
                            { desa: 'Motong', kluster: 'Dusun Motong Timur (30 KK Binaan)', alokasi: '210 KK', status: 'Anomali Survival 44%' },
                            { desa: 'Sabedo', kluster: 'Dusun Sabedo (26 KK Binaan)', alokasi: '190 KK', status: 'Perlu Uji Petik Ulang' },
                            { desa: 'Pukat', kluster: 'Dusun Pukat Makmur (20 KK Binaan)', alokasi: '140 KK', status: 'Monitoring Intensif' }
                        ]
                    },
                    'Kecamatan Plampang': {
                        kuota: '1.050 KK',
                        realisasi: '690 KK',
                        persenRealisasi: '65.7% Menunggu Tahap 2',
                        survival: '64.0%',
                        statusTanaman: 'Kurang Pasokan Air',
                        status: 'Perhatian',
                        statusClass: 'bg-status-warning-surface text-secondary border-secondary/20',
                        survivalColor: 'text-secondary',
                        iconBg: 'bg-status-warning-surface text-secondary',
                        titikDampingan: '13 Titik Dampingan',
                        desaCount: '6 Desa Terjangkau',
                        trenLabels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                        trenTarget: [180, 360, 560, 740, 900, 1050],
                        trenRealisasi: [140, 270, 410, 540, 620, 690],
                        komoditasLabels: ['Jagung Hibrida', 'Kacang Kedelai', 'Padi Gogo', 'Sorgum', 'Cabai'],
                        komoditasData: [55, 20, 15, 6, 4],
                        desilData: [320, 230, 105, 25, 10],
                        desaList: [
                            { desa: 'Sepakat', kluster: 'Dusun Sepakat Jaya (31 KK Binaan)', alokasi: '230 KK', status: 'Menunggu Uji Petik' },
                            { desa: 'Plampang', kluster: 'Dusun Plampang Tengah (29 KK Binaan)', alokasi: '210 KK', status: 'Monitoring Lapangan' },
                            { desa: 'Teluk Santong', kluster: 'Dusun Teluk (22 KK Binaan)', alokasi: '150 KK', status: 'Terverifikasi 100%' },
                            { desa: 'Muer', kluster: 'Dusun Muer (16 KK Binaan)', alokasi: '100 KK', status: 'Perlu Konfirmasi CPCL' }
                        ]
                    },
                    'Kecamatan Empang': {
                        kuota: '880 KK',
                        realisasi: '780 KK',
                        persenRealisasi: '88.6% Terpenuhi',
                        survival: '88.5%',
                        statusTanaman: 'Pertumbuhan Baik',
                        status: 'Aman',
                        statusClass: 'bg-status-verified-surface text-primary border-primary/20',
                        survivalColor: 'text-status-verified',
                        iconBg: 'bg-gov-green-surface text-primary',
                        titikDampingan: '11 Titik Dampingan',
                        desaCount: '5 Desa Terjangkau',
                        trenLabels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                        trenTarget: [150, 300, 460, 620, 760, 880],
                        trenRealisasi: [140, 290, 440, 590, 710, 780],
                        komoditasLabels: ['Jagung Hibrida', 'Padi Gogo', 'Bawang Merah', 'Kacang Tanah', 'Sayuran'],
                        komoditasData: [52, 28, 10, 6, 4],
                        desilData: [310, 290, 130, 40, 10],
                        desaList: [
                            { desa: 'Empang Bawa', kluster: 'Dusun Empang Bawa (35 KK Binaan)', alokasi: '260 KK', status: 'Terverifikasi 100%' },
                            { desa: 'Empang Atas', kluster: 'Dusun Empang Atas (30 KK Binaan)', alokasi: '220 KK', status: 'Terverifikasi 100%' },
                            { desa: 'Jotang', kluster: 'Dusun Jotang Subur (25 KK Binaan)', alokasi: '180 KK', status: 'Monitoring Lapangan' },
                            { desa: 'Bonto', kluster: 'Dusun Bonto (18 KK Binaan)', alokasi: '120 KK', status: 'Terverifikasi 100%' }
                        ]
                    },
                    'Kecamatan Alas': {
                        kuota: '950 KK',
                        realisasi: '870 KK',
                        persenRealisasi: '91.5% Terpenuhi',
                        survival: '89.2%',
                        statusTanaman: 'Pertumbuhan Baik',
                        status: 'Aman',
                        statusClass: 'bg-status-verified-surface text-primary border-primary/20',
                        survivalColor: 'text-status-verified',
                        iconBg: 'bg-gov-green-surface text-primary',
                        titikDampingan: '12 Titik Dampingan',
                        desaCount: '6 Desa Terjangkau',
                        trenLabels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                        trenTarget: [160, 320, 500, 670, 820, 950],
                        trenRealisasi: [150, 310, 480, 640, 780, 870],
                        komoditasLabels: ['Padi Sawah', 'Jagung Hibrida', 'Cabai Merah', 'Bawang Merah', 'Kacang Hijau'],
                        komoditasData: [48, 32, 10, 6, 4],
                        desilData: [360, 330, 140, 32, 8],
                        desaList: [
                            { desa: 'Luar', kluster: 'Dusun Luar (32 KK Binaan)', alokasi: '240 KK', status: 'Terverifikasi 100%' },
                            { desa: 'Dalam', kluster: 'Dusun Dalam (28 KK Binaan)', alokasi: '210 KK', status: 'Terverifikasi 100%' },
                            { desa: 'Kalimango', kluster: 'Dusun Kalimango (30 KK Binaan)', alokasi: '230 KK', status: 'Monitoring Lapangan' },
                            { desa: 'Juring', kluster: 'Dusun Juring (25 KK Binaan)', alokasi: '190 KK', status: 'Terverifikasi 100%' }
                        ]
                    }
                };

                // Fallback generator untuk kecamatan lainnya di Sumbawa
                function getKecamatanData(name) {
                    // Cek exact match atau fuzzy match
                    for (const key in kecamatanDatabase) {
                        if (name.toLowerCase().includes(key.replace('Kecamatan ', '').toLowerCase())) {
                            return kecamatanDatabase[key];
                        }
                    }

                    // Default dummy generator realistis
                    return {
                        kuota: '850 KK',
                        realisasi: '760 KK',
                        persenRealisasi: '89.4% Terpenuhi',
                        survival: '85.0%',
                        statusTanaman: 'Kondisi Normal',
                        status: 'Aman',
                        statusClass: 'bg-status-verified-surface text-primary border-primary/20',
                        survivalColor: 'text-status-verified',
                        iconBg: 'bg-gov-green-surface text-primary',
                        titikDampingan: '10 Titik Dampingan',
                        desaCount: '5 Desa Terjangkau',
                        trenLabels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                        trenTarget: [140, 280, 440, 600, 730, 850],
                        trenRealisasi: [130, 260, 410, 560, 680, 760],
                        komoditasLabels: ['Jagung Hibrida', 'Padi Gogo', 'Cabai Rawit', 'Bawang Merah', 'Kacang Hijau'],
                        komoditasData: [50, 25, 12, 8, 5],
                        desilData: [290, 280, 130, 45, 15],
                        desaList: [
                            { desa: 'Desa Pusat', kluster: 'Dusun Krajan (35 KK Binaan)', alokasi: '250 KK', status: 'Terverifikasi 100%' },
                            { desa: 'Desa Timur', kluster: 'Dusun Harapan Baru (28 KK Binaan)', alokasi: '200 KK', status: 'Monitoring Lapangan' },
                            { desa: 'Desa Barat', kluster: 'Dusun Barat Lestari (25 KK Binaan)', alokasi: '180 KK', status: 'Terverifikasi 100%' },
                            { desa: 'Desa Selatan', kluster: 'Dusun Selatan Sejahtera (18 KK Binaan)', alokasi: '130 KK', status: 'Terverifikasi 100%' }
                        ]
                    };
                }

                // Global references ke instance Chart.js
                let chartTrenBulananInstance = null;
                let chartKomposisiKomoditasInstance = null;
                let chartDesilInstance = null;

                function openKecamatanModal(namaKecamatan) {
                    if (!namaKecamatan || namaKecamatan === 'Semua Kecamatan') {
                        namaKecamatan = 'Kecamatan Sumbawa';
                    }

                    // Normalkan nama
                    const displayName = namaKecamatan.startsWith('Kecamatan') ? namaKecamatan : `Kecamatan ${namaKecamatan}`;
                    const data = getKecamatanData(displayName);

                    // Update UI teks & badge
                    document.getElementById('modal-kecamatan-title').textContent = displayName;
                    const badgeElem = document.getElementById('modal-kecamatan-badge');
                    badgeElem.className = `px-2.5 py-0.5 rounded-full text-xs font-bold border ${data.statusClass}`;
                    badgeElem.textContent = `Status: ${data.status} (${data.survival})`;

                    document.getElementById('modal-icon-container').className = `w-12 h-12 rounded-xl flex items-center justify-center shadow-sm ${data.iconBg}`;

                    // Update KPI cards
                    document.getElementById('stat-kuota').textContent = data.kuota;
                    document.getElementById('stat-realisasi').textContent = data.realisasi;
                    document.getElementById('stat-persen-realisasi').textContent = data.persenRealisasi;
                    
                    const statSurvivalElem = document.getElementById('stat-survival');
                    statSurvivalElem.textContent = data.survival;
                    statSurvivalElem.className = `text-xl font-bold font-code-dense ${data.survivalColor}`;
                    document.getElementById('stat-status-tanaman').textContent = data.statusTanaman;

                    document.getElementById('stat-poktan').textContent = data.titikDampingan || data.poktan;
                    document.getElementById('stat-desa-count').textContent = data.desaCount;

                    // Update Tabel Desa
                    const tbody = document.getElementById('table-desa-list');
                    tbody.innerHTML = '';
                    data.desaList.forEach(item => {
                        const tr = document.createElement('tr');
                        tr.className = 'hover:bg-surface-subtle/80 transition-colors';
                        
                        let badgeStyle = 'bg-status-verified-surface text-primary';
                        if (item.status.includes('Investigasi') || item.status.includes('Anomali')) {
                            badgeStyle = 'bg-status-fraud-surface text-error';
                        } else if (item.status.includes('Menunggu') || item.status.includes('Uji Petik') || item.status.includes('Intensif')) {
                            badgeStyle = 'bg-status-warning-surface text-secondary';
                        }

                        tr.innerHTML = `
                            <td class="py-2 px-2.5 font-semibold text-text-primary">${item.desa}</td>
                            <td class="py-2 px-2.5 text-text-secondary">${item.kluster || item.poktan}</td>
                            <td class="py-2 px-2.5 font-code-dense font-medium">${item.alokasi}</td>
                            <td class="py-2 px-2.5 text-right">
                                <span class="inline-block px-2 py-0.5 rounded-full text-[11px] font-bold ${badgeStyle}">${item.status}</span>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });

                    // Render / Update Chart.js
                    renderCharts(data);

                    // Tampilkan modal dengan animasi fade in
                    const modal = document.getElementById('modal-kecamatan-grafik');
                    const card = document.getElementById('modal-kecamatan-card');
                    modal.classList.remove('opacity-0', 'pointer-events-none');
                    modal.classList.add('opacity-100', 'pointer-events-auto');
                    card.classList.remove('scale-95');
                    card.classList.add('scale-100');
                    document.body.style.overflow = 'hidden';
                }

                function closeKecamatanModal() {
                    const modal = document.getElementById('modal-kecamatan-grafik');
                    const card = document.getElementById('modal-kecamatan-card');
                    modal.classList.add('opacity-0', 'pointer-events-none');
                    modal.classList.remove('opacity-100', 'pointer-events-auto');
                    card.classList.add('scale-95');
                    card.classList.remove('scale-100');
                    document.body.style.overflow = '';
                }

                // Render Chart.js
                function renderCharts(data) {
                    if (typeof Chart === 'undefined') return;

                    // 1. Chart Realisasi Bulanan (Target vs Realisasi)
                    const ctxTren = document.getElementById('chart-tren-bulanan').getContext('2d');
                    if (chartTrenBulananInstance) {
                        chartTrenBulananInstance.destroy();
                    }
                    chartTrenBulananInstance = new Chart(ctxTren, {
                        type: 'bar',
                        data: {
                            labels: data.trenLabels,
                            datasets: [
                                {
                                    label: 'Realisasi Bibit (KK)',
                                    data: data.trenRealisasi,
                                    backgroundColor: '#1E5631',
                                    borderRadius: 6,
                                    barPercentage: 0.6,
                                    order: 2
                                },
                                {
                                    label: 'Target Alokasi (KK)',
                                    data: data.trenTarget,
                                    type: 'line',
                                    borderColor: '#D97706',
                                    backgroundColor: '#D97706',
                                    borderWidth: 2,
                                    borderDash: [5, 5],
                                    fill: false,
                                    pointRadius: 4,
                                    pointBackgroundColor: '#D97706',
                                    tension: 0.2,
                                    order: 1
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        boxWidth: 12,
                                        font: { size: 11, family: 'Inter, sans-serif' }
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return `${context.dataset.label}: ${context.raw.toLocaleString('id-ID')} KK`;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: { color: 'rgba(0, 0, 0, 0.05)' },
                                    ticks: { font: { size: 10 } }
                                },
                                x: {
                                    grid: { display: false },
                                    ticks: { font: { size: 11 } }
                                }
                            }
                        }
                    });

                    // 2. Chart Komposisi Komoditas (Doughnut)
                    const ctxKomoditas = document.getElementById('chart-komposisi-komoditas').getContext('2d');
                    if (chartKomposisiKomoditasInstance) {
                        chartKomposisiKomoditasInstance.destroy();
                    }
                    chartKomposisiKomoditasInstance = new Chart(ctxKomoditas, {
                        type: 'doughnut',
                        data: {
                            labels: data.komoditasLabels,
                            datasets: [{
                                data: data.komoditasData,
                                backgroundColor: [
                                    '#1E5631', // Gov Green
                                    '#3B82F6', // Blue
                                    '#F59E0B', // Amber
                                    '#EC4899', // Pink / Merah
                                    '#10B981'  // Emerald
                                ],
                                borderWidth: 2,
                                borderColor: '#FFFFFF',
                                hoverOffset: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'right',
                                    labels: {
                                        boxWidth: 12,
                                        font: { size: 11, family: 'Inter, sans-serif' }
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return `${context.label}: ${context.raw}% alokasi`;
                                        }
                                    }
                                }
                            },
                            cutout: '62%'
                        }
                    });

                    // 3. Chart Desil Kesejahteraan (Horizontal Bar)
                    const ctxDesil = document.getElementById('chart-desil-kesejahteraan').getContext('2d');
                    if (chartDesilInstance) {
                        chartDesilInstance.destroy();
                    }
                    chartDesilInstance = new Chart(ctxDesil, {
                        type: 'bar',
                        data: {
                            labels: ['Desil 1 (Ekstrem)', 'Desil 2 (Sangat Miskin)', 'Desil 3 (Miskin)', 'Desil 4 (Rentan)', 'Desil 5+'],
                            datasets: [{
                                label: 'Jumlah Penerima (KK)',
                                data: data.desilData,
                                backgroundColor: [
                                    '#B91C1C', // Merah gelap
                                    '#EA580C', // Oranye
                                    '#F59E0B', // Kuning
                                    '#10B981', // Hijau
                                    '#6B7280'  // Abu
                                ],
                                borderRadius: 5,
                                barPercentage: 0.65
                            }]
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return `Penerima: ${context.raw} KK`;
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    grid: { color: 'rgba(0, 0, 0, 0.05)' },
                                    ticks: { font: { size: 10 } }
                                },
                                y: {
                                    grid: { display: false },
                                    ticks: { font: { size: 11, weight: '500' } }
                                }
                            }
                        }
                    });
                }

                // Tutup modal jika klik di luar card atau tekan tombol Escape
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape') {
                        closeKecamatanModal();
                    }
                });

                document.getElementById('modal-kecamatan-grafik').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeKecamatanModal();
                    }
                });
            </script>
@endsection
