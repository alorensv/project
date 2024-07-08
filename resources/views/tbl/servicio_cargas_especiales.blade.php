@extends('tbl.plantilla')

@section('content')
<div id="serviciosVue">


  <section class="welcome-servicios">
    <div class="bg_cargaespecial">

    </div>
    <div>
      <div class="container ceroR">
        <div class="row py-5">
          <div id="welcomeTitle" class="col-lg-6 pt-5 pr-5 presentacionServicio section-phone-padding">
            <h2>
              Transporte de cargas especiales
            </h2>
            <p><br></p>
            <p>
              Somos expertos en Transporte de Cargas Especiales. Nos dedicamos a mover maquinaria pesada, equipos sobredimensionados y cualquier carga que requiera un manejo especializado.</p>
            <p>
              Confíe en nosotros para el transporte de sus cargas especiales. ¡Llámenos hoy y descubra cómo podemos ayudarle a mover su negocio hacia adelante!</p>
            <p class="pt-3">
              <a href="#" class="btn btn-secondary d-flex align-items-center" style="width: 155px;" data-toggle="modal" @click="seleccionarServicio(2,'Transporte de cargas especiales')"   data-target="#cotizarServicio">Quiero cotizar</a>
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
            <img src="/img/tbl/services/carga_especial_1.png" class="img-fluid">
          </div>
          <div class="services_gallery-item">
            <img src="/img/tbl/services/carga_especial_2.png" class="img-fluid">
          </div>
          <div class="services_gallery-item">
            <img src="/img/tbl/services/carga_especial_3.png" class="img-fluid">
          </div>
          <div class="services_gallery-item">
            <img src="/img/tbl/services/carga_especial_4.png" class="img-fluid">
          </div>
          <div class="services_gallery-item">
            <img src="/img/tbl/services/carga_especial_5.png" class="img-fluid">
          </div>
          <div class="services_gallery-item">
            <img src="/img/tbl/services/carga_especial_6.png" class="img-fluid">
          </div>
          <div class="services_gallery-item">
            <img src="/img/tbl/services/carga_especial_7.png" class="img-fluid">
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