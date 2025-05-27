<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;

class JadwalKuliahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // List seluruh jadwal kuliah
    public function index()
    {
        $jadwals = JadwalKuliah::with(['mataKuliah', 'dosen', 'ruangan'])->get();

        return response()->json([
            "status" => "success",
            "data" => $jadwals
        ]);
    }

    // Tambah jadwal kuliah
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_mata_kuliah' => 'required|exists:mata_kuliah,id_mata_kuliah',
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'id_ruang' => 'required|exists:ruangan,id_ruang',
            'kelas' => 'required|string|max:50',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_selesai' => 'required|date_format:H:i:s',
        ]);

        $jadwal = JadwalKuliah::create($validated);

        return response()->json([
            "status" => "success",
            "message" => "Jadwal kuliah berhasil ditambahkan",
            "data" => $jadwal->load(['mataKuliah', 'dosen', 'ruangan'])
        ], 201);
    }

    // Detail jadwal kuliah
    public function show($id)
    {
        $jadwalKuliah = JadwalKuliah::with(['mataKuliah','dosen','ruangan'])->find($id);

        if (!$jadwalKuliah) {
            return response()->json([
                "status" => "error",
                "message" => "Jadwal kuliah tidak ditemukan"
            ], 404);
        }

        return response()->json([
            "status" => "success",
            "data" => $jadwalKuliah
        ]);
    }

    // Update jadwal kuliah
    public function update(Request $request, $id)
    {
        $jadwalKuliah = JadwalKuliah::find($id);

        if (!$jadwalKuliah) {
            return response()->json([
                "status" => "error",
                "message" => "Jadwal kuliah tidak ditemukan"
            ], 404);
        }

        $validated = $request->validate([
            'id_mata_kuliah' => 'sometimes|required|exists:mata_kuliah,id_mata_kuliah',
            'id_dosen' => 'sometimes|required|exists:dosens,id_dosen',
            'id_ruang' => 'sometimes|required|exists:ruangan,id_ruang',
            'kelas' => 'sometimes|required|string|max:50',
            'hari' => 'sometimes|required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'sometimes|required|date_format:H:i:s',
            'jam_selesai' => 'sometimes|required|date_format:H:i:s',
        ]);

        $jadwalKuliah->update($validated);

        return response()->json([
            "status" => "success",
            "message" => "Jadwal kuliah berhasil diupdate",
            "data" => $jadwalKuliah->load(['mataKuliah', 'dosen', 'ruangan'])
        ]);
    }

    // Hapus jadwal kuliah
    public function destroy($id)
    {
        $jadwalKuliah = JadwalKuliah::find($id);

        if (!$jadwalKuliah) {
            return response()->json([
                "status" => "error",
                "message" => "Jadwal kuliah tidak ditemukan"
            ], 404);
        }

        $jadwalKuliah->delete();

        return response()->json([
            "status" => "success",
            "message" => "Jadwal kuliah berhasil dihapus"
        ]);
    }
}
