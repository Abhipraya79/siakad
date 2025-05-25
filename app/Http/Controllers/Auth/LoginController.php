<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        
        $role = $request->input('role');
        $guard = $role;

        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        Log::info("Mencoba login sebagai $role", [
            'username' => $credentials['username']
        ]);

        try {
            
            if (Auth::guard($guard)->attempt($credentials)) {
                Log::info("Login $role berhasil");
                $userId = Auth::guard($guard)->id();
                $user = Auth::guard($guard)->user();
                if ($user) {
                    $userId = $user->id;
                    Log::info("User ID retrieved manually: $userId");
                } else {
                    Log::warning("User could not be retrieved.");
                }
                Log::info("User berhasil diautentikasi", [
                    'id' => $userId,
                    'username' => $user ? $user->username : 'null'
                ]);

                $request->session()->regenerate();
                $targetUrl = route("$role.dashboard");
                Log::info("Target URL: $targetUrl");

                if ($role === 'mahasiswa') {
                    Log::info("Menggunakan direct URL redirect ke /mahasiswa/dashboard");
                    return redirect('/mahasiswa/dashboard');
                } else {
                    return redirect('/dosen/dashboard');
                }
            }

           
            Log::warning("Login $role gagal untuk username: {$credentials['username']}");

           
            return back()->withErrors([
                'username' => 'Username atau password salah.',
            ])->withInput(['username' => $credentials['username']]);
        } catch (\Exception $e) {
            
            Log::error("Error saat autentikasi: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withErrors([
                'error' => 'Terjadi kesalahan sistem. Silakan coba lagi nanti.',
            ])->withInput(['username' => $credentials['username']]);
        }
    }

    /**
     * Logout kedua guard (mahasiswa dan dosen).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        try {
            if (Auth::guard('mahasiswa')->check()) {
                Log::info("Logging out mahasiswa: " . Auth::guard('mahasiswa')->user()->username);
            }
            if (Auth::guard('dosen')->check()) {
                Log::info("Logging out dosen: " . Auth::guard('dosen')->user()->username);
            }

            Auth::guard('mahasiswa')->logout();
            Auth::guard('dosen')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            Log::info("Logout berhasil, session invalidated");

            return redirect('/');
        } catch (\Exception $e) {
            Log::error("Error saat logout: " . $e->getMessage());
            return redirect('/');
        }
    }
}
