<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MarcaVehiculo;
use App\Models\Material;
use App\Models\ModeloVehiculo;
use App\Models\TipoVehiculo;
use App\Models\TipoUso;

class MaterialController extends Controller
{
    /**
     * Retorna la vista de materiales
     * 
     * @return view materiales.index
     */
    public function index()
    {
        $materiales = Material::all();

        return view('materiales.index', compact('materiales'));
    }

    /**
     * Retorna la vista de creación de un material
     * 
     * @return view materiales.create
     */
    public function create()
    {
        $tiposUso = TipoUso::all();
        $tiposVehiculo = TipoVehiculo::all();
        $marcasVehiculo = MarcaVehiculo::all();

        return view('materiales.create', compact('tiposUso', 'tiposVehiculo', 'marcasVehiculo'));
    }

    /**
     * Agrega un material
     * 
     * @param Request $request
     * @return redirección ruta materiales.index
     */
    public function store(Request $request)
    {
        $this->createValidator($request->all())->validate();
        $material = new Material();
        $material->codigo = $request->codigo;
        $material->descripcion = $request->descripcion;
        $material->cantidad = $request->cantidad;
        $material->id_tipo_uso = $request->id_tipo_uso;
        $material->id_tipo_vehiculo = $request->id_tipo_vehiculo;
        $material->id_marca = $request->id_marca;
        $material->id_modelo = $request->id_modelo;
        $material->costo_unitario = $request->costo_unitario;
        $material->save();
        return redirect()->route('materiales.index')->with('success', 'Material agregado correctamente');
    }

    /**
     * Retorna la vista de un material
     * 
     * @param int $id
     * @return vista materiales.show
     */
    public function show(int $id)
    {
        $material = Material::find($id);

        return view('materiales.show', compact('material'));
    }

    /**
     * Retorna la vista de edición de un material
     * 
     * @param int $id
     * @return vista materiales.edit
     */
    public function edit(int $id)
    {
        $material = Material::find($id);
        $tiposUso = TipoUso::all();
        $tiposVehiculo = TipoVehiculo::all();
        $marcasVehiculo = MarcaVehiculo::all();

        return view('materiales.edit', compact('material', 'tiposUso', 'tiposVehiculo', 'marcasVehiculo'));
    }

    /**
     * Actualiza un materiales
     * 
     * @param Request $request
     * @param int $id
     * @return redirección ruta materiales.index
     */
    public function update(Request $request, int $id)
    {
        $this->updateValidator($request->all())->validate();
        $material = Material::find($id);
        $material->codigo = $request->codigo;
        $material->descripcion = $request->descripcion;
        $material->cantidad = $request->cantidad;
        $material->id_tipo_uso = $request->id_tipo_uso;
        $material->id_tipo_vehiculo = $request->id_tipo_vehiculo;
        $material->id_marca = $request->id_marca;
        $material->id_modelo = $request->id_modelo;
        $material->costo_unitario = $request->costo_unitario;
        $material->save();

        return redirect()->route('materiales.index')->with('success', 'Material actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Validación para la creación de un material
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createValidator(array $data)
    {
        $reglas = [
            'codigo' => 'required|unique:materiales,codigo',
            'descripcion' => 'required',
            'cantidad' => 'required|integer|min:0',
            'id_tipo_uso' => 'required',
            'id_tipo_vehiculo' => 'required',
            'id_marca' => 'required',
            'id_modelo' => 'required|min:1',
            'costo_unitario' => 'required|decimal:2|min:0',
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'codigo.required' => 'El código del material es requerido',
            'codigo.unique' => 'Ya existe un material con ese codigo',
            'descripcion.required' => 'La descripción es requerida',
            'cantidad.required' => 'La cantidad es requerida',
            'cantidad.integer' => 'La cantidad debe ser un número',
            'cantidad.min' => 'La cantidad no puede ser menor a 0',
            'id_tipo_uso.required' => 'El tipo de uso es requerido',
            'id_tipo_vehiculo.required' => 'El tipo de vehículo es requerido',
            'id_marca.required' => 'La marca del vehículo es requerida',
            'id_modelo.required' => 'El modelo del vehículo es requerido',
            'id_modelo.min' => 'El modelo del vehículo es requerido',
            'costo_unitario.required' => 'El costo unitorio es requerido',
            'costo_unitario.decimal' => 'El formato del costo unitario es incorrecto',
            'costo_unitario.min' => 'El costo unitario no puede ser menor a 0',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }

    /**
     * Validación para la actualización de un material
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function updateValidator(array $data)
    {
        $reglas = [
            'codigo' => 'required|unique:materiales,codigo,' . $data['id'],
            'descripcion' => 'required',
            'cantidad' => 'required|integer|min:0',
            'id_tipo_uso' => 'required',
            'id_tipo_vehiculo' => 'required',
            'id_marca' => 'required',
            'id_modelo' => 'required|min:1',
            'costo_unitario' => 'required|decimal:2|min:0',
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'codigo.required' => 'El código del material es requerido',
            'codigo.unique' => 'Ya existe un material con ese codigo',
            'descripcion.required' => 'La descripción es requerida',
            'cantidad.required' => 'La cantidad es requerida',
            'cantidad.integer' => 'La cantidad debe ser un número',
            'cantidad.min' => 'La cantidad no puede ser menor a 0',
            'id_tipo_uso.required' => 'El tipo de uso es requerido',
            'id_tipo_vehiculo.required' => 'El tipo de vehículo es requerido',
            'id_marca.required' => 'La marca del vehículo es requerida',
            'id_modelo.required' => 'El modelo del vehículo es requerido',
            'id_modelo.min' => 'El modelo del vehículo es requerido',
            'costo_unitario.required' => 'El costo unitorio es requerido',
            'costo_unitario.decimal' => 'El formato del costo unitario es incorrecto',
            'costo_unitario.min' => 'El costo unitario no puede ser menor a 0',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }
}
