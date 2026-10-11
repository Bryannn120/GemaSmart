<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 Not Found - Gema Smart Sumbawa</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = { theme: { extend: { colors: { primary: "#00450d", surface: "#fbf9f9" }, fontFamily: { sans: ["Inter"] } } } };
    </script>
</head>
<body class="bg-surface font-sans antialiased text-gray-800 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-lg w-full text-center">
        <div class="mb-8 relative inline-block">
            <span class="material-symbols-outlined text-[120px] text-primary opacity-20">travel_explore</span>
            <span class="material-symbols-outlined text-[60px] text-green-600 absolute bottom-0 right-0 transform translate-x-1/4 translate-y-1/4">error</span>
        </div>
        
        <h1 class="text-6xl font-bold text-primary mb-2">404</h1>
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Halaman Tidak Ditemukan</h2>
        <p class="text-gray-500 mb-8 leading-relaxed">
            Maaf, halaman atau dokumen yang Anda cari mungkin telah dipindahkan, diganti namanya, atau tidak pernah ada di dalam sistem Gema Smart Sumbawa.
        </p>
        
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 bg-primary hover:bg-green-900 text-white px-6 py-3 rounded-full font-medium transition-colors shadow-lg shadow-green-900/20">
            <span class="material-symbols-outlined">home</span>
            Kembali ke Beranda
        </a>
        
        <div class="mt-12 text-sm text-gray-400">
            Sistem Informasi Penyaluran Bibit &bull; Pemkab Sumbawa
        </div>
    </div>
</body>
</html>
