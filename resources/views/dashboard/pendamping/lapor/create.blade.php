@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col">
        <a href="{{ route('pendamping.lapor.index') }}" class="inline-flex items-center gap-1 text-text-secondary hover:text-primary mb-space-md font-label-md transition-colors w-fit">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Laporan Kunjungan</span>
        </a>
        <div class="flex items-center gap-2 mb-1">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gov-green-surface text-primary">
                <span class="material-symbols-outlined text-[14px] mr-1">assignment</span>
                MONITORING KUNJUNGAN PER PROGRAM
            </span>
            <span class="text-xs text-text-tertiary">Pencatatan Laporan Kunjungan per Program</span>
        </div>
        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Input Laporan Kunjungan Lapangan</h1>
        <p class="text-xs text-text-secondary mt-1">
            Catat hasil kunjungan berkala untuk memantau perkembangan bantuan keluarga penerima bantuan berdasarkan program kampus yang diterima.
        </p>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="bg-error-container text-on-error-container p-space-md rounded-xl font-body-sm border border-error/20">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pendamping.lapor.store') }}" method="POST" class="flex flex-col gap-space-lg">
        @csrf

        <!-- CARD 1: PILIH PROGRAM KAMPUS & BANTUAN YANG DIPANTAU -->
        <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light p-space-xl flex flex-col gap-space-md">
            <div class="flex items-center justify-between pb-space-sm border-b border-border-light">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-[22px]">volunteer_activism</span>
                    <h2 class="font-title-md text-title-md font-bold text-text-primary">1. Identifikasi Program & Bantuan yang Dipantau</h2>
                </div>
                <a href="{{ route('pendamping.penyaluran-bantuan.create') }}" class="text-xs text-primary hover:underline font-semibold flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">add_circle</span>
                    <span>+ Salurkan Bantuan Baru</span>
                </a>
            </div>

            <!-- Langkah 1: Pilih Program Bantuan Kampus Mitra -->
            <div class="flex flex-col gap-1.5">
                <label for="program_bantuan_id" class="font-label-sm text-label-sm text-text-secondary font-bold flex items-center gap-2">
                    <span class="w-5 h-5 rounded-full bg-primary text-white text-[11px] font-bold flex items-center justify-center">1</span>
                    <span>Pilih Program Kampus yang Sedang Dipantau</span>
                    <span class="text-status-error">*</span>
                </label>
                <select name="program_bantuan_id" id="program_bantuan_id" required onchange="onProgramChanged(this.value)"
                    class="w-full px-3 py-2.5 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm font-semibold focus:border-primary focus:bg-canvas-bg focus:outline-none transition-all">
                    <option value="">-- Pilih Program Kampus Mitra Terlebih Dahulu --</option>
                    @foreach ($programs as $prog)
                        <option value="{{ $prog->id }}"
                            data-kampus="{{ $prog->kampusMitra->nama_universitas ?? $prog->kampusMitra->nama_kampus ?? 'Kampus Mitra' }}"
                            {{ (old('program_bantuan_id', $selectedProgramId) == $prog->id) ? 'selected' : '' }}>
                            {{ $prog->nama_program }} — [{{ $prog->kampusMitra->nama_universitas ?? $prog->kampusMitra->nama_kampus ?? 'Kampus Mitra' }}] (TA {{ $prog->tahun_anggaran ?? '-' }})
                        </option>
                    @endforeach
                </select>

                <!-- Banner Proteksi Program -->
                <div class="p-3 bg-blue-50/80 border border-blue-200 rounded-xl text-xs text-blue-900 flex items-start gap-2.5">
                    <span class="material-symbols-outlined text-[18px] text-blue-700 shrink-0 mt-0.5">verified_user</span>
                    <div class="leading-relaxed">
                        <strong class="font-bold text-blue-950">Update Terisolasi per Program:</strong> Laporan perkembangan ini hanya memperbarui status program yang Anda pilih. Laporan dari program kampus lainnya pada keluarga yang sama akan tetap utuh, terpisah, dan <strong>tidak akan tertindih</strong>.
                    </div>
                </div>
            </div>

            <!-- Langkah 2: Pilih Bantuan Tersalurkan pada Program Tersebut -->
            <div class="flex flex-col gap-1.5">
                <label for="penyaluran_bantuan_id" class="font-label-sm text-label-sm text-text-secondary font-bold flex items-center gap-2">
                    <span class="w-5 h-5 rounded-full bg-primary text-white text-[11px] font-bold flex items-center justify-center">2</span>
                    <span>Pilih Keluarga & Item Bantuan dalam Program Terpilih</span>
                    <span class="text-status-error">*</span>
                </label>
                <select name="penyaluran_bantuan_id" id="penyaluran_bantuan_id" required onchange="onPenyaluranSelected(this.value)"
                    class="w-full px-3 py-2.5 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm font-semibold focus:border-primary focus:bg-canvas-bg focus:outline-none transition-all">
                    <option value="">-- Pilih Bantuan Tersalurkan yang Diterima Keluarga Binaan --</option>
                    @foreach ($penyalurans as $peny)
                        <option value="{{ $peny->id }}" 
                            data-program-id="{{ $peny->program_bantuan_id }}"
                            data-keluarga-id="{{ $peny->keluarga_penerima_id }}"
                            data-nama-keluarga="{{ $peny->keluargaPenerima->kepala_keluarga ?? '-' }}"
                            data-nik="{{ $peny->keluargaPenerima->nik ?? '-' }}"
                            data-desa="{{ $peny->keluargaPenerima->wilayah->nama ?? '-' }}"
                            data-desil="{{ $peny->keluargaPenerima->desil ?? '-' }}"
                            data-jenis="{{ $peny->jenis }}"
                            data-nama-item="{{ $peny->itemBantuan->nama_item ?? '-' }}"
                            data-jumlah="{{ $peny->jenis === 'uang' ? 'Rp ' . number_format($peny->nominal_uang ?? $peny->jumlah, 0, ',', '.') : number_format($peny->jumlah) . ' ' . $peny->satuan }}"
                            data-tgl-salur="{{ \Carbon\Carbon::parse($peny->tgl_penyaluran)->translatedFormat('d F Y') }}"
                            data-program="{{ $peny->programBantuan->nama_program ?? '-' }}"
                            data-peruntukan="{{ $peny->peruntukan ?? '' }}"
                            {{ (old('penyaluran_bantuan_id', $selectedPenyaluranId) == $peny->id) ? 'selected' : '' }}>
                            {{ $peny->keluargaPenerima->kepala_keluarga ?? '-' }} — [{{ strtoupper($peny->jenis) }}] {{ $peny->itemBantuan->nama_item ?? '-' }} (Disalurkan: {{ \Carbon\Carbon::parse($peny->tgl_penyaluran)->format('d/m/Y') }})
                        </option>
                    @endforeach
                </select>
                <span class="text-[11px] text-text-tertiary">Daftar bantuan otomatis disaring berdasarkan program kampus yang Anda pilih di atas.</span>
            </div>

            <!-- Hidden input keluarga_penerima_id (otomatis tersinkron) -->
            <input type="hidden" name="keluarga_penerima_id" id="hidden_keluarga_penerima_id" value="{{ old('keluarga_penerima_id', $selectedKeluargaId) }}">

            <!-- KARTU RINGKASAN BANTUAN YANG TERPILIH -->
            <div id="aidSummaryCard" class="p-space-lg rounded-xl border border-border-light bg-surface-subtle flex flex-col gap-3 transition-all">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span id="summaryBadgeJenis" class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-primary text-on-primary uppercase">
                            Bibit
                        </span>
                        <span id="summaryProgramName" class="text-xs text-text-secondary font-bold">Program Bantuan</span>
                    </div>
                    <span id="summaryTglSalur" class="text-xs text-text-tertiary">Disalurkan: -</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 border-t border-border-light/60">
                    <div>
                        <span class="text-[11px] text-text-tertiary block font-semibold">Penerima Bantuan:</span>
                        <h4 id="summaryNamaKeluarga" class="text-sm font-bold text-text-primary">-</h4>
                        <span id="summaryDetailPenerima" class="text-xs text-text-secondary block">NIK: - • Desa: -</span>
                    </div>
                    <div>
                        <span class="text-[11px] text-text-tertiary block font-semibold">Item & Jumlah Bantuan:</span>
                        <h4 id="summaryNamaItem" class="text-sm font-bold text-text-primary">-</h4>
                        <span id="summaryJumlah" class="text-xs font-semibold text-primary block">-</span>
                    </div>
                </div>

                <div id="summaryPeruntukanRow" class="hidden p-2 rounded-lg bg-gold-surface border border-secondary/20 text-xs text-secondary font-medium">
                    <span>Peruntukan Modal: </span><strong id="summaryPeruntukanText">-</strong>
                </div>
            </div>
        </div>

        <!-- CARD 2: CATATAN KUNJUNGAN & PERKEMBANGAN TERKINI -->
        <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light p-space-xl flex flex-col gap-space-md">
            <div class="flex items-center gap-2 pb-space-sm border-b border-border-light">
                <span class="material-symbols-outlined text-primary text-[22px]">edit_note</span>
                <h2 class="font-title-md text-title-md font-bold text-text-primary">2. Hasil Kunjungan & Perkembangan Terkini</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <!-- Tanggal Lapor / Kunjungan -->
                <div class="flex flex-col gap-1.5">
                    <label for="tanggal_lapor" class="font-label-sm text-label-sm text-text-secondary font-bold">
                        Tanggal Kunjungan / Lapor <span class="text-status-error">*</span>
                    </label>
                    <input type="date" name="tanggal_lapor" id="tanggal_lapor" value="{{ old('tanggal_lapor', date('Y-m-d')) }}" required
                        class="w-full px-3 py-2.5 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm focus:border-primary focus:bg-canvas-bg focus:outline-none transition-all">
                    <span class="text-[11px] text-text-tertiary">Tanggal saat Anda datang memantau kondisi bantuan di lapangan.</span>
                </div>

                <!-- Status Kondisi Perkembangan -->
                <div class="flex flex-col gap-1.5">
                    <label for="status_kondisi" class="font-label-sm text-label-sm text-text-secondary font-bold">
                        Status Kondisi Perkembangan <span class="text-status-error">*</span>
                    </label>
                    <select name="status_kondisi" id="status_kondisi" required
                        class="w-full px-3 py-2.5 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm font-semibold focus:border-primary focus:bg-canvas-bg focus:outline-none transition-all">
                        <option value="normal" {{ old('status_kondisi') == 'normal' ? 'selected' : '' }} id="optStatusNormal">
                            Normal / Tumbuh Subur / Produktif
                        </option>
                        <option value="hama" {{ old('status_kondisi') == 'hama' ? 'selected' : '' }} id="optStatusHama">
                            Terserang Hama / Ada Kendala Operasional
                        </option>
                        <option value="gagal" {{ old('status_kondisi') == 'gagal' ? 'selected' : '' }} id="optStatusGagal">
                            Gagal Tumbuh / Mati / Rusak
                        </option>
                    </select>
                    <span class="text-[11px] text-text-tertiary">Klasifikasi kondisi kesehatan bibit / kelancaran modal / fungsi alat.</span>
                </div>
            </div>

            <!-- Catatan Detail Kunjungan Lapangan -->
            <div class="flex flex-col gap-1.5">
                <label for="catatan" class="font-label-sm text-label-sm text-text-secondary font-bold">
                    Catatan Perkembangan Lapangan <span class="text-status-error">*</span>
                </label>
                <textarea name="catatan" id="catatan" rows="4" required
                    class="w-full px-3 py-2.5 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm focus:border-primary focus:bg-canvas-bg focus:outline-none transition-all"
                    placeholder="Contoh: Bibit telah ditanam di polybag pekarangan, pertumbuhan daun baik dan segar tanpa ada serangan hama...">{{ old('catatan') }}</textarea>
                <span class="text-[11px] text-text-tertiary">Jelaskan temuan kondisi riil bantuan saat kunjungan (pertumbuhan bibit, pemanfaatan modal, atau keaktifan alat).</span>
            </div>

            <!-- Foto Bukti Lapangan (URL) -->
            <div class="flex flex-col gap-1.5">
                <label for="foto_url" class="font-label-sm text-label-sm text-text-secondary font-bold">
                    Foto Bukti Lapangan / Kondisi Bantuan (URL) (Opsional)
                </label>
                <input type="text" name="foto_url" id="foto_url" value="{{ old('foto_url') }}"
                    class="w-full px-3 py-2.5 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm focus:border-primary focus:bg-canvas-bg focus:outline-none transition-all"
                    placeholder="https://images.unsplash.com/... atau URL foto dokumentasi">
                <span class="text-[11px] text-text-tertiary">Cantumkan tautan foto pohon/tanaman bibit atau kegiatan pemanfaatan bantuan jika ada.</span>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex items-center justify-end gap-3 pt-space-xs">
            <a href="{{ route('pendamping.lapor.index') }}" class="px-5 py-2.5 rounded-xl border border-border-light text-text-secondary font-semibold hover:bg-surface-subtle transition-all text-sm">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-primary text-on-primary font-bold hover:bg-gov-green-dark transition-all text-sm shadow-md hover:shadow-lg flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">save</span>
                <span>Simpan Perkembangan Program Ini</span>
            </button>
        </div>
    </form>
