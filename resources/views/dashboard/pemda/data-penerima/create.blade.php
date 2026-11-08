@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <div class="flex flex-col">
        <a href="{{ route('pemda.data-penerima.index') }}" class="inline-flex items-center gap-1 text-text-secondary hover:text-primary mb-space-md font-label-md transition-colors w-fit">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Data Penerima</span>
        </a>
        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Tambah Penerima Baru</h1>
        <p class="font-body-md text-text-secondary mt-1">
            Masukkan data Calon KeluargaPenerima Calon Lokasi (CPCL).
        </p>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="bg-error-container text-on-error-container p-space-md rounded-xl font-body-sm mb-space-md border border-error/20">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-xl">
        <form action="{{ route('pemda.data-penerima.store') }}" method="POST" class="flex flex-col gap-space-lg">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="nik" class="font-label-md text-text-primary">NIK <span class="text-error">*</span></label>
                    <input type="text" name="nik" id="nik" value="{{ old('nik') }}" required maxlength="16" minlength="16"
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle font-mono"
                        placeholder="16 Digit NIK">
                    <div id="nik-dup-alert" class="hidden text-xs text-error font-medium mt-1 flex items-start gap-1 p-2 rounded-lg bg-error-container/40 border border-error/20"></div>
                </div>
                
                <div class="flex flex-col gap-space-xs">
                    <label for="kepala_keluarga" class="font-label-md text-text-primary">Kepala Keluarga Lengkap <span class="text-error">*</span></label>
                    <input type="text" name="kepala_keluarga" id="kepala_keluarga" value="{{ old('kepala_keluarga') }}" required
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="no_kk" class="font-label-md text-text-primary">No. KK <span class="text-error">*</span></label>
                    <input type="text" name="no_kk" id="no_kk" value="{{ old('no_kk') }}" required maxlength="16" minlength="16"
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle font-mono"
                        placeholder="16 Digit No. Kartu Keluarga">
                    <div id="no-kk-dup-alert" class="hidden text-xs text-error font-medium mt-1 flex items-start gap-1 p-2 rounded-lg bg-error-container/40 border border-error/20"></div>
                </div>
                
                <div class="flex flex-col gap-space-xs">
                    <label for="desil" class="font-label-md text-text-primary">Desil Kemiskinan <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="desil" id="desil" required
                            class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                            @for($d = 1; $d <= 10; $d++)
                                <option value="{{ $d }}" {{ old('desil', 1) == $d ? 'selected' : '' }}>
                                    Desil {{ $d }} {{ $d >= 6 ? '• Mandiri (Lulus Bantuan)' : '• Prioritas Penerima Bantuan' }}
                                </option>
                            @endfor
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-space-xs">
                <label for="alamat" class="font-label-md text-text-primary">Alamat Lengkap / Dusun / RT-RW</label>
                <textarea name="alamat" id="alamat" rows="2"
                    class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle"
                    placeholder="Contoh: Dusun Karang Anyar RT 02 / RW 01">{{ old('alamat') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="wilayah_id" class="font-label-md text-text-primary">Wilayah Desa / Kelurahan <span class="text-error">*</span></label>
                    @include('components.searchable-select', [
                        'name' => 'wilayah_id',
                        'id' => 'wilayah_id',
                        'value' => old('wilayah_id'),
                        'options' => $wilayahs,
                        'placeholder' => '-- Cari / Pilih Wilayah Desa --',
                        'searchPlaceholder' => 'Ketik nama desa atau kecamatan...',
                        'required' => true,
                        'icon' => 'location_on'
                    ])
                </div>

                <div class="flex flex-col gap-space-xs">
                    <label for="program_bantuan_id" class="font-label-md text-text-primary">Program Bantuan <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="program_bantuan_id" id="program_bantuan_id" required
                            class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                            <option value="">-- Pilih Program --</option>
                            @foreach ($programs as $p)
                                <option value="{{ $p->id }}" {{ old('program_bantuan_id') == $p->id ? 'selected' : '' }}>{{ $p->nama_program }}</option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="pendamping_id" class="font-label-md text-text-primary font-semibold flex items-center gap-1">
                        <span class="material-symbols-outlined text-[18px] text-primary">support_agent</span>
                        <span>Pendamping Lapangan (Opsional)</span>
                    </label>
                    <div class="relative">
                        <select name="pendamping_id" id="pendamping_id"
                            class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                            <option value="">-- Belum Ditugaskan / Tetapkan Nanti --</option>
                            @foreach ($pendampings as $p)
                                <option value="{{ $p->id }}" {{ old('pendamping_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->name }} {{ $p->kampus ? '(' . $p->kampus->nama_universitas . ')' : '' }}
                                </option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>

                <div class="flex flex-col gap-space-xs">
                    <label for="status_validasi" class="font-label-md text-text-primary font-semibold">Status Validasi <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="status_validasi" id="status_validasi" required
                            class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                            <option value="menunggu_validasi" {{ old('status_validasi') == 'menunggu_validasi' ? 'selected' : '' }}>Menunggu Validasi</option>
                            <option value="proses_lapangan" {{ old('status_validasi') == 'proses_lapangan' ? 'selected' : '' }}>Proses Lapangan</option>
                            <option value="valid" {{ old('status_validasi') == 'valid' ? 'selected' : '' }}>Valid</option>
                            <option value="anomali" {{ old('status_validasi') == 'anomali' ? 'selected' : '' }}>Anomali</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-space-sm mt-space-md pt-space-lg border-t border-border-light">
                <a href="{{ route('pemda.data-penerima.index') }}" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold text-text-secondary hover:bg-surface-variant transition-colors">
                    Batal
                </a>
                <button type="submit" id="submit-btn" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold bg-primary-container text-on-primary hover:bg-gov-green-dark transition-colors shadow-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">person_add</span>
                    <span>Simpan Penerima</span>
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

    let nikDuplicate = false;
    let noKkDuplicate = false;
    let debounceTimer;

    function updateSubmitState() {
        if (!submitBtn) return;
        if (nikDuplicate || noKkDuplicate) {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            submitBtn.title = 'Data NIK atau No. KK sudah terdaftar. Perbaiki sebelum menyimpan.';
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

        fetch("{{ route('penerima.cek_duplikasi') }}?" + params.toString())
            .then(res => res.json())
            .then(data => {
                if (data.duplicate) {
                    if (field === 'nik') nikDuplicate = true;
                    if (field === 'no_kk') noKkDuplicate = true;
                    alertEl.innerHTML = `<span class="material-symbols-outlined text-[16px] text-error shrink-0 mt-0.5">error</span><span class="text-error font-medium leading-tight">${data.message}</span>`;
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
                submitBtn.innerHTML = `<span class="inline-block animate-spin mr-2">⏳</span> Menyimpan Data...`;
            }
        });
    }
});
</script>
@endsection
