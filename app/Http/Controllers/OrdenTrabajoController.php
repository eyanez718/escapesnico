<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\OrdenTrabajo;
use App\Models\Usuario;
use App\Models\Insumo;
use App\Models\Material;
use App\Models\Maquina;
use App\Models\ModeloVehiculo;
use App\Models\TipoVehiculo;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class OrdenTrabajoController extends Controller
{
    /**
     * Retorna la vista de ordenes de trabajo
     * 
     * @return view ordenes_trabajo.index
     */
    public function index()
    {
        $ordenesTrabajo = OrdenTrabajo::all();

        return view('ordenes_trabajo.index', compact('ordenesTrabajo'));
    }

    /**
     * Retorna la vista de creación de una orden de trabajo
     * 
     * @return view ordenes_trabajo.create
     */
    public function create()
    {
        $usuarios = Usuario::where('id_rol', '=', 3)->get();
        $insumos = Insumo::where('cantidad', '>', 0)->get();
        $materiales = Material::where('cantidad', '>', 0)->get();
        $maquinas = Maquina::all();
        $modelosVehiculo = ModeloVehiculo::all();
        $tiposVehiculo = TipoVehiculo::all();
        $trabajosRealizados = array(
            array('id'=> 1, 'nombre' => 'Soldadura'),
            array('id'=> 2, 'nombre' => 'Reparación'),
            array('id'=> 3, 'nombre' => 'Limpieza'),
            array('id'=> 4, 'nombre' => 'Sustitución'),
        );

        return view('ordenes_trabajo.create', compact('usuarios', 'insumos', 'materiales', 'maquinas', 'modelosVehiculo', 'tiposVehiculo', 'trabajosRealizados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->createValidator($request->all())->validate();
        
        // Crear orden (ejemplo simple)
        $ordenTrabajo = OrdenTrabajo::create([
            // completar con campos necesarios, ejemplo:
            'fecha' => $request->fecha,
            'id_usuario' => $request->id_usuario,
            'empresa' => $request->empresa,
            'patente' => Str::upper($request->patente),
            'id_modelo_vehiculo' => $request->id_modelo_vehiculo,
            'id_tipo_vehiculo' => $request->id_tipo_vehiculo,
            'trabajo_realizado_1' => $request->trabajo_realizado_1,
            'trabajo_realizado_2' => $request->trabajo_realizado_2,
            'trabajo_realizado_3' => $request->trabajo_realizado_3,
            'trabajo_realizado_4' => $request->trabajo_realizado_4,
        ]);

        // Insumos
        foreach ($request->input('insumos', []) as $item) {
            $id = $item['id'] ?? null;
            $cantidad = $item['cantidad'] ?? null;

            if ($id && $cantidad) {
                $ordenTrabajo->insumos()->attach($id, ['cantidad' => $cantidad]);
                $insumo = Insumo::find($id);
                $insumo->cantidad = $insumo->cantidad - $cantidad;
                $insumo->save();
            }
        }

        // Materiales
        foreach ($request->input('materials', []) as $item) {
            $id = $item['id'] ?? null;
            $cantidad = $item['cantidad'] ?? null;

            if ($id && $cantidad) {
                $ordenTrabajo->materiales()->attach($id, ['cantidad' => $cantidad]);
                $material = Material::find($id);
                $material->cantidad = $material->cantidad - $cantidad;
                $material->save();
            }
        }

        // Maquinas
        foreach ($request->input('maquinas', []) as $item) {
            $id = $item['id'] ?? null;
            $minutos_uso = $item['minutos_uso'] ?? null;
            $cambio_combustible = $item['cambio_combustible'] ?? null;

            if ($id && $minutos_uso) {
                $ordenTrabajo->maquinas()->attach($id, ['minutos_uso' => $minutos_uso, 'cambio_combustible' => $cambio_combustible]);
            }
        }

        return redirect()->route('ordenes_trabajo.index')->with('success', 'Compra guardada correctamente.');
    }

    /**
     * Retorna la vista de una orden de trabajo
     * 
     * @param int $id
     * @return vista ordenes_trabajo.show
     */
    public function show(int $id)
    {
        $ordenTrabajo = OrdenTrabajo::find($id);
        $trabajosRealizados = array(
            array('id'=> 1, 'nombre' => 'Soldadura'),
            array('id'=> 2, 'nombre' => 'Reparación'),
            array('id'=> 3, 'nombre' => 'Limpieza'),
            array('id'=> 4, 'nombre' => 'Sustitución'),
        );

        return view('ordenes_trabajo.show', compact('ordenTrabajo', 'trabajosRealizados'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Validación para la creación de una orden de trabajo
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createValidator(array $data)
    {
        $reglas = [
            'fecha' => 'required|date_format:Y-m-d',
            'id_usuario' => 'required',
            'empresa' => 'required',
            'patente' => ['required', function ($attribute, $value, $fail) {
                $valido = true;
                $cadena = $value;
                if (Str::length($cadena) !== 6 && Str::length($cadena) !== 7) {
                    $valido = false;
                } else {
                    if (Str::length($cadena) == 6) { // Patente de 6 caracteres
                        if (!(
                            ctype_alpha(Str::charAt($cadena, 0)) &&
                            ctype_alpha(Str::charAt($cadena, 1)) &&
                            ctype_alpha(Str::charAt($cadena, 2)) &&
                            ctype_digit(Str::charAt($cadena, 3)) &&
                            ctype_digit(Str::charAt($cadena, 4)) &&
                            ctype_digit(Str::charAt($cadena, 5))
                        )) {
                            $valido = false;
                        }
                    } else { // Patente de 7 caracteres
                        if (!(
                            ctype_alpha(Str::charAt($cadena, 0)) &&
                            ctype_alpha(Str::charAt($cadena, 1)) &&
                            ctype_digit(Str::charAt($cadena, 2)) &&
                            ctype_digit(Str::charAt($cadena, 3)) &&
                            ctype_digit(Str::charAt($cadena, 4)) &&
                            ctype_alpha(Str::charAt($cadena, 5)) &&
                            ctype_alpha(Str::charAt($cadena, 6))
                        )) {
                            $valido = false;
                        }
                    }
                }
                if (!$valido) {
                    $fail('El formato de la patente es inválido.');
                }
            },
        ],
            'trabajo_realizado' => function ($attribute, $value, $fail) {

            },
        ];
        
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'fecha.required' => 'La fecha de la compra es requerida',
            'fecha.date_format' => 'El formato de la fecha es incorrecto',
            'id_usuario' => 'El operador es requerido',
            'empresa.required' => 'La empresa es requerida',
            'patente.required' => 'La patente es requerida',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        $validacion->after(function ($validacion) use ($data) {
            //Verifico si existe al menos un item con cantidad < 0 o precio < 0
            $errorValores = false;
            if (Arr::has($data, 'insumos')) {
                $insumos = Arr::get($data, 'insumos');
                foreach ($insumos as $insumo) {
                    if ($insumo['cantidad'] <= 0) {
                        $errorValores = true;
                    }
                }
            }
            if (Arr::has($data, 'materials')) {
                $materiales = Arr::get($data, 'materials');
                foreach ($materiales as $material) {
                    if ($material['cantidad'] <= 0) {
                        $errorValores = true;
                    }
                }
            }
            if ($errorValores) {
                $validacion->errors()->add('productos', 'No se puede cargar cantidades en cero.');
            }
        });

        $validacion->after(function ($validacion) use ($data) {
            //Verifico si existe al menos un item con cantidad < 0 o precio < 0
            $errorTrabajoRealizado = false;

            if (!( (Arr::get($data, 'trabajo_realizado_1') != 0 && Arr::get($data, 'trabajo_realizado_2') == 0 && Arr::get($data, 'trabajo_realizado_3') == 0 && Arr::get($data, 'trabajo_realizado_4') == 0)
                || (Arr::get($data, 'trabajo_realizado_1') != 0 && Arr::get($data, 'trabajo_realizado_2') != 0 && Arr::get($data, 'trabajo_realizado_3') == 0 && Arr::get($data, 'trabajo_realizado_4') == 0)
                || (Arr::get($data, 'trabajo_realizado_1') != 0 && Arr::get($data, 'trabajo_realizado_2') != 0 && Arr::get($data, 'trabajo_realizado_3') != 0 && Arr::get($data, 'trabajo_realizado_4') == 0)
                || (Arr::get($data, 'trabajo_realizado_1') != 0 && Arr::get($data, 'trabajo_realizado_2') != 0 && Arr::get($data, 'trabajo_realizado_3') != 0 && Arr::get($data, 'trabajo_realizado_4') != 0)
            )) {
                $errorTrabajoRealizado = true;
            } else {
                if ((Arr::get($data, 'trabajo_realizado_1') != 0 && Arr::get($data, 'trabajo_realizado_2') != 0 && Arr::get($data, 'trabajo_realizado_3') == 0 && Arr::get($data, 'trabajo_realizado_4') == 0)) {
                    if (!(Arr::get($data, 'trabajo_realizado_1') != Arr::get($data, 'trabajo_realizado_2'))) {
                        $errorTrabajoRealizado = true;
                    }
                } else {
                    if (Arr::get($data, 'trabajo_realizado_1') != 0 && Arr::get($data, 'trabajo_realizado_2') != 0 && Arr::get($data, 'trabajo_realizado_3') != 0 && Arr::get($data, 'trabajo_realizado_4') == 0) {
                       if (!(
                               (Arr::get($data, 'trabajo_realizado_1') != Arr::get($data, 'trabajo_realizado_2'))
                            && (Arr::get($data, 'trabajo_realizado_1') != Arr::get($data, 'trabajo_realizado_3'))
                            && (Arr::get($data, 'trabajo_realizado_2') != Arr::get($data, 'trabajo_realizado_3'))
                        )) {
                            $errorTrabajoRealizado = true;
                        }
                    } else {
                        if (Arr::get($data, 'trabajo_realizado_1') != 0 && Arr::get($data, 'trabajo_realizado_2') != 0 && Arr::get($data, 'trabajo_realizado_3') != 0 && Arr::get($data, 'trabajo_realizado_4') != 0) {
                            if (!(
                                   (Arr::get($data, 'trabajo_realizado_1') != Arr::get($data, 'trabajo_realizado_2'))
                                && (Arr::get($data, 'trabajo_realizado_1') != Arr::get($data, 'trabajo_realizado_3'))
                                && (Arr::get($data, 'trabajo_realizado_1') != Arr::get($data, 'trabajo_realizado_4'))
                                && (Arr::get($data, 'trabajo_realizado_2') != Arr::get($data, 'trabajo_realizado_3'))
                                && (Arr::get($data, 'trabajo_realizado_2') != Arr::get($data, 'trabajo_realizado_4'))
                                && (Arr::get($data, 'trabajo_realizado_3') != Arr::get($data, 'trabajo_realizado_4'))
                            )) {
                                $errorTrabajoRealizado = true;
                            }
                        }
                    }
                }
            }
            if ($errorTrabajoRealizado) {
                $validacion->errors()->add('trabajo_realizado', 'Debe cargar al menos un trabajo realizado, deben estar cargados en orden y no se pueden repetir.');
            }
        });

        return $validacion;
    }

    /**
     * 
     */
    public function cambiarEstado(Request $request)
    {
        $ordenTrabajo = OrdenTrabajo::find($request->id);
        $ordenTrabajo->estado = $request->estado;
        $ordenTrabajo->save();

        if ($request->estado == 1) {
            return redirect()->route('ordenes_trabajo.index')->with('success', 'Orden finalizada correctamente.');
        } else {
            foreach ($ordenTrabajo->insumos as $insumo) {
                $auxInsumo = Insumo::find($insumo->id);
                $auxInsumo->cantidad = $auxInsumo->cantidad + $insumo->pivot->cantidad;
                $auxInsumo->save();
            }
            foreach ($ordenTrabajo->materiales as $material) {
                $auxMaterial = Material::find($material->id);
                $auxMaterial->cantidad = $auxMaterial->cantidad + $material->pivot->cantidad;
                $auxMaterial->save();
            }
            return redirect()->route('ordenes_trabajo.index')->with('success', 'Orden cancelada correctamente.');
        }
    }
}
