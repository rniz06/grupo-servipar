<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Pedidos\PedidoController;
use Illuminate\Support\Facades\Route;

Route::prefix('compras')->name('compras.')->middleware('auth')->group(function () {

    // RUTAS DEL MODULO PEDIDOS
    Route::controller(PedidoController::class)->prefix('pedidos')->name('pedidos.')->group(function () {
        Route::get('/', 'index')->name('index');
    });
});
