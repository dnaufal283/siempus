<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRoleIT
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah sudah login dan apakah role-nya 'it'
        if (Auth::check() && Auth::user()->role === 'it') {
            return $next($request);
        }

        // Jika bukan IT, tendang ke login atau kasih error
        abort(403, 'Akses Terlarang! Hanya Admin IT yang boleh masuk.');
    }
}
