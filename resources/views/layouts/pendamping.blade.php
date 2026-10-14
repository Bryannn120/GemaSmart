<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="web_dashboard" name="shell-type"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">tailwind.config = { darkMode: "class", theme: { extend: { "colors": { "on-error-container": "#93000a", "surface": "#fbf9f9", "outline": "#717a6d", "inverse-on-surface": "#f2f0f0", "on-primary-fixed-variant": "#0c5216", "on-tertiary-fixed": "#001c3a", "surface-variant": "#e3e2e2", "on-secondary-fixed": "#2a1800", "status-fraud": "#D32F2F", "tertiary": "#003b71", "border-light": "#E5E7EB", "primary-fixed-dim": "#91d78a", "on-secondary-fixed-variant": "#643f00", "status-verified-surface": "#E8F5E9", "on-tertiary-container": "#a3c7ff", "primary-fixed": "#acf4a4", "surface-container-low": "#f5f3f3", "text-primary": "#212121", "on-background": "#1b1c1c", "on-secondary-container": "#694300", "surface-container-high": "#e9e8e7", "status-warning": "#FF9800", "canvas-bg": "#FFFFFF", "text-secondary": "#757575", "surface-container-highest": "#e3e2e2", "status-info": "#1976D2", "tertiary-container": "#005299", "gov-green-surface": "#E8F5E9", "on-tertiary": "#ffffff", "secondary": "#835400", "status-info-surface": "#E3F2FD", "surface-muted": "#F5F5F5", "surface-container-lowest": "#ffffff", "text-tertiary": "#9E9E9E", "surface-dim": "#dbdad9", "on-surface-variant": "#41493e", "gov-green-dark": "#0E3A13", "secondary-fixed": "#ffddb5", "outline-variant": "#c0c9bb", "tertiary-fixed": "#d4e3ff", "status-warning-surface": "#FFF3E0", "error": "#ba1a1a", "surface-container": "#efeded", "status-verified": "#43A047", "secondary-fixed-dim": "#ffb957", "background": "#fbf9f9", "gold-surface": "#FFFDE7", "surface-subtle": "#F8FAFC", "status-fraud-surface": "#FFEBEE", "on-primary": "#ffffff", "error-container": "#ffdad6", "inverse-surface": "#303031", "on-primary-fixed": "#002203", "tertiary-fixed-dim": "#a5c8ff", "on-tertiary-fixed-variant": "#004786", "on-primary-container": "#90d689", "gold-accent": "#F9A825", "primary-container": "#1b5e20", "surface-bright": "#fbf9f9", "primary": "#00450d", "border-medium": "#E0E0E0", "on-surface": "#1b1c1c", "surface-tint": "#2a6b2c", "inverse-primary": "#91d78a", "on-error": "#ffffff", "on-secondary": "#ffffff", "secondary-container": "#fcab28" }, "borderRadius": { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" }, "spacing": { "gutter-lg": "2rem", "space-lg": "1rem", "margin": "1rem", "gutter-md": "1.5rem", "space-xs": "0.25rem", "space-2xl": "2rem", "space-sm": "0.5rem", "space-3xl": "3rem", "space-md": "0.75rem", "space-xl": "1.5rem", "gutter": "1rem", "margin-md": "1.5rem", "margin-lg": "2.5rem" }, "fontFamily": { "body-md": ["Inter"], "label-md": ["Inter"], "headline-sm": ["Inter"], "headline-xl-mobile": ["Inter"], "code-dense": ["Inter"], "body-sm": ["Inter"], "label-sm": ["Inter"], "headline-xl": ["Inter"], "label-lg": ["Inter"], "headline-md": ["Inter"], "headline-lg": ["Inter"], "body-lg": ["Inter"] }, "fontSize": { "body-md": ["0.875rem", { "lineHeight": "1.375rem", "letterSpacing": "0em", "fontWeight": "400" }], "label-md": ["0.75rem", { "lineHeight": "1rem", "letterSpacing": "0.02em", "fontWeight": "600" }], "headline-sm": ["1.125rem", { "lineHeight": "1.5rem", "letterSpacing": "-0.01em", "fontWeight": "600" }], "headline-xl-mobile": ["1.5rem", { "lineHeight": "2rem", "letterSpacing": "-0.02em", "fontWeight": "700" }], "code-dense": ["0.8125rem", { "lineHeight": "1.125rem", "letterSpacing": "0.03em", "fontWeight": "500" }], "body-sm": ["0.75rem", { "lineHeight": "1.125rem", "letterSpacing": "0.005em", "fontWeight": "400" }], "label-sm": ["0.6875rem", { "lineHeight": "0.875rem", "letterSpacing": "0.04em", "fontWeight": "700" }], "headline-xl": ["2rem", { "lineHeight": "2.5rem", "letterSpacing": "-0.025em", "fontWeight": "700" }], "label-lg": ["0.875rem", { "lineHeight": "1.25rem", "letterSpacing": "0.01em", "fontWeight": "600" }], "headline-md": ["1.25rem", { "lineHeight": "1.75rem", "letterSpacing": "-0.015em", "fontWeight": "600" }], "headline-lg": ["1.5rem", { "lineHeight": "2rem", "letterSpacing": "-0.02em", "fontWeight": "600" }], "body-lg": ["1rem", { "lineHeight": "1.5rem", "letterSpacing": "0em", "fontWeight": "400" }] } } } };</script>
</head>
<body class="bg-surface font-body-md text-on-surface antialiased">
    @include('components.preloader')
    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-gray-900/50 z-40 hidden lg:hidden transition-opacity"></div>

    <aside id="sidebar" class="fixed left-0 top-0 h-screen w-[260px] bg-primary-container text-on-primary z-50 flex flex-col justify-between shadow-[0_1px_8px_rgba(0,0,0,0.04)] transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="flex flex-col">
            <div class="p-space-lg bg-gov-green-dark flex items-center justify-between gap-space-md">
                <div class="flex items-center gap-space-md">
                    <img alt="Logo" class="h-8 w-auto object-contain" src="{{ asset('gemas.jpg') }}"/>
                    <div class="flex flex-col min-w-0">
                        <span class="font-headline-sm text-headline-sm text-on-primary tracking-tight truncate">Gema Smart Sumbawa</span>
                        <span class="font-label-sm text-label-sm text-primary-fixed-dim uppercase tracking-wider truncate">Kader Lapangan</span>
                    </div>
                </div>
                <button id="close-sidebar-btn" class="lg:hidden p-1 text-primary-fixed-dim hover:text-white rounded-lg">
                    <span class="material-symbols-outlined text-[24px]">close</span>
                </button>
            </div>
            <div class="p-space-md mx-space-md mt-space-md rounded-xl bg-gov-green-dark/60 flex items-center gap-space-md">
                <div class="w-9 h-9 rounded-full bg-secondary-fixed flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-secondary text-[20px]">badge</span>
                </div>
                <div class="flex flex-col min-w-0 flex-1">
                    <span class="font-label-lg text-label-lg text-on-primary font-semibold truncate">{{ Auth::user()->name ?? 'Pendamping' }}</span>
                    <span class="inline-block px-space-xs py-0.5 rounded-full bg-secondary-container text-on-secondary-fixed font-label-sm text-label-sm mt-0.5 w-fit">Pendamping Kampus</span>
                </div>
            </div>
            <nav class="flex flex-col gap-1 px-space-md mt-space-lg">
                <a href="{{ route('dashboard.pendamping') }}" class="flex items-center gap-space-md px-space-md py-space-sm rounded-lg transition-colors {{ request()->routeIs('dashboard.pendamping') ? 'bg-primary text-on-primary font-semibold shadow-sm' : 'text-on-primary/80 hover:bg-gov-green-dark hover:text-on-primary font-label-lg text-label-lg' }}">
                    <span class="material-symbols-outlined text-[20px]">home</span><span>Beranda</span>
                </a>
                {{-- Menu Tugas Validasi dinonaktifkan sementara sesuai instruksi --}}
                <a href="{{ route('pendamping.lapor.index') }}" class="flex items-center gap-space-md px-space-md py-space-sm rounded-lg {{ request()->routeIs('pendamping.lapor.*') ? 'bg-primary text-on-primary font-semibold shadow-sm' : 'text-on-primary/80 hover:bg-gov-green-dark hover:text-on-primary transition-colors font-label-lg text-label-lg' }}">
                    <span class="material-symbols-outlined text-[20px]">eco</span><span>Lapor Tumbuh Kembang</span>
                </a>
                <a href="{{ route('pendamping.keluarga_penerima.index') }}" class="flex items-center gap-space-md px-space-md py-space-sm rounded-lg {{ request()->routeIs('pendamping.keluarga_penerima.*') ? 'bg-primary text-on-primary font-semibold shadow-sm' : 'text-on-primary/80 hover:bg-gov-green-dark hover:text-on-primary transition-colors font-label-lg text-label-lg' }}">
                    <span class="material-symbols-outlined text-[20px]">group</span><span>Keluarga Penerima Binaan</span>
                </a>
                <a href="{{ route('pendamping.penyaluran-bantuan.index') }}" class="flex items-center gap-space-md px-space-md py-space-sm rounded-lg {{ request()->routeIs('pendamping.penyaluran-bantuan.*') ? 'bg-primary text-on-primary font-semibold shadow-sm' : 'text-on-primary/80 hover:bg-gov-green-dark hover:text-on-primary transition-colors font-label-lg text-label-lg' }}">
                    <span class="material-symbols-outlined text-[20px]">volunteer_activism</span><span>Penyaluran Bantuan</span>
                </a>
                <a href="{{ route('pendamping.kemandirian.index') }}" class="flex items-center gap-space-md px-space-md py-space-sm rounded-lg {{ request()->routeIs('pendamping.kemandirian.*') ? 'bg-primary text-on-primary font-semibold shadow-sm' : 'text-on-primary/80 hover:bg-gov-green-dark hover:text-on-primary transition-colors font-label-lg text-label-lg' }}">
                    <span class="material-symbols-outlined text-[20px]">query_stats</span><span>Monitoring Kemandirian</span>
                </a>
                <a href="{{ route('profile.index') }}" class="flex items-center gap-space-md px-space-md py-space-sm rounded-lg {{ request()->routeIs('profile.*') ? 'bg-primary text-on-primary font-semibold shadow-sm' : 'text-on-primary/80 hover:bg-gov-green-dark hover:text-on-primary transition-colors font-label-lg text-label-lg' }}">
                    <span class="material-symbols-outlined text-[20px]">settings</span><span>Pengaturan Akun</span>
                </a>
            </nav>
        </div>
        <div class="p-space-md flex flex-col gap-space-sm bg-gov-green-dark/40">
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="w-full flex items-center gap-space-md px-space-md py-space-sm rounded-lg text-on-primary/80 hover:bg-gov-green-dark hover:text-on-primary transition-colors font-label-lg text-label-lg">
                    <span class="material-symbols-outlined text-[20px]">logout</span><span>Keluar</span>
                </button>
            </form>
            <div class="px-space-md pt-space-xs text-on-primary/50 font-label-sm text-label-sm flex items-center justify-between">
                <span>Gema Smart Mobile v2.0</span>
            </div>
        </div>
    </aside>

    <div class="lg:pl-[260px] flex flex-col min-h-screen transition-all duration-300 ease-in-out">
        <header class="fixed top-0 left-0 lg:left-[260px] right-0 h-16 bg-surface/90 backdrop-blur-xl z-30 shadow-[0_1px_8px_rgba(0,0,0,0.04)] transition-all duration-300 ease-in-out">
            <div class="h-16 w-full px-4 lg:px-space-xl flex items-center justify-between">
                <div class="flex items-center gap-space-sm min-w-0">
                    <button id="mobile-menu-btn" class="lg:hidden p-2 -ml-2 text-text-secondary hover:bg-surface-container-high rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-[24px]">menu</span>
                    </button>
                    <img alt="Logo" class="h-8 w-auto object-contain lg:hidden hidden sm:block" src="{{ asset('gemas.jpg') }}"/>
                    <div class="hidden sm:flex items-center gap-space-xs font-body-sm text-body-sm text-text-secondary overflow-hidden">
                        <span class="hover:text-text-primary transition-colors cursor-pointer">Pendamping</span>
                        <span class="material-symbols-outlined text-[14px] text-text-tertiary">chevron_right</span>
                        <span class="text-text-primary font-semibold truncate">Dashboard</span>
                    </div>
                </div>
                <div class="flex items-center gap-space-lg">
                    <div class="flex items-center gap-space-sm cursor-pointer p-space-xs rounded-lg hover:bg-surface-container-high hover:text-on-surface transition-colors">
                        <div class="w-8 h-8 rounded-full bg-secondary flex items-center justify-center">
                            <span class="material-symbols-outlined text-on-secondary text-[18px]">badge</span>
                        </div>
                        <div class="hidden xl:flex flex-col text-left">
                            <span class="font-label-md text-label-md text-on-surface">Area: Kec. Utan</span>
                            <span class="font-label-sm text-label-sm text-text-secondary">Aktif Bertugas</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="relative w-full pt-20 px-4 pb-4 md:pt-28 md:px-space-xl md:pb-space-xl bg-surface flex-grow max-w-[100vw]">
            @yield('content')
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const toggleBtn = document.getElementById('mobile-menu-btn');
            const closeBtn = document.getElementById('close-sidebar-btn');

            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
                document.body.classList.toggle('overflow-hidden');
            }

            if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
            if (overlay) overlay.addEventListener('click', toggleSidebar);
            if (closeBtn) closeBtn.addEventListener('click', toggleSidebar);
        });
    </script>
    @include('components.searchable-select-script')
</body>
</html>
