<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // Tampilkan semua data mahasiswa
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return response()->json([
            "status" => "success",
            "data" => $mahasiswa
        ]);
    }

    // Detail mahasiswa berdasarkan ID
    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                "status" => "error",
                "message" => "Mahasiswa tidak ditemukan"
            ], 404);
        }

        return response()->json([
            "status" => "success",
            "data" => $mahasiswa
        ]);
    }

    // Update data mahasiswa
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                "status" => "error",
                "message" => "Mahasiswa tidak ditemukan"
            ], 404);
        }

        $validated = $request->validate([
            'nama' => 'sometimes|string|max:100',
            'nrp' => 'sometimes|string|unique:mahasiswa,nrp,' . $id . ',id_mahasiswa',
            'prodi' => 'sometimes|string|max:100',
            'tahun_masuk' => 'sometimes|digits:4',
        ]);

        $mahasiswa->update($validated);

        return response()->json([
            "status" => "success",
            "message" => "Data mahasiswa berhasil diperbarui",
            "data" => $mahasiswa
        ]);
    }

    // Hapus data mahasiswa
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                "status" => "error",
                "message" => "Mahasiswa tidak ditemukan"
            ], 404);
        }

        $mahasiswa->delete();

        return response()->json([
            "status" => "success",
            "message" => "Mahasiswa berhasil dihapus"
        ]);
    }
}
