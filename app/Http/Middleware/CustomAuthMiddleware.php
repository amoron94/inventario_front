<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('usuario_logueado') || now()->gt(session('session_expires_at'))) {
            // El usuario no está autenticado o la sesión ha expirado, redirigir a la página de inicio de sesión
            return redirect()->route('login_page');
        }
        return $next($request);
    }
}
