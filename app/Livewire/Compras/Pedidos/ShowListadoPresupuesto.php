<?php

namespace App\Livewire\Compras\Pedidos;

use App\Enums\Compras\PresupuestoEstado;
use App\Models\Compras\Pedido;
use App\Models\Compras\PedidoComentario;
use App\Models\Compras\Presupuesto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowListadoPresupuesto extends Component
{
    public $pedido;
    public $paginado = 5;

    public function mount($pedido_id)
    {
        $this->pedido = Pedido::findOrFail($pedido_id);
    }

    // Limpiar el buscador y la paginación al cambiar de pagina
    public function updating($key): void
    {
        if (in_array($key, [
            'paginado',
        ])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.compras.pedidos.show-listado-presupuesto', [
            'presupuestos' => Presupuesto::select('id', 'fecha', 'estado', 'proveedor_id', 'creado_por')
                ->where('pedido_id', $this->pedido->id)
                ->with(['proveedor:id,razon_social,ruc', 'creadoPor:id,name'])->paginate($this->paginado, ['*'], 'presupuestos_page')
        ]);
    }

    public function aprobarPresupuesto($id)
    {
        DB::transaction(function () use ($id) {
            // MARCAR COMO APROBADO EL PRESUPUESTO SELECCIONADO
            $presupuesto = Presupuesto::findOrFail($id);

            $presupuesto->update([
                'estado'          => PresupuestoEstado::APROBADO,
                'actualizado_por' => Auth::id(),
            ]);

            // MARCAR EL RESTO DE PRESUPUESTOS DE ESTE PEDIDO COMO RECHAZADO
            $rechazados = Presupuesto::where('pedido_id', $presupuesto->pedido_id)
                ->where('id', '!=', $presupuesto->id)
                ->get(['id']); // Traemos solo el campo id

            foreach ($rechazados as $rechazado) {
                Presupuesto::findOrFail($rechazado->id)->update([
                    'estado'          => PresupuestoEstado::RECHAZADO,
                    'actualizado_por' => Auth::id(),
                ]);
            }

            PedidoComentario::create([
                'comentario' => 'APROBO PRESUPUESTO',
                'pedido_id' => $this->pedido->id,
                'creado_por' => Auth::id()
            ]);
        });

        session()->flash('success', 'Presupuesto Aprobado correctamente.');
        $this->redirectRoute('compras.pedidos.show', $this->pedido->id);
    }
}
