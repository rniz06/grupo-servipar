@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Pedidos')
@section('content_header_title', 'Pedidos')
@section('content_header_subtitle', 'Listar')

{{-- Content body: main page content --}}

@section('content_body')
    @livewire('compras.pedidos.index')
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