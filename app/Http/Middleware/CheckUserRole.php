<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        // Periksa apakah pengguna terotentikasi
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Periksa apakah peran pengguna termasuk dalam peran yang diizinkan
        foreach ($roles as $role) {
            if (auth()->user()->role === $role) {
                return $next($request);
            }
        }

        // Jika tidak ada peran yang sesuai, tampilkan halaman 403 Unauthorized
        return redirect()->back()->with('error', 'Unauthorized access!');
    }
}

