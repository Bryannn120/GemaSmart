<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Statistik Tumbuh Kembang - Pemda Sumbawa</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; line-height: 1.4; }
        .header { text-align: center; border-bottom: 2px solid #00450d; padding-bottom: 8px; margin-bottom: 15px; }
        .header h1 { font-size: 18px; margin: 0; color: #00450d; text-transform: uppercase; }
        .header p { margin: 3px 0 0 0; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #ddd; padding: 6px 8px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; font-size: 11px; }
        .summary-box { background: #e3f2fd; padding: 10px; margin-bottom: 15px; border-left: 4px solid #1976D2; }
        .footer { position: fixed; bottom: -20px; left: 0; right: 0; font-size: 10px; text-align: center; color: #888; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Pemerintah Kabupaten Sumbawa</h1>
        <p>Badan Perencanaan Pembangunan Daerah &bull; Tim Monev Lapangan</p>
        <p style="font-weight:bold; margin-top:8px;">LAPORAN MONITORING & EVALUASI TUMBUH KEMBANG TANAMAN</p>
    </div>

    <div class="summary-box">
        <strong>Statistik Hasil Pemantauan Lapangan:</strong><br>
        Total Laporan Pengamatan: <strong>{{ $laporans->count() }} Laporan</strong> |
        Dicetak pada: <strong>{{ now()->format('d M Y H:i') }} WITA</strong>
    </div>

    <h4 style="margin-bottom: 5px; color: #00450d;">Rekapitulasi Kondisi Tanaman:</h4>
    <table style="width: 50%; margin-bottom: 15px;">
        <thead>
            <tr>
                <th>Status Kondisi</th>
                <th>Jumlah Laporan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporanByKondisi as $k)
            <tr>
                <td style="text-transform: capitalize;">{{ $k->status_kondisi }}</td>
                <td><strong>{{ $k->total }}</strong></td>
            </tr>
            @empty
            <tr>
                <td colspan="2" style="text-align: center; color: #888;">Belum ada data survei.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <h4 style="margin-bottom: 5px; color: #00450d;">Rincian Log Monitoring Lapangan:</h4>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 25%;">Keluarga Penerima</th>
                <th style="width: 20%;">Pendamping Lapangan</th>
                <th style="width: 15%;">Kondisi</th>
                <th style="width: 20%;">Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporans as $index => $l)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($l->tanggal_lapor)->format('d M Y') }}</td>
                <td>{{ $l->keluarga_penerima->kepala_keluarga ?? '-' }}</td>
                <td>{{ $l->pendamping->name ?? '-' }}</td>
                <td style="text-transform: capitalize;">{{ $l->status_kondisi }}</td>
                <td>{{ $l->catatan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 15px; color: #888;">Belum ada log pemantauan tumbuh kembang tercatat.</td>
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
                Tim Monev Pertanian Sumbawa
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
