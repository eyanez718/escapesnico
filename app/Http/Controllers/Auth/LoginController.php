<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only('nombre', 'contrasenia');

        if (Auth::attempt(['nombre' => $credentials['nombre'], 'password' => $credentials['contrasenia']])) {
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'nombre' => 'Nombre de usuario o contraseña incorrectos',
        ]);
    }
}