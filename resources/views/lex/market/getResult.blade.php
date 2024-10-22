@extends('lex.plantilla')

@section('content')
<div id="vueFirmas">
    <section class="white-division pt-5 pb-2" style="margin-top: 30px;">

        <div class="container containerPagoExitoso">
            <?php //echo "<pre>"; print_r($compra->direccion->region);  die; 
            ?>

            <div class="row bg-white market-body ">
                <div class="col-12 pt-4 pl-4">
                    <div class="row pb-3">
                        <div class="col-12">
                            <div id="accordionCarrito">

                                <?php if (isset($response->status) && $response->status == 'AUTHORIZED'): ?>
                                    <!-- Pago exitoso con icono -->
                                    <div class="success-message text-center">
                                        <span class="material-icons">check_circle</span>
                                        <span>Pago exitoso</span>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingCart">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseCart" aria-expanded="false" aria-controls="collapseCart">
                                                    Comprobante de pago <i class="fas fa-chevron-down"></i>
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseCart" class="collapse" aria-labelledby="headingCart" data-parent="#accordionCarrito">
                                            <div class="card-body">
                                                <table class="table">
                                                    <tr>
                                                        <th>Identificador de pago</th>
                                                        <td>{{$response->buy_order}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Monto de transacción</th>
                                                        <td>${{ number_format($response->amount, 0, ',', '.') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>4 últimos digitos de la tarjeta</th>
                                                        <td>{{$response->card_detail->card_number}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Fecha de la transacción</th>
                                                        <td>{{$response->transaction_date}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Código de autorización</th>
                                                        <td>{{$response->authorization_code}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Código tipo de transacción</th>
                                                        <td>{{$response->payment_type_code}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Número de cuotas</th>
                                                        <td>{{$response->installments_number}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                <?php elseif (isset($compra)): ?>
                                    <div class="card">
                                        <div class="card-header" id="headingCart">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseCart" aria-expanded="false" aria-controls="collapseCart">
                                                    Detalles de la transacción <i class="fas fa-chevron-down"></i>
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseCart" class="collapse show" aria-labelledby="headingCart" data-parent="#accordionCarrito">
                                            <div class="card-body">
                                                <table class="table">
                                                    <tr>
                                                        <th>Identificador de pago</th>
                                                        <td>{{$compra->id}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Monto de transacción</th>
                                                        <td>${{ number_format($compra->monto, 0, ',', '.') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>4 últimos digitos de la tarjeta</th>
                                                        <td>{{$compra->ultimos_num_tarjeta}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Fecha de la transacción</th>
                                                        <td>{{$compra->fecha_transaccion}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Código de autorización</th>
                                                        <td>{{$compra->codigo_auth}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Código tipo de transacción</th>
                                                        <td>{{$compra->codigo_tipo_transaccion}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Número de cuotas</th>
                                                        <td>{{$compra->num_cuotas}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                <?php else: ?>
                                    <h1>error</h1>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>


                    <div class="row pb-3">
                        <div class="col-12">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                Detalles de mi compra<i class="fas fa-chevron-down"></i>
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseCart" class="collapse show" aria-labelledby="headingCart" data-parent="#accordionCarrito">
                                        <div class="card-body">

                                            <table class="table">
                                                <tr>
                                                    <th>Servicio</th>
                                                    <th>Cantidad</th>
                                                    <th>Costo</th>
                                                    <th></th>
                                                </tr>
                                                @foreach($detallesCompra as $detalle)
                                                <tr>
                                                    <td>{{$detalle->idRedaccion}} Firma avanzada {{$detalle->nombreDoc}}</td>
                                                    <td>{{$detalle->cantidad}}</td>
                                                    <td>${{ number_format($detalle->monto, 0, ',', '.') }}</td>
                                                    <td><button class="btn btn-primary" @click="firmardocumento({{ $detalle->idRedaccion }})">Firmar</button></td>
                                                </tr>
                                                @endforeach

                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>


    </section>
</div>

<script>
    let firmas = new Vue({
        el: '#vueFirmas',
        data: {
            
        },
        mounted() {

        },
        methods: {
            firmardocumento(idRedaccion) {
                axios.post('/auth', {
                    idRedaccion: idRedaccion
                })
                .then(response => {        
                                        
                    if(response.data.urlRedirect) {
                        console.log(JSON.stringify(response.data));
                        window.location.href = response.data.urlRedirect;
                    } else {
                        // Si no hay URL, mostrar el error o un mensaje
                        alert('No se pudo obtener la URL de redirección.');
                    }
            
                })
                .catch(error => {
                    // Manejar el error
                    console.error('Hubo un error al enviar el formulario', error);
                });
            },
        }
    });
</script>


@endsection