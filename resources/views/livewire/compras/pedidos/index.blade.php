<div>
    <x-tabla titulo="Roles" excel pdf>

        <x-slot name="headerBotones">
            <a href="#" class="btn btn-sm btn-success"><i class="fas fa-plus"></i>Añadir Pedido</a>
        </x-slot>
        <x-slot name="cabeceras">
            {{-- Fecha Pedido --}}
            <th>
                <x-adminlte-input type="date" name="" wire:model.live.debounce.200ms="buscarFechaPedido"
                    label="Fecha Pedido" igroup-size="sm" />
            </th>

            {{-- Fecha Entrega --}}
            <th>
                <x-adminlte-input type="date" name="" wire:model.live.debounce.200ms="buscarFechaEntrega"
                    label="Fecha Entrega" igroup-size="sm" />
            </th>

            {{-- Estado --}}
            <th>
                <x-adminlte-select name="" wire:model.live.debounce.200ms="buscarEstado" label="Estado"
                    igroup-size="sm">
                    <option value="">-- Todos --</option>
                    @foreach ($estados as $estado)
                        <option value="{{ $estado }}">{{ $estado }}</option>
                    @endforeach
                </x-adminlte-select>
            </th>

            {{-- Departamento --}}
            <th>
                <x-adminlte-select name="" wire:model.live.debounce.200ms="buscarDepartamentoId"
                    label="Departamento" igroup-size="sm">
                    <option value="">-- Todos --</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->id }}">{{ $departamento->departamento ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>
            </th>

            {{-- Sucursal --}}
            <th>
                <x-adminlte-select name="" wire:model.live.debounce.200ms="buscarSucursalId" label="Sucursal"
                    igroup-size="sm">
                    <option value="">-- Todos --</option>
                    @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id }}">{{ $sucursal->sucursal ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>
            </th>

            {{-- Pedido Por --}}
            <th>
                <x-adminlte-input name="" label="Pedido Por" igroup-size="sm" disabled />
            </th>

            {{-- Acciones --}}
            <th>
                <x-adminlte-input name="" label="Acciones" igroup-size="sm" disabled />
            </th>
        </x-slot>

        @forelse ($pedidos as $pedido)
            <tr wire:key="{{ $pedido->id }}">
                <td>{{ optional($pedido->fecha_pedido)->format('d/m/Y') ?? 'S/D' }}</td>
                <td>{{ optional($pedido->fecha_entrega)->format('d/m/Y') ?? 'S/D' }}</td>
                <td>{{ $pedido->estado ?? 'S/D' }}</td>
                <td>{{ $pedido->departamento->departamento ?? 'S/D' }}</td>
                <td>{{ $pedido->sucursal->sucursal ?? 'S/D' }}</td>
                <td>{{ $pedido->creadoPor->name ?? 'S/D' }}</td>
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
            {{ $pedidos->links() }}
        </x-slot>
    </x-tabla>
</div>
