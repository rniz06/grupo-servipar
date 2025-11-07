<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Acceso extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'ACCESOS';

    protected $fillable = ['acceso', 'empresa_id', 'sucursal_id', 'creado_por', 'actualizado_por'];
}
