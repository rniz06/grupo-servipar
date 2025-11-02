<?php

namespace App\Livewire\Compras\Pedidos;

use App\Enums\Compras\PedidoEstado;
use App\Models\Compras\Pedido;
use App\Models\Departamento;
use App\Models\Sucursal;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // Propiedades de Busqueda
    public $buscarFechaPedido = '', $buscarFechaEntrega = '', $buscarEstado = '', $buscarDepartamentoId = '', $buscarSucursalId = '';
    public $paginado = 5;

    // Propiedades de Busqueda Select
    public $estados = [], $departamentos = [], $sucursales = [];

    public function mount()
    {
        $this->estados       = PedidoEstado::cases();
        $this->departamentos = Departamento::select('id', 'departamento')->orderBy('departamento')->get();
        $this->sucursales    = Sucursal::select('id', 'sucursal')->orderBy('sucursal')->get();
    }

    public function render()
    {
        return view('livewire.compras.pedidos.index', [
            'pedidos' => Pedido::select('id', 'fecha_pedido', 'fecha_entrega', 'estado', 'departamento_id', 'sucursal_id', 'pedido_por')
                ->buscarFechaPedido($this->buscarFechaPedido)
                ->buscarFechaEntrega($this->buscarFechaEntrega)
                ->buscarEstado($this->buscarEstado)
                ->with(['departamento:id,departamento', 'sucursal:id,sucursal', 'pedidoPor:id,name'])
                ->paginate($this->paginado)
        ]);
    }
}
