<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Empresa extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'EMPRESAS';

    protected $fillable = ['empresa', 'razon_social', 'ruc', 'correo', 'direccion', 'telefono'];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class, 'empresa_id');
    }

    public function depositos()
    {
        return $this->hasMany(Deposito::class, 'empresa_id');
    }

    public function departamentos()
    {
        return $this->hasMany(Departamento::class, 'empresa_id');
    }

    /*
    |---------------------------------------
    | FIN RELACIONES DEL MODELO
    |---------------------------------------
    */
}
