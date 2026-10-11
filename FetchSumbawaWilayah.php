<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Wilayah;
use Illuminate\Support\Facades\Http;

echo "Fetching data from Wikipedia...\n";
$response = Http::withHeaders(['User-Agent' => 'Mozilla/5.0'])->get('https://id.wikipedia.org/wiki/Daftar_kecamatan_dan_kelurahan_di_Kabupaten_Sumbawa');
if (!$response->successful()) {
    die("Failed to fetch Wikipedia page.\n");
}

$html = $response->body();

$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML($html);
libxml_clear_errors();

$xpath = new DOMXPath($dom);
// The table is usually the first wikitable
$rows = $xpath->query('//table[contains(@class, "wikitable")]/tbody/tr');

$data = [];

foreach ($rows as $i => $row) {
    if ($i == 0) continue; // skip header
    
    $cells = $xpath->query('td', $row);
    if ($cells->length < 6) continue;
    
    $kode = trim($cells->item(0)->textContent);
    $kecamatan = trim($cells->item(1)->textContent);
    
    // Desa list is in the 6th column, inside list items usually, or comma separated if we just get textContent
    // Let's get the <li> elements if they exist, otherwise split by newline
    $desaNodes = $xpath->query('.//li/a | .//li', $cells->item(5));
    $desaList = [];
    
    if ($desaNodes->length > 0) {
        foreach ($desaNodes as $dNode) {
            $desaList[] = trim($dNode->textContent);
        }
    } else {
        $text = trim($cells->item(5)->textContent);
        $desaList = array_filter(array_map('trim', explode("\n", $text)));
    }
    
    $data[] = [
        'kode' => $kode,
        'kecamatan' => $kecamatan,
        'desa' => array_unique($desaList)
    ];
}

echo "Found " . count($data) . " kecamatan.\n";

$totalDesa = 0;

foreach ($data as $row) {
    echo "Processing Kecamatan: " . $row['kecamatan'] . "...\n";
    $kecamatan = Wilayah::firstOrCreate(
        ['nama' => $row['kecamatan'], 'jenis' => 'kecamatan'],
        ['kode_wilayah' => $row['kode'], 'is_aktif' => true]
    );
    
    // There are some duplicates because of <li> and <a> being queried if we just used both. 
    // Wait, `.//li/a | .//li` might duplicate if an li has an a.
    // Let's clean up $row['desa']
    $cleanDesaList = [];
    foreach ($row['desa'] as $desaName) {
        if (empty($desaName)) continue;
        $desaNameClean = preg_replace('/ \(.*?\)/', '', $desaName);
        $cleanDesaList[$desaNameClean] = $desaNameClean;
    }
    
    $i = 0;
    foreach ($cleanDesaList as $desaNameClean) {
        $jenis = str_contains(strtolower($desaNameClean), 'kelurahan') ? 'kelurahan' : 'desa';
        $kodeDesa = $row['kode'] . '.' . str_pad($i + 1, 4, '0', STR_PAD_LEFT);
        
        Wilayah::firstOrCreate(
            ['nama' => $desaNameClean, 'jenis' => $jenis, 'parent_id' => $kecamatan->id],
            ['kode_wilayah' => $kodeDesa, 'is_aktif' => true]
        );
        $totalDesa++;
        $i++;
    }
}

echo "Successfully added " . count($data) . " Kecamatan and $totalDesa Desa/Kelurahan.\n";
