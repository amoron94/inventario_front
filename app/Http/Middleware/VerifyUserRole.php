<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        $usuario = session('usuario_logueado');
        //dd($role);

        // Verificar el rol del usuario
        if ($usuario['data']['tipo'] === $role)
        {
            return back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        return $next($request);
    }

}
