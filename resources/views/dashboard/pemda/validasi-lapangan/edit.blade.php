@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <div class="flex flex-col">
        <a href="{{ route('pemda.validasi-lapangan.index') }}" class="inline-flex items-center gap-1 text-text-secondary hover:text-primary mb-space-md font-label-md transition-colors w-fit">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Validasi Lapangan</span>
        </a>
        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Review Validasi Lapangan</h1>
        <p class="font-body-md text-text-secondary mt-1">
            Berikan persetujuan akhir (Approval Pemda) atas hasil survei lapangan.
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

    <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
        <!-- Informasi Survei -->
        <div class="bg-surface-subtle rounded-xl p-space-lg border border-border-light flex flex-col gap-space-md">
            <h3 class="font-headline-sm text-headline-sm text-text-primary border-b border-border-medium pb-2">Informasi Survei</h3>
            
            <div class="flex flex-col gap-1">
                <span class="font-label-sm text-text-secondary">Nama KeluargaPenerima (CPCL)</span>
                <span class="font-body-md text-text-primary">{{ $validasi->keluarga_penerima->nama ?? '-' }} ({{ $validasi->keluarga_penerima->nik ?? '-' }})</span>
            </div>
            
            <div class="flex flex-col gap-1">
                <span class="font-label-sm text-text-secondary">Tanggal Survei</span>
                <span class="font-body-md text-text-primary">{{ \Carbon\Carbon::parse($validasi->tgl_survei)->format('d F Y') }}</span>
            </div>
            
            <div class="flex flex-col gap-1">
                <span class="font-label-sm text-text-secondary">Pendamping (Surveyor)</span>
                <span class="font-body-md text-text-primary">{{ $validasi->pendamping->name ?? '-' }}</span>
            </div>

            <div class="flex flex-col gap-1">
                <span class="font-label-sm text-text-secondary">Validator Kampus</span>
                <span class="font-body-md text-text-primary">{{ $validasi->validator->name ?? 'Belum direview kampus' }}</span>
            </div>
            
            <div class="flex flex-col gap-1 mt-space-sm p-space-sm bg-canvas-bg rounded-lg border border-border-light">
                <span class="font-label-sm text-text-secondary">Rekomendasi Kelayakan</span>
                <span class="font-headline-md mt-1">
                    @if ($validasi->status_kelayakan == 'layak')
                        <span class="text-status-verified font-bold">LAYAK</span>
                    @elseif ($validasi->status_kelayakan == 'tidak_layak')
                        <span class="text-status-fraud font-bold">TIDAK LAYAK</span>
                    @else
                        <span class="text-status-warning font-bold">REVIEW (BELUM FINAL)</span>
                    @endif
                </span>
            </div>
        </div>

        <!-- Form Approval -->
        <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-xl">
            <form action="{{ route('pemda.validasi-lapangan.update', $validasi->id) }}" method="POST" class="flex flex-col gap-space-lg">
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-space-xs">
                    <label for="status_approval_pemda" class="font-label-md text-text-primary">Keputusan Pemda <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="status_approval_pemda" id="status_approval_pemda" required
                            class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                            <option value="menunggu" {{ old('status_approval_pemda', $validasi->status_approval_pemda) == 'menunggu' ? 'selected' : '' }}>Menunggu Review</option>
                            <option value="disetujui" {{ old('status_approval_pemda', $validasi->status_approval_pemda) == 'disetujui' ? 'selected' : '' }}>Setuju (Approve)</option>
                            <option value="ditolak" {{ old('status_approval_pemda', $validasi->status_approval_pemda) == 'ditolak' ? 'selected' : '' }}>Tolak (Reject)</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                    <p class="font-body-sm text-text-secondary mt-1">Jika disetujui, status keluarga_penerima (CPCL) akan berubah menjadi Valid.</p>
                </div>

                <div class="flex flex-col gap-space-xs">
                    <label for="catatan" class="font-label-md text-text-primary">Catatan Approval (Opsional)</label>
                    <textarea name="catatan" id="catatan" rows="4"
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle"
                        placeholder="Tambahkan catatan jika diperlukan...">{{ old('catatan', $validasi->catatan) }}</textarea>
                </div>

                <div class="flex items-center justify-end gap-space-sm mt-space-md pt-space-lg border-t border-border-light">
                    <a href="{{ route('pemda.validasi-lapangan.index') }}" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold text-text-secondary hover:bg-surface-variant transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold bg-primary-container text-on-primary hover:bg-gov-green-dark transition-colors shadow-sm">
                        Simpan Keputusan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
