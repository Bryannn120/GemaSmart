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
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Barryvdh\DomPDF\Facade\Pdf;

class DataPenerimaExportImportService
{
    /**
     * Ekspor data penerima bantuan ke file Excel (.xlsx), CSV (.csv), atau PDF (.pdf)
     * dengan dukungan scoping role (Pemda, Kampus, Pendamping).
     */
    public function export($format = 'xlsx', $tab = 'aktif', $wilayahId = null, $programId = null, $search = null, array $context = [])
    {
        $query = KeluargaPenerima::with([
            'wilayah.parent',
            'programBantuan',
            'user',
            'pendamping',
            'kampusMitra',
            'penilaianKemandirians' => function ($q) {
                $q->latest('id');
            },
        ]);

        if ($tab === 'mandiri') {
            $query->mandiri();
        } elseif ($tab === 'aktif') {
            $query->penerimaAktif();
        }

        // Role-based scoping
        $role = $context['role'] ?? 'pemda';
        if ($role === 'kampus' && !empty($context['kampus_id'])) {
            $kampusId = $context['kampus_id'];
            $query->where(function ($q) use ($kampusId, $context) {
                $q->where('kampus_id', $kampusId);
                if (!empty($context['wilayah_binaan'])) {
                    $q->orWhereHas('wilayah', function ($w) use ($context) {
                        $w->where('nama', $context['wilayah_binaan']);
                    });
                }
            });
        } elseif ($role === 'pendamping' && !empty($context['pendamping_id'])) {
            $pendId = $context['pendamping_id'];
            $desaIds = $context['desa_ids'] ?? ($context['assigned_desa_ids'] ?? []);
            $query->where(function ($q) use ($pendId, $desaIds) {
                $q->where('pendamping_id', $pendId);
                if (!empty($desaIds)) {
                    $q->orWhereIn('wilayah_id', $desaIds);
                }
            });
        }

        if (!empty($wilayahId)) {
            $query->where('wilayah_id', $wilayahId);
        }

        if (!empty($programId)) {
            $query->where('program_bantuan_id', $programId);
        }

        $pendampingFilter = $context['pendamping_filter'] ?? null;
        if (!empty($pendampingFilter)) {
            if ($pendampingFilter === 'sudah') {
                $query->whereNotNull('pendamping_id');
            } elseif ($pendampingFilter === 'belum') {
                $query->whereNull('pendamping_id');
            } elseif (is_numeric($pendampingFilter)) {
                $query->where('pendamping_id', $pendampingFilter);
            }
        }

        if (!empty($search)) {
            $term = trim($search);
            $query->where(function ($q) use ($term) {
                $q->where('kepala_keluarga', 'like', "%{$term}%")
                  ->orWhere('nik', 'like', "%{$term}%")
                  ->orWhere('no_kk', 'like', "%{$term}%")
                  ->orWhere('alamat', 'like', "%{$term}%")
                  ->orWhereHas('pendamping', function($pq) use ($term) {
                      $pq->where('name', 'like', "%{$term}%");
                  });
            });
        }

        $penerimas = $query->latest('id')->get();
        $timestamp = date('Y-m-d_H-i-s');
        $tabTitle = ($tab === 'mandiri') ? 'Lulus_Mandiri' : (($tab === 'aktif') ? 'Aktif' : 'Semua');

        if ($role === 'kampus') {
            $prefix = 'Data_Penerima_Kampus_' . preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', $context['kampus_name'] ?? 'Mitra'));
        } elseif ($role === 'pendamping') {
            $prefix = 'Data_Penerima_Pendamping_' . preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', $context['pendamping_name'] ?? 'Petugas'));
        } else {
            $prefix = 'Data_Penerima_Bantuan_Bappeda';
        }

        $ext = match ($format) {
            'csv' => 'csv',
            'pdf' => 'pdf',
            default => 'xlsx',
        };
        $filename = "{$prefix}_{$tabTitle}_{$timestamp}.{$ext}";

        // Catat Audit Trail
        AuditLog::record(
            ucfirst($role) . ' Mengekspor Data Penerima Bantuan',
            'KeluargaPenerima',
            null,
            null,
            [
                'format' => $format,
                'tab' => $tab,
                'role' => $role,
                'total_baris' => $penerimas->count(),
                'filename' => $filename,
            ]
        );

        if ($format === 'csv') {
            return $this->streamCsvExport($penerimas, $filename);
        }

        if ($format === 'pdf') {
            return $this->streamPdfExport($penerimas, $filename, $tabTitle, $context);
        }

        return $this->streamXlsxExport($penerimas, $filename, $tabTitle, $context);
    }

