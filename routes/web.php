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
    Route::get('/dashboard/pemda', [\App\Http\Controllers\Pemda\DashboardController::class, 'index'])->name('dashboard.pemda');
    Route::prefix('pemda')->name('pemda.')->group(function () {
        Route::resource('/program-bantuan', \App\Http\Controllers\Pemda\ProgramBantuanController::class)->only(['index', 'show']);
        Route::resource('/kampus-mitra', \App\Http\Controllers\Pemda\KampusMitraController::class);
        Route::post('/kampus-mitra/{id}/tambah-dana', [\App\Http\Controllers\Pemda\KampusMitraController::class, 'tambahDana'])->name('kampus-mitra.tambah-dana');
        Route::resource('/pendamping', \App\Http\Controllers\Pemda\PendampingController::class);
        Route::resource('/validator', \App\Http\Controllers\Pemda\ValidatorController::class);
        Route::get('/data-penerima/export', [\App\Http\Controllers\Pemda\DataPenerimaController::class, 'export'])->name('data-penerima.export');
        Route::get('/data-penerima/template', [\App\Http\Controllers\Pemda\DataPenerimaController::class, 'downloadTemplate'])->name('data-penerima.template');
        Route::post('/data-penerima/import', [\App\Http\Controllers\Pemda\DataPenerimaController::class, 'import'])->name('data-penerima.import');
        Route::resource('/data-penerima', \App\Http\Controllers\Pemda\DataPenerimaController::class);
        Route::redirect('/penyaluran-bibit', '/pemda/monitoring')->name('penyaluran-bibit.index');
        Route::redirect('/validasi-lapangan', '/pemda/monitoring')->name('validasi-lapangan.index');
        Route::get('/monitoring/kecamatan/{id}', [\App\Http\Controllers\Pemda\MonitoringController::class, 'getKecamatanDetail'])->name('monitoring.kecamatan-detail');
        Route::resource('/monitoring', \App\Http\Controllers\Pemda\MonitoringController::class);
        Route::get('/laporan/cetak-pdf', [\App\Http\Controllers\Pemda\LaporanController::class, 'cetakPdf'])->name('laporan.pdf');
        Route::get('/laporan/penyaluran-pdf', [\App\Http\Controllers\Pemda\LaporanController::class, 'penyaluranPdf'])->name('laporan.penyaluran-pdf');
        Route::get('/laporan/tumbuh-kembang-pdf', [\App\Http\Controllers\Pemda\LaporanController::class, 'tumbuhKembangPdf'])->name('laporan.tumbuh-kembang-pdf');
        Route::get('/laporan/validasi-pdf', [\App\Http\Controllers\Pemda\LaporanController::class, 'validasiPdf'])->name('laporan.validasi-pdf');
        Route::resource('/laporan', \App\Http\Controllers\Pemda\LaporanController::class);
        Route::resource('/wilayah', \App\Http\Controllers\Pemda\WilayahController::class);
        Route::resource('/master-data/wilayah', \App\Http\Controllers\Pemda\WilayahController::class)->names('master-data.wilayah');
        Route::redirect('/master-data/jenis-bibit', '/pemda/wilayah')->name('master-data.jenis-bibit.index');
        Route::resource('/audit-log', \App\Http\Controllers\Pemda\AuditLogController::class);
        Route::resource('/pengaturan', \App\Http\Controllers\Pemda\PengaturanController::class);
    });
});

Route::middleware(['auth', 'role:kampus'])->group(function () {
    Route::get('/dashboard/kampus', [\App\Http\Controllers\Kampus\DashboardController::class, 'index'])->name('dashboard.kampus');
    Route::prefix('kampus')->name('kampus.')->group(function () {
        Route::resource('/program-bantuan', \App\Http\Controllers\Kampus\ProgramBantuanController::class);
        Route::post('/program-bantuan/{id}/item', [\App\Http\Controllers\Kampus\ProgramBantuanController::class, 'storeItem'])->name('program-bantuan.item.store');
        Route::delete('/program-bantuan/{programId}/item/{itemId}', [\App\Http\Controllers\Kampus\ProgramBantuanController::class, 'destroyItem'])->name('program-bantuan.item.destroy');
        Route::redirect('/pengadaan', '/kampus/program-bantuan')->name('pengadaan.index');
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
        Route::get('/keluarga_penerima-binaan/{id}/penilaian/create', [\App\Http\Controllers\Pendamping\PenilaianKemandirianController::class, 'create'])->name('keluarga_penerima.penilaian.create');
        Route::post('/keluarga_penerima-binaan/{id}/penilaian', [\App\Http\Controllers\Pendamping\PenilaianKemandirianController::class, 'store'])->name('keluarga_penerima.penilaian.store');
        Route::get('/monitoring-kemandirian', [\App\Http\Controllers\Pendamping\MonitoringKemandirianController::class, 'index'])->name('kemandirian.index');
        Route::resource('/penyaluran-bantuan', \App\Http\Controllers\Pendamping\PenyaluranBantuanController::class)->names('penyaluran-bantuan');
        Route::get('/pantau-penyaluran', [\App\Http\Controllers\Pendamping\PantauPenyaluranController::class, 'index'])->name('pantau-penyaluran.index');
        Route::get('/penyaluran-bantuan-items/{programId}', [\App\Http\Controllers\Pendamping\PenyaluranBantuanController::class, 'getItemsByProgram'])->name('penyaluran-bantuan.items');
    });
});

Route::middleware(['auth', 'role:validator'])->group(function () {
    Route::get('/dashboard/validator', [\App\Http\Controllers\Validator\DashboardController::class, 'index'])->name('dashboard.validator');
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


