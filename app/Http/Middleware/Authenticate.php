<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
{
    if ($request->expectsJson()) {
        return null;
    }

    if ($request->is('mahasiswa') || $request->is('mahasiswa/*')) {
        return route('login.role', ['role' => 'mahasiswa']);
    }

    if ($request->is('dosen') || $request->is('dosen/*')) {
        return route('login.role', ['role' => 'dosen']);
    }

    // fallback ke login default (mahasiswa)
    return route('login.role', ['role' => 'mahasiswa']);
}


}
