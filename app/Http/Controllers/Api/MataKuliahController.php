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

    public function index()
    {
        return response()->json(["status" => "success", "data" => MataKuliah::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_mata_kuliah' => 'required|unique:mata_kuliah',
            'nama_mata_kuliah' => 'required',
            'sks' => 'required|integer',
        ]);

        $mataKuliah = MataKuliah::create($validated);
        return response()->json(["status" => "success", "data" => $mataKuliah], 201);
    }

    public function show(MataKuliah $mataKuliah)
    {
        return response()->json(["status" => "success", "data" => $mataKuliah]);
    }

    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $validated = $request->validate([
            'kode_mata_kuliah' => 'sometimes|required|unique:mata_kuliah,kode_mata_kuliah,' . $mataKuliah->id,
            'nama_mata_kuliah' => 'sometimes|required',
            'sks' => 'sometimes|required|integer',
        ]);

        $mataKuliah->update($validated);
        return response()->json(["status" => "success", "data" => $mataKuliah]);
    }

    public function destroy(MataKuliah $mataKuliah)
    {
        $mataKuliah->delete();
        return response()->json(["status" => "success", "message" => "Deleted successfully"]);
    }
}