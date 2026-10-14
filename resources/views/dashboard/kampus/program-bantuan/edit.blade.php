@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('kampus.program-bantuan.show', $program->id) }}" class="inline-flex items-center gap-1 text-text-secondary hover:text-primary font-body-sm text-sm transition-colors w-fit">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                <span>Kembali ke Detail Program</span>
            </a>
        </div>
        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Edit Program Bantuan</h1>
        <p class="font-body-md text-text-secondary mt-1">
            Perbarui data pokok atau pagu anggaran untuk program {{ $program->nama_program }}.
        </p>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="bg-status-fraud-surface text-status-fraud p-space-md rounded-xl font-body-sm border border-status-fraud/20 flex flex-col gap-1 shadow-sm">
            <div class="flex items-center gap-2 font-bold">
                <span class="material-symbols-outlined text-[20px]">error</span>
                <span>Mohon periksa kembali formulir:</span>
            </div>
            <ul class="list-disc list-inside text-xs pl-6 space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light p-space-xl">
        <form action="{{ route('kampus.program-bantuan.update', $program->id) }}" method="POST" class="flex flex-col gap-6">
            @csrf
            @method('PUT')

            <!-- Section 1: Data Pokok Program -->
            <div>
                <div class="flex items-center gap-2 pb-2 border-b border-border-light mb-4">
                    <span class="material-symbols-outlined text-primary text-[20px]">folder</span>
                    <h2 class="font-bold text-text-primary text-base">1. Informasi Pokok & Anggaran Program</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label for="nama_program" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                            Nama Program Bantuan <span class="text-status-fraud">*</span>
                        </label>
                        <input type="text" name="nama_program" id="nama_program" value="{{ old('nama_program', $program->nama_program) }}" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary font-medium text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    </div>

                    <div>
                        <label for="tahun_anggaran" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                            Tahun Anggaran <span class="text-status-fraud">*</span>
                        </label>
                        <input type="number" name="tahun_anggaran" id="tahun_anggaran" value="{{ old('tahun_anggaran', $program->tahun_anggaran) }}" required min="2020" max="2099"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary font-mono text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    </div>

                    <div>
                        <label for="target_kk" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                            Target Jumlah Penerima (KK) <span class="text-status-fraud">*</span>
                        </label>
                        <input type="number" name="target_kk" id="target_kk" value="{{ old('target_kk', $program->target_kk) }}" required min="1"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary font-mono text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    </div>

                    <div class="md:col-span-2">
                        <label for="pagu_anggaran" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                            Total Pagu Anggaran Program (Rp) <span class="text-status-fraud">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-text-secondary text-sm font-semibold">Rp</span>
                            <input type="number" step="100000" min="0" name="pagu_anggaran" id="pagu_anggaran"
                                value="{{ old('pagu_anggaran', $program->pagu_anggaran) }}" required
                                class="w-full pl-11 pr-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm font-bold font-mono focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                            Deskripsi, Latar Belakang & Tujuan Sasaran
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">{{ old('deskripsi', $program->deskripsi) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section 2: Status Terbit -->
            <div>
                <label for="status" class="block text-xs font-semibold text-text-secondary uppercase mb-1">
                    Status Publikasi Program <span class="text-status-fraud">*</span>
                </label>
                <select name="status" id="status" required
                    class="w-full sm:w-64 px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    <option value="aktif" {{ old('status', $program->status) == 'aktif' ? 'selected' : '' }}>Aktif (Siap Disalurkan Pendamping)</option>
                    <option value="draf" {{ old('status', $program->status) == 'draf' ? 'selected' : '' }}>Draf (Penyusunan Internal)</option>
                    <option value="selesai" {{ old('status', $program->status) == 'selesai' ? 'selected' : '' }}>Selesai / Ditutup</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="pt-4 border-t border-border-light flex flex-col sm:flex-row items-center justify-between gap-3">
                <a href="{{ route('kampus.program-bantuan.show', $program->id) }}" class="w-full sm:w-auto px-space-md py-2.5 rounded-xl bg-surface-container-high hover:bg-surface-container-highest text-text-secondary hover:text-text-primary font-label-md text-xs font-semibold transition-colors text-center">
                    Batal
                </a>
                <button type="submit" class="w-full sm:w-auto px-space-xl py-3 rounded-xl bg-primary hover:bg-gov-green-dark text-white font-label-md text-sm font-bold shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    <span>Simpan Perubahan Program</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
