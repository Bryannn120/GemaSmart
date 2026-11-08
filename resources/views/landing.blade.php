<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>GEMASMART - Inovasi Tata Kelola Bantuan Pangan &amp; Kemandirian Keluarga Binaan Kab. Sumbawa</title>
    <meta name="description" content="Profil Inovasi Daerah GEMASMART: Sistem Informasi Manajemen Bantuan Bibit, Pendampingan Lapangan, dan Monitoring Kemandirian Pangan Keluarga Binaan Kabupaten Sumbawa berbasis Desil P3KE dan Pencegahan Stunting."/>
    <meta name="keywords" content="GemaSmart, Inovasi Daerah, Bappeda Sumbawa, Kabupaten Sumbawa, Bantuan Bibit, Ketahanan Pangan, P3KE, Stunting, IGA Kemendagri"/>
    <meta name="author" content="Bappeda Kabupaten Sumbawa &amp; Perguruan Tinggi Mitra"/>

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="GEMASMART - Inovasi Bantuan Bibit &amp; Kemandirian Pangan Sumbawa"/>
    <meta property="og:description" content="Transformasi digital bantuan sosial-pertanian berbasis keluarga prasejahtera berkolaborasi dengan Perguruan Tinggi Mitra di 24 Kecamatan Kabupaten Sumbawa."/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="{{ asset('images/gemas.jpg') }}"/>
    
    <link rel="manifest" href="/manifest.json"/>
    <meta name="theme-color" content="#00450d"/>
    <link rel="apple-touch-icon" href="/icon-192.png"/>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin=""/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#00450d",
                        "gov-green-dark": "#0E3A13",
                        "primary-container": "#1b5e20",
                        "status-verified": "#43A047",
                        "status-verified-surface": "#E8F5E9",
                        "gold-accent": "#F59E0B",
                        "gold-surface": "#FFFBEB",
                        "status-warning": "#EA580C",
                        "status-fraud": "#DC2626",
                        "surface-subtle": "#F8FAFC",
                        "text-primary": "#0F172A",
                        "text-secondary": "#475569",
                        "text-tertiary": "#94A3B8"
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                        body: ['Inter', 'sans-serif']
                    }
                }
            }
        };
    </script>

    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .hero-pattern {
            background-color: #06240d;
            background-image: radial-gradient(rgba(16, 185, 129, 0.15) 1px, transparent 1px), radial-gradient(rgba(245, 158, 11, 0.1) 1px, #06240d 1px);
            background-size: 40px 40px;
            background-position: 0 0, 20px 20px;
        }
        .pulse-beacon {
            box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.7);
            animation: pulse-ring 2s infinite;
        }
        @keyframes pulse-ring {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(74, 222, 128, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(74, 222, 128, 0); }
        }
        .text-gradient {
            background: linear-gradient(135deg, #10b981 0%, #34d399 50%, #fbbf24 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-emerald-600 selection:text-white flex flex-col min-h-screen">

    <!-- ========================================================================= -->
    <!-- TOP STICKY NAVBAR DENGAN TOMBOL LOGIN DI POJOK KANAN ATAS -->
    <!-- ========================================================================= -->
    <header class="sticky top-0 z-50 w-full glass-nav border-b border-slate-200/80 transition-all duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- BAGIAN KIRI: BRAND/LOGO & MENU PROFIL INOVASI (SAMPING KANAN LOGO) -->
                <div class="flex items-center gap-4 lg:gap-6">
                    <!-- Brand & Logo -->
                    <a href="#hero" class="flex items-center gap-3.5 group flex-shrink-0">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-100 p-1 flex items-center justify-center shadow-sm overflow-hidden flex-shrink-0 group-hover:scale-105 transition-transform">
                            <img alt="Gema Smart Sumbawa Logo" class="w-full h-full object-contain" src="{{ asset('images/gemas.jpg') }}" onerror="this.onerror=null; this.src='{{ asset('images/logo.png') }}';"/>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-1.5">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-800 bg-emerald-100/80 px-2 py-0.5 rounded-md">Inovasi Daerah Kab. Sumbawa</span>
                            </div>
                            <span class="text-xl font-extrabold text-slate-900 tracking-tight leading-tight">
                                GEMASMART
                            </span>
                            <span class="text-[11px] text-slate-500 font-medium">Bappeda &amp; Perguruan Tinggi Mitra</span>
                        </div>
                    </a>

                    <!-- MENU PROFIL INOVASI (DI BAGIAN KIRI, TEPAT DI SAMPING KANAN LOGO) -->
                    <div class="relative group hidden md:block">
                        <a href="#tentang" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-sm font-bold text-slate-800 hover:text-emerald-900 bg-emerald-50/80 hover:bg-emerald-100/90 border border-emerald-200/90 transition-all shadow-xs">
                            <span class="material-symbols-outlined text-[19px] text-emerald-700">stars</span>
                            <span>Profil Inovasi</span>
                            <span class="material-symbols-outlined text-[16px] text-slate-400 group-hover:rotate-180 transition-transform">expand_more</span>
                        </a>

                        <!-- Dropdown Menu Sub-seksi Profil Inovasi -->
                        <div class="hidden group-hover:block absolute left-0 top-full pt-2 w-72 z-50 animate-fade-in">
                            <div class="bg-white rounded-2xl shadow-xl border border-slate-200 p-2 space-y-1">
                                <a href="#tentang" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-900 transition-colors">
                                    <span class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center flex-shrink-0">
                                        <span class="material-symbols-outlined text-[16px]">info</span>
                                    </span>
                                    <div>
                                        <strong class="block text-slate-900">Tentang Inovasi</strong>
                                        <span class="text-[10px] text-slate-500">Latar belakang &amp; paket bantuan</span>
                                    </div>
                                </a>

                                <a href="#siklus" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-900 transition-colors">
                                    <span class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center flex-shrink-0">
                                        <span class="material-symbols-outlined text-[16px]">sync</span>
                                    </span>
                                    <div>
                                        <strong class="block text-slate-900">Alur 5 Siklus</strong>
                                        <span class="text-[10px] text-slate-500">SOP dari pagu hingga graduasi</span>
                                    </div>
                                </a>

                                <a href="#kolaborasi" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-900 transition-colors">
                                    <span class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center flex-shrink-0">
                                        <span class="material-symbols-outlined text-[16px]">groups</span>
                                    </span>
                                    <div>
                                        <strong class="block text-slate-900">Aktor Kolaborasi</strong>
                                        <span class="text-[10px] text-slate-500">5 peran wewenang (RBAC)</span>
                                    </div>
                                </a>

                                <a href="#dampak" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-900 transition-colors">
                                    <span class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center flex-shrink-0">
                                        <span class="material-symbols-outlined text-[16px]">trending_up</span>
                                    </span>
                                    <div>
                                        <strong class="block text-slate-900">Dampak &amp; Hasil</strong>
                                        <span class="text-[10px] text-slate-500">Komparasi sebelum vs sesudah</span>
                                    </div>
                                </a>

                                <a href="#indikator" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-900 transition-colors">
                                    <span class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center flex-shrink-0">
                                        <span class="material-symbols-outlined text-[16px]">military_tech</span>
                                    </span>
                                    <div>
                                        <strong class="block text-slate-900">20 Indikator IGA</strong>
                                        <span class="text-[10px] text-slate-500">Kesiapan standar Kemendagri</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN KANAN: MENU LAPORAN, MENU QnA, BUTTON PANDUAN, & TOMBOL LOGIN -->
                <div class="flex items-center gap-2 sm:gap-3">
                    
                    <!-- MENU LAPORAN (TANPA LOGIN) -->
                    <a href="#lapor" class="inline-flex items-center gap-1.5 px-3 sm:px-3.5 py-2 sm:py-2.5 rounded-xl text-sm font-bold text-emerald-950 bg-emerald-100 hover:bg-emerald-200 border border-emerald-400 shadow-sm transition-all hover:scale-105 active:scale-95" title="Kirim Laporan Mandiri Warga (Tanpa Perlu Login)">
                        <span class="material-symbols-outlined text-[19px] text-emerald-800 animate-pulse">campaign</span>
                        <span>Laporan</span>
                    </a>

                    <!-- MENU QnA (DI SEBELAH PANDUAN) -->
                    <a href="#qna" class="inline-flex items-center gap-1.5 px-3 sm:px-3.5 py-2 sm:py-2.5 rounded-xl text-sm font-bold text-amber-900 bg-amber-50 hover:bg-amber-100 border border-amber-300 shadow-sm transition-all hover:scale-105 active:scale-95" title="Menu Tanya Jawab (QnA)">
                        <span class="material-symbols-outlined text-[19px] text-amber-700">help_center</span>
                        <span>QnA</span>
                    </a>

                    <!-- BUTTON PANDUAN (DI SEBELAH QnA & SEBELAH LOGIN) -->
                    <button id="btn-panduan-header" type="button" onclick="openPanduanModal()" class="inline-flex items-center gap-1.5 px-3 sm:px-3.5 py-2 sm:py-2.5 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-900 font-bold text-sm border border-amber-300 shadow-sm transition-all hover:scale-105 active:scale-95" title="Buka Buku Panduan & SOP Operasional">
                        <span class="material-symbols-outlined text-[19px] text-amber-700">menu_book</span>
                        <span class="hidden sm:inline">Panduan</span>
                    </button>

                    <!-- TOMBOL LOGIN (POJOK KANAN ATAS) -->
                    @auth
                        @php
                            $role = auth()->user()->role;
                            $targetRoute = match($role) {
                                'pemda' => route('dashboard.pemda'),
                                'kampus' => route('dashboard.kampus'),
                                'pendamping' => route('dashboard.pendamping'),
                                'validator' => route('dashboard.validator'),
                                default => route('dashboard.penerima'),
                            };
                        @endphp
                        <a id="btn-login-header" href="{{ $targetRoute }}" class="inline-flex items-center gap-2 px-4 sm:px-5 py-2 sm:py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-800 text-white font-bold text-sm shadow-md hover:shadow-emerald-700/25 hover:from-emerald-700 hover:to-emerald-900 transition-all duration-200 border border-emerald-500/20 active:scale-95">
                            <span class="material-symbols-outlined text-[18px]">space_dashboard</span>
                            <span>Buka Dashboard</span>
                            <span class="text-[10px] bg-white/20 uppercase px-1.5 py-0.5 rounded font-mono">{{ $role }}</span>
                        </a>
                    @else
                        <a id="btn-login-header" href="{{ route('login') }}" class="group relative inline-flex items-center gap-2 px-4 sm:px-6 py-2 sm:py-2.5 rounded-xl bg-gradient-to-r from-emerald-800 via-emerald-700 to-gov-green-dark text-white font-bold text-sm shadow-md hover:shadow-emerald-900/30 hover:brightness-110 active:scale-95 transition-all duration-200 border border-emerald-500/40">
                            <span class="material-symbols-outlined text-[18px] group-hover:rotate-12 transition-transform">lock_open</span>
                            <span>Masuk / Login</span>
                            <span class="flex h-2 w-2 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-300 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-400"></span>
                            </span>
                        </a>
                    @endauth

                    <!-- Mobile Hamburger Button -->
                    <button id="mobile-menu-btn" type="button" class="md:hidden p-2 rounded-xl text-slate-700 hover:bg-slate-100 transition-colors" aria-label="Toggle Menu">
                        <span class="material-symbols-outlined text-2xl">menu</span>
                    </button>
                </div>

            </div>
        </div>

        <!-- MOBILE MENU DROPDOWN -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-slate-200 bg-white/95 px-4 pt-3 pb-6 space-y-2">
            <a href="#tentang" class="block px-3 py-2 rounded-lg text-base font-bold text-slate-800 hover:bg-emerald-50 flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px] text-emerald-700">stars</span>
                <span>Profil Inovasi Lengkap</span>
            </a>
            <a href="#lapor" class="block px-3 py-2 rounded-lg text-base font-bold text-emerald-900 bg-emerald-100 hover:bg-emerald-200 flex items-center justify-between">
                <span class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px] text-emerald-800">campaign</span>
                    <span>Lapor Mandiri (Tanpa Login)</span>
                </span>
                <span class="text-[10px] bg-emerald-300 text-emerald-950 font-extrabold px-2 py-0.5 rounded">Form Warga</span>
            </a>
            <a href="#qna" class="block px-3 py-2 rounded-lg text-base font-bold text-amber-900 bg-amber-50 hover:bg-amber-100 flex items-center justify-between">
                <span class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px] text-amber-700">help_center</span>
                    <span>QnA</span>
                </span>
                <span class="text-xs bg-amber-200 text-amber-900 font-bold px-2 py-0.5 rounded">FAQ</span>
            </a>
            <div class="pt-3 border-t border-slate-100 space-y-2">
                <button type="button" onclick="openPanduanModal()" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl bg-amber-100 text-amber-900 font-bold text-sm border border-amber-300">
                    <span class="material-symbols-outlined text-[19px] text-amber-800">menu_book</span>
                    <span>Buku Panduan Sistem (Manual)</span>
                </button>
                <a href="{{ route('login') }}" class="w-full flex items-center justify-center gap-2 py-3 rounded-xl bg-emerald-800 text-white font-bold text-sm shadow">
                    <span class="material-symbols-outlined text-[18px]">login</span>
                    <span>Masuk ke Portal Login</span>
                </a>
            </div>
        </div>
    </header>

    <main class="flex-grow">

        <!-- ========================================================================= -->
        <!-- HERO SECTION -->
        <!-- ========================================================================= -->
        <section id="hero" class="relative overflow-hidden hero-pattern text-white py-20 lg:py-28">
            <!-- Background glow accents -->
            <div class="absolute -top-40 -left-40 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute top-1/2 right-0 w-[500px] h-[500px] bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                    
                    <!-- Left Hero Content -->
                    <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                        
                        <!-- Badge Inovasi -->
                        <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-semibold text-emerald-200">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 pulse-beacon"></span>
                            <span>PROFIL INOVASI DAERAH KABUPATEN SUMBAWA</span>
                            <span class="bg-amber-400/90 text-slate-900 font-extrabold text-[10px] px-2 py-0.5 rounded-full uppercase tracking-wider">TA 2026</span>
                        </div>

                        <!-- Main Heading -->
                        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-5xl font-black tracking-tight text-white leading-[1.15]">
                            Transformasi Digital Bantuan Bibit &amp; Kemandirian Pangan 
                            <span class="text-gradient block mt-1">Keluarga Binaan Sumbawa</span>
                        </h1>

                        <!-- Subtitle Description -->
                        <p class="text-base sm:text-lg text-slate-300 font-normal leading-relaxed max-w-2xl mx-auto lg:mx-0">
                            <strong class="text-white font-semibold">GEMASMART</strong> memadukan kebijakan fiskal daerah, pendampingan perguruan tinggi mitra (Tim Pendamping &amp; Validator), serta pemantauan geospasial real-time untuk menjamin ketepatan sasaran bagi keluarga <span class="text-amber-300 font-semibold">Desil 1–3 P3KE</span> dan percepatan penanganan stunting di 24 Kecamatan.
                        </p>

                        <!-- CTA Action Buttons -->
                        <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 sm:gap-4 pt-2">
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2.5 px-6 sm:px-7 py-3.5 rounded-xl bg-gradient-to-r from-emerald-500 to-emerald-400 text-slate-950 font-extrabold text-sm shadow-xl shadow-emerald-500/20 hover:brightness-110 active:scale-95 transition-all">
                                <span class="material-symbols-outlined text-[20px]">login</span>
                                <span>Akses Portal Sistem (Login)</span>
                            </a>
                            <button type="button" onclick="openPanduanModal()" class="inline-flex items-center gap-2 px-5 sm:px-6 py-3.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-sm shadow-xl shadow-amber-500/20 active:scale-95 transition-all">
                                <span class="material-symbols-outlined text-[20px]">menu_book</span>
                                <span>Buku Panduan Sistem</span>
                            </button>
                            <a href="#qna" class="inline-flex items-center gap-2 px-5 py-3.5 rounded-xl bg-white/10 hover:bg-white/15 text-white font-semibold text-sm backdrop-blur-md border border-white/20 transition-colors">
                                <span class="material-symbols-outlined text-[20px] text-amber-300">help_center</span>
                                <span>QnA</span>
                            </a>
                            <a href="{{ route('profil.download') }}" class="inline-flex items-center gap-2 px-4 py-3.5 rounded-xl bg-slate-900/60 hover:bg-slate-900/80 text-amber-300 font-semibold text-sm border border-amber-400/30 transition-colors" title="Unduh Dokumen Profil Format Markdown">
                                <span class="material-symbols-outlined text-[20px]">download</span>
                                <span>Profil (MD)</span>
                            </a>
                        </div>

                        <!-- Quick Trust Meta -->
                        <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-6 text-xs text-slate-400 border-t border-white/10">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-emerald-400 text-[18px]">verified</span>
                                <span>Bappeda Kab. Sumbawa</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-emerald-400 text-[18px]">school</span>
                                <span>Universitas Teknologi Sumbawa (UTS)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-emerald-400 text-[18px]">shield</span>
                                <span>Filter Integritas FR-24</span>
                            </div>
                        </div>

                    </div>

                    <!-- Right Hero Stats Showcase Card -->
                    <div class="lg:col-span-5">
                        <div class="relative rounded-2xl bg-gradient-to-b from-white/10 to-white/5 p-6 sm:p-8 backdrop-blur-xl border border-white/20 shadow-2xl space-y-6">
                            
                            <div class="flex items-center justify-between border-b border-white/15 pb-4">
                                <div>
                                    <span class="text-xs font-semibold text-emerald-300 uppercase tracking-wider block">Indikator Kinerja Utama</span>
                                    <h3 class="text-lg font-bold text-white">Status Capaian Daerah</h3>
                                </div>
                                <span class="px-2.5 py-1 rounded-md bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 font-mono text-xs font-bold">LIVE DATA</span>
                            </div>

                            <!-- 4 Key Metric Boxes -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-black/30 rounded-xl p-4 border border-white/10">
                                    <span class="text-[11px] text-slate-300 uppercase font-medium block">Cakupan Wilayah</span>
                                    <div class="text-2xl sm:text-3xl font-black text-white mt-1">{{ $stats['total_kecamatan'] ?? 24 }} <span class="text-xs font-normal text-slate-400">Kecamatan</span></div>
                                    <span class="text-[10px] text-emerald-400 mt-1 block">100% Terintegrasi GIS</span>
                                </div>

                                <div class="bg-black/30 rounded-xl p-4 border border-white/10">
                                    <span class="text-[11px] text-slate-300 uppercase font-medium block">Target Sasaran</span>
                                    <div class="text-2xl sm:text-3xl font-black text-white mt-1">{{ number_format($stats['total_penerima'] ?? 6426, 0, ',', '.') }} <span class="text-xs font-normal text-slate-400">KK</span></div>
                                    <span class="text-[10px] text-amber-300 mt-1 block">Desil 1 s.d. 3 P3KE</span>
                                </div>

                                <div class="bg-black/30 rounded-xl p-4 border border-white/10">
                                    <span class="text-[11px] text-slate-300 uppercase font-medium block">Tingkat Tumbuh</span>
                                    <div class="text-2xl sm:text-3xl font-black text-emerald-400 mt-1">88.4%</div>
                                    <span class="text-[10px] text-slate-300 mt-1 block">Survival Rate Tanaman</span>
                                </div>

                                <div class="bg-black/30 rounded-xl p-4 border border-white/10">
                                    <span class="text-[11px] text-slate-300 uppercase font-medium block">Kemandirian</span>
                                    <div class="text-2xl sm:text-3xl font-black text-amber-400 mt-1">{{ number_format($stats['total_mandiri'] ?? 1240, 0, ',', '.') }}+ <span class="text-xs font-normal text-slate-400">KK</span></div>
                                    <span class="text-[10px] text-emerald-300 mt-1 block">Tergraduasi Mandiri</span>
                                </div>
                            </div>

                            <!-- Highlights Banner within Hero Card -->
                            <div class="p-3.5 rounded-xl bg-gradient-to-r from-emerald-950/60 to-emerald-900/60 border border-emerald-500/30 flex items-center gap-3">
                                <span class="p-2 rounded-lg bg-emerald-500/20 text-emerald-300">
                                    <span class="material-symbols-outlined text-[20px]">security</span>
                                </span>
                                <div>
                                    <span class="text-xs font-bold text-white block">Algoritma Integritas FR-24</span>
                                    <span class="text-[11px] text-slate-300">Deteksi anomali kematian bibit &amp; pencegahan NIK ganda otomatis.</span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- SECTION 1: IDENTITAS & TENTANG INOVASI -->
        <!-- ========================================================================= -->
        <section id="tentang" class="py-20 bg-white border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
                
                <div class="text-center max-w-3xl mx-auto space-y-3">
                    <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-xs font-bold uppercase tracking-wider">
                        Rancang Bangun Inovasi Daerah
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        Mengapa Inovasi Ini Hadir di Kabupaten Sumbawa?
                    </h2>
                    <p class="text-base text-slate-600">
                        Inovasi GemaSmart lahir dari evaluasi mendalam atas tantangan penyaluran bantuan sosial-pertanian konvensional yang kerap tidak tepat sasaran dan terputus pengawalannya.
                    </p>
                </div>

                <!-- 2-COLUMN COMPARISON CARDS: MASALAH LAMA VS SOLUSI GEMASMART -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- SISI MASALAH KONVENSIONAL -->
                    <div class="rounded-2xl p-6 sm:p-8 bg-red-50/50 border border-red-200 space-y-5">
                        <div class="flex items-center gap-3 text-red-700">
                            <span class="p-2.5 rounded-xl bg-red-100 text-red-600">
                                <span class="material-symbols-outlined text-[24px]">warning</span>
                            </span>
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-red-500">Kondisi Sebelumnya</span>
                                <h3 class="text-lg font-bold text-red-950">Pola Bantuan Konvensional (Baseline)</h3>
                            </div>
                        </div>

                        <ul class="space-y-3.5 text-sm text-slate-700">
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-red-500 text-[18px] mt-0.5 flex-shrink-0">cancel</span>
                                <span><strong>Hanya Menyasar Poktan:</strong> Bantuan pertanian terpusat pada kelompok tani, mengesampingkan keluarga miskin yang tidak bertanah luas.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-red-500 text-[18px] mt-0.5 flex-shrink-0">cancel</span>
                                <span><strong>Pola "Bagi Bibit Lalu Ditinggal":</strong> Tidak ada pendampingan pasca-salur, menyebabkan mortalitas bibit tinggi (&gt; 60% mati/gagal tumbuh).</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-red-500 text-[18px] mt-0.5 flex-shrink-0">cancel</span>
                                <span><strong>Risiko Data Ganda &amp; Subjektivitas:</strong> Tidak ada verifikasi geotagging sehingga rentan duplikasi NIK dan salah sasaran.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-red-500 text-[18px] mt-0.5 flex-shrink-0">cancel</span>
                                <span><strong>Administrasi Laporan Manual yang Lambat:</strong> Rekapitulasi penyaluran memakan waktu lama dengan tumpukan berkas fisik.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- SISI SOLUSI GEMASMART -->
                    <div class="rounded-2xl p-6 sm:p-8 bg-emerald-50/60 border border-emerald-300 space-y-5 shadow-sm">
                        <div class="flex items-center gap-3 text-emerald-800">
                            <span class="p-2.5 rounded-xl bg-emerald-100 text-emerald-700">
                                <span class="material-symbols-outlined text-[24px]">verified</span>
                            </span>
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Terobosan Kebaruan</span>
                                <h3 class="text-lg font-bold text-slate-900">Solusi GEMASMART</h3>
                            </div>
                        </div>

                        <ul class="space-y-3.5 text-sm text-slate-700">
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-emerald-600 text-[18px] mt-0.5 flex-shrink-0">check_circle</span>
                                <span><strong>Berbasis Keluarga Penerima Bantuan (KPB):</strong> Intervensi langsung ke rumah tangga Desil 1–3 P3KE untuk ketahanan pangan pekarangan.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-emerald-600 text-[18px] mt-0.5 flex-shrink-0">check_circle</span>
                                <span><strong>Pengawalan Tim Mitra (Validator &amp; Pendamping):</strong> Pendampingan intensif budidaya, pelaporan fase tumbuh, dan proteksi dini hama.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-emerald-600 text-[18px] mt-0.5 flex-shrink-0">check_circle</span>
                                <span><strong>Validasi Geotagging &amp; Filter FR-24:</strong> Koordinat lahan presisi dan mesin pencegah NIK ganda menjamin 100% akuntabilitas.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-emerald-600 text-[18px] mt-0.5 flex-shrink-0">check_circle</span>
                                <span><strong>Rekapitulasi &amp; Laporan PDF Otomatis Sekali Klik:</strong> Menghemat waktu penyusunan administrasi pelaporan hingga 80%.</span>
                            </li>
                        </ul>
                    </div>

                </div>

                <!-- 3 KOMPONEN BANTUAN MULTI-KOMPONEN -->
                <div class="pt-8 space-y-6">
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-slate-900">Paket Bantuan Terintegrasi (3 Pilar Subsidi)</h3>
                        <p class="text-sm text-slate-500 mt-1">GemaSmart tidak hanya menyalurkan bibit, namun memadukan paket pendukung produktivitas keluarga</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Pilar 1 -->
                        <div class="p-6 rounded-xl bg-slate-50 border border-slate-200 hover:border-emerald-500 transition-all group">
                            <div class="w-12 h-12 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[24px]">potted_plant</span>
                            </div>
                            <h4 class="font-bold text-base text-slate-900 mb-1">1. Bibit Unggul &amp; Hortikultura</h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Benih Jagung Hibrida Bisi-18, Padi Gogo/Ciherang bersertifikat, bibit cabai rawit siap tanam, bawang merah, dan aneka tanaman sayuran pekarangan pencegah stunting.
                            </p>
                        </div>

                        <!-- Pilar 2 -->
                        <div class="p-6 rounded-xl bg-slate-50 border border-slate-200 hover:border-amber-500 transition-all group">
                            <div class="w-12 h-12 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[24px]">payments</span>
                            </div>
                            <h4 class="font-bold text-base text-slate-900 mb-1">2. Stimulan Modal Usaha Tani</h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Bantuan tunai stimulan modal kerja untuk pembelian pakan, bibit ikan budidaya, sewa olah lahan, atau modal usaha olahan pangan rumahan keluarga binaan.
                            </p>
                        </div>

                        <!-- Pilar 3 -->
                        <div class="p-6 rounded-xl bg-slate-50 border border-slate-200 hover:border-blue-500 transition-all group">
                            <div class="w-12 h-12 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[24px]">handyman</span>
                            </div>
                            <h4 class="font-bold text-base text-slate-900 mb-1">3. Sarana &amp; Alat Produksi</h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Hand sprayer pupuk cair 16L, pupuk organik cair (POC) hayati ramah lingkungan, serta kompor gas SNI untuk pengolahan pascapanen bernilai tambah.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- SECTION 2: ALUR KERJA 5 SIKLUS SISTEM -->
        <!-- ========================================================================= -->
        <section id="siklus" class="py-20 bg-slate-50 border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-14">
                
                <div class="text-center max-w-3xl mx-auto space-y-3">
                    <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-900 border border-emerald-300 text-xs font-bold uppercase tracking-wider">
                        SOP &amp; Alur Operasional
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        5 Tahapan Siklus Inovasi GemaSmart
                    </h2>
                    <p class="text-base text-slate-600">
                        Siklus menyeluruh dari perencanaan pagu hingga graduasi kemandirian keluarga sasaran yang terdokumentasi secara digital.
                    </p>
                </div>

                <!-- 5 Steps Flow -->
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 relative">
                    
                    <!-- Step 1 -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-shadow space-y-3 relative flex flex-col justify-between">
                        <div class="space-y-2">
                            <span class="w-9 h-9 rounded-xl bg-emerald-800 text-white font-black text-sm flex items-center justify-center">01</span>
                            <h3 class="font-bold text-sm text-slate-900">Perencanaan &amp; Alokasi Kuota</h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Pemda/Bappeda menetapkan pagu anggaran dan kuota bibit bagi 24 kecamatan disinkronkan dengan data kemiskinan ekstrem P3KE.
                            </p>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider block pt-2 border-t border-slate-100">Pemda &amp; Bappeda</span>
                    </div>

                    <!-- Step 2 -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-shadow space-y-3 relative flex flex-col justify-between">
                        <div class="space-y-2">
                            <span class="w-9 h-9 rounded-xl bg-emerald-700 text-white font-black text-sm flex items-center justify-center">02</span>
                            <h3 class="font-bold text-sm text-slate-900">Sensus CPCL &amp; Validasi Bertingkat</h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Pendamping memverifikasi NIK, lahan pekarangan &amp; geotagging. Validator menguji petik kelayakan dokumen.
                            </p>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider block pt-2 border-t border-slate-100">Validator &amp; Pendamping</span>
                    </div>

                    <!-- Step 3 -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-shadow space-y-3 relative flex flex-col justify-between">
                        <div class="space-y-2">
                            <span class="w-9 h-9 rounded-xl bg-emerald-600 text-white font-black text-sm flex items-center justify-center">03</span>
                            <h3 class="font-bold text-sm text-slate-900">Penyaluran &amp; BAST Digital</h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Penyerahan bibit, modal usaha, dan sarana produksi dengan Berita Acara Serah Terima digital, memperbarui serapan dana riil.
                            </p>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider block pt-2 border-t border-slate-100">Kampus &amp; Keluarga KPB</span>
                    </div>

                    <!-- Step 4 -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-shadow space-y-3 relative flex flex-col justify-between">
                        <div class="space-y-2">
                            <span class="w-9 h-9 rounded-xl bg-amber-600 text-white font-black text-sm flex items-center justify-center">04</span>
                            <h3 class="font-bold text-sm text-slate-900">Monitoring &amp; Indeks Kemandirian</h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Tracking survival rate berkala. Alarm FR-24 aktif bila &lt; 50%. Skoring 3 indikator kemandirian hingga graduasi.
                            </p>
                        </div>
                        <span class="text-[10px] font-bold text-amber-700 uppercase tracking-wider block pt-2 border-t border-slate-100">Algoritma FR-24</span>
                    </div>

                    <!-- Step 5 -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-shadow space-y-3 relative flex flex-col justify-between">
                        <div class="space-y-2">
                            <span class="w-9 h-9 rounded-xl bg-slate-900 text-white font-black text-sm flex items-center justify-center">05</span>
                            <h3 class="font-bold text-sm text-slate-900">Rekapitulasi Otomatis &amp; Evaluasi Spasial GIS</h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Cetak laporan rekapitulasi resmi PDF dalam 1 klik dan pemantauan peta sebaran wilayah interaktif se-Kabupaten Sumbawa.
                            </p>
                        </div>
                        <span class="text-[10px] font-bold text-slate-800 uppercase tracking-wider block pt-2 border-t border-slate-100">Dashboard Eksekutif</span>
                    </div>

                </div>

            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- SECTION 3: STRUKTUR KOLABORASI 5 AKTOR (RBAC) -->
        <!-- ========================================================================= -->
        <section id="kolaborasi" class="py-20 bg-white border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-14">
                
                <div class="text-center max-w-3xl mx-auto space-y-3">
                    <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-xs font-bold uppercase tracking-wider">
                        Kemitraan Quadruple Helix
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        5 Aktor Utama dalam Ekosistem Sistem
                    </h2>
                    <p class="text-base text-slate-600">
                        Pembagian peran berbasis hak akses sistem (Role-Based Access Control) yang menjamin tata kelola yang transparan, akuntabel, dan bebas benturan kepentingan.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <!-- Aktor 1: Pemda -->
                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-emerald-600 transition-all space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-xl bg-emerald-800 text-white flex items-center justify-center">
                                <span class="material-symbols-outlined text-[22px]">account_balance</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-base text-slate-900">Pemerintah Daerah</h3>
                                <span class="text-xs text-emerald-800 font-semibold">Bappeda &amp; Dinas Pertanian</span>
                            </div>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Penetapan pagu anggaran, pengesahan kuota 24 kecamatan, persetujuan akhir SK CPCL, monitoring peta GIS, audit anomali sistem (FR-24), dan pemantauan realisasi kas hibah.
                        </p>
                    </div>

                    <!-- Aktor 2: Kampus Mitra -->
                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-emerald-600 transition-all space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-xl bg-emerald-700 text-white flex items-center justify-center">
                                <span class="material-symbols-outlined text-[22px]">school</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-base text-slate-900">Kampus Mitra</h3>
                                <span class="text-xs text-emerald-800 font-semibold">LPPM / Koordinator DPL</span>
                            </div>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Pengelolaan program kemitraan, penyusunan katalog paket bibit dan sarana, penugasan validator dan pendamping, serta penerbitan laporan rekapitulasi resmi.
                        </p>
                    </div>

                    <!-- Aktor 3: Validator -->
                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-emerald-600 transition-all space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-xl bg-blue-700 text-white flex items-center justify-center">
                                <span class="material-symbols-outlined text-[22px]">fact_check</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-base text-slate-900">Validator</h3>
                                <span class="text-xs text-blue-700 font-semibold">Verifikator Kelayakan &amp; Uji Petik</span>
                            </div>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Memeriksa antrean hasil survei lapangan, uji petik keabsahan berkas CPCL &amp; foto geotagging lahan secara independen, serta memberikan rekomendasi setuju/revisi.
                        </p>
                    </div>

                    <!-- Aktor 4: Pendamping -->
                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-emerald-600 transition-all space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-xl bg-amber-600 text-white flex items-center justify-center">
                                <span class="material-symbols-outlined text-[22px]">assignment_ind</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-base text-slate-900">Pendamping</h3>
                                <span class="text-xs text-amber-700 font-semibold">Petugas Pendamping Lapangan</span>
                            </div>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Sensus faktual door-to-door, pengambilan koordinat presisi, pengawalan distribusi bibit, monitoring berkala fase tumbuh, dan input asesmen skoring kemandirian.
                        </p>
                    </div>

                    <!-- Aktor 5: Keluarga Penerima Bantuan (KPB) -->
                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-emerald-600 transition-all space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-xl bg-emerald-600 text-white flex items-center justify-center">
                                <span class="material-symbols-outlined text-[22px]">family_restroom</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-base text-slate-900">Keluarga Penerima Bantuan (KPB)</h3>
                                <span class="text-xs text-emerald-800 font-semibold">Rumah Tangga Sasaran Desil 1–3</span>
                            </div>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Penerima paket bibit pekarangan dan stimulan modal, pelapor mandiri kondisi kebun melalui portal warga, serta peserta aktif program peningkatan gizi keluarga.
                        </p>
                    </div>

                    <!-- Card Login Quick Direct -->
                    <div class="p-6 rounded-2xl bg-gradient-to-br from-emerald-900 to-gov-green-dark text-white flex flex-col justify-between shadow-md">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-300">Akses Portal Pengguna</span>
                            <h3 class="text-lg font-bold text-white mt-1">Sudah Memiliki Akun Terdaftar?</h3>
                            <p class="text-xs text-slate-200 mt-2">
                                Masuk ke antarmuka kerja sesuai wewenang peran Anda untuk memulai monitoring atau pelaporan.
                            </p>
                        </div>
                        <a href="{{ route('login') }}" class="mt-4 inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold text-xs shadow transition-colors">
                            <span class="material-symbols-outlined text-[16px]">login</span>
                            <span>Login ke Dashboard Aktor</span>
                        </a>
                    </div>

                </div>

            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- SECTION 4: DAMPAK & METRIK (SEBELUM VS SESUDAH) -->
        <!-- ========================================================================= -->
        <section id="dampak" class="py-20 bg-slate-50 border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-14">
                
                <div class="text-center max-w-3xl mx-auto space-y-3">
                    <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-900 border border-emerald-300 text-xs font-bold uppercase tracking-wider">
                        Keluaran &amp; Dampak Terukur
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        Komparasi Dampak Nyata Inovasi Daerah
                    </h2>
                    <p class="text-base text-slate-600">
                        Hasil evaluasi terukur membandingkan efisiensi sebelum dan setelah implementasi GemaSmart di Kabupaten Sumbawa.
                    </p>
                </div>

                <!-- TABLE KOMPARASI -->
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-slate-100 text-slate-700 uppercase font-bold text-xs tracking-wider border-b border-slate-200">
                                <tr>
                                    <th class="py-4 px-6">Indikator Kinerja</th>
                                    <th class="py-4 px-6 text-red-700 bg-red-50/50">Sebelum Inovasi (Konvensional)</th>
                                    <th class="py-4 px-6 text-emerald-800 bg-emerald-50/70">Setelah Inovasi GEMASMART</th>
                                    <th class="py-4 px-6 text-slate-700">Dampak &amp; Nilai Tambah</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="py-4 px-6 font-semibold text-slate-900">Unit Sasaran Bantuan</td>
                                    <td class="py-4 px-6 text-slate-600 bg-red-50/20">Kelompok Tani (Poktan), sering elitis</td>
                                    <td class="py-4 px-6 font-bold text-emerald-800 bg-emerald-50/30">Keluarga Penerima Manfaat (Desil 1–3 P3KE)</td>
                                    <td class="py-4 px-6 text-slate-600">Keadilan distributif menjangkau warga termiskin</td>
                                </tr>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="py-4 px-6 font-semibold text-slate-900">Tingkat Tumbuh (Survival Rate)</td>
                                    <td class="py-4 px-6 text-slate-600 bg-red-50/20">&lt; 40% (Banyak bibit mati tanpa rawatan)</td>
                                    <td class="py-4 px-6 font-bold text-emerald-800 bg-emerald-50/30">&gt; 85% dengan pendampingan mahasiswa</td>
                                    <td class="py-4 px-6 text-slate-600">Efisiensi anggaran bibit meningkat lebih dari 2 kali lipat</td>
                                </tr>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="py-4 px-6 font-semibold text-slate-900">Verifikasi Faktual &amp; Geotag</td>
                                    <td class="py-4 px-6 text-slate-600 bg-red-50/20">Manual tanpa koordinat lahan</td>
                                    <td class="py-4 px-6 font-bold text-emerald-800 bg-emerald-50/30">100% Ber-geotagging &amp; Uji Petik DPL</td>
                                    <td class="py-4 px-6 text-slate-600">Zero duplicate NIK &amp; bebas risiko manipulasi</td>
                                </tr>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="py-4 px-6 font-semibold text-slate-900">Waktu Penyelesaian Laporan Rekapitulasi</td>
                                    <td class="py-4 px-6 text-slate-600 bg-red-50/20">30 s.d. 60 hari kerja manual</td>
                                    <td class="py-4 px-6 font-bold text-emerald-800 bg-emerald-50/30">&lt; 15 menit (Cetak PDF Otomatis)</td>
                                    <td class="py-4 px-6 text-slate-600">Efisiensi waktu administrasi dinas hingga 80%</td>
                                </tr>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="py-4 px-6 font-semibold text-slate-900">Keberlanjutan Pasca-Salur</td>
                                    <td class="py-4 px-6 text-slate-600 bg-red-50/20">Selesai saat barang diserahkan</td>
                                    <td class="py-4 px-6 font-bold text-emerald-800 bg-emerald-50/30">Dipantau 3 Indikator Kemandirian</td>
                                    <td class="py-4 px-6 text-slate-600">Graduasi KPM menjadi mandiri pangan berkelanjutan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- SECTION 5: KESIAPAN 20 INDIKATOR IGA KEMENDAGRI -->
        <!-- ========================================================================= -->
        <section id="indikator" class="py-20 bg-white border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-14">
                
                <div class="text-center max-w-3xl mx-auto space-y-3">
                    <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-xs font-bold uppercase tracking-wider">
                        Standar Indeks Inovasi Daerah
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        Kesiapan 20 Parameter Indikator IGA Kemendagri
                    </h2>
                    <p class="text-base text-slate-600">
                        Inovasi GemaSmart telah memenuhi seluruh regulasi, bukti dukung (*evidence*), dan instrumen pelaporan Innovative Government Award.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    @php
                        $indikators = [
                            ['no' => '01', 'title' => 'Regulasi Inovasi Daerah', 'desc' => 'Didukung SK Bupati Sumbawa & Perbup Ketahanan Pangan'],
                            ['no' => '02', 'title' => 'Ketersediaan SDM Inovasi', 'desc' => 'Tim Bappeda, Distan, DPL Validator, dan Mahasiswa KKN'],
                            ['no' => '03', 'title' => 'Dukungan Anggaran', 'desc' => 'Alokasi APBD Kab. Sumbawa melalui hibah program Bappeda'],
                            ['no' => '04', 'title' => 'Bimtek / Sosialisasi Inovasi', 'desc' => 'Buku panduan operasional, video tutorial, & workshop DPL'],
                            ['no' => '05', 'title' => 'Pedoman & SOP Resmi', 'desc' => 'SOP Sensus CPCL, SOP Validasi, SOP Salur, & SOP Asesmen'],
                            ['no' => '06', 'title' => 'Keterlibatan Aktor', 'desc' => 'Kolaborasi Quadruple Helix Pemda, Kampus, KPM & Swasta'],
                            ['no' => '07', 'title' => 'Pelaksana Inovasi', 'desc' => 'Unit pengampu utama Bappeda Kab. Sumbawa & Dinas Teknis'],
                            ['no' => '08', 'title' => 'Jejaring Inovasi', 'desc' => 'Kemitraan formal berbasis MoU dengan Perguruan Tinggi (UTS)'],
                            ['no' => '09', 'title' => 'Sosialisasi Inovasi', 'desc' => 'Publikasi portal web, media sosial, & expo inovasi daerah'],
                            ['no' => '10', 'title' => 'Layanan Pengaduan', 'desc' => 'Portal pelaporan kendala bibit mandiri bagi warga & helpdesk'],
                            ['no' => '11', 'title' => 'Sistem Informasi Digital', 'desc' => 'Aplikasi web modular RBAC, peta GIS interaktif, & PDF export'],
                            ['no' => '12', 'title' => 'Waktu Pelayanan Cepat', 'desc' => 'Pemrosesan berkas CPCL terpangkas dari 30 hari jadi 7 hari'],
                            ['no' => '13', 'title' => 'Kemudahan Proses Layanan', 'desc' => 'UI/UX intuitif ramah smartphone & alur validasi mandiri'],
                            ['no' => '14', 'title' => 'Penyelesaian Layanan', 'desc' => 'Distribusi bantuan tepat waktu sesuai siklus musim tanam'],
                            ['no' => '15', 'title' => 'Tingkat Kepuasan Pengguna', 'desc' => 'Survei kepuasan penerima & kampus mitra mencapai > 88%'],
                            ['no' => '16', 'title' => 'Kemanfaatan Inovasi', 'desc' => 'Pengurangan belanja pangan & peningkatan gizi balita stunting'],
                            ['no' => '17', 'title' => 'Partisipasi Stakeholder', 'desc' => 'Keterlibatan ratusan mahasiswa KKN & ribuan kepala keluarga'],
                            ['no' => '18', 'title' => 'Kualitas Inovasi (Audit)', 'desc' => 'Algoritma FR-24 untuk deteksi anomali & anti fraud NIK ganda'],
                            ['no' => '19', 'title' => 'Potensi Replikasi Daerah', 'desc' => '100% Replicable untuk 514 Kabupaten/Kota di Indonesia'],
                            ['no' => '20', 'title' => 'Dokumentasi Hasil Inovasi', 'desc' => 'Bukti dukung video, BAST digital, & laporan eksekutif lengkap']
                        ];
                    @endphp

                    @foreach($indikators as $ind)
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 hover:border-emerald-500 hover:bg-emerald-50/30 transition-all group">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-mono font-bold text-emerald-800 bg-emerald-100/70 px-2 py-0.5 rounded">{{ $ind['no'] }}</span>
                            <span class="material-symbols-outlined text-emerald-600 text-[18px]">task_alt</span>
                        </div>
                        <h3 class="font-bold text-xs text-slate-900 group-hover:text-emerald-900">{{ $ind['title'] }}</h3>
                        <p class="text-[11px] text-slate-600 mt-1 leading-snug">{{ $ind['desc'] }}</p>
                    </div>
                    @endforeach

                </div>

            </div>
        <!-- ========================================================================= -->
        <!-- SECTION 6: MENU TANYA JAWAB (Q&A / FAQ) -->
        <!-- ========================================================================= -->
        <section id="qna" class="py-20 bg-slate-50 border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto space-y-3">
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-amber-100 text-amber-900 border border-amber-300 text-xs font-bold uppercase tracking-wider">
                        <span class="material-symbols-outlined text-[16px] text-amber-700">help</span>
                        <span>Pusat Tanya Jawab &amp; Edukasi</span>
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        Pertanyaan yang Sering Diajukan (Q&amp;A)
                    </h2>
                    <p class="text-base text-slate-600">
                        Temukan informasi lengkap dan regulasi seputar tata kelola bantuan bibit, validasi lapangan berjenjang, dan penggunaan sistem GemaSmart.
                    </p>
                </div>

                <!-- Interactive Search & Category Filter Bar -->
                <div class="max-w-3xl mx-auto space-y-4">
                    <!-- Search Input -->
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-3.5 text-slate-400 text-[22px] pointer-events-none">search</span>
                        <input id="faq-search-input" type="text" onkeyup="searchFaq(this.value)" placeholder="Cari pertanyaan... (misal: bibit, validasi, stunting, login, NIK, pupuk, anomali)" class="w-full pl-12 pr-10 py-3.5 rounded-2xl bg-white border border-slate-200 shadow-sm text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"/>
                        <button id="faq-clear-btn" type="button" onclick="clearFaqSearch()" class="hidden absolute right-3.5 top-3.5 text-slate-400 hover:text-slate-600">
                            <span class="material-symbols-outlined text-[20px]">close</span>
                        </button>
                    </div>

                    <!-- Filter Category Pills -->
                    <div class="flex flex-wrap items-center justify-center gap-2 pt-1 text-xs font-semibold">
                        <button type="button" onclick="filterFaq('all', this)" class="faq-filter-btn px-4 py-2 rounded-xl bg-emerald-800 text-white shadow-sm transition-all active:scale-95">Semua Topik</button>
                        <button type="button" onclick="filterFaq('kebijakan', this)" class="faq-filter-btn px-4 py-2 rounded-xl bg-white text-slate-700 border border-slate-200 hover:bg-slate-100 transition-all active:scale-95">Kebijakan &amp; Sasaran</button>
                        <button type="button" onclick="filterFaq('validasi', this)" class="faq-filter-btn px-4 py-2 rounded-xl bg-white text-slate-700 border border-slate-200 hover:bg-slate-100 transition-all active:scale-95">Validasi Lapangan</button>
                        <button type="button" onclick="filterFaq('bantuan', this)" class="faq-filter-btn px-4 py-2 rounded-xl bg-white text-slate-700 border border-slate-200 hover:bg-slate-100 transition-all active:scale-95">Paket &amp; Survival Rate</button>
                        <button type="button" onclick="filterFaq('kemandirian', this)" class="faq-filter-btn px-4 py-2 rounded-xl bg-white text-slate-700 border border-slate-200 hover:bg-slate-100 transition-all active:scale-95">Kemandirian &amp; Akun</button>
                    </div>
                </div>

                <!-- Accordion Q&A Items List -->
                <div id="faq-accordion-list" class="max-w-4xl mx-auto space-y-4">
                    
                    <!-- Q1 -->
                    <div class="faq-item bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all duration-200 hover:border-emerald-400" data-category="kebijakan" data-keywords="gemasmart latar belakang perbedaan poktan kelompok tani keluarga binaan">
                        <button type="button" onclick="toggleFaq('faq-1')" class="w-full p-5 sm:p-6 text-left flex items-start justify-between gap-4 focus:outline-none">
                            <div class="flex items-start gap-3.5">
                                <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">Q1</span>
                                <span class="font-bold text-base text-slate-900 leading-snug">Apa itu sistem GEMASMART dan apa bedanya dengan bantuan pertanian biasa?</span>
                            </div>
                            <span id="faq-icon-faq-1" class="material-symbols-outlined text-slate-400 text-[24px] transform transition-transform duration-200 flex-shrink-0">expand_more</span>
                        </button>
                        <div id="faq-ans-faq-1" class="hidden px-6 pb-6 pt-1 text-sm text-slate-600 border-t border-slate-100 leading-relaxed space-y-2">
                            <p>
                                <strong>GEMASMART</strong> adalah platform digital terintegrasi milik Pemerintah Kabupaten Sumbawa berkolaborasi dengan Perguruan Tinggi Mitra untuk mengelola, memvalidasi, mendistribusikan, dan memantau bantuan bibit secara akuntabel dan transparan.
                            </p>
                            <p>
                                Perbedaan utamanya: Bantuan pertanian konvensional umumnya menyasar <em>Kelompok Tani (Poktan)</em> tanpa pendampingan intensif pasca-salur. Sedangkan GemaSmart berfokus pada <strong>Keluarga Penerima Bantuan (KPB / Rumah Tangga)</strong> berbasis data mikro kemiskinan ekstrem (P3KE Desil 1–3) dan lokus pencegahan stunting. Bantuan didampingi langsung oleh tim Pendamping dan Validator dari fase tanam hingga panen dan graduasi mandiri.
                            </p>
                            <div class="pt-2 flex items-center gap-2 text-xs text-slate-500">
                                <span class="px-2 py-0.5 rounded bg-slate-100 font-medium">Kategori: Kebijakan &amp; Sasaran</span>
                                <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-800 font-semibold">Tersertifikasi Pemda</span>
                            </div>
                        </div>
                    </div>

                    <!-- Q2 -->
                    <div class="faq-item bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all duration-200 hover:border-emerald-400" data-category="kebijakan" data-keywords="siapa penerima kriteria syarat p3ke desil kemiskinan ekstrem stunting pekarangan">
                        <button type="button" onclick="toggleFaq('faq-2')" class="w-full p-5 sm:p-6 text-left flex items-start justify-between gap-4 focus:outline-none">
                            <div class="flex items-start gap-3.5">
                                <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">Q2</span>
                                <span class="font-bold text-base text-slate-900 leading-snug">Siapa saja yang berhak menjadi penerima bantuan dan apa persyaratannya?</span>
                            </div>
                            <span id="faq-icon-faq-2" class="material-symbols-outlined text-slate-400 text-[24px] transform transition-transform duration-200 flex-shrink-0">expand_more</span>
                        </button>
                        <div id="faq-ans-faq-2" class="hidden px-6 pb-6 pt-1 text-sm text-slate-600 border-t border-slate-100 leading-relaxed space-y-2">
                            <p>Penerima bantuan ditentukan melalui kriteria terukur:</p>
                            <ul class="list-disc list-inside space-y-1.5 pl-2 text-slate-700">
                                <li>Terdaftar dalam database resmi <strong>Pensasaran Percepatan Penghapusan Kemiskinan Ekstrem (P3KE) pada Desil 1, Desil 2, atau Desil 3</strong> di Kabupaten Sumbawa.</li>
                                <li>Keluarga yang memiliki balita berisiko stunting atau ibu hamil pada lokus prioritas penanganan stunting.</li>
                                <li>Memiliki kesediaan dan ketersediaan lahan pekarangan rumah (tanah atau polybag) serta akses sumber air sederhana.</li>
                                <li>Telah melalui sensus faktual <em>door-to-door</em> oleh Pendamping Lapangan dan lolos uji petik oleh Validator.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Q3 -->
                    <div class="faq-item bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all duration-200 hover:border-emerald-400" data-category="validasi" data-keywords="alur pendaftaran validasi cpcl sensus geotagging uji petik approval sk bupati">
                        <button type="button" onclick="toggleFaq('faq-3')" class="w-full p-5 sm:p-6 text-left flex items-start justify-between gap-4 focus:outline-none">
                            <div class="flex items-start gap-3.5">
                                <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">Q3</span>
                                <span class="font-bold text-base text-slate-900 leading-snug">Bagaimana alur pendaftaran dan validasi CPCL hingga disahkan Pemda?</span>
                            </div>
                            <span id="faq-icon-faq-3" class="material-symbols-outlined text-slate-400 text-[24px] transform transition-transform duration-200 flex-shrink-0">expand_more</span>
                        </button>
                        <div id="faq-ans-faq-3" class="hidden px-6 pb-6 pt-1 text-sm text-slate-600 border-t border-slate-100 leading-relaxed space-y-2">
                            <p>Proses Calon Petani Calon Lokasi (CPCL) melewati 3 lapis persetujuan yang ketat:</p>
                            <ol class="list-decimal list-inside space-y-1.5 pl-2 text-slate-700">
                                <li><strong>Sensus Lapangan:</strong> Pendamping mendatangi rumah calon penerima, memverifikasi kesesuaian NIK Dukcapil, memotret kondisi rumah &amp; lahan dengan koordinat geotagging presisi.</li>
                                <li><strong>Antrean Validasi:</strong> Berkas masuk ke antrean Validator untuk uji petik sampel kelayakan berkas dan lapangan.</li>
                                <li><strong>Filter Integritas FR-24:</strong> Sistem otomatis mendeteksi apakah NIK tersebut pernah menerima bantuan serupa atau terdaftar ganda.</li>
                                <li><strong>Persetujuan Pemda:</strong> Data yang bersih disahkan oleh Bappeda / Dinas Pertanian menjadi Surat Keputusan (SK) Penerima Bantuan resmi.</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Q4 -->
                    <div class="faq-item bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all duration-200 hover:border-emerald-400" data-category="validasi" data-keywords="kampus peran validator pendamping pengabdian independen">
                        <button type="button" onclick="toggleFaq('faq-4')" class="w-full p-5 sm:p-6 text-left flex items-start justify-between gap-4 focus:outline-none">
                            <div class="flex items-start gap-3.5">
                                <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">Q4</span>
                                <span class="font-bold text-base text-slate-900 leading-snug">Apa peran Perguruan Tinggi (Validator dan Pendamping) dalam inovasi ini?</span>
                            </div>
                            <span id="faq-icon-faq-4" class="material-symbols-outlined text-slate-400 text-[24px] transform transition-transform duration-200 flex-shrink-0">expand_more</span>
                        </button>
                        <div id="faq-ans-faq-4" class="hidden px-6 pb-6 pt-1 text-sm text-slate-600 border-t border-slate-100 leading-relaxed space-y-2">
                            <p>
                                Perguruan Tinggi Mitra bertindak sebagai <strong>mitra pelaksana independen</strong>. Keterlibatan tim independen memberikan jaminan bahwa:
                            </p>
                            <ul class="list-disc list-inside space-y-1 pl-2 text-slate-700">
                                <li>Penetapan sasaran bebas dari intervensi politis lokal (*zero conflict of interest*).</li>
                                <li>Validator bertindak secara objektif untuk memastikan kelayakan teknis budidaya.</li>
                                <li>Pendamping bertugas mendampingi keluarga secara berkala, mengajarkan teknik budidaya tanaman, pembuatan pupuk cair, hingga mencatat data tumbuh kembang tanaman di aplikasi.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Q5 -->
                    <div class="faq-item bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all duration-200 hover:border-emerald-400" data-category="bantuan" data-keywords="paket bantuan jenis bibit jagung padi cabai sayuran uang tunai modal sprayer poc">
                        <button type="button" onclick="toggleFaq('faq-5')" class="w-full p-5 sm:p-6 text-left flex items-start justify-between gap-4 focus:outline-none">
                            <div class="flex items-start gap-3.5">
                                <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">Q5</span>
                                <span class="font-bold text-base text-slate-900 leading-snug">Apa saja rincian komoditas bibit dan paket bantuan yang disalurkan?</span>
                            </div>
                            <span id="faq-icon-faq-5" class="material-symbols-outlined text-slate-400 text-[24px] transform transition-transform duration-200 flex-shrink-0">expand_more</span>
                        </button>
                        <div id="faq-ans-faq-5" class="hidden px-6 pb-6 pt-1 text-sm text-slate-600 border-t border-slate-100 leading-relaxed space-y-2">
                            <p>Paket bantuan dirancang terpadu (3 komponen subsidi):</p>
                            <ul class="list-disc list-inside space-y-1 pl-2 text-slate-700">
                                <li><strong>Bibit Pertanian &amp; Hortikultura:</strong> Jagung Hibrida Bisi-18, Padi Ciherang/Gogo bersertifikat, Cabai Rawit Hibrida polybag, bibit pohon buah (mangga arumanis, durian), dan sayuran cepat panen (kangkung, bayam, tomat).</li>
                                <li><strong>Stimulan Tunai Modal Usaha:</strong> Bantuan dana stimulan langsung untuk modal usaha olahan pangan atau sarana ternak kecil.</li>
                                <li><strong>Sarana Produksi:</strong> Hand sprayer pupuk cair 16L, Pupuk Organik Cair (POC) hayati, dan kompor gas standar SNI untuk produksi kripik/sambal olahan keluarga.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Q6 -->
                    <div class="faq-item bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all duration-200 hover:border-emerald-400" data-category="bantuan" data-keywords="bibit mati hama kering gagal panen survival rate fr-24 deteksi anomali early warning">
                        <button type="button" onclick="toggleFaq('faq-6')" class="w-full p-5 sm:p-6 text-left flex items-start justify-between gap-4 focus:outline-none">
                            <div class="flex items-start gap-3.5">
                                <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">Q6</span>
                                <span class="font-bold text-base text-slate-900 leading-snug">Bagaimana jika bibit terserang hama atau mati? Apa itu Algoritma Deteksi Anomali FR-24?</span>
                            </div>
                            <span id="faq-icon-faq-6" class="material-symbols-outlined text-slate-400 text-[24px] transform transition-transform duration-200 flex-shrink-0">expand_more</span>
                        </button>
                        <div id="faq-ans-faq-6" class="hidden px-6 pb-6 pt-1 text-sm text-slate-600 border-t border-slate-100 leading-relaxed space-y-2">
                            <p>
                                Sistem GemaSmart dilengkapi <strong>Algoritma Integritas &amp; Deteksi Dini FR-24</strong>. Ketika pendamping atau keluarga mengunggah foto dan laporan fase pertumbuhan berkala, sistem secara otomatis mengalkulasi <em>Survival Rate</em> (tingkat kelangsungan hidup).
                            </p>
                            <p>
                                Apabila angka survival rate turun di bawah <strong>50%</strong> atau terjadi serangan hama ulat/kutu daun, sistem otomatis menandai wilayah tersebut sebagai <strong>'Status Anomali'</strong> dengan indikator merah di dashboard Pemda. Hal ini memicu notifikasi darurat agar Petugas Penyuluh Lapangan (PPL) dan tim kampus segera melakukan intervensi proteksi tanaman secara cepat sebelum terlambat.
                            </p>
                        </div>
                    </div>

                    <!-- Q7 -->
                    <div class="faq-item bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all duration-200 hover:border-emerald-400" data-category="kemandirian" data-keywords="kapan mandiri graduasi skor kemandirian 3 pilar evaluasi pendapatan">
                        <button type="button" onclick="toggleFaq('faq-7')" class="w-full p-5 sm:p-6 text-left flex items-start justify-between gap-4 focus:outline-none">
                            <div class="flex items-start gap-3.5">
                                <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">Q7</span>
                                <span class="font-bold text-base text-slate-900 leading-snug">Kapan sebuah keluarga binaan dinyatakan 'Mandiri' (Graduasi)?</span>
                            </div>
                            <span id="faq-icon-faq-7" class="material-symbols-outlined text-slate-400 text-[24px] transform transition-transform duration-200 flex-shrink-0">expand_more</span>
                        </button>
                        <div id="faq-ans-faq-7" class="hidden px-6 pb-6 pt-1 text-sm text-slate-600 border-t border-slate-100 leading-relaxed space-y-2">
                            <p>
                                Keluarga binaan dinilai kemandiriannya oleh pendamping setiap kuartal berdasarkan <strong>3 Indikator Terukur</strong>:
                            </p>
                            <ol class="list-decimal list-inside space-y-1 pl-2 text-slate-700">
                                <li><strong>Peningkatan Pendapatan &amp; Penghematan Belanja (Bobot 40%):</strong> Terjadi pengurangan pengeluaran belanja sayur/cabai harian keluarga dan pemasukan dari penjualan panen.</li>
                                <li><strong>Pekerjaan / Usaha Sampingan Produktif (Bobot 30%):</strong> Terbentuknya unit usaha pekarangan atau olahan produk pangan bernilai tambah.</li>
                                <li><strong>Partisipasi Sosial Ekonomi (Bobot 30%):</strong> Keaktifan keluarga dalam kelompok simpan pinjam desa atau kegiatan ketahanan pangan lingkungan.</li>
                            </ol>
                            <p class="pt-1">
                                Jika akumulasi skor mencapai &ge; 75 poin, status keluarga berubah dari <em>Dampingan Aktif</em> menjadi <strong>Mandiri (Graduasi)</strong> dan kuota bantuan dapat dialihkan ke keluarga prasejahtera lainnya.
                            </p>
                        </div>
                    </div>

                    <!-- Q8 -->
                    <div class="faq-item bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all duration-200 hover:border-emerald-400" data-category="kemandirian" data-keywords="cara dapat akun login daftar password registrasi nomor kk nik">
                        <button type="button" onclick="toggleFaq('faq-8')" class="w-full p-5 sm:p-6 text-left flex items-start justify-between gap-4 focus:outline-none">
                            <div class="flex items-start gap-3.5">
                                <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">Q8</span>
                                <span class="font-bold text-base text-slate-900 leading-snug">Bagaimana cara mendapatkan akun login untuk pendamping, validator, atau warga penerima?</span>
                            </div>
                            <span id="faq-icon-faq-8" class="material-symbols-outlined text-slate-400 text-[24px] transform transition-transform duration-200 flex-shrink-0">expand_more</span>
                        </button>
                        <div id="faq-ans-faq-8" class="hidden px-6 pb-6 pt-1 text-sm text-slate-600 border-t border-slate-100 leading-relaxed space-y-2">
                            <ul class="list-disc list-inside space-y-1.5 pl-2 text-slate-700">
                                <li><strong>Untuk Akun Pendamping &amp; Validator:</strong> Diterbitkan secara resmi oleh Koordinator Kampus Mitra (LPPM) setelah dilakukan penugasan wilayah kecamatan. Username dan password diberikan saat sesi pembekalan (Bimtek).</li>
                                <li><strong>Untuk Akun Keluarga Penerima (KPB):</strong> Otomatis di-generate oleh sistem saat pengesahan SK CPCL dengan menggunakan Nomor KK sebagai password default. Warga dapat masuk ke portal penerima untuk memantau bantuan dan mengirim laporan mandiri atau melapor lewat WhatsApp.</li>
                                <li><strong>Untuk Akun Administrator Pemda:</strong> Dikelola oleh Bidang Perencanaan Bappeda Kabupaten Sumbawa.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Q9: Pelaporan WhatsApp -->
                    <div class="faq-item bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden transition-all duration-200 hover:border-emerald-400" data-category="bantuan" data-keywords="whatsapp lapor wa pengaduan kendala bibit perkembangan nomor api gemasmart format kpb">
                        <button type="button" onclick="toggleFaq('faq-9')" class="w-full p-5 sm:p-6 text-left flex items-start justify-between gap-4 focus:outline-none">
                            <div class="flex items-start gap-3.5">
                                <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">Q9</span>
                                <span class="font-bold text-base text-slate-900 leading-snug">Bagaimana cara Keluarga Penerima Bantuan (KPB) melapor melalui WhatsApp secara langsung?</span>
                            </div>
                            <span id="faq-icon-faq-9" class="material-symbols-outlined text-slate-400 text-[24px] transform transition-transform duration-200 flex-shrink-0">expand_more</span>
                        </button>
                        <div id="faq-ans-faq-9" class="hidden px-6 pb-6 pt-1 text-sm text-slate-600 border-t border-slate-100 leading-relaxed space-y-3">
                            <p>
                                Sistem <strong>GemaSmart</strong> telah terintegrasi dengan Webhook API WhatsApp Bot. Penerima bantuan dapat mengirim laporan perkembangan bibit, kendala hama, atau panen kapan saja langsung lewat WhatsApp tanpa harus menggunakan aplikasi komputer:
                            </p>
                            <div class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 space-y-2">
                                <div class="font-bold text-emerald-950 flex items-center gap-1.5 text-xs">
                                    <i class="fa-brands fa-whatsapp text-emerald-700 text-sm"></i> Format Pengiriman Pesan:
                                </div>
                                <code class="block bg-white p-2.5 rounded-lg border border-emerald-200 font-mono text-xs text-slate-800 select-all">#LAPOR#[NIK_ATAU_NO_KK]#[Isi Laporan / Kendala Bibit]</code>
                                <p class="text-xs text-slate-600">
                                    <strong>Contoh:</strong> <span class="italic">#LAPOR#5204011234560001#Bibit tomat tumbuh subur sudah berbunga lebat, butuh saran pupuk tambahan.</span>
                                </p>
                            </div>
                            <p class="text-xs text-slate-600">
                                Laporan yang dikirim akan otomatis masuk ke API sistem GemaSmart, diverifikasi dengan data penerima bantuan, dan langsung dapat ditinjau serta ditanggapi oleh Tim Pendamping, Kampus Mitra, dan Bappeda. Bot WhatsApp akan segera membalas dengan Nomor Tiket Laporan Anda secara instan.
                            </p>
                            <div class="pt-1 flex items-center gap-2 text-xs text-slate-500">
                                <span class="px-2 py-0.5 rounded bg-slate-100 font-medium">Kategori: Layanan Laporan WhatsApp</span>
                                <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-800 font-semibold">Tersinkronisasi Otomatis</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Helpdesk Card CTA -->
                <div class="max-w-4xl mx-auto rounded-2xl bg-white border border-amber-200/80 p-6 sm:p-8 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-[28px]">contact_support</span>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900">Masih Ada Pertanyaan atau Ingin Lapor Langsung?</h3>
                            <p class="text-xs text-slate-600 mt-0.5">Tim Sekretariat Inovasi Bappeda Kabupaten Sumbawa dan layanan bot WhatsApp siap membantu Anda.</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                        <a href="https://wa.me/6281234567890?text=%23LAPOR%23" target="_blank" class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-md transition-colors">
                            <i class="fa-brands fa-whatsapp text-[16px]"></i>
                            <span>Lapor via WhatsApp</span>
                        </a>
                        <button type="button" onclick="openPanduanModal()" class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs shadow-md transition-colors">
                            <span class="material-symbols-outlined text-[18px]">menu_book</span>
                            <span>Buku Panduan Lengkap</span>
                        </button>
                    </div>
                </div>

        </section>

        <!-- ========================================================================= -->
        <!-- SECTION: FORMULIR LAPORAN MANDIRI WARGA (TANPA PERLU LOGIN) -->
        <!-- ========================================================================= -->
        <section id="lapor" class="py-20 bg-white border-b border-slate-200 scroll-mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto space-y-3">
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-950 border border-emerald-300 text-xs font-bold uppercase tracking-wider">
                        <span class="material-symbols-outlined text-[16px] text-emerald-800">campaign</span>
                        <span>Layanan Laporan Mandiri Warga</span>
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        Kirim Laporan &amp; Kendala Bibit Tanpa Perlu Login
                    </h2>
                    <p class="text-base text-slate-600">
                        Keluarga Penerima Bantuan (KPB) maupun warga binaan dapat langsung melaporkan tumbuh kembang bibit, kendala serangan hama, atau hasil panen secara mandiri tanpa harus membuat akun atau login.
                    </p>
                </div>

                @if(session('laporan_sukses'))
                <!-- Flash Notification Sukses -->
                <div id="alert-sukses-lapor" class="max-w-4xl mx-auto bg-emerald-50 border-2 border-emerald-500 rounded-2xl p-6 sm:p-8 shadow-md flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[28px]">check_circle</span>
                    </div>
                    <div class="space-y-1.5 flex-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="text-lg font-bold text-emerald-950">Laporan Berhasil Diterima Sistem!</h3>
                            <span class="px-3 py-1 rounded-lg bg-emerald-700 text-white font-mono text-xs font-black tracking-wide">
                                {{ session('nomor_tiket') }}
                            </span>
                        </div>
                        <p class="text-sm text-emerald-900">
                            Terima kasih Bpk/Ibu <strong>{{ session('nama_pengirim') }}</strong>. Laporan Anda telah tersimpan di sistem GemaSmart dan langsung diteruskan ke Tim Pendamping Lapangan serta Pemerintah Daerah untuk ditindaklanjuti.
                        </p>
                    </div>
                </div>
                @endif

                <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- FORMULIR WEB MANDIRI (7 Kolom) -->
                    <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-lg shadow-slate-100 space-y-6">
                        <div class="border-b border-slate-100 pb-4">
                            <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                                <span class="material-symbols-outlined text-emerald-700 text-[22px]">edit_note</span>
                                Formulir Lapor Mandiri Web
                            </h3>
                            <p class="text-xs text-slate-500 mt-1">
                                Isi formulir singkat di bawah ini. Jika Anda memasukkan NIK terdaftar, sistem akan otomatis mengenali data bantuan Anda.
                            </p>
                        </div>

                        <!-- Feedback Box JS Saat Kirim via Ajax -->
                        <div id="ajaxResultBox" class="hidden rounded-2xl p-5 border"></div>

                        <form id="formLaporMandiri" action="{{ route('public.lapor.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf

                            <!-- NIK / No. KK -->
                            <div>
                                <label for="nik_input" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                    Nomor Induk Kependudukan (NIK) / No. KK <span class="text-slate-400 font-normal lowercase">(opsional tapi direkomendasikan)</span>
                                </label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-3.5 top-3 text-slate-400 text-[20px]">badge</span>
                                    <input type="text" id="nik_input" name="nik" maxlength="20" oninput="verifikasiNikPublik(this.value)" placeholder="Contoh: 5204010000000001 (16 digit)" class="w-full pl-11 pr-10 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all font-mono" />
                                    <div id="nikLoadingSpinner" class="hidden absolute right-3 top-3">
                                        <span class="material-symbols-outlined text-emerald-600 animate-spin text-[20px]">autorenew</span>
                                    </div>
                                </div>
                                <!-- Tempat Muncul Verifikasi NIK Real-time -->
                                <div id="nikFeedbackBox" class="hidden mt-2 p-2.5 rounded-xl text-xs flex items-center gap-2"></div>
                            </div>

                            <!-- Nama Lengkap & No WhatsApp (Grid 2 Kolom) -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="nama_input" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Nama Lengkap Pelapor
                                    </label>
                                    <div class="relative">
                                        <span class="material-symbols-outlined absolute left-3.5 top-3 text-slate-400 text-[20px]">person</span>
                                        <input type="text" id="nama_input" name="nama_pengirim" placeholder="Nama Kepala Keluarga / Pelapor" class="w-full pl-11 pr-3 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all" />
                                    </div>
                                </div>

                                <div>
                                    <label for="no_hp_input" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Nomor WhatsApp / HP Aktif
                                    </label>
                                    <div class="relative">
                                        <span class="material-symbols-outlined absolute left-3.5 top-3 text-slate-400 text-[20px]">call</span>
                                        <input type="text" id="no_hp_input" name="no_hp" placeholder="Contoh: 081234567890" class="w-full pl-11 pr-3 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all font-mono" />
                                    </div>
                                </div>
                            </div>

                            <!-- Isi Laporan / Kendala -->
                            <div>
                                <label for="laporan_teks" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                    Isi Laporan / Kendala Bibit <span class="text-rose-500">*</span>
                                </label>
                                <textarea id="laporan_teks" name="laporan_teks" rows="4" required placeholder="Ceritakan kondisi tanaman bibit bantuan Anda, kendala pupuk/hama yang dialami, atau hasil panen yang diperoleh..." class="w-full p-3.5 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all leading-relaxed"></textarea>
                            </div>

                            <!-- Upload Foto Lapangan (Opsional) -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                    Foto Kondisi Tanaman / Lapangan <span class="text-slate-400 font-normal lowercase">(opsional)</span>
                                </label>
                                <div class="border-2 border-dashed border-slate-200 hover:border-emerald-400 rounded-2xl p-4 text-center transition-colors">
                                    <input type="file" id="foto_input" name="foto" accept="image/*" onchange="previewPublicPhoto(this)" class="hidden" />
                                    <label for="foto_input" class="cursor-pointer flex flex-col items-center justify-center gap-1.5">
                                        <span class="material-symbols-outlined text-emerald-700 text-[32px]">add_a_photo</span>
                                        <span class="text-xs font-semibold text-slate-700">Klik untuk memilih foto dari galeri / kamera</span>
                                        <span class="text-[10px] text-slate-400">Format: JPG, PNG, WEBP (Maksimal 5 MB)</span>
                                    </label>
                                    <div id="fotoPreviewContainer" class="hidden mt-3 relative inline-block">
                                        <img id="fotoPreviewImg" src="#" alt="Preview" class="h-28 rounded-xl object-cover border border-slate-200 shadow-sm" />
                                        <button type="button" onclick="cancelPublicPhoto()" class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-rose-500 text-white flex items-center justify-center shadow hover:bg-rose-600 transition-colors">
                                            <span class="material-symbols-outlined text-[14px]">close</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button id="btnSubmitPublicReport" type="submit" class="w-full py-3.5 px-6 rounded-2xl bg-gradient-to-r from-emerald-700 to-emerald-900 hover:from-emerald-800 hover:to-emerald-950 text-white font-bold text-sm shadow-md hover:shadow-emerald-900/25 active:scale-[0.99] transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">send</span>
                                <span>Kirim Laporan Sekarang</span>
                            </button>
                        </form>
                    </div>

                    <!-- KANAL CEPAT WHATSAPP (5 Kolom) -->
                    <div class="lg:col-span-5 space-y-6">
                        
                        <!-- Kartu Hijau WhatsApp -->
                        <div class="bg-gradient-to-br from-emerald-900 via-green-950 to-slate-950 text-white rounded-3xl p-6 sm:p-7 shadow-xl border border-emerald-700/50 space-y-5">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-emerald-300 shrink-0">
                                    <i class="fa-brands fa-whatsapp text-[28px]"></i>
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold tracking-wider uppercase text-emerald-300 bg-emerald-900/80 px-2 py-0.5 rounded border border-emerald-700">Lapor Instan</span>
                                    <h4 class="text-base font-bold text-white mt-0.5">Lebih Nyaman Lewat WhatsApp?</h4>
                                </div>
                            </div>

                            <p class="text-xs text-emerald-100/90 leading-relaxed">
                                Anda juga dapat melapor langsung melalui aplikasi WhatsApp tanpa membuka formulir website. Pesan otomatis dicatat oleh sistem GemaSmart.
                            </p>

                            <!-- Kotak Format WA -->
                            <div class="bg-black/35 rounded-2xl p-4 border border-emerald-800/80 space-y-2">
                                <span class="text-[11px] font-bold text-emerald-300 block">Kirim Pesan dengan Format:</span>
                                <code class="block bg-black/60 p-2.5 rounded-xl font-mono text-xs text-emerald-200 select-all border border-emerald-800/50">#LAPOR#[NIK]#[Isi Laporan]</code>
                                <p class="text-[11px] text-emerald-200/80 italic">
                                    Contoh: #LAPOR#5204010000000001#Bibit tomat tumbuh subur sudah berbunga.
                                </p>
                            </div>

                            <!-- Tombol Direct Link WhatsApp -->
                            <a href="https://wa.me/6285743400187?text=%23LAPOR%23" target="_blank" class="w-full inline-flex items-center justify-center gap-2.5 py-3 px-5 rounded-2xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold text-sm shadow-md transition-all active:scale-95">
                                <i class="fa-brands fa-whatsapp text-[19px]"></i>
                                <span>Buka WhatsApp Hotline (0857-4340-0187)</span>
                            </a>

                            <div class="pt-2 border-t border-emerald-800/60 flex items-center justify-between text-[11px] text-emerald-300">
                                <span class="flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                                    Bot WhatsApp Aktif
                                </span>
                                <span>Balasan Tiket Instan</span>
                            </div>
                        </div>

                        <!-- Kartu Info Alur Laporan -->
                        <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 space-y-3">
                            <h5 class="text-xs font-bold text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[18px] text-slate-700">info</span>
                                Apa yang Terjadi Setelah Anda Melapor?
                            </h5>
                            <ol class="text-xs text-slate-600 space-y-2 list-decimal list-inside leading-relaxed">
                                <li>Sistem menerbitkan <strong>Nomor Tiket Aduan</strong> resmi.</li>
                                <li>Laporan diteruskan langsung ke <strong>Pendamping Lapangan</strong> di wilayah desa Anda.</li>
                                <li>Tim Pendamping &amp; Bappeda akan meninjau dan memberikan solusi atau bantuan tindak lanjut.</li>
                            </ol>
                        </div>

                    </div>

                </div>

            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- SECTION 7: CALL TO ACTION & UNDUH DOKUMEN PROFIL -->
        <!-- ========================================================================= -->
        <section id="dokumen" class="py-20 bg-gradient-to-br from-gov-green-dark via-emerald-950 to-slate-950 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:24px_24px] opacity-15 pointer-events-none"></div>

            <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
                
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-xs font-semibold text-emerald-300">
                    <span class="material-symbols-outlined text-[16px]">file_download</span>
                    <span>DOKUMEN RESMI INOVASI DAERAH</span>
                </div>

                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-white tracking-tight">
                    Akses Portal Sistem &amp; Unduh Panduan
                </h2>

                <p class="text-slate-300 max-w-2xl mx-auto text-sm sm:text-base leading-relaxed">
                    Akses portal digital terpadu GemaSmart untuk Pemerintah Daerah, Kampus Mitra, DPL Validator, Pendamping Lapangan, dan Keluarga Penerima Manfaat se-Kabupaten Sumbawa.
                </p>

                <!-- Dual Action Buttons -->
                <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-3 px-8 py-4 rounded-xl bg-gradient-to-r from-emerald-500 to-emerald-400 text-slate-950 font-black text-base shadow-xl shadow-emerald-500/25 hover:brightness-110 active:scale-95 transition-all">
                        <span class="material-symbols-outlined text-[22px]">login</span>
                        <span>Masuk ke Halaman Login</span>
                    </a>
                    <button type="button" onclick="openPanduanModal()" class="inline-flex items-center gap-2 px-7 py-4 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-base shadow-xl shadow-amber-500/25 transition-all">
                        <span class="material-symbols-outlined text-[22px]">menu_book</span>
                        <span>Buku Panduan Sistem</span>
                    </button>
                    <a href="{{ route('profil.download') }}" class="inline-flex items-center gap-2 px-6 py-4 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-base backdrop-blur-md border border-white/25 transition-all">
                        <span class="material-symbols-outlined text-[22px]">download_for_offline</span>
                        <span>Unduh Dokumen Profil (.MD)</span>
                    </a>
                </div>

                <!-- Footer Card Info -->
                <div class="pt-8 border-t border-white/10 grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs text-slate-400">
                    <div>
                        <strong class="text-white block mb-0.5">Sekretariat Inovasi:</strong>
                        <span>Bappeda Kabupaten Sumbawa, NTB</span>
                    </div>
                    <div>
                        <strong class="text-white block mb-0.5">Perguruan Tinggi Mitra:</strong>
                        <span>Universitas Teknologi Sumbawa (UTS)</span>
                    </div>
                    <div>
                        <strong class="text-white block mb-0.5">Kontak &amp; Bantuan:</strong>
                        <span>Dinas Pertanian &amp; Ketahanan Pangan</span>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <!-- ========================================================================= -->
    <!-- FOOTER -->
    <!-- ========================================================================= -->
    <footer class="bg-slate-950 text-slate-400 py-10 border-t border-slate-900 text-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-emerald-900/60 p-1 flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('images/gemas.jpg') }}" alt="Logo" class="w-full h-full object-contain" onerror="this.onerror=null; this.src='{{ asset('images/logo.png') }}';"/>
                </div>
                <div>
                    <span class="font-bold text-white block">GEMASMART</span>
                    <span>Pemerintah Kabupaten Sumbawa &copy; {{ date('Y') }}. Seluruh hak cipta dilindungi undang-undang.</span>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <button type="button" onclick="openPanduanModal()" class="text-amber-400 font-semibold hover:underline">Buku Panduan</button>
                <span>&bull;</span>
                <a href="#qna" class="hover:text-emerald-400 transition-colors">Menu Q&amp;A</a>
                <span>&bull;</span>
                <a href="{{ route('login') }}" class="text-emerald-400 font-semibold hover:underline">Halaman Login</a>
            </div>
        </div>
    </footer>

    <!-- ========================================================================= -->
    <!-- MODAL PANDUAN OPERASIONAL SISTEM (INTERAKTIF & MULTI-ROLE TABS) -->
    <!-- ========================================================================= -->
    <div id="modal-panduan" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm p-4 sm:p-6 md:p-10 flex items-center justify-center animate-fade-in" aria-modal="true" role="dialog">
        <div class="relative w-full max-w-4xl bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden flex flex-col max-h-[90vh]">
            
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-gov-green-dark to-emerald-900 px-6 py-5 text-white flex items-center justify-between flex-shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white/20 p-2 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[24px] text-amber-300">menu_book</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white tracking-tight">Buku Panduan &amp; Standar Operasional Prosedur (SOP)</h3>
                        <p class="text-xs text-emerald-200">Panduan Operasional Sistem Informasi Manajemen Bantuan Bibit GEMASMART</p>
                    </div>
                </div>
                <button type="button" onclick="closePanduanModal()" class="w-9 h-9 rounded-xl bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-colors">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>

            <!-- Modal Action Subbar: Role Tabs & Download -->
            <div class="bg-slate-50 border-b border-slate-200 px-6 py-3 flex flex-wrap items-center justify-between gap-3 flex-shrink-0">
                <div class="flex items-center gap-1.5 overflow-x-auto pb-1 sm:pb-0 text-xs font-semibold">
                    <button type="button" onclick="switchPanduanTab('tab-pemda')" class="panduan-tab-btn px-3 py-1.5 rounded-lg bg-emerald-800 text-white shadow-sm" data-tab="tab-pemda">Pemda / Bappeda</button>
                    <button type="button" onclick="switchPanduanTab('tab-kampus')" class="panduan-tab-btn px-3 py-1.5 rounded-lg bg-white text-slate-700 hover:bg-slate-200" data-tab="tab-kampus">Kampus Mitra</button>
                    <button type="button" onclick="switchPanduanTab('tab-validator')" class="panduan-tab-btn px-3 py-1.5 rounded-lg bg-white text-slate-700 hover:bg-slate-200" data-tab="tab-validator">Validator</button>
                    <button type="button" onclick="switchPanduanTab('tab-pendamping')" class="panduan-tab-btn px-3 py-1.5 rounded-lg bg-white text-slate-700 hover:bg-slate-200" data-tab="tab-pendamping">Pendamping</button>
                    <button type="button" onclick="switchPanduanTab('tab-warga')" class="panduan-tab-btn px-3 py-1.5 rounded-lg bg-white text-slate-700 hover:bg-slate-200" data-tab="tab-warga">Keluarga KPB</button>
                </div>
                <a href="{{ route('panduan.download') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs shadow transition-colors">
                    <span class="material-symbols-outlined text-[16px]">download</span>
                    <span>Unduh Dokumen Panduan (.DOCX)</span>
                </a>
            </div>

            <!-- Modal Body (Scrollable) -->
            <div class="p-6 overflow-y-auto space-y-6 text-sm text-slate-700">
                
                <!-- TAB 1: PEMDA / BAPPEDA -->
                <div id="tab-pemda" class="panduan-tab-content space-y-5">
                    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-start gap-3">
                        <span class="material-symbols-outlined text-emerald-700 text-[24px] mt-0.5">admin_panel_settings</span>
                        <div>
                            <strong class="block text-sm">Otoritas Pemerintah Daerah &amp; Bappeda Kabupaten Sumbawa</strong>
                            <span class="text-xs text-emerald-800">Bertindak sebagai regulator utama, penetap pagu dana hibah, pengesah SK CPCL, dan pemantau peta makro GIS di 24 Kecamatan.</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h4 class="font-bold text-slate-900 text-sm uppercase tracking-wide">Tahapan Operasional Pemda:</h4>
                        
                        <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="w-7 h-7 rounded-lg bg-emerald-800 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">1</span>
                            <div>
                                <strong class="text-slate-900 block">Penetapan Pagu Anggaran &amp; Alokasi Kuota Kecamatan</strong>
                                <p class="text-xs text-slate-600 mt-1">Buka menu <em>Program Bantuan &rarr; Alokasi Wilayah</em>. Tentukan kuota jumlah KK sasaran untuk masing-masing kecamatan sesuai prioritas indeks kerentanan pangan dan konsentrasi kemiskinan ekstrem P3KE.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="w-7 h-7 rounded-lg bg-emerald-800 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">2</span>
                            <div>
                                <strong class="text-slate-900 block">Persetujuan Akhir SK CPCL (Approval CPCL)</strong>
                                <p class="text-xs text-slate-600 mt-1">Buka menu <em>Verifikasi Data CPCL</em>. Tinjau berkas yang telah dinyatakan 'Layak' oleh Validator kampus. Klik tombol <em>Setujui / Terbitkan SK</em> untuk mengunci data penerima resmi.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="w-7 h-7 rounded-lg bg-emerald-800 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">3</span>
                            <div>
                                <strong class="text-slate-900 block">Audit Anomali &amp; Monitoring Peta GIS (FR-24)</strong>
                                <p class="text-xs text-slate-600 mt-1">Pantau indikator wilayah pada Dashboard GIS. Jika muncul notifikasi 'Anomali' (Survival Rate bibit &lt; 50%), segera perintahkan PPL kecamatan untuk melakukan intervensi proteksi tanaman.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 2: KAMPUS MITRA -->
                <div id="tab-kampus" class="panduan-tab-content hidden space-y-5">
                    <div class="p-4 rounded-xl bg-blue-50 border border-blue-200 text-blue-900 flex items-start gap-3">
                        <span class="material-symbols-outlined text-blue-700 text-[24px] mt-0.5">school</span>
                        <div>
                            <strong class="block text-sm">Pengelola Program Kampus Mitra (LPPM / Koordinator Mitra)</strong>
                            <span class="text-xs text-blue-800">Mengelola penugasan tim lapangan, menyusun item paket bantuan, dan mengunduh rekapitulasi program resmi.</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h4 class="font-bold text-slate-900 text-sm uppercase tracking-wide">Tahapan Operasional Kampus:</h4>
                        
                        <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="w-7 h-7 rounded-lg bg-blue-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">1</span>
                            <div>
                                <strong class="text-slate-900 block">Manajemen Pengguna Validator &amp; Pendamping</strong>
                                <p class="text-xs text-slate-600 mt-1">Buka menu <em>Pengguna Lapangan</em>. Daftarkan akun Validator dan Pendamping, lalu petakan ke wilayah kecamatan binaan.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="w-7 h-7 rounded-lg bg-blue-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">2</span>
                            <div>
                                <strong class="text-slate-900 block">Penyusunan Katalog Item Bantuan</strong>
                                <p class="text-xs text-slate-600 mt-1">Kelola stok paket bibit unggul, pupuk organik, serta peralatan pertanian yang siap didistribusikan ke keluarga sasaran binaan.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="w-7 h-7 rounded-lg bg-blue-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">3</span>
                            <div>
                                <strong class="text-slate-900 block">Ekspor Rekapitulasi &amp; Log Pendampingan</strong>
                                <p class="text-xs text-slate-600 mt-1">Buka menu <em>Laporan</em>. Sistem secara otomatis membuat berkas PDF rekapitulasi penyaluran bantuan bibit, bukti serah terima, dan log pemantauan lapangan berstandar audit resmi.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 3: VALIDATOR -->
                <div id="tab-validator" class="panduan-tab-content hidden space-y-5">
                    <div class="p-4 rounded-xl bg-purple-50 border border-purple-200 text-purple-900 flex items-start gap-3">
                        <span class="material-symbols-outlined text-purple-700 text-[24px] mt-0.5">verified_user</span>
                        <div>
                            <strong class="block text-sm">Validator Independen</strong>
                            <span class="text-xs text-purple-800">Menjamin validitas ilmiah, akurasi geotagging pekarangan, dan kepatuhan kriteria P3KE sebelum diajukan ke dinas.</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h4 class="font-bold text-slate-900 text-sm uppercase tracking-wide">Tahapan Operasional Validator:</h4>
                        
                        <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="w-7 h-7 rounded-lg bg-purple-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">1</span>
                            <div>
                                <strong class="text-slate-900 block">Pemeriksaan Antrean Survei CPCL Lapangan</strong>
                                <p class="text-xs text-slate-600 mt-1">Buka menu <em>Antrean Validasi</em>. Tinjau berkas keluarga yang disurvei oleh pendamping, cek foto rumah tangga, kesesuaian NIK, dan koordinat GPS.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="w-7 h-7 rounded-lg bg-purple-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">2</span>
                            <div>
                                <strong class="text-slate-900 block">Uji Petik Sampel Kelayakan Lahan</strong>
                                <p class="text-xs text-slate-600 mt-1">Lakukan uji petik lapangan secara berkala untuk mengecek kondisi lahan pekarangan dan kesiapan keluarga membudidayakan bibit.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="w-7 h-7 rounded-lg bg-purple-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">3</span>
                            <div>
                                <strong class="text-slate-900 block">Rekomendasi Setuju / Catatan Perbaikan</strong>
                                <p class="text-xs text-slate-600 mt-1">Klik <em>Valid (Setuju)</em> jika memenuhi syarat atau berikan <em>Catatan Revisi</em> kepada pendamping bila dokumen belum lengkap.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 4: PENDAMPING -->
                <div id="tab-pendamping" class="panduan-tab-content hidden space-y-5">
                    <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 flex items-start gap-3">
                        <span class="material-symbols-outlined text-amber-700 text-[24px] mt-0.5">assignment_ind</span>
                        <div>
                            <strong class="block text-sm">Petugas Pendamping Lapangan</strong>
                            <span class="text-xs text-amber-800">Garda terdepan sensus faktual, pendampingan budidaya, pelaporan fase tumbuh, dan skoring kemandirian.</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h4 class="font-bold text-slate-900 text-sm uppercase tracking-wide">Tahapan Operasional Pendamping:</h4>
                        
                        <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="w-7 h-7 rounded-lg bg-amber-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">1</span>
                            <div>
                                <strong class="text-slate-900 block">Sensus Faktual &amp; Ambil Foto Geotagging</strong>
                                <p class="text-xs text-slate-600 mt-1">Buka menu <em>Input CPCL</em> melalui smartphone. Masukkan NIK, No KK, desil, ambil foto lahan dan koordinat GPS di lokasi calon penerima.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="w-7 h-7 rounded-lg bg-amber-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">2</span>
                            <div>
                                <strong class="text-slate-900 block">Penyaluran Bantuan &amp; BAST Digital</strong>
                                <p class="text-xs text-slate-600 mt-1">Dampingi penyerahan paket bibit dan sarana produksi. Input tanggal terima dan unggah tanda tangan Berita Acara Serah Terima (BAST).</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="w-7 h-7 rounded-lg bg-amber-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">3</span>
                            <div>
                                <strong class="text-slate-900 block">Lapor Fase Tumbuh Kembang &amp; Skoring Kemandirian</strong>
                                <p class="text-xs text-slate-600 mt-1">Setiap 2 minggu, laporkan persentase bibit hidup (*survival rate*). Pada akhir periode, isi kuesioner 3 indikator kemandirian keluarga binaan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 5: KELUARGA KPB -->
                <div id="tab-warga" class="panduan-tab-content hidden space-y-5">
                    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-start gap-3">
                        <span class="material-symbols-outlined text-emerald-700 text-[24px] mt-0.5">home</span>
                        <div>
                            <strong class="block text-sm">Keluarga Penerima Bantuan (KPB)</strong>
                            <span class="text-xs text-emerald-800">Pemanfaat bantuan bibit pekarangan dan pengguna portal mandiri pelaporan warga.</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h4 class="font-bold text-slate-900 text-sm uppercase tracking-wide">Langkah Mudah untuk Warga:</h4>
                        
                        <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="w-7 h-7 rounded-lg bg-emerald-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">1</span>
                            <div>
                                <strong class="text-slate-900 block">Menerima Paket Bantuan</strong>
                                <p class="text-xs text-slate-600 mt-1">Terima bibit tanaman unggul dan stimulan sesuai jadwal pembagian di kantor desa/dusun bersama pendamping.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="w-7 h-7 rounded-lg bg-emerald-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">2</span>
                            <div>
                                <strong class="text-slate-900 block">Login ke Portal Warga</strong>
                                <p class="text-xs text-slate-600 mt-1">Gunakan Nomor Kartu Keluarga (KK) dan NIK untuk masuk ke halaman portal penerima di smartphone Anda.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="w-7 h-7 rounded-lg bg-emerald-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">3</span>
                            <div>
                                <strong class="text-slate-900 block">Kirim Laporan &amp; Aduan Mandiri</strong>
                                <p class="text-xs text-slate-600 mt-1">Unggah foto perkembangan kebun pekarangan Anda atau sampaikan kendala bila bibit terkena hama agar lekas dibantu penyuluh.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="bg-slate-100 px-6 py-4 border-t border-slate-200 flex flex-wrap items-center justify-between gap-3 flex-shrink-0">
                <span class="text-xs text-slate-500 font-medium">Dokumen panduan berlisensi resmi Pemerintah Kabupaten Sumbawa.</span>
                <div class="flex items-center gap-2">
                    <button type="button" onclick="closePanduanModal()" class="px-4 py-2 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold text-xs transition-colors">Tutup</button>
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl bg-emerald-800 hover:bg-emerald-700 text-white font-bold text-xs shadow transition-colors">Masuk ke Sistem</a>
                </div>
            </div>

        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- INTERACTIVE JAVASCRIPT LOGIC (FAQ ACCORDION, SEARCH, FILTER & MODAL) -->
    <!-- ========================================================================= -->
    <script>
        // 1. Mobile Menu Toggle
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });

        // 2. Modal Panduan Handlers
        function openPanduanModal() {
            const modal = document.getElementById('modal-panduan');
            if (modal) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        function closePanduanModal() {
            const modal = document.getElementById('modal-panduan');
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }

        // Close modal on click outside
        window.addEventListener('click', (e) => {
            const modal = document.getElementById('modal-panduan');
            if (e.target === modal) {
                closePanduanModal();
            }
        });

        // Close on Esc key
        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closePanduanModal();
            }
        });

        // 3. Tab Switching in Modal Panduan
        function switchPanduanTab(tabId) {
            document.querySelectorAll('.panduan-tab-content').forEach(el => el.classList.add('hidden'));
            const target = document.getElementById(tabId);
            if (target) target.classList.remove('hidden');

            document.querySelectorAll('.panduan-tab-btn').forEach(btn => {
                if (btn.getAttribute('data-tab') === tabId) {
                    btn.classList.add('bg-emerald-800', 'text-white', 'shadow-sm');
                    btn.classList.remove('bg-white', 'text-slate-700');
                } else {
                    btn.classList.remove('bg-emerald-800', 'text-white', 'shadow-sm');
                    btn.classList.add('bg-white', 'text-slate-700');
                }
            });
        }

        // 4. FAQ Accordion Toggle
        function toggleFaq(id) {
            const ans = document.getElementById('faq-ans-' + id);
            const icon = document.getElementById('faq-icon-' + id);
            if (!ans) return;

            const isHidden = ans.classList.contains('hidden');
            if (isHidden) {
                ans.classList.remove('hidden');
                if (icon) icon.classList.add('rotate-180', 'text-emerald-700');
            } else {
                ans.classList.add('hidden');
                if (icon) icon.classList.remove('rotate-180', 'text-emerald-700');
            }
        }

        // 5. FAQ Category Filtering
        let currentCategory = 'all';

        function filterFaq(category, btnElement) {
            currentCategory = category;
            
            // Update button styles
            document.querySelectorAll('.faq-filter-btn').forEach(btn => {
                btn.classList.remove('bg-emerald-800', 'text-white', 'shadow-sm');
                btn.classList.add('bg-white', 'text-slate-700', 'border', 'border-slate-200');
            });
            if (btnElement) {
                btnElement.classList.remove('bg-white', 'text-slate-700');
                btnElement.classList.add('bg-emerald-800', 'text-white', 'shadow-sm');
            }

            applyFaqFilter();
        }

        // 6. FAQ Search Logic
        function searchFaq(query) {
            const clearBtn = document.getElementById('faq-clear-btn');
            if (clearBtn) {
                if (query.trim().length > 0) {
                    clearBtn.classList.remove('hidden');
                } else {
                    clearBtn.classList.add('hidden');
                }
            }
            applyFaqFilter();
        }

        function clearFaqSearch() {
            const input = document.getElementById('faq-search-input');
            if (input) {
                input.value = '';
                searchFaq('');
            }
        }

        function applyFaqFilter() {
            const query = (document.getElementById('faq-search-input')?.value || '').toLowerCase().trim();
            const items = document.querySelectorAll('.faq-item');

            items.forEach(item => {
                const category = item.getAttribute('data-category') || '';
                const keywords = item.getAttribute('data-keywords') || '';
                const text = item.textContent.toLowerCase();

                const matchesCategory = (currentCategory === 'all' || category === currentCategory);
                const matchesQuery = (query === '' || text.includes(query) || keywords.includes(query));

                if (matchesCategory && matchesQuery) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        }

        // ==========================================
        // 7. PUBLIC REPORT JAVASCRIPT (TANPA LOGIN)
        // ==========================================
        let nikDebounceTimeout = null;
        function verifikasiNikPublik(val) {
            clearTimeout(nikDebounceTimeout);
            const clean = val.replace(/\D/g, '');
            const box = document.getElementById('nikFeedbackBox');
            const spinner = document.getElementById('nikLoadingSpinner');
            const namaInput = document.getElementById('nama_input');

            if (clean.length < 15) {
                if (box) { box.classList.add('hidden'); }
                if (spinner) { spinner.classList.add('hidden'); }
                return;
            }

            if (spinner) { spinner.classList.remove('hidden'); }

            nikDebounceTimeout = setTimeout(() => {
                fetch('/lapor-mandiri/cek-nik?nik=' + encodeURIComponent(clean))
                    .then(res => res.json())
                    .then(data => {
                        if (spinner) { spinner.classList.add('hidden'); }
                        if (box) {
                            box.classList.remove('hidden');
                            if (data.found) {
                                box.className = "mt-2 p-3 rounded-xl text-xs bg-emerald-50 border border-emerald-300 text-emerald-950 flex items-start gap-2";
                                box.innerHTML = `
                                    <span class="material-symbols-outlined text-emerald-700 text-[18px] shrink-0 mt-0.5">verified</span>
                                    <div>
                                        <strong>Terverifikasi KPB:</strong> ${data.nama} (${data.desa}, Kec. ${data.kecamatan})<br>
                                        <span class="text-[11px] text-emerald-800">${data.program || 'Bantuan Bibit'} ${data.desil ? '• ' + data.desil : ''}</span>
                                    </div>
                                `;
                                if (namaInput && !namaInput.value.trim()) {
                                    namaInput.value = data.nama;
                                }
                            } else {
                                box.className = "mt-2 p-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 text-slate-600 flex items-center gap-1.5";
                                box.innerHTML = `
                                    <span class="material-symbols-outlined text-slate-400 text-[16px]">info</span>
                                    <span>NIK belum tercatat di data penerima, laporan tetap dapat dikirim sebagai warga umum.</span>
                                `;
                            }
                        }
                    })
                    .catch(() => {
                        if (spinner) { spinner.classList.add('hidden'); }
                    });
            }, 400);
        }

        function previewPublicPhoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('fotoPreviewImg');
                    const container = document.getElementById('fotoPreviewContainer');
                    if (img && container) {
                        img.src = e.target.result;
                        container.classList.remove('hidden');
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function cancelPublicPhoto() {
            const input = document.getElementById('foto_input');
            const container = document.getElementById('fotoPreviewContainer');
            if (input) { input.value = ''; }
            if (container) { container.classList.add('hidden'); }
        }

        // AJAX Submission Handling untuk pengalaman instan
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('formLaporMandiri');
            if (!form) return;

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const btn = document.getElementById('btnSubmitPublicReport');
                const resultBox = document.getElementById('ajaxResultBox');
                const origBtnHtml = btn.innerHTML;

                btn.disabled = true;
                btn.innerHTML = `<span class="material-symbols-outlined text-[18px] animate-spin">autorenew</span> Mengirim Laporan...`;

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    btn.disabled = false;
                    btn.innerHTML = origBtnHtml;

                    if (data.success) {
                        resultBox.classList.remove('hidden');
                        resultBox.className = "rounded-2xl p-6 bg-emerald-50 border-2 border-emerald-500 shadow-md flex items-start gap-3.5 text-emerald-950";
                        resultBox.innerHTML = `
                            <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[24px]">task_alt</span>
                            </div>
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h4 class="font-bold text-base text-emerald-950">Laporan Berhasil Terkirim!</h4>
                                    <span class="px-2.5 py-0.5 rounded-lg bg-emerald-700 text-white font-mono text-xs font-black">${data.nomor_tiket}</span>
                                </div>
                                <p class="text-xs text-emerald-900 leading-relaxed">
                                    Terima kasih Bpk/Ibu <strong>${data.data.pengirim}</strong>. Laporan Anda langsung diteruskan ke Tim Pendamping Lapangan untuk ditindaklanjuti.
                                </p>
                                <div class="pt-2">
                                    <button type="button" onclick="this.closest('#ajaxResultBox').classList.add('hidden')" class="px-3 py-1 bg-emerald-200 hover:bg-emerald-300 text-emerald-950 rounded-lg text-xs font-semibold">Tutup Notifikasi</button>
                                </div>
                            </div>
                        `;
                        form.reset();
                        cancelPublicPhoto();
                        const feedback = document.getElementById('nikFeedbackBox');
                        if (feedback) feedback.classList.add('hidden');
                        resultBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    } else {
                        alert(data.message || 'Terjadi kesalahan saat mengirim laporan.');
                    }
                })
                .catch(err => {
                    btn.disabled = false;
                    btn.innerHTML = origBtnHtml;
                    // Fallback submit standar jika browser memblokir fetch
                    form.submit();
                });
            });
        });
    </script>

</body>
</html>
