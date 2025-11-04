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
                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                    alt="user image">
                                <span class="username">
                                    <a href="#">Jonathan Burke Jr.</a>
                                </span>
                                <span class="description">Shared publicly - 7:45 PM today</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore.
                            </p>

                            <p>
                                <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo
                                    File 1 v2</a>
                            </p>
                        </div>

                        <div class="post clearfix">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg"
                                    alt="User Image">
                                <span class="username">
                                    <a href="#">Sarah Ross</a>
                                </span>
                                <span class="description">Sent you a message - 3 days ago</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore.
                            </p>
                            <p>
                                <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo
                                    File 2</a>
                            </p>
                        </div>

                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                    alt="user image">
                                <span class="username">
                                    <a href="#">Jonathan Burke Jr.</a>
                                </span>
                                <span class="description">Shared publicly - 5 days ago</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore.
                            </p>
                        </div>
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
                <ul class="list-unstyled">
                    <li>
                        <span class="font-weight-bold">Fecha Pedido:</span>
                        {{ optional($pedido->fecha_pedido)->format('d/m/Y') ?? 'S/D' }}
                    </li>
                    <li>
                        <span class="font-weight-bold">Estado:</span> {{ $pedido->estado ?? 'S/D' }}
                    </li>
                    <li>
                        <span class="font-weight-bold">Pedido Por:</span> {{ $pedido->pedidoPor->name ?? 'S/D' }}
                    </li>

                    <li>
                        <span class="font-weight-bold">Departamento:</span>
                        {{ $pedido->departamento->departamento ?? 'S/D' }}
                    </li>

                    <li>
                        <span class="font-weight-bold">Sucursal:</span> {{ $pedido->sucursal->sucursal ?? 'S/D' }}
                    </li>
                </ul>

                <hr>
                <h4>Items Solicitados</h4>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->producto->nombre ?? 'S/D' }}</td>
                                <td>{{ $item->cantidad ?? 'S/D' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center text-muted">Sin resultados coincidentes...</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- <div class="text-center mt-5 mb-3">
                    <a href="#" class="btn btn-sm btn-primary">Add files</a>
                    <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                </div> --}}
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
