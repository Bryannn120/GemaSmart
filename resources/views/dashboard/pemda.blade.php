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
                            <span class="text-text-tertiary text-body-sm font-body-sm">Pembaruan: Hari ini, {{ date('H:i') }} WITA</span>
                        </div>
                        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Dashboard Monitoring Program Bantuan</h1>
                        <p class="font-body-md text-text-secondary mt-1">
                            Monitoring terpadu program bantuan daerah (bibit, bantuan dana usaha tani, alat/fasilitas), pemantauan desil kemandirian keluarga, dan sebaran wilayah se-Kabupaten Sumbawa.
                        </p>
                    </div>
                    <!-- Controls -->
                    <div class="flex flex-wrap items-center gap-space-sm">
                        <div class="relative bg-canvas-bg rounded-xl shadow-sm border border-border-light">
                            <select class="appearance-none font-label-md text-label-md text-text-primary bg-transparent pl-space-md pr-8 py-2 rounded-xl cursor-pointer focus:outline-none focus:bg-surface-subtle">
                                <option>Tahun Anggaran 2026</option>
                                <option>Tahun Anggaran 2025</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-2 top-2.5 text-text-secondary text-[18px] pointer-events-none">expand_more</span>
                        </div>
                        <div class="relative bg-canvas-bg rounded-xl shadow-sm border border-border-light">
                            <select id="select-kecamatan-quick" onchange="if(this.value && this.value !== 'Semua') openKecamatanModal(this.value)" class="appearance-none font-label-md text-label-md text-text-primary bg-transparent pl-space-md pr-8 py-2 rounded-xl cursor-pointer focus:outline-none focus:bg-surface-subtle">
                                <option value="Semua">-- Pilih Kecamatan untuk Lihat Grafik --</option>
                                @foreach($kecamatans as $kec)
                                <option value="{{ $kec->nama }}">{{ $kec->nama }}</option>
                                @endforeach
                            </select>
                            <span class="material-symbols-outlined absolute right-2 top-2.5 text-text-secondary text-[18px] pointer-events-none">expand_more</span>
                        </div>
                        <a href="{{ route('pemda.laporan.pdf') }}" target="_blank" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                            <span class="material-symbols-outlined text-[18px]">download</span>
                            <span>Unduh Ringkasan PDF</span>
                        </a>
                    </div>
                </div>

                <!-- RINGKASAN KEUANGAN: Dana Bappeda ke Kampus & Pengurangan Penggunaan -->
                <div class="p-space-lg rounded-2xl bg-gradient-to-r from-gov-green-dark to-primary-container text-white shadow-sm border border-primary/20 flex flex-col gap-space-md">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 border-b border-white/20 pb-space-sm">
                        <div class="flex items-center gap-2">
                            <span class="p-2 rounded-lg bg-white/20 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-[22px]">account_balance</span>
                            </span>
                            <div>
                                <h2 class="text-base font-bold text-white tracking-tight">Alokasi Dana Bappeda ke Kampus Mitra &amp; Realisasi Penggunaan Kas</h2>
                                <p class="text-xs text-white/80">Total pagu hibah bantuan yang diserahkan Bappeda kepada seluruh Kampus Mitra dan serapan riil di lapangan</p>
                            </div>
                        </div>
                        <a href="{{ route('pemda.kampus-mitra.index') }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-white/20 hover:bg-white/30 text-white text-xs font-semibold backdrop-blur-sm transition-colors w-fit">
                            <span>Kelola Kampus Mitra</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
                        <div class="p-space-md rounded-xl bg-white/10 backdrop-blur-md border border-white/15">
                            <span class="text-xs text-white/75 font-medium uppercase tracking-wider block">Dana Diberikan Bappeda ke Kampus</span>
                            <div class="text-2xl lg:text-3xl font-extrabold text-white mt-1 tracking-tight">
                                Rp {{ number_format($totalDanaBappeda ?? 0, 0, ',', '.') }}
                            </div>
                            <span class="text-[11px] text-white/70 mt-1 block">Total alokasi pagu kampus mitra</span>
                        </div>

                        <div class="p-space-md rounded-xl bg-white/10 backdrop-blur-md border border-white/15">
                            <span class="text-xs text-amber-200 font-medium uppercase tracking-wider block flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">trending_down</span>
                                <span>Total Penggunaan Dana (-)</span>
                            </span>
                            <div class="text-2xl lg:text-3xl font-extrabold text-amber-300 mt-1 tracking-tight">
                                Rp {{ number_format($totalDanaTerpakai ?? 0, 0, ',', '.') }}
                            </div>
                            <span class="text-[11px] text-white/70 mt-1 block">Realisasi bantuan tersalur ke masyarakat</span>
                        </div>

                        <div class="p-space-md rounded-xl bg-white/20 backdrop-blur-md border border-white/30 shadow-inner">
                            <span class="text-xs text-emerald-200 font-bold uppercase tracking-wider block flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">savings</span>
                                <span>Sisa Saldo Kas Kampus (=)</span>
                            </span>
                            <div class="text-2xl lg:text-3xl font-extrabold text-white mt-1 tracking-tight">
                                Rp {{ number_format($totalSisaDana ?? 0, 0, ',', '.') }}
                            </div>
                            <span class="text-[11px] text-emerald-100 mt-1 font-medium block">Sisa dana tersisa siap disalurkan (Serapan: {{ $persenSerapanBappeda }}%)</span>
                        </div>
                    </div>
                </div>

                <!-- KPI Cards Grid (4 Columns) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-space-lg">
                    <!-- Card 1: Program Bantuan & Pagu Dana -->
                    <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-between relative overflow-hidden">
                        <div class="flex items-start justify-between">
                            <div class="w-10 h-10 rounded-xl bg-status-verified-surface flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-[24px]">folder_open</span>
                            </div>
                            <span class="inline-flex items-center gap-0.5 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
                                {{ $totalProgram ?? 0 }} Program Aktif
                            </span>
                        </div>
                        <div class="mt-space-md">
                            <span class="font-label-md text-label-md text-text-secondary block">Bantuan Dana Tersalurkan</span>
                            <span class="font-headline-xl text-headline-xl text-text-primary font-bold tracking-tight block mt-1">Rp {{ number_format($totalUangDisalurkan ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="mt-space-md pt-space-sm bg-surface-subtle -mx-space-lg -mb-space-lg p-space-md border-t border-border-light">
                            <div class="flex justify-between items-center text-text-secondary font-body-sm text-body-sm">
                                <span>Kategori Bantuan:</span>
                                <strong class="text-text-primary font-semibold">Tunai, Bibit &amp; Alat</strong>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card 2: Keluarga Penerima & Penyaluran -->
                    <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-between relative overflow-hidden">
                        <div class="flex items-start justify-between">
                            <div class="w-10 h-10 rounded-xl bg-gold-surface flex items-center justify-center text-secondary">
                                <span class="material-symbols-outlined text-[24px]">groups</span>
                            </div>
                            <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
                                Binaan Aktif
                            </span>
                        </div>
                        <div class="mt-space-md">
                            <span class="font-label-md text-label-md text-text-secondary block">Penerima Bantuan Aktif</span>
                            <span class="font-headline-xl text-headline-xl text-text-primary font-bold tracking-tight block mt-1">{{ $totalPenerima ?? 0 }} KK</span>
                        </div>
                        <div class="mt-space-md pt-space-sm bg-surface-subtle -mx-space-lg -mb-space-lg p-space-md border-t border-border-light">
                            <div class="flex justify-between items-center text-text-secondary font-body-sm text-body-sm">
                                <span>Lulus Mandiri (Desil 6+):</span>
                                <strong class="text-emerald-700 font-semibold">{{ $totalMandiri ?? 0 }} KK</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Realisasi Fisik (Barang & Bibit) -->
                    <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-between relative overflow-hidden">
                        <div class="flex items-start justify-between">
                            <div class="w-10 h-10 rounded-xl bg-status-verified-surface flex items-center justify-center text-status-verified">
                                <span class="material-symbols-outlined text-[24px]">psychiatry</span>
                            </div>
                            <span class="inline-flex items-center gap-1 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-status-verified font-bold">
                                <span class="material-symbols-outlined text-[13px]">eco</span>
                                Tumbuh &amp; Produktif
                            </span>
                        </div>
                        <div class="mt-space-md">
                            <span class="font-label-md text-label-md text-text-secondary block">Barang &amp; Bibit Tersalur</span>
                            <div class="flex items-baseline gap-2 mt-1">
                                <span class="font-headline-xl text-headline-xl text-text-primary font-bold tracking-tight">{{ number_format($totalBarangDisalurkan ?? 0) }} <span class="text-sm font-normal text-text-secondary">Alat</span> • {{ number_format($totalBibitDisalurkan ?? 0) }} <span class="text-sm font-normal text-text-secondary">Bibit</span></span>
                            </div>
                        </div>
                        <div class="mt-space-md pt-space-sm bg-surface-subtle -mx-space-lg -mb-space-lg p-space-md border-t border-border-light">
                            <div class="flex justify-between items-center text-text-secondary font-body-sm text-body-sm">
                                <span>Laporan Tumbuh Kembang:</span>
                                <strong class="text-text-primary font-semibold">{{ $totalLaporanKembang ?? 0 }} Laporan</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Evaluasi Kemandirian & Desil -->
                    <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-between relative overflow-hidden">
                        <div class="flex items-start justify-between">
                            <div class="w-10 h-10 rounded-xl bg-status-info-surface flex items-center justify-center text-status-info">
                                <span class="material-symbols-outlined text-[24px]">query_stats</span>
                            </div>
                            <span class="inline-flex items-center gap-1 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-gov-green-surface text-primary font-bold">
                                Kemandirian
                            </span>
                        </div>
                        <div class="mt-space-md">
                            <span class="font-label-md text-label-md text-text-secondary block">Evaluasi Desil &amp; Kemandirian</span>
                            <span class="font-headline-xl text-headline-xl text-text-primary font-bold tracking-tight block mt-1">{{ $totalAsesmen ?? 0 }} Asesmen</span>
                        </div>
                        <div class="mt-space-md pt-space-sm bg-surface-subtle -mx-space-lg -mb-space-lg p-space-md border-t border-border-light">
                            <div class="flex justify-between items-center text-text-secondary font-body-sm text-body-sm">
                                <span>Mitra Kerja Sama:</span>
                                <strong class="text-text-primary font-semibold">{{ $totalKampus ?? 0 }} Kampus • {{ $totalPendamping ?? 0 }} Pendamping</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Analytical Section: 2 Columns (7 cols : 5 cols) -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg">
                    <!-- Left Column (7 cols): Map & Regional Cluster Breakdown -->
                    <div class="lg:col-span-7 flex flex-col gap-space-lg">
                        <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm pb-space-md">
                                <div class="flex items-center gap-space-sm">
                                    <div class="w-8 h-8 rounded-lg bg-surface-muted flex items-center justify-center text-primary-container">
                                        <span class="material-symbols-outlined text-[20px]">map</span>
                                    </div>
                                    <div>
                                        <h2 class="font-headline-sm text-headline-sm text-text-primary font-bold">Peta Sebaran &amp; Distribusi Kecamatan</h2>
                                        <span class="font-body-sm text-body-sm text-text-secondary">Monitoring wilayah penyaluran bantuan se-Kabupaten Sumbawa (24 Kecamatan)</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1 font-label-sm text-label-sm text-text-secondary">
                                        <span class="w-2.5 h-2.5 rounded-full bg-status-verified"></span> Aktif
                                    </span>
                                    <span class="inline-flex items-center gap-1 font-label-sm text-label-sm text-text-secondary">
                                        <span class="w-2.5 h-2.5 rounded-full bg-secondary"></span> Wilayah Dampingan
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Interactive GIS Visual Map Canvas -->
                            <div class="relative w-full h-72 rounded-xl overflow-hidden bg-surface-muted flex items-center justify-center shadow-inner border border-border-light">
                                <div class="w-full h-full bg-cover bg-center" data-location="Kabupaten Sumbawa, NTB, Indonesia" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDUy5A14lej1Z07vzdRd2HsyKYue4NZ_ZyWhhhKAR4wuUhqTxQhxkrfJUAvR3E5juh8zfXGsm4XoK7F-_ekZhoUkjAIe2saZifqjavrZUFuZp17D7QCTpbNcwQHTCjn9jGG0A94FbTo9cAMg5ysgEVYom5YEqJuNOL1jzt8DKAnioEEya1zdWn3mOwUGKiK6EGQIYgRQwdbE3NGJ_cHiRZSSMy35v0n1gJoxnEvoiqDNRPuMMUpP46Grw')"></div>
                                <!-- Overlay Administrative Pins -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-black/10 pointer-events-none"></div>
                                
                                <!-- Pinned locations (Clickable to show Graphs) -->
                                <button type="button" onclick="openKecamatanModal('Kecamatan Sumbawa')" class="absolute top-1/4 left-1/3 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-110 hover:shadow-lg hover:ring-2 hover:ring-primary transition-all text-left group">
                                    <span class="w-2.5 h-2.5 rounded-full bg-status-verified animate-ping"></span>
                                    <span class="font-label-sm text-label-sm font-bold text-text-primary group-hover:text-primary">Sumbawa</span>
                                    <span class="material-symbols-outlined text-[14px] text-primary">bar_chart</span>
                                </button>
                                <button type="button" onclick="openKecamatanModal('Kecamatan Utan')" class="absolute top-1/2 left-1/4 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-110 hover:shadow-lg hover:ring-2 hover:ring-primary transition-all text-left group">
                                    <span class="w-2.5 h-2.5 rounded-full bg-status-verified"></span>
                                    <span class="font-label-sm text-label-sm font-bold text-text-primary">Utan</span>
                                    <span class="material-symbols-outlined text-[14px] text-primary">bar_chart</span>
                                </button>
                                <button type="button" onclick="openKecamatanModal('Kecamatan Plampang')" class="absolute top-1/3 right-1/4 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-110 hover:shadow-lg hover:ring-2 hover:ring-secondary transition-all text-left group">
                                    <span class="w-2.5 h-2.5 rounded-full bg-secondary"></span>
                                    <span class="font-label-sm text-label-sm font-bold text-text-primary group-hover:text-secondary">Plampang</span>
                                    <span class="material-symbols-outlined text-[14px] text-secondary">bar_chart</span>
                                </button>
                                <button type="button" onclick="openKecamatanModal('Kecamatan Empang')" class="absolute bottom-1/4 right-1/3 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-110 hover:shadow-lg hover:ring-2 hover:ring-primary transition-all text-left group">
                                    <span class="w-2.5 h-2.5 rounded-full bg-status-verified"></span>
                                    <span class="font-label-sm text-label-sm font-bold text-text-primary group-hover:text-primary">Empang</span>
                                    <span class="material-symbols-outlined text-[14px] text-primary">bar_chart</span>
                                </button>
                                <button type="button" onclick="openKecamatanModal('Kecamatan Alas')" class="absolute top-16 left-12 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-110 hover:shadow-lg hover:ring-2 hover:ring-primary transition-all text-left group">
                                    <span class="w-2.5 h-2.5 rounded-full bg-status-verified"></span>
                                    <span class="font-label-sm text-label-sm font-bold text-text-primary group-hover:text-primary">Alas</span>
                                    <span class="material-symbols-outlined text-[14px] text-primary">bar_chart</span>
                                </button>
                                <button type="button" onclick="openKecamatanModal('Kecamatan Moyo Hilir')" class="absolute top-16 right-16 bg-canvas-bg/95 backdrop-blur-md px-space-sm py-1 rounded-lg shadow-md flex items-center gap-1.5 cursor-pointer hover:scale-110 hover:shadow-lg hover:ring-2 hover:ring-primary transition-all text-left group">
                                    <span class="w-2.5 h-2.5 rounded-full bg-status-verified"></span>
                                    <span class="font-label-sm text-label-sm font-bold text-text-primary group-hover:text-primary">Moyo Hilir</span>
                                    <span class="material-symbols-outlined text-[14px] text-primary">bar_chart</span>
                                </button>
                                
                                <!-- Bottom map controls & click guidance -->
                                <div class="absolute bottom-3 left-3 bg-canvas-bg/90 backdrop-blur-md px-3 py-1.5 rounded-lg shadow flex items-center gap-3 text-text-secondary font-label-sm text-label-sm">
                                    <span class="flex items-center gap-1 text-primary font-semibold"><span class="material-symbols-outlined text-[15px]">touch_app</span> Klik pin untuk lihat grafik</span>
                                    <span class="h-3 w-px bg-border-medium"></span>
                                    <span>24 Titik Pantau Kecamatan</span>
                                </div>
                                <div class="absolute bottom-3 right-3">
                                    <a href="{{ route('pemda.monitoring.index') }}" class="px-2.5 py-1 rounded-lg bg-primary-container text-white text-xs font-semibold hover:bg-gov-green-dark transition-colors shadow flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">map</span>
                                        <span>Buka Monitoring Wilayah</span>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Top Distribution Clusters Table (Dynamic from Wilayah Database) -->
                            <div class="mt-space-md">
                                <div class="flex items-center justify-between mb-space-sm">
                                    <div class="flex items-center gap-2">
                                        <span class="font-label-lg text-label-lg text-text-primary font-bold">Sebaran Wilayah Kecamatan</span>
                                        <span class="text-xs text-text-tertiary">(Klik baris untuk analisis grafik)</span>
                                    </div>
                                    <a class="text-primary font-label-sm text-label-sm hover:underline font-semibold flex items-center" href="{{ route('pemda.monitoring.index') }}">
                                        Semua Wilayah
                                        <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                    </a>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left font-body-sm text-body-sm">
                                        <thead class="bg-surface-subtle text-text-secondary font-label-md text-label-md">
                                            <tr>
                                                <th class="py-2.5 px-3">Kecamatan</th>
                                                <th class="py-2.5 px-3">Penerima Bantuan</th>
                                                <th class="py-2.5 px-3">Penyaluran Bantuan</th>
                                                <th class="py-2.5 px-3">Status</th>
                                                <th class="py-2.5 px-3 text-right">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-surface-muted font-body-md text-body-md">
                                            @foreach($sebaranKecamatan->take(6) as $kec)
                                            <tr onclick="openKecamatanModal('{{ $kec['nama'] }}')" class="hover:bg-gov-green-surface/40 cursor-pointer transition-colors group">
                                                <td class="py-3 px-3 font-semibold text-text-primary flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-primary-container text-[18px]">location_on</span>
                                                    <span class="group-hover:text-primary transition-colors">{{ $kec['nama'] }}</span>
                                                </td>
                                                <td class="py-3 px-3 font-code-dense text-code-dense font-medium">
                                                    {{ $kec['total_kk'] > 0 ? $kec['total_kk'] . ' KK Binaan' : '-' }}
                                                </td>
                                                <td class="py-3 px-3">
                                                    <span class="font-semibold text-text-primary">{{ $kec['total_penyaluran'] > 0 ? $kec['total_penyaluran'] . ' Transaksi' : '0' }}</span>
                                                </td>
                                                <td class="py-3 px-3">
                                                    @if($kec['total_kk'] > 0)
                                                        <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">Aktif Dampingan</span>
                                                    @else
                                                        <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-surface-muted text-text-secondary font-medium">Tersedia</span>
                                                    @endif
                                                </td>
                                                <td class="py-3 px-3 text-right">
                                                    <button type="button" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-gov-green-surface text-primary hover:bg-primary hover:text-white font-label-sm text-xs font-semibold transition-colors shadow-sm">
                                                        <span class="material-symbols-outlined text-[15px]">bar_chart</span>
                                                        <span>Lihat Grafik</span>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column (5 cols): Komposisi Bantuan & Program Bantuan Kampus -->
                    <div class="lg:col-span-5 flex flex-col gap-space-lg">
                        <!-- Komposisi Realisasi Bantuan -->
                        <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between pb-space-sm">
                                    <div class="flex items-center gap-space-sm">
                                        <div class="w-8 h-8 rounded-lg bg-surface-muted flex items-center justify-center text-primary-container">
                                            <span class="material-symbols-outlined text-[20px]">pie_chart</span>
                                        </div>
                                        <div>
                                            <h2 class="font-headline-sm text-headline-sm text-text-primary font-bold">Komposisi Bantuan Disalurkan</h2>
                                            <span class="font-body-sm text-body-sm text-text-secondary">Distribusi realisasi bantuan TA 2026</span>
                                        </div>
                                    </div>
                                    <span class="font-label-md text-label-md font-bold text-primary">{{ $totalPenyaluran ?? 0 }} Penyaluran</span>
                                </div>

                                <div class="flex flex-col gap-space-md mt-space-md">
                                    <!-- Bantuan Uang Tunai Usaha -->
                                    <div class="flex flex-col gap-1">
                                        <div class="flex justify-between items-center">
                                            <span class="font-label-md text-label-md font-semibold text-text-primary flex items-center gap-1.5">
                                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span> Bantuan Tunai Modal Usaha Tani
                                            </span>
                                            <span class="font-label-md text-label-md font-bold text-emerald-700">
                                                {{ $persenUang }}% <span class="text-text-secondary font-normal font-body-sm text-xs">(Rp {{ number_format($totalUangDisalurkan ?? 0, 0, ',', '.') }})</span>
                                            </span>
                                        </div>
                                        <div class="w-full bg-surface-container rounded-full h-2 overflow-hidden">
                                            <div class="bg-emerald-600 h-2 rounded-full" style="width: {{ max($persenUang, 5) }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Bantuan Alat & Fasilitas -->
                                    <div class="flex flex-col gap-1">
                                        <div class="flex justify-between items-center">
                                            <span class="font-label-md text-label-md font-semibold text-text-primary flex items-center gap-1.5">
                                                <span class="w-2.5 h-2.5 rounded-full bg-amber-600"></span> Bantuan Alat / Fasilitas Tani &amp; Olahan
                                            </span>
                                            <span class="font-label-md text-label-md font-bold text-amber-700">
                                                {{ $persenBarang }}% <span class="text-text-secondary font-normal font-body-sm text-xs">({{ number_format($totalBarangDisalurkan ?? 0) }} Unit)</span>
                                            </span>
                                        </div>
                                        <div class="w-full bg-surface-container rounded-full h-2 overflow-hidden">
                                            <div class="bg-amber-600 h-2 rounded-full" style="width: {{ max($persenBarang, 5) }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Bantuan Bibit Pertanian -->
                                    <div class="flex flex-col gap-1">
                                        <div class="flex justify-between items-center">
                                            <span class="font-label-md text-label-md font-semibold text-text-primary flex items-center gap-1.5">
                                                <span class="w-2.5 h-2.5 rounded-full bg-gov-green-dark"></span> Bantuan Bibit Pertanian (Cabai, Jagung, dll)
                                            </span>
                                            <span class="font-label-md text-label-md font-bold text-primary">
                                                {{ $persenBibit }}% <span class="text-text-secondary font-normal font-body-sm text-xs">({{ number_format($totalBibitDisalurkan ?? 0) }} Bibit)</span>
                                            </span>
                                        </div>
                                        <div class="w-full bg-surface-container rounded-full h-2 overflow-hidden">
                                            <div class="bg-gov-green-dark h-2 rounded-full" style="width: {{ max($persenBibit, 5) }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-space-lg pt-space-md bg-surface-subtle -mx-space-lg -mb-space-lg p-space-md rounded-b-xl flex items-center justify-between text-text-secondary font-body-sm text-body-sm border-t border-border-light">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px] text-primary">inventory_2</span> Subsidi Ditentukan oleh Kampus Mitra
                                </span>
                                <span class="font-semibold text-text-primary">Disalurkan Pendamping</span>
                            </div>
                        </div>

                        <!-- Program Bantuan Kampus Mitra Card -->
                        <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between pb-space-sm mb-space-sm border-b border-border-light">
                                    <div class="flex items-center gap-space-sm">
                                        <div class="w-8 h-8 rounded-lg bg-gov-green-surface flex items-center justify-center text-primary">
                                            <span class="material-symbols-outlined text-[20px]">school</span>
                                        </div>
                                        <div>
                                            <h2 class="font-headline-sm text-headline-sm text-text-primary font-bold">Program Bantuan Kampus</h2>
                                            <span class="font-body-sm text-body-sm text-text-secondary">Dibuat &amp; dikelola pihak Kampus Mitra</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('pemda.program-bantuan.index') }}" class="text-xs font-bold text-primary hover:underline">
                                        Lihat Semua
                                    </a>
                                </div>

                                <div class="flex flex-col divide-y divide-border-light">
                                    @forelse($programs as $prog)
                                    <div class="py-2.5 flex items-center justify-between gap-2">
                                        <div>
                                            <span class="font-semibold text-text-primary text-sm block">{{ $prog->nama_program }}</span>
                                            <span class="text-xs text-text-tertiary">
                                                Mitra: {{ $prog->kampusMitra->nama ?? 'Kampus Mitra' }} • {{ $prog->itemBantuans->count() }} Item Subsidi
                                            </span>
                                        </div>
                                        <a href="{{ route('pemda.program-bantuan.show', $prog->id) }}" class="px-2.5 py-1 bg-surface-subtle hover:bg-surface-muted text-primary font-semibold text-xs rounded-lg transition-colors border border-border-light shrink-0">
                                            Detail
                                        </a>
                                    </div>
                                    @empty
                                    <div class="text-center py-4 text-xs text-text-tertiary">
                                        Belum ada program bantuan aktif.
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="mt-space-md pt-space-xs text-xs text-text-tertiary flex justify-between items-center">
                                <span>Pemda melakukan fungsi pengawasan &amp; monitoring.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section: Aktivitas Terkini & Log Penyaluran Lapangan -->
                <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg flex flex-col">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm pb-space-md border-b border-border-light">
                        <div class="flex items-center gap-space-sm">
                            <div class="w-8 h-8 rounded-lg bg-surface-muted flex items-center justify-center text-primary-container">
                                <span class="material-symbols-outlined text-[20px]">assignment_turned_in</span>
                            </div>
                            <div>
                                <h2 class="font-headline-sm text-headline-sm text-text-primary font-bold">Aktivitas Penyaluran Bantuan Terkini</h2>
                                <span class="font-body-sm text-body-sm text-text-secondary">Distribusi real-time bantuan yang disalurkan oleh kader pendamping kepada keluarga penerima</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-space-sm">
                            <a href="{{ route('pemda.monitoring.index') }}" class="px-3 py-1.5 rounded-lg bg-surface-subtle hover:bg-surface-muted text-primary font-label-md text-xs font-semibold transition-colors border border-border-light">
                                Monitoring Terpadu
                            </a>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto mt-space-md">
                        <table class="w-full text-left font-body-sm text-body-sm">
                            <thead class="bg-surface-subtle text-text-secondary font-label-md text-label-md">
                                <tr>
                                    <th class="py-3 px-4">Waktu &amp; Tanggal</th>
                                    <th class="py-3 px-4">Pendamping Penyalur</th>
                                    <th class="py-3 px-4">Keluarga Penerima</th>
                                    <th class="py-3 px-4">Program &amp; Item Bantuan</th>
                                    <th class="py-3 px-4">Bantuan Diterima</th>
                                    <th class="py-3 px-4">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-surface-muted font-body-md text-body-md">
                                @forelse($penyaluranTerbaru as $pen)
                                <tr class="hover:bg-surface-subtle/80 transition-colors">
                                    <td class="py-3.5 px-4 font-code-dense text-code-dense text-text-secondary whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($pen->tgl_penyaluran)->format('d M Y') }}
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-gov-green-surface text-primary flex items-center justify-center font-bold text-xs">
                                                {{ substr($pen->pendamping->name ?? 'P', 0, 2) }}
                                            </div>
                                            <span class="font-semibold text-text-primary">{{ $pen->pendamping->name ?? 'Kader Pendamping' }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <span class="font-semibold text-text-primary block">{{ $pen->keluargaPenerima->kepala_keluarga ?? $pen->keluargaPenerima->nama ?? 'Penerima' }}</span>
                                        <span class="text-xs text-text-tertiary">Desa {{ $pen->keluargaPenerima->wilayah->nama ?? '-' }}</span>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <span class="font-medium text-text-primary block">{{ $pen->itemBantuan->nama_item ?? '-' }}</span>
                                        <span class="text-xs text-text-tertiary">{{ $pen->programBantuan->nama_program ?? '-' }}</span>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        @if($pen->jenis === 'uang')
                                            <span class="font-bold text-emerald-600 block">Rp {{ number_format($pen->nominal_uang, 0, ',', '.') }}</span>
                                            <span class="text-[11px] text-text-tertiary">Uang Modal Usaha Tani</span>
                                        @elseif($pen->jenis === 'barang')
                                            <span class="font-bold text-amber-700 block">{{ number_format($pen->jumlah, 0) }} {{ $pen->satuan }}</span>
                                            <span class="text-[11px] text-text-tertiary">Alat / Fasilitas</span>
                                        @else
                                            <span class="font-bold text-gov-green-dark block">{{ number_format($pen->jumlah, 0) }} {{ $pen->satuan }}</span>
                                            <span class="text-[11px] text-text-tertiary">Bibit Pertanian</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <span class="inline-flex items-center gap-1 px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-bold">
                                            <span class="material-symbols-outlined text-[13px]">check_circle</span> Tersalurkan
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-8 text-text-tertiary">
                                        Belum ada aktivitas penyaluran bantuan yang tercatat.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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
