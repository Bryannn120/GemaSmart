<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gema Smart Sumbawa</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS (CDN for rapid prototyping as requested) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#10b981',
                        secondary: '#047857',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased selection:bg-primary selection:text-white flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <img src="{{ asset('images/gemas.jpg') }}" alt="Gema Smart Logo" class="h-10 w-auto object-contain">
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg transition-colors shadow-sm">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg transition-colors shadow-sm">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 px-4 py-2 transition-colors">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
            <div class="text-center lg:text-left lg:w-1/2">
                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                    <span class="block">Sistem Monitoring</span>
                    <span class="block text-green-600">Penyaluran Bibit</span>
                </h1>
                <div class="mt-5 bg-green-50 p-4 rounded-xl border border-green-100">
                    <h3 class="text-lg font-bold text-green-800 mb-2">Tujuan Sistem:</h3>
                    <p class="text-base text-gray-600">
                        Memastikan penyaluran bantuan bibit pertanian di Kabupaten Sumbawa berjalan <strong>transparan, terukur, dan tepat sasaran</strong>. Platform ini mengintegrasikan seluruh tahapan mulai dari perencanaan, distribusi fisik, hingga validasi dan pemantauan keberhasilan tanaman.
                    </p>
                </div>
                <div class="mt-8 flex justify-center lg:justify-start">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 md:py-4 md:text-lg md:px-10 shadow-sm transition-all hover:shadow-md">
                        Masuk Portal <svg class="ml-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
            <div class="lg:w-1/2 mt-10 lg:mt-0 w-full">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-gray-100 group">
                    <!-- Placeholder untuk gambar (menggunakan gambar yang baru di-generate) -->
                    <img src="{{ asset('images/hero.jpg') }}" alt="Ilustrasi Distribusi Bibit Pertanian" class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-green-900/30 to-transparent mix-blend-multiply"></div>
                </div>
            </div>
        </div>

        <!-- Role Cards Section -->
        <div class="mt-16 sm:mt-24">
            <h2 class="text-center text-2xl font-bold text-gray-900 mb-10">Portal Akses Berdasarkan Peran</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                
                <!-- Card: Pemda -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow group relative overflow-hidden flex flex-col h-full">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-50 rounded-full z-0 group-hover:scale-110 transition-transform duration-300"></div>
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-4 shrink-0">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Pemda</h3>
                        <p class="mt-2 text-sm text-gray-500 flex-grow">Super Admin. Kelola program, anggaran, kampus mitra, dan audit secara menyeluruh.</p>
                        <a href="#" class="mt-6 inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700">
                            Masuk Portal <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Card: Kampus Mitra -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow group relative overflow-hidden flex flex-col h-full">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-purple-50 rounded-full z-0 group-hover:scale-110 transition-transform duration-300"></div>
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center mb-4 shrink-0">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Kampus Mitra</h3>
                        <p class="mt-2 text-sm text-gray-500 flex-grow">Kelola pendamping, wilayah distribusi, SPJ, procurement, dan monitoring.</p>
                        <a href="#" class="mt-6 inline-flex items-center text-sm font-semibold text-purple-600 hover:text-purple-700">
                            Masuk Portal <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Card: Pendamping -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow group relative overflow-hidden flex flex-col h-full">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-green-50 rounded-full z-0 group-hover:scale-110 transition-transform duration-300"></div>
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-4 shrink-0">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Pendamping</h3>
                        <p class="mt-2 text-sm text-gray-500 flex-grow">Aplikasi lapangan. Kelola penerima, distribusi bibit, foto, GPS, dan monitoring tanaman.</p>
                        <a href="#" class="mt-6 inline-flex items-center text-sm font-semibold text-green-600 hover:text-green-700">
                            Masuk Portal <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Card: Validator -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow group relative overflow-hidden flex flex-col h-full">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-orange-50 rounded-full z-0 group-hover:scale-110 transition-transform duration-300"></div>
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center mb-4 shrink-0">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Validator</h3>
                        <p class="mt-2 text-sm text-gray-500 flex-grow">Verifikasi lapangan, validasi laporan, filter wilayah, dan tandai fraud atau revisi.</p>
                        <a href="#" class="mt-6 inline-flex items-center text-sm font-semibold text-orange-600 hover:text-orange-700">
                            Masuk Portal <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 mt-auto py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center text-center md:text-left">
            <p class="text-sm text-gray-500 mb-4 md:mb-0">&copy; {{ date('Y') }} Pemerintah Kabupaten Sumbawa. Hak Cipta Dilindungi.</p>
            <div class="flex space-x-4">
                <a href="#" class="text-sm text-gray-400 hover:text-gray-900 transition-colors">Bantuan</a>
                <a href="#" class="text-sm text-gray-400 hover:text-gray-900 transition-colors">Syarat & Ketentuan</a>
            </div>
        </div>
    </footer>
</body>
</html>
