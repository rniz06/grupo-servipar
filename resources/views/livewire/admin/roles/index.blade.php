<div>
    <x-tabla titulo="Roles" buscador excel pdf>

        <x-slot name="headerBotones">
            <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-success"><i
                    class="fas fa-user-plus"></i>Añadir Rol</a>
        </x-slot>
        <x-slot name="cabeceras">
            {{-- # --}}
            <th>#</th>

            {{-- Nombre --}}
            <th>Nombre</th>

            {{-- Creado El --}}
            <th>Creado El</th>

            {{-- Actualizado El --}}
            <th>Actualizado El</th>

            {{-- Acciones --}}
            <th>Acciones</th>
        </x-slot>

        @forelse ($roles as $rol)
            <tr>
                <td>#</td>
                <td>{{ $rol->name ?? 'S/D' }}</td>
                <td>{{ optional($rol->created_at)->format('d/m/Y H:i:s') ?? 'S/D' }}</td>
                <td>{{ optional($rol->updated_at)->format('d/m/Y H:i:s') ?? 'S/D' }}</td>
                <td>
                    <a href="{{ route('admin.roles.edit', $rol->id) }}" class="btn btn-sm btn-warning"><i
                            class="fas fa-edit mr-1"></i>Editar</a>
                </td>
            </tr>
        @empty
            <td colspan="100%" class="text-center text-muted">Sin resultados coincidentes...</td>
        @endforelse

        <x-slot name="paginacion">
            {{ $roles->links() }}
        </x-slot>
    </x-tabla>
</div>
