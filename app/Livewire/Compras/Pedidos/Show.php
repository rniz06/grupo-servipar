<?php

namespace App\Livewire\Compras\Pedidos;

use App\Enums\Compras\PedidoEstado;
use App\Enums\Compras\PresupuestoEstado;
use App\Models\Compras\Pedido;
use App\Models\Compras\PedidoComentario;
use App\Models\Compras\PedidoDetalle;
use App\Models\Compras\PedidoRechazado;
use App\Models\Compras\Presupuesto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $pedido, $anulado, $items, $comentarios, $usuario;

    public function mount($pedido_id)
    {
        $this->pedido = Pedido::with(['pedidoPor:id,name', 'departamentoActual:id,departamento', 'departamentoSolicitante:id,departamento,responsable_id', 'sucursal:id,sucursal'])->findOrFail($pedido_id);

        $this->anulado = PedidoRechazado::select('id', 'motivo', 'creado_por')->with(['creadoPor:id,name'])->where('pedido_id', $pedido_id)->first() ?? null;

        $this->items = PedidoDetalle::select('id', 'cantidad', 'producto_id')->with(['producto:id,nombre'])->where('pedido_id', $pedido_id)->get();

        $this->comentarios = PedidoComentario::select('id', 'comentario', 'creado_por', 'created_at')->where('pedido_id', $this->pedido->id)
            ->with(['creadoPor:id,name'])
            ->orderByDesc('created_at')
            ->get();

        $this->usuario = Auth::user();
    }

    public function aprobarPedidoSupervisor()
    {
        DB::transaction(function () {

            Pedido::findOrFail($this->pedido->id)->update([
                'estado' => PedidoEstado::APROBADOSUPERVISOR,
                'actualizado_por' => Auth::id()
            ]);

            PedidoComentario::create([
                'comentario' => "APROBO PEDIDO",
                'pedido_id'  => $this->pedido->id,
                'creado_por' => Auth::id()
            ]);
        });

        session()->flash('success', 'Pedido Aprobado Por Supervisor.');
        $this->redirectRoute('compras.pedidos.show', $this->pedido->id);
    }


    public function render()
    {
        return view('livewire.compras.pedidos.show');
    }
}
