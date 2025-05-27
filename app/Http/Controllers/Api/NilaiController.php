<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // List semua nilai (dengan relasi mahasiswa dan jadwal)
    public function index()
    {
        $nilai = Nilai::with(['frs.mahasiswa', 'frs.jadwalKuliah'])->get();

        return response()->json([
            "status" => "success",
            "data" => $nilai
        ]);
    }

    // Tambah nilai
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_frs' => 'required|exists:frs,id_frs',
            'nilai_angka' => 'nullable|integer|min:0|max:100',
            'nilai_huruf' => 'nullable|string|max:2',
        ]);

        $nilai = Nilai::create($validated);

        return response()->json([
            "status" => "success",
            "message" => "Nilai berhasil ditambahkan",
            "data" => $nilai->load(['frs.mahasiswa', 'frs.jadwalKuliah'])
        ], 201);
    }

    // Detail nilai
    public function show($id)
    {
        $nilai = Nilai::with(['frs.mahasiswa', 'frs.jadwalKuliah'])->find($id);

        if (!$nilai) {
            return response()->json([
                "status" => "error",
                "message" => "Nilai tidak ditemukan"
            ], 404);
        }

        return response()->json([
            "status" => "success",
            "data" => $nilai
        ]);
    }

    // Update nilai
    public function update(Request $request, $id)
    {
        $nilai = Nilai::find($id);

        if (!$nilai) {
            return response()->json([
                "status" => "error",
                "message" => "Nilai tidak ditemukan"
            ], 404);
        }

        $validated = $request->validate([
            'nilai_angka' => 'sometimes|integer|min:0|max:100',
            'nilai_huruf' => 'sometimes|string|max:2',
        ]);

        $nilai->update($validated);

        return response()->json([
            "status" => "success",
            "message" => "Nilai berhasil diupdate",
            "data" => $nilai->load(['frs.mahasiswa', 'frs.jadwalKuliah'])
        ]);
    }

    // Hapus nilai
    public function destroy($id)
    {
        $nilai = Nilai::find($id);

        if (!$nilai) {
            return response()->json([
                "status" => "error",
                "message" => "Nilai tidak ditemukan"
            ], 404);
        }

        $nilai->delete();

        return response()->json([
            "status" => "success",
            "message" => "Nilai berhasil dihapus"
        ]);
    }
}
