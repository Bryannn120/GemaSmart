<?php
$controllers = [
    'Kampus' => [
        'Pengadaan' => 'pengadaan',
        'Pendamping' => 'pendamping',
        'Petani' => 'petani',
        'Penyaluran' => 'penyaluran',
        'Monitoring' => 'monitoring',
        'Laporan' => 'laporan',
        'Pengaturan' => 'pengaturan'
    ],
    'Pendamping' => [
        'TugasValidasi' => 'tugas-validasi',
        'Lapor' => 'lapor',
        'Petani' => 'petani'
    ],
    'Validator' => [
        'Antrean' => 'antrean',
        'Riwayat' => 'riwayat',
        'Akun' => 'akun'
    ]
];

foreach ($controllers as $role => $roleControllers) {
    $roleLower = strtolower($role);
    foreach ($roleControllers as $name => $view) {
        $path = 'c:/sibibit/app/Http/Controllers/' . $role . '/' . $name . 'Controller.php';
        if (file_exists($path)) {
            $content = file_get_contents($path);
            $pattern = '/(public function index\(\)\s*\{)\s*\/\//';
            $replacement = '$1' . "\n        return view('dashboard.{$roleLower}.{$view}.index');\n";
            $newContent = preg_replace($pattern, $replacement, $content);
            file_put_contents($path, $newContent);
            echo "Updated $role/$name\n";
        }
    }
}
