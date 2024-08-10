@extends('seguros.web.plantilla')

@section('content')
<style>
    .bg-image-vertical {
        position: relative;
        overflow: hidden;
        background-repeat: no-repeat;
        background-position: right center;
        background-size: auto 100%;
    }

    .navbar-expand-md {
        display: none !important;
    }

    .py-4 {
        padding-top: 0rem !important;
        padding-bottom: 0rem !important;
    }

    .centerAll {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    body {
        padding-top: 0rem;
        color: #5a5a5a;
        font-family: "Urbanist", sans-serif;
        font-optical-sizing: auto;
        font-style: normal;
    }
</style>
<div id="appseguros">
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5 text-black mt-3">

                    <div class="faq-container">
                        <div class="faq-icon">
                            <span
                                class="material-icons"
                                style="cursor: pointer; font-size: 24px;"
                                @click="goBack()">
                                arrow_back
                            </span>

                        </div>
                    </div>


                    <div class="px-5 ms-xl-4 mt-5 centerAll" style="padding-top: 10%;">
                        <div class="row">
                            <div class="col-12">
                                <section>

                                </section>
                            </div>
                        </div>
                    </div>

                    <div class="px-5 ms-xl-4 mt-2 centerAll">
                        <div class="row">
                            <div class="col-12">
                                <section>
                                    <h5 class="pb-3">Seguro de vehículo y flota</h5>
                                    <p>
                                        El seguro vehicular protege los daños que puedan ser ocasionados a tu vehículo en caso de volcamiento o colisión accidental, y en caso de que el vehículo sufra daños siendo trasladado (grúa) por un servicio de transporte permitido por la autoridad competente.
                                    </p>
                                    <h5>Tipos de Seguros de vehículos:</h5>
                                    <ul>
                                        <li>✓ Full Cobertura</li>
                                        <li>✓ Pérdida total + Responsabilidad Civil</li>
                                        <li>✓ Solo Responsabilidad Civil</li>
                                        <li>✓ Colectivos (vehículos comerciales)</li>
                                    </ul>


                                    <div class="d-flex justify-content-center pt-3">
                                        <div class="text-center mx-3">
                                            <div class="perfil-container" @click="cotizar('vehiculo')" style="cursor: pointer;">
                                                <div class="perfil-icon" style="background-color: #495ab4;">
                                                    <i class="fas fa-comments"></i> <!-- Ícono de conversación -->
                                                </div>
                                                <div class="perfil-text">¡Hablemos!</div>
                                            </div>
                                        </div>

                                        <div class="text-center mx-3">
                                            <div class="perfil-container" style="cursor: pointer;">
                                                <div class="perfil-icon" style="background-color: darkcyan;">
                                                    <i class="fas fa-envelope"></i> <!-- Ícono de correo -->
                                                </div>
                                                <div class="perfil-text">¡Escríbeme!</div>
                                            </div>
                                        </div>

                                        <div class="text-center mx-3">
                                            <div class="perfil-container" style="cursor: pointer;">
                                                <div class="perfil-icon" style="background-color: darkorchid;">
                                                    <i class="fas fa-user-plus"></i> <!-- Ícono de seguir -->
                                                </div>
                                                <div class="perfil-text">¡Sígueme!</div>
                                            </div>
                                        </div>
                                    </div>

                                </section>

                            </div>
                        </div>
                    </div>




                    <div class="contenedorPadre">
                        <!-- Otros elementos aquí -->
                        <div class="redes-container">
                            <img src="/img/seguros/instagram.png" class="p-1" alt="" style="width: 40px;">
                            <img src="/img/seguros/facebook.png" class="p-1" alt="" style="width: 40px;">
                        </div>
                    </div>



                </div>
                <div class="col-sm-7 px-0 pl-5 d-none d-sm-block bg-seguros-web">

                    <div class="contenedorSeguros">

                        <div class="modal-body p-5" style="color: white;font-weight: 600;">
                            <form @submit.prevent="guardarContacto">
                                @csrf
                                <!-- Formulario de contacto -->
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" v-model="contacto.nombre" placeholder="Acá tu nombre" required maxlength="255" id="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" class="form-control" v-model="contacto.telefono" placeholder="Recuerda ingresar el +569 " required maxlength="255" id="telefono">
                                </div>
                                <div class="form-group">
                                    <label for="correo">Correo</label>
                                    <input type="email" class="form-control" v-model="contacto.correo" placeholder="Acá tu correo" required maxlength="255" id="correo" required>
                                </div>
                                <div class="form-group">
                                    <label for="comentarios">Mensaje:</label>
                                    <textarea class="form-control" v-model="contacto.comentarios" placeholder="Haznos saber tus dudas o consultas" required maxlength="255" rows="4" id="comentarios" required></textarea>
                                </div>
                                <button type="submit" class="w-100 btn btn-primary">Enviar</button>
                            </form>
                        </div>

                    </div>

                </div>


            </div>
        </div>
    </section>

    @include('seguros.web.modals.corredora_seguros')
    @include('seguros.web.modals.cotizar')
</div>


<script>
    let appseguros = new Vue({
        el: '#appseguros',
        data: {
            contacto: {},
        },
        watch: {},
        created() {},
        computed: {},
        methods: {
            toggleLoading(show) {
                const loading = document.getElementById('loading');
                if (show) {
                    loading.style.visibility = 'visible';
                } else {
                    loading.style.visibility = 'hidden';
                }
            },
            verMas() {
                $("#verMas").modal('show');
            },
            cotizar(type) {
                $("#cotizaModal").modal('show');
            },
            guardarCotizacion() {

            },
            goBack(){
                window.location.href = '/seguros';
            }
            
        },

    });
</script>

@endsection