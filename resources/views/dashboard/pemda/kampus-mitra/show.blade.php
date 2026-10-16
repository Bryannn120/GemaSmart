@extends('layouts.pemda')

@section('content')
<div class="flex flex-col gap-space-md">
    <div class="flex items-center gap-2 text-text-secondary font-label-md text-label-md">
        <a href="{{ route('pemda.kampus-mitra.index') }}" class="hover:text-primary transition-colors">Kampus Mitra</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <span class="text-text-primary font-semibold">Detail</span>
    </div>

    <div class="flex justify-between items-center">
        <div>
            <h1 class="font-headline-lg text-headline-lg font-bold text-text-primary">Detail Kampus Mitra</h1>
            <p class="font-body-md text-body-md text-text-secondary mt-1">Informasi lengkap data kerja sama perguruan tinggi.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('pemda.kampus-mitra.edit', $kampusMitra->id) }}" class="flex items-center gap-2 bg-primary text-on-primary px-space-md py-space-sm rounded-lg hover:bg-primary-container transition-colors shadow-sm font-label-lg text-label-lg font-semibold">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                <span>Edit</span>
            </a>
        </div>
    </div>

    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg max-w-2xl">
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-4 border-b border-border-light pb-4">
                <div class="w-16 h-16 rounded-full bg-status-verified-surface text-primary flex items-center justify-center font-bold text-2xl">
                    <span class="material-symbols-outlined text-[32px]">school</span>
                </div>
                <div>
                    <h3 class="font-headline-sm text-headline-sm font-bold text-text-primary">{{ $kampusMitra->nama_universitas }}</h3>
                    @if ($kampusMitra->status_mou == 'aktif')
                        <span class="inline-block px-2 py-0.5 rounded text-label-sm bg-status-verified-surface text-primary font-bold mt-1">MoU Aktif</span>
                    @else
                        <span class="inline-block px-2 py-0.5 rounded text-label-sm bg-status-warning-surface text-status-warning font-bold mt-1">MoU Tidak Aktif</span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <span class="text-text-secondary font-label-md text-label-md block">PIC / Koordinator</span>
                    <span class="text-text-primary font-semibold block mt-1">{{ $kampusMitra->pic_name }}</span>
                </div>
                <div>
                    <span class="text-text-secondary font-label-md text-label-md block">Kontak PIC</span>
                    <span class="text-text-primary font-semibold block mt-1">{{ $kampusMitra->pic_contact ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-text-secondary font-label-md text-label-md block">Email Akun</span>
                    <span class="text-text-primary font-semibold block mt-1">{{ $kampusMitra->user ? $kampusMitra->user->email : '-' }}</span>
                </div>
                <div class="col-span-2">
                    <span class="text-text-secondary font-label-md text-label-md block mb-1.5">Wilayah Binaan (Kecamatan)</span>
                    @if($kampusMitra->wilayahs && $kampusMitra->wilayahs->isNotEmpty())
                        <div class="flex flex-wrap gap-2">
                            @foreach($kampusMitra->wilayahs as $wilayah)
                                <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gov-green-surface text-primary border border-primary/20 text-xs font-bold shadow-2xs">
                                    <span class="material-symbols-outlined text-[16px]">location_on</span>
                                    <span>Kecamatan {{ $wilayah->nama }}</span>
                                    @if($wilayah->children && $wilayah->children->isNotEmpty())
                                        <span class="text-[10px] font-semibold bg-primary/10 text-primary px-1.5 py-0.5 rounded-full ml-0.5">
                                            {{ $wilayah->children->count() }} Desa
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <span class="text-text-primary font-semibold block">{{ $kampusMitra->wilayah_binaan ?? '-' }}</span>
                    @endif
                </div>
                <div class="col-span-2">
                    <span class="text-text-secondary font-label-md text-label-md block">MoU Berlaku Sampai</span>
                    <span class="text-text-primary font-semibold block mt-1">{{ $kampusMitra->mou_berlaku_sampai ? \Carbon\Carbon::parse($kampusMitra->mou_berlaku_sampai)->format('d M Y') : '-' }}</span>
                </div>
            </div>

            <!-- Financial Summary Card -->
            <div class="mt-4 p-space-md rounded-xl bg-surface-subtle border border-border-light flex flex-col gap-3">
                <div class="flex items-center justify-between flex-wrap gap-2">
                    <span class="font-bold text-text-primary text-sm flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px] text-emerald-700">account_balance_wallet</span>
                        <span>Ringkasan Keuangan &amp; Serapan Dana Bappeda</span>
                    </span>
                    <button type="button" onclick="openTambahDanaModal({{ $kampusMitra->id }}, '{{ addslashes($kampusMitra->nama_universitas) }}', {{ (int)$kampusMitra->dana_bappeda }})"
                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold shadow-sm transition-colors">
                        <span class="material-symbols-outlined text-[16px]">add_circle</span>
                        <span>+ Tambah Dana</span>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="p-3 rounded-lg bg-canvas-bg border border-border-light">
                        <span class="text-[11px] text-text-secondary uppercase font-semibold block">Dana dari Bappeda</span>
                        <span class="text-base font-bold text-emerald-700 block mt-0.5">Rp {{ number_format($kampusMitra->dana_bappeda, 0, ',', '.') }}</span>
                    </div>
                    <div class="p-3 rounded-lg bg-canvas-bg border border-border-light">
                        <span class="text-[11px] text-text-secondary uppercase font-semibold block">Total Penggunaan</span>
                        <span class="text-base font-bold text-blue-700 block mt-0.5">Rp {{ number_format($kampusMitra->total_penggunaan_dana, 0, ',', '.') }}</span>
                    </div>
                    <div class="p-3 rounded-lg bg-canvas-bg border border-border-light">
                        <span class="text-[11px] text-text-secondary uppercase font-semibold block">Sisa Saldo Kas</span>
                        <span class="text-base font-bold text-gov-green-dark block mt-0.5">Rp {{ number_format($kampusMitra->sisa_dana, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between text-xs text-text-secondary mb-1">
                        <span>Serapan Realisasi:</span>
                        <span class="font-bold text-text-primary">{{ $kampusMitra->persentase_penggunaan }}%</span>
                    </div>
                    <div class="w-full bg-border-light rounded-full h-2 overflow-hidden">
                        <div class="bg-primary h-2 rounded-full transition-all duration-500" style="width: {{ $kampusMitra->persentase_penggunaan }}%"></div>
                    </div>
                </div>
            </div>
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
                    <p class="text-xs text-white/80" id="modalNamaKampus">{{ $kampusMitra->nama_universitas }}</p>
                </div>
            </div>
            <button type="button" onclick="closeTambahDanaModal()" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-colors">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <form id="formTambahDana" method="POST" action="{{ route('pemda.kampus-mitra.tambah-dana', $kampusMitra->id) }}" class="p-space-lg flex flex-col gap-4">
            @csrf
            <!-- Info Dana Saat Ini -->
            <div class="p-3 rounded-xl bg-surface-subtle border border-border-light flex items-center justify-between text-sm">
                <span class="text-text-secondary font-medium">Alokasi Dana Saat Ini:</span>
                <span class="font-bold text-emerald-700 text-base" id="modalDanaSaatIni">Rp {{ number_format($kampusMitra->dana_bappeda, 0, ',', '.') }}</span>
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
    let currentDanaBappeda = {{ (float)$kampusMitra->dana_bappeda }};

    function openTambahDanaModal(id, nama, danaSaatIni) {
        currentDanaBappeda = parseFloat(danaSaatIni) || 0;
        document.getElementById('modalNamaKampus').textContent = nama;
        document.getElementById('modalDanaSaatIni').textContent = 'Rp ' + currentDanaBappeda.toLocaleString('id-ID');
        document.getElementById('modalInputNominal').value = '';
        document.getElementById('modalKeterangan').value = '';
        
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
