@props([
    'periodInfo' => null,
    'label' => 'Filter Periode Laporan:',
    'route' => null,
])

@php
    $periodInfo = $periodInfo ?? \App\Services\PeriodFilterHelper::parseRequest(request());
    $startDate = request('start_date', $periodInfo['start_date'] ?? '');
    $endDate = request('end_date', $periodInfo['end_date'] ?? '');
@endphp

<div class="bg-canvas-bg p-space-md rounded-2xl border border-border-light shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
    <!-- Status & Info Periode Aktif -->
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-gov-green-surface text-primary flex items-center justify-center shrink-0 border border-primary/20">
            <span class="material-symbols-outlined text-[20px]">calendar_today</span>
        </div>
        <div>
            <span class="font-label-md text-xs uppercase tracking-wider font-bold text-text-primary block">{{ $label }}</span>
            <div class="flex items-center gap-1.5 text-xs text-text-secondary mt-0.5">
                <span>Periode:</span>
                <span class="font-bold {{ !empty($periodInfo['is_filtered']) ? 'text-primary bg-primary/10 px-2 py-0.5 rounded-lg' : 'text-text-primary' }}">
                    {{ $periodInfo['label'] }}
                </span>
            </div>
        </div>
    </div>

    <!-- Form Pemilihan Rentang Tanggal Bebas (Dari tgl ... s/d tgl ...) -->
    <form action="{{ $route ? route($route) : url()->current() }}" method="GET" class="flex flex-wrap items-center gap-2.5">
        {{-- Pertahankan parameter selain tanggal & pagination --}}
        @foreach(request()->except(['page', 'start_date', 'end_date', 'periode', 'bulan', 'tahun', 'minggu']) as $k => $v)
            @if(is_array($v))
                @foreach($v as $subV)
                    <input type="hidden" name="{{ $k }}[]" value="{{ $subV }}">
                @endforeach
            @else
                <input type="hidden" name="{{ $k }}" value="{{ $v }}">
            @endif
        @endforeach

        <!-- Dari Tanggal -->
        <div class="flex items-center gap-1.5 bg-surface-subtle border border-border-medium rounded-xl px-3 py-1.5 focus-within:ring-2 focus-within:ring-primary focus-within:bg-white transition-all">
            <label for="filter_start_date" class="text-xs text-text-secondary font-medium">Dari:</label>
            <input type="date" name="start_date" id="filter_start_date" value="{{ $startDate }}"
                class="bg-transparent text-xs text-text-primary focus:outline-none font-semibold cursor-pointer">
        </div>

        <span class="text-xs text-text-tertiary font-bold">s/d</span>

        <!-- Sampai Tanggal -->
        <div class="flex items-center gap-1.5 bg-surface-subtle border border-border-medium rounded-xl px-3 py-1.5 focus-within:ring-2 focus-within:ring-primary focus-within:bg-white transition-all">
            <label for="filter_end_date" class="text-xs text-text-secondary font-medium">Sampai:</label>
            <input type="date" name="end_date" id="filter_end_date" value="{{ $endDate }}"
                class="bg-transparent text-xs text-text-primary focus:outline-none font-semibold cursor-pointer">
        </div>

        <!-- Tombol Terapkan -->
        <button type="submit"
            class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-primary text-white text-xs font-semibold hover:bg-gov-green-dark transition-all shadow-sm">
            <span class="material-symbols-outlined text-[16px]">filter_alt</span>
            <span>Terapkan</span>
        </button>

        <!-- Tombol Reset jika filter aktif -->
        @if(!empty($periodInfo['is_filtered']))
            @php
                $resetParams = request()->except(['page', 'start_date', 'end_date', 'periode', 'bulan', 'tahun', 'minggu']);
                $resetUrl = $route ? route($route, $resetParams) : url()->current() . ($resetParams ? '?' . http_build_query($resetParams) : '');
            @endphp
            <a href="{{ $resetUrl }}"
               class="inline-flex items-center gap-1 px-3 py-2 rounded-xl bg-surface-container-high hover:bg-surface-container-highest text-text-secondary hover:text-text-primary text-xs font-semibold transition-colors border border-border-light"
               title="Reset Filter Tanggal">
                <span class="material-symbols-outlined text-[16px]">restart_alt</span>
                <span>Reset</span>
            </a>
        @endif
    </form>
</div>
