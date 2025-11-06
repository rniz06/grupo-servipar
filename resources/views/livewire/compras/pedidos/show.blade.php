<div>
    <x-adminlte-card title="Pedido Detalles">

        <x-slot name="toolsSlot">
            <div class="d-flex">

                @if ($pedido->departamentoSolicitante->responsable_id == $usuario->id and $pedido->estado == \App\Enums\Compras\PedidoEstado::PENDIENTE)
                    {{-- Boton Aprobar --}}
                    <x-adminlte-button label="Aprobar" theme="outline-secondary" class="btn-sm mr-1"
                        icon="fas fa-check-square" wire:click="aprobarPedidoSupervisor"
                        wire:confirm="¿ESTAS SEGURO QUE DESEAS APROBAR ESTE PEDIDO?" />
                @else
                    <x-adminlte-button label="Aprobar" theme="outline-secondary" class="btn-sm mr-1"
                        icon="fas fa-check-square" disabled />
                @endif

                @if ($anulado == null)
                    {{-- Boton Modal Rechazar --}}
                    <x-adminlte-button label="Rechazar" theme="outline-secondary" class="btn-sm mr-1"
                        icon="fas fa-store-slash" data-toggle="modal"
                        data-target="#modal-rechazar-{{ $pedido->id }}" />

                    {{-- Modal Rechazar --}}
                    @livewire('compras.pedidos.rechazar', ['pedido_id' => $pedido->id], key($pedido->id))
                @endif

                @if ($anulado == null)
                    {{-- Boton Modal Rechazar --}}
                    <x-adminlte-button label="Derivar" theme="outline-secondary" class="btn-sm mr-1"
                        icon="fas fa-arrows-alt-v" data-toggle="modal"
                        data-target="#modal-derivar" />

                    {{-- Modal Rechazar --}}
                    @livewire('compras.pedidos.modal-derivar', ['pedido_id' => $pedido->id], key($pedido->id))
                @endif

                @if ($pedido->estado == \App\Enums\Compras\PedidoEstado::ENPROCESO)
                    @can('Pedidos Cargar Factura')
                        {{-- Boton MODAL PARA CARGAR FACTURA --}}
                        <x-adminlte-button label="Cargar Factura" theme="outline-secondary" class="btn-sm mr-1"
                            icon="fas fa-file-upload" data-toggle="modal"
                            data-target="#modal-cargar-factura-{{ $pedido->id }}" />

                        {{-- COMPONENTE QUE RENDERIZA MODAL PARA CARGAR FACTURA --}}
                        @livewire('compras.pedidos.modal-cargar-factura', ['pedido_id' => $pedido->id])
                    @endcan
                @else
                    @can('Pedidos Cargar Factura')
                        {{-- MOSTRAR BOTON DESHABILITADO --}}
                        <x-adminlte-button label="Cargar Factura" theme="outline-secondary" class="btn-sm mr-1"
                            icon="fas fa-file-upload" disabled />
                    @endcan
                @endif
            </div>
        </x-slot>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                <div class="row">
                    <div class="col-12">
                        <h4>Historico del Pedido</h4>
                        @forelse ($comentarios as $comentario)
                            @if ($loop->first)
                                <ul>
                            @endif
                            <li>
                                <div class="card p-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="mb-0">
                                            <span
                                                class="font-weight-bold">{{ $comentario->creadoPor->name ?? 'S/D' }}</span>
                                            {{ $comentario->comentario ?? 'S/D' }}
                                        </p>
                                        <small class="text-muted ms-3">
                                            <i class="fas fa-clock"></i>
                                            {{ optional($comentario->created_at)->format('d/m/Y H:i:s') ?? 'S/D' }}
                                            Hs.
                                        </small>
                                    </div>
                                </div>
                            </li>
                            @if ($loop->last)
                                </ul>
                            @endif
                        @empty
                            <p class="font-italic font-weight-bold">SIN DATOS...</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                @if ($anulado != null)
                    <span class="font-weight-bold text-danger">Rechazado Por: </span>
                    {{ $anulado->creadoPor->name ?? 'S/D' }}
                    <p class="text-muted">Motivo: {{ $anulado->motivo ?? 'S/D' }}</p>
                @endif

                <h5 class="font-weight-bold">Detalles</h5>
                <hr>

                <dl class="row">
                    <dt class="col-md-4">Fecha Pedido:</dt>
                    <dd class="col-md-8">{{ optional($pedido->fecha_pedido)->format('d/m/Y') ?? 'S/D' }}</dd>

                    <dt class="col-md-4">Estado:</dt>
                    <dd class="col-md-8">{{ $pedido->estado ?? 'S/D' }}</dd>

                    <dt class="col-md-4">Pedido Por:</dt>
                    <dd class="col-md-8">{{ $pedido->pedidoPor->name ?? 'S/D' }}</dd>

                    <dt class="col-md-4">Departamento Actual:</dt>
                    <dd class="col-md-8">{{ $pedido->departamentoActual->departamento ?? 'S/D' }}</dd>

                    <dt class="col-md-4">Departamento Solicitante:</dt>
                    <dd class="col-md-8">{{ $pedido->departamentoSolicitante->departamento ?? 'S/D' }}</dd>

                    <dt class="col-md-4">Sucursal:</dt>
                    <dd class="col-md-8">{{ $pedido->sucursal->sucursal ?? 'S/D' }}</dd>
                </dl>

                <hr>
                <h4>Items Solicitados</h4>
                <dl class="row">
                    @forelse ($items as $item)
                        <dt class="col-md-4">{{ $item->producto->nombre ?? 'S/D' }}:</dt>
                        <dd class="col-md-8">{{ $item->cantidad ?? 'S/D' }}</dd>
                    @empty
                        <dt class="col-md-4">Sin registros...</dt>
                    @endforelse
                </dl>
            </div>
        </div>

    </x-adminlte-card>

    {{-- COMPONENTE QUE RENDERIZA LISTADO DE PRESUPUESTOS --}}
    @livewire('compras.pedidos.show-listado-presupuesto', ['pedido_id' => $pedido->id])

</div>
