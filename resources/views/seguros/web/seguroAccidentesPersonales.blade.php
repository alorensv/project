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
                                        <h5 class="pb-3">Seguro de accidentes personales</h5>

                                        <p><strong>¿Qué cubre?</strong></p>
                                        <p>Este seguro otorga una indemnización al asegurado a consecuencia de las lesiones producidas por un accidente.</p>

                                        <p><strong>Requisitos mínimos para el seguro de Accidentes Personales:</strong></p>

                                        <ul>
                                            <li>✓ Para personas mayores de 18 años, hasta 70 años de edad.</li>
                                            <li>✓ Dentro y fuera del territorio chileno, con exclusión de países con conflictos bélicos.</li>
                                            <li>✓ Sólo rige siempre y cuando los asegurados realicen su gestión de trabajo, con las medidas de seguridad implementadas para cada tipo de actividad.</li>
                                            <li>✓ En caso de siniestro se deberá demostrar la relación laboral entre la persona afectada y la empresa o institución contratante (Contrato laboral).</li>
                                        </ul>
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