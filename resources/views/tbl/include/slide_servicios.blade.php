<section id="traslados" class="traslados">
      <div class="carousel">
        <div class="titles">
          <div class="title" @click="showAlert(0)" :class="{ active: currentSlide === 0 }"><strong>Transporte sobre dimensionado y sobre contenedores</strong></div>
          <div class="title" @click="showAlert(1)" :class="{ active: currentSlide === 1 }"><strong>Transporte de cargas especiales</strong></div>
          <div class="title" @click="showAlert(2)" :class="{ active: currentSlide === 2 }">Transporte maquinaria y equipos forestales</div>
          <div class="title" @click="showSlide(3)" :class="{ active: currentSlide === 3 }">Transporte y rescate equipos siniestrados</div>
          <div class="title" @click="showSlide(4)" :class="{ active: currentSlide === 4 }">Transporte de maquinaria menor y rescate de vehículos</div>
          <div class="title" @click="showSlide(5)" :class="{ active: currentSlide === 5 }">Servicios de Izaje</div>
          <div class="title" @click="showSlide(6)" :class="{ active: currentSlide === 6 }">Arriendos nuestros equipos</div>
        </div>
        <div class="indicators">
          <span class="indicator" @click="showAlert(0)" :class="{ active: currentSlide === 0 }"></span>
          <span class="indicator" @click="showAlert(1)" :class="{ active: currentSlide === 1 }"></span>
          <span class="indicator" @click="showSlide(2)" :class="{ active: currentSlide === 2 }"></span>
          <span class="indicator" @click="showSlide(3)" :class="{ active: currentSlide === 3 }"></span>
          <span class="indicator" @click="showSlide(4)" :class="{ active: currentSlide === 4 }"></span>
          <span class="indicator" @click="showSlide(5)" :class="{ active: currentSlide === 5 }"></span>
          <span class="indicator" @click="showSlide(6)" :class="{ active: currentSlide === 6 }"></span>
        </div>
        <div class="photos">
          <div class="photo" v-for="(item, index) in carouselItems" :key="index" :class="{ active: currentSlide === index }">
            <img :src="item.image" :alt="item.alt">
          </div>
        </div>
      </div>
    </section>
    <script>
    new Vue({
      el: '#traslados',
      data: {
        currentSlide: 0,
        carouselItems: [
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

          photos[this.currentSlide].classList.remove('active');
          indicators[this.currentSlide].classList.remove('active');
          titles[this.currentSlide].classList.remove('active');

          // Mostrar la nueva diapositiva y añadir la clase activa a los indicadores y títulos correspondientes
          photos[index].classList.add('active');
          indicators[index].classList.add('active');
          titles[index].classList.add('active');

          // Actualizar el índice de la diapositiva actual
          this.currentSlide = index;

          // Reiniciar el intervalo para cambiar la diapositiva automáticamente después de 2 segundos
          this.intervalId = setInterval(() => {
            const nextSlide = (this.currentSlide + 1) % this.carouselItems.length;
            this.showSlide(nextSlide);
          }, 2000);
        }
      },
      beforeDestroy() {
        // Limpiar el intervalo al destruir la instancia Vue para evitar fugas de memoria
        clearInterval(this.intervalId);
      }
    });
  </script>
