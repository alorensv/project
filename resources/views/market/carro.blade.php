@extends('plantilla')

@section('content')
<style>

</style>
<section class="pt-4" style="margin-top: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-12 pl-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('market') }}">Market</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Comprar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="white-division pt-2 pb-2">

<div class="container">
    @include('market.modals.loginRegister')
    @include('market.modals.register')
    @include('market.modals.login')    

    <div class="row bg-white market-body ">
        <div class="col-8">
            <div class="row pb-3">
                <div class="col-12">
                    <div id="accordionCarrito">
                        <div class="card">
                            <div class="card-header" id="headingCart">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseCart" aria-expanded="false" aria-controls="collapseCart">
                                        Mi carrito <i class="fas fa-chevron-down"></i>
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseCart" class="collapse show" aria-labelledby="headingCart" data-parent="#accordionCarrito">
                                <div class="card-body">
                                    <div class="w-100" v-if="cart.length > 0" id="cart-items">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width: 5%;">ID</th>
                                                    <th scope="col" colspan="2">Producto</th>
                                                    <th scope="col text-center" style="width: 5%;">N°</th>
                                                    <th scope="col text-center" style="width: 5%;">C/U</th>
                                                    <th scope="col text-center" style="width: 5%;">Costo</th>
                                                    <th scope="col" style="width: 26%;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <div v-for="item in cart" :key="item.id">
                                                    <tr v-for="(item, index) in cart" :key="index">
                                                        <td>@{{ item.id }}</td>
                                                        <td style="width: 50px;">
                                                            <img class="card-img-top" style="width: 50px;" :src="item.imagen" alt="Imagen del producto"><!-- Imagen del producto -->
                                                        </td>
                                                        <td>@{{ item.nombre }}</td>
                                                        <td class="text-center">@{{ item.cantidad }}</td>
                                                        <td class="text-center">$@{{ parseInt(item.costo).toLocaleString('es-CL') }}</td>
                                                        <td class="text-center">$@{{ (parseInt(item.cantidad) * parseInt(item.costo)).toLocaleString('es-CL') }}</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="quantity-input mr-2">
                                                                    <button id="minus-btn" class="border border-light border-1" @click="decrementQuantity(item)">
                                                                        <i class="fas fa-minus fas-727272"style="font-size: 11px;"></i>
                                                                    </button>
                                                                    <input type="number" class="border border-light border-1" v-model="item.cantidad" min="1" style="width: 42px;">
                                                                    <button id="plus-btn" class="border border-light border-1" @click="incrementQuantity(item)">
                                                                        <i class="fas fa-plus fas-727272" style="font-size: 11px;"></i>
                                                                    </button>
                                                                </div>
                                                                <button class="btn btn-sm btn-danger" id="deleteFromCart" @click="deleteFromCart(item.id)">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                </div>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" class="text-right"><strong>Total:</strong></td>
                                                    <td class="text-center"><strong>$@{{ calcularTotal().toLocaleString('es-CL') }}</strong></td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
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


            <div class="row pb-3">
                <div class="col-12">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        Datos de envío <i class="fas fa-chevron-down"></i>
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                @auth
                                <table v-if="direcciones.length > 0" class="table" :authenticated="{{ Auth::check() ? 'true' : 'false' }}">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Region / Comuna</th>
                                            <th>Dirección</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="direccion in direcciones" :key="direccion.id">
                                            <td><input type="checkbox" style="width: 20px;" class="form-control" name="selectDireccion" id="selectDireccion"></td>
                                            <td>@{{ direccion.region }} / @{{ direccion.comuna }}</td>
                                            <td>@{{ direccion.direccion }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h5 style="cursor: pointer;" @click="mostrarFormularioAgregarDireccion">Agregar dirección</h5>

                                <div v-if="mostrarAgregarDireccion">
                                    @include('market.forms.agregarDirecciones')
                                </div>
                                @else
                                    <p>Para continuar, inicia sesión o regístrate</p>
                                    <button class="btn btn-primary" onclick="$('#loginRegister').modal('show');">Iniciar sesión / registro</button>
                                @endauth                              

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
        <div class="col-4 bg-white border border-ligh pt-3 pl-5 pr-5">
            <div class="row">
                <div class="col-12">
                    <div class="w-100 pb-3">
                        <p class="w-100">Resumen</p>
                    </div>
                    <div class="w-100">
                        <div class="w-100" v-if="cart.length > 0" id="cart-items">
                            <table class="table w-100">
                                <thead>
                                    <tr>
                                        <th scope="col">Producto</th>
                                        <th scope="col text-center">N°</th>
                                        <th scope="col text-center" style="width: 5%;">Costo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div v-for="item in cart" :key="item.id">

                                        <tr v-for="(item, index) in cart" :key="index">
                                            <td>@{{ item.nombre }}</td>
                                            <td class="text-center">@{{ item.cantidad }}</td>
                                            <td class="text-center">$@{{ (parseInt(item.cantidad) * parseInt(item.costo)).toLocaleString('es-CL') }}</td>

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
                        <div v-else class="w-100" style="display: flex; align-items: center; justify-content: center;">
                            <img src="../img/iconos/carrito.svg" alt="" style="width: 25px;">
                            <p class="carrito_vacio" style="margin-left: 13px; align-self: center; padding-top: 17px;">Tu Carro está vacío</p>
                        </div>
                    </div>
                    <div class="w-100 pb-3" style="text-align: center;">
                        @auth
                            <button @click="pagarWebpay" class="w-100 btn btn-success"><i class="material-icons">shopping_cart</i>Pagar</button>
                        @else
                            <a href="#" title="Para continuar, inicia sesión o regístrate" data-toggle="tooltip" class="w-100 mb-3 btn btn-secondary"><i class="material-icons">shopping_cart</i>Pagar</a>
                            
                            <a href="/carro" class="w-100 btn btn-primary"><i class="material-icons">person</i>Iniciar sesión / registro</a>
                            @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</section>

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
    new Vue({
        el: '#app',
        data: {
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
            direccion: '',
            region: '',
            comuna: '',
            codigo_postal: '',
            regiones: [],
            comunas: [],
            selectedRegion: '',
            selectedComuna: '',
            direcciones: [],
            mostrarAgregarDireccion: false,
            total: ''
        },
        mounted() {
            this.listarCarrito();
            this.fetchRegiones();
            if (this.authenticated) {
                this.listarDirecciones(); // Ejecutar la función listarDirecciones si está autenticado
            }
        },
        methods: {
            listarCarrito() {
                axios.get('/get-cart')
                    .then((response) => {

                        this.cart = response.data;
                        console.log(this.cart)
                    })
                    .catch((error) => {
                        console.error(error);
                    });
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
                this.cart.forEach(item => {
                    total += parseInt(item.costo) * parseInt(item.cantidad);
                });
                this.total = total;
                return total;
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
            submitForm: function() {

                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                axios.post('/agregarDireccion', {
                        _token: csrfToken,
                        region: this.selectedRegion,
                        comuna: this.selectedComuna,
                        codigo_postal: this.codigo_postal,
                        direccion: this.direccion
                    })
                    .then((response) => {
                        this.listarDirecciones();
                    })
                    .catch((error) => {
                        console.error(error);
                    });

                console.log('Formulario enviado');
                
                this.direccion = '';
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
            listarDirecciones() {
                axios.get('/getUserDirecciones') // Realiza una solicitud GET al servidor para obtener las direcciones del usuario
                    .then(response => {
                        console.log(response.data.userDirecciones)
                        this.direcciones = response.data.userDirecciones; // Asigna las direcciones obtenidas al array de direcciones
                    })
                    .catch(error => {
                        console.error('Error al obtener las direcciones del usuario:', error);
                    });
            },
            mostrarFormularioAgregarDireccion() {
                // Cambia el estado para mostrar u ocultar el formulario
                this.mostrarAgregarDireccion = !this.mostrarAgregarDireccion;
            },
            consultarCorreo() {
                axios.get(`/existeUsuario/${this.correo}`)
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
                        console.error('Error al enviar el formulario:', error);
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
            pagarWebpay(){
                location.href = 'pagar';
            }

        }
    });
</script>
@endsection