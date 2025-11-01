<?php

namespace App\Models;

use App\Models\Compras\Compra;
use App\Models\Compras\Pedido;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Sucursal extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'SUCURSALES';

    protected $fillable = ['sucursal', 'razon_social', 'ruc', 'correo', 'direccion', 'telefono', 'empresa_id'];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function depositos()
    {
        return $this->hasMany(Deposito::class, 'empresa_id');
    }

    public function departamentos()
    {
        return $this->hasMany(Departamento::class, 'sucursal_id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'empresa_id');
    }

    public function compras()
    {
        return $this->hasMany(Compra::class, 'sucursal_id');
    }

    /*
    |---------------------------------------
    | FIN RELACIONES DEL MODELO
    |---------------------------------------
    */
}
