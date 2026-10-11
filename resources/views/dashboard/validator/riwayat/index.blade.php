@extends('layouts.validator')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Riwayat Validasi</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Log aktivitas semua laporan yang sudah Anda proses (Disetujui atau Ditolak).
            </p>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-container-low text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Pengirim (Pendamping)</th>
                        <th class="py-3 px-4 font-semibold">Jenis Laporan</th>
                        <th class="py-3 px-4 font-semibold">Tanggal Proses</th>
                        <th class="py-3 px-4 font-semibold">Status Akhir</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light">
                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                        <td class="py-3.5 px-4 font-semibold text-text-primary">Budi Pendamping</td>
                        <td class="py-3.5 px-4 text-text-primary">Validasi CPCL Lahan Pak Hasan</td>
                        <td class="py-3.5 px-4 text-text-primary">Kemarin, 14:00</td>
                        <td class="py-3.5 px-4"><span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-verified-surface text-status-verified font-bold">Diteruskan (Disetujui)</span></td>
                        <td class="py-3.5 px-4 text-right">
                            <button class="px-3 py-1.5 bg-surface-container border border-border-light text-text-secondary font-label-sm rounded-lg hover:bg-surface-variant transition-colors">Detail</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                        <td class="py-3.5 px-4 font-semibold text-text-primary">Andi Pratama</td>
                        <td class="py-3.5 px-4 text-text-primary">Monitoring Umur 30 Hari</td>
                        <td class="py-3.5 px-4 text-text-primary">12 Okt 2026</td>
                        <td class="py-3.5 px-4"><span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-fraud-surface text-status-fraud font-bold">Ditolak (Foto Buram)</span></td>
                        <td class="py-3.5 px-4 text-right">
                            <button class="px-3 py-1.5 bg-surface-container border border-border-light text-text-secondary font-label-sm rounded-lg hover:bg-surface-variant transition-colors">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
