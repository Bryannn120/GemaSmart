<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Validasi Lapangan CPCL - Pemda Sumbawa</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; line-height: 1.4; }
        .header { text-align: center; border-bottom: 2px solid #00450d; padding-bottom: 8px; margin-bottom: 15px; }
        .header h1 { font-size: 18px; margin: 0; color: #00450d; text-transform: uppercase; }
        .header p { margin: 3px 0 0 0; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #ddd; padding: 6px 8px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; font-size: 11px; }
        .summary-box { background: #fff3e0; padding: 10px; margin-bottom: 15px; border-left: 4px solid #FF9800; }
        .footer { position: fixed; bottom: -20px; left: 0; right: 0; font-size: 10px; text-align: center; color: #888; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Pemerintah Kabupaten Sumbawa</h1>
        <p>Badan Perencanaan Pembangunan Daerah &bull; Tim Verifikasi & Validasi</p>
        <p style="font-weight:bold; margin-top:8px;">LAPORAN HASIL VALIDASI CPCL & KELAYAKAN PENERIMA BANTUAN</p>
    </div>

    <div class="summary-box">
        <strong>Statistik Validasi Lapangan:</strong><br>
        Total Riwayat Survei: <strong>{{ $validasis->count() }} Berkas</strong> |
        Dicetak pada: <strong>{{ now()->format('d M Y H:i') }} WITA</strong>
    </div>

    <h4 style="margin-bottom: 5px; color: #00450d;">Status Validasi Penerima (CPCL):</h4>
    <table style="width: 50%; margin-bottom: 15px;">
        <thead>
            <tr>
                <th>Status Validasi</th>
                <th>Jumlah Penerima</th>
            </tr>
        </thead>
        <tbody>
            @forelse($keluarga_penerimaByStatus as $p)
            <tr>
                <td style="text-transform: capitalize;">{{ str_replace('_', ' ', $p->status_validasi) }}</td>
                <td><strong>{{ $p->total }} Keluarga</strong></td>
            </tr>
            @empty
            <tr>
                <td colspan="2" style="text-align: center; color: #888;">Belum ada data status penerima.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <h4 style="margin-bottom: 5px; color: #00450d;">Daftar Validasi Fisik Lapangan:</h4>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tgl Survei</th>
                <th style="width: 25%;">Nama Calon Penerima</th>
                <th style="width: 20%;">Petugas Surveyor</th>
                <th style="width: 15%;">Kelayakan</th>
                <th style="width: 20%;">Catatan Tim</th>
            </tr>
        </thead>
        <tbody>
            @forelse($validasis as $index => $v)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($v->tgl_survei)->format('d M Y') }}</td>
                <td>{{ $v->keluarga_penerima->kepala_keluarga ?? '-' }}</td>
                <td>{{ $v->pendamping->name ?? '-' }}</td>
                <td style="text-transform: capitalize;">{{ $v->status_kelayakan }}</td>
                <td>{{ $v->catatan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 15px; color: #888;">Belum ada data survei fisik lapangan yang dicatat.</td>
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
                Ketua Tim Verifikasi CPCL
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
