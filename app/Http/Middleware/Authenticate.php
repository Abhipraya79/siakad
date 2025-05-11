<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
{
    if (! $request->expectsJson()) {
        // Ambil prefix URL seperti 'mahasiswa' atau 'dosen'
        $prefix = $request->route()?->getPrefix();

        // Jika prefix adalah 'mahasiswa' atau 'dosen', arahkan ke halaman login sesuai role
        if (in_array($prefix, ['mahasiswa', 'dosen'])) {
            return route('login.role', ['role' => $prefix]);
        }

        // Default fallback ke login mahasiswa
        return route('login.role', ['role' => 'mahasiswa']);
    }

    return null;
}
}

