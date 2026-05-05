<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    // app/Http/Middleware/CheckRole.php
public function handle(Request $request, Closure $next, string $role)
{
    if (!auth()->check() || auth()->user()->role !== $role) {
        abort(403, 'Akses tidak diizinkan.');
    }
    return $next($request);
}
}
