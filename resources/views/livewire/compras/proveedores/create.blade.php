<div>
    <form wire:submit="grabar">
        <x-adminlte-card theme="light" title="Añadir Proveedor" icon="fas fa-plus-circle"
            header-class="text-muted text-sm">
            <div class="row col-md-12">
                {{-- Razón Social --}}
                <x-adminlte-input name="razon_social" wire:model.blur="razon_social"
                    oninput="this.value = this.value.toUpperCase()" placeholder="EJ: GRUPO SERVIPAR S.A"
                    label-class="text-lightblue" fgroup-class="col-md-4" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Razón Social *</div>
                    </x-slot>
                </x-adminlte-input>

                {{-- Ruc --}}
                <x-adminlte-input name="ruc" wire:model.blur="ruc" placeholder="EJ: 80045670-0"
                    label-class="text-lightblue" fgroup-class="col-md-4" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Ruc *</div>
                    </x-slot>
                </x-adminlte-input>

                {{-- Correo --}}
                <x-adminlte-input type="email" name="correo" wire:model.blur="correo"
                    oninput="this.value = this.value.toLowerCase()" placeholder="EJ: info@servipar.com"
                    label-class="text-lightblue" fgroup-class="col-md-4" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Correo *</div>
                    </x-slot>
                </x-adminlte-input>

                {{-- Dirección --}}
                <x-adminlte-input name="direccion" wire:model.blur="direccion"
                    oninput="this.value = this.value.toUpperCase()" placeholder="EJ: DIRECCION, TAL PARTE"
                    label-class="text-lightblue" fgroup-class="col-md-4" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Dirección</div>
                    </x-slot>
                </x-adminlte-input>

                {{-- Teléfono --}}
                <x-adminlte-input name="telefono" wire:model.blur="telefono" placeholder="EJ: 021 502 292"
                    label-class="text-lightblue" fgroup-class="col-md-4" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Teléfono *</div>
                    </x-slot>
                </x-adminlte-input>

                {{-- Ciudades --}}
                <x-adminlte-select name="ciudad_id" wire:model.blur="ciudad_id" label-class="text-lightblue"
                    fgroup-class="col-md-4" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Ciudades *</div>
                    </x-slot>
                    <option value="">-- Seleccionar --</option>
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}">{{ $ciudad->ciudad ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>
            </div>



            <x-slot name="footerSlot">
                {{-- Botón de Volver --}}
                <a href="{{ route('compras.proveedores.index') }}"
                    class="btn btn-sm btn-outline-secondary text-decoration-none"><i
                        class="fas fa-arrow-left mr-1"></i>Volver</a>
                {{-- Botón de Guardar --}}
                <x-adminlte-button type="submit" label="Guardar" theme="outline-success" icon="fas fa-lg fa-save"
                    class="btn-sm float-right" />
                {{-- <x-adminlte-button class="d-flex ml-auto" theme="light" label="submit" icon="fas fa-sign-in" /> --}}
            </x-slot>

        </x-adminlte-card>
    </form>
</div>
