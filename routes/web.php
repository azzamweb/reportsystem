<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\DesaController;
use App\Http\Controllers\Admin\LaporanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\JenisLaporanController;
use App\Http\Controllers\Admin\TindakLanjutController;

use App\Http\Controllers\Admin\SumberDanaController;



Route::get('/', function () {
    return view('welcome');
});

// Rute untuk pengguna yang sudah login
Route::middleware('auth')->group(function () {
    // CRUD untuk user
    Route::resource('users', UserController::class);

    // CRUD untuk kecamatan
    Route::resource('kecamatans', KecamatanController::class);

    // CRUD untuk desa
    Route::resource('desas', DesaController::class);

    // CRUD untuk laporan
    Route::resource('laporans', LaporanController::class);
    //jenis laporan 
    Route::resource('jenis_laporans', JenisLaporanController::class);


    // Tambahan rute untuk form laporan
    Route::post('/laporans', [LaporanController::class, 'store'])->name('laporans.store');

    // API untuk dropdown desa berdasarkan kecamatan
    Route::get('/get-desas/{kecamatan}', [DesaController::class, 'getDesas']);

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //tindaklanjut
Route::resource('tindaklanjut', TindakLanjutController::class);
Route::get('/tindaklanjut/create', [TindakLanjutController::class, 'create'])->name('tindaklanjut.create');


//autocomplete nama penerima
Route::get('/laporan-autocomplete', [LaporanController::class, 'autocomplete'])->name('laporan.autocomplete');


});

// Rute untuk dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/get-desas/{kecamatan}', [DesaController::class, 'getDesas']);
Route::get('/laporans/{id}', [LaporanController::class, 'show'])->name('laporans.show');

Route::get('/peta-sebaran', [LaporanController::class, 'map'])->name('laporans.map');

//sumberdana 
Route::resource('sumber_dana', SumberDanaController::class);

Route::get('/fitur-belum-tersedia', function () {
    return view('feature_unavailable');
})->name('feature.unavailable');







// Auth routes
require __DIR__.'/auth.php';
