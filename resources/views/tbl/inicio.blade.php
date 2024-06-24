@extends('tbl.plantilla')

@include('tbl.include.cotiza')

@section('slide')
@include('tbl.include.slide')
@endsection

@section('content')

<section class="welcome">
  <div>
    <div class="container">
      <div class="row py-5">
        <div class="col-lg-6 pt16 pb16 ceroR">
          <h2>
            Transportes Bulnes Limitada
          </h2>
          <p><br></p>
          <p>
            Constituida como empresa el año 2011, actualmente contamos con más de <strong>11 años de antiguedad y experiencia en el mercado.</strong> Nos especializamos en el traslado de carga sobredimensionada como maquinarias, equipos, contenedores y carga en general por todo Chile.
          </p>
          <p>
            Disponemos de profesionales calificados y operadores certificados con experiencia para entregar servicios de calidad, cumpliendo con los estándares de seguridad y puntualidad.
          </p>
          <p>
            <a href="#" class="btn btn-primary d-flex align-items-center" style="width: 155px;">Descubre más </a>
          </p>
        </div>
        <div class="col-6">

        </div>
      </div>
    </div>
  </div>
  <div class="bgRuta">

  </div>
</section>

@include('tbl.include.slide_servicios')

<section class="indicadores py-5 bgIndicadores">
  <div class="container ">

    <div class="indicators-container">
      <div class="indicator" id="indicator-accidentes">
        <div class="value-container" data-start="0" data-end="0">0</div>
        <div class="title">Accidentes</div>
      </div>
      <div class="indicator" id="indicator-km">
        <div class="value-container">
          <span>+</span>
          <div class="value" data-start="0" data-end="3">3</div><span> Millones</span>
        </div>
        <div class="title">de km recorridos</div>
      </div>
      <div class="indicator" id="indicator-clientes">
        <div class="value-container">
          <span>+</span>
          <div class="value" data-start="0" data-end="790">790</div>
        </div>
        <div class="title">Clientes satisfechos</div>
      </div>
      <div class="indicator" id="indicator-compromiso">
        <div class="value-container">
          <div class="value" data-start="0" data-end="100">100</div><span>%</span>
        </div>
        <div class="title">Compromiso con nuestros clientes</div>
      </div>
    </div>




  </div>
</section>

<section class="transporte-cargas">
  <div class="container">
    <div class="row">
      <div class="col-6 d-flex justify-content-center align-items-center logoGrande">
        <img src="/img/tbl/logo2.png" alt="" style="width: 50%;">
      </div>
      <div class="col-lg-6 pt-5 text-justify ceroR">
        <h2 class="pt-3" style="color: white;">
          ¿Porqué trabajar con nosotros?
        </h2>
        <p><br></p>
        <p>
          Equipos de diferentes anchos, largos y altos, tractos, cama baja, ramplas, camas bajas extensibles, ramplas extensibles y drop.
        </p>
        <p>
          Patio de almacenamiento transitorio para cargas con elementos con certificación (elementos de anclaje).
        </p>
        <p>
          Tramitación, pago de permisos y coordinación con Carabineros de Chile para traslado de cargas especiales.
        </p>
        <p>
          Mantenemos vigentes con la aseguradora "Davidson Eltit Asociados", segurtos personales (trabajadores), seguros de carga, cabotaje, responsabilidad civil y daños propios.
        </p>
        <p class="pt-4">
          <a href="#" class="btn btn-secondary d-flex align-items-center" style="width: 155px;">Descubre más </a>
        </p>
      </div>
    </div>
  </div>
</section>



@endsection