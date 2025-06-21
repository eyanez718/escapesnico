<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\MaquinaController;
use App\Http\Controllers\MarcaVehiculoController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ModeloVehiculoController;
use App\Http\Controllers\OrdenTrabajoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TipoUsoController;
use App\Http\Controllers\TipoVehiculoController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    Route::resource('compras', CompraController::class)->middleware(['administracion']);
    Route::resource('insumos', InsumoController::class)->middleware(['administracion']);
    Route::resource('maquinas', MaquinaController::class)->middleware(['administracion']);
    Route::resource('marcas_vehiculo', MarcaVehiculoController::class)->middleware(['administracion']);
    Route::get('/materiales/marcas_vehiculo/obtener_modelos/{idMarca}', [MarcaVehiculoController::class, 'getModelos'])->middleware(['administracion']);
    Route::resource('materiales', MaterialController::class)->middleware(['administracion']);
    Route::resource('modelos_vehiculo', ModeloVehiculoController::class)->middleware(['administracion']);
    Route::resource('ordenes_trabajo', OrdenTrabajoController::class);
    Route::post('/ordenes_trabajo/cambiarEstado', [OrdenTrabajoController::class, 'cambiarEstado'])->name('ordenes_trabajo.cambiar_estado');
    Route::resource('proveedores', ProveedorController::class)->middleware(['administracion']);
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index')->middleware(['administracion']);
    Route::get('/reportes/stock_valorizado', [ReporteController::class, 'stockValorizado'])->name('reportes.stock_valorizado')->middleware(['administracion']);
    Route::get('/reportes/stock_valorizado_período', [ReporteController::class, 'stockValorizadoPeríodo'])->name('reportes.stock_valorizado_período')->middleware(['administracion']);
    Route::get('/reportes/ranking_proveedores', [ReporteController::class, 'rankingProveedores'])->name('reportes.ranking_proveedores')->middleware(['administracion']);
    Route::get('/reportes/estadisticas_operadores', [ReporteController::class, 'estadisticasOperadores'])->name('reportes.estadisticas_operadores')->middleware(['administracion']);
    Route::get('/reportes/estadisticas_maquinaria', [ReporteController::class, 'estadisticasMaquinaria'])->name('reportes.estadisticas_maquinaria')->middleware(['administracion']);
    Route::resource('roles', RolController::class)->middleware(['administracion']);
    Route::get('/stock', [StockController::class, 'index'])->middleware(['administracion'])->name('stock.index');
    Route::get('/stock/importar_listado_precios', [StockController::class, 'importarListadoPrecios'])->middleware(['administracion'])->name('stock.importar_listado_precios');
    Route::post('/stock/procesar_listado_precios', [StockController::class, 'procesarListadoPrecios'])->middleware(['administracion'])->name('stock.procesar_listado_precios');
    Route::resource('tipos_uso', TipoUsoController::class)->middleware(['administracion']);
    Route::resource('tipos_vehiculo', TipoVehiculoController::class)->middleware(['administracion']);
    Route::resource('usuarios', UsuarioController::class)->middleware(['administracion']);
    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');
});


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);