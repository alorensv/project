@extends('tbl.plantilla')

@section('content')

<section class="welcome-servicios">
  <div class="bg_sobredimensionados">

  </div>
  <div>
    <div class="container">
      <div class="row py-5">
        <div id="welcomeTitle" class="col-lg-6 pt-5 pr-5 presentacionServicio">
          <h2>
            Transporte sobre dimensionado
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
    <div class="services_gallery-container">
      <div class="services_gallery-inner">
        <div class="services_gallery-item">
          <img src="/img/tbl/services/sobredimensionado_1.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/sobredimensionado_2.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/sobredimensionado_3.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/sobredimensionado_3.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/sobredimensionado_3.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/sobredimensionado_3.png" class="img-fluid">
        </div>
        <div class="services_gallery-item">
          <img src="/img/tbl/services/sobredimensionado_3.png" class="img-fluid">
        </div>
        <!-- Agrega más columnas según la cantidad de imágenes que tengas -->
      </div>
    </div>
  </div>
</section>

@include('tbl.include.trabaja_con_nosotros')

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
      elements: [],
      currentSlide: 0
    },
    mounted() {
      this.updateElements();
      window.addEventListener('scroll', this.handleScroll);
      this.startCarousel();
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
      startCarousel() {
        const galleryInner = document.querySelector('.services_gallery-inner');
        const items = document.querySelectorAll('.services_gallery-item');
        const itemCount = items.length;

        setInterval(() => {
          this.currentSlide = (this.currentSlide + 1) % itemCount;
          const offset = this.currentSlide * items[0].clientWidth;
          galleryInner.style.transform = `translateX(-${offset}px)`;
        }, 3000);
      }
    }
  });
</script>

@endsection