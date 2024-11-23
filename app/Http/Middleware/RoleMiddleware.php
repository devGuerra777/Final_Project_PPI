<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (auth()->check() && auth()->user()->role === $role) {
            return $next($request);
        }

        // Redirige al usuario si no tiene permiso
        return redirect()->route('products.index')->with('error', 'No tienes acceso a esta sección.');
    }
}