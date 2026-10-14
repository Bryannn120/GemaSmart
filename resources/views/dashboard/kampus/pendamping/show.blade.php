@extends('layouts.kampus')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <a href="{{ route('kampus.pendamping.index') }}" class="inline-flex items-center gap-1 text-xs text-text-secondary hover:text-primary transition-colors font-medium">
                    <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                    <span>Kembali ke Daftar Tim Pendamping</span>
                </a>
            </div>
            <div class="flex items-center gap-3">
                <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">{{ $pendamping->name }}</h1>
                @if($pendamping->status_keaktifan === 'aktif')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-status-verified-surface text-primary border border-primary/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary mr-1.5 animate-pulse"></span>
                        Aktif Lapangan
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                        Nonaktif
                    </span>
                @endif
            </div>
            <p class="font-body-md text-text-secondary mt-1">
                {{ $pendamping->fakultas_prodi ?? 'Fakultas Belum Diatur' }} • {{ $pendamping->kampus ? $pendamping->kampus->nama_universitas : 'Kampus Mitra' }}
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('kampus.pendamping.edit', $pendamping->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-primary text-on-primary font-bold text-xs hover:bg-gov-green-dark transition-all shadow-sm">
                <span class="material-symbols-outlined text-[16px]">edit</span>
                <span>Edit Profil &amp; Password</span>
            </a>
            <form action="{{ route('kampus.pendamping.destroy', $pendamping->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pendamping {{ $pendamping->name }}? Akun login akan dihapus.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-1 px-3 py-2.5 rounded-xl border border-border-medium text-status-fraud hover:bg-red-50 font-semibold text-xs transition-colors">
                    <span class="material-symbols-outlined text-[16px]">delete</span>
                    <span>Hapus</span>
                </button>
            </form>
        </div>
    </div>

    <!-- 3 KPI Cards Aktivitas Pendamping -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-lg">
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-800 shrink-0">
                <span class="material-symbols-outlined text-[26px]">family_restroom</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-semibold">Keluarga Binaan</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $pendamping->keluargaPenerimas->count() }} KK</span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Didampingi Langsung</span>
            </div>
        </div>

        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-gov-green-surface flex items-center justify-center text-primary shrink-0">
                <span class="material-symbols-outlined text-[26px]">monitoring</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-semibold">Laporan Kunjungan</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $pendamping->laporanTumbuhKembangs->count() }} Kali</span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Monitoring Lapangan</span>
            </div>
        </div>

        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-gold-surface flex items-center justify-center text-secondary shrink-0">
                <span class="material-symbols-outlined text-[26px]">volunteer_activism</span>
            </div>
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary font-semibold">Penyaluran Bantuan</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ $pendamping->penyaluranBantuans->count() }} Kali</span>
                <span class="font-label-xs text-label-xs text-text-tertiary">Serah Terima Bantuan</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Panel Detail Profil Akun -->
        <div class="bg-canvas-bg rounded-2xl p-space-lg shadow-sm border border-border-light flex flex-col gap-4">
            <div class="flex items-center gap-2 pb-3 border-b border-border-light">
                <span class="p-1.5 rounded-lg bg-gov-green-surface text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[18px]">badge</span>
                </span>
                <h3 class="font-bold text-sm text-text-primary">Informasi Akun &amp; Kontak</h3>
            </div>

            <div class="flex flex-col gap-3 text-xs">
                <div>
                    <span class="text-text-tertiary block font-medium">NIM / NIP:</span>
                    <span class="text-text-primary font-bold">{{ $pendamping->nim_nip ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-text-tertiary block font-medium">Email Login:</span>
                    <span class="text-text-primary font-semibold font-mono">{{ $pendamping->email }}</span>
                </div>
                <div>
                    <span class="text-text-tertiary block font-medium">No. WhatsApp / HP:</span>
                    @if($pendamping->no_hp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pendamping->no_hp) }}" target="_blank" class="text-primary hover:underline font-bold flex items-center gap-1 mt-0.5">
                            <span class="material-symbols-outlined text-[14px]">call</span>
                            {{ $pendamping->no_hp }}
                        </a>
                    @else
                        <span class="text-text-secondary">-</span>
                    @endif
                </div>
                <div>
                    <span class="text-text-tertiary block font-medium">Desa / Wilayah Penugasan:</span>
                    <span class="text-text-primary font-bold">{{ $pendamping->desa_penugasan ?? 'Belum ditentukan' }}</span>
                </div>
                <div>
                    <span class="text-text-tertiary block font-medium">Kampus Mitra:</span>
                    <span class="text-text-primary font-semibold">{{ $pendamping->kampus ? $pendamping->kampus->nama_universitas : '-' }}</span>
                </div>
                <div>
                    <span class="text-text-tertiary block font-medium">Terdaftar Sejak:</span>
                    <span class="text-text-secondary">{{ $pendamping->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar Keluarga Penerima Binaan -->
        <div class="lg:col-span-2 bg-canvas-bg rounded-2xl shadow-sm border border-border-light flex flex-col overflow-hidden">
            <div class="p-space-md border-b border-border-light flex items-center justify-between bg-surface-subtle">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-[20px]">diversity_3</span>
                    <h3 class="font-bold text-sm text-text-primary">Daftar Keluarga Penerima Binaan</h3>
                </div>
                <span class="text-xs font-bold px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-800">
                    {{ $pendamping->keluargaPenerimas->count() }} KK Terhubung
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left font-body-sm text-xs">
                    <thead class="bg-surface-muted text-text-secondary font-semibold border-b border-border-light">
                        <tr>
                            <th class="py-3 px-4">Kepala Keluarga</th>
                            <th class="py-3 px-4">Wilayah / Desa</th>
                            <th class="py-3 px-4">Status Validasi</th>
                            <th class="py-3 px-4">Kemandirian</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        @forelse($pendamping->keluargaPenerimas as $kk)
                        <tr class="hover:bg-surface-subtle transition-colors">
                            <td class="py-3 px-4">
                                <span class="font-bold text-text-primary block">{{ $kk->kepala_keluarga }}</span>
                                <span class="text-text-tertiary text-[11px]">NIK: {{ $kk->nik }} • KK: {{ $kk->no_kk }}</span>
                            </td>
                            <td class="py-3 px-4 text-text-secondary">
                                {{ $kk->wilayah ? $kk->wilayah->nama : '-' }}
                                @if($kk->wilayah && $kk->wilayah->parent)
                                    <span class="block text-[11px] text-text-tertiary">Kec. {{ $kk->wilayah->parent->nama }}</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                @if($kk->status_validasi === 'valid')
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-gov-green-surface text-primary">Valid</span>
                                @elseif($kk->status_validasi === 'menunggu_verifikasi')
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">Menunggu</span>
                                @else
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-600">{{ $kk->status_validasi }}</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                @if($kk->status_kemandirian === 'mandiri')
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Mandiri</span>
                                @elseif($kk->status_kemandirian === 'berkembang')
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Berkembang</span>
                                @else
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-gold-surface text-secondary">Rentan</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-8 px-4 text-center text-text-tertiary">
                                Belum ada keluarga penerima yang di-ploting ke pendamping ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
