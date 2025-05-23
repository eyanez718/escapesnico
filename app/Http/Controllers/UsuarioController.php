<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Usuario;
use App\Models\Rol;

class UsuarioController extends Controller
{
    /**
     * Retorna la vista de usuarios
     * 
     * @return vista usuarios.index
     */
    public function index()
    {
        $usuarios = Usuario::with('rol')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Retorna la vista de creación de un usuario
     * 
     * @return vista usuarios.create
     */
    public function create()
    {
        $roles = Rol::all();

        return view('usuarios.create', compact('roles'));
    }

    /**
     * Agrega un nuevo usuario
     * 
     * @param Request $request
     * @return redirección usuarios.index
     */
    public function store(Request $request)
    {
        $this->createValidator($request->all())->validate();
        Usuario::create([
            'nombre' => $request->nombre,
            'nombre_completo' => $request->nombre_completo,
            'email' => $request->email,
            'id_rol' => $request->id_rol,
            'contrasenia' => Hash::make($request->contrasenia),
        ]);
        return redirect()->route('usuarios.index')->with('success', 'Usuario agregado correctamente');
    }

    /**
     * Retorna la vista de un usuario
     * 
     * @param int $id
     * @return vista usuarios.show
     */
    public function show(int $id)
    {
        $usuario = Usuario::with('rol')->find($id);
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Retorna la vista de edición de un usuario
     * 
     * @param int $id
     * @return vista usuarios.edit
     */
    public function edit(int $id)
    {
        $usuario = Usuario::with('rol')->find($id);
        $roles = Rol::all();

        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Actualiza un usuario
     * 
     * @param Request $request
     * @param int $id
     * @return redirección ruta usuarios.index
     */
    public function update(Request $request, int $id)
    {
        $this->updateValidator($request->all())->validate();
        $usuario = Usuario::find($id);
        $usuario->update($request->only('nombre', 'nombre_completo', 'email', 'id_rol'));
        
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Eliminación de usuario
     * 
     * @param int $id
     * @return redirect ruta usuarios.index
     */
    public function destroy(string $id)
    {
        return redirect()->route('usuarios.index');
    }

    /**
     * Validación para la actualización de un usuario
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function updateValidator(array $data)
    {
        $reglas = [
            'nombre' => 'required|unique:usuarios,nombre,' . $data['id'],
            'nombre_completo' => 'required',
            'email' => 'required|email|unique:usuarios,email,' . $data['id'],
            'id_rol' => 'required'
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'nombre.required' => 'El nombre de usuario es requerido',
            'nombre.unique' => 'Ya existe un usuario con ese nombre',
            'nombre_completo.required' => 'El nombre completo es requerido',
            'email.required' => 'El email es requerido',
            'email.email' => 'El formato del email es incorrecto',
            'email.unique' => 'Ya existe un usuario con ese email',
            'id_rol.required' => 'El rol es requerido',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }

    /**
     * Validación para la creación de un usuario
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createValidator(array $data)
    {
        $reglas = [
            'nombre' => 'required|unique:usuarios,nombre',
            'nombre_completo' => 'required',
            'email' => 'required|email|unique:usuarios,email',
            'id_rol' => 'required',
            'contrasenia' => 'required|confirmed',
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'nombre.required' => 'El nombre de usuario es requerido',
            'nombre.unique' => 'Ya existe un usuario con ese nombre',
            'nombre_completo.required' => 'El nombre completo es requerido',
            'email.required' => 'El email es requerido',
            'email.email' => 'El formato del email es incorrecto',
            'email.unique' => 'Ya existe un usuario con ese email',
            'id_rol.required' => 'El rol es requerido',
            'contrasenia.required' => 'La contraseña es requerida',
            'contrasenia.confirmed' => 'Las contraseñas ingresadas no coinciden',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }
}
