<?php

namespace App\Models\Compras;

use App\Enums\Compras\PedidoEstado;
use App\Models\Departamento;
use App\Models\Empresa;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Contracts\Auditable;

class Pedido extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'compras.COM_PEDIDOS';

    protected $fillable = ['fecha_pedido', 'fecha_entrega', 'estado', 'pedido_por', 'departamento_actual_id', 'departamento_solicitante_id', 'empresa_id', 'sucursal_id', 'creado_por', 'actualizado_por'];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function pedidoPor()
    {
        return $this->belongsTo(User::class, 'pedido_por');
    }

    public function departamentoActual()
    {
        return $this->belongsTo(Departamento::class, 'departamento_actual_id');
    }

    public function departamentoSolicitante()
    {
        return $this->belongsTo(Departamento::class, 'departamento_solicitante_id');
    }

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
        return $this->hasMany(PedidoDetalle::class, 'pedido_id');
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

    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class, 'pedido_id');
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
    | LOCAL SCOPE / FILTROS DE CONSULTAS
    |---------------------------------------
    */

    /**
     * Busqueda por campo fecha_pedido.
     */
    #[Scope]
    protected function filtrarPorDepartamento(Builder $query): void
    {
        $usuario = Auth::user();
        $query->where('departamento_actual_id', $usuario->departamento_id);
    }

    /**
     * Busqueda por campo fecha_pedido.
     */
    #[Scope]
    protected function buscarFechaPedido(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereDate('fecha_pedido', $search);
        });
    }

    /**
     * Busqueda por campo fecha_entrega.
     */
    #[Scope]
    protected function buscarFechaEntrega(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereDate('fecha_entrega', $search);
        });
    }

    /**
     * Busqueda por campo estado.
     */
    #[Scope]
    protected function buscarEstado(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->where('estado', $search);
        });
    }

    /**
     * Busqueda por campo departamento_actual_id.
     */
    #[Scope]
    protected function buscarDepartamentoActualId(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->where('departamento_actual_id', $search);
        });
    }

    /**
     * Busqueda por campo departamento_solicitante_id.
     */
    #[Scope]
    protected function buscarDepartamentoSolicitanteId(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->where('departamento_solicitante_id', $search);
        });
    }

    /**
     * Busqueda por campo empresa_id.
     */
    #[Scope]
    protected function buscarEmpresaId(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->where('empresa_id', $search);
        });
    }

    /**
     * Busqueda por campo sucursal_id.
     */
    #[Scope]
    protected function buscarSucursalId(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->where('sucursal_id', $search);
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
