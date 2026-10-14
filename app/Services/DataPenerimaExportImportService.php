<?php

namespace App\Services;

use App\Models\KeluargaPenerima;
use App\Models\Wilayah;
use App\Models\ProgramBantuan;
use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class DataPenerimaExportImportService
{
    /**
     * Ekspor data penerima bantuan ke file Excel (.xlsx) atau CSV (.csv).
     */
    public function export($format = 'xlsx', $tab = 'aktif', $wilayahId = null, $programId = null, $search = null)
    {
        $query = KeluargaPenerima::with(['wilayah.parent', 'programBantuan', 'user', 'pendamping', 'kampusMitra']);

        if ($tab === 'mandiri') {
            $query->mandiri();
        } elseif ($tab === 'aktif') {
            $query->penerimaAktif();
        }

        if (!empty($wilayahId)) {
            $query->where('wilayah_id', $wilayahId);
        }

        if (!empty($programId)) {
            $query->where('program_bantuan_id', $programId);
        }

        if (!empty($search)) {
            $term = trim($search);
            $query->where(function ($q) use ($term) {
                $q->where('kepala_keluarga', 'like', "%{$term}%")
                  ->orWhere('nik', 'like', "%{$term}%")
                  ->orWhere('no_kk', 'like', "%{$term}%")
                  ->orWhere('alamat', 'like', "%{$term}%");
            });
        }

        $penerimas = $query->latest('id')->get();
        $timestamp = date('Y-m-d_H-i-s');
        $tabTitle = ($tab === 'mandiri') ? 'Lulus_Mandiri' : (($tab === 'aktif') ? 'Aktif' : 'Semua');
        $filename = "Data_Penerima_Bantuan_Bappeda_{$tabTitle}_{$timestamp}." . ($format === 'csv' ? 'csv' : 'xlsx');

        // Catat Audit Trail
        AuditLog::record(
            'Bappeda Mengekspor Data Penerima Bantuan',
            'KeluargaPenerima',
            null,
            null,
            [
                'format' => $format,
                'tab' => $tab,
                'total_baris' => $penerimas->count(),
                'filename' => $filename,
            ]
        );

        if ($format === 'csv') {
            return $this->streamCsvExport($penerimas, $filename);
        }

        return $this->streamXlsxExport($penerimas, $filename, $tabTitle);
    }

    /**
     * Stream output dalam format Excel (.xlsx) dengan styling rapi khas Bappeda.
     */
    protected function streamXlsxExport($penerimas, $filename, $tabTitle)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Penerima Bantuan');

        // Judul Laporan di Sheet
        $sheet->setCellValue('A1', 'PEMERINTAH KABUPATEN SUMBAWA - BAPPEDA');
        $sheet->setCellValue('A2', 'DATABASE KELUARGA PENERIMA MANFAAT BANTUAN SOSIAL (' . strtoupper(str_replace('_', ' ', $tabTitle)) . ')');
        $sheet->setCellValue('A3', 'Diekspor pada: ' . date('d F Y H:i:s') . ' WITA | Total: ' . $penerimas->count() . ' KK');

        $sheet->mergeCells('A1:N1');
        $sheet->mergeCells('A2:N2');
        $sheet->mergeCells('A3:N3');

        $sheet->getStyle('A1:A2')->getFont()->setBold(true)->setSize(13);
        $sheet->getStyle('A3')->getFont()->setItalic(true)->setSize(10)->getColor()->setRGB('555555');

        // Header Kolom Tabel
        $headers = [
            'No',
            'No. KK',
            'NIK Kepala Keluarga',
            'Nama Kepala Keluarga',
            'Alamat Lengkap',
            'Desa / Kelurahan',
            'Kecamatan',
            'Program Bantuan',
            'Desil',
            'Status Kemandirian',
            'Penghasilan (Rp)',
            'Status Validasi',
            'Pendamping Lapangan',
            'Tanggal Terdaftar'
        ];

        $headerRow = 5;
        foreach ($headers as $colIdx => $header) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx + 1);
            $sheet->setCellValue($colLetter . $headerRow, $header);
        }

        // Style Header Kolom
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1E3A8A'], // Navy Blue
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CBD5E1'],
                ],
            ],
        ];
        $sheet->getStyle('A5:N5')->applyFromArray($headerStyle);
        $sheet->getRowDimension(5)->setRowHeight(28);

        // Isi Data Baris
        $row = 6;
        $no = 1;
        foreach ($penerimas as $item) {
            $desa = $item->wilayah->nama ?? '-';
            $kecamatan = $item->wilayah->parent->nama ?? '-';
            $program = $item->programBantuan->nama_program ?? '-';
            $pendamping = $item->pendamping->name ?? '-';
            $tglDaftar = $item->created_at ? $item->created_at->format('d/m/Y') : '-';

            $sheet->setCellValue('A' . $row, $no);
            // Simpan NIK dan KK secara eksplisit sebagai STRING untuk mencegah konversi scientific notation di Excel
            $sheet->setCellValueExplicit('B' . $row, (string) ($item->no_kk ?? '-'), DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('C' . $row, (string) ($item->nik ?? '-'), DataType::TYPE_STRING);
            $sheet->setCellValue('D' . $row, $item->kepala_keluarga ?? '-');
            $sheet->setCellValue('E' . $row, $item->alamat ?? '-');
            $sheet->setCellValue('F' . $row, $desa);
            $sheet->setCellValue('G' . $row, $kecamatan);
            $sheet->setCellValue('H' . $row, $program);
            $sheet->setCellValue('I' . $row, $item->desil ?? 1);
            $sheet->setCellValue('J' . $row, $item->status_kemandirian ?? 'Belum Dinilai');
            $sheet->setCellValue('K' . $row, (float) ($item->penghasilan_perbulan ?? 0));
            $sheet->setCellValue('L' . $row, strtoupper($item->status_validasi ?? 'VALID'));
            $sheet->setCellValue('M' . $row, $pendamping);
            $sheet->setCellValue('N' . $row, $tglDaftar);

            // Center align for certain columns
            $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B' . $row . ':C' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('I' . $row . ':J' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('L' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('N' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            // Format number untuk penghasilan
            $sheet->getStyle('K' . $row)->getNumberFormat()->setFormatCode('#,##0');

            // Zebra striping
            if ($no % 2 === 0) {
                $sheet->getStyle('A' . $row . ':N' . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F8FAFC');
            }

            $no++;
            $row++;
        }

        $lastRow = $row - 1;
        if ($lastRow >= 6) {
            $sheet->getStyle('A5:N' . $lastRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setRGB('E2E8F0');
        }

        // Auto-fit kolom
        foreach (range(1, 14) as $colIdx) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx);
            $sheet->getColumnDimension($colLetter)->setAutoSize(true);
        }

        return new StreamedResponse(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    /**
     * Stream output dalam format CSV dengan BOM UTF-8 agar kompatibel dengan Excel.
     */
    protected function streamCsvExport($penerimas, $filename)
    {
        return new StreamedResponse(function () use ($penerimas) {
            $handle = fopen('php://output', 'w');
            // Tulis BOM UTF-8 agar karakter dan simbol dibaca benar oleh Microsoft Excel
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header CSV
            fputcsv($handle, [
                'No',
                'No KK',
                'NIK',
                'Kepala Keluarga',
                'Alamat',
                'Desa',
                'Kecamatan',
                'Program Bantuan',
                'Desil',
                'Status Kemandirian',
                'Penghasilan Perbulan',
                'Status Validasi',
                'Pendamping',
                'Tanggal Terdaftar'
            ]);

            $no = 1;
            foreach ($penerimas as $item) {
                fputcsv($handle, [
                    $no++,
                    "'" . ($item->no_kk ?? ''), // Prefix kutip satu agar tidak terkonversi scientific notation di Excel
                    "'" . ($item->nik ?? ''),
                    $item->kepala_keluarga ?? '',
                    $item->alamat ?? '',
                    $item->wilayah->nama ?? '',
                    $item->wilayah->parent->nama ?? '',
                    $item->programBantuan->nama_program ?? '',
                    $item->desil ?? 1,
                    $item->status_kemandirian ?? 'Belum Dinilai',
                    $item->penghasilan_perbulan ?? 0,
                    $item->status_validasi ?? 'valid',
                    $item->pendamping->name ?? '',
                    $item->created_at ? $item->created_at->format('Y-m-d') : '',
                ]);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    /**
     * Download template format impor data penerima bantuan (.xlsx atau .csv).
     */
    public function downloadTemplate($format = 'xlsx')
    {
        $filename = "Template_Impor_Penerima_Bantuan_Bappeda." . ($format === 'csv' ? 'csv' : 'xlsx');

        if ($format === 'csv') {
            return new StreamedResponse(function () {
                $handle = fopen('php://output', 'w');
                fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

                fputcsv($handle, [
                    'no_kk',
                    'nik',
                    'kepala_keluarga',
                    'alamat',
                    'nama_desa',
                    'nama_program',
                    'desil',
                    'penghasilan_perbulan',
                    'status_validasi'
                ]);

                // Baris Contoh 1
                fputcsv($handle, [
                    '5204010101900001',
                    '5204010101900001',
                    'Ahmad Dahlan',
                    'Dusun Empang RT 01 RW 02',
                    'Empang Atas',
                    'Pemberdayaan Bibit Jagung Hibrida',
                    '2',
                    '750000',
                    'valid'
                ]);

                // Baris Contoh 2
                fputcsv($handle, [
                    '5204010101900002',
                    '5204010101900002',
                    'Siti Aminah',
                    'Jl. Lintas Sumbawa RT 03',
                    'Plampang',
                    'Bantuan Ternak Unggas Rakyat',
                    '3',
                    '900000',
                    'valid'
                ]);

                fclose($handle);
            }, 200, [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Cache-Control' => 'max-age=0',
            ]);
        }

        // Template XLSX dengan Lembar Panduan & Data Referensi
        $spreadsheet = new Spreadsheet();
        
        // Sheet 1: Template Pengisian Data
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Template_Impor');

        $headers = [
            'no_kk',
            'nik',
            'kepala_keluarga',
            'alamat',
            'nama_desa',
            'nama_program',
            'desil',
            'penghasilan_perbulan',
            'status_validasi'
        ];

        foreach ($headers as $colIdx => $h) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx + 1);
            $sheet->setCellValue($colLetter . '1', $h);
        }

        // Style Header
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '047857']], // Emerald
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(26);

        // Contoh Data Baris 2
        $sheet->setCellValueExplicit('A2', '5204010101900001', DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('B2', '5204010101900001', DataType::TYPE_STRING);
        $sheet->setCellValue('C2', 'Ahmad Dahlan');
        $sheet->setCellValue('D2', 'Dusun Empang RT 01 RW 02');
        $sheet->setCellValue('E2', 'Empang Atas');
        $sheet->setCellValue('F2', 'Pemberdayaan Bibit Jagung Hibrida');
        $sheet->setCellValue('G2', 2);
        $sheet->setCellValue('H2', 750000);
        $sheet->setCellValue('I2', 'valid');

        // Contoh Data Baris 3
        $sheet->setCellValueExplicit('A3', '5204010101900002', DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('B3', '5204010101900002', DataType::TYPE_STRING);
        $sheet->setCellValue('C3', 'Siti Aminah');
        $sheet->setCellValue('D3', 'Jl. Lintas Sumbawa RT 03');
        $sheet->setCellValue('E3', 'Plampang');
        $sheet->setCellValue('F3', 'Bantuan Ternak Unggas Rakyat');
        $sheet->setCellValue('G3', 3);
        $sheet->setCellValue('H3', 900000);
        $sheet->setCellValue('I3', 'valid');

        foreach (range(1, 9) as $colIdx) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx);
            $sheet->getColumnDimension($colLetter)->setAutoSize(true);
        }

        // Sheet 2: Daftar Referensi Wilayah & Program
        $refSheet = $spreadsheet->createSheet();
        $refSheet->setTitle('Referensi_Desa_dan_Program');

        $refSheet->setCellValue('A1', 'Daftar Desa Aktif (Kab. Sumbawa)');
        $refSheet->setCellValue('B1', 'Kecamatan');
        $refSheet->mergeCells('A1:B1');
        $refSheet->getStyle('A1')->getFont()->setBold(true);

        $refSheet->setCellValue('A2', 'Nama Desa');
        $refSheet->setCellValue('B2', 'Kecamatan');
        $refSheet->getStyle('A2:B2')->getFont()->setBold(true);

        $desas = Wilayah::where('jenis', 'desa')->with('parent')->where('is_aktif', true)->orderBy('nama')->take(50)->get();
        $r = 3;
        foreach ($desas as $d) {
            $refSheet->setCellValue('A' . $r, $d->nama);
            $refSheet->setCellValue('B' . $r, $d->parent->nama ?? '-');
            $r++;
        }

        $refSheet->setCellValue('D1', 'Daftar Program Bantuan Aktif');
        $refSheet->mergeCells('D1:E1');
        $refSheet->getStyle('D1')->getFont()->setBold(true);

        $refSheet->setCellValue('D2', 'Nama Program');
        $refSheet->setCellValue('E2', 'Pagu / Target');
        $refSheet->getStyle('D2:E2')->getFont()->setBold(true);

        $programs = ProgramBantuan::where('status', 'aktif')->orderBy('nama_program')->get();
        $pr = 3;
        foreach ($programs as $p) {
            $refSheet->setCellValue('D' . $pr, $p->nama_program);
            $refSheet->setCellValue('E' . $pr, ($p->target_kk ?? 0) . ' KK');
            $pr++;
        }

        $refSheet->getColumnDimension('A')->setAutoSize(true);
        $refSheet->getColumnDimension('B')->setAutoSize(true);
        $refSheet->getColumnDimension('D')->setAutoSize(true);
        $refSheet->getColumnDimension('E')->setAutoSize(true);

        $spreadsheet->setActiveSheetIndex(0);

        return new StreamedResponse(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    /**
     * Proses Impor File Excel/CSV Data Penerima Bantuan.
     */
    public function import($file, $duplicateMode = 'update')
    {
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        if (empty($rows) || count($rows) < 2) {
            return [
                'success' => false,
                'message' => 'File yang diunggah kosong atau tidak memiliki data baris penerima bantuan.',
                'stats' => ['total' => 0, 'new' => 0, 'updated' => 0, 'skipped' => 0, 'errors' => []],
            ];
        }

        // Ambil header di baris 1
        $headerRow = array_shift($rows);
        $columnMap = [];
        foreach ($headerRow as $colLetter => $headerText) {
            $normalized = strtolower(trim((string)$headerText));
            $normalized = str_replace([' ', '.', '_', '-'], '', $normalized);

            if (in_array($normalized, ['nokk', 'kk', 'nomorkk', 'kartukeluarga'])) {
                $columnMap['no_kk'] = $colLetter;
            } elseif (in_array($normalized, ['nik', 'nomorinduk', 'ktp', 'nikkepalakeluarga'])) {
                $columnMap['nik'] = $colLetter;
            } elseif (in_array($normalized, ['kepalakeluarga', 'nama', 'namakepalakeluarga', 'namalengkap'])) {
                $columnMap['kepala_keluarga'] = $colLetter;
            } elseif (in_array($normalized, ['alamat', 'alamatrumah', 'dusun', 'domisili'])) {
                $columnMap['alamat'] = $colLetter;
            } elseif (in_array($normalized, ['namadesa', 'desa', 'kelurahan', 'wilayah', 'desakelurahan'])) {
                $columnMap['nama_desa'] = $colLetter;
            } elseif (in_array($normalized, ['namaprogram', 'program', 'programbantuan', 'bantuan'])) {
                $columnMap['nama_program'] = $colLetter;
            } elseif (in_array($normalized, ['desil', 'desilkemiskinan', 'tingkatdesil'])) {
                $columnMap['desil'] = $colLetter;
            } elseif (in_array($normalized, ['penghasilan', 'penghasilanperbulan', 'pendapatan', 'gaji'])) {
                $columnMap['penghasilan_perbulan'] = $colLetter;
            } elseif (in_array($normalized, ['statusvalidasi', 'validasi', 'status'])) {
                $columnMap['status_validasi'] = $colLetter;
            }
        }

        // Pastikan kolom esensial ditemukan
        if (!isset($columnMap['nik']) || !isset($columnMap['kepala_keluarga'])) {
            return [
                'success' => false,
                'message' => 'Format kolom file tidak valid. Pastikan terdapat kolom NIK dan Nama Kepala Keluarga pada baris pertama template.',
                'stats' => ['total' => 0, 'new' => 0, 'updated' => 0, 'skipped' => 0, 'errors' => []],
            ];
        }

        // Cache daftar wilayah dan program untuk mempercepat lookup
        $activeDesas = Wilayah::where('jenis', 'desa')->where('is_aktif', true)->get();
        $activePrograms = ProgramBantuan::where('status', 'aktif')->get();
        $fallbackDesa = $activeDesas->first();
        $fallbackProgram = $activePrograms->first();

        $stats = [
            'total' => 0,
            'new' => 0,
            'updated' => 0,
            'skipped' => 0,
            'errors' => [],
        ];

        DB::beginTransaction();
        try {
            $line = 2; // Baris kedua pada file
            foreach ($rows as $row) {
                // Abaikan baris kosong
                $nikRaw = isset($columnMap['nik']) ? $row[$columnMap['nik']] : null;
                $namaRaw = isset($columnMap['kepala_keluarga']) ? $row[$columnMap['kepala_keluarga']] : null;

                if (empty($nikRaw) && empty($namaRaw)) {
                    $line++;
                    continue;
                }

                $stats['total']++;

                // Bersihkan NIK & No KK dari format ilmiah (scientific notation)
                $nik = $this->sanitizeNumberString($nikRaw);
                $noKk = isset($columnMap['no_kk']) ? $this->sanitizeNumberString($row[$columnMap['no_kk']]) : $nik;
                $kepalaKeluarga = trim((string)$namaRaw);
                $alamat = isset($columnMap['alamat']) ? trim((string)$row[$columnMap['alamat']]) : '-';

                if (empty($nik) || strlen($nik) < 8) {
                    $stats['errors'][] = "Baris {$line}: NIK '{$nikRaw}' tidak valid (minimal 8-16 digit).";
                    $line++;
                    continue;
                }

                if (empty($kepalaKeluarga)) {
                    $stats['errors'][] = "Baris {$line}: Nama Kepala Keluarga kosong.";
                    $line++;
                    continue;
                }

                // Lookup Wilayah / Desa
                $desaInput = isset($columnMap['nama_desa']) ? trim((string)$row[$columnMap['nama_desa']]) : '';
                $wilayah = null;
                if (!empty($desaInput)) {
                    $wilayah = $activeDesas->first(function ($item) use ($desaInput) {
                        return strcasecmp($item->nama, $desaInput) === 0 || stripos($item->nama, $desaInput) !== false;
                    });
                }
                $wilayahId = $wilayah ? $wilayah->id : ($fallbackDesa ? $fallbackDesa->id : null);

                // Lookup Program Bantuan
                $programInput = isset($columnMap['nama_program']) ? trim((string)$row[$columnMap['nama_program']]) : '';
                $program = null;
                if (!empty($programInput)) {
                    $program = $activePrograms->first(function ($item) use ($programInput) {
                        return strcasecmp($item->nama_program, $programInput) === 0 || stripos($item->nama_program, $programInput) !== false;
                    });
                }
                $programId = $program ? $program->id : ($fallbackProgram ? $fallbackProgram->id : null);

                // Desil (1-10)
                $desilRaw = isset($columnMap['desil']) ? $row[$columnMap['desil']] : 1;
                $desil = (int) $desilRaw;
                if ($desil < 1) $desil = 1;
                if ($desil > 10) $desil = 10;

                // Status Kemandirian Otomatis: Desil 6+ adalah Mandiri
                $statusKemandirian = ($desil >= 6) ? 'Mandiri' : 'Belum Dinilai';

                // Penghasilan perbulan
                $penghasilanRaw = isset($columnMap['penghasilan_perbulan']) ? $row[$columnMap['penghasilan_perbulan']] : 0;
                $penghasilan = (float) preg_replace('/[^0-9.]/', '', (string)$penghasilanRaw);

                // Status validasi
                $validasiRaw = isset($columnMap['status_validasi']) ? strtolower(trim((string)$row[$columnMap['status_validasi']])) : 'valid';
                $statusValidasi = in_array($validasiRaw, ['valid', 'proses_lapangan', 'menunggu_validasi', 'anomali']) ? $validasiRaw : 'valid';

                // Cek apakah data penerima sudah ada sebelumnya berdasarkan NIK atau No KK
                $existing = KeluargaPenerima::where('nik', $nik)
                    ->orWhere(function ($q) use ($noKk) {
                        if (!empty($noKk) && strlen($noKk) >= 10) {
                            $q->where('no_kk', $noKk);
                        }
                    })
                    ->first();

                if ($existing) {
                    if ($duplicateMode === 'skip') {
                        $stats['skipped']++;
                        $line++;
                        continue;
                    }

                    // Update data yang sudah ada
                    $existing->update([
                        'no_kk' => $noKk,
                        'kepala_keluarga' => $kepalaKeluarga,
                        'alamat' => $alamat ?: $existing->alamat,
                        'wilayah_id' => $wilayahId ?: $existing->wilayah_id,
                        'program_bantuan_id' => $programId ?: $existing->program_bantuan_id,
                        'desil' => $desil,
                        'penghasilan_perbulan' => $penghasilan > 0 ? $penghasilan : $existing->penghasilan_perbulan,
                        'status_kemandirian' => $statusKemandirian,
                        'status_validasi' => $statusValidasi,
                    ]);

                    // Update nama di User jika terhubung
                    if ($existing->user) {
                        $existing->user->update(['name' => $kepalaKeluarga]);
                    }

                    $stats['updated']++;
                } else {
                    // Buat Akun User Penerima Otomatis
                    $userEmail = $nik . '@penerima.com';
                    $user = User::where('email', $userEmail)->first();
                    if (!$user) {
                        $user = User::create([
                            'name' => $kepalaKeluarga,
                            'email' => $userEmail,
                            'password' => Hash::make($noKk),
                            'role' => 'penerima',
                        ]);
                    }

                    // Insert KeluargaPenerima Baru
                    KeluargaPenerima::create([
                        'no_kk' => $noKk,
                        'nik' => $nik,
                        'kepala_keluarga' => $kepalaKeluarga,
                        'alamat' => $alamat,
                        'wilayah_id' => $wilayahId,
                        'program_bantuan_id' => $programId,
                        'desil' => $desil,
                        'penghasilan_perbulan' => $penghasilan,
                        'status_kemandirian' => $statusKemandirian,
                        'status_validasi' => $statusValidasi,
                        'user_id' => $user->id,
                    ]);

                    $stats['new']++;
                }

                $line++;
            }

            DB::commit();

            // Catat Audit Log
            AuditLog::record(
                'Bappeda Mengimpor Data Penerima Bantuan (Excel/CSV)',
                'KeluargaPenerima',
                null,
                null,
                [
                    'total_dibaca' => $stats['total'],
                    'sukses_baru' => $stats['new'],
                    'sukses_diperbarui' => $stats['updated'],
                    'dilewati' => $stats['skipped'],
                    'jumlah_error' => count($stats['errors']),
                    'mode' => $duplicateMode,
                ]
            );

            return [
                'success' => true,
                'message' => "Proses impor selesai. Berhasil menambahkan {$stats['new']} data baru dan memperbarui {$stats['updated']} data. " . ($stats['skipped'] > 0 ? "({$stats['skipped']} data dilewati). " : ""),
                'stats' => $stats,
            ];
        } catch (\Throwable $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan sistem saat memproses impor data: ' . $e->getMessage(),
                'stats' => $stats,
            ];
        }
    }

    /**
     * Bersihkan string nomor angka yang terkonversi menjadi format ilmiah / spasi.
     */
    protected function sanitizeNumberString($value): string
    {
        if (is_null($value)) return '';
        $str = trim((string)$value);

        // Jika terdeteksi format ilmiah Excel e.g. 5.204E+15
        if (is_numeric($str) && (str_contains(strtoupper($str), 'E+') || str_contains(strtoupper($str), 'E-'))) {
            return number_format((float)$str, 0, '', '');
        }

        // Hilangkan karakter non-numerik seperti kutip, spasi, dash
        return preg_replace('/[^0-9]/', '', $str);
    }
}
