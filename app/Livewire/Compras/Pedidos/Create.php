<?php

namespace App\Livewire\Compras\Pedidos;

use App\Enums\Compras\PedidoEstado;
use App\Models\Compras\Pedido;
use App\Models\Compras\PedidoComentario;
use App\Models\Compras\PedidoDetalle;
use App\Models\Productos\Producto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    // PROPIEDADES DEL FORMULARIO
    #[Validate]
    public $fecha_pedido, $estado, $pedido_por, $items = [];

    // ITEMS (cada item = producto + cantidad)


    // LISTA DE PRODUCTOS DISPONIBLES
    public $productos = [];

    public function mount()
    {
        $this->fecha_pedido = Carbon::now()->format('Y-m-d');
        $this->estado       = PedidoEstado::PENDIENTE;
        $this->pedido_por   = Auth::user()->name;

        $this->productos    = Producto::with('categoria:id,categoria,nivel')->get();

        // Iniciar con un item vacío
        $this->items = [
            ['producto_id' => null, 'cantidad' => 1],
        ];
    }

    protected function rules()
    {
        return [
            'items.*.producto_id' => ['required', Rule::exists(Producto::class, 'id')],
            'items.*.cantidad'    => ['required', 'numeric', 'min:1']
        ];
    }

    protected function messages()
    {
        return [
            'items.*.producto_id.required' => 'El campo item es obligatorio.',
            'items.*.producto_id.exists'   => 'El item seleccionado no existe en el sistema(Contacte con soporte).',

            'items.*.cantidad.required'    => 'La cantidad es obligatoria.',
            'items.*.cantidad.numeric'     => 'La cantidad debe ser un número válido.',
            'items.*.cantidad.min'         => 'La cantidad mínima permitida es :min.',
        ];
    }

    public function agregarItem()
    {
        $this->items[] = ['producto_id' => null, 'cantidad' => 1];
    }

    public function eliminarItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Reindexar el array
    }

    public function grabar()
    {
        $this->validate();

        DB::transaction(function () {

            $usuario = Auth::user();
            // Crear Cabecera
            $pedido = Pedido::create([
                'fecha_pedido'    => Carbon::now()->format('Y-m-d'),
                'estado'          => PedidoEstado::PENDIENTE,
                'pedido_por'      => $usuario->id,
                'departamento_id' => $usuario->departamento_id,
                'empresa_id'      => $usuario->empresa_id,
                'sucursal_id'     => $usuario->sucursal_id,
                'creado_por'      => $usuario->id
            ]);
            foreach ($this->items as $item) {
                PedidoDetalle::create([
                    'pedido_id'   => $pedido->id,
                    'producto_id' => $item['producto_id'],
                    'cantidad'    => $item['cantidad'],
                    'creado_por'  => $usuario->id
                ]);
            }

            PedidoComentario::create([
                'comentario' => 'INGRESA PEDIDO AL SISTEMA',
                'pedido_id'  => $pedido->id,
                'creado_por' => Auth::id()
            ]);
        });

        session()->flash('success', 'Pedido Realizado correctamente.');
        $this->redirectRoute('compras.pedidos.index');
    }

    public function render()
    {
        return view('livewire.compras.pedidos.create');
    }
}
