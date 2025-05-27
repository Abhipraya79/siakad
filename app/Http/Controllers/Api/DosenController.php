<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Frs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DosenController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data'   => Dosen::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_dosen'     => 'required|unique:dosens',
            'nama'         => 'required|string|max:100',
            'ndin'         => 'required|unique:dosens',
            'bidang_studi' => 'required|string|max:50',
            'prodi'        => 'required|string|max:50',
            'username'     => 'required|unique:dosens',
            'password'     => 'required|min:6'
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['is_dosen_wali'] = $request->has('is_dosen_wali');

        $dosen = Dosen::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Dosen berhasil ditambahkan',
            'data' => $dosen
        ], 201);
    }

    public function show($id)
    {
        $dosen = Dosen::find($id);
        if (!$dosen) {
            return response()->json(['status' => 'error', 'message' => 'Dosen tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $dosen
        ]);
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::find($id);
        if (!$dosen) {
            return response()->json(['status' => 'error', 'message' => 'Dosen tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama'         => 'required|string|max:100',
            'bidang_studi' => 'required|string|max:50',
            'prodi'        => 'required|string|max:50',
            'password'     => 'nullable|min:6'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        $validated['is_dosen_wali'] = $request->has('is_dosen_wali');

        $dosen->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data dosen berhasil diperbarui',
            'data' => $dosen
        ]);
    }

    public function destroy($id)
    {
        $dosen = Dosen::find($id);
        if (!$dosen) {
            return response()->json(['status' => 'error', 'message' => 'Dosen tidak ditemukan'], 404);
        }

        $dosen->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Dosen berhasil dihapus'
        ]);
    }

    public function dashboard(Request $request)
    {
        $dosen = $request->user(); // dari token

        if (!$dosen) {
            Log::error('Dosen tidak ditemukan di dashboard');
            return response()->json([
                'status' => 'error',
                'message' => 'Anda harus login terlebih dahulu.'
            ], 401);
        }

        Log::info('Dashboard dosen diakses', [
            'id_dosen' => $dosen->id_dosen ?? 'unknown',
            'username' => $dosen->username ?? 'unknown'
        ]);

        $mahasiswa = Mahasiswa::where('id_dosen_wali', $dosen->id_dosen)->get();
        $totalMahasiswa = $mahasiswa->count();

        $frsPending = Frs::whereIn('id_mahasiswa', $mahasiswa->pluck('id_mahasiswa'))
            ->where('status_acc', 'pending')
            ->with(['mahasiswa', 'jadwalKuliah.mataKuliah'])
            ->get();
        $totalFrsPending = $frsPending->count();

        $totalMataKuliah = $dosen->jadwalMataKuliah()->count();

        return response()->json([
            'status' => 'success',
            'data' => [
                'dosen'            => $dosen,
                'totalMahasiswa'   => $totalMahasiswa,
                'totalFrsPending'  => $totalFrsPending,
                'totalMataKuliah'  => $totalMataKuliah,
                'frsPending'       => $frsPending
            ]
        ]);
    }
}
