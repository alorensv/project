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
                                    <h5 class="pb-3">Seguro de garantía</h5>
                                        <p>Las pólizas de garantía, tal como su nombre indica, garantizan que se cumplan las condiciones y cláusulas que tiene un contrato entre dos partes.</p>
                                        <p>La póliza de garantía, a diferencia de la boleta bancaria, al ser contratada no queda registrada en los sistemas bancarios, por tanto, no afectará a los antecedentes crediticios o financieros del cliente.</p>

                                        <ul>
                                            <li>✓ Póliza Seriedad de la Oferta → Licitaciones.</li>
                                            <li>✓ Póliza Fiel Cumplimiento de contrato → Asegura que un contrato entre dos partes se ejecute tal como indica en plazo y condiciones.</li>
                                            <li>✓ Póliza Correcto Uso de Anticipos → Garantiza que los dineros sean utilizados tal como lo indica el contrato.</li>
                                            <li>✓ Póliza Correcta Ejecución de la Obra → Para trabajos de construcción.</li>
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