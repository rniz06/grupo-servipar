<?php

namespace App\Livewire\Compras\Pedidos;

use App\Models\Compras\PresupuestoDetalle;
use Livewire\Component;

class PresupuestoVer extends Component
{
    public $detalles, $presupuesto_id;

    public function mount($presupuesto_id)
    {
        $this->presupuesto_id = $presupuesto_id;

        $this->detalles = PresupuestoDetalle::select('cantidad', 'precio', 'producto_id')
            ->with(['producto:id,nombre'])
            ->where('presupuesto_id', $presupuesto_id)
            ->get();
    }

    public function render()
    {
        return view('livewire.compras.pedidos.presupuesto-ver');
    }
}
