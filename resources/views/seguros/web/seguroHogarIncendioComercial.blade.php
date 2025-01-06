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
                                    <h5 class="pb-3">Seguro de hogar e incendio comercial</h5>
                                    <div class="faq-item">
                                        <h5>¿Puedo contratar un seguro hogar si mi vivienda se encuentra hipotecada?</h5>
                                        <p>Sí. Tu póliza de seguro quedará en beneficio a la institución bancaria, en caso de siniestro, en el % que le corresponda.</p>
                                    </div>

                                    <div class="faq-item">
                                        <h5>¿Por qué contratar el seguro hogar con cobertura de incendio + sismo?</h5>
                                        <p>Porque en caso de Terremoto, y su casa es siniestrada por un Incendio (ya sea por cortes de cables de electricidad, o por el mismo movimiento telúrico u otros), la compañía no estará obligada a indemnizar al asegurado; bajo exclusión “Incendio provocado por sismo”.</p>
                                    </div>

                                    <div class="faq-item">
                                        <h5>¿Qué monto asegurado es el que se debe informar a la compañía para una eventual indemnización?</h5>
                                        <p>El monto a informar es el valor de la edificación del inmueble según sus características de construcción (material sólido-concreto-albañilería-mixto-ligero-madera). Este valor no debe considerar el terreno, por tanto el monto asegurado no es el valor comercial, ni la tasación fiscal.</p>
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