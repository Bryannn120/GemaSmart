<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KampusMitra;
use App\Models\ProgramBantuan;
use App\Models\ItemBantuan;
use App\Models\User;

class ProgramBantuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kampus = KampusMitra::first();
        if (!$kampus) {
            $kampus = KampusMitra::create([
                'nama_universitas' => 'Universitas Teknologi Sumbawa (UTS)',
                'pic_name' => 'Koordinator Kampus',
                'pic_contact' => '081234567890',
                'wilayah_binaan' => 'Kec. Moyo Hulu, Utan, Labuhan Badas',
                'mou_berlaku_sampai' => '2027-12-31',
                'status_mou' => 'aktif',
            ]);
        }

        User::where('role', 'kampus')->whereNull('kampus_id')->update(['kampus_id' => $kampus->id]);

        $prog1 = ProgramBantuan::create([
            'kampus_id' => $kampus->id,
            'nama_program' => 'Program Bantuan Bibit & Modal Tani Sumbawa Gemilang',
            'deskripsi' => 'Program subsidi terpadu dari kampus yang mencakup bantuan bibit tanaman hortikultura/jagung unggul, modal uang tunai usaha produktif, dan peralatan pengolahan pangan/tani.',
            'pagu_anggaran' => 2000000000,
            'target_kk' => 6426,
            'tahun_anggaran' => 2026,
            'jenis_subsidi' => 'bibit,uang,barang',
            'status' => 'aktif',
        ]);

        // Item 1: Bibit
        ItemBantuan::create([
            'program_bantuan_id' => $prog1->id,
            'jenis' => 'bibit',
            'nama_item' => 'Bibit Jagung Hibrida Bisi-18',
            'satuan' => 'KG',
            'deskripsi' => 'Benih jagung hibrida produktivitas tinggi dan tahan kekeringan.',
            'nominal_satuan' => 75000,
            'total_stok' => 500,
        ]);
        ItemBantuan::create([
            'program_bantuan_id' => $prog1->id,
            'jenis' => 'bibit',
            'nama_item' => 'Bibit Cabai Rawit Hibrida',
            'satuan' => 'Polybag',
            'deskripsi' => 'Bibit cabai rawit siap tanam untuk budidaya pekarangan.',
            'nominal_satuan' => 5000,
            'total_stok' => 2500,
        ]);

        // Item 2: Uang Tunai Modal
        ItemBantuan::create([
            'program_bantuan_id' => $prog1->id,
            'jenis' => 'uang',
            'nama_item' => 'Bantuan Tunai Modal Usaha Tani & Ternak',
            'satuan' => 'Rupiah',
            'deskripsi' => 'Dana tunai stimulan modal kerja (pupuk, bibit ikan lele, pakan, atau sewa olah lahan).',
            'nominal_satuan' => 1500000,
            'total_stok' => 100,
        ]);

        // Item 3: Barang / Alat
        ItemBantuan::create([
            'program_bantuan_id' => $prog1->id,
            'jenis' => 'barang',
            'nama_item' => 'Kompor Gas Usaha Olahan Pangan Rumah Tangga',
            'satuan' => 'Unit',
            'deskripsi' => 'Kompor gas 2 tungku lengkap dengan regulator ber-SNI untuk produksi usaha olahan kripik & sambal.',
            'nominal_satuan' => 450000,
            'total_stok' => 50,
        ]);
        ItemBantuan::create([
            'program_bantuan_id' => $prog1->id,
            'jenis' => 'barang',
            'nama_item' => 'Hand Sprayer Pupuk Cair 16 Liter',
            'satuan' => 'Unit',
            'deskripsi' => 'Alat semprot elektrik untuk pemupukan cair dan perawatan tanaman.',
            'nominal_satuan' => 350000,
            'total_stok' => 60,
        ]);
        ItemBantuan::create([
            'program_bantuan_id' => $prog1->id,
            'jenis' => 'barang',
            'nama_item' => 'Pupuk Organik Cair Hayati (POC)',
            'satuan' => 'LT',
            'deskripsi' => 'Nutrisi tanaman cair kemasan botol 1 Liter untuk penyubur tanah dan percepatan tumbuh.',
            'nominal_satuan' => 65000,
            'total_stok' => 200,
        ]);

        $prog2 = ProgramBantuan::create([
            'kampus_id' => $kampus->id,
            'nama_program' => 'Bantuan Ketahanan Pangan Padi Ciherang & Hortikultura',
            'deskripsi' => 'Program bantuan bibit padi ciherang dan hortikultura untuk meningkatkan ketahanan pangan keluarga prasejahtera.',
            'pagu_anggaran' => 1500000000,
            'target_kk' => 4284,
            'tahun_anggaran' => 2026,
            'jenis_subsidi' => 'bibit,barang',
            'status' => 'aktif',
        ]);

        ItemBantuan::create([
            'program_bantuan_id' => $prog2->id,
            'jenis' => 'bibit',
            'nama_item' => 'Bibit Padi Ciherang Bersertifikat',
            'satuan' => 'KG',
            'deskripsi' => 'Bibit padi sawah unggul tahan wereng batang coklat.',
            'nominal_satuan' => 15000,
            'total_stok' => 3000,
        ]);
    }
}
