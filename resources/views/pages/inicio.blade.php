@extends('plantilla')

@section('slide')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li><!-- 
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li> -->
  </ol>
  <div class="carousel-inner">
    <!-- <div class="carousel-item active">
            <img class="first-slide" src="img/bg.jpg" alt="First slide">
            <div class="container">
              <div class="carousel-caption text-left">
                <h1>Diseño Web.</h1>
                <p>Comienza tu presencia digital con una página web escalable y presenta tus productos y/o servicios a cientos de personas.</p>
                <p><a class="btn btn-lg btn-primary" href="pagina_web.php" role="button">Ver más</a></p>
              </div>
            </div>
          </div> -->
    <div class="carousel-item active">
      <img class="second-slide" src="img/bg_sw.jpg" alt="Second slide">
      <div class="container">
        <div class="carousel-caption" style="top: 20%;">
          <div class="row">
            <div class="col-md-6">
              <h1 class="text-left">Diseño y desarrollo de plataformas web</h1>
              <p class="text-left">Inicia tu presencia digital con una página web escalable.<br> Presenta tus productos, administra ventas, realiza cotizaciones y obtén reportes de manera rápida y accesible.</p>
              <div class="row">
                <a class="btn btn-lg btn-primary d-flex align-items-center mr-3" href="#" role="button">Diseño web
                  <i style="color: white; font-size: 35px!important; margin-left: 5px;" class="material-icons">arrow_forward</i>
                </a>
                <a class="btn btn-lg btn-primary d-flex align-items-center" href="#" role="button">Desarrollo a medida
                  <i style="color: white; font-size: 35px!important; margin-left: 5px;" class="material-icons">arrow_forward</i>
                </a>
              </div>
            </div>
            <div class="col-md-6">
              <img src="img/web/diseñoweb.jpg" alt="" class="img-fluid">
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- <div class="carousel-item">
            <img class="third-slide" src="img/administracion_web.jpeg" alt="Third slide">
            <div class="container">
              <div class="carousel-caption text-right">
                <h1>Administración Web.</h1>
                <p>Dedida tu tiempo a tu negocio, nosotros administramos tu presencia digital.</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Ver más</a></p>
              </div>
            </div>
          </div> -->
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
<section class="clientes">
  <div class="container">
    <div class="texto-clientes">
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

    </div>

  </div>
</section>

<section class="cotiza">
  <div class="container">
    <div class="row featurette">
      <div class="col-md-12">
        <div class="texto-cotiza">
          <h2 class="featurette-heading">Cotiza tu proyecto <span class="text-muted">con Nosotros</span><i class="bi bi-chevron-right"></i></h2>
        </div>
      </div>

      <div class="col-md-7">

        <h4 class="featurette">Diseño <span class="text-muted">Web</span><i class="bi bi-chevron-right"></i></h4>
        <p class="lead mb-4 text-justify">Realizamos páginas web que generan una gran experiencia de usuario, desarrollando sitios adaptables a computadores de escritorio, tablet, notebook y celulares para que sus clientes puedan revisar toda la información de la mejor manera.</p>
        <p class="lead text-justify">Una experiencia positiva transforma usuarios en clientes recurrentes.</p>

        <h4 class="featurette">Desarrollo <span class="text-muted">Software</span><i class="bi bi-chevron-right"></i></h4>
        <p class="lead mb-4 text-justify">Nuestro conocimiento en usabilidad nos permite generar aplicaciones web más fáciles de usar y de intuitivo aprendizaje, generando una mayor satisfacción a nuestros clientes y disminuyendo problemas relacionados con el soporte y capacitación.</p>

      </div>
      <div class="col-md-5" style="padding-top: 15px;padding-bottom: 15px;color: white;">

        <section class="shadow-lg" style=" background-color: #262626;border-radius: 10px;" id="contacto">
          <form action="{{route('enviarEmail')}}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="text-center">
                  <h4>Contáctanos</h4>
                </div>

                @if (session('info'))
                <div class="status alert alert-success">{{session('info')}}</div>
                @endif

                <div class="form-group">
                  <input type="text" id="name" name="name" class="form-control" required="required" placeholder="Nombre">
                </div>
                @error('name')
                <p class="">{{$message}}</p>
                @enderror
                <div class="form-group">
                  <input type="email" id="email" name="email" class="form-control" required="required" placeholder="Correo">
                </div>
                @error('email')
                <p class="">{{$message}}</p>
                @enderror
                <div class="form-group">
                  <input type="number" id="fono" name="fono" class="form-control" placeholder="Teléfono">
                </div>
                <div class="form-group">
                  <textarea name="message" id="message" required="required" class="form-control" rows="4" placeholder="Consultas"></textarea>
                </div>
                @error('message')
                <p class="">{{$message}}</p>
                @enderror
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-light btn-lg" required="required" onClick="enviarmail()">Enviar</button>
                </div>

              </div><!--/.col-md-12-->

            </div><!--/.row-->
          </form>
        </section>

      </div><!--/#fin div contacto-page-->
    </div>
    <hr class="featurette-divider">
  </div>
</section>


<section class="portafolio py-4">
  <div class="container">
    <div class="row featurette">
      <div class="col-md-6">
        <h2 class="featurette-heading">Nuestro trabajo <span class="text-muted"> nos valida.</span></h2>
        <p class="lead text-justify">Nos especializamos en diseño de páginas web y sistemas web fáciles de usar y accesibles que generan rentabilidad, mejora en procesos y muchisimos datos para tomar las mejores decisiones en su negocio.</p>
        
        <div id="counter" class="row counter-style" style="width: 90%;">
          <div class="col-md-4 box" style="border-right: 1px solid #ccc;">
            <b class="counter-value" data-count="8">8</b>
            <span>Años de experiencia</span>
          </div>
          <div class="col-md-4 box" style="border-right: 1px solid #ccc;">
            <b class="counter-value" data-count="50">+50</b>
            <span>Proyectos realizados</span>
          </div>
          <div class="col-md-4 box">
            <b class="counter-value" data-count="99999">+100000</b>
            <span>Líneas de código</span>
          </div>
        </div>
        
        <a href="{{route('portafolio')}}">
          <h2 class="featurette-heading">Revisa nuestro <span class="text-muted"><br> Portafolio<i class="bi bi-chevron-right"></i></span></h2>
        </a>



      </div>
      <div class="col-md-6 py-4">


        <!--<img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image">-->
        <div class="owl-carousel owl-theme">
          <div class="item"><img src="img/trabajos/transportesbulnes.jpg"></div>
          <div class="item"><img src="img/trabajos/decoraciones.jpg"></div>
          <div class="item"><img src="img/trabajos/holmanortiz.jpg"></div>
          <div class="item"><img src="img/trabajos/pypconsulting.jpg"></div>
          <div class="item"><img src="img/trabajos/seguros.jpg"></div>
          <div class="item"><img src="img/trabajos/amagi.jpg"></div>
        </div>


      </div>
    </div>
  </div>
</section>

@include('include.convenioMarco')
@endsection