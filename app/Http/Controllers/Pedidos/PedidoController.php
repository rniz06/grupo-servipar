<?php

namespace App\Http\Controllers\Pedidos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Establece los middleware necesarios para gestionar permisos
     * Se utilizan permisos específicos para cada acción del controlador.
     */
    function __construct()
    {
        $this->middleware('permission:Pedidos Listar', ['only' => ['index']]);
        $this->middleware('permission:Pedidos Crear', ['only' => ['create']]);
    }

    public function index()
    {
        return view('compras.pedidos.index');
    }

    public function create()
    {
        return view('compras.pedidos.create');
    }
}
