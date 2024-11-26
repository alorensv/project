<script>
    import Loader from "../components/Loader.vue";
    import Declaraciones from "../components/redaccion/Declaraciones.vue";
    import Poderes from "../components/redaccion/Poderes.vue";
    import Previsualizacion from "../components/redaccion/Previsualizacion.vue";

    export default {
        components: {
            Loader,
            Declaraciones,
            Poderes,
            Previsualizacion,
        },
        props: {
            statusMessage: {
                type: String,
                default: null, // Si no lo usas, considera eliminar esta prop
            },
            inputs: {
                type: Array, // Ajusta según el tipo de datos real
                required: true,
            },
            documento: {
                type: Object, // Ajusta según el tipo de datos real
                required: true,
            },
        },
        data() {
            return {
                loaderActive: false,
                firmantes: [], // Lista de firmantes
                nuevoFirmante: {
                    nombre: '',
                    apellido_paterno: '',
                    apellido_materno: '',
                    rut: '',
                    correo: '',
                    domicilio: '',
                    region: '',
                    comuna: ''
                },
                generalError: null,  // Error general
                firmantesError: null,  // Error al agregar firmantes
                mostrarFormularioFirmante: false, // Estado para mostrar/ocultar formulario de firmantes
                regiones: [], // Lista de regiones
                comunas: [],
                defaultText: this.documento.default_text
            };
        },
        methods: {
            toggleLoader(state) {
                this.loaderActive = state;
                this.$emit("toggle-loader", state);
            },
            fetchComunas(region) {
                // Aquí debes implementar la lógica para obtener las comunas según la región seleccionada.
            },
            agregarFirmante() {
                // Lógica para agregar firmante a la lista
                if (this.nuevoFirmante.nombre && this.nuevoFirmante.rut) {
                    this.firmantes.push({ ...this.nuevoFirmante });
                    this.nuevoFirmante = {
                        nombre: '',
                        apellido_paterno: '',
                        apellido_materno: '',
                        rut: '',
                        correo: '',
                        domicilio: '',
                        region: '',
                        comuna: ''
                    };
                    this.firmantesError = null;
                } else {
                    this.firmantesError = 'Por favor complete todos los campos del firmante.';
                }
            },
            completeRut(name, value) {
                // Lógica para completar el RUT en formato chileno
                if (value) {
                    this.$set(this.inputs.find(input => input.name === name), 'value', this.formatearRut(value));
                }
            },
            formatearRut(rut) {
                // Función que formatea el RUT
                rut = rut.replace(/[^\dKk]/g, ''); // Elimina caracteres no numéricos
                if (rut.length > 1) {
                    let rutFormateado = rut.slice(0, -1);
                    const dv = rut[rut.length - 1];
                    return `${rutFormateado.slice(0, -3)}.${rutFormateado.slice(-3, -1)}.${rutFormateado.slice(-1)}-${dv}`;
                }
                return rut;
            },
            focusField(fieldName) {
                // Lógica para manejar el foco en los campos
            },
            blurField(fieldName) {
                // Lógica para manejar cuando el campo pierde el foco
            },
            toggleAccordion() {
                this.isAccordionOpen = !this.isAccordionOpen;
            },
            getInputValue(fieldName) {
                const input = this.inputs.find(input => input.name === fieldName);
                return input ? input.value : '';
            }
        }
    };
</script>


<template>
    <loader :loader="loaderActive"></loader>

    <section class="white-division pt-2 pb-2">
        <div class="container">
            <div class="pt-4 mt-2" style="background-color: #FB3F5C; color: white; padding: 20px 20px 10px;">
                Sección de avisos
                <!-- Renderizar statusMessage si está disponible -->
                <p v-if="statusMessage" class="mt-2">{{ statusMessage }}</p>
            </div>

            <div class="row market-body mt-1 pt-1">
                <!-- Columna de categorías (Panel de Inputs) -->
                <div class="col-md-4">
                    <div class="filtrosDiv">
                        <div class="card">
                            <div class="card-body">
                                <!-- Contenido de filtros -->
                                <p>Filtros disponibles aquí.</p>
                                <template v-if="documento.lex_categoria_id === 1">
                                    <!-- Renderiza Declaraciones -->
                                    <Declaraciones :inputs="inputs" :documento="documento" />
                                </template>
                                <template v-else>
                                    <!-- Renderiza Poderes -->
                                    <Poderes :inputs="inputs" :documento="documento" />
                                </template>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna de productos (Cuadro de Declaración Jurada) -->
                <div class="col-md-8 sticky-top" style="max-height: 401px;">
                    <div class="card">
                        <div
                            class="card-body previsualizacionDocumento"
                            style="box-shadow: rgba(49, 49, 34, 0.3) 0px 0em 2em inset, white 0px 0px 0px 0px, rgba(255, 255, 255, 0.6) 0.3em 0.3em 0em;">
                            <!-- Contenido principal -->
                            <previsualizacion :default-text="defaultText" ></previsualizacion>
                        </div>
                    </div>

                    <div class="pt-3">
                        <div class="row">
                            <div class="col-6">
                                <!-- Contenido de la primera columna -->
                                <p>Más contenido aquí.</p>
                            </div>
                            <div class="col-6">
                                <div
                                    class="card p-4"
                                    style="box-shadow: 10px 10px 15px -6px rgba(168, 166, 168, 0.89);">
                                    <!-- Contenido adicional -->
                                    <p>Contenido adicional.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>