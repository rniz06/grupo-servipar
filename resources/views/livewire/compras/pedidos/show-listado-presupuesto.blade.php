<div>
    <x-tabla titulo="Listado de Presupuestos">

        <x-slot name="headerBotones">
            {{-- Boton Modal Agregar Presupuesto --}}
            <x-adminlte-button label="Agregar Presupuesto" theme="outline-success" icon="fas fa-plus" class="btn-sm"
                data-toggle="modal" data-target="#modal-presupuesto-{{ $pedido_id }}" />
            {{-- Modal Agregar Presupuesto --}}
            @livewire('compras.pedidos.presupuesto', ['pedido_id' => $pedido_id], key($pedido_id))
        </x-slot>
        <x-slot name="cabeceras">
            <th>Fecha Presupuesto</th>
            <th>Estado</th>
            <th>Proveedor</th>
            <th>Cargado Por</th>
            <th>Acciones</th>
        </x-slot>

        @forelse ($presupuestos as $presupuesto)
            <tr wire:key="{{ $presupuesto->id }}">
                <td>{{ optional($presupuesto->fecha)->format('d/m/Y') ?? 'S/D' }}</td>
                <td>{{ $presupuesto->estado ?? 'S/D' }}</td>
                <td>{{ $presupuesto->proveedor->razon_social ?? 'S/D' }} - {{ $presupuesto->proveedor->ruc ?? 'S/D' }}
                </td>
                <td>{{ $presupuesto->creadoPor->name ?? 'S/D' }}</td>
                <td>
                    <x-tabla-dropdown>
                        {{-- Ver Detalles --}}
                        <x-adminlte-button label="Ver Detalles" class="dropdown-item btn-sm" icon="fas fa-eye mr-1"
                            data-toggle="modal" data-target="#modal-ver-presupuesto-{{ $presupuesto->id }}" />

                        @can('Pedidos Aprobar Presupuesto')
                            {{-- VALIDAR QUE EL PRESUPUESTO NO ESTE APROBADO NI RECHAZADO SINO EN REVISION --}}
                            @if ($presupuesto->estado == \App\Enums\Compras\PresupuestoEstado::ENREVISION)
                                {{-- Boton Aprobar Presupuesto --}}
                                <x-adminlte-button label="Aprobar Presupuesto" icon="far fa-check-circle"
                                    class="dropdown-item btn-sm" wire:click="aprobarPresupuesto({{ $presupuesto->id }})"
                                    wire:confirm="Estas seguro que deseas aprobar este presupuesto? Esto marcará el resto como RECHAZADO" />
                            @endif
                        @endcan
                    </x-tabla-dropdown>
                    {{-- Modal Presupuesto Ver --}}
                    @livewire('compras.pedidos.presupuesto-ver', ['presupuesto_id' => $presupuesto->id], key($presupuesto->id))
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100%" class="text-center text-muted">Sin resultados coincidentes...</td>
            </tr>
        @endforelse

        <x-slot name="paginacion">
            {{ $presupuestos->links() }}
        </x-slot>
    </x-tabla>
</div>
