@extends('layouts.pemda')

@section('content')
<div class="flex flex-col gap-space-md">
    <div class="flex items-center gap-2 text-text-secondary font-label-md text-label-md">
        <a href="{{ route('pemda.validator.index') }}" class="hover:text-primary transition-colors">Data Validator</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <span class="text-text-primary font-semibold">Edit Data</span>
    </div>

    <div>
        <h1 class="font-headline-lg text-headline-lg font-bold text-text-primary">Edit Validator</h1>
        <p class="font-body-md text-body-md text-text-secondary mt-1">Perbarui data akun validator.</p>
    </div>

    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg">
        <form action="{{ route('pemda.validator.update', $validator->id) }}" method="POST" class="flex flex-col gap-space-md max-w-2xl">
            @csrf
            @method('PUT')
            
            <div class="flex flex-col gap-2">
                <label for="name" class="font-label-md text-label-md font-semibold text-text-primary">Nama Validator <span class="text-error">*</span></label>
                <input type="text" id="name" name="name" value="{{ $validator->name }}" required class="px-space-md py-space-sm border border-border-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary font-body-md text-body-md">
            </div>

            <div class="flex flex-col gap-2">
                <label for="email" class="font-label-md text-label-md font-semibold text-text-primary">Email <span class="text-error">*</span></label>
                <input type="email" id="email" name="email" value="{{ $validator->email }}" required class="px-space-md py-space-sm border border-border-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary font-body-md text-body-md">
            </div>

            <div class="flex flex-col gap-2">
                <label for="password" class="font-label-md text-label-md font-semibold text-text-primary">Password (Opsional)</label>
                <input type="password" id="password" name="password" class="px-space-md py-space-sm border border-border-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary font-body-md text-body-md" placeholder="Kosongkan jika tidak ingin mengubah password">
            </div>

            <div class="flex items-center gap-space-sm mt-space-sm pt-space-md border-t border-border-light">
                <a href="{{ route('pemda.validator.index') }}" class="px-space-md py-space-sm rounded-lg font-label-lg text-label-lg font-semibold text-text-secondary hover:bg-surface-subtle transition-colors">Batal</a>
                <button type="submit" class="px-space-md py-space-sm rounded-lg font-label-lg text-label-lg font-semibold bg-primary text-on-primary hover:bg-primary-container transition-colors shadow-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
