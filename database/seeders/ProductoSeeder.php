<?php

namespace Database\Seeders;

use App\Models\Productos\Categoria;
use App\Models\Productos\Marca;
use App\Models\Productos\Producto;
use App\Models\Productos\Tipo;
use App\Models\Productos\Unidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            'categoria' => 'SIN ESPECIFICAR',
            'creadoPor' => 1, // USUARIO: ADMINISTRADOR
        ]);

        Marca::create([
            'marca' => 'SIN ESPECIFICAR',
            'creadoPor' => 1, // USUARIO: ADMINISTRADOR
        ]);

        $tipos = ['ESTANDAR', 'SERVICIO', 'FISICO', 'DIGITAL'];

        foreach ($tipos as $tipo) {
            Tipo::create([
                'tipo' => $tipo,
                'creadoPor' => 1, // USUARIO: ADMINISTRADOR
            ]);
        }

        $unidades = ['SIN ESPECIFICAR', 'UNIDAD', 'KILOGRAMO', 'LITROS', 'METROS'];

        foreach ($unidades as $unidad) {
            Unidad::create([
                'unidad' => $unidad,
                'creadoPor' => 1, // USUARIO: ADMINISTRADOR
            ]);
        }

        Producto::create([
            'nombre' => 'PRODUCTO PRUEBA',
            'codigo_barra' => null,
            'precio' => null,
            'descripcion' => 'PRODUCTO DE PRUEBA',
            'fecha_vencimiento' => null,
            'activo' => true,
            'tipo_id' => 1,
            'categoria_id' => 1,
            'marca_id' => 1,
            'unidad_id' => 1,
            'impuesto_id' => 1,
            'creadoPor' => 1, // ADMINISTRADOR
        ]);
    }
}
