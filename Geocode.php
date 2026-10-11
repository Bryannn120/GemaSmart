<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Wilayah;
use Illuminate\Support\Facades\Http;

$kecamatans = Wilayah::where('jenis', 'kecamatan')->get();
$coords = [];

foreach ($kecamatans as $kec) {
    $query = urlencode($kec->nama . ' Sumbawa Nusa Tenggara Barat Indonesia');
    echo "Geocoding: " . $kec->nama . "...\n";
    $response = Http::withHeaders(['User-Agent' => 'GemaSmart/1.0'])->get("https://nominatim.openstreetmap.org/search?q=$query&format=json&limit=1");
    
    if ($response->successful() && count($response->json()) > 0) {
        $data = $response->json()[0];
        $coords[$kec->id] = [
            'lat' => $data['lat'],
            'lon' => $data['lon']
        ];
    } else {
        // Fallback coordinates (center of Sumbawa)
        $coords[$kec->id] = [
            'lat' => '-8.4975',
            'lon' => '117.4278'
        ];
    }
    sleep(1); // Respect Nominatim rate limits (1 req/sec)
}

file_put_contents('public/kecamatan_coords.json', json_encode($coords));
echo "Geocoding completed.\n";
