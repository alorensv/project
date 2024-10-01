@extends('tiny.tinyTemplate')

@section('content')
<style>

</style>

<section class="white-division pt-5 pb-2" style="margin-top: 20px;">

<div class="container">
<?php //echo "<pre>"; print_r($compra->direccion->region);  die; ?>

<div class="row bg-white market-body ">
    <div class="col-12 pt-4 pl-4">
        <div class="row pb-3">
            <div class="col-12">
                <div id="accordionCarrito">
                    <div class="card">

                    <?php if(isset($response->status) && $response->status == 'AUTHORIZED'): ?>

                        <div class="card-header" id="headingCart">
                            <h5 class="mb-0">                                
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseCart" aria-expanded="false" aria-controls="collapseCart">
                                    Comprobante de pago <i class="fas fa-chevron-down"></i>
                                </button>
                            </h5>
                        </div>

                        <div id="collapseCart" class="collapse show" aria-labelledby="headingCart" data-parent="#accordionCarrito">
                            <div class="card-body">
                                <table class="table">
                                    <tr><th>Identificador de pago</th><td>{{$response->buy_order}}</td></tr>
                                    <tr><th>Monto de transacción</th><td>${{ number_format($response->amount, 0, ',', '.') }}</td></tr>
                                    <tr><th>4 últimos digitos de la tarjeta</th><td>{{$response->card_detail->card_number}}</td></tr>
                                    <tr><th>Fecha de la transacción</th><td>{{$response->transaction_date}}</td></tr>
                                    <tr><th>Código de autorización</th><td>{{$response->authorization_code}}</td></tr>
                                    <tr><th>Código tipo de transacción</th><td>{{$response->payment_type_code}}</td></tr>
                                    <tr><th>Número de cuotas</th><td>{{$response->installments_number}}</td></tr>
                                </table>
                            </div>
                        </div>

                    <?php elseif(isset($compra)): ?>

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
                                    <tr><th>Identificador de pago</th><td>{{$compra->id}}</td></tr>
                                    <tr><th>Monto de transacción</th><td>${{ number_format($compra->monto, 0, ',', '.') }}</td></tr>
                                    <tr><th>4 últimos digitos de la tarjeta</th><td>{{$compra->ultimos_num_tarjeta}}</td></tr>
                                    <tr><th>Fecha de la transacción</th><td>{{$compra->fecha_transaccion}}</td></tr>
                                    <tr><th>Código de autorización</th><td>{{$compra->codigo_auth}}</td></tr>
                                    <tr><th>Código tipo de transacción</th><td>{{$compra->codigo_tipo_transaccion}}</td></tr>
                                    <tr><th>Número de cuotas</th><td>{{$compra->num_cuotas}}</td></tr>
                                </table>
                            </div>
                        </div>
                            
                        
                    <?php else: ?>
                        <h1>error</h1>
                    <?php endif; ?>
                    </div>
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

                        <div id="collapseCart" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Costo</th>
                                    </tr>                                    
                                    @foreach($detalleCompra as $detalle)
                                    <tr>
                                      <td>{{$detalle->producto->nombre}}</td>
                                      <td>{{$detalle->cantidad}}</td>
                                      <td>${{ number_format($detalle->monto, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                    
                                </table>

                                <table class="table">
                                    <tr>
                                        <th colspan="4">Datos de entrega</th>
                                    </tr>
                                    <tr>
                                        <th>Región</th>
                                        <th>Comuna</th>
                                        <th>Dirección</th>
                                        <th>Código postal</th>
                                        <th>Nombre contacto</th>
                                        <th>Teléfono contacto</th>
                                    </tr>
                                    <tr>
                                        <td>{{$compra->direccion->region}}</td>
                                        <td>{{$compra->direccion->comuna}}</td>
                                        <td>{{$compra->direccion->direccion}}</td>
                                        <td>{{$compra->direccion->codigo_postal}}</td>
                                        <td>{{$compra->direccion->nombre_contacto}}</td>
                                        <td>{{$compra->direccion->fono_contacto}}</td>
                                    </tr>
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
@include('tiny.footer')

@endsection