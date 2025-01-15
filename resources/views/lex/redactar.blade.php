@extends('lex.plantilla')

@section('content')
<div id="vueRedaccion" data-inputs="{{ json_encode($inputs) }}">

  <div v-bind:class="{ 'loader': loading }" v-cloak></div>


  <section class="pt-2 pb-2">
    <div class="container top-phone-padding">

      <!-- <div class="pt-4 mt-2" style="background-color: #FB3F5C;color: white;padding: 20px;padding-bottom: 10px;">
        Sección de avisos
      </div> -->


      <div class="alert alert-warning mt-3">
        <p>Se dispone de 3 intentos para firmar; en caso de error en el ingreso de datos para la firma, tu firma se bloquea por 24 horas por seguridad.</p>
      </div>

      <div v-if="generalError" class="alert alert-danger mt-3 d-flex justify-content-between align-items-center">
        <span>@{{ generalError }}</span>
        <button type="button" class="btn-close" aria-label="Close" @click="closeError"></button>
      </div>




      <div class="row market-body mt-1 pt-1">
        <!-- Columna de categorías (Panel de Inputs) -->
        <div class="col-md-4">
          <div>
            
            @include('lex.forms.formularioFirmantes')

          </div>
        </div>

        <!-- Columna de productos (Cuadro de Declaración Jurada) -->
        <div class="col-md-8 ">
          <div class="sticky-top">
            <div class="card mt-3">
              <div class="card-body previsualizacionDocumento" style="box-shadow: rgba(168, 166, 168, 0.89) 10px 10px 15px -6px;">
                <div>

                  <div class="predocumento">
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
                <div class="col-lg-6">
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
                      <button class="btn btn-success w-100" @click="validateContinue" style=" display: inline-flex;align-items: center;justify-content: center;">
                        Pagar <span class="material-icons icon pl-2">payments</span></button>
                    </div>

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
  @include('lex.modals.autocomplete')
</div>

