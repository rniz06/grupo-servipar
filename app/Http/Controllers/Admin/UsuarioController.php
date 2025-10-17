<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('admin.usuarios.index');
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function edit($usuario)
    {
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function asignarRol($usuario)
    {
        return view('admin.usuarios.asignar-rol', compact('usuario'));
    }
}
