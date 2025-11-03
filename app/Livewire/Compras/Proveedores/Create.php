<?php

namespace App\Livewire\Compras\Proveedores;

use App\Models\Ciudad;
use App\Models\Compras\Proveedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    // PROPIEDADES DEL FORMULARIO
    #[Validate]
    public $razon_social, $ruc, $correo, $direccion, $telefono, $ciudad_id;

    // PROPIEDADES PARA SELECT
    public $ciudades = [];

    public function mount()
    {
        $this->ciudades = Ciudad::select('id', 'ciudad')->orderBy('ciudad')->get();
    }

    protected function rules()
    {
        return [
            'razon_social' => ['required', Rule::unique(Proveedor::class), 'max:75'],
            'ruc'          => ['required', Rule::unique(Proveedor::class), 'min:7', 'max:20'],
            'correo'       => ['required', Rule::unique(Proveedor::class), 'max:50'],
            'direccion'    => ['nullable', 'string', 'max:100'],
            'telefono'     => ['required', Rule::unique(Proveedor::class), 'max:20'],
            'ciudad_id'    => ['required', Rule::exists(Ciudad::class, 'id')],
        ];
    }

    public function grabar()
    {
        $this->validate();
        Proveedor::create([
            'razon_social' => $this->razon_social,
            'ruc'          => $this->ruc,
            'correo'       => $this->correo,
            'direccion'    => $this->direccion,
            'telefono'     => $this->telefono,
            'ciudad_id'    => $this->ciudad_id,
            'creado_por'   => Auth::id()
        ]);

        session()->flash('success', 'Proveedor Registrado correctamente.');
        $this->redirectRoute('compras.proveedores.index');
    }

    public function render()
    {
        return view('livewire.compras.proveedores.create');
    }
}
