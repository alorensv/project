@extends('tbl.plantilla')

@section('content')
<div id="serviciosVue">
<section class="welcome-servicios">
  <div class="bg_izaje">

  </div>
  <div>
    <div class="container ceroR">
      <div class="row py-5">
        <div id="welcomeTitle" class="col-lg-6 pt-5 pr-5 presentacionServicio section-phone-padding">
          <h2>
          Servicios de izaje
          </h2>
          <p><br></p>
          <p>
          Servicio garantizado y altos estándares! Contamos con camiones pluma de 10 toneladas, grúas de 25 a 150 toneladas y grúas camión con capacidad desde las 25 toneladas hasta las 220 toneladas. 
          </p>
          
          <p>
            Asesoramos a nuestros clientes en el diseño, implementación y/o ajustes de programas para manejo seguro de cargas.
          </p>
          <p>¡Tenemos socios estratégicos para que confíes en nosotros tus proyectos más exigentes! Trabajamos con Grollmus Group, Grúas Elebö y Grúas Hydrosur.</p>
          <div class="d-flex">
            <img src="/img/tbl/grollmus.png" class="sociosIzajes" alt="servicios de izajes">
            <img src="/img/tbl/elebo.png" class="sociosIzajes" alt="servicios de izajes" >
          </div>
          <p class="pt-3">
            <a href="#" class="btn btn-secondary d-flex align-items-center" style="width: 155px;"  data-toggle="modal"  @click="seleccionarServicio(6,'Servicios de izaje')" data-target="#cotizarServicio">Quiero cotizar </a>
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
          <img src="/img/tbl/services/servicios_izajes.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/izajes_2.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/izajes_3.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/gruas.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/izajes_4.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/izajes_5.png" class="img-fluid">
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