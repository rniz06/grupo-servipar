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
        Marca::create([
            'marca' => 'SIN ESPECIFICAR',
            'creado_por' => 1, // USUARIO: ADMINISTRADOR
        ]);

        $tipos = ['ESTANDAR', 'SERVICIO', 'FISICO', 'DIGITAL'];

        foreach ($tipos as $tipo) {
            Tipo::create([
                'tipo' => $tipo,
                'creado_por' => 1, // USUARIO: ADMINISTRADOR
            ]);
        }

        $unidades = ['SIN ESPECIFICAR', 'UNIDAD', 'KILOGRAMO', 'LITROS', 'METROS'];

        foreach ($unidades as $unidad) {
            Unidad::create([
                'unidad' => $unidad,
                'creado_por' => 1, // USUARIO: ADMINISTRADOR
            ]);
        }

        $productos = [
            //CATEGORIA: ELEMENTOS DE COMPUTADORA
            ['nombre' => 'CARGADOR',  'categoria' => 1],
            ['nombre' => 'MOUSE',     'categoria' => 1],
            ['nombre' => 'MOUSEPAD',  'categoria' => 1],

            //CATEGORIA: INSUMOS DE BOTIQUIN
            ['nombre' => 'GAZA',    'categoria' => 2],
            ['nombre' => 'MEDICAMENTOS',               'categoria' => 2],
            ['nombre' => 'ALCOHOL RATIFICADO',  'categoria' => 2],

            //CATEGORIA: ELEMENTOS DE OFICINA
            ['nombre' => 'HOJAS',                'categoria' => 3],
            ['nombre' => 'CARPETAS',             'categoria' => 3],
            ['nombre' => 'CUADERNOS',            'categoria' => 3],
            ['nombre' => 'TINTA PARA IMPRESORA', 'categoria' => 3],

            //CATEGORIA: ELEMENTOS DE TELEFONO
            ['nombre' => 'CARGADOR',        'categoria' => 4],
            ['nombre' => 'PROTECTOR',       'categoria' => 4],
            ['nombre' => 'CHIP O SIMCARD',  'categoria' => 4],

            //CATEGORIA: SUMINISTROS DE PUESTOS
            ['nombre' => 'VIVERES',  'categoria' => 5],
            ['nombre' => 'PALETS',     'categoria' => 5],
            ['nombre' => 'GALPÓN REJILLA',  'categoria' => 5],

            //CATEGORIA: CALCOMANÍAS
            ['nombre' => 'PARA CASETAS',   'categoria' => 6],
            ['nombre' => 'PARA CASCOS',    'categoria' => 6],
            ['nombre' => 'PARA CHALECOS',  'categoria' => 6],

            //CATEGORIA: MANTENIMIENTO DE OFICINA
            ['nombre' => 'MANTENIMIENTO DE LUZ',      'categoria' => 7],
            ['nombre' => 'INCONVENIENTE EN EL BAÑO',  'categoria' => 7],
            ['nombre' => 'MANTENIMIENTO IMPRESORA',   'categoria' => 7],
            ['nombre' => 'ARREGLO DE ENCHUFE',        'categoria' => 7],

            //CATEGORIA: VESTUARIO
            ['nombre' => 'CHALECOS', 'categoria' => 8],
            ['nombre' => 'FUNDAS',   'categoria' => 8],
            ['nombre' => 'BOTAS',    'categoria' => 8],
            ['nombre' => 'CAMISAS',  'categoria' => 8],

            //CATEGORIA: MANTENIMIENTO/INSTALACIÓN DE MÓVILES
            ['nombre' => 'INSTALACIÓN DE BALIZAS',      'categoria' => 9],
            ['nombre' => 'CAMBIO DE PASTILLA DE FRENO', 'categoria' => 9],
            ['nombre' => 'MANTENIMIENTO DE LUZ',        'categoria' => 9],
            ['nombre' => 'CAMBIO DE RUEDAS',            'categoria' => 9],

            //CATEGORIA: ELEMENTOS DE PUESTO
            ['nombre' => 'CAJAS DE SEGURIDAD',  'categoria' => 10],
            ['nombre' => 'RADIOS',              'categoria' => 10],

            //CATEGORIA: COMPRA DE MOVILES
            ['nombre' => 'CAMIONETAS',      'categoria' => 11],
            ['nombre' => 'MINIBUSES',       'categoria' => 11],
            ['nombre' => 'MOTOCICLETAS',    'categoria' => 11],
            ['nombre' => 'AUTOMÓVILES',     'categoria' => 11],

            //CATEGORIA: ARTILLERIA
            ['nombre' => 'REVOLVER',        'categoria' => 9],
            ['nombre' => 'ESCOPETA',        'categoria' => 9],
            ['nombre' => 'BASTÓN O TONFA',  'categoria' => 9],
        ];

        foreach ($productos as $producto) {
            Producto::create([
                'nombre' => $producto['nombre'],
                'codigo_barra' => null,
                'precio' => null,
                'descripcion' => null,
                'fecha_vencimiento' => null,
                'activo' => true,
                'tipo_id' => 1,
                'categoria_id' => $producto['categoria'],
                'marca_id' => 1,
                'unidad_id' => 1,
                'impuesto_id' => 1,
                'creado_por' => 1, // USUARIO: ADMINISTRADOR
            ]);
        }
    }
}
