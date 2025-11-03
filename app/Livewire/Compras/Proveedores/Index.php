<?php

namespace App\Livewire\Compras\Proveedores;

use App\Models\Ciudad;
use App\Models\Compras\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;

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
}
