<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 Server Error - Gema Smart Sumbawa</title>
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
            <span class="material-symbols-outlined text-[120px] text-red-100">dns</span>
            <span class="material-symbols-outlined text-[60px] text-red-600 absolute bottom-0 right-0 transform translate-x-1/4 translate-y-1/4">warning</span>
        </div>
        
        <h1 class="text-6xl font-bold text-red-600 mb-2">500</h1>
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Gangguan Sistem Internal</h2>
        <p class="text-gray-500 mb-8 leading-relaxed">
            Sistem kami sedang mengalami kendala internal dalam memproses permintaan Anda. Tim teknis Pusdatin telah diinformasikan secara otomatis.
        </p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <button onclick="window.location.reload()" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-primary hover:bg-green-900 text-white px-6 py-3 rounded-full font-medium transition-colors shadow-lg shadow-green-900/20">
                <span class="material-symbols-outlined">refresh</span>
                Coba Ulangi
            </button>
            <a href="{{ url('/') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-full font-medium transition-colors">
                <span class="material-symbols-outlined">home</span>
                Beranda
            </a>
        </div>
        
        <div class="mt-12 text-sm text-gray-400">
            Sistem Informasi Penyaluran Bibit &bull; Pemkab Sumbawa
        </div>
    </div>
</body>
</html>
