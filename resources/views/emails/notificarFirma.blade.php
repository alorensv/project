<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing:border-box;font-family: 'Urbanist', sans-serif;background-color:#ffff;margin:0;padding:0;width:100%">
<tbody><tr>
<td align="center" style="box-sizing:border-box;font-family: 'Urbanist', sans-serif">
<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing:border-box;font-family: 'Urbanist', sans-serif;margin:0;padding:0;width:100%">
<tbody><tr>
<td style="box-sizing:border-box;font-family: 'Urbanist', sans-serif;padding:25px 0;text-align:center">
<a href="https://swap-lex.cl" style="box-sizing:border-box;font-family: 'Urbanist', sans-serif;color:#fff;font-size:19px;font-weight:bold;text-decoration:none;display:inline-block" target="_blank">
<img src="https://swap-lex.cl/wp-content/uploads/2022/04/Logo-v2.jpg" style="width: 200px;margin-top: 30px;margin-bottom: 20px;" alt="">
</a>
</td>
</tr>


<tr>
<td width="100%" cellpadding="0" cellspacing="0" style="box-sizing:border-box;font-family: 'Urbanist', sans-serif;background-color:#ffff;border-bottom:1px solid #ffff;border-top:1px solid #ffff;margin:0;padding:0;width:100%">
<table class="m_-6278040809201852508inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing:border-box;font-family: 'Urbanist', sans-serif;background-color:#ffffff;border-color:#e8e5ef;border-radius:2px;border-width:1px;margin:0 auto;padding:0;width:570px">

<tbody><tr>
<td style="box-sizing:border-box;font-family: 'Urbanist', sans-serif;max-width:100vw;padding:32px">
<h1 style="box-sizing: border-box; font-family: 'Urbanist', sans-serif; color: #3d4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left">
    Notificación de firma avanzada.
</h1>
<div>
    <p>¡Hola {{ $firmaDocumento->nombres }} {{ $firmaDocumento->apellido_paterno }}, somos Chao Notaria!</p>
    @if(isset($firmaDocumento->redaccion->user->name) && !empty($firmaDocumento->redaccion->user->name))  
        <p>{{ $firmaDocumento->redaccion->user->name }} te ha invitado a firmar un documento con firma electrónica avanzada.</p>
    @else
        <p>Te han invitado a firmar un documento con firma electrónica avanzada.</p>
    @endif
    <p>El documento a firmar es <strong>"{{ $firmaDocumento->redaccion->documento->nombre }}"</strong></p>
    <p>Si la invitación no corresponde, por favor indica mediante el siguiente enlace: <a href="">aviso de invitación no deseada</a>.</p>
    <p>Para realizar tu firma, accede mediante el siguiente enlace:</p>

    <table style="width: 100%; margin-top: 20px;">
        <tr style="background-color: #f6f6f6; color: #000;">
            <td style="padding: 8px; background-color: #060737; color: white; font-size: 16px; font-weight: 900; text-align: center;">
                <a href="http://127.0.0.1:8000/firmarDocumento/{{ $firmaDocumento->token }}" style="color: white; text-decoration: none;">Firmar documento</a>
            </td>
        </tr>
        <tr style="color: #000; text-align: center;">
            <td style="padding: 8px; font-size: 16px; font-weight: 900;">
                Código del documento: {{ $firmaDocumento->redaccion->id }}
            </td>
        </tr>
    </table>

    <p><a href=""></a></p>
    <h4>Te sugerimos iniciar sesión para realizar el seguimiento del documento firmado y tener siempre disponible la información.</h4>


<table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">

    

</table>



</div></div></td>
</tr>
</tbody></table>
</td>
</tr>

<tr>
<td style="box-sizing:border-box;font-family: 'Urbanist', sans-serif">
<table class="m_-6278040809201852508footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing:border-box;font-family: 'Urbanist', sans-serif;margin:0 auto;padding:0;text-align:center;width:570px">
<tbody><tr>
<td align="center" style="box-sizing:border-box;font-family: 'Urbanist', sans-serif;max-width:100vw;padding:32px">
<p style="box-sizing:border-box;font-family: 'Urbanist', sans-serif;line-height:1.5em;margin-top:0;color:#b0adc5;font-size:12px;text-align:center">© 2024 Chao Notaria. Todos los derechos reservados.</p>

</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody></table>