<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        /** @var \Illuminate\Http\Request $request */
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->hasRole('dosen')) {
            return redirect()->intended(RouteServiceProvider::DOSEN_HOME);
        }

        if ($user->hasRole('mahasiswa')) {
            return redirect()->intended(RouteServiceProvider::MAHASISWA_HOME);
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        /** @var \Illuminate\Http\Request $request */
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}