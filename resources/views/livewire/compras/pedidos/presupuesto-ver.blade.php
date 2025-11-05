<div>
    {{-- Example button to open modal --}}
    <x-adminlte-modal id="modal-ver-presupuesto-{{ $presupuesto_id }}" title="Presupuesto Detalles" static-backdrop
        icon="fas fa-tasks" theme="default" size="lg" wire:ignore.self scrollable>

        <div class="col-md-12 row">
            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Item</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->producto->nombre ?? 'S/D' }}</td>
                                <td>{{ $detalle->cantidad ?? 'S/D' }}</td>
                                <td>{{ $detalle->precio ?? 'S/D' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <x-slot name="footerSlot">
            <x-adminlte-button theme="outline-secondary" icon="fas fa-arrow-left" class="btn-sm mr-auto" label="Cerrar"
                data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>
</div>
