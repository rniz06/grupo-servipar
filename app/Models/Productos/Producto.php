<?php

namespace App\Models\Productos;

use App\Models\Compras\PedidoDetalle;
use App\Models\Compras\PresupuestoDetalle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Producto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'productos.PRO_PRODUCTOS';

    protected $fillable = [
        'nombre',
        'codigo_barra',
        'precio',
        'descripcion',
        'fecha_vencimiento',
        'activo',
        'tipo_id',
        'categoria_id',
        'marca_id',
        'unidad_id',
        'impuesto_id',
        'creadoPor',
        'actualizadoPor'
    ];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function pedidoDetalle()
    {
        return $this->hasMany(PedidoDetalle::class, 'producto_id');
    }

    public function presupuestoDetalle()
    {
        return $this->hasMany(PresupuestoDetalle::class, 'producto_id');
    }

    /*
    |---------------------------------------
    | FIN RELACIONES DEL MODELO
    |---------------------------------------
    */
}
