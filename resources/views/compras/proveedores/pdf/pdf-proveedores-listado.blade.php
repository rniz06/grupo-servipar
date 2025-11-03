@extends('layouts.pdf.plantilla')

@section('titulo', 'Proveedores')

{{-- @section('departamento', 'Central de Comunicaciones y Alarmas') --}}

{{-- Definimos los logos para este reporte --}}
{{-- @section('logo_izq', public_path('img/logos/logo-especial.png'))
    @section('logo_der', public_path('img/logos/logo-secundario.png')) --}}


@section('contenido')
    <div class="subtitulo">Reporte de Proveedores</div>

    <table class="tabla">
        <thead class="tabla-thead">
            <tr>
                <th>Razón Social</th>
                <th>Ruc</th>
                <th>Correo</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Ciudad</th>
            </tr>
        </thead>

        <tbody class="tabla-tbody">
            @forelse ($datos as $proveedor)
                <tr>
                    <td>{{ $proveedor->razon_social ?? 'S/D' }}</td>
                    <td>{{ $proveedor->ruc ?? 'S/D' }}</td>
                    <td>{{ $proveedor->correo ?? 'S/D' }}</td>
                    <td>{{ $proveedor->direccion ?? 'S/D' }}</td>
                    <td>{{ $proveedor->telefono ?? 'S/D' }}</td>
                    <td>{{ $proveedor->ciudad->ciudad ?? 'S/D' }}</td>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100%" style="font-style: italic; text-align: center">SIN REGISTROS</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

@push('styles')
@endpush
