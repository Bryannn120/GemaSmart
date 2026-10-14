@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header Navigation & Title -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <div class="flex items-center gap-2 mb-1">
                <a href="{{ route('pendamping.keluarga_penerima.show', $keluarga_penerima->id) }}" class="text-text-secondary hover:text-primary transition-colors flex items-center gap-1 font-body-sm text-sm">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    <span>Kembali ke Detail Penerima</span>
                </a>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Penilaian Subjektif & Evaluasi Desil</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Lakukan penginputan indikator sosial ekonomi keluarga penerima binaan untuk evaluasi tingkat desil dan kemandirian secara berkala.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <div class="px-3.5 py-1.5 rounded-xl bg-surface-container-high border border-border-light flex items-center gap-2 text-xs font-semibold text-text-primary shadow-sm">
                <span class="material-symbols-outlined text-primary text-[18px]">person</span>
                <span>{{ $keluarga_penerima->kepala_keluarga ?? $keluarga_penerima->nama }}</span>
                <span class="text-text-tertiary">|</span>
                <span class="font-mono text-text-secondary">{{ $keluarga_penerima->no_kk }}</span>
            </div>
        </div>
    </div>

    <!-- Info Banner Ringkasan Status Awal -->
    <div class="bg-gradient-to-r from-gov-green-dark to-primary text-white rounded-2xl p-space-lg shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-start md:items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-white/10 backdrop-blur-md flex items-center justify-center shrink-0 border border-white/20">
                <span class="material-symbols-outlined text-[28px] text-white">trending_up</span>
            </div>
            <div>
                <h3 class="font-bold text-base text-white">Tujuan Program: Kenaikan Desil & Pengentasan Kemiskinan</h3>
                <p class="text-xs text-white/80 mt-0.5 max-w-xl">
                    Melalui bantuan bibit dan pendampingan produktif, program bertujuan meningkatkan penghasilan per bulan keluarga penerima sehingga desil meningkat dan keluar dari garis kemiskinan.
                </p>
            </div>
        </div>
        <div class="flex items-center gap-3 bg-white/10 backdrop-blur-md px-4 py-2.5 rounded-xl border border-white/15 shrink-0">
            <div class="text-right">
                <span class="text-[11px] text-white/70 block uppercase font-semibold">Desil Saat Ini</span>
                <span class="text-lg font-bold text-white">Desil {{ $keluarga_penerima->desil }}</span>
            </div>
            <div class="w-px h-8 bg-white/20"></div>
            <div class="text-left">
                <span class="text-[11px] text-white/70 block uppercase font-semibold">Status Kemandirian</span>
                <span class="text-sm font-semibold text-white/95">{{ $keluarga_penerima->status_kemandirian ?? 'Belum Dinilai' }}</span>
            </div>
        </div>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="bg-status-fraud-surface text-status-fraud p-space-md rounded-xl font-body-sm border border-status-fraud/20 flex flex-col gap-1 shadow-sm">
            <div class="flex items-center gap-2 font-bold">
                <span class="material-symbols-outlined text-[20px]">error</span>
                <span>Mohon lengkapi seluruh formulir penilaian dengan benar:</span>
            </div>
            <ul class="list-disc list-inside text-xs pl-6 space-y-0.5">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main Grid Form & Live Assessment Card -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg">
        <!-- Kolom Kiri: Form Input Pendamping (7/12) -->
        <div class="lg:col-span-7 flex flex-col gap-space-lg">
            <form action="{{ route('pendamping.keluarga_penerima.penilaian.store', $keluarga_penerima->id) }}" method="POST" id="formPenilaian" class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light p-space-lg flex flex-col gap-6">
                @csrf

                <!-- Section 1: Periode & Identifikasi Asesmen -->
                <div>
                    <div class="flex items-center gap-2 pb-2 border-b border-border-light mb-4">
                        <span class="material-symbols-outlined text-primary text-[20px]">calendar_month</span>
                        <h2 class="font-bold text-text-primary text-base">1. Periode Penilaian</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="periode" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                                Periode / Tahap Evaluasi <span class="text-status-fraud">*</span>
                            </label>
                            <input type="text" name="periode" id="periode" required
                                value="{{ old('periode', 'Bulan ' . \Carbon\Carbon::now()->translatedFormat('F Y')) }}"
                                placeholder="Contoh: Bulan Oktober 2026, Triwulan IV 2026"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                                Pendamping Penilai
                            </label>
                            <input type="text" disabled value="{{ Auth::user()->name }} (Anda)"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-border-light bg-surface-muted text-text-secondary text-sm cursor-not-allowed">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Penghasilan Bulanan & Tanggungan Keluarga -->
                <div>
                    <div class="flex items-center gap-2 pb-2 border-b border-border-light mb-4">
                        <span class="material-symbols-outlined text-primary text-[20px]">payments</span>
                        <h2 class="font-bold text-text-primary text-base">2. Penghasilan & Jumlah Tanggungan</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="penghasilan_perbulan" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                                Penghasilan per Bulan (Rp) <span class="text-status-fraud">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-text-secondary text-sm font-semibold">Rp</span>
                                <input type="number" step="50000" min="0" name="penghasilan_perbulan" id="penghasilan_perbulan" required
                                    value="{{ old('penghasilan_perbulan', $keluarga_penerima->penghasilan_perbulan > 0 ? (int)$keluarga_penerima->penghasilan_perbulan : 800000) }}"
                                    placeholder="800000"
                                    class="w-full pl-11 pr-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                            </div>
                            <span class="text-[11px] text-text-tertiary mt-1 block">Rata-rata pendapatan seluruh anggota KK per bulan.</span>

                            <!-- Quick preset buttons -->
                            <div class="flex flex-wrap gap-1.5 mt-2">
                                <button type="button" onclick="setPenghasilan(500000)" class="px-2 py-0.5 text-[11px] rounded bg-surface-container-high hover:bg-surface-container-highest text-text-secondary font-medium transition-colors">500rb</button>
                                <button type="button" onclick="setPenghasilan(1000000)" class="px-2 py-0.5 text-[11px] rounded bg-surface-container-high hover:bg-surface-container-highest text-text-secondary font-medium transition-colors">1 Juta</button>
                                <button type="button" onclick="setPenghasilan(1800000)" class="px-2 py-0.5 text-[11px] rounded bg-surface-container-high hover:bg-surface-container-highest text-text-secondary font-medium transition-colors">1.8 Juta</button>
                                <button type="button" onclick="setPenghasilan(3000000)" class="px-2 py-0.5 text-[11px] rounded bg-surface-container-high hover:bg-surface-container-highest text-text-secondary font-medium transition-colors">3 Juta</button>
                            </div>
                        </div>

                        <div>
                            <label for="jumlah_anak" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                                Jumlah Anak / Tanggungan <span class="text-status-fraud">*</span>
                            </label>
                            <input type="number" min="0" max="25" name="jumlah_anak" id="jumlah_anak" required
                                value="{{ old('jumlah_anak', 2) }}"
                                placeholder="Contoh: 2"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                            <span class="text-[11px] text-text-tertiary mt-1 block">Total anggota keluarga = Kepala KK + Pasangan + Anak.</span>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Kepemilikan & Kondisi Aset -->
                <div>
                    <div class="flex items-center gap-2 pb-2 border-b border-border-light mb-4">
                        <span class="material-symbols-outlined text-primary text-[20px]">home_work</span>
                        <h2 class="font-bold text-text-primary text-base">3. Kondisi Aset Tempat Tinggal & Modal</h2>
                    </div>

                    <!-- Aset Rumah -->
                    <div class="mb-5">
                        <label class="block text-xs font-semibold text-text-secondary uppercase mb-2">
                            Kondisi Fisik & Status Tempat Tinggal <span class="text-status-fraud">*</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <label class="relative flex flex-col p-3 rounded-xl border border-border-medium cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-gov-green-surface/40">
                                <input type="radio" name="aset_rumah" value="tidak_layak" class="sr-only" {{ old('aset_rumah', 'tidak_layak') == 'tidak_layak' ? 'checked' : '' }}>
                                <span class="font-semibold text-text-primary text-xs flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-amber-600">cabin</span>
                                    <span>Tidak Layak / Gubuk</span>
                                </span>
                                <span class="text-[11px] text-text-tertiary mt-1">Dinding anyaman bambu / lantai tanah / menumpang.</span>
                            </label>

                            <label class="relative flex flex-col p-3 rounded-xl border border-border-medium cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-gov-green-surface/40">
                                <input type="radio" name="aset_rumah" value="semi_permanen" class="sr-only" {{ old('aset_rumah') == 'semi_permanen' ? 'checked' : '' }}>
                                <span class="font-semibold text-text-primary text-xs flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-blue-600">cottage</span>
                                    <span>Semi Permanen</span>
                                </span>
                                <span class="text-[11px] text-text-tertiary mt-1">Dinding setengah tembok / plester / papan terawat.</span>
                            </label>

                            <label class="relative flex flex-col p-3 rounded-xl border border-border-medium cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-gov-green-surface/40">
                                <input type="radio" name="aset_rumah" value="permanen" class="sr-only" {{ old('aset_rumah') == 'permanen' ? 'checked' : '' }}>
                                <span class="font-semibold text-text-primary text-xs flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-primary">domain</span>
                                    <span>Permanen Layak</span>
                                </span>
                                <span class="text-[11px] text-text-tertiary mt-1">Tembok penuh, lantai keramik, milik sendiri.</span>
                            </label>
                        </div>
                    </div>

                    <!-- Aset Lahan / Tanah -->
                    <div class="mb-5">
                        <label class="block text-xs font-semibold text-text-secondary uppercase mb-2">
                            Kepemilikan Lahan / Tanah Pekarangan <span class="text-status-fraud">*</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <label class="relative flex flex-col p-3 rounded-xl border border-border-medium cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-gov-green-surface/40">
                                <input type="radio" name="aset_tanah" value="tidak_ada" class="sr-only" {{ old('aset_tanah', 'tidak_ada') == 'tidak_ada' ? 'checked' : '' }}>
                                <span class="font-semibold text-text-primary text-xs flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-text-tertiary">block</span>
                                    <span>Tidak Ada / Sewa / Menumpang</span>
                                </span>
                                <span class="text-[11px] text-text-tertiary mt-1">Tidak mempunyai lahan sendiri (< 100 m²).</span>
                            </label>

                            <label class="relative flex flex-col p-3 rounded-xl border border-border-medium cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-gov-green-surface/40">
                                <input type="radio" name="aset_tanah" value="sempit" class="sr-only" {{ old('aset_tanah') == 'sempit' ? 'checked' : '' }}>
                                <span class="font-semibold text-text-primary text-xs flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-secondary">yard</span>
                                    <span>Lahan Sempit (< 250 m²)</span>
                                </span>
                                <span class="text-[11px] text-text-tertiary mt-1">Hanya pekarangan kecil sekitar rumah.</span>
                            </label>

                            <label class="relative flex flex-col p-3 rounded-xl border border-border-medium cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-gov-green-surface/40">
                                <input type="radio" name="aset_tanah" value="sedang" class="sr-only" {{ old('aset_tanah') == 'sedang' ? 'checked' : '' }}>
                                <span class="font-semibold text-text-primary text-xs flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-primary">nature</span>
                                    <span>Lahan Sedang (250 - 1.000 m²)</span>
                                </span>
                                <span class="text-[11px] text-text-tertiary mt-1">Cukup untuk kebun bibit produktif keluarga.</span>
                            </label>

                            <label class="relative flex flex-col p-3 rounded-xl border border-border-medium cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-gov-green-surface/40">
                                <input type="radio" name="aset_tanah" value="luas" class="sr-only" {{ old('aset_tanah') == 'luas' ? 'checked' : '' }}>
                                <span class="font-semibold text-text-primary text-xs flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-gov-green-dark">forest</span>
                                    <span>Lahan Luas (> 1.000 m² / > 1 Ha)</span>
                                </span>
                                <span class="text-[11px] text-text-tertiary mt-1">Kebun / ladang luas dengan potensi komersial.</span>
                            </label>
                        </div>
                    </div>

                    <!-- Aset Kendaraan -->
                    <div>
                        <label class="block text-xs font-semibold text-text-secondary uppercase mb-2">
                            Kepemilikan Kendaraan Bermotor <span class="text-status-fraud">*</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <label class="relative flex flex-col p-3 rounded-xl border border-border-medium cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-gov-green-surface/40">
                                <input type="radio" name="aset_kendaraan" value="tidak_ada" class="sr-only" {{ old('aset_kendaraan', 'tidak_ada') == 'tidak_ada' ? 'checked' : '' }}>
                                <span class="font-semibold text-text-primary text-xs flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-text-tertiary">pedal_bike</span>
                                    <span>Tidak Ada / Sepeda Kayuh</span>
                                </span>
                                <span class="text-[11px] text-text-tertiary mt-1">Hanya berjalan kaki atau sepeda kayuh biasa.</span>
                            </label>

                            <label class="relative flex flex-col p-3 rounded-xl border border-border-medium cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-gov-green-surface/40">
                                <input type="radio" name="aset_kendaraan" value="motor_tua" class="sr-only" {{ old('aset_kendaraan') == 'motor_tua' ? 'checked' : '' }}>
                                <span class="font-semibold text-text-primary text-xs flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-amber-600">two_wheeler</span>
                                    <span>Motor Tua / Kurang Layak (1 Unit)</span>
                                </span>
                                <span class="text-[11px] text-text-tertiary mt-1">1 unit sepeda motor tua dengan mobilitas terbatas.</span>
                            </label>

                            <label class="relative flex flex-col p-3 rounded-xl border border-border-medium cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-gov-green-surface/40">
                                <input type="radio" name="aset_kendaraan" value="motor_layak" class="sr-only" {{ old('aset_kendaraan') == 'motor_layak' ? 'checked' : '' }}>
                                <span class="font-semibold text-text-primary text-xs flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-primary">moped</span>
                                    <span>Motor Prima (>= 1 Unit)</span>
                                </span>
                                <span class="text-[11px] text-text-tertiary mt-1">Sepeda motor kondisi baik atau memiliki lebih dari 1 unit.</span>
                            </label>

                            <label class="relative flex flex-col p-3 rounded-xl border border-border-medium cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-gov-green-surface/40">
                                <input type="radio" name="aset_kendaraan" value="mobil" class="sr-only" {{ old('aset_kendaraan') == 'mobil' ? 'checked' : '' }}>
                                <span class="font-semibold text-text-primary text-xs flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-blue-600">directions_car</span>
                                    <span>Memiliki Mobil / Roda 4</span>
                                </span>
                                <span class="text-[11px] text-text-tertiary mt-1">Memiliki mobil pribadi atau kendaraan angkut niaga.</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Catatan Pendamping Lapangan -->
                <div>
                    <div class="flex items-center gap-2 pb-2 border-b border-border-light mb-4">
                        <span class="material-symbols-outlined text-primary text-[20px]">edit_note</span>
                        <h2 class="font-bold text-text-primary text-base">4. Catatan & Observasi Pendamping</h2>
                    </div>

                    <div>
                        <label for="catatan" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                            Catatan Perkembangan Ekonomi / Hambatan
                        </label>
                        <textarea name="catatan" id="catatan" rows="3"
                            placeholder="Catat kondisi usaha sampingan bibit, hasil panen, atau kemajuan pendapatan keluarga binaan selama masa pendampingan..."
                            class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">{{ old('catatan') }}</textarea>
                    </div>
                </div>

                <!-- Tombol Aksi Simpan -->
                <div class="pt-4 border-t border-border-light flex flex-col sm:flex-row items-center justify-between gap-3">
                    <a href="{{ route('pendamping.keluarga_penerima.show', $keluarga_penerima->id) }}" class="w-full sm:w-auto px-space-md py-2.5 rounded-xl bg-surface-container-high hover:bg-surface-container-highest text-text-secondary hover:text-text-primary font-label-md text-xs font-semibold transition-colors text-center">
                        Batal
                    </a>
                    <button type="submit" class="w-full sm:w-auto px-space-xl py-3 rounded-xl bg-primary hover:bg-gov-green-dark text-white font-label-md text-sm font-bold shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">task_alt</span>
                        <span>Simpan Hasil Penilaian & Perbarui Desil</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Kolom Kanan: Live Simulator & Penjelasan Regulasi Desil (5/12) -->
        <div class="lg:col-span-5 flex flex-col gap-space-lg">
            <!-- Kartu Live Kalkulasi Desil -->
            <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light p-space-lg flex flex-col gap-4 sticky top-24">
                <div class="flex items-center justify-between pb-3 border-b border-border-light">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[22px]">calculate</span>
                        <h3 class="font-bold text-text-primary text-base">Hasil Estimasi Sistem</h3>
                    </div>
                    <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-gov-green-surface text-primary border border-primary/20">
                        Otomatis Real-Time
                    </span>
                </div>

                <!-- Display Utama Desil & Skor -->
                <div class="p-4 rounded-xl bg-surface-subtle border border-border-light flex flex-col items-center text-center">
                    <span class="text-xs font-semibold text-text-tertiary uppercase tracking-wider">Hasil Tingkatan Desil</span>
                    <div class="mt-1 flex items-baseline gap-1">
                        <span id="previewDesilNumber" class="text-4xl font-extrabold text-primary">Desil 1</span>
                    </div>
                    <span id="previewDesilLabel" class="text-xs font-medium text-text-secondary mt-1">Sangat Miskin / Kemiskinan Ekstrem</span>

                    <div class="w-full border-t border-border-light my-3"></div>

                    <div class="grid grid-cols-2 w-full gap-2 text-left">
                        <div class="p-2 rounded-lg bg-surface-container-lowest">
                            <span class="text-[10px] text-text-tertiary uppercase block font-semibold">Skor Komposit</span>
                            <span id="previewTotalSkor" class="text-base font-bold text-text-primary">15 / 100</span>
                        </div>
                        <div class="p-2 rounded-lg bg-surface-container-lowest">
                            <span class="text-[10px] text-text-tertiary uppercase block font-semibold">Status Kemandirian</span>
                            <span id="previewKemandirian" class="text-sm font-bold text-amber-700">Belum Mandiri</span>
                        </div>
                    </div>
                </div>

                <!-- Perbandingan dengan Desil Sebelumnya -->
                <div class="p-3.5 rounded-xl border border-border-light flex items-center justify-between text-xs" id="previewComparisonBox">
                    <div>
                        <span class="text-text-tertiary block text-[11px]">Desil Sebelumnya:</span>
                        <span class="font-bold text-text-primary">Desil {{ $keluarga_penerima->desil }}</span>
                    </div>
                    <div class="flex items-center gap-1 font-bold" id="previewTrendBadge">
                        <span class="material-symbols-outlined text-[18px]">trending_flat</span>
                        <span>Tetap</span>
                    </div>
                </div>

                <!-- Rincian Parameter Kuantitatif -->
                <div class="flex flex-col gap-2 text-xs">
                    <span class="font-bold text-text-secondary uppercase text-[11px] tracking-wider">Rincian Perhitungan Sistem:</span>
                    
                    <div class="flex items-center justify-between p-2 rounded-lg bg-surface-muted">
                        <span class="text-text-secondary">Total Anggota Keluarga:</span>
                        <span id="previewTotalAnggota" class="font-bold text-text-primary">4 Jiwa</span>
                    </div>

                    <div class="flex items-center justify-between p-2 rounded-lg bg-surface-muted">
                        <span class="text-text-secondary">Pendapatan per Kapita / bln:</span>
                        <span id="previewPendapatanKapita" class="font-bold text-primary font-mono">Rp 200.000</span>
                    </div>

                    <div class="flex items-center justify-between p-2 rounded-lg bg-surface-muted">
                        <span class="text-text-secondary">Bobot Skor Rumah (25%):</span>
                        <span id="previewSkorRumah" class="font-semibold text-text-primary">15 poin</span>
                    </div>

                    <div class="flex items-center justify-between p-2 rounded-lg bg-surface-muted">
                        <span class="text-text-secondary">Bobot Skor Lahan (15%):</span>
                        <span id="previewSkorTanah" class="font-semibold text-text-primary">15 poin</span>
                    </div>

                    <div class="flex items-center justify-between p-2 rounded-lg bg-surface-muted">
                        <span class="text-text-secondary">Bobot Skor Kendaraan (15%):</span>
                        <span id="previewSkorKendaraan" class="font-semibold text-text-primary">10 poin</span>
                    </div>
                </div>

                <!-- Regulasi & Pedoman Desil -->
                <div class="p-3 rounded-xl bg-gov-green-surface/40 border border-primary/20 text-xs text-text-secondary flex flex-col gap-1.5">
                    <div class="flex items-center gap-1.5 font-bold text-primary">
                        <span class="material-symbols-outlined text-[16px]">policy</span>
                        <span>Sesuai Regulasi Desil DTSK & Kemensos</span>
                    </div>
                    <p class="text-[11px] leading-relaxed">
                        Pengurangan kemiskinan diukur dari pergerakan naik desil keluarga binaan (Desil 1–2 ke Desil 3–4 Rentan, hingga Desil 5+ Berkembang/Mandiri). Peningkatan pendapatan bulanan memiliki bobot terbesar (45%) dalam algoritma penilaian.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const desilAwal = {{ (int) $keluarga_penerima->desil }};

    function setPenghasilan(val) {
        document.getElementById('penghasilan_perbulan').value = val;
        hitungLivePreview();
    }

    function hitungLivePreview() {
        const penghasilan = parseFloat(document.getElementById('penghasilan_perbulan').value) || 0;
        const jumlahAnak = parseInt(document.getElementById('jumlah_anak').value) || 0;
        const totalAnggota = Math.max(1, jumlahAnak + 2);
        const perKapita = penghasilan / totalAnggota;

        // 1. Base Desil dari Penghasilan Bulanan
        let baseDesil = 1;
        if (penghasilan < 1000000) baseDesil = 1;
        else if (penghasilan < 1800000) baseDesil = 2;
        else if (penghasilan < 2700000) baseDesil = 3;
        else if (penghasilan < 3800000) baseDesil = 4;
        else if (penghasilan < 5000000) baseDesil = 5;
        else if (penghasilan < 6500000) baseDesil = 6;
        else if (penghasilan < 8500000) baseDesil = 7;
        else if (penghasilan < 12000000) baseDesil = 8;
        else if (penghasilan < 18000000) baseDesil = 9;
        else baseDesil = 10;

        // 2. Evaluasi Aset
        let poinAset = 0;
        const asetRumah = document.querySelector('input[name="aset_rumah"]:checked')?.value || 'tidak_layak';
        let skorRumah = 15;
        if (asetRumah === 'permanen') { skorRumah = 90; poinAset += 2; }
        else if (asetRumah === 'semi_permanen') { skorRumah = 50; poinAset += 1; }
        else { poinAset -= 1; }

        const asetTanah = document.querySelector('input[name="aset_tanah"]:checked')?.value || 'tidak_ada';
        let skorTanah = 15;
        if (asetTanah === 'luas') { skorTanah = 95; poinAset += 2; }
        else if (asetTanah === 'sedang') { skorTanah = 70; poinAset += 1; }
        else if (asetTanah === 'tidak_ada') { poinAset -= 1; }

        const asetKendaraan = document.querySelector('input[name="aset_kendaraan"]:checked')?.value || 'tidak_ada';
        let skorKendaraan = 10;
        if (asetKendaraan === 'mobil') { skorKendaraan = 100; poinAset += 3; }
        else if (asetKendaraan === 'motor_layak') { skorKendaraan = 75; poinAset += 1; }
        else if (asetKendaraan === 'tidak_ada') { poinAset -= 1; }

        // 3. Penyesuaian Desil
        let penyesuaian = 0;
        if (poinAset >= 4) penyesuaian += 1;
        else if (poinAset <= -2 && baseDesil > 2) penyesuaian -= 1;

        if (jumlahAnak >= 4 && perKapita < 600000 && baseDesil > 1) penyesuaian -= 1;

        const desil = Math.max(1, Math.min(10, baseDesil + penyesuaian));

        // Skor Komposit (0 - 100)
        const skorBase = (desil * 10) - 3;
        const totalSkor = Math.max(10, Math.min(100, Math.round(skorBase + (poinAset * 1.5))));

        const labelMap = {
            1: "Desil 1 (Sangat Miskin / Ekstrem)",
            2: "Desil 2 (Miskin)",
            3: "Desil 3 (Hampir Miskin)",
            4: "Desil 4 (Rentan Miskin)",
            5: "Desil 5 (Menengah Bawah)",
            6: "Desil 6 (Menengah / Mandiri Awal)",
            7: "Desil 7 (Menengah Mapan)",
            8: "Desil 8 (Menengah Atas)",
            9: "Desil 9 (Mapan)",
            10: "Desil 10 (Sangat Mapan / Sejahtera)"
        };
        const labelDesil = labelMap[desil] || ("Desil " + desil);

        // Status Kemandirian (Aturan: Mandiri jika sudah di Desil 6 ke atas)
        let statusKemandirian = "Tahap Kemandirian";
        let colorClass = "text-blue-700";
        if (desil >= 6) {
            statusKemandirian = "Sudah Mandiri";
            colorClass = "text-gov-green-dark";
        } else if (desil < desilAwal) {
            statusKemandirian = "Penurunan Desil";
            colorClass = "text-amber-700";
        } else {
            statusKemandirian = "Tahap Kemandirian";
            colorClass = "text-blue-700";
        }

        // DOM Updates
        document.getElementById('previewDesilNumber').innerText = "Desil " + desil;
        document.getElementById('previewDesilLabel').innerText = labelDesil;
        document.getElementById('previewTotalSkor').innerText = totalSkor + " / 100";
        
        const elemKemandirian = document.getElementById('previewKemandirian');
        elemKemandirian.innerText = statusKemandirian;
        elemKemandirian.className = "text-sm font-bold " + colorClass;

        document.getElementById('previewTotalAnggota').innerText = totalAnggota + " Jiwa (" + (jumlahAnak) + " anak)";
        document.getElementById('previewPendapatanKapita').innerText = "Rp " + Math.round(perKapita).toLocaleString('id-ID');
        document.getElementById('previewSkorRumah').innerText = skorRumah + " poin";
        document.getElementById('previewSkorTanah').innerText = skorTanah + " poin";
        document.getElementById('previewSkorKendaraan').innerText = skorKendaraan + " poin";

        // Trend Comparison
        const badgeTrend = document.getElementById('previewTrendBadge');
        if (desil > desilAwal) {
            badgeTrend.className = "flex items-center gap-1 font-bold text-green-600";
            badgeTrend.innerHTML = '<span class="material-symbols-outlined text-[18px]">trending_up</span><span>Maju (+ ' + (desil - desilAwal) + ' Desil)</span>';
        } else if (desil === desilAwal) {
            badgeTrend.className = "flex items-center gap-1 font-bold text-blue-600";
            badgeTrend.innerHTML = '<span class="material-symbols-outlined text-[18px]">trending_flat</span><span>Tetap</span>';
        } else {
            badgeTrend.className = "flex items-center gap-1 font-bold text-amber-600";
            badgeTrend.innerHTML = '<span class="material-symbols-outlined text-[18px]">trending_down</span><span>Mundur (- ' + (desilAwal - desil) + ' Desil)</span>';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('penghasilan_perbulan').addEventListener('input', hitungLivePreview);
        document.getElementById('jumlah_anak').addEventListener('input', hitungLivePreview);
        document.querySelectorAll('input[name="aset_rumah"]').forEach(el => el.addEventListener('change', hitungLivePreview));
        document.querySelectorAll('input[name="aset_tanah"]').forEach(el => el.addEventListener('change', hitungLivePreview));
        document.querySelectorAll('input[name="aset_kendaraan"]').forEach(el => el.addEventListener('change', hitungLivePreview));

        hitungLivePreview();
    });
</script>
@endsection
