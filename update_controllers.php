<?php
$controllers = [
    'KampusMitra' => 'kampus-mitra',
    'DataPenerima' => 'data-penerima',
    'PenyaluranBibit' => 'penyaluran-bibit',
    'Monitoring' => 'monitoring',
    'ValidasiLapangan' => 'validasi-lapangan',
    'Laporan' => 'laporan',
    'Wilayah' => 'master-data.wilayah',
    'JenisBibit' => 'master-data.jenis-bibit',
    'AuditLog' => 'audit-log',
    'Pengaturan' => 'pengaturan'
];

foreach ($controllers as $name => $view) {
    $path = 'c:/sibibit/app/Http/Controllers/Pemda/' . $name . 'Controller.php';
    if (file_exists($path)) {
        $content = file_get_contents($path);
        // Look for the index method
        $pattern = '/(public function index\(\)\s*\{)\s*\/\//';
        $replacement = '$1' . "\n        return view('dashboard.pemda.{$view}.index');\n";
        $newContent = preg_replace($pattern, $replacement, $content);
        file_put_contents($path, $newContent);
        echo "Updated $name\n";
    }
}
