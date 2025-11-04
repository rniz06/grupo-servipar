<?php

namespace App\Livewire\Compras\Pedidos;

use App\Enums\Compras\PresupuestoEstado;
use App\Models\Compras\Pedido;
use App\Models\Compras\Presupuesto as ComprasPresupuesto;
use App\Models\Compras\PresupuestoDetalle;
use App\Models\Compras\Proveedor;
use App\Models\Productos\Producto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Presupuesto extends Component
{
    public $pedido;

    // PROPIEDADES DEL FORMULARIO
    #[Validate]
    public $proveedor_id;

    public $proveedores = [], $productos  = [], $items = [];

    public function mount($pedido_id)
    {
        $this->pedido = Pedido::select('id')->with(['pedidoDetalle:id,producto_id,pedido_id,cantidad'])->findOrFail($pedido_id);
        $this->proveedores = Proveedor::select('id', 'razon_social', 'ruc')->orderBy('razon_social')->get();

        $this->productos    = Producto::with('categoria:id,categoria,nivel')->get();

       // Inicializar items directamente, con fallback usando operador ternario
    $this->items = $this->pedido->pedidoDetalle->isNotEmpty()
        ? $this->pedido->pedidoDetalle->map(fn($detalle) => [
            'producto_id' => $detalle->producto_id,
            'cantidad'    => $detalle->cantidad,
            'precio'      => null
        ])->toArray()
        : [['producto_id' => null, 'cantidad' => 1, 'precio' => null]];
    }

    protected function rules()
    {
        return [
            'proveedor_id' => ['required', Rule::exists(Proveedor::class, 'id')],
            'items.*.producto_id' => ['required', Rule::exists(Producto::class, 'id')],
            'items.*.cantidad'    => ['required', 'numeric', 'min:1'],
            'items.*.precio'    => ['required', 'numeric']
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
        $this->items[] = ['producto_id' => null, 'cantidad' => 1, 'cantidad' => null];
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
            $presupuesto = ComprasPresupuesto::create([
                'fecha'           => Carbon::now()->format('Y-m-d'),
                'estado'          => PresupuestoEstado::ENREVISION,
                'pedido_id'       => $this->pedido->id,
                'proveedor_id'    => $this->proveedor_id,
                'empresa_id'      => $usuario->empresa_id,
                'sucursal_id'     => $usuario->sucursal_id,
                'creado_por'      => $usuario->id
            ]);
            foreach ($this->items as $item) {
                PresupuestoDetalle::create([
                    'cantidad'       => $item['cantidad'],
                    'precio'         => $item['precio'],
                    'presupuesto_id' => $presupuesto->id,
                    'producto_id'    => $item['producto_id'],
                    'creado_por'     => $usuario->id
                ]);
            }
        });

        session()->flash('success', 'Presupuesto Agregado correctamente.');
        $this->redirectRoute('compras.pedidos.index');
    }

    public function render()
    {
        return view('livewire.compras.pedidos.presupuesto');
    }
}
