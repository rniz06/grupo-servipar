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
        Schema::create('compras.COM_PROVEEDORES', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social', 75);
            $table->string('ruc', 20);
            $table->string('correo', 50);
            $table->string('direccion', 100);
            $table->string('telefono', 20);
            $table->foreignId('ciudad_id')->constrained('public.CIUDADES')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('compras.COM_PROVEEDORES');
    }
};
