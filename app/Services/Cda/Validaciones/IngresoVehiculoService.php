<?php

namespace App\Services\Cda\Validaciones;

use App\Models\Cda\IngresoVehiculo;
use App\Models\Cda\Vehiculo;

class IngresoVehiculoService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Verifica si un vehículo con la chapa dada tiene un ingreso pendiente (sin salida).
     *
     * @param string $chapa
     * @return bool
     */
    public static function tieneIngresoPendiente(string $chapa): bool
    {
        $vehiculo = Vehiculo::where('chapa', $chapa)->first();

        # Si no existe ningún vehículo con esa chapa, no puede haber un
        # ingreso pendiente asociado. Por eso devuelve false.
        if (!$vehiculo) {
            return false;
        }

        # Devuelve true si hay al menos un registro que cumple las condiciones, y false si no
        return IngresoVehiculo::where('vehiculo_id', $vehiculo->id)
            ->whereNull('fecha_hora_salida')
            ->exists();
    }
}
