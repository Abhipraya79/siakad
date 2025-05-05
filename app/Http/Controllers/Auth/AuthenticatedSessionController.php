<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
    private const ROLE_DOSEN = 'dosen';
    private const ROLE_MAHASISWA = 'mahasiswa';

    /**
     * Tampilkan form login berdasarkan role (mahasiswa/dosen).
     */
    public function createWithRole(string $role): View
    {
        if (!in_array($role, [self::ROLE_MAHASISWA, self::ROLE_DOSEN])) {
            abort(404);
        }

        return view('auth.login', compact('role'));
    }

    /**
     * Tampilkan form login umum (jika ingin tanpa role di URL).
     */
    public function create(Request $request): View
    {
        // Bisa fallback ke mahasiswa atau default
        $role = $request->query('role', self::ROLE_MAHASISWA);
        return view('auth.login', compact('role'));
    }

    /**
     * Proses autentikasi dan redirect berdasarkan role.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        session()->regenerate();

        $user = Auth::user();
        $inputRole = request('role'); 

        // Pastikan login di halaman role yang sesuai
        if ($user->role !== $inputRole) {
            Auth::logout();
            return redirect()->route('login.role', ['role' => $inputRole])
                              ->withErrors([
                                  'username' => "Anda tidak memiliki akses sebagai {$inputRole}.",
                              ]);
        }

        // Redirect ke dashboard sesuai role
        if ($user->role === self::ROLE_MAHASISWA) {
            return redirect()->route('mahasiswa.dashboard');
        }

        if ($user->role === self::ROLE_DOSEN) {
            return redirect()->route('dosen.dashboard');
        }

        // Fallback ke HOME
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Logout user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
