@extends('tbl.plantilla')

@section('content')

<section class="welcome-servicios">
  <div class="bg_izaje">

  </div>
  <div>
    <div class="container">
      <div class="row py-5">
        <div id="welcomeTitle" class="col-lg-6 pt-5 pr-5 presentacionServicio">
          <h2>
          Servicios de Izaje
          </h2>
          <p><br></p>
          <p>
            La precisión en cada carga y descarga de equipos pesados ​​y sobredimensionados es la clave en todas nuestras operaciones especiales.
          </p>
          <p>
            Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500.
          </p>
          <p class="pt-3">
            <a href="#" class="btn btn-secondary d-flex align-items-center" style="width: 155px;">Quiero cotizar </a>
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

    <div class="row">
      <div class="col-md-4">
        <div class="gallery-item">
          <img src="/img/tbl/services/sobredimensionado_1.png" class="img-fluid">
        </div>
      </div>
      <div class="col-md-4">
        <div class="gallery-item">
          <img src="/img/tbl/services/sobredimensionado_1.png" class="img-fluid">
        </div>
      </div>
      <div class="col-md-4">
        <div class="gallery-item">
          <img src="/img/tbl/services/sobredimensionado_1.png" class="img-fluid">
        </div>
      </div>
      <!-- Agrega más columnas según la cantidad de imágenes que tengas -->
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

@include('tbl.include.footer')

<script>
  setTimeout(() => {
    const miDiv = document.getElementById('welcomeTitle');
    if (miDiv) {
      miDiv.classList.remove('presentacionServicio');
    }
  }, 1000);

  // Agregar las clases ceroR y animate después de 5.5 segundos
  setTimeout(() => {
    const miDiv = document.getElementById('welcomeTitle');
    if (miDiv) {
      miDiv.classList.add('ceroR');
      miDiv.classList.add('animate');

    }
  }, 1500);
</script>
<script>
  let inicio = new Vue({
    el: '#vueInicio',
    data: {
      animationTriggered: {},
      elements: []
    },
    mounted() {
      this.updateElements();
      window.addEventListener('scroll', this.handleScroll);
    },
    methods: {
      updateElements() {
        this.elements = document.querySelectorAll('.ceroR');
        this.elements.forEach(element => {
          this.checkAnimation(element);
        });
      },
      checkAnimation(element) {
        const rect = element.getBoundingClientRect();
        const windowHeight = window.innerHeight || document.documentElement.clientHeight;
        if (rect.top <= windowHeight && rect.bottom >= 0) {
          if (!this.animationTriggered[element]) {
            element.classList.add('animate');
            this.animationTriggered[element] = true;
          }
        } else {
          this.animationTriggered[element] = false;
          element.classList.remove('animate');
        }
      },
      handleScroll() {
        this.elements.forEach(element => {
          this.checkAnimation(element);
        });
      },
    }
  });
</script>
@endsection