<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penyaluran Bibit - Pemda Sumbawa</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; line-height: 1.4; }
        .header { text-align: center; border-bottom: 2px solid #00450d; padding-bottom: 8px; margin-bottom: 15px; }
        .header h1 { font-size: 18px; margin: 0; color: #00450d; text-transform: uppercase; }
        .header p { margin: 3px 0 0 0; font-size: 11px; }
        .meta { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #ddd; padding: 6px 8px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; font-size: 11px; }
        .summary-box { background: #e8f5e9; padding: 10px; margin-bottom: 15px; border-left: 4px solid #00450d; }
        .footer { position: fixed; bottom: -20px; left: 0; right: 0; font-size: 10px; text-align: center; color: #888; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Pemerintah Kabupaten Sumbawa</h1>
        <p>Badan Perencanaan Pembangunan Daerah &bull; Dinas Pertanian</p>
        <p style="font-weight:bold; margin-top:8px;">LAPORAN PENYALURAN BIBIT TANAMAN PRODUKTIF</p>
    </div>

    <div class="summary-box">
        <strong>Ringkasan Penyaluran:</strong><br>
        Total Dokumen BAST: <strong>{{ $penyalurans->count() }} Dokumen</strong> | 
        Total Akumulasi Bibit: <strong>{{ number_format($totalKuantitas) }} Bibit/Pohon</strong> |
        Dicetak pada: <strong>{{ now()->format('d M Y H:i') }} WITA</strong>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">Nomor BAST</th>
                <th style="width: 25%;">Tujuan Wilayah / Desa</th>
                <th style="width: 25%;">Jenis Bibit</th>
                <th style="width: 15%;">Jumlah</th>
                <th style="width: 10%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penyalurans as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $p->nomor_bast }}</strong><br><small>{{ \Carbon\Carbon::parse($p->tgl_kirim)->format('d M Y') }}</small></td>
                <td>{{ $p->wilayah->nama ?? '-' }}</td>
                <td>{{ $p->jenisBibit->nama_varian ?? '-' }} ({{ $p->jenisBibit->kategori ?? '-' }})</td>
                <td>{{ number_format($p->kuantitas) }} {{ $p->jenisBibit->satuan ?? 'Unit' }}</td>
                <td style="text-transform: capitalize;">{{ $p->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 15px; color: #888;">Belum ada riwayat penyaluran bibit tercatat.</td>
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
                Penanggung Jawab Distribusi
                <br><br><br><br>
                ( ......................................... )
            </td>
        </tr>
    </table>

    <div class="footer">
        Dokumen Resmi Sistem SiBibit Gema Smart Sumbawa &bull; Dicetak Otomatis
    </div>
</body>
</html>
