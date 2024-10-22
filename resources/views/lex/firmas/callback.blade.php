@extends('lex.plantilla')

@section('content')
<div id="callback">
    <section class="white-division pt-5 pb-2" style="margin-top: 30px;">

        <div class="container containerPagoExitoso">
            <?php //echo "<pre>"; print_r($compra->direccion->region);  die; 
            ?>

            <div class="row bg-white market-body ">
                <div class="col-12 pt-4 pl-4">

                    <div class="success-message text-center">
                        <span class="material-icons">check_circle</span>
                        <span>Callback in progress</span>
                    </div>


                </div>
            </div>
        </div>


    </section>
</div>



@endsection