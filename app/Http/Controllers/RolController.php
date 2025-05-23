<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Rol;

class RolController extends Controller
{
    /**
     * Retorna la vista de roles
     * 
     * @return vista roles.index
     */
    public function index()
    {
        $roles = Rol::all();

        return view('roles.index', compact('roles'));
    }

    /**
     * Retorna la vista de creación de un rol
     * 
     * @return vista roles.create
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Agrega un nuevo rol
     * 
     * @param Request $request
     * @return redirección roles.index
     */
    public function store(Request $request)
    {
        $this->createValidator($request->all())->validate();
        Rol::create($request->only('nombre', 'descripcion'));

        return redirect()->route('roles.index')->with('success', 'Rol agregado correctamente');
    }

    /**
     * Retorna la vista de un rol
     * 
     * @param int $id
     * @return vista roles.show
     */
    public function show(int $id)
    {
        $rol = Rol::find($id);

        return view('roles.show', compact('rol'));
    }

    /**
     * Retorna la vista de edición de un rol
     * 
     * @param int $id
     * @return vista roles.edit
     */
    public function edit(int $id)
    {
        $rol = Rol::find($id);

        return view('roles.edit', compact('rol'));
    }

    /**
     * Actualiza un rol
     * 
     * @param Request $request
     * @param int $id
     * @return redirección ruta roles.index
     */
    public function update(Request $request, int $id)
    {   
        $this->updateValidator($request->all())->validate();
        $rol = Rol::find($id);
        $rol->update($request->only('nombre', 'descripcion'));

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente');
    }

    /**
     * Eliminación de un rol
     * 
     * @param int $id
     * @return redirección ruta roles.index
     */
    public function destroy(int $id)
    {
        //$rol = Rol::find($id);
        //$rol->delete();

        //return redirect()->route('roles.index')->with('success', 'Rol eliminado.');
        return redirect()->route('roles.index');
    }

    /**
     * Validación para la actualización de un rol
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function updateValidator(array $data)
    {
        $reglas = [
            'nombre' => 'required|unique:roles,nombre,' . $data['id'],
            'descripcion' => 'required'
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'nombre.required' => 'El nombre del rol es requerido',
            'nombre.unique' => 'Ya existe un rol con ese nombre',
            'descripcion.required' => 'La descripción del rol es requerida',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }

    /**
     * Validación para creación de un rol
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createValidator(array $data)
    {
        $reglas = [
            'nombre' => 'required|unique:roles,nombre',
            'descripcion' => 'required'
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'nombre.required' => 'El nombre del rol es requerido',
            'nombre.unique' => 'Ya existe un rol con ese nombre',
            'descripcion.required' => 'La descripción del rol es requerida',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }
}
