<?php

namespace App\Models\Productos;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Tipo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'productos.PRO_TIPOS';

    protected $fillable = ['tipo', 'creado_por', 'actualizado_por'];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function productos()
    {
        return $this->hasMany(Producto::class, 'tipo_id');
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
        return $this->belongsTo(User::class, 'creado_por');
    }

    public function actualizadoPor()
    {
        return $this->belongsTo(User::class, 'actualizado_por');
    }
}
