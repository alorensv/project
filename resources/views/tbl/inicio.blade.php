@extends('tbl.plantilla')

@section('slide')
@include('tbl.include.slide')
@endsection

@section('content')

<div id="vueInicio">
  <section class="welcome">
    <div>
      <div class="container section-phone-padding">
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
              <a href="/transportes_bulnes" class="btn btn-primary d-flex align-items-center" style="width: 180px;">¡Conócenos más!</a>
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

  <section id="traslados_celular" class="traslados_celular">

    <div class="container section-phone-padding">
      <h2 class="escribiendo ceroR animate pt-5 text-center" style="color: white;">
        ¡Conoce nuestros servicios!
      </h2>
    </div>


    <div class="swiffy-slider">
      <ul class="slider-container">
        <li>
          <div class="card" style="max-width: 100%;height: auto;">
            <img src="/img/tbl/services/sobredimensionado_1.png" class="img-fluid" alt="Transporte sobre dimensionado">
            <div class="card-body text-center">
              <h5 class="card-title"><strong>Transporte sobre dimensionado</strong></h5>
              <a href="/servicio_sobredimensionado" class="btn btn-primary">¡Conoce más sobre este servicio!</a>
            </div>
          </div>
        </li>

        <li>
          <div class="card" style="max-width: 100%;height: auto;">
            <img src="/img/tbl/services/carga_especial_0.png" class="img-fluid" alt="Transporte sobre dimensionado">
            <div class="card-body text-center">
              <h5 class="card-title"><strong>Transporte de cargas especiales</strong></h5>
              <a href="/servicio_cargas_especiales" class="btn btn-primary">¡Conoce más sobre este servicio!</a>
            </div>
          </div>
        </li>

        <li>
          <div class="card" style="max-width: 100%;height: auto;">
            <img src="/img/tbl/services/maquinaria_forestal_0.png" class="img-fluid" alt="Transporte sobre dimensionado">
            <div class="card-body text-center">
              <h5 class="card-title"><strong>Transporte de equipos forestales</strong></h5>
              <a href="/transporte_equipos_forestales" class="btn btn-primary">¡Conoce más sobre este servicio!</a>
            </div>
          </div>
        </li>

        <li>
          <div class="card" style="max-width: 100%;height: auto;">
            <img src="/img/tbl/services/rescate_0.png" class="img-fluid" alt="Transporte sobre dimensionado">
            <div class="card-body text-center">
              <h5 class="card-title"><strong>Transporte y rescate equipos siniestrados</strong></h5>
              <a href="/rescate_equipos_siniestrados" class="btn btn-primary">¡Conoce más sobre este servicio!</a>
            </div>
          </div>
        </li>

        <li>
          <div class="card" style="max-width: 100%;height: auto;">
            <img src="/img/tbl/services/maquinaria_menor.png" class="img-fluid" alt="Transporte sobre dimensionado">
            <div class="card-body text-center">
              <h5 class="card-title"><strong>Transporte de maquinaria</strong></h5>
              <a href="/transporte_maquinaria" class="btn btn-primary">¡Conoce más sobre este servicio!</a>
            </div>
          </div>
        </li>

        <li>
          <div class="card" style="max-width: 100%;height: auto;">
            <img src="/img/tbl/services/izaje.png" class="img-fluid" alt="Transporte sobre dimensionado">
            <div class="card-body text-center">
              <h5 class="card-title"><strong>Servicios de Izaje</strong></h5>
              <a href="/servicios_izajes" class="btn btn-primary">¡Conoce más sobre este servicio!</a>
            </div>
          </div>
        </li>

        <li>
          <div class="card" style="max-width: 100%;height: auto;">
            <img src="/img/tbl/services/arriendo_equipos.png" class="img-fluid" alt="Transporte sobre dimensionado">
            <div class="card-body text-center">
              <h5 class="card-title"><strong>Arriendos de nuestros equipos</strong></h5>
              <a href="/equipos" class="btn btn-primary">¡Conoce más sobre este servicio!</a>
            </div>
          </div>
        </li>


      </ul>

      <button type="button" class="slider-nav"></button>
      <button type="button" class="slider-nav slider-nav-next"></button>

      <div class="slider-indicators">
        <button class="active"></button>
        <button></button>
        <button></button>
      </div>
    </div>

  </section>


  <section id="traslados" class="traslados">
    <div class="carousel">
      <div class="titles">
        <div class="title" @click="showSlide(0)" :class="{ active: currentServices === 0 }"><strong>Transporte sobre dimensionado</strong></div>
        <div class="title" @click="showSlide(1)" :class="{ active: currentServices === 1 }"><strong>Transporte de cargas especiales</strong></div>
        <div class="title" @click="showSlide(2)" :class="{ active: currentServices === 2 }">Transporte de equipos forestales</div>
        <div class="title" @click="showSlide(3)" :class="{ active: currentServices === 3 }">Transporte y rescate equipos siniestrados</div>
        <div class="title" @click="showSlide(4)" :class="{ active: currentServices === 4 }">Transporte de maquinaria</div>
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
              <h5 style="padding-top: 10px;">¡Conoce más sobre este servicio!</h5>
            </a>
          </div>
          <img :src="item.image" :alt="item.alt">

        </div>
      </div>
    </div>
  </section>

  <section class="indicadores py-5 bgIndicadores">
    <div class="container">
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


  @include('tbl.include.trabaja_con_nosotros')

  <footer id="footerVue" style="background-color: white!important;">
  <div class="container section-phone-padding">
    <div class="row ">
      <div class="col-md-4 logo-footer ">
        <h3 class="">Cantidad de visitas: @{{parseInt(total).toLocaleString('es-CL')}}</h3>
        <a class="d-flex align-items-center custom-link" target="_blank" href="https://www.meteochile.gob.cl/PortalDMC-web/index.xhtml" ><span class="material-icons icon">cloud</span><h3 class="mt-2 ml-2"> Consultar el clima</h3></a>
        <a class="d-flex align-items-center custom-link" target="_blank" href="https://www.bcentral.cl/web/banco-central" ><span class="material-icons icon">trending_up</span><h3 class="mt-2 ml-2"> Consultar indicadores económicos</h3></a>
        <a class="d-flex align-items-center custom-link" target="_blank" href="https://sitios.cl/servicios/distancias.htm" ><span class="material-icons icon">place</span><h3 class="mt-2 ml-2"> Calcular distancias</h3></a>
      </div>
      <div class="col-md-5 menu-footer  ">
        <h3>¡Visítanos!</h3>
        <ul>
          <li><a href="{{route('web')}}">Lautaro 740, Concepción, Región del Bío Bío, CHILE</a></li>
          <li><a href="{{route('desarrollo')}}">Patio Aparcamiento: Camino a Penco, Concepción</a></li>
        </ul>

        <div class="map-container">

          <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3195.5492720083016!2d-73.02737554902022!3d-36.781378900926164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzbCsDQ2JzUzLjAiUyA3M8KwMDEnMjEuMCJX!5e0!3m2!1ses!2scl!4v1719166888531!5m2!1ses!2scl" 
            width="600" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy"></iframe>

        </div>
        
      </div>
      <div class="col-md-3 social-media ">
        <h3>Encuentranos en:</h3>
        <a href="https://www.facebook.com/L%C3%ADneas-de-C%C3%B3digo-SPA-334915964097846" target="_blank"><i class="bi bi-facebook"></i></a>
        <!--<a href="https://twitter.com/aeurus/" target="_blank"><i class="bi bi-twitter"></i></a>-->
        <a href="https://www.instagram.com/lineasdecodigocl/" target="_blank"><i class="bi bi-instagram"></i></a>
        <a href="https://www.linkedin.com/company/79925476/admin/" target="_blank"><i class="bi bi-linkedin"></i></a>
        <h3 class="mt-3">Contáctenos</h3>
        <ul>
          <li><a href="tel:+56978565544">+569 78565544</a></li>
          <li><a href="mailto:eduardo@empresasbulnes.com">eduardo@empresasbulnes.com</a></li>
        </ul>
      </div>
    </div>

  </div>
