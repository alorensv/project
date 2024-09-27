@extends('seguros.web.plantilla')

@section('content')
<div id="appseguros">
<section class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-5 text-black mt-3">

                <!-- <div class="faq-container">
                    <div class="faq-icon">
                        <span class="material-icons">help_outline</span>
                    </div>
                    <div class="faq-text">Preguntas frecuentes</div>
                </div> -->


                <div class="px-5 ms-xl-4 mt-5 centerAll logoUbication">
                    <div class="row">
                        <div class="col-12">
                        <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4 moving-crow" style="color: #d64078;"></i>

                            <span class="h1 fw-bold mb-0" style="width: 70%;">
                                <img class="imgLogoCel" src="/img/seguros/logo.png" alt="">
                            </span>
                        </div>
                    </div>
                </div>

                <div class="px-5 ms-xl-4 mt-2 centerAll">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="web">Natalia Caballero, corredora de seguros</h5>
                            <div class="cel">
                                <h5>Natalia Caballero</h5>
                                <h5>Corredora de seguros</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-5 ms-xl-4 mt-2 centerAll">
                    <button class="btn btn-primary  d-flex align-items-center" style="background-color: #495ab4;" @click="go('corredora')">
                        Ver más
                    </button>
                </div>

                <div class="web">
                <div class="d-flex align-items-center justify-content-center px-5 ms-xl-4 mt-2 pt-5">
                    <div class="p-3">
                        <h5 class="d-flex align-items-center mb-0">
                            ¿Qué seguros buscas?
                        </h5>
                    </div>

                    <div class="form-group mb-0 p-3">
                        <select class="form-control" v-model="selectedSeguro">
                            <option value="Seguro condominio">Seguro condominio</option>
                            <!-- Agrega más colores si es necesario -->
                        </select>
                    </div>

                    <div class="p-3">
                    <button class="btn btn-primary d-flex align-items-center" style="background-color: #d64078;" @click="cotizarSeguro">
                        Cotizar
                    </button>
                    </div>
                </div>
                </div>

                <div class="cel">
                <div class="d-flex align-items-center justify-content-center px-5 ms-xl-4 mt-2 pt-5">
                    <div class="p-3">
                        <h5 class="d-flex align-items-center mb-0">
                            ¿Qué seguros buscas?
                        </h5>
                    </div>
                </div>                
                <div class="d-flex align-items-center justify-content-center px-5 ms-xl-4 mt-2 pt-1">
                    <div class="form-group mb-0 p-1">
                        <select class="form-control" v-model="selectedSeguro">
                            <option value="Seguro condominio">Seguro condominio</option>
                            <!-- Agrega más colores si es necesario -->
                        </select>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center px-5 ms-xl-4 mt-2 pt-1">
                    <div class="p-3">
                    <button class="btn btn-primary d-flex align-items-center" style="background-color: #d64078;" @click="cotizarSeguro">
                        Cotizar
                    </button>
                    </div>
                </div>
                </div>

                @include('seguros.web.include.redes')

            </div>
            <div class="web col-sm-7 px-0 pl-5 d-sm-block bg-seguros-web">

                <div class="contenedorSeguros">

                    <div class="row pt-3 pb-4">
                        <div class="col-4">
                            <div class="seguro-container" @click="go('vehiculo')">
                                    <div class="seguro-border"></div>
                                    <div class="seguro-icon" style="background-color: #495ab4;">
                                        <span class="material-icons">directions_car</span>
                                    </div>
                                <div class="seguro-text">Seguro de vehículo y flota</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container" @click="go('hogar')">
                                <div class="seguro-border2"></div>
                                <div class="seguro-icon" style="background-color: #495ab4;;">
                                    <span class="material-icons">home</span>
                                </div>
                                <div class="seguro-text">Seguro de hogar e incendio comercial</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container" @click="go('responsabilidad')">
                                <div class="seguro-border3"></div>
                                <div class="seguro-icon" style="background-color: #495ab4;">
                                    <span class="material-icons">gavel</span>
                                </div>
                                <div class="seguro-text">Seguro de responsabilidad civil</div>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-4 pb-4">
                        <div class="col-4">
                            <div class="seguro-container" @click="go('construccion')">
                                <div class="seguro-border4"></div>
                                <div class="seguro-icon" style="background-color: darkcyan;">
                                    <span class="material-icons">construction</span>
                                </div>
                                <div class="seguro-text">Seguro todo riesgo en construcción</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container" @click="go('garantia')">
                                <div class="seguro-border5"></div>
                                <div class="seguro-icon" style="background-color: darkcyan;">
                                    <span class="material-icons">shield</span>
                                </div>
                                <div class="seguro-text">Seguro de garantía</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container" @click="go('transporte')">
                                <div class="seguro-border6"></div>
                                <div class="seguro-icon" style="background-color: darkcyan;">
                                    <span class="material-icons">local_shipping</span>
                                </div>
                                <div class="seguro-text">Seguro transporte terrestre</div>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-4">
                        <div class="col-4">
                            <div class="seguro-container" @click="go('rc')">
                                <div class="seguro-border7"></div>
                                <div class="seguro-icon" style="background-color: darkorchid;">
                                    <span class="material-icons">account_balance</span>
                                </div>
                                <div class="seguro-text">Seguro RC SERVIU y MOP</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container" @click="go('ingenieria')">
                                <div class="seguro-border8"></div>
                                <div class="seguro-icon" style="background-color: darkorchid;">
                                    <span class="material-icons">engineering</span>
                                </div>
                                <div class="seguro-text">Seguro de ingeniería y equipo móvil</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container" @click="go('accidentes')">
                                <div class="seguro-border9"></div>
                                <div class="seguro-icon" style="background-color: darkorchid;">
                                    <span class="material-icons">warning</span>
                                </div>
                                <div class="seguro-text">Seguro de accidentes personales</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="cel col-sm-7 pt-4 bg-seguros-cel">

                <div class="contenedorSeguros">

                    <div class="row pt-3 pb-4">
                        <div class="col-4">
                            <div class="seguro-container" @click="go('vehiculo')">
                                    <div class="seguro-border"></div>
                                    <div class="seguro-icon" style="background-color: #495ab4;">
                                        <span class="material-icons">directions_car</span>
                                    </div>
                                <div class="seguro-text">Seguro de vehículo y flota</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container" @click="go('hogar')">
                                <div class="seguro-border2"></div>
                                <div class="seguro-icon" style="background-color: #495ab4;;">
                                    <span class="material-icons">home</span>
                                </div>
                                <div class="seguro-text">Seguro de hogar e incendio comercial</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container" @click="go('responsabilidad')">
                                <div class="seguro-border3"></div>
                                <div class="seguro-icon" style="background-color: #495ab4;">
                                    <span class="material-icons">gavel</span>
                                </div>
                                <div class="seguro-text">Seguro de responsabilidad civil</div>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-4 pb-4">
                        <div class="col-4">
                            <div class="seguro-container" @click="go('construccion')">
                                <div class="seguro-border4"></div>
                                <div class="seguro-icon" style="background-color: darkcyan;">
                                    <span class="material-icons">construction</span>
                                </div>
                                <div class="seguro-text">Seguro todo riesgo en construcción</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container" @click="go('garantia')">
                                <div class="seguro-border5"></div>
                                <div class="seguro-icon" style="background-color: darkcyan;">
                                    <span class="material-icons">shield</span>
                                </div>
                                <div class="seguro-text">Seguro de garantía</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container" @click="go('transporte')">
                                <div class="seguro-border6"></div>
                                <div class="seguro-icon" style="background-color: darkcyan;">
                                    <span class="material-icons">local_shipping</span>
                                </div>
                                <div class="seguro-text">Seguro transporte terrestre</div>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-4">
                        <div class="col-4">
                            <div class="seguro-container" @click="go('rc')">
                                <div class="seguro-border7"></div>
                                <div class="seguro-icon" style="background-color: darkorchid;">
                                    <span class="material-icons">account_balance</span>
                                </div>
                                <div class="seguro-text">Seguro RC SERVIU y MOP</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container" @click="go('ingenieria')">
                                <div class="seguro-border8"></div>
                                <div class="seguro-icon" style="background-color: darkorchid;">
                                    <span class="material-icons">engineering</span>
                                </div>
                                <div class="seguro-text">Seguro de ingeniería y equipo móvil</div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="seguro-container" @click="go('accidentes')">
                                <div class="seguro-border9"></div>
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
@include('seguros.web.modals.cotizar')
</div>


<script src="{{ asset('js/seguros/scriptJs.js') }}"></script>

@endsection