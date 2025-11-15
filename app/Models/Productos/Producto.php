<?php

namespace App\Models\Productos;

use App\Models\Compras\PedidoDetalle;
use App\Models\Compras\PresupuestoDetalle;
use App\Models\Impuesto;
use App\Models\User;
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
        'creado_por',
        'actualizado_por'
    ];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'tipo_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'unidad_id');
    }

    public function impuesto()
    {
        return $this->belongsTo(Impuesto::class, 'impuesto_id');
    }

    public function pedidoDetalle()
    {
        return $this->hasMany(PedidoDetalle::class, 'producto_id');
    }

    public function presupuestoDetalle()
    {
        return $this->hasMany(PresupuestoDetalle::class, 'producto_id');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class, 'producto_id');
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
