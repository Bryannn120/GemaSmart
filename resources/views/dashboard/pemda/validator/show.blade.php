@extends('layouts.pemda')

@section('content')
<div class="flex flex-col gap-space-md">
    <div class="flex items-center gap-2 text-text-secondary font-label-md text-label-md">
        <a href="{{ route('pemda.validator.index') }}" class="hover:text-primary transition-colors">Data Validator</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <span class="text-text-primary font-semibold">Detail</span>
    </div>

    <div class="flex justify-between items-center">
        <div>
            <h1 class="font-headline-lg text-headline-lg font-bold text-text-primary">Detail Validator</h1>
            <p class="font-body-md text-body-md text-text-secondary mt-1">Informasi lengkap akun validator.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('pemda.validator.edit', $validator->id) }}" class="flex items-center gap-2 bg-primary text-on-primary px-space-md py-space-sm rounded-lg hover:bg-primary-container transition-colors shadow-sm font-label-lg text-label-lg font-semibold">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                <span>Edit</span>
            </a>
        </div>
    </div>

    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-lg max-w-2xl">
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-4 border-b border-border-light pb-4">
                <div class="w-16 h-16 rounded-full bg-status-verified-surface text-status-verified flex items-center justify-center font-bold text-2xl">
                    {{ substr($validator->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="font-headline-sm text-headline-sm font-bold text-text-primary">{{ $validator->name }}</h3>
                    <span class="inline-block px-2 py-0.5 rounded text-label-sm bg-status-verified-surface text-status-verified font-bold mt-1">Validator</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <span class="text-text-secondary font-label-md text-label-md block">Email</span>
                    <span class="text-text-primary font-semibold block mt-1">{{ $validator->email }}</span>
                </div>
                <div>
                    <span class="text-text-secondary font-label-md text-label-md block">Terdaftar Pada</span>
                    <span class="text-text-primary font-semibold block mt-1">{{ $validator->created_at ? $validator->created_at->format('d M Y H:i') : '-' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
