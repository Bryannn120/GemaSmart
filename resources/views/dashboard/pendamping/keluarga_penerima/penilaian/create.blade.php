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
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Penilaian Tolak Ukur Kemandirian</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Evaluasi tolak ukur pendapatan dan pengeluaran (pilihan per bulan atau per hari) serta indikator sosial ekonomi keluarga penerima bantuan.
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
                <span class="material-symbols-outlined text-[28px] text-white">balance</span>
            </div>
            <div>
                <h3 class="font-bold text-base text-white">Tolak Ukur Kemandirian: Pendapatan vs Pengeluaran</h3>
                <p class="text-xs text-white/80 mt-0.5 max-w-xl">
                    Kemandirian ekonomi dinilai dari kemampuan keluarga menghasilkan pendapatan yang melebihi pengeluaran pokok (surplus positif), dihitung berdasarkan basis per hari atau per bulan.
                </p>
            </div>
        </div>
        <div class="flex items-center gap-3 bg-white/10 backdrop-blur-md px-4 py-2.5 rounded-xl border border-white/15 shrink-0">
            <div class="text-right">
                <span class="text-[11px] text-white/70 block uppercase font-semibold">Status Saat Ini</span>
                <span class="text-lg font-bold text-white">{{ $keluarga_penerima->status_kemandirian ?? 'Tahap Kemandirian' }}</span>
            </div>
            <div class="w-px h-8 bg-white/20"></div>
            <div class="text-left">
                <span class="text-[11px] text-white/70 block uppercase font-semibold">Tolak Ukur</span>
                <span class="text-sm font-semibold text-white/95">Indikator Penilaian</span>
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

                <!-- Section 2: Tolak Ukur Pendapatan & Pengeluaran (Bisa Per Bulan atau Per Hari) -->
                <div>
                    <div class="flex items-center justify-between pb-2 border-b border-border-light mb-4">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[20px]">payments</span>
                            <h2 class="font-bold text-text-primary text-base">2. Tolak Ukur: Pendapatan &amp; Pengeluaran</h2>
                        </div>
                        <span class="text-xs font-semibold text-primary bg-gov-green-surface px-2.5 py-1 rounded-lg border border-primary/20">
                            Pilihan Waktu Fleksibel
                        </span>
                    </div>

                    <!-- Pilihan Basis Waktu: Per Bulan vs Per Hari -->
                    <div class="mb-4 p-3 rounded-xl bg-surface-subtle border border-border-light">
                        <label class="block text-xs font-semibold text-text-secondary uppercase mb-2">
                            Pilih Basis Waktu Pengukuran <span class="text-status-fraud">*</span>
                        </label>
                        <div class="grid grid-cols-2 gap-3">
                            <label id="labelPeriodeBulan" class="flex items-center justify-center gap-2 p-2.5 rounded-xl border border-primary bg-primary text-white font-semibold text-xs cursor-pointer transition-all shadow-xs">
                                <input type="radio" name="tipe_periode" value="per_bulan" id="tipe_bulan" class="sr-only" checked onchange="handlePeriodeChange('per_bulan')">
                                <span class="material-symbols-outlined text-[18px]">calendar_view_month</span>
                                <span>Per Bulan (Bulanan)</span>
                            </label>

                            <label id="labelPeriodeHari" class="flex items-center justify-center gap-2 p-2.5 rounded-xl border border-border-medium bg-white text-text-secondary font-semibold text-xs cursor-pointer hover:border-primary/50 transition-all">
                                <input type="radio" name="tipe_periode" value="per_hari" id="tipe_hari" class="sr-only" onchange="handlePeriodeChange('per_hari')">
                                <span class="material-symbols-outlined text-[18px]">today</span>
                                <span>Per Hari (Harian)</span>
                            </label>
                        </div>
                        <span class="text-[11px] text-text-tertiary mt-2 block" id="tipePeriodeDesc">
                            Pilihan Per Bulan: masukkan akumulasi pendapatan & pengeluaran rata-rata selama 1 bulan penuh.
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Input Pendapatan -->
                        <div>
                            <label for="pendapatan" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                                <span id="labelInputPendapatan">Pendapatan per Bulan (Rp)</span> <span class="text-status-fraud">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-text-secondary text-sm font-semibold">Rp</span>
                                <input type="number" step="1000" min="0" name="pendapatan" id="pendapatan" required
                                    value="{{ old('pendapatan', $keluarga_penerima->pendapatan > 0 ? (int)$keluarga_penerima->pendapatan : ($keluarga_penerima->penghasilan_perbulan > 0 ? (int)$keluarga_penerima->penghasilan_perbulan : 1200000)) }}"
                                    placeholder="1200000"
                                    class="w-full pl-11 pr-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                            </div>
                            <span class="text-[11px] text-text-tertiary mt-1 block" id="subLabelPendapatan">Hasil panen, upah kerja, atau penjualan harian/bulanan.</span>

                            <!-- Quick preset buttons for pendapatan -->
                            <div class="flex flex-wrap gap-1.5 mt-2" id="presetPendapatanContainer">
                                <!-- Populated dynamically by JS -->
                            </div>
                        </div>

                        <!-- Input Pengeluaran -->
                        <div>
                            <label for="pengeluaran" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                                <span id="labelInputPengeluaran">Pengeluaran Pokok per Bulan (Rp)</span> <span class="text-status-fraud">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-text-secondary text-sm font-semibold">Rp</span>
                                <input type="number" step="1000" min="0" name="pengeluaran" id="pengeluaran" required
                                    value="{{ old('pengeluaran', $keluarga_penerima->pengeluaran > 0 ? (int)$keluarga_penerima->pengeluaran : 800000) }}"
                                    placeholder="800000"
                                    class="w-full pl-11 pr-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                            </div>
                            <span class="text-[11px] text-text-tertiary mt-1 block" id="subLabelPengeluaran">Biaya makan harian, listrik/air, dan kebutuhan dapur.</span>

                            <!-- Quick preset buttons for pengeluaran -->
                            <div class="flex flex-wrap gap-1.5 mt-2" id="presetPengeluaranContainer">
                                <!-- Populated dynamically by JS -->
                            </div>
                        </div>
                    </div>

                    <!-- Net Cash Flow Preview (Surplus / Defisit) -->
                    <div class="mt-4 p-3.5 rounded-xl border border-border-light bg-surface-muted flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0" id="surplusIconContainer">
                                <span class="material-symbols-outlined text-[20px]" id="surplusIcon">trending_up</span>
                            </div>
                            <div>
                                <span class="text-[11px] text-text-tertiary uppercase font-bold block">Status Arus Kas (Surplus / Defisit)</span>
                                <span class="text-sm font-bold block" id="surplusAmountText">Surplus: +Rp 400.000 / bln</span>
                            </div>
                        </div>
                        <div class="text-left sm:text-right text-xs">
                            <span class="text-text-tertiary block text-[11px]">Ekuivalen Konversi:</span>
                            <span class="font-semibold text-text-primary" id="konversiText">Harian: Pendapatan Rp 40.000 | Pengeluaran Rp 26.667</span>
                        </div>
                    </div>

                    <!-- Jumlah Anggota Keluarga / Anak -->
                    <div class="mt-4">
                        <label for="jumlah_anak" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                            Jumlah Anak / Tanggungan Keluarga <span class="text-status-fraud">*</span>
                        </label>
                        <input type="number" min="0" max="25" name="jumlah_anak" id="jumlah_anak" required
                            value="{{ old('jumlah_anak', 2) }}"
                            placeholder="Contoh: 2"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                        <span class="text-[11px] text-text-tertiary mt-1 block">Total tanggungan untuk perhitungan pendapatan &amp; pengeluaran per kapita (Kepala KK + Pasangan + Anak).</span>
                    </div>
                </div>

                <!-- Section 3: Kepemilikan & Kondisi Aset -->
                <div>
                    <div class="flex items-center gap-2 pb-2 border-b border-border-light mb-4">
                        <span class="material-symbols-outlined text-primary text-[20px]">home_work</span>
                        <h2 class="font-bold text-text-primary text-base">3. Kondisi Aset Tempat Tinggal &amp; Modal</h2>
                    </div>

                    <!-- Aset Rumah -->
                    <div class="mb-5">
                        <label class="block text-xs font-semibold text-text-secondary uppercase mb-2">
                            Kondisi Fisik Tempat Tinggal <span class="text-status-fraud">*</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <label class="relative flex flex-col p-3 rounded-xl border border-border-medium cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-gov-green-surface/40">
                                <input type="radio" name="aset_rumah" value="tidak_layak" class="sr-only" {{ old('aset_rumah', 'tidak_layak') == 'tidak_layak' ? 'checked' : '' }}>
                                <span class="font-semibold text-text-primary text-xs flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-amber-600">cabin</span>
                                    <span>Tidak Layak / Gubuk</span>
                                </span>
                                <span class="text-[11px] text-text-tertiary mt-1">Dinding bambu / lantai tanah / menumpang.</span>
                            </label>

                            <label class="relative flex flex-col p-3 rounded-xl border border-border-medium cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-gov-green-surface/40">
                                <input type="radio" name="aset_rumah" value="semi_permanen" class="sr-only" {{ old('aset_rumah') == 'semi_permanen' ? 'checked' : '' }}>
                                <span class="font-semibold text-text-primary text-xs flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-blue-600">cottage</span>
                                    <span>Semi Permanen</span>
                                </span>
                                <span class="text-[11px] text-text-tertiary mt-1">Setengah tembok / plester / papan terawat.</span>
                            </label>

                            <label class="relative flex flex-col p-3 rounded-xl border border-border-medium cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-gov-green-surface/40">
                                <input type="radio" name="aset_rumah" value="permanen" class="sr-only" {{ old('aset_rumah') == 'permanen' ? 'checked' : '' }}>
                                <span class="font-semibold text-text-primary text-xs flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-primary">domain</span>
                                    <span>Permanen Layak</span>
                                </span>
                                <span class="text-[11px] text-text-tertiary mt-1">Tembok penuh, keramik, milik sendiri.</span>
                            </label>
                        </div>
                    </div>

                    <!-- Aset Lahan / Tanah -->
                    <div class="mb-5">
                        <label class="block text-xs font-semibold text-text-secondary uppercase mb-2">
                            Kepemilikan Lahan / Kebun Pekarangan <span class="text-status-fraud">*</span>
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
                                <span class="text-[11px] text-text-tertiary mt-1">Pekarangan kecil sekitar rumah.</span>
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
                                <span class="text-[11px] text-text-tertiary mt-1">Kebun / ladang luas bernilai komersial.</span>
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
                                    <span>Motor Tua (1 Unit)</span>
                                </span>
                                <span class="text-[11px] text-text-tertiary mt-1">Sepeda motor tua dengan mobilitas terbatas.</span>
                            </label>

                            <label class="relative flex flex-col p-3 rounded-xl border border-border-medium cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-gov-green-surface/40">
                                <input type="radio" name="aset_kendaraan" value="motor_layak" class="sr-only" {{ old('aset_kendaraan') == 'motor_layak' ? 'checked' : '' }}>
                                <span class="font-semibold text-text-primary text-xs flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-primary">moped</span>
                                    <span>Motor Prima (>= 1 Unit)</span>
                                </span>
                                <span class="text-[11px] text-text-tertiary mt-1">Sepeda motor kondisi baik atau memiliki &gt; 1 unit.</span>
                            </label>

                            <label class="relative flex flex-col p-3 rounded-xl border border-border-medium cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-gov-green-surface/40">
                                <input type="radio" name="aset_kendaraan" value="mobil" class="sr-only" {{ old('aset_kendaraan') == 'mobil' ? 'checked' : '' }}>
                                <span class="font-semibold text-text-primary text-xs flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-blue-600">directions_car</span>
                                    <span>Memiliki Mobil / Roda 4</span>
                                </span>
                                <span class="text-[11px] text-text-tertiary mt-1">Memiliki mobil pribadi atau kendaraan niaga.</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Catatan Pendamping Lapangan -->
                <div>
                    <div class="flex items-center gap-2 pb-2 border-b border-border-light mb-4">
                        <span class="material-symbols-outlined text-primary text-[20px]">edit_note</span>
                        <h2 class="font-bold text-text-primary text-base">4. Catatan &amp; Observasi Pendamping</h2>
                    </div>

                    <div>
                        <label for="catatan" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                            Catatan Perkembangan Usaha / Hambatan
                        </label>
                        <textarea name="catatan" id="catatan" rows="3"
                            placeholder="Catat kondisi tanaman bibit, hasil panen, sumber pendapatan harian/bulanan, dan pengeluaran mendesak keluarga binaan..."
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
                        <span>Simpan Hasil Penilaian &amp; Perbarui Indikator</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Kolom Kanan: Live Simulator & Tolak Ukur Indikator (5/12) -->
        <div class="lg:col-span-5 flex flex-col gap-space-lg">
            <!-- Kartu Live Kalkulasi Indikator -->
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

                <!-- Display Utama Indikator & Skor -->
                <div class="p-4 rounded-xl bg-surface-subtle border border-border-light flex flex-col items-center text-center">
                    <span class="text-xs font-semibold text-text-tertiary uppercase tracking-wider">Hasil Indikator Penilaian</span>
                    <div class="mt-1 flex items-baseline gap-1">
                        <span id="previewSkorNumber" class="text-3xl font-extrabold text-primary">Skor 70 / 100</span>
                    </div>
                    <span id="previewIndikatorLabel" class="text-xs font-medium text-text-secondary mt-1">Kategori: Mandiri Madya</span>

                    <div class="w-full border-t border-border-light my-3"></div>

                    <div class="grid grid-cols-2 w-full gap-2 text-left">
                        <div class="p-2.5 rounded-lg bg-surface-container-lowest border border-border-light">
                            <span class="text-[10px] text-text-tertiary uppercase block font-semibold">Skor Total</span>
                            <span id="previewTotalSkor" class="text-base font-bold text-text-primary">70 / 100</span>
                        </div>
                        <div class="p-2.5 rounded-lg bg-surface-container-lowest border border-border-light">
                            <span class="text-[10px] text-text-tertiary uppercase block font-semibold">Status Kemandirian</span>
                            <span id="previewKemandirian" class="text-sm font-bold text-green-700">Sudah Mandiri</span>
                        </div>
                    </div>
                </div>

                <!-- Perbandingan dengan Status Sebelumnya -->
                <div class="p-3.5 rounded-xl border border-border-light flex items-center justify-between text-xs" id="previewComparisonBox">
                    <div>
                        <span class="text-text-tertiary block text-[11px]">Status Sebelumnya:</span>
                        <span class="font-bold text-text-primary">{{ $keluarga_penerima->status_kemandirian ?? 'Tahap Kemandirian' }}</span>
                    </div>
                    <div class="flex items-center gap-1 font-bold" id="previewTrendBadge">
                        <span class="material-symbols-outlined text-[18px]">trending_flat</span>
                        <span>Tetap</span>
                    </div>
                </div>

                <!-- Rincian Parameter Tolak Ukur Finansial -->
                <div class="flex flex-col gap-2 text-xs">
                    <span class="font-bold text-text-secondary uppercase text-[11px] tracking-wider">Rincian Tolak Ukur Finansial:</span>
                    
                    <div class="flex items-center justify-between p-2 rounded-lg bg-surface-muted">
                        <span class="text-text-secondary">Ekuivalen Pendapatan Bulanan:</span>
                        <span id="previewPendapatanBulan" class="font-bold text-primary font-mono">Rp 1.200.000</span>
                    </div>

                    <div class="flex items-center justify-between p-2 rounded-lg bg-surface-muted">
                        <span class="text-text-secondary">Ekuivalen Pengeluaran Bulanan:</span>
                        <span id="previewPengeluaranBulan" class="font-bold text-text-primary font-mono">Rp 800.000</span>
                    </div>

                    <div class="flex items-center justify-between p-2 rounded-lg bg-surface-muted" id="previewSurplusRow">
                        <span class="text-text-secondary">Sisa Bersih (Surplus / Defisit):</span>
                        <span id="previewSisaBersih" class="font-bold text-emerald-700 font-mono">+Rp 400.000 / bln</span>
                    </div>

                    <div class="flex items-center justify-between p-2 rounded-lg bg-surface-muted">
                        <span class="text-text-secondary">Pendapatan per Kapita / bln:</span>
                        <span id="previewPendapatanKapita" class="font-bold text-text-primary font-mono">Rp 300.000</span>
                    </div>

                    <div class="flex items-center justify-between p-2 rounded-lg bg-surface-muted">
                        <span class="text-text-secondary">Pengeluaran per Kapita / bln:</span>
                        <span id="previewPengeluaranKapita" class="font-bold text-text-primary font-mono">Rp 200.000</span>
                    </div>
                </div>

                <!-- Penjelasan Tolak Ukur -->
                <div class="p-3 rounded-xl bg-gov-green-surface/40 border border-primary/20 text-xs text-text-secondary flex flex-col gap-1.5">
                    <div class="flex items-center gap-1.5 font-bold text-primary">
                        <span class="material-symbols-outlined text-[16px]">info</span>
                        <span>Tolak Ukur Kemandirian Finansial</span>
                    </div>
                    <p class="text-[11px] leading-relaxed">
                        Tolak ukur dihitung dari rasio pendapatan vs pengeluaran. Keluarga dengan <strong>surplus pendapatan</strong> di atas pengeluaran pokok memiliki daya tahan ekonomi lebih kuat dan skor indikator meningkat menuju status <strong>Sudah Mandiri</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const tingkatAwal = {{ (int) ($keluarga_penerima->desil ?? 1) }};
    let currentTipe = 'per_bulan';

    const presets = {
        per_bulan: {
            pendapatan: [
                { label: '800rb', val: 800000 },
                { label: '1.2 Jt', val: 1200000 },
                { label: '2 Jt', val: 2000000 },
                { label: '3.5 Jt', val: 3500000 },
                { label: '5.5 Jt', val: 5500000 }
            ],
            pengeluaran: [
                { label: '600rb', val: 600000 },
                { label: '900rb', val: 900000 },
                { label: '1.5 Jt', val: 1500000 },
                { label: '2.5 Jt', val: 2500000 }
            ]
        },
        per_hari: {
            pendapatan: [
                { label: '30rb/hr', val: 30000 },
                { label: '50rb/hr', val: 50000 },
                { label: '75rb/hr', val: 75000 },
                { label: '120rb/hr', val: 120000 },
                { label: '200rb/hr', val: 200000 }
            ],
            pengeluaran: [
                { label: '25rb/hr', val: 25000 },
                { label: '40rb/hr', val: 40000 },
                { label: '60rb/hr', val: 60000 },
                { label: '90rb/hr', val: 90000 }
            ]
        }
    };

    function renderPresets() {
        const pContainer = document.getElementById('presetPendapatanContainer');
        const eContainer = document.getElementById('presetPengeluaranContainer');
        
        pContainer.innerHTML = '';
        presets[currentTipe].pendapatan.forEach(item => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'px-2 py-0.5 text-[11px] rounded bg-surface-container-high hover:bg-surface-container-highest text-text-secondary font-medium transition-colors';
            btn.innerText = item.label;
            btn.onclick = () => {
                document.getElementById('pendapatan').value = item.val;
                hitungLivePreview();
            };
            pContainer.appendChild(btn);
        });

        eContainer.innerHTML = '';
        presets[currentTipe].pengeluaran.forEach(item => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'px-2 py-0.5 text-[11px] rounded bg-surface-container-high hover:bg-surface-container-highest text-text-secondary font-medium transition-colors';
            btn.innerText = item.label;
            btn.onclick = () => {
                document.getElementById('pengeluaran').value = item.val;
                hitungLivePreview();
            };
            eContainer.appendChild(btn);
        });
    }

    function handlePeriodeChange(tipe) {
        if (currentTipe === tipe) return;

        const pendInput = document.getElementById('pendapatan');
        const pengInput = document.getElementById('pengeluaran');
        let currentPend = parseFloat(pendInput.value) || 0;
        let currentPeng = parseFloat(pengInput.value) || 0;

        if (tipe === 'per_hari') {
            // Konversi dari bulanan ke harian
            pendInput.value = Math.round(currentPend / 30);
            pengInput.value = Math.round(currentPeng / 30);
            
            document.getElementById('labelInputPendapatan').innerText = 'Pendapatan per Hari (Rp)';
            document.getElementById('labelInputPengeluaran').innerText = 'Pengeluaran Pokok per Hari (Rp)';
            document.getElementById('tipePeriodeDesc').innerText = 'Pilihan Per Hari: masukkan rata-rata penghasilan & belanja harian keluarga (otomatis dikali 30 hari untuk perhitungan indikator bulanan).';

            document.getElementById('labelPeriodeHari').className = 'flex items-center justify-center gap-2 p-2.5 rounded-xl border border-primary bg-primary text-white font-semibold text-xs cursor-pointer transition-all shadow-xs';
            document.getElementById('labelPeriodeBulan').className = 'flex items-center justify-center gap-2 p-2.5 rounded-xl border border-border-medium bg-white text-text-secondary font-semibold text-xs cursor-pointer hover:border-primary/50 transition-all';
        } else {
            // Konversi dari harian ke bulanan
            pendInput.value = Math.round(currentPend * 30);
            pengInput.value = Math.round(currentPeng * 30);

            document.getElementById('labelInputPendapatan').innerText = 'Pendapatan per Bulan (Rp)';
            document.getElementById('labelInputPengeluaran').innerText = 'Pengeluaran Pokok per Bulan (Rp)';
            document.getElementById('tipePeriodeDesc').innerText = 'Pilihan Per Bulan: masukkan akumulasi pendapatan & pengeluaran rata-rata selama 1 bulan penuh.';

            document.getElementById('labelPeriodeBulan').className = 'flex items-center justify-center gap-2 p-2.5 rounded-xl border border-primary bg-primary text-white font-semibold text-xs cursor-pointer transition-all shadow-xs';
            document.getElementById('labelPeriodeHari').className = 'flex items-center justify-center gap-2 p-2.5 rounded-xl border border-border-medium bg-white text-text-secondary font-semibold text-xs cursor-pointer hover:border-primary/50 transition-all';
        }

        currentTipe = tipe;
        renderPresets();
        hitungLivePreview();
    }

    function hitungLivePreview() {
        const rawPendapatan = parseFloat(document.getElementById('pendapatan').value) || 0;
        const rawPengeluaran = parseFloat(document.getElementById('pengeluaran').value) || 0;
        const jumlahAnak = parseInt(document.getElementById('jumlah_anak').value) || 0;

        let pendBulan = rawPendapatan;
        let pengBulan = rawPengeluaran;
        let pendHari = Math.round(rawPendapatan / 30);
        let pengHari = Math.round(rawPengeluaran / 30);

        if (currentTipe === 'per_hari') {
            pendBulan = rawPendapatan * 30;
            pengBulan = rawPengeluaran * 30;
            pendHari = rawPendapatan;
            pengHari = rawPengeluaran;
        }

        const sisaBulan = pendBulan - pengBulan;
        const totalAnggota = Math.max(1, jumlahAnak + 2);
        const perKapitaPendapatan = Math.round(pendBulan / totalAnggota);
        const perKapitaPengeluaran = Math.round(pengBulan / totalAnggota);

        // Update Cash Flow Banner
        const surplusIconContainer = document.getElementById('surplusIconContainer');
        const surplusIcon = document.getElementById('surplusIcon');
        const surplusAmountText = document.getElementById('surplusAmountText');
        const konversiText = document.getElementById('konversiText');

        if (sisaBulan >= 0) {
            surplusIconContainer.className = 'w-9 h-9 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0';
            surplusIcon.innerText = 'trending_up';
            surplusAmountText.innerText = 'Surplus: +Rp ' + sisaBulan.toLocaleString('id-ID') + ' / bln';
            surplusAmountText.className = 'text-sm font-bold block text-emerald-700';
        } else {
            surplusIconContainer.className = 'w-9 h-9 rounded-lg bg-red-100 text-red-700 flex items-center justify-center shrink-0';
            surplusIcon.innerText = 'trending_down';
            surplusAmountText.innerText = 'Defisit: -Rp ' + Math.abs(sisaBulan).toLocaleString('id-ID') + ' / bln';
            surplusAmountText.className = 'text-sm font-bold block text-red-600';
        }

        if (currentTipe === 'per_hari') {
            konversiText.innerText = 'Ekuivalen Bulanan: Pendapatan Rp ' + pendBulan.toLocaleString('id-ID') + ' | Pengeluaran Rp ' + pengBulan.toLocaleString('id-ID');
        } else {
            konversiText.innerText = 'Rata-rata Harian: Pendapatan Rp ' + pendHari.toLocaleString('id-ID') + '/hr | Pengeluaran Rp ' + pengHari.toLocaleString('id-ID') + '/hr';
        }

        // 1. Base Tingkat dari Tolak Ukur Pendapatan Bulanan
        let baseTingkat = 1;
        if (pendBulan < 1000000) baseTingkat = 1;
        else if (pendBulan < 1800000) baseTingkat = 2;
        else if (pendBulan < 2700000) baseTingkat = 3;
        else if (pendBulan < 3800000) baseTingkat = 4;
        else if (pendBulan < 5000000) baseTingkat = 5;
        else if (pendBulan < 6500000) baseTingkat = 6;
        else if (pendBulan < 8500000) baseTingkat = 7;
        else if (pendBulan < 12000000) baseTingkat = 8;
        else if (pendBulan < 18000000) baseTingkat = 9;
        else baseTingkat = 10;

        // 2. Koreksi Arus Kas (Surplus/Defisit)
        let koreksiKas = 0;
        if (sisaBulan < -200000 && baseTingkat > 1) {
            koreksiKas -= 1; // Defisit kronis menurunkan tingkat skor
        } else if (sisaBulan >= 1500000 && baseTingkat < 10) {
            koreksiKas += 1; // Tabungan kuat menaikkan tingkat skor
        }

        // 3. Evaluasi Aset
        let poinAset = 0;
        const asetRumah = document.querySelector('input[name="aset_rumah"]:checked')?.value || 'tidak_layak';
        if (asetRumah === 'permanen') poinAset += 2;
        else if (asetRumah === 'semi_permanen') poinAset += 1;
        else poinAset -= 1;

        const asetTanah = document.querySelector('input[name="aset_tanah"]:checked')?.value || 'tidak_ada';
        if (asetTanah === 'luas') poinAset += 2;
        else if (asetTanah === 'sedang') poinAset += 1;
        else if (asetTanah === 'tidak_ada') poinAset -= 1;

        const asetKendaraan = document.querySelector('input[name="aset_kendaraan"]:checked')?.value || 'tidak_ada';
        if (asetKendaraan === 'mobil') poinAset += 3;
        else if (asetKendaraan === 'motor_layak') poinAset += 1;
        else if (asetKendaraan === 'tidak_ada') poinAset -= 1;

        let koreksiAset = 0;
        if (poinAset >= 4) koreksiAset += 1;
        else if (poinAset <= -2 && baseTingkat > 2) koreksiAset -= 1;

        if (jumlahAnak >= 4 && perKapitaPendapatan < 600000 && baseTingkat > 1) koreksiAset -= 1;

        const tingkat = Math.max(1, Math.min(10, baseTingkat + koreksiKas + koreksiAset));

        // Skor Komposit (0 - 100)
        const skorBase = (tingkat * 10) - 3;
        const totalSkor = Math.max(10, Math.min(100, Math.round(skorBase + (poinAset * 1.5))));

        const labelMap = {
            1: "Tingkat 1 (Perlu Intervensi Ekstrem)",
            2: "Tingkat 2 (Sangat Rentan)",
            3: "Tingkat 3 (Rentan / Tahap Awal)",
            4: "Tingkat 4 (Berkembang Bawah)",
            5: "Tingkat 5 (Berkembang Menengah)",
            6: "Tingkat 6 (Mandiri Awal)",
            7: "Tingkat 7 (Mandiri Madya)",
            8: "Tingkat 8 (Mandiri Maju)",
            9: "Tingkat 9 (Mandiri Unggul)",
            10: "Tingkat 10 (Mandiri Utama / Sejahtera)"
        };
        const labelTingkat = labelMap[tingkat] || ("Tingkat " + tingkat);

        // Status Kemandirian berdasarkan skor indikator dan surplus finansial
        let statusKemandirian = "Tahap Kemandirian";
        let colorClass = "text-blue-700";
        let labelKategori = "Kategori: Berkembang";

        if (totalSkor >= 85 && sisaBulan >= 0) {
            statusKemandirian = "Sudah Mandiri";
            colorClass = "text-gov-green-dark";
            labelKategori = "Kategori: Mandiri Utama (Surplus Kuat)";
        } else if (totalSkor >= 70 && sisaBulan >= 0) {
            statusKemandirian = "Sudah Mandiri";
            colorClass = "text-gov-green-dark";
            labelKategori = "Kategori: Mandiri Madya (Tercapai)";
        } else if (sisaBulan < 0 || totalSkor < 40) {
            statusKemandirian = "Butuh Perhatian Khusus";
            colorClass = "text-amber-700";
            labelKategori = "Kategori: Defisit Finansial / Perlu Intervensi";
        } else {
            statusKemandirian = "Tahap Kemandirian";
            colorClass = "text-blue-700";
            labelKategori = "Kategori: Tahap Berkembang";
        }

        // DOM Updates
        document.getElementById('previewSkorNumber').innerText = "Skor " + totalSkor + " / 100";
        document.getElementById('previewIndikatorLabel').innerText = labelKategori;
        document.getElementById('previewTotalSkor').innerText = totalSkor + " / 100";
        
        const elemKemandirian = document.getElementById('previewKemandirian');
        elemKemandirian.innerText = statusKemandirian;
        elemKemandirian.className = "text-sm font-bold " + colorClass;

        document.getElementById('previewPendapatanBulan').innerText = "Rp " + pendBulan.toLocaleString('id-ID');
        document.getElementById('previewPengeluaranBulan').innerText = "Rp " + pengBulan.toLocaleString('id-ID');
        
        const previewSisa = document.getElementById('previewSisaBersih');
        if (sisaBulan >= 0) {
            previewSisa.innerText = "+Rp " + sisaBulan.toLocaleString('id-ID') + " / bln";
            previewSisa.className = "font-bold text-emerald-700 font-mono";
        } else {
            previewSisa.innerText = "-Rp " + Math.abs(sisaBulan).toLocaleString('id-ID') + " / bln";
            previewSisa.className = "font-bold text-red-600 font-mono";
        }

        document.getElementById('previewPendapatanKapita').innerText = "Rp " + perKapitaPendapatan.toLocaleString('id-ID');
        document.getElementById('previewPengeluaranKapita').innerText = "Rp " + perKapitaPengeluaran.toLocaleString('id-ID');

        // Trend Comparison
        const badgeTrend = document.getElementById('previewTrendBadge');
        if (tingkat > tingkatAwal) {
            badgeTrend.className = "flex items-center gap-1 font-bold text-green-600";
            badgeTrend.innerHTML = '<span class="material-symbols-outlined text-[18px]">trending_up</span><span>Maju (Skor Meningkat)</span>';
        } else if (tingkat === tingkatAwal) {
            badgeTrend.className = "flex items-center gap-1 font-bold text-blue-600";
            badgeTrend.innerHTML = '<span class="material-symbols-outlined text-[18px]">trending_flat</span><span>Tetap</span>';
        } else {
            badgeTrend.className = "flex items-center gap-1 font-bold text-amber-600";
            badgeTrend.innerHTML = '<span class="material-symbols-outlined text-[18px]">trending_down</span><span>Mundur (Skor Menurun)</span>';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        renderPresets();
        document.getElementById('pendapatan').addEventListener('input', hitungLivePreview);
        document.getElementById('pengeluaran').addEventListener('input', hitungLivePreview);
        document.getElementById('jumlah_anak').addEventListener('input', hitungLivePreview);
        document.querySelectorAll('input[name="aset_rumah"]').forEach(el => el.addEventListener('change', hitungLivePreview));
        document.querySelectorAll('input[name="aset_tanah"]').forEach(el => el.addEventListener('change', hitungLivePreview));
        document.querySelectorAll('input[name="aset_kendaraan"]').forEach(el => el.addEventListener('change', hitungLivePreview));

        hitungLivePreview();
    });
</script>
@endsection
