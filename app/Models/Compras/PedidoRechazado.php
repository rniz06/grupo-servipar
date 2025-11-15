<?php

namespace App\Models\Compras;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PedidoRechazado extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'compras.COM_PEDIDOS_RECHAZADOS';

    protected $fillable = ['motivo', 'pedido_id', 'creado_por', 'actualizado_por'];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
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
