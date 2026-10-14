@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-5xl mx-auto">
    <!-- Breadcrumb & Back -->
    <div class="flex items-center gap-space-sm text-body-sm font-body-sm text-text-tertiary">
        <a href="{{ route('pendamping.penyaluran-bantuan.index') }}" class="hover:text-primary transition-colors flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
            <span>Kembali ke Penyaluran</span>
        </a>
        <span>/</span>
        <span class="text-text-primary font-medium">Formulir Penyaluran Bantuan</span>
    </div>

    <!-- Header Section -->
    <div class="flex flex-col gap-1">
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gov-green-surface text-primary">
                <span class="material-symbols-outlined text-[14px] mr-1">volunteer_activism</span>
                Distribusi Lapangan
            </span>
            <span class="text-xs text-text-tertiary">Bantuan Subsidi Ditetapkan Kampus</span>
        </div>
        <h1 class="font-headline-xl text-headline-xl text-text-primary font-bold">Salurkan Bantuan ke Keluarga Binaan</h1>
        <p class="font-body-md text-text-secondary text-sm">
            Catat detail bantuan yang diserahkan kepada keluarga penerima binaan. Anda dapat menyalurkan bantuan bibit, uang modal tunai (beserta peruntukannya), dan barang/alat sekaligus dalam satu kali penyaluran.
        </p>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-space-md rounded-xl text-sm">
            <strong class="font-bold block mb-1">Periksa kembali isian formulir:</strong>
            <ul class="list-disc list-inside text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pendamping.penyaluran-bantuan.store') }}" method="POST" class="flex flex-col gap-space-lg" id="formPenyaluran">
        @csrf

        <!-- CARD 1: INFORMASI PENERIMA & PROGRAM -->
        <div class="bg-canvas-bg rounded-2xl p-space-xl shadow-sm border border-border-light flex flex-col gap-space-md">
            <h2 class="font-title-md text-title-md font-bold text-text-primary flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[20px]">person_pin</span>
                1. Pilih Keluarga Penerima & Program Bantuan
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <!-- PILIH KELUARGA PENERIMA (DENGAN SEARCH) -->
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm text-label-sm text-text-secondary font-bold">
                        Keluarga Penerima Binaan <span class="text-status-error">*</span>
                    </label>

                    <!-- Filter search box untuk penerima -->
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-text-tertiary text-[18px]">search</span>
                        <input type="text" id="searchKeluargaInput" placeholder="Ketik nama atau NIK penerima untuk memfilter..."
                            oninput="filterKeluargaDropdown()"
                            class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-border-light bg-surface-subtle focus:border-primary focus:outline-none mb-1">
                    </div>

                    <select name="keluarga_penerima_id" id="selectKeluarga" required
                        class="w-full px-3 py-2.5 rounded-xl border border-border-light bg-canvas-bg text-text-primary text-sm font-medium focus:border-primary focus:outline-none transition-all">
                        <option value="">-- Pilih Keluarga Penerima --</option>
                        @foreach ($keluarga_penerimas as $keluarga)
                            <option value="{{ $keluarga->id }}" 
                                data-text="{{ strtolower($keluarga->kepala_keluarga . ' ' . $keluarga->nik . ' ' . ($keluarga->wilayah->nama ?? '')) }}"
                                data-wilayah="{{ $keluarga->wilayah->nama ?? '-' }}"
                                data-desil="{{ $keluarga->desil ?? '-' }}"
                                {{ (old('keluarga_penerima_id', $selectedKeluargaId) == $keluarga->id) ? 'selected' : '' }}>
                                {{ $keluarga->kepala_keluarga }} (NIK: {{ $keluarga->nik }}) - Desa {{ $keluarga->wilayah->nama ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                    <span class="text-[11px] text-text-tertiary">Pilih salah satu keluarga penerima dari wilayah binaan Anda.</span>
                </div>

                <!-- PILIH PROGRAM BANTUAN KAMPUS -->
                <div class="flex flex-col gap-1.5">
                    <label for="selectProgram" class="font-label-sm text-label-sm text-text-secondary font-bold">
                        Program Bantuan Kampus <span class="text-status-error">*</span>
                    </label>
                    <select name="program_bantuan_id" id="selectProgram" required onchange="onProgramChanged()"
                        class="w-full px-3 py-2.5 rounded-xl border border-border-light bg-canvas-bg text-text-primary text-sm font-medium focus:border-primary focus:outline-none transition-all">
                        <option value="">-- Pilih Program Bantuan Kampus --</option>
                        @foreach ($programs as $prog)
                            <option value="{{ $prog->id }}" 
                                {{ (old('program_bantuan_id') == $prog->id || $loop->first) ? 'selected' : '' }}>
                                {{ $prog->nama_program }} (Tahun {{ $prog->tahun_anggaran }})
                            </option>
                        @endforeach
                    </select>
                    <span class="text-[11px] text-text-tertiary">Daftar item bantuan (bibit, uang, alat) disesuaikan dengan program terpilih.</span>
                </div>
            </div>

            <!-- TANGGAL PENYALURAN -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg pt-2 border-t border-border-light">
                <div class="flex flex-col gap-1.5">
                    <label for="tgl_penyaluran" class="font-label-sm text-label-sm text-text-secondary font-bold">
                        Tanggal Penyerahan / Penyaluran <span class="text-status-error">*</span>
                    </label>
                    <input type="date" id="tgl_penyaluran" name="tgl_penyaluran" required
                        value="{{ old('tgl_penyaluran', date('Y-m-d')) }}"
                        class="w-full px-3 py-2.5 rounded-xl border border-border-light bg-canvas-bg text-text-primary text-sm focus:border-primary focus:outline-none">
                </div>
                <div class="flex flex-col gap-1.5">
                    <label for="catatan_umum" class="font-label-sm text-label-sm text-text-secondary font-bold">
                        Catatan Serah Terima / Lokasi Kunjungan (Opsional)
                    </label>
                    <input type="text" id="catatan_umum" name="catatan_umum" value="{{ old('catatan_umum') }}"
                        placeholder="Contoh: Diserahkan langsung di rumah penerima RT 02 / Dusun Krajan"
                        class="w-full px-3 py-2.5 rounded-xl border border-border-light bg-canvas-bg text-text-primary text-sm focus:border-primary focus:outline-none">
                </div>
            </div>
        </div>

        <!-- CARD 2: DAFTAR RINCIAN ITEM BANTUAN YANG DISALURKAN -->
        <div class="bg-canvas-bg rounded-2xl p-space-xl shadow-sm border border-border-light flex flex-col gap-space-md">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-md pb-space-sm border-b border-border-light">
                <div>
                    <h2 class="font-title-md text-title-md font-bold text-text-primary flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[20px]">category</span>
                        2. Rincian Bantuan yang Diserahkan (Bibit, Uang, atau Barang)
                    </h2>
                    <p class="text-xs text-text-secondary mt-0.5">
                        Tentukan item yang diserahkan. Jika berupa <strong>Uang</strong>, wajib cantumkan <strong>jumlah uang & peruntukan penggunaannya</strong>.
                    </p>
                </div>
                <button type="button" onclick="addNewItemRow()" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-gov-green-surface text-primary border border-primary/20 text-xs font-bold hover:bg-primary hover:text-on-primary transition-all self-start sm:self-auto">
                    <span class="material-symbols-outlined text-[16px]">add_circle</span>
                    <span>+ Tambah Rincian Item Lain</span>
                </button>
            </div>

            <!-- CONTAINER DYNAMIC ROWS -->
            <div id="itemsContainer" class="flex flex-col gap-space-md">
                <!-- Row template will be cloned or inserted here -->
            </div>

            <div class="pt-2">
                <button type="button" onclick="addNewItemRow()" class="w-full py-2.5 border-2 border-dashed border-border-light hover:border-primary text-text-secondary hover:text-primary rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    <span>Tambah Item Bantuan Lainnya (Bibit / Uang / Alat)</span>
                </button>
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="flex items-center justify-end gap-3 pt-space-md">
            <a href="{{ route('pendamping.penyaluran-bantuan.index') }}" class="px-5 py-2.5 rounded-xl border border-border-light text-text-secondary font-semibold hover:bg-surface-subtle transition-all text-sm">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-primary text-on-primary font-bold hover:bg-gov-green-dark transition-all text-sm shadow-md hover:shadow-lg flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">send</span>
                <span>Simpan & Salurkan Bantuan</span>
            </button>
        </div>
    </form>
</div>

<!-- DATA MASTER ITEMS PER PROGRAM DARI CONTROLLER UNTUK JS REACTIVITY -->
<script>
const programItemsData = {
    @foreach ($programs as $prog)
        "{{ $prog->id }}": [
            @foreach ($prog->itemBantuans as $item)
                {
                    id: {{ $item->id }},
                    jenis: "{{ $item->jenis }}",
                    nama_item: "{{ addslashes($item->nama_item) }}",
                    satuan: "{{ addslashes($item->satuan) }}",
                    nominal_satuan: {{ $item->nominal_satuan ?? 0 }},
                    total_stok: {{ $item->total_stok ?? 0 }},
                    deskripsi: "{{ addslashes($item->deskripsi ?? '') }}"
                },
            @endforeach
        ],
    @endforeach
};

let rowCounter = 0;

function filterKeluargaDropdown() {
    const term = document.getElementById('searchKeluargaInput').value.toLowerCase().trim();
    const select = document.getElementById('selectKeluarga');
    const options = select.options;

    for (let i = 1; i < options.length; i++) {
        const text = options[i].getAttribute('data-text') || '';
        if (text.includes(term)) {
            options[i].style.display = '';
        } else {
            options[i].style.display = 'none';
        }
    }
}

function onProgramChanged() {
    // Re-render all current rows with the items from newly selected program
    const container = document.getElementById('itemsContainer');
    container.innerHTML = '';
    addNewItemRow();
}

function addNewItemRow() {
    const programId = document.getElementById('selectProgram').value;
    const items = programItemsData[programId] || [];

    if (items.length === 0) {
        alert('Program yang dipilih belum memiliki rincian item bantuan dari kampus. Harap minta pihak kampus untuk menambahkan item subsidi terlebih dahulu.');
        return;
    }

    const index = rowCounter++;
    const container = document.getElementById('itemsContainer');

    const rowDiv = document.createElement('div');
    rowDiv.id = `item-row-${index}`;
    rowDiv.className = 'p-space-md rounded-xl border border-border-light bg-surface-subtle flex flex-col gap-3 relative transition-all';

    let optionsHtml = '';
    items.forEach((it, idx) => {
        let badgeJenis = it.jenis.toUpperCase();
        optionsHtml += `<option value="${it.id}" data-jenis="${it.jenis}" data-satuan="${it.satuan}" data-nominal="${it.nominal_satuan}" ${idx === 0 ? 'selected' : ''}>
            [${badgeJenis}] ${it.nama_item} (${it.satuan})
        </option>`;
    });

    rowDiv.innerHTML = `
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="w-6 h-6 rounded-full bg-primary/10 text-primary font-bold text-xs flex items-center justify-center">
                    #${container.children.length + 1}
                </span>
                <span class="text-xs font-bold text-text-primary">Item Bantuan</span>
            </div>
            ${container.children.length > 0 ? `
                <button type="button" onclick="removeItemRow(${index})" class="text-red-500 hover:text-red-700 text-xs font-semibold flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">delete</span>
                    <span>Hapus Baris</span>
                </button>
            ` : ''}
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <!-- SELECT ITEM -->
            <div class="flex flex-col gap-1 md:col-span-2">
                <label class="text-xs font-bold text-text-secondary">Pilih Bantuan dari Kampus <span class="text-red-500">*</span></label>
                <select name="items[${index}][item_bantuan_id]" id="select_item_${index}" onchange="updateRowFields(${index})" required
                    class="w-full px-3 py-2 text-sm rounded-xl border border-border-light bg-canvas-bg font-medium text-text-primary focus:border-primary focus:outline-none">
                    ${optionsHtml}
                </select>
            </div>

            <!-- JUMLAH & SATUAN -->
            <div class="flex flex-col gap-1">
                <label class="text-xs font-bold text-text-secondary" id="label_jumlah_${index}">Jumlah & Satuan <span class="text-red-500">*</span></label>
                <div class="flex items-center gap-1.5">
                    <input type="number" step="any" min="0.01" name="items[${index}][jumlah]" id="input_jumlah_${index}" required value="1"
                        class="w-24 sm:w-28 px-3 py-2 text-sm rounded-xl border border-border-light bg-canvas-bg font-bold text-text-primary focus:border-primary focus:outline-none">
                    <select name="items[${index}][satuan]" id="select_satuan_${index}"
                        class="flex-1 px-2.5 py-2 text-xs font-bold rounded-xl border border-border-light bg-canvas-bg text-text-primary focus:border-primary focus:outline-none">
                        <option value="Unit">Unit</option>
                        <option value="KG">KG</option>
                        <option value="LT">LT</option>
                        <option value="Polybag">Polybag</option>
                        <option value="Batang">Batang</option>
                        <option value="Pohon">Pohon</option>
                        <option value="Biji">Biji</option>
                        <option value="Gram">Gram</option>
                        <option value="Paket">Paket</option>
                        <option value="Set">Set</option>
                        <option value="Sak">Sak</option>
                        <option value="Ekor">Ekor</option>
                        <option value="Rupiah">Rupiah</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- CONDITIONAL FIELDS UNTUK UANG -->
        <div id="uang_fields_${index}" class="p-3 rounded-xl bg-gold-surface/40 border border-secondary/20 flex flex-col gap-3">
            <div class="flex items-center gap-1.5 text-secondary text-xs font-bold">
                <span class="material-symbols-outlined text-[16px]">payments</span>
                <span>Rincian Bantuan Uang Tunai</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-bold text-text-secondary">Nominal Uang Diserahkan (Rp) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3 top-2 text-xs font-bold text-text-tertiary">Rp</span>
                        <input type="number" min="0" step="5000" name="items[${index}][nominal_uang]" id="nominal_uang_${index}" value="1000000"
                            placeholder="Contoh: 1000000"
                            class="w-full pl-9 pr-3 py-1.5 text-sm rounded-lg border border-border-light bg-canvas-bg font-bold text-emerald-800 focus:border-primary focus:outline-none">
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-bold text-text-secondary">Digunakan Untuk Apa (Peruntukan) <span class="text-red-500">*</span></label>
                    <input type="text" name="items[${index}][peruntukan]" id="peruntukan_${index}"
                        placeholder="Contoh: Modal beli bibit lele, pakan & pembuatan kolam terpal"
                        class="w-full px-3 py-1.5 text-sm rounded-lg border border-border-light bg-canvas-bg text-text-primary focus:border-primary focus:outline-none">
                    <span class="text-[10px] text-text-tertiary">Jelaskan rencana penggunaan uang bantuan oleh keluarga.</span>
                </div>
            </div>
        </div>

        <!-- KETERANGAN / SPESIFIKASI TAMBAHAN -->
        <div class="flex flex-col gap-1">
            <label class="text-xs font-bold text-text-secondary">Catatan / Keterangan Kondisi Barang / Bibit (Opsional)</label>
            <input type="text" name="items[${index}][keterangan]"
                placeholder="Contoh: Kompor diterima dalam keadaan baru bersegel / Bibit dalam kondisi segar siap tanam"
                class="w-full px-3 py-1.5 text-xs rounded-lg border border-border-light bg-canvas-bg text-text-primary focus:border-primary focus:outline-none">
        </div>
    `;

    container.appendChild(rowDiv);
    updateRowFields(index);
}

function updateRowFields(index) {
    const select = document.getElementById(`select_item_${index}`);
    if (!select) return;

    const selectedOption = select.options[select.selectedIndex];
    const jenis = selectedOption.getAttribute('data-jenis');
    const satuan = selectedOption.getAttribute('data-satuan') || 'Unit';
    const nominal = selectedOption.getAttribute('data-nominal') || 0;

    const selectSatuan = document.getElementById(`select_satuan_${index}`);
    const uangBox = document.getElementById(`uang_fields_${index}`);
    const inputJumlah = document.getElementById(`input_jumlah_${index}`);
    const inputNominal = document.getElementById(`nominal_uang_${index}`);
    const labelJumlah = document.getElementById(`label_jumlah_${index}`);

    if (selectSatuan && satuan) {
        let matched = false;
        for (let i = 0; i < selectSatuan.options.length; i++) {
            if (selectSatuan.options[i].value.toLowerCase() === satuan.toLowerCase()) {
                selectSatuan.selectedIndex = i;
                matched = true;
                break;
            }
        }
        if (!matched) {
            const newOpt = document.createElement('option');
            newOpt.value = satuan;
            newOpt.text = satuan;
            newOpt.selected = true;
            selectSatuan.appendChild(newOpt);
        }
    }

    if (jenis === 'uang') {
        uangBox.classList.remove('hidden');
        labelJumlah.innerHTML = 'Jumlah Paket & Satuan <span class="text-red-500">*</span>';
        if (nominal > 0 && (!inputNominal.value || inputNominal.value == '0')) {
            inputNominal.value = nominal;
        }
    } else {
        uangBox.classList.add('hidden');
        if (jenis === 'bibit') {
            labelJumlah.innerHTML = 'Banyak Bibit & Satuan <span class="text-red-500">*</span>';
        } else {
            labelJumlah.innerHTML = 'Jumlah Alat & Satuan <span class="text-red-500">*</span>';
        }
    }
}

function removeItemRow(index) {
    const row = document.getElementById(`item-row-${index}`);
    if (row) {
        row.remove();
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    addNewItemRow();
});
</script>
@endsection