    /**
     * Format satu baris data penerima secara seragam untuk XLSX, CSV, dan PDF
     * tanpa menyertakan angka desil.
     */
    protected function formatExportRow($item): array
    {
        $noWaRaw = trim((string) ($item->no_hp ?: ($item->user->no_hp ?? '')));
        $noWa = $noWaRaw !== '' ? $noWaRaw : '-';

        $latestPenilaian = $item->relationLoaded('penilaianKemandirians')
            ? $item->penilaianKemandirians->first()
            : null;

        if ($latestPenilaian && $latestPenilaian->total_skor !== null) {
            $indikatorKemandirian = 'Skor: ' . $latestPenilaian->total_skor . '/100';
            if (!empty($latestPenilaian->status_perkembangan)) {
                $indikatorKemandirian .= ' (' . $latestPenilaian->status_perkembangan . ')';
            }
        } else {
            $indikatorKemandirian = 'Belum Dinilai';
        }

        $statusKemandirian = $item->status_kemandirian ?: 'Belum Dinilai';
        if ($statusKemandirian === 'Penurunan Desil') {
            $statusKemandirian = 'Butuh Perhatian Khusus';
        }

        return [
            'no_kk' => (string) ($item->no_kk ?? '-'),
            'nik' => (string) ($item->nik ?? '-'),
            'kepala_keluarga' => $item->kepala_keluarga ?? '-',
            'no_whatsapp' => $noWa,
            'alamat' => $item->alamat ?? '-',
            'desa' => $item->wilayah->nama ?? '-',
            'kecamatan' => $item->wilayah->parent->nama ?? '-',
            'program' => $item->programBantuan->nama_program ?? '-',
            'indikator_kemandirian' => $indikatorKemandirian,
            'status_kemandirian' => $statusKemandirian,
            'pendapatan' => (float) ($item->pendapatan_perbulan ?: ($item->penghasilan_perbulan ?? 0)),
            'status_validasi' => strtoupper($item->status_validasi ?? 'VALID'),
            'pendamping' => $item->pendamping->name ?? '-',
            'tgl_daftar' => $item->created_at ? $item->created_at->format('d/m/Y') : '-',
        ];
    }

    /**
     * Menghasilkan judul organisasi header laporan sesuai role pengekspor.
     */
    protected function resolveExportOrgTitle(array $context = []): string
    {
        $role = $context['role'] ?? 'pemda';
        if ($role === 'kampus') {
            return 'KAMPUS MITRA: ' . strtoupper($context['kampus_name'] ?? 'PERGURUAN TINGGI MITRA');
        }
        if ($role === 'pendamping') {
            return 'PENDAMPING LAPANGAN: ' . strtoupper($context['pendamping_name'] ?? 'TIM PENDAMPING');
        }
        return 'PEMERINTAH KABUPATEN SUMBAWA - BAPPEDA';
    }

    /**
     * Stream output dalam format PDF (.pdf) landscape A4.
     */
    protected function streamPdfExport($penerimas, $filename, $tabTitle, array $context = [])
    {
        $rows = $penerimas->map(fn ($item) => $this->formatExportRow($item))->values()->all();
        $subTitleOrg = $this->resolveExportOrgTitle($context);
        $exportedAt = date('d F Y H:i:s');

        $pdf = Pdf::loadView('exports.data_penerima_pdf', compact(
            'rows',
            'subTitleOrg',
            'tabTitle',
            'exportedAt'
        ));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download($filename);
    }

    /**
     * Stream output dalam format Excel (.xlsx) dengan styling rapi khas GemaSmart.
     */
    protected function streamXlsxExport($penerimas, $filename, $tabTitle, array $context = [])
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Penerima Bantuan');

