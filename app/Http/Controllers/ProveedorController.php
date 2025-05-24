<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    /**
     * Retorna la vista de proveedores
     * 
     * @return vista proveedores.index
     */
    public function index()
    {
        $proveedores = Proveedor::all();

        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Retorna la vista de creación de un proveedor
     * 
     * @return vista proveedores.create
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Agrega un nuevo proveedor
     * 
     * @param Request $request
     * @return redirección ruta proveedores.index
     */
    public function store(Request $request)
    {
        $this->createValidator($request->all())->validate();
        Proveedor::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'email' => $request->email,
        ]);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor agregado correctamente');
    }

    /**
     * Retorna la vista de un proveedor
     * 
     * @param int $id
     * @return vista proveedores.show
     */
    public function show(int $id)
    {
        $proveedor = Proveedor::find($id);

        return view('proveedores.show', compact('proveedor'));
    }

    /**
     * Retorna la vista de edición de un proveedor
     * 
     * @param int $id
     * @return vista proveedores.edit
     */
    public function edit(int $id)
    {
        $proveedor = Proveedor::find($id);

        return view('proveedores.edit', compact('proveedor'));
    }

    /**
     * Actualiza un proveedor
     * 
     * @param Request $request
     * @param int $id
     * @return redirección ruta proveedores.index
     */
    public function update(Request $request, int $id)
    {
        $this->updateValidator($request->all())->validate();
        $proveedor = Proveedor::find($id);
        $proveedor->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'email' => $request->email,
        ]);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Validación para la creación de un proveedor
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createValidator(array $data)
    {
        $reglas = [
            'nombre' => 'required|unique:proveedores,nombre',
            'descripcion' => 'required',
            'email' => 'required|email|unique:proveedores,email',
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'nombre.required' => 'El nombre de proveedor es requerido',
            'nombre.unique' => 'Ya existe un proveedor con ese nombre',
            'descripcion.required' => 'La descripcion es requerida',
            'email.required' => 'El email es requerido',
            'email.email' => 'El formato del email es incorrecto',
            'email.unique' => 'Ya existe un proveedor con ese email',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }

    /**
     * Validación para la actualización de un proveedor
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function updateValidator(array $data)
    {
        $reglas = [
            'nombre' => 'required|unique:proveedores,nombre,' . $data['id'],
            'descripcion' => 'required',
            'email' => 'required|email|unique:proveedores,email,' . $data['id'],
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'nombre.required' => 'El nombre de proveedor es requerido',
            'nombre.unique' => 'Ya existe un proveedor con ese nombre',
            'descripcion.required' => 'La descripcion es requerida',
            'email.required' => 'El email es requerido',
            'email.email' => 'El formato del email es incorrecto',
            'email.unique' => 'Ya existe un proveedor con ese email',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }
}
