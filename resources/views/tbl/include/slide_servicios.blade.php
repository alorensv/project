@extends('tbl.inicio')

@section('transportes')
<section id="traslados" class="traslados">
      <div class="carousel">
        <div class="titles">
          <div class="title" @click="showAlert(0)" :class="{ active: currentServices === 0 }"><strong>Transporte sobre dimensionado y sobre contenedores</strong></div>
          <div class="title" @click="showAlert(1)" :class="{ active: currentServices === 1 }"><strong>Transporte de cargas especiales</strong></div>
          <div class="title" @click="showAlert(2)" :class="{ active: currentServices === 2 }">Transporte maquinaria y equipos forestales</div>
          <div class="title" @click="showSlide(3)" :class="{ active: currentServices === 3 }">Transporte y rescate equipos siniestrados</div>
          <div class="title" @click="showSlide(4)" :class="{ active: currentServices === 4 }">Transporte de maquinaria menor y rescate de vehículos</div>
          <div class="title" @click="showSlide(5)" :class="{ active: currentServices === 5 }">Servicios de Izaje</div>
          <div class="title" @click="showSlide(6)" :class="{ active: currentServices === 6 }">Arriendos nuestros equipos</div>
        </div>
        <div class="indicators">
          <span class="indicator" @click="showAlert(0)" :class="{ active: currentServices === 0 }"></span>
          <span class="indicator" @click="showAlert(1)" :class="{ active: currentServices === 1 }"></span>
          <span class="indicator" @click="showSlide(2)" :class="{ active: currentServices === 2 }"></span>
          <span class="indicator" @click="showSlide(3)" :class="{ active: currentServices === 3 }"></span>
          <span class="indicator" @click="showSlide(4)" :class="{ active: currentServices === 4 }"></span>
          <span class="indicator" @click="showSlide(5)" :class="{ active: currentServices === 5 }"></span>
          <span class="indicator" @click="showSlide(6)" :class="{ active: currentServices === 6 }"></span>
        </div>
        <div class="photos">
          <div class="photo" v-for="(item, index) in servicesItems" :key="index" :class="{ active: currentServices === index }">
            <img :src="item.image" :alt="item.alt">
          </div>
        </div>
      </div>
    </section>
    <script>
    new Vue({
      el: '#traslados',
      data: {
        currentServices: 0,
        servicesItems: [
          {
            image: 'img/tbl/sobredimensionado.png',
            alt: 'Transporte sobre dimensionado y sobre contenedores'
          },
          {
            image: 'img/tbl/transporte.png',
            alt: 'Transporte de cargas especiales'
          },
          {
            image: 'img/tbl/transporte.png',
            alt: 'Transporte maquinaria y equipos forestales'
          },
          {
            image: 'img/tbl/transporte.png',
            alt: 'Transporte y rescate equipos siniestrados'
          },
          {
            image: 'img/tbl/transporte.png',
            alt: 'Transporte de maquinaria menor y rescate de vehículos'
          },
          {
            image: 'img/tbl/transporte.png',
            alt: 'Servicios de Izaje'
          },
          {
            image: 'img/tbl/transporte.png',
            alt: 'Arriendos nuestros equipos'
          }
        ],
        intervalId: null
      },      
      mounted() {
        // Mostrar la primera diapositiva al cargar la página
        this.showSlide(0);
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
        }
      }
    });
  </script>
@endsection