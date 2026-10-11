<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="web_blank" name="shell-type"/>
    <title>Gema Smart Sumbawa - Portal Masuk Terpadu</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        @layer base { 
            html, body { margin: 0; padding: 0; } 
            body { overscroll-behavior: none; } 
            main > :first-child { margin-top: 0 !important; } 
            main > :last-child { margin-bottom: 0 !important; } 
        } 
        ::-webkit-scrollbar { display: none; }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = { 
            darkMode: "class", 
            theme: { 
                extend: { 
                    "colors": { "tertiary": "#003b71", "surface-variant": "#e3e2e2", "inverse-on-surface": "#f2f0f0", "inverse-surface": "#303031", "on-surface-variant": "#41493e", "outline-variant": "#c0c9bb", "surface-subtle": "#F8FAFC", "surface": "#fbf9f9", "surface-dim": "#dbdad9", "text-primary": "#212121", "on-surface": "#1b1c1c", "on-error": "#ffffff", "on-tertiary": "#ffffff", "text-secondary": "#757575", "secondary-fixed-dim": "#ffb957", "surface-muted": "#F5F5F5", "on-error-container": "#93000a", "on-primary-fixed-variant": "#0c5216", "secondary": "#835400", "tertiary-fixed": "#d4e3ff", "canvas-bg": "#FFFFFF", "surface-container-highest": "#e3e2e2", "surface-container-lowest": "#ffffff", "on-secondary-fixed-variant": "#643f00", "on-secondary": "#ffffff", "text-tertiary": "#9E9E9E", "border-light": "#E5E7EB", "on-primary": "#ffffff", "gold-accent": "#F9A825", "on-secondary-container": "#694300", "on-background": "#1b1c1c", "primary-fixed-dim": "#91d78a", "status-info": "#1976D2", "error": "#ba1a1a", "surface-container-high": "#e9e8e7", "on-tertiary-fixed": "#001c3a", "on-primary-fixed": "#002203", "status-warning": "#FF9800", "surface-bright": "#fbf9f9", "inverse-primary": "#91d78a", "gold-surface": "#FFFDE7", "on-secondary-fixed": "#2a1800", "status-verified": "#43A047", "surface-container": "#efeded", "border-medium": "#E0E0E0", "primary-container": "#1b5e20", "surface-tint": "#2a6b2c", "secondary-fixed": "#ffddb5", "primary-fixed": "#acf4a4", "status-verified-surface": "#E8F5E9", "surface-container-low": "#f5f3f3", "on-tertiary-fixed-variant": "#004786", "primary": "#00450d", "background": "#fbf9f9", "status-info-surface": "#E3F2FD", "gov-green-surface": "#E8F5E9", "tertiary-container": "#005299", "status-warning-surface": "#FFF3E0", "on-tertiary-container": "#a3c7ff", "status-fraud-surface": "#FFEBEE", "tertiary-fixed-dim": "#a5c8ff", "outline": "#717a6d", "on-primary-container": "#90d689", "secondary-container": "#fcab28", "gov-green-dark": "#0E3A13", "error-container": "#ffdad6", "status-fraud": "#D32F2F" }, 
                    "borderRadius": { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" }, 
                    "fontFamily": { "headline-xl-mobile": ["Inter"], "headline-sm": ["Inter"], "label-lg": ["Inter"], "body-lg": ["Inter"], "headline-md": ["Inter"], "body-sm": ["Inter"], "headline-xl": ["Inter"], "headline-lg": ["Inter"], "code-dense": ["Inter"], "label-md": ["Inter"], "label-sm": ["Inter"], "body-md": ["Inter"] }, 
                    "fontSize": { "headline-xl-mobile": ["1.5rem", { "lineHeight": "2rem", "letterSpacing": "-0.02em", "fontWeight": "700" }], "headline-sm": ["1.125rem", { "lineHeight": "1.5rem", "letterSpacing": "-0.01em", "fontWeight": "600" }], "label-lg": ["0.875rem", { "lineHeight": "1.25rem", "letterSpacing": "0.01em", "fontWeight": "600" }], "body-lg": ["1rem", { "lineHeight": "1.5rem", "letterSpacing": "0em", "fontWeight": "400" }], "headline-md": ["1.25rem", { "lineHeight": "1.75rem", "letterSpacing": "-0.015em", "fontWeight": "600" }], "body-sm": ["0.75rem", { "lineHeight": "1.125rem", "letterSpacing": "0.005em", "fontWeight": "400" }], "headline-xl": ["2rem", { "lineHeight": "2.5rem", "letterSpacing": "-0.025em", "fontWeight": "700" }], "headline-lg": ["1.5rem", { "lineHeight": "2rem", "letterSpacing": "-0.02em", "fontWeight": "600" }], "code-dense": ["0.8125rem", { "lineHeight": "1.125rem", "letterSpacing": "0.03em", "fontWeight": "500" }], "label-md": ["0.75rem", { "lineHeight": "1rem", "letterSpacing": "0.02em", "fontWeight": "600" }], "label-sm": ["0.6875rem", { "lineHeight": "0.875rem", "letterSpacing": "0.04em", "fontWeight": "700" }], "body-md": ["0.875rem", { "lineHeight": "1.375rem", "letterSpacing": "0em", "fontWeight": "400" }] } 
                } 
            } 
        };
    </script>
</head>
<body class="bg-surface font-body-md text-body-md text-on-surface antialiased selection:bg-primary-fixed selection:text-on-primary-fixed">
@include('components.preloader')
<main class="min-h-screen w-full bg-surface">
    <div class="flex flex-col w-full">
        <div class="w-full min-h-[calc(100vh-0px)] flex flex-col lg:flex-row bg-canvas-bg">
            <!-- LEFT PANEL: LOGIN FORM -->
            <div class="w-full lg:w-[48%] xl:w-[45%] flex flex-col justify-between px-6 sm:px-12 md:px-16 lg:px-14 xl:px-20 py-8 lg:py-12 bg-canvas-bg z-10">
                <!-- Top Section: Header & Identitas Pemda -->
                <div>
                    <!-- Emblem & Brand Bar -->
                    <div class="flex items-center gap-3.5 mb-8">
                        <div class="w-24 h-16 rounded-lg bg-surface-subtle p-2 flex items-center justify-center shadow-sm overflow-hidden flex-shrink-0">
                            <img alt="Gema Smart Sumbawa Emblem" class="w-full h-full object-contain" src="{{ asset('images/gemas.jpg') }}"/>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-1.5">
                                <span class="font-label-sm text-label-sm uppercase tracking-wider text-text-secondary">Pemerintah Kab. Sumbawa</span>
                                <span class="w-1.5 h-1.5 rounded-full bg-status-verified"></span>
                            </div>
                            <span class="font-label-lg text-label-lg text-primary font-bold">Badan Perencanaan Pembangunan Daerah Kabupaten Sumbawa</span>
                        </div>
                    </div>
                    <!-- Portal Heading -->
                    <div class="mb-8">
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-gov-green-surface text-primary text-label-sm font-label-sm mb-3">
                            <span class="material-symbols-outlined text-[14px]">shield</span>
                            <span>Portal Masuk Layanan Terpadu</span>
                        </div>
                        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight mb-2">
                            Gema Smart Sumbawa
                        </h1>
                        <p class="font-headline-sm text-headline-sm text-primary font-semibold mb-2">
                            Sistem Monitoring Penyaluran &amp; Pendampingan Bantuan Bibit
                        </p>
                        <p class="font-body-md text-body-md text-text-secondary">
                            Silakan masukkan email kedinasan/institusi dan kata sandi Anda untuk masuk ke sistem monitoring.
                        </p>
                    </div>
                    <!-- Notification Banner / Alert -->
                    <div class="mb-6 p-3.5 bg-surface-subtle rounded-md flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary text-[20px] mt-0.5 flex-shrink-0">info</span>
                        <p class="font-body-sm text-body-sm text-text-secondary leading-relaxed">
                            Akses khusus Aparatur Sipil Negara, Penyuluh Pertanian Lapangan (PPL), serta Petugas Verifikasi terdaftar di wilayah Sumbawa.
                        </p>
                    </div>

                    <!-- Form Elements -->
                    <form class="space-y-4" id="loginForm" method="POST" action="{{ route('login') }}" onsubmit="handleLoginSubmission()">
                        @csrf
                        
                        <!-- Email / No KK Field -->
                        <div class="space-y-1.5">
                            <label class="block font-label-lg text-label-lg text-text-primary" for="login">Email Kedinasan atau Nomor KK (Warga)</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-3 text-text-tertiary material-symbols-outlined text-[20px] pointer-events-none">account_circle</span>
                                <input class="w-full h-11 pl-10 pr-3.5 bg-canvas-bg rounded text-body-md font-body-md text-text-primary placeholder:text-text-tertiary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all shadow-sm @error('login') ring-2 ring-error/50 @enderror" id="login" name="login" value="{{ old('login') }}" placeholder="Email ASN / Nomor KK Penerima" required="" type="text"/>
                            </div>
                            @error('login')
                                <p class="text-error font-body-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label class="block font-label-lg text-label-lg text-text-primary" for="password">Kata Sandi</label>
                                <span class="font-label-sm text-label-sm text-text-tertiary">Enkripsi 256-bit</span>
                            </div>
                            <div class="relative flex items-center">
                                <span class="absolute left-3 text-text-tertiary material-symbols-outlined text-[20px] pointer-events-none">lock</span>
                                <input class="w-full h-11 pl-10 pr-11 bg-canvas-bg rounded text-body-md font-body-md text-text-primary placeholder:text-text-tertiary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all shadow-sm" id="password" name="password" placeholder="Masukkan kata sandi" required="" type="password"/>
                                <button aria-label="Tampilkan atau sembunyikan kata sandi" class="absolute right-3 p-1 text-text-secondary hover:text-text-primary transition-colors focus:outline-none" id="togglePasswordBtn" onclick="togglePasswordVisibility()" type="button">
                                    <span class="material-symbols-outlined text-[20px]" id="eyeIcon">visibility</span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Captcha Field -->
                        <div class="space-y-1.5 pt-1">
                            <label class="block font-label-lg text-label-lg text-text-primary" for="captcha">Keamanan Anti-Spam <span class="text-error">*</span></label>
                            <div class="flex items-center gap-3">
                                <div class="h-11 px-4 bg-surface-variant/50 rounded flex items-center justify-center border border-border-light font-headline-sm text-text-primary tracking-widest whitespace-nowrap select-none">
                                    {{ $num1 ?? rand(1,9) }} + {{ $num2 ?? rand(1,9) }} =
                                </div>
                                <div class="relative flex-1">
                                    <input class="w-full h-11 pl-3 pr-3 bg-canvas-bg rounded text-body-md font-body-md text-text-primary placeholder:text-text-tertiary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all shadow-sm @error('captcha') ring-2 ring-error/50 @enderror" id="captcha" name="captcha" placeholder="Jawaban" required="" type="number"/>
                                </div>
                            </div>
                            @error('captcha')
                                <p class="text-error font-body-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="flex items-center justify-between pt-1">
                            <label class="flex items-center gap-2.5 cursor-pointer select-none">
                                <input class="w-4 h-4 rounded text-primary focus:ring-primary focus:ring-offset-0 transition" id="rememberMe" name="rememberMe" type="checkbox"/>
                                <span class="font-body-md text-body-md text-text-secondary">Ingat sesi masuk saya</span>
                            </label>
                            <span class="inline-flex items-center gap-1 font-label-sm text-label-sm text-status-verified">
                                <span class="material-symbols-outlined text-[15px]">verified_user</span>
                                <span>Koneksi Aman</span>
                            </span>
                        </div>

                        <!-- Primary Submit Button -->
                        <div class="pt-2">
                            <button class="w-full h-11 bg-primary hover:bg-[#144A18] active:bg-[#0c5216] text-on-primary font-label-lg text-label-lg rounded-md transition duration-150 flex items-center justify-center gap-2 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2" id="submitBtn" type="submit">
                                <span id="btnText">Masuk ke Sistem</span>
                                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                            </button>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="text-center pt-2 pb-2">
                            <a class="font-body-md text-body-md text-primary font-semibold hover:text-gov-green-dark hover:underline focus:outline-none inline-flex items-center gap-1" href="#lupa-password" onclick="showPasswordHelp(event)">
                                <span class="material-symbols-outlined text-[16px]">help</span>
                                <span>Lupa Password atau Mengalami Kendala Akses?</span>
                            </a>
                        </div>
                    </form>
                    
                    <!-- Notification Toast (Hidden by default) -->
                    <div class="hidden mt-4 p-3 bg-gold-surface text-secondary rounded-md shadow-sm flex items-center gap-2.5" id="toastMessage">
                        <span class="material-symbols-outlined text-[20px] text-gold-accent">contact_support</span>
                        <p class="font-body-sm text-body-sm">
                            Hubungi Admin Pusdatin Distan Sumbawa di <strong>pusdatin@sumbawakab.go.id</strong> atau Ext. 104 untuk reset token.
                        </p>
                    </div>
                </div>

                <!-- Left Panel Footer -->
                <div class="pt-8 mt-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-text-secondary">
                        <p class="font-body-sm text-body-sm">
                            Ãƒâ€šÃ‚Â© 2026 Badan Perencanaan Pembangunan Daerah Kabupaten Sumbawa
                        </p>
                        <div class="flex items-center gap-1.5 font-label-sm text-label-sm text-text-tertiary">
                            <span class="material-symbols-outlined text-[14px]">lock</span>
                            <span>Dilindungi Enkripsi AES-256 &amp; UU PDP No. 27/2022</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT PANEL: IMMERSIVE AGRICULTURAL VISUAL & BENEFIT CARDS -->
            <div class="hidden lg:flex lg:w-[52%] xl:w-[55%] relative overflow-hidden flex-col justify-between p-12 xl:p-16 text-on-primary">
                <!-- Background Photo with Deep Forest Green Overlay -->
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 scale-105" data-alt="Lush panoramic agricultural nursery in Kabupaten Sumbawa" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA-dGrTfKBN_n5tyCYZDU8axYBL6WlDJadTKe9RpWUP0UdORXs6xGD5Qca4YhqTpRfZb4ULUKBvY4tlVhJdbDS_4gahy2Hs8gHnFpYWQ_a0CB4AhHcF-PWs5R0uO90DTUinTkBv7O2ft06WU_n5UyvjpNw9OuslhJK21lqnWjuKb4UM9Z0NGbLFQWYGpqouwhhdxrdrUo5b6ayHhXNZEdePqDvwpCZ-F0df7E2UgKNTBqL57N7lPf2nyQ')"></div>
                <!-- Rich Forest Green Ambient Gradient Overlay (#1B5E20 at ~80% depth) -->
                <div class="absolute inset-0 bg-gradient-to-tr from-[#092B0D]/95 via-[#1B5E20]/85 to-[#0E3A13]/80"></div>
                <!-- Subtle Decorative SVG Watermark Graphic -->
                <svg class="absolute -right-20 -bottom-20 w-96 h-96 text-white/5 pointer-events-none" fill="currentColor" viewBox="0 0 200 200">
                    <path d="M42,-72C54.9,-66.1,65.6,-54.6,73.1,-41.2C80.6,-27.8,85,-12.5,83.9,2.4C82.8,17.2,76.2,31.7,67.2,43.8C58.3,55.9,46.9,65.7,33.9,71.2C20.8,76.7,6.1,77.9,-8.7,76.1C-23.5,74.3,-38.3,69.5,-50.2,60.8C-62,52,-70.8,39.3,-76.3,25.1C-81.8,10.9,-83.9,-4.8,-79.8,-18.8C-75.7,-32.8,-65.4,-45.1,-52.8,-51.2C-40.2,-57.3,-25.3,-57.2,-11.2,-61.2C2.8,-65.1,16.8,-73.1,30.3,-75.4C43.8,-77.7,56.8,-74.3,42,-72Z" transform="translate(100 100)"></path>
                </svg>
                <!-- Right Top: Government Authority Badge -->
                <div class="relative z-10 flex items-center justify-between">
                    <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md shadow-lg">
                        <div class="w-2.5 h-2.5 rounded-full bg-secondary-container animate-pulse"></div>
                        <span class="font-label-sm text-label-sm tracking-wide uppercase text-secondary-fixed">
                            Sistem Satu Data Penyaluran Bibit Sumbawa
                        </span>
                    </div>
                    <div class="flex items-center gap-2 text-white/80 font-code-dense text-code-dense">
                        <span class="material-symbols-outlined text-[16px]">cloud_done</span>
                        <span>Server Aktif: Sumbawa-Node-01</span>
                    </div>
                </div>
                <!-- Right Center: Narrative Tagline & Highlights Grid -->
                <div class="relative z-10 my-auto py-10 max-w-xl">
                    <div class="inline-block mb-3 px-3 py-1 rounded bg-secondary-container text-on-secondary-container font-label-sm text-label-sm">
                        Amanat Perbup Sumbawa No. 18/2024
                    </div>
                    <h2 class="font-headline-xl text-headline-xl text-white font-bold leading-tight mb-4 tracking-tight">
                        Mewujudkan Distribusi Bantuan Bibit Pertanian yang Transparan, Akuntabel, dan Presisi.
                    </h2>
                    <p class="font-body-lg text-body-lg text-white/90 leading-relaxed mb-8">
                        Platform terpusat pengawasan rantai pasok bibit tanaman pangan, hortikultura, dan perkebunan untuk menjamin ketepatan sasaran kelompok tani (Poktan).
                    </p>
                    <!-- 3 Feature Glass Cards -->
                    <div class="space-y-3.5">
                        <div class="flex items-start gap-4 p-4 rounded-lg bg-white/10 backdrop-blur-md hover:bg-white/15 transition-all shadow-md">
                            <div class="w-10 h-10 rounded-md bg-white/20 flex items-center justify-center flex-shrink-0 text-white">
                                <span class="material-symbols-outlined text-[22px]">fingerprint</span>
                            </div>
                            <div>
                                <h3 class="font-headline-sm text-headline-sm text-white mb-0.5">Anti-Duplikasi NIK &amp; KK Terintegrasi</h3>
                                <p class="font-body-sm text-body-sm text-white/80">Penyelarasan otomatis dengan database Dukcapil dan Simluhtan untuk mencegah penerima bantuan ganda lintas kecamatan.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 rounded-lg bg-white/10 backdrop-blur-md hover:bg-white/15 transition-all shadow-md">
                            <div class="w-10 h-10 rounded-md bg-white/20 flex items-center justify-center flex-shrink-0 text-white">
                                <span class="material-symbols-outlined text-[22px]">pin_drop</span>
                            </div>
                            <div>
                                <h3 class="font-headline-sm text-headline-sm text-white mb-0.5">Bukti Penyaluran Geotagging &amp; Tanda Tangan Digital</h3>
                                <p class="font-body-sm text-body-sm text-white/80">Validasi titik koordinat lahan penerima secara riil saat serah terima bibit fisik disertai e-signature ketua kelompok tani.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 rounded-lg bg-white/10 backdrop-blur-md hover:bg-white/15 transition-all shadow-md">
                            <div class="w-10 h-10 rounded-md bg-white/20 flex items-center justify-center flex-shrink-0 text-white">
                                <span class="material-symbols-outlined text-[22px]">fact_check</span>
                            </div>
                            <div>
                                <h3 class="font-headline-sm text-headline-sm text-white mb-0.5">Audit Sampling Uji Petik Independen</h3>
                                <p class="font-body-sm text-body-sm text-white/80">Fitur acak statistik untuk inspeksi berkala kesehatan bibit dan daya tumbuh pasca-tanam oleh Inspektorat Daerah.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Bottom: Authority Stamp & Regional Context -->
                <div class="relative z-10 pt-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-white/80">
                    <div>
                        <p class="font-label-md text-label-md text-white">Pemerintah Kabupaten Sumbawa</p>
                        <p class="font-body-sm text-body-sm text-white/70">Badan Perencanaan Pembangunan Daerah ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¢ Nusa Tenggara Barat</p>
                    </div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 backdrop-blur-sm text-white text-label-sm font-label-sm">
                        <span class="material-symbols-outlined text-[16px] text-secondary-container">eco</span>
                        <span>Gema Smart v3.4.2 Enterprise</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                eyeIcon.textContent = 'visibility';
            }
        }

        function showPasswordHelp(e) {
            e.preventDefault();
            const toast = document.getElementById('toastMessage');
            if (toast) {
                toast.classList.toggle('hidden');
            }
        }

        function handleLoginSubmission() {
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            
            // Just show loading state while the form submits to Laravel
            submitBtn.classList.add('opacity-80', 'cursor-wait');
            btnText.textContent = 'Memverifikasi Kredensial...';
        }
    </script>
</main>
</body>
</html>
