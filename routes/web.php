<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\MaquinaController;
use App\Http\Controllers\MarcaVehiculoController;
use App\Http\Controllers\ProveedorController;
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
    Route::resource('insumos', InsumoController::class)->middleware(['administracion']);
    Route::resource('maquinas', MaquinaController::class)->middleware(['administracion']);
    Route::resource('marcas_vehiculo', MarcaVehiculoController::class)->middleware(['administracion']);
    Route::resource('proveedores', ProveedorController::class)->middleware(['administracion']);
    Route::resource('roles', RolController::class)->middleware(['administracion']);
    Route::get('/stock', [StockController::class, 'index'])->middleware(['administracion'])->name('stock.index');
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