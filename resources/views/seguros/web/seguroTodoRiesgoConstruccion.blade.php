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
                                    <h5 class="pb-3">Seguro todo riesgo en construcción</h5>
                                    <div class="faq-item">
                                        <h5>¿Qué indemniza?</h5>
                                        <p>El seguro de todo riesgo en construcción, indemniza las pérdidas que puedan ocasionarse dentro de una obra, siempre y cuando esto ocurra en el lugar específico donde se desarrolla dicha construcción.</p>
                                    </div>
                                    <h5>Los seguros de TRC , son solicitados por obligatoriedad por el organismo Mandante, ya sea:</h5>
                                    <ul>
                                        <li>✓ Seremi de Obras Públicas</li>
                                        <li>✓ Municipalidades</li>
                                        <li>✓ Mandantes en licitaciones públicas</li>
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
                                <li>✓ </li>
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
                                <li>✓ </li>
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