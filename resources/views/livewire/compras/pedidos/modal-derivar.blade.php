<div>
    {{-- Example button to open modal --}}
    <x-adminlte-modal id="modal-derivar" title="Derivar Pedido" static-backdrop icon="fas fa-tasks" theme="default"
        size="lg" wire:ignore.self scrollable>

        <div class="col-md-12 row">
            {{-- Presupuestos --}}
            <x-adminlte-select name="departamento_id" wire:model.blur="departamento_id" label-class="text-lightblue"
                fgroup-class="col-md-12" igroup-size="sm">
                <option value="">-- Seleccionar --</option>
                @foreach ($departamentos as $departamento)
                    <option value="{{ $departamento->id ?? 'S/D' }}">{{ $departamento->departamento ?? 'S/D' }}
                    </option>
                @endforeach
                <x-slot name="prependSlot">
                    <div class="input-group-text">Departamento *</div>
                </x-slot>
            </x-adminlte-select>
        </div>

        <x-slot name="footerSlot">
            <x-adminlte-button theme="outline-secondary" icon="fas fa-arrow-left" class="btn-sm mr-auto" label="Cerrar"
                data-dismiss="modal" />
            <x-adminlte-button wire:click="grabar" icon="fas fa-save" theme="outline-success" label="Guardar"
                class="btn-sm" />
        </x-slot>
    </x-adminlte-modal>
</div>
