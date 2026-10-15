<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PeriodFilterHelper
{
    /**
     * Parse date range filter from Request or parameters.
     * Supports:
     * - Custom Date Range: start_date & end_date (e.g. 2026-09-08 s/d 2026-10-20)
     * - Predefined periods: 'hari', '3hari', 'minggu', 'minggu_1_2', 'bulan', 'tahun', 'semua'
     * - Specific month & year: bulan (1-12), tahun (e.g. 2026)
     */
    public static function parseRequest(Request $request): array
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $periode = $request->query('periode');
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');
        $minggu = $request->query('minggu');

        return self::resolveRange($startDate, $endDate, $periode, $bulan, $tahun, $minggu);
    }

    /**
     * Resolve date range and generate readable label.
     */
    public static function resolveRange(?string $startDate = null, ?string $endDate = null, ?string $periode = null, ?string $bulan = null, ?string $tahun = null, ?string $minggu = null): array
    {
        $now = Carbon::now();
        $tahunSelected = !empty($tahun) ? (int)$tahun : $now->year;

        // 1. Prioritas Utama: Custom Date Range (misal: tgl 8 bulan 9 sampai tgl 20 bulan 10)
        if (!empty($startDate) && !empty($endDate)) {
            try {
                $start = Carbon::parse($startDate)->startOfDay();
                $end = Carbon::parse($endDate)->endOfDay();

                // Jika tanggal terbalik, tukar posisinya
                if ($start->gt($end)) {
                    $temp = $start;
                    $start = $end->startOfDay();
                    $end = $temp->endOfDay();
                }

                return [
                    'start' => $start,
                    'end' => $end,
                    'start_date' => $start->toDateString(),
                    'end_date' => $end->toDateString(),
                    'key' => 'custom',
                    'periode' => 'custom',
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    'minggu' => $minggu,
                    'label' => $start->translatedFormat('d M Y') . ' s/d ' . $end->translatedFormat('d M Y'),
                    'is_filtered' => true,
                ];
            } catch (\Exception $e) {
                // Lanjut ke fallback jika parsing gagal
            }
        }

        // 2. Hanya tanggal mulai yang diisi
        if (!empty($startDate) && empty($endDate)) {
            try {
                $start = Carbon::parse($startDate)->startOfDay();
                $end = $now->copy()->endOfDay();
                return [
                    'start' => $start,
                    'end' => $end,
                    'start_date' => $start->toDateString(),
                    'end_date' => $end->toDateString(),
                    'key' => 'custom',
                    'periode' => 'custom',
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    'minggu' => $minggu,
                    'label' => 'Mulai ' . $start->translatedFormat('d M Y') . ' s/d Sekarang',
                    'is_filtered' => true,
                ];
            } catch (\Exception $e) {
                // Fallback
            }
        }

        // 3. Pilihan Bulan Tertentu (misal: Bulan 9 / September dengan opsi minggu tertentu)
        if (!empty($bulan) && is_numeric($bulan) && $bulan >= 1 && $bulan <= 12) {
            $monthCarbon = Carbon::createFromDate($tahunSelected, (int)$bulan, 1);

            if ($minggu === '1_2') {
                $start = $monthCarbon->copy()->startOfMonth();
                $end = $monthCarbon->copy()->startOfMonth()->addDays(13)->endOfDay();
                $label = 'Minggu 1 & 2 ' . $monthCarbon->translatedFormat('F Y');
            } elseif ($minggu === '3_4') {
                $start = $monthCarbon->copy()->startOfMonth()->addDays(14)->startOfDay();
                $end = $monthCarbon->copy()->endOfMonth();
                $label = 'Minggu 3 & 4 ' . $monthCarbon->translatedFormat('F Y');
            } elseif ($minggu === '1') {
                $start = $monthCarbon->copy()->startOfMonth();
                $end = $monthCarbon->copy()->startOfMonth()->addDays(6)->endOfDay();
                $label = 'Minggu Ke-1 ' . $monthCarbon->translatedFormat('F Y');
            } elseif ($minggu === '2') {
                $start = $monthCarbon->copy()->startOfMonth()->addDays(7)->startOfDay();
                $end = $monthCarbon->copy()->startOfMonth()->addDays(13)->endOfDay();
                $label = 'Minggu Ke-2 ' . $monthCarbon->translatedFormat('F Y');
            } else {
                $start = $monthCarbon->copy()->startOfMonth();
                $end = $monthCarbon->copy()->endOfMonth();
                $label = 'Bulan ' . $monthCarbon->translatedFormat('F Y');
            }

            return [
                'start' => $start,
                'end' => $end,
                'start_date' => $start->toDateString(),
                'end_date' => $end->toDateString(),
                'key' => 'bulan_spesifik',
                'periode' => 'bulan',
                'bulan' => (int)$bulan,
                'tahun' => $tahunSelected,
                'minggu' => $minggu,
                'label' => $label,
                'is_filtered' => true,
            ];
        }

        // 4. Pilihan Tahun Tertentu (jika hanya tahun tanpa bulan)
        if (!empty($tahun) && empty($periode) && empty($startDate)) {
            $start = Carbon::createFromDate($tahunSelected, 1, 1)->startOfYear();
            $end = Carbon::createFromDate($tahunSelected, 12, 31)->endOfYear();

            return [
                'start' => $start,
                'end' => $end,
                'start_date' => $start->toDateString(),
                'end_date' => $end->toDateString(),
                'key' => 'tahun_spesifik',
                'periode' => 'tahun',
                'bulan' => null,
                'tahun' => $tahunSelected,
                'minggu' => null,
                'label' => 'Tahun ' . $tahunSelected,
                'is_filtered' => true,
            ];
        }

        // 5. Preset Periode Kata Kunci ('hari', '3hari', 'minggu', 'minggu_1_2', 'bulan', 'tahun')
        $p = strtolower(trim($periode ?? 'semua'));
        switch ($p) {
            case 'hari':
                $start = $now->copy()->startOfDay();
                $end = $now->copy()->endOfDay();
                return [
                    'start' => $start,
                    'end' => $end,
                    'start_date' => $start->toDateString(),
                    'end_date' => $end->toDateString(),
                    'key' => 'hari',
                    'periode' => 'hari',
                    'bulan' => null,
                    'tahun' => null,
                    'label' => 'Hari Ini (' . $now->translatedFormat('d M Y') . ')',
                    'is_filtered' => true,
                ];

            case '3hari':
                // Mengambil 3 hari terakhir (misal hari ini dan 2 hari sebelumnya)
                $start = $now->copy()->subDays(2)->startOfDay();
                $end = $now->copy()->endOfDay();
                return [
                    'start' => $start,
                    'end' => $end,
                    'start_date' => $start->toDateString(),
                    'end_date' => $end->toDateString(),
                    'key' => '3hari',
                    'periode' => '3hari',
                    'bulan' => null,
                    'tahun' => null,
                    'label' => '3 Hari Terakhir (' . $start->format('d M') . ' - ' . $end->format('d M Y') . ')',
                    'is_filtered' => true,
                ];

            case 'minggu':
                $start = $now->copy()->startOfWeek();
                $end = $now->copy()->endOfWeek();
                return [
                    'start' => $start,
                    'end' => $end,
                    'start_date' => $start->toDateString(),
                    'end_date' => $end->toDateString(),
                    'key' => 'minggu',
                    'periode' => 'minggu',
                    'bulan' => null,
                    'tahun' => null,
                    'label' => 'Minggu Ini (' . $start->format('d M') . ' - ' . $end->format('d M Y') . ')',
                    'is_filtered' => true,
                ];

            case 'minggu_1_2':
                // Minggu 1 & 2 dari bulan berjalan (tgl 1 s/d tgl 14)
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->startOfMonth()->addDays(13)->endOfDay();
                return [
                    'start' => $start,
                    'end' => $end,
                    'start_date' => $start->toDateString(),
                    'end_date' => $end->toDateString(),
                    'key' => 'minggu_1_2',
                    'periode' => 'minggu_1_2',
                    'bulan' => null,
                    'tahun' => null,
                    'label' => 'Minggu 1 & 2 (' . $start->format('d M') . ' - ' . $end->format('d M Y') . ')',
                    'is_filtered' => true,
                ];

            case 'bulan':
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
                return [
                    'start' => $start,
                    'end' => $end,
                    'start_date' => $start->toDateString(),
                    'end_date' => $end->toDateString(),
                    'key' => 'bulan',
                    'periode' => 'bulan',
                    'bulan' => $now->month,
                    'tahun' => $now->year,
                    'label' => 'Bulan Ini (' . $now->translatedFormat('F Y') . ')',
                    'is_filtered' => true,
                ];

            case 'tahun':
                $start = $now->copy()->startOfYear();
                $end = $now->copy()->endOfYear();
                return [
                    'start' => $start,
                    'end' => $end,
                    'start_date' => $start->toDateString(),
                    'end_date' => $end->toDateString(),
                    'key' => 'tahun',
                    'periode' => 'tahun',
                    'bulan' => null,
                    'tahun' => $now->year,
                    'label' => 'Tahun ' . $now->year,
                    'is_filtered' => true,
                ];

            default:
                return [
                    'start' => null,
                    'end' => null,
                    'start_date' => null,
                    'end_date' => null,
                    'key' => 'semua',
                    'periode' => 'semua',
                    'bulan' => null,
                    'tahun' => null,
                    'label' => 'Semua Periode',
                    'is_filtered' => false,
                ];
        }
    }

    /**
     * Backward-compatibility helper for getPeriodRange(?string $periode).
     */
    public static function getPeriodRange(?string $periode): array
    {
        return self::resolveRange(null, null, $periode, null, null);
    }

    /**
     * Apply date range filter to an Eloquent Builder or Relation.
     */
    public static function applyFilter($query, array $periodInfo, string $column = 'created_at')
    {
        if (!empty($periodInfo['start']) && !empty($periodInfo['end'])) {
            $query->whereBetween($column, [$periodInfo['start'], $periodInfo['end']]);
        }
        return $query;
    }

    /**
     * Apply date range filter to a date-only column (e.g. 'tgl_penyaluran', 'tanggal_lapor').
     */
    public static function applyDateFilter($query, array $periodInfo, string $column)
    {
        if (!empty($periodInfo['start_date']) && !empty($periodInfo['end_date'])) {
            $query->whereBetween($column, [$periodInfo['start_date'], $periodInfo['end_date']]);
        }
        return $query;
    }
}
