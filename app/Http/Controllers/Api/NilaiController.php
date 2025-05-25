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

    public function index()
    {
        $nilai = Nilai::with(['frs.mahasiswa','frs.jadwalKuliah'])->get();
        return response()->json(["status" => "success", "data" => $nilai]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_frs' => 'required|exists:frs,id_frs',
            'nilai_angka' => 'nullable|integer|min:0|max:100',
            'nilai_huruf' => 'nullable|string|max:2',
        ]);

        $nilai = Nilai::create($validated);
        return response()->json(["status" => "success", "data" => $nilai], 201);
    }

    public function show(Nilai $nilai)
    {
        return response()->json(["status" => "success", "data" => $nilai->load(['frs.mahasiswa','frs.jadwalKuliah'])]);
    }

    public function update(Request $request, Nilai $nilai)
    {
        $validated = $request->validate([
            'nilai_angka' => 'sometimes|integer|min:0|max:100',
            'nilai_huruf' => 'sometimes|string|max:2',
        ]);

        $nilai->update($validated);
        return response()->json(["status" => "success", "data" => $nilai]);
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return response()->json(["status" => "success", "message" => "Deleted successfully"]);
    }
}