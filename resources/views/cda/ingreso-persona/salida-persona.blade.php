@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Persona')
@section('content_header_title', 'Persona')
@section('content_header_subtitle', 'Salida')

{{-- Content body: main page content --}}

@section('content_body')
    HOLA DESDE PERSONA SALIDA
@stop

@push('css')
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush
