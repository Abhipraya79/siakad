<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;

Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Route untuk mendapatkan data user
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    // Route untuk logout yang hanya bisa diakses oleh user yang sudah login
    Route::post('/logout', [LoginController::class, 'logout']);
});
