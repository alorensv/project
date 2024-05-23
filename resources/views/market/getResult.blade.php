@extends('plantilla')

@section('content')
<style>

</style>
<section class="pt-4" style="margin-top: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-12 pl-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('market') }}">Market</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Comprobante de pago</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="white-division pt-2 pb-2">

<div class="container">
<?php //echo "<pre>"; print_r($detalleCompra); ?>

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

@endsection