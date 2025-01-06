@extends('lex.plantilla')

@section('content')
<style>

</style>
<div id="carroVue">

    <div v-bind:class="{ 'loader': loading }" v-cloak></div>

    <section class="white-division pt-5 pb-2" style="margin-top: 20px;min-height: 91vh;">

        <div class="container">
            @include('lex.modals.loginRegister')
            @include('lex.modals.register')
            @include('lex.modals.login')
            @include('lex.modals.firmantes')
            @include('lex.modals.verDocumento')

            <div class="row bg-white market-body celContainer">
                <div class="col-md-8">
                    <div class="row pb-3">
                        <div class="col-12">
                            <h4>Compra de documentos para firmar</h4>
                            <hr>
                            <div>
                                <div class="w-100" v-if="cart.length > 0" id="cart-items">

                                    <div v-for="(item, index) in cart" :key="index"  class="pt-2 pb-2">

                                        <div class="card" style="box-shadow: rgba(168, 166, 168, 0.89) 10px 10px 15px -6px">
                                            <div class="card-header" id="headingCart">
                                                

                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5 class="mb-0">#@{{ item.id }} @{{ item.nombreDoc }}</h5>
                                                    </div>
                                                    
                                                </div>

                                                
                                            </div>

                                            <div class="card-body">

                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="row">
                                                            <div class="col-10 d-flex">
                                                                <p class="mr-4">Cantidad de firmantes</p>
                                                                <span class="badge badge-primary fontBadge" @click="verFirmantes(item.id)"> @{{ item.firmantes }}</span>
                                                            </div>
                                                            <div class="col-2">
                                                                <i class="material-icons"  @click="verPDF(item.base64)" style="color: red;font-size: 30px;">picture_as_pdf</i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="row rowComprasCel">
                                                            <div class="col-3">
                                                                Total
                                                            </div>
                                                            <div class="col-5">
                                                                $@{{ parseInt(item.precioDoc).toLocaleString('es-CL') }}
                                                            </div>
                                                            <div class="col-3 checkCelu">
                                                                <input type="checkbox" :value="item" v-model="selectedItems" checked>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div v-else class="w-100" style="display: flex; align-items: center; justify-content: center;">
                                    <img src="../img/iconos/carrito.svg" alt="" style="width: 25px;">
                                    <p class="carrito_vacio" style="margin-left: 13px; align-self: center; padding-top: 17px;">Tu Carro está vacío</p>
                                </div>
                            </div>


                        </div>

                    </div>


                </div>
                <div class="col-md-4 bg-white border border-ligh pt-3 pl-5 pr-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100 pb-3">
                                <p class="w-100">Resumen</p>
                            </div>
                            <div class="w-100">
                                <div class="w-100" v-if="selectedItems.length > 0" id="selectedItems-items">
                                    <table class="table w-100">
                                        <thead>
                                            <tr>
                                                <th scope="col">Documento</th>
                                                <th scope="col text-center">N°</th>
                                                <th scope="col text-center" style="width: 5%;">Costo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <div v-for="item in selectedItems" :key="item.id">

                                                <tr v-for="(item, index) in selectedItems" :key="index">
                                                    <td>@{{ item.nombreDoc }}</td>
                                                    <td class="text-center">1</td>
                                                    <td class="text-center">$@{{ parseInt(item.precioDoc).toLocaleString('es-CL') }}</td>

                                                </tr>
                                            </div>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-right"><strong>Total:</strong></td>
                                                <td class="text-center"><strong>$@{{ calcularTotal().toLocaleString('es-CL') }}</strong></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <table class="table w-100">
                                        <thead>
                                            <tr>
                                                <th scope="col" colspan="2">Descuentos</th>
                                                <th scope="col">0</th>
                                            </tr>
                                        </thead>
                                    </table>

                                    <table class="table w-100">
                                        <thead>
                                            <tr>
                                                <th scope="col" colspan="2">Total</th>
                                                <th scope="col" style="width: 5%;">$@{{ calcularTotal().toLocaleString('es-CL') }}</th>
                                            </tr>
                                        </thead>
                                    </table>

                                </div>

                                <div class="w-100 pb-3" style="text-align: center;">
                                    <!-- @auth
                        <button @click="pagarWebpay" class="w-100 btn btn-success"><i class="material-icons">shopping_cart</i>Pagar</button>
                        @else
                        <a href="#" title="Para continuar te segurerimos iniciar sesión o registrater" data-toggle="tooltip" class="w-100 mb-3 btn btn-secondary"><i class="material-icons">shopping_cart</i>Pagar</a>

                        <a href="/carro" class="w-100 btn btn-primary"><i class="material-icons">person</i>Iniciar sesión / registro</a>
                        @endauth -->

                                    <button title="Para continuar te segurerimos iniciar sesión o registrater" data-toggle="tooltip" @click="pagarWebpay" class="w-100 btn btn-success"><i class="material-icons">shopping_cart</i>Pagar</button>
                                </div>

                                <div v-else class="w-100" style="display: flex; align-items: center; justify-content: center;">
                                    <img src="../img/iconos/carrito.svg" alt="" style="width: 25px;">
                                    <p class="carrito_vacio" style="margin-left: 13px; align-self: center; padding-top: 17px;">Tu Carro está vacío</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@if(Auth::check())
