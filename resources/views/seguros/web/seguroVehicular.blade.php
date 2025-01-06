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

                            <p>👋 ¡Hola! ¿buscas un seguro de vehículo o flota?, cuentame tu nombre y hablemos por Whatsapp para encontrar la mejor
                                opción de seguros.
                            </p>
                            <p>Ten a mano los siguientes datos:</p>
                            <ul>
                                <li>✓ Rut del propietario</li>
                                <li>✓ Marca, modelo y año del/los vehículos</li>
                            </ul>
                            @include('seguros.web.include.formWsp')

                        </div>

                    </div>

                </div>

                <div class="cel col-sm-7 bg-seguros-cel">

                    <div class="contenedorSeguros">

                        <div class="modal-body" style="color: white;font-weight: 600;">

                            <p>👋 ¡Hola! ¿buscas un seguro de vehículo o flota?, cuentame tu nombre y hablemos por Whatsapp para encontrar la mejor
                                opción de seguros.
                            </p>
                            <p>Ten a mano los siguientes datos:</p>
                            <ul>
                                <li>✓ Rut del propietario</li>
                                <li>✓ Marca, modelo y año del/los vehículos</li>
                            </ul>
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