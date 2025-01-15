@extends('lex.plantilla')

@section('content')

<style>
@keyframes showTopText {
    0% {
        transform: translate3d(0, 100%, 0);
    }
    40%, 60% {
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
    z-index: 10;
}

.animated-title > div {
    height: 49.6%;
    overflow: hidden;
    position: absolute;
    width: 100%;
}

.animated-title > div div {
    font-size: 2.6vmin;
    padding: 3.4vmin 0;
    position: absolute;
    transition: transform 0.4s ease-out; /* Añadir transición más suave */
}

.animated-title > div div span {
    display: block;
}

.animated-title > div.text-top {
    border-bottom: 0.5vmin solid #ee6076;
    top: 0;
}

.animated-title > div.text-top div {
    animation: showTopText 0.8s ease-out forwards; /* Reducir tiempo y añadir suavizado */
    animation-delay: 0.2s; /* Ajustar el tiempo de delay */
    bottom: 0;
    transform: translate(0, 100%);
}

.animated-title > div.text-top div span:first-child {
    color: #767676;
}

.animated-title > div.text-bottom {
    bottom: 0;
}

.animated-title > div.text-bottom div {
    animation: showBottomText 0.6s ease-out forwards; /* Reducir tiempo de animación */
    animation-delay: 1s; /* Ajustar delay */
    top: 0;
    transform: translate(0, -100%);
}

/* Animación de los títulos (Slide-in) */
.titleOne h4,
.titlePrincipal h2,
.titlePrincipal p {
    animation-duration: 1s;
    animation-name: slidein;
    animation-timing-function: ease-out; /* Añadir suavizado para el slide-in */
}

@keyframes slidein {
    from {
        margin-left: 40%;
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
      <div class="bgInicio">
      <div class="container section-phone-padding">
        <div class="row celContainer">
          <div class="col-lg-7 padding-title-presentation-large titleOne titlePrincipal">
            <h4 class="pb-2">Seguro, online y con validez legal </h4>
            <h2 class="pb-2">
              ¿Necesitas un documento legal con firma avanzada en minutos?
            </h2>
            <p>Podrás encontrar <strong>declaraciones, contratos, cartas poder y muchos más documentos</strong>.</p>
            <div class="row">
              <div class="col-4 col-lg-2 pt-2">
                <img src="https://www.ecertla.com//content/uploads/2023/09/logo-ecert.png" alt="" class="img-fluid">
              </div>
              <div class="col-4 col-lg-2 pt-2">
                <img src="https://publico.transbank.cl/documents/20129/38535804/logo_tbk.svg" alt="" class="img-fluid">
              </div>
              <div class="col-4 col-lg-2 pt-2">
                <img src="/img/lex/claveunica.png" alt="" class="img-fluid">
              </div>
            </div>
            <p>
              <br>
            </p>
          </div>
          <div class="col-lg-5 displayNoneCel">
            <img src="/img/lex/documentoPrincipal.png" alt="Documento legal" class="img-fluid documento-legal">
          </div>
        </div>


      </div>
      </div>

      <div class="bgBuscador">
        <div class="container">
          <div class="row">



          <div class="col-md-3">
            <div class="form-group">
              <div class="btn btn-lex-secondary d-flex align-items-center btnPrincipalSearch" style="width: 100%; padding: 10px; display: flex; align-items: center;">
                <i class="material-icons icon" style="font-size: 24px; margin-right: 10px;">search</i>
                <input type="text" v-model="searchQuery" class="form-control" placeholder="Buscar documento" style="border: none; background: transparent; color: inherit; font-size: 16px; width: 100%; text-align: left;" @input="filterDocuments">
              </div>
              <!-- Lista de resultados de búsqueda -->
              <ul v-if="filteredDocuments.length > 0" id="searchResults" class="list-group" style="display: block; position: absolute; width: 125%; padding-left: 33px; max-height: 200px; overflow-y: auto; z-index: 10;">
                <li v-for="document in filteredDocuments" :key="document.id_documento" class="list-group-item" @click="redirectToDocument(document)">
                  @{{ document.documento }}
                </li>
              </ul>
            </div>
          </div>




            <div class="col-md-9">
              <p>Crea documentos que <strong>no requieren de redacción de abogado ni de cumplir con solemnidades especiales</strong>, ya que <strong>puede ser extendido por las partes firmantes</strong> del documento</p>
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
            <div class="card" style="width: 18rem;box-shadow:rgba(168, 166, 168, 0.89) 5px 0px 15px -3px;">
              <img src="/img/lex/docFirma.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title" style="min-height: 64px;">{{ $categoriaDocumento->documento }}</h5>
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
      searchQuery: '', // La cadena de búsqueda que se ingresa
      categoriasDocumentos: @json($categoriasDocumentos), // Pasar los datos del backend
      filteredDocuments: [] // Lista de documentos filtrados
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
      document.getElementById('documentoSelect').addEventListener('change', this.redirigirDocumento);
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
              items: 1 // Mostrar 2 cards en pantallas medianas
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
        }, {
          threshold: 1
        });

        steps.forEach(step => observer.observe(step));
      },
      filterDocuments() {
        const query = this.searchQuery.toLowerCase();
        this.filteredDocuments = this.categoriasDocumentos.filter(document => 
          document.documento.toLowerCase().includes(query)
        );
      },
      // Método para redirigir al documento seleccionado
      redirectToDocument(document) {
        window.location.href = `/redactar/${document.id_documento}`;
      }





    }
  });
</script>


@endsection