@extends('tbl.plantilla')

@section('content')

<div id="serviciosVue">

  <section class="welcome-servicios">
    <div class="bg_equiposforestales">

    </div>
    <div>
      <div class="container ceroR">
        <div class="row py-5">
          <div id="welcomeTitle" class="col-lg-6 pt-5 pr-5 presentacionServicio section-phone-padding">
            <h2>
              Transporte de equipos forestales
            </h2>
            <p><br></p>
            <p>
              Entendemos la complejidad y los desafíos asociados con el movimiento de maquinaria y equipos utilizados en la industria forestal.
            </p>
            <p>
              Transporte de maquinaria como retroexcavadoras, minicargadores, grúa horquilla, y vehículos livianos.
            </p>
            <p class="pt-3">
              <a href="#" class="btn btn-secondary d-flex align-items-center" style="width: 155px;" data-toggle="modal" @click="seleccionarServicio(3,'Transporte de equipos forestales')" data-target="#cotizarServicio">Quiero cotizar </a>
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
            <img src="/img/tbl/services/equipo_forestal_1.png" class="img-fluid">
          </div>

          <div class="services_gallery-item">
            <img src="/img/tbl/services/transporte_maquinaria_7.png" class="img-fluid">
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