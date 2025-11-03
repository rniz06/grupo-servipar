<?php

namespace App\Livewire\Compras\Pedidos;

use App\Enums\Compras\PedidoEstado;
use App\Models\Productos\Producto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    // PROPIEDAADES DEL FORMULARIO
    #[Validate]
    public $fecha_pedido , $estado, $pedido_por;

    public function mount()
    {
        $this->fecha_pedido = Carbon::now()->format('Y-m-d');
        $this->estado       = PedidoEstado::PENDIENTE;
        $this->pedido_por   = Auth::user()->name;
    }

    protected function rules()
    {
        return [
            'fecha_pedido'    => ['required', 'date', Rule::date()],
            'estado'          => ['required'],
            'pedido_por'      => ['required', Rule::exists(User::class, 'id')],
        ];
    }

    public function render()
    {
        return view('livewire.compras.pedidos.create');
    }
}
