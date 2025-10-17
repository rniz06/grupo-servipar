<?php

use App\Http\Controllers\Admin\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('role:SuperAdmin')->group(function () {
    
    // RUTAS DEL MODULO USUARIOS
    Route::controller(UsuarioController::class)->group(function () {
        Route::get('/usuarios', 'index')->name('usuarios.index');
        Route::get('/usuarios/create', 'create')->name('usuarios.create');
        Route::get('/usuarios/{usuario}/edit', 'edit')->name('usuarios.edit');
    });
});