<!-- El usuario está autenticado, no es necesario mostrar el modal -->
@else
<!-- El usuario no está autenticado, muestra el modal -->
<script>
    $(document).ready(function() {
        $('#loginRegister').modal('show');
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endif


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    let carroVue = new Vue({
        el: '#carroVue',
        data: {
            loading: false,
            authenticated: {
                type: Boolean,
                default: false
            },
            user: [],
            cart: [],
            nombre: '',
            apellido: '',
            rut: '',
            correo: '',
            clave: '',
            password_confirmation: '',
            nombre_contacto: '',
            fono_contacto: '',
            total: '',
            pdfURL: '',
            firmantes: {},
            documentoBase: '',
            selectedItems: [],
        },
        mounted() {
            this.listarCarrito();
            //this.fetchRegiones();
            if (this.authenticated) {
                // Ejecutar la función listarDirecciones si está autenticado
            }
            this.initializeSelectedItems();
        },
        methods: {
            verFirmantes(idRedaccion) {
                this.loading = true;
                axios.get(`/firmantes/${idRedaccion}`, {}).then(response => {
                    console.log(response);
                    this.firmantes = response.data.firmantes
                }).catch(error => {
                    console.error('Error al consultar los firmantes:', error);
                }).finally(() => {
                    this.loading = false;
                    const modal = new bootstrap.Modal(document.getElementById('firmantesModal'));
                    modal.show();
                });
            },
            listarCarrito() {
                this.loading = true;
                axios.get('/getRedaccionesPorPagar')
                    .then((response) => {

                        this.cart = response.data.redacciones.data;
                        this.initializeSelectedItems();
                        console.log(this.cart)
                    })
                    .catch((error) => {
                        console.error(error);
                    }).finally(() => {
                        this.loading = false;
                    });
            },
            initializeSelectedItems() {
                // Asegúrate de que selectedItems contenga referencias exactas de los objetos de cart
                this.selectedItems = [...this.cart]; // Crea una copia exacta de los objetos
            },
            eliminarProducto(id) {
                // Aquí puedes enviar una solicitud al servidor para eliminar el producto del carrito
                axios.delete(`/deleteCart/${id}`)
                    .then(response => {
                        // Después de eliminar el producto, vuelves a cargar el carrito
                        this.listarCarrito();
                    })
                    .catch(error => {
                        console.error('Error al eliminar el producto del carrito:', error);
                    });
            },
            calcularTotal: function() {
                let total = 0;
                this.selectedItems.forEach(item => {
                    total += parseInt(item.precioDoc); // Suma el precio de cada item seleccionado
                });
                this.total = total; // Actualiza el valor de la propiedad total (opcional)
                return total; // Devuelve el total calculado
            },
            deleteFromCart: function(itemId) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                axios.post('/deleteCart/' + itemId, {
                        _token: csrfToken
                    })
                    .then((response) => {
                        this.listarCarrito();
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
            _submitRegister: function() {
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
                        password_confirmation: this.password_confirmation,
                    })
                    .then(response => {
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error al enviar el formulario:', error);
                    });
            },
            submitRegister: function() {
                this._submitRegister();
            },
            _submitLogin: function() {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                var claveEncriptada = this.clave;
                var remember = 'false';

                axios.post('/login', {
                        _token: csrfToken,
                        email: this.correo,
                        password: claveEncriptada,
                        remember: remember,
                    })
                    .then(response => {
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error al enviar el formulario:', error);
                    });
            },
            submitLogin: function() {
                this._submitLogin();
            },
            async fetchRegiones() {
                try {
                    axios.get('/regiones')
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
            async fetchComunas() {
                if (!this.selectedRegion) {
                    return;
                }
                try {
                    const response = await axios.get(`/comunas/${this.selectedRegion}`);
                    this.comunas = response.data;
                } catch (error) {
                    console.error('Error al obtener las comunas:', error);
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
            decrementQuantity: function(item) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                axios.post(`/updateCart/${item.id}`, {
                        _token: csrfToken,
                        itemId: item.id,
                        action: 'decrement'
                    })
                    .then((response) => {
                        this.listarCarrito(); // Actualizar el carrito después de la operación
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
            incrementQuantity: function(item) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                axios.post(`/updateCart/${item.id}`, {
                        _token: csrfToken,
                        itemId: item.id,
                        action: 'increment'
                    })
                    .then((response) => {
                        this.listarCarrito(); // Actualizar el carrito después de la operación
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },

            pagarWebpay() {
                if (this.selectedItems.length === 0) {
                    alert("Por favor, selecciona al menos un documento para pagar.");
                    return;
                }
                this.loading = true;
                // Aquí envías los datos de los ítems seleccionados al backend
                axios.post('/lexPagar', {
                        selectedItems: this.selectedItems
                    })
                    .then(response => {
                        // Verificamos si la respuesta contiene los datos necesarios
                        if (response.data.url_tbk && response.data.token) {
                            // Crea dinámicamente un formulario para enviar los datos a Webpay
                            var form = document.createElement('form');
                            form.setAttribute('method', 'POST');
                            form.setAttribute('action', response.data.url_tbk);

                            // Crea el campo oculto para el token
                            var tokenField = document.createElement('input');
                            tokenField.setAttribute('type', 'hidden');
                            tokenField.setAttribute('name', 'token_ws');
                            tokenField.setAttribute('value', response.data.token);
                            form.appendChild(tokenField);

                            // Añadir el formulario al body del documento
                            document.body.appendChild(form);

                            // Enviar el formulario automáticamente
                            form.submit();
                        } else {
                            alert('Error en la respuesta de Transbank');
                        }
                    })
                    .catch(error => {
                        console.error('Error al procesar el pago:', error);
                        alert('Hubo un error al procesar el pago. Intenta nuevamente.');
                    }).finally(() => {
                        this.loading = false;
                    });
            },
            verPDF(base64) {

                this.loading = true;
                this.closeModal('verPDFModal');
                // Asegúrate de esperar que se cierre completamente antes de continuar
                setTimeout(() => {
                    this.documentoBase = ""; // Limpia la variable para forzar la actualización
                    this.$nextTick(() => {
                        this.documentoBase = base64; // Asigna el nuevo valor
                        const modal = new bootstrap.Modal(document.getElementById('verPDFModal'));
                        modal.show();
                        this.loading = false; // Desactiva el indicador de carga
                    });
                }, 300); // Espera 300 ms antes de reabrir el modal

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
            async continuarInvitado() {},

        }
    });
</script>
@endsection