<?php

namespace App\Livewire\Admin\Usuarios;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate]
    public $name, $usuario, $nro_cedula, $nro_celular, $observacion, $email, $password = '12345678';

    protected function rules()
    {
        return [
            'name'        => ['required', 'string', 'max:100'],
            'usuario'     => ['required', 'string', 'max:45', Rule::unique(User::class)],
            'nro_cedula'  => ['required', 'string', 'max:45', Rule::unique(User::class)],
            'nro_celular' => ['required', 'string', 'max:45', Rule::unique(User::class)],
            'observacion' => ['required', 'string', 'max:255'],
            'email'       => ['nullable', 'email', 'max:100', Rule::unique(User::class)],
            'password'    => ['required', 'string', 'min:8', 'max:20'],
        ];
    }

    public function guardar()
    {
        $this->validate();
        User::create([
            'name' => $this->name,
            'usuario' => $this->usuario,
            'email' => $this->email,
            'nro_cedula' => $this->nro_cedula,
            'nro_celular' => $this->nro_celular,
            'observacion' => $this->observacion,
            'password' => $this->password,
            'activo' => true, // ACTIVO POR DEFECTO
            'ultimo_acceso' => null, // NULO AL CREAR
            'creadoPor' => Auth::id(),
        ]);

        session()->flash('success', 'Usuario Creado Correctamente!');
        $this->redirectRoute('admin.usuarios.index');
    }

    public function render()
    {
        return view('livewire.admin.usuarios.create');
    }
}
