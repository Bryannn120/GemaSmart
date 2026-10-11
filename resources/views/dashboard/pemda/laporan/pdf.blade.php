<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Rekapitulasi - Gema Smart</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; line-height: 1.5; }
        .header { text-align: center; border-bottom: 2px solid #00450d; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { font-size: 20px; margin: 0; color: #00450d; text-transform: uppercase; }
        .header p { margin: 5px 0 0 0; font-size: 12px; }
        .section-title { font-size: 14px; font-weight: bold; background: #e8f5e9; padding: 5px 10px; color: #00450d; margin-top: 20px; margin-bottom: 10px; }
        .summary-box { border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; width: 48%; display: inline-block; box-sizing: border-box; text-align: center; }
        .summary-box h3 { margin: 0 0 5px 0; font-size: 18px; color: #1b5e20; }
        .summary-box p { margin: 0; font-size: 11px; text-transform: uppercase; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; }
        .footer { position: fixed; bottom: -20px; left: 0; right: 0; font-size: 10px; text-align: center; color: #999; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Pemerintah Kabupaten Sumbawa</h1>
        <p>Badan Perencanaan Pembangunan Daerah</p>
        <p style="font-weight:bold; margin-top:10px;">LAPORAN REKAPITULASI PROGRAM GEMA SMART</p>
        <p>Tanggal Cetak: {{ now()->format('d F Y H:i') }}</p>
    </div>

    <div class="section-title">Ringkasan Eksekutif</div>
    
    <div>
        <div class="summary-box">
            <h3>{{ number_format($totalProgram) }}</h3>
            <p>Program Bantuan</p>
        </div>
        <div class="summary-box">
            <h3>{{ number_format($totalKeluargaPenerima) }}</h3>
            <p>Total KeluargaPenerima Calon Penerima</p>
        </div>
        <div class="summary-box">
            <h3>{{ number_format($totalPenyaluran) }}</h3>
            <p>Total Proses Penyaluran</p>
        </div>
        <div class="summary-box">
            <h3>{{ number_format($totalValidasi) }}</h3>
            <p>Total Data Validasi</p>
        </div>
    </div>

    <div class="section-title">Status Kelayakan Penerima (CPCL)</div>
    <table>
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
                    <td>{{ $p->total }} KeluargaPenerima</td>
                </tr>
            @empty
                <tr><td colspan="2" style="text-align:center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">Status Penyaluran Bibit Fisik</div>
    <table>
        <thead>
            <tr>
                <th>Status Penyaluran</th>
                <th>Jumlah Penyaluran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penyaluranByStatus as $p)
                <tr>
                    <td style="text-transform: capitalize;">{{ $p->status }}</td>
                    <td>{{ $p->total }} BAST</td>
                </tr>
            @empty
                <tr><td colspan="2" style="text-align:center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">Kondisi Tumbuh Kembang (Monev)</div>
    <table>
        <thead>
            <tr>
                <th>Status Kondisi Tanaman</th>
                <th>Jumlah Laporan Survei</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporanByKondisi as $l)
                <tr>
                    <td style="text-transform: capitalize;">{{ $l->status_kondisi }}</td>
                    <td>{{ $l->total }} Laporan</td>
                </tr>
            @empty
                <tr><td colspan="2" style="text-align:center">Belum ada data laporan dari lapangan</td></tr>
            @endforelse
        </tbody>
    </table>

    <br><br>
    <table style="border:none;">
        <tr style="border:none;">
            <td style="border:none; width: 60%;"></td>
            <td style="border:none; text-align: center;">
                Sumbawa Besar, {{ now()->format('d F Y') }}<br>
                Admin Gema Smart Sumbawa
                <br><br><br><br><br>
                ( ......................................... )
            </td>
        </tr>
    </table>

    <div class="footer">
        Dicetak dari Sistem Gema Smart &bull; Dilindungi oleh UU ITE.
    </div>
</body>
</html>
