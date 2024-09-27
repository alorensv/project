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
                                    <h5 class="pb-3">Seguro de responsabilidad civil</h5>
                                    <p>
                                    El seguro de responsabilidad civil cubre los daños ocasionados a terceras personas; ya sean daños físicos o a sus bienes. Este seguro es idóneo para empresas que deseen proteger su patrimonio en caso menoscabar a terceros perjudicados, en el ejercicio de su rubro.
                                    </p>
                                    <h5>Tipos de responsabilidad civil:</h5>
                                    <ul>
                                        <li>✓ Responsabilidad Civil (empresas de construcción, transporte, inmuebles, patronal, cruzada).</li>
                                        <li>✓ Responsabilidad Civil Médica.</li>
                                        <li>✓ Responsabilidad Civil Internacional.</li>
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