<?php

namespace App\Enums\Compras;

enum CompraEstado: string
{
    case FINALIZADO = 'FINALIZADO';
    case ANULADO  = 'ANULADO';
}
