<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PostController;
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [DefaultController::class, 'home'])->name('home');
Route::get('/estadisticas', [DefaultController::class, 'estadisticas'])->name('cuenta_estadisticas');

Route::get('/cuenta/list', [CuentaController::class, 'list'])->name('cuenta_list');
Route::get('/cliente/list', [ClienteController::class, 'list'])->name('cliente_list');
Route::get('/cuenta/filtro', [CuentaController::class, 'filtro'])->name('cuenta_filtro');

Route::middleware('auth')->group(function () {
    //// CUENTAS
    Route::match(['get', 'post'], '/cuenta/new', [CuentaController::class, 'new'])->name('cuenta_new');

    Route::match(['get', 'post'], '/cuenta/modificar/{id}', [CuentaController::class, 'modificar'])->name('cuenta_modificar');

    Route::get('/cuenta/delete/{id}', [CuentaController::class, 'delete'])->name('cuenta_delete');

    //// CLIENTES
    Route::match(['get', 'post'], '/cliente/new', [ClienteController::class, 'new'])->name('cliente_new');

    Route::match(['get', 'post'], '/cliente/modificar/{id}', [ClienteController::class, 'modificar'])->name('cliente_modificar');

    Route::get('/cliente/delete/{id}', [ClienteController::class, 'delete'])->name('cliente_delete');
});

//// VALIDACIONES

Route::get('/post/create', [PostController::class, 'create']);

Route::post('/post', [PostController::class, 'store']);

?>