@extends('layouts.pendamping')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Keluarga Penerima Binaan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Daftar keluarga penerima manfaat program bantuan bibit yang berada dalam wilayah binaan dan pendampingan Anda di lapangan.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-gov-green-surface text-primary border border-primary/20">
                Total: {{ $keluarga_penerimas->count() }} Keluarga Binaan
            </span>
            <a href="{{ route('pendamping.keluarga_penerima.create') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-primary hover:bg-gov-green-dark text-white font-label-md text-xs font-bold shadow-sm transition-all">
                <span class="material-symbols-outlined text-[17px]">person_add</span>
                <span>+ Tambah Penerima</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-status-verified-surface text-primary p-space-md rounded-xl font-body-sm border border-primary/20 flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Search Bar -->
    <div class="bg-canvas-bg rounded-2xl p-space-md shadow-sm border border-border-light flex flex-col sm:flex-row items-center justify-between gap-space-md">
        <form action="{{ route('pendamping.keluarga_penerima.index') }}" method="GET" class="w-full flex items-center gap-space-sm">
            <div class="flex-1 relative">
                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-text-secondary text-[20px]">search</span>
                <input type="text" name="search" id="searchKeluarga" value="{{ request('search') }}"
                    placeholder="Cari nama kepala keluarga, NIK, No. KK, atau nama wilayah (desa/kecamatan)..."
                    class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-border-medium bg-surface-subtle focus:bg-white text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                @if(request('search'))
                    <a href="{{ route('pendamping.keluarga_penerima.index') }}" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-text-tertiary hover:text-text-primary" title="Hapus pencarian">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </a>
                @endif
            </div>
            <button type="submit" class="px-space-md py-2.5 rounded-xl bg-primary text-white font-label-md text-xs font-semibold hover:bg-gov-green-dark transition-colors shadow-sm flex items-center gap-1.5 shrink-0">
                <span class="material-symbols-outlined text-[16px]">search</span>
                <span>Cari</span>
            </button>
            @if(request('search'))
                <a href="{{ route('pendamping.keluarga_penerima.index') }}" class="px-space-md py-2.5 rounded-xl bg-surface-container-high hover:bg-surface-container-highest text-text-secondary hover:text-text-primary font-label-md text-xs font-semibold transition-colors border border-border-light flex items-center gap-1 shrink-0">
                    <span class="material-symbols-outlined text-[16px]">refresh</span>
                    <span>Reset</span>
                </a>
            @endif
        </form>
    </div>

    <!-- Tabs: Penerima Aktif vs Lulus Mandiri -->
    <div class="flex items-center gap-2 border-b border-border-light pb-2">
        <a href="{{ route('pendamping.keluarga_penerima.index', array_merge(request()->except('tab'), ['tab' => 'aktif'])) }}" 
           class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 {{ $tab !== 'mandiri' ? 'bg-primary text-white shadow-sm' : 'bg-surface-subtle text-text-secondary hover:text-text-primary' }}">
            <span class="material-symbols-outlined text-[16px]">verified</span>
            <span>Daftar Penerima Bantuan Aktif</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $tab !== 'mandiri' ? 'bg-white/20 text-white' : 'bg-primary/10 text-primary font-bold' }}">{{ $countAktif }}</span>
        </a>
        <a href="{{ route('pendamping.keluarga_penerima.index', array_merge(request()->except('tab'), ['tab' => 'mandiri'])) }}" 
           class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 {{ $tab === 'mandiri' ? 'bg-emerald-700 text-white shadow-sm' : 'bg-surface-subtle text-text-secondary hover:text-text-primary' }}">
            <span class="material-symbols-outlined text-[16px]">workspace_premium</span>
            <span>Lulus Mandiri (Desil 6+)</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $tab === 'mandiri' ? 'bg-white/20 text-white' : 'bg-emerald-100 text-emerald-800 font-bold' }}">{{ $countMandiri }}</span>
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="p-space-md border-b border-border-light bg-surface-subtle flex items-center justify-between">
            <span class="text-xs font-bold text-text-primary uppercase tracking-wider">
                {{ $tab === 'mandiri' ? 'Warga Binaan Telah Mandiri / Lulus (Desil 6 ke atas)' : 'Daftar Penerima Bantuan Aktif Binaan (Desil 1 s/d 5)' }}
            </span>
            <span class="text-xs text-text-secondary font-medium">
                {{ $keluarga_penerimas->count() }} Data Ditampilkan
            </span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Nama Kepala Keluarga</th>
                        <th class="py-3 px-4 font-semibold">No. KK & NIK</th>
                        <th class="py-3 px-4 font-semibold">Wilayah / Alamat</th>
                        <th class="py-3 px-4 font-semibold">Penghasilan/Bln</th>
                        <th class="py-3 px-4 font-semibold">Desil</th>
                        <th class="py-3 px-4 font-semibold">Kemandirian</th>
                        <th class="py-3 px-4 font-semibold">Program Bantuan</th>
                        <th class="py-3 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($keluarga_penerimas as $kp)
                    <tr class="hover:bg-surface-subtle transition-colors group">
                        <td class="py-3.5 px-4 font-semibold text-text-primary">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gov-green-surface text-primary flex items-center justify-center font-bold text-xs">
                                    {{ strtoupper(substr($kp->kepala_keluarga, 0, 1)) }}
                                </div>
                                <span>{{ $kp->kepala_keluarga }}</span>
                            </div>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="font-mono text-text-primary block font-medium">{{ $kp->no_kk }}</span>
                            <span class="text-text-tertiary font-mono text-[11px]">NIK: {{ $kp->nik }}</span>
                        </td>
                        <td class="py-3.5 px-4 text-text-primary">
                            <div>{{ $kp->wilayah->nama ?? 'Sumbawa' }}</div>
                            <span class="text-text-tertiary text-xs">{{ $kp->alamat }}</span>
                        </td>
                        <td class="py-3.5 px-4 font-mono text-xs">
                            @if(($kp->penghasilan_perbulan ?? 0) > 0)
                                <span class="font-bold text-text-primary">Rp {{ number_format($kp->penghasilan_perbulan, 0, ',', '.') }}</span>
                            @else
                                <span class="text-text-tertiary italic">Belum diinput</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="inline-block px-2.5 py-0.5 rounded text-xs font-bold bg-gov-green-surface text-primary border border-primary/20">
                                Desil {{ $kp->desil }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4">
                            @if ($kp->desil >= 6 || $kp->status_kemandirian == 'Mandiri')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-xs font-bold bg-green-100 text-green-800">
                                    <span class="material-symbols-outlined text-[13px]">verified</span>
                                    Sudah Mandiri
                                </span>
                            @elseif ($kp->status_kemandirian == 'Penurunan Desil')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-xs font-bold bg-amber-100 text-amber-800">
                                    <span class="material-symbols-outlined text-[13px]">trending_down</span>
                                    Penurunan Desil
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-xs font-bold bg-blue-100 text-blue-800">
                                    <span class="material-symbols-outlined text-[13px]">hourglass_top</span>
                                    Tahap Kemandirian
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-text-primary text-xs font-medium">
                            {{ $kp->programBantuan->nama_program ?? '-' }}
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5">
                                <a href="{{ route('pendamping.keluarga_penerima.penilaian.create', $kp->id) }}" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-gov-green-surface hover:bg-gov-green text-primary hover:text-white font-label-md text-xs font-semibold transition-colors border border-primary/20" title="Beri Penilaian Desil">
                                    <span class="material-symbols-outlined text-[15px]">rate_review</span>
                                    <span>Nilai Desil</span>
                                </a>
                                <a href="{{ route('pendamping.keluarga_penerima.show', $kp->id) }}" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-surface-container-low hover:bg-surface-container-high text-text-secondary hover:text-text-primary font-label-md text-xs font-semibold transition-colors border border-border-light" title="Lihat Profil Lengkap">
                                    <span class="material-symbols-outlined text-[15px]">visibility</span>
                                    <span>Detail</span>
                                </a>
                                <a href="{{ route('pendamping.keluarga_penerima.edit', $kp->id) }}" class="inline-flex items-center gap-1 px-2 py-1.5 rounded-lg bg-surface-container-low hover:bg-surface-container-high text-text-secondary hover:text-text-primary font-label-md text-xs font-semibold transition-colors border border-border-light" title="Edit Data Penerima">
                                    <span class="material-symbols-outlined text-[15px]">edit</span>
                                </a>
                                <form action="{{ route('pendamping.keluarga_penerima.destroy', $kp->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data penerima {{ $kp->kepala_keluarga }}? Tindakan ini tidak dapat dibatalkan.');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-2 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 font-label-md text-xs font-semibold transition-colors border border-red-200" title="Hapus Data Penerima">
                                        <span class="material-symbols-outlined text-[15px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-12 text-text-tertiary">
                            <span class="material-symbols-outlined text-4xl block mb-2 text-text-tertiary">group_off</span>
                            Belum ada data keluarga penerima binaan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
