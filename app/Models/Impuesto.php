<?php

namespace App\Models;

use App\Models\Productos\Producto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Impuesto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'IMPUESTOS';

    protected $fillable = ['impuesto', 'porcentaje', 'siglas', 'creadoPor', 'actualizadoPor'];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function productos()
    {
        return $this->hasMany(Producto::class, 'impuesto_id');
    }

    /*
    |---------------------------------------
    | FIN RELACIONES DEL MODELO
    |---------------------------------------
    */

    /*
    |---------------------------------------
    | RELACIONES DE AUDITORIA DE LA TABLA
    |---------------------------------------
    */
    public function creadoPor()
    {
        return $this->belongsTo(User::class, 'creadoPor');
    }

    public function actualizadoPor()
    {
        return $this->belongsTo(User::class, 'actualizadoPor');
    }
}
