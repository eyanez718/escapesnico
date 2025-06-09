<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Compra;
use App\Models\Insumo;
use App\Models\Material;
use App\Models\Proveedor;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CompraController extends Controller
{
    /**
     * Retorna la vista de compras
     * 
     * @return view compras.index
     */
    public function index()
    {
        $compras = Compra::all();

        return view('compras.index', compact('compras'));
    }

    /**
     * Retorna la vista de creación de una compra
     * 
     * @return view compras.create
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        $insumos = Insumo::all();
        $materiales = Material::all();

        return view('compras.create', compact('proveedores', 'insumos', 'materiales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->createValidator($request->all())->validate();
        
        // Crear orden (ejemplo simple)
        $compra = Compra::create([
            // completar con campos necesarios, ejemplo:
            'fecha' => $request->fecha,
            'numero_factura' => $request->numero_factura,
            'id_usuario' => auth()->id(),
            'id_proveedor' => $request->id_proveedor,
        ]);

        // Insumos
        foreach ($request->input('insumos', []) as $item) {
            $id = $item['id'] ?? null;
            $cantidad = $item['cantidad'] ?? null;
            $costo_unitario = $item['costo_unitario'] ?? null;

            if ($id && $cantidad && $costo_unitario) {
                $compra->insumos()->attach($id, ['cantidad' => $cantidad, 'costo_unitario' => $costo_unitario]);
                $insumo = Insumo::find($id);
                $insumo->cantidad = $insumo->cantidad + $cantidad;
                $insumo->costo_unitario = $costo_unitario;
                $insumo->save();
            }
        }

        // Materiales
        foreach ($request->input('materials', []) as $item) {
            $id = $item['id'] ?? null;
            $cantidad = $item['cantidad'] ?? null;
            $costo_unitario = $item['costo_unitario'] ?? null;

            if ($id && $cantidad) {
                $compra->materiales()->attach($id, ['cantidad' => $cantidad, 'costo_unitario' => $costo_unitario]);
                $material = Material::find($id);
                $material->cantidad = $material->cantidad + $cantidad;
                $material->costo_unitario = $costo_unitario;
                $material->save();
            }
        }

        return redirect()->route('compras.index')->with('success', 'Compra guardada correctamente.');
    }

    /**
     * Retorna la vista de una compra
     * 
     * @param int $id
     * @return vista compras.show
     */
    public function show(int $id)
    {
        $compra = Compra::find($id);

        return view('compras.show', compact('compra'));
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
     * Validación para la creación de una compra
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createValidator(array $data)
    {
        $reglas = [
            'fecha' => 'required|date_format:Y-m-d',
            'numero_factura' => ['required', function ($attribute, $value, $fail) {
                $cadena = Str::upper($value);
                $valido = true;
                if (Str::length($cadena) !== 14) {
                    $valido = false;
                } else {
                    if (!(Str::startsWith($cadena, 'A') || Str::startsWith($cadena, 'B') || Str::startsWith($cadena, 'C'))) {
                        $valido = false;
                    } else {
                        if (Str::charAt($cadena, 5) !== '-') {
                            $valido = false;
                        } else {
                            if (!(is_numeric(Str::substr($cadena, 1, 4)) && is_numeric(Str::substr($cadena, 6, 8)) &&
                                !Str::contains(Str::substr($cadena, 1, 4), '.') && !Str::contains(Str::substr($cadena, 6, 8), '.')
                            )) {
                                $valido = false;
                            }
                        }
                    }
                }
                if (!$valido) {
                    $fail('El formato del número de factura es inválido.');
                }
            },
        ],
            'id_proveedor' => 'required',
        ];
        
        $mensajes = [//Los mensajes por validación required no los agrego porque el formulario siempre se envía con todos los campos llenos, de la misma manera con el email que siempre viene en formato email
            'fecha.required' => 'La fecha de la compra es requerida',
            'fecha.date_format' => 'El formato de la fecha es incorrecto',
            'numero_factura.required' => 'El número de factura es requerido',
            'id_proveedor' => 'El proveedor es requerido',
        ];
        $validacion = Validator::make($data, $reglas, $mensajes);
        
        $validacion->after(function ($validacion) use ($data) {
            // Verifico que existan insumos y/o materiales
            if (!Arr::has($data, 'insumos') && !Arr::has($data, 'materials')) {
                $validacion->errors()->add('productos', 'Debe cargar al menos un insumo o material.');
            }

            //Verifico si existe al menos un item con cantidad < 0 o precio < 0
            $errorValores = false;
            if (Arr::has($data, 'insumos')) {
                $insumos = Arr::get($data, 'insumos');
                foreach ($insumos as $insumo) {
                    if ($insumo['cantidad'] <= 0 || $insumo['costo_unitario'] <= 0) {
                        $errorValores = true;
                    }
                }
            }
            if (Arr::has($data, 'materials')) {
                $materiales = Arr::get($data, 'materials');
                foreach ($materiales as $material) {
                    if ($material['cantidad'] <= 0 || $material['costo_unitario'] <= 0) {
                        $errorValores = true;
                    }
                }
            }
            if ($errorValores) {
                $validacion->errors()->add('productos', 'No se puede cargar cantidades o costos unitarios en cero.');
            }
        });

        return $validacion;
    }
}
