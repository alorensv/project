@extends('lex.plantilla')

@section('content')

<div id="vueValidez">

  <section class="welcome">
    <div>
      <div class="bgInicio">
        <div class="container section-phone-padding">
          <div class="row celContainer">
            <div class="col-lg-7 padding-title-presentation-large titleOne titlePrincipal">
              <h4 class="pb-2">¡Te ayudamos a completar tus documentos!</h4>
              <h2 class="pb-2">
                Un equipo de abogados ha redactado las plantillas modelos
              </h2>
              <p>Chao Notaria, tiene a disposición <strong>plantillas modelos</strong> que puedes completar fácilmente y lo haces en tres simples pasos.</p>

              <div class="accordion" id="faqAccordion">
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading1">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                    ¿Qué servicios me ofrece Swap-Lex?
                  </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    Con Swap-Lex, di Chao Notaria usando documentos legales que puedes autorizar con firma electrónica avanzada usando tu clave única.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading2">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                    ¿Cómo funciona?
                  </button>
                </h2>
                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    <ol>
                      <li>Paso 1: Elige un documento.</li>
                      <li>Paso 2: Completa el documento, el cual se va creando frente a tus ojos, a medida que respondes a las preguntas.</li>
                      <li>Paso 3: Firma con clave única y descarga el documento.</li>
                    </ol>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading3">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                    ¿Cuánto cuesta un documento?
                  </button>
                </h2>
                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    El precio varía de acuerdo al número de firmantes y el tipo de documento, el cual parte de $xxxxx, dicho precio se muestra al final de cada plantilla.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading4">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                    Compré y firmé un documento tengo respaldo, si lo pierdo. ¿Qué hago?
                  </button>
                </h2>
                <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    Una vez firmas con clave única el documento, puedes descargarlo y guardarlo en tu PC o celular. Alternativamente, regístrate en nuestra plataforma para un acceso más seguro.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading5">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                    ¿Tengo soporte técnico o legal si tengo dudas con mi documento?
                  </button>
                </h2>
                <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    Sí, siempre tendrás ayuda. Puedes agendar en línea una asesoría o hacer tus preguntas vía WhatsApp.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading6">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                    ¿Cómo puedo presentar los documentos en una institución?
                  </button>
                </h2>
                <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    Los documentos pueden ser presentados electrónicamente o impresos, siempre que estén completos y muestren la certificación electrónica.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading7">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                    ¿Es necesario que un notario valide mi firma electrónica?
                  </button>
                </h2>
                <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    No es necesario, ya que las firmas electrónicas tienen valor legal por sí mismas.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading8">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                    ¿Cuál es la validez legal del documento que firmo electrónicamente en esta plataforma?
                  </button>
                </h2>
                <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    La validez radica en los certificados digitales emitidos por una entidad certificadora autorizada conforme a la Ley N.º 19.799.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading9">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                    ¿Quién puede firmar electrónicamente un documento a través de esta plataforma?
                  </button>
                </h2>
                <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    Cualquier persona mayor de edad, chileno o extranjero, que cuente con clave única.
                  </div>
                </div>
              </div>
            </div>


            </div>
            <div class="col-lg-5 displayNoneCel">
              <div class="sticky-top">
              <img src="/img/lex/faq.png" alt="Documento legal" class="img-fluid documento-legal">
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