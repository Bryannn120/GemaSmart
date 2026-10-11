<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard Penerima Bantuan - SiBibit</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#00450d',
                        'primary-container': '#1b5e20',
                        'gov-green-dark': '#0E3A13',
                        'gov-green-surface': '#E8F5E9',
                        'gold-accent': '#F9A825',
                        'gold-surface': '#FFFDE7',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex flex-col">
    <!-- Navbar -->
    <header class="bg-primary-container text-white shadow-md sticky top-0 z-30">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ asset('gemas.jpg') }}" alt="Logo" class="h-9 w-auto bg-white p-1 rounded-md shadow-sm"/>
                <div>
                    <h1 class="font-bold text-base sm:text-lg leading-tight">SiBibit Sumbawa</h1>
                    <p class="text-xs text-green-200">Portal Warga Penerima Bantuan</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <span class="block text-sm font-semibold">{{ $user->name }}</span>
                    <span class="block text-xs text-green-200">Keluarga Penerima</span>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center gap-1.5 bg-red-600/80 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors">
                        <span class="material-symbols-outlined text-[16px]">logout</span>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-6 sm:py-8 flex-1 w-full">
        @if (session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 flex items-center gap-3 shadow-sm">
                <span class="material-symbols-outlined text-green-600 text-[24px]">check_circle</span>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-gov-green-dark to-primary-container rounded-2xl p-6 sm:p-8 text-white shadow-lg mb-8 relative overflow-hidden">
            <div class="relative z-10 max-w-2xl">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-gold-accent text-gray-900 mb-3">Akun Terverifikasi</span>
                <h2 class="text-2xl sm:text-3xl font-bold tracking-tight">Selamat Datang, {{ $keluarga->kepala_keluarga ?? $user->name }}!</h2>
                <p class="text-green-100 text-sm sm:text-base mt-2">
                    Berikut adalah data kepesertaan Anda dalam program bantuan bibit tanaman produktif Kabupaten Sumbawa.
                </p>
            </div>
            <div class="absolute -right-10 -bottom-10 opacity-10 pointer-events-none">
                <span class="material-symbols-outlined text-[200px]">potted_plant</span>
            </div>
        </div>

        @if ($keluarga)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
            <!-- Left Column: Data KK & Program -->
            <div class="lg:col-span-2 flex flex-col gap-6">
                <!-- Identitas Penerima Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-700">badge</span>
                            Data Identitas Keluarga
                        </h3>
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $keluarga->status_validasi == 'valid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            Status: {{ ucfirst($keluarga->status_validasi) }}
                        </span>
                    </div>

                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-5 text-sm">
                        <div>
                            <dt class="text-gray-500 font-medium">Nomor Kartu Keluarga (KK)</dt>
                            <dd class="text-gray-900 font-semibold font-mono text-base mt-0.5">{{ $keluarga->no_kk }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500 font-medium">Nomor Induk Kependudukan (NIK)</dt>
                            <dd class="text-gray-900 font-semibold font-mono text-base mt-0.5">{{ $keluarga->nik }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500 font-medium">Desil Kemiskinan</dt>
                            <dd class="text-gray-900 font-semibold mt-0.5">
                                <span class="inline-block px-2.5 py-0.5 rounded bg-blue-50 text-blue-700 font-bold">Desil {{ $keluarga->desil }}</span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-gray-500 font-medium">Desa / Wilayah</dt>
                            <dd class="text-gray-900 font-semibold mt-0.5">{{ $keluarga->wilayah->nama ?? '-' }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-gray-500 font-medium">Alamat Tempat Tinggal</dt>
                            <dd class="text-gray-900 mt-0.5">{{ $keluarga->alamat ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Program Bantuan Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2 pb-4 border-b border-gray-100">
                        <span class="material-symbols-outlined text-green-700">potted_plant</span>
                        Program Bantuan yang Diikuti
                    </h3>

                    @if ($keluarga->programBantuan)
                    <div class="mt-5">
                        <div class="bg-green-50/60 border border-green-100 rounded-xl p-4">
                            <span class="text-xs font-bold uppercase tracking-wider text-green-700">Tahun Anggaran {{ $keluarga->programBantuan->tahun_anggaran }}</span>
                            <h4 class="text-base font-bold text-gray-900 mt-1">{{ $keluarga->programBantuan->nama_program }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ $keluarga->programBantuan->deskripsi }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mt-4 text-sm">
                            <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <span class="text-gray-500 text-xs block">Status Kemandirian</span>
                                <span class="text-gray-900 font-bold text-sm block mt-1">{{ $keluarga->status_kemandirian ?? 'Belum Dinilai' }}</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <span class="text-gray-500 text-xs block">Catatan Pendamping</span>
                                <span class="text-gray-900 font-bold text-sm block mt-1">{{ $keluarga->is_flagged ? 'Perlu Perhatian Khusus' : 'Baik' }}</span>
                            </div>
                        </div>
                    </div>
                    @else
                    <p class="text-sm text-gray-500 mt-4">Belum terdaftar dalam program aktif saat ini.</p>
                    @endif
                </div>
            </div>

            <!-- Right Column: Feedback & Laporan -->
            <div class="flex flex-col gap-6">
                <!-- Form Kirim Laporan -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2 mb-3">
                        <span class="material-symbols-outlined text-green-700">rate_review</span>
                        Kirim Laporan / Kendala
                    </h3>
                    <p class="text-xs text-gray-500 mb-4">Sampaikan kendala, kebutuhan bibit/pupuk, atau perkembangan langsung ke Pemda & Pendamping.</p>

                    <form action="{{ route('penerima.laporan.store') }}" method="POST" class="flex flex-col gap-3">
                        @csrf
                        <div>
                            <textarea name="laporan_teks" rows="4" required class="w-full text-sm rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent" placeholder="Tuliskan laporan atau kendala Anda di sini..."></textarea>
                        </div>
                        <button type="submit" class="w-full bg-primary hover:bg-primary-container text-white py-2.5 px-4 rounded-lg font-semibold text-sm transition-colors flex items-center justify-center gap-2 shadow-sm">
                            <span class="material-symbols-outlined text-[18px]">send</span>
                            <span>Kirim Laporan</span>
                        </button>
                    </form>
                </div>

                <!-- Riwayat Laporan -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-base font-bold text-gray-900 flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-gray-600">history</span>
                        Riwayat Laporan Saya
                    </h3>

                    <div class="flex flex-col gap-3 max-h-[300px] overflow-y-auto">
                        @forelse ($keluarga->laporanPenerimas->sortByDesc('created_at') as $lap)
                        <div class="p-3 rounded-lg bg-gray-50 border border-gray-100 text-xs">
                            <div class="flex justify-between items-center text-gray-400 mb-1">
                                <span>{{ $lap->created_at->format('d M Y, H:i') }}</span>
                                @if ($lap->is_read_by_pemda)
                                    <span class="text-green-600 font-bold">Dibaca Pemda</span>
                                @else
                                    <span class="text-yellow-600 font-bold">Menunggu Respon</span>
                                @endif
                            </div>
                            <p class="text-gray-800">{{ $lap->laporan_teks }}</p>
                        </div>
                        @empty
                        <p class="text-xs text-gray-500 text-center py-4">Belum pernah mengirimkan laporan.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="bg-white rounded-xl p-8 text-center text-gray-500">
            <span class="material-symbols-outlined text-[48px] text-gray-300 mb-2">person_off</span>
            <p>Data keluarga penerima tidak ditemukan untuk akun ini.</p>
        </div>
        @endif
    </main>

    <footer class="bg-white border-t border-gray-200 py-4 text-center text-xs text-gray-500">
        &copy; 2026 Pemerintah Kabupaten Sumbawa. Sistem Informasi SiBibit.
    </footer>
</body>
</html>
