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
                                    <div class="pt-0 text-center">
                                        <img src="/img/seguros/perfil.png" class="img-fluid rounded-circle mb-4" alt="Descripción de la imagen" style="max-width: 180px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);">
                                        <h4 class="mt-3">Natalia Caballero</h4>
                                        <h5>Corredora de seguros, CMF</h5>
                                        <h5>Administradora pública, Universidad de Concepción</h5>


                                    </div>

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

                            <p>👋 ¡Hola! Soy Natalia Caballero Pérez, corredora de propiedades miembro de la Comisión para el Mercado Financiero (CMF) con más de 7 años de experiencia en el rubro.</p>
                            <p>
                                Me especializo en ofrecer un servicio integral y gratuito de asesoramiento, con un enfoque particular en seguros generales y de vehículos.
                            </p>
                            <p>
                                Mi objetivo es ayudarte a tomar las mejores decisiones para tu inversión, con la tranquilidad de estar en manos expertas.
                            </p>


                            <form @submit.prevent="guardarContacto">
                                @csrf
                                <!-- Formulario de contacto -->
                                <div class="form-group">
                                    <label for="comentarios">Hablemos por whatsapp ...</label>
                                    <textarea class="form-control" v-model="contacto.comentarios" placeholder="Hablemos en whatsapp ...." required maxlength="255" rows="4" id="comentarios" required></textarea>
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
            goBack() {
                window.location.href = '/seguros';
            }

        },

    });
</script>

@endsection