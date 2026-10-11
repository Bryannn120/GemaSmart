@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">{{ $title }}</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Halaman {{ $title }} sedang dalam tahap pengembangan (Dummy Data).
            </p>
        </div>
    </div>

    <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm flex items-center justify-center min-h-[400px]">
        <div class="text-center">
            <span class="material-symbols-outlined text-[64px] text-text-tertiary mb-space-md block">construction</span>
            <h2 class="font-headline-md text-headline-md text-text-primary">Dalam Pengembangan</h2>
            <p class="font-body-md text-text-secondary mt-2">Data dan fungsionalitas untuk halaman ini akan segera tersedia.</p>
        </div>
    </div>
</div>
@endsection
