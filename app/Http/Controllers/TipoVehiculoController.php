<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TipoVehiculo;

class TipoVehiculoController extends Controller
{
    /**
     * Retorna la vista de tipos de vehículo
     * 
     * @return vista tipos_vehiculo.index
     */
    public function index()
    {
        $tiposVehiculo = TipoVehiculo::all();

        return view('tipos_vehiculo.index', compact('tiposVehiculo'));
    }

    /**
     * Retorna la vista de creación de un tipo de vehículo
     * 
     * @return view tipos_vehiculo.create
     */
    public function create()
    {
        return view('tipos_vehiculo.create');
    }

    /**
     * Agrega un nuevo tipo de vehículo
     * 
     * @param Request $request
     * @return redirección ruta tipos_vehiculo.index
     */
    public function store(Request $request)
    {
        $this->createValidator($request->all())->validate();
        TipoVehiculo::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('tipos_vehiculo.index')->with('success', 'Tipo de vehículo agregado correctamente');
    }

    /**
     * Retorna la vista de un tipo de vehículo
     * 
     * @param int $id
     * @return vista tipos_vehiculo.show
     */
    public function show(int $id)
    {
        $tipoVehiculo = TipoVehiculo::find($id);

        return view('tipos_vehiculo.show', compact('tipoVehiculo'));
    }

    /**
     * Retorna la vista de edición de un tipo de vehículo
     * 
     * @param int $id
     * @return view tipos_vehiculo.edit
     */
    public function edit(int $id)
    {
        $tipoVehiculo = TipoVehiculo::find($id);

        return view('tipos_vehiculo.edit', compact('tipoVehiculo'));
    }

    /**
     * Actualiza un tipo de vehículo
     * 
     * @param Request $request
     * @param int $id
     * @return redirección ruta tipos_vehiculo.index
     */
    public function update(Request $request, string $id)
    {
        $this->updateValidator($request->all())->validate();
        $tipoVehiculo = TipoVehiculo::find($id);
        $tipoVehiculo->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('tipos_vehiculo.index')->with('success', 'Tipo de vehiculo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Validación para creación de un tipo de vehiculo
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createValidator(array $data)
    {
        $reglas = [
            'nombre' => 'required|unique:tipos_vehiculo,nombre',
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'nombre.required' => 'El nombre del tipo de vehículo es requerido',
            'nombre.unique' => 'Ya existe ese tipo de vehículo',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }

    /**
     * Validación para la actualización de un tipo de vehículo
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function updateValidator(array $data)
    {
        $reglas = [
            'nombre' => 'required|unique:tipos_vehiculo,nombre,' . $data['id'],
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'nombre.required' => 'El nombre del tipo de vehículo es requerido',
            'nombre.unique' => 'Ya existe ese tipo de vehículo',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }
}