</footer>

<div id="lineas" style="font-family: 'Roboto', sans-serif;font-size: 14px;background-color: #333;">
  <a href="https://www.lineasdecodigo.cl/" title="Diseño Web - Posicionamiento Web - Sistema Web">
    <img width="142" height="22" src="img/logo.png" alt="Diseño Web - Posicionamiento Web - Sistema Web"></a>
</div>
</div>

<script>
  let inicio = new Vue({
    el: '#vueInicio',
    data: {
      animationTriggered: {},
      elements: [],
      currentServices: 0,
      currentTraslados: 0,
      servicesItems: [{
          image: 'img/tbl/services/sobredimensionado_0.png',
          alt: 'Transporte sobre dimensionado y sobre contenedores',
          url: '/servicio_sobredimensionado'
        },
        {
          image: 'img/tbl/services/carga_especial_0.png',
          alt: 'Transporte de cargas especiales',
          url: '/servicio_cargas_especiales'
        },
        {
          image: 'img/tbl/services/maquinaria_forestal_0.png',
          alt: 'Transporte de equipos forestales',
          url: '/transporte_equipos_forestales'
        },
        {
          image: 'img/tbl/services/rescate_0.png',
          alt: 'Transporte y rescate equipos siniestrados',
          url: '/rescate_equipos_siniestrados'
        },
        {
          image: 'img/tbl/services/maquinaria_menor.png',
          alt: 'Transporte de maquinaria',
          url: '/transporte_maquinaria'
        },
        {
          image: 'img/tbl/services/izaje.png',
          alt: 'Servicios de Izaje',
          url: '/servicios_izajes'
        },
        {
          image: 'img/tbl/services/arriendo_equipos.png',
          alt: 'Arriendos nuestros equipos',
          url: '/equipos'
        }
      ],
      intervalId: null,
      total: 0,
    },
    created(){
      this.guardarVisita();
    },
    mounted() {
      this.updateElements();
      this.showSlide(0);
      window.addEventListener('scroll', this.handleScroll);
      this.animateNumbers();
      this.getVisitas();
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
        }, 3000);
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

        const indicadoresSection = document.querySelector('.indicadores');
        if (this.isElementInViewport(indicadoresSection)) {
          this.animateNumbers();
        }
      },
      animateNumbers() {
        const indicators = document.querySelectorAll('.value-container .value');
        indicators.forEach(indicator => {
          const start = parseInt(indicator.getAttribute('data-start'), 10);
          const end = parseInt(indicator.getAttribute('data-end'), 10);
          this.countUp(indicator, start, end, 2000);
        });
      },
      countUp(element, start, end, duration) {
        let startTime = null;

        function animation(currentTime) {
          if (startTime === null) startTime = currentTime;
          const progress = currentTime - startTime;
          const current = Math.min(start + (progress / duration) * (end - start), end);
          element.textContent = Math.floor(current);
          if (current < end) {
            requestAnimationFrame(animation);
          }
        }

        requestAnimationFrame(animation);
      },
      isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
          rect.top >= 0 &&
          rect.left >= 0 &&
          rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
          rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
      },
      getVisitas() {
        axios.get('/cantidadVisitas')
          .then(response => {
            this.total = response.data.cantidad;
            console.log(response.data)
          })
          .catch(error => {
            console.error('Error al obtener productos:', error);
          });
        
      },
      guardarVisita(){

        axios.post('/guardarVisita')
          .then(response => {
            console.log(response.data.message)
          })
          .catch(error => {
            console.error('Error al obtener productos:', error);
          });
      }



    }
  });
</script>


@endsection