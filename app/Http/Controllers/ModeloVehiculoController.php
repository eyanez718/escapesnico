<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MarcaVehiculo;
use App\Models\ModeloVehiculo;

class ModeloVehiculoController extends Controller
{
    /**
     * Retorna la vista de modelos de vehículo
     * 
     * @return view modelos_vehiculo.index
     */
    public function index()
    {
        $modelosVehiculo = ModeloVehiculo::all();

        return view('modelos_vehiculo.index', compact('modelosVehiculo'));
    }

    /**
     * Retorna la vista de creación de un modelo
     * 
     * @return vista modelos_vehiculo.create
     */
    public function create()
    {
        $marcasVehiculo = MarcaVehiculo::all();

        return view('modelos_vehiculo.create', compact('marcasVehiculo'));
    }

    /**
     * Agrega un nuevo modelo de vehículo
     * 
     * @param Request $request
     * @return redirección ruta modelos_vehiculo.index
     */
    public function store(Request $request)
    {
        $this->createValidator($request->all())->validate();
        ModeloVehiculo::create([
            'nombre' => $request->nombre,
            'id_marca' => $request->id_marca,
        ]);

        return redirect()->route('modelos_vehiculo.index')->with('success', 'Modelo de vehículo agregado correctamente');
    }

    /**
     * Retorna la vista de un modelo de vehículo
     * 
     * @param int $id
     * @return vista modelos_vehiculo.show
     */
    public function show(int $id)
    {
        $modeloVehiculo = ModeloVehiculo::find($id);

        return view('modelos_vehiculo.show', compact('modeloVehiculo'));
    }

    /**
     * Retorna la vista de edición de un modelo de vehículo
     * 
     * @param int $id
     * @return view modelos_vehiculo.edit
     */
    public function edit(string $id)
    {
        $modeloVehiculo = ModeloVehiculo::find($id);
        $marcasVehiculo = MarcaVehiculo::all();

        return view('modelos_vehiculo.edit', compact('modeloVehiculo', 'marcasVehiculo'));
    }

    /**
     * Actualiza un modelo de vehículo
     * 
     * @param Request $request
     * @param int $id
     * @return redirección ruta modelos_vehiculo.index
     */
    public function update(Request $request, int $id)
    {
        $this->updateValidator($request->all())->validate();
        $modeloVehiculo = ModeloVehiculo::find($id);
        $modeloVehiculo->update([
            'nombre' => $request->nombre,
            'id_marca' => $request->id_marca,
        ]);

        return redirect()->route('modelos_vehiculo.index')->with('success', 'Modelo de vehículo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Validación para creación de un modelo de vehículo
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createValidator(array $data)
    {
        $reglas = [
            'nombre' => 'required|unique:modelos_vehiculo,nombre',
            'id_marca' => 'required'
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'nombre.required' => 'El nombre del modelo de vehículo es requerido',
            'nombre.unique' => 'Ya existe un modelo de vehículo con ese nombre',
            'id_marca.required' => 'La marca del vehículo es requerida',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }

    /**
     * Validación para actualización de un modelo de vehículo
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function updateValidator(array $data)
    {
        $reglas = [
            'nombre' => 'required|unique:modelos_vehiculo,nombre,' . $data['id'],
            'id_marca' => 'required'
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'nombre.required' => 'El nombre del modelo de vehículo es requerido',
            'nombre.unique' => 'Ya existe un modelo de vehículo con ese nombre',
            'id_marca.required' => 'La marca del vehículo es requerida',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }
}
