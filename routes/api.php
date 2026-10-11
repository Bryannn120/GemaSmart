<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\KeluargaPenerima;
use App\Models\Penyaluran;
use App\Models\LaporanTumbuhKembang;
use App\Models\ValidasiCpcl;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Endpoint Publik / Integrasi
Route::prefix('v1')->group(function () {

    // 1. Get Data Penerima / KeluargaPenerima
    Route::get('/penerima', function (Request $request) {
        $query = KeluargaPenerima::with(['wilayah', 'programBantuan']);
        
        if ($request->has('status')) {
            $query->where('status_validasi', $request->status);
        }
        
        if ($request->has('nik')) {
            $query->where('nik', $request->nik);
        }

        return response()->json([
            'status' => 'success',
            'data' => $query->paginate(20)
        ]);
    });

    // 2. Get Data Penyaluran BAST
    Route::get('/penyaluran', function (Request $request) {
        $query = Penyaluran::with(['wilayah', 'jenisBibit']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        return response()->json([
            'status' => 'success',
            'data' => $query->paginate(20)
        ]);
    });

    // 3. Get Laporan Tumbuh Kembang
    Route::get('/laporan-tumbuh-kembang', function (Request $request) {
        $query = LaporanTumbuhKembang::with(['keluarga_penerima', 'pendamping']);

        return response()->json([
            'status' => 'success',
            'data' => $query->paginate(20)
        ]);
    });

    // 4. POST (Push) Laporan Tumbuh Kembang dari Aplikasi External (Mobile dll)
    Route::post('/laporan-tumbuh-kembang', function (Request $request) {
        $request->validate([
            'keluarga_penerima_id' => 'required|exists:keluarga_penerimas,id',
            'pendamping_id' => 'required|exists:users,id',
            'tanggal_lapor' => 'required|date',
            'status_kondisi' => 'required|in:normal,hama,gagal',
            'catatan' => 'required|string',
        ]);

        $laporan = LaporanTumbuhKembang::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Laporan tumbuh kembang berhasil dikirim.',
            'data' => $laporan
        ], 201);
    });

});
