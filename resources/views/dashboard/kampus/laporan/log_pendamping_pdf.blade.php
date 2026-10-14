<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Log Harian Pendamping Lapangan - {{ $kampus->nama_universitas ?? 'Kampus Mitra' }}</title>
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
        <h1>{{ $kampus->nama_universitas ?? 'KAMPUS MITRA SIBIBIT' }}</h1>
        <p>Laporan Aktivitas Pendamping Lapangan &bull; Program SiBibit Gema Smart</p>
        <p style="font-weight:bold; margin-top:8px;">KOMPILASI LOG HARIAN PENDAMPING LAPANGAN</p>
    </div>

    <div class="summary-box">
        <strong>Informasi Pendampingan:</strong><br>
        Total Pendamping Terdaftar: <strong>{{ $pendampings->count() }} Orang</strong> |
        Total Log/Laporan Monitoring: <strong>{{ $laporans->count() }} Kegiatan</strong><br>
        Periode Laporan: <strong>{{ $periodInfo['label'] ?? 'Semua Periode' }}</strong> |
        Dicetak pada: <strong>{{ now()->format('d M Y H:i') }} WITA</strong>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 25%;">Nama Pendamping</th>
                <th style="width: 25%;">Keluarga Penerima</th>
                <th style="width: 15%;">Status Kondisi</th>
                <th style="width: 15%;">Catatan Lapangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporans as $index => $l)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($l->tanggal_lapor)->format('d M Y') }}</td>
                <td><strong>{{ $l->pendamping->name ?? '-' }}</strong></td>
                <td>{{ $l->keluarga_penerima->kepala_keluarga ?? '-' }}</td>
                <td style="text-transform: capitalize;">{{ $l->status_kondisi }}</td>
                <td>{{ $l->catatan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: #888; padding: 15px;">Belum ada log aktivitas monitoring tercatat.</td>
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
                Koordinator Tim Pendamping
                <br><br><br><br>
                ( ......................................... )
            </td>
        </tr>
    </table>

    <div class="footer">
        Dokumen Resmi Evaluasi Akademik & Pendampingan &bull; SiBibit Sumbawa
    </div>
</body>
</html>
