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
                                    <div class="insurance-info">
                                        <h5 class="pb-3">Seguro transporte terrestre</h5>
                                        <p>El seguro de transporte terrestre cubre los daños ocasionados a la carga transportada, ya sea por:</p>

                                        <ul>
                                            <li>✓ Choque o colisión.</li>
                                            <li>✓ Volcamiento o descarrilamiento del medio transportador.</li>
                                            <li>✓ Rotura de puentes, túneles u otras obras viales.</li>
                                            <li>✓ Terremoto y fenómenos de la naturaleza.</li>
                                            <li>✓ Robo.</li>
                                        </ul>

                                        <p><strong>**</strong> Considerar que el medio transportador deberá contar con medidas mínimas de: embalaje, cierre hermético, GPS (robo), entre otros dependiendo de cada compañía.</p>

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

                            <p>👋 ¡Hola! ¿buscas un seguro de vehículo o flota?, cuentame tu nombre y hablemos por Whatsapp para encontrar la mejor
                                opción de seguros.
                            </p>
                            <p>Ten a mano los siguientes datos:</p>
                            <ul>
                                <li>✓ Rut</li>
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
                                <li>✓ Rut</li>
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