<?php

namespace App\Http\Controllers\Compras\Proveedores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Establece los middleware necesarios para gestionar permisos
     * Se utilizan permisos específicos para cada acción del controlador.
     */
    function __construct()
    {
        $this->middleware('permission:Proveedores Listar', ['only' => ['index']]);
        $this->middleware('permission:Proveedores Crear', ['only' => ['create']]);
    }

    public function index()
    {
        return view('compras.proveedores.index');
    }

    public function create()
    {
        return view('compras.proveedores.create');
    }
}
