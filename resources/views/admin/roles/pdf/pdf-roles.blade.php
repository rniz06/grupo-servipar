<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>{{ $nombre_archivo ?? 'Documento' }}</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf/pdf-general.css') }}">
</head>

<body>
    <h2>{{ $nombre_archivo ?? 'Documento' }}</h2>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Creado El</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($datos as $rol)
                <tr>
                    <td>{{ $rol->name ?? 'S/D' }}</td>
                    <td>{{ !empty($rol->created_at) ? date('d/m/Y H:i:s', strtotime($rol->created_at)) : 'S/D' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100%" class="sin-resultados">Sin resultados coincidentes...</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
