@extends('tbl.plantilla')

@section('content')

<section class="sobre_tbl ">
  <div class="bg_transportesbulnes">

  </div>
  <div>
    <div class="container section-phone-padding">
      <div class="row py-5">
        <div id="welcomeTitle" class="col-lg-6 pt-5 pr-5 presentacionServicio">
          <h2>
            Transportes Bulnes Limitada
          </h2>
          <p><br></p>
          <p>
            Empresa especializada en servicios de traslado de máquinas y equipos, contenedores y carga en general, con profesionales y operadores de gran experiencia para entregar soluciones profesionales y servicios más integrales.
          </p>
          <p>
            Nuestros principales valores son entregar un precio justo, profesionalismo en el servicio y puntualidad.
          </p>
          <p>
          <strong>Preparados para nuevos desafíos logisticos y de transportes, somos un real aporte.</strong>
          </p>
        </div>
        <div class="col-6">

        </div>
      </div>
    </div>
  </div>

</section>

<section class="mision-vision section-phone-padding">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center logoGrande">
        <img src="/img/tbl/logo2.png" alt="" style="width: 50%;">
      </div>
      <div class="col-lg-6 pt-5 pb-5 text-justify ceroR">
        <h2 class="pt-3" style="color: white;">
        MISIÓN
        </h2>
        <p><br></p>
        <p>
        Transportes Bulnes Limitada tiene como misión diferenciarse de sus competidores prestando servicios con valores justos, servicios profesionales y puntualidad.
        </p>
        <h2 class="pt-5" style="color: white;">
        VISIÓN
        </h2>
        <p>
        Transportes Bulnes Limitada tiene como Visión llegar a ser un actor relevante en los servicios relacionados al traslado de máquinas y equipos, contenedores y carga en general para todo Chile.
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