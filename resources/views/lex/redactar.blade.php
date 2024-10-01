@extends('lex.plantilla')

@section('content')

<div id="vueRedaccion">
  <section class="white-division pt-2 pb-2">
    <div class="container">
      <div class="row market-body mt-5 pt-5">
        <!-- Columna de categorías (Panel de Inputs) -->
        <div class="col-md-3">
          <div class="filtrosDiv">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Tipo de Firma</h3>
                <!-- Radio Buttons -->
                <div class="form-check mb-3">
                  <input type="radio" v-model="firma" value="simple" id="firma_simple" class="form-check-input">
                  <label class="form-check-label" for="firma_simple">Firma electrónica simple</label>
                </div>
                <div class="form-check mb-3">
                  <input type="radio" v-model="firma" value="avanzada" id="firma_avanzada" class="form-check-input">
                  <label class="form-check-label" for="firma_avanzada">Firma electrónica avanzada</label>
                </div>

                <!-- Otros Inputs -->
                <div class="mb-3">
                  <label for="nombre" class="form-label">Nombre</label>
                  <input type="text" id="nombre" v-model="nombre" class="form-control" placeholder="Ingresa tu nombre">
                </div>
                <div class="mb-3">
                  <label for="rut" class="form-label">RUT</label>
                  <input type="text" id="rut" v-model="rut" class="form-control" placeholder="Ingresa tu RUT">
                </div>
                <div class="mb-3">
                  <label for="comuna" class="form-label">Comuna</label>
                  <input type="text" id="comuna" v-model="comuna" @focus="focusField('comuna')" @blur="blurField('comuna')" class="form-control" placeholder="Ingresa tu comuna">
                </div>
                <div class="mb-3">
                  <label for="region" class="form-label">Región</label>
                  <input type="text" id="region" v-model="region" class="form-control" placeholder="Ingresa tu región">
                </div>
                <div class="mb-3">
                  <label for="direccion" class="form-label">Dirección</label>
                  <input type="text" id="direccion" v-model="direccion" class="form-control" placeholder="Ingresa tu dirección">
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Columna de productos (Cuadro de Declaración Jurada) -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-body">
              <h3 class="text-center titulo mb-5 mt-3">Declaración Jurada de Residencia</h3>
              <div class="paragraph-style mb-3">
                <p>
                  En <span class="redactarRelleno" :class="{ 'highlight': isFocused.comuna }">@{{ comuna || espaciosRelleno }}</span>, República de Chile, a <span class="redactarRelleno">@{{ fecha }}</span>,
                  por el presente instrumento yo <span class="redactarRelleno">@{{ nombre || espaciosRelleno }}</span>,
                  cédula de identidad número <span class="redactarRelleno">@{{ rut || espaciosRelleno }}</span>, domiciliado en
                  <span class="redactarRelleno">@{{ direccion || espaciosRelleno }}</span>, comuna de
                  <span class="redactarRelleno">@{{ comuna || espaciosRelleno }}</span>,
                  <span class="redactarRelleno">@{{ region || espaciosRelleno }}</span>; declaro que:
                </p>
              </div>

              <div class="paragraph-style mb-3">
                <p>
                  Mi residencia habitual es <span class="redactarRelleno">@{{ direccion || espaciosRelleno }}</span>, comuna de
                  <span class="redactarRelleno">@{{ comuna || espaciosRelleno }}</span>,
                  <span class="redactarRelleno">@{{ region || espaciosRelleno }}</span>.
                </p>
              </div>

              <div class="text-center mb-3">
                <img src="https://www.muysimple.cl/wp-content/uploads/timbre_solo_firma_electronica_muysimple_600x600.png" width="130">
                <p>
                  <span>@{{ nombre || espaciosRelleno }}</span><br>
                  <span>@{{ rut || espaciosRelleno }}</span>
                </p>
              </div>
            </div>
          </div>



          <!-- Botón para generar PDF -->
          <button class="btn btn-primary" @click="generatePDF">Generar PDF</button>

          <button class="btn btn-primary" onclick="$('#loginRegister').modal('show');">Continuar</button>

          <!-- Spinner (loading) -->
          <div v-if="loading" class="spinner-border text-primary" role="status">
            <span class="sr-only">Generando PDF...</span>
          </div>

          <!-- Modal para mostrar el PDF -->
          <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="pdfModalLabel">Documento PDF</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <iframe :src="pdfUrl" width="100%" height="600px"></iframe>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
  </section>

  @include('lex.modals.loginRegister')
</div>

<script>
  let redact = new Vue({
    el: '#vueRedaccion',
    data: {
      firma: '', // Firma seleccionada
      nombre: '',
      rut: '',
      comuna: '',
      region: '',
      direccion: '',
      fecha: new Date().toLocaleDateString('es-CL'),
      espaciosRelleno: '____________________________',
      isFocused: {
        comuna: false
      },
      loading: false,
      pdfUrl: '',
    },
    methods: {
      toggleFiltros() {
        // Método para activar o desactivar filtros, si es necesario
      },
      focusField(field) {
        this.isFocused[field] = true;
      },
      blurField(field) {
        this.isFocused[field] = false;
      },
      async generatePDF() {
        this.loading = true;

        try {
          // Hacer petición para generar PDF
          let response = await axios.post('/generate-pdf', {
            comuna: this.comuna,
            // otros datos
          });

          this.pdfUrl = '/storage/lex/' + response.data.filename; // ruta del archivo generado
          this.loading = false;

          // Mostrar el modal con el PDF
          $('#pdfModal').modal('show');
        } catch (error) {
          console.error('Error al generar el PDF:', error);
          this.loading = false;
        }
      },
      async continuarInvitado() {
        this.loading = true;

        try {
          // Hacer petición para generar PDF
          let response = await axios.post('/guardarRedaccion', {
            comuna: this.comuna,
            documento_id : 1,
            // otros datos
          });
          console.log(response);
          this.loading = false;
          window.location.href = '/carroCompras';
        } catch (error) {
          console.error('Error al generar el PDF:', error);
          this.loading = false;
        }
      },
    }
  });
</script>

@endsection