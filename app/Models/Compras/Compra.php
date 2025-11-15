<?php

namespace App\Models\Compras;

use App\Enums\Compras\CompraEstado;
use App\Models\Deposito;
use App\Models\Empresa;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Compra extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'compras.COM_COMPRAS';

    protected $fillable = ['fecha', 'nro_factura', 'total_pagado', 'estado', 'pedido_id', 'presupuesto_id', 'empresa_id', 'sucursal_id', 'deposito_id', 'creado_por', 'actualizado_por'];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class, 'presupuesto_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    public function deposito()
    {
        return $this->belongsTo(Deposito::class, 'deposito_id');
    }

    /*
    |---------------------------------------
    | FIN RELACIONES DEL MODELO
    |---------------------------------------
    */

    protected function casts(): array
    {
        return [
            'fecha'  => 'date',
            'estado'        => CompraEstado::class
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
