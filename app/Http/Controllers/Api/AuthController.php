<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    /**
     * Login – mengeluarkan token Sanctum.
     * Body: username, password, role (mahasiswa|dosen|admin)
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'role'     => ['required', Rule::in(['mahasiswa', 'dosen', 'admin'])],
        ]);

        $guard = $validated['role'];

        // attempt() akan otomatis pakai provider pada guard tsb.
        if (! Auth::guard($guard)->attempt([
                'username' => $validated['username'],
                'password' => $validated['password']
            ])) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user  = Auth::guard($guard)->user();

        // Hapus token lama (opsional, satu‐device‐per‐user)
        $user->tokens()->delete();

        // Buat token baru; nama token bisa apa saja
        $token = $user->createToken($guard . '-token')->plainTextToken;

        return response()->json([
            'status' => true,
            'token'  => $token,
            'role'   => $guard,
            'user'   => $user,
        ]);
    }

    /**
     * Logout – menghapus token yang dipakai request saat ini.
     * Header harus memuat: Authorization: Bearer {token}
     */
    public function logout(Request $request)
    {
        // Sanctum sudah me‐resolve user sesuai token & guard
        if ($request->user() && $request->user()->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json(['status' => true, 'message' => 'Logged out']);
    }

    /**
     * (Opsional) Registrasi user baru – contoh mahasiswa.
     * Sesuaikan validasinya & pakai model khusus.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:100',
            'username' => 'required|string|max:30|unique:mahasiswa,username',
            'password' => 'required|string|min:6',
        ]);

        $mahasiswaModel = \App\Models\Mahasiswa::create([
            'nama'     => $validated['nama'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            // kolom lain…
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Account created',
            'user'    => $mahasiswaModel,
        ], 201);
    }
}
