<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="web_dashboard" name="shell-type"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet"/>
    <style>
        @layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config={darkMode:"class",theme:{extend:{"colors":{"on-tertiary-fixed-variant":"#004786","border-medium":"#E0E0E0","tertiary-fixed-dim":"#a5c8ff","surface-subtle":"#F8FAFC","error":"#ba1a1a","surface-muted":"#F5F5F5","on-tertiary":"#ffffff","tertiary-fixed":"#d4e3ff","tertiary":"#003b71","primary":"#00450d","primary-container":"#1b5e20","on-primary":"#ffffff","canvas-bg":"#FFFFFF","status-info-surface":"#E3F2FD","status-verified-surface":"#E8F5E9","inverse-primary":"#91d78a","inverse-on-surface":"#f2f0f0","on-secondary-container":"#694300","status-warning":"#FF9800","surface-container-high":"#e9e8e7","status-info":"#1976D2","secondary":"#835400","gov-green-dark":"#0E3A13","secondary-fixed":"#ffddb5","tertiary-container":"#005299","gov-green-surface":"#E8F5E9","primary-fixed":"#acf4a4","on-error":"#ffffff","surface":"#fbf9f9","surface-dim":"#dbdad9","surface-tint":"#2a6b2c","inverse-surface":"#303031","surface-bright":"#fbf9f9","surface-container-lowest":"#ffffff","gold-accent":"#F9A825","surface-variant":"#e3e2e2","on-secondary":"#ffffff","primary-fixed-dim":"#91d78a","on-tertiary-container":"#a3c7ff","gold-surface":"#FFFDE7","on-background":"#1b1c1c","status-warning-surface":"#FFF3E0","secondary-container":"#fcab28","status-verified":"#43A047","text-tertiary":"#9E9E9E","on-error-container":"#93000a","on-secondary-fixed-variant":"#643f00","text-primary":"#212121","surface-container":"#efeded","text-secondary":"#757575","outline-variant":"#c0c9bb","error-container":"#ffdad6","status-fraud":"#D32F2F","on-primary-container":"#90d689","on-primary-fixed":"#002203","on-tertiary-fixed":"#001c3a","background":"#fbf9f9","on-primary-fixed-variant":"#0c5216","on-secondary-fixed":"#2a1800","border-light":"#E5E7EB","surface-container-highest":"#e3e2e2","outline":"#717a6d","secondary-fixed-dim":"#ffb957","surface-container-low":"#f5f3f3","on-surface-variant":"#41493e","status-fraud-surface":"#FFEBEE","on-surface":"#1b1c1c"},"borderRadius":{"DEFAULT":"0.125rem","lg":"0.25rem","xl":"0.5rem","full":"0.75rem"},"spacing":{"space-md":"0.75rem","space-xs":"0.25rem","space-sm":"0.5rem","gutter-lg":"2rem","margin-lg":"2.5rem","space-xl":"1.5rem","space-3xl":"3rem","space-lg":"1rem","space-2xl":"2rem","gutter":"1rem","margin-md":"1.5rem","margin":"1rem","gutter-md":"1.5rem"},"fontFamily":{"headline-xl-mobile":["Inter"],"headline-lg":["Inter"],"headline-xl":["Inter"],"body-lg":["Inter"],"label-lg":["Inter"],"headline-md":["Inter"],"label-md":["Inter"],"label-sm":["Inter"],"body-md":["Inter"],"headline-sm":["Inter"],"code-dense":["Inter"],"body-sm":["Inter"]},"fontSize":{"headline-xl-mobile":["1.5rem",{"lineHeight":"2rem","letterSpacing":"-0.02em","fontWeight":"700"}],"headline-lg":["1.5rem",{"lineHeight":"2rem","letterSpacing":"-0.02em","fontWeight":"600"}],"headline-xl":["2rem",{"lineHeight":"2.5rem","letterSpacing":"-0.025em","fontWeight":"700"}],"body-lg":["1rem",{"lineHeight":"1.5rem","letterSpacing":"0em","fontWeight":"400"}],"label-lg":["0.875rem",{"lineHeight":"1.25rem","letterSpacing":"0.01em","fontWeight":"600"}],"headline-md":["1.25rem",{"lineHeight":"1.75rem","letterSpacing":"-0.015em","fontWeight":"600"}],"label-md":["0.75rem",{"lineHeight":"1rem","letterSpacing":"0.02em","fontWeight":"600"}],"label-sm":["0.6875rem",{"lineHeight":"0.875rem","letterSpacing":"0.04em","fontWeight":"700"}],"body-md":["0.875rem",{"lineHeight":"1.375rem","letterSpacing":"0em","fontWeight":"400"}],"headline-sm":["1.125rem",{"lineHeight":"1.5rem","letterSpacing":"-0.01em","fontWeight":"600"}],"code-dense":["0.8125rem",{"lineHeight":"1.125rem","letterSpacing":"0.03em","fontWeight":"500"}],"body-sm":["0.75rem",{"lineHeight":"1.125rem","letterSpacing":"0.005em","fontWeight":"400"}]}}}};</script>
