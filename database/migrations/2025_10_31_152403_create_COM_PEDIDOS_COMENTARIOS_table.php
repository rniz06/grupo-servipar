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
        Schema::create('compras.COM_PEDIDOS_COMENTARIOS', function (Blueprint $table) {
            $table->id();
            $table->string('comentario', 30);
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
        Schema::dropIfExists('compras.COM_PEDIDOS_COMENTARIOS');
    }
};
