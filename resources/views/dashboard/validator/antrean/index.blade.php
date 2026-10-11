@extends('layouts.validator')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Antrean Review Validasi</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Lakukan pengecekan akhir terhadap data survei CPCL yang dikirim oleh Pendamping Lapangan.
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Tgl Survei</th>
                        <th class="py-3 px-4 font-semibold">KeluargaPenerima (CPCL)</th>
                        <th class="py-3 px-4 font-semibold">Pendamping (Surveyor)</th>
                        <th class="py-3 px-4 font-semibold">Catatan Survei</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($antreans as $antrean)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4 font-semibold text-text-primary">{{ \Carbon\Carbon::parse($antrean->tgl_survei)->format('d M Y') }}</td>
                        <td class="py-3.5 px-4">
                            <span class="font-semibold text-text-primary block">{{ $antrean->keluarga_penerima->nama ?? '-' }}</span>
                            <span class="text-text-tertiary font-code-dense text-[12px]">{{ $antrean->keluarga_penerima->nik ?? '-' }}</span>
                        </td>
                        <td class="py-3.5 px-4 text-text-primary">{{ $antrean->pendamping->name ?? '-' }}</td>
                        <td class="py-3.5 px-4 text-text-primary truncate max-w-[200px]">{{ $antrean->catatan ?? 'Tidak ada catatan' }}</td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('validator.antrean.edit', $antrean->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium rounded-lg bg-primary-container text-on-primary hover:bg-gov-green-dark transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">rule</span>
                                    <span>Review Sekarang</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-text-secondary">
                            <span class="material-symbols-outlined text-[48px] text-border-medium mb-2 block">task_alt</span>
                            <p class="font-body-md text-text-primary font-semibold mb-1">Semua Selesai!</p>
                            <p class="font-body-md">Tidak ada antrean validasi yang perlu direview saat ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
