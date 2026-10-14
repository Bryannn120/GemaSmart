{{-- Reusable Searchable Select Component for Daerah/Wilayah and Other Large Lists --}}
@props([
    'name' => 'wilayah_id',
    'id' => null,
    'value' => null,
    'options' => [], // array of objects/arrays with id/value, nama/name/label, and optional subtext / parent
    'placeholder' => '-- Pilih Wilayah / Daerah --',
    'searchPlaceholder' => 'Ketik nama desa atau kecamatan...',
    'required' => false,
    'icon' => 'location_on',
    'class' => '',
])

@php
    $inputId = $id ?? $name . '_' . uniqid();
    $currentVal = old($name, $value);
@endphp

<div class="searchable-select-component relative w-full {{ $class }}" 
     id="wrapper-{{ $inputId }}"
     data-name="{{ $name }}">
    
    {{-- Native select (kept hidden for standard form submission and validation) --}}
    <select name="{{ $name }}" 
            id="{{ $inputId }}" 
            class="searchable-select-native sr-only" 
            {{ $required ? 'required' : '' }}
            tabindex="-1"
            aria-hidden="true">
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $opt)
            @php
                $optVal = is_array($opt) ? ($opt['id'] ?? $opt['value']) : ($opt->id ?? $opt->value ?? '');
                $rawText = is_array($opt) ? ($opt['nama'] ?? $opt['name'] ?? $opt['label']) : ($opt->nama ?? $opt->name ?? $opt->label ?? '');
                $jenis = is_array($opt) ? ($opt['jenis'] ?? '') : ($opt->jenis ?? '');
                $prefix = ($jenis === 'desa' && !str_starts_with(strtolower($rawText), 'desa') && !str_starts_with(strtolower($rawText), 'kelurahan')) ? 'Desa ' : '';
                $optText = $prefix . $rawText;

                $parentName = is_array($opt) ? ($opt['parent']['nama'] ?? '') : ($opt->parent->nama ?? '');
                $optSub = is_array($opt) 
                    ? ($opt['subtext'] ?? ($parentName ? 'Kec. ' . $parentName : '')) 
                    : ($opt->subtext ?? ($parentName ? 'Kec. ' . $parentName : ''));
                $optKode = is_array($opt) ? ($opt['kode_wilayah'] ?? '') : ($opt->kode_wilayah ?? '');
                $isSelected = (string)$currentVal === (string)$optVal && $optVal !== '';
            @endphp
            <option value="{{ $optVal }}" 
                    data-subtext="{{ $optSub }}"
                    data-kode="{{ $optKode }}"
                    {{ $isSelected ? 'selected' : '' }}>
                {{ $optText }}
            </option>
        @endforeach
    </select>

    {{-- Custom Trigger Button --}}
    <button type="button" 
            class="searchable-trigger w-full text-left flex items-center justify-between px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle hover:bg-white text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all shadow-sm"
            aria-haspopup="listbox"
            aria-expanded="false">
        <div class="flex items-center gap-2.5 min-w-0 flex-1">
            <span class="material-symbols-outlined text-primary text-[20px] shrink-0">{{ $icon }}</span>
            <div class="flex flex-col min-w-0 flex-1">
                <span class="searchable-selected-title font-medium text-text-primary truncate">
                    {{ $placeholder }}
                </span>
                <span class="searchable-selected-sub text-[11px] text-text-tertiary truncate hidden"></span>
            </div>
        </div>
        <div class="flex items-center gap-1 shrink-0 ml-2">
            <span class="searchable-btn-clear hidden p-1 rounded-full hover:bg-surface-container-high text-text-tertiary hover:text-text-primary transition-colors cursor-pointer" title="Hapus pilihan">
                <span class="material-symbols-outlined text-[16px] block">close</span>
            </span>
            <span class="material-symbols-outlined text-text-secondary text-[20px] transition-transform duration-200 searchable-arrow">expand_more</span>
        </div>
    </button>

    {{-- Dropdown Panel --}}
    <div class="searchable-panel hidden absolute left-0 right-0 top-full mt-1.5 z-50 bg-canvas-bg rounded-xl shadow-2xl border border-border-medium overflow-hidden flex flex-col transition-all animate-fadeIn">
        
        {{-- Search Input Box --}}
        <div class="p-2.5 border-b border-border-light bg-surface-subtle sticky top-0 z-10 flex flex-col gap-1.5">
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary text-[18px]">search</span>
                <input type="text" 
                       class="searchable-input w-full pl-9 pr-8 py-2 rounded-lg border border-border-medium bg-canvas-bg text-text-primary text-xs focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                       placeholder="{{ $searchPlaceholder }}"
                       autocomplete="off"
                       spellcheck="false">
                <button type="button" class="searchable-input-clear hidden absolute right-2.5 top-1/2 -translate-y-1/2 text-text-tertiary hover:text-text-primary">
                    <span class="material-symbols-outlined text-[16px]">close</span>
                </button>
            </div>
            <div class="flex items-center justify-between text-[11px] text-text-tertiary px-1">
                <span class="searchable-counter">Memuat data daerah...</span>
                <span class="italic hidden sm:inline">Ketik nama desa atau kec.</span>
            </div>
        </div>

        {{-- Scrollable List --}}
        <div class="searchable-list max-h-64 overflow-y-auto divide-y divide-border-light/60 text-xs" role="listbox">
            {{-- Options populated by JS --}}
        </div>

        {{-- Empty State --}}
        <div class="searchable-empty hidden p-6 text-center text-text-tertiary text-xs">
            <span class="material-symbols-outlined text-3xl block mb-1 text-text-tertiary">location_off</span>
            <span>Tidak ditemukan daerah dengan kata kunci tersebut.</span>
        </div>
    </div>
</div>
