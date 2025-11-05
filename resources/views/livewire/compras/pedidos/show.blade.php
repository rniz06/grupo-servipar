<div>

    <x-adminlte-card title="Pedido Detalles">

        <x-slot name="toolsSlot">

            @if ($anulado == null)
                {{-- Boton Modal Rechazar --}}
                <x-adminlte-button label="Rechazar" theme="outline-secondary" class="btn-sm" icon="fas fa-store-slash"
                    data-toggle="modal" data-target="#modal-rechazar-{{ $pedido->id }}" />

                {{-- Modal Rechazar --}}
                @livewire('compras.pedidos.rechazar', ['pedido_id' => $pedido->id], key($pedido->id))
            @endif
        </x-slot>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                {{-- <div class="row">
                    <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Estimated budget</span>
                                <span class="info-box-number text-center text-muted mb-0">2300</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Total amount spent</span>
                                <span class="info-box-number text-center text-muted mb-0">2000</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Estimated project duration</span>
                                <span class="info-box-number text-center text-muted mb-0">20</span>
                            </div>
                        </div>
                    </div>
                </div> --}}
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

    <x-tabla titulo="Listado de Presupuestos" paginado="presupuestosPaginado">

        <x-slot name="headerBotones">
            {{-- Boton Modal Agregar Presupuesto --}}
            <x-adminlte-button label="Agregar Presupuesto" theme="outline-success" icon="fas fa-plus" class="btn-sm"
                data-toggle="modal" data-target="#modal-presupuesto-{{ $pedido->id }}" />
            {{-- Modal Agregar Presupuesto --}}
            @livewire('compras.pedidos.presupuesto', ['pedido_id' => $pedido->id], key($pedido->id))
        </x-slot>
        <x-slot name="cabeceras">
            <th>Fecha Presupuesto</th>
            <th>Estado</th>
            <th>Proveedor</th>
            <th>Cargado Por</th>
        </x-slot>

        @forelse ($presupuestos as $presupuesto)
            <tr wire:key="{{ $presupuesto->id }}">
                <td>{{ optional($presupuesto->fecha)->format('d/m/Y') ?? 'S/D' }}</td>
                <td>{{ $presupuesto->estado ?? 'S/D' }}</td>
                <td>{{ $presupuesto->proveedor->razon_social ?? 'S/D' }} - {{ $presupuesto->proveedor->ruc ?? 'S/D' }}
                </td>
                <td>{{ $presupuesto->creadoPor->name ?? 'S/D' }}</td>
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
