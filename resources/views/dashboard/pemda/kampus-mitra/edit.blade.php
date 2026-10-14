@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <div class="flex flex-col">
        <a href="{{ route('pemda.kampus-mitra.index') }}" class="inline-flex items-center gap-1 text-text-secondary hover:text-primary mb-space-md font-label-md transition-colors w-fit">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Daftar Kampus</span>
        </a>
        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Edit Kampus Mitra</h1>
        <p class="font-body-md text-text-secondary mt-1">
            Ubah detail kampus mitra dan data koordinatornya.
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
        <form action="{{ route('pemda.kampus-mitra.update', $kampusMitra->id) }}" method="POST" class="flex flex-col gap-space-lg">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-space-xs">
                <label for="email_kampus" class="font-label-md text-text-primary">Email Kampus <span class="text-error">*</span></label>
                <input type="email" name="email_kampus" id="email_kampus" value="{{ old('email_kampus', $kampusMitra->user->email ?? '') }}" required
                    class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle"
                    placeholder="Contoh: admin@unsa.ac.id">
            </div>

            <div class="flex flex-col gap-space-xs">
                <label for="nama_universitas" class="font-label-md text-text-primary">Nama Universitas <span class="text-error">*</span></label>
                <input type="text" name="nama_universitas" id="nama_universitas" value="{{ old('nama_universitas', $kampusMitra->nama_universitas) }}" required
                    class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="pic_name" class="font-label-md text-text-primary">Nama PIC <span class="text-error">*</span></label>
                    <input type="text" name="pic_name" id="pic_name" value="{{ old('pic_name', $kampusMitra->pic_name) }}" required
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
                <div class="flex flex-col gap-space-xs">
                    <label for="pic_contact" class="font-label-md text-text-primary">Kontak PIC</label>
                    <input type="text" name="pic_contact" id="pic_contact" value="{{ old('pic_contact', $kampusMitra->pic_contact) }}"
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
            </div>

            <div class="flex flex-col gap-space-xs">
                <label for="wilayah_binaan" class="font-label-md text-text-primary">Wilayah Binaan</label>
                <input type="text" name="wilayah_binaan" id="wilayah_binaan" value="{{ old('wilayah_binaan', $kampusMitra->wilayah_binaan) }}"
                    class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="mou_berlaku_sampai" class="font-label-md text-text-primary">MoU Berlaku Sampai</label>
                    <input type="date" name="mou_berlaku_sampai" id="mou_berlaku_sampai" value="{{ old('mou_berlaku_sampai', $kampusMitra->mou_berlaku_sampai) }}"
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
                <div class="flex flex-col gap-space-xs">
                    <label for="status_mou" class="font-label-md text-text-primary">Status MoU <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="status_mou" id="status_mou" required
                            class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                            <option value="aktif" {{ old('status_mou', $kampusMitra->status_mou) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak_aktif" {{ old('status_mou', $kampusMitra->status_mou) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-space-xs p-space-md rounded-xl bg-gov-green-surface/40 border border-primary/20">
                <label for="dana_bappeda" class="font-label-md text-gov-green-dark font-bold flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px]">account_balance_wallet</span>
                    <span>Alokasi Dana dari Bappeda ke Kampus (Rp)</span>
                </label>
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 font-bold text-text-secondary text-sm">Rp</span>
                    <input type="number" name="dana_bappeda" id="dana_bappeda" value="{{ old('dana_bappeda', (int)$kampusMitra->dana_bappeda) }}" min="0" step="any"
                        class="w-full font-body-md pl-11 pr-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-white font-semibold text-text-primary"
                        placeholder="Contoh: 500000000">
                </div>
                <p class="text-xs text-text-secondary">Uang yang diberikan Bappeda ini akan otomatis dikurangi secara real-time oleh total penyaluran dan penggunaan program bantuan kampus.</p>
            </div>

            <div class="flex items-center justify-end gap-space-sm mt-space-md pt-space-lg border-t border-border-light">
                <a href="{{ route('pemda.kampus-mitra.index') }}" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold text-text-secondary hover:bg-surface-variant transition-colors">
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

