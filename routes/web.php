<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');

Route::get('/sibibit', function () {
    return view('sibibit');
});

use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

Route::middleware(['auth', 'role:pemda'])->group(function () {
    Route::get('/dashboard/pemda', function () { return view('dashboard.pemda'); })->name('dashboard.pemda');
    Route::prefix('pemda')->name('pemda.')->group(function () {
        Route::resource('/program-bantuan', \App\Http\Controllers\Pemda\ProgramBantuanController::class);
        Route::resource('/kampus-mitra', \App\Http\Controllers\Pemda\KampusMitraController::class);
        Route::resource('/pendamping', \App\Http\Controllers\Pemda\PendampingController::class);
        Route::resource('/validator', \App\Http\Controllers\Pemda\ValidatorController::class);
        Route::resource('/data-penerima', \App\Http\Controllers\Pemda\DataPenerimaController::class);
        Route::resource('/penyaluran-bibit', \App\Http\Controllers\Pemda\PenyaluranBibitController::class);
        Route::get('/monitoring/kecamatan/{id}', [\App\Http\Controllers\Pemda\MonitoringController::class, 'getKecamatanDetail'])->name('monitoring.kecamatan-detail');
        Route::resource('/monitoring', \App\Http\Controllers\Pemda\MonitoringController::class);
        Route::get('/laporan/cetak-pdf', [\App\Http\Controllers\Pemda\LaporanController::class, 'cetakPdf'])->name('laporan.pdf');
        Route::get('/laporan/penyaluran-pdf', [\App\Http\Controllers\Pemda\LaporanController::class, 'penyaluranPdf'])->name('laporan.penyaluran-pdf');
        Route::get('/laporan/tumbuh-kembang-pdf', [\App\Http\Controllers\Pemda\LaporanController::class, 'tumbuhKembangPdf'])->name('laporan.tumbuh-kembang-pdf');
        Route::get('/laporan/validasi-pdf', [\App\Http\Controllers\Pemda\LaporanController::class, 'validasiPdf'])->name('laporan.validasi-pdf');
        Route::resource('/laporan', \App\Http\Controllers\Pemda\LaporanController::class);
        Route::resource('/master-data/wilayah', \App\Http\Controllers\Pemda\WilayahController::class)->names('master-data.wilayah');
        Route::resource('/master-data/jenis-bibit', \App\Http\Controllers\Pemda\JenisBibitController::class)->names('master-data.jenis-bibit');
        Route::resource('/audit-log', \App\Http\Controllers\Pemda\AuditLogController::class);
        Route::resource('/pengaturan', \App\Http\Controllers\Pemda\PengaturanController::class);
    });
});

Route::middleware(['auth', 'role:kampus'])->group(function () {
    Route::get('/dashboard/kampus', function () { return view('dashboard.kampus'); })->name('dashboard.kampus');
    Route::prefix('kampus')->name('kampus.')->group(function () {
        Route::resource('/pengadaan', \App\Http\Controllers\Kampus\PengadaanController::class);
        Route::resource('/pendamping', \App\Http\Controllers\Kampus\PendampingController::class);
        Route::resource('/keluarga_penerima', \App\Http\Controllers\Kampus\KeluargaPenerimaController::class);
        Route::resource('/penyaluran', \App\Http\Controllers\Kampus\PenyaluranController::class);
        Route::resource('/monitoring', \App\Http\Controllers\Kampus\MonitoringController::class);
        Route::get('/laporan/cetak-pdf', [\App\Http\Controllers\Kampus\LaporanController::class, 'cetakPdf'])->name('laporan.pdf');
        Route::get('/laporan/spj-pdf', [\App\Http\Controllers\Kampus\LaporanController::class, 'spjPdf'])->name('laporan.spj-pdf');
        Route::get('/laporan/log-pendamping-pdf', [\App\Http\Controllers\Kampus\LaporanController::class, 'logPendampingPdf'])->name('laporan.log-pendamping-pdf');
        Route::resource('/laporan', \App\Http\Controllers\Kampus\LaporanController::class);
        Route::resource('/pengaturan', \App\Http\Controllers\Kampus\PengaturanController::class);
    });
});

Route::middleware(['auth', 'role:pendamping'])->group(function () {
    Route::get('/dashboard/pendamping', [\App\Http\Controllers\Pendamping\DashboardController::class, 'index'])->name('dashboard.pendamping');
    Route::prefix('pendamping')->name('pendamping.')->group(function () {
        Route::resource('/tugas-validasi', \App\Http\Controllers\Pendamping\TugasValidasiController::class)->names('tugas-validasi');
        Route::resource('/lapor-tumbuh-kembang', \App\Http\Controllers\Pendamping\LaporController::class)->names('lapor');
        Route::resource('/keluarga_penerima-binaan', \App\Http\Controllers\Pendamping\KeluargaPenerimaController::class)->names('keluarga_penerima');
    });
});

Route::middleware(['auth', 'role:validator'])->group(function () {
    Route::get('/dashboard/validator', function () { return view('dashboard.validator'); })->name('dashboard.validator');
    Route::prefix('validator')->name('validator.')->group(function () {
        Route::resource('/antrean', \App\Http\Controllers\Validator\AntreanController::class);
        Route::resource('/riwayat', \App\Http\Controllers\Validator\RiwayatController::class);
        Route::resource('/akun', \App\Http\Controllers\Validator\AkunController::class);
    });
});

Route::middleware(['auth', 'role:penerima'])->group(function () {
    Route::get('/dashboard/penerima', [\App\Http\Controllers\Penerima\DashboardController::class, 'index'])->name('dashboard.penerima');
    Route::post('/penerima/laporan', [\App\Http\Controllers\Penerima\DashboardController::class, 'kirimLaporan'])->name('penerima.laporan.store');
});


