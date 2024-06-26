@extends('tbl.plantilla')

@section('content')

<div id="vueEquipos">
  <section class="white-division pt-2 pb-2">
    <div class="container">
      <div class="row market-body mt-5 pt-5">
        <!-- Columna de categorías -->
        <div class="col-md-3">
          <div class="h-100 bg-white pl-4 pr-4 pt-2 pb-2">
            <span class="material-icons float-left">search</span>
            <h4 class="font-weight-bold">Filtros</h4>
            <div v-for="tipo in tipos" :key="tipo.id">
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
                  <img class="card-img-top" :src="equipo.imagen" alt="Imagen del equipo">
                  <div class="card-body">

                    <div class="row">
                      <div class="col-12">
                        <p class="card-text titleEquipos"><strong>Marca</strong></p>
                        <p class="card-text"><span class="material-icons">chevron_right</span>@{{ equipo.marca }}</p>
                        <p class="card-text titleEquipos"><strong>Modelo</strong></p>
                        <p class="card-text"><span class="material-icons">chevron_right</span>@{{ equipo.modelo }}</p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12 d-flex align-items-center pt-3">
                        <button class="w-100 btn btn-primary">Cotizar</button>
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

  <section class="transporte-cargas">
    <div class="container">
      <div class="row">
        <div class="col-6 d-flex justify-content-center align-items-center logoGrande">
          <img src="/img/tbl/logo2.png" alt="" style="width: 50%;">
        </div>
        <div class="col-lg-6 pt-5 text-justify ceroR" id="welcomeTitle">
          <h2 class="pt-3" style="color: white;">
            ¿Porqué trabajar con nosotros?
          </h2>
          <p><br></p>
          <p>
            Equipos de diferentes anchos, largos y altos, tractos, cama baja, ramplas, camas bajas extensibles, ramplas extensibles y drop.
          </p>
          <p>
            Patio de almacenamiento transitorio para cargas con elementos con certificación (elementos de anclaje).
          </p>
          <p>
            Tramitación, pago de permisos y coordinación con Carabineros de Chile para traslado de cargas especiales.
          </p>
          <p>
            Mantenemos vigentes con la aseguradora "Davidson Eltit Asociados", seguros personales (trabajadores), seguros de carga, cabotaje, responsabilidad civil y daños propios.
          </p>
          <p class="pt-4">
            <a href="#" class="btn btn-secondary d-flex align-items-center" style="width: 155px;">Descubre más </a>
          </p>
        </div>
      </div>
    </div>
  </section>
</div>

@include('tbl.include.footer')

<script>
  let equipos = new Vue({
    el: '#vueEquipos',
    data: {
      equipos: [],
      tipos: [],
      subcategoriasSeleccionadas: [],
      animationTriggered: {},
      elements: []
    },
    created() {
      this.getTiposEquipos();
      this.getEquipos();
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
    }
  });
</script>

@endsection