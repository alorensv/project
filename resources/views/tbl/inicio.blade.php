@extends('tbl.plantilla')

@include('tbl.include.cotiza')

@section('slide')


<div id="myCarousel" class="carousel slide" data-ride="carousel" style="padding-bottom: 0px !important;margin-top: 3%;">
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">

    <div class="carousel-item active">
      <img class="second-slide" src="img/tbl/traslados.png" alt="Second slide">
      <div class="row titleCarousel">
        <div class="container d-flex">
          <div class="titleServices1">
            <h1 class="text-center">Traslado de carga general - sobredimensión</h1>
          </div>
          <div onclick="goToServices()" class="titleServices2">
            <a class="btn btn-lg btn-primary d-flex align-items-center" style="font-size: 22px !important;padding: 1rem 1.35rem;margin-top: -14px;" href="#" role="button">Nuestros servicios
              <i style="color: white; font-size: 30px!important; margin-left: 48px;" class="material-icons">arrow_forward</i>
            </a>
          </div>
        </div>


      </div>
    </div>
    <div class="carousel-item">
      <img class="third-slide" src="img/tbl/sobredimensionado.png" alt="Third slide">
      <div class="row titleCarousel">
        <div class="container d-flex">
          <div class="titleServices1">
            <h1 class="text-center">Transporte a todo Chile</h1>
          </div>
          <div onclick="goToServices()" class="titleServices2">
            <a class="btn btn-lg btn-primary d-flex align-items-center" style="font-size: 22px !important;padding: 1rem 1.35rem;margin-top: -14px;" href="#" role="button">Nuestros servicios
              <i style="color: white; font-size: 30px!important; margin-left: 48px;" class="material-icons">arrow_forward</i>
            </a>
          </div>
        </div>


      </div>
      <div class="container" style="display: none;">

      </div>
    </div>

    <div class="carousel-item">
      <img class="third-slide" src="img/tbl/transporte.png" alt="Third slide">
      <div class="row titleCarousel">
        <div class="container d-flex">
          <div class="titleServices1">
            <h1 class="text-center">Transporte de cargas especial</h1>
          </div>
          <div onclick="goToServices()" class="titleServices2">
            <a class="btn btn-lg btn-primary d-flex align-items-center" style="font-size: 22px !important;padding: 1rem 1.35rem;margin-top: -14px;" href="#" role="button">Nuestros servicios
              <i style="color: white; font-size: 30px!important; margin-left: 48px;" class="material-icons">arrow_forward</i>
            </a>
          </div>
        </div>


      </div>
      <div class="container" style="display: none;">

      </div>
    </div>

  </div>
  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
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

<section class="traslados">

  <div class="carousel">
    <div class="titles">
      <div class="title" onclick="showSlide(0)"><strong>Transporte sobre dimensionado y sobre contenedores</strong></div>
      <div class="title" onclick="showSlide(1)"><strong>Transporte de cargas especiales</strong></div>
      <div class="title" onclick="showSlide(2)">Transporte maquinaria y equipos forestales</div>
      <div class="title" onclick="showSlide(2)">Transporte y rescate equipos siniestrados</div>
      <div class="title" onclick="showSlide(2)">Transporte de maquinaria menor y rescate de vehículos</div>
      <div class="title" onclick="showSlide(2)">Servicios de Izaje</div>
      <div class="title" onclick="showSlide(2)">Arriendos nuestros equipos</div>
    </div>
    <div class="indicators">
      <span class="indicator" onclick="showSlide(0)"></span>
      <span class="indicator" onclick="showSlide(1)"></span>
      <span class="indicator" onclick="showSlide(2)"></span>
    </div>
    <div class="photos">
      <div class="photo">
        <img src="/img/tbl/sobredimensionado.png" alt="Photo 1">
      </div>
      <div class="photo">
        <img src="/img/tbl/transporte.png" alt="Photo 2">
      </div>
      <div class="photo">
        <img src="/img/tbl/transporte.png" alt="Photo 3">
      </div>
    </div>
  </div>

</section>

<section class="indicadores py-5 bgIndicadores">
  <div class="container ">

  <div class="indicators-container">
  <div class="indicator" id="indicator-accidentes">
    <div class="value-container" data-start="0" data-end="0">0</div>
    <div class="title">Accidentes</div>
  </div>
  <div class="indicator" id="indicator-km">
    <div class="value-container">
      <span>+</span><div class="value" data-start="0" data-end="3">3</div><span> Millones</span>
    </div>
    <div class="title">de km recorridos</div>
  </div>
  <div class="indicator" id="indicator-clientes">
    <div class="value-container">
      <span>+</span><div class="value" data-start="0" data-end="790">790</div>
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


<script>
  let currentSlide = 0;

  function showSlide(index) {
    const photos = document.querySelectorAll('.photo');
    const indicators = document.querySelectorAll('.indicator');
    const titles = document.querySelectorAll('.title');

    // Esconde la foto actual y remueve la clase activa de los indicadores y títulos
    photos[currentSlide].style.display = 'none';
    indicators[currentSlide].classList.remove('active');
    titles[currentSlide].classList.remove('active');

    // Actualiza el índice de la diapositiva actual
    currentSlide = index;

    // Muestra la nueva foto y añade la clase activa a los indicadores y títulos correspondientes
    photos[currentSlide].style.display = 'block';
    indicators[currentSlide].classList.add('active');
    titles[currentSlide].classList.add('active');
  }

  // Inicializa el carrusel
  document.addEventListener('DOMContentLoaded', () => {
    showSlide(0); // Muestra la primera diapositiva

    // Configura el intervalo para cambiar la diapositiva cada 2 segundos
    setInterval(() => {
      const nextSlide = (currentSlide + 1) % document.querySelectorAll('.photo').length;
      showSlide(nextSlide);
    }, 2000); // Cambia cada 2 segundos (2000 ms)
  });

  function goToServices() {
    const element = document.querySelector('.traslados');
    const yOffset = -120; // Ajusta esto a la cantidad de píxeles que quieras desplazar hacia arriba
    const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;

    window.scrollTo({
      top: y,
      behavior: 'smooth'
    });
  }

</script>