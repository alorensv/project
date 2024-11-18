@extends('lex.plantilla')

@section('content')

<style>
  @keyframes showTopText {
    0% {
      transform: translate3d(0, 100%, 0);
    }

    40%,
    60% {
      transform: translate3d(0, 50%, 0);
    }

    100% {
      transform: translate3d(0, 0, 0);
    }
  }

  @keyframes showBottomText {
    0% {
      transform: translate3d(0, -100%, 0);
    }

    100% {
      transform: translate3d(0, 0, 0);
    }
  }

  .animated-title {
    line-height: normal;
    color: #222;
    height: 134vmin;
    left: 70%;
    position: absolute;
    top: 21%;
    transform: translate(-64%, -54%);
    width: 72vmin;
  }

  .animated-title>div {
    height: 49.6%;
    overflow: hidden;
    position: absolute;
    width: 100%;
  }

  .animated-title>div div {
    font-size: 2.6vmin;
    padding: 3.4vmin 0;
    position: absolute;
  }

  .animated-title>div div span {
    display: block;
  }

  .animated-title>div.text-top {
    border-bottom: 0.5vmin solid #ee6076;
    top: 0;
  }

  .animated-title>div.text-top div {
    animation: showTopText 1s forwards;
    animation-delay: 0.5s;
    bottom: 0;
    transform: translate(0, 100%);
  }

  .animated-title>div.text-top div span:first-child {
    color: #767676;
  }

  .animated-title>div.text-bottom {
    bottom: 0;
  }

  .animated-title>div.text-bottom div {
    animation: showBottomText 0.5s forwards;
    animation-delay: 1.75s;
    top: 0;
    transform: translate(0, -100%);
  }

  .animated-title {
    z-index: 10;
  }

  .animated-title p {
    font-size: 19px !important;
  }

  .titleOne h4 {
    animation-duration: 3s;
    animation-name: slidein;
  }

  .titlePrincipal h2 {
    animation-duration: 2s;
    animation-name: slidein;
  }

  .titlePrincipal p {
    animation-duration: 2s;
    animation-name: slidein;
  }

  @keyframes slidein {
    from {
      margin-left: 100%;
      width: 100%;
    }

    to {
      margin-left: 0%;
      width: 100%;
    }
  }
  

</style>

<div id="vueInicio">

  <section class="welcome">
    <div>
      <div class="container section-phone-padding">
        <div class="row">
          <div class="col-lg-6 padding-title-presentation-large titleOne titlePrincipal">
            <h4>Seguro, online y con validez legal </h4>
            <h2>
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

            <div id="banner-carousel" class="owl-carousel owl-theme">

              <div v-for="(item, index) in carouselItems" :key="index">

                <div class="item">
                  <div>
                    <div class="animated-title">
                      <div class="text-top">
                        <div style="margin-bottom: -10px;">
                          <span>@{{ item.title }}</span>

                        </div>
                      </div>
                      <div class="text-bottom pt-1">
                        <span>
                          <p>@{{ item.sub1 }}</p>
                        </span>
                        <div>
                          <p>@{{ item.sub2 }}</p>
                        </div>
                      </div>
                    </div>

                    <img class="second-slide imgCaruselPrincipal" :src="item.image" alt="Second slide">
                  </div>
                </div>

              </div>

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

            <!-- Paso 3 -->
            <div class="step">
              <div class="circle">3</div>
              <span class="material-icons icon">credit_card</span>
              <h4>Realiza el pago con Transbank</h4>
            </div>

            <!-- Línea que conecta los pasos -->
            <div class="line"></div>

            <!-- Paso 4 -->
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

        <div class="pb-4">
          <h4><i class="material-icons" style="vertical-align: middle;">double_arrow</i>Documentos disponibles</h4>
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
          title: 'Paso 1',
          sub1: 'Selecciona y completa los datos del documento',
          sub2: 'Agrega a los FIRMANTES que participarán.'
        },
        {
          image: 'img/lex/bg1.png',
          alt: 'Documento privado con firma avanzada',
          title: 'Paso 2',
          sub1: 'Paga segur@ con Transbank',
          sub2: 'TODOS los documentos y firmas que necesites.'
        },
        /* 
                { image: 'img/lex/bg1.png', alt: 'Pago online', title: 'Paso 2' },
                { image: 'img/lex/bg1.png', alt: 'Firmar con clave única', title: 'Paso 3' } */
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
      this.startAutoSlide();
    },
    beforeDestroy() {
      clearInterval(this.intervalId);
    },
    mounted() {
      this.carruselBanner();
      this.carruselDocumentos();
      this.initStepAnimation();
    },
    methods: {
      startAutoSlide() {
        this.intervalId = setInterval(this.nextSlide, 9000);
      },
      showSlide(index) {
        this.currentSlide = index;
      },
      nextSlide() {
        this.currentSlide = (this.currentSlide + 1) % this.carouselItems.length;
      },
      prevSlide() {
        this.currentSlide = (this.currentSlide - 1 + this.carouselItems.length) % this.carouselItems.length;
      },
      carruselDocumentos() {
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
      carruselBanner() {
        $('#banner-carousel').owlCarousel({
          items: 1, // Mostrar 4 cards inicialmente
          loop: true, // Si no deseas un carrusel en bucle
          margin: 20, // Margen entre los elementos
          nav: true, // Habilitar la navegación con flechas
          dots: false, // Desactivar los puntos de paginación
          autoplay: true,
          autoplayTimeout: 5000,
          autoplayHoverPause: true,
        });
      },
      initStepAnimation() {
        const steps = document.querySelectorAll('.step');
        const observer = new IntersectionObserver((entries) => {
          let delay = 0;
          let visibleCount = 0; // Contador para llevar un seguimiento de los pasos visibles

          entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
              // Mostrar inmediatamente el primer elemento
              setTimeout(() => {
                  entry.target.classList.add('visible');
                  visibleCount++; // Contar este paso como visible
                  // Verificar si todos los pasos han sido visibles
                  if (visibleCount === steps.length) {
                    document.querySelector('.final-text').style.fontSize = '34px'; // Aumentar el tamaño del texto
                  }
                }, delay);
                delay += 200; 
            } else {
              entry.target.classList.remove('visible');
              document.querySelector('.final-text').style.fontSize = '1.4rem'; 
            }
          });
        }, { threshold: 1 });

        steps.forEach(step => observer.observe(step));
      }





    }
  });
</script>


@endsection