<?php

namespace App\Livewire\Cda\IngresoVehiculo;

use App\Models\Acceso;
use App\Models\Cda\IngresoVehiculo;
use App\Models\Cda\Persona;
use App\Models\Cda\Vehiculo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Salida extends Component
{
    public $registro;

    // Datos del ingreso
    public $chapa, $acceso_salida_id;

    // Opciones para selects
    public $accesos;

    public function mount()
    {
        $this->accesos = Acceso::orderBy('acceso')->get(['id', 'acceso']);
    }

    protected function rules()
    {
        return [
            'chapa'            => ['required', 'string', 'min:6', 'max:10'],
            'acceso_salida_id' => ['required', Rule::exists(Acceso::class, 'id')],
        ];
    }

    /** ─────────────────────────────────────────────
     *  Eventos de actualización
     * ────────────────────────────────────────────── */
    public function updatedChapa($value)
    {
        $this->resetVehiculoForm();

        $this->registro = IngresoVehiculo::with(['vehiculo', 'personaIngreso'])
            ->whereHas('vehiculo', function (Builder $query) use ($value) {
                $query->where('chapa', $value);
            })->first();
    }

    /** ─────────────────────────────────────────────
     *  Métodos auxiliares (limpieza y relleno)
     * ────────────────────────────────────────────── */
    private function resetVehiculoForm()
    {
        $this->registro = null;
    }

    /** ────────────────────────────────────────────
     *  Registro de ingreso
     * ────────────────────────────────────────────── */
    public function grabar()
    {
        
        $this->validate();

        // AGREGAR VALIDACION SI NO SE ENCUENTRA UNA ENTRADA DE ESE VEHICULO Y FILTRAR SOLO POR LOS PENDIENTES DE SALIDA
        
        $this->registro->update([
            'fecha_hora_salida'       => Carbon::now(),
            'acceso_salida_id'        => $this->acceso_salida_id,
            'usuario_registro_salida' => Auth::id(),
            'corresponde_salida'      => true,
            'actualizado_por'         => Auth::id(),
        ]);

        session()->flash('success', 'Salida registrada correctamente.');
        return redirect()->route('cda.panel-central.index');
    }

    public function render()
    {
        return view('livewire.cda.ingreso-vehiculo.salida');
    }
}
