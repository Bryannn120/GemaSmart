@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <div class="flex flex-col">
        <a href="{{ route('pemda.master-data.jenis-bibit.index') }}" class="inline-flex items-center gap-1 text-text-secondary hover:text-primary mb-space-md font-label-md transition-colors w-fit">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Data Jenis Bibit</span>
        </a>
        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Edit Jenis Bibit</h1>
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
        <form action="{{ route('pemda.master-data.jenis-bibit.update', $jenisBibit->id) }}" method="POST" class="flex flex-col gap-space-lg">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="kode_bibit" class="font-label-md text-text-primary">Kode Bibit <span class="text-error">*</span></label>
                    <input type="text" name="kode_bibit" id="kode_bibit" value="{{ old('kode_bibit', $jenisBibit->kode_bibit) }}" required
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
                
                <div class="flex flex-col gap-space-xs">
                    <label for="kategori" class="font-label-md text-text-primary">Kategori <span class="text-error">*</span></label>
                    <input type="text" name="kategori" id="kategori" value="{{ old('kategori', $jenisBibit->kategori) }}" required
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="nama_varian" class="font-label-md text-text-primary">Nama Varian <span class="text-error">*</span></label>
                    <input type="text" name="nama_varian" id="nama_varian" value="{{ old('nama_varian', $jenisBibit->nama_varian) }}" required
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>

                <div class="flex flex-col gap-space-xs">
                    <label for="satuan" class="font-label-md text-text-primary">Satuan Kuantitas <span class="text-error">*</span></label>
                    <select name="satuan" id="satuan" required
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                        @php
                            $currSatuan = old('satuan', $jenisBibit->satuan);
                            $satuanOptions = ['Polybag', 'KG', 'LT', 'Unit', 'Batang', 'Pohon', 'Biji', 'Gram', 'Paket', 'Sak'];
                        @endphp
                        @foreach($satuanOptions as $opt)
                            <option value="{{ $opt }}" {{ strcasecmp($currSatuan, $opt) === 0 ? 'selected' : '' }}>
                                {{ $opt }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end gap-space-sm mt-space-md pt-space-lg border-t border-border-light">
                <a href="{{ route('pemda.master-data.jenis-bibit.index') }}" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold text-text-secondary hover:bg-surface-variant transition-colors">
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
