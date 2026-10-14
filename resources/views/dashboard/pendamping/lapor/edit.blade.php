@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <div class="flex flex-col">
        <a href="{{ route('pendamping.lapor.show', $laporan->id) }}" class="inline-flex items-center gap-1 text-text-secondary hover:text-primary mb-space-md font-label-md transition-colors w-fit">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Detail & Histori</span>
        </a>
        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Update Laporan Kunjungan Lapangan</h1>
        <p class="font-body-md text-text-secondary mt-1">
            Perbarui data hasil monitoring kondisi bibit saat dilakukan kunjungan berkala. Data histori pembaruan akan otomatis dicatat.
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

    <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light p-space-xl">
        <form action="{{ route('pendamping.lapor.update', $laporan->id) }}" method="POST" class="flex flex-col gap-space-lg">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="keluarga_penerima_id" class="font-label-md text-text-primary">Keluarga Penerima Binaan <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="keluarga_penerima_id" id="keluarga_penerima_id" required
                            class="searchable-select appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                            @foreach ($keluarga_penerimas as $p)
                                <option value="{{ $p->id }}" 
                                    data-subtext="Desa {{ $p->wilayah->nama ?? '-' }} • No KK: {{ $p->no_kk }}"
                                    {{ old('keluarga_penerima_id', $laporan->keluarga_penerima_id) == $p->id ? 'selected' : '' }}>
                                    {{ $p->kepala_keluarga ?? $p->nama }}
                                </option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>
                
                <div class="flex flex-col gap-space-xs">
                    <label for="tanggal_lapor" class="font-label-md text-text-primary">Tanggal Kunjungan / Lapor <span class="text-error">*</span></label>
                    <input type="date" name="tanggal_lapor" id="tanggal_lapor" value="{{ old('tanggal_lapor', \Carbon\Carbon::parse($laporan->tanggal_lapor)->format('Y-m-d')) }}" required
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
            </div>

            <div class="flex flex-col gap-space-xs">
                <label for="status_kondisi" class="font-label-md text-text-primary">Kondisi Tumbuh Kembang Bibit <span class="text-error">*</span></label>
                <div class="relative">
                    <select name="status_kondisi" id="status_kondisi" required
                        class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                        <option value="normal" {{ old('status_kondisi', $laporan->status_kondisi) == 'normal' ? 'selected' : '' }}>Normal / Sehat</option>
                        <option value="hama" {{ old('status_kondisi', $laporan->status_kondisi) == 'hama' ? 'selected' : '' }}>Terkena Hama</option>
                        <option value="gagal" {{ old('status_kondisi', $laporan->status_kondisi) == 'gagal' ? 'selected' : '' }}>Gagal / Mati</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                </div>
            </div>

            <div class="flex flex-col gap-space-xs">
                <label for="catatan" class="font-label-md text-text-primary">Catatan Pemantauan Hasil Kunjungan <span class="text-error">*</span></label>
                <textarea name="catatan" id="catatan" rows="4" required
                    class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle"
                    placeholder="Tuliskan catatan hasil kunjungan lapangan, kondisi tinggi bibit, kesehatan daun, dll...">{{ old('catatan', $laporan->catatan) }}</textarea>
            </div>

            <div class="flex flex-col gap-space-xs">
                <label for="foto_url" class="font-label-md text-text-primary">Foto Bukti Lapangan (URL) (Opsional)</label>
                <input type="text" name="foto_url" id="foto_url" value="{{ old('foto_url', $laporan->foto_url) }}"
                    class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle"
                    placeholder="https://...">
            </div>

            <div class="flex items-center justify-between gap-space-sm mt-space-md pt-space-lg border-t border-border-light">
                <a href="{{ route('pendamping.lapor.show', $laporan->id) }}" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold text-text-secondary hover:bg-surface-variant transition-colors">
                    Batal
                </a>
                <div class="flex items-center gap-2">
                    <button type="submit" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold bg-primary-container text-on-primary hover:bg-gov-green-dark transition-colors shadow-sm flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        <span>Simpan & Catat Histori Update</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
