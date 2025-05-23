<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Procesa el login de usuario
     * 
     * @param Request $request
     * @return redirección home
     */
    public function login(Request $request)
    {
        $credentials = $request->only('nombre', 'contrasenia');

        if (Auth::attempt(['nombre' => $credentials['nombre'], 'password' => $credentials['contrasenia']])) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'nombre' => 'Nombre de usuario o contraseña incorrectos',
        ]);
    }
}