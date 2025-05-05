<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\FRSController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\JadwalKuliahController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman awal (Welcome)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route untuk guest (belum login)
// ...
Route::middleware(['guest'])->group(function () {
    Route::get('/login',   [AuthenticatedSessionController::class, 'create'])
         ->name('login');
    Route::get('/login/{role}', [AuthenticatedSessionController::class, 'createWithRole'])
         ->name('login.role');
    Route::post('/login',  [AuthenticatedSessionController::class, 'store'])
         ->name('login.process');
});
// ...


// Route untuk semua user yang sudah login
Route::middleware(['auth'])->group(function () {
    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
         ->name('logout');

    // ===================== MAHASISWA ROUTES =====================
    Route::middleware(['role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])
             ->name('dashboard');

        // FRS
        Route::get('/frs',    [FRSController::class, 'index'])->name('frs.index');
        Route::get('/frs/create', [FRSController::class, 'create'])->name('frs.create');
        Route::post('/frs',   [FRSController::class, 'store'])->name('frs.store');
        Route::get('/frs/{id}', [FRSController::class, 'show'])->name('frs.show');

        // Jadwal
        Route::get('/jadwal', [JadwalKuliahController::class, 'jadwalMahasiswa'])
             ->name('jadwal.index');

        // Nilai
        Route::get('/nilai',  [NilaiController::class, 'nilaiMahasiswa'])->name('nilai.index');
    });

    // ===================== DOSEN ROUTES =====================
    Route::middleware(['role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
        Route::get('/dashboard', [DosenController::class, 'dashboard'])
             ->name('dashboard');

        // FRS Approval
        Route::get('/frs',            [FRSController::class, 'approvalIndex'])->name('frs.index');
        Route::post('/frs/{id}/approve', [FRSController::class, 'approve'])->name('frs.approve');
        Route::post('/frs/{id}/reject',  [FRSController::class, 'reject'])->name('frs.reject');

        // Nilai
        Route::get('/nilai',          [NilaiController::class, 'index'])->name('nilai.index');
        Route::get('/nilai/create/{id}', [NilaiController::class, 'create'])->name('nilai.create');
        Route::post('/nilai/{id}',    [NilaiController::class, 'store'])->name('nilai.store');
        Route::get('/nilai/{id}/edit',[NilaiController::class, 'edit'])->name('nilai.edit');
        Route::put('/nilai/{id}',     [NilaiController::class, 'update'])->name('nilai.update');

        // Jadwal
        Route::get('/jadwal', [JadwalKuliahController::class, 'jadwalDosen'])
             ->name('jadwal.index');
    });
});
