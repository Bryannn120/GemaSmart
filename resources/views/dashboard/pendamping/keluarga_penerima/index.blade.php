@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header Page -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <div class="flex items-center gap-space-xs text-text-secondary font-label-md text-label-md mb-1">
                <span>Dashboard Pendamping</span>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="text-text-primary font-semibold">Keluarga Binaan</span>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Keluarga Penerima Bantuan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Daftar keluarga penerima manfaat program bantuan yang berada dalam wilayah pendampingan Anda di lapangan.
            </p>
        </div>

        <!-- Action Buttons: Ekspor, Impor, Tambah -->
        <div class="flex flex-wrap items-center gap-space-sm">
            <!-- Dropdown Ekspor Data -->
            <div class="relative">
                <button id="btnExportDropdownPendamping" onclick="toggleExportDropdownPendamping()" type="button" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-surface-container-low hover:bg-surface-container text-text-primary border border-border-medium font-label-md text-label-md font-semibold transition-all shadow-2xs">
                    <span class="material-symbols-outlined text-[20px] text-emerald-700">file_download</span>
                    <span>Ekspor Data</span>
                    <span class="material-symbols-outlined text-[16px] text-text-secondary transition-transform duration-200" id="iconExportArrowPendamping">expand_more</span>
                </button>

                <div id="exportDropdownMenuPendamping" class="hidden absolute right-0 mt-2 w-56 rounded-xl bg-canvas-bg shadow-xl border border-border-light py-2 z-30">
                    <div class="px-3 py-1.5 text-[11px] font-bold text-text-secondary uppercase tracking-wider border-b border-border-light">
                        Pilih Format Ekspor
                    </div>
                    <a href="{{ route('pendamping.keluarga_penerima.export', array_merge(request()->query(), ['format' => 'xlsx'])) }}" class="flex items-center gap-2 px-4 py-2.5 text-xs text-text-primary hover:bg-surface-subtle transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-emerald-700">table_view</span>
                        <div>
                            <div class="font-semibold">Microsoft Excel (.xlsx)</div>
                            <div class="text-[11px] text-text-secondary">Lengkap dengan format cell rapi</div>
                        </div>
                    </a>
                    <a href="{{ route('pendamping.keluarga_penerima.export', array_merge(request()->query(), ['format' => 'csv'])) }}" class="flex items-center gap-2 px-4 py-2.5 text-xs text-text-primary hover:bg-surface-subtle transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-blue-700">text_snippet</span>
                        <div>
                            <div class="font-semibold">File CSV (.csv)</div>
                            <div class="text-[11px] text-text-secondary">Kompatibel UTF-8 BOM</div>
                        </div>
                    </a>
                    <a href="{{ route('pendamping.keluarga_penerima.export', array_merge(request()->query(), ['format' => 'pdf'])) }}" target="_blank" class="flex items-center gap-2 px-4 py-2.5 text-xs text-text-primary hover:bg-surface-subtle transition-colors border-t border-border-light">
                        <span class="material-symbols-outlined text-[18px] text-red-700">picture_as_pdf</span>
                        <div>
                            <div class="font-semibold">Dokumen PDF (.pdf)</div>
                            <div class="text-[11px] text-text-secondary">Siap cetak format lanskap A4</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Tombol Impor Data (Buka Modal) -->
            <button id="btnOpenImportModalPendamping" onclick="openImportModalPendamping()" type="button" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-surface-container-low hover:bg-surface-container text-text-primary border border-border-medium font-label-md text-label-md font-semibold transition-all shadow-2xs">
                <span class="material-symbols-outlined text-[20px] text-blue-700">file_upload</span>
                <span>Impor Data Excel</span>
            </button>

            <!-- Tombol Tambah Penerima -->
            <a href="{{ route('pendamping.keluarga_penerima.create') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-primary hover:bg-gov-green-dark text-white font-label-md text-xs font-bold shadow-sm transition-all">
                <span class="material-symbols-outlined text-[17px]">person_add</span>
                <span>+ Tambah Penerima</span>
            </a>
        </div>
    </div>

    <!-- Alert Sukses / Error -->
    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20 flex items-start gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px] shrink-0 text-emerald-700">check_circle</span>
            <div class="flex-1">
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 text-red-800 p-space-md rounded-xl font-body-sm border border-red-200 flex items-start gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px] shrink-0 text-red-600">error</span>
            <div class="flex-1">
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    @if(session('import_errors') && count(session('import_errors')) > 0)
        <div class="bg-amber-50 text-amber-900 p-space-md rounded-xl font-body-sm border border-amber-200" x-data="{ openErrors: false }">
            <div class="flex items-center justify-between cursor-pointer" @click="openErrors = !openErrors">
                <div class="flex items-center gap-2 font-semibold">
                    <span class="material-symbols-outlined text-[20px] text-amber-700">warning</span>
                    <span>Terdapat {{ count(session('import_errors')) }} catatan baris data yang dilewati / disesuaikan saat impor:</span>
                </div>
                <button type="button" class="text-xs text-amber-800 underline flex items-center gap-1">
                    <span x-text="openErrors ? 'Sembunyikan' : 'Lihat Detail Baris'"></span>
                    <span class="material-symbols-outlined text-[16px]" :class="openErrors ? 'rotate-180' : ''">expand_more</span>
                </button>
            </div>
            <div x-show="openErrors" x-cloak class="mt-3 pl-7 text-xs font-code-dense space-y-1 max-h-40 overflow-y-auto">
                @foreach(session('import_errors') as $err)
                    <div class="text-red-700">• {{ $err }}</div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Search Bar -->
    <div class="bg-canvas-bg rounded-2xl p-space-md shadow-sm border border-border-light flex flex-col sm:flex-row items-center justify-between gap-space-md">
        <form action="{{ route('pendamping.keluarga_penerima.index') }}" method="GET" class="w-full flex items-center gap-space-sm">
            <input type="hidden" name="tab" value="{{ $tab }}">
            <div class="flex-1 relative">
                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-text-secondary text-[20px]">search</span>
                <input type="text" name="search" id="searchKeluarga" value="{{ request('search') }}"
                    placeholder="Cari nama kepala keluarga, NIK, No. KK, atau nama wilayah (desa/kecamatan)..."
                    class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                @if(request('search'))
                    <a href="{{ route('pendamping.keluarga_penerima.index', ['tab' => $tab]) }}" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-text-tertiary hover:text-text-primary" title="Hapus pencarian">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </a>
                @endif
            </div>
            <button type="submit" class="px-space-md py-2.5 rounded-xl bg-primary text-white font-label-md text-xs font-semibold hover:bg-gov-green-dark transition-colors shadow-sm flex items-center gap-1.5 shrink-0">
                <span class="material-symbols-outlined text-[16px]">search</span>
                <span>Cari</span>
            </button>
            @if(request('search'))
                <a href="{{ route('pendamping.keluarga_penerima.index', ['tab' => $tab]) }}" class="px-space-md py-2.5 rounded-xl bg-surface-container-high hover:bg-surface-container-highest text-text-secondary hover:text-text-primary font-label-md text-xs font-semibold transition-colors border border-border-light flex items-center gap-1 shrink-0">
                    <span class="material-symbols-outlined text-[16px]">refresh</span>
                    <span>Reset</span>
                </a>
            @endif
        </form>
    </div>

    <!-- Tabs: Penerima Aktif vs Lulus Mandiri -->
    <div class="flex items-center gap-2 border-b border-border-light pb-2">
        <a href="{{ route('pendamping.keluarga_penerima.index', array_merge(request()->except('tab'), ['tab' => 'aktif'])) }}" 
           class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 {{ $tab !== 'mandiri' ? 'bg-primary text-white shadow-sm' : 'bg-surface-subtle text-text-secondary hover:text-text-primary' }}">
            <span class="material-symbols-outlined text-[16px]">verified</span>
            <span>Daftar Penerima Bantuan Aktif</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $tab !== 'mandiri' ? 'bg-white/20 text-white' : 'bg-primary/10 text-primary font-bold' }}">{{ $countAktif }}</span>
        </a>
        <a href="{{ route('pendamping.keluarga_penerima.index', array_merge(request()->except('tab'), ['tab' => 'mandiri'])) }}" 
           class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 {{ $tab === 'mandiri' ? 'bg-emerald-700 text-white shadow-sm' : 'bg-surface-subtle text-text-secondary hover:text-text-primary' }}">
            <span class="material-symbols-outlined text-[16px]">workspace_premium</span>
            <span>Lulus Mandiri</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $tab === 'mandiri' ? 'bg-white/20 text-white' : 'bg-emerald-100 text-emerald-800 font-bold' }}">{{ $countMandiri }}</span>
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="p-space-md border-b border-border-light bg-surface-subtle flex items-center justify-between">
            <span class="text-xs font-bold text-text-primary uppercase tracking-wider">
                {{ $tab === 'mandiri' ? 'Warga Binaan Telah Mandiri / Lulus' : 'Daftar Penerima Bantuan Aktif Binaan' }}
            </span>
            <span class="text-xs text-text-secondary font-medium">
                {{ $keluarga_penerimas->count() }} Data Ditampilkan
            </span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Nama Kepala Keluarga</th>
                        <th class="py-3 px-4 font-semibold">No. KK &amp; NIK</th>
                        <th class="py-3 px-4 font-semibold">Wilayah / Alamat</th>
                        <th class="py-3 px-4 font-semibold">Tolak Ukur (Pendapatan &amp; Pengeluaran)</th>
                        <th class="py-3 px-4 font-semibold">Indikator Penilaian</th>
                        <th class="py-3 px-4 font-semibold">Kemandirian</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($keluarga_penerimas as $kp)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4 font-semibold text-text-primary">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gov-green-surface text-primary flex items-center justify-center font-bold text-xs">
                                    {{ strtoupper(substr($kp->kepala_keluarga, 0, 1)) }}
                                </div>
                                <span>{{ $kp->kepala_keluarga }}</span>
                            </div>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="font-mono text-text-primary block font-medium">{{ $kp->no_kk }}</span>
                            <span class="text-text-tertiary font-mono text-[11px]">NIK: {{ $kp->nik }}</span>
                        </td>
                        <td class="py-3.5 px-4 text-text-primary">
                            <div>{{ $kp->wilayah->nama ?? 'Sumbawa' }}</div>
                            <span class="text-text-tertiary text-xs">{{ $kp->alamat }}</span>
                        </td>
                        <td class="py-3.5 px-4 font-mono text-xs">
                            @php
                                $valIn = $kp->pendapatan_perbulan ?: ($kp->penghasilan_perbulan ?: 0);
                                $valOut = $kp->pengeluaran_perbulan ?: 0;
                                $valNet = $valIn - $valOut;
                            @endphp
                            @if($valIn > 0)
                                <div class="space-y-0.5">
                                    <div class="text-emerald-700 font-semibold flex items-center gap-1">
                                        <span class="text-[10px] text-text-tertiary">Masuk:</span>
                                        <span>Rp {{ number_format($valIn, 0, ',', '.') }}/bln</span>
                                    </div>
                                    @if($valOut > 0)
                                        <div class="text-rose-700 font-medium flex items-center gap-1">
                                            <span class="text-[10px] text-text-tertiary">Keluar:</span>
                                            <span>Rp {{ number_format($valOut, 0, ',', '.') }}/bln</span>
                                        </div>
                                    @endif
                                    <div class="text-[10px] {{ $valNet >= 0 ? 'text-primary' : 'text-red-600' }} font-bold border-t border-border-light pt-0.5">
                                        Surplus: Rp {{ number_format($valNet, 0, ',', '.') }}
                                        @if($kp->tipe_periode === 'per_hari')
                                            <span class="text-text-tertiary font-normal">(Input harian)</span>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <span class="text-text-tertiary italic">Belum dinilai</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            @php
                                $latestPen = $kp->penilaianKemandirians->first();
                                $skorVal = $latestPen ? $latestPen->total_skor : null;
                            @endphp
                            @if($skorVal !== null)
                                <span class="inline-block px-2.5 py-0.5 rounded text-xs font-bold {{ $skorVal >= 70 ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    Skor: {{ $skorVal }}/100
                                </span>
                            @else
                                <span class="inline-block px-2.5 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-600">
                                    Belum Dinilai
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            @if ($kp->status_kemandirian == 'Mandiri')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-xs font-bold bg-green-100 text-green-800">
                                    <span class="material-symbols-outlined text-[13px]">verified</span>
                                    Sudah Mandiri
                                </span>
                            @elseif (str_contains($kp->status_kemandirian ?? '', 'Penurunan') || ($kp->penghasilan_bersih < 0 && $kp->pendapatan_perbulan > 0))
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-xs font-bold bg-amber-100 text-amber-800">
                                    <span class="material-symbols-outlined text-[13px]">warning</span>
                                    Butuh Perhatian
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-xs font-bold bg-blue-100 text-blue-800">
                                    <span class="material-symbols-outlined text-[13px]">hourglass_top</span>
                                    Tahap Kemandirian
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5">
                                <a href="{{ route('pendamping.keluarga_penerima.penilaian.create', $kp->id) }}" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-gov-green-surface hover:bg-gov-green text-primary hover:text-white font-label-md text-xs font-semibold transition-colors border border-primary/20" title="Beri Penilaian Indikator (Tolak Ukur)">
                                    <span class="material-symbols-outlined text-[15px]">rate_review</span>
                                    <span>Tolak Ukur</span>
                                </a>
                                <a href="{{ route('pendamping.keluarga_penerima.show', $kp->id) }}" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-surface-container-low hover:bg-surface-container-high text-text-secondary hover:text-text-primary font-label-md text-xs font-semibold transition-colors border border-border-light" title="Lihat Profil Lengkap">
                                    <span class="material-symbols-outlined text-[15px]">visibility</span>
                                    <span>Detail</span>
                                </a>
                                <a href="{{ route('pendamping.keluarga_penerima.edit', $kp->id) }}" class="inline-flex items-center gap-1 px-2 py-1.5 rounded-lg bg-surface-container-low hover:bg-surface-container-high text-text-secondary hover:text-text-primary font-label-md text-xs font-semibold transition-colors border border-border-light" title="Edit Data Penerima">
                                    <span class="material-symbols-outlined text-[15px]">edit</span>
                                </a>
                                <form action="{{ route('pendamping.keluarga_penerima.destroy', $kp->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data penerima {{ $kp->kepala_keluarga }}? Tindakan ini tidak dapat dibatalkan.');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-2 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 font-label-md text-xs font-semibold transition-colors border border-red-200" title="Hapus Data Penerima">
                                        <span class="material-symbols-outlined text-[15px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-12 text-text-tertiary">
                            <span class="material-symbols-outlined text-4xl block mb-2 text-text-tertiary">group_off</span>
                            Belum ada data keluarga penerima bantuan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Impor Data Penerima Excel/CSV Pendamping Lapangan -->