        $subTitleOrg = $this->resolveExportOrgTitle($context);

        // Header Kolom Tabel
        $headers = [
            'No',
            'No. KK',
            'NIK Kepala Keluarga',
            'Nama Kepala Keluarga',
            'No. WhatsApp Penerima',
            'Alamat Lengkap',
            'Desa / Kelurahan',
            'Kecamatan',
            'Program Bantuan',
            'Indikator Kemandirian',
            'Status Kemandirian',
            'Pendapatan/bln (Rp)',
            'Status Validasi',
            'Pendamping Lapangan',
            'Tanggal Terdaftar'
        ];
        $totalCols = count($headers);
        $lastColLetter = Coordinate::stringFromColumnIndex($totalCols);

        // Judul Laporan di Sheet
        $sheet->setCellValue('A1', $subTitleOrg);
        $sheet->setCellValue('A2', 'DATABASE KELUARGA PENERIMA MANFAAT BANTUAN (' . strtoupper(str_replace('_', ' ', $tabTitle)) . ')');
        $sheet->setCellValue('A3', 'Diekspor pada: ' . date('d F Y H:i:s') . ' WITA | Total: ' . $penerimas->count() . ' KK');

        $sheet->mergeCells("A1:{$lastColLetter}1");
        $sheet->mergeCells("A2:{$lastColLetter}2");
        $sheet->mergeCells("A3:{$lastColLetter}3");

        $sheet->getStyle('A1:A2')->getFont()->setBold(true)->setSize(13);
        $sheet->getStyle('A3')->getFont()->setItalic(true)->setSize(10)->getColor()->setRGB('555555');

