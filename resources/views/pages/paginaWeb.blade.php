@extends('plantilla')

@section('slide')
<section class="portada_web">
   <img src="img/web/webs.jpg">
</section>
@endsection

@section('content')
<div class="container marketing">

<div class="col-md-12">
    <div class="texto-cotiza">
      <h2 class="featurette-heading">Cotiza tu Página Web <span class="text-muted">con Nosotros</span><i class="bi bi-chevron-right"></i></h2>
    </div>
  </div>


<!-- Three columns of text below the carousel -->
<div class="row">

  <div class="col-lg-4">
    <img class="rounded-circle" src="img/web/facil_uso.jpg" alt="Generic placeholder image" width="140" height="140">
    <h2>Landing Page</h2>
    <p>Páginas web de fácil uso enfocado en productos y/o servicios, dirigendo al usuario exclusivamente a la información destacada evitando generar demasiado contenido para el usuario.</p>
    <!--<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>-->
  </div><!-- /.col-lg-4 -->

  <div class="col-lg-4">
    <img class="rounded-circle" src="img/web/autoadministrable.jpg" alt="Generic placeholder image" width="140" height="140">
    <h2>Escalables</h2>
    <p>Comienza con una página web estática y la posibilidad de escalar a una página web con administración y finalmente a un sistema modular que te apoye en el control y toma de decisiones!</p>
  </div><!-- /.col-lg-4 -->

  <div class="col-lg-4">
    <img class="rounded-circle" src="img/web/responsivo.jpg" alt="Generic placeholder image" width="140" height="140">
    <h2>Sitios web responsivos</h2>
    <p>Dar la alternativa de visitar tu página web por un ordenador, notebook, tablet y/o celular, aumentará las posibilidad de captar clientes mejorando la experiencia del usuario.</p>
  </div><!-- /.col-lg-4 -->
  
  <div class="col-lg-4">
    <img class="rounded-circle" src="img/web/ux.jpg" alt="Generic placeholder image" width="140" height="140">
    <h2>Experiencia de Usuario</h2>
    <p>Un cliente con buena experiencia en tu página web, consultará toda la información que le entregues, volverá a tu página web y recomendará su visita a sus redes.</p>
  </div><!-- /.col-lg-4 -->

  <div class="col-lg-4">
    <img class="rounded-circle" src="img/web/amigable.jpg" alt="Generic placeholder image" width="140" height="140">
    <h2>Dinámicos y amigables</h2>
    <p>Generar un poco de movimiento, actualizaciones constantes y claridad en la información entregará la confianza suficiente para lograr captar un nuevo cliente.</p>
  </div><!-- /.col-lg-4 -->


  <div class="col-lg-4">
    <img class="rounded-circle" src="img/web/asesoria.jpg" alt="Generic placeholder image" width="140" height="140">
    <h2>Asesoría constante</h2>
    <p>No te abandonaremos, creceremos juntos y siempre tendrás a Líneas de Código SPA como tu patner informático para mejoras o nuevas ideas que desees implementar.</p>
  </div><!-- /.col-lg-4 -->

</div><!-- /.row -->

</div><!-- /.container -->

<section class="portafolio py-4">
<!-- START THE FEATURETTES --> 
<div class="container"> 
  <div class="row featurette">
    <div class="col-md-6">
      <h2 class="featurette-heading">Nuestro trabajo <span class="text-muted"> nos valida.</span></h2>
      <p class="lead text-justify">Nos especializamos en diseño de páginas web y sistemas web fáciles de usar y accesibles que generan rentabilidad, mejora en procesos y muchisimos datos para tomar las mejores decisiones en su negocio..</p>
      <a href="{{route('portafolio')}}" ><h2 class="featurette-heading">Revisa nuestro <span class="text-muted"><br> Portafolio<i class="bi bi-chevron-right"></i></span></h2></a>
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
<!-- /END THE FEATURETTES -->
</section>


<div class="container" style="padding-bottom: 40px;">
<div class="row featurette"> 
  <div class="col-md-12">
    <div class="texto-cotiza">
      <h2 class="featurette-heading">Cotiza tu proyecto <span class="text-muted">con Nosotros</span><i class="bi bi-chevron-right"></i></h2>
    </div>
  </div> 
</div>

@include('include.formularioContacto')

</div>
@endsection