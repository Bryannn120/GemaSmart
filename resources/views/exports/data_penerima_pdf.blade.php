<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Data Penerima Bantuan - GemaSmart Sumbawa</title>
    <style>
        @page {
            margin: 18px 20px 28px 20px;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 8.5px;
            color: #1f2937;
            line-height: 1.35;
        }
        .header {
            border-bottom: 2px solid #00450d;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 13px;
            margin: 0;
            color: #00450d;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .header h2 {
            font-size: 10px;
            margin: 3px 0 0 0;
            color: #111827;
            font-weight: bold;
        }
        .meta {
            font-size: 8px;
            color: #4b5563;
            margin-top: 3px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        thead {
            display: table-header-group;
        }
        tr {
            page-break-inside: avoid;
        }
        th {
            background-color: #00450d;
            color: #ffffff;
            font-weight: bold;
            font-size: 7.8px;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #00330a;
            padding: 5px 4px;
            word-wrap: break-word;
        }
        td {
            border: 1px solid #d1d5db;
            padding: 4px;
            vertical-align: top;
            word-wrap: break-word;
            font-size: 7.8px;
        }
        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .mono { font-family: DejaVu Sans Mono, monospace; font-size: 7.4px; }
        .badge {
            display: inline-block;
            padding: 1px 4px;
            border-radius: 3px;
            font-size: 7px;
            font-weight: bold;
        }
        .badge-mandiri { background-color: #dcfce7; color: #166534; }
        .badge-tahap { background-color: #dbeafe; color: #1e40af; }
        .badge-perhatian { background-color: #fef3c7; color: #92400e; }
        .footer {
            position: fixed;
            bottom: -16px;
            left: 0;
            right: 0;
            font-size: 7.5px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 3px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $subTitleOrg }}</h1>
        <h2>DATABASE KELUARGA PENERIMA MANFAAT BANTUAN ({{ strtoupper(str_replace('_', ' ', $tabTitle)) }})</h2>
        <div class="meta">
            Diekspor pada: {{ $exportedAt }} WITA &bull; Total Data: <strong>{{ count($rows) }} Keluarga Penerima</strong>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 11%;">No. KK &amp; NIK</th>
                <th style="width: 11%;">Nama Kepala Keluarga</th>
                <th style="width: 9%;">No. WhatsApp Penerima</th>
                <th style="width: 14%;">Alamat &amp; Wilayah</th>
                <th style="width: 12%;">Program Bantuan</th>
                <th style="width: 10%;">Indikator Kemandirian</th>
                <th style="width: 9%;">Status Kemandirian</th>
                <th style="width: 8%;">Pendapatan / Bulan</th>
                <th style="width: 5%;">Validasi</th>
                <th style="width: 8%;">Pendamping &amp; Tgl Daftar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $idx => $r)
                <tr>
                    <td class="text-center">{{ $idx + 1 }}</td>
                    <td class="mono">
                        <strong>KK:</strong> {{ $r['no_kk'] }}<br>
                        <strong>NIK:</strong> {{ $r['nik'] }}
                    </td>
                    <td><strong>{{ $r['kepala_keluarga'] }}</strong></td>
                    <td class="mono text-center">{{ $r['no_whatsapp'] }}</td>
                    <td>
                        {{ $r['alamat'] }}<br>
                        <span style="color: #4b5563;">Desa {{ $r['desa'] }}, Kec. {{ $r['kecamatan'] }}</span>
                    </td>
                    <td>{{ $r['program'] }}</td>
                    <td class="text-center">{{ $r['indikator_kemandirian'] }}</td>
                    <td class="text-center">
                        @php
                            $stLower = strtolower($r['status_kemandirian']);
                            $badgeClass = str_contains($stLower, 'mandiri') && !str_contains($stLower, 'tahap')
                                ? 'badge-mandiri'
                                : (str_contains($stLower, 'perhatian') ? 'badge-perhatian' : 'badge-tahap');
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $r['status_kemandirian'] }}</span>
                    </td>
                    <td class="text-right mono">Rp {{ number_format($r['pendapatan'], 0, ',', '.') }}</td>
                    <td class="text-center">{{ $r['status_validasi'] }}</td>
                    <td>
                        {{ $r['pendamping'] }}<br>
                        <span style="color: #6b7280;">{{ $r['tgl_daftar'] }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center" style="padding: 14px; color: #6b7280;">
                        Tidak ada data penerima bantuan yang sesuai dengan filter.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dokumen Resmi Sistem GemaSmart Bappeda Kabupaten Sumbawa &bull; Dicetak Otomatis
    </div>
</body>
</html>

