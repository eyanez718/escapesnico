<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MarcaVehiculo;

class MarcaVehiculoController extends Controller
{
    /**
     * Retorna la vista de marcas de vehículo
     * 
     * @return view marcas_vehiculo.index
     */
    public function index()
    {
        $marcasVehiculo = MarcaVehiculo::all();

        return view('marcas_vehiculo.index', compact('marcasVehiculo'));
    }

    /**
     * Retorna la vista de creación de una marca de vehículo
     * 
     * @return view marcas_vehiculo.create
     */
    public function create()
    {
        return view('marcas_vehiculo.create');
    }

    /**
     * Agrega una nueva marca de vehículo
     * 
     * @param Request $request
     * @return redirección ruta marcas_vehiculo.index
     */
    public function store(Request $request)
    {
        $this->createValidator($request->all())->validate();
        MarcaVehiculo::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('marcas_vehiculo.index')->with('success', 'Marca de vehículo agregada correctamente');
    }

    /**
     * Retorna la vista de una marca de vehículo
     * 
     * @param int $id
     * @return view marcas_vehiculo.show
     */
    public function show(int $id)
    {
        $marcaVehiculo = MarcaVehiculo::find($id);

        return view('marcas_vehiculo.show', compact('marcaVehiculo'));
    }

    /**
     * Retorna la vista de edición de una marca de vehículo
     * 
     * @param int $id
     * @return view marcas_vehiculo.edit
     */
    public function edit(string $id)
    {
        $marcaVehiculo = MarcaVehiculo::find($id);

        return view('marcas_vehiculo.edit', compact('marcaVehiculo'));
    }

    /**
     * Actualiza una marca de vehículo
     */
    public function update(Request $request, string $id)
    {
        $this->updateValidator($request->all())->validate();
        $marcaVehiculo = MarcaVehiculo::find($id);
        $marcaVehiculo->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('marcas_vehiculo.index')->with('success', 'Marca de vehículo actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Validación para creación de una marca de vehículo
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createValidator(array $data)
    {
        $reglas = [
            'nombre' => 'required|unique:marcas_vehiculo,nombre',
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'nombre.required' => 'El nombre de la marca de vehículo es requerido',
            'nombre.unique' => 'Ya existe una marca de vehículo con ese nombre',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }

    /**
     * Validación para la actualización de una marca de vehículo
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function updateValidator(array $data)
    {
        $reglas = [
            'nombre' => 'required|unique:roles,nombre,' . $data['id'],
        ];
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'nombre.required' => 'El nombre de la marca de vehículo es requerido',
            'nombre.unique' => 'Ya existe una marca de vehículo con ese nombre',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        return $validacion;
    }
}
