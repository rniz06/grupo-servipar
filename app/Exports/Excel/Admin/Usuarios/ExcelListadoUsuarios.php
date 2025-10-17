<?php

namespace App\Exports\Excel\Admin\Usuarios;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelListadoUsuarios implements FromCollection, WithHeadings
{
    public $datos, $encabezados;

    public function __construct($datos = null, $encabezados = null)
    {
        $this->datos = $datos;
        $this->encabezados = $encabezados;
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
        return $this->encabezados;
    }

    public function map($usuario): array
    {
        $activo = $usuario->activo ? 'Activo' : 'Inactivo';

        return [
            $usuario->name ?? 'S/D',
            $usuario->usuario ?? 'S/D',
            $usuario->email ?? 'S/D',
            $usuario->nro_cedula ?? 'S/D',
            $usuario->nro_celular ?? 'S/D',
            $usuario->observacion ?? 'S/D',
            $activo,
            !empty($usuario->ultimo_acceso) ? date('d/m/Y H:i:s', strtotime($usuario->ultimo_acceso)) : 'S/D',
        ];
    }
}
