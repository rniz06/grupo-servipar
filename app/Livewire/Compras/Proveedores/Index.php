<?php

namespace App\Livewire\Compras\Proveedores;

use App\Exports\Excel\Compras\Proveedores\ExcelListadoProveedores;
use App\Exports\Pdf\Compras\Proveedores\PdfListadoProveedores;
use App\Models\Ciudad;
use App\Models\Compras\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;

    // Propiedades de Busqueda
    public $buscarRazonsocial = '', $buscarRuc = '', $buscarCorreo = '', $buscarDireccion = '', $buscarTelefono = '', $buscarCiudadId = '';
    public $paginado = 5;

    // Propiedades de Busqueda Select
    public $ciudades = [];

    public function mount()
    {
        $this->ciudades = Ciudad::select('id', 'ciudad')->orderBy('ciudad')->get();
    }

    // Limpiar el buscador y la paginación al cambiar de pagina
    public function updating($key): void
    {
        if (in_array($key, [
            'buscarRazonsocial',
            'buscarRuc',
            'buscarCorreo',
            'buscarDireccion',
            'buscarTelefono',
            'buscarCiudadId',
            'paginado'
        ])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.compras.proveedores.index', [
            'proveedores' => Proveedor::select('id', 'razon_social', 'ruc', 'correo', 'direccion', 'telefono', 'ciudad_id')
                ->buscarRazonsocial($this->buscarRazonsocial)
                ->buscarRuc($this->buscarRuc)
                ->buscarCorreo($this->buscarCorreo)
                ->buscarDireccion($this->buscarDireccion)
                ->buscarTelefono($this->buscarTelefono)
                ->buscarCiudadId($this->buscarCiudadId)
                ->with(['ciudad:id,ciudad'])
                ->paginate($this->paginado)
        ]);
    }

    public function cargarDatosParaExpotar()
    {
        return Proveedor::select('razon_social', 'ruc', 'correo', 'direccion', 'telefono', 'ciudad_id')
            ->buscarRazonsocial($this->buscarRazonsocial)
            ->buscarRuc($this->buscarRuc)
            ->buscarCorreo($this->buscarCorreo)
            ->buscarDireccion($this->buscarDireccion)
            ->buscarTelefono($this->buscarTelefono)
            ->buscarCiudadId($this->buscarCiudadId)
            ->with(['ciudad:id,ciudad'])
            ->get();
    }

    public function excel()
    {
        $datos = $this->cargarDatosParaExpotar();
        return Excel::download(new ExcelListadoProveedores($datos), 'Proveedores.xlsx');
    }

    public function pdf()
    {
        $nombre_archivo = "Proveedores";
        $datos = $this->cargarDatosParaExpotar();
        return (new PdfListadoProveedores($datos, $nombre_archivo))->download();
    }
}
