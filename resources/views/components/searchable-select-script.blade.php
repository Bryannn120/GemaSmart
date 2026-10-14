<script>
/**
 * Searchable Select Engine for Gema Smart Sumbawa
 * Handles fast client-side searching for 180+ daerah / wilayah & other large dropdown lists
 */
(function() {
    function setupSearchableComponent(wrapper) {
        if (wrapper.dataset.searchableInit === 'true') return;
        wrapper.dataset.searchableInit = 'true';

        const nativeSelect = wrapper.querySelector('select.searchable-select-native') || wrapper.querySelector('select');
        const trigger = wrapper.querySelector('.searchable-trigger');
        const panel = wrapper.querySelector('.searchable-panel');
        const searchInput = wrapper.querySelector('.searchable-input');
        const searchClear = wrapper.querySelector('.searchable-input-clear');
        const listContainer = wrapper.querySelector('.searchable-list');
        const counterEl = wrapper.querySelector('.searchable-counter');
        const emptyState = wrapper.querySelector('.searchable-empty');
        const clearBtn = wrapper.querySelector('.searchable-btn-clear');
        const titleEl = wrapper.querySelector('.searchable-selected-title');
        const subEl = wrapper.querySelector('.searchable-selected-sub');
        const arrowEl = wrapper.querySelector('.searchable-arrow');

        if (!nativeSelect || !trigger || !panel || !listContainer) return;

        const placeholder = nativeSelect.options[0] ? nativeSelect.options[0].text : '-- Pilih --';
        let optionsData = [];

        // Parse native select options
        Array.from(nativeSelect.options).forEach((opt, index) => {
            if (index === 0 && !opt.value) return; // skip default placeholder
            optionsData.push({
                value: opt.value,
                text: opt.text.trim(),
                subtext: opt.dataset.subtext || '',
                kode: opt.dataset.kode || '',
                selected: opt.selected
            });
        });

        // Render option elements into list
        listContainer.innerHTML = '';
        optionsData.forEach((item) => {
            const row = document.createElement('div');
            row.className = 'searchable-item px-3.5 py-2.5 hover:bg-gov-green-surface hover:text-primary cursor-pointer flex items-center justify-between transition-colors group ' + (item.selected ? 'bg-gov-green-surface/70 text-primary font-semibold' : '');
            row.dataset.value = item.value;
            row.dataset.text = item.text.toLowerCase();
            row.dataset.subtext = item.subtext.toLowerCase();
            row.dataset.kode = item.kode.toLowerCase();

            row.innerHTML = `
                <div class="flex flex-col min-w-0 pr-2">
                    <span class="item-title font-medium text-text-primary group-hover:text-primary truncate">${item.text}</span>
                    ${item.subtext ? `<span class="item-sub text-[11px] text-text-tertiary group-hover:text-primary/80 truncate mt-0.5">${item.subtext}</span>` : ''}
                </div>
                <span class="material-symbols-outlined text-primary text-[18px] shrink-0 checkmark ${item.selected ? 'opacity-100' : 'opacity-0'}">check</span>
            `;

            row.addEventListener('click', (e) => {
                e.stopPropagation();
                selectValue(item.value, item.text, item.subtext);
                closePanel();
            });

            listContainer.appendChild(row);
        });

        function updateTriggerDisplay() {
            const selectedVal = nativeSelect.value;
            const selectedItem = optionsData.find(o => String(o.value) === String(selectedVal));

            if (selectedItem && selectedVal !== '') {
                titleEl.textContent = selectedItem.text;
                titleEl.classList.remove('text-text-secondary');
                titleEl.classList.add('text-text-primary');

                if (selectedItem.subtext) {
                    subEl.textContent = selectedItem.subtext;
                    subEl.classList.remove('hidden');
                } else {
                    subEl.classList.add('hidden');
                }

                if (clearBtn) clearBtn.classList.remove('hidden');
                trigger.classList.remove('border-status-fraud', 'ring-1', 'ring-status-fraud');
            } else {
                titleEl.textContent = placeholder;
                titleEl.classList.remove('text-text-primary');
                titleEl.classList.add('text-text-secondary');
                subEl.classList.add('hidden');
                if (clearBtn) clearBtn.classList.add('hidden');
            }

            // Sync visual active checkmark in list
            listContainer.querySelectorAll('.searchable-item').forEach(el => {
                const isCurrent = String(el.dataset.value) === String(selectedVal);
                const check = el.querySelector('.checkmark');
                if (isCurrent) {
                    el.classList.add('bg-gov-green-surface/70', 'text-primary', 'font-semibold');
                    if (check) check.classList.remove('opacity-0');
                } else {
                    el.classList.remove('bg-gov-green-surface/70', 'text-primary', 'font-semibold');
                    if (check) check.classList.add('opacity-0');
                }
            });
        }

        function selectValue(val, text, subtext) {
            nativeSelect.value = val;
            updateTriggerDisplay();
            nativeSelect.dispatchEvent(new Event('change', { bubbles: true }));
            nativeSelect.dispatchEvent(new Event('input', { bubbles: true }));
        }

        function openPanel() {
            // Close any other open dropdowns first
            document.querySelectorAll('.searchable-panel:not(.hidden)').forEach(p => {
                p.classList.add('hidden');
                const t = p.closest('.searchable-select-component')?.querySelector('.searchable-trigger');
                if (t) t.setAttribute('aria-expanded', 'false');
                const arr = p.closest('.searchable-select-component')?.querySelector('.searchable-arrow');
                if (arr) arr.classList.remove('rotate-180');
            });

            panel.classList.remove('hidden');
            trigger.setAttribute('aria-expanded', 'true');
            if (arrowEl) arrowEl.classList.add('rotate-180');

            if (searchInput) {
                searchInput.value = '';
                filterItems('');
                setTimeout(() => searchInput.focus(), 50);
            }

            // Scroll active item into view
            const activeItem = listContainer.querySelector('.searchable-item.bg-gov-green-surface\\/70');
            if (activeItem) {
                activeItem.scrollIntoView({ block: 'nearest' });
            }
        }

        function closePanel() {
            panel.classList.add('hidden');
            trigger.setAttribute('aria-expanded', 'false');
            if (arrowEl) arrowEl.classList.remove('rotate-180');
        }

        function filterItems(query) {
            const q = query.trim().toLowerCase();
            const items = listContainer.querySelectorAll('.searchable-item');
            let visibleCount = 0;

            items.forEach(item => {
                const t = item.dataset.text || '';
                const s = item.dataset.subtext || '';
                const k = item.dataset.kode || '';

                if (!q || t.includes(q) || s.includes(q) || k.includes(q)) {
                    item.classList.remove('hidden');
                    visibleCount++;
                } else {
                    item.classList.add('hidden');
                }
            });

            if (counterEl) {
                if (q) {
                    counterEl.textContent = `Ditemukan ${visibleCount} dari ${optionsData.length} daerah`;
                } else {
                    counterEl.textContent = `${optionsData.length} daerah tersedia`;
                }
            }

            if (emptyState) {
                if (visibleCount === 0) {
                    emptyState.classList.remove('hidden');
                } else {
                    emptyState.classList.add('hidden');
                }
            }

            if (searchClear) {
                if (q) searchClear.classList.remove('hidden');
                else searchClear.classList.add('hidden');
            }
        }

        // Event Listeners
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            if (panel.classList.contains('hidden')) {
                openPanel();
            } else {
                closePanel();
            }
        });

        if (clearBtn) {
            clearBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                selectValue('', '', '');
            });
        }

        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                filterItems(e.target.value);
            });

            searchInput.addEventListener('keydown', (e) => {
                const visibleItems = Array.from(listContainer.querySelectorAll('.searchable-item:not(.hidden)'));
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    if (visibleItems.length > 0) visibleItems[0].focus();
                } else if (e.key === 'Escape') {
                    closePanel();
                    trigger.focus();
                }
            });
        }

        if (searchClear) {
            searchClear.addEventListener('click', (e) => {
                e.stopPropagation();
                searchInput.value = '';
                filterItems('');
                searchInput.focus();
            });
        }

        // Keyboard navigation across items
        listContainer.addEventListener('keydown', (e) => {
            const visibleItems = Array.from(listContainer.querySelectorAll('.searchable-item:not(.hidden)'));
            const currentIndex = visibleItems.indexOf(document.activeElement);

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                const next = visibleItems[currentIndex + 1] || visibleItems[0];
                if (next) next.focus();
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                const prev = visibleItems[currentIndex - 1] || visibleItems[visibleItems.length - 1];
                if (prev) prev.focus();
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (document.activeElement && document.activeElement.classList.contains('searchable-item')) {
                    document.activeElement.click();
                }
            } else if (e.key === 'Escape') {
                closePanel();
                trigger.focus();
            }
        });

        // Form validation hook
        const form = trigger.closest('form');
        if (form && nativeSelect.required) {
            form.addEventListener('submit', function(e) {
                if (!nativeSelect.value) {
                    e.preventDefault();
                    trigger.classList.add('border-status-fraud', 'ring-2', 'ring-status-fraud');
                    trigger.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    openPanel();
                }
            });
        }

        // Initialize state
        updateTriggerDisplay();
        if (counterEl) {
            counterEl.textContent = `${optionsData.length} daerah tersedia`;
        }
    }

    /**
     * Auto transformer for standard selects with class .searchable-select or [data-searchable="true"]
     */
    function transformStandardSelect(selectEl) {
        if (selectEl.dataset.searchableTransformed === 'true') return;
        selectEl.dataset.searchableTransformed = 'true';

        const name = selectEl.getAttribute('name') || 'select_' + Math.random().toString(36).substring(2, 9);
        const placeholder = selectEl.options[0] ? selectEl.options[0].text : '-- Pilih --';
        const required = selectEl.hasAttribute('required');
        const currentVal = selectEl.value;

        // Create component wrapper
        const wrapper = document.createElement('div');
        wrapper.className = 'searchable-select-component relative w-full ' + (selectEl.dataset.wrapperClass || '');
        wrapper.dataset.name = name;

        // Clone select into native hidden
        selectEl.classList.add('searchable-select-native', 'sr-only');
        selectEl.setAttribute('tabindex', '-1');
        selectEl.setAttribute('aria-hidden', 'true');

        selectEl.parentNode.insertBefore(wrapper, selectEl);
        wrapper.appendChild(selectEl);

        // Inject trigger and panel
        wrapper.insertAdjacentHTML('beforeend', `
            <button type="button" 
                    class="searchable-trigger w-full text-left flex items-center justify-between px-3.5 py-2.5 rounded-xl border border-border-medium bg-surface-subtle hover:bg-white text-text-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all shadow-sm"
                    aria-haspopup="listbox"
                    aria-expanded="false">
                <div class="flex items-center gap-2.5 min-w-0 flex-1">
                    <span class="material-symbols-outlined text-primary text-[20px] shrink-0">location_on</span>
                    <div class="flex flex-col min-w-0 flex-1">
                        <span class="searchable-selected-title font-medium text-text-primary truncate">${placeholder}</span>
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
            <div class="searchable-panel hidden absolute left-0 right-0 top-full mt-1.5 z-50 bg-canvas-bg rounded-xl shadow-2xl border border-border-medium overflow-hidden flex flex-col transition-all">
                <div class="p-2.5 border-b border-border-light bg-surface-subtle sticky top-0 z-10 flex flex-col gap-1.5">
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary text-[18px]">search</span>
                        <input type="text" 
                               class="searchable-input w-full pl-9 pr-8 py-2 rounded-lg border border-border-medium bg-canvas-bg text-text-primary text-xs focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                               placeholder="Ketik nama desa atau kecamatan (misal: Moyo, Alas, dll)..."
                               autocomplete="off"
                               spellcheck="false">
                        <button type="button" class="searchable-input-clear hidden absolute right-2.5 top-1/2 -translate-y-1/2 text-text-tertiary hover:text-text-primary">
                            <span class="material-symbols-outlined text-[16px]">close</span>
                        </button>
                    </div>
                    <div class="flex items-center justify-between text-[11px] text-text-tertiary px-1">
                        <span class="searchable-counter">Memuat data...</span>
                        <span class="italic hidden sm:inline">Pencarian cepat</span>
                    </div>
                </div>
                <div class="searchable-list max-h-64 overflow-y-auto divide-y divide-border-light/60 text-xs" role="listbox"></div>
                <div class="searchable-empty hidden p-6 text-center text-text-tertiary text-xs">
                    <span class="material-symbols-outlined text-3xl block mb-1 text-text-tertiary">location_off</span>
                    <span>Tidak ditemukan data dengan kata kunci tersebut.</span>
                </div>
            </div>
        `);

        setupSearchableComponent(wrapper);
    }

    // Global listener for closing on click outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.searchable-select-component')) {
            document.querySelectorAll('.searchable-panel:not(.hidden)').forEach(panel => {
                panel.classList.add('hidden');
                const trigger = panel.closest('.searchable-select-component')?.querySelector('.searchable-trigger');
                if (trigger) trigger.setAttribute('aria-expanded', 'false');
                const arrow = panel.closest('.searchable-select-component')?.querySelector('.searchable-arrow');
                if (arrow) arrow.classList.remove('rotate-180');
            });
        }
    });

    // Initialize all on DOM ready
    function initAll() {
        document.querySelectorAll('.searchable-select-component').forEach(setupSearchableComponent);
        document.querySelectorAll('select.searchable-select, select[data-searchable="true"]').forEach(transformStandardSelect);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAll);
    } else {
        initAll();
    }

    window.initSearchableSelects = initAll;
})();
</script>
