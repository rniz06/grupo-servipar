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
        $this->middleware('permission:Proveedores Editar', ['only' => ['edit']]);
    }

    public function index()
    {
        return view('compras.proveedores.index');
    }

    public function create()
    {
        return view('compras.proveedores.create');
    }

    public function edit($proveedor)
    {
        return view('compras.proveedores.edit', compact('proveedor'));
    }
}
