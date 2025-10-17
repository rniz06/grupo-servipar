<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>{{ config('adminlte.title') }} @hasSection('titulo')
           - @yield('titulo')
        @endif
    </title>
    {{-- CSS base (siempre presente) --}}
    <link rel="stylesheet" href="{{ public_path('css/pdf/partials/encabezado.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/pdf/plantilla.css') }}">
    {{-- CSS opcionales --}}
    @stack('styles')
</head>

<body>
    {{-- Encabezado común --}}
    @include('layouts.pdf.partials.encabezado', [
        'logo_izq' => $logo_izq ?? config('logos.principal'),
        'logo_der' => $logo_der ?? config('logos.principal'),
    ])

    <main class="contenedor">
        @yield('contenido')
    </main>

    @include('layouts.pdf.partials.firma')
</body>

</html>
