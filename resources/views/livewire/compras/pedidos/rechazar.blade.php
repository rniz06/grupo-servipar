<div>
    {{-- Example button to open modal --}}
    <x-adminlte-modal id="modal-rechazar-{{ $pedido->id }}" title="Rechazar Compra" static-backdrop icon="fas fa-tasks"
        theme="default" size="lg" wire:ignore.self scrollable>

        <div class="col-md-12 row">
            {{-- Motivo --}}
            <x-adminlte-textarea name="motivo" wire:model.blur="motivo" oninput="this.value = this.value.toUpperCase()"
                placeholder="EJ: NO SE ENCONTRO PROVEEDOR..." label-class="text-lightblue" fgroup-class="col-md-12"
                igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Motivo Del Rechazo *</div>
                </x-slot>
            </x-adminlte-textarea>
        </div>

        <div class="col-md-12 row">
            {{-- Fecha Pedido --}}
            <x-adminlte-input name label-class="text-lightblue" value="{{ $pedido->fecha_pedido->format('d/m/Y') ?? 'S/D' }}"
                fgroup-class="col-md-4" igroup-size="sm" disabled>
                <x-slot name="prependSlot">
                    <div class="input-group-text">Fecha Pedido:</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Pedido Por --}}
            <x-adminlte-input name label-class="text-lightblue" value="{{ $pedido->pedidoPor->name ?? 'S/D' }}"
                fgroup-class="col-md-4" igroup-size="sm" disabled>
                <x-slot name="prependSlot">
                    <div class="input-group-text">Pedido Por</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Departamento --}}
            <x-adminlte-input name label-class="text-lightblue" value="{{ $pedido->departamento->departamento ?? 'S/D' }}"
                fgroup-class="col-md-4" igroup-size="sm" disabled>
                <x-slot name="prependSlot">
                    <div class="input-group-text">Departamento</div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="col-md-12 row" wire:ignore>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th scope="col">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->producto->nombre ?? 'S/D' }}</td>
                            <td>{{ $detalle->cantidad ?? 'S/D' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <x-slot name="footerSlot">
            <x-adminlte-button theme="outline-secondary" icon="fas fa-arrow-left" class="btn-sm mr-auto" label="Cerrar"
                data-dismiss="modal" />
            <x-adminlte-button wire:click="grabar" icon="fas fa-save" theme="outline-success" label="Guardar"
                class="btn-sm" />
        </x-slot>
    </x-adminlte-modal>
</div>
