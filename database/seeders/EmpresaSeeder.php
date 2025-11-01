<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Empresa::create([
            'empresa' => 'GRUPO SERVIPAR',
            'razon_social' => 'GRUPO SEVIPAR S.A',
            'ruc' => '80045670-0',
            'correo' => 'info@servipar.com',
            'direccion' => 'Teniente Aguirre 1237 esq. Coronel Rivarola y Facundo Machain, Asunción, Paraguay',
            'telefono' => '021 502 292',
            'creadoPor' => 1 //ADMINISTRADOR
        ]);
    }
}
