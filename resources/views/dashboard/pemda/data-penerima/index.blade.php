@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl" x-data="{ showImportModal: false, showExportMenu: false, fileName: '' }">
    <!-- Header Page -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <div class="flex items-center gap-space-xs text-text-secondary font-label-md text-label-md mb-1">
                <span>Dashboard Bappeda</span>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="text-text-primary font-semibold">Data Penerima (CPCL)</span>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Data Penerima (CPCL)</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Calon Penerima Calon Lokasi (CPCL) yang telah divalidasi dan ditetapkan sebagai penerima bantuan sosial Kabupaten Sumbawa.
            </p>
        </div>

        <!-- Action Buttons: Ekspor, Impor, Tambah -->
        <div class="flex flex-wrap items-center gap-space-sm">
            <!-- Dropdown Ekspor Data -->
            <div class="relative">
                <button id="btnExportDropdown" onclick="toggleExportDropdown()" type="button" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-surface-container-low hover:bg-surface-container text-text-primary border border-border-medium font-label-md text-label-md font-semibold transition-all shadow-2xs">
                    <span class="material-symbols-outlined text-[20px] text-emerald-700">file_download</span>
                    <span>Ekspor Data</span>
                    <span class="material-symbols-outlined text-[16px] text-text-secondary transition-transform duration-200" id="iconExportArrow">expand_more</span>
                </button>

                <div id="exportDropdownMenu" class="hidden absolute right-0 mt-2 w-56 rounded-xl bg-canvas-bg shadow-xl border border-border-light py-2 z-30">
                    <div class="px-3 py-1.5 text-[11px] font-bold text-text-secondary uppercase tracking-wider border-b border-border-light">
                        Pilih Format Ekspor
                    </div>
                    <a href="{{ route('pemda.data-penerima.export', array_merge(request()->query(), ['format' => 'xlsx'])) }}" class="flex items-center gap-2 px-4 py-2.5 text-xs text-text-primary hover:bg-surface-subtle transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-emerald-700">table_view</span>
                        <div>
                            <div class="font-semibold">Microsoft Excel (.xlsx)</div>
                            <div class="text-[11px] text-text-secondary">Lengkap dengan format cell rapi</div>
                        </div>
                    </a>
                    <a href="{{ route('pemda.data-penerima.export', array_merge(request()->query(), ['format' => 'csv'])) }}" class="flex items-center gap-2 px-4 py-2.5 text-xs text-text-primary hover:bg-surface-subtle transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-blue-700">text_snippet</span>
                        <div>
                            <div class="font-semibold">File CSV (.csv)</div>
                            <div class="text-[11px] text-text-secondary">Kompatibel UTF-8 BOM</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Tombol Impor Data (Buka Modal) -->
            <button id="btnOpenImportModal" onclick="openImportModal()" type="button" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-surface-container-low hover:bg-surface-container text-text-primary border border-border-medium font-label-md text-label-md font-semibold transition-all shadow-2xs">
                <span class="material-symbols-outlined text-[20px] text-blue-700">file_upload</span>
                <span>Impor Data</span>
            </button>

            <!-- Tombol Tambah Penerima Single -->
            <a href="{{ route('pemda.data-penerima.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add</span>
                <span>Tambah Penerima</span>
            </a>
        </div>
    </div>

    <!-- Alert Sukses / Error -->
    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20 flex items-start gap-2">
            <span class="material-symbols-outlined text-[20px] shrink-0 text-emerald-700">check_circle</span>
            <div class="flex-1">
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 text-red-800 p-space-md rounded-xl font-body-sm border border-red-200 flex items-start gap-2">
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
                    <span>Terdapat {{ count(session('import_errors')) }} catatan baris data yang dilewati / error saat impor:</span>
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

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-lg">
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-gov-green-surface flex items-center justify-center text-primary shrink-0">
                <span class="material-symbols-outlined text-[26px]">how_to_reg</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-semibold">Penerima Bantuan Aktif</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ number_format($countAktif, 0, ',', '.') }} KK</span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Desil 1 s/d Desil 5</span>
            </div>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-800 shrink-0">
                <span class="material-symbols-outlined text-[26px]">workspace_premium</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-semibold">Telah Mandiri (Lulus)</span>
                <span class="font-headline-md text-headline-md text-emerald-800 font-bold block">{{ number_format($countMandiri, 0, ',', '.') }} KK</span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Desil 6+ (Otomatis Lulus)</span>
            </div>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-800 shrink-0">
                <span class="material-symbols-outlined text-[26px]">groups</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-semibold">Total Terdaftar</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ number_format($totalSemua, 0, ',', '.') }} KK</span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Seluruh Basis Data</span>
            </div>
        </div>
    </div>

    <!-- Filter & Toolbar Pencarian -->
    <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light">
        <form method="GET" action="{{ route('pemda.data-penerima.index') }}" class="flex flex-col lg:flex-row gap-space-md items-end">
            <input type="hidden" name="tab" value="{{ $tab }}">

            <!-- Input Cari Kata Kunci -->
            <div class="flex-1 w-full">
                <label for="search" class="font-label-sm text-label-sm text-text-secondary block mb-1">Cari Nama Kepala Keluarga / NIK / No. KK</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary text-[20px]">search</span>
                    <input type="text" id="search" name="search" value="{{ $search }}" placeholder="Ketik NIK, Nomor KK, nama warga, atau alamat..."
                        class="w-full pl-10 pr-4 py-2 border border-border-light rounded-xl font-body-sm text-text-primary focus:outline-none focus:border-gov-green focus:ring-1 focus:ring-gov-green transition-all">
                </div>
            </div>

            <!-- Filter Wilayah / Desa -->
            <div class="w-full lg:w-56">
                <label for="wilayah_id" class="font-label-sm text-label-sm text-text-secondary block mb-1">Wilayah / Desa</label>
                <select id="wilayah_id" name="wilayah_id" class="w-full py-2 px-3 border border-border-light rounded-xl font-body-sm text-text-primary focus:outline-none focus:border-gov-green focus:ring-1 focus:ring-gov-green">
                    <option value="">-- Semua Desa --</option>
                    @foreach($wilayahs as $w)
                        <option value="{{ $w->id }}" {{ $wilayahId == $w->id ? 'selected' : '' }}>
                            {{ $w->nama }} {{ $w->parent ? '(' . $w->parent->nama . ')' : '' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Program Bantuan -->
            <div class="w-full lg:w-64">
                <label for="program_bantuan_id" class="font-label-sm text-label-sm text-text-secondary block mb-1">Program Bantuan</label>
                <select id="program_bantuan_id" name="program_bantuan_id" class="w-full py-2 px-3 border border-border-light rounded-xl font-body-sm text-text-primary focus:outline-none focus:border-gov-green focus:ring-1 focus:ring-gov-green">
                    <option value="">-- Semua Program --</option>
                    @foreach($programs as $prog)
                        <option value="{{ $prog->id }}" {{ $programId == $prog->id ? 'selected' : '' }}>
                            {{ $prog->nama_program }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Filter & Reset -->
            <div class="flex items-center gap-space-xs w-full lg:w-auto">
                <button type="submit" class="w-full lg:w-auto inline-flex items-center justify-center gap-1.5 px-space-md py-2 bg-primary-container text-on-primary rounded-xl font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">filter_alt</span>
                    <span>Filter</span>
                </button>
                @if($search || $wilayahId || $programId)
                    <a href="{{ route('pemda.data-penerima.index', ['tab' => $tab]) }}" class="w-full lg:w-auto inline-flex items-center justify-center gap-1 px-3 py-2 border border-border-medium text-text-secondary hover:bg-surface-subtle rounded-xl font-label-md text-label-md transition-colors" title="Reset Filter">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                        <span>Reset</span>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Navigation Tabs: Penerima Bantuan Aktif vs Lulus Mandiri vs Semua -->
    <div class="flex items-center gap-2 border-b border-border-light pb-2">
        <a href="{{ route('pemda.data-penerima.index', array_merge(request()->except('tab', 'page'), ['tab' => 'aktif'])) }}" 
           class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 {{ $tab === 'aktif' ? 'bg-primary text-white shadow-sm' : 'bg-surface-subtle text-text-secondary hover:text-text-primary' }}">
            <span class="material-symbols-outlined text-[16px]">verified</span>
            <span>Penerima Bantuan Aktif</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $tab === 'aktif' ? 'bg-white/20 text-white' : 'bg-primary/10 text-primary font-bold' }}">{{ $countAktif }}</span>
        </a>
        <a href="{{ route('pemda.data-penerima.index', array_merge(request()->except('tab', 'page'), ['tab' => 'mandiri'])) }}" 
           class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 {{ $tab === 'mandiri' ? 'bg-emerald-700 text-white shadow-sm' : 'bg-surface-subtle text-text-secondary hover:text-text-primary' }}">
            <span class="material-symbols-outlined text-[16px]">workspace_premium</span>
            <span>Lulus Mandiri (Desil 6+)</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $tab === 'mandiri' ? 'bg-white/20 text-white' : 'bg-emerald-100 text-emerald-800 font-bold' }}">{{ $countMandiri }}</span>
        </a>
        <a href="{{ route('pemda.data-penerima.index', array_merge(request()->except('tab', 'page'), ['tab' => 'semua'])) }}" 
           class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 {{ $tab === 'semua' ? 'bg-gray-800 text-white shadow-sm' : 'bg-surface-subtle text-text-secondary hover:text-text-primary' }}">
            <span class="material-symbols-outlined text-[16px]">list_alt</span>
            <span>Semua Basis Data</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $tab === 'semua' ? 'bg-white/20 text-white' : 'bg-surface-container text-text-secondary font-bold' }}">{{ $totalSemua }}</span>
        </a>
    </div>

    <!-- Table Data Penerima -->
    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="p-space-md border-b border-border-light bg-surface-subtle flex items-center justify-between">
            <span class="text-xs font-bold text-text-primary uppercase tracking-wider">
                @if($tab === 'mandiri')
                    Daftar Keluarga Telah Mandiri / Lulus Bantuan (Desil 6 ke atas)
                @elseif($tab === 'aktif')
                    Daftar Penerima Bantuan Aktif (Belum Mandiri / Desil 1 s/d 5)
                @else
                    Seluruh Basis Data Keluarga Penerima (Aktif & Mandiri)
                @endif
            </span>
            <span class="text-xs text-text-secondary font-medium">
                Menampilkan {{ $keluarga_penerimas->count() }} data (Total: {{ $keluarga_penerimas->total() }})
            </span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">NIK &amp; Kepala Keluarga</th>
                        <th class="py-3 px-4 font-semibold">No. KK</th>
                        <th class="py-3 px-4 font-semibold">Wilayah</th>
                        <th class="py-3 px-4 font-semibold">Desil &amp; Status</th>
                        <th class="py-3 px-4 font-semibold">Program Bantuan</th>
                        <th class="py-3 px-4 font-semibold">Validasi</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($keluarga_penerimas as $keluarga_penerima)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4">
                            <span class="font-semibold text-text-primary block">{{ $keluarga_penerima->kepala_keluarga }}</span>
                            <span class="text-text-tertiary font-code-dense text-[12px]">{{ $keluarga_penerima->nik }}</span>
                        </td>
                        <td class="py-3.5 px-4 font-code-dense text-text-primary text-xs">{{ $keluarga_penerima->no_kk ?? '-' }}</td>
                        <td class="py-3.5 px-4 text-text-primary">
                            <div>{{ $keluarga_penerima->wilayah->nama ?? '-' }}</div>
                            <div class="text-[11px] text-text-secondary">{{ $keluarga_penerima->wilayah->parent->nama ?? '' }}</div>
                        </td>
                        <td class="py-3.5 px-4">
                            @if($keluarga_penerima->desil >= 6 || strtolower($keluarga_penerima->status_kemandirian ?? '') === 'mandiri')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                    Desil {{ $keluarga_penerima->desil }} • Mandiri
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-gov-green-surface text-primary border border-primary/20">
                                    Desil {{ $keluarga_penerima->desil }} • Aktif
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-text-primary text-xs">
                            <span class="font-medium block">{{ $keluarga_penerima->programBantuan->nama_program ?? '-' }}</span>
                            @if($keluarga_penerima->pendamping)
                                <span class="text-[11px] text-text-secondary">Pendamping: {{ $keluarga_penerima->pendamping->name }}</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            @if ($keluarga_penerima->status_validasi == 'valid')
                                <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-verified-surface text-primary font-bold">Valid</span>
                            @elseif ($keluarga_penerima->status_validasi == 'anomali')
                                <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-fraud-surface text-status-fraud font-bold">Anomali</span>
                            @else
                                <span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-warning-surface text-status-warning font-bold">Proses</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('pemda.data-penerima.show', $keluarga_penerima->id) }}" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-surface-container-low hover:bg-surface-container-high text-text-secondary hover:text-text-primary text-xs font-semibold border border-border-light transition-colors" title="Lihat Profil">
                                    <span class="material-symbols-outlined text-[16px]">visibility</span>
                                    <span>Detail</span>
                                </a>
                                <a href="{{ route('pemda.data-penerima.edit', $keluarga_penerima->id) }}" class="inline-flex items-center p-1.5 text-text-secondary hover:text-primary hover:bg-gov-green-surface rounded-lg border border-border-light transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[16px]">edit</span>
                                </a>
                                <form action="{{ route('pemda.data-penerima.destroy', $keluarga_penerima->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus penerima ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center p-1.5 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg border border-red-200 transition-colors" title="Hapus">
                                        <span class="material-symbols-outlined text-[16px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-text-secondary">
                            <span class="material-symbols-outlined text-[48px] text-border-medium mb-2 block">inbox</span>
                            <p class="font-body-md font-semibold">Belum ada data penerima bantuan.</p>
                            <p class="font-body-sm text-text-secondary mt-1">Anda dapat menambahkan secara manual atau menggunakan tombol <strong>Impor Data</strong>.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginasi Tabel -->
        @if($keluarga_penerimas->hasPages())
            <div class="p-space-md border-t border-border-light bg-surface-subtle/40 flex items-center justify-between">
                <div class="font-label-sm text-xs text-text-secondary">
                    Menampilkan <strong>{{ $keluarga_penerimas->firstItem() }}</strong> - <strong>{{ $keluarga_penerimas->lastItem() }}</strong> dari <strong>{{ $keluarga_penerimas->total() }}</strong> keluarga penerima
                </div>
                <div>
                    {{ $keluarga_penerimas->links() }}
                </div>
            </div>
        @endif
    </div>

    <!-- MODAL IMPOR DATA (Excel / CSV) -->
    <div id="modalImportData" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Backdrop (Klik backdrop untuk menutup modal) -->
            <div id="modalImportBackdrop" onclick="closeImportModal()" class="fixed inset-0 bg-gray-900/60 backdrop-blur-xs transition-opacity cursor-pointer"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal Dialog Content -->
            <div class="inline-block align-bottom bg-canvas-bg rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-border-light relative z-10">
                <form action="{{ route('pemda.data-penerima.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Header Modal -->
                    <div class="p-space-lg border-b border-border-light flex items-center justify-between bg-surface-subtle">
                        <div class="flex items-center gap-space-sm">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center">
                                <span class="material-symbols-outlined text-[24px]">file_upload</span>
                            </div>
                            <div>
                                <h3 class="font-headline-sm text-headline-sm font-bold text-text-primary" id="modal-title">
                                    Impor Data Penerima Bantuan
                                </h3>
                                <p class="text-xs text-text-secondary mt-0.5">
                                    Unggah file spreadsheet Excel (.xlsx) atau CSV (.csv) untuk memperbarui data massal.
                                </p>
                            </div>
                        </div>
                        <button type="button" onclick="closeImportModal()" class="text-text-secondary hover:text-text-primary p-2 rounded-xl hover:bg-surface-container transition-colors" title="Tutup Modal (Esc)">
                            <span class="material-symbols-outlined text-[22px]">close</span>
                        </button>
                    </div>

                    <!-- Body Modal -->
                    <div class="p-space-lg flex flex-col gap-space-lg">
                        <!-- Step 1: Download Template -->
                        <div class="bg-emerald-50/70 border border-emerald-200 rounded-xl p-4">
                            <div class="flex items-start justify-between gap-space-md">
                                <div class="flex items-start gap-2.5">
                                    <span class="material-symbols-outlined text-emerald-700 text-[22px] shrink-0 mt-0.5">download_for_offline</span>
                                    <div>
                                        <div class="font-semibold text-xs text-emerald-950">Langkah 1: Unduh Format Template Standar</div>
                                        <p class="text-[11px] text-emerald-800 mt-0.5">
                                            Gunakan template resmi Bappeda untuk memastikan kolom NIK, No. KK, nama desa, dan program bantuan terbaca dengan akurat.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    <a href="{{ route('pemda.data-penerima.template', ['format' => 'xlsx']) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold shadow-xs transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">table_view</span>
                                        <span>Template Excel</span>
                                    </a>
                                    <a href="{{ route('pemda.data-penerima.template', ['format' => 'csv']) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-white hover:bg-emerald-100 text-emerald-800 border border-emerald-300 text-xs font-semibold transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">text_snippet</span>
                                        <span>CSV</span>
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
                                <input type="file" name="file" accept=".xlsx,.xls,.csv" required onchange="handleFileChosen(this)"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                
                                <div class="flex flex-col items-center justify-center">
                                    <span class="material-symbols-outlined text-[36px] text-text-secondary mb-2">cloud_upload</span>
                                    <div id="fileNamePreview" class="text-xs font-semibold text-text-primary">Klik atau seret file ke sini</div>
                                    <p class="text-[11px] text-text-secondary mt-1">
                                        Mendukung format <strong>.xlsx</strong>, <strong>.xls</strong>, atau <strong>.csv</strong> (Maksimal 10 MB)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Opsi Penanganan Duplikasi -->
                        <div>
                            <label class="block font-label-md text-label-md font-semibold text-text-primary mb-2">
                                Langkah 3: Jika Data NIK / No. KK Sudah Ada di Database:
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-sm">
                                <label class="border border-border-light rounded-xl p-3 flex items-start gap-3 cursor-pointer hover:bg-surface-subtle transition-colors has-[:checked]:border-gov-green has-[:checked]:bg-gov-green-surface/20">
                                    <input type="radio" name="duplicate_mode" value="update" checked class="mt-1 text-gov-green focus:ring-gov-green">
                                    <div>
                                        <span class="font-semibold text-xs text-text-primary block">Perbarui Data (Update)</span>
                                        <span class="text-[11px] text-text-secondary block mt-0.5">
                                            Data profil, desil, dan alamat warga yang cocok akan diperbarui dengan data dari file.
                                        </span>
                                    </div>
                                </label>
                                <label class="border border-border-light rounded-xl p-3 flex items-start gap-3 cursor-pointer hover:bg-surface-subtle transition-colors has-[:checked]:border-gov-green has-[:checked]:bg-gov-green-surface/20">
                                    <input type="radio" name="duplicate_mode" value="skip" class="mt-1 text-gov-green focus:ring-gov-green">
                                    <div>
                                        <span class="font-semibold text-xs text-text-primary block">Lewati (Skip)</span>
                                        <span class="text-[11px] text-text-secondary block mt-0.5">
                                            Hanya tambahkan data warga baru. NIK yang sudah ada akan dilewati tanpa diubah.
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
                            <p>• Akun login penerima bantuan akan otomatis dibuat (Email: <code class="bg-canvas-bg px-1 rounded">NIK@penerima.com</code>, Password default: <code class="bg-canvas-bg px-1 rounded">No. KK</code>).</p>
                            <p>• Keluarga dengan nilai desil 6 atau lebih tinggi akan otomatis ditetapkan berstatus <strong>Mandiri</strong>.</p>
                            <p>• Seluruh proses impor akan tercatat pada <strong>Audit Log Sistem Bappeda</strong>.</p>
                        </div>
                    </div>

                    <!-- Footer Modal -->
                    <div class="p-space-lg border-t border-border-light bg-surface-subtle flex items-center justify-end gap-space-sm">
                        <button type="button" onclick="closeImportModal()" class="px-4 py-2 rounded-xl border border-border-medium text-text-secondary hover:bg-surface-container font-label-md text-label-md transition-colors">
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
</div>

