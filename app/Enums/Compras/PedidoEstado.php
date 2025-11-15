<?php

namespace App\Enums\Compras;

enum PedidoEstado: string
{
    case PENDIENTE          = 'PENDIENTE';
    case APROBADOSUPERVISOR = 'APROBADO SUPERVISOR';
    case ENPROCESO          = 'EN PROCESO';
    case FINALIZADO         = 'FINALIZADO';
    case RECHAZADO          = 'RECHAZADO';
}
