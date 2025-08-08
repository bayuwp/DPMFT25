<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->email === 'admin@example.com') {
            return $next($request);
        }

        abort(403, 'Akses ditolak. Anda bukan admin.');
    }
}
