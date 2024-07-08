@extends('tbl.plantilla')

@section('content')
<div id="serviciosVue">
  <section class="welcome-servicios">
    <div class="bg_sobredimensionados"></div>
    <div>
      <div class="container ceroR">
        <div class="row py-5">
          <div id="welcomeTitle" class="col-lg-6 pt-5 pr-5 presentacionServicio section-phone-padding">
          <h2>Transporte Sobredimensionado</h2>
          <p><br></p>
          <p>
            Nuestra experiencia y equipo especializado nos permiten manejar cargas que superan las dimensiones estándar con la máxima seguridad y eficiencia.
          </p>
          <p>
            Desde la planificación hasta la ejecución, nos encargamos de cada detalle para asegurar que su carga llegue a su destino en perfectas condiciones y a tiempo.
          </p>
          <p>
            Elijanos para sus necesidades de transporte sobredimensionado. ¡Contáctenos hoy y descubra cómo podemos facilitar su logística!
          </p>
          <p class="pt-3">
            <a href="#" class="btn btn-secondary d-flex align-items-center" style="width: 155px;" @click="seleccionarServicio(1,'Transporte sobre dimensionado')"  data-toggle="modal" data-target="#cotizarServicio">Quiero cotizar</a>
          </p>
          </div>
          <div class="col-6"></div>
        </div>
      </div>
    </div>
  </section>

  <section class="galery py-5 bgservicios ceroR">
    <div class="container">
      <h2 class="blueH my-4">Nuestros trabajos</h2>
      <div class="services_gallery-container">
        <div class="services_gallery-inner">
          <div class="services_gallery-item"><img src="/img/tbl/services/sobre_dimensionado_1.png" class="img-fluid"></div>
          <div class="services_gallery-item"><img src="/img/tbl/services/sobre_dimensionado_2.png" class="img-fluid"></div>
          <div class="services_gallery-item"><img src="/img/tbl/services/sobre_dimensionado_3.png" class="img-fluid"></div>
          <div class="services_gallery-item"><img src="/img/tbl/services/sobre_dimensionado_4.png" class="img-fluid"></div>
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
