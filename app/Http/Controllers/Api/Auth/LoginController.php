<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Tampilkan form login per role
    public function show(string $role)
    {
        if (!in_array($role, ['mahasiswa','dosen'])) {
            abort(404);
        }
        return view('auth.login', compact('role'));
    }

    // Proses autentikasi
    public function authenticate(Request $request)
    {
        $role = $request->input('role');
        $guard = $role; // nama guard = 'mahasiswa' atau 'dosen'

        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard($guard)->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route("$role.dashboard");
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput(['username' => $credentials['username']]);
    }

    // Logout kedua guard
    public function logout(Request $request)
    {
        Auth::guard('mahasiswa')->logout();
        Auth::guard('dosen')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
