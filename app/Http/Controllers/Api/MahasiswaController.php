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

    public function index()
    {
        return response()->json(["status" => "success", "data" => Mahasiswa::all()]);
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return response()->json(["status" => "success", "data" => $mahasiswa]);
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nama' => 'sometimes|string',
            'nrp' => 'sometimes|string|unique:mahasiswa,nrp,' . $mahasiswa->id,
            'prodi' => 'sometimes|string',
            'tahun_masuk' => 'sometimes|digits:4',
        ]);

        $mahasiswa->update($validated);
        return response()->json(["status" => "success", "data" => $mahasiswa]);
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return response()->json(["status" => "success", "message" => "Deleted successfully"]);
    }
}