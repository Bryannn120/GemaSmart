<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Akademik & Internal - {{ $kampus->nama_universitas ?? 'Kampus Mitra' }}</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; line-height: 1.4; }
        .header { text-align: center; border-bottom: 2px solid #00450d; padding-bottom: 8px; margin-bottom: 15px; }
        .header h1 { font-size: 18px; margin: 0; color: #00450d; text-transform: uppercase; }
        .header p { margin: 3px 0 0 0; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #ddd; padding: 6px 8px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; font-size: 11px; }
        .summary-box { background: #e8f5e9; padding: 10px; margin-bottom: 15px; border-left: 4px solid #00450d; }
        .footer { position: fixed; bottom: -20px; left: 0; right: 0; font-size: 10px; text-align: center; color: #888; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $kampus->nama_universitas ?? 'KAMPUS MITRA SIBIBIT' }}</h1>
        <p>Koordinator Program Kemitraan &bull; Pemerintah Daerah Kabupaten Sumbawa</p>
        <p style="font-weight:bold; margin-top:8px;">LAPORAN INTERNAL KAMPUS & PENDAMPINGAN LAPANGAN</p>
    </div>

    <div class="summary-box">
        <strong>Informasi Kemitraan:</strong><br>
        Universitas: <strong>{{ $kampus->nama_universitas ?? 'Universitas Teknologi Sumbawa' }}</strong> |
        PIC: <strong>{{ $kampus->pic_name ?? '-' }} ({{ $kampus->pic_contact ?? '-' }})</strong><br>
        Wilayah Binaan: <strong>{{ $kampus->wilayah_binaan ?? 'Seluruh Wilayah Sumbawa' }}</strong><br>
        Periode Laporan: <strong>{{ $periodInfo['label'] ?? 'Semua Periode' }}</strong> |
        Dicetak pada: <strong>{{ now()->format('d M Y H:i') }} WITA</strong>
    </div>

    @if(isset($penyalurans) && $penyalurans->count() > 0)
    <h4 style="margin-bottom: 5px; color: #00450d;">Realisasi Penyaluran Bantuan ({{ $periodInfo['label'] ?? 'Periode Ini' }}):</h4>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tgl Penyaluran</th>
                <th style="width: 25%;">Penerima</th>
                <th style="width: 25%;">Item / Bantuan</th>
                <th style="width: 15%;">Jumlah</th>
                <th style="width: 15%;">Nilai (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penyalurans as $idx => $pen)
            <tr>
                <td>{{ $idx + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($pen->tgl_penyaluran)->format('d/m/Y') }}</td>
                <td><strong>{{ $pen->keluargaPenerima->kepala_keluarga ?? '-' }}</strong></td>
                <td>{{ $pen->itemBantuan->nama_item ?? '-' }}</td>
                <td>{{ number_format($pen->jumlah, 0) }} {{ $pen->satuan }}</td>
                <td>
                    @if($pen->jenis === 'uang')
                        Rp {{ number_format($pen->nominal_uang, 0, ',', '.') }}
                    @else
                        Rp {{ number_format($pen->jumlah * ($pen->itemBantuan->nominal_satuan ?? 0), 0, ',', '.') }}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <h4 style="margin-bottom: 5px; color: #00450d;">Daftar Mahasiswa / Kader Pendamping:</h4>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 35%;">Nama Pendamping</th>
                <th style="width: 35%;">Email Petugas</th>
                <th style="width: 25%;">Peran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendampings as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $p->name }}</strong></td>
                <td>{{ $p->email }}</td>
                <td>Pendamping Lapangan</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; color: #888;">Belum ada data pendamping lapangan tercatat.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <h4 style="margin-bottom: 5px; color: #00450d;">Keluarga Penerima Binaan:</h4>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 30%;">Kepala Keluarga</th>
                <th style="width: 25%;">No. KK & NIK</th>
                <th style="width: 20%;">Wilayah / Desa</th>
                <th style="width: 20%;">Pendamping</th>
            </tr>
        </thead>
        <tbody>
            @forelse($keluargas as $index => $k)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $k->kepala_keluarga }}</strong></td>
                <td>{{ $k->no_kk }}</td>
                <td>{{ $k->wilayah->nama ?? '-' }}</td>
                <td>{{ $k->pendamping->name ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #888;">Belum ada keluarga penerima terdaftar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <br><br>
    <table style="border:none;">
        <tr style="border:none;">
            <td style="border:none; width: 65%;"></td>
            <td style="border:none; text-align: center;">
                Sumbawa Besar, {{ now()->format('d F Y') }}<br>
                Koordinator Pelaksana Kampus
                <br><br><br><br>
                ( {{ $kampus->pic_name ?? '.........................................' }} )
            </td>
        </tr>
    </table>

    <div class="footer">
        Dokumen Laporan Internal Kampus &bull; Sistem SiBibit Sumbawa
    </div>
</body>
</html>
