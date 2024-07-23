@extends('tbl.plantilla')

@section('content')

<div id="vueEquipos">
  <section class="white-division pt-2 pb-2">
    <div class="container">
      <div class="row market-body mt-5 pt-5">
        <!-- Columna de categorías -->
        <div class="col-md-3">
          <div class="filtrosDiv">
           
            <button class="btn btn-primary w-100"  @click="toggleFiltros">
              <span class="material-icons float-left">search</span>
              <h5 class="font-weight-bold" style="margin-bottom: 0px !important;">@{{filters}}</h5>
            </button>
            
            <div id="listarFiltros" v-show="filtrosVisibles" v-for="tipo in tipos" :key="tipo.id">
              <div class="categoria-title">
                <hr>
                <h5 class="font-weight-bold">@{{ tipo.nombre }}</h5>
                <!-- Título de la categoría -->
                <hr>
              </div>
              <!-- Lista de subcategorías -->
              <div v-for="carac in tipo.caracteristicas" :key="carac.id">
                <div class="subcategoriaDiv d-flex align-items-center">
                  <input type="checkbox" :id="'subcategoria_' + carac.id" v-model="subcategoriasSeleccionadas" :value="carac.id" @change="getEquipos">
                  <label class="pl-2" style="margin-top: 10px;" :for="'subcategoria_' + carac.id">@{{ carac.nombre }}</label>
                  <!-- Nombre de la subcategoría -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Columna de productos -->
        <div class="col-md-9">
          <div class="row">
            <!-- Tarjetas de productos -->
            <div v-for="equipo in equipos" :key="equipo.id" class="col-md-4">
              <div class="productDiv">
                <div class="card mb-3">
                  <div class="card-header pt-4">
                    <h5 class="card-title">@{{ equipo.nombre }}</h5>
                  </div>
                  <img 
                    v-bind:src="equipo.img ? equipo.img : '/img/tbl/default.png'" 
                    alt="Imagen del equipo" 
                    class="card-img-top" 
                    style="min-height: 300px;max-height: 300px; object-fit: cover;"
                  >

                  <div class="card-body">

                    <div class="row">
                      <div class="col-12">
                        <p class="card-text titleEquipos"><strong>Marca</strong></p>
                        <p class="card-text"><span class="material-icons">chevron_right</span>@{{ equipo.marca }}</p>
                        <p class="card-text titleEquipos"><strong>Modelo</strong></p>
                        <p class="card-text"><span class="material-icons">chevron_right</span>@{{ equipo.modelo }}</p>
                        <p class="card-text titleEquipos"><strong>Año</strong></p>
                        <p class="card-text"><span class="material-icons">chevron_right</span>@{{ equipo.anio }}</p>
                      </div>
                    </div>

                    <div class="row">
                      <div v-if="equipo.link_ficha_tecnica" class="col-12 d-flex align-items-center pt-3">
                        <a :href="equipo.link_ficha_tecnica" target="_blank" class="w-100 btn btn-outline-success">Descargar ficha técnica</a>
                      </div>

                      <div class="col-12 d-flex align-items-center pt-3">
                        <button class="w-100 btn btn-primary" @click="seleccionarEquipo(equipo)" data-toggle="modal" data-target="#arriendoEquipo">Cotizar</button>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('tbl.include.trabaja_con_nosotros')

  @include('tbl.modals.cotizaEquipo')
  @include('tbl.include.footer')
</div>


<script>
  let equipos = new Vue({
    el: '#vueEquipos',
    data: {
      total: 0,
      equipos: [],
      tipos: [],
      subcategoriasSeleccionadas: [],
      animationTriggered: {},
      elements: [],
      filtrosVisibles: true,
      filters: 'Ocultar filtros',
      cotiza: {
        nombre: '',
        telefono: '',
        email: '',
        origen: '',
        destino: '',
        fecha_servicio: '',
        fecha_termino: '',
        comentarios: '',
        equipo: {},
      },
      equipoSeleccionado: {},
    },
    created() {
      this.getTiposEquipos();
      this.getEquipos();
      this.getVisitas();
    },
    mounted() {
      this.updateElements();
      window.addEventListener('scroll', this.handleScroll);
    },
    methods: {
      getTiposEquipos() {
        axios.get('/tiposEquipos')
          .then(response => {
            this.tipos = response.data.datos;
          })
          .catch(error => {
            console.error('Error al obtener categorías:', error);
          });
      },
      getEquipos() {
        axios.get('/getEquipos', {
            params: {
              subcategorias: this.subcategoriasSeleccionadas
            }
          })
          .then(response => {
            this.equipos = response.data.equipos;
          })
          .catch(error => {
            console.error('Error al obtener productos:', error);
          });
        console.log(this.equipos)
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
      },
      toggleFiltros() {
        this.filtrosVisibles = !this.filtrosVisibles;
        if (this.filtrosVisibles) {
          this.filters = 'Ocultar filtros';
        } else {
          this.filters = 'Ver filtros';
        }
      },
      seleccionarEquipo(equipo) {
        this.equipoSeleccionado = equipo;
        this.cotiza.equipo = equipo;
      },
      guardarCotizacionEquipo() {
        axios.post('/guardarCotizacion', this.cotiza)
          .then(response => {
            $("#arriendoEquipo").modal('hide'); 
            // Manejar la respuesta exitosa
            if (response.data.status === 'ok') {
              $("#successContact").modal('show');    
              setTimeout(() => {
                $("#successContact").modal('hide'); 
              }, 4000); 

              this.limpiarContacto();
            }
                    
          })
          .catch(error => {
            // Manejar el error
            console.error('Hubo un error al enviar el formulario', error);
          });
      },
      limpiarForm(){
        this.cotiza.nombre = '';
        this.cotiza.telefono = '';
        this.cotiza.correo = '';
        this.cotiza.comentarios = '';
        this.cotiza.equipo = {};
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
</script>

@endsection