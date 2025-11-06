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
                            <th>Precio Unitario</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_general = 0;
                        @endphp

                        @foreach ($detalles as $detalle)
                            @php
                                $total_item = $detalle->precio * $detalle->cantidad;
                                $total_general += $total_item;
                            @endphp
                            <tr>
                                <td>{{ $detalle->producto->nombre ?? 'S/D' }}</td>
                                <td>{{ $detalle->cantidad ?? 'S/D' }}</td>
                                <td>{{ number_format($detalle->precio, 0, ',', '.') ?? 'S/D' }}</td>
                                <td>{{ number_format($total_item, 0, ',', '.') ?? 'S/D' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold">
                            <td colspan="3" class="text-end">TOTAL GENERAL:</td>
                            <td>{{ number_format($total_general, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <x-slot name="footerSlot">
            <x-adminlte-button theme="outline-secondary" icon="fas fa-arrow-left" class="btn-sm mr-auto" label="Cerrar"
                data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>
</div>
