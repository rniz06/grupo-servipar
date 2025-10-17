<?php

namespace App\Livewire\Admin\Usuarios;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    public $id;
    #[Validate]
    public $name, $usuario, $nro_cedula, $nro_celular, $observacion, $email;

    public function mount(User $user)
    {
        $this->id          = $user->id;
        $this->name        = $user->name;
        $this->usuario     = $user->usuario;
        $this->email     = $user->email;
        $this->nro_cedula  = $user->nro_cedula;
        $this->nro_celular = $user->nro_celular;
        $this->observacion = $user->observacion;
    
    }

    protected function rules()
    {
        return [
            'name'     => ['required', 'string', 'max:100'],
            'usuario'  => ['required', 'string', 'max:45', Rule::unique(User::class)->ignore($this->id)],
            'email'    => ['nullable', 'email', 'max:100', Rule::unique(User::class)->ignore($this->id)],
            'nro_cedula'  => ['required', 'string', 'max:45', Rule::unique(User::class)->ignore($this->id)],
            'nro_celular' => ['required', 'string', 'max:45', Rule::unique(User::class)->ignore($this->id)],
            'observacion' => ['required', 'string', 'max:255'],
        ];
    }

    public function guardar()
    {
        $this->validate();
        User::findOrFail($this->id)->update([
            'name' => $this->name,
            'usuario' => $this->usuario,
            'email' => $this->email,
            'nro_cedula' => $this->nro_cedula,
            'nro_celular' => $this->nro_celular,
            'observacion' => $this->observacion,
            'actualizadoPor' => Auth::id(),
        ]);

        session()->flash('success', 'Usuario Actualizado Correctamente!');
        $this->redirectRoute('admin.usuarios.index');
    }

    public function render()
    {
        return view('livewire.admin.usuarios.edit');
    }
}
