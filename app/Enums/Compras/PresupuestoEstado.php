<?php

namespace App\Enums\Compras;

enum PresupuestoEstado: string
{
    case PENDIENTE = 'PENDIENTE';
    case ENPROCESO  = 'EN PROCESO';
    case APROBADO  = 'APROBADO';
    case RECHAZADO  = 'RECHAZADO';
}
