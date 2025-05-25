<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    /**
     * GET /api/mahasiswa
     * Mengembalikan daftar mahasiswa dalam bentuk JSON.
     */
    public function index()
    {
        return response()->json(Mahasiswa::all());
    }

    // tambahkan show(), store(), update(), destroy() jika perlu
}
