<?php

namespace App\Exports\Excel\Compras\Proveedores;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelListadoProveedores implements FromCollection, WithHeadings
{
    public $datos, $encabezados;

    public function __construct($datos = null)
    {
        $this->datos = $datos;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->datos;
    }

    public function headings(): array
    {
        return ['Razón Social', 'Ruc', 'Correo', 'Dirección', 'Teléfono', 'Ciudad'];
    }

    public function map($proveedor): array
    {
        return [
            $proveedor->razon_social ?? 'S/D',
            $proveedor->ruc ?? 'S/D',
            $proveedor->correo ?? 'S/D',
            $proveedor->direccion ?? 'S/D',
            $proveedor->telefono ?? 'S/D',
            $proveedor->ciudad->ciudad ?? 'S/D',
        ];
    }
}
