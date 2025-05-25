<?php
namespace App\Http\Controllers\Api;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return response()->json(["status" => "success", "data" => Dosen::all()]);
    }

    public function show(Dosen $dosen)
    {
        return response()->json(["status" => "success", "data" => $dosen]);
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nama' => 'sometimes|string',
            'nidn' => 'sometimes|string|unique:dosen,nidn,' . $dosen->id,
            'bidang_studi' => 'sometimes|string',
            'prodi' => 'sometimes|string',
        ]);

        $dosen->update($validated);
        return response()->json(["status" => "success", "data" => $dosen]);
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return response()->json(["status" => "success", "message" => "Deleted successfully"]);
    }
}