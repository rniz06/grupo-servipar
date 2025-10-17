<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>{{ $nombre_archivo ?? 'Documento' }}</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf/pdf-general.css') }}">
    {{-- <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #999;
            padding: 4px 6px;
            text-align: left;
        }

        th {
            background-color: #e0e0e0;
        }

        .center {
            text-align: center;
        }
    </style> --}}
</head>

<body>
    <h2>{{ $nombre_archivo ?? 'Documento' }}</h2>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Email</th>
                <th>Nro. Cedula</th>
                <th>Nro. Celular</th>
                <th>Obs.</th>
                <th>Activo</th>
                <th>Ultimo Acceso</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datos as $usuario)
                <tr>
                    <td>{{ $usuario->name ?? 'S/D' }}</td>
                    <td>{{ $usuario->usuario ?? 'S/D' }}</td>
                    <td>{{ $usuario->email ?? 'S/D' }}</td>
                    <td>{{ $usuario->nro_cedula ?? 'S/D' }}</td>
                    <td>{{ $usuario->nro_celular ?? 'S/D' }}</td>
                    <td>{{ $usuario->observacion ?? 'S/D' }}</td>
                    <td>{{ $usuario->activo ? 'SI' : 'NO' }}</td>
                    <td>{{ !empty($usuario->ultimo_acceso) ? date('d/m/Y H:i:s', strtotime($usuario->ultimo_acceso)) : 'S/D' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
