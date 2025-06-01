<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\FRSController;
use App\Http\Controllers\Api\NilaiController;
use App\Http\Controllers\Api\JadwalKuliahController;
use App\Http\Controllers\Api\MataKuliahController;

// ========== AUTH ==========

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// ========== DOSEN ==========

Route::middleware('auth:sanctum')->group(function () {
    // Dosen resource CRUD
    Route::get('/dosen', [DosenController::class, 'index']);
    Route::post('/dosen', [DosenController::class, 'store']);
    Route::get('/dosen/{id}', [DosenController::class, 'show']);
    Route::put('/dosen/{id}', [DosenController::class, 'update']);
    Route::delete('/dosen/{id}', [DosenController::class, 'destroy']);
    // Dashboard dosen
    Route::get('/dosen-dashboard', [DosenController::class, 'dashboard']);
});

// ========== MAHASISWA ==========

Route::middleware('auth:sanctum')->group(function () {
    // Mahasiswa resource CRUD
    Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
    Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show']);
    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update']);
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy']);
    // (tambahkan route 'store' jika ingin tambah mahasiswa lewat API)
});

// ========== MATA KULIAH ==========
Route::middleware('auth:sanctum')->get('/mahasiswa/nilai', [NilaiController::class, 'nilaiMahasiswa']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/mata-kuliah', [MataKuliahController::class, 'index']);
    Route::post('/mata-kuliah', [MataKuliahController::class, 'store']);
    Route::get('/mata-kuliah/{id}', [MataKuliahController::class, 'show']);
    Route::put('/mata-kuliah/{id}', [MataKuliahController::class, 'update']);
    Route::delete('/mata-kuliah/{id}', [MataKuliahController::class, 'destroy']);
});

// ========== FRS ==========

Route::middleware('auth:sanctum')->group(function () {
    // Mahasiswa FRS
    Route::get('/frs', [FRSController::class, 'index']); // List FRS milik mahasiswa
    Route::get('/frs/available-jadwal', [FRSController::class, 'availableJadwal']); // Jadwal yang bisa diambil mahasiswa
    Route::post('/frs', [FRSController::class, 'store']); // Ajukan FRS
    Route::delete('/frs/{id}', [FRSController::class, 'destroy']); // Batal FRS

    // Dosen FRS Approval
    Route::get('/frs-approval', [FRSController::class, 'approvalIndex']); // FRS untuk approval dosen
    Route::post('/frs/{id}/approve', [FRSController::class, 'approve']); // Setujui FRS
    Route::post('/frs/{id}/reject', [FRSController::class, 'reject']); // Tolak FRS
});

// ========== NILAI ==========

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/nilai', [NilaiController::class, 'index']);
    Route::post('/nilai', [NilaiController::class, 'store']);
    Route::get('/nilai/{id}', [NilaiController::class, 'show']);
    Route::put('/nilai/{id}', [NilaiController::class, 'update']);
    Route::delete('/nilai/{id}', [NilaiController::class, 'destroy']);
});

// ========== JADWAL KULIAH ==========

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/jadwal-kuliah', [JadwalKuliahController::class, 'index']);
    Route::post('/jadwal-kuliah', [JadwalKuliahController::class, 'store']);
    Route::get('/jadwal-kuliah/{id}', [JadwalKuliahController::class, 'show']);
    Route::put('/jadwal-kuliah/{id}', [JadwalKuliahController::class, 'update']);
    Route::delete('/jadwal-kuliah/{id}', [JadwalKuliahController::class, 'destroy']);
});

