@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Monitoring & Evaluasi</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Laporan tumbuh kembang yang disubmit oleh mahasiswa pendamping dari lapangan.
            </p>
        </div>
    </div>

    <!-- Feed Container -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light flex flex-col h-[500px]">
        <div class="flex-1 overflow-y-auto p-space-xl flex flex-col gap-space-xl">
            
            <div class="flex gap-space-md pb-space-lg border-b border-border-light">
                <div class="w-10 h-10 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold text-label-md shrink-0">FM</div>
                <div class="flex flex-col flex-1">
                    <div class="flex justify-between items-start">
                        <span class="font-label-lg font-semibold text-text-primary">Fajar Maulana (Kec. Alas)</span>
                        <span class="text-label-sm text-text-tertiary">Baru saja</span>
                    </div>
                    <span class="font-code-dense text-[12px] text-primary mb-2">Desa Kalimango • KT Mekar Jaya</span>
                    <p class="font-body-md text-text-secondary">Pertumbuhan jagung minggu ke-2 optimal. Curah hujan cukup membantu pengairan alami. Tidak ditemukan hama.</p>
                </div>
            </div>

            <div class="flex gap-space-md pb-space-lg border-b border-border-light">
                <div class="w-10 h-10 rounded-full bg-secondary text-on-secondary flex items-center justify-center font-bold text-label-md shrink-0">SR</div>
                <div class="flex flex-col flex-1">
                    <div class="flex justify-between items-start">
                        <span class="font-label-lg font-semibold text-text-primary">Siti Rahmawati (Kec. Rhee)</span>
                        <span class="text-label-sm text-text-tertiary">3 Jam lalu</span>
                    </div>
                    <span class="font-code-dense text-[12px] text-status-warning mb-2">Desa Sampe • Lahan Pak Agus</span>
                    <p class="font-body-md text-text-secondary">Ditemukan gulma cukup tebal di sekitar padi ciherang. Sudah diarahkan untuk segera melakukan penyiangan.</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
