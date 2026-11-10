@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('pendamping.keluarga_penerima.show', $keluarga_penerima->id) }}" class="inline-flex items-center gap-1 text-text-secondary hover:text-primary font-body-sm text-sm transition-colors w-fit">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                <span>Kembali ke Detail Penerima</span>
            </a>
        </div>
        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Edit Data Keluarga Penerima Bantuan</h1>
        <p class="font-body-md text-text-secondary mt-1">
            Perbarui data profil, identitas KTP/KK, wilayah, atau alokasi bantuan untuk keluarga {{ $keluarga_penerima->kepala_keluarga }}.
        </p>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="bg-status-fraud-surface text-status-fraud p-space-md rounded-xl font-body-sm border border-status-fraud/20 flex flex-col gap-1 shadow-sm">
            <div class="flex items-center gap-2 font-bold">
                <span class="material-symbols-outlined text-[20px]">error</span>
                <span>Mohon periksa kembali formulir perubahan:</span>
            </div>
            <ul class="list-disc list-inside text-xs pl-6 space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light p-space-xl">
        <form action="{{ route('pendamping.keluarga_penerima.update', $keluarga_penerima->id) }}" method="POST" class="flex flex-col gap-6">
            @csrf
            @method('PUT')

            <!-- Section 1: Identitas Kependudukan -->
            <div>
                <div class="flex items-center gap-2 pb-2 border-b border-border-light mb-4">
                    <span class="material-symbols-outlined text-primary text-[20px]">badge</span>
                    <h2 class="font-bold text-text-primary text-base">1. Identitas Kependudukan (KTP & KK)</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nik" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                            NIK Kepala Keluarga <span class="text-status-fraud">*</span>
                        </label>
                        <input type="text" name="nik" id="nik" value="{{ old('nik', $keluarga_penerima->nik) }}" required maxlength="16" minlength="16"
                            placeholder="16 digit NIK sesuai KTP"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary font-mono text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                        <div id="nik-dup-alert" class="hidden text-xs text-status-fraud font-medium mt-1 flex items-start gap-1 p-2 rounded-lg bg-status-fraud-surface border border-status-fraud/20"></div>
                    </div>

                    <div>
                        <label for="no_kk" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                            Nomor Kartu Keluarga (KK) <span class="text-status-fraud">*</span>
                        </label>
                        <input type="text" name="no_kk" id="no_kk" value="{{ old('no_kk', $keluarga_penerima->no_kk) }}" required maxlength="16" minlength="16"
                            placeholder="16 digit Nomor Kartu Keluarga"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary font-mono text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                        <div id="no-kk-dup-alert" class="hidden text-xs text-status-fraud font-medium mt-1 flex items-start gap-1 p-2 rounded-lg bg-status-fraud-surface border border-status-fraud/20"></div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="kepala_keluarga" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                            Nama Lengkap Kepala Keluarga <span class="text-status-fraud">*</span>
                        </label>
                        <input type="text" name="kepala_keluarga" id="kepala_keluarga" value="{{ old('kepala_keluarga', $keluarga_penerima->kepala_keluarga) }}" required
                            placeholder="Nama lengkap sesuai KTP / KK"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary font-medium text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    </div>
                </div>
            </div>

            <!-- Section 2: Wilayah & Lokasi Tempat Tinggal -->
            <div>
                <div class="flex items-center gap-2 pb-2 border-b border-border-light mb-4">
                    <span class="material-symbols-outlined text-primary text-[20px]">location_on</span>
                    <h2 class="font-bold text-text-primary text-base">2. Lokasi Wilayah Binaan & Alamat</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="wilayah_id" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                            Desa / Kelurahan Binaan <span class="text-status-fraud">*</span>
                        </label>
                        @include('components.searchable-select', [
                            'name' => 'wilayah_id',
                            'id' => 'wilayah_id',
                            'value' => old('wilayah_id', $keluarga_penerima->wilayah_id),
                            'options' => $wilayahs,
                            'placeholder' => '-- Cari / Pilih Wilayah Desa --',
                            'searchPlaceholder' => 'Ketik nama desa atau kecamatan (misal: Moyo, Alas, Utan)...',
                            'required' => true,
                            'icon' => 'location_on'
                        ])
                    </div>

                    <div>
                        <label for="alamat" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                            Alamat Lengkap / Dusun / RT / RW
                        </label>
                        <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $keluarga_penerima->alamat) }}"
                            placeholder="Contoh: Dusun Timur RT 02 / RW 01"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    </div>
                </div>
            </div>

            <!-- Section 3: Program Bantuan & Status Kemandirian -->
            <div>
                <div class="flex items-center gap-2 pb-2 border-b border-border-light mb-4">
                    <span class="material-symbols-outlined text-primary text-[20px]">inventory_2</span>
                    <h2 class="font-bold text-text-primary text-base">3. Program Bantuan &amp; Indikator Kemandirian</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="program_bantuan_id" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                            Program Bantuan Bibit <span class="text-status-fraud">*</span>
                        </label>
                        <select name="program_bantuan_id" id="program_bantuan_id" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                            @foreach ($programs as $prog)
                                <option value="{{ $prog->id }}" {{ old('program_bantuan_id', $keluarga_penerima->program_bantuan_id) == $prog->id ? 'selected' : '' }}>
                                    {{ $prog->nama_program }} ({{ $prog->tahun_anggaran }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="desil" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                            Indikator Kemandirian <span class="text-status-fraud">*</span>
                        </label>
                        <select name="desil" id="desil" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all font-semibold">
                            <option value="1" {{ old('desil', $keluarga_penerima->desil) == 1 ? 'selected' : '' }}>Tingkat 1 - Perlu Intervensi Ekstrem (Tahap Kemandirian)</option>
                            <option value="2" {{ old('desil', $keluarga_penerima->desil) == 2 ? 'selected' : '' }}>Tingkat 2 - Sangat Rentan (Tahap Kemandirian)</option>
                            <option value="3" {{ old('desil', $keluarga_penerima->desil) == 3 ? 'selected' : '' }}>Tingkat 3 - Rentan / Tahap Awal (Tahap Kemandirian)</option>
                            <option value="4" {{ old('desil', $keluarga_penerima->desil) == 4 ? 'selected' : '' }}>Tingkat 4 - Berkembang Bawah (Tahap Kemandirian)</option>
                            <option value="5" {{ old('desil', $keluarga_penerima->desil) == 5 ? 'selected' : '' }}>Tingkat 5 - Berkembang Menengah (Tahap Kemandirian)</option>
                            <option value="6" {{ old('desil', $keluarga_penerima->desil) == 6 ? 'selected' : '' }}>Tingkat 6 - Mandiri Awal (Sudah Mandiri)</option>
                            <option value="7" {{ old('desil', $keluarga_penerima->desil) == 7 ? 'selected' : '' }}>Tingkat 7 - Mandiri Madya (Sudah Mandiri)</option>
                            <option value="8" {{ old('desil', $keluarga_penerima->desil) == 8 ? 'selected' : '' }}>Tingkat 8 - Mandiri Maju (Sudah Mandiri)</option>
                            <option value="9" {{ old('desil', $keluarga_penerima->desil) == 9 ? 'selected' : '' }}>Tingkat 9 - Mandiri Unggul (Sudah Mandiri)</option>
                            <option value="10" {{ old('desil', $keluarga_penerima->desil) == 10 ? 'selected' : '' }}>Tingkat 10 - Mandiri Utama / Sejahtera (Sudah Mandiri)</option>
                        </select>
                    </div>

                    <div>
                        <label for="penghasilan_perbulan" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                            Penghasilan per Bulan (Rp)
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-text-secondary text-sm font-semibold">Rp</span>
                            <input type="number" step="50000" min="0" name="penghasilan_perbulan" id="penghasilan_perbulan"
                                value="{{ old('penghasilan_perbulan', (int)$keluarga_penerima->penghasilan_perbulan) }}"
                                class="w-full pl-11 pr-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="status_validasi" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                            Status Validasi Lapangan
                        </label>
                        <select name="status_validasi" id="status_validasi"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                            <option value="valid" {{ old('status_validasi', $keluarga_penerima->status_validasi) == 'valid' ? 'selected' : '' }}>Valid (Data Lapangan Sesuai)</option>
                            <option value="proses_lapangan" {{ old('status_validasi', $keluarga_penerima->status_validasi) == 'proses_lapangan' ? 'selected' : '' }}>Proses Lapangan</option>
                            <option value="menunggu_validasi" {{ old('status_validasi', $keluarga_penerima->status_validasi) == 'menunggu_validasi' ? 'selected' : '' }}>Menunggu Validasi</option>
                            <option value="anomali" {{ old('status_validasi', $keluarga_penerima->status_validasi) == 'anomali' ? 'selected' : '' }}>Anomali / Perlu Cek Ulang</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi Simpan & Hapus -->
            <div class="pt-4 border-t border-border-light flex flex-col sm:flex-row items-center justify-between gap-3">
                <a href="{{ route('pendamping.keluarga_penerima.show', $keluarga_penerima->id) }}" class="w-full sm:w-auto px-space-md py-2.5 rounded-xl bg-surface-container-high hover:bg-surface-container-highest text-text-secondary hover:text-text-primary font-label-md text-xs font-semibold transition-colors text-center">
                    Batal
                </a>
                <button type="submit" id="submit-btn" class="w-full sm:w-auto px-space-xl py-3 rounded-xl bg-primary hover:bg-gov-green-dark text-white font-label-md text-sm font-bold shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    <span>Simpan Perubahan Data Penerima</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nikInput = document.getElementById('nik');
    const noKkInput = document.getElementById('no_kk');
    const nikAlert = document.getElementById('nik-dup-alert');
    const noKkAlert = document.getElementById('no-kk-dup-alert');
    const submitBtn = document.getElementById('submit-btn');
    const form = submitBtn ? submitBtn.closest('form') : null;
    const excludeId = "{{ $keluarga_penerima->id }}";

    let nikDuplicate = false;
    let noKkDuplicate = false;
    let debounceTimer;

    function updateSubmitState() {
        if (!submitBtn) return;
        if (nikDuplicate || noKkDuplicate) {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            submitBtn.title = 'Data NIK atau No. KK sudah terdaftar pada penerima lain.';
        } else {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            submitBtn.title = '';
        }
    }

    function checkDuplication(field, value, alertEl) {
        if (!value || value.length < 12) {
            if (field === 'nik') nikDuplicate = false;
            if (field === 'no_kk') noKkDuplicate = false;
            alertEl.classList.add('hidden');
            alertEl.innerHTML = '';
            updateSubmitState();
            return;
        }

        const params = new URLSearchParams();
        params.append(field, value);
        params.append('exclude_id', excludeId);

        fetch("{{ route('penerima.cek_duplikasi') }}?" + params.toString())
            .then(res => res.json())
            .then(data => {
                if (data.duplicate) {
                    if (field === 'nik') nikDuplicate = true;
                    if (field === 'no_kk') noKkDuplicate = true;
                    alertEl.innerHTML = `<span class="material-symbols-outlined text-[16px] text-status-fraud shrink-0 mt-0.5">error</span><span class="text-status-fraud font-medium leading-tight">${data.message}</span>`;
                    alertEl.classList.remove('hidden');
                } else {
                    if (field === 'nik') nikDuplicate = false;
                    if (field === 'no_kk') noKkDuplicate = false;
                    alertEl.classList.add('hidden');
                    alertEl.innerHTML = '';
                }
                updateSubmitState();
            })
            .catch(err => {
                console.error('Gagal memeriksa duplikasi:', err);
            });
    }

    if (nikInput && nikAlert) {
        nikInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const val = this.value.replace(/\D/g, '');
            debounceTimer = setTimeout(() => checkDuplication('nik', val, nikAlert), 400);
        });
    }

    if (noKkInput && noKkAlert) {
        noKkInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const val = this.value.replace(/\D/g, '');
            debounceTimer = setTimeout(() => checkDuplication('no_kk', val, noKkAlert), 400);
        });
    }

    if (form) {
        form.addEventListener('submit', function(e) {
            if (nikDuplicate || noKkDuplicate) {
                e.preventDefault();
                alert('Tidak dapat menyimpan: Data NIK atau No. KK sudah terdaftar dalam sistem!');
                return false;
            }
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `<span class="inline-block animate-spin mr-2">⏳</span> Menyimpan Perubahan...`;
            }
        });
    }
});
</script>
@endsection
