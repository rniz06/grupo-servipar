<?php

namespace App\Livewire\Compras\Pedidos;

use App\Models\Compras\Pedido;
use App\Models\Compras\PedidoDetalle;
use App\Models\Compras\PedidoRechazado;
use App\Models\Compras\Presupuesto;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $pedido, $anulado, $items;

    public $presupuestosPaginado = 5;

    public function mount($pedido_id)
    {
        $this->pedido = Pedido::with(['pedidoPor:id,name', 'departamento:id,departamento', 'sucursal:id,sucursal'])->findOrFail($pedido_id);

        $this->anulado = PedidoRechazado::select('id', 'motivo', 'creado_por')->with(['creadoPor:id,name'])->where('pedido_id', $pedido_id)->first() ?? null;

        $this->items = PedidoDetalle::select('id', 'cantidad', 'producto_id')->with(['producto:id,nombre'])->where('pedido_id', $pedido_id)->get();
    }

    // Limpiar el buscador y la paginación al cambiar de pagina
    public function updating($key): void
    {
        if (in_array($key, [
            'presupuestosPaginado',
        ])) {
            $this->resetPage();
        }
    }


    public function render()
    {
        return view('livewire.compras.pedidos.show', [
            'presupuestos' => Presupuesto::select('id', 'fecha', 'estado', 'proveedor_id', 'creado_por')
                ->with(['proveedor:id,razon_social,ruc', 'creadoPor:id,name'])->paginate($this->presupuestosPaginado, ['*'], 'presupuestos_page')
        ]);
    }
}
