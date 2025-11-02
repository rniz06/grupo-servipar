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
        Schema::create('compras.COM_PRESUPUESTOS_DETALLES', function (Blueprint $table) {
            $table->integer('cantidad');
            $table->bigInteger('precio');
            $table->foreignId('producto_id')->nullable()->constrained('productos.PRO_PRODUCTOS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('pedido_id')->nullable()->constrained('compras.COM_PEDIDOS')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('compras.COM_PRESUPUESTOS_DETALLES');
    }
};
