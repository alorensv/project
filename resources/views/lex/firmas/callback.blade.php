@extends('lex.plantilla')

@section('content')
<div id="vueFirmar">

    @include('lex.modals.loginRegister')
    @include('lex.modals.register')
    @include('lex.modals.login')

    <div v-bind:class="{ 'loader': loading }" v-cloak></div>
    <section class="white-division pt-5 pb-2" style="height: 93vh;">
        <div class="container">
            <div class="row celContainer bg-white">
                <div class="col-12 pt-2">
                    <div class="row">
                        <div class="col-md-5 p-5">
                            <div>
                                <h3><span class="material-icons" style="width: 24px;">approval_delegation</span> Firma avanzada del documento</h3>
                                @if(is_null($redaccion->final_base64))
                                <p>Hola {{ $firmaDocumento->nombres }} {{ $firmaDocumento->apellido_paterno }}, aún hay firmantes pendientes sobre el documento <strong>"{{ $redaccion->documento->nombre }}"</strong>.</p>
                                <p>Te recomendamos registrarte en la plataforma para obtener más detalles.</p>
                                @else
                                <p>Hola {{ $firmaDocumento->nombres }} {{ $firmaDocumento->apellido_paterno }}, ya puedes descargar el documento <strong>"{{ $redaccion->documento->nombre }}"</strong>.</p>
                                <div class="pt-3">
                                    <h5>
                                        <button class="btn btn-success" type="button" @click="descargarDocumento({{ $redaccion->id }})">
                                            Descargar
                                        </button>
                                    </h5>

                                    

                                </div>
                                @endif
                                <div>
                                <div>
                                        <button class="w-100 btn btn-primary" type="button" @click="registrarse()">
                                            <i class="material-icons">person</i>Iniciar sesión / registro
                                        </button>
                                    </div>
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
                                    data="data:application/pdf;base64,{{ $base64PDF }}"
                                    type="application/pdf"
                                    width="100%"
                                    height="100%"
                                    style="border: none;">
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
            confirmChecked: false,
            correo: '',
            clave: '',
            nombre: '',
            dni: '',
        },
        methods: {
            firmardocumento(idRedaccion, idFirmante) {
                this.loading = true;
                axios.post('/autorizaFirma', {
                        idRedaccion: idRedaccion,
                        idFirmante: idFirmante
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
            descargarDocumento(idRedaccion) {
                this.loading = true;
                axios.get(`/documento/descargar/${idRedaccion}`, {
                    responseType: 'blob' // Importante para obtener el archivo en formato binario
                }).then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data], {
                        type: 'application/pdf'
                    }));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', `documento_${idRedaccion}.pdf`);
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    this.loading = false;
                }).catch(error => {
                    console.error('Error al descargar el documento:', error);
                    alert('No se pudo descargar el documento.');
                });
            },
            registrarse() {
                $('#loginRegister').modal('show');
            },
            continuarInvitado() {
                $('#loginRegister').modal('hide');
            },
            consultarCorreo() {
                axios.get('/existeUsuario', {
                    params: {
                    correo: this.correo
                    }
                })
                .then(response => {
                    if (response.data.message == 'ok') {
                    $('#loginRegister').modal('hide');
                    $('#login').modal('show');
                    } else {
                    $('#loginRegister').modal('hide');
                    $('#register').modal('show');
                    }
                })
                .catch(error => {
                    console.error('Error al obtener productos:', error);
                });
            },
            _submitRegister: function() {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                var claveEncriptada = this.clave;
                //this.clave = '';
                //this.nombre = 'Test';
                this.password_confirmation = this.clave;

                // Enviar los datos al servidor usando HTTPS
                axios.post('/register', {
                        _token: csrfToken,
                        name: this.nombre,
                        email: this.correo,
                        dni: this.dni,
                        password: claveEncriptada,
                        password_confirmation: this.password_confirmation,
                    })
                    .then(response => {
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error al enviar el formulario:', error);
                    });
            },
            submitRegister: function() {
                this._submitRegister();
            },
            _submitLogin: function() {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                var claveEncriptada = this.clave;
                var remember = 'false';

                axios.post('/login', {
                        _token: csrfToken,
                        email: this.correo,
                        password: claveEncriptada,
                        remember: remember,
                    })
                    .then(response => {
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error al enviar el formulario:', error);
                    });
            },
            submitLogin: function() {
                this._submitLogin();
            },
        }
    });
</script>
@endsection