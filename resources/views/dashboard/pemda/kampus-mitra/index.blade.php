@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Kampus Mitra</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Kelola universitas yang bekerja sama dalam pengerahan mahasiswa pendamping.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <a href="{{ route('pemda.kampus-mitra.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add</span>
                <span>Tambah Kampus</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20">
            {{ session('success') }}
        </div>
    @endif

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-lg">
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-primary-fixed flex items-center justify-center text-on-primary-fixed-variant">
                <span class="material-symbols-outlined text-[24px]">school</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Kampus Mitra</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $kampusMitras->count() }} Mitra ({{ $kampusMitras->where('status_mou', 'aktif')->count() }} Aktif)</span>
            </div>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-700">
                <span class="material-symbols-outlined text-[24px]">account_balance</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Total Dana Bappeda</span>
                <span class="font-headline-md text-headline-md text-emerald-700 font-bold block">Rp {{ number_format($kampusMitras->sum('dana_bappeda'), 0, ',', '.') }}</span>
            </div>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-700">
                <span class="material-symbols-outlined text-[24px]">payments</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Total Penggunaan</span>
                <span class="font-headline-md text-headline-md text-blue-700 font-bold block">Rp {{ number_format($kampusMitras->sum('total_penggunaan_dana'), 0, ',', '.') }}</span>
            </div>
        </div>
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-gov-green-surface flex items-center justify-center text-gov-green-dark">
                <span class="material-symbols-outlined text-[24px]">savings</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Sisa Saldo Kas</span>
                <span class="font-headline-md text-headline-md text-gov-green-dark font-bold block">Rp {{ number_format($kampusMitras->sum('sisa_dana'), 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3.5 px-4 font-semibold">Nama Universitas</th>
                        <th class="py-3.5 px-4 font-semibold">PIC / Koordinator</th>
                        <th class="py-3.5 px-4 font-semibold">Dana dari Bappeda</th>
                        <th class="py-3.5 px-4 font-semibold">Total Penggunaan</th>
                        <th class="py-3.5 px-4 font-semibold">Sisa Saldo</th>
                        <th class="py-3.5 px-4 font-semibold">Status MoU</th>
                        <th class="py-3.5 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($kampusMitras as $km)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4">
                            <span class="font-bold text-text-primary block">{{ $km->nama_universitas }}</span>
                            <span class="text-xs text-text-tertiary">Wilayah: {{ $km->wilayah_binaan ?? '-' }}</span>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="font-medium text-text-primary block">{{ $km->pic_name }}</span>
                            <span class="text-text-tertiary text-xs">{{ $km->pic_contact }}</span>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="font-bold text-emerald-700 block">Rp {{ number_format($km->dana_bappeda, 0, ',', '.') }}</span>
                            <button type="button" onclick="openTambahDanaModal({{ $km->id }}, '{{ addslashes($km->nama_universitas) }}', {{ (int)$km->dana_bappeda }})" 
                                    class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 hover:text-emerald-900 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 px-2 py-0.5 rounded-md mt-1 transition-colors" title="Tambah / Top-up Dana">
                                <span class="material-symbols-outlined text-[13px]">add_circle</span>
                                <span>+ Tambah Dana</span>
                            </button>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="font-bold text-blue-700 block">Rp {{ number_format($km->total_penggunaan_dana, 0, ',', '.') }}</span>
                            <span class="text-[11px] text-text-tertiary">Serapan: {{ $km->persentase_penggunaan }}%</span>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="font-bold text-gov-green-dark block">Rp {{ number_format($km->sisa_dana, 0, ',', '.') }}</span>
                            <span class="text-[11px] text-text-tertiary">Tersedia</span>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @if ($km->status_mou == 'aktif')
                                <span class="inline-flex px-space-sm py-0.5 rounded-full text-label-sm bg-status-verified-surface text-primary font-bold">Aktif</span>
                            @else
                                <span class="inline-flex px-space-sm py-0.5 rounded-full text-label-sm bg-status-warning-surface text-status-warning font-bold">Tidak Aktif</span>
                            @endif
                            <span class="text-[11px] text-text-tertiary block mt-0.5">s/d {{ $km->mou_berlaku_sampai ? \Carbon\Carbon::parse($km->mou_berlaku_sampai)->format('d M Y') : '-' }}</span>
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1">
                                <button type="button" onclick="openTambahDanaModal({{ $km->id }}, '{{ addslashes($km->nama_universitas) }}', {{ (int)$km->dana_bappeda }})" class="p-1.5 text-emerald-700 hover:text-emerald-900 hover:bg-emerald-50 rounded-lg transition-colors border border-emerald-200" title="Tambah Dana Kampus">
                                    <span class="material-symbols-outlined text-[20px]">payments</span>
                                </button>
                                <a href="{{ route('pemda.kampus-mitra.show', $km->id) }}" class="p-1.5 text-text-secondary hover:text-primary hover:bg-status-info-surface rounded-lg transition-colors" title="Lihat Detail">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <a href="{{ route('pemda.kampus-mitra.edit', $km->id) }}" class="p-1.5 text-text-secondary hover:text-primary hover:bg-status-verified-surface rounded-lg transition-colors" title="Edit Data & Dana">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('pemda.kampus-mitra.destroy', $km->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kampus mitra ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-text-secondary hover:text-error hover:bg-status-fraud-surface rounded-lg transition-colors" title="Hapus">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-text-secondary">
                            <span class="material-symbols-outlined text-[48px] text-border-medium mb-2 block">inbox</span>
                            <p class="font-body-md">Belum ada data kampus mitra.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="flex items-center justify-between p-space-md border-t border-border-light bg-surface-subtle">
            <span class="text-text-secondary font-body-sm text-body-sm">Menampilkan <strong>{{ $kampusMitras->count() }}</strong> data kampus mitra</span>
        </div>
    </div>
</div>

<!-- Modal Tambah Dana Bappeda ke Kampus -->
<div id="modalTambahDana" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm hidden p-4">
    <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full border border-border-light overflow-hidden animate-in fade-in zoom-in-95 duration-200">
        <div class="p-space-lg bg-gradient-to-r from-gov-green-dark to-primary text-white flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">account_balance_wallet</span>
                </div>
                <div>
                    <h3 class="font-bold text-base leading-tight">Tambah / Alokasikan Dana Kampus</h3>
                    <p class="text-xs text-white/80" id="modalNamaKampus">Universitas</p>
                </div>
            </div>
            <button type="button" onclick="closeTambahDanaModal()" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-colors">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <form id="formTambahDana" method="POST" class="p-space-lg flex flex-col gap-4">
            @csrf
            <!-- Info Dana Saat Ini -->
            <div class="p-3 rounded-xl bg-surface-subtle border border-border-light flex items-center justify-between text-sm">
                <span class="text-text-secondary font-medium">Alokasi Dana Saat Ini:</span>
                <span class="font-bold text-emerald-700 text-base" id="modalDanaSaatIni">Rp 0</span>
            </div>

            <!-- Pilihan Tipe -->
            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-text-secondary uppercase">Metode Pengalokasian</label>
                <div class="grid grid-cols-2 gap-2">
                    <label class="flex items-center gap-2 p-2.5 rounded-xl border border-border-medium cursor-pointer hover:border-primary transition-colors bg-white has-[:checked]:bg-gov-green-surface has-[:checked]:border-primary">
                        <input type="radio" name="tipe" value="tambah" checked onchange="updatePerhitunganDana()" class="accent-primary">
                        <div>
                            <span class="font-bold text-xs text-text-primary block">Tambah ke Saldo (+)</span>
                            <span class="text-[11px] text-text-tertiary block">Top-up dana bantuan</span>
                        </div>
                    </label>
                    <label class="flex items-center gap-2 p-2.5 rounded-xl border border-border-medium cursor-pointer hover:border-primary transition-colors bg-white has-[:checked]:bg-gov-green-surface has-[:checked]:border-primary">
                        <input type="radio" name="tipe" value="set" onchange="updatePerhitunganDana()" class="accent-primary">
                        <div>
                            <span class="font-bold text-xs text-text-primary block">Set Total Pagu (=)</span>
                            <span class="text-[11px] text-text-tertiary block">Ganti total nominal</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Input Nominal -->
            <div class="flex flex-col gap-1.5">
                <label for="modalInputNominal" class="text-xs font-bold text-text-primary uppercase flex items-center justify-between">
                    <span id="labelNominal">Nominal Tambahan (Rp)</span>
                    <span class="text-[11px] text-text-tertiary font-normal">Minimal Rp 1</span>
                </label>
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 font-bold text-text-secondary text-sm">Rp</span>
                    <input type="number" name="nominal" id="modalInputNominal" min="1" step="any" required
                           oninput="updatePerhitunganDana()"
                           placeholder="Contoh: 50000000"
                           class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary font-bold text-base focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                </div>
            </div>

            <!-- Preview Total Dana Baru -->
            <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between text-sm">
                <span class="text-emerald-900 font-semibold">Total Pagu Dana Baru:</span>
                <span class="font-extrabold text-emerald-800 text-lg" id="modalDanaBaruPreview">Rp 0</span>
            </div>

            <!-- Keterangan Tambahan -->
            <div class="flex flex-col gap-1.5">
                <label for="modalKeterangan" class="text-xs font-bold text-text-secondary uppercase">Catatan / Keterangan (Opsional)</label>
                <input type="text" name="keterangan" id="modalKeterangan" placeholder="Contoh: Tambahan anggaran program bibit Q4 2026"
                       class="w-full px-3.5 py-2 rounded-xl border border-border-medium bg-surface-subtle text-text-primary text-xs focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
            </div>

            <div class="flex items-center justify-end gap-2 pt-2 border-t border-border-light mt-1">
                <button type="button" onclick="closeTambahDanaModal()" class="px-4 py-2 rounded-xl text-xs font-bold text-text-secondary hover:bg-surface-subtle transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-primary text-white hover:bg-gov-green-dark transition-colors shadow-sm flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px]">check</span>
                    <span>Simpan Alokasi Dana</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let currentDanaBappeda = 0;

    function openTambahDanaModal(id, nama, danaSaatIni) {
        currentDanaBappeda = parseFloat(danaSaatIni) || 0;
        document.getElementById('modalNamaKampus').textContent = nama;
        document.getElementById('modalDanaSaatIni').textContent = 'Rp ' + currentDanaBappeda.toLocaleString('id-ID');
        document.getElementById('modalInputNominal').value = '';
        document.getElementById('modalKeterangan').value = '';
        document.getElementById('formTambahDana').action = '{{ url("/pemda/kampus-mitra") }}/' + id + '/tambah-dana';
        
        updatePerhitunganDana();
        document.getElementById('modalTambahDana').classList.remove('hidden');
    }

    function closeTambahDanaModal() {
        document.getElementById('modalTambahDana').classList.add('hidden');
    }

    function updatePerhitunganDana() {
        const nominal = parseFloat(document.getElementById('modalInputNominal').value) || 0;
        const tipe = document.querySelector('input[name="tipe"]:checked')?.value || 'tambah';
        const label = document.getElementById('labelNominal');
        
        let totalBaru = 0;
        if (tipe === 'tambah') {
            label.textContent = 'Nominal Tambahan (Rp)';
            totalBaru = currentDanaBappeda + nominal;
        } else {
            label.textContent = 'Total Pagu Baru (Rp)';
            totalBaru = nominal;
        }

        document.getElementById('modalDanaBaruPreview').textContent = 'Rp ' + totalBaru.toLocaleString('id-ID');
    }

    // Close on backdrop click
    document.getElementById('modalTambahDana')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeTambahDanaModal();
        }
    });
</script>
@endsection
