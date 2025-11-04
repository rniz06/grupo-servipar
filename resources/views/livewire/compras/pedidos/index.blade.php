<div>
    <x-tabla titulo="Listado de Pedidos" excel pdf>

        <x-slot name="headerBotones">
            <a href="{{ route('compras.pedidos.create') }}" class="btn btn-sm btn-success"><i
                    class="fas fa-plus"></i>Añadir Pedido</a>
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
                <td>{{ $pedido->pedidoPor->name ?? 'S/D' }}</td>
                <td>
                    <x-tabla-dropdown>
                        <a href="{{ route('compras.pedidos.show', $pedido->id) }}" class="dropdown-item btn-sm"><i
                                class="far fa-eye mr-1"></i>Ver Detalles</a>

                        {{-- Boton Modal Agregar Presupuesto --}}
                        <x-adminlte-button label="Agregar Presupuesto" class="dropdown-item btn-sm" icon="fas fa-plus"
                            data-toggle="modal" data-target="#modal-presupuesto-{{ $pedido->id }}" />

                        {{-- Boton Modal Rechazar --}}
                        <x-adminlte-button label="Rechazar" class="dropdown-item btn-sm" icon="fas fa-store-slash"
                            data-toggle="modal" data-target="#modal-rechazar-{{ $pedido->id }}" />

                    </x-tabla-dropdown>

                    {{-- Modal Agregar Presupuesto --}}
                    @livewire('compras.pedidos.presupuesto', ['pedido_id' => $pedido->id], key($pedido->id))

                    {{-- Modal Rechazar --}}
                    @livewire('compras.pedidos.rechazar', ['pedido_id' => $pedido->id], key($pedido->id))
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
