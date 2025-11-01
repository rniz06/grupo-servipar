<?php

namespace App\Models\Productos;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Categoria extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'productos.PRO_CATEGORIAS';

    protected $fillable = ['categoria', 'nivel', 'descripcion', 'creadoPor', 'actualizadoPor'];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id');
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
