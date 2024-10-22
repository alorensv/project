@extends('lex.plantilla')

@section('content')

<div id="vueRedaccion" data-inputs="{{ json_encode($inputs) }}">
  <section class="white-division pt-2 pb-2">
    <div class="container">
      <div class="row market-body mt-5 pt-5">
        <!-- Columna de categorías (Panel de Inputs) -->
        <div class="col-md-4">
          <div class="filtrosDiv">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Datos generales</h3>

                <div v-for="(input, index) in inputs" :key="index" class="mb-3">
                  <label :for="input.name" class="form-label">@{{ input.label }}</label>

                  <!-- Condicional para textarea -->
                  <textarea v-if="input.field_type === 'textarea'"
                    :id="input.name"
                    v-model="input.value"
                    :placeholder="input.placeholder"
                    :class="{'is-invalid': errors[input.name]}"
                    @focus="focusField(input.name)"
                    @blur="blurField(input.name)"
                    class="form-control">
                  </textarea>

                  <!-- Select de región -->
                  <select v-else-if="input.field_type === 'select' && input.name === 'region_domicilio'"
                    :id="input.name"
                    v-model="input.value"
                    :class="{'is-invalid': errors[input.name]}"
                    @focus="focusField(input.name)"
                    @blur="blurField(input.name)" 
                    @change="fetchComunas(input.value)"                   
                    class="form-control">
                    <option disabled value selected>
                      @{{ input.placeholder || 'Seleccione una región' }} <!-- Muestra el placeholder o un texto por defecto -->
                    </option>
                    <option  v-for="region in regiones" :key="region.id" :value="region.nombre">@{{ region.nombre }}</option>
                  </select>

                  <!-- Select de comuna -->
                  <select v-else-if="input.field_type === 'select' && input.name === 'comuna_domicilio'"
                    :id="input.name"
                    v-model="input.value"
                    :placeholder="input.placeholder"
                    :class="{'is-invalid': errors[input.name]}"
                    @focus="focusField(input.name)"
                    @blur="blurField(input.name)"                  
                    class="form-control">
                    <option disabled value selected>
                      @{{ input.placeholder || 'Seleccione una comuna' }} <!-- Muestra el placeholder o un texto por defecto -->
                    </option>
                    <option v-for="comuna in comunas" :key="comuna.id" :value="comuna.nombre">@{{ comuna.nombre }}</option>
                  </select>

                  <!-- Condicional para otros tipos de input -->
                  <input v-else
                    :type="input.field_type"
                    :id="input.name"
                    v-model="input.value"
                    :placeholder="input.placeholder"
                    :class="{'is-invalid': errors[input.name]}"
                    @focus="focusField(input.name)"
                    @blur="blurField(input.name)"
                    class="form-control">

                  <div v-if="errors[input.name]" class="invalid-feedback">
                    @{{ errors[input.name] }}
                  </div>
                </div>



                <div class="card">
                  <div class="card-header" id="headingCart">
                    <h5 class="mb-0">
                      <button class="btn btn-link" data-toggle="collapse" data-target="#collapseCart" aria-expanded="true" aria-controls="collapseCart">
                        Firmantes <i class="fas fa-chevron-down"></i>
                      </button>
                    </h5>
                  </div>

                  <div id="collapseCart" class="collapse" aria-labelledby="headingCart">
                    <div class="card-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Firmantes</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Firmante 1 (predefinido) -->
                          <tr>
                            <td>@{{ getInputValue('nombre') }}<br>@{{ getInputValue('rut') }}<br>@{{ getInputValue('correo') }}</td>
                          </tr>

                          <!-- Lista de otros firmantes -->
                          <tr v-for="(firmante, index) in firmantes" :key="index">
                            <td>@{{ firmante.nombre }}<br>@{{ firmante.rut }}<br>@{{ firmante.correo }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <button class="btn btn-primary" @click="mostrarFormularioFirmante = !mostrarFormularioFirmante">
                  Agregar Firmante
                </button>

                <div v-if="mostrarFormularioFirmante" class="mt-3">
                  <div class="mb-3">
                    <label for="nombreFirmante" class="form-label">Nombre</label>
                    <input type="text" id="nombreFirmante" v-model="nuevoFirmante.nombre" class="form-control" placeholder="Nombre del firmante">
                  </div>
                  <div class="mb-3">
                    <label for="rutFirmante" class="form-label">RUT</label>
                    <input type="text" id="rutFirmante" v-model="nuevoFirmante.rut" class="form-control" placeholder="RUT del firmante">
                  </div>
                  <div class="mb-3">
                    <label for="correoFirmante" class="form-label">Correo</label>
                    <input type="email" id="correoFirmante" v-model="nuevoFirmante.correo" class="form-control" placeholder="Correo del firmante">
                  </div>
                  <button class="btn btn-success" @click="agregarFirmante">Guardar Firmante</button>
                </div>

                <div v-if="generalError" class="alert alert-danger mt-3">
                  @{{ generalError }}
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Columna de productos (Cuadro de Declaración Jurada) -->
        <div class="col-md-8">
          <div class="card">
            <div class="card-body" style="    box-shadow: rgba(49, 49, 34, 0.3) 0px -1em 3em inset, white 0px 0px 0px 2px, rgb(255 255 255 / 60%) 0.3em 0.3em 1em;
}">
              <div>
                {!! $documento->default_text !!}

                <div class="firmas-container" style="display: flex; flex-wrap: wrap; justify-content: center;">
                  <div v-for="(firmante, index) in firmantes" :key="index" class="mb-3" style="text-align: center; margin-right: 20px;">
                    <p>
                      <span>@{{ firmante.nombre }}</span><br>
                      <span>@{{ firmante.rut }}</span><br>
                      <span>@{{ firmante.correo }}</span>
                    </p>
                  </div>
                </div>

              </div>
            </div>
          </div>



          <!-- Botón para generar PDF -->
          <button class="btn btn-primary" @click="generatePDF">Generar PDF</button>

          <button class="btn btn-primary" @click="validateContinue">Continuar</button>

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
      inputs: JSON.parse(document.getElementById('vueRedaccion').getAttribute('data-inputs')),
      formData: {},
      espaciosRelleno: '____________________________',
      isFocused: {},
      firmantes: [],
      mostrarFormularioFirmante: false, // Controlar el formulario para agregar firmantes
      nuevoFirmante: {
        nombre: '',
        rut: '',
        correo: ''
      },
      loading: false,
      pdfUrl: '',
      errors: {},
      generalError: '',
      regiones: [], // Guardar las regiones obtenidas del servidor
      comunas: [], // Guardar las comunas correspondientes a la región seleccionada
      selectedRegion: null // Variable para la región seleccionada
    },
    mounted() {

      this.inputs = this.inputs.map(input => ({
        ...input, // Mantener todas las propiedades existentes
        value: "" // Agregar la nueva propiedad 'value' con un valor vacío
      }));

      // Inicializa isFocused con los campos de inputs
      this.inputs.forEach(input => {
        this.$set(this.isFocused, input.name, false); // Cada campo se inicia como false
      });

      this.fetchRegiones();
    },
    methods: {
      toggleFiltros() {
        // Método para activar o desactivar filtros, si es necesario
      },
      getInputValue(fieldName) {
        const input = this.inputs.find(input => input.name === fieldName);
        return input ? input.value : null; // Si existe, retorna el valor, de lo contrario null
      },
      async fetchRegiones() {
        try {
          axios.get('/lexregiones')
            .then((response) => {

              this.regiones = response.data;
              console.log(this.regiones)
            })
            .catch((error) => {
              console.error(error);
            });
        } catch (error) {
          console.error('Error al obtener las regiones:', error);
        }
      },
      async handleRegionChange(regionNombre) {
        
        const regionSeleccionada = this.regiones.find(region => region.nombre === regionNombre);
        if (regionSeleccionada) {
          alert(regionSeleccionada)
          this.fetchComunas(regionSeleccionada.id); // Llama a fetchComunas con el id de la región seleccionada
        }
      },
      async fetchComunas(regionInput) {
        if (!regionInput) {
          return;
        }
        console.log(JSON.stringify(this.regiones));
        const regionSeleccionada = this.regiones.find(region => region.nombre === regionInput);
        regionId = regionSeleccionada.codigo; 
        if(regionId){
          try {
            const response = await axios.get(`/lexcomunas/${regionId}`);
            this.comunas = response.data;
          } catch (error) {
            console.error('Error al obtener las comunas:', error);
          }
        }        
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
      agregarFirmante() {
        if (this.nuevoFirmante.nombre && this.nuevoFirmante.rut && this.nuevoFirmante.correo) {
          this.firmantes.push({
            ...this.nuevoFirmante
          }); // Agregar nuevo firmante
          this.nuevoFirmante = {
            nombre: '',
            rut: '',
            correo: ''
          }; // Limpiar el formulario
          this.mostrarFormularioFirmante = false; // Ocultar el formulario
        } else {
          alert("Por favor, completa todos los campos del firmante.");
        }
      },
      eliminarFirmante(index) {
        this.firmantes.splice(index, 1); // Eliminar firmante por su índice
      },
      validateContinue() {
        // Resetear errores previos
        this.errors = {};
        this.generalError = '';

        // Validar campos requeridos recorriendo los inputs
        this.inputs.forEach(input => {
          if (input.required && !input.value) {
            // Si el campo es requerido y está vacío, agregar un mensaje de error
            this.errors[input.name] = `El campo ${input.label || input.name} es requerido.`;
          }
        });

        // Si hay errores, mostrar mensaje de error general
        if (Object.keys(this.errors).length > 0) {
          this.generalError = "Por favor, completa los campos requeridos.";
          return;
        }

        // Si todo está bien, mostrar el modal de login/register
        $('#loginRegister').modal('show');
      },
      async continuarInvitado() {
        this.loading = true;

        try {
          // Crear el objeto que contendrá los valores de los inputs
          let formData = {};

          // Recorremos los inputs y construimos el formData con sus valores
          this.inputs.forEach(input => {
            formData[input.name] = input.value; // Asignar el valor correspondiente
          });

          // Agregar otros datos como documento_id al formData
          formData['documento_id'] = 1;

          // Crear el array de firmantes, comenzando por el firmante principal
          formData['firmantes'] = [
            {
              nombre: this.getInputValue('nombre'),
              rut: this.getInputValue('rut'),
              correo: this.getInputValue('correo')
            },
            ...this.firmantes // Incluir los firmantes adicionales
          ];

          // Hacer petición para guardar la redacción
          let response = await axios.post('/guardarRedaccion', formData);

          console.log(response);
          this.loading = false;

          // Redireccionar al carrito de compras
          window.location.href = '/carroCompras';

        } catch (error) {
          console.error('Error al guardar la redacción:', error);
          this.loading = false;
        }
      },

    }
  });
</script>

@endsection