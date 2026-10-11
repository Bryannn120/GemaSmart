<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekapitulasi SPJ Pengadaan - {{ $kampus->nama_universitas ?? 'Kampus Mitra' }}</title>
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
        <p>Laporan Pertanggungjawaban Keuangan &bull; Pengadaan Bibit Tanaman</p>
        <p style="font-weight:bold; margin-top:8px;">REKAPITULASI SURAT PERTANGGUNGJAWABAN (SPJ)</p>
    </div>

    <div class="summary-box">
        <strong>Ringkasan Pertanggungjawaban (SPJ):</strong><br>
        Total Berkas Pengajuan: <strong>{{ $spjs->count() }} Berkas</strong> |
        Total Realisasi Anggaran: <strong>Rp {{ number_format($totalNominal, 0, ',', '.') }}</strong><br>
        Dicetak pada: <strong>{{ now()->format('d M Y H:i') }} WITA</strong>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">Nomor SPJ</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 35%;">Uraian Pengadaan</th>
                <th style="width: 15%;">Nominal</th>
                <th style="width: 10%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($spjs as $index => $s)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $s->nomor_spj }}</strong></td>
                <td>{{ \Carbon\Carbon::parse($s->tgl_pengajuan)->format('d M Y') }}</td>
                <td>{{ $s->uraian }}</td>
                <td>Rp {{ number_format($s->nominal, 0, ',', '.') }}</td>
                <td style="text-transform: capitalize;">{{ $s->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: #888; padding: 15px;">Belum ada berkas SPJ yang diajukan.</td>
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
                Bendahara / PIC Pengadaan Kampus
                <br><br><br><br>
                ( ......................................... )
            </td>
        </tr>
    </table>

    <div class="footer">
        Dokumen Resmi Pertanggungjawaban Keuangan &bull; Sistem SiBibit Sumbawa
    </div>
</body>
</html>
