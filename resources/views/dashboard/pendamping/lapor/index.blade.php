@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-gov-green-surface text-primary border border-primary/20 flex items-center gap-1">
                    <span class="material-symbols-outlined text-[13px]">verified</span>
                    Data Monitoring Terkini
                </span>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Laporan Kunjungan Lapangan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Menampilkan catatan laporan kunjungan dan pemantauan perkembangan bantuan untuk setiap keluarga penerima bantuan. Riwayat kunjungan sebelumnya tersimpan dan dapat dilihat pada detail laporan.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <a href="{{ route('pendamping.lapor.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2.5 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add_location_alt</span>
                <span>+ Input Kunjungan Baru</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20 flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- FILTER PERIODE WAKTU (Hari, Minggu, Bulan, Tahun, Rentang Kustom) -->
    <x-period-filter :periodInfo="$periodInfo" label="Pilih Periode Kunjungan:" />

    <!-- Search & Filter Card -->
    <div class="bg-canvas-bg rounded-2xl p-space-lg shadow-sm border border-border-light flex flex-col gap-space-md">
        <form id="filterForm" action="{{ route('pendamping.lapor.index') }}" method="GET" class="flex flex-col lg:flex-row lg:items-center gap-space-md">
            @if(request('start_date'))
                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
            @endif
            @if(request('end_date'))
                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
            @endif
            @if(request('periode'))
                <input type="hidden" name="periode" value="{{ request('periode') }}">
            @endif
            @if(request('bulan'))
                <input type="hidden" name="bulan" value="{{ request('bulan') }}">
            @endif
            @if(request('tahun'))
                <input type="hidden" name="tahun" value="{{ request('tahun') }}">
            @endif
            <!-- Search Input: Nama Penerima atau Wilayah -->
            <div class="flex-1 relative">
                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-text-secondary text-[20px]">search</span>
                <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                    placeholder="Cari nama penerima, NIK, atau nama wilayah (desa/kecamatan)..."
                    class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                @if(request('search'))
                    <a href="{{ route('pendamping.lapor.index', array_merge(request()->except('search'))) }}" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-text-tertiary hover:text-text-primary" title="Hapus pencarian">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </a>
                @endif
            </div>

            <div class="flex flex-wrap items-center gap-space-sm">
                <!-- Filter Desa -->
                <div class="relative min-w-[200px]">
                    <select name="desa_id" id="desaSelect" onchange="this.form.submit()"
                        class="searchable-select appearance-none w-full pl-3.5 pr-9 py-2.5 rounded-xl border border-border-medium bg-surface-subtle text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary cursor-pointer transition-all">
                        <option value="">-- Semua Desa --</option>
                        @foreach ($desas as $d)
                            <option value="{{ $d->id }}" 
                                data-subtext="{{ $d->parent ? 'Kec. ' . $d->parent->nama : '' }}"
                                {{ request('desa_id') == $d->id ? 'selected' : '' }}>
                                Desa {{ $d->nama }}
                            </option>
                        @endforeach
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-text-secondary pointer-events-none text-[18px]">expand_more</span>
                </div>

                <!-- Filter Program Kampus -->
                <div class="relative min-w-[200px]">
                    <select name="program_id" onchange="this.form.submit()"
                        class="appearance-none w-full pl-3.5 pr-9 py-2.5 rounded-xl border border-border-medium bg-surface-subtle text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary cursor-pointer transition-all">
                        <option value="">-- Semua Program Kampus --</option>
                        @foreach ($programs as $prog)
                            <option value="{{ $prog->id }}" {{ request('program_id') == $prog->id ? 'selected' : '' }}>
                                {{ $prog->nama_program }}
                            </option>
                        @endforeach
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-text-secondary pointer-events-none text-[18px]">expand_more</span>
                </div>

                <!-- Filter Kondisi -->
                <div class="relative min-w-[170px]">
                    <select name="status_kondisi" onchange="this.form.submit()"
                        class="appearance-none w-full pl-3.5 pr-9 py-2.5 rounded-xl border border-border-medium bg-surface-subtle text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary cursor-pointer transition-all">
                        <option value="">-- Semua Kondisi --</option>
                        <option value="normal" {{ request('status_kondisi') == 'normal' ? 'selected' : '' }}>Normal / Sehat</option>
                        <option value="hama" {{ request('status_kondisi') == 'hama' ? 'selected' : '' }}>Terkena Hama</option>
                        <option value="gagal" {{ request('status_kondisi') == 'gagal' ? 'selected' : '' }}>Gagal / Mati</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-text-secondary pointer-events-none text-[18px]">expand_more</span>
                </div>

                <!-- Tombol Submit & Reset -->
                <button type="submit" class="px-space-md py-2.5 rounded-xl bg-primary text-white font-label-md text-xs font-semibold hover:bg-gov-green-dark transition-colors shadow-sm flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px]">search</span>
                    <span>Cari</span>
                </button>

                @if(request('search') || request('desa_id') || request('program_id') || request('status_kondisi'))
                    <a href="{{ route('pendamping.lapor.index') }}" class="px-space-md py-2.5 rounded-xl bg-surface-container-high hover:bg-surface-container-highest text-text-secondary hover:text-text-primary font-label-md text-xs font-semibold transition-colors border border-border-light flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">refresh</span>
                        <span>Reset</span>
                    </a>
                @endif
            </div>
        </form>


        <!-- Info Keterangan Pemisahan Laporan Per Program -->
        <div class="p-3 bg-gov-green-surface/40 rounded-xl border border-primary/20 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs text-text-secondary">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[18px]">verified</span>
                <span>Setiap baris mencatat perkembangan <strong>khusus per program bantuan</strong>. Jika satu keluarga menerima bantuan dari beberapa program berbeda, laporannya <strong>tersimpan terpisah dan tidak saling menindih</strong>.</span>
            </div>
            <span class="font-bold text-primary shrink-0">Total: {{ $laporans->count() }} Monitoring Aktif</span>
        </div>
    </div>

    <!-- Active Filter Feedback -->
    @if(request('search') || request('desa_id') || request('status_kondisi'))
        <div class="flex items-center justify-between text-xs text-text-secondary px-1">
            <div class="flex items-center gap-2">
                <span>Hasil pencarian: <strong>{{ $laporans->count() }}</strong> keluarga penerima ditemukan</span>
                @if(request('search'))
                    <span class="px-2 py-0.5 rounded bg-surface-container-high text-text-primary">Kata kunci: "{{ request('search') }}"</span>
                @endif
                @if(request('desa_id'))
                    @php $currDesa = $desas->firstWhere('id', request('desa_id')); @endphp
                    <span class="px-2 py-0.5 rounded bg-gov-green-surface text-primary font-semibold">Wilayah: Desa {{ $currDesa->nama ?? '-' }}</span>
                @endif
            </div>
            <a href="{{ route('pendamping.lapor.index') }}" class="text-primary hover:underline font-semibold">Tampilkan Semua</a>
        </div>
    @endif

    @php
        $bantuanBelumDipantau = $bantuansTersalurkan->filter(fn($b) => !$b->latestPerkembangan);
    @endphp
    @if($bantuanBelumDipantau->isNotEmpty())
        <!-- Banner Proaktif: Bantuan Baru yang Belum Dipantau -->
        <div class="bg-gradient-to-r from-amber-500/10 via-amber-50 to-orange-50 border border-amber-300 rounded-2xl p-space-md shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-xs">
                    <span class="material-symbols-outlined text-[22px]">notification_important</span>
                </div>
                <div>
                    <h4 class="font-bold text-xs sm:text-sm text-amber-900">
                        {{ $bantuanBelumDipantau->count() }} Bantuan Baru Tersalurkan Belum Pernah Dipantau
                    </h4>
                    <p class="text-[11px] text-amber-800 mt-0.5">
                        Terdapat bantuan yang telah diserahkan ke keluarga penerima bantuan namun belum memiliki catatan laporan kunjungan.
                    </p>
                </div>
            </div>
            <a href="{{ route('pendamping.pantau-penyaluran.index') }}" class="px-3.5 py-1.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs transition-all shrink-0 self-start sm:self-auto shadow-sm flex items-center gap-1">
                <span>Pantau Penyaluran</span>
                <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
            </a>
        </div>
    @endif

    <!-- Table Card -->
    <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm" id="laporanTable">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3.5 px-4 font-semibold">Kunjungan Terakhir</th>
                        <th class="py-3.5 px-4 font-semibold">Wilayah (Desa)</th>
                        <th class="py-3.5 px-4 font-semibold">Nama Penerima</th>
                        <th class="py-3.5 px-4 font-semibold">Program Kampus</th>
                        <th class="py-3.5 px-4 font-semibold">Bantuan yang Dipantau</th>
                        <th class="py-3.5 px-4 font-semibold">Kondisi Perkembangan</th>
                        <th class="py-3.5 px-4 font-semibold">Catatan Lapangan</th>
                        <th class="py-3.5 px-4 text-right font-semibold">Histori & Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg" id="laporanTableBody">
                    @forelse ($laporans as $laporan)
                    @php
                        $totalHistoriKunjungan = $laporan->keluarga_penerima && $laporan->keluarga_penerima->laporanTumbuhKembangs ? $laporan->keluarga_penerima->laporanTumbuhKembangs->count() : 1;
                        $prog = $laporan->programBantuan ?? ($laporan->penyaluranBantuan->programBantuan ?? $laporan->keluarga_penerima->programBantuan ?? null);
                    @endphp
                    <tr class="hover:bg-surface-subtle transition-colors group laporan-row"
                        data-penerima="{{ strtolower($laporan->keluarga_penerima->kepala_keluarga ?? '') }}"
                        data-nik="{{ $laporan->keluarga_penerima->nik ?? '' }}"
                        data-wilayah="{{ strtolower($laporan->keluarga_penerima->wilayah->nama ?? '') }}"
                        data-kecamatan="{{ strtolower($laporan->keluarga_penerima->wilayah->parent->nama ?? '') }}">
                        
                        <!-- Kunjungan Terakhir -->
                        <td class="py-3.5 px-4 text-text-primary whitespace-nowrap">
                            <div class="flex flex-col gap-1">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-primary text-white w-fit shadow-xs">
                                    <span class="material-symbols-outlined text-[12px]">verified</span>
                                    <span>Kunjungan Terakhir</span>
                                </span>
                                <div class="flex items-center gap-1.5 font-semibold text-sm">
                                    <span class="material-symbols-outlined text-[16px] text-text-tertiary">calendar_today</span>
                                    <span>{{ \Carbon\Carbon::parse($laporan->tanggal_lapor)->format('d M Y') }}</span>
                                </div>
                            </div>
                        </td>

                        <!-- Wilayah Desa -->
                        <td class="py-3.5 px-4 text-text-primary">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-gov-green-surface text-primary border border-primary/20">
                                <span class="material-symbols-outlined text-[14px]">location_on</span>
                                <span>Desa {{ $laporan->keluarga_penerima->wilayah->nama ?? '-' }}</span>
                            </span>
                            @if(isset($laporan->keluarga_penerima->wilayah->parent))
                                <span class="block text-[11px] text-text-tertiary mt-0.5">
                                    Kec. {{ $laporan->keluarga_penerima->wilayah->parent->nama }}
                                </span>
                            @endif
                        </td>

                        <!-- Keluarga Penerima -->
                        <td class="py-3.5 px-4 text-text-primary">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-surface-muted text-primary flex items-center justify-center font-bold text-xs shrink-0 border border-border-light">
                                    {{ strtoupper(substr($laporan->keluarga_penerima->kepala_keluarga ?? $laporan->keluarga_penerima->nama ?? 'P', 0, 1)) }}
                                </div>
                                <div>
                                    <span class="font-bold text-text-primary block text-sm">
                                        {{ $laporan->keluarga_penerima->kepala_keluarga ?? $laporan->keluarga_penerima->nama ?? '-' }}
                                    </span>
                                    <span class="text-text-tertiary font-mono text-[11px]">
                                        NIK: {{ $laporan->keluarga_penerima->nik ?? '-' }}
                                    </span>
                                </div>
                            </div>
                        </td>

                        <!-- Program Kampus yang Dipantau -->
                        <td class="py-3.5 px-4 text-text-primary max-w-[200px]">
                            @if($prog)
                                <div class="flex flex-col gap-0.5">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-lg text-xs font-bold bg-blue-50 text-blue-800 border border-blue-200 w-fit" title="{{ $prog->nama_program }}">
                                        <span class="material-symbols-outlined text-[13px] text-blue-600">school</span>
                                        <span class="truncate max-w-[160px]">{{ $prog->nama_program }}</span>
                                    </span>
                                    <span class="text-[10px] text-text-tertiary">
                                        {{ $prog->kampusMitra->nama_universitas ?? $prog->kampusMitra->nama_kampus ?? 'Kampus Mitra' }}
                                    </span>
                                </div>
                            @else
                                <span class="text-xs text-text-tertiary">-</span>
                            @endif
                        </td>

                        <!-- Bantuan yang Dipantau -->
                        <td class="py-3.5 px-4 text-text-primary">
                            @if($laporan->penyaluranBantuan)
                                <div class="flex items-center gap-1.5">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $laporan->penyaluranBantuan->jenis === 'uang' ? 'bg-amber-100 text-amber-800' : ($laporan->penyaluranBantuan->jenis === 'barang' ? 'bg-blue-100 text-blue-800' : 'bg-gov-green-surface text-primary') }}">
                                        {{ $laporan->penyaluranBantuan->jenis }}
                                    </span>
                                    <span class="font-bold text-xs text-text-primary line-clamp-1">
                                        {{ $laporan->penyaluranBantuan->itemBantuan->nama_item ?? '-' }}
                                    </span>
                                </div>
                            @else
                                <span class="text-xs text-text-secondary font-medium">
                                    Bantuan Program
                                </span>
                            @endif
                        </td>

                        <!-- Kondisi Perkembangan Terakhir -->
                        <td class="py-3.5 px-4">
                            @if ($laporan->status_kondisi == 'normal')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs bg-status-verified-surface text-primary font-bold border border-primary/20">
                                    <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                    Normal / Baik
                                </span>
                            @elseif ($laporan->status_kondisi == 'hama')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs bg-status-warning-surface text-status-warning font-bold border border-status-warning/20">
                                    <span class="material-symbols-outlined text-[14px]">pest_control</span>
                                    Hama / Kendala
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs bg-status-fraud-surface text-status-fraud font-bold border border-status-fraud/20">
                                    <span class="material-symbols-outlined text-[14px]">cancel</span>
                                    Gagal / Rusak
                                </span>
                            @endif
                        </td>

                        <!-- Catatan Kunjungan Terakhir -->
                        <td class="py-3.5 px-4 text-text-primary max-w-[240px]">
                            <p class="truncate text-xs text-text-secondary" title="{{ $laporan->catatan }}">
                                {{ $laporan->catatan }}
                            </p>
                        </td>

                        <!-- Histori & Aksi -->
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1.5">
                                <!-- Tombol Tambah Kunjungan / Update Baru untuk program & bantuan ini -->
                                <a href="{{ route('pendamping.lapor.create', ['program_id' => $laporan->program_bantuan_id, 'penyaluran_id' => $laporan->penyaluran_bantuan_id, 'keluarga_id' => $laporan->keluarga_penerima_id]) }}"
                                   class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-gov-green-surface hover:bg-primary text-primary hover:text-white font-label-md text-xs font-bold transition-all border border-primary/20 shadow-xs"
                                   title="+ Catat Kunjungan / Update Perkembangan Program Ini">
                                    <span class="material-symbols-outlined text-[15px]">edit_note</span>
                                    <span>Update</span>
                                </a>

                                <!-- Tombol Histori Kunjungan Lengkap -->
                                <a href="{{ route('pendamping.lapor.show', $laporan->id) }}"
                                   class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-surface-container-high hover:bg-surface-container-highest text-text-primary font-label-md text-xs font-semibold transition-all border border-border-light shadow-xs"
                                   title="Lihat Kronologi Riwayat Kunjungan Program Ini">
                                    <span class="material-symbols-outlined text-[15px]">history</span>
                                    <span>Histori ({{ $totalHistoriKunjungan }}x)</span>
                                </a>

                                <!-- Tombol Edit Laporan Terakhir -->
                                <a href="{{ route('pendamping.lapor.edit', $laporan->id) }}"
                                   class="p-1.5 text-text-secondary hover:text-primary hover:bg-surface-container-high rounded-lg transition-colors"
                                   title="Edit Catatan Kunjungan Terakhir Ini">
                                    <span class="material-symbols-outlined text-[16px]">edit</span>
                                </a>

                                <!-- Hapus -->
                                <form action="{{ route('pendamping.lapor.destroy', $laporan->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus laporan kunjungan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-text-secondary hover:text-error hover:bg-status-fraud-surface rounded-lg transition-colors" title="Hapus Laporan">
                                         <span class="material-symbols-outlined text-[16px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-12 text-center text-text-secondary">
                            <span class="material-symbols-outlined text-[48px] text-border-medium mb-2 block">assignment_late</span>
                            <p class="font-headline-sm font-semibold text-text-primary">Tidak ada laporan kunjungan ditemukan</p>
                            <p class="text-xs text-text-tertiary mt-1">Coba sesuaikan kata kunci pencarian atau filter desa di atas.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Instant Client-side Search Script (Pelengkap Realtime) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('laporanTableBody');
    if (!searchInput || !tableBody) return;

    searchInput.addEventListener('input', function() {
        const query = this.value.trim().toLowerCase();
        const rows = tableBody.querySelectorAll('.laporan-row');

        rows.forEach(row => {
            const penerima = row.dataset.penerima || '';
            const nik = row.dataset.nik || '';
            const wilayah = row.dataset.wilayah || '';
            const kecamatan = row.dataset.kecamatan || '';

            if (penerima.includes(query) || nik.includes(query) || wilayah.includes(query) || kecamatan.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
</script>
@endsection
