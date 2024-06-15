@extends('tbl.plantilla')

@section('slide')


<div id="myCarousel" class="carousel slide" data-ride="carousel" style="padding-bottom: 0px !important;margin-top: 2%;">
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
        <div class="col-lg-6 pt16 pb16">
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

<section class="clientes">
  <div class="container">
    <!-- <div class="texto-clientes">
      <h2 class="featurette-heading">Clientes que <span class="text-muted">confían en Nosotros</span><i class="bi bi-chevron-right"></i></h2>
    </div>

    <div class="row">
      <div class="col-md-12 py-3">
        <div class="owl-carousel-clientes owl-carousel owl-theme">
          <div class="item"><img src="img/clientes/fiscalia.png"></div>
          <div class="item"><img src="img/clientes/fullmedical.png"></div>
          <div class="item"><img src="img/clientes/netcook.png"></div>
          <div class="item"><img src="img/clientes/holman.png"></div>
          <div class="item"><img src="img/clientes/tbl.png"></div>
          <div class="item"><img src="img/clientes/dv.png"></div>
          <div class="item"><img src="img/clientes/segurosncs.png"></div>
          <div class="item"><img src="img/clientes/pyp.png"></div>
        </div>
      </div>

    </div> -->

  </div>
</section>

<section class="cotiza">
  <div class="container">
 
    <hr class="featurette-divider">
  </div>
</section>


<section class="portafolio py-4">
  <div class="container">
    <div class="row featurette">
      <div class="col-md-6">
 


      </div>
      <div class="col-md-6 py-4">





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

    photos[currentSlide].style.display = 'none';
    indicators[currentSlide].classList.remove('active');

    currentSlide = index;

    photos[currentSlide].style.display = 'block';
    indicators[currentSlide].classList.add('active');
  }

  // Inicializa el carrusel
  document.addEventListener('DOMContentLoaded', () => {
    showSlide(0);
  });



  function goToServices(){
    const element = document.querySelector('.traslados');
    const yOffset = -120; // Ajusta esto a la cantidad de píxeles que quieras desplazar hacia arriba
    const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;

    window.scrollTo({ top: y, behavior: 'smooth' });
  }

</script>