</div>

<!-- JAVASCRIPT LOGIC UNTUK FILTER PROGRAM & REACTIVITY BANTUAN -->
<script>
// Filter opsi penyaluran bantuan berdasarkan program terpilih
function onProgramChanged(programId) {
    const penyaluranSelect = document.getElementById('penyaluran_bantuan_id');
    const options = penyaluranSelect.querySelectorAll('option');

    let firstMatch = null;

    options.forEach(option => {
        if (!option.value) {
            option.style.display = '';
            return;
        }

        const optionProgramId = option.getAttribute('data-program-id');

        if (!programId || optionProgramId === programId) {
            option.style.display = '';
            if (!firstMatch) {
                firstMatch = option;
            }
        } else {
            option.style.display = 'none';
        }
    });

    // Jika opsi yang saat ini terpilih tidak sesuai dengan program yang baru dipilih, ubah pilihan
    const currentSelected = penyaluranSelect.options[penyaluranSelect.selectedIndex];
    if (currentSelected && currentSelected.value && currentSelected.getAttribute('data-program-id') !== programId) {
        if (firstMatch) {
            penyaluranSelect.value = firstMatch.value;
            onPenyaluranSelected(firstMatch.value);
        } else {
            penyaluranSelect.value = '';
            document.getElementById('aidSummaryCard').classList.add('opacity-50');
        }
    }
}