<div id="modalImportDataPendamping" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="fixed inset-0 bg-black/50 transition-opacity" onclick="closeImportModalPendamping()"></div>
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative w-full max-w-2xl rounded-2xl bg-canvas-bg shadow-2xl border border-border-light overflow-hidden z-10 animate-fade-in">
            <!-- Header Modal -->
            <div class="p-space-lg border-b border-border-light flex items-center justify-between bg-surface-subtle">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[22px]">upload_file</span>
                    </div>
                    <div>
                        <h3 class="font-headline-sm text-headline-sm text-text-primary font-bold">Impor Data Penerima Bantuan</h3>
                        <p class="text-xs text-text-secondary">Unggah berkas Excel (.xlsx) atau CSV (.csv) keluarga penerima binaan lapangan</p>
                    </div>
                </div>
                <button type="button" onclick="closeImportModalPendamping()" class="text-text-secondary hover:text-text-primary p-1.5 rounded-lg hover:bg-surface-container transition-colors">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>

            <!-- Form Impor -->
            <form action="{{ route('pendamping.keluarga_penerima.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-space-lg space-y-space-md">
                    <!-- Step 1: Download Template -->
                    <div class="p-space-md bg-blue-50/60 border border-blue-200/80 rounded-xl">
                        <div class="flex items-start justify-between gap-space-sm">
                            <div class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[20px] text-blue-700 shrink-0 mt-0.5">download_for_offline</span>
                                <div>
                                    <h4 class="font-semibold text-xs text-blue-950">Langkah 1: Unduh Format Template Resmi</h4>
                                    <p class="text-[11px] text-blue-900 mt-0.5 leading-relaxed">
                                        Gunakan format template resmi agar data NIK, No. KK, nama desa binaan, dan tolak ukur pendapatan terbaca dengan sempurna tanpa kesalahan format.
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-1.5 shrink-0">
                                <a href="{{ route('pendamping.keluarga_penerima.template', ['format' => 'xlsx']) }}" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-emerald-700 text-white font-semibold text-[11px] hover:bg-emerald-800 transition-colors shadow-2xs">
                                    <span class="material-symbols-outlined text-[15px]">table_view</span>
                                    <span>Template .xlsx</span>
                                </a>
                                <a href="{{ route('pendamping.keluarga_penerima.template', ['format' => 'csv']) }}" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-blue-700 text-white font-semibold text-[11px] hover:bg-blue-800 transition-colors shadow-2xs">
                                    <span class="material-symbols-outlined text-[15px]">text_snippet</span>
                                    <span>.csv</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Pilih File -->
                    <div>
                        <label class="block font-label-md text-label-md font-semibold text-text-primary mb-1">
                            Langkah 2: Pilih File Excel / CSV yang Ingin Diunggah
                        </label>
                        <div class="border-2 border-dashed border-border-medium rounded-xl p-6 text-center hover:border-gov-green transition-colors bg-surface-subtle/50 relative">
                            <input type="file" name="file" accept=".xlsx,.xls,.csv" required onchange="handleFileChosenPendamping(this)"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            
                            <div class="flex flex-col items-center justify-center">
                                <span class="material-symbols-outlined text-[36px] text-text-secondary mb-2">cloud_upload</span>
                                <div id="fileNamePreviewPendamping" class="text-xs font-semibold text-text-primary">Klik atau seret file ke sini</div>
                                <p class="text-[11px] text-text-secondary mt-1">
                                    Mendukung format <strong>.xlsx</strong>, <strong>.xls</strong>, atau <strong>.csv</strong> (Maksimal 10 MB)
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Opsi Penanganan Duplikasi -->
                    <div>
                        <label class="block font-label-md text-label-md font-semibold text-text-primary mb-2">
                            Langkah 3: Proteksi Anti-Duplikasi Data (Jika NIK / No. KK Sudah Terdaftar):
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-sm">
                            <label class="border border-border-light rounded-xl p-3 flex items-start gap-3 cursor-pointer hover:bg-surface-subtle transition-colors has-[:checked]:border-gov-green has-[:checked]:bg-gov-green-surface/20">
                                <input type="radio" name="duplicate_mode" value="skip" checked class="mt-1 text-gov-green focus:ring-gov-green">
                                <div>
                                    <span class="font-semibold text-xs text-text-primary block">Lewati &amp; Lindungi (Skip)</span>
                                    <span class="text-[11px] text-text-secondary block mt-0.5">
                                        Hanya tambahkan data warga baru. NIK / KK yang sudah ada dalam database atau baris sebelumnya akan dilewati tanpa membuat duplikat.
                                    </span>
                                </div>
                            </label>
                            <label class="border border-border-light rounded-xl p-3 flex items-start gap-3 cursor-pointer hover:bg-surface-subtle transition-colors has-[:checked]:border-gov-green has-[:checked]:bg-gov-green-surface/20">
                                <input type="radio" name="duplicate_mode" value="update" class="mt-1 text-gov-green focus:ring-gov-green">
                                <div>
                                    <span class="font-semibold text-xs text-text-primary block">Perbarui Data (Update)</span>
                                    <span class="text-[11px] text-text-secondary block mt-0.5">
                                        Data profil, indikator penilaian, dan tolak ukur pendapatan warga yang cocok diperbarui dengan data file tanpa membuat baris baru.
                                    </span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Catatan Otomasi Sistem -->
                    <div class="p-3 bg-surface-container rounded-xl text-[11px] text-text-secondary space-y-1">
                        <div class="font-semibold text-text-primary flex items-center gap-1">
                            <span class="material-symbols-outlined text-[15px] text-blue-700">info</span>
                            <span>Ketentuan Otomatisasi Sistem:</span>
                        </div>
                        <p>• Akun login keluarga penerima bantuan akan otomatis dibuat (Email: <code class="bg-canvas-bg px-1 rounded">NIK@penerima.com</code>, Password default: <code class="bg-canvas-bg px-1 rounded">No. KK</code>).</p>
                        <p>• Data yang diimpor akan otomatis terhubung ke akun Anda sebagai Pendamping Lapangan.</p>
                        <p>• Keluarga dengan tolak ukur terpenuhi dan surplus finansial positif akan otomatis berstatus <strong>Mandiri</strong>.</p>
                        <p>• Seluruh proses impor akan tercatat pada <strong>Audit Log Sistem</strong>.</p>
                    </div>
                </div>

                <!-- Footer Modal -->
                <div class="p-space-lg border-t border-border-light bg-surface-subtle flex items-center justify-end gap-space-sm">
                    <button type="button" onclick="closeImportModalPendamping()" class="px-4 py-2 rounded-xl border border-border-medium text-text-secondary hover:bg-surface-container font-label-md text-label-md transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="inline-flex items-center gap-1.5 px-space-lg py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">publish</span>
                        <span>Unggah &amp; Proses Impor</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script Interaktif Modal & Dropdown Pendamping -->
