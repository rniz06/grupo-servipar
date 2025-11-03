<div>
    <form wire:submit="grabar">
        <x-adminlte-card theme="light" title="Datos del Solicitante" icon="fas fa-info" header-class="text-muted text-sm">

            <div class="col-md-12 row">
                {{-- Fecha Pedido --}}
                <x-adminlte-input type="date" name="fecha_pedido" wire:model.blur="fecha_pedido"
                    label-class="text-lightblue" fgroup-class="col-md-4" igroup-size="sm" value="{{ $fecha_pedido }}"
                    disabled>
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Fecha Pedido *</div>
                    </x-slot>
                </x-adminlte-input>

                {{-- Estado --}}
                <x-adminlte-input name="estado" wire:model.blur="estado" label-class="text-lightblue"
                    fgroup-class="col-md-4" igroup-size="sm" value="{{ $estado }}" disabled>
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Estado *</div>
                    </x-slot>
                </x-adminlte-input>

                {{-- Pedido Por --}}
                <x-adminlte-input name="pedido_por" wire:model.blur="pedido_por" label-class="text-lightblue"
                    fgroup-class="col-md-4" igroup-size="sm" value="{{ $pedido_por }}" disabled>
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Pedido Por *</div>
                    </x-slot>
                </x-adminlte-input>
            </div>

        </x-adminlte-card>
        
    </form>
</div>
