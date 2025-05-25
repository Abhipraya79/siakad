<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\MataKuliahController;
use App\Http\Controllers\Api\RuanganController;
use App\Http\Controllers\Api\JadwalKuliahController;
use App\Http\Controllers\Api\FRSController;
use App\Http\Controllers\Api\NilaiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::prefix('auth')->group(function () {
    Route::post('login',    [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

// Protected by Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Auth actions
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return response()->json(["status" => "success", "data" => $request->user()]);
    });

    // CRUD resources
    Route::apiResource('mahasiswa', MahasiswaController::class);
    Route::apiResource('dosen',     DosenController::class);
    Route::apiResource('mata-kuliah', MataKuliahController::class);
    Route::apiResource('jadwal',    JadwalKuliahController::class);
    Route::apiResource('frs',       FRSController::class);
    Route::apiResource('nilai',     NilaiController::class);

    // Custom endpoints
    Route::get('jadwal/mahasiswa', [JadwalKuliahController::class, 'jadwalMahasiswa']);
    Route::get('nilai/mahasiswa',  [NilaiController::class,        'nilaiMahasiswa']);
    Route::get('jadwal/dosen',     [JadwalKuliahController::class, 'jadwalDosen']);
    Route::post('frs/{frs}/approve',[FRSController::class,          'approve']);
    Route::post('frs/{frs}/reject', [FRSController::class,          'reject']);
});

// Fallback for undefined routes
Route::fallback(function () {
    return response()->json(["status" => "error", "message" => "Endpoint not found."], 404);
});
