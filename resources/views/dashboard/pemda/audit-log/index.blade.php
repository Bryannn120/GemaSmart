@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Audit Log (Riwayat Sistem)</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Catatan aktivitas penting dalam sistem untuk transparansi dan keamanan.
            </p>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Waktu (WITA)</th>
                        <th class="py-3 px-4 font-semibold">User</th>
                        <th class="py-3 px-4 font-semibold">Modul</th>
                        <th class="py-3 px-4 font-semibold">Aktivitas</th>
                        <th class="py-3 px-4 font-semibold">Alamat IP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4 font-code-dense text-text-secondary">07 Okt 2026 09:12:45</td>
                        <td class="py-3.5 px-4 font-semibold text-text-primary">Admin Pemda</td>
                        <td class="py-3.5 px-4"><span class="inline-flex px-space-sm py-0.5 rounded text-[11px] font-code-dense bg-surface-container text-text-secondary border border-border-medium">Validasi Lapangan</span></td>
                        <td class="py-3.5 px-4 text-text-primary">Menerima (Approve) hasil survei NIK 5204111222333444</td>
                        <td class="py-3.5 px-4 font-code-dense text-text-secondary">103.144.xxx.xx</td>
                    </tr>
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4 font-code-dense text-text-secondary">07 Okt 2026 08:30:10</td>
                        <td class="py-3.5 px-4 font-semibold text-text-primary">Siti (Pendamping UNSA)</td>
                        <td class="py-3.5 px-4"><span class="inline-flex px-space-sm py-0.5 rounded text-[11px] font-code-dense bg-surface-container text-text-secondary border border-border-medium">Monitoring</span></td>
                        <td class="py-3.5 px-4 text-text-primary">Mengunggah laporan "Indikasi serangan hama" di Empang</td>
                        <td class="py-3.5 px-4 font-code-dense text-text-secondary">114.122.xxx.xx</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
