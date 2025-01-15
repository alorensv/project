@extends('lex.plantilla')

@section('content')

<div id="vueValidez">


<!-- Modal de contacto -->
<div class="modal fade" id="successContact"  tabindex="-1" aria-labelledby="successContactLabel" aria-hidden="true">
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
          <p>¡Hemos recibido tu mensaje con éxito, te contactaremos lo más luego posible!</p>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>


  <section class="welcome">
    <div>
      <div class="bgInicio">
        <div class="container section-phone-padding">
          <div class="row celContainer">
            <div class="col-lg-7 padding-title-presentation-large titleOne titlePrincipal">
              <h4 class="pb-2">¡Contáctanos y te apoyamos en todas tus dudas!</h4>
              <h2 class="pb-2">
                Un equipo de abogados e informáticos preparados para resolver tus dudas
              </h2>
              

              <div class="p-5">
              <p>Formulario de contacto.</p>
              <form @submit.prevent="guardarContacto">
                @csrf
                <!-- Formulario de contacto -->
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" v-model="contacto.nombre" placeholder="Acá tu nombre" required maxlength="255" id="nombre" required>
                </div>
                <div class="form-group">
                  <label for="telefono">Teléfono</label>
                  <input type="text" class="form-control" v-model="contacto.telefono" placeholder="Recuerda ingresar el +569 " required maxlength="255" id="telefono">
                </div>
                <div class="form-group">
                  <label for="correo">Correo</label>
                  <input type="email" class="form-control" v-model="contacto.correo" placeholder="Acá tu correo" required maxlength="255" id="correo" required>
                </div>
                <div class="form-group">
                  <label for="comentarios">Mensaje:</label>
                  <textarea class="form-control" v-model="contacto.comentarios" placeholder="Haznos saber tus dudas o consultas" required maxlength="255" rows="4" id="comentarios" required></textarea>
                </div>
                <button type="submit" class="w-100 btn btn-primary">Enviar</button>
              </form>
              </div>

              
            </div>

            <div class="col-lg-5 displayNoneCel">
              <div class="sticky-top">
              <img src="/img/lex/contacto.png" alt="Documento legal" class="img-fluid documento-legal">
              </div>
              
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


  </section>


  @include('lex.include.footer')




</div>


<script>
  let validez = new Vue({
    el: '#vueValidez',
    data: {
      contacto: {
        nombre: '',
        telefono: '',
        correo: '',
        comentarios: '',
      },
      categoriasDocumentos: @json($categoriasDocumentos), // Pasar los datos del backend
      searchQuery: '',
      filteredDocuments: [] // Lista de documentos filtrados
    },
    mounted() {
      document.getElementById('documentoSelect').addEventListener('change', this.redirigirDocumento);
    },
    methods: {
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