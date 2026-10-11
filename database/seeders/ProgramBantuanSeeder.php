<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramBantuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ProgramBantuan::create([
            'nama_program' => 'Bantuan Jagung Hibrida Bisi-18',
            'deskripsi' => 'Program bantuan bibit jagung hibrida untuk keluarga_penerima di wilayah sumbawa.',
            'pagu_anggaran' => 2000000000,
            'target_kk' => 6426,
            'tahun_anggaran' => 2026,
            'status' => 'aktif',
        ]);

        \App\Models\ProgramBantuan::create([
            'nama_program' => 'Bantuan Bibit Padi Ciherang',
            'deskripsi' => 'Program bantuan bibit padi ciherang untuk meningkatkan ketahanan pangan.',
            'pagu_anggaran' => 1500000000,
            'target_kk' => 4284,
            'tahun_anggaran' => 2026,
            'status' => 'aktif',
        ]);

        \App\Models\ProgramBantuan::create([
            'nama_program' => 'Bantuan Kopi Robusta Batulanteh',
            'deskripsi' => 'Program bantuan bibit kopi robusta untuk keluarga_penerima kopi di lereng gunung.',
            'pagu_anggaran' => 850000000,
            'target_kk' => 2142,
            'tahun_anggaran' => 2026,
            'status' => 'aktif',
        ]);
        
        \App\Models\ProgramBantuan::create([
            'nama_program' => 'Bantuan Hortikultura (Cabe Rawit & Bawang Merah)',
            'deskripsi' => 'Program bantuan bibit hortikultura untuk mengendalikan inflasi daerah.',
            'pagu_anggaran' => 500000000,
            'target_kk' => 1428,
            'tahun_anggaran' => 2026,
            'status' => 'draf',
        ]);
    }
}
