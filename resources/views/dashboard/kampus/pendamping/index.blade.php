@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Tim Pendamping Lapangan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Kelola pendaftaran dan ploting wilayah mahasiswa pendamping dari kampus.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <button class="inline-flex items-center gap-space-xs px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">person_add</span>
                <span>Tambah Pendamping</span>
            </button>
        </div>
    </div>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-container-low text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Nama / NIP</th>
                        <th class="py-3 px-4 font-semibold">Fakultas / Prodi</th>
                        <th class="py-3 px-4 font-semibold">Desa Dampingan</th>
                        <th class="py-3 px-4 font-semibold">Status Keaktifan</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light">
                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                        <td class="py-3.5 px-4">
                            <span class="font-semibold text-text-primary block">Budi Pendamping</span>
                            <span class="text-text-tertiary font-code-dense text-[12px]">NIM: 180101002</span>
                        </td>
                        <td class="py-3.5 px-4 text-text-primary">Teknologi Pertanian</td>
                        <td class="py-3.5 px-4 text-text-primary">Desa Motong, Kec. Utan</td>
                        <td class="py-3.5 px-4"><span class="inline-flex px-space-sm py-1 rounded-full text-label-sm bg-status-verified-surface text-status-verified font-bold">Aktif di Lapangan</span></td>
                        <td class="py-3.5 px-4 text-right">
                            <button class="p-1.5 text-text-secondary hover:text-primary"><span class="material-symbols-outlined text-[20px]">edit</span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
