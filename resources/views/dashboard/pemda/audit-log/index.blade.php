@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header Page -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <div class="flex items-center gap-space-xs text-text-secondary font-label-md text-label-md mb-1">
                <span>Dashboard Bappeda</span>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="text-text-primary font-semibold">Audit Log Sistem</span>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Audit Log (Riwayat Sistem)</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Rekam jejak seluruh transaksi, perubahan data, dan aktivitas pengguna secara transparan dan <i>real-time</i> langsung dari database sistem.
            </p>
        </div>
        <div class="flex items-center gap-space-sm">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-200">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Audit Trail Aktif</span>
            </span>
        </div>
    </div>

    <!-- Summary Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-lg">
        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-primary-fixed flex items-center justify-center text-on-primary-fixed-variant">
                <span class="material-symbols-outlined text-[24px]">receipt_long</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Total Log Tercatat</span>
                <span class="font-headline-md text-headline-md text-text-primary font-bold block">{{ number_format($totalLogs, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-700">
                <span class="material-symbols-outlined text-[24px]">today</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Aktivitas Hari Ini</span>
                <span class="font-headline-md text-headline-md text-blue-700 font-bold block">{{ number_format($logsHariIni, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center text-purple-700">
                <span class="material-symbols-outlined text-[24px]">group</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Aktor / Pengguna Aktif</span>
                <span class="font-headline-md text-headline-md text-purple-700 font-bold block">{{ number_format($totalUsersAktif, 0, ',', '.') }} Pengguna</span>
            </div>
        </div>

        <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light flex items-center gap-space-md">
            <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-700">
                <span class="material-symbols-outlined text-[24px]">dashboard_customize</span>
            </div>
            <div>
                <span class="font-label-md text-label-md text-text-secondary">Modul Terpantau</span>
                <span class="font-headline-md text-headline-md text-amber-700 font-bold block">{{ count($distinctModels) }} Modul</span>
            </div>
        </div>
    </div>

    <!-- Filters & Search Toolbar -->
    <div class="bg-canvas-bg rounded-xl p-space-md shadow-sm border border-border-light">
        <form method="GET" action="{{ route('pemda.audit-log.index') }}" class="flex flex-col lg:flex-row gap-space-md items-end">
            <!-- Search Text Input -->
            <div class="flex-1 w-full">
                <label for="search" class="font-label-sm text-label-sm text-text-secondary block mb-1">Pencarian Aktivitas / Pengguna / IP</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary text-[20px]">search</span>
                    <input type="text" id="search" name="search" value="{{ $search }}" placeholder="Ketik kata kunci aktivitas, nama user, modul, atau IP..."
                        class="w-full pl-10 pr-4 py-2 border border-border-light rounded-xl font-body-sm text-text-primary focus:outline-none focus:border-gov-green focus:ring-1 focus:ring-gov-green transition-all">
                </div>
            </div>

            <!-- Modul Dropdown -->
            <div class="w-full lg:w-48">
                <label for="model" class="font-label-sm text-label-sm text-text-secondary block mb-1">Modul / Objek</label>
                <select id="model" name="model" class="w-full py-2 px-3 border border-border-light rounded-xl font-body-sm text-text-primary focus:outline-none focus:border-gov-green focus:ring-1 focus:ring-gov-green">
                    <option value="">-- Semua Modul --</option>
                    @foreach($distinctModels as $mod)
                        <option value="{{ $mod }}" {{ $modelFilter == $mod ? 'selected' : '' }}>
                            @if($mod == 'PenilaianKemandirian') Penilaian Kemandirian
                            @elseif($mod == 'PenyaluranBantuan') Penyaluran Bantuan
                            @elseif($mod == 'KeluargaPenerima') Keluarga Penerima
                            @elseif($mod == 'KampusMitra') Kampus Mitra
                            @elseif($mod == 'ProgramBantuan') Program Bantuan
                            @elseif($mod == 'User') Pengguna / Pendamping
                            @elseif($mod == 'Auth') Autentikasi / Login
                            @else {{ $mod }}
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Peran / Role Dropdown -->
            <div class="w-full lg:w-44">
                <label for="role" class="font-label-sm text-label-sm text-text-secondary block mb-1">Peran Aktor</label>
                <select id="role" name="role" class="w-full py-2 px-3 border border-border-light rounded-xl font-body-sm text-text-primary focus:outline-none focus:border-gov-green focus:ring-1 focus:ring-gov-green">
                    <option value="">-- Semua Peran --</option>
                    <option value="pemda" {{ $roleFilter == 'pemda' ? 'selected' : '' }}>Pemda (Bappeda)</option>
                    <option value="kampus" {{ $roleFilter == 'kampus' ? 'selected' : '' }}>Kampus Mitra</option>
                    <option value="pendamping" {{ $roleFilter == 'pendamping' ? 'selected' : '' }}>Pendamping</option>
                    <option value="validator" {{ $roleFilter == 'validator' ? 'selected' : '' }}>Validator</option>
                    <option value="penerima" {{ $roleFilter == 'penerima' ? 'selected' : '' }}>Penerima Bantuan</option>
                </select>
            </div>

            <!-- Date Range Filter -->
            <div class="w-full lg:w-40">
                <label for="start_date" class="font-label-sm text-label-sm text-text-secondary block mb-1">Dari Tanggal</label>
                <input type="date" id="start_date" name="start_date" value="{{ $startDate }}"
                    class="w-full py-2 px-3 border border-border-light rounded-xl font-body-sm text-text-primary focus:outline-none focus:border-gov-green focus:ring-1 focus:ring-gov-green">
            </div>

            <div class="w-full lg:w-40">
                <label for="end_date" class="font-label-sm text-label-sm text-text-secondary block mb-1">Sampai Tanggal</label>
                <input type="date" id="end_date" name="end_date" value="{{ $endDate }}"
                    class="w-full py-2 px-3 border border-border-light rounded-xl font-body-sm text-text-primary focus:outline-none focus:border-gov-green focus:ring-1 focus:ring-gov-green">
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-space-xs w-full lg:w-auto">
                <button type="submit" class="w-full lg:w-auto inline-flex items-center justify-center gap-1.5 px-space-md py-2 bg-primary-container text-on-primary rounded-xl font-label-md text-label-md font-semibold hover:bg-gov-green-dark transition-colors shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">filter_alt</span>
                    <span>Terapkan</span>
                </button>
                @if($search || $modelFilter || $roleFilter || $startDate || $endDate)
                    <a href="{{ route('pemda.audit-log.index') }}" class="w-full lg:w-auto inline-flex items-center justify-center gap-1 px-3 py-2 border border-border-medium text-text-secondary hover:bg-surface-subtle rounded-xl font-label-md text-label-md transition-colors" title="Reset Filter">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                        <span>Reset</span>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="p-space-md border-b border-border-light flex items-center justify-between bg-surface-subtle/50">
            <div class="flex items-center gap-space-sm">
                <span class="font-headline-sm text-headline-sm font-bold text-text-primary">Daftar Aktivitas Sistem</span>
                <span class="px-2 py-0.5 rounded-full bg-surface-container text-xs font-semibold text-text-secondary border border-border-light">
                    {{ $logs->total() }} riwayat
                </span>
            </div>
            <span class="text-xs text-text-secondary font-label-sm">
                Zona Waktu: <strong>WITA (GMT+8)</strong>
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3 px-4 font-semibold w-16">#ID</th>
                        <th class="py-3 px-4 font-semibold w-48">Waktu (WITA)</th>
                        <th class="py-3 px-4 font-semibold w-64">Pengguna / Aktor</th>
                        <th class="py-3 px-4 font-semibold w-48">Modul</th>
                        <th class="py-3 px-4 font-semibold">Aktivitas & Deskripsi</th>
                        <th class="py-3 px-4 font-semibold w-36">Alamat IP</th>
                        <th class="py-3 px-4 font-semibold text-right w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse($logs as $log)
                        @php
                            $user = $log->user;
                            $role = $user ? $user->role : 'system';
                            
                            // Warna Badge Role
                            $roleBadgeClasses = match($role) {
                                'pemda' => 'bg-blue-50 text-blue-700 border-blue-200',
                                'kampus' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                'pendamping' => 'bg-teal-50 text-teal-700 border-teal-200',
                                'validator' => 'bg-amber-50 text-amber-700 border-amber-200',
                                'penerima' => 'bg-purple-50 text-purple-700 border-purple-200',
                                default => 'bg-gray-100 text-gray-700 border-gray-200',
                            };

                            // Format Label Modul & Icon
                            $modulLabel = match($log->model) {
                                'PenilaianKemandirian' => 'Penilaian Desil',
                                'PenyaluranBantuan' => 'Penyaluran Bantuan',
                                'KeluargaPenerima' => 'Keluarga Penerima',
                                'KampusMitra' => 'Kampus Mitra',
                                'ProgramBantuan' => 'Program Bantuan',
                                'User' => 'Pengguna / SDM',
                                'Auth' => 'Autentikasi Login',
                                default => $log->model ?? 'Sistem',
                            };

                            $modulIcon = match($log->model) {
                                'PenilaianKemandirian' => 'trending_up',
                                'PenyaluranBantuan' => 'local_shipping',
                                'KeluargaPenerima' => 'family_restroom',
                                'KampusMitra' => 'school',
                                'ProgramBantuan' => 'assignment',
                                'User' => 'person',
                                'Auth' => 'lock',
                                default => 'dns',
                            };
                        @endphp
                        <tr class="hover:bg-surface-subtle transition-colors group">
                            <!-- ID -->
                            <td class="py-3.5 px-4 font-code-dense text-xs text-text-secondary">
                                #{{ $log->id }}
                            </td>

                            <!-- Waktu WITA -->
                            <td class="py-3.5 px-4 font-code-dense text-text-secondary whitespace-nowrap">
                                <div class="font-medium text-text-primary text-xs">
                                    {{ $log->created_at->timezone('Asia/Makassar')->translatedFormat('d M Y, H:i:s') }}
                                </div>
                                <div class="text-[11px] text-text-secondary mt-0.5">
                                    {{ $log->created_at->diffForHumans() }}
                                </div>
                            </td>

                            <!-- Pengguna / Aktor -->
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-space-xs">
                                    <div class="w-8 h-8 rounded-full bg-primary-fixed flex items-center justify-center font-bold text-xs text-on-primary-fixed-variant shrink-0">
                                        {{ strtoupper(substr($user->name ?? 'S', 0, 1)) }}
                                    </div>
                                    <div class="flex flex-col min-w-0">
                                        <span class="font-semibold text-text-primary truncate block text-xs" title="{{ $user->name ?? 'Sistem / Anonim' }}">
                                            {{ $user->name ?? 'Sistem / Tamu' }}
                                        </span>
                                        <div class="flex items-center gap-1 mt-0.5">
                                            <span class="inline-flex px-1.5 py-0.2 rounded text-[10px] font-semibold border {{ $roleBadgeClasses }}">
                                                {{ ucfirst($role) }}
                                            </span>
                                            @if($user && $user->email)
                                                <span class="text-[10px] text-text-secondary truncate max-w-[120px]" title="{{ $user->email }}">{{ $user->email }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Modul -->
                            <td class="py-3.5 px-4">
                                <span class="inline-flex items-center gap-1 px-space-sm py-1 rounded-lg text-xs font-semibold bg-surface-container text-text-secondary border border-border-medium whitespace-nowrap">
                                    <span class="material-symbols-outlined text-[15px]">{{ $modulIcon }}</span>
                                    <span>{{ $modulLabel }}</span>
                                </span>
                            </td>

                            <!-- Aktivitas / Deskripsi -->
                            <td class="py-3.5 px-4 text-text-primary">
                                <div class="font-medium text-xs text-text-primary">
                                    {{ $log->aksi }}
                                </div>
                                @if(!empty($log->data_baru))
                                    <div class="text-[11px] text-text-secondary mt-0.5 truncate max-w-md">
                                        @if(isset($log->data_baru['kepala_keluarga']))
                                            Warga: <strong>{{ $log->data_baru['kepala_keluarga'] }}</strong>
                                        @elseif(isset($log->data_baru['nama_universitas']))
                                            Kampus: <strong>{{ $log->data_baru['nama_universitas'] }}</strong>
                                        @elseif(isset($log->data_baru['nominal_transaksi']))
                                            Nominal: <strong>Rp {{ number_format($log->data_baru['nominal_transaksi'], 0, ',', '.') }}</strong>
                                        @elseif(isset($log->data_baru['desil']))
                                            Desil: <strong>{{ $log->data_baru['desil'] }}</strong> ({{ $log->data_baru['status_kemandirian'] ?? '' }})
                                        @elseif(isset($log->data_baru['nama_program']))
                                            Program: <strong>{{ $log->data_baru['nama_program'] }}</strong>
                                        @elseif(isset($log->data_baru['name']))
                                            Nama: <strong>{{ $log->data_baru['name'] }}</strong>
                                        @endif
                                    </div>
                                @endif
                            </td>

                            <!-- IP Address -->
                            <td class="py-3.5 px-4 font-code-dense text-xs text-text-secondary whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded bg-surface-muted text-text-secondary border border-border-light text-[11px]">
                                    {{ $log->ip_address ?? '127.0.0.1' }}
                                </span>
                            </td>

                            <!-- Aksi -->
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <a href="{{ route('pemda.audit-log.show', $log->id) }}" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg border border-border-medium hover:bg-surface-subtle text-text-primary font-label-sm text-xs font-semibold transition-colors shadow-2xs" title="Lihat Rekam Jejak Detail">
                                    <span>Detail</span>
                                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 px-4 text-center">
                                <div class="flex flex-col items-center justify-center text-text-secondary">
                                    <div class="w-16 h-16 rounded-full bg-surface-container flex items-center justify-center mb-3 text-text-secondary">
                                        <span class="material-symbols-outlined text-[32px]">manage_search</span>
                                    </div>
                                    <span class="font-headline-sm text-headline-sm text-text-primary font-semibold">Tidak Ada Log Ditemukan</span>
                                    <p class="font-body-sm text-body-sm max-w-md mt-1 text-text-secondary">
                                        Tidak ada catatan riwayat sistem yang cocok dengan parameter filter atau pencarian Anda. Silakan ubah filter atau klik Reset.
                                    </p>
                                    @if($search || $modelFilter || $roleFilter || $startDate || $endDate)
                                        <a href="{{ route('pemda.audit-log.index') }}" class="mt-4 px-4 py-2 rounded-xl bg-surface-container hover:bg-surface-container-high text-text-primary font-label-md text-label-md font-semibold transition-colors">
                                            Reset Filter Pencarian
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($logs->hasPages())
            <div class="p-space-md border-t border-border-light bg-surface-subtle/30 flex items-center justify-between">
                <div class="font-label-sm text-xs text-text-secondary">
                    Menampilkan <strong>{{ $logs->firstItem() }}</strong> - <strong>{{ $logs->lastItem() }}</strong> dari <strong>{{ $logs->total() }}</strong> catatan riwayat
                </div>
                <div>
                    {{ $logs->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
