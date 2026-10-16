@extends('layouts.pemda')

@section('content')
<div class="flex flex-col gap-space-lg w-full">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Data Pendamping</h1>
            <p class="font-body-md text-body-md text-text-secondary mt-1">
                Kelola dan pantau seluruh data mahasiswa pendamping lapangan dari perguruan tinggi mitra.
            </p>
        </div>
        <div class="flex items-center gap-space-sm w-full md:w-auto">
            <a href="{{ route('pemda.pendamping.create') }}" class="flex-1 md:flex-none flex items-center justify-center gap-2 bg-primary-container text-on-primary px-space-md py-2.5 rounded-xl hover:bg-gov-green-dark transition-colors shadow-sm font-label-md text-label-md font-semibold">
                <span class="material-symbols-outlined text-[20px]">add</span>
                <span>Tambah Pendamping</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20 flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-space-md">
        <div class="bg-canvas-bg p-space-md rounded-xl shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-status-info-surface text-status-info flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[24px]">support_agent</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-medium">Total Pendamping</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $totalPendamping }} Orang</span>
                <span class="text-xs text-text-tertiary">Mahasiswa Terdaftar</span>
            </div>
        </div>

        <div class="bg-canvas-bg p-space-md rounded-xl shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[24px]">verified</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-medium">Pendamping Aktif</span>
                <span class="font-headline-md text-headline-md text-emerald-700 font-bold block">{{ $totalAktif }} Orang</span>
                <span class="text-xs text-emerald-600 font-semibold">{{ $totalPendamping > 0 ? round(($totalAktif / $totalPendamping) * 100) : 0 }}% Status Aktif</span>
            </div>
        </div>

        <div class="bg-canvas-bg p-space-md rounded-xl shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[24px]">school</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-medium">Asal Kampus Mitra</span>
                <span class="font-headline-md text-headline-md text-blue-700 font-bold block">{{ $totalKampusTerlibat }} Kampus</span>
                <span class="text-xs text-text-tertiary">Dari {{ $totalKampusMitra }} Mitra Bappeda</span>
            </div>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3">
        <form action="{{ route('pemda.pendamping.index') }}" method="GET" class="flex flex-wrap items-center gap-2.5 flex-1">
            <!-- Search Text -->
            <div class="relative flex-1 min-w-[200px]">
                <span class="material-symbols-outlined absolute left-3 top-2.5 text-text-tertiary text-[18px]">search</span>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama, email, NIM/NIP, prodi, atau desa..."
                    class="w-full pl-9 pr-3 py-2 rounded-lg border border-border-medium bg-surface-subtle text-text-primary text-sm focus:border-primary focus:bg-canvas-bg focus:outline-none transition-all">
            </div>

            <!-- Filter Asal Kampus -->
            <div class="min-w-[180px]">
                <select name="kampus_id" onchange="this.form.submit()" class="w-full px-3 py-2 rounded-lg border border-border-medium bg-surface-subtle text-text-primary text-sm focus:border-primary focus:outline-none transition-all cursor-pointer">
                    <option value="">Semua Asal Kampus</option>
                    @foreach($kampusList as $km)
                        <option value="{{ $km->id }}" {{ request('kampus_id') == $km->id ? 'selected' : '' }}>
                            🏛️ {{ $km->nama_universitas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Status -->
            <div class="min-w-[130px]">
                <select name="status" onchange="this.form.submit()" class="w-full px-3 py-2 rounded-lg border border-border-medium bg-surface-subtle text-text-primary text-sm focus:border-primary focus:outline-none transition-all cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>🟢 Aktif</option>
                    <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>⚪ Nonaktif</option>
                </select>
            </div>

            <button type="submit" class="px-4 py-2 bg-primary text-on-primary rounded-lg font-label-md text-sm font-semibold hover:bg-gov-green-dark transition-all shadow-sm">
                Cari
            </button>

            @if(request('search') || request('kampus_id') || request('status'))
                <a href="{{ route('pemda.pendamping.index') }}" class="px-3 py-2 text-text-secondary hover:text-text-primary text-sm font-semibold transition-colors">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3.5 px-4 font-semibold">Nama &amp; Akun Login</th>
                        <th class="py-3.5 px-4 font-semibold">Asal Kampus</th>
                        <th class="py-3.5 px-4 font-semibold">Kontak / HP</th>
                        <th class="py-3.5 px-4 font-semibold">Wilayah Penugasan</th>
                        <th class="py-3.5 px-4 font-semibold">Status</th>
                        <th class="py-3.5 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($pendampings as $p)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-status-info-surface text-status-info flex items-center justify-center font-bold text-sm shrink-0">
                                    {{ strtoupper(substr($p->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <span class="font-bold text-text-primary block truncate">{{ $p->name }}</span>
                                    <span class="text-xs text-text-secondary block truncate">{{ $p->email }}</span>
                                    @if($p->nim_nip)
                                        <span class="text-[11px] text-text-tertiary font-mono">NIM: {{ $p->nim_nip }}</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <!-- Keterangan Asal Kampus -->
                        <td class="py-3.5 px-4">
                            @if($p->kampus)
                                <a href="{{ route('pemda.kampus-mitra.show', $p->kampus->id) }}" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-800 text-xs font-bold transition-colors group/link" title="Lihat detail {{ $p->kampus->nama_universitas }}">
                                    <span class="material-symbols-outlined text-[16px] text-blue-600 group-hover/link:scale-110 transition-transform">school</span>
                                    <span>{{ $p->kampus->nama_universitas }}</span>
                                </a>
                                @if($p->fakultas_prodi)
                                    <span class="text-[11px] text-text-tertiary block mt-0.5 truncate max-w-xs">{{ $p->fakultas_prodi }}</span>
                                @endif
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-medium bg-surface-muted text-text-tertiary italic">
                                    <span class="material-symbols-outlined text-[14px]">help_outline</span>
                                    <span>Belum Ditentukan</span>
                                </span>
                            @endif
                        </td>

                        <!-- Kontak -->
                        <td class="py-3.5 px-4">
                            @if($p->no_hp)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $p->no_hp) }}" target="_blank" class="inline-flex items-center gap-1 text-text-primary hover:text-emerald-600 font-medium text-xs transition-colors">
                                    <span class="material-symbols-outlined text-[15px] text-emerald-600">call</span>
                                    <span>{{ $p->no_hp }}</span>
                                </a>
                            @else
                                <span class="text-xs text-text-tertiary">-</span>
                            @endif
                        </td>

                        <!-- Wilayah Penugasan -->
                        <td class="py-3.5 px-4">
                            <div class="flex flex-col gap-0.5">
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-text-primary">
                                    <span class="material-symbols-outlined text-[14px] text-primary">location_on</span>
                                    <span>{{ $p->assigned_wilayah_label ?: ($p->desa_penugasan ?: 'Belum Ada Penugasan') }}</span>
                                </span>
                                @if(isset($p->keluarga_penerimas_count) && $p->keluarga_penerimas_count > 0)
                                    <span class="text-[11px] text-text-secondary">
                                        Membina <strong>{{ $p->keluarga_penerimas_count }}</strong> KK
                                    </span>
                                @endif
                            </div>
                        </td>

                        <!-- Status -->
                        <td class="py-3.5 px-4">
                            @if(($p->status_keaktifan ?? 'aktif') === 'aktif')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Aktif</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                    <span>Nonaktif</span>
                                </span>
                            @endif
                        </td>

                        <!-- Aksi -->
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('pemda.pendamping.show', $p->id) }}" class="p-1.5 text-text-secondary hover:text-primary hover:bg-status-info-surface rounded-lg transition-colors" title="Lihat Detail">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <a href="{{ route('pemda.pendamping.edit', $p->id) }}" class="p-1.5 text-text-secondary hover:text-primary hover:bg-status-verified-surface rounded-lg transition-colors" title="Edit Data">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('pemda.pendamping.destroy', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus akun pendamping {{ addslashes($p->name) }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-text-secondary hover:text-error hover:bg-status-fraud-surface rounded-lg transition-colors" title="Hapus">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-text-secondary">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[48px] text-border-medium">person_off</span>
                                <p class="font-semibold text-text-primary text-sm">Tidak ada data pendamping yang ditemukan.</p>
                                <p class="text-xs text-text-tertiary">Coba ubah kata kunci pencarian atau filter kampus.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