        $headerRow = 5;
        foreach ($headers as $colIdx => $header) {
            $colLetter = Coordinate::stringFromColumnIndex($colIdx + 1);
            $sheet->setCellValueExplicit($colLetter . $headerRow, $header, DataType::TYPE_STRING);
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
                'startColor' => ['rgb' => '00450D'], // Gov Green
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => false,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CBD5E1'],
                ],
            ],
        ];
        $sheet->getStyle("A5:{$lastColLetter}5")->applyFromArray($headerStyle);
        $sheet->getRowDimension(5)->setRowHeight(32);
        $sheet->freezePane('A6');

        // Isi Data Baris
        $row = 6;
        $no = 1;
        foreach ($penerimas as $item) {
            $r = $this->formatExportRow($item);

            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValueExplicit('B' . $row, $r['no_kk'], DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('C' . $row, $r['nik'], DataType::TYPE_STRING);
            $sheet->setCellValue('D' . $row, $r['kepala_keluarga']);
            $sheet->setCellValueExplicit('E' . $row, $r['no_whatsapp'], DataType::TYPE_STRING);
            $sheet->setCellValue('F' . $row, $r['alamat']);
            $sheet->setCellValue('G' . $row, $r['desa']);
            $sheet->setCellValue('H' . $row, $r['kecamatan']);
            $sheet->setCellValue('I' . $row, $r['program']);
            $sheet->setCellValue('J' . $row, $r['indikator_kemandirian']);
            $sheet->setCellValue('K' . $row, $r['status_kemandirian']);
            $sheet->setCellValue('L' . $row, $r['pendapatan']);
            $sheet->setCellValue('M' . $row, $r['status_validasi']);
            $sheet->setCellValue('N' . $row, $r['pendamping']);
            $sheet->setCellValue('O' . $row, $r['tgl_daftar']);

            $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B' . $row . ':C' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('E' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('J' . $row . ':K' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('M' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('O' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            $sheet->getStyle('L' . $row)->getNumberFormat()->setFormatCode('#,##0');

            if ($no % 2 === 0) {
                $sheet->getStyle("A{$row}:{$lastColLetter}{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F8FAFC');
            }

            $no++;
            $row++;
        }

        $lastRow = $row - 1;
        if ($lastRow >= 6) {
            $sheet->getStyle("A5:{$lastColLetter}{$lastRow}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setRGB('E2E8F0');
        }

        foreach (range(1, $totalCols) as $colIdx) {
            $colLetter = Coordinate::stringFromColumnIndex($colIdx);
            $sheet->getColumnDimension($colLetter)->setAutoSize(true);
        }
        $sheet->calculateColumnWidths();
        foreach ($headers as $colIdx => $header) {
            $colLetter = Coordinate::stringFromColumnIndex($colIdx + 1);
            $minWidth = mb_strlen($header) + 6;
            $currentWidth = $sheet->getColumnDimension($colLetter)->getWidth();
            if ($currentWidth < $minWidth) {
                $sheet->getColumnDimension($colLetter)->setAutoSize(false);
                $sheet->getColumnDimension($colLetter)->setWidth($minWidth);
            }
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
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, [
                'No',
                'No KK',
                'NIK',
                'Kepala Keluarga',
                'No. WhatsApp Penerima',
                'Alamat',
                'Desa',
                'Kecamatan',
                'Program Bantuan',
                'Indikator Kemandirian',
                'Status Kemandirian',
                'Pendapatan Perbulan',
                'Status Validasi',
                'Pendamping',
                'Tanggal Terdaftar'
            ]);

            $no = 1;
            foreach ($penerimas as $item) {
                $r = $this->formatExportRow($item);
                fputcsv($handle, [
                    $no++,
                    "'" . ($item->no_kk ?? ''),
                    "'" . ($item->nik ?? ''),
                    $r['kepala_keluarga'],
                    $r['no_whatsapp'] !== '-' ? "'" . $r['no_whatsapp'] : '-',
                    $r['alamat'],
                    $r['desa'],
                    $r['kecamatan'],
                    $r['program'],
                    $r['indikator_kemandirian'],
                    $r['status_kemandirian'],
                    $r['pendapatan'],
                    $r['status_validasi'],
                    $r['pendamping'],
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
    public function downloadTemplate($format = 'xlsx', array $context = [])
    {
        $role = $context['role'] ?? 'pemda';
        $filename = "Template_Impor_Penerima_" . ucfirst($role) . "." . ($format === 'csv' ? 'csv' : 'xlsx');

        if ($format === 'csv') {
            return new StreamedResponse(function () {
                $handle = fopen('php://output', 'w');
                fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

                fputcsv($handle, [
                    'no_kk',
                    'nik',
                    'kepala_keluarga',
                    'no_whatsapp',
                    'alamat',
                    'nama_desa',
                    'nama_program',
                    'indikator_kemandirian',
                    'pendapatan_perbulan',
                    'status_validasi'
                ]);

                // Contoh 1
                fputcsv($handle, [
                    '5204010101900001',
                    '5204010101900001',
                    'Ahmad Dahlan',
                    '085234567890',
                    'Dusun Empang RT 01 RW 02',
                    'Empang Atas',
                    'Pemberdayaan Bibit Jagung Hibrida',
                    '2',
                    '1200000',
                    'valid'
                ]);

                // Contoh 2
                fputcsv($handle, [
                    '5204010101900002',
                    '5204010101900002',
                    'Siti Aminah',
                    '085234567891',
                    'Jl. Lintas Sumbawa RT 03',
                    'Plampang',
                    'Bantuan Bibit Hortikultura Buah',
                    '3',
                    '1500000',
                    'valid'
                ]);

                fclose($handle);
            }, 200, [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Cache-Control' => 'max-age=0',
            ]);
        }

        $spreadsheet = new Spreadsheet();
        
        // Sheet 1: Template Pengisian Data
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Template_Impor');

        $headers = [
            'no_kk',
            'nik',
            'kepala_keluarga',
            'no_whatsapp',
            'alamat',
            'nama_desa',
            'nama_program',
            'indikator_kemandirian',
            'pendapatan_perbulan',
            'status_validasi'
        ];

        foreach ($headers as $colIdx => $h) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx + 1);
            $sheet->setCellValue($colLetter . '1', $h);
        }

        // Style Header
        $sheet->getStyle('A1:J1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '00450D']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(26);

        // Contoh Data Baris 2
        $sheet->setCellValueExplicit('A2', '5204010101900001', DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('B2', '5204010101900001', DataType::TYPE_STRING);
        $sheet->setCellValue('C2', 'Ahmad Dahlan');
        $sheet->setCellValueExplicit('D2', '085234567890', DataType::TYPE_STRING);
        $sheet->setCellValue('E2', 'Dusun Empang RT 01 RW 02');
        $sheet->setCellValue('F2', 'Empang Atas');
        $sheet->setCellValue('G2', 'Pemberdayaan Bibit Jagung Hibrida');
        $sheet->setCellValue('H2', 2);
        $sheet->setCellValue('I2', 1200000);
        $sheet->setCellValue('J2', 'valid');

        // Contoh Data Baris 3
        $sheet->setCellValueExplicit('A3', '5204010101900002', DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('B3', '5204010101900002', DataType::TYPE_STRING);
        $sheet->setCellValue('C3', 'Siti Aminah');
        $sheet->setCellValueExplicit('D3', '085234567891', DataType::TYPE_STRING);
        $sheet->setCellValue('E3', 'Jl. Lintas Sumbawa RT 03');
        $sheet->setCellValue('F3', 'Plampang');
        $sheet->setCellValue('G3', 'Bantuan Bibit Hortikultura Buah');
        $sheet->setCellValue('H3', 3);
        $sheet->setCellValue('I3', 1500000);
        $sheet->setCellValue('J3', 'valid');

        foreach (range(1, 10) as $colIdx) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx);
            $sheet->getColumnDimension($colLetter)->setAutoSize(true);
        }

        // Sheet 2: Referensi Wilayah & Program
        $refSheet = $spreadsheet->createSheet();
        $refSheet->setTitle('Referensi_Desa_dan_Program');

        $refSheet->setCellValue('A1', 'Daftar Desa Aktif (Kab. Sumbawa)');
        $refSheet->setCellValue('B1', 'Kecamatan');
        $refSheet->mergeCells('A1:B1');
        $refSheet->getStyle('A1')->getFont()->setBold(true);

        $refSheet->setCellValue('A2', 'Nama Desa');
        $refSheet->setCellValue('B2', 'Kecamatan');
        $refSheet->getStyle('A2:B2')->getFont()->setBold(true);

        $desasQuery = Wilayah::where('jenis', 'desa')->with('parent')->where('is_aktif', true);
        if ($role === 'pendamping' && !empty($context['desa_ids'])) {
            $desasQuery->whereIn('id', $context['desa_ids']);
        }
        $desas = $desasQuery->orderBy('nama')->take(50)->get();

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
        $refSheet->setCellValue('E2', 'Target KK');
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
     * Proses Impor File Excel/CSV Data Penerima Bantuan dengan PROTEKSI ANTI-DUPLIKASI KETAT.
     * Mencegah duplikasi NIK & No KK baik di dalam file spreadsheet maupun terhadap database.
     */
    public function import($file, $duplicateMode = 'skip', array $context = [])
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
            } elseif (in_array($normalized, ['nowa', 'nowhatsapp', 'nowhatsapppenerima', 'whatsapp', 'nohp', 'nohppenerima', 'hp', 'telepon', 'notelp'])) {
                $columnMap['no_hp'] = $colLetter;
            } elseif (in_array($normalized, ['alamat', 'alamatrumah', 'dusun', 'domisili'])) {
                $columnMap['alamat'] = $colLetter;
            } elseif (in_array($normalized, ['namadesa', 'desa', 'kelurahan', 'wilayah', 'desakelurahan'])) {
                $columnMap['nama_desa'] = $colLetter;
            } elseif (in_array($normalized, ['namaprogram', 'program', 'programbantuan', 'bantuan'])) {
                $columnMap['nama_program'] = $colLetter;
            } elseif (in_array($normalized, ['desil', 'desilkemiskinan', 'tingkatdesil', 'tingkatkemandirian', 'tingkat', 'indikator', 'indikatorkemandirian', 'skor'])) {
                $columnMap['desil'] = $colLetter;
            } elseif (in_array($normalized, ['pendapatan', 'penghasilan', 'penghasilanperbulan', 'pendapatanperbulan', 'gaji'])) {
                $columnMap['pendapatan_perbulan'] = $colLetter;
            } elseif (in_array($normalized, ['statusvalidasi', 'validasi', 'status'])) {
                $columnMap['status_validasi'] = $colLetter;
            }
        }

        // Validasi kolom wajib
        if (!isset($columnMap['nik']) || !isset($columnMap['kepala_keluarga'])) {
            return [
                'success' => false,
                'message' => 'Format kolom file tidak valid. Pastikan terdapat kolom NIK dan Nama Kepala Keluarga pada baris pertama template.',
                'stats' => ['total' => 0, 'new' => 0, 'updated' => 0, 'skipped' => 0, 'errors' => []],
            ];
        }

        $activeDesas = Wilayah::where('jenis', 'desa')->where('is_aktif', true)->get();
        $activePrograms = ProgramBantuan::where('status', 'aktif')->get();
        $fallbackDesa = $activeDesas->first();
        $fallbackProgram = $activePrograms->first();

        $role = $context['role'] ?? 'pemda';
        $scopeKampusId = $context['kampus_id'] ?? null;
        $scopePendampingId = $context['pendamping_id'] ?? null;

        $stats = [
            'total' => 0,
            'new' => 0,
            'updated' => 0,
            'skipped' => 0,
            'errors' => [],
        ];

        // SET PENGECEKAN DUPLIKASI DALAM FILE UPLOAD (In-file deduplication)
        $seenNiksInFile = [];
        $seenNoKksInFile = [];

        DB::beginTransaction();
        try {
            $line = 2; // Baris data dimulai dari baris 2
            foreach ($rows as $row) {
                $nikRaw = isset($columnMap['nik']) ? $row[$columnMap['nik']] : null;
                $namaRaw = isset($columnMap['kepala_keluarga']) ? $row[$columnMap['kepala_keluarga']] : null;

                if (empty($nikRaw) && empty($namaRaw)) {
                    $line++;
                    continue;
                }

                $stats['total']++;

                // Bersihkan NIK & No KK
                $nik = $this->sanitizeNumberString($nikRaw);
                $noKk = isset($columnMap['no_kk']) ? $this->sanitizeNumberString($row[$columnMap['no_kk']]) : $nik;
                $kepalaKeluarga = trim((string)$namaRaw);
                $alamat = isset($columnMap['alamat']) ? trim((string)$row[$columnMap['alamat']]) : '-';

                if (empty($nik) || strlen($nik) < 8) {
                    $stats['errors'][] = "Baris {$line}: NIK '{$nikRaw}' tidak valid (harus 8-16 digit angka).";
                    $line++;
                    continue;
                }

                if (empty($kepalaKeluarga)) {
                    $stats['errors'][] = "Baris {$line}: Nama Kepala Keluarga tidak boleh kosong.";
                    $line++;
                    continue;
                }

                // 1. CEK DUPLIKASI DI DALAM FILE (Anti-duplikasi baris yang sama di berkas upload)
                if (isset($seenNiksInFile[$nik])) {
                    $prevLine = $seenNiksInFile[$nik];
                    $stats['skipped']++;
                    $stats['errors'][] = "Baris {$line}: NIK '{$nik}' duplikat dengan baris {$prevLine} di dalam berkas ini. Dilewati agar data tidak ganda.";
                    $line++;
                    continue;
                }
                $seenNiksInFile[$nik] = $line;

                if (!empty($noKk) && strlen($noKk) >= 10 && isset($seenNoKksInFile[$noKk])) {
                    $prevLine = $seenNoKksInFile[$noKk];
                    $stats['skipped']++;
                    $stats['errors'][] = "Baris {$line}: Nomor KK '{$noKk}' duplikat dengan baris {$prevLine} di dalam berkas ini. Dilewati agar data tidak ganda.";
                    $line++;
                    continue;
                }
                if (!empty($noKk) && strlen($noKk) >= 10) {
                    $seenNoKksInFile[$noKk] = $line;
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

                // Nomor WhatsApp Penerima (opsional)
                $noHpRaw = isset($columnMap['no_hp']) ? $this->sanitizeNumberString($row[$columnMap['no_hp']]) : '';
                if (!empty($noHpRaw) && str_starts_with($noHpRaw, '08')) {
                    $noHpRaw = '62' . substr($noHpRaw, 1);
                }
                $noHp = !empty($noHpRaw) ? $noHpRaw : null;

                // Indikator Kemandirian (1-10)
                $desilRaw = isset($columnMap['desil']) ? $row[$columnMap['desil']] : 1;
                $desil = (int) $desilRaw;
                if ($desil < 1) $desil = 1;
                if ($desil > 10) $desil = 10;

                // Status Kemandirian Otomatis: Indikator Kemandirian 6+ adalah Mandiri
                $statusKemandirian = ($desil >= 6) ? 'Mandiri' : 'Belum Dinilai';

                // Pendapatan perbulan
                $pendapatanRaw = isset($columnMap['pendapatan_perbulan']) ? $row[$columnMap['pendapatan_perbulan']] : 0;
                $pendapatan = (float) preg_replace('/[^0-9.]/', '', (string)$pendapatanRaw);

                // Status validasi
                $validasiRaw = isset($columnMap['status_validasi']) ? strtolower(trim((string)$row[$columnMap['status_validasi']])) : 'valid';
                $statusValidasi = in_array($validasiRaw, ['valid', 'proses_lapangan', 'menunggu_validasi', 'anomali']) ? $validasiRaw : 'valid';

                // 2. CEK DUPLIKASI TERHADAP DATABASE SECARA TERPISAH (Termasuk Soft Deleted Records)
                $existingByNik = KeluargaPenerima::withTrashed()->with('wilayah')->where('nik', $nik)->first();
                $existingByKk = (!empty($noKk) && strlen($noKk) >= 10)
                    ? KeluargaPenerima::withTrashed()->with('wilayah')->where('no_kk', $noKk)->first()
                    : null;

                if ($duplicateMode === 'skip') {
                    if ($existingByNik) {
                        $desa = $existingByNik->wilayah ? $existingByNik->wilayah->nama : 'Sumbawa';
                        $stats['skipped']++;
                        $stats['errors'][] = "Baris {$line}: NIK '{$nik}' sudah terdaftar atas nama {$existingByNik->kepala_keluarga} (Desa {$desa}). Dilewati demi mencegah duplikasi.";
                        $line++;
                        continue;
                    }
                    if ($existingByKk) {
                        $desa = $existingByKk->wilayah ? $existingByKk->wilayah->nama : 'Sumbawa';
                        $stats['skipped']++;
                        $stats['errors'][] = "Baris {$line}: Nomor KK '{$noKk}' sudah terdaftar atas nama {$existingByKk->kepala_keluarga} (Desa {$desa}). Dilewati demi mencegah duplikasi.";
                        $line++;
                        continue;
                    }
                }

                $existing = $existingByNik ?: $existingByKk;

                if ($existing) {
                    // Deteksi konflik silang: NIK milik keluarga A, KK milik keluarga B
                    if ($existingByNik && $existingByKk && $existingByNik->id !== $existingByKk->id) {
                        $stats['skipped']++;
                        $stats['errors'][] = "Baris {$line}: Konflik identitas silang — NIK '{$nik}' milik {$existingByNik->kepala_keluarga}, namun No KK '{$noKk}' milik {$existingByKk->kepala_keluarga}. Baris dilewati demi integritas data.";
                        $line++;
                        continue;
                    }

                    // Mode update: perbarui data yang ada tanpa membuat entri ganda
                    if ($existing->trashed()) {
                        $existing->restore();
                    }

                    $updateData = [
                        'kepala_keluarga' => $kepalaKeluarga,
                        'no_hp' => $noHp ?: $existing->no_hp,
                        'alamat' => $alamat ?: $existing->alamat,
                        'wilayah_id' => $wilayahId ?: $existing->wilayah_id,
                        'program_bantuan_id' => $programId ?: $existing->program_bantuan_id,
                        'desil' => $desil,
                        'penghasilan_perbulan' => $pendapatan > 0 ? $pendapatan : $existing->penghasilan_perbulan,
                        'pendapatan_perbulan' => $pendapatan > 0 ? $pendapatan : ($existing->pendapatan_perbulan ?: $existing->penghasilan_perbulan),
                        'pendapatan' => $pendapatan > 0 ? $pendapatan : ($existing->pendapatan ?: $existing->penghasilan_perbulan),
                        'status_kemandirian' => $statusKemandirian,
                        'status_validasi' => $statusValidasi,
                    ];

                    // Hanya perbarui no_kk jika tidak menyebabkan tabrakan dengan record lain
                    if (!empty($noKk) && strlen($noKk) >= 10) {
                        $collisionCheck = KeluargaPenerima::withTrashed()
                            ->where('no_kk', $noKk)
                            ->where('id', '!=', $existing->id)
                            ->exists();
                        if (!$collisionCheck) {
                            $updateData['no_kk'] = $noKk;
                        }
                    }

                    if ($role === 'pendamping' && $scopePendampingId) {
                        $updateData['pendamping_id'] = $scopePendampingId;
                    }
                    if ($scopeKampusId) {
                        $updateData['kampus_id'] = $scopeKampusId;
                    }

                    $existing->update($updateData);

                    if ($existing->user) {
                        $userUpdate = ['name' => $kepalaKeluarga];
                        if ($noHp) {
                            $userUpdate['no_hp'] = $noHp;
                        }
                        $existing->user->update($userUpdate);
                    }

                    $stats['updated']++;
                } else {
                    // Buat Akun User Penerima Otomatis jika belum ada
                    $userEmail = $nik . '@penerima.com';
                    $user = User::firstOrCreate(
                        ['email' => $userEmail],
                        [
                            'name' => $kepalaKeluarga,
                            'no_hp' => $noHp,
                            'password' => Hash::make($noKk),
                            'role' => 'penerima',
                        ]
                    );

                    $insertData = [
                        'no_kk' => $noKk,
                        'nik' => $nik,
                        'kepala_keluarga' => $kepalaKeluarga,
                        'no_hp' => $noHp,
                        'alamat' => $alamat,
                        'wilayah_id' => $wilayahId,
                        'program_bantuan_id' => $programId,
                        'desil' => $desil,
                        'tipe_periode' => 'per_bulan',
                        'pendapatan' => $pendapatan,
                        'pengeluaran' => 0,
                        'pendapatan_perbulan' => $pendapatan,
                        'pengeluaran_perbulan' => 0,
                        'penghasilan_bersih' => $pendapatan,
                        'penghasilan_perbulan' => $pendapatan,
                        'status_kemandirian' => $statusKemandirian,
                        'status_validasi' => $statusValidasi,
                        'user_id' => $user->id,
                        'kampus_id' => $scopeKampusId,
                        'pendamping_id' => $scopePendampingId,
                    ];

                    KeluargaPenerima::create($insertData);
                    $stats['new']++;
                }

                $line++;
            }

            DB::commit();

            // Catat Audit Log
            AuditLog::record(
                ucfirst($role) . ' Mengimpor Data Penerima Bantuan (Excel/CSV)',
                'KeluargaPenerima',
                null,
                null,
                [
                    'role' => $role,
                    'total_dibaca' => $stats['total'],
                    'sukses_baru' => $stats['new'],
                    'sukses_diperbarui' => $stats['updated'],
                    'dilewati' => $stats['skipped'],
                    'jumlah_catatan' => count($stats['errors']),
                    'mode' => $duplicateMode,
                ]
            );

            return [
                'success' => true,
                'message' => "Proses impor selesai. Berhasil menambahkan {$stats['new']} data baru dan memperbarui {$stats['updated']} data. " . ($stats['skipped'] > 0 ? "({$stats['skipped']} data dilewati demi mencegah duplikasi). " : ""),
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

        if (is_numeric($str) && (str_contains(strtoupper($str), 'E+') || str_contains(strtoupper($str), 'E-'))) {
            return number_format((float)$str, 0, '', '');
        }

        return preg_replace('/[^0-9]/', '', $str);
    }
}
