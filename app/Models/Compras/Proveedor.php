<?php

namespace App\Models\Compras;

use App\Models\Ciudad;
use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Proveedor extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'compras.COM_PROVEEDORES';

    protected $fillable = ['razon_social', 'ruc', 'correo', 'direccion', 'telefono', 'ciudad_id', 'creado_por', 'actualizado_por'];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }

    /*
    |---------------------------------------
    | FIN RELACIONES DEL MODELO
    |---------------------------------------
    */

    /*
    |---------------------------------------
    | LOCAL SCOPE / FILTROS DE CONSULTAS
    |---------------------------------------
    */

    /**
     * Busqueda por campo razon_social.
     */
    #[Scope]
    protected function buscarRazonsocial(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereLike('razon_social', "%{$search}%");
        });
    }

    /**
     * Busqueda por campo ruc.
     */
    #[Scope]
    protected function buscarRuc(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereLike('ruc', "%{$search}%");
        });
    }

    /**
     * Busqueda por campo correo.
     */
    #[Scope]
    protected function buscarCorreo(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereLike('correo', "%{$search}%");
        });
    }

    /**
     * Busqueda por campo direccion.
     */
    #[Scope]
    protected function buscarDireccion(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereLike('direccion', "%{$search}%");
        });
    }

    /**
     * Busqueda por campo telefono.
     */
    #[Scope]
    protected function buscarTelefono(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereLike('telefono', "%{$search}%");
        });
    }

    /**
     * Busqueda por campo ciudad_id.
     */
    #[Scope]
    protected function buscarCiudadId(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->where('ciudad_id', $search);
        });
    }

    /*
    |---------------------------------------
    | FIN LOCAL SCOPE / FILTROS DE CONSULTAS
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
