<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Wilayah;
use App\Models\ProgramBantuan;
use App\Models\KeluargaPenerima;
use App\Models\IndikatorKemandirian;
use App\Models\PenilaianKemandirian;
use App\Models\DetailPenilaianKemandirian;
use App\Models\LaporanPenerima;
use App\Models\ValidasiCpcl;
use Illuminate\Support\Facades\Hash;

class KeluargaPenerimaSeeder extends Seeder
{
    public function run(): void
    {
        $desa = Wilayah::where('jenis', 'desa')->first();
        $program = ProgramBantuan::first();
        $pendamping = User::where('role', 'pendamping')->first();
        $pemda = User::where('role', 'pemda')->first();

        // Buat indikator kemandirian
        $indikator1 = IndikatorKemandirian::create(['nama_indikator' => 'Peningkatan Pendapatan (Rp/Bulan)', 'bobot' => 40]);
        $indikator2 = IndikatorKemandirian::create(['nama_indikator' => 'Pekerjaan / Usaha Sampingan', 'bobot' => 30]);
        $indikator3 = IndikatorKemandirian::create(['nama_indikator' => 'Partisipasi Sosial Ekonomi', 'bobot' => 30]);

        // Buat 3 KK
        for ($i=1; $i<=3; $i++) {
            $noKk = "5204012001" . str_pad($i, 6, "0", STR_PAD_LEFT);
            
            $userPenerima = User::create([
                'name' => 'Kepala Keluarga ' . $i,
                'email' => 'kk' . $i . '@example.com',
                'password' => Hash::make($noKk),
                'role' => 'penerima',
            ]);

            $desil = rand(1, 5);
            $pendapatanBulanan = ($desil * 400000) + rand(300000, 600000);
            $pengeluaranBulanan = ($desil * 300000) + rand(250000, 500000);
            $surplusBulanan = $pendapatanBulanan - $pengeluaranBulanan;
            $statusKemandirian = ($desil >= 6) ? 'Mandiri' : (($surplusBulanan < 0) ? 'Penurunan Desil' : 'Tahap Kemandirian');

            $kk = KeluargaPenerima::create([
                'no_kk' => $noKk,
                'kepala_keluarga' => 'Kepala Keluarga ' . $i,
                'nik' => '520401' . str_pad($i, 10, "0", STR_PAD_LEFT),
                'alamat' => 'Jalan Desa Semamung RT 0' . $i,
                'desil' => $desil,
                'tipe_periode' => 'per_bulan',
                'pendapatan' => $pendapatanBulanan,
                'pengeluaran' => $pengeluaranBulanan,
                'pendapatan_perbulan' => $pendapatanBulanan,
                'pengeluaran_perbulan' => $pengeluaranBulanan,
                'penghasilan_bersih' => $surplusBulanan,
                'penghasilan_perbulan' => $pendapatanBulanan,
                'wilayah_id' => $desa->id,
                'program_bantuan_id' => $program->id,
                'status_validasi' => 'valid',
                'user_id' => $userPenerima->id,
                'pendamping_id' => $pendamping ? $pendamping->id : null,
                'status_kemandirian' => $statusKemandirian,
            ]);

            // Buat laporan feedback dari penerima ini
            LaporanPenerima::create([
                'keluarga_penerima_id' => $kk->id,
                'laporan_teks' => 'Bibit tanaman produktif tumbuh subur dan hasil panen membantu kebutuhan dapur serta menambah penghasilan keluarga.',
                'is_read_by_pemda' => false,
            ]);

            // Buat penilaian kemandirian
            $jumlahAnak = rand(1, 3);
            $totalAnggota = $jumlahAnak + 2;
            $evalInc = $pendapatanBulanan + rand(100000, 300000);
            $evalExp = $pengeluaranBulanan;
            $evalSurplus = $evalInc - $evalExp;

            $penilaian = PenilaianKemandirian::create([
                'keluarga_penerima_id' => $kk->id,
                'pendamping_id' => $pendamping->id,
                'periode' => 'Q1 2026',
                'total_skor' => rand(60, 90),
                'status_perkembangan' => 'Maju',
                'tipe_periode' => 'per_bulan',
                'pendapatan' => $evalInc,
                'pengeluaran' => $evalExp,
                'pendapatan_perbulan' => $evalInc,
                'pengeluaran_perbulan' => $evalExp,
                'penghasilan_bersih' => $evalSurplus,
                'penghasilan_perbulan' => $evalInc,
                'pendapatan_per_kapita' => round($evalInc / $totalAnggota),
                'jumlah_anak' => $jumlahAnak,
                'aset_rumah' => 'Semi Permanen',
                'aset_tanah' => 'Hak Milik',
                'aset_kendaraan' => 'Sepeda Motor',
                'catatan' => 'Pertumbuhan bibit sangat baik, hasil panen perdana mulai dipasarkan dan menambah pendapatan harian keluarga.'
            ]);

            // Buat tugas validasi CPCL untuk validator
            ValidasiCpcl::create([
                'keluarga_penerima_id' => $kk->id,
                'pendamping_id' => $pendamping->id,
                'tgl_survei' => now()->subDays($i)->toDateString(),
                'status_kelayakan' => 'review',
                'status_approval_pemda' => 'menunggu',
                'catatan' => 'Survei lahan dan berkas CPCL untuk ' . $kk->kepala_keluarga . ' telah selesai di lapangan. Menunggu verifikasi.',
                'foto_lahan_url' => null,
            ]);
        }
    }
}
