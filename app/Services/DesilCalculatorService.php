<?php

namespace App\Services;

class DesilCalculatorService
{
    /**
     * Hitung tolak ukur penilaian indikator kemandirian berdasarkan pendapatan dan pengeluaran
     * (bisa dipilih basis waktu per bulan atau per hari), serta indikator sosial ekonomi keluarga.
     *
     * @param float $pendapatan
     * @param float $pengeluaran
     * @param string $tipePeriode ('per_bulan' atau 'per_hari')
     * @param int $jumlahAnak
     * @param string $asetRumah (tidak_layak, semi_permanen, permanen)
     * @param string $asetTanah (tidak_ada, sempit, sedang, luas)
     * @param string $asetKendaraan (tidak_ada, motor_tua, motor_layak, mobil)
     * @param int|null $desilSebelumnya
     * @param float|null $penghasilanPerbulan (legacy compatibility)
     * @return array
     */
    public static function hitung(
        float $pendapatan = 0,
        float $pengeluaran = 0,
        string $tipePeriode = 'per_bulan',
        int $jumlahAnak = 0,
        string $asetRumah = 'tidak_layak',
        string $asetTanah = 'tidak_ada',
        string $asetKendaraan = 'tidak_ada',
        ?int $desilSebelumnya = null,
        ?float $penghasilanPerbulan = null
    ): array {
        // Fallback backward compatibility jika pemanggil lama hanya mengirim penghasilanPerbulan
        if ($pendapatan == 0 && $penghasilanPerbulan !== null && $penghasilanPerbulan > 0) {
            $pendapatan = $penghasilanPerbulan;
            $tipePeriode = 'per_bulan';
        }

        // 1. Normalisasi Pendapatan & Pengeluaran ke Ekuivalen Bulanan & Harian
        if ($tipePeriode === 'per_hari') {
            $pendapatanPerhari = $pendapatan;
            $pengeluaranPerhari = $pengeluaran;
            $pendapatanPerbulan = $pendapatan * 30;
            $pengeluaranPerbulan = $pengeluaran * 30;
        } else {
            $tipePeriode = 'per_bulan';
            $pendapatanPerbulan = $pendapatan;
            $pengeluaranPerbulan = $pengeluaran;
            $pendapatanPerhari = round($pendapatan / 30, 2);
            $pengeluaranPerhari = round($pengeluaran / 30, 2);
        }

        // Sisa Bersih Finansial (Surplus jika > 0, Defisit jika < 0)
        $penghasilanBersih = $pendapatanPerbulan - $pengeluaranPerbulan;
        $sisaPerhari = round($penghasilanBersih / 30, 2);

        // 2. Total Anggota Keluarga (Kepala Keluarga + Pasangan + Jumlah Anak)
        $totalAnggota = max(1, $jumlahAnak + 2);
        $pendapatanPerKapita = round($pendapatanPerbulan / $totalAnggota, 2);
        $pengeluaranPerKapita = round($pengeluaranPerbulan / $totalAnggota, 2);
        $surplusPerKapita = round($penghasilanBersih / $totalAnggota, 2);

        // 3. Base Tingkat dari Tolak Ukur Pendapatan Bulanan Keluarga
        // Mengacu pada tolak ukur standar pemantauan kemandirian
        if ($pendapatanPerbulan < 1000000) {
            $baseDesil = 1;
            $kategoriDesil = 'Tingkat 1 (Perlu Intervensi Ekstrem)';
        } elseif ($pendapatanPerbulan < 1800000) {
            $baseDesil = 2;
            $kategoriDesil = 'Tingkat 2 (Sangat Rentan)';
        } elseif ($pendapatanPerbulan < 2700000) {
            $baseDesil = 3;
            $kategoriDesil = 'Tingkat 3 (Rentan / Tahap Awal)';
        } elseif ($pendapatanPerbulan < 3800000) {
            $baseDesil = 4;
            $kategoriDesil = 'Tingkat 4 (Berkembang Bawah)';
        } elseif ($pendapatanPerbulan < 5000000) {
            $baseDesil = 5;
            $kategoriDesil = 'Tingkat 5 (Berkembang Menengah)';
        } elseif ($pendapatanPerbulan < 6500000) {
            $baseDesil = 6;
            $kategoriDesil = 'Tingkat 6 (Mandiri Awal)';
        } elseif ($pendapatanPerbulan < 8500000) {
            $baseDesil = 7;
            $kategoriDesil = 'Tingkat 7 (Mandiri Madya)';
        } elseif ($pendapatanPerbulan < 12000000) {
            $baseDesil = 8;
            $kategoriDesil = 'Tingkat 8 (Mandiri Maju)';
        } elseif ($pendapatanPerbulan < 18000000) {
            $baseDesil = 9;
            $kategoriDesil = 'Tingkat 9 (Mandiri Unggul)';
        } else {
            $baseDesil = 10;
            $kategoriDesil = 'Tingkat 10 (Mandiri Utama / Sejahtera)';
        }

        // 4. Penyesuaian Berdasarkan Rasio Pengeluaran & Sisa Finansial (Surplus / Defisit)
        $penyesuaianKeuangan = 0;
        if ($penghasilanBersih < -200000 && $baseDesil > 1) {
            // Defisit lebih dari 200rb per bulan -> rentan terjerat utang, kurangi 1 desil
            $penyesuaianKeuangan -= 1;
        } elseif ($penghasilanBersih >= 1500000 && $baseDesil < 10) {
            // Surplus tabungan kuat di atas 1.5jt per bulan -> tambah 1 desil
            $penyesuaianKeuangan += 1;
        }

        // 5. Evaluasi Skor & Penyesuaian Aset
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

        // 6. Penyesuaian Desil Berdasarkan Kekayaan Aset & Tanggungan Anak
        $penyesuaianAset = 0;
        if ($poinAset >= 4) {
            $penyesuaianAset += 1; // Aset mewah / lengkap menaikkan +1 desil
        } elseif ($poinAset <= -2 && $baseDesil > 2) {
            $penyesuaianAset -= 1; // Aset sangat minim mengoreksi -1 desil
        }

        // Tanggungan anak banyak (>= 4) dengan pendapatan per kapita sangat rendah
        if ($jumlahAnak >= 4 && $pendapatanPerKapita < 600000 && $baseDesil > 1) {
            $penyesuaianAset -= 1;
        }

        $desil = max(1, min(10, $baseDesil + $penyesuaianKeuangan + $penyesuaianAset));

        // Update label kategori indikator jika ada penyesuaian
        $daftarKategori = [
            1 => 'Tingkat 1 (Perlu Intervensi Ekstrem)',
            2 => 'Tingkat 2 (Sangat Rentan)',
            3 => 'Tingkat 3 (Rentan / Tahap Awal)',
            4 => 'Tingkat 4 (Berkembang Bawah)',
            5 => 'Tingkat 5 (Berkembang Menengah)',
            6 => 'Tingkat 6 (Mandiri Awal)',
            7 => 'Tingkat 7 (Mandiri Madya)',
            8 => 'Tingkat 8 (Mandiri Maju)',
            9 => 'Tingkat 9 (Mandiri Unggul)',
            10 => 'Tingkat 10 (Mandiri Utama / Sejahtera)',
        ];
        $kategoriDesil = $daftarKategori[$desil] ?? "Tingkat {$desil}";

        // 7. Total Skor Komposit (0 - 100)
        $skorBase = ($desil * 10) - 3;
        $totalSkor = max(10, min(100, round($skorBase + ($poinAset * 1.5))));

        // 8. Status Perkembangan terhadap Asesmen Sebelumnya
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

        // 9. Status Kemandirian (Sesuai tolak ukur indikator: Mandiri jika Tingkat 6 ke atas)
        if ($desil >= 6) {
            $statusKemandirian = 'Mandiri';
        } else {
            if ($statusPerkembangan === 'Mundur') {
                $statusKemandirian = 'Butuh Perhatian Khusus';
            } else {
                $statusKemandirian = 'Tahap Kemandirian';
            }
        }

        return [
            'tipe_periode' => $tipePeriode,
            'pendapatan' => $pendapatan,
            'pengeluaran' => $pengeluaran,
            'pendapatan_perbulan' => $pendapatanPerbulan,
            'pengeluaran_perbulan' => $pengeluaranPerbulan,
            'pendapatan_perhari' => $pendapatanPerhari,
            'pengeluaran_perhari' => $pengeluaranPerhari,
            'penghasilan_bersih' => $penghasilanBersih,
            'sisa_perhari' => $sisaPerhari,
            'total_anggota' => $totalAnggota,
            'pendapatan_per_kapita' => $pendapatanPerKapita,
            'pengeluaran_per_kapita' => $pengeluaranPerKapita,
            'surplus_per_kapita' => $surplusPerKapita,
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
