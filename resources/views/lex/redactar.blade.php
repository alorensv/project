@extends('lex.plantilla')

@section('content')

<div id="vueRedaccion" data-inputs="{{ json_encode($inputs) }}">

  <div v-bind:class="{ 'loader': loading }" v-cloak></div>


  <section class="white-division pt-2 pb-2">
    <div class="container">
      <div class="row market-body mt-5 pt-5">
        <!-- Columna de categorías (Panel de Inputs) -->
        <div class="col-md-4">
          <div class="filtrosDiv">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title titleFormDoc">Datos generales</h4>

                <div v-for="(input, index) in inputs" :key="index" class="mb-3">

                  <h4 class="card-title titleFormDoc pt-2 pb-2" v-if="input.name === 'nombre'">Declarante(s)</h4>
                  <h4 class="card-title titleFormDoc pt-2 pb-2" v-if="input.name === 'declaracion'">Declaración</h4>
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
                  <select v-else-if="input.field_type === 'select' && ( input.name === 'region' || input.name === 'region_domicilio' )"
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
                    <option v-for="region in regiones" :key="region.id" :value="region.nombre">@{{ region.nombre }}</option>
                  </select>

                  <!-- Select de comuna -->
                  <select v-else-if="input.field_type === 'select' && ( input.name === 'comuna' || input.name === 'comuna_domicilio' ) "
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


                  <!-- Select de estado civil -->
                  <select v-else-if="input.field_type === 'select' && input.name === 'estado_civil'  "
                    :id="input.name"
                    v-model="input.value"
                    :class="{'is-invalid': errors[input.name]}"
                    @focus="focusField(input.name)"
                    @blur="blurField(input.name)"
                    class="form-control">
                    <option value="Soltero" selected>Soltero</option>
                    <option value="Casado">Casado</option>
                    <option value="Divorciado/a">Divorciado/a</option>
                  </select>

                  <!-- text rut -->
                  <input 
                    v-else-if="input.name === 'rut'"
                    :type="input.field_type"
                    :id="input.name"
                    v-model="input.value"
                    :placeholder="input.placeholder"
                    :class="{'is-invalid': errors[input.name]}"
                    @focus="focusField(input.name)"
                    @blur="blurField(input.name)"
                    @input="completeRut(input.name, input.value)"
                    class="form-control"
                  />



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

                <div class="mb-3">
                  <button class="btn btn-primary w-100" @click="mostrarFormularioFirmante = !mostrarFormularioFirmante" style="display: inline-flex;align-items: center;justify-content: center;">
                    Agregar Firmante <span class="material-icons icon pl-2 pr-3">group_add</span> (+$5.000)
                  </button>

                </div>

                <div v-if="mostrarFormularioFirmante" class="mt-3">
                  <div class="mb-3">
                    <label for="nombreFirmante" class="form-label">Nombre</label>
                    <input type="text" id="nombreFirmante" v-model="nuevoFirmante.nombre" class="form-control" placeholder="Nombre del firmante">
                  </div>
                  <div class="mb-3">
                    <label for="apellidoPaternoFirmante" class="form-label">Apellido Paterno</label>
                    <input type="text" id="apellidoPaternoFirmante" v-model="nuevoFirmante.apellido_paterno" class="form-control" placeholder="Apellido paterno del firmante">
                  </div>
                  <div class="mb-3">
                    <label for="apellidoMaternoFirmante" class="form-label">Apellido Materno</label>
                    <input type="text" id="apellidoMaternoFirmante" v-model="nuevoFirmante.apellido_materno" class="form-control" placeholder="Apellido materno del firmante">
                  </div>
                  <div class="mb-3">
                    <label for="rutFirmante" class="form-label">RUT</label>
                    <input type="text" id="rutFirmante" v-model="nuevoFirmante.rut" class="form-control" placeholder="RUT del firmante">
                  </div>
                  <div class="mb-3">
                    <label for="correoFirmante" class="form-label">Correo</label>
                    <input type="email" id="correoFirmante" v-model="nuevoFirmante.correo" class="form-control" placeholder="Correo del firmante">
                  </div>
                  <div class="mb-3">
                    <button class="btn btn-success w-100" @click="agregarFirmante" style="display: inline-flex;align-items: center;justify-content: center;">Guardar Firmante
                      <span class="material-icons icon pl-2">save_as</span>
                    </button>
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
                            <td>@{{ getInputValue('nombre') }} @{{ getInputValue('apellido_paterno') }} @{{ getInputValue('apellido_materno') }}<br>@{{ getInputValue('rut') }}<br>@{{ getInputValue('correo') }}</td>
                          </tr>

                          <!-- Lista de otros firmantes -->
                          <tr v-for="(firmante, index) in firmantes" :key="index">
                            <td>@{{ firmante.nombre }} @{{ firmante.apellido_paterno }} @{{ firmante.apellido_materno }}<br>@{{ firmante.rut }}<br>@{{ firmante.correo }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>


                <div v-if="generalError" class="alert alert-danger mt-3">
                  @{{ generalError }}
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Columna de productos (Cuadro de Declaración Jurada) -->
        <div class="col-md-8 sticky-top" style="max-height: 401px;">
          <div class="card">
            <div class="card-body previsualizacionDocumento" style="box-shadow: rgba(49, 49, 34, 0.3) 0px 0em 2em inset, white 0px 0px 0px 0px, rgba(255, 255, 255, 0.6) 0.3em 0.3em 0em;">
              <div>
                {!! $documento->default_text !!}

                <div class="firmas-container" style="display: flex; flex-wrap: wrap; justify-content: center;">
                  <div v-for="(firmante, index) in firmantes" :key="index" class="mb-3" style="text-align: center; margin-right: 20px;font-size: 20px;">
                    <p>
                      <span>@{{ firmante.nombre }}</span> <span>@{{ firmante.apellido_paterno }}</span> <span>@{{ firmante.apellido_materno }}</span><br>
                      <span>@{{ firmante.rut }}</span><br>
                      <span>@{{ firmante.correo }}</span>
                    </p>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="pt-3">
            <div class="row">
              <div class="col-6">

              </div>
              <div class="col-6">
                <div class="card p-4" style="box-shadow: 10px 10px 15px -6px rgba(168,166,168,0.89);">
                  <table>
                    <tr>
                      <th>Valor documento</th>
                      <td>$9.999</td>
                    </tr>
                    <tr>
                      <th>Firma(s) adicional(es)</th>
                      <td>$5.000</td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <th>$14.999</th>
                    </tr>
                  </table>
                  <div class="mt-3" style="float: right;">
                    <button class="btn btn-success w-100" @click="validateContinue" style="display: inline-flex;align-items: center;justify-content: center;">
                      Pagar <span class="material-icons icon pl-2">payments</span></button>
                  </div>

                </div>





              </div>
            </div>
          </div>
          <!-- Botón para generar PDF 
          <button class="btn btn-primary" @click="generatePDF">Generar PDF</button>
          -->


          <!-- Spinner (loading) 
          <div v-if="loading" class="spinner-border text-primary" role="status">
            <span class="sr-only">Generando PDF...</span>
          </div>-->

          <!-- Modal para mostrar el PDF 
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

          </div>-->

        </div>
      </div>
  </section>

  @include('lex.modals.loginRegister')
  @include('lex.modals.login')
  @include('lex.modals.register')
</div>

<script>
  let redact = new Vue({
    el: '#vueRedaccion',
    data: {
      loader: false,
      correo: '',
      clave: '',
      inputs: JSON.parse(document.getElementById('vueRedaccion').getAttribute('data-inputs')),
      formData: {},
      espaciosRelleno: '_______________________',
      isFocused: {},
      firmantes: [],
      mostrarFormularioFirmante: false, // Controlar el formulario para agregar firmantes
      nuevoFirmante: {
        nombre: '',
        apellido_paterno: '',
        apellido_materno: '',
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
        if (input) {
          if (input.field_type === 'date') {
            const date = new Date(input.value); // Asegúrate de que `input.value` sea una fecha válida
            return date.toLocaleDateString("es-ES", {
              weekday: 'long', // Ej: lunes
              day: 'numeric', // Ej: 1
              month: 'long', // Ej: enero
              year: 'numeric' // Ej: 2023
            });
          }
          return input.value; // Si no es tipo date, devuelve el valor sin cambios
        }
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
      async fetchComunas(regionInput) {
        this.loading = true;
        if (!regionInput) {
          return;
        }
        console.log(JSON.stringify(this.regiones));
        const regionSeleccionada = this.regiones.find(region => region.nombre === regionInput);
        regionId = regionSeleccionada.codigo;
        if (regionId) {
          try {
            const response = await axios.get(`/lexcomunas/${regionId}`);
            this.comunas = response.data;
            this.loading = false;
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
      completeRut(name, value) {
        // Encuentra el input correspondiente por nombre
        const input = this.inputs.find(input => input.name === name);

        // Si no encuentra el input, termina la función
        if (!input) return;

        // Remueve caracteres que no sean números o 'k' para mantener sólo la raíz y el dígito verificador
        let rut = value.replace(/[^0-9kK]/g, '');

        // Formateo básico, agregando guion y puntos
        if (rut.length > 1) {
          rut = rut.slice(0, -1) + '-' + rut.slice(-1); // Agrega el guion antes del dígito verificador
        }
        if (rut.length > 5) {
          rut = rut.slice(0, -5) + '.' + rut.slice(-5); // Agrega el primer punto
        }
        if (rut.length > 9) {
          rut = rut.slice(0, -9) + '.' + rut.slice(-9); // Agrega el segundo punto
        }

        // Actualiza el valor del input con el RUT formateado
        input.value = rut;
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

          let firmantesContainer = document.getElementById("posiblesFirmantes");

          if (firmantesContainer) {
            this.firmantes.forEach((firmante, index) => {
              let firmanteHTML = document.createElement('span');
              firmanteHTML.innerHTML = (index > 0 ? ', ' : ', ') + firmante.nombre + firmante.apellido_paterno + firmante.apellido_materno + ' R.U.N. ' + firmante.rut + ' con domicilio para estos efectos en ';
              firmantesContainer.appendChild(firmanteHTML);
            });
          }

          this.nuevoFirmante = {
            nombre: '',
            apellido_paterno: '',
            apellido_materno: '',
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

          if (input.name == 'rut') {
            if (!this.validarRut(input.value)) {
              this.errors[input.name] = `El RUT ingresado es inválido.`;
            }
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
      validarRut(rut) {
        // Limpiar el RUT de caracteres no numéricos
        const cleanedRut = rut.replace(/[^0-9kK]/g, '');

        const match = cleanedRut.match(/(\d+)-?([0-9kK]{1})/);
        if (!match) return false;

        const [, num, dv] = match;
        const rutNumber = parseInt(num, 10);
        const dvCalculated = this.calcularDv(rutNumber).toString(); // Asegurarse de que sea una cadena

        return dv.toLowerCase() === dvCalculated.toLowerCase();
      },

      calcularDv(rut) {
        let M = 0,
          S = 1;
        for (; rut; rut = Math.floor(rut / 10)) {
          S = (S + rut % 10 * (9 - M++ % 6)) % 11;
        }
        const dv = S ? S - 1 === 10 ? 'k' : (S - 1).toString() : '0'; // Asegurarse de que el DV sea una cadena
        return dv;
      },
      async continuarInvitado() {
        this.loading = true;

        try {
          // Crear el objeto que contendrá los valores de los inputs
          this.guardarRedaccion();

          // Redireccionar al carrito de compras
          window.location.href = '/carroCompras';

        } catch (error) {
          console.error('Error al guardar la redacción:', error);
          this.loading = false;
        }
      },
      consultarCorreo() {
        axios.get('/existeUsuario', {
            params: {
              correo: this.correo
            }
          })
          .then(response => {
            if (response.data.message == 'ok') {
              $('#loginRegister').modal('hide');
              $('#login').modal('show');
            } else {
              $('#loginRegister').modal('hide');
              $('#register').modal('show');
            }
          })
          .catch(error => {
            console.error('Error al obtener productos:', error);
          });
      },
      _submitLogin: function() {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var claveEncriptada = this.clave;
        var remember = 'false';
        var infoResult = false;

        axios.post('/login', {
            _token: csrfToken,
            email: this.correo,
            password: claveEncriptada,
            remember: remember,
          })
          .then(response => {

            infoResult = this.guardarRedaccion();
            if(infoResult){
              window.location.href = '/carroCompras';
            }else{
              // mostrar un popup con el error al intentar guardar redacción
            }
          
          })
          .catch(error => {
            console.error('Error al enviar el formulario:', error);
          });
      },
      submitLogin: function() {
        this._submitLogin();
      },
      loginTrue() {
        this.loading = true;
      },
      async guardarRedaccion() {
        let formData = {};

        // Recorremos los inputs y construimos el formData con sus valores
        this.inputs.forEach(input => {
          formData[input.name] = input.value; // Asignar el valor correspondiente
        });

        // Agregar otros datos como documento_id al formData
        formData['documento_id'] = 1;

        // Crear el array de firmantes, comenzando por el firmante principal
        formData['firmantes'] = [{
            nombre: this.getInputValue('nombre'),
            rut: this.getInputValue('rut'),
            correo: this.getInputValue('correo')
          },
          ...this.firmantes // Incluir los firmantes adicionales
        ];

        // Hacer petición para guardar la redacción
        let response = await axios.post('/guardarRedaccion', formData);

        //PENDING RETURN RESPONSE OK OR ERROR
        
        console.log(response);
        this.loading = false;
        return true;
      }

    }
  });
</script>

@endsection