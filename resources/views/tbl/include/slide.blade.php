<div id="formSlide">

  <div id="cotiza" class="div_cotiza">
    <section class="shadow-lg estiloCotiza" id="contacto">
      <form @submit.prevent="guardarCotizacion">

        <div class="row">
          <div class="col-md-12">
            <div class="text-center pb-4">
              <h4 style="font-size: 1.8rem; font-weight: 600;">¡Cotiza y trabajemos juntos!</h4>
            </div>

            <!-- Aquí puedes colocar tu formulario de contacto -->
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" v-model="cotizacion.nombre" placeholder="Acá tu nombre" maxlength="255" name="cotizacion.nombre" id="nombre">
            </div>

            <div class="form-group">
              <label for="telefono">Teléfono</label>
              <input type="text" class="form-control" v-model="cotizacion.telefono" placeholder="Recuerda ingresar el +569 " maxlength="255" name="cotizacion.telefono" id="telefono">
            </div>

            <div class="form-group">
              <label for="email">Correo</label>
              <input type="email" class="form-control" v-model="cotizacion.email" placeholder="Acá tu correo" maxlength="255" name="cotizacion.email" id="email">
            </div>

            <div class="form-group">
              <label for="fecha">Fecha posible del servicio</label>
              <input type="date" v-model="cotizacion.fecha_servicio" id="fecha" name="fecha" class="form-control" placeholder="Fecha posible del servicio">
            </div>

          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="origen">Origen</label>
              <input type="text" v-model="cotizacion.origen" id="origen" name="origen" class="form-control" placeholder="Origen">
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="destino">Destino</label>
              <input type="text" v-model="cotizacion.destino" id="destino" name="destino" class="form-control" placeholder="Destino">
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <label for="comentarios">Mensaje:</label>
              <textarea class="form-control" placeholder="Haznos saber tus dudas o consultas" v-model="cotizacion.comentarios" id="comentarios" name="cotizacion.comentarios" maxlength="255" rows="4"></textarea>
            </div>
            <button type="submit" class="w-100 btn btn-primary">Enviar</button>
          </div>
        </div>
      </form>
    </section>
  </div>


  <div id="myCarousel" class="carousel slide margenCarusel" data-ride="carousel">
    <ol class="carousel-indicators">
      <li v-for="(item, index) in carouselItems" :key="index" :data-slide-to="index" :class="{ active: index === currentSlide }" @click="showSlide(index)"></li>
    </ol>
    <div class="carousel-inner">
      <div v-for="(item, index) in carouselItems" :key="index" :class="['carousel-item', { active: index === currentSlide }]">
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


  <!-- Modal de contacto -->
  <div class="modal fade" id="successContact" style="display: none;" tabindex="-1" aria-labelledby="successContactLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class=" p-5">
            <div class="text-center">
              <div class="icon-check pb-3">
                <i class="material-icons" style="color: #8bb06f;font-size: 60px;">check_circle</i>
              </div>
              <p>¡Hemos recibido tu solicitud de cotización con éxito, te contactaremos lo más luego posible!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>


<script>
  let formSlide = new Vue({
    el: '#formSlide',
    data: {
      cotizacion: {
        nombre: '',
        email: '',
        telefono: '',
        fecha_servicio: '',
        origen: '',
        destino: '',
        comentarios: '',
      },
      currentSlide: 0,
      carouselItems: [
      {
        image: 'img/tbl/traslado_equipos.png',
        alt: 'Third slide',
        title: 'Transporte de maquinaria'
      },
      {
        image: 'img/tbl/transporte_a_todo_chile.png',
        alt: 'Third slide',
        title: 'Transporte sobre dimensionado'
      },      
      {
        image: 'img/tbl/services/izaje.png',
        alt: 'Third slide',
        title: 'Servicio de Izajes'
      }],
      intervalId: null
    },
    created() {
      this.showSlide(0); // Muestra la primera diapositiva
      this.intervalId = setInterval(() => {
        this.nextSlide();
      }, 7000); // Cambia cada 2 segundos (2000 ms)
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
        console.log('goToServices called');
        let trasladosElement = document.getElementById('traslados');
        let trasladosElementCelular = document.getElementById('traslados_celular');
        if (trasladosElement) {
          // Obtener la posición del elemento
          let elementPosition = trasladosElement.getBoundingClientRect().top + window.scrollY;
          // Calcular la posición deseada (50px más arriba)
          let offsetPosition = elementPosition - 150;

          // Desplazar la ventana a la posición deseada
          window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
          });

          // Si prefieres un salto instantáneo en lugar de un scroll suave, usa:
          // window.scrollTo({ top: offsetPosition, behavior: 'auto' });
        } 
        
        /* if (trasladosElementCelular){
          let elementPosition = trasladosElementCelular.getBoundingClientRect().top + window.scrollY;
          let offsetPosition = elementPosition - 210;
          window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
          });
        } */
        // Agrega aquí tu lógica para desplazarte o realizar acciones específicas
        // Asegúrate de que esta parte esté funcionando correctamente
      },
      goToServicesPhone() {
        console.log('goToServicesphone called');
        let trasladosElementCelular = document.getElementById('traslados_celular');  
        if (trasladosElementCelular){
          let elementPosition = trasladosElementCelular.getBoundingClientRect().top + window.scrollY;
          let offsetPosition = elementPosition - 210;
          window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
          });
        }
        // Agrega aquí tu lógica para desplazarte o realizar acciones específicas
        // Asegúrate de que esta parte esté funcionando correctamente
      },

      guardarCotizacion() {
        axios.post('/guardarCotizacion', this.cotizacion)
          .then(response => {

            // Manejar la respuesta exitosa
            if (response.data.status === 'ok') {
              $("#successContact").modal('show');
              setTimeout(() => {
                $("#successContact").modal('hide');
              }, 4000);
            }
            this.limpiarCotizacion();

          })
          .catch(error => {
            // Manejar el error
            console.error('Hubo un error al enviar el formulario', error);
          });
      },
      limpiarCotizacion() {
        this.cotizacion.nombre = '';
        this.cotizacion.email = '';
        this.cotizacion.telefono = '';
        this.cotizacion.fecha_servicio = '';
        this.cotizacion.origen = '';
        this.cotizacion.destino = '';
        this.cotizacion.comentarios = '';
      }
    }
  });
</script>