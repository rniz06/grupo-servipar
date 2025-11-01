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
        Schema::create('productos.PRO_PRODUCTOS', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('codigo_barra')->nullable();
            $table->integer('precio')->nullable();
            $table->string('descripcion')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->boolean('activo')->default(true);
            $table->foreignId('tipo_id')->nullable()->constrained('productos.PRO_TIPOS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('categoria_id')->nullable()->constrained('productos.PRO_CATEGORIAS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('marca_id')->nullable()->constrained('productos.PRO_MARCAS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('unidad_id')->nullable()->constrained('productos.PRO_UNIDADES')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('impuesto_id')->nullable()->constrained('public.IMPUESTOS')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('productos.PRO_PRODUCTOS');
    }
};
