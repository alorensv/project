@extends('tbl.plantilla')

@include('tbl.include.cotiza')

@section('slide')
@include('tbl.include.slide')
@endsection

@section('content')

<div id="vueInicio">
  <section class="welcome">
    <div>
      <div class="container">
        <div class="row py-5">
          <div class="col-lg-6 pt16 pb16 ceroR">
            <h2 class="escribiendo ceroR">
              Transportes Bulnes Limitada
            </h2>
            <p><br></p>
            <p class="ceroR">
              Constituida como empresa el año 2011, actualmente contamos con más de <strong>11 años de antiguedad y experiencia en el mercado.</strong> Nos especializamos en el traslado de carga sobredimensionada como maquinarias, equipos, contenedores y carga en general por todo Chile.
            </p>
            <p>
              Disponemos de profesionales calificados y operadores certificados con experiencia para entregar servicios de calidad, cumpliendo con los estándares de seguridad y puntualidad.
            </p>
            <p>
              <a href="#" class="btn btn-primary d-flex align-items-center" style="width: 180px;">¡Conócenos más!</a>
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

  <section id="traslados" class="traslados">
      <div class="carousel">
        <div class="titles">
          <div class="title" @click="showSlide(0)" :class="{ active: currentServices === 0 }"><strong>Transporte sobre dimensionado y sobre contenedores</strong></div>
          <div class="title" @click="showSlide(1)" :class="{ active: currentServices === 1 }"><strong>Transporte de cargas especiales</strong></div>
          <div class="title" @click="showSlide(2)" :class="{ active: currentServices === 2 }">Transporte maquinaria y equipos forestales</div>
          <div class="title" @click="showSlide(3)" :class="{ active: currentServices === 3 }">Transporte y rescate equipos siniestrados</div>
          <div class="title" @click="showSlide(4)" :class="{ active: currentServices === 4 }">Transporte de maquinaria menor y rescate de vehículos</div>
          <div class="title" @click="showSlide(5)" :class="{ active: currentServices === 5 }">Servicios de Izaje</div>
          <div class="title" @click="showSlide(6)" :class="{ active: currentServices === 6 }">Arriendos nuestros equipos</div>
        </div>
        <div class="indicators">
          <span class="indicator" @click="showSlide(0)" :class="{ active: currentServices === 0 }"></span>
          <span class="indicator" @click="showSlide(1)" :class="{ active: currentServices === 1 }"></span>
          <span class="indicator" @click="showSlide(2)" :class="{ active: currentServices === 2 }"></span>
          <span class="indicator" @click="showSlide(3)" :class="{ active: currentServices === 3 }"></span>
          <span class="indicator" @click="showSlide(4)" :class="{ active: currentServices === 4 }"></span>
          <span class="indicator" @click="showSlide(5)" :class="{ active: currentServices === 5 }"></span>
          <span class="indicator" @click="showSlide(6)" :class="{ active: currentServices === 6 }"></span>
        </div>
        <div class="photos">
          <div class="photo" v-for="(item, index) in servicesItems" :key="index" :class="{ active: currentServices === index }">
            <div style="position: absolute;left: 30%;top: 80%;width: 350px;">
            <a :href="item.url" class="w-100 btn btn-primary btn-lg">
              <h5 style="padding-top: 10px;">¡Conoce más sobre este servicio!</h5></a>
            </div>  
            <img :src="item.image" :alt="item.alt">
            
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

  @include('tbl.include.footer')
</div>

<script>
  let inicio = new Vue({
    el: '#vueInicio',
    data: {
      animationTriggered: {},
      elements: [],
      currentServices: 0,
        servicesItems: [
          {
            image: 'img/tbl/sobredimensionado.png',
            alt: 'Transporte sobre dimensionado y sobre contenedores',
            url: '/servicio_sobredimensionado'
          },
          {
            image: 'img/tbl/transporte.png',
            alt: 'Transporte de cargas especiales',
            url: '/servicio_cargas_especiales'
          },
          {
            image: 'img/tbl/transporte.png',
            alt: 'Transporte maquinaria y equipos forestales',
            url: '/servicio_cargas_especiales'
          },
          {
            image: 'img/tbl/transporte.png',
            alt: 'Transporte y rescate equipos siniestrados',
            url: '/servicio_cargas_especiales'
          },
          {
            image: 'img/tbl/transporte.png',
            alt: 'Transporte de maquinaria menor y rescate de vehículos',
            url: '/servicio_cargas_especiales'
          },
          {
            image: 'img/tbl/transporte.png',
            alt: 'Servicios de Izaje',
            url: '/servicio_cargas_especiales'
          },
          {
            image: 'img/tbl/transporte.png',
            alt: 'Arriendos nuestros equipos',
            url: '/servicio_cargas_especiales'
          }
        ],
        intervalId: null
    },
    mounted() {
      this.updateElements();
      this.showSlide(0);
      window.addEventListener('scroll', this.handleScroll);
    },
    methods: {
      showAlert(index) {
          console.log('Mostrando alerta para el índice:', index);
          alert('Hola'); // Muestra un alert con el mensaje 'Hola'
        },
        showSlide(index) {
          // Detener el intervalo para no cambiar la diapositiva automáticamente mientras el usuario interactúa
          clearInterval(this.intervalId);

          // Ocultar la diapositiva actual y quitar la clase activa de los indicadores y títulos
          const photos = document.querySelectorAll('.photo');
          const indicators = document.querySelectorAll('.indicator');
          const titles = document.querySelectorAll('.title');

          photos[this.currentServices].classList.remove('active');
          indicators[this.currentServices].classList.remove('active');
          titles[this.currentServices].classList.remove('active');

          // Mostrar la nueva diapositiva y añadir la clase activa a los indicadores y títulos correspondientes
          photos[index].classList.add('active');
          indicators[index].classList.add('active');
          titles[index].classList.add('active');

          // Actualizar el índice de la diapositiva actual
          this.currentServices = index;

          // Reiniciar el intervalo para cambiar la diapositiva automáticamente después de 2 segundos
          this.intervalId = setInterval(() => {
            const nextSlide = (this.currentServices + 1) % this.servicesItems.length;
            this.showSlide(nextSlide);
          }, 2000);
        },
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