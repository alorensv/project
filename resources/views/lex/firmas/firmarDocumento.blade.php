@extends('lex.plantilla')

@section('content')
<div id="vueFirmar">

    <div v-bind:class="{ 'loader': loading }" v-cloak></div>
    <section class="white-division pt-5 pb-2">
        <div class="container">
            <div class="row celContainer bg-white">
                <div class="col-12 pt-2">
                    <div class="row">
                        <div class="col-md-5 p-5">
                            <div>
                                <h3><span class="material-icons pb-3" style="width: 24px;">approval_delegation</span> Firmar documento</h3>
                                <p>Hola {{ $firmaDocumento->nombres}} {{ $firmaDocumento->apellido_paterno}}, te han invitado a firmar el siguiente documento " {{ $redaccion->documento->nombre }} ".</p>
                                <p>Lee cuidadosamente el documento y confirma para habilitar la firma.</p>
                            </div>
                            <div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="p-3" style="display: flex; align-items: center;">
                                            <input type="checkbox" v-model="confirmChecked" class="form-check-input" style="margin-right: 10px;" />
                                            <p style="margin: 0;">Confirmo que he leído y revisado el texto del documento antes de firmar.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-if="confirmChecked" class="pt-3">
                                @if (empty($firmanteEnProceso))
                                <button class="btn btn-success" @click="firmarDocumento({{ $redaccion->id }}, '{{ $firmaDocumento->token }}')">Firmar</button>
                                @else
                                <div class="p-4 bg-warning">
                                    <i class="material-icons">warning</i>
                                    <span>Firma en curso: En estos momentos el documento está en proceso de firma por {{ $firmanteEnProceso->nombres }} {{ $firmanteEnProceso->apellido_paterno }} <br> Vuelve a intentarlo en unos minutos.</span>
                                </div>

                                @endif
                            </div>


                            <div class="pt-3">
                                <h5>
                                    <span style="text-decoration: underline;cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#requisitosAcordeon" aria-expanded="false" aria-controls="requisitosAcordeon">
                                        <i class="material-icons">keyboard_arrow_down</i>Requisitos para firmar
                                    </span>
                                </h5>

                                <div id="requisitosAcordeon" class="collapse">
                                    <ul>
                                        <li>
                                            Para firmar se requiere tener una Cédula de Identidad chilena vigente, y estar en posesión de su Clave Única, entregada por el Registro Civil. No permiten firmar electrónicamente las prórrogas administrativas de la vigencia, otorgadas por la autoridad.
                                        </li>
                                        <li>
                                            Poseer suficiente información en bases de datos del Registro Civil, y en instituciones financieras, para que la empresa certificadora digital pueda generar las preguntas secretas de seguridad.
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-7">

                        <div class="row">
                                <div class="col-md-5">
                                <h4>Previsualización del documento </h4>
                                </div>

                                <div class="col-md-3">
                                    @if (!empty($redaccion->user_id))
                                <span class="success pr-3">Autor: {{ $redaccion->user->name }} </span>
                                @endif
                                </div>

                                <div class="col-md-4">
                                <p style="text-align: right;">Fecha de creación: {{ $redaccion->formatted_date_creacion }} </p>
                                </div>
                            </div>

                            <div style="width: 100%; height: 75vh; border: 1px solid #ccc;">
                                <object
                                    data="data:application/pdf;base64,{{ $base64PDF }}#toolbar=0"
                                    type="application/pdf"
                                    width="100%"
                                    height="100%"
                                    style="border: none;">
                                    <p>
                                        Tu navegador no puede mostrar el documento.
                                        <a href="data:application/pdf;base64,{{ $base64PDF }}" download="documento.pdf">Descarga el PDF aquí</a>.
                                    </p>
                                </object>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    let vueFirmar = new Vue({
        el: '#vueFirmar',
        data: {
            loading: false,
            confirmChecked: false, // Variable para el estado del checkbox
        },
        methods: {
            firmarDocumento(idRedaccion, token) {
                this.loading = true;
                axios.post('/autorizaFirma', {
                        idRedaccion: idRedaccion,
                        token: token
                    })
                    .then(response => {

                        if (response.data.urlRedirect) {
                            //console.log(JSON.stringify(response.data));
                            //alert(JSON.stringify(response.data))
                            window.location.href = response.data.urlRedirect;
                        } else {
                            // Si no hay URL, mostrar el error o un mensaje
                            alert('No se pudo obtener la URL de redirección.');
                        }

                    })
                    .catch(error => {
                        // Manejar el error
                        console.error('Hubo un error al enviar el formulario', error);
                    });
            },
        }
    });
</script>
@endsection