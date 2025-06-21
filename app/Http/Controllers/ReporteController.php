<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Insumo;
use App\Models\Maquina;
use App\Models\Material;
use App\Models\Proveedor;
use App\Models\Usuario;

class ReporteController extends Controller
{
    /**
     * Retorna la vista de reportes
     * 
     * @return vista reportes.index
     */
    public function index()
    {
        return view('reportes.index');
    }

    /**
     * Retorna el reporte de stock valorizado
     * 
     * @return vista reportes.stock_valorizado
     */
    public function stockValorizado()
    {
        $materiales = Material::where('cantidad', '>', 0)->orderByRaw('cantidad * costo_unitario DESC')->get();
        $insumos = Insumo::where('cantidad', '>', 0)->orderByRaw('cantidad * costo_unitario DESC')->get();

        return view('reportes.stock_valorizado', compact('insumos', 'materiales'));
    }

    /**
     * Retorna el reporte de ranking de proveedores
     * 
     * @return vista reportes.ranking proveedores
     */
    public function rankingProveedores()
    {
        $proveedores = Proveedor::with('compras')
                                ->withCount('compras') // agrega una columna "compras_count"
                                ->orderBy('compras_count', 'desc') // ordena por cantidad de compras
                                ->get();

        return view('reportes.ranking_proveedores', compact('proveedores'));
    }

    /**
     * Retorna el reporte de uso de maquinaria
     * 
     * @return vista reportes.estadisticas_maquinaria
     */
    public function estadisticasMaquinaria()
    {
        /*$maquinas = Maquina::select('maquinas.id', 'maquinas.nombre')
                            ->join('ordenes_trabajo_maquinas', 'maquinas.id', '=', 'ordenes_trabajo_maquinas.id_maquina')
                            ->selectRaw('SUM(ordenes_trabajo_maquinas.minutos_uso) as total_minutos')
                            ->selectRaw('SUM(ordenes_trabajo_maquinas.cambio_combustible) as total_cambios_combustible')
                            ->groupBy('maquinas.id', 'maquinas.nombre')
                            ->orderBy('total_minutos', 'desc')
                            ->get();*/
        $maquinas = Maquina::select('maquinas.id', 'maquinas.nombre')
                            ->join('ordenes_trabajo_maquinas', 'maquinas.id', '=', 'ordenes_trabajo_maquinas.id_maquina')
                            ->join('ordenes_trabajo', 'ordenes_trabajo.id', '=', 'ordenes_trabajo_maquinas.id_orden_trabajo')
                            ->where('ordenes_trabajo.estado', 1)
                            ->selectRaw('SUM(ordenes_trabajo_maquinas.minutos_uso) as total_minutos')
                            ->selectRaw('SUM(ordenes_trabajo_maquinas.cambio_combustible) as total_cambios_combustible')
                            ->selectRaw('COUNT(ordenes_trabajo.id) as total_trabajos')
                            ->groupBy('maquinas.id', 'maquinas.nombre')
                            ->orderByDesc('total_minutos')
                            ->get();

        return view('reportes.estadisticas_maquinaria', compact('maquinas'));
    }

    /**
     * Retorna el reporte de operadores
     * 
     * @return vista reportes.estadisticas_operadores
     */
    public function estadisticasOperadores()
    {
        $operadores = Usuario::select('usuarios.id', 'usuarios.nombre', 'usuarios.nombre_completo')
                            ->join('ordenes_trabajo', 'ordenes_trabajo.id_usuario', '=', 'usuarios.id')
                            ->where('ordenes_trabajo.estado', 1)
                            ->selectRaw('SUM(ordenes_trabajo.minutos_trabajo) as total_minutos_trabajo')
                            ->selectRaw('COUNT(ordenes_trabajo.id) as total_trabajos')
                            ->groupBy('usuarios.id', 'usuarios.nombre', 'usuarios.nombre_completo')
                            ->get();

        return view('reportes.estadisticas_operadores', compact('operadores'));
    }
}