function onPenyaluranSelected(penyaluranId) {
    const select = document.getElementById('penyaluran_bantuan_id');
    const selectedOption = select.options[select.selectedIndex];

    if (!selectedOption || !selectedOption.value) {
        document.getElementById('aidSummaryCard').classList.add('opacity-50');
        return;
    }

    document.getElementById('aidSummaryCard').classList.remove('opacity-50');

    const programId = selectedOption.getAttribute('data-program-id');
    const keluargaId = selectedOption.getAttribute('data-keluarga-id');
    const namaKeluarga = selectedOption.getAttribute('data-nama-keluarga');
    const nik = selectedOption.getAttribute('data-nik');
    const desa = selectedOption.getAttribute('data-desa');
    const desil = selectedOption.getAttribute('data-desil');
    const jenis = selectedOption.getAttribute('data-jenis') || 'bibit';
    const namaItem = selectedOption.getAttribute('data-nama-item');
    const jumlah = selectedOption.getAttribute('data-jumlah');
    const tglSalur = selectedOption.getAttribute('data-tgl-salur');
    const program = selectedOption.getAttribute('data-program');
    const peruntukan = selectedOption.getAttribute('data-peruntukan');

    // Pastikan program_bantuan_id di select program tersinkron
    const programSelect = document.getElementById('program_bantuan_id');
    if (programSelect && programId && programSelect.value !== programId) {
        programSelect.value = programId;
    }

    // Update hidden input
    document.getElementById('hidden_keluarga_penerima_id').value = keluargaId;

    // Update Summary Card
    const badge = document.getElementById('summaryBadgeJenis');
    badge.innerText = jenis.toUpperCase();
    if (jenis === 'uang') {
        badge.className = 'px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-500 text-white uppercase';
    } else if (jenis === 'barang') {
        badge.className = 'px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-600 text-white uppercase';
    } else {
        badge.className = 'px-2.5 py-0.5 rounded-full text-xs font-bold bg-primary text-on-primary uppercase';
    }

    document.getElementById('summaryProgramName').innerText = program;
    document.getElementById('summaryTglSalur').innerText = 'Disalurkan: ' + tglSalur;
    document.getElementById('summaryNamaKeluarga').innerText = namaKeluarga;
    document.getElementById('summaryDetailPenerima').innerText = `NIK: ${nik} • Desa: ${desa} • Desil: ${desil}`;
    document.getElementById('summaryNamaItem').innerText = namaItem;
    document.getElementById('summaryJumlah').innerText = jumlah;

    const peruntukanRow = document.getElementById('summaryPeruntukanRow');
    if (peruntukan && peruntukan.trim() !== '') {
        peruntukanRow.classList.remove('hidden');
        document.getElementById('summaryPeruntukanText').innerText = peruntukan;
    } else {
        peruntukanRow.classList.add('hidden');
    }

    // Sesuaikan Label Status Kondisi & Placeholder Catatan berdasarkan Jenis Bantuan
    const optNormal = document.getElementById('optStatusNormal');
    const optHama = document.getElementById('optStatusHama');
    const optGagal = document.getElementById('optStatusGagal');
    const inputCatatan = document.getElementById('catatan');

    if (jenis === 'uang') {
        optNormal.innerText = 'Modal Produktif / Usaha Berkembang';
        optHama.innerText = 'Ada Kendala Operasional Usaha';
        optGagal.innerText = 'Modal Habis / Usaha Terhenti';
        if (!inputCatatan.value) {
            inputCatatan.placeholder = 'Jelaskan bagaimana dana modal dibelanjakan, omzet penjualan, atau kendala permodalan keluarga penerima...';
        }
    } else if (jenis === 'barang') {
        optNormal.innerText = 'Alat Berfungsi Baik & Produktif Digunakan';
        optHama.innerText = 'Alat Mengalami Kerusakan Ringan / Butuh Perbaikan';
        optGagal.innerText = 'Alat Rusak Total / Hilang / Tidak Digunakan';
        if (!inputCatatan.value) {
            inputCatatan.placeholder = 'Jelaskan intensitas pemakaian alat, kondisi fisik alat, atau dampak alat terhadap kegiatan usaha...';
        }
    } else {
        optNormal.innerText = 'Normal / Tumbuh Subur / Produktif';
        optHama.innerText = 'Terserang Hama / Penyakit Tanaman';
        optGagal.innerText = 'Gagal Tumbuh / Mati / Puso';
        if (!inputCatatan.value) {
            inputCatatan.placeholder = 'Jelaskan tinggi tanaman bibit, kondisi daun/buah, pemupukan, atau kondisi lahan...';
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const progSelect = document.getElementById('program_bantuan_id');
    const penyaluranSelect = document.getElementById('penyaluran_bantuan_id');

    if (progSelect && progSelect.value) {
        onProgramChanged(progSelect.value);
    }

    if (penyaluranSelect && penyaluranSelect.value) {
        onPenyaluranSelected(penyaluranSelect.value);
    } else if (progSelect && progSelect.value) {
        // Otomatis pilih opsi pertama yang sesuai jika ada
        const firstVisibleOption = Array.from(penyaluranSelect.options).find(opt => opt.value && opt.style.display !== 'none');
        if (firstVisibleOption) {
            penyaluranSelect.value = firstVisibleOption.value;
            onPenyaluranSelected(firstVisibleOption.value);
        }
    }
});
</script>
@endsection
