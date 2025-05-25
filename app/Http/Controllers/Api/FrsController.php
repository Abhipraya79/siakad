<?php

namespace App\Http\Controllers\Api;                // ✔️ namespace Api

use App\Http\Controllers\Controller; 
use App\Models\FRS;
use Illuminate\Http\Request;

class FrsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $frs = Frs::with(['mahasiswa','jadwalKuliah','dosenWali'])->get();
        return response()->json(["status" => "success", "data" => $frs]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswa,id_mahasiswa',
            'id_jadwal_kuliah' => 'required|exists:jadwal_kuliah,id_jadwal_kuliah',
            'id_dosen_wali' => 'required|exists:dosen_wali,id_dosen_wali',
            'semester' => 'required|integer',
        ]);

        $frs = Frs::create($validated);
        return response()->json(["status" => "success", "data" => $frs], 201);
    }

    public function show(Frs $frs)
    {
        return response()->json(["status" => "success", "data" => $frs->load(['mahasiswa','jadwalKuliah','dosenWali'])]);
    }

    public function update(Request $request, Frs $frs)
    {
        $validated = $request->validate([
            'status_acc' => 'sometimes|required|in:pending,approved,rejected',
            'semester' => 'sometimes|required|integer',
        ]);

        $frs->update($validated);
        return response()->json(["status" => "success", "data" => $frs]);
    }

    public function destroy(Frs $frs)
    {
        $frs->delete();
        return response()->json(["status" => "success", "message" => "Deleted successfully"]);
    }
}