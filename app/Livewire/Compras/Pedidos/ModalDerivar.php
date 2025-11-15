<?php

namespace App\Livewire\Compras\Pedidos;

use App\Models\Compras\Pedido;
use App\Models\Compras\PedidoComentario;
use App\Models\Departamento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ModalDerivar extends Component
{
    public $pedido;

    // PROPIEDADES DEL FORMULARIO
    #[Validate]
    public $departamento_id;

    // PROPIEDADES PARA LOS SELECT
    public $departamentos = [];

    public function mount($pedido_id)
    {
        $this->pedido        = Pedido::findOrFail($pedido_id);

        $this->departamento_id= $this->pedido->departamento_actual_id;

        $this->departamentos = Departamento::select('id', 'departamento')->orderBy('departamento')->get();
    }

    protected function rules()
    {
        return [
            'departamento_id' => ['required', Rule::exists(Departamento::class, 'id')]
        ];
    }

    public function grabar()
    {
        $this->validate();

        DB::transaction(function () {

            Pedido::findOrFail($this->pedido->id)->update([
                'departamento_actual_id' => $this->departamento_id,
                'actualizado_por'        => Auth::id()
            ]);

            $x = Departamento::select('departamento')->findOrFail($this->departamento_id);

            PedidoComentario::create([
                'comentario' => 'DERIVO EL PEDIDO A ' . $x->departamento,
                'pedido_id'  => $this->pedido->id,
                'creado_por' => Auth::id()
            ]);
        });

        session()->flash('success', 'Pedido Derivado correctamente.');
        $this->redirectRoute('compras.pedidos.show', $this->pedido->id);
    }

    public function render()
    {
        return view('livewire.compras.pedidos.modal-derivar');
    }
}
