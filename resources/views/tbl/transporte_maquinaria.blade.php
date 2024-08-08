@extends('tbl.plantilla')

@section('content')
<div id="serviciosVue">

<section class="welcome-servicios">
  <div class="bg_transportemaquinaria">

  </div>
  <div>
    <div class="container ceroR">
      <div class="row py-5">
        <div id="welcomeTitle" class="col-lg-6 pt-5 pr-5 presentacionServicio section-phone-padding">
          <h2>
            Transporte de maquinaria
          </h2>
          <p><br></p>
          <p>
          Ofrecemos soluciones de transporte para maquinaria pesada y con sobre dimensión. Nos encargamos del traslado de todo tipo de equipos industriales y de construcción, asegurando un servicio seguro, puntual y adaptado a tus necesidades. 
          </p>
          <p>
          Con nuestra flota y personal capacitado, garantizamos la protección y entrega eficiente de tu maquinaria. ¡Confía en nosotros para mover tus equipos con la máxima seguridad y profesionalismo!
          </p>
          <p class="pt-3">
            <a href="#" class="btn btn-secondary d-flex align-items-center" style="width: 155px;"  data-toggle="modal"  @click="seleccionarServicio(5,'Transporte de maquinaria')" data-target="#cotizarServicio">Quiero cotizar </a>
          </p>
        </div>
        <div class="col-6">

        </div>
      </div>
    </div>
  </div>

</section>


<section class="galery py-5 bgservicios ceroR">
  <div class="container ">
    <h2 class="blueH my-4">Nuestros trabajos</h2>
    <div class="services_gallery-container">
      <div class="services_gallery-inner">
        <div class="services_gallery-item">
          <img src="/img/tbl/services/transporte_maquinaria_1.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/transporte_maquinaria_2.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/transporte_maquinaria_3.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/transporte_maquinaria_4.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/transporte_maquinaria_5.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/transporte_maquinaria_6.png" class="img-fluid">
        </div>
        <!-- Agrega más columnas según la cantidad de imágenes que tengas -->
      </div>
    </div>
  </div>
</section>
@include('tbl.modals.cotizaServicio')
  @include('tbl.include.trabaja_con_nosotros')
  @include('tbl.include.footer')

  
</div>

<script src="{{ asset('js/tbl/servicios.js') }}"></script>

@endsection