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
              ¿Necesitas un documento legal con firma avanzada en minutos?
            </h2>
            <p>Crea documentos que no requieren de redacción de abogado ni de cumplir con solemnidades especiales, ya que puede ser extendido por las partes firmantes del documento</p>
            <p>Podrás encontrar <strong>declaraciones, contratos, cartas poder y muchos más documentos</strong>.</p>
            <p><br></p>
            <p>
              <a href="/#" class="btn btn-lex-secondary d-flex align-items-center" style="width: 180px;">¡Conócenos más!</a>
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
    <div class="bgInfo">
      <div class="container">
        <div class="pt-4 pb-5 text-center">
          <h2 class="text-primary">¿Cómo funciona?</h2>
          <hr class="divider">

          <div class="steps-container">
            <!-- Paso 1 -->
            <div class="step">
              <div class="circle">1</div>
              <span class="material-icons icon">description</span>
              <h4>Elige y completa tu documento</h4>
            </div>

            <!-- Línea que conecta los pasos -->
            <div class="line"></div>

            <!-- Paso 2 -->
            <div class="step">
              <div class="circle">2</div>
              <span class="material-icons icon">group_add</span>
              <h4>Añade los firmantes</h4>
            </div>

            <!-- Línea que conecta los pasos -->
            <div class="line"></div>

            <!-- Paso 2 -->
            <div class="step">
              <div class="circle">3</div>
              <span class="material-icons icon">credit_card</span>
              <h4>Realiza el pago con Transbank</h4>
            </div>

            <!-- Línea que conecta los pasos -->
            <div class="line"></div>

            <!-- Paso 3 -->
            <div class="step">
              <div class="circle">4</div>
              <span class="material-icons icon">edit_note</span>
              <h4>Firma tu documento online</h4>
            </div>
          </div>

          <p class="final-text">¡Todo listo para descargar y usar!</p>
        </div>
      </div>
    </div>

    <div class="container py-5">

      <div class="mb-5">

        <div>
          <h4><i class="material-icons" style="vertical-align: middle;">double_arrow</i>Declaraciones</h4>
        </div>
        <div class="owl-carousel owl-theme">

          @foreach($categoriasDocumentos as $categoriaDocumento)

          <div class="item">
            <div class="card" style="width: 18rem;">
              <img src="/img/lex/docFirma.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">{{ $categoriaDocumento->documento }}</h5>
                <a href="{{ url('redactar/' . $categoriaDocumento->id_documento) }}" class="btn btn-primary">Iniciar</a>
              </div>
            </div>
          </div>

          @endforeach

        </div>
      </div>

    </div>






  </section>


  @include('lex.include.footer')




</div>

<script>
  let inicio = new Vue({
    el: '#vueInicio',
    data: {
      animationTriggered: {},
      currentSlide: 0,
      carouselItems: [{
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
      carouselItemsCel: [{
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
        nav: true, // Habilitar la navegación con flechas
        dots: false, // Desactivar los puntos de paginación
        navText: [
          '<span class="material-icons" style="font-size: 24px;">arrow_back_ios</span>',
          '<span class="material-icons" style="font-size: 24px;">arrow_forward_ios</span>'
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