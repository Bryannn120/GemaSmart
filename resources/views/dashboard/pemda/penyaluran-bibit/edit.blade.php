@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <div class="flex flex-col">
        <a href="{{ route('pemda.penyaluran-bibit.index') }}" class="inline-flex items-center gap-1 text-text-secondary hover:text-primary mb-space-md font-label-md transition-colors w-fit">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Penyaluran</span>
        </a>
        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Edit BAST</h1>
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
        <form action="{{ route('pemda.penyaluran-bibit.update', $penyaluran->id) }}" method="POST" class="flex flex-col gap-space-lg">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="nomor_bast" class="font-label-md text-text-primary">No BAST <span class="text-error">*</span></label>
                    <input type="text" name="nomor_bast" id="nomor_bast" value="{{ old('nomor_bast', $penyaluran->nomor_bast) }}" required
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
                
                <div class="flex flex-col gap-space-xs">
                    <label for="tgl_kirim" class="font-label-md text-text-primary">Tanggal Kirim <span class="text-error">*</span></label>
                    <input type="date" name="tgl_kirim" id="tgl_kirim" value="{{ old('tgl_kirim', $penyaluran->tgl_kirim) }}" required
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="wilayah_id" class="font-label-md text-text-primary">Tujuan Wilayah Desa <span class="text-error">*</span></label>
                    @include('components.searchable-select', [
                        'name' => 'wilayah_id',
                        'id' => 'wilayah_id',
                        'value' => old('wilayah_id', $penyaluran->wilayah_id),
                        'options' => $wilayahs,
                        'placeholder' => '-- Cari / Pilih Tujuan Wilayah --',
                        'searchPlaceholder' => 'Ketik nama desa atau kecamatan...',
                        'required' => true,
                        'icon' => 'location_on'
                    ])
                </div>

                <div class="flex flex-col gap-space-xs">
                    <label for="jenis_bibit_id" class="font-label-md text-text-primary">Jenis Bibit <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="jenis_bibit_id" id="jenis_bibit_id" required
                            class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                            @foreach ($jenisBibits as $j)
                                <option value="{{ $j->id }}" {{ old('jenis_bibit_id', $penyaluran->jenis_bibit_id) == $j->id ? 'selected' : '' }}>{{ $j->nama_varian }}</option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="kuantitas" class="font-label-md text-text-primary">Kuantitas <span class="text-error">*</span></label>
                    <input type="number" name="kuantitas" id="kuantitas" value="{{ old('kuantitas', $penyaluran->kuantitas) }}" required min="1"
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>

                <div class="flex flex-col gap-space-xs">
                    <label for="status" class="font-label-md text-text-primary">Status <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="status" id="status" required
                            class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                            <option value="disiapkan" {{ old('status', $penyaluran->status) == 'disiapkan' ? 'selected' : '' }}>Disiapkan</option>
                            <option value="dikirim" {{ old('status', $penyaluran->status) == 'dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                            <option value="diterima" {{ old('status', $penyaluran->status) == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-space-sm mt-space-md pt-space-lg border-t border-border-light">
                <a href="{{ route('pemda.penyaluran-bibit.index') }}" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold text-text-secondary hover:bg-surface-variant transition-colors">
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
