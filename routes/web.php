<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\FRSController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\JadwalKuliahController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route untuk guest (belum login)
Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

// Route untuk semua user yang sudah login
Route::middleware(['auth'])->group(function () {
    // Logout route
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Route untuk mahasiswa
    Route::middleware(['role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');
        
        // FRS Routes
        Route::get('/frs', [FRSController::class, 'index'])->name('frs.index');
        Route::get('/frs/create', [FRSController::class, 'create'])->name('frs.create');
        Route::post('/frs', [FRSController::class, 'store'])->name('frs.store');
        Route::get('/frs/{id}', [FRSController::class, 'show'])->name('frs.show');

        // Jadwal Routes
        Route::get('/jadwal', [JadwalKuliahController::class, 'jadwalMahasiswa'])->name('jadwal.index');
        
        // Nilai Routes
        Route::get('/nilai', [NilaiController::class, 'nilaiMahasiswa'])->name('nilai.index');
    });

    // Route untuk dosen
    Route::middleware(['role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
        Route::get('/dashboard', [DosenController::class, 'dashboard'])->name('dashboard');
        
        // FRS Approval Routes
        Route::get('/frs', [FRSController::class, 'approvalIndex'])->name('frs.index');
        Route::post('/frs/{id}/approve', [FRSController::class, 'approve'])->name('frs.approve');
        Route::post('/frs/{id}/reject', [FRSController::class, 'reject'])->name('frs.reject');
        
        // Nilai Routes
        Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
        Route::get('/nilai/create/{id}', [NilaiController::class, 'create'])->name('nilai.create');
        Route::post('/nilai/{id}', [NilaiController::class, 'store'])->name('nilai.store');
        Route::get('/nilai/{id}/edit', [NilaiController::class, 'edit'])->name('nilai.edit');
        Route::put('/nilai/{id}', [NilaiController::class, 'update'])->name('nilai.update');
        
        // Jadwal Mengajar
        Route::get('/jadwal', [JadwalKuliahController::class, 'jadwalDosen'])->name('jadwal.index');
    });
});
