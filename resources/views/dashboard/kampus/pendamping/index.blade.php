@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <div class="flex items-center gap-space-sm mb-space-xs">
                <span class="inline-flex items-center px-space-sm py-0.5 rounded-full font-label-sm text-label-sm bg-gov-green-surface text-primary font-bold">
                    <span class="material-symbols-outlined text-[14px] mr-1">badge</span>
                    MANAJEMEN SUMBER DAYA
                </span>
                <span class="text-text-tertiary text-body-sm font-body-sm">{{ $kampus ? $kampus->nama_universitas : 'Kampus Mitra' }}</span>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Tim Pendamping Lapangan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Kelola pendaftaran kader mahasiswa/fasilitator pendamping, buat akun login, dan pantau keluarga binaan yang didampingi di desa sasaran.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <a href="{{ route('kampus.pendamping.create') }}" class="inline-flex items-center gap-space-xs px-space-md py-2.5 rounded-xl bg-primary text-on-primary font-label-md text-label-md font-bold hover:bg-gov-green-dark transition-all shadow-md hover:shadow-lg">
                <span class="material-symbols-outlined text-[18px]">person_add</span>
                <span>+ Tambah Pendamping Baru</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20 flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- 3 KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-lg">
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-gov-green-surface flex items-center justify-center text-primary shrink-0">
                <span class="material-symbols-outlined text-[26px]">groups</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-semibold">Total Pendamping</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $totalPendamping }} Orang</span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Terdaftar di Kampus</span>
            </div>
        </div>

        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-800 shrink-0">
                <span class="material-symbols-outlined text-[26px]">verified_user</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-semibold">Pendamping Aktif</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $totalAktif }} Orang</span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Bertugas di Lapangan</span>
            </div>
        </div>

        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-800 shrink-0">
                <span class="material-symbols-outlined text-[26px]">home</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-semibold">Total KK Dampingan</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $totalBinaan }} KK</span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Penerima Dibina</span>
            </div>
        </div>
    </div>

    <!-- Filter & Search Section -->
    <div class="bg-canvas-bg rounded-2xl p-space-md shadow-sm border border-border-light flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3">
        <form action="{{ route('kampus.pendamping.index') }}" method="GET" class="flex flex-wrap items-center gap-3 flex-1">
            <!-- Search -->
            <div class="relative flex-1 min-w-[220px]">
                <span class="material-symbols-outlined absolute left-3 top-2.5 text-text-tertiary text-[18px]">search</span>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama, email, NIM/NIP, prodi, atau desa..."
                    class="w-full pl-9 pr-3 py-2 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm focus:border-primary focus:bg-canvas-bg focus:outline-none transition-all">
            </div>

            <!-- Filter Status -->
            <select name="status" onchange="this.form.submit()" class="px-3 py-2 rounded-xl border border-border-light bg-surface-subtle text-text-primary text-sm focus:border-primary focus:outline-none transition-all">
                <option value="">Semua Status</option>
                <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>🟢 Aktif</option>
                <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>⚪ Nonaktif</option>
            </select>

            <button type="submit" class="px-4 py-2 bg-primary text-on-primary rounded-xl font-label-sm text-label-sm font-semibold hover:bg-gov-green-dark transition-all">
                Cari
            </button>

            @if(request('search') || request('status'))
                <a href="{{ route('kampus.pendamping.index') }}" class="px-3 py-2 text-text-secondary hover:text-text-primary font-label-sm text-label-sm">
                    Reset
                </a>
            @endif
        </form>

        <a href="{{ route('kampus.pendamping.create') }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl bg-primary text-on-primary font-label-sm text-label-sm font-bold hover:bg-gov-green-dark transition-all shrink-0">
            <span class="material-symbols-outlined text-[16px]">add</span>
            <span>Tambah Pendamping</span>
        </a>
    </div>

    <!-- Tabel Tim Pendamping -->
    <div class="bg-canvas-bg rounded-2xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3.5 px-4 font-semibold">Nama / Akun Login</th>
                        <th class="py-3.5 px-4 font-semibold">NIM / NIP &amp; Prodi</th>
                        <th class="py-3.5 px-4 font-semibold">No. Kontak / HP</th>
                        <th class="py-3.5 px-4 font-semibold">Wilayah &amp; Binaan</th>
                        <th class="py-3.5 px-4 font-semibold">Status</th>
                        <th class="py-3.5 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($pendampings as $p)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <!-- Nama & Email -->
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gov-green-surface text-primary flex items-center justify-center font-bold text-sm shrink-0 border border-primary/20">
                                    {{ strtoupper(substr($p->name, 0, 2)) }}
                                </div>
                                <div>
                                    <a href="{{ route('kampus.pendamping.show', $p->id) }}" class="font-bold text-text-primary hover:text-primary transition-colors block">
                                        {{ $p->name }}
                                    </a>
                                    <span class="text-xs text-text-tertiary flex items-center gap-1 mt-0.5">
                                        <span class="material-symbols-outlined text-[13px]">mail</span>
                                        {{ $p->email }}
                                    </span>
                                </div>
                            </div>
                        </td>

                        <!-- NIM & Prodi -->
                        <td class="py-3.5 px-4">
                            <span class="text-text-primary font-medium block">
                                {{ $p->nim_nip ? 'NIM: ' . $p->nim_nip : '-' }}
                            </span>
                            <span class="text-xs text-text-secondary block mt-0.5">
                                {{ $p->fakultas_prodi ?? 'Fakultas Belum Diisi' }}
                            </span>
                        </td>

                        <!-- Kontak -->
                        <td class="py-3.5 px-4">
                            @if($p->no_hp)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $p->no_hp) }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-emerald-700 hover:text-emerald-800 font-semibold bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200">
                                    <span class="material-symbols-outlined text-[14px]">call</span>
                                    {{ $p->no_hp }}
                                </a>
                            @else
                                <span class="text-xs text-text-tertiary">-</span>
                            @endif
                        </td>

                        <!-- Wilayah & Binaan -->
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-bold bg-blue-50 text-blue-800 border border-blue-200">
                                    {{ $p->keluarga_penerimas_count ?? 0 }} KK Binaan
                                </span>
                            </div>
                            <span class="text-xs text-text-secondary block mt-1 font-medium text-emerald-800">
                                📍 {{ $p->assigned_wilayah_label ?: ($p->desa_penugasan ? 'Desa: ' . $p->desa_penugasan : 'Wilayah belum diatur') }}
                            </span>
                        </td>

                        <!-- Status -->
                        <td class="py-3.5 px-4">
                            @if($p->status_keaktifan === 'aktif')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-status-verified-surface text-primary border border-primary/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary mr-1.5 animate-pulse"></span>
                                    Aktif Lapangan
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        <!-- Aksi -->
                        <td class="py-3.5 px-4 text-right">
                            <div class="inline-flex items-center gap-1">
                                <!-- Detail -->
                                <a href="{{ route('kampus.pendamping.show', $p->id) }}" class="p-1.5 rounded-lg text-text-secondary hover:text-primary hover:bg-surface-subtle transition-colors" title="Lihat Profil & Binaan">
                                    <span class="material-symbols-outlined text-[19px]">visibility</span>
                                </a>

                                <!-- Edit -->
                                <a href="{{ route('kampus.pendamping.edit', $p->id) }}" class="p-1.5 rounded-lg text-text-secondary hover:text-amber-700 hover:bg-amber-50 transition-colors" title="Edit Data & Password">
                                    <span class="material-symbols-outlined text-[19px]">edit</span>
                                </a>

                                <!-- Hapus -->
                                <form action="{{ route('kampus.pendamping.destroy', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pendamping {{ $p->name }}? Akun login akan dihapus dan keluarga binaan akan dilepas.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-text-secondary hover:text-status-fraud hover:bg-red-50 transition-colors" title="Hapus Pendamping">
                                        <span class="material-symbols-outlined text-[19px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 px-4 text-center">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[48px] text-text-tertiary">groups_off</span>
                                <p class="font-bold text-text-primary text-base">Belum Ada Pendamping Terdaftar</p>
                                <p class="text-xs text-text-secondary max-w-md">Klik tombol di bawah ini untuk menambahkan kader mahasiswa pendamping lapangan baru.</p>
                                <a href="{{ route('kampus.pendamping.create') }}" class="mt-2 inline-flex items-center gap-1 px-4 py-2 rounded-xl bg-primary text-white text-xs font-semibold hover:bg-gov-green-dark transition-all">
                                    <span class="material-symbols-outlined text-[16px]">person_add</span>
                                    <span>+ Tambah Pendamping Pertama</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pendampings->hasPages())
            <div class="p-4 border-t border-border-light">
                {{ $pendampings->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
