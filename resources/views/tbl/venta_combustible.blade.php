@extends('tbl.plantilla')

@section('content')
<div id="serviciosVue">
<section class="welcome-servicios">
  <div class="bg_ventacombustible">

  </div>
  <div>
    <div class="container ceroR">
      <div class="row py-5">
        <div id="welcomeTitle" class="col-lg-6 pt-5 pr-5 presentacionServicio section-phone-padding">
          <h2>
          Venta de combustible y arriendo de camiones de combustible
          </h2>
          <p><br></p>
          <p>
          Proporcionamos combustible de alta calidad y camiones cisterna para transporte eficiente. Ideal para tus operaciones diarias y grandes volúmenes. </p>
</p>
          
          <p>
          ¡Contáctanos y optimiza tu logística con nuestros servicios confiables!
          </p>
          <p class="pt-3">
            <a href="#" class="btn btn-secondary d-flex align-items-center" style="width: 155px;"  data-toggle="modal"  @click="seleccionarServicio(7,'Venta de combustible y arriendo de camiones de combustible')" data-target="#cotizarServicio">Quiero cotizar </a>
          </p>
        </div>
        <div class="col-6">

        </div>
      </div>
    </div>
  </div>

</section>



@include('tbl.modals.cotizaServicio')

  @include('tbl.include.footer')

  
</div>

<script src="{{ asset('js/tbl/servicios.js') }}"></script>

@endsection