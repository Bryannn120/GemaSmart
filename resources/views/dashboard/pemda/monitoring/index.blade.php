@extends('layouts.pemda')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    .leaflet-popup-content-wrapper {
        border-radius: 12px;
        padding: 0;
        overflow: hidden;
    }
    .leaflet-popup-content {
        margin: 0;
        width: 250px !important;
    }
</style>

<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight">Monitoring & Peta Sebaran</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Pantau sebaran masyarakat penerima bantuan berdasarkan desa dan rincian tingkat ekonomi (desil), serta laporan terkini.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm">
            <form action="{{ route('pemda.monitoring.index') }}" method="GET" class="flex items-center gap-2 min-w-[240px]">
                <select name="kecamatan_id" onchange="this.form.submit()" class="searchable-select font-body-md px-space-md py-2 pr-8 rounded-xl bg-surface-container-high text-text-primary border border-border-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary cursor-pointer transition-shadow">
                    <option value="">-- Semua Wilayah Kecamatan --</option>
                    @foreach($kecamatans as $kec)
                        <option value="{{ $kec->id }}" {{ $selectedKecamatan == $kec->id ? 'selected' : '' }}>
                            Kecamatan {{ $kec->nama }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    <!-- Map & Feed Container -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-space-lg">
        
        <!-- Peta Sebaran (Data Statistik) -->
        <div class="lg:col-span-2 bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden ">
            <div class="p-space-md border-b border-border-light bg-surface-subtle flex justify-between items-center z-10 relative">
                <h3 class="font-headline-sm font-semibold text-text-primary">Peta Interaktif Sebaran Penerima</h3>
                <div class="text-xs text-text-secondary">Klik pada pin kecamatan untuk melihat detail desa.</div>
            </div>
            
            <div id="map" class="w-full relative z-0" style="height: 500px;"></div>
        </div>

        <!-- Latest Reports Feed -->
        <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col h-[500px]">
            <div class="p-space-md border-b border-border-light bg-surface-subtle">
                <h3 class="font-headline-sm font-semibold text-text-primary">Laporan Terkini</h3>
            </div>
            <div class="flex-1 overflow-y-auto p-space-md flex flex-col gap-space-md">
                
                @forelse ($laporans as $laporan)
                <div class="flex gap-space-sm pb-space-md border-b border-border-light last:border-0">
                    <div class="w-8 h-8 rounded-full bg-primary-fixed flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-on-primary-fixed-variant text-[16px]">person</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex justify-between items-start">
                            <span class="font-label-md text-text-primary">{{ $laporan->keluargaPenerima->kepala_keluarga ?? 'Anonim' }}</span>
                            <span class="text-[10px] text-text-tertiary">{{ $laporan->created_at->diffForHumans() }}</span>
                        </div>
                        <span class="font-code-dense text-[11px] text-primary mb-1">
                            {{ $laporan->keluargaPenerima->wilayah->nama ?? 'Tidak Diketahui' }} 
                            � Desil {{ $laporan->keluargaPenerima->desil ?? '-' }}
                        </span>
                        <p class="font-body-sm text-text-secondary">{{ $laporan->laporan_teks }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center p-space-md text-text-tertiary text-sm">Belum ada laporan dari penerima.</div>
                @endforelse

            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Kecamatan -->
<div id="detailModal" class="fixed inset-0 z-[1000] hidden items-center justify-center">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeDetailModal()"></div>
    <div class="bg-surface relative z-10 w-full max-w-5xl max-h-[90vh] rounded-2xl shadow-xl flex flex-col overflow-hidden mx-4 transform transition-transform scale-95 opacity-0 duration-300" id="detailModalContent">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-border-light bg-surface-subtle flex justify-between items-center">
            <div>
                <h3 class="font-headline-md font-bold text-text-primary" id="modalTitle">Data Penerima Bantuan - Kec. ...</h3>
                <p class="font-label-sm text-text-secondary mt-1">Daftar lengkap keluarga penerima beserta rincian desil ekonomi.</p>
            </div>
            <button onclick="closeDetailModal()" class="w-8 h-8 flex items-center justify-center rounded-full bg-surface-container hover:bg-surface-variant text-text-secondary transition-colors">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>
        
        <!-- Loading State -->
        <div id="modalLoading" class="p-8 flex flex-col items-center justify-center min-h-[300px]">
            <span class="material-symbols-outlined animate-spin text-primary text-4xl mb-4">autorenew</span>
            <p class="text-text-secondary font-body-md">Memuat data penerima...</p>
        </div>

        <!-- Content -->
        <div id="modalBody" class="hidden flex-1 overflow-hidden flex flex-col">
            <div class="p-4 border-b border-border-light flex justify-between items-center bg-surface">
                <div class="font-label-md text-text-primary">
                    Total: <span id="modalTotalKk" class="font-bold text-primary">0</span> Keluarga
                </div>
                <div class="relative max-w-xs w-full">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-tertiary">search</span>
                    <input type="text" id="modalSearch" onkeyup="filterModalTable()" placeholder="Cari nama atau desa..." class="w-full pl-10 pr-4 py-2 font-body-sm rounded-lg border border-border-medium focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
            </div>
            <div class="flex-1 overflow-auto bg-surface">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-surface-container sticky top-0 z-10">
                        <tr>
                            <th class="py-3 px-4 font-label-sm text-text-secondary border-b border-border-medium">No. KK / NIK</th>
                            <th class="py-3 px-4 font-label-sm text-text-secondary border-b border-border-medium">Kepala Keluarga</th>
                            <th class="py-3 px-4 font-label-sm text-text-secondary border-b border-border-medium">Desa</th>
                            <th class="py-3 px-4 font-label-sm text-text-secondary border-b border-border-medium text-center">Desil</th>
                            <th class="py-3 px-4 font-label-sm text-text-secondary border-b border-border-medium">Status Kemandirian</th>
                        </tr>
                    </thead>
                    <tbody id="modalTableBody" class="font-body-sm text-text-primary divide-y divide-border-light">
                        <!-- Data rows will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    function openDetailModal(kecId) {
        const modal = document.getElementById('detailModal');
        const modalContent = document.getElementById('detailModalContent');
        const modalLoading = document.getElementById('modalLoading');
        const modalBody = document.getElementById('modalBody');
        const modalTitle = document.getElementById('modalTitle');
        const tableBody = document.getElementById('modalTableBody');
        const modalTotalKk = document.getElementById('modalTotalKk');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);

        modalLoading.classList.remove('hidden');
        modalBody.classList.add('hidden');
        tableBody.innerHTML = '';
        document.getElementById('modalSearch').value = '';

        fetch(`/pemda/monitoring/kecamatan/${kecId}`)
            .then(res => res.json())
            .then(data => {
                modalTitle.textContent = `Data Penerima Bantuan - Kec. ${data.kecamatan}`;
                modalTotalKk.textContent = data.total_kk;
                
                if(data.penerimas.length === 0) {
                    tableBody.innerHTML = `<tr><td colspan="5" class="py-8 text-center text-text-tertiary">Tidak ada data penerima di kecamatan ini.</td></tr>`;
                } else {
                    data.penerimas.forEach(p => {
                        let desilColor = p.desil <= 2 ? 'bg-error-container text-error' : (p.desil <= 4 ? 'bg-warning-container text-warning' : 'bg-success-container text-success');
                        
                        tableBody.innerHTML += `
                            <tr class="hover:bg-surface-subtle transition-colors search-row">
                                <td class="py-3 px-4">
                                    <div class="font-medium">${p.no_kk || '-'}</div>
                                    <div class="text-xs text-text-tertiary">NIK: ${p.nik || '-'}</div>
                                </td>
                                <td class="py-3 px-4 font-bold search-nama">${p.nama || '-'}</td>
                                <td class="py-3 px-4 search-desa">${p.desa || '-'}</td>
                                <td class="py-3 px-4 text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full font-bold text-xs ${desilColor}">
                                        ${p.desil || '-'}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium border border-border-medium bg-surface-container">
                                        ${p.status_kemandirian}
                                    </span>
                                </td>
                            </tr>
                        `;
                    });
                }
                
                modalLoading.classList.add('hidden');
                modalBody.classList.remove('hidden');
            })
            .catch(err => {
                console.error(err);
                modalTitle.textContent = `Gagal Memuat Data`;
                modalLoading.classList.add('hidden');
            });
    }

    function closeDetailModal() {
        const modal = document.getElementById('detailModal');
        const modalContent = document.getElementById('detailModalContent');
        
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 300);
    }

    function filterModalTable() {
        const input = document.getElementById('modalSearch').value.toLowerCase();
        const rows = document.querySelectorAll('.search-row');
        
        rows.forEach(row => {
            const nama = row.querySelector('.search-nama').textContent.toLowerCase();
            const desa = row.querySelector('.search-desa').textContent.toLowerCase();
            if(nama.includes(input) || desa.includes(input)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([-8.4975, 117.4278], 10);
        
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);

        fetch('/kecamatan_coords.json')
            .then(response => response.json())
            .then(coords => {
                var sebaranData = @json($sebaranDesa);
                var kecamatansData = @json($kecamatans);
                
                var sebaranByKecamatan = {};
                sebaranData.forEach(function(item) {
                    if (!sebaranByKecamatan[item.kecamatan]) {
                        sebaranByKecamatan[item.kecamatan] = [];
                    }
                    sebaranByKecamatan[item.kecamatan].push(item);
                });

                kecamatansData.forEach(function(kec) {
                    if (coords[kec.id]) {
                        var lat = coords[kec.id].lat;
                        var lon = coords[kec.id].lon;
                        var totalKk = 0;
                        var desaHtml = '';
                        
                        if (sebaranByKecamatan[kec.nama]) {
                            sebaranByKecamatan[kec.nama].forEach(function(desa) {
                                totalKk += desa.total_penerima;
                                desaHtml += `
                                    <div style="border-bottom: 1px solid #e0e0e0; padding: 10px 15px;">
                                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 8px;">
                                            <strong style="font-size: 14px; color: #1f2937;">${desa.desa}</strong>
                                            <span style="background-color: #d1fae5; color: #065f46; font-size: 11px; padding: 2px 6px; border-radius: 4px; font-weight: bold;">${desa.total_penerima} KK</span>
                                        </div>
                                        <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap: 4px; text-align:center;">
                                            <div style="background:#f3f4f6; padding: 4px; border-radius: 4px;"><span style="display:block; font-size:9px; color:#6b7280;">D1</span><strong style="font-size:12px;">${desa.desil['1']}</strong></div>
                                            <div style="background:#f3f4f6; padding: 4px; border-radius: 4px;"><span style="display:block; font-size:9px; color:#6b7280;">D2</span><strong style="font-size:12px;">${desa.desil['2']}</strong></div>
                                            <div style="background:#f3f4f6; padding: 4px; border-radius: 4px;"><span style="display:block; font-size:9px; color:#6b7280;">D3</span><strong style="font-size:12px;">${desa.desil['3']}</strong></div>
                                            <div style="background:#f3f4f6; padding: 4px; border-radius: 4px;"><span style="display:block; font-size:9px; color:#6b7280;">D4</span><strong style="font-size:12px;">${desa.desil['4']}</strong></div>
                                            <div style="background:#f3f4f6; padding: 4px; border-radius: 4px;"><span style="display:block; font-size:9px; color:#6b7280;">D5</span><strong style="font-size:12px;">${desa.desil['5']}</strong></div>
                                            <div style="background:#f3f4f6; padding: 4px; border-radius: 4px;"><span style="display:block; font-size:9px; color:#6b7280;">>D5</span><strong style="font-size:12px;">${desa.desil['>5']}</strong></div>
                                        </div>
                                    </div>
                                `;
                            });
                        }

                        if (desaHtml === '') {
                            desaHtml = '<div style="padding: 15px; text-align: center; color: #6b7280; font-size: 13px;">Belum ada data penerima.</div>';
                        }
                        
                        var popupContent = `
                            <div style="width: 100%;">
                                <div style="background: #10b981; color: white; padding: 12px 15px;">
                                    <h4 style="margin: 0; font-size: 16px; font-weight: bold;">Kec. ${kec.nama}</h4>
                                    <div style="font-size: 12px; opacity: 0.9; margin-top: 4px;">Total Penerima: ${totalKk} KK</div>
                                </div>
                                <div style="max-height: 250px; overflow-y: auto;">
                                    ${desaHtml}
                                </div>
                                <div style="padding: 10px 15px; background: #f9fafb; border-top: 1px solid #e5e7eb;">
                                    <button onclick="openDetailModal(${kec.id})" style="width: 100%; padding: 8px 0; background: #059669; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: bold; transition: 0.2s;">Lihat Rincian Data Lengkap</button>
                                </div>
                            </div>
                        `;

                        var selectedKecId = '{{ $selectedKecamatan }}';
                        if (selectedKecId == '' || selectedKecId == kec.id) {
                            var marker = L.marker([lat, lon]).addTo(map);
                            marker.bindPopup(popupContent);
                            if (selectedKecId == kec.id) {
                                map.setView([lat, lon], 12);
                                marker.openPopup();
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching coords:', error));
    });
</script>
@endsection

