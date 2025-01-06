@extends('seguros.web.plantilla')

@section('content')
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


                    <div class="mt-2 paddingCel">
                        <div class="row">
                            <div class="col-12">
                                <section>
                                    <div class="pt-0 text-center">
                                        <img src="/img/seguros/perfil.png" class="img-fluid rounded-circle mb-4" alt="Descripción de la imagen" style="max-width: 180px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);">
                                        <h4 class="mt-3">Natalia Caballero</h4>
                                        <h5>Corredora de seguros, CMF</h5>
                                        <h5>Administradora pública, Universidad de Concepción</h5>


                                    </div>

                                    @include('seguros.web.include.contacto')

                                </section>

                            </div>
                        </div>
                    </div>


                    @include('seguros.web.include.redes')


                </div>
                <div class="web col-sm-7 px-0 pl-5  d-sm-block bg-seguros-web">

                    <div class="contenedorSeguros">

                        <div class="modal-body p-5" style="color: white;font-weight: 600;">

                            <p>👋 ¡Hola! Soy Natalia Caballero Pérez, corredora de propiedades miembro de la Comisión para el Mercado Financiero (CMF) con más de 7 años de experiencia en el rubro.</p>
                            <p>
                                Me especializo en ofrecer un servicio integral y gratuito de asesoramiento, con un enfoque particular en seguros generales y de vehículos.
                            </p>
                            <p>
                                Mi objetivo es ayudarte a tomar las mejores decisiones para tu inversión, con la tranquilidad de estar en manos expertas.
                            </p>
                            @include('seguros.web.include.formWsp')
                        </div>

                    </div>

                </div>

                <div class="cel col-sm-7 bg-seguros-cel">

                    <div class="contenedorSeguros">

                        <div class="modal-body" style="color: white;font-weight: 600;">

                            <p>👋 ¡Hola! Soy Natalia Caballero Pérez, corredora de propiedades miembro de la Comisión para el Mercado Financiero (CMF) con más de 7 años de experiencia en el rubro.</p>
                            <p>
                                Me especializo en ofrecer un servicio integral y gratuito de asesoramiento, con un enfoque particular en seguros generales y de vehículos.
                            </p>
                            <p>
                                Mi objetivo es ayudarte a tomar las mejores decisiones para tu inversión, con la tranquilidad de estar en manos expertas.
                            </p>
                            @include('seguros.web.include.formWsp')
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