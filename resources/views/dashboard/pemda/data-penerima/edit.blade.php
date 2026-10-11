@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <div class="flex flex-col">
        <a href="{{ route('pemda.data-penerima.index') }}" class="inline-flex items-center gap-1 text-text-secondary hover:text-primary mb-space-md font-label-md transition-colors w-fit">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Data Penerima</span>
        </a>
        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Edit Penerima</h1>
        <p class="font-body-md text-text-secondary mt-1">
            Ubah data Calon KeluargaPenerima Calon Lokasi (CPCL).
        </p>
    </div>

    @if ($errors->any())
        <div class="bg-error-container text-on-error-container p-space-md rounded-xl font-body-sm mb-space-md border border-error/20">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-xl">
        <form action="{{ route('pemda.data-penerima.update', $keluarga_penerima->id) }}" method="POST" class="flex flex-col gap-space-lg">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="nik" class="font-label-md text-text-primary">NIK <span class="text-error">*</span></label>
                    <input type="text" name="nik" id="nik" value="{{ old('nik', $keluarga_penerima->nik) }}" required maxlength="16" minlength="16"
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle"
                        placeholder="16 Digit NIK">
                </div>
                
                <div class="flex flex-col gap-space-xs">
                    <label for="kepala_keluarga" class="font-label-md text-text-primary">Kepala Keluarga Lengkap <span class="text-error">*</span></label>
                    <input type="text" name="kepala_keluarga" id="kepala_keluarga" value="{{ old('kepala_keluarga', $keluarga_penerima->kepala_keluarga) }}" required
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="no_kk" class="font-label-md text-text-primary">No. KK</label>
                    <input type="text" name="no_kk" id="no_kk" value="{{ old('no_kk', $keluarga_penerima->no_kk) }}"
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle"
                        placeholder="Opsional">
                </div>
                
                <div class="flex flex-col gap-space-xs">
                    <label for="desil" class="font-label-md text-text-primary">Desil (Ha)</label>
                    <input type="number" step="0.01" name="desil" id="desil" value="{{ old('desil', $keluarga_penerima->desil) }}"
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="wilayah_id" class="font-label-md text-text-primary">Wilayah <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="wilayah_id" id="wilayah_id" required
                            class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                            @foreach ($wilayahs as $w)
                                <option value="{{ $w->id }}" {{ old('wilayah_id', $keluarga_penerima->wilayah_id) == $w->id ? 'selected' : '' }}>{{ $w->nama }} ({{ $w->kode_wilayah }})</option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>

                <div class="flex flex-col gap-space-xs">
                    <label for="program_bantuan_id" class="font-label-md text-text-primary">Program Bantuan <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="program_bantuan_id" id="program_bantuan_id" required
                            class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                            @foreach ($programs as $p)
                                <option value="{{ $p->id }}" {{ old('program_bantuan_id', $keluarga_penerima->program_bantuan_id) == $p->id ? 'selected' : '' }}>{{ $p->nama_program }}</option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-space-xs">
                <label for="status_validasi" class="font-label-md text-text-primary">Status Validasi <span class="text-error">*</span></label>
                <div class="relative">
                    <select name="status_validasi" id="status_validasi" required
                        class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                        <option value="menunggu_validasi" {{ old('status_validasi', $keluarga_penerima->status_validasi) == 'menunggu_validasi' ? 'selected' : '' }}>Menunggu Validasi</option>
                        <option value="proses_lapangan" {{ old('status_validasi', $keluarga_penerima->status_validasi) == 'proses_lapangan' ? 'selected' : '' }}>Proses Lapangan</option>
                        <option value="valid" {{ old('status_validasi', $keluarga_penerima->status_validasi) == 'valid' ? 'selected' : '' }}>Valid</option>
                        <option value="anomali" {{ old('status_validasi', $keluarga_penerima->status_validasi) == 'anomali' ? 'selected' : '' }}>Anomali</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                </div>
            </div>

            <div class="flex items-center justify-end gap-space-sm mt-space-md pt-space-lg border-t border-border-light">
                <a href="{{ route('pemda.data-penerima.index') }}" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold text-text-secondary hover:bg-surface-variant transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold bg-primary-container text-on-primary hover:bg-gov-green-dark transition-colors shadow-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
