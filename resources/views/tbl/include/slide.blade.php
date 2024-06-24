<div id="myCarousel" class="carousel slide" data-ride="carousel" style="padding-bottom: 0px !important;margin-top: 3%;">
  <ol class="carousel-indicators">
    <li v-for="(item, index) in carouselItems" :key="index" :data-slide-to="index" :class="{ active: index === currentSlide }" @click="showSlide(index)"></li>
  </ol>
  <div class="carousel-inner">
    <div v-for="(item, index) in carouselItems" :key="index" :class="['carousel-item', { active: index === currentSlide }]">
        <img class="second-slide" src="img/tbl/traslados.png" alt="Second slide">
        <div class="row titleCarousel">
            <div class="container d-flex">
            <div class="titleServices1">
                <h1 class="text-center">@{{ item.title }}</h1>
            </div>
            <div @click.prevent="goToServices" class="titleServices2">
                <a class="btn btn-lg btn-primary d-flex align-items-center" style="font-size: 22px !important;padding: 1rem 1.35rem;margin-top: -14px;" href="#" role="button">Nuestros servicios
                <i style="color: white; font-size: 30px!important; margin-left: 48px;" class="material-icons">arrow_forward</i>
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






<script>
  new Vue({
    el: '#myCarousel',
    data: {
      currentSlide: 0,
      carouselItems: [
        {
          image: 'img/tbl/traslados.png',
          alt: 'Second slide',
          title: 'Traslado de carga general - sobredimensión'
        },
        {
          image: 'img/tbl/sobredimensionado.png',
          alt: 'Third slide',
          title: 'Transporte a todo Chile'
        },
        {
          image: 'img/tbl/transporte.png',
          alt: 'Third slide',
          title: 'Transporte de cargas especial'
        }
      ],
      intervalId: null
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
      goToServices() {
        const element = document.querySelector('.traslados');
        const yOffset = -120; // Ajusta esto según tus necesidades
        const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;

        window.scrollTo({
          top: y,
          behavior: 'smooth'
        });
      }
    },
    mounted() {
      this.showSlide(0); // Muestra la primera diapositiva
      this.intervalId = setInterval(() => {
        this.nextSlide();
      }, 2000); // Cambia cada 2 segundos (2000 ms)
    },
    beforeDestroy() {
      clearInterval(this.intervalId);
    }
  });
</script>