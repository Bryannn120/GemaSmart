@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Breadcrumb & Back -->
    <div class="flex items-center gap-space-sm text-body-sm font-body-sm text-text-tertiary">
        <a href="{{ route('kampus.program-bantuan.index') }}" class="hover:text-primary transition-colors flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
            <span>Kembali ke Daftar Program</span>
        </a>
        <span>/</span>
        <span class="text-text-primary font-medium">{{ $program->nama_program }}</span>
    </div>

    <!-- Header Details -->
    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-space-lg bg-canvas-bg p-space-xl rounded-2xl border border-border-light shadow-sm">
        <div class="flex flex-col max-w-3xl">
            <div class="flex flex-wrap items-center gap-space-sm mb-space-xs">
                <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-gov-green-surface text-primary font-bold">
                    <span class="material-symbols-outlined text-[14px] mr-1">school</span>
                    {{ $program->kampusMitra->nama_universitas ?? $program->kampusMitra->nama_kampus ?? 'Kampus Mitra' }}
                </span>
                @if ($program->status === 'aktif')
                    <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-status-verified-surface text-primary font-semibold">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary mr-1.5"></span>
                        Program Aktif
                    </span>
                @elseif($program->status === 'selesai')
                    <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-surface-muted text-text-secondary font-semibold">
                        Selesai
                    </span>
                @else
                    <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-yellow-100 text-yellow-800 font-semibold">
                        Draf
                    </span>
                @endif
                <span class="text-text-tertiary text-label-sm font-label-sm">Tahun Anggaran {{ $program->tahun_anggaran }}</span>
            </div>

            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">{{ $program->nama_program }}</h1>
            <p class="font-body-md text-text-secondary mt-2 leading-relaxed">
                {{ $program->deskripsi ?? 'Program bantuan subsidi yang dirancang oleh kampus mitra untuk mendorong kemandirian dan peningkatan taraf hidup keluarga prasejahtera.' }}
            </p>

            <!-- Metadata Pills -->
            <div class="flex flex-wrap items-center gap-space-lg mt-space-md pt-space-md border-t border-border-light text-body-sm font-body-sm text-text-secondary">
                <div class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-secondary text-[20px]">account_balance_wallet</span>
                    <span>Pagu Anggaran: <strong class="text-text-primary">Rp {{ number_format($program->pagu_anggaran, 0, ',', '.') }}</strong></span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-primary text-[20px]">group</span>
                    <span>Target: <strong class="text-text-primary">{{ number_format($program->target_kk) }} KK</strong></span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-blue-600 text-[20px]">category</span>
                    <span>Jenis Subsidi: 
                        <strong class="text-text-primary uppercase">{{ str_replace(',', ', ', $program->jenis_subsidi ?? 'bibit, uang, barang') }}</strong>
                    </span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap items-center gap-space-sm shrink-0">
            <a href="{{ route('kampus.program-bantuan.edit', $program->id) }}" class="inline-flex items-center gap-1.5 px-space-md py-2 rounded-xl bg-surface-muted hover:bg-surface-subtle text-text-primary font-label-md text-label-md font-semibold border border-border-light transition-all">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                <span>Edit Program</span>
            </a>
            <button type="button" onclick="document.getElementById('modalTambahItem').classList.remove('hidden')" class="inline-flex items-center gap-1.5 px-space-md py-2 rounded-xl bg-primary text-on-primary font-label-md text-label-md font-bold hover:bg-gov-green-dark transition-all shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add</span>
                <span>+ Tambah Item Bantuan</span>
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20 flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- KPI Realisasi Bantuan Disalurkan Pendamping -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-lg">
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-gold-surface flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined text-[24px]">payments</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary">Uang Disalurkan</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">Rp {{ number_format($totalUangDisalurkan, 0, ',', '.') }}</span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Lewat Pendamping</span>
            </div>
        </div>

        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center text-amber-800">
                <span class="material-symbols-outlined text-[24px]">home_repair_service</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary">Alat / Barang</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ number_format($totalAlatDisalurkan) }} Unit</span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Kompor, Sprayer, dll</span>
            </div>
        </div>

        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-gov-green-surface flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-[24px]">potted_plant</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary">Bibit Diterima KK</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ number_format($totalBibitDisalurkan) }} Unit/Kg</span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Bibit Tanaman</span>
            </div>
        </div>

        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-800">
                <span class="material-symbols-outlined text-[24px]">inventory_2</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary">Variasi Item Kampus</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $program->itemBantuans->count() }} Jenis</span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Ditetapkan Kampus</span>
            </div>
        </div>
    </div>

    <!-- TABEL 1: MASTER ITEM BANTUAN YANG DITENTUKAN KAMPUS -->
    <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="p-space-lg border-b border-border-light flex flex-col sm:flex-row sm:items-center justify-between gap-space-md bg-surface-subtle">
            <div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-[22px]">format_list_bulleted</span>
                    <h2 class="font-title-lg text-title-lg text-text-primary font-bold">Daftar Item Subsidi Bantuan Ditentukan Kampus</h2>
                </div>
                <p class="font-body-sm text-text-secondary text-xs mt-1">
                    Kampus menentukan jenis dan nama bantuan (Bibit, Uang, atau Barang/Alat). Pendamping bertugas menyalurkan item-item ini ke keluarga binaan.
                </p>
            </div>
            <button type="button" onclick="document.getElementById('modalTambahItem').classList.remove('hidden')" class="inline-flex items-center gap-1.5 px-space-md py-2 rounded-xl bg-primary text-on-primary font-label-sm text-label-sm font-bold hover:bg-gov-green-dark transition-all self-start sm:self-auto shadow-sm">
                <span class="material-symbols-outlined text-[16px]">add_circle</span>
                <span>+ Tambah Item Subsidi</span>
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Jenis Subsidi</th>
                        <th class="py-3 px-4 font-semibold">Nama Item Bantuan</th>
                        <th class="py-3 px-4 font-semibold">Satuan</th>
                        <th class="py-3 px-4 font-semibold">Estimasi Nilai / Nominal</th>
                        <th class="py-3 px-4 font-semibold">Kuota Stok Kampus</th>
                        <th class="py-3 px-4 font-semibold">Tersalurkan</th>
                        <th class="py-3 px-4 font-semibold">Sisa Stok</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($program->itemBantuans as $item)
                        @php
                            $disalurkan = $item->penyaluranBantuans->where('status', '!=', 'batal')->sum('jumlah');
                            if ($item->jenis === 'uang') {
                                $disalurkan = $item->penyaluranBantuans->where('status', '!=', 'batal')->sum('nominal_uang');
                            }
                            $sisa = max(0, $item->total_stok - $disalurkan);
                        @endphp
                        <tr class="hover:bg-surface-subtle transition-colors group">
                            <td class="py-3.5 px-4 font-medium">
                                @if($item->jenis === 'bibit')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-gov-green-surface text-primary border border-primary/20">
                                        <span class="material-symbols-outlined text-[14px]">potted_plant</span>
                                        Bibit
                                    </span>
                                @elseif($item->jenis === 'uang')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-gold-surface text-secondary border border-secondary/20">
                                        <span class="material-symbols-outlined text-[14px]">payments</span>
                                        Uang Tunai
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-300">
                                        <span class="material-symbols-outlined text-[14px]">home_repair_service</span>
                                        Barang / Alat
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-text-primary block text-sm">{{ $item->nama_item }}</span>
                                @if($item->deskripsi)
                                    <span class="text-xs text-text-tertiary block mt-0.5 line-clamp-1">{{ $item->deskripsi }}</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-text-secondary font-medium">
                                {{ $item->satuan }}
                            </td>
                            <td class="py-3.5 px-4 text-text-primary font-semibold">
                                @if($item->nominal_satuan > 0)
                                    Rp {{ number_format($item->nominal_satuan, 0, ',', '.') }}
                                @else
                                    <span class="text-text-tertiary text-xs">-</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-text-primary font-medium">
                                {{ number_format($item->total_stok) }} {{ $item->satuan }}
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-primary">
                                @if($item->jenis === 'uang')
                                    Rp {{ number_format($disalurkan, 0, ',', '.') }}
                                @else
                                    {{ number_format($disalurkan) }} {{ $item->satuan }}
                                @endif
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold {{ $sisa > 0 ? 'text-text-primary' : 'text-red-500' }}">
                                    @if($item->jenis === 'uang')
                                        Rp {{ number_format($sisa, 0, ',', '.') }}
                                    @else
                                        {{ number_format($sisa) }} {{ $item->satuan }}
                                    @endif
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <form action="{{ route('kampus.program-bantuan.item.destroy', [$program->id, $item->id]) }}" method="POST" onsubmit="return confirm('Hapus item bantuan {{ $item->nama_item }} dari program ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-text-tertiary hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus Item">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-8 px-4 text-center text-text-tertiary">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-[36px] text-text-tertiary/60">inventory_2</span>
                                    <p class="font-body-md text-text-secondary font-medium">Belum ada item subsidi yang ditentukan untuk program ini.</p>
                                    <p class="text-xs text-text-tertiary">Klik tombol di bawah untuk menambahkan jenis bibit, uang modal, atau alat bantuan.</p>
                                    <button type="button" onclick="document.getElementById('modalTambahItem').classList.remove('hidden')" class="mt-2 inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary text-on-primary font-label-sm text-label-sm font-bold hover:bg-gov-green-dark transition-all">
                                        <span class="material-symbols-outlined text-[16px]">add</span>
                                        <span>+ Tambah Item Subsidi Bantuan Sekarang</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- TABEL 2: REKAP PENYALURAN OLEH PENDAMPING LAPANGAN -->
    <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="p-space-lg border-b border-border-light bg-surface-subtle flex flex-col sm:flex-row sm:items-center justify-between gap-space-md">
            <div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary text-[22px]">volunteer_activism</span>
                    <h2 class="font-title-lg text-title-lg text-text-primary font-bold">Laporan Realisasi Penyaluran oleh Pendamping</h2>
                </div>
                <p class="font-body-sm text-text-secondary text-xs mt-1">
                    Daftar keluarga yang telah menerima penyaluran bantuan dari para pendamping di lapangan.
                </p>
            </div>
            <span class="font-label-sm text-label-sm px-3 py-1 bg-canvas-bg rounded-lg border border-border-light text-text-secondary">
                Total Tersalurkan: <strong>{{ $program->penyaluranBantuans->count() }} Penyaluran</strong>
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Tgl Serah</th>
                        <th class="py-3 px-4 font-semibold">Keluarga Penerima</th>
                        <th class="py-3 px-4 font-semibold">Wilayah / Desa</th>
                        <th class="py-3 px-4 font-semibold">Jenis & Item Diterima</th>
                        <th class="py-3 px-4 font-semibold">Jumlah / Nominal</th>
                        <th class="py-3 px-4 font-semibold">Peruntukan / Keterangan</th>
                        <th class="py-3 px-4 font-semibold">Pendamping Penyalur</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($program->penyaluranBantuans as $penyaluran)
                        <tr class="hover:bg-surface-subtle transition-colors">
                            <td class="py-3 px-4 text-text-secondary whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($penyaluran->tgl_penyaluran)->translatedFormat('d M Y') }}
                            </td>
                            <td class="py-3 px-4">
                                <span class="font-bold text-text-primary block">{{ $penyaluran->keluargaPenerima->kepala_keluarga ?? 'Keluarga Penerima' }}</span>
                                <span class="text-xs text-text-tertiary">NIK: {{ $penyaluran->keluargaPenerima->nik ?? '-' }}</span>
                            </td>
                            <td class="py-3 px-4 text-text-secondary text-xs">
                                {{ $penyaluran->keluargaPenerima->wilayah->nama ?? 'Wilayah Desa' }}
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-1.5">
                                    @if($penyaluran->jenis === 'bibit')
                                        <span class="p-1 rounded bg-gov-green-surface text-primary">
                                            <span class="material-symbols-outlined text-[14px]">potted_plant</span>
                                        </span>
                                    @elseif($penyaluran->jenis === 'uang')
                                        <span class="p-1 rounded bg-gold-surface text-secondary">
                                            <span class="material-symbols-outlined text-[14px]">payments</span>
                                        </span>
                                    @else
                                        <span class="p-1 rounded bg-amber-100 text-amber-800">
                                            <span class="material-symbols-outlined text-[14px]">home_repair_service</span>
                                        </span>
                                    @endif
                                    <span class="font-semibold text-text-primary">{{ $penyaluran->itemBantuan->nama_item ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 font-bold text-text-primary">
                                @if($penyaluran->jenis === 'uang')
                                    <span class="text-emerald-700">Rp {{ number_format($penyaluran->nominal_uang ?? $penyaluran->jumlah, 0, ',', '.') }}</span>
                                @else
                                    <span>{{ number_format($penyaluran->jumlah) }} {{ $penyaluran->satuan }}</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-xs">
                                @if($penyaluran->peruntukan)
                                    <span class="font-semibold text-text-secondary block">Keperluan: {{ $penyaluran->peruntukan }}</span>
                                @endif
                                @if($penyaluran->keterangan)
                                    <span class="text-text-tertiary block mt-0.5">{{ $penyaluran->keterangan }}</span>
                                @endif
                                @if(!$penyaluran->peruntukan && !$penyaluran->keterangan)
                                    <span class="text-text-tertiary">-</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-text-secondary text-xs">
                                <div class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px] text-text-tertiary">person</span>
                                    <span>{{ $penyaluran->pendamping->name ?? 'Kader Pendamping' }}</span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-6 px-4 text-center text-text-tertiary text-xs">
                                Belum ada riwayat penyaluran oleh pendamping untuk program ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH ITEM BANTUAN OLEH KAMPUS -->
<div id="modalTambahItem" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm hidden p-4">
    <div class="bg-canvas-bg rounded-2xl max-w-lg w-full border border-border-light shadow-2xl overflow-hidden flex flex-col animate-in fade-in zoom-in duration-200">
        <!-- Modal Header -->
        <div class="p-space-lg border-b border-border-light bg-surface-subtle flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-gov-green-surface text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[18px]">add_circle</span>
                </div>
                <h3 class="font-title-md text-title-md font-bold text-text-primary">Tambah Item Subsidi Bantuan</h3>
            </div>
            <button type="button" onclick="document.getElementById('modalTambahItem').classList.add('hidden')" class="text-text-tertiary hover:text-text-primary p-1 rounded-lg">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <!-- Modal Form -->
        <form action="{{ route('kampus.program-bantuan.item.store', $program->id) }}" method="POST" class="p-space-lg flex flex-col gap-space-md">
            @csrf

            <!-- Kategori Jenis Subsidi -->
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm text-label-sm text-text-secondary font-bold">
                    Kategori Jenis Bantuan <span class="text-status-error">*</span>
                </label>
                <div class="grid grid-cols-3 gap-2">
                    <label class="cursor-pointer">
                        <input type="radio" name="jenis" value="bibit" class="peer sr-only" checked onchange="adjustItemForm('bibit')">
                        <div class="p-3 rounded-xl border border-border-light peer-checked:border-primary peer-checked:bg-gov-green-surface peer-checked:text-primary flex flex-col items-center justify-center text-center transition-all">
                            <span class="material-symbols-outlined text-[22px] mb-1">potted_plant</span>
                            <span class="text-xs font-bold">Bibit</span>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="jenis" value="uang" class="peer sr-only" onchange="adjustItemForm('uang')">
                        <div class="p-3 rounded-xl border border-border-light peer-checked:border-secondary peer-checked:bg-gold-surface peer-checked:text-secondary flex flex-col items-center justify-center text-center transition-all">
                            <span class="material-symbols-outlined text-[22px] mb-1">payments</span>
                            <span class="text-xs font-bold">Uang Tunai</span>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="jenis" value="barang" class="peer sr-only" onchange="adjustItemForm('barang')">
                        <div class="p-3 rounded-xl border border-border-light peer-checked:border-amber-600 peer-checked:bg-amber-100 peer-checked:text-amber-800 flex flex-col items-center justify-center text-center transition-all">
                            <span class="material-symbols-outlined text-[22px] mb-1">home_repair_service</span>
                            <span class="text-xs font-bold">Barang / Alat</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Nama Item Bantuan -->
            <div class="flex flex-col gap-1.5">
                <label for="modal_nama_item" class="font-label-sm text-label-sm text-text-secondary font-bold">
                    Nama Item Bantuan <span class="text-status-error">*</span>
                </label>
                <input type="text" id="modal_nama_item" name="nama_item" required
                    placeholder="Contoh: Bibit Cabai Rawit / Kompor Gas 2 Tungku / Bantuan Uang Modal"
                    class="w-full px-3 py-2 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm focus:border-primary focus:bg-canvas-bg focus:outline-none transition-all">
                <span class="text-[11px] text-text-tertiary">Nama spesifik bantuan yang akan disalurkan oleh pendamping.</span>
            </div>

            <!-- Satuan & Total Stok Kuota -->
            <div class="grid grid-cols-2 gap-3">
                <div class="flex flex-col gap-1.5">
                    <label for="modal_satuan" class="font-label-sm text-label-sm text-text-secondary font-bold">
                        Pilih Satuan Bantuan <span class="text-status-error">*</span>
                    </label>
                    <select id="modal_satuan" name="satuan" required
                        class="w-full px-3 py-2 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm font-semibold focus:border-primary focus:bg-canvas-bg focus:outline-none transition-all">
                        <option value="Unit">Unit (Alat, Kompor, Mesin)</option>
                        <option value="KG">KG (Kilogram)</option>
                        <option value="LT">LT (Liter)</option>
                        <option value="Polybag" selected>Polybag (Bibit Tanaman)</option>
                        <option value="Batang">Batang</option>
                        <option value="Pohon">Pohon</option>
                        <option value="Biji">Biji / Butir</option>
                        <option value="Gram">Gram</option>
                        <option value="Paket">Paket</option>
                        <option value="Set">Set</option>
                        <option value="Sak">Sak / Karung</option>
                        <option value="Ekor">Ekor (Ternak / Ikan)</option>
                        <option value="Rupiah">Rupiah (Dana Tunai)</option>
                    </select>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label for="modal_total_stok" class="font-label-sm text-label-sm text-text-secondary font-bold">
                        Total Kuota Disediakan <span class="text-status-error">*</span>
                    </label>
                    <input type="number" step="any" min="1" id="modal_total_stok" name="total_stok" required value="100"
                        class="w-full px-3 py-2 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm focus:border-primary focus:bg-canvas-bg focus:outline-none transition-all">
                </div>
            </div>

            <!-- Estimasi Nominal Satuan (Rp) -->
            <div class="flex flex-col gap-1.5">
                <label for="modal_nominal_satuan" class="font-label-sm text-label-sm text-text-secondary font-bold">
                    Estimasi Nilai / Nominal per Satuan (Rp)
                </label>
                <div class="relative">
                    <span class="absolute left-3 top-2.5 text-text-tertiary text-xs font-bold">Rp</span>
                    <input type="number" min="0" step="1000" id="modal_nominal_satuan" name="nominal_satuan" value="0"
                        placeholder="Contoh: 500000"
                        class="w-full pl-9 pr-3 py-2 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm focus:border-primary focus:bg-canvas-bg focus:outline-none transition-all">
                </div>
                <span class="text-[11px] text-text-tertiary">Jika jenis uang tunai, isi dengan nominal standar bantuan (misal Rp 1.000.000).</span>
            </div>

            <!-- Deskripsi / Catatan Item -->
            <div class="flex flex-col gap-1.5">
                <label for="modal_deskripsi" class="font-label-sm text-label-sm text-text-secondary font-bold">
                    Keterangan & Spesifikasi Item (Opsional)
                </label>
                <textarea id="modal_deskripsi" name="deskripsi" rows="2"
                    placeholder="Contoh: Varietas hibrida tahan hama, bersertifikat BPSB / Bantuan modal usaha tani mandiri"
                    class="w-full px-3 py-2 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm focus:border-primary focus:bg-canvas-bg focus:outline-none transition-all"></textarea>
            </div>

            <!-- Modal Footer -->
            <div class="flex items-center justify-end gap-2 pt-space-md border-t border-border-light mt-2">
                <button type="button" onclick="document.getElementById('modalTambahItem').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-border-light text-text-secondary text-sm font-semibold hover:bg-surface-subtle transition-all">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 rounded-xl bg-primary text-on-primary text-sm font-bold hover:bg-gov-green-dark transition-all shadow-sm">
                    Simpan Item Bantuan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function adjustItemForm(jenis) {
    const inputSatuan = document.getElementById('modal_satuan');
    const inputNama = document.getElementById('modal_nama_item');
    const inputNominal = document.getElementById('modal_nominal_satuan');

    if (jenis === 'bibit') {
        inputSatuan.value = 'Polybag';
        inputNama.placeholder = 'Contoh: Bibit Cabai Rawit Hibrida';
    } else if (jenis === 'uang') {
        inputSatuan.value = 'Rupiah';
        inputNama.placeholder = 'Contoh: Bantuan Dana Modal Usaha Tani';
        if (!inputNominal.value || inputNominal.value == '0') {
            inputNominal.value = '1000000';
        }
    } else if (jenis === 'barang') {
        inputSatuan.value = 'Unit';
        inputNama.placeholder = 'Contoh: Kompor Gas 2 Tungku + Regulator';
    }
}
</script>
@endsection
