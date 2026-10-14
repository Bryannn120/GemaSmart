@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header Page & Breadcrumb -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-3xl">
            <div class="flex items-center gap-space-xs text-text-secondary font-label-md text-label-md mb-1">
                <a href="{{ route('pemda.audit-log.index') }}" class="hover:text-text-primary transition-colors">Audit Log</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="text-text-primary font-semibold">Detail Rekam Jejak #{{ $log->id }}</span>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight flex items-center gap-2">
                <span>{{ $log->aksi }}</span>
            </h1>
            <p class="font-body-md text-text-secondary mt-1">
                Detail forensik transaksi dan perubahan atribut data pada entitas <strong>{{ $log->model ?? 'Sistem' }}</strong> (ID: {{ $log->model_id ?? '-' }}).
            </p>
        </div>
        <div class="flex items-center gap-space-sm">
            <a href="{{ route('pemda.audit-log.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 border border-border-medium hover:bg-surface-subtle text-text-primary font-label-md text-label-md font-semibold rounded-xl transition-colors shadow-2xs">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                <span>Kembali ke Daftar Log</span>
            </a>
        </div>
    </div>

    <!-- Metadata Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-space-lg">
        <!-- Aktor / Pengguna -->
        <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="font-label-md text-label-md font-semibold text-text-secondary uppercase tracking-wider">Aktor / Pengguna</span>
                    <span class="material-symbols-outlined text-text-secondary text-[20px]">person</span>
                </div>
                @php
                    $user = $log->user;
                    $role = $user ? $user->role : 'system';
                    $roleBadge = match($role) {
                        'pemda' => 'bg-blue-50 text-blue-700 border-blue-200',
                        'kampus' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                        'pendamping' => 'bg-teal-50 text-teal-700 border-teal-200',
                        'validator' => 'bg-amber-50 text-amber-700 border-amber-200',
                        'penerima' => 'bg-purple-50 text-purple-700 border-purple-200',
                        default => 'bg-gray-100 text-gray-700 border-gray-200',
                    };
                @endphp
                <div class="flex items-center gap-space-md">
                    <div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center font-bold text-base text-on-primary-fixed-variant">
                        {{ strtoupper(substr($user->name ?? 'S', 0, 1)) }}
                    </div>
                    <div>
                        <div class="font-headline-sm text-headline-sm font-bold text-text-primary">
                            {{ $user->name ?? 'Sistem / Anonim' }}
                        </div>
                        <div class="text-xs text-text-secondary mt-0.5">
                            {{ $user->email ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-border-light flex items-center justify-between text-xs">
                <span class="text-text-secondary">Peran Akun:</span>
                <span class="px-2 py-0.5 rounded font-semibold border {{ $roleBadge }}">
                    {{ ucfirst($role) }}
                </span>
            </div>
        </div>

        <!-- Modul & Objek -->
        <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="font-label-md text-label-md font-semibold text-text-secondary uppercase tracking-wider">Modul & Target Objek</span>
                    <span class="material-symbols-outlined text-text-secondary text-[20px]">category</span>
                </div>
                <div class="flex flex-col gap-1">
                    <div class="font-headline-sm text-headline-sm font-bold text-text-primary">
                        {{ $log->model ?? 'Sistem' }}
                    </div>
                    <div class="text-xs text-text-secondary">
                        ID Record Objek: <strong class="font-code-dense text-text-primary">#{{ $log->model_id ?? '-' }}</strong>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-border-light flex items-center justify-between text-xs">
                <span class="text-text-secondary">Kategori Operasi:</span>
                <span class="px-2 py-0.5 rounded font-semibold bg-surface-container text-text-primary border border-border-medium">
                    @if($log->data_lama && $log->data_baru)
                        UPDATE (Perubahan Data)
                    @elseif($log->data_baru && !$log->data_lama)
                        CREATE / INSERT (Data Baru)
                    @elseif($log->data_lama && !$log->data_baru)
                        DELETE (Penghapusan)
                    @else
                        EVENT / AKSES SISTEM
                    @endif
                </span>
            </div>
        </div>

        <!-- Waktu & Jaringan -->
        <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="font-label-md text-label-md font-semibold text-text-secondary uppercase tracking-wider">Waktu & Jaringan</span>
                    <span class="material-symbols-outlined text-text-secondary text-[20px]">schedule</span>
                </div>
                <div class="flex flex-col gap-1">
                    <div class="font-headline-sm text-headline-sm font-bold text-text-primary">
                        {{ $log->created_at->timezone('Asia/Makassar')->translatedFormat('d M Y, H:i:s') }} WITA
                    </div>
                    <div class="text-xs text-text-secondary">
                        Tercatat {{ $log->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-border-light flex items-center justify-between text-xs">
                <span class="text-text-secondary">Alamat IP:</span>
                <span class="px-2 py-0.5 rounded font-code-dense text-xs bg-surface-muted text-text-primary border border-border-light">
                    {{ $log->ip_address ?? '127.0.0.1' }}
                </span>
            </div>
        </div>
    </div>

    <!-- Data Changes Comparison (Payload Inspector) -->
    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light overflow-hidden flex flex-col">
        <div class="p-space-lg border-b border-border-light bg-surface-subtle/50 flex flex-col sm:flex-row sm:items-center justify-between gap-space-md">
            <div>
                <h3 class="font-headline-md text-headline-md font-bold text-text-primary flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-[22px]">compare_arrows</span>
                    <span>Rekam Jejak Perubahan Atribut Data (Payload)</span>
                </h3>
                <p class="font-body-sm text-body-sm text-text-secondary mt-0.5">
                    Perbandingan data sebelum dan sesudah aktivitas dilakukan oleh pengguna.
                </p>
            </div>
        </div>

        <div class="p-space-lg">
            @php
                $dataLama = (array) ($log->data_lama ?? []);
                $dataBaru = (array) ($log->data_baru ?? []);
                $allKeys = array_unique(array_merge(array_keys($dataLama), array_keys($dataBaru)));
            @endphp

            @if(!empty($allKeys))
                <div class="overflow-x-auto rounded-xl border border-border-light">
                    <table class="w-full text-left font-body-sm text-body-sm">
                        <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                            <tr>
                                <th class="py-3 px-4 font-semibold w-1/4">Nama Atribut / Kolom</th>
                                <th class="py-3 px-4 font-semibold w-3/8 bg-red-50/50 text-red-900 border-r border-border-light">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px] text-red-600">history</span>
                                        <span>Data Sebelumnya (Old Value)</span>
                                    </span>
                                </th>
                                <th class="py-3 px-4 font-semibold w-3/8 bg-emerald-50/50 text-emerald-900">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px] text-emerald-600">update</span>
                                        <span>Data Baru / Diubah (New Value)</span>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-light bg-canvas-bg font-code-dense text-xs">
                            @foreach($allKeys as $key)
                                @php
                                    $valLama = $dataLama[$key] ?? null;
                                    $valBaru = $dataBaru[$key] ?? null;
                                    $isChanged = ($valLama !== $valBaru) && array_key_exists($key, $dataLama) && array_key_exists($key, $dataBaru);
                                    
                                    $formatVal = function($val) {
                                        if (is_null($val)) return '<span class="text-text-secondary italic">null</span>';
                                        if (is_bool($val)) return $val ? '<span class="text-emerald-700 font-semibold">true</span>' : '<span class="text-red-700 font-semibold">false</span>';
                                        if (is_array($val)) return htmlspecialchars(json_encode($val, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
                                        return htmlspecialchars((string)$val);
                                    };
                                @endphp
                                <tr class="{{ $isChanged ? 'bg-amber-50/40' : 'hover:bg-surface-subtle' }} transition-colors">
                                    <td class="py-3 px-4 font-semibold text-text-primary border-r border-border-light">
                                        <div class="flex items-center gap-1.5">
                                            @if($isChanged)
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            @endif
                                            <span>{{ $key }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 border-r border-border-light {{ array_key_exists($key, $dataLama) ? 'text-text-secondary' : 'text-gray-400 italic' }}">
                                        {!! array_key_exists($key, $dataLama) ? $formatVal($valLama) : '<span class="text-gray-400 italic">(tidak ada)</span>' !!}
                                    </td>
                                    <td class="py-3 px-4 {{ $isChanged ? 'font-semibold text-emerald-700 bg-emerald-50/20' : (array_key_exists($key, $dataBaru) ? 'text-text-primary' : 'text-gray-400 italic') }}">
                                        {!! array_key_exists($key, $dataBaru) ? $formatVal($valBaru) : '<span class="text-gray-400 italic">(dihapus / tidak ada)</span>' !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-8 text-center bg-surface-subtle rounded-xl border border-border-light">
                    <span class="material-symbols-outlined text-[36px] text-text-secondary mb-2 block">info</span>
                    <span class="font-headline-sm text-headline-sm font-semibold text-text-primary block">Tidak Ada Payload Spesifik</span>
                    <p class="font-body-sm text-body-sm text-text-secondary mt-1">
                        Aktivitas ini merupakan event sistem tanpa perubahan kolom atribut langsung.
                    </p>
                </div>
            @endif
        </div>

        <!-- Raw JSON Inspector Accordion -->
        <div class="p-space-lg border-t border-border-light bg-surface-subtle/30" x-data="{ open: false }">
            <button @click="open = !open" type="button" class="w-full flex items-center justify-between text-left font-label-md text-label-md font-semibold text-text-primary hover:text-primary transition-colors">
                <span class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">code</span>
                    <span>Inspeksi Raw JSON Payload (Untuk Forensik IT)</span>
                </span>
                <span class="material-symbols-outlined transition-transform duration-200" :class="open ? 'rotate-180' : ''">expand_more</span>
            </button>

            <div x-show="open" x-cloak class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-space-md">
                <div class="bg-gray-900 rounded-xl p-4 text-gray-100 font-code-dense text-xs overflow-x-auto shadow-inner">
                    <div class="text-gray-400 font-semibold mb-2 uppercase text-[11px] tracking-wider border-b border-gray-700 pb-1">Raw: Data Lama</div>
                    <pre><code>{{ json_encode($log->data_lama, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?: 'null' }}</code></pre>
                </div>
                <div class="bg-gray-900 rounded-xl p-4 text-gray-100 font-code-dense text-xs overflow-x-auto shadow-inner">
                    <div class="text-gray-400 font-semibold mb-2 uppercase text-[11px] tracking-wider border-b border-gray-700 pb-1">Raw: Data Baru</div>
                    <pre><code>{{ json_encode($log->data_baru, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?: 'null' }}</code></pre>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
