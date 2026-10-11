@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <div class="flex flex-col">
        <a href="{{ route('pemda.master-data.wilayah.index') }}" class="inline-flex items-center gap-1 text-text-secondary hover:text-primary mb-space-md font-label-md transition-colors w-fit">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Data Wilayah</span>
        </a>
        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Tambah Wilayah</h1>
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
        <form action="{{ route('pemda.master-data.wilayah.store') }}" method="POST" class="flex flex-col gap-space-lg">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="kode_wilayah" class="font-label-md text-text-primary">Kode Wilayah <span class="text-error">*</span></label>
                    <input type="text" name="kode_wilayah" id="kode_wilayah" value="{{ old('kode_wilayah') }}" required
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle"
                        placeholder="Ex: 52.04.XX">
                </div>
                
                <div class="flex flex-col gap-space-xs">
                    <label for="nama" class="font-label-md text-text-primary">Nama Wilayah <span class="text-error">*</span></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="jenis" class="font-label-md text-text-primary">Tingkat Wilayah <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="jenis" id="jenis" required
                            class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                            <option value="kecamatan" {{ old('jenis') == 'kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                            <option value="desa" {{ old('jenis') == 'desa' ? 'selected' : '' }}>Desa / Kelurahan</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>

                <div class="flex flex-col gap-space-xs">
                    <label for="parent_id" class="font-label-md text-text-primary">Parent / Induk Kecamatan (Jika Desa)</label>
                    <div class="relative">
                        <select name="parent_id" id="parent_id"
                            class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                            <option value="">-- Pilih Induk (Opsional) --</option>
                            @foreach ($parents as $p)
                                <option value="{{ $p->id }}" {{ old('parent_id') == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-space-sm mt-space-xs">
                <input type="checkbox" name="is_aktif" id="is_aktif" value="1" {{ old('is_aktif', true) ? 'checked' : '' }}
                    class="w-5 h-5 text-primary border-border-medium rounded focus:ring-primary">
                <label for="is_aktif" class="font-body-md text-text-primary cursor-pointer">Status Wilayah Aktif</label>
            </div>

            <div class="flex items-center justify-end gap-space-sm mt-space-md pt-space-lg border-t border-border-light">
                <a href="{{ route('pemda.master-data.wilayah.index') }}" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold text-text-secondary hover:bg-surface-variant transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold bg-primary-container text-on-primary hover:bg-gov-green-dark transition-colors shadow-sm">
                    Simpan Wilayah
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
