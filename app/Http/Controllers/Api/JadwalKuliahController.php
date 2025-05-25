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

    public function index()
    {
        $jadwals = JadwalKuliah::with(['mataKuliah', 'dosen', 'ruangan'])->get();
        return response()->json(["status" => "success", "data" => $jadwals]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_mata_kuliah' => 'required|exists:mata_kuliah,id_mata_kuliah',
            'id_dosen' => 'required|exists:dosen,id_dosen',
            'id_ruang' => 'required|exists:ruangan,id_ruang',
            'kelas' => 'required|string',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_selesai' => 'required|date_format:H:i:s',
        ]);

        $jadwal = JadwalKuliah::create($validated);
        return response()->json(["status" => "success", "data" => $jadwal], 201);
    }

    public function show(JadwalKuliah $jadwalKuliah)
    {
        return response()->json(["status" => "success", "data" => $jadwalKuliah->load(['mataKuliah','dosen','ruangan'])]);
    }

    public function update(Request $request, JadwalKuliah $jadwalKuliah)
    {
        $validated = $request->validate([
            'id_mata_kuliah' => 'sometimes|required|exists:mata_kuliah,id_mata_kuliah',
            'id_dosen' => 'sometimes|required|exists:dosen,id_dosen',
            'id_ruang' => 'sometimes|required|exists:ruangan,id_ruang',
            'kelas' => 'sometimes|required|string',
            'hari' => 'sometimes|required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'sometimes|required|date_format:H:i:s',
            'jam_selesai' => 'sometimes|required|date_format:H:i:s',
        ]);

        $jadwalKuliah->update($validated);
        return response()->json(["status" => "success", "data" => $jadwalKuliah]);
    }

    public function destroy(JadwalKuliah $jadwalKuliah)
    {
        $jadwalKuliah->delete();
        return response()->json(["status" => "success", "message" => "Deleted successfully"]);
    }
}