<?php

namespace App\Enums\Compras;

enum PedidoEstado: string
{
    case ENREVISION = 'EN REVISION';
    case APROBADO  = 'APROBADO';
    case RECHAZADO  = 'RECHAZADO';
}
