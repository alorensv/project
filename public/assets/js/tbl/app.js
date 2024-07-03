let inicio = new Vue({
    el: '#vueInicio',
    data: {
      contacto: {
        nombre: '',
        telefono: '',
        correo: '',
        comentarios: '',
      },
      animationTriggered: {},
      elements: [],
      currentServices: 0,
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
      intervalId: null
    },
    mounted() {
      this.updateElements();
      this.showSlide(0);
      window.addEventListener('scroll', this.handleScroll);
      this.animateNumbers();
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
      guardarContacto() {
        axios.post('/guardarContacto', this.contacto)
          .then(response => {
            $("#contactModal").modal('hide'); 
            // Manejar la respuesta exitosa
            if (response.data.status === 'ok') {
              $("#successContact").modal('show');    
              setTimeout(() => {
                $("#successContact").modal('hide'); 
              }, 4000); 
            }
                    
          })
          .catch(error => {
            // Manejar el error
            console.error('Hubo un error al enviar el formulario', error);
          });
      },
      clearContactoData(){
        this.nombre = '';
        this.telefono = '';
        this.correo = '';
        this.comentarios = '';
      }

      
    }
  });