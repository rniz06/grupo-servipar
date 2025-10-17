<!-- {{-- Encabezado con logos --}} -->
<table class="tabla-encabezado">
    <tr>
        <td style="width: 25%;">
            <img src="{{ $logo_izq }}" class="encabezado-logo">
        </td>
        <td style="width: 50%;">
            <strong style="font-size: 18px; font-weight: bold;">Rubilock - Grupo Servipar</strong><br>
            info@rubilock.com.py | rubilock.com.py<br>
            <span style="font-weight: bold;">Contacto:</span> 0982 23 23 23<br>
            Teniente Aguirre 1237 esq. Coronel Rivarola y Facundo Machain, Asunción, Paraguay<br>

            @hassection('departamento')
                @yield('departamento')<br>
            @endif
            <small>Generado el: {{ date('d / m / Y H:i') ?? 'S/D' }} Hs </small>
        </td>
        <td style="width: 25%;">
            <img src="{{ $logo_der }}" class="encabezado-logo">
        </td>
    </tr>
</table>
