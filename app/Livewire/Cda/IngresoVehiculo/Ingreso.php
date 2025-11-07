<?php

namespace App\Livewire\Cda\IngresoVehiculo;

use App\Models\Acceso;
use App\Models\Cda\Color;
use App\Models\Cda\IngresoVehiculo;
use App\Models\Cda\Marca;
use App\Models\Cda\Modelo;
use App\Models\Cda\Persona;
use App\Models\Cda\Vehiculo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Ingreso extends Component
{
    /*
    |---------------------------------------
    | pi: persona ingresa
    |---------------------------------------
    */

    public $vehiculo_id, $persona_ingresa_id, $persona_visita_id, $acceso_ingreso_id;

    public $chapa, $marca_id, $modelo_id, $color_id; // PROPIEDADES DEL VEHICULO

    public $pi_nombre_completo, $pi_nro_cedula; // PROPIEDADES DE LA PERSONA QUE INGRESA

    public $marcas, $modelos, $colores, $personasVisitables, $accesos; // PROPIEDADES PARA LOS SELECT

    public $bloqueoFormVehiculo = true, $bloqueoFormPerIngresa = true;

    public function mount()
    {
        $this->marcas = Marca::select('id', 'marca')->orderBy('marca')->get();

        $this->modelos = Modelo::select('id', 'modelo', 'marca_id')->orderBy('modelo')->get();

        $this->colores = Color::select('id', 'color')->orderBy('color')->get();

        $this->personasVisitables = Persona::select('id', 'nombre_completo')->where('esPersonalEmpresa', true)->orderBy('nombre_completo')->get();

        $this->accesos = Acceso::select('id', 'acceso')->orderBy('acceso')->get();
    }

    protected function rules()
    {
        return [
            'chapa'     => ['required', 'min:6', 'max:10'],
            'marca_id'  => ['required', Rule::exists(Marca::class, 'id')],
            'modelo_id' => ['required', Rule::exists(Modelo::class, 'id')],
            'color_id'  => ['required', Rule::exists(Color::class, 'id')],
            'pi_nro_cedula' => ['required', 'min:6', 'max:15'],
            'pi_nombre_completo' => ['required', 'string'],
            'persona_visita_id'  => ['required', Rule::exists(Persona::class, 'id')],
            'acceso_ingreso_id'  => ['required', Rule::exists(Acceso::class, 'id')],
        ];
    }

    public function updatedChapa($value)
    {
        $this->bloqueoFormVehiculo = true;
        $this->marca_id  = '';
        $this->modelo_id = '';
        $this->color_id  = '';

        $vehiculo = Vehiculo::select('id', 'chapa', 'marca_id', 'modelo_id', 'color_id')
            ->with(['marca:id,marca', 'modelo:id,modelo', 'color:id,color'])
            ->where('chapa', $value)
            ->first();

        if ($vehiculo) {
            $this->vehiculo_id  = $vehiculo->id;
            $this->marca_id     = $vehiculo->marca_id;
            $this->modelo_id    = $vehiculo->modelo_id;
            $this->color_id     = $vehiculo->color_id;
        } else {
            $this->bloqueoFormVehiculo = false;
        }
    }

    public function updatedMarcaId($value)
    {
        $this->modelo_id = '';

        $this->modelos = Modelo::select('id', 'modelo', 'marca_id')->where('marca_id', $value)->orderBy('modelo')->get();
    }

    public function updatedPiNroCedula($value)
    {
        $this->bloqueoFormPerIngresa = true;
        $this->pi_nombre_completo    = '';

        $persona = Persona::select('id', 'nombre_completo', 'nro_cedula')->where('nro_cedula', $value)->first();

        if ($persona) {
            $this->pi_nombre_completo = $persona->nombre_completo;
            $this->persona_ingresa_id = $persona->id;
        } else {
            $this->bloqueoFormPerIngresa = false;
        }
    }

    public function grabar()
    {
        $this->validate();

        // SI EL VEHICULO NO EXISTE LO CREAMOS
        if ($this->vehiculo_id == null) {
            $vehiculo = Vehiculo::create([
                'chapa'      => $this->chapa,
                'marca_id'   => $this->marca_id,
                'modelo_id'  => $this->modelo_id,
                'color_id'   => $this->color_id,
                'creado_por' => Auth::id()
            ]);
            $this->vehiculo_id = $vehiculo->id;
        }

        if ($this->persona_ingresa_id == null) {
            $persona = Persona::create([
                'nombre_completo' => $this->pi_nombre_completo,
                'nro_cedula'      => $this->pi_nro_cedula,
                'creado_por'      => Auth::id()
            ]);
            $this->persona_ingresa_id = $persona->id;
        }

        IngresoVehiculo::create([
            'fecha_hora_ingreso'       => Carbon::now(),
            'vehiculo_id'              => $this->vehiculo_id,
            'persona_ingresa_id'       => $this->persona_ingresa_id,
            'persona_visita_id'        => $this->persona_visita_id,
            'acceso_ingreso_id'        => $this->acceso_ingreso_id,
            'usuario_registro_ingreso' => Auth::id(),
            'creado_por'               => Auth::id()
        ]);

        session()->flash('success', 'Ingreso Registrado.');
        $this->redirectRoute('cda.panel-central.index');
    }

    public function render()
    {
        return view('livewire.cda.ingreso-vehiculo.ingreso');
    }
}
