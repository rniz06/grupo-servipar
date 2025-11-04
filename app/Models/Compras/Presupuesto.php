<?php

namespace App\Models\Compras;

use App\Enums\Compras\PresupuestoEstado;
use App\Models\Empresa;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Presupuesto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'compras.COM_PRESUPUESTOS';

    protected $fillable = ['fecha', 'fecha_entrega', 'estado', 'pedido_id', 'proveedor_id', 'empresa_id', 'sucursal_id', 'creado_por', 'actualizado_por'];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    public function compras()
    {
        return $this->hasMany(Compra::class, 'presupuesto_id');
    }

    public function presupuestosDetalles()
    {
        return $this->hasMany(PresupuestoDetalle::class, 'presupuesto_id');
    }

    /*
    |---------------------------------------
    | FIN RELACIONES DEL MODELO
    |---------------------------------------
    */

    protected function casts(): array
    {
        return [
            'fecha'         => 'date',
            'fecha_entrega' => 'date',
            'estado'        => PresupuestoEstado::class
        ];
    }

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
