@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <div class="flex flex-col">
        <a href="{{ route('pemda.program-bantuan.index') }}" class="inline-flex items-center gap-1 text-text-secondary hover:text-primary mb-space-md font-label-md transition-colors w-fit">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Daftar Program</span>
        </a>
        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Tambah Program Bantuan</h1>
        <p class="font-body-md text-text-secondary mt-1">
            Buat program bantuan baru beserta alokasi anggarannya.
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
        <form action="{{ route('pemda.program-bantuan.store') }}" method="POST" class="flex flex-col gap-space-lg">
            @csrf
            
            <div class="flex flex-col gap-space-xs">
                <label for="nama_program" class="font-label-md text-text-primary">Nama Program <span class="text-error">*</span></label>
                <input type="text" name="nama_program" id="nama_program" value="{{ old('nama_program') }}" required
                    class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle"
                    placeholder="Contoh: Bantuan Benih Padi Hibrida Musim Kemarau 2026">
            </div>

            <div class="flex flex-col gap-space-xs">
                <label for="deskripsi" class="font-label-md text-text-primary">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3"
                    class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle"
                    placeholder="Penjelasan singkat mengenai program bantuan ini">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="pagu_anggaran" class="font-label-md text-text-primary">Pagu Anggaran (Rp) <span class="text-error">*</span></label>
                    <input type="number" name="pagu_anggaran" id="pagu_anggaran" value="{{ old('pagu_anggaran') }}" required min="0"
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle"
                        placeholder="Contoh: 150000000">
                </div>
                
                <div class="flex flex-col gap-space-xs">
                    <label for="target_kk" class="font-label-md text-text-primary">Target (KK) <span class="text-error">*</span></label>
                    <input type="number" name="target_kk" id="target_kk" value="{{ old('target_kk') }}" required min="0"
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle"
                        placeholder="Contoh: 500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="tahun_anggaran" class="font-label-md text-text-primary">Tahun Anggaran <span class="text-error">*</span></label>
                    <input type="number" name="tahun_anggaran" id="tahun_anggaran" value="{{ old('tahun_anggaran', date('Y')) }}" required min="2000"
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
                
                <div class="flex flex-col gap-space-xs">
                    <label for="status" class="font-label-md text-text-primary">Status Program <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="status" id="status" required
                            class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                            <option value="draf" {{ old('status') == 'draf' ? 'selected' : '' }}>Draf</option>
                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-space-sm mt-space-md pt-space-lg border-t border-border-light">
                <a href="{{ route('pemda.program-bantuan.index') }}" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold text-text-secondary hover:bg-surface-variant transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold bg-primary-container text-on-primary hover:bg-gov-green-dark transition-colors shadow-sm">
                    Simpan Program
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
