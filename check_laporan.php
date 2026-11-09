<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$reports = App\Models\LaporanPenerima::latest('id')->take(10)->get();
foreach ($reports as $r) {
    echo "ID: {$r->id} | Sumber: {$r->sumber} | Sender: {$r->wa_sender} | Nama: {$r->pengirim_nama} | Created: {$r->created_at}\n";
    echo "Teks: {$r->laporan_teks}\n";
    echo "Tanggapan: {$r->tanggapan}\n";
    echo "----------------------------------------\n";
}

