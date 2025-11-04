<?php

namespace App\Enums\Compras;

enum PresupuestoEstado: string
{
    case ENREVISION = 'EN REVISION';
    case APROBADO  = 'APROBADO';
    case RECHAZADO  = 'RECHAZADO';
}
