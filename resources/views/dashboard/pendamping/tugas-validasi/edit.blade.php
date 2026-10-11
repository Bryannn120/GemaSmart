@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <div class="flex flex-col">
        <a href="{{ route('pendamping.tugas-validasi.index') }}" class="inline-flex items-center gap-1 text-text-secondary hover:text-primary mb-space-md font-label-md transition-colors w-fit">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Data Survei</span>
        </a>
        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Edit Formulir Survei</h1>
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
        <form action="{{ route('pendamping.tugas-validasi.update', $validasi->id) }}" method="POST" class="flex flex-col gap-space-lg">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <!-- KeluargaPenerima is typically read-only on edit, so just displaying it but omitting from update or using hidden -->
                <div class="flex flex-col gap-space-xs">
                    <label class="font-label-md text-text-primary">KeluargaPenerima (CPCL)</label>
                    <input type="text" value="{{ $validasi->keluarga_penerima->nama ?? '-' }}" disabled
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium bg-surface-muted text-text-secondary">
                </div>
                
                <div class="flex flex-col gap-space-xs">
                    <label for="tgl_survei" class="font-label-md text-text-primary">Tanggal Survei <span class="text-error">*</span></label>
                    <input type="date" name="tgl_survei" id="tgl_survei" value="{{ old('tgl_survei', \Carbon\Carbon::parse($validasi->tgl_survei)->format('Y-m-d')) }}" required
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
            </div>

            <div class="flex flex-col gap-space-xs">
                <label for="status_kelayakan" class="font-label-md text-text-primary">Rekomendasi Kelayakan <span class="text-error">*</span></label>
                <div class="relative">
                    <select name="status_kelayakan" id="status_kelayakan" required
                        class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                        <option value="layak" {{ old('status_kelayakan', $validasi->status_kelayakan) == 'layak' ? 'selected' : '' }}>Layak (Sesuai Kriteria)</option>
                        <option value="tidak_layak" {{ old('status_kelayakan', $validasi->status_kelayakan) == 'tidak_layak' ? 'selected' : '' }}>Tidak Layak</option>
                        <option value="review" {{ old('status_kelayakan', $validasi->status_kelayakan) == 'review' ? 'selected' : '' }}>Perlu Review Tambahan (Validator Kampus)</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                </div>
            </div>

            <div class="flex flex-col gap-space-xs">
                <label for="catatan" class="font-label-md text-text-primary">Catatan Survei</label>
                <textarea name="catatan" id="catatan" rows="4"
                    class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">{{ old('catatan', $validasi->catatan) }}</textarea>
            </div>

            <div class="flex items-center justify-end gap-space-sm mt-space-md pt-space-lg border-t border-border-light">
                <a href="{{ route('pendamping.tugas-validasi.index') }}" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold text-text-secondary hover:bg-surface-variant transition-colors">
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
