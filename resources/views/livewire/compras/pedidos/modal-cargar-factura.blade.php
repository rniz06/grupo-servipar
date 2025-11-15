<div>
    <x-adminlte-modal id="modal-cargar-factura-{{ $pedido->id }}" title="Cargar Factura" static-backdrop
        icon="fas fa-tasks" theme="default" size="lg" wire:ignore.self scrollable>

        <div class="col-md-12 row">
            {{-- Presupuestos --}}
            <x-adminlte-select name="presupuesto_id" wire:model.blur="presupuesto_id" label-class="text-lightblue"
                fgroup-class="col-md-12" igroup-size="sm">
                <option value="" readonly>-- Seleccionar --</option>
                @forelse ($presupuestos as $presupuesto)
                    <option value="{{ $presupuesto->id ?? 'S/D' }}">{{ $presupuesto->proveedor->razon_social ?? 'S/D' }}
                    </option>
                @empty
                    <option disabled>SIN PRESUPUESTOS APROBADOS</option>
                @endforelse
                <x-slot name="prependSlot">
                    <div class="input-group-text">Presupuestos Aprobados *</div>
                </x-slot>
            </x-adminlte-select>
        </div>
        <hr>
        <div class="col-md-12 row">
            {{-- Fecha Factura --}}
            <x-adminlte-input type="date" name="fecha" wire:model.blur="fecha" label-class="text-lightblue"
                fgroup-class="col-md-4" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Fecha Factura *</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Nro. Factura --}}
            <x-adminlte-input name="nro_factura" wire:model.blur="nro_factura" label-class="text-lightblue"
                fgroup-class="col-md-4" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Nro. Factura *</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Monto Total --}}
            <x-adminlte-input type="number" name="total_pagado" wire:model.blur="total_pagado"
                label-class="text-lightblue" fgroup-class="col-md-4" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Monto Total *</div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <x-slot name="footerSlot">
            <x-adminlte-button theme="outline-secondary" icon="fas fa-arrow-left" class="btn-sm mr-auto" label="Cerrar"
                data-dismiss="modal" />
            <x-adminlte-button wire:click="grabar" icon="fas fa-save" theme="outline-success" label="Guardar"
                class="btn-sm" />
        </x-slot>
    </x-adminlte-modal>
</div>
