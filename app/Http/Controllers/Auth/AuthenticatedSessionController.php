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


    public function create(Request $request): View
    {
        $role = $request->query('role', self::ROLE_MAHASISWA);
        return view('auth.login', compact('role'));
    }
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        session()->regenerate();

        $user = Auth::user();
        $inputRole = request('role'); 

        if ($user->role !== $inputRole) {
            Auth::logout();
            return redirect()->route('login.role', ['role' => $inputRole])
                              ->withErrors([
                                  'username' => "Anda tidak memiliki akses sebagai {$inputRole}.",
                              ]);
        }

        if ($user->role === self::ROLE_MAHASISWA) {
            return redirect()->route('mahasiswa.dashboard');
        }

        if ($user->role === self::ROLE_DOSEN) {
            return redirect()->route('dosen.dashboard');
        }
        return redirect()->intended(RouteServiceProvider::HOME);
    }
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
