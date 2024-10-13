@extends('lex.plantilla')

@section('content')

<div id="vueInicio">

  <section class="welcome">
    <div>
      <div class="container section-phone-padding">
        <div class="row">
          <div class="col-lg-6 padding-title-presentation-large">
            <h4>Seguro, online y con validez legal </h4>
            <h2 class="escribiendo ">
            Crea y firma documentos legales
            </h2>
            <p>Crea documentos que no requieren de redacción de abogado ni de cumplir con solemnidades especiales, ya que puede ser extendido por las partes firmantes del documento</p>
            <p><br></p>
            <p>
              <a href="/transportes_bulnes" class="btn btn-lex-secondary d-flex align-items-center" style="width: 180px;">¡Conócenos más!</a>
            </p>
          </div>
          <div class="col-6">

            <div id="myCarousel" class="carousel slide margenCarusel" data-ride="carousel">
              <ol class="carousel-indicators">
                <li v-for="(item, index) in carouselItems" :key="index" :data-slide-to="index" :class="{ active: index === currentSlide }" @click="showSlide(index)"></li>
              </ol>
              <div class="carousel-inner large-screen">
                <div v-for="(item, index) in carouselItems" :key="index" :class="['carousel-item', { active: index === currentSlide }]">
                  <img class="second-slide imgCaruselPrincipal" :src="item.image" alt="Second slide">
                  <div class="row titleCarousel">
                    <div class="container d-flex">
                      <div class="titleServices1">
                        <h1 class="text-center">@{{ item.title }}</h1>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <div class="carousel-inner small-screen" style="display: none;">
                <div v-for="(item, index) in carouselItemsCel" :key="index" :class="['carousel-item', { active: index === currentSlide }]">
                  <img class="second-slide imgCaruselPrincipal" :src="item.image" alt="Second slide">
                  <div class="row titleCarousel">
                    <div class="container d-flex">
                      <div class="titleServices1">
                        <h1 class="text-center">@{{ item.title }}</h1>
                      </div>
                      <div class="titleServices2">
                        <a class="btn btn-lg btn-primary buttonServices" href="#" role="button" @click.prevent="goToServices">
                          <span>Nuestros servicios</span>
                          <i style="color: white; font-size: 30px!important; margin-left: 48px;" class="material-icons">arrow_forward</i>
                        </a>
                      </div>
                      <div class="titleServices2Celular">
                        <a class="btn btn-lg btn-primary buttonServices" href="#" role="button" @click.prevent="goToServicesPhone">
                          <span>Nuestros servicios</span>
                          <i style="color: white; font-size: 30px!important; margin-left: 15px;" class="material-icons">arrow_forward</i>
                        </a>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev" @click.prevent="prevSlide">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next" @click.prevent="nextSlide">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>


          </div>
        </div>
      </div>
    </div>
    <div class="carrusel">

    <div class="owl-carousel owl-theme">
      <div class="item" v-for="(card, index) in cards" :key="index">
        <!-- El contenido de tu card va aquí -->
        <img :src="card.image" alt="Card image">
        <h4>@{{ card.title }}</h4>
        <p>@{{ card.description }}</p>
      </div>
    </div>



    </div>
  </section>

  <!-- <section class="indicadores py-5 bgIndicadores">
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
  </section> -->


  @include('lex.include.footer')


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
      currentSlide: 0,
      carouselItems: [
        {
          image: 'img/lex/bg1.png',
          alt: 'Documento privado con firma avanzada',
          title: 'Paso 1'
        },
        {
          image: 'img/lex/bg1.png',
          alt: 'Pago online',
          title: 'Paso 2'
        },      
        {
          image: 'img/lex/bg1.png',
          alt: 'Firmar con clave única',
          title: 'Paso 3'
        }
      ],
      carouselItemsCel: [
        {
          image: 'img/lex/bg1.png',
          alt: 'Third slide',
          title: 'Paso 1'
        },
        {
          image: 'img/lex/bg1.png',
          alt: 'Third slide',
          title: 'Paso 2'
        },      
        {
          image: 'img/lex/bg1.png',
          alt: 'Third slide',
          title: 'Paso 3'
        }
      ],
      cards: [
        { image: 'img/lex/doc.png', title: 'Card 1', description: 'Descripción de la card 1' },
        { image: 'img/lex/doc.png', title: 'Card 2', description: 'Descripción de la card 2' },
        { image: 'img/lex/doc.png', title: 'Card 3', description: 'Descripción de la card 3' },
        { image: 'img/lex/doc.png', title: 'Card 4', description: 'Descripción de la card 4' },
        { image: 'img/lex/doc.png', title: 'Card 5', description: 'Descripción de la card 5' },
        { image: 'img/lex/doc.png', title: 'Card 6', description: 'Descripción de la card 6' },
        { image: 'img/lex/doc.png', title: 'Card 7', description: 'Descripción de la card 7' },
        { image: 'img/lex/doc.png', title: 'Card 8', description: 'Descripción de la card 8' },
        { image: 'img/lex/doc.png', title: 'Card 9', description: 'Descripción de la card 9' },
        { image: 'img/lex/doc.png', title: 'Card 10', description: 'Descripción de la card 10' }
      ],
      intervalId: null,
    },
    created() {
      this.showSlide(0); // Muestra la primera diapositiva
      this.intervalId = setInterval(() => {
        this.nextSlide();
      }, 7000); // Cambia cada 2 segundos (2000 ms)
    },
    mounted() {
      $('.owl-carousel').owlCarousel({
        items: 4, // Mostrar 4 cards inicialmente
        loop: false, // Si no deseas un carrusel en bucle
        margin: 20, // Margen entre los elementos
        nav: true, // Habilitar la navegación
        dots: false, // Desactivar los puntos de paginación
        navText : [
          '<span class="material-icons-outlined">arrow_back_ios</span>',
          '<span class="material-icons-outlined">arrow_forward_ios</span>'
        ],
        responsive: {
          0: {
            items: 1 // Mostrar 1 card en pantallas pequeñas
          },
          600: {
            items: 2 // Mostrar 2 cards en pantallas medianas
          },
          1000: {
            items: 4 // Mostrar 4 cards en pantallas grandes
          }
        }
      });
    },
    methods: {
      showSlide(index) {
        this.currentSlide = index;
      },
      nextSlide() {
        this.currentSlide = (this.currentSlide + 1) % this.carouselItems.length;
      },
      prevSlide() {
        this.currentSlide = (this.currentSlide - 1 + this.carouselItems.length) % this.carouselItems.length;
      },


    }
  });
</script>


@endsection