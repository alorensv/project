@extends('tbl.plantilla')

@section('content')


<div id="serviciosVue">

<section class="welcome-servicios">
  <div class="bg_rescateequipos">

  </div>
  <div>
    <div class="container ceroR">
      <div class="row py-5">
        <div id="welcomeTitle" class="col-lg-6 pt-5 pr-5 presentacionServicio section-phone-padding">
          <h2>Transporte y rescate de equipos siniestrados</h2>
          <p><br></p>
          <p>Brindamos soluciones profesionales para el transporte y rescate de equipos siniestrados, asegurando el manejo seguro y eficiente de maquinaria y equipos en situaciones de emergencia.</p>
          <p>Confíe en nosotros para recuperar y trasladar sus equipos siniestrados con rapidez y profesionalismo. ¡Contáctenos hoy mismo para obtener más información y asegurar la continuidad de sus operaciones!</p>
          <p class="pt-3">
            <a href="#" class="btn btn-secondary d-flex align-items-center" style="width: 155px;" data-toggle="modal"  @click="seleccionarServicio(4,'Transporte y rescate de equipos siniestrados')" data-target="#cotizarServicio">Quiero cotizar</a>
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
          <img src="/img/tbl/services/sobredimensionado_1.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/sobredimensionado_2.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/sobredimensionado_3.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/sobredimensionado_3.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/sobredimensionado_3.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/sobredimensionado_3.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/sobredimensionado_3.png" class="img-fluid">
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