<!-- Script Interaktif Modal & Dropdown -->
<script>
    function openImportModal() {
        const modal = document.getElementById('modalImportData');
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeImportModal() {
        const modal = document.getElementById('modalImportData');
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }
    }

    function toggleExportDropdown() {
        const menu = document.getElementById('exportDropdownMenu');
        const arrow = document.getElementById('iconExportArrow');
        if (menu) {
            menu.classList.toggle('hidden');
            if (arrow) {
                arrow.classList.toggle('rotate-180');
            }
        }
    }

    function closeExportDropdown() {
        const menu = document.getElementById('exportDropdownMenu');
        const arrow = document.getElementById('iconExportArrow');
        if (menu && !menu.classList.contains('hidden')) {
            menu.classList.add('hidden');
            if (arrow) arrow.classList.remove('rotate-180');
        }
    }

    function handleFileChosen(input) {
        const preview = document.getElementById('fileNamePreview');
        if (input.files && input.files[0]) {
            preview.textContent = 'File dipilih: ' + input.files[0].name;
            preview.className = 'text-xs font-bold text-emerald-700';
        } else {
            preview.textContent = 'Klik atau seret file ke sini';
            preview.className = 'text-xs font-semibold text-text-primary';
        }
    }

    // Event listener tombol Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' || e.keyCode === 27) {
            closeImportModal();
            closeExportDropdown();
        }
    });

    // Event listener klik di luar dropdown ekspor
    document.addEventListener('click', function(e) {
        const btn = document.getElementById('btnExportDropdown');
        const menu = document.getElementById('exportDropdownMenu');
        if (btn && menu && !btn.contains(e.target) && !menu.contains(e.target)) {
            closeExportDropdown();
        }
    });
</script>
@endsection
