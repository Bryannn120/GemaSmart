<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tambah kampus_id & jenis_subsidi ke tabel program_bantuans
        Schema::table('program_bantuans', function (Blueprint $table) {
            $table->foreignId('kampus_id')->nullable()->after('id')->constrained('kampus_mitras')->nullOnDelete();
            $table->string('jenis_subsidi')->nullable()->after('tahun_anggaran')->comment('bibit, uang, barang');
        });

        // 2. Buat tabel item_bantuans (Kategori bantuan yang dibuat oleh Kampus: bibit, uang, barang/alat)
        Schema::create('item_bantuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_bantuan_id')->constrained('program_bantuans')->onDelete('cascade');
            $table->enum('jenis', ['bibit', 'uang', 'barang'])->default('bibit');
            $table->string('nama_item'); // e.g., 'Kompor Gas Usaha', 'Bibit Cabai Rawit', 'Bantuan Tunai Modal Tani'
            $table->string('satuan')->default('unit'); // 'batang', 'unit', 'rupiah', 'kg', 'paket'
            $table->text('deskripsi')->nullable(); // Spesifikasi / kegunaan
            $table->decimal('nominal_satuan', 15, 2)->nullable()->default(0); // Nilai nominal / harga satuan
            $table->decimal('total_stok', 12, 2)->default(0); // Kuota / alokasi total program
            $table->timestamps();
            $table->softDeletes();
        });

        // 3. Buat tabel penyaluran_bantuans (Catatan penyaluran dari Pendamping ke Keluarga Penerima)
        Schema::create('penyaluran_bantuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keluarga_penerima_id')->constrained('keluarga_penerimas')->onDelete('cascade');
            $table->foreignId('program_bantuan_id')->constrained('program_bantuans')->onDelete('cascade');
            $table->foreignId('item_bantuan_id')->constrained('item_bantuans')->onDelete('cascade');
            $table->foreignId('pendamping_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('jenis', ['bibit', 'uang', 'barang']);
            $table->decimal('jumlah', 12, 2)->default(1); // Jumlah alat/bibit atau 1 untuk uang
            $table->string('satuan')->default('unit'); // unit, batang, rupiah
            $table->decimal('nominal_uang', 15, 2)->nullable()->default(0); // Khusus uang: berapa jumlah uangnya
            $table->text('peruntukan')->nullable(); // Khusus uang/bantuan: digunakan untuk apa
            $table->text('keterangan')->nullable(); // Catatan tambahan serah terima
            $table->string('foto_penyerahan_url')->nullable();
            $table->date('tgl_penyaluran');
            $table->enum('status', ['disalurkan', 'diterima', 'batal'])->default('diterima');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyaluran_bantuans');
        Schema::dropIfExists('item_bantuans');

        Schema::table('program_bantuans', function (Blueprint $table) {
            $table->dropForeign(['kampus_id']);
            $table->dropColumn(['kampus_id', 'jenis_subsidi']);
        });
    }
};
