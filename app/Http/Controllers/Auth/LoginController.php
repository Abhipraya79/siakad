<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Dosen;

class LoginController extends Controller
{
    /**
     * Tampilkan form login berdasarkan role.
     *
     * @param  string  $role
     * @return \Illuminate\View\View
     */
    public function show(string $role)
    {
        // Validasi agar hanya 'mahasiswa' atau 'dosen' yang bisa mengakses
        if (!in_array($role, ['mahasiswa', 'dosen'])) {
            abort(404);
        }

        // Kirim data role ke view
        return view('auth.login', compact('role'));
    }

    /**
     * Proses autentikasi pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {
        // Ambil role dari input
        $role = $request->input('role');
        $guard = $role; // guard = 'mahasiswa' atau 'dosen'

        // Validasi input username dan password
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek apakah pengguna dengan kredensial yang diberikan ada
        if (Auth::guard($guard)->attempt($credentials)) {
            // Regenerasi session setelah berhasil login
            $request->session()->regenerate();

            // Redirect ke dashboard sesuai role (mahasiswa atau dosen)
            return redirect()->route("$role.dashboard");
        }

        // Jika login gagal, tampilkan pesan error
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput(['username' => $credentials['username']]);
    }

    /**
     * Logout kedua guard (mahasiswa dan dosen).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Logout dari kedua guard
        Auth::guard('mahasiswa')->logout();
        Auth::guard('dosen')->logout();

        // Hapus session dan regenerasi token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman utama
        return redirect('/');
    }
}
