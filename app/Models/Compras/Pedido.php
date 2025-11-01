<?php

namespace App\Models\Compras;

use App\Enums\Compras\PedidoEstado;
use App\Models\Empresa;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Pedido extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'compras.COM_PEDIDOS';

    protected $fillable = ['fecha_pedido', 'fecha_entrega', 'estado', 'empresa_id', 'sucursal_id', 'creadoPor', 'actualizadoPor'];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    public function pedidoDetalle()
    {
        return $this->hasMany(PedidoDetalle::class, 'producto_id');
    }

    public function pedidoRechazado()
    {
        return $this->hasMany(PedidoRechazado::class, 'pedido_id');
    }

    public function presupuestoDetalle()
    {
        return $this->hasMany(PresupuestoDetalle::class, 'producto_id');
    }

    public function compras()
    {
        return $this->hasMany(Compra::class, 'pedido_id');
    }

    /*
    |---------------------------------------
    | FIN RELACIONES DEL MODELO
    |---------------------------------------
    */

    protected function casts(): array
    {
        return [
            'fecha_pedido'  => 'date',
            'fecha_entrega' => 'date',
            'estado'        => PedidoEstado::class
        ];
    }

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
