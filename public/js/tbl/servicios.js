let serviciosVue = new Vue({
    el: '#serviciosVue',
    data: {
      total: 0,
      animationTriggered: {},
      elements: [],
      currentSlide: 0,
      cotizaServ: {
        nombre: '',
        telefono: '',
        email: '',
        origen: '',
        destino: '',
        fecha_servicio: '',
        comentarios: '',
        servicioId: '',
        servicioSeleccionado: '',
      },
    },
    mounted() {
      this.getVisitas();
      this.updateElements();
      window.addEventListener('scroll', this.handleScroll);
      this.startCarousel();
    },
    methods: {
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
      startCarousel() {
        const galleryInner = document.querySelector('.services_gallery-inner');
        const items = document.querySelectorAll('.services_gallery-item');
        const itemCount = items.length;
        setInterval(() => {
          this.currentSlide = (this.currentSlide + 1) % itemCount;
          const offset = this.currentSlide * items[0].clientWidth;
          galleryInner.style.transform = `translateX(-${offset}px)`;
        }, 3000);
      },
      seleccionarServicio(id, servicio){
        this.cotizaServ.servicioId = id;
        this.cotizaServ.servicioSeleccionado = servicio;
      },
      guardarCotizacionServicio() {
        axios.post('/guardarCotizacion', this.cotizaServ)
          .then(response => {

            $("#cotizarServicio").modal('hide');
            // Manejar la respuesta exitosa
            if (response.data.status === 'ok') {
              $("#successContact").modal('show');
              setTimeout(() => {
                $("#successContact").modal('hide');
              }, 4000);
            }
            this.limpiarCotizacionServ();

          })
          .catch(error => {
            // Manejar el error
            console.error('Hubo un error al enviar el formulario', error);
          });
      },
      limpiarCotizacionServ() {
        this.cotizaServ.nombre = '';
        this.cotizaServ.email = '';
        this.cotizaServ.telefono = '';
        this.cotizaServ.fecha_servicio = '';
        this.cotizaServ.origen = '';
        this.cotizaServ.destino = '';
        this.cotizaServ.comentarios = '';
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
    }
  });