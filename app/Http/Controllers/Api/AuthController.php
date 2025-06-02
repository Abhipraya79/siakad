<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Handle login for mahasiswa or dosen via Sanctum token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
{
    $validated = $request->validate([
    'identifier' => 'required_without:username|string',
    'username'   => 'required_without:identifier|string',
    'password'   => 'required|string',
]);

$identifier = $validated['identifier'] ?? $validated['username'];

    $password   = $validated['password'];
    $user       = null;
    $role       = null;

    /* ---------- ganti bagian pencarian user ---------- */

    // cari di tabel mahasiswa dengan kolom username
    $mahasiswa = Mahasiswa::where('username', $identifier)->first();
    if ($mahasiswa && Hash::check($password, $mahasiswa->password)) {
        $user = $mahasiswa;
        $role = 'mahasiswa';
    }

    // kalau belum ketemu, coba di tabel dosen
    if (!$user) {
        $dosen = Dosen::where('username', $identifier)->first();
        if ($dosen && Hash::check($password, $dosen->password)) {
            $user = $dosen;
            $role = 'dosen';
        }
    }

    /* ---------- sisanya tetap sama ---------- */

    if (!$user) {
        return response()->json([
            'status'  => 'error',
            'message' => 'Username atau password salah.',
        ], 401);
    }

    $user->tokens()->delete();                       // hapus token lama
    $token = $user->createToken("{$role}-token")->plainTextToken;

    return response()->json([
        'status' => 'success',
        'data'   => [
            'user'  => $user,
            'role'  => $role,
            'token' => $token,
        ],
    ]); 
}

    /**
     * Logout user by deleting current access token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        /** @var \Laravel\Sanctum\PersonalAccessToken|null $token */
        $token = $request->user()->currentAccessToken();

        if ($token) {
            $token->delete();
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Berhasil logout',
        ]);
    }
}
