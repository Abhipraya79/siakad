<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', fn() => view('welcome'))->name('welcome');

Route::get('/login', fn() => redirect()->route('login.role', ['role' => 'mahasiswa']))->name('login');

Route::middleware('guest')->group(function () {
    Route::get('/login/{role}', [LoginController::class, 'show'])->name('login.role');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.perform');
});

Route::middleware(['web'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// ===================== MAHASISWA ROUTES =====================
Route::prefix('mahasiswa')
    ->name('mahasiswa.')
    ->middleware('auth:mahasiswa')
    ->group(function () {
        Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');
        Route::get('/frs',         [FRSController::class, 'index'])->name('frs.index');
        Route::get('/frs/create',  [FRSController::class, 'create'])->name('frs.create');
        Route::post('/frs',        [FRSController::class, 'store'])->name('frs.store');
        Route::delete('/frs/{id}', [FRSController::class, 'destroy'])->name('frs.destroy'); 
        Route::get('/jadwal',      [JadwalKuliahController::class, 'jadwalMahasiswa'])->name('jadwal.index');
        Route::get('/nilai',       [NilaiController::class, 'nilaiMahasiswa'])->name('nilai.index');
    });

// ===================== DOSEN ROUTES =====================
Route::prefix('dosen')
    ->name('dosen.')
    ->middleware('auth:dosen')
    ->group(function () {
        Route::get('/dashboard', [DosenController::class, 'dashboard'])->name('dashboard');
        Route::get('/frs',                  [FRSController::class, 'approvalIndex'])->name('frs.index');
        Route::post('/frs/{id}/approve',    [FRSController::class, 'approve'])->name('frs.approve');
        Route::post('/frs/{id}/reject',     [FRSController::class, 'reject'])->name('frs.reject');
        // Nilai - Dosen
        Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
        Route::get('/nilai/create/{id_frs}', [NilaiController::class, 'create'])->name('nilai.create');
        Route::post('/nilai', [NilaiController::class, 'store'])->name('nilai.store');
        Route::get('/nilai/{id_nilai}/edit', [NilaiController::class, 'edit'])->name('nilai.edit');
        Route::put('/nilai/{id_nilai}', [NilaiController::class, 'update'])->name('nilai.update'); // ✅ Tambahkan ini
        Route::get('/jadwal',               [JadwalKuliahController::class, 'jadwalDosen'])->name('jadwal.index');
    
        });