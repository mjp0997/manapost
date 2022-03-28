<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\SucursalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
});

Route::group(['prefix' => '/estados', 'controller' => EstadoController::class], function () {

    Route::get('/', 'index');

    Route::get('/mostrar/{id}', 'show');

    Route::get('/crear', 'create');
    Route::post('/guardar', 'store');

    Route::get('/editar/{id}', 'edit');
    Route::put('/actualizar/{id}', 'update');

    Route::delete('/eliminar/{id}', 'destroy');
});

Route::group(['prefix' => '/ciudades', 'controller' => CiudadController::class], function () {

    Route::get('/', 'index');

    Route::get('/mostrar/{id}', 'show');

    Route::get('/crear', 'create');
    Route::post('/guardar', 'store');

    Route::get('/editar/{id}', 'edit');
    Route::put('/actualizar/{id}', 'update');

    Route::delete('/eliminar/{id}', 'destroy');
});

Route::group(['prefix' => '/sucursales', 'controller' => SucursalController::class], function () {

    Route::get('/', 'index');

    Route::get('/mostrar/{id}', 'show');

    Route::get('/crear', 'create');
    Route::post('/guardar', 'store');

    Route::get('/editar/{id}', 'edit');
    Route::put('/actualizar/{id}', 'update');

    Route::delete('/eliminar/{id}', 'destroy');
});

Route::group(['prefix' => '/rutas', 'controller' => RutaController::class], function () {

    Route::get('/', 'index');

    Route::get('/mostrar/{id}', 'show');

    Route::get('/crear', 'create');
    Route::post('/guardar', 'store');

    Route::get('/editar/{id}', 'edit');
    Route::put('/actualizar/{id}', 'update');

    Route::delete('/eliminar/{id}', 'destroy');
});

Route::group(['prefix' => '/roles', 'controller' => RolController::class], function () {

    Route::get('/', 'index');

    Route::get('/mostrar/{id}', 'show');

    Route::get('/crear', 'create');
    Route::post('/guardar', 'store');

    Route::get('/editar/{id}', 'edit');
    Route::put('/actualizar/{id}', 'update');

    Route::delete('/eliminar/{id}', 'destroy');
});

Route::group(['prefix' => '/empleados', 'controller' => EmpleadoController::class], function () {

    Route::get('/', 'index');

    Route::get('/mostrar/{id}', 'show');

    Route::get('/crear', 'create');
    Route::post('/guardar', 'store');

    Route::get('/editar/{id}', 'edit');
    Route::put('/actualizar/{id}', 'update');

    Route::delete('/eliminar/{id}', 'destroy');
});