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
                        <span class="material-icons">help_outline</span>
                    </div>
                    <div class="faq-text">Preguntas frecuentes</div>
                </div>


                <div class="px-5 ms-xl-4 mt-5 centerAll" style="padding-top: 15%;">
                    <div class="row">
                        <div class="col-12">
                            <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #d64078;"></i>
                            <span class="h1 fw-bold mb-0" style="width: 70%;">
                                <img style="width: 390px;" src="https://segurosncs.cl/img/logo.png" alt="">
                            </span>
                        </div>
                    </div>
                </div>

                <div class="px-5 ms-xl-4 mt-2 centerAll">
                    <div class="row">
                        <div class="col-12">
                            <h5>Natalia Caballero, corredora de seguros</h5>
                        </div>
                    </div>
                </div>

                <div class="px-5 ms-xl-4 mt-2 centerAll">
                    <button class="btn btn-primary  d-flex align-items-center" style="background-color: #495ab4;" @click="verMas()">
                        Ver más
                    </button>
                </div>

                <div class="d-flex align-items-center justify-content-center px-5 ms-xl-4 mt-2 pt-5">
                    <div class="p-3">
                        <h5 class="d-flex align-items-center mb-0">
                            ¿Qué seguros buscas?
                        </h5>
                    </div>

                    <div class="form-group mb-0 p-3">
                        <select class="form-control">
                            <option value="99">Seguro condominio</option>
                            <!-- Agrega más colores si es necesario -->
                        </select>
                    </div>

                    <div class="p-3">
                    <a class="btn btn-primary d-flex align-items-center" style="background-color: #d64078;" href="#" data-toggle="modal" data-target="#contactModal">
                        Cotizar
                    </a>
                    </div>
                </div>



                <div class="contenedorPadre">
                    <!-- Otros elementos aquí -->
                    <div class="redes-container">
                        <img src="/img/seguros/instagram.png" alt="" style="width: 40px;">
                        <img src="/img/seguros/facebook.png" alt="" style="width: 40px;">
                    </div>
                </div>



            </div>
            <div class="col-sm-7 px-0 pl-5 d-none d-sm-block bg-seguros-web">

                <div class="contenedorSeguros">

                    <div class="row pt-3 pb-4">
                        <div class="col-4">
                            <div class="seguro-container">
                                <div class="seguro-icon" style="background-color: #495ab4;">
                                    <span class="material-icons">directions_car</span>
                                </div>
                                <div class="seguro-text">Seguro de vehículo y flota</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container">
                                <div class="seguro-icon" style="background-color: #495ab4;;">
                                    <span class="material-icons">home</span>
                                </div>
                                <div class="seguro-text">Seguro de hogar e incendio comercial</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container">
                                <div class="seguro-icon" style="background-color: #495ab4;">
                                    <span class="material-icons">gavel</span>
                                </div>
                                <div class="seguro-text">Seguro de responsabilidad civil</div>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-4 pb-4">
                        <div class="col-4">
                            <div class="seguro-container">
                                <div class="seguro-icon" style="background-color: darkcyan;">
                                    <span class="material-icons">construction</span>
                                </div>
                                <div class="seguro-text">Seguro todo riesgo en construcción</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container">
                                <div class="seguro-icon" style="background-color: darkcyan;">
                                    <span class="material-icons">shield</span>
                                </div>
                                <div class="seguro-text">Seguro de garantía</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container">
                                <div class="seguro-icon" style="background-color: darkcyan;">
                                    <span class="material-icons">local_shipping</span>
                                </div>
                                <div class="seguro-text">Seguro transporte terrestre</div>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-4">
                        <div class="col-4">
                            <div class="seguro-container">
                                <div class="seguro-icon" style="background-color: darkorchid;">
                                    <span class="material-icons">account_balance</span>
                                </div>
                                <div class="seguro-text">Seguro RC SERVIU y MOP</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container">
                                <div class="seguro-icon" style="background-color: darkorchid;">
                                    <span class="material-icons">engineering</span>
                                </div>
                                <div class="seguro-text">Seguro de ingeniería y equipo móvil</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container">
                                <div class="seguro-icon" style="background-color: darkorchid;">
                                    <span class="material-icons">warning</span>
                                </div>
                                <div class="seguro-text">Seguro de accidentes personales</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


        </div>
    </div>
</section>

@include('seguros.web.modals.corredora_seguros')

</div>


<script>
    let appseguros = new Vue({
        el: '#appseguros',
        data: {
            
        },
        watch: {
        },
        created() {
            alert("hola")
        },
        computed: {
        },
        methods: {
            toggleLoading(show) {
                const loading = document.getElementById('loading');
                if (show) {
                    loading.style.visibility = 'visible';
                } else {
                    loading.style.visibility = 'hidden';
                }
            },   
            verMas(){
                $("#verMas").modal('show');
            },
            guardarCotizacion(){

            },
        },

    });
</script>

@endsection