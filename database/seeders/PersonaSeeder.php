<?php

namespace Database\Seeders;

use App\Models\Cda\Persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Persona::create([
            'nombre_completo'   => 'JUAN PEREZ',
            'nro_cedula'        => '1234567',
            'nro_celular'       => '0984123123',
            'esPersonalEmpresa' => false,
            'empresa_id'        => null,
            'sucursal_id'       => null,
            'creado_por'        => 1 // ADMINISTRADOR
        ]);

        Persona::create([
            'nombre_completo'   => 'RAMON DIAZ',
            'nro_cedula'        => '7654321',
            'nro_celular'       => '0984321321',
            'esPersonalEmpresa' => true,
            'empresa_id'        => 1,
            'sucursal_id'       => 1,
            'creado_por'        => 1 // ADMINISTRADOR
        ]);
    }
}
