@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl max-w-4xl mx-auto">
    <div class="flex flex-col">
        <a href="{{ route('pemda.kampus-mitra.index') }}" class="inline-flex items-center gap-1 text-text-secondary hover:text-primary mb-space-md font-label-md transition-colors w-fit">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Daftar Kampus</span>
        </a>
        <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Edit Kampus Mitra</h1>
        <p class="font-body-md text-text-secondary mt-1">
            Ubah detail kampus mitra dan data koordinatornya.
        </p>
    </div>

    @if ($errors->any())
        <div class="bg-error-container text-on-error-container p-space-md rounded-xl font-body-sm mb-space-md border border-error/20">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light p-space-xl">
        <form action="{{ route('pemda.kampus-mitra.update', $kampusMitra->id) }}" method="POST" class="flex flex-col gap-space-lg">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-space-xs">
                <label for="email_kampus" class="font-label-md text-text-primary">Email Kampus <span class="text-error">*</span></label>
                <input type="email" name="email_kampus" id="email_kampus" value="{{ old('email_kampus', $kampusMitra->user->email ?? '') }}" required
                    class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle"
                    placeholder="Contoh: admin@unsa.ac.id">
            </div>

            <div class="flex flex-col gap-space-xs">
                <label for="nama_universitas" class="font-label-md text-text-primary">Nama Universitas <span class="text-error">*</span></label>
                <input type="text" name="nama_universitas" id="nama_universitas" value="{{ old('nama_universitas', $kampusMitra->nama_universitas) }}" required
                    class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="pic_name" class="font-label-md text-text-primary">Nama PIC <span class="text-error">*</span></label>
                    <input type="text" name="pic_name" id="pic_name" value="{{ old('pic_name', $kampusMitra->pic_name) }}" required
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
                <div class="flex flex-col gap-space-xs">
                    <label for="pic_contact" class="font-label-md text-text-primary">Kontak PIC</label>
                    <input type="text" name="pic_contact" id="pic_contact" value="{{ old('pic_contact', $kampusMitra->pic_contact) }}"
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
            </div>

            <!-- Section Wilayah Binaan (List dengan Search & Isolasi Antar-Kampus) -->
            <div class="flex flex-col gap-space-xs p-space-md rounded-xl bg-surface-subtle border border-border-medium">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 pb-2 border-b border-border-light">
                    <div>
                        <label class="font-label-md text-text-primary font-bold flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[18px] text-primary">location_on</span>
                            <span>Wilayah Binaan (Kecamatan) <span class="text-error">*</span></span>
                        </label>
                        <p class="text-xs text-text-secondary mt-0.5">
                            Tiap kampus tidak dapat memilih wilayah yang sama (eksklusif per kecamatan).
                        </p>
                    </div>
                    <div class="text-xs text-text-tertiary">
                        Total: <strong>{{ $kecamatans->count() }}</strong> Kecamatan di Kab. Sumbawa
                    </div>
                </div>

                <!-- Live Search Box & Filter Tabs -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 mt-2">
                    <div class="relative flex-1">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-text-tertiary text-[18px]">search</span>
                        <input type="text" id="search-wilayah-input" placeholder="Cari nama kecamatan atau desa..."
                            class="w-full pl-9 pr-3 py-2 rounded-xl border border-border-medium bg-white text-text-primary text-sm focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                    </div>
                    <div class="flex items-center gap-1 text-xs">
                        <button type="button" onclick="setFilterMode('all')" id="filter-btn-all" class="px-2.5 py-1.5 rounded-lg font-bold bg-primary text-white transition-colors">
                            Semua ({{ $kecamatans->count() }})
                        </button>
                        <button type="button" onclick="setFilterMode('available')" id="filter-btn-available" class="px-2.5 py-1.5 rounded-lg font-semibold bg-surface-muted text-text-secondary hover:text-primary transition-colors">
                            Tersedia ({{ $kecamatans->count() - count($takenWilayahs) }})
                        </button>
                        <button type="button" onclick="setFilterMode('selected')" id="filter-btn-selected" class="px-2.5 py-1.5 rounded-lg font-semibold bg-surface-muted text-text-secondary hover:text-primary transition-colors">
                            Dipilih (<span id="count-selected-tab">{{ count(old('wilayah_ids', $selectedWilayahIds)) }}</span>)
                        </button>
                    </div>
                </div>

                <!-- Selected Badges Preview -->
                <div class="p-2.5 rounded-xl bg-canvas-bg border border-border-light min-h-[42px] flex flex-wrap items-center gap-1.5 mt-1">
                    <span class="text-xs font-semibold text-text-tertiary mr-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">check_box</span>
                        <span>Dipilih:</span>
                    </span>
                    <div id="selected-badges-container" class="flex flex-wrap items-center gap-1.5">
                        <span class="text-xs text-text-tertiary italic" id="empty-selected-placeholder">Belum ada kecamatan yang dipilih. Centang pada daftar di bawah.</span>
                    </div>
                </div>

                <!-- Scrollable Wilayah List -->
                <div class="mt-1 border border-border-medium rounded-xl max-h-72 overflow-y-auto divide-y divide-border-light bg-canvas-bg shadow-inner" id="wilayah-list-container">
                    @forelse($kecamatans as $kec)
                        @php
                            $isTaken = isset($takenWilayahs[$kec->id]);
                            $takenBy = $isTaken ? $takenWilayahs[$kec->id]->nama_universitas : null;
                            $isSelected = in_array($kec->id, old('wilayah_ids', $selectedWilayahIds));
                            $desaNames = $kec->children->pluck('nama')->implode(', ');
                        @endphp
                        <div class="wilayah-item p-3 transition-colors flex items-start justify-between gap-3 {{ $isTaken ? 'bg-surface-muted/60 opacity-75' : ($isSelected ? 'bg-gov-green-surface/40 hover:bg-gov-green-surface/60' : 'hover:bg-surface-subtle') }}"
                             data-id="{{ $kec->id }}"
                             data-nama="{{ strtolower($kec->nama) }}"
                             data-kode="{{ strtolower($kec->kode_wilayah) }}"
                             data-desa="{{ strtolower($desaNames) }}"
                             data-taken="{{ $isTaken ? 'true' : 'false' }}"
                             data-selected="{{ $isSelected ? 'true' : 'false' }}">
                            
                            <div class="flex items-start gap-3 flex-1 min-w-0">
                                <div class="pt-0.5">
                                    @if($isTaken)
                                        <input type="checkbox" disabled class="rounded border-gray-300 text-gray-400 cursor-not-allowed">
                                    @else
                                        <input type="checkbox" 
                                               name="wilayah_ids[]" 
                                               value="{{ $kec->id }}" 
                                               id="kec_{{ $kec->id }}"
                                               {{ $isSelected ? 'checked' : '' }}
                                               onchange="toggleWilayahSelection({{ $kec->id }}, '{{ addslashes($kec->nama) }}', this.checked)"
                                               class="wilayah-checkbox w-4 h-4 rounded border-border-medium text-primary focus:ring-primary cursor-pointer mt-0.5">
                                    @endif
                                </div>
                                <label for="{{ $isTaken ? '' : 'kec_' . $kec->id }}" class="flex-1 min-w-0 {{ $isTaken ? 'cursor-not-allowed' : 'cursor-pointer' }}">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="font-bold text-sm text-text-primary">Kecamatan {{ $kec->nama }}</span>
                                        <span class="text-xs font-mono text-text-tertiary">({{ $kec->kode_wilayah }})</span>
                                        <span class="text-[11px] font-semibold text-blue-700 bg-blue-50 px-2 py-0.2 rounded-full border border-blue-200">
                                            {{ $kec->children->count() }} Desa/Kelurahan
                                        </span>
                                    </div>
                                    @if($kec->children->isNotEmpty())
                                        <p class="text-[11px] text-text-secondary truncate mt-0.5" title="{{ $desaNames }}">
                                            Desa: {{ $desaNames }}
                                        </p>
                                    @endif
                                </label>
                            </div>

                            <div class="shrink-0 flex items-center">
                                @if($isTaken)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-900 border border-amber-300 shadow-2xs" title="Kecamatan ini telah dipilih oleh {{ $takenBy }}">
                                        <span class="material-symbols-outlined text-[13px]">lock</span>
                                        <span>Dibina: {{ Str::limit($takenBy, 20) }}</span>
                                    </span>
                                @else
                                    <span class="available-badge inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="material-symbols-outlined text-[13px]">check_circle</span>
                                        <span>Tersedia</span>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-text-tertiary">
                            Tidak ada data kecamatan.
                        </div>
                    @endforelse
                    
                    <div id="no-search-results" class="hidden p-8 text-center text-text-tertiary flex-col items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-[32px] text-text-tertiary/60">search_off</span>
                        <p class="text-xs font-semibold text-text-secondary">Kecamatan atau desa tidak ditemukan.</p>
                        <p class="text-[11px] text-text-tertiary">Coba gunakan kata kunci pencarian yang lain.</p>
                    </div>
                </div>

                @error('wilayah_ids')
                    <div class="p-2.5 rounded-lg bg-red-50 border border-red-200 text-xs text-red-700 font-semibold flex items-center gap-1.5 mt-1">
                        <span class="material-symbols-outlined text-[16px]">error</span>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                <div class="flex flex-col gap-space-xs">
                    <label for="mou_berlaku_sampai" class="font-label-md text-text-primary">MoU Berlaku Sampai</label>
                    <input type="date" name="mou_berlaku_sampai" id="mou_berlaku_sampai" value="{{ old('mou_berlaku_sampai', $kampusMitra->mou_berlaku_sampai) }}"
                        class="w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle">
                </div>
                <div class="flex flex-col gap-space-xs">
                    <label for="status_mou" class="font-label-md text-text-primary">Status MoU <span class="text-error">*</span></label>
                    <div class="relative">
                        <select name="status_mou" id="status_mou" required
                            class="appearance-none w-full font-body-md px-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-surface-subtle cursor-pointer">
                            <option value="aktif" {{ old('status_mou', $kampusMitra->status_mou) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak_aktif" {{ old('status_mou', $kampusMitra->status_mou) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-space-xs p-space-md rounded-xl bg-gov-green-surface/40 border border-primary/20">
                <label for="dana_bappeda" class="font-label-md text-gov-green-dark font-bold flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px]">account_balance_wallet</span>
                    <span>Alokasi Dana dari Bappeda ke Kampus (Rp)</span>
                </label>
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 font-bold text-text-secondary text-sm">Rp</span>
                    <input type="number" name="dana_bappeda" id="dana_bappeda" value="{{ old('dana_bappeda', (int)$kampusMitra->dana_bappeda) }}" min="0" step="any"
                        class="w-full font-body-md pl-11 pr-space-md py-2.5 rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow bg-white font-semibold text-text-primary"
                        placeholder="Contoh: 500000000">
                </div>
                <p class="text-xs text-text-secondary">Uang yang diberikan Bappeda ini akan otomatis dikurangi secara real-time oleh total penyaluran dan penggunaan program bantuan kampus.</p>
            </div>

            <div class="flex items-center justify-end gap-space-sm mt-space-md pt-space-lg border-t border-border-light">
                <a href="{{ route('pemda.kampus-mitra.index') }}" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold text-text-secondary hover:bg-surface-variant transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-space-lg py-2.5 rounded-xl font-label-md font-semibold bg-primary-container text-on-primary hover:bg-gov-green-dark transition-colors shadow-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let currentFilterMode = 'all';

    function updateSelectedBadges() {
        const container = document.getElementById('selected-badges-container');
        const placeholder = document.getElementById('empty-selected-placeholder');
        const checkboxes = document.querySelectorAll('.wilayah-checkbox:checked');
        const countTab = document.getElementById('count-selected-tab');

        if (countTab) countTab.textContent = checkboxes.length;

        // Clear existing badge elements except placeholder
        const existingBadges = container.querySelectorAll('.selected-badge-pill');
        existingBadges.forEach(el => el.remove());

        if (checkboxes.length === 0) {
            if (placeholder) placeholder.classList.remove('hidden');
        } else {
            if (placeholder) placeholder.classList.add('hidden');
            checkboxes.forEach(cb => {
                const item = cb.closest('.wilayah-item');
                const labelEl = item.querySelector('label span.font-bold');
                const nama = labelEl ? labelEl.textContent.replace('Kecamatan ', '') : cb.value;
                const pill = document.createElement('span');
                pill.className = 'selected-badge-pill inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-gov-green-surface text-primary border border-primary/20 shadow-2xs';
                pill.innerHTML = `
                    <span>Kec. ${nama}</span>
                    <button type="button" onclick="removeBadgeSelection(${cb.value})" class="hover:text-red-600 flex items-center ml-0.5" title="Hapus pilihan">
                        <span class="material-symbols-outlined text-[13px]">close</span>
                    </button>
                `;
                container.appendChild(pill);
            });
        }
    }

    function toggleWilayahSelection(id, nama, isChecked) {
        const item = document.querySelector(`.wilayah-item[data-id="${id}"]`);
        if (item) {
            item.setAttribute('data-selected', isChecked ? 'true' : 'false');
            if (isChecked) {
                item.classList.add('bg-gov-green-surface/40');
            } else {
                item.classList.remove('bg-gov-green-surface/40');
            }
        }
        updateSelectedBadges();
        if (currentFilterMode === 'selected') {
            applyWilayahFilter();
        }
    }

    function removeBadgeSelection(id) {
        const cb = document.getElementById(`kec_${id}`);
        if (cb) {
            cb.checked = false;
            toggleWilayahSelection(id, '', false);
        }
    }

    function setFilterMode(mode) {
        currentFilterMode = mode;
        const btnAll = document.getElementById('filter-btn-all');
        const btnAvailable = document.getElementById('filter-btn-available');
        const btnSelected = document.getElementById('filter-btn-selected');

        [btnAll, btnAvailable, btnSelected].forEach(btn => {
            if (btn) {
                btn.className = 'px-2.5 py-1.5 rounded-lg font-semibold bg-surface-muted text-text-secondary hover:text-primary transition-colors';
            }
        });

        if (mode === 'all' && btnAll) btnAll.className = 'px-2.5 py-1.5 rounded-lg font-bold bg-primary text-white transition-colors';
        if (mode === 'available' && btnAvailable) btnAvailable.className = 'px-2.5 py-1.5 rounded-lg font-bold bg-primary text-white transition-colors';
        if (mode === 'selected' && btnSelected) btnSelected.className = 'px-2.5 py-1.5 rounded-lg font-bold bg-primary text-white transition-colors';

        applyWilayahFilter();
    }

    function applyWilayahFilter() {
        const query = (document.getElementById('search-wilayah-input').value || '').toLowerCase().trim();
        const items = document.querySelectorAll('.wilayah-item');
        let visibleCount = 0;

        items.forEach(item => {
            const nama = item.getAttribute('data-nama') || '';
            const kode = item.getAttribute('data-kode') || '';
            const desa = item.getAttribute('data-desa') || '';
            const isTaken = item.getAttribute('data-taken') === 'true';
            const isSelected = item.getAttribute('data-selected') === 'true';

            let modeMatch = true;
            if (currentFilterMode === 'available') {
                modeMatch = !isTaken;
            } else if (currentFilterMode === 'selected') {
                modeMatch = isSelected;
            }

            const searchMatch = !query || nama.includes(query) || kode.includes(query) || desa.includes(query);

            if (modeMatch && searchMatch) {
                item.classList.remove('hidden');
                visibleCount++;
            } else {
                item.classList.add('hidden');
            }
        });

        const noResults = document.getElementById('no-search-results');
        if (noResults) {
            if (visibleCount === 0) {
                noResults.classList.remove('hidden');
                noResults.classList.add('flex');
            } else {
                noResults.classList.add('hidden');
                noResults.classList.remove('flex');
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-wilayah-input');
        if (searchInput) {
            searchInput.addEventListener('input', applyWilayahFilter);
        }
        updateSelectedBadges();
    });
</script>
@endsection

