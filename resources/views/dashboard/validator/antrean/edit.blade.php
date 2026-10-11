@extends('layouts.validator')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <div class="flex flex-col">
        <a href="{{ route('validator.antrean.index') }}" class="inline-flex items-center gap-1 text-text-secondary hover:text-primary mb-space-md font-label-md transition-colors w-fit">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Antrean</span>
        </a>
        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Review Survei Lapangan</h1>
        <p class="font-body-md text-text-secondary mt-1">
            Validasi data survei pendamping lapangan dan tentukan status kelayakan akhir.
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

    <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
        <!-- Informasi Survei Detail -->
        <div class="bg-surface-subtle rounded-xl p-space-lg border border-border-light flex flex-col gap-space-md">
            <h3 class="font-headline-sm text-headline-sm text-text-primary border-b border-border-medium pb-2">Data Laporan Pendamping</h3>
            
            <div class="flex flex-col gap-1">
                <span class="font-label-sm text-text-secondary">Keluarga Penerima (CPCL)</span>
                <span class="font-body-md text-text-primary font-semibold">{{ $antrean->keluarga_penerima->kepala_keluarga ?? $antrean->keluarga_penerima->nama ?? '-' }} (NIK: {{ $antrean->keluarga_penerima->nik ?? '-' }})</span>
            </div>
            
            <div class="flex flex-col gap-1">
                <span class="font-label-sm text-text-secondary">Lokasi / Wilayah</span>
                <span class="font-body-md text-text-primary">{{ $antrean->keluarga_penerima->wilayah->nama ?? '-' }}</span>
            </div>
            
            <div class="flex flex-col gap-1">
                <span class="font-label-sm text-text-secondary">Luas Lahan</span>
                <span class="font-body-md text-text-primary">{{ $antrean->keluarga_penerima->luas_lahan ?? '-' }} Ha</span>
            </div>
            
            <div class="border-t border-border-light my-2"></div>
            
            <div class="flex flex-col gap-1">
                <span class="font-label-sm text-text-secondary">Surveyor / Pendamping</span>
                <span class="font-body-md text-text-primary">{{ $antrean->pendamping->name ?? '-' }}</span>
            </div>
            
            <div class="flex flex-col gap-1">
                <span class="font-label-sm text-text-secondary">Tanggal Survei Lapangan</span>
                <span class="font-body-md text-text-primary">{{ \Carbon\Carbon::parse($antrean->tgl_survei)->format('d M Y') }}</span>
            </div>
            
            <div class="flex flex-col gap-1 mt-2">
                <span class="font-label-sm text-text-secondary">Catatan Pendamping</span>
                <div class="p-3 bg-canvas-bg rounded-lg border border-border-light text-text-primary text-body-sm italic">
                    "{{ $antrean->catatan ?? 'Tidak ada catatan.' }}"
                </div>
            </div>
        </div>

        <!-- Form Review -->
        <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-xl">
            <form action="{{ route('validator.antrean.update', $antrean->id) }}" method="POST" class="flex flex-col gap-space-lg">
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-space-xs">
                    <label for="status_kelayakan" class="font-label-md text-text-primary">Keputusan Review (Kelayakan) <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="status_kelayakan" id="status_kelayakan" required
                            class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                            <option value="review" {{ old('status_kelayakan', $antrean->status_kelayakan) == 'review' ? 'selected' : '' }}>Masih Review / Tunda</option>
                            <option value="layak" {{ old('status_kelayakan', $antrean->status_kelayakan) == 'layak' ? 'selected' : '' }}>Setuju (LAYAK)</option>
                            <option value="tidak_layak" {{ old('status_kelayakan', $antrean->status_kelayakan) == 'tidak_layak' ? 'selected' : '' }}>Tolak (TIDAK LAYAK)</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>

                <div class="flex flex-col gap-space-xs">
                    <label for="catatan" class="font-label-md text-text-primary">Catatan Tambahan Validator (Opsional)</label>
                    <textarea name="catatan" id="catatan" rows="5"
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle"
                        placeholder="Tambahkan catatan hasil review Anda...">{{ old('catatan', $antrean->catatan) }}</textarea>
                </div>

                <div class="flex items-center justify-end gap-space-sm mt-space-md pt-space-lg border-t border-border-light">
                    <button type="submit" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold bg-primary-container text-on-primary hover:bg-gov-green-dark transition-colors shadow-sm w-full md:w-auto">
                        Simpan & Proses
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