</head>
    <body class="bg-surface-muted font-body-md text-text-primary antialiased">
    @include('components.preloader')
    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-gray-900/50 z-40 hidden lg:hidden transition-opacity"></div>

    <aside id="sidebar" class="fixed left-0 top-0 h-full w-[260px] bg-primary-container text-on-primary z-50 flex flex-col justify-between shadow-[0_1px_8px_rgba(0,0,0,0.04)] transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="flex flex-col">
            <div class="px-space-lg pt-space-lg pb-space-md">
                <div class="flex items-center justify-between gap-space-sm">
                    <div class="flex items-center gap-space-sm">
                        <img alt="Logo" class="h-10 w-auto object-contain bg-white p-1 rounded" src="{{ asset('gemas.jpg') }}"/>
                        <div class="flex flex-col"><span class="font-headline-sm text-headline-sm text-on-primary font-bold tracking-tight leading-tight">Gema Smart Sumbawa</span><span class="font-label-sm text-label-sm text-primary-fixed-dim leading-none mt-space-xs truncate w-40" title="Bappeda Kabupaten Sumbawa">Bappeda Kab. Sumbawa</span></div>
                    </div>
                    <button id="close-sidebar-btn" class="lg:hidden p-1 text-primary-fixed-dim hover:text-white rounded-lg">
                        <span class="material-symbols-outlined text-[24px]">close</span>
                    </button>
                </div>
                <div class="mt-space-md p-space-sm rounded-xl bg-gov-green-dark/60 flex items-center gap-space-sm">
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center shrink-0"><span class="material-symbols-outlined text-on-primary text-[18px]">person</span></div>
                    <div class="flex flex-col min-w-0 flex-1">
                        <span class="font-label-md text-label-md text-on-primary truncate font-semibold">{{ Auth::user()->name }}</span>
                        <div class="flex items-center mt-space-xs"><span class="bg-gold-accent text-text-primary font-label-sm text-label-sm px-space-sm py-0.5 rounded-full font-bold uppercase tracking-wider">Super Admin</span></div>
                    </div>
                </div>
            </div>
            <nav class="flex flex-col gap-1 px-space-sm mt-space-xs overflow-y-auto max-h-[calc(100vh-270px)]">
                <a href="{{ route('dashboard.pemda') }}" class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg transition-colors {{ request()->routeIs('dashboard.pemda') ? 'bg-gov-green-dark text-on-primary font-semibold shadow-inner' : 'text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary' }}">
                    <span class="material-symbols-outlined text-[20px]">dashboard</span><span class="font-label-lg text-label-lg">Dashboard</span>
                </a>
                <a href="{{ route('pemda.program-bantuan.index') }}" class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg transition-colors {{ request()->routeIs('pemda.program-bantuan.*') ? 'bg-gov-green-dark text-on-primary font-semibold shadow-inner' : 'text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary' }}">
                    <span class="material-symbols-outlined text-[20px]">folder_open</span><span class="font-label-lg text-label-lg">Program Bantuan</span>
                </a>
                <a href="{{ route('pemda.kampus-mitra.index') }}" class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg transition-colors {{ request()->routeIs('pemda.kampus-mitra.*') ? 'bg-gov-green-dark text-on-primary font-semibold shadow-inner' : 'text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary' }}">
                    <span class="material-symbols-outlined text-[20px]">school</span><span class="font-label-lg text-label-lg">Kampus Mitra</span>
                </a>
                <a href="{{ route('pemda.pendamping.index') }}" class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg transition-colors {{ request()->routeIs('pemda.pendamping.*') ? 'bg-gov-green-dark text-on-primary font-semibold shadow-inner' : 'text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary' }}">
                    <span class="material-symbols-outlined text-[20px]">support_agent</span><span class="font-label-lg text-label-lg">Pendamping</span>
                </a>
                <a href="{{ route('pemda.validator.index') }}" class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg transition-colors {{ request()->routeIs('pemda.validator.*') ? 'bg-gov-green-dark text-on-primary font-semibold shadow-inner' : 'text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary' }}">
                    <span class="material-symbols-outlined text-[20px]">rule</span><span class="font-label-lg text-label-lg">Validator</span>
                </a>
                <a href="{{ route('pemda.data-penerima.index') }}" class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg transition-colors {{ request()->routeIs('pemda.data-penerima.*') ? 'bg-gov-green-dark text-on-primary font-semibold shadow-inner' : 'text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary' }}">
                    <span class="material-symbols-outlined text-[20px]">group</span><span class="font-label-lg text-label-lg">Data Penerima</span>
                </a>
                <a href="{{ route('pemda.penyaluran-bibit.index') }}" class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg transition-colors {{ request()->routeIs('pemda.penyaluran-bibit.*') ? 'bg-gov-green-dark text-on-primary font-semibold shadow-inner' : 'text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary' }}">
                    <span class="material-symbols-outlined text-[20px]">potted_plant</span><span class="font-label-lg text-label-lg">Penyaluran Bibit</span>
                </a>
                <a href="{{ route('pemda.monitoring.index') }}" class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg transition-colors {{ request()->routeIs('pemda.monitoring.*') ? 'bg-gov-green-dark text-on-primary font-semibold shadow-inner' : 'text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary' }}">
                    <span class="material-symbols-outlined text-[20px]">assignment_turned_in</span><span class="font-label-lg text-label-lg">Monitoring</span>
                </a>
                <a href="{{ route('pemda.validasi-lapangan.index') }}" class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg transition-colors {{ request()->routeIs('pemda.validasi-lapangan.*') ? 'bg-gov-green-dark text-on-primary font-semibold shadow-inner' : 'text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary' }}">
                    <span class="material-symbols-outlined text-[20px]">verified_user</span><span class="font-label-lg text-label-lg">Validasi Lapangan</span>
                </a>
                <a href="{{ route('pemda.laporan.index') }}" class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg transition-colors {{ request()->routeIs('pemda.laporan.*') ? 'bg-gov-green-dark text-on-primary font-semibold shadow-inner' : 'text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary' }}">
                    <span class="material-symbols-outlined text-[20px]">description</span><span class="font-label-lg text-label-lg">Laporan</span>
                </a>
                <div class="flex flex-col gap-1">
                    <div class="flex items-center justify-between px-space-md py-space-sm rounded-lg text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary transition-colors cursor-pointer">
                        <div class="flex items-center gap-space-sm"><span class="material-symbols-outlined text-[20px]">database</span><span class="font-label-lg text-label-lg">Master Data</span></div>
                        <span class="material-symbols-outlined text-[16px]">expand_more</span>
                    </div>
                    <div class="pl-8 flex flex-col gap-1">
                        <a href="{{ route('pemda.master-data.wilayah.index') }}" class="px-space-md py-space-xs rounded-lg transition-colors {{ request()->routeIs('pemda.master-data.wilayah.*') ? 'bg-gov-green-dark/50 text-on-primary' : 'text-primary-fixed-dim hover:bg-gov-green-dark/50 hover:text-on-primary' }} font-label-md text-label-md">Wilayah</a>
                        <a href="{{ route('pemda.master-data.jenis-bibit.index') }}" class="px-space-md py-space-xs rounded-lg transition-colors {{ request()->routeIs('pemda.master-data.jenis-bibit.*') ? 'bg-gov-green-dark/50 text-on-primary' : 'text-primary-fixed-dim hover:bg-gov-green-dark/50 hover:text-on-primary' }} font-label-md text-label-md">Jenis Bibit</a>
                    </div>
                </div>
                <a href="{{ route('pemda.audit-log.index') }}" class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg transition-colors {{ request()->routeIs('pemda.audit-log.*') ? 'bg-gov-green-dark text-on-primary font-semibold shadow-inner' : 'text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary' }}">
                    <span class="material-symbols-outlined text-[20px]">receipt_long</span><span class="font-label-lg text-label-lg">Audit Log</span>
                </a>
                <a href="{{ route('profile.index') }}" class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg transition-colors {{ request()->routeIs('profile.*') ? 'bg-gov-green-dark text-on-primary font-semibold shadow-inner' : 'text-primary-fixed-dim hover:bg-gov-green-dark/70 hover:text-on-primary' }}">
                    <span class="material-symbols-outlined text-[20px]">settings</span><span class="font-label-lg text-label-lg">Pengaturan Akun</span>
                </a>
            </nav>
        </div>
        <div class="p-space-md bg-gov-green-dark/40 flex flex-col gap-space-sm">
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="w-full flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-error-container hover:bg-error/20 hover:text-on-primary transition-colors">
                    <span class="material-symbols-outlined text-[20px]">logout</span>
                    <span class="font-label-lg text-label-lg font-semibold">Keluar</span>
                </button>
            </form>
            <div class="flex items-center justify-between px-space-xs pt-space-xs border-t border-white/10">
                <span class="font-label-sm text-label-sm text-primary-fixed-dim">Gema Smart Enterprise</span>
                <span class="font-label-sm text-label-sm text-gold-accent font-semibold">v2.0</span>
            </div>
        </div>
    </aside>

    <div class="lg:pl-[260px] flex flex-col min-h-screen transition-all duration-300 ease-in-out">
        <header class="fixed top-0 left-0 lg:left-[260px] right-0 h-16 bg-canvas-bg/95 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-30 flex items-center justify-between px-4 lg:px-6 transition-all duration-300 ease-in-out">
            <div class="flex items-center gap-space-md">
                <button id="mobile-menu-btn" class="lg:hidden p-2 -ml-2 text-text-secondary hover:bg-surface-subtle rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-[24px]">menu</span>
                </button>
                <img alt="Logo" class="h-8 w-auto object-contain bg-white p-1 rounded hidden sm:block lg:hidden" src="{{ asset('gemas.jpg') }}"/>
                <div class="hidden sm:flex items-center gap-space-xs text-text-secondary font-label-md text-label-md"><span class="material-symbols-outlined text-[18px]">home</span><span>Beranda</span><span class="material-symbols-outlined text-[14px]">chevron_right</span><span class="text-text-primary font-semibold">Dashboard Eksekutif</span></div>
                <span class="hidden md:inline-block bg-gold-surface text-secondary font-label-sm text-label-sm px-space-sm py-0.5 rounded-full font-bold border border-gold-accent/40">TA 2026</span>
            </div>
            <div class="flex items-center gap-space-md">
                <div class="hidden md:flex items-center gap-space-xs bg-status-verified-surface text-primary px-space-md py-1 rounded-full font-label-sm text-label-sm font-semibold"><span class="w-2 h-2 rounded-full bg-status-verified animate-pulse"></span><span>Server Aktif: Sumbawa-Node-01</span></div>
                <button aria-label="Notifikasi" class="relative p-space-sm rounded-lg text-text-secondary hover:bg-surface-subtle hover:text-text-primary transition-colors"><span class="material-symbols-outlined text-[22px]">notifications</span><span class="absolute top-1.5 right-1.5 w-4 h-4 rounded-full bg-error text-on-error font-label-sm text-label-sm flex items-center justify-center font-bold text-[10px]">3</span></button>
                <div class="h-6 w-px bg-border-medium hidden sm:block"></div>
                <div class="flex items-center gap-space-sm cursor-pointer">
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center"><span class="material-symbols-outlined text-on-primary text-[18px]">person</span></div>
                    <span class="material-symbols-outlined text-text-secondary text-[20px]">keyboard_arrow_down</span>
                </div>
            </div>
        </header>

        <main class="relative px-4 pb-4 pt-20 md:px-6 md:pb-6 md:pt-24 bg-surface-muted flex-grow w-full max-w-[100vw]">
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
</body>
</html>
