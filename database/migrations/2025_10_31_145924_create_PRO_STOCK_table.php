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
        Schema::create('productos.PRO_STOCK', function (Blueprint $table) {
            $table->integer('cantidad')->default(0);
            $table->integer('minimo')->nullable();
            $table->integer('maximo')->nullable();
            $table->foreignId('producto_id')->constrained('productos.PRO_PRODUCTOS')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('productos.PRO_STOCK');
    }
};
