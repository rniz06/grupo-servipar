@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Proveedores')
@section('content_header_title', 'Proveedores')
@section('content_header_subtitle', 'Editar')

{{-- Content body: main page content --}}

@section('content_body')
    @livewire('compras.proveedores.edit', ['proveedor_id' => $proveedor])
@stop

@push('css')
    {{-- Incluir estilos adicionales desde el componente --}}
    @stack('styles')
@endpush

{{-- Push extra scripts --}}

@push('js')
    {{-- Incluir scripts js adicionales desde el componente --}}
    @stack('scripts')
@endpush
