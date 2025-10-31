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
        Schema::create('DEPOSITOS', function (Blueprint $table) {
            $table->id();
            $table->string('deposito');
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
        Schema::dropIfExists('DEPOSITOS');
    }
};
