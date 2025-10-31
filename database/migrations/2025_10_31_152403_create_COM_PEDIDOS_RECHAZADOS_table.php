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
        Schema::create('compras.COM_PEDIDOS_RECHAZADOS', function (Blueprint $table) {
            $table->id();
            $table->string('motivo');
            $table->foreignId('pedido_id')->nullable()->constrained('compras.COM_PEDIDOS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('creadoPor')->constrained('public.users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('actualizadoPor')->constrained('public.users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras.COM_PEDIDOS_RECHAZADOS');
    }
};
