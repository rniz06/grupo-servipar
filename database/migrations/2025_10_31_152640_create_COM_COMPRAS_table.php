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
        Schema::create('compras.COM_COMPRAS', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('nro_factura');
            $table->integer('total_pagado');
            $table->enum('estado', ['FINALIZADO', 'ANULADO']);
            $table->foreignId('pedido_id')->nullable()->constrained('compras.COM_PEDIDOS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('presupuesto_id')->nullable()->constrained('compras.COM_PRESUPUESTOS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('empresa_id')->nullable()->constrained('EMPRESAS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('sucursal_id')->nullable()->constrained('SUCURSALES')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('deposito_id')->nullable()->constrained('DEPOSITOS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('creadoPor')->nullable()->constrained('public.users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('actualizadoPor')->nullable()->constrained('public.users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras.COM_COMPRAS');
    }
};
