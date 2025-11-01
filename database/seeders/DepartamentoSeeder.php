<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Departamento::create([
            'departamento' => 'COMPRAS',
            'empresa_id' => 1,
            'sucursal_id' => 1,
            'responsable_id' => 1,
            'creadoPor' => 1 //ADMINISTRADOR
        ]);

        Departamento::create([
            'departamento' => 'OPERACIONES',
            'empresa_id' => 1,
            'sucursal_id' => 1,
            'responsable_id' => 1,
            'creadoPor' => 1 //ADMINISTRADOR
        ]);
    }
}
