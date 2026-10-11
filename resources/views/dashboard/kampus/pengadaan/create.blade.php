@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <div class="flex flex-col">
        <a href="{{ route('kampus.pengadaan.index') }}" class="inline-flex items-center gap-1 text-text-secondary hover:text-primary mb-space-md font-label-md transition-colors w-fit">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Data SPJ</span>
        </a>
        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Buat SPJ Baru</h1>
        <p class="font-body-md text-text-secondary mt-1">
            Ajukan Surat Pertanggungjawaban (SPJ) baru untuk program pendampingan.
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
        <form action="{{ route('kampus.pengadaan.store') }}" method="POST" class="flex flex-col gap-space-lg">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="nomor_spj" class="font-label-md text-text-primary">Nomor SPJ <span class="text-error">*</span></label>
                    <input type="text" name="nomor_spj" id="nomor_spj" value="{{ old('nomor_spj') }}" required
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle"
                        placeholder="Ex: SPJ-2026/01/UTS">
                </div>
                
                <div class="flex flex-col gap-space-xs">
                    <label for="tgl_pengajuan" class="font-label-md text-text-primary">Tanggal Pengajuan <span class="text-error">*</span></label>
                    <input type="date" name="tgl_pengajuan" id="tgl_pengajuan" value="{{ old('tgl_pengajuan', date('Y-m-d')) }}" required
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
            </div>

            <div class="flex flex-col gap-space-xs">
                <label for="uraian" class="font-label-md text-text-primary">Uraian Kebutuhan <span class="text-error">*</span></label>
                <textarea name="uraian" id="uraian" rows="4" required
                    class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle"
                    placeholder="Sebutkan secara rinci uraian pengadaan atau operasional yang diajukan...">{{ old('uraian') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="nominal" class="font-label-md text-text-primary">Nominal Pengajuan (Rp) <span class="text-error">*</span></label>
                    <input type="number" name="nominal" id="nominal" value="{{ old('nominal') }}" required min="0" step="1"
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle"
                        placeholder="Misal: 5000000">
                </div>

                <div class="flex flex-col gap-space-xs">
                    <label for="status" class="font-label-md text-text-primary">Status <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="status" id="status" required
                            class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                            <option value="diajukan" {{ old('status') == 'diajukan' ? 'selected' : '' }}>Draft / Diajukan</option>
                            <option value="review" {{ old('status') == 'review' ? 'selected' : '' }}>Dalam Review</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-space-sm mt-space-md pt-space-lg border-t border-border-light">
                <a href="{{ route('kampus.pengadaan.index') }}" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold text-text-secondary hover:bg-surface-variant transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold bg-primary-container text-on-primary hover:bg-gov-green-dark transition-colors shadow-sm">
                    Simpan Pengajuan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
