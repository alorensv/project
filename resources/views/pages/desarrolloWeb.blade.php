@extends('plantilla')

@section('slide')
<section class="portada_web">
  <img src="img/software/software.jpg">
</section>
@endsection

@section('content')
<div class="container marketing">

<div class="col-md-12">
    <div class="texto-cotiza">
      <h2 class="featurette-heading">Cotiza tu Sistema Web <span class="text-muted">con Nosotros</span><i class="bi bi-chevron-right"></i></h2>
    </div>
  </div>

  <div class="row">

    <div class="col-lg-4">
      <img class="rounded-circle" src="img/web/facil_uso.jpg" alt="Generic placeholder image" width="140" height="140">
      <h2>Modulares</h2>
      <p>Comenzar con un solo módulo de un software te puede ayudar a resolver muchos problemas. Cotiza un módulo específico con la información que requieres controlar y procesar y obtén resultados de inmediato.</p>
      <!--<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>-->
    </div><!-- /.col-lg-4 -->

    <div class="col-lg-4">
      <img class="rounded-circle" src="img/web/autoadministrable.jpg" alt="Generic placeholder image" width="140" height="140">
      <h2>Escalables</h2>
      <p>Cotizaste 1 módulo y ahora quieres incrementar el sistema?, cotiza un nuevo módulo y aprovecha la escalabilidad de nuestra metodología de trabajo. Cotiza lo que necesites urgente y beneficaté de inmediato.</p>
    </div><!-- /.col-lg-4 -->

    <div class="col-lg-4">
      <img class="rounded-circle" src="img/web/responsivo.jpg" alt="Generic placeholder image" width="140" height="140">
      <h2>Responsivos</h2>
      <p>Consulta, registra y actualiza tus sistemas y/o módulos por medio un ordenador, notebook, tablet y/o celular, podrás controlar la información que requieres siempre disponible y de inmediato!</p>
    </div><!-- /.col-lg-4 -->

    <div class="col-lg-4">
      <img class="rounded-circle" src="img/web/amigable.jpg" alt="Generic placeholder image" width="140" height="140">
      <h2>Fácil uso</h2>
      <p>Navegación intuitiva en el sistema te evitará estar consultando videos tutoriales y/o manuales para recordar como realizar ciertas tareas. Nuestro objetivo es entregar un sistema de fácil uso y con grandes resultados.</p>
    </div><!-- /.col-lg-4 -->

  
    <div class="col-lg-4">
      <img class="rounded-circle" src="img/software/exportable.jpg" alt="Generic placeholder image" width="140" height="140">
      <h2>Exporabilidad</h2>
      <p>Todos los datos que ingresen al sistema podrán ser exportarlos en Excel para trabajo individual, podrás generar reportabilidad y compartir seguimientos e indicadores.</p>
    </div><!-- /.col-lg-4 -->

    <div class="col-lg-4">
      <img class="rounded-circle" src="img/web/asesoria.jpg" alt="Generic placeholder image" width="140" height="140">
      <h2>Soporte</h2>
      <p>No te abandonaremos, creceremos juntos y siempre tendrás a Líneas de Código SPA como tu patner informático para mejoras o nuevas ideas que desees implementar.</p>
    </div><!-- /.col-lg-4 -->

  </div><!-- /.row -->

</div><!-- /.container -->

<section class="portafolio py-4">
<!-- PORTAFOLIO --> 
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