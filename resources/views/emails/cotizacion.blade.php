@component('mail::message')
# ¡Haz recibido una nueva cotización!

<table>
    <tr>
        <th style="text-align: left; padding: 8px; background-color: #060737; color: white;">Campo</th>
        <th style="text-align: left; padding: 8px; background-color: #060737; color: white;">Valor</th>
    </tr>
    <tr>
        <td style="padding: 8px;">Nombre</td>
        <td style="padding: 8px;">{{ $cotizacion->nombre }}</td>
    </tr>
    <tr>
        <td style="padding: 8px;">Correo</td>
        <td style="padding: 8px;">{{ $cotizacion->email }}</td>
    </tr>
    <tr>
        <td style="padding: 8px;">Teléfono</td>
        <td style="padding: 8px;">{{ $cotizacion->telefono }}</td>
    </tr>
    <tr>
        <td style="padding: 8px;">Fecha posible del servicio</td>
        <td style="padding: 8px;">{{ $cotizacion->fecha_servicio }}</td>
    </tr>
    <tr>
        <td style="padding: 8px;">Origen</td>
        <td style="padding: 8px;">{{ $cotizacion->origen }}</td>
    </tr>
    <tr>
        <td style="padding: 8px;">Destino</td>
        <td style="padding: 8px;">{{ $cotizacion->destino }}</td>
    </tr>
    <tr>
        <td style="padding: 8px;">Comentarios</td>
        <td style="padding: 8px;">{{ $cotizacion->comentarios }}</td>
    </tr>
</table>

@endcomponent