<script>
    function openImportModalPendamping() {
        const modal = document.getElementById('modalImportDataPendamping');
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeImportModalPendamping() {
        const modal = document.getElementById('modalImportDataPendamping');
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }
    }

    function toggleExportDropdownPendamping() {
        const menu = document.getElementById('exportDropdownMenuPendamping');
        const arrow = document.getElementById('iconExportArrowPendamping');
        if (menu) {
            menu.classList.toggle('hidden');
            if (arrow) {
                arrow.classList.toggle('rotate-180');
            }
        }
    }

    function closeExportDropdownPendamping() {
        const menu = document.getElementById('exportDropdownMenuPendamping');
        const arrow = document.getElementById('iconExportArrowPendamping');
        if (menu && !menu.classList.contains('hidden')) {
            menu.classList.add('hidden');
            if (arrow) arrow.classList.remove('rotate-180');
        }
    }

    function handleFileChosenPendamping(input) {
        const preview = document.getElementById('fileNamePreviewPendamping');
        if (input.files && input.files[0]) {
            preview.textContent = 'File dipilih: ' + input.files[0].name;
            preview.className = 'text-xs font-bold text-emerald-700';
        } else {
            preview.textContent = 'Klik atau seret file ke sini';
            preview.className = 'text-xs font-semibold text-text-primary';
        }
    }

    // Escape listener
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' || e.keyCode === 27) {
            closeImportModalPendamping();
            closeExportDropdownPendamping();
        }
    });

    // Outside click listener
    document.addEventListener('click', function(e) {
        const btn = document.getElementById('btnExportDropdownPendamping');
        const menu = document.getElementById('exportDropdownMenuPendamping');
        if (btn && menu && !btn.contains(e.target) && !menu.contains(e.target)) {
            closeExportDropdownPendamping();
        }
    });
</script>
@endsection
