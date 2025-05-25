<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TipoUso;

class TipoUsoController extends Controller
{
    /**
     * Retorna la vista de tipos de uso
     * 
     * @return vista tipos_uso.index
     */
    public function index()
    {
        $tiposUso = TipoUso::all();

        return view('tipos_uso.index', compact('tiposUso'));
    }

    /**
     * Retorna la vista de creación de un tipo de uso
     * 
     * @return view tipos_uso.create
     */
    public function create()
    {
        return view('tipos_uso.create');
    }

    /**
     * Agrega un nuevo tipo de uso
     * 
     * @param Request $request
     * @return redirección ruta tipos_uso.index
     */
    public function store(Request $request)
    {
        $this->createValidator($request->all())->validate();
        TipoUso::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('tipos_uso.index')->with('success', 'Tipo de uso agregado correctamente');
    }

    /**
     * Retorna la vista de un tipo de uso
     * 
     * @param int $id
     * @return vista tipos_uso.show
     */
    public function show(int $id)
    {
        $tipoUso = TipoUso::find($id);

        return view('tipos_uso.show', compact('tipoUso'));
    }

    /**
     * Retorna la vista de edición de un tipo de uso
     * 
     * @param int $id
     * @return view tipos_uso.edit
     */
    public function edit(int $id)
    {
        $tipoUso = TipoUso::find($id);

        return view('tipos_uso.edit', compact('tipoUso'));
    }

    /**
     * Actualiza un tipo de uso
     * 
     * @param Request $request
     * @param int $id
     * @return redirección ruta tipos_uso.index
     */
    public function update(Request $request, string $id)
    {
        $this->updateValidator($request->all())->validate();
        $tipoUso = TipoUso::find($id);
        $tipoUso->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('tipos_uso.index')->with('success', 'Tipo de uso actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Validación para creación de un tipo de uso
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createValidator(array $data)
    {
        $reglas = [
            'nombre' => 'required|unique:tipos_uso,nombre',
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'nombre.required' => 'El nombre del tipo de uso es requerido',
            'nombre.unique' => 'Ya existe ese tipo de uso',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }

    /**
     * Validación para la actualización de un tipo de uso
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function updateValidator(array $data)
    {
        $reglas = [
            'nombre' => 'required|unique:tipos_uso,nombre,' . $data['id'],
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'nombre.required' => 'El nombre del tipo de uso es requerido',
            'nombre.unique' => 'Ya existe ese tipo de uso',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }
}
