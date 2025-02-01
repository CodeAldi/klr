<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        if ($request->user()->role == UserRole::tryFrom($role)) {
            return $next($request);
        }
        abort(403, 'Akun tidak memiliki level akses yang cukup untuk mengakases halaman ini');
    }
}
