<?php

namespace App\Livewire\Compras\Pedidos;

use App\Enums\Compras\CompraEstado;
use App\Enums\Compras\PedidoEstado;
use App\Enums\Compras\PresupuestoEstado;
use App\Models\Compras\Compra;
use App\Models\Compras\Pedido;
use App\Models\Compras\PedidoComentario;
use App\Models\Compras\Presupuesto;
use App\Models\Compras\PresupuestoDetalle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ModalCargarFactura extends Component
{
    public $pedido, $presupuesto, $detalles = [];

    public $fecha, $nro_factura, $total_pagado;

    public function mount($pedido_id)
    {
        $this->pedido = Pedido::findOrFail($pedido_id);

        $this->presupuesto = Presupuesto::where('pedido_id', $this->pedido->id)->where('estado', PresupuestoEstado::APROBADO)->first();

        if (isset($this->presupuesto)) {
            $this->detalles = PresupuestoDetalle::where('presupuesto_id', $this->presupuesto->id)->get(['precio', 'cantidad']);
        }

        $this->fecha = Carbon::now()->format('Y-m-d');

        $a = 0;

        foreach ($this->detalles as $detalle) {
            $a =  $a + ($detalle->precio * $detalle->cantidad);
        }

        $this->total_pagado = $a;
    }

    protected function rules()
    {
        return [
            'nro_factura'   => ['required', 'max:30'],
            'total_pagado'  => ['required', 'numeric']
        ];
    }

    public function grabar()
    {
        $this->validate();

        DB::transaction(function () {
            
            Compra::create([
                'fecha'          => Carbon::now()->format('Y-m-d'),
                'nro_factura'    => $this->nro_factura ?? null,
                'total_pagado'   => $this->total_pagado ?? null,
                'estado'         => CompraEstado::FINALIZADO,
                'pedido_id'      => $this->pedido->id,
                'presupuesto_id' => $this->presupuesto->id,
                'empresa_id'     => $this->pedido->empresa_id,
                'sucursal_id'    => $this->pedido->sucursal_id,
                'creado_por'     => Auth::id()
            ]);

            Pedido::findOrFail($this->pedido->id)->update([
                'fecha_entrega'   => Carbon::now()->format('Y-m-d'),
                'estado'          => PedidoEstado::APROBADO,
                'actualizado_por' => Auth::id()
            ]);

            PedidoComentario::create([
                'comentario' => 'CARGA FACTURA Y FINALIZA PEDIDO',
                'pedido_id'  => $this->pedido->id,
                'creado_por' => Auth::id()
            ]);
        });

        session()->flash('success', 'Pedido Finalizado correctamente.');
        $this->redirectRoute('compras.pedidos.index');
    }

    public function render()
    {
        return view('livewire.compras.pedidos.modal-cargar-factura');
    }
}
