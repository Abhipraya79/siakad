<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
   public function show(string $role)
    {
        if (!in_array($role, ['mahasiswa','dosen'])) {
            abort(404);
        }
        return view('auth.login', compact('role'));
    }

    public function authenticate(Request $request)
    {
        // Validasi input: gunakan username bukan username
        $request->validate([
            'username' => 'required|string',
            'password'   => 'required|string',
            'role'       => 'required|in:mahasiswa,dosen',
        ]);

        $role  = $request->input('role');
        $guard = 'web_' . $role; // Contoh: web_mahasiswa

        
        // Ambil user dari tabel sesuai role
        if ($role === 'mahasiswa') {
            $user = Mahasiswa::where('nrp', $request->username)->first();
        } else {
            $user = Dosen::where('nidn', $request->username)->first();
        }

        // Cek kredensial
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'username' => 'username atau password salah.',
            ])->withInput();
        }

        // Login via guard session
        Auth::guard($guard)->login($user);
        $request->session()->regenerate();

        // Redirect sesuai role
        return redirect()->route("{$role}.dashboard");
    }

    public function logout(Request $request)
    {
        Auth::guard('mahasiswa')->logout();
        Auth::guard('dosen')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
