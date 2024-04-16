@extends('plantilla')

@section('content')
<style>

</style>
<section class="container py-4" style="margin-top: 20px;">


    <!-- Modal -->
    <div class="modal fade" id="loginRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro / Iniciar sesión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="guardarCorreo">
                        <div class="form-group">
                            <label for="correo">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="correo" v-model="correo" required>
                        </div>
                        <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary">Continuar</button>
                        </div>
                    </form>
                </div>                
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submitRegister">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" v-model="nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="correo">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="correo" v-model="correo" required>
                        </div>
                        <div class="form-group">
                            <label for="clave">Contraseña:</label>
                            <input type="password" class="form-control" id="clave" v-model="clave" required minlength="6">
                            <small class="form-text text-muted">La contraseña debe tener al menos 6 caracteres.</small>
                        </div>

                        <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary">Continuar</button>
                        </div>
                    </form>
                </div>                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 pl-3">
            <nav aria-label="breadcrumb">
                <ol class="bg-white breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('market') }}">Market</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('carro') }}">Carro</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Carro</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row bg-white market-body ">
        <div class="col-8 pt-4 pl-4">
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
                                                                    <button id="minus-btn" @click="decrementQuantity(item)">
                                                                        <i class="fas fa-minus" style="font-size: 11px;"></i>
                                                                    </button>
                                                                    <input type="number" v-model="item.cantidad" min="1" style="width: 42px;">
                                                                    <button id="plus-btn" @click="incrementQuantity(item)">
                                                                        <i class="fas fa-plus" style="font-size: 11px;"></i>
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

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <form @submit.prevent="submitForm">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="direccion">Región</label>
                                                    <select v-model="selectedRegion" class="form-control" @change="fetchComunas">
                                                        <option value="" disabled selected>Selecciona una región</option>
                                                        <option v-for="region in regiones" :key="region.codigo" :value="region.codigo">@{{ region.nombre }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="comuna">Comuna</label>
                                                    <select v-model="selectedComuna" class="form-control">
                                                        <option value="" disabled selected>Selecciona una comuna</option>
                                                        <option v-for="comuna in comunas" :key="comuna.codigo" :value="comuna.nombre">@{{ comuna.nombre }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="codigo_postal">Código postal</label>
                                                    <input type="text" class="form-control" id="codigo_postal" required>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="direccion">Dirección</label>
                                                    <input type="text" class="form-control" id="direccion" v-model="direccion" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-right">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
        <div class="col-4 bg-white border border-ligh pt-3 pl-5 pr-4">
            <div class="row">
                <div class="col-12">
                    <div class="row pb-3">
                        <p class="w-100">Resumen</p>
                    </div>
                    <div class="row w-100">
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
                    <div class="row pb-3" style="text-align: center;">
                        <a href="/carro" class="w-100 btn btn-success"><i class="material-icons">shopping_cart</i>Pagar</a>
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
        });
    </script>
@endif


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    new Vue({
        el: '#app',
        data: {
            cart: [],
            nombre: '',
            apellido: '',
            rut: '',
            correo: '',
            clave: '',
            password_confirmation: '',
            direccion: '',
            regiones: [],
            comunas: [],
            selectedRegion: '',
            selectedComuna: ''
        },
        mounted() {
            this.listarCarrito();
            this.fetchRegiones();
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
                
                /* var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                axios.post('/deleteCart/' + itemId, {
                        nombre: csrfToken,
                        _token: csrfToken,
                        _token: csrfToken,
                        _token: csrfToken,
                        _token: csrfToken
                    })
                    .then((response) => {
                        this.listarCarrito();
                    })
                    .catch((error) => {
                        console.error(error);
                    }); */

                console.log('Formulario enviado');
                this.nombre = '';
                this.apellido = '';
                this.rut = '';
                this.correo = '';
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
                    password: claveEncriptada ,
                    password_confirmation: this.password_confirmation,                    
                    })
                    .then(response => {
                        console.log(response.data); // Aquí puedes listar el POST recibido del servidor
                        // Lógica adicional después de recibir la respuesta del servidor
                    })
                    .catch(error => {
                        console.error('Error al enviar el formulario:', error);
                    });
            },
            submitRegister: function() {
                this._submitRegister();
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
            guardarCorreo() {
                console.log("por aca")
                $('#loginRegister').modal('hide');
                $('#register').modal('show');
            }

        }
    });
</script>
@endsection