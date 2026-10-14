<?php

namespace App\Services;

class DesilCalculatorService
{
    /**
     * Hitung penilaian desil dan kemandirian berdasarkan indikator sosial ekonomi keluarga.
     *
     * @param float $penghasilanPerbulan
     * @param int $jumlahAnak
     * @param string $asetRumah (tidak_layak, semi_permanen, permanen)
     * @param string $asetTanah (tidak_ada, sempit, sedang, luas)
     * @param string $asetKendaraan (tidak_ada, motor_tua, motor_layak, mobil)
     * @param int|null $desilSebelumnya
     * @return array
     */
    public static function hitung(
        float $penghasilanPerbulan,
        int $jumlahAnak,
        string $asetRumah,
        string $asetTanah,
        string $asetKendaraan,
        ?int $desilSebelumnya = null
    ): array {
        // 1. Total Anggota Keluarga (Kepala Keluarga + Pasangan + Jumlah Anak)
        $totalAnggota = max(1, $jumlahAnak + 2);
        $pendapatanPerKapita = $penghasilanPerbulan / $totalAnggota;

        // 2. Base Desil dari Penghasilan Bulanan Keluarga
        // Mengacu pada standar desil pengeluaran & pendapatan BPS / Kemensos DTSK
        if ($penghasilanPerbulan < 1000000) {
            $baseDesil = 1;
            $kategoriDesil = 'Desil 1 (Sangat Miskin / Ekstrem)';
        } elseif ($penghasilanPerbulan < 1800000) {
            $baseDesil = 2;
            $kategoriDesil = 'Desil 2 (Miskin)';
        } elseif ($penghasilanPerbulan < 2700000) {
            $baseDesil = 3;
            $kategoriDesil = 'Desil 3 (Hampir Miskin)';
        } elseif ($penghasilanPerbulan < 3800000) {
            $baseDesil = 4;
            $kategoriDesil = 'Desil 4 (Rentan Miskin)';
        } elseif ($penghasilanPerbulan < 5000000) {
            $baseDesil = 5;
            $kategoriDesil = 'Desil 5 (Menengah Bawah)';
        } elseif ($penghasilanPerbulan < 6500000) {
            $baseDesil = 6;
            $kategoriDesil = 'Desil 6 (Menengah / Mandiri Awal)';
        } elseif ($penghasilanPerbulan < 8500000) {
            $baseDesil = 7;
            $kategoriDesil = 'Desil 7 (Menengah Mapan)';
        } elseif ($penghasilanPerbulan < 12000000) {
            $baseDesil = 8;
            $kategoriDesil = 'Desil 8 (Menengah Atas)';
        } elseif ($penghasilanPerbulan < 18000000) {
            $baseDesil = 9;
            $kategoriDesil = 'Desil 9 (Mapan)';
        } else {
            $baseDesil = 10;
            $kategoriDesil = 'Desil 10 (Sangat Mapan / Sejahtera)';
        }

        // 3. Evaluasi Skor & Penyesuaian Aset
        $poinAset = 0;

        // Aset Rumah
        switch ($asetRumah) {
            case 'permanen':
                $skorRumah = 90;
                $labelRumah = 'Permanen Layak Huni (Tembok & Keramik)';
                $poinAset += 2;
                break;
            case 'semi_permanen':
                $skorRumah = 50;
                $labelRumah = 'Semi Permanen (Setengah Tembok / Plester)';
                $poinAset += 1;
                break;
            case 'tidak_layak':
            default:
                $skorRumah = 15;
                $labelRumah = 'Tidak Layak Huni / Gubuk / Menumpang';
                $poinAset -= 1;
                break;
        }

        // Aset Tanah / Lahan
        switch ($asetTanah) {
            case 'luas':
                $skorTanah = 95;
                $labelTanah = 'Lahan Produktif Luas (> 1.000 m² / Kebun)';
                $poinAset += 2;
                break;
            case 'sedang':
                $skorTanah = 70;
                $labelTanah = 'Lahan Sedang (250 m² - 1.000 m²)';
                $poinAset += 1;
                break;
            case 'sempit':
                $skorTanah = 40;
                $labelTanah = 'Lahan Pekarangan Sempit (< 250 m²)';
                break;
            case 'tidak_ada':
            default:
                $skorTanah = 15;
                $labelTanah = 'Tidak Memiliki Lahan Sendiri / Sewa';
                $poinAset -= 1;
                break;
        }

        // Aset Kendaraan
        switch ($asetKendaraan) {
            case 'mobil':
                $skorKendaraan = 100;
                $labelKendaraan = 'Memiliki Mobil Pribadi / Niaga';
                $poinAset += 3;
                break;
            case 'motor_layak':
                $skorKendaraan = 75;
                $labelKendaraan = 'Sepeda Motor Kondisi Prima / >= 1 Unit';
                $poinAset += 1;
                break;
            case 'motor_tua':
                $skorKendaraan = 40;
                $labelKendaraan = '1 Unit Motor Tua / Kurang Layak';
                break;
            case 'tidak_ada':
            default:
                $skorKendaraan = 10;
                $labelKendaraan = 'Tidak Ada Kendaraan Bermotor (Sepeda/Jalan Kaki)';
                $poinAset -= 1;
                break;
        }

        // 4. Penyesuaian Desil Berdasarkan Kekayaan Aset & Tanggungan Anak
        $penyesuaian = 0;
        if ($poinAset >= 4) {
            $penyesuaian += 1; // Aset mewah / lengkap menaikkan +1 desil
        } elseif ($poinAset <= -2 && $baseDesil > 2) {
            $penyesuaian -= 1; // Aset sangat minim mengoreksi -1 desil
        }

        // Tanggungan anak banyak (>= 4) dengan pendapatan per kapita sangat rendah
        if ($jumlahAnak >= 4 && $pendapatanPerKapita < 600000 && $baseDesil > 1) {
            $penyesuaian -= 1;
        }

        $desil = max(1, min(10, $baseDesil + $penyesuaian));

        // Update label kategori desil jika ada penyesuaian
        $daftarKategori = [
            1 => 'Desil 1 (Sangat Miskin / Ekstrem)',
            2 => 'Desil 2 (Miskin)',
            3 => 'Desil 3 (Hampir Miskin)',
            4 => 'Desil 4 (Rentan Miskin)',
            5 => 'Desil 5 (Menengah Bawah)',
            6 => 'Desil 6 (Menengah / Mandiri Awal)',
            7 => 'Desil 7 (Menengah Mapan)',
            8 => 'Desil 8 (Menengah Atas)',
            9 => 'Desil 9 (Mapan)',
            10 => 'Desil 10 (Sangat Mapan / Sejahtera)',
        ];
        $kategoriDesil = $daftarKategori[$desil] ?? "Desil {$desil}";

        // 5. Total Skor Komposit (0 - 100)
        $skorBase = ($desil * 10) - 3;
        $totalSkor = max(10, min(100, round($skorBase + ($poinAset * 1.5))));

        // 6. Status Perkembangan terhadap Desil Sebelumnya
        if ($desilSebelumnya !== null && $desilSebelumnya > 0) {
            if ($desil > $desilSebelumnya) {
                $statusPerkembangan = 'Maju';
            } elseif ($desil === $desilSebelumnya) {
                $statusPerkembangan = 'Tetap';
            } else {
                $statusPerkembangan = 'Mundur';
            }
        } else {
            $statusPerkembangan = 'Tetap';
        }

        // 7. Status Kemandirian (Sesuai regulasi: Mandiri jika Desil 6 ke atas)
        if ($desil >= 6) {
            $statusKemandirian = 'Mandiri';
        } else {
            if ($statusPerkembangan === 'Mundur') {
                $statusKemandirian = 'Penurunan Desil';
            } else {
                $statusKemandirian = 'Tahap Kemandirian';
            }
        }

        return [
            'total_anggota' => $totalAnggota,
            'pendapatan_per_kapita' => round($pendapatanPerKapita, 2),
            'skor_pendapatan' => round($skorBase),
            'skor_rumah' => $skorRumah,
            'label_rumah' => $labelRumah,
            'skor_tanah' => $skorTanah,
            'label_tanah' => $labelTanah,
            'skor_kendaraan' => $skorKendaraan,
            'label_kendaraan' => $labelKendaraan,
            'total_skor' => $totalSkor,
            'desil' => $desil,
            'kategori_desil' => $kategoriDesil,
            'status_kemandirian' => $statusKemandirian,
            'status_perkembangan' => $statusPerkembangan,
        ];
    }
}
