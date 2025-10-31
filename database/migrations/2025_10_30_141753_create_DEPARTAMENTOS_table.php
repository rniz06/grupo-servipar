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
        Schema::create('DEPARTAMENTOS', function (Blueprint $table) {
            $table->id();
            $table->string('departamento', 100)->comment('DEPARTAMENTOS DE LA EMPRESA');
            $table->foreignId('responsable_id')->comment('USUARIO RESPONSABLE DEL DPTO')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('empresa_id')->constrained('EMPRESAS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('sucursal_id')->constrained('SUCURSALES')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('DEPARTAMENTOS');
    }
};
