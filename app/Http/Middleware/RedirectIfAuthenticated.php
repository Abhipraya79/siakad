<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        Log::info('RedirectIfAuthenticated dipanggil', [
            'path' => $request->path(),
            'guards' => empty($guards) ? ['default'] : $guards
        ]);
        
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            Log::info("Checking guard: " . ($guard ?? 'default'), [
                'is_authenticated' => Auth::guard($guard)->check() ? 'yes' : 'no'
            ]);
            
            if (Auth::guard($guard)->check()) {
                Log::info("User sudah terotentikasi dengan guard: " . ($guard ?? 'default'));
                
                if ($guard === 'mahasiswa') {
                    return redirect('/mahasiswa/dashboard'); // Gunakan URL langsung
                }
                
                if ($guard === 'dosen') {
                    return redirect('/dosen/dashboard'); // Gunakan URL langsung
                }
                
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}