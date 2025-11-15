<div>
    {{-- Example button to open modal --}}
    <x-adminlte-modal id="modal-presupuesto-{{ $pedido->id }}" title="Agregar Presupuesto" static-backdrop
        icon="fas fa-tasks" theme="default" size="lg" wire:ignore.self scrollable>
        
        <div class="col-md-12 row">
            {{-- Proveedores --}}
            <x-adminlte-select name="proveedor_id" wire:model.blur="proveedor_id" label-class="text-lightblue"
                fgroup-class="col-md-12" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Proveedores *</div>
                </x-slot>
                <option value="">-- Seleccionar --</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social ?? 'S/D' }} -
                        {{ $proveedor->ruc ?? 'S/D' }}</option>
                @endforeach
            </x-adminlte-select>

            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
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
                                <td>
                                    {{-- Precio --}}
                                    <x-adminlte-input type="number" name="items.{{ $index }}.precio"
                                        wire:model.blur="items.{{ $index }}.precio" placeholder="EJ: 10000"
                                        igroup-size="sm">
                                    </x-adminlte-input>
                                </td>
                                <td>
                                    {{-- Eliminar Item --}}
                                    <x-adminlte-button wire:click="eliminarItem({{ $index }})" label="Eliminar"
                                        theme="outline-danger" icon="fas fa-lg fa-trash" class="btn-sm" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <x-slot name="footerSlot">
            <x-adminlte-button theme="outline-secondary" icon="fas fa-arrow-left" class="btn-sm mr-auto" label="Cerrar"
                data-dismiss="modal" />
            {{-- Botón para agregar más productos --}}
            <x-adminlte-button wire:click="agregarItem" label="Añadir Item" theme="outline-secondary" icon="fas fa-plus"
                class="btn-sm" />
            <x-adminlte-button wire:click="grabar" icon="fas fa-save" theme="outline-success" label="Guardar"
                class="btn-sm" />
        </x-slot>
    </x-adminlte-modal>
</div>
