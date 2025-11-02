<?php

namespace App\Enums\Compras;

enum PedidoEstado: string
{
    case PENDIENTE = 'PENDIENTE';
    case ENPROCESO = 'EN PROCESO';
    case APROBADO  = 'APROBADO';
    case RECHAZADO  = 'RECHAZADO';
}
