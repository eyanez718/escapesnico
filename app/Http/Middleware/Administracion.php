<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Administracion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->id_rol == 1) {
            return $next($request);
        } elseif ($user && $user->id_rol == 2 &&
                    ($request->segment(1) == 'proveedores' ||
                    $request->segment(1) == 'stock' ||
                    $request->segment(1) == 'insumos' ||
                    $request->segment(1) == 'compras')
        ) {
            return $next($request);
        }

        abort(403, 'Acceso denegado.');
    }
}
