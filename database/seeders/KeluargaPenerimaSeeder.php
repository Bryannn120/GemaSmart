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

            $kk = KeluargaPenerima::create([
                'no_kk' => $noKk,
                'kepala_keluarga' => 'Kepala Keluarga ' . $i,
                'nik' => '520401' . str_pad($i, 10, "0", STR_PAD_LEFT),
                'alamat' => 'Jalan Desa Semamung RT 0' . $i,
                'desil' => rand(1, 5),
                'wilayah_id' => $desa->id,
                'program_bantuan_id' => $program->id,
                'status_validasi' => 'valid',
                'user_id' => $userPenerima->id,
                'status_kemandirian' => 'Belum Dinilai',
            ]);

            // Buat laporan feedback dari penerima ini
            LaporanPenerima::create([
                'keluarga_penerima_id' => $kk->id,
                'laporan_teks' => 'Bibit sudah ditanam, namun butuh pupuk tambahan.',
                'is_read_by_pemda' => false,
            ]);

            // Buat penilaian kemandirian
            $penilaian = PenilaianKemandirian::create([
                'keluarga_penerima_id' => $kk->id,
                'pendamping_id' => $pendamping->id,
                'periode' => 'Q1 2026',
                'total_skor' => rand(50, 90),
                'status_perkembangan' => 'Maju'
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
