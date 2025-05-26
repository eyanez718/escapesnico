<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Insumo;
use App\Models\TipoVehiculo;
use App\Models\TipoUso;

class InsumoController extends Controller
{
    /**
     * Retorna la vista de insumos
     * 
     * @return view insumos.index
     */
    public function index()
    {
        $insumos = Insumo::all();

        return view('insumos.index', compact('insumos'));
    }

    /**
     * Retorna la vista de creación de un insumo
     * 
     * @return view insumos.create
     */
    public function create()
    {
        $tiposUso = TipoUso::all();
        $tiposVehiculo = TipoVehiculo::all();

        return view('insumos.create', compact('tiposUso', 'tiposVehiculo'));
    }

    /**
     * Agrega un insumo
     * 
     * @param Request $request
     * @return redirección ruta insumos.index
     */
    public function store(Request $request)
    {
        $this->createValidator($request->all())->validate();
        Insumo::create([
            'codigo' => $request->codigo,
            'descripcion' => $request->descripcion,
            'cantidad' => $request->cantidad,
            'id_tipo_uso' => $request->id_tipo_uso,
            'id_tipo_vehiculo' => $request->id_tipo_vehiculo,
            'costo_unitario' => $request->costo_unitario,
        ]);
        return redirect()->route('insumos.index')->with('success', 'Insumo agregado correctamente');
    }

    /**
     * Retorna la vista de un insumo
     * 
     * @param int $id
     * @return vista insumos.show
     */
    public function show(int $id)
    {
        $insumo = Insumo::find($id);

        return view('insumos.show', compact('insumo'));
    }

    /**
     * Retorna la vista de edición de un insumo
     * 
     * @param int $id
     * @return vista insumos.edit
     */
    public function edit(int $id)
    {
        $insumo = Insumo::find($id);
        $tiposUso = TipoUso::all();
        $tiposVehiculo = TipoVehiculo::all();

        return view('insumos.edit', compact('insumo', 'tiposUso', 'tiposVehiculo'));
    }

    /**
     * Actualiza un insumo
     * 
     * @param Request $request
     * @param int $id
     * @return redirección ruta insumos.index
     */
    public function update(Request $request, int $id)
    {
        $this->updateValidator($request->all())->validate();
        $insumo = Insumo::find($id);
        $insumo->update([
            'codigo' => $request->codigo,
            'descripcion' => $request->descripcion,
            'cantidad' => $request->cantidad,
            'id_tipo_uso' => $request->id_tipo_uso,
            'id_tipo_vehiculo' => $request->id_tipo_vehiculo,
            'costo_unitario' => $request->costo_unitario,
        ]);

        return redirect()->route('insumos.index')->with('success', 'Insumo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Validación para la creación de un insumo
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createValidator(array $data)
    {
        $reglas = [
            'codigo' => 'required|unique:insumos,codigo',
            'descripcion' => 'required',
            'cantidad' => 'required|integer|min:0',
            'id_tipo_uso' => 'required',
            'id_tipo_vehiculo' => 'required',
            'costo_unitario' => 'required|decimal:2|min:0',
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'codigo.required' => 'El de código de insumo es requerido',
            'codigo.unique' => 'Ya existe un insumo con ese codigo',
            'descripcion.required' => 'La descripción es requerida',
            'cantidad.required' => 'La cantidad es requerida',
            'cantidad.integer' => 'La cantidad debe ser un número',
            'cantidad.min' => 'La cantidad no puede ser menor a 0',
            'id_tipo_uso.required' => 'El tipo de uso es requerido',
            'id_tipo_vehiculo.required' => 'El tipo de vehículo es requerido',
            'costo_unitario.required' => 'El costo unitorio es requerido',
            'costo_unitario.decimal' => 'El formato del costo unitario es incorrecto',
            'costo_unitario.min' => 'El costo unitario no puede ser menor a 0',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }

    /**
     * Validación para la actualización de un insumo
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function updateValidator(array $data)
    {
        $reglas = [
            'codigo' => 'required|unique:insumos,codigo,' . $data['id'],
            'descripcion' => 'required',
            'cantidad' => 'required|integer|min:0',
            'id_tipo_uso' => 'required',
            'id_tipo_vehiculo' => 'required',
            'costo_unitario' => 'required|decimal:2|min:0',
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'codigo.required' => 'El de código de insumo es requerido',
            'codigo.unique' => 'Ya existe un insumo con ese codigo',
            'descripcion.required' => 'La descripción es requerida',
            'cantidad.required' => 'La cantidad es requerida',
            'cantidad.integer' => 'La cantidad debe ser un número',
            'cantidad.min' => 'La cantidad no puede ser menor a 0',
            'id_tipo_uso.required' => 'El tipo de uso es requerido',
            'id_tipo_vehiculo.required' => 'El tipo de vehículo es requerido',
            'costo_unitario.required' => 'El costo unitorio es requerido',
            'costo_unitario.decimal' => 'El formato del costo unitario es incorrecto',
            'costo_unitario.min' => 'El costo unitario no puede ser menor a 0',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }
}
