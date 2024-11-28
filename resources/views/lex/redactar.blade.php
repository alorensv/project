@extends('lex.plantilla')

@section('content')

<div id="vueRedaccion" data-inputs="{{ json_encode($inputs) }}">

  <div v-bind:class="{ 'loader': loading }" v-cloak></div>


  <section class="white-division pt-2 pb-2">
    <div class="container">

      <div class="pt-4 mt-2" style="background-color: #FB3F5C;color: white;padding: 20px;padding-bottom: 10px;">
        Sección de avisos
      </div>

      <div class="row market-body mt-1 pt-1">
        <!-- Columna de categorías (Panel de Inputs) -->
        <div class="col-md-4">
          <div class="filtrosDiv">
            <div class="card">
              <div class="card-body">
                @if($documento->lex_categoria_id == 1)
                @include('lex.forms.declaraciones')
                @else
                @include('lex.forms.poderes')
                @endif
              </div>

            </div>
          </div>
        </div>

        <!-- Columna de productos (Cuadro de Declaración Jurada) -->
        <div class="col-md-8 sticky-top" style="max-height: 401px;">
          <div class="card">
            <div class="card-body previsualizacionDocumento" style="box-shadow: rgba(49, 49, 34, 0.3) 0px 0em 2em inset, white 0px 0px 0px 0px, rgba(255, 255, 255, 0.6) 0.3em 0.3em 0em;">
              <div>

              <div>
                  <div v-if="firmantes.length === 0">
                      {!! $documento->default_text !!}
                  </div>
                  <div v-else>
                      {!! $documento->default_text_plural !!}
                  </div>
              </div>


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
                      <td>${{ number_format($documento->precio, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                      <th>Firma(s) adicional(es)</th>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <td>${{ number_format($documento->precio, 0, ',', '.') }}</td>
                    </tr>
                  </table>
                  <div class="mt-3" style="float: right;">
                    <button class="btn btn-success w-100" @click="validateContinue" :authenticated="{{ Auth::check() ? 'true' : 'false' }}" style=" display: inline-flex;align-items: center;justify-content: center;">
                      Pagar <span class="material-icons icon pl-2">payments</span></button>
                  </div>

                </div>





              </div>
            </div>
          </div>

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
      authenticated: {
        type: Boolean,
        default: false
      },
      loader: false,
      documentoId: <?php echo json_encode($documento->id); ?>,
      correo: '',
      clave: '',
      inputs: JSON.parse(document.getElementById('vueRedaccion').getAttribute('data-inputs')),
      formData: {},
      espaciosRelleno: '_______________________',
      isFocused: {},
      isAccordionOpen: false,
      firmantes: [],
      mostrarFormularioFirmante: false, // Controlar el formulario para agregar firmantes
      nuevoFirmante: {
        nombre: '',
        apellido_paterno: '',
        apellido_materno: '',
        rut: '',
        correo: '',
        nacionalidad: '',
        estado_civil: '',
        profesion_oficio: '',
        domicilio: '',
        comuna: '',
        region: '',
      },
      loading: false,
      errors: {},
      generalError: '',
      firmantesError: '',
      regiones: [],
      comunas: [],
      nacionalidades: [],
      estados_civiles: [],
      selectedRegion: null
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
      this.fetchNacionalidades();
      this.fetchEstadosCiviles();
    },
    methods: {
      getInputValue(fieldName) {
        const input = this.inputs.find(input => input.name === fieldName);
        if (input) {
          if (input.field_type === 'date') {
            const date = new Date(input.value); // Asegúrate de que `input.value` sea una fecha válida
            return date.toLocaleDateString("es-ES", {
              weekday: 'long', // Ej: lunes
              day: 'numeric', // Ej: 1
              month: 'long', // Ej: enero
              year: 'numeric',
              timeZone: 'America/Santiago'
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
      async fetchNacionalidades() {
        try {
          axios.get('/nacionalidades')
            .then((response) => {

              this.nacionalidades = response.data.nacionalidades;
            })
            .catch((error) => {
              console.error(error);
            });
        } catch (error) {
          console.error('Error al obtener las nacionalidades:', error);
        }
      },
      async fetchEstadosCiviles() {
        try {
          axios.get('/estados_civiles')
            .then((response) => {

              this.estados_civiles = response.data.estados_civiles;
            })
            .catch((error) => {
              console.error(error);
            });
        } catch (error) {
          console.error('Error al obtener las estados civiles:', error);
        }
      },
      focusField(field) {
        this.isFocused[field] = true;
        this.generalError = '';
        this.errors = {};
      },
      blurField(field) {
        this.isFocused[field] = false;
      },
      completeRut(name, value, type) {
        let input;
        if (type === 'input') {
            input = this.inputs.find(input => input.name === name);
            if (!input) {
                console.warn(`Input con nombre "${name}" no encontrado.`);
                return; // Sal del método si no se encuentra el input
            }
        }

        // Formatea el valor del RUT
        let rut = value.replace(/[^0-9kK]/g, ''); // Elimina caracteres no permitidos
        if (rut.length > 1) {
            rut = rut.slice(0, -1) + '-' + rut.slice(-1); // Agrega el guion antes del dígito verificador
        }
        if (rut.length > 5) {
            rut = rut.slice(0, -5) + '.' + rut.slice(-5); // Agrega el primer punto
        }
        if (rut.length > 9) {
            rut = rut.slice(0, -9) + '.' + rut.slice(-9); // Agrega el segundo punto
        }

        // Asigna el valor formateado según el tipo
        if (type === 'firmantes') {
            this.nuevoFirmante.rut = rut;
        } else {
            input.value = rut;
        }
    },
      toggleAccordion() {
        this.isAccordionOpen = !this.isAccordionOpen;
      },
      agregarFirmante() {
        if (this.nuevoFirmante.nombre && this.nuevoFirmante.rut && this.nuevoFirmante.correo && this.nuevoFirmante.domicilio && this.nuevoFirmante.comuna && this.nuevoFirmante.region) {
         
          if (!this.validarRut(this.nuevoFirmante.rut)) {
            this.firmantesError = `El RUT ingresado es inválido.`;
            return;
          }

          if (!this.validarCorreo(this.nuevoFirmante.correo)) {
            this.firmantesError = `El correo ingresado no tiene un formato válido.`;
            return;
          }
         
          this.firmantes.push({
            ...this.nuevoFirmante
          }); // Agregar nuevo firmante

          let firmantesContainer = document.getElementById("posiblesFirmantes");

          if (firmantesContainer) {
            this.firmantes.forEach((firmante, index) => {
              let firmanteHTML = document.createElement('span');
              firmanteHTML.innerHTML = (index > 0 ? ', ' : ', ') + firmante.nombre + ' ' + firmante.apellido_paterno + ' ' + firmante.apellido_materno + ' R.U.N. ' + firmante.rut + ' de nacionalidad ' + firmante.nacionalidad + ', ' + firmante.estado_civil + ', ' + firmante.profesion_oficio  + ', con domicilio para estos efectos en ' + firmante.domicilio + ' de la comuna de ' + firmante.comuna + ' ' + firmante.region + ', ';
              firmantesContainer.appendChild(firmanteHTML);
            });
          }

          this.nuevoFirmante = {
            nombre: '',
            apellido_paterno: '',
            apellido_materno: '',
            rut: '',
            correo: '',
            nacionalidad: '',
            estado_civil: '',
            profesion_oficio: '',
            domicilio: '',
            comuna: '',
            region: '',
          }; // Limpiar el formulario
          this.isAccordionOpen = true;
          this.mostrarFormularioFirmante = false; // Ocultar el formulario
        } else {
          this.firmantesError = "Por favor, completa los campos requeridos para los firmantes.";
          return;
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

        if (this.authenticated) {
          this.loading = true;

          try {
            this.guardarRedaccion();
            window.location.href = '/carroCompras';

          } catch (error) {
            console.error('Error al guardar la redacción:', error);
            this.loading = false;
          }
        }else{
          $('#loginRegister').modal('show');
        }
        
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
      validarCorreo(correo) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(correo);
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
            if (infoResult) {
              window.location.href = '/carroCompras';
            } else {
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
        formData['documento_id'] = this.documentoId;

        // Crear el array de firmantes, comenzando por el firmante principal
        formData['firmantes'] = [{
            nombre: this.getInputValue('nombre'),
            apellido_paterno: this.getInputValue('apellido_paterno'),
            apellido_materno: this.getInputValue('apellido_materno'),
            rut: this.getInputValue('rut'),
            correo: this.getInputValue('correo'),
            domicilio: this.getInputValue('direccion'),
            comuna: this.getInputValue('comuna_domicilio'),
            region: this.getInputValue('region_domicilio'),
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