<script>
  let redact = new Vue({
    el: '#vueRedaccion',
    data: {
      authenticated: <?php echo json_encode(auth()->check()); ?>,
      loader: false,
      documentoId: <?php echo json_encode($documento->id); ?>,
      documentoCategoria: <?php echo json_encode($documento->lex_categoria_id); ?>,
      cantidadFirmantes: <?php echo json_encode($documento->cantidad_firmantes); ?>,
      nombre: '',
      dni: '',
      correo: '',
      clave: '',
      inputs: JSON.parse(document.getElementById('vueRedaccion').getAttribute('data-inputs')),
      tipo_reuniones: [
        {id: 1,nombre: 'JUNTA DE VECINOS'},
        {id: 2,nombre: 'COPROPIETARIOS'}
      ],
      tipos_usos: [
        {id: 1,nombre: 'habitacional'},
        {id: 2,nombre: 'bodega'},
        {id: 3,nombre: 'oficina'},
        {id: 4,nombre: 'comercial'},
        {id: 5,nombre: 'dirección tributaria'}
      ],
      groupedInputs: {},
      accordionState: {},
      formData: {},
      espaciosRelleno: '_______________________',
      isFocused: {},
      isAccordionOpen: false,
      firmantes: [],
      nombreCampoNuevoFirmante: 'Agregar firmantes',
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
        sexo: 'femenino',
      },
      loading: false,
      errors: {},
      generalError: '',
      firmantesError: '',
      regiones: [],
      comunas: [],
      nacionalidades: [],
      estados_civiles: [],
      selectedRegion: null,
      loginError: ''
    },
    mounted() {
      this.nameFormFirmantes();
      window.addEventListener("beforeunload", this.confirmarSalida);
      this.groupInputs();
      this.initializeAccordionState();

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
    computed: {
      groupCompletionStatus() {
        const status = {};
        for (const groupName in this.groupedInputs) {
          const group = this.groupedInputs[groupName];
          const totalFields = group.length;
          const filledFields = group.filter(input => input.value !== '').length; // Campos no vacíos
          status[groupName] = {
            filled: filledFields,
            total: totalFields
          };
        }
        return status;
      }
    },
    watch: {
      // Observa cualquier cambio en los valores de los inputs
      inputs: {
        handler(newValue) {
          // Después de que los inputs cambian, recalculate el estado de los grupos
          this.groupInputs(); // Si modificas algún input, asegúrate de reagruparlos
        },
        deep: true // Asegúrate de escuchar cambios en los valores de los campos dentro de los objetos
      },
    },
    methods: {
      nameFormFirmantes(){
        if( this.documentoCategoria == 1 ){
          this.nombreCampoNuevoFirmante = 'Agregar declarante';
        }

        if( this.documentoCategoria == 2 ){
          this.nombreCampoNuevoFirmante = 'Agregar autorizado';
        }

        if( this.documentoCategoria == 3 ){
          this.nombreCampoNuevoFirmante = 'Agregar autorizado';
        }

        if( this.documentoCategoria == 4 ){
          this.nombreCampoNuevoFirmante = 'Agregar contraparte';
        }
        
      },
      groupInputs() {
        this.groupedInputs = this.inputs.reduce((groups, input) => {
          // Asegúrate de inicializar un valor predeterminado si es un campo vacío
          if (input.field_type === 'radio' && input.name === 'sexo' && !input.value) {
            input.value = "femenino";
          }
          (groups[input.group] = groups[input.group] || []).push(input);
          return groups;
        }, {});
      },
      isGroupCompleteCount(group) {
        const filledFields = group.filter(input => input.value !== '').length;
        return filledFields === group.length;
      },
      isGroupComplete(group) {
        return group.every(input => input.value && input.value.trim() !== '');
      },
      initializeAccordionState() {
        this.accordionState = Object.keys(this.groupedInputs).reduce((state, group) => {
          state[group] = false; // Por defecto, todos cerrados
          return state;
        }, {});
      },

      // Alterna el estado del acordeón
      toggleAccordion(groupName) {
        this.accordionState[groupName] = !this.accordionState[groupName];
      },
      getInputValue(fieldName) {
        // Recorre los grupos y sus inputs
        for (const groupName in this.groupedInputs) {
          const group = this.groupedInputs[groupName];

          // Busca el input dentro de cada grupo
          const input = group.find(input => input.name === fieldName);

          if (input) {
            // Si el tipo de campo es 'date', lo formateamos
            if (input.field_type === 'date') {
              const dateValue = new Date(input.value);
              dateValue.setMinutes(dateValue.getMinutes() + dateValue.getTimezoneOffset()); // Ajusta la zona horaria

              // Verifica si la fecha es válida
              if (!isNaN(dateValue)) {
                return dateValue.toLocaleDateString("es-ES", {
                  weekday: 'long',
                  day: 'numeric',
                  month: 'long',
                  year: 'numeric'
                });
              } else {
                return 'Fecha no válida';
              }
            }


            // Si no es tipo 'date', retorna el valor del input
            return input.value;
          }
        }

        // Si no encuentra el input en ningún grupo, retorna una cadena vacía
        return '';
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
        console.log("aca")
        console.log(JSON.stringify(this.regiones));
        const regionSeleccionada = this.regiones.find(region =>
          region.nombre.toLowerCase().trim() === regionInput.toLowerCase().trim()
        );
        if (!regionSeleccionada) {
          console.error(`No se encontró una región con el nombre: "${regionInput}"`);
          this.loading = false;
          return;
        }
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
      async fetchNacionalidades(sexo = 'femenino') {

        try {
          const response = await axios.get(`/nacionalidades`, {
            params: {
              sexo
            }, // Enviar el género como parámetro
          });
          this.nacionalidades = response.data.nacionalidades; // Actualizar la lista
        } catch (error) {
          console.error('Error al obtener las nacionalidades:', error);
        }

      },
      async fetchEstadosCiviles(sexo = 'femenino') {
        try {
          const response = await axios.get(`/estados_civiles`, {
            params: {
              sexo
            }, // Enviar el género como parámetro
          });
          this.estados_civiles = response.data.estados_civiles; // Actualizar la lista
        } catch (error) {
          console.error('Error al obtener los estados civiles:', error);
        }
      },
      async fetchInputs(sexo = 'femenino') {
        this.fetchNacionalidades(sexo);
        this.fetchEstadosCiviles(sexo);
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

        if (!value && value !== '') {
          return; // Si el valor es undefined o null, no hacemos nada y salimos
        }

        let input;
        if (type === 'input') {
          for (const groupName in this.groupedInputs) {
            const group = this.groupedInputs[groupName];

            // Buscar el input dentro del grupo
            input = group.find(input => input.name === name);

            if (input) {
              break; // Si encontramos el input, salimos del loop
            }
          }

          if (!input) {
            console.warn(`Input con nombre "${name}" no encontrado.`);
            return; // Salir si no se encuentra el input
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

          if (this.authenticated && rut.length > 10) {

            console.log("Authenticated:", this.authenticated); // Verificar el valor
            axios.get(`/buscarFirmante/${rut}`, {}).then(response => {
              if (response.data.firmante) {

                this.showMatchPopup(response.data.firmante);

              }
            }).catch(error => {
              console.error('Error:', error);
            });
          }
        }
      },

      // Función para mostrar el popup de coincidencia
      showMatchPopup(firmante) {
        // Muestra el modal de Bootstrap

        const modal = new bootstrap.Modal(document.getElementById('matchModal'));
        modal.show();
        // Aquí asignamos la información del firmante al modal
        this.firmanteEncontrado = firmante;
      },

      // Función para aceptar el autocompletado de los datos
      acceptAutoComplete() {
        // Asigna los valores al formulario con los datos del firmante
        this.assignValueToGroupedInput('nombre', this.firmanteEncontrado.nombres);
        this.assignValueToGroupedInput('apellido_paterno', this.firmanteEncontrado.apellido_paterno);
        this.assignValueToGroupedInput('apellido_materno', this.firmanteEncontrado.apellido_materno);
        this.assignValueToGroupedInput('nacionalidad', this.firmanteEncontrado.nacionalidad_nombre);
        this.assignValueToGroupedInput('estado_civil', this.firmanteEncontrado.estado_civil_nombre);
        this.assignValueToGroupedInput('profesion_oficio', this.firmanteEncontrado.profesion_oficio);
        this.assignValueToGroupedInput('region_domicilio', this.firmanteEncontrado.region);
        this.assignValueToGroupedInput('comuna_domicilio', this.firmanteEncontrado.comuna);
        this.assignValueToGroupedInput('direccion', this.firmanteEncontrado.domicilio);
        this.assignValueToGroupedInput('correo', this.firmanteEncontrado.correo);

        // Cierra el modal
        this.closeModal('matchModal');
      },

      // Función para rechazar el autocompletado de los datos
      rejectAutoComplete() {
        this.closeModal('matchModal');
      },
      closeModal(id) {
        const modalElement = document.getElementById(id);
        if (modalElement) {
          const modalInstance = bootstrap.Modal.getInstance(modalElement);
          if (!modalInstance) {
            const newModalInstance = new bootstrap.Modal(modalElement);
            newModalInstance.hide();
          } else {
            modalInstance.hide();
          }
        } else {
          console.error(`Modal con ID ${id} no encontrado.`);
        }
      },
      assignValueToGroupedInput(fieldName, value) {
        if (fieldName == 'region_domicilio') {
          this.fetchComunas(value);
        }
        for (const groupName in this.groupedInputs) {
          const group = this.groupedInputs[groupName];

          // Busca el input dentro del grupo
          const input = group.find(input => input.name === fieldName);


          if (input) {
            this.$set(input, 'value', value); // Usa $set para que Vue detecte el cambio
            return true; // Salir del método si se encuentra y asigna el valor
          }
        }

        console.warn(`Input con nombre "${fieldName}" no encontrado.`);
        return false; // Retorna falso si no encuentra el campo
      },

      toggleAccordionFirmantes() {
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

            firmantesContainer.innerHTML = '';

            this.firmantes.forEach((firmante, index) => {
              let firmanteHTML = document.createElement('span');

              // Verificar si es el único firmante
              if (this.firmantes.length === 1) {
                firmanteHTML.innerHTML = ' y ' + firmante.nombre + ' ' + firmante.apellido_paterno + ' ' + firmante.apellido_materno +
                  ' cédula de identidad ' + firmante.rut + ' de nacionalidad ' + firmante.nacionalidad + ', ' + firmante.estado_civil +
                  ', ' + firmante.profesion_oficio + ', con domicilio en ' + firmante.domicilio +
                  ', comuna ' + firmante.comuna + ', ' + firmante.region;
              }
              // Verificar si es el último firmante
              else if (index === this.firmantes.length - 1) {
                firmanteHTML.innerHTML = ' y ' + firmante.nombre + ' ' + firmante.apellido_paterno + ' ' + firmante.apellido_materno +
                  ' cédula de identidad ' + firmante.rut + ' de nacionalidad ' + firmante.nacionalidad + ', ' + firmante.estado_civil +
                  ', ' + firmante.profesion_oficio + ', con domicilio en ' + firmante.domicilio +
                  ', comuna ' + firmante.comuna + ', ' + firmante.region;
              }
              // Para cualquier otro firmante
              else {
                firmanteHTML.innerHTML = ', ' + firmante.nombre + ' ' + firmante.apellido_paterno + ' ' +
                  firmante.apellido_materno + ' cédula de identidad ' + firmante.rut + ' de nacionalidad ' + firmante.nacionalidad +
                  ', ' + firmante.estado_civil + ', ' + firmante.profesion_oficio + ', con domicilio en ' +
                  firmante.domicilio + ', comuna ' + firmante.comuna + ', ' + firmante.region;
              }

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
            sexo: 'femenino',
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

        this.loading = true;
        // Resetear errores previos
        this.errors = {};
        this.generalError = '';

        // Validar campos requeridos recorriendo los inputs
        Object.values(this.groupedInputs).forEach(group => {
          group.forEach(input => {
            if (input.required && !input.value) {
              this.errors[input.name] = `El campo ${input.label || input.name} es requerido.`;
              this.loading = false;
            }

            if (input.name === 'rut' && !this.validarRut(input.value)) {
              this.errors[input.name] = `El RUT ingresado es inválido.`;
              this.loading = false;
            }
          });
        });

        // Si hay errores, mostrar mensaje de error general
        if (Object.keys(this.errors).length > 0) {
          this.generalError = "Por favor, completa los campos requeridos.";
          this.loading = false;

          this.$nextTick(() => {
            // Esperar a que el DOM se actualice
            const alertElement = this.$el.querySelector(".alert-danger");
            if (alertElement) {
              const rect = alertElement.getBoundingClientRect();
              const offsetTop = window.scrollY + rect.top - 90; // Ajusta 30px hacia arriba
              window.scrollTo({
                top: offsetTop,
                behavior: "smooth",
              });
            }
          });


          return;
        }

        if (this.authenticated) {

          try {

            infoResult = this.guardarRedaccion();
            if (infoResult) {
              this.beforeDestroy();
              window.location.href = '/carroCompras';
            } else {
              this.loading = false;
              this.generalError = 'Error al guardar la redacción';
            }

          } catch (error) {
            console.error('Error al guardar la redacción:', error);
            this.loading = false;
          }

        } else {
          this.loading = false;
          const modal = new bootstrap.Modal(document.getElementById('loginRegister'));
          modal.show();
        }

      },
      closeError() {
        this.generalError = "";
      },
      closeLoginError(){
        this.loginError = "";
      },
      validarRut(rut) {
        if (!rut) {
          return false;
        }
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

          infoResult = this.guardarRedaccion();
          if (infoResult) {
            this.beforeDestroy();
            window.location.href = '/carroCompras';
          } else {
            this.loading = false;
            this.generalError = 'Error al guardar la redacción';
          }

        } catch (error) {
          console.error('Error al guardar la redacción:', error);
          this.loading = false;
        }


      },
      consultarCorreo() {
        this.loading = true;
        axios.get('/existeUsuario', {
            params: {
              correo: this.correo
            }
          })
          .then(response => {
            if (response.data.message == 'ok') {
              this.loading = false;
              this.closeModal('loginRegister');
              const modal = new bootstrap.Modal(document.getElementById('login'));
              modal.show();
            } else {
              this.loading = false;
              this.closeModal('loginRegister');
              const modal = new bootstrap.Modal(document.getElementById('register'));
              modal.show();
            }
          })
          .catch(error => {
            this.loading = false;
            console.error('Error :', error);
          });
      },
      _submitLogin: function() {
        this.loading = true;
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

            try {

              infoResult = this.guardarRedaccion();
              if (infoResult) {
                this.beforeDestroy();
                window.location.href = '/carroCompras';
              } else {
                this.loading = false;
                this.generalError = 'Error al guardar la redacción';
              }

            } catch (error) {
              console.error('Error al guardar la redacción:', error);
              this.loading = false;
            }


          })
          .catch(error => {
            this.loading = false;
            this.loginError = error.response?.data?.errors || 'Error al iniciar sesión.';
            console.error('Error al enviar el formulario:', error);
          });
      },
      submitLogin: function() {
        this._submitLogin();
      },
      _submitRegister: function() {
        this.loading = true;
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var claveEncriptada = this.clave;
        //this.clave = '';
        //this.nombre = 'Test';
        this.password_confirmation = this.clave;

        // Enviar los datos al servidor usando HTTPS
        axios.post('/register', {
            _token: csrfToken,
            name: this.nombre,
            email: this.correo,
            password: claveEncriptada,
            dni: this.dni,
            password_confirmation: this.password_confirmation,
          })
          .then(response => {

            try {

              infoResult = this.guardarRedaccion();
              if (infoResult) {
                this.beforeDestroy();
                window.location.href = '/carroCompras';
              } else {
                this.loading = false;
                this.generalError = 'Error al guardar la redacción';
              }

            } catch (error) {
              console.error('Error al guardar la redacción:', error);
              this.loading = false;
            }


          })
          .catch(error => {
            console.error('Error al enviar el formulario:', error);
          });
      },
      submitRegister: function() {
        this._submitRegister();
      },
      loginTrue() {
        this.loading = true;
      },
      async guardarRedaccion() {
        let formData = {};

        // Recorremos los inputs y construimos el formData con sus valores
        for (const groupName in this.groupedInputs) {
          const group = this.groupedInputs[groupName];

          // Recorremos los inputs de cada grupo y asignamos sus valores al formData
          group.forEach(input => {
            formData[input.name] = input.value; // Asignar el valor correspondiente
          });
        }

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
            nacionalidad: this.getInputValue('nacionalidad'),
            estado_civil: this.getInputValue('estado_civil'),
            profesion_oficio: this.getInputValue('profesion_oficio'),
          },
          ...this.firmantes // Incluir los firmantes adicionales
        ];

        //console.log(formData)

        // Hacer petición para guardar la redacción
        let response = await axios.post('/guardarRedaccion', formData);

        //PENDING RETURN RESPONSE OK OR ERROR

        //console.log(response);
        this.loading = false;
        return true;
      },
      confirmarSalida(event) {
        const mensaje = "Si sales perderás la redacción. ¿Estás seguro de salir?";
        event.preventDefault();
        event.returnValue = mensaje; // Necesario para navegadores modernos
      },
      beforeDestroy() {
        window.removeEventListener("beforeunload", this.confirmarSalida);
      },
      beforeRouteLeave(to, from, next) {
        const confirmacion = confirm(
            "Si sales perderás la redacción. ¿Estás seguro de salir?"
          );
          if (confirmacion) {
            next(); // Permite el cambio de ruta
          } else {
            next(false); // Cancela el cambio de ruta
          }
      },

    }
  });
</script>

@endsection