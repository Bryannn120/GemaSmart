<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Wilayah;
use App\Models\JenisBibit;
use App\Models\ProgramBantuan;
use App\Models\KampusMitra;
use App\Models\KeluargaPenerima;
use App\Models\Penyaluran;
use App\Models\ValidasiCpcl;
use App\Models\LaporanTumbuhKembang;
use App\Models\Spj;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Pemda
        $pemda = User::create([
            'name' => 'Admin Pemda Sumbawa',
            'email' => 'pemda@sumbawakab.go.id',
            'password' => Hash::make('password123'),
            'role' => 'pemda',
        ]);

        // 2. Akun Kampus Mitra
        $kampusUser = User::create([
            'name' => 'Admin Kampus Mitra UTS',
            'email' => 'kampus@sumbawakab.go.id',
            'password' => Hash::make('password123'),
            'role' => 'kampus',
        ]);

        // 3. Akun Pendamping Lapangan
        $pendamping = User::create([
            'name' => 'Budi Pendamping (Surveyor)',
            'email' => 'pendamping@sumbawakab.go.id',
            'password' => Hash::make('password123'),
            'role' => 'pendamping',
        ]);

        // 4. Akun Validator Kampus
        $validator = User::create([
            'name' => 'Siti Validator (DPL)',
            'email' => 'validator@sumbawakab.go.id',
            'password' => Hash::make('password123'),
            'role' => 'validator',
        ]);

        // --- Data Master Utama (Opsional: Tetap dipertahankan untuk master awal) ---
        $kecamatan = Wilayah::create([
            'kode_wilayah' => '52.04.01',
            'nama' => 'Moyo Hulu',
            'jenis' => 'kecamatan',
            'is_aktif' => true,
        ]);

        $desa = Wilayah::create([
            'kode_wilayah' => '52.04.01.2001',
            'nama' => 'Desa Semamung',
            'jenis' => 'desa',
            'parent_id' => $kecamatan->id,
            'is_aktif' => true,
        ]);

        $bibit1 = JenisBibit::create([
            'kode_bibit' => 'BBT-MG-01',
            'kategori' => 'Buah-buahan',
            'nama_varian' => 'Mangga Arumanis',
            'satuan' => 'Pohon',
        ]);

        $bibit2 = JenisBibit::create([
            'kode_bibit' => 'BBT-DR-01',
            'kategori' => 'Buah-buahan',
            'nama_varian' => 'Durian Musang King',
            'satuan' => 'Pohon',
        ]);

        $program = ProgramBantuan::create([
            'nama_program' => 'Pemberdayaan Lahan Kritis 2026',
            'deskripsi' => 'Program bantuan bibit pohon produktif untuk lahan kritis.',
            'tahun_anggaran' => 2026,
            'pagu_anggaran' => 150000000,
            'target_kk' => 500,
            'status' => 'aktif',
        ]);

        // LOG: Admin Production Initiation
        DB::table('audit_logs')->insert([
            'user_id' => $pemda->id,
            'aksi' => 'create',
            'model' => 'System',
            'model_id' => 1,
            'ip_address' => '127.0.0.1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $this->call([
            KeluargaPenerimaSeeder::class,
        ]);
    }
}
