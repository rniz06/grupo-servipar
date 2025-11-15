<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compras.COM_PRESUPUESTOS', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->date('fecha_entrega')->nullable();
            $table->enum('estado', ['EN REVISION', 'APROBADO', 'RECHAZADO']);
            $table->foreignId('pedido_id')->nullable()->constrained('compras.COM_PEDIDOS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('proveedor_id')->nullable()->constrained('compras.COM_PROVEEDORES')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('empresa_id')->nullable()->constrained('EMPRESAS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('sucursal_id')->nullable()->constrained('SUCURSALES')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('creado_por')->nullable()->references('id')->on('public.users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('actualizado_por')->nullable()->references('id')->on('public.users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras.COM_PRESUPUESTOS');
    }
};
