<?php

namespace Database\Seeders;

use App\Models\Productos\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['categoria' => 'ELEMENTOS DE COMPUTADORA',  'nivel' => 1],
            ['categoria' => 'INSUMOS DE BOTIQUIN',       'nivel' => 1],
            ['categoria' => 'ELEMENTOS DE OFICINA',      'nivel' => 1],
            ['categoria' => 'ELEMENTOS DE TELEFONO',     'nivel' => 1],
            ['categoria' => 'SUMINISTROS DE PUESTOS',    'nivel' => 2],
            ['categoria' => 'CALCOMANÍAS',               'nivel' => 2],
            ['categoria' => 'MANTENIMIENTO DE OFICINA',  'nivel' => 2],
            ['categoria' => 'VESTUARIO',                 'nivel' => 2],
            ['categoria' => 'MANTENIMIENTO/INSTALACIÓN DE MÓVILES', 'nivel' => 3],
            ['categoria' => 'ELEMENTOS DE PUESTO',       'nivel' => 3],
            ['categoria' => 'COMPRA DE MOVILES',         'nivel' => 3],
            ['categoria' => 'ARTILLERIA',                'nivel' => 3],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create([
                'categoria' => $categoria['categoria'],
                'nivel'     => $categoria['nivel'],
                'creadoPor' => 1, // USUARIO: ADMINISTRADOR
            ]);
        }
    }
}
