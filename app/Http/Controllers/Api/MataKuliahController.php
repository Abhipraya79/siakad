<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // List semua mata kuliah
    public function index()
    {
        $mataKuliah = MataKuliah::all();
        return response()->json([
            "status" => "success",
            "data" => $mataKuliah
        ]);
    }

    // Tambah mata kuliah baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_mata_kuliah' => 'required|unique:mata_kuliah,kode_mata_kuliah',
            'nama_mata_kuliah' => 'required|string|max:100',
            'sks' => 'required|integer|min:1|max:8',
        ]);

        $mataKuliah = MataKuliah::create($validated);

        return response()->json([
            "status" => "success",
            "message" => "Mata kuliah berhasil ditambahkan",
            "data" => $mataKuliah
        ], 201);
    }

    // Detail mata kuliah
    public function show($id)
    {
        $mataKuliah = MataKuliah::find($id);

        if (!$mataKuliah) {
            return response()->json([
                "status" => "error",
                "message" => "Mata kuliah tidak ditemukan"
            ], 404);
        }

        return response()->json([
            "status" => "success",
            "data" => $mataKuliah
        ]);
    }

    // Update data mata kuliah
    public function update(Request $request, $id)
    {
        $mataKuliah = MataKuliah::find($id);

        if (!$mataKuliah) {
            return response()->json([
                "status" => "error",
                "message" => "Mata kuliah tidak ditemukan"
            ], 404);
        }

        $validated = $request->validate([
            'kode_mata_kuliah' => 'sometimes|required|unique:mata_kuliah,kode_mata_kuliah,' . $id . ',id_mata_kuliah',
            'nama_mata_kuliah' => 'sometimes|required|string|max:100',
            'sks' => 'sometimes|required|integer|min:1|max:8',
        ]);

        $mataKuliah->update($validated);

        return response()->json([
            "status" => "success",
            "message" => "Mata kuliah berhasil diperbarui",
            "data" => $mataKuliah
        ]);
    }

    // Hapus mata kuliah
    public function destroy($id)
    {
        $mataKuliah = MataKuliah::find($id);

        if (!$mataKuliah) {
            return response()->json([
                "status" => "error",
                "message" => "Mata kuliah tidak ditemukan"
            ], 404);
        }

        $mataKuliah->delete();

        return response()->json([
            "status" => "success",
            "message" => "Mata kuliah berhasil dihapus"
        ]);
    }
}
