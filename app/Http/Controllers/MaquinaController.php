<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Maquina;

class MaquinaController extends Controller
{
    /**
     * Retorna la vista de las maquinas
     */
    public function index()
    {
        $maquinas = Maquina::all();

        return view('maquinas.index', compact('maquinas'));
    }

    /**
     * Retorna la vista de creación de una máquina
     * 
     * @return vista maquinas.index
     */
    public function create()
    {
        return view('maquinas.create');
    }

    /**
     * Agrega una nueva máquina
     * 
     * @param Request $request
     * @return redirección ruta maquinas.index
     */
    public function store(Request $request)
    {
        $this->createValidator($request->all())->validate();
        Maquina::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'usa_combustible' => $request->usa_combustible,
        ]);

        return redirect()->route('maquinas.index')->with('success', 'Máquina agregada correctamente');
    }

    /**
     * Retorna la vista de una máquina
     * 
     * @param int $id
     * @return vista maquinas.show
     */
    public function show(int $id)
    {
        $maquina = Maquina::find($id);

        return view('maquinas.show', compact('maquina'));
    }

    /**
     * Retorna la vista de edición de una máquina
     * 
     * @param int $id
     * @return vista maquinas.edit
     */
    public function edit(int $id)
    {
        $maquina = Maquina::find($id);

        return view('maquinas.edit', compact('maquina'));
    }

    /**
     * Actualiza una máquina
     * 
     * @param Request $request
     * @param int $id
     * @return redirección ruta maquinas.index
     */
    public function update(Request $request, int $id)
    {
        $this->updateValidator($request->all())->validate();
        $maquina = Maquina::find($id);
        $maquina->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'usa_combustible' => $request->usa_combustible,
        ]);

        return redirect()->route('maquinas.index')->with('success', 'Máquina actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Validación para creación de una máquina
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createValidator(array $data)
    {
        $reglas = [
            'nombre' => 'required|unique:maquinas,nombre',
            'descripcion' => 'required',
            'usa_combustible' => 'required|boolean',
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'nombre.required' => 'El nombre de la máquina es requerido',
            'nombre.unique' => 'Ya existe un máquina con ese nombre',
            'descripcion.required' => 'La descripción de la máquina es requerida',
            'usa_combustible.required' => 'Se requiere definir si usa o no combustible',
            'usa_combustible.boolean' => 'Debe definir si usa o no combustible correctamente',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }

    /**
     * Validación para actualización de una máquina
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function updateValidator(array $data)
    {
        $reglas = [
            'nombre' => 'required|unique:maquinas,nombre,' . $data['id'],
            'descripcion' => 'required',
            'usa_combustible' => 'required|boolean',
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'nombre.required' => 'El nombre de la máquina es requerido',
            'nombre.unique' => 'Ya existe un máquina con ese nombre',
            'descripcion.required' => 'La descripción de la máquina es requerida',
            'usa_combustible.required' => 'Se requiere definir si usa o no combustible',
            'usa_combustible.boolean' => 'Debe definir si usa o no combustible correctamente',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }
}
