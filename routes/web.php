<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\TransporteController;
use App\Http\Controllers\UsuarioController;

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

Route::group(['controller' => AuthController::class], function () {

    Route::get('/login', 'show')->name('login');

    Route::post('/login', 'login');

    Route::post('/logout', 'logout');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('main');
    });
    
    Route::group([
        'prefix' => '/estados',
        'controller' => EstadoController::class,
        'middleware' => 'rol:ADMIN,DEV'
    ], function () {

        Route::get('/', 'index');
    
        Route::get('/mostrar/{id}', 'show');
    
        Route::get('/crear', 'create');
        Route::post('/guardar', 'store');
    
        Route::get('/editar/{id}', 'edit');
        Route::put('/actualizar/{id}', 'update');
    
        Route::delete('/eliminar/{id}', 'destroy');
    });
    
    Route::group([
        'prefix' => '/ciudades',
        'controller' => CiudadController::class,
        'middleware' => 'rol:ADMIN,DEV'
    ], function () {
    
        Route::get('/', 'index');
    
        Route::get('/mostrar/{id}', 'show');
    
        Route::get('/crear', 'create');
        Route::post('/guardar', 'store');
    
        Route::get('/editar/{id}', 'edit');
        Route::put('/actualizar/{id}', 'update');
    
        Route::delete('/eliminar/{id}', 'destroy');
    });
    
    Route::group([
        'prefix' => '/sucursales',
        'controller' => SucursalController::class,
        'middleware' => 'rol:ADMIN,DEV'
    ], function () {
    
        Route::get('/', 'index');
    
        Route::get('/mostrar/{id}', 'show');
    
        Route::get('/crear', 'create');
        Route::post('/guardar', 'store');
    
        Route::get('/editar/{id}', 'edit');
        Route::put('/actualizar/{id}', 'update');
    
        Route::delete('/eliminar/{id}', 'destroy');
    });
    
    Route::group([
        'prefix' => '/rutas',
        'controller' => RutaController::class,
        'middleware' => 'rol:ADMIN,DEV'
    ], function () {
    
        Route::get('/', 'index');
    
        Route::get('/mostrar/{id}', 'show');
    
        Route::get('/crear', 'create');
        Route::post('/guardar', 'store');
    
        Route::get('/editar/{id}', 'edit');
        Route::put('/actualizar/{id}', 'update');
    
        Route::delete('/eliminar/{id}', 'destroy');
    });
    
    Route::group([
        'prefix' => '/roles',
        'controller' => RolController::class,
        'middleware' => 'rol:DEV'
    ], function () {
    
        Route::get('/', 'index');
    
        Route::get('/mostrar/{id}', 'show');
    
        Route::get('/crear', 'create');
        Route::post('/guardar', 'store');
    
        Route::get('/editar/{id}', 'edit');
        Route::put('/actualizar/{id}', 'update');
    
        Route::delete('/eliminar/{id}', 'destroy');
    });
    
    Route::group([
        'prefix' => '/empleados',
        'controller' => EmpleadoController::class,
        'middleware' => 'rol:ADMIN,DEV,GERENTE'
    ], function () {
    
        Route::get('/', 'index');
    
        Route::get('/mostrar/{id}', 'show');
    
        Route::get('/crear', 'create');
        Route::post('/guardar', 'store');
    
        Route::get('/editar/{id}', 'edit');
        Route::put('/actualizar/{id}', 'update');
    
        Route::delete('/eliminar/{id}', 'destroy');
    });
    
    Route::group([
        'prefix' => '/transportes',
        'controller' => TransporteController::class,
        'middleware' => 'rol:ADMIN,DEV,GERENTE'
    ], function () {
    
        Route::get('/', 'index');
    
        Route::get('/mostrar/{id}', 'show');
    
        Route::get('/crear', 'create');
        Route::post('/guardar', 'store');
    
        Route::get('/editar/{id}', 'edit');
        Route::put('/actualizar/{id}', 'update');
    
        Route::delete('/eliminar/{id}', 'destroy');
    });
    
    Route::group([
        'prefix' => '/usuarios',
        'controller' => UsuarioController::class,
        'middleware' => 'rol:ADMIN,DEV,GERENTE'
    ], function () {
    
        Route::get('/', 'index');
    
        Route::get('/crear/{empleado_id}', 'create');
        Route::post('/guardar', 'store');
    
        Route::get('/editar/{id}', 'edit');
        Route::put('/actualizar/{id}', 'update');
    
        Route::delete('/eliminar/{id}', 'destroy');
    });

    Route::group([
        'prefix' => '/envios',
        'controller' => EnvioController::class,
        'middleware' => 'rol:ADMIN,DEV,GERENTE,ATENCION'
    ], function () {

        // Route::get('/', 'index');
        Route::get('/consignados', 'consignados');
        Route::get('/recibidos', 'recibidos');
        Route::get('/despachados', 'despachados');
        Route::get('/entregados', 'entregados');
    
        Route::get('/mostrar/{id}', 'show');
    
        Route::get('/crear', 'create');
        Route::post('/guardar', 'store');
    
        // Route::get('/editar/{id}', 'edit');
        Route::put('/actualizar/{id}', 'update');
    
        // Route::delete('/eliminar/{id}', 'destroy');
    });

    Route::group([
        'prefix' => '/lotes',
        'controller' => LoteController::class,
        'middleware' => 'rol:ADMIN,DEV,GERENTE,CHOFER'
    ], function () {

        Route::get('/consignados', 'consignados');
        Route::get('/recibidos', 'recibidos');
        Route::get('/despachados', 'despachados');
    
        Route::get('/mostrar/{id}', 'show');
    
        // Route::get('/crear', 'create');
        // Route::post('/guardar', 'store');
    
        // Route::get('/editar/{id}', 'edit');
        
        Route::get('/transporte/{id}', 'edit');
        Route::put('/asignar/{id}', 'update');

        Route::put('/recibir/{id}', 'recibir');
        Route::put('/despachar/{id}', 'despachar');
    
        // Route::delete('/eliminar/{id}', 'destroy');
    });
});