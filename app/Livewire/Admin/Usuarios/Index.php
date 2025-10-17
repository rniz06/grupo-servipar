<?php

namespace App\Livewire\Admin\Usuarios;

use App\Exports\Excel\Admin\Usuarios\ExcelListadoUsuarios;
use App\Exports\Pdf\Admin\Usuarios\PdfListadoUsuarios;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;

    public $buscador = '';
    public $buscarName = '';
    public $buscarUsuario = '';
    public $buscarEmail = '';
    public $buscarActivo = '';
    public $paginado = 5;

    // Limpiar el buscador y la paginación al cambiar de pagina
    public function updating($key): void
    {
        if (in_array($key, [
            'buscador',
            'buscarName',
            'buscarUsuario',
            'buscarEmail',
            'buscarActivo',
            'paginado',
        ])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.admin.usuarios.index', [
            'usuarios' => User::buscador($this->buscador)
                ->buscarName($this->buscarName)
                ->buscarUsuario($this->buscarUsuario)
                ->buscarEmail($this->buscarEmail)
                ->buscarActivo($this->buscarActivo)
                ->paginate($this->paginado),
        ]);
    }

    // METODO PARA ACTIVAR UN USUARIO
    public function activar($id)
    {
        User::findOrFail($id)->update([
            'activo' => true,
            'actualizadoPor' => Auth::id(),
        ]);

        session()->flash('success', 'Usuario Activo Correctamente!');
        $this->redirectRoute('admin.usuarios.index');
    }

    // METODO PARA INACTIVAR UN USUARIO
    public function inactivar($id)
    {
        User::findOrFail($id)->update([
            'activo' => false,
            'actualizadoPor' => Auth::id(),
        ]);

        session()->flash('success', 'Usuario Inactivado Correctamente!');
        $this->redirectRoute('admin.usuarios.index');
    }

    // METODO PARA INACTIVAR UN USUARIO
    public function resetearContrasena($id)
    {
        User::findOrFail($id)->update([
            'password' => Hash::make('12345678'),
            'actualizadoPor' => Auth::id(),
        ]);

        session()->flash('success', 'Contraseña Restablecida Correctamente!');
        $this->redirectRoute('admin.usuarios.index');
    }

    public function cargarDatosParaExpotar()
    {
        return User::select('name', 'usuario', 'email', 'nro_cedula', 'nro_celular', 'observacion', 'activo', 'ultimo_acceso')
            ->buscador($this->buscador)
            ->buscarName($this->buscarName)
            ->buscarUsuario($this->buscarUsuario)
            ->buscarEmail($this->buscarEmail)
            ->buscarActivo($this->buscarActivo)
            ->orderBy('name')
            ->get();
    }

    public function excel()
    {
        $datos = $this->cargarDatosParaExpotar();
        $encabezados = ['Nombre', 'Usuario', 'Email', 'Nro. Cedula', 'Nro. Celular', 'Obs:', 'Activo', 'Ultimo Acceso'];

        return Excel::download(new ExcelListadoUsuarios($datos, $encabezados), 'Usuarios.xlsx');
    }

    public function pdf()
    {
        $nombre_archivo = "Usuarios";
        $datos = $this->cargarDatosParaExpotar();
        $encabezados = ['Nombre', 'Usuario', 'Email', 'Nro. Cedula', 'Nro. Celular', 'Obs:', 'Activo', 'Ultimo Acceso'];

        return (new PdfListadoUsuarios($datos, $encabezados, $nombre_archivo))->download();
    }
}
