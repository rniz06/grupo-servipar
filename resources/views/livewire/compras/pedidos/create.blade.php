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

        <x-adminlte-card theme="light" title="Items Solicitados" icon="fas fa-tasks" header-class="text-muted text-sm">

            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $index => $item)
                            <tr wire:key="item-{{ $index }}">
                                <td>
                                    {{-- Productos --}}
                                    <x-adminlte-select name="items.{{ $index }}.producto_id"
                                        wire:model.blur="items.{{ $index }}.producto_id" igroup-size="sm">
                                        <option value="">-- Seleccionar --</option>
                                        @foreach ($productos as $producto)
                                            <option value="{{ $producto->id }}">
                                                {{ $producto->nombre }} - Cat: {{ $producto->categoria->categoria }} -
                                                Nivel: {{ $producto->categoria->nivel }}
                                            </option>
                                        @endforeach
                                    </x-adminlte-select>
                                </td>
                                <td>
                                    {{-- Cantidad --}}
                                    <x-adminlte-input type="number" name="items.{{ $index }}.cantidad"
                                        wire:model.blur="items.{{ $index }}.cantidad" placeholder="EJ: 10"
                                        igroup-size="sm" min="1">
                                    </x-adminlte-input>
                                </td>
                                <td class="">
                                    {{-- Eliminar Item --}}
                                    <x-adminlte-button wire:click="eliminarItem({{ $index }})"
                                        wire:confirm="¿Estas Seguro que deseas eliminar este item?" label="Eliminar"
                                        theme="outline-danger" icon="fas fa-lg fa-trash" class="btn-sm" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <x-slot name="footerSlot">
                {{-- Botón para agregar más productos --}}
                <x-adminlte-button wire:click="agregarItem" label="Añadir Item" theme="outline-secondary"
                    icon="fas fa-plus" class="btn-sm" />
                {{-- Guardar --}}
                <x-adminlte-button type="submit" label="Guardar Pedido" theme="outline-success" icon="fas fa-save"
                    class="btn-sm float-right" />
            </x-slot>
        </x-adminlte-card>

    </form>
</div>
