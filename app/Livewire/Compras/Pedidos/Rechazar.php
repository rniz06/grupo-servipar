<?php

namespace App\Livewire\Compras\Pedidos;

use App\Enums\Compras\PedidoEstado;
use App\Models\Compras\Pedido;
use App\Models\Compras\PedidoComentario;
use App\Models\Compras\PedidoDetalle;
use App\Models\Compras\PedidoRechazado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Rechazar extends Component
{
    public $pedido, $detalles;

    // PROPIEDADES DEL FORMULARIO
    #[Validate('required|max:255')]
    public $motivo;

    public function mount($pedido_id)
    {
        $this->pedido = Pedido::with(['pedidoPor:id,name', 'departamento:id,departamento'])->findOrFail($pedido_id);
        $this->detalles = PedidoDetalle::select('cantidad', 'producto_id')->with(['producto:id,nombre'])->where('pedido_id', $this->pedido->id)->get();
    }

    public function grabar()
    {
        $this->validate();
        DB::transaction(function () {
            PedidoRechazado::create([
                'motivo'      => $this->motivo,
                'pedido_id'   => $this->pedido->id,
                'creado_por'  => Auth::id()
            ]);

            $this->pedido->update([
                'estado'          => PedidoEstado::RECHAZADO,
                'actualizado_por' => Auth::id()
            ]);

            PedidoComentario::create([
                'comentario' => 'RECHAZO EL PEDIDO',
                'pedido_id'  => $this->pedido->id,
                'creado_por' => Auth::id()
            ]);
        });

        session()->flash('success', 'Pedido Rechazado correctamente.');
        $this->redirectRoute('compras.pedidos.index');
    }

    public function render()
    {
        return view('livewire.compras.pedidos.rechazar');
    }
}
