<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard Penerima Bantuan - SiBibit</title>
    <link rel="manifest" href="/manifest.json"/>
    <meta name="theme-color" content="#00450d"/>
    <link rel="apple-touch-icon" href="/icon-192.png"/>
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

            <div class="flex items-center gap-2 sm:gap-3">
                <span id="networkStatusBadge" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-100 border border-emerald-400/30">
                    <span id="networkDot" class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span id="networkStatusText" class="text-[11px] hidden sm:inline">Online</span>
                </span>
                <a href="#ubah-password" class="flex items-center gap-2 bg-white/10 hover:bg-white/20 py-1.5 px-2.5 rounded-lg transition-colors border border-white/10" title="Klik untuk Pengaturan Akun & Ubah Password">
                    <div class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center text-white shrink-0">
                        <span class="material-symbols-outlined text-[18px]">person</span>
                    </div>
                    <div class="text-left hidden sm:block">
                        <span class="block text-xs font-semibold text-white leading-tight truncate max-w-[120px]">{{ $user->name }}</span>
                        <span class="block text-[10px] text-green-200">Pengaturan</span>
                    </div>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center gap-1 bg-red-600/80 hover:bg-red-600 text-white px-2.5 py-1.5 rounded-lg text-xs font-semibold transition-colors">
                        <span class="material-symbols-outlined text-[15px]">logout</span>
                        <span class="hidden sm:inline">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-6 sm:py-8 flex-1 w-full">
        <!-- Offline Warning Banner (Shown when no signal) -->
        <div id="offlineNoticeBanner" class="hidden mb-6 p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 shadow-sm transition-all duration-300">
            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-amber-600 text-[26px] shrink-0 mt-0.5">cloud_off</span>
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <h4 class="font-bold text-sm text-amber-900">Mode Offline Aktif (Di Luar Jangkauan Sinyal)</h4>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-200 text-amber-800">Tersimpan di HP</span>
                    </div>
                    <p class="text-xs text-amber-800 mt-1 leading-relaxed">
                        Anda sedang berada di daerah tanpa sinyal internet. Seluruh data identitas & status bantuan Anda tetap dapat dibaca secara offline. Laporan atau kendala yang Anda ketik akan <strong>disimpan di HP</strong> dan <strong>otomatis dikirim ke Pemda</strong> begitu ponsel Anda kembali menangkap sinyal.
                    </p>
                </div>
            </div>
        </div>

        <!-- Sync Success Notice -->
        <div id="syncSuccessNotice" class="hidden mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 shadow-sm transition-all duration-300">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-emerald-600 text-[24px]">cloud_done</span>
                    <span class="text-xs sm:text-sm font-semibold text-emerald-900" id="syncSuccessMessage">Laporan offline Anda berhasil disinkronkan ke server Pemda!</span>
                </div>
                <button type="button" onclick="document.getElementById('syncSuccessNotice').classList.add('hidden')" class="text-emerald-700 hover:text-emerald-900 text-xs">✕ Tutup</button>
            </div>
        </div>
        @if (session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 flex items-center gap-3 shadow-sm">
                <span class="material-symbols-outlined text-green-600 text-[24px]">check_circle</span>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 flex items-start gap-3 shadow-sm">
                <span class="material-symbols-outlined text-red-600 text-[24px]">error</span>
                <div class="text-sm">
                    <p class="font-bold">Gagal memperbarui kata sandi:</p>
                    <ul class="list-disc pl-5 mt-1 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
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

                    <form id="formLaporanPenerima" action="{{ route('penerima.laporan.store') }}" method="POST" class="flex flex-col gap-3">
                        @csrf
                        <div>
                            <textarea id="laporanTeksInput" name="laporan_teks" rows="4" required class="w-full text-sm rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent" placeholder="Tuliskan laporan atau kendala bibit Anda di sini... (Bisa diketik saat offline)"></textarea>
                        </div>
                        <div id="formOfflineHelp" class="hidden text-[11px] text-amber-800 bg-amber-50 p-2 rounded border border-amber-200">
                            <span class="font-bold">📡 Mode Offline:</span> Laporan akan disimpan di memori HP Anda dan otomatis dikirim ke Pemda begitu ponsel mendapatkan sinyal internet.
                        </div>
                        <button type="submit" id="btnSubmitLaporan" class="w-full bg-primary hover:bg-primary-container text-white py-2.5 px-4 rounded-lg font-semibold text-sm transition-colors flex items-center justify-center gap-2 shadow-sm">
                            <span class="material-symbols-outlined text-[18px]">send</span>
                            <span id="btnSubmitLaporanText">Kirim Laporan</span>
                        </button>
                    </form>
                </div>

                <!-- Riwayat Laporan -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between pb-2 mb-3 border-b border-gray-100">
                        <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-gray-600">history</span>
                            Riwayat Laporan Saya
                        </h3>
                        <span id="offlineCountBadge" class="hidden px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-300">
                            0 Menunggu Sinyal
                        </span>
                    </div>

                    <div id="riwayatLaporanContainer" class="flex flex-col gap-3 max-h-[340px] overflow-y-auto">
                        <!-- Offline Queue Container (Prepended here) -->
                        <div id="offlineReportsList" class="flex flex-col gap-2.5"></div>

                        <!-- Server Reports -->
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
                        <p id="emptyLaporanNotice" class="text-xs text-gray-500 text-center py-4">Belum pernah mengirimkan laporan.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Form Ubah Password Penerima -->
                <div id="ubah-password" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 scroll-mt-24">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2 mb-2">
                        <span class="material-symbols-outlined text-green-700">lock_reset</span>
                        Ubah Kata Sandi (Password)
                    </h3>
                    <p class="text-xs text-gray-500 mb-4">Ganti kata sandi bawaan (No. KK) Anda dengan kata sandi baru yang aman.</p>

                    <form action="{{ route('profile.password.update') }}" method="POST" class="flex flex-col gap-3">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Password Saat Ini</label>
                            <input type="password" name="current_password" required class="w-full text-sm rounded-lg border border-gray-300 p-2.5 focus:outline-none focus:ring-2 focus:ring-green-700" placeholder="Masukkan password saat ini (No. KK)"/>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Password Baru (Min. 8 Karakter)</label>
                            <input type="password" name="password" required class="w-full text-sm rounded-lg border border-gray-300 p-2.5 focus:outline-none focus:ring-2 focus:ring-green-700" placeholder="Minimal 8 karakter"/>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Ulangi Password Baru</label>
                            <input type="password" name="password_confirmation" required class="w-full text-sm rounded-lg border border-gray-300 p-2.5 focus:outline-none focus:ring-2 focus:ring-green-700" placeholder="Ketik ulang password baru"/>
                        </div>
                        <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white py-2.5 px-4 rounded-lg font-semibold text-sm transition-colors flex items-center justify-center gap-2 shadow-sm mt-1">
                            <span class="material-symbols-outlined text-[18px]">save</span>
                            <span>Simpan Password Baru</span>
                        </button>
                    </form>
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
        &copy; 2026 Gema Smart Sumbawa. Sistem Informasi Bantuan Bibit.
    </footer>

    <!-- Offline Sync Engine Script -->
    <script>
        (function() {
            // 1. Service Worker Registration
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('/sw.js')
                        .then(reg => console.log('GemaSmart SW Registered'))
                        .catch(err => console.log('GemaSmart SW Failed', err));
                });
            }

            // 2. Network Status Elements
            const badge = document.getElementById('networkStatusBadge');
            const dot = document.getElementById('networkDot');
            const text = document.getElementById('networkStatusText');
            const offlineBanner = document.getElementById('offlineNoticeBanner');
            const offlineHelp = document.getElementById('formOfflineHelp');
            const btnSubmitText = document.getElementById('btnSubmitLaporanText');

            function updateNetworkStatus() {
                const isOnline = navigator.onLine;
                if (isOnline) {
                    if (badge) {
                        badge.className = "inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-100 border border-emerald-400/30";
                    }
                    if (dot) dot.className = "w-2 h-2 rounded-full bg-emerald-400";
                    if (text) text.textContent = "Online";
                    if (offlineBanner) offlineBanner.classList.add('hidden');
                    if (offlineHelp) offlineHelp.classList.add('hidden');
                    if (btnSubmitText) btnSubmitText.textContent = "Kirim Laporan";

                    // Trigger sync when back online
                    syncOfflineReports();
                } else {
                    if (badge) {
                        badge.className = "inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-500 text-gray-900 border border-amber-600 animate-pulse";
                    }
                    if (dot) dot.className = "w-2 h-2 rounded-full bg-black";
                    if (text) text.textContent = "Offline";
                    if (offlineBanner) offlineBanner.classList.remove('hidden');
                    if (offlineHelp) offlineHelp.classList.remove('hidden');
                    if (btnSubmitText) btnSubmitText.textContent = "Simpan di HP (Offline)";
                }
            }

            window.addEventListener('online', updateNetworkStatus);
            window.addEventListener('offline', updateNetworkStatus);
            updateNetworkStatus();

            // 3. Local Cache for Penerima Profile
            @if ($keluarga)
            const profileCache = {
                name: "{{ $user->name }}",
                no_kk: "{{ $keluarga->no_kk }}",
                nik: "{{ $keluarga->nik }}",
                desil: "{{ $keluarga->desil }}",
                status_validasi: "{{ $keluarga->status_validasi }}",
                wilayah: "{{ $keluarga->wilayah->nama ?? '-' }}",
                alamat: "{{ $keluarga->alamat ?? '-' }}",
                cached_at: new Date().toISOString()
            };
            try {
                localStorage.setItem('gemasmart_penerima_cache', JSON.stringify(profileCache));
            } catch(e) {}
            @endif

            // 4. Offline Report Queue Management
            const STORAGE_KEY = 'gemasmart_offline_penerima_laporan';

            function getOfflineReports() {
                try {
                    const raw = localStorage.getItem(STORAGE_KEY);
                    return raw ? JSON.parse(raw) : [];
                } catch(e) {
                    return [];
                }
            }

            function saveOfflineReports(reports) {
                try {
                    localStorage.setItem(STORAGE_KEY, JSON.stringify(reports));
                } catch(e) {}
                renderOfflineList();
            }

            function renderOfflineList() {
                const list = getOfflineReports();
                const container = document.getElementById('offlineReportsList');
                const badgeCount = document.getElementById('offlineCountBadge');
                const emptyNotice = document.getElementById('emptyLaporanNotice');

                if (!container) return;
                container.innerHTML = '';

                if (list.length > 0) {
                    if (emptyNotice) emptyNotice.classList.add('hidden');
                    if (badgeCount) {
                        badgeCount.textContent = list.length + ' Menunggu Sinyal';
                        badgeCount.classList.remove('hidden');
                    }

                    list.forEach(item => {
                        const div = document.createElement('div');
                        div.className = "p-3 rounded-lg bg-amber-50 border border-amber-200 text-xs shadow-xs";
                        div.id = 'offline-card-' + item.id;
                        div.innerHTML = `
                            <div class="flex justify-between items-center text-amber-800 mb-1">
                                <span class="font-medium">${new Date(item.created_at).toLocaleString('id-ID', {day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit'})}</span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-200 text-amber-900 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[13px]">pending</span>
                                    <span>Tersimpan di HP</span>
                                </span>
                            </div>
                            <p class="text-gray-900">${escapeHtml(item.teks)}</p>
                        `;
                        container.appendChild(div);
                    });
                } else {
                    if (badgeCount) badgeCount.classList.add('hidden');
                }
            }

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            // Initial render of offline items
            renderOfflineList();

            // 5. Intercept Form Submit
            const form = document.getElementById('formLaporanPenerima');
            const textarea = document.getElementById('laporanTeksInput');

            if (form) {
                form.addEventListener('submit', function(e) {
                    if (!navigator.onLine) {
                        e.preventDefault();
                        const teks = textarea.value.trim();
                        if (!teks) return;

                        const newReport = {
                            id: 'offline_' + Date.now(),
                            teks: teks,
                            created_at: new Date().toISOString()
                        };

                        const currentReports = getOfflineReports();
                        currentReports.unshift(newReport);
                        saveOfflineReports(currentReports);

                        textarea.value = '';
                        alert('📡 Sedang Offline: Laporan Anda telah aman disimpan di memori HP. Begitu ponsel Anda menangkap sinyal internet, laporan ini akan otomatis terkirim ke Pemda.');
                    }
                });
            }

            // 6. Background Auto-Sync
            let isSyncing = false;
            async function syncOfflineReports() {
                if (isSyncing || !navigator.onLine) return;
                const reports = getOfflineReports();
                if (reports.length === 0) return;

                isSyncing = true;
                const csrfToken = document.querySelector('input[name="_token"]')?.value;

                let syncedCount = 0;
                const remainingReports = [];

                for (const report of reports) {
                    try {
                        const res = await fetch("{{ route('penerima.laporan.store') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({ laporan_teks: report.teks })
                        });

                        if (res.ok) {
                            syncedCount++;
                        } else {
                            remainingReports.push(report);
                        }
                    } catch(err) {
                        remainingReports.push(report);
                    }
                }

                saveOfflineReports(remainingReports);
                isSyncing = false;

                if (syncedCount > 0) {
                    const notice = document.getElementById('syncSuccessNotice');
                    const msg = document.getElementById('syncSuccessMessage');
                    if (notice && msg) {
                        msg.textContent = `${syncedCount} laporan offline berhasil disinkronkan ke server Pemda!`;
                        notice.classList.remove('hidden');
                    }
                }
            }

            // Periodic sync check every 20 seconds
            setInterval(() => {
                if (navigator.onLine) {
                    syncOfflineReports();
                }
            }, 20000);
        })();
    </script>
</body>
</html>
