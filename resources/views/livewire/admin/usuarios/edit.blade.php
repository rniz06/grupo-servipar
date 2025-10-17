<div>
    {{-- Formulario --}}
    <x-adminlte-card theme="light" title="Añadir Usuario" icon="fas fa-plus-circle" header-class="text-muted text-sm">
        <form class="row col-md-12 p-2" wire:submit="guardar">

            {{-- Nombre --}}
            <x-adminlte-input name="name" wire:model.blur="name" oninput="this.value = this.value.toUpperCase()"
                placeholder="EJ: JUAN PEREZ" label-class="text-lightblue" fgroup-class="col-md-4" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Nombre *</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Usuario --}}
            <x-adminlte-input name="usuario" wire:model.blur="usuario" oninput="this.value = this.value.toLowerCase()"
                placeholder="EJ: juan.perez" label-class="text-lightblue" fgroup-class="col-md-4" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Usuario *</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Email --}}
            <x-adminlte-input type="email" name="email" wire:model.blur="email"
                oninput="this.value = this.value.toLowerCase()" placeholder="EJ: ejemplo@ejemplo.com.py"
                label-class="text-lightblue" fgroup-class="col-md-4" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Email *</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Nro Cedula --}}
            <x-adminlte-input type="number" name="nro_cedula" wire:model.blur="nro_cedula" placeholder="EJ: 7654321"
                label-class="text-lightblue" fgroup-class="col-md-4" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Nro. Cédula</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Nro Celular --}}
            <x-adminlte-input name="nro_celular" wire:model.blur="nro_celular" placeholder="EJ: 0986123123"
                label-class="text-lightblue" fgroup-class="col-md-4" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Nro. Celular</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Observacion --}}
            <x-adminlte-textarea name="observacion" wire:model.blur="observacion"
                oninput="this.value = this.value.toUpperCase()" placeholder="EJ: USUARIO CREADO PARA..."
                label-class="text-lightblue" fgroup-class="col-md-12" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Observación *</div>
                </x-slot>
            </x-adminlte-textarea>

            {{-- Botón de Volver --}}
            <div class="form-group col-md-3 d-flex align-items-end">
                <a href="{{ route('admin.usuarios.index') }}"
                    class="btn btn-block btn-outline-secondary text-decoration-none btn-sm"><i
                        class="fas fa-arrow-left mr-1"></i>Volver</a>
            </div>
            {{-- Botón de Guardar --}}
            <div class="form-group col-md-3 d-flex align-items-end">
                <x-adminlte-button type="submit" label="Guardar" theme="outline-success" icon="fas fa-lg fa-save"
                    class="w-100 btn-sm" />
            </div>
        </form>
    </x-adminlte-card>
</div>
