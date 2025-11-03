<div>
    <x-tabla titulo="Listado de Proveedores" excel pdf>

        <x-slot name="headerBotones">
            <a href="{{ route('compras.proveedores.create') }}" class="btn btn-sm btn-success"><i
                    class="fas fa-plus"></i>Añadir Proveedor</a>
        </x-slot>
        <x-slot name="cabeceras">
            {{-- Razón Social --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarRazonsocial" oninput="this.value = this.value.toUpperCase()"
                    label="Razón Social:" igroup-size="sm" />
            </th>

            {{-- Ruc --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarRuc"
                    label="Ruc:" igroup-size="sm" />
            </th>

            {{-- Correo --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarCorreo"
                    label="Correo:" igroup-size="sm" />
            </th>

            {{-- Dirección --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarDireccion"
                    label="Dirección:" igroup-size="sm" />
            </th>

            {{-- Teléfono --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarTelefono"
                    label="Teléfono:" igroup-size="sm" />
            </th>

            {{-- Ciudad --}}
            <th>
                <x-adminlte-select name="" wire:model.live.debounce.200ms="buscarCiudadId"
                    label="Ciudad:" igroup-size="sm">
                    <option value="">-- Todos --</option>
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}">{{ $ciudad->ciudad ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>
            </th>

            {{-- Acciones --}}
            <th>
                <x-adminlte-input name="" label="Acciones" igroup-size="sm" disabled />
            </th>
        </x-slot>

        @forelse ($proveedores as $proveedor)
            <tr wire:key="{{ $proveedor->id }}">
                <td>{{ $proveedor->razon_social ?? 'S/D' }}</td>
                <td>{{ $proveedor->ruc ?? 'S/D' }}</td>
                <td>{{ $proveedor->correo ?? 'S/D' }}</td>
                <td>{{ $proveedor->direccion ?? 'S/D' }}</td>
                <td>{{ $proveedor->telefono ?? 'S/D' }}</td>
                <td>{{ $proveedor->ciudad->ciudad ?? 'S/D' }}</td>
                <td>
                    {{-- <a href="{{ route('admin.roles.edit', $rol->id) }}" class="btn btn-sm btn-warning"><i
                            class="fas fa-edit mr-1"></i>Editar</a> --}}

                    <button class="btn btn-sm btn-warning">Editar</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100%" class="text-center text-muted">Sin resultados coincidentes...</td>
            </tr>
        @endforelse

        <x-slot name="paginacion">
            {{ $proveedores->links() }}
        </x-slot>
    </x-tabla>
</div>
