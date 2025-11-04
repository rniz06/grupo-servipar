<?php

use App\Http\Controllers\Compras\Pedidos\PedidoController;
use App\Http\Controllers\Compras\Proveedores\ProveedorController;
use Illuminate\Support\Facades\Route;

Route::prefix('compras')->name('compras.')->middleware('auth')->group(function () {

    // RUTAS DEL MODULO PEDIDOS
    Route::controller(PedidoController::class)->prefix('pedidos')->name('pedidos.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{pedido}', 'show')->name('show');
    });

    // RUTAS DEL MODULO PROVEEDORES
    Route::controller(ProveedorController::class)->prefix('proveedores')->name('proveedores.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{proveedor}/edit', 'edit')->name('edit');
    });
});
