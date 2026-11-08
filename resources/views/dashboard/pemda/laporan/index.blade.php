@extends('layouts.pemda')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div class="flex flex-col max-w-2xl">
            <h1 class="font-headline-xl text-headline-xl text-text-primary tracking-tight font-bold">Laporan & Pengaduan</h1>
            <p class="font-body-md text-text-secondary mt-1">
                Pantau laporan kendala langsung dari warga penerima bantuan, statistik program, dan rekapitulasi data.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('pemda.laporan.pdf', request()->all()) }}" target="_blank" class="px-space-md py-space-sm rounded-lg bg-status-fraud text-on-error font-label-lg hover:bg-red-800 transition-colors shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">picture_as_pdf</span> Cetak PDF Keseluruhan
            </a>
        </div>
    </div>

    <!-- FILTER PERIODE WAKTU (Hari, Minggu, Bulan, Tahun, Rentang Tanggal Kustom) -->
    <x-period-filter :periodInfo="$periodInfo" label="Pilih Periode Laporan:" />

    <!-- KARTU INTEGRASI WHATSAPP GATEWAY & WEBHOOK API -->
    <div class="bg-gradient-to-r from-emerald-900 to-green-950 text-white rounded-2xl p-5 sm:p-6 shadow-md border border-emerald-700/40 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div class="flex items-start gap-4 max-w-2xl">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center shrink-0 text-emerald-300">
                <span class="material-symbols-outlined text-[28px]">phone_iphone</span>
            </div>
            <div>
                <div class="flex items-center gap-2 flex-wrap mb-1">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-400 text-slate-900 uppercase tracking-wider flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-900 animate-ping"></span>
                        API WhatsApp Siap Menerima Laporan
                    </span>
                    <span class="text-xs text-emerald-200">Terhubung ke Database Sistem</span>
                </div>
                <h3 class="text-lg font-bold text-white">Kanal Pelaporan Penerima via WhatsApp Hotline</h3>
                <p class="text-xs sm:text-sm text-emerald-100/90 mt-1 leading-relaxed">
                    Warga dapat mengirim keluhan langsung via WhatsApp tanpa perlu login. Pesan otomatis dicatat ke sistem dengan format: 
                    <code class="bg-emerald-950/80 px-2 py-0.5 rounded font-mono text-emerald-300 text-xs font-bold border border-emerald-800">#LAPOR#[NIK]#[Pesan Kendala]</code>
                </p>
                <div class="mt-3 flex flex-wrap items-center gap-2 text-xs text-emerald-200">
                    <span class="font-semibold">Webhook API:</span>
                    <code id="webhookUrlText" class="bg-black/30 px-2.5 py-1 rounded font-mono text-emerald-300 text-[11px] select-all border border-emerald-800/60">{{ url('/api/v1/whatsapp/webhook') }}</code>
                    <button type="button" onclick="copyWebhookUrl()" class="px-2 py-1 rounded bg-white/10 hover:bg-white/20 text-white text-[11px] font-semibold transition-colors flex items-center gap-1">
                        <span class="material-symbols-outlined text-[13px]">content_copy</span>
                        <span id="copyBtnText">Salin</span>
                    </button>
                    <span class="text-[11px] text-emerald-300/80 bg-emerald-950/60 px-2 py-0.5 rounded border border-emerald-800/60">
                        Gateway: <strong>BalesOtomatis.id</strong>, Fonnte, Wablas
                    </span>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row lg:flex-col gap-2.5 shrink-0">
            <button type="button" onclick="openWaSimulatorModal()" class="px-4 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold text-xs sm:text-sm shadow-md transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">send_to_mobile</span>
                <span>Uji Simulasi WhatsApp</span>
            </button>
            <a href="{{ url('/api/v1/whatsapp/info') }}" target="_blank" class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white font-medium text-xs transition-colors flex items-center justify-center gap-1.5 border border-white/15">
                <span class="material-symbols-outlined text-[16px]">code</span>
                <span>Dokumentasi API</span>
            </a>
        </div>
    </div>

    <!-- TABEL UTAMA: Laporan & Kendala dari Penerima Bantuan -->
    <div class="bg-canvas-bg rounded-xl shadow-sm border border-border-light flex flex-col overflow-hidden">
        <div class="p-space-lg border-b border-border-light flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-surface-subtle">
            <div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-[24px]">mark_email_unread</span>
                    <h2 class="font-headline-sm font-bold text-text-primary">Laporan &amp; Kendala dari Penerima Bantuan</h2>
                </div>
                <p class="font-body-sm text-text-secondary mt-0.5">Daftar keluhan, kendala bibit, dan feedback yang dikirim warga via WhatsApp &amp; Portal Web.</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-gov-green-surface text-primary border border-primary/20">
                    Periode: {{ $periodInfo['label'] }}
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-primary text-on-primary">
                    Total: {{ $laporanWargas->count() }} Laporan
                </span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left font-body-sm text-body-sm">
                <thead class="bg-surface-muted text-text-secondary font-label-md text-label-md border-b border-border-light">
                    <tr>
                        <th class="py-3.5 px-4 font-semibold">Tgl / Waktu</th>
                        <th class="py-3.5 px-4 font-semibold">Warga Penerima (KK)</th>
                        <th class="py-3.5 px-4 font-semibold">Kanal</th>
                        <th class="py-3.5 px-4 font-semibold">Wilayah / Desa</th>
                        <th class="py-3.5 px-4 font-semibold">Isi Laporan / Kendala</th>
                        <th class="py-3.5 px-4 font-semibold">Pendamping Lapangan</th>
                        <th class="py-3.5 px-4 font-semibold">Kampus Mitra</th>
                        <th class="py-3.5 px-4 font-semibold">Status</th>
                        <th class="py-3.5 px-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light bg-canvas-bg">
                    @forelse ($laporanWargas as $lap)
                    <tr class="hover:bg-surface-subtle transition-colors group {{ !$lap->is_read_by_pemda ? 'bg-gov-green-surface/20 font-medium' : '' }}">
                        <td class="py-3.5 px-4 text-text-secondary whitespace-nowrap text-xs">
                            {{ $lap->created_at->format('d M Y') }}<br/>
                            <span class="text-text-tertiary">{{ $lap->created_at->format('H:i') }} WITA</span>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="font-bold text-text-primary block">{{ $lap->keluargaPenerima->kepala_keluarga ?? ($lap->pengirim_nama ?: 'Tidak Diketahui') }}</span>
                            <span class="text-text-tertiary font-mono text-[11px]">
                                @if($lap->keluargaPenerima)
                                    No. KK: {{ $lap->keluargaPenerima->no_kk }}
                                @else
                                    Nomor Pengirim: {{ $lap->wa_sender ?? '-' }}
                                @endif
                            </span>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @if($lap->is_whatsapp || $lap->sumber === 'whatsapp')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-300 shadow-sm" title="Pesan masuk melalui API WhatsApp">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                    <span>WhatsApp</span>
                                </span>
                                @if($lap->wa_sender)
                                    <span class="block text-[10px] text-emerald-700 font-mono mt-0.5">{{ $lap->formatted_wa_sender }}</span>
                                @endif
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                    <span class="material-symbols-outlined text-[13px]">language</span>
                                    <span>Portal Web</span>
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="text-text-primary block">{{ $lap->keluargaPenerima->wilayah->nama ?? '-' }}</span>
                            <span class="text-text-tertiary text-xs">
                                {{ isset($lap->keluargaPenerima->wilayah->parent) ? 'Kec. ' . $lap->keluargaPenerima->wilayah->parent->nama : '-' }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 max-w-xs">
                            <p class="truncate text-text-primary text-sm" title="{{ $lap->laporan_teks }}">
                                {{ $lap->laporan_teks }}
                            </p>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @php
                                $p = $lap->keluargaPenerima->pendamping ?? null;
                            @endphp
                            @if ($p)
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[18px] text-primary">support_agent</span>
                                    <div>
                                        <span class="font-semibold text-text-primary block text-xs">{{ $p->name }}</span>
                                        <span class="text-text-tertiary text-[11px] block">{{ $p->email }}</span>
                                    </div>
                                </div>
                            @else
                                <span class="text-text-tertiary italic text-xs">Belum ditugaskan</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @php
                                $k = $lap->keluargaPenerima->kampusMitra ?? ($p->kampus ?? null);
                            @endphp
                            @if ($k)
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[18px] text-status-info">school</span>
                                    <span class="font-semibold text-text-primary text-xs">{{ $k->nama_universitas }}</span>
                                </div>
                            @else
                                <span class="text-text-tertiary italic text-xs">-</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            @if ($lap->is_read_by_pemda)
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-bold bg-surface-container text-text-secondary">
                                    Sudah Dilihat
                                </span>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-bold bg-status-warning-surface text-status-warning animate-pulse">
                                    Baru Masuk
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <a href="{{ route('pemda.laporan.show', $lap->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary text-on-primary hover:bg-primary-container rounded-lg font-label-sm text-xs font-semibold transition-colors shadow-sm">
                                <span class="material-symbols-outlined text-[16px]">visibility</span>
                                <span>Lihat Detail</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="py-12 text-center text-text-secondary">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[48px] text-border-medium">inbox</span>
                                <p class="text-base font-semibold">Belum ada laporan atau kendala dari warga.</p>
                                <p class="text-xs text-text-tertiary">Laporan yang dikirim melalui WhatsApp API atau dashboard akun warga akan tampil di sini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Reports Grid / Statistik Dokumen -->
    <div class="flex flex-col gap-3">
        <div class="flex items-center justify-between">
            <h2 class="font-headline-sm font-bold text-text-primary">Dokumen Rekapitulasi &amp; Statistik</h2>
            <span class="text-xs text-text-secondary font-medium">Berdasarkan {{ $periodInfo['label'] }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-space-md">
            <!-- Card 1 -->
            <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light hover:border-primary transition-colors cursor-pointer group">
                <div class="w-12 h-12 rounded-xl bg-status-verified-surface text-primary flex items-center justify-center mb-space-md">
                    <span class="material-symbols-outlined text-[24px]">description</span>
                </div>
                <h3 class="font-headline-sm font-semibold text-text-primary group-hover:text-primary transition-colors">Laporan Penyaluran Bibit</h3>
                <p class="font-body-sm text-text-secondary mt-1 mb-space-md">Data penyaluran periode ini: {{ $totalPenyaluran }} transaksi.</p>
                <a href="{{ route('pemda.laporan.penyaluran-pdf', request()->all()) }}" target="_blank" class="w-full block text-center py-2 bg-surface-container rounded-lg text-text-primary font-label-md font-semibold group-hover:bg-primary group-hover:text-on-primary transition-colors">Unduh PDF</a>
            </div>

            <!-- Card 2 -->
            <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light hover:border-primary transition-colors cursor-pointer group">
                <div class="w-12 h-12 rounded-xl bg-status-info-surface text-status-info flex items-center justify-center mb-space-md">
                    <span class="material-symbols-outlined text-[24px]">pie_chart</span>
                </div>
                <h3 class="font-headline-sm font-semibold text-text-primary group-hover:text-primary transition-colors">Statistik Tumbuh Kembang</h3>
                <p class="font-body-sm text-text-secondary mt-1 mb-space-md">Laporan pengamatan periode ini: {{ $totalLaporan }} data.</p>
                <a href="{{ route('pemda.laporan.tumbuh-kembang-pdf', request()->all()) }}" target="_blank" class="w-full block text-center py-2 bg-surface-container rounded-lg text-text-primary font-label-md font-semibold group-hover:bg-primary group-hover:text-on-primary transition-colors">Unduh PDF</a>
            </div>
            
            <!-- Card 3 -->
            <div class="bg-canvas-bg rounded-xl p-space-lg shadow-sm border border-border-light hover:border-primary transition-colors cursor-pointer group">
                <div class="w-12 h-12 rounded-xl bg-status-warning-surface text-status-warning flex items-center justify-center mb-space-md">
                    <span class="material-symbols-outlined text-[24px]">rule</span>
                </div>
                <h3 class="font-headline-sm font-semibold text-text-primary group-hover:text-primary transition-colors">Laporan Validasi Lapangan</h3>
                <p class="font-body-sm text-text-secondary mt-1 mb-space-md">Total validasi CPCL periode ini: {{ $totalValidasi }} data keluarga.</p>
                <a href="{{ route('pemda.laporan.validasi-pdf', request()->all()) }}" target="_blank" class="w-full block text-center py-2 bg-surface-container rounded-lg text-text-primary font-label-md font-semibold group-hover:bg-primary group-hover:text-on-primary transition-colors">Unduh PDF</a>
            </div>
        </div>
    </div>
</div>

<!-- MODAL SIMULATOR WHATSAPP WEBHOOK -->
<div id="waSimulatorModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4">
    <div class="bg-canvas-bg rounded-2xl max-w-xl w-full shadow-2xl border border-border-light overflow-hidden flex flex-col transform transition-all duration-300">
        <!-- Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-emerald-800 to-green-900 text-white flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">phone_iphone</span>
                </div>
                <div>
                    <h3 class="font-bold text-base leading-tight">Simulator Webhook WhatsApp</h3>
                    <p class="text-[11px] text-emerald-200">Uji pengiriman laporan warga langsung ke API sistem</p>
                </div>
            </div>
            <button type="button" onclick="closeWaSimulatorModal()" class="w-8 h-8 rounded-lg flex items-center justify-center text-white/80 hover:text-white hover:bg-white/10 transition-colors">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <!-- Form Body -->
        <form id="waSimulatorForm" onsubmit="submitWaSimulator(event)" class="p-6 flex flex-col gap-4 text-xs sm:text-sm">
            <div>
                <label class="block font-semibold text-text-primary mb-1">Nomor WhatsApp Pengirim</label>
                <input type="text" id="simSender" value="085239112233" required placeholder="08xxxxxxxxxx atau 628xxxxxxxxxx" class="w-full px-3 py-2 rounded-lg border border-border-medium font-mono text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent"/>
                <span class="text-[11px] text-text-tertiary mt-0.5 block">Nomor yang mengirim pesan via WhatsApp Gateway.</span>
            </div>

            <div>
                <label class="block font-semibold text-text-primary mb-1">Nama Profil WhatsApp (PushName)</label>
                <input type="text" id="simPushName" value="Pak Ahmad (Petani Binaan)" class="w-full px-3 py-2 rounded-lg border border-border-medium text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent"/>
            </div>

            <div>
                <label class="block font-semibold text-text-primary mb-1">Pilihan Contoh Cepat (Quick Template):</label>
                <div class="flex flex-wrap gap-1.5 mb-2">
                    <button type="button" onclick="setQuickMsg(1)" class="px-2.5 py-1 rounded bg-surface-subtle hover:bg-surface-muted text-[11px] font-medium border border-border-light text-text-primary">
                        📝 Format NIK Terstruktur (#LAPOR)
                    </button>
                    <button type="button" onclick="setQuickMsg(2)" class="px-2.5 py-1 rounded bg-surface-subtle hover:bg-surface-muted text-[11px] font-medium border border-border-light text-text-primary">
                        🐛 Laporan Hama Tanaman
                    </button>
                    <button type="button" onclick="setQuickMsg(3)" class="px-2.5 py-1 rounded bg-surface-subtle hover:bg-surface-muted text-[11px] font-medium border border-border-light text-text-primary">
                        🌾 Laporan Panen Mandiri
                    </button>
                </div>
                <textarea id="simMessage" rows="3" required class="w-full px-3 py-2 rounded-lg border border-border-medium font-mono text-xs focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent" placeholder="Ketik isi pesan WhatsApp..."></textarea>
            </div>

            <!-- Response Preview Box (Hidden initially) -->
            <div id="simResultBox" class="hidden flex flex-col gap-2 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200">
                <div class="flex items-center justify-between text-xs font-bold text-emerald-900">
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px] text-emerald-700">check_circle</span>
                        <span>Respon API (200 OK)</span>
                    </span>
                    <span id="simResultTicket" class="font-mono text-emerald-800">#LAP-0</span>
                </div>
                <div class="text-[11px] text-emerald-950 font-sans whitespace-pre-line bg-white/90 p-3 rounded-lg border border-emerald-300 shadow-sm" id="simResultAutoReply">
                    <!-- WhatsApp Chat Bubble Preview -->
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 pt-2 border-t border-border-light">
                <button type="button" onclick="closeWaSimulatorModal()" class="px-4 py-2 rounded-lg bg-surface-container hover:bg-surface-variant text-text-secondary font-semibold text-xs">
                    Tutup
                </button>
                <button type="submit" id="btnSimSubmit" class="px-5 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center gap-1.5 shadow-sm transition-colors">
                    <span class="material-symbols-outlined text-[16px]">send</span>
                    <span>Kirim ke Webhook API</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function copyWebhookUrl() {
        const text = document.getElementById('webhookUrlText').innerText;
        navigator.clipboard.writeText(text).then(() => {
            const btn = document.getElementById('copyBtnText');
            btn.innerText = 'Tersalin!';
            setTimeout(() => { btn.innerText = 'Salin'; }, 2000);
        });
    }

    function openWaSimulatorModal() {
        const modal = document.getElementById('waSimulatorModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setQuickMsg(1);
    }

    function closeWaSimulatorModal() {
        const modal = document.getElementById('waSimulatorModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    function setQuickMsg(type) {
        const msgBox = document.getElementById('simMessage');
        if (type === 1) {
            msgBox.value = "#LAPOR#5204010000000001#Bantuan bibit cabai sebanyak 20 polybag sudah kami terima di Desa Semamung dalam kondisi baik dan mulai ditanam.";
        } else if (type === 2) {
            msgBox.value = "#LAPOR#5204010000000001#Lapor pak pendamping, ada beberapa bedengan tanaman jagung kami yang mulai terserang ulat daun, mohon arahan obat pembasmi.";
        } else if (type === 3) {
            msgBox.value = "#LAPOR#5204010000000001#Alhamdulillah hasil panen pertama bibit bawang merah mencapai 150 kg, pendapatan kami meningkat bulan ini.";
        }
    }

    function submitWaSimulator(e) {
        e.preventDefault();
        const btn = document.getElementById('btnSimSubmit');
        const resultBox = document.getElementById('simResultBox');
        const resultTicket = document.getElementById('simResultTicket');
        const resultReply = document.getElementById('simResultAutoReply');

        btn.disabled = true;
        btn.innerHTML = `<span class="material-symbols-outlined text-[16px] animate-spin">autorenew</span> Mengirim...`;

        const payload = {
            sender: document.getElementById('simSender').value,
            message: document.getElementById('simMessage').value,
            pushName: document.getElementById('simPushName').value,
        };

        fetch('/api/v1/whatsapp/webhook', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(data => {
            btn.disabled = false;
            btn.innerHTML = `<span class="material-symbols-outlined text-[16px]">send</span> Kirim ke Webhook API`;

            if (data.success) {
                resultBox.classList.remove('hidden');
                resultTicket.innerText = data.data.nomor_tiket || 'OK';
                resultReply.innerText = data.reply || data.message;

                // Tampilkan notifikasi dan reload setelah 2.5 detik
                setTimeout(() => {
                    window.location.reload();
                }, 2200);
            } else {
                alert('Gagal: ' + (data.message || 'Terjadi kesalahan'));
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = `<span class="material-symbols-outlined text-[16px]">send</span> Kirim ke Webhook API`;
            alert('Error koneksi API: ' + err.message);
        });
    }
</script>
@endsection
