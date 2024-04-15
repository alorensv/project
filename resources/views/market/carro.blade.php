@extends('plantilla')

@section('content')
<style>

</style>
<section class="container py-4" style="margin-top: 20px;">

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
                                                    <label for="nombre">Nombre</label>
                                                    <input type="text" class="form-control" id="nombre" v-model="nombre" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="apellido">Apellido</label>
                                                    <input type="text" class="form-control" id="apellido" v-model="apellido" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="rut">Rut</label>
                                                    <input type="rut" class="form-control" id="rut" v-model="rut" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="email">Correo electrónico</label>
                                                    <input type="email" class="form-control" id="email" v-model="correo" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="direccion">Dirección</label>
                                                    <input type="text" class="form-control" id="direccion" v-model="direccion" required>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Enviar</button>
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
            direccion: ''
        },
        mounted() {
            this.listarCarrito();
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
                // Aquí puedes realizar la validación del formulario y enviar los datos
                // Por ejemplo, podrías enviar los datos mediante una solicitud HTTP utilizando Axios
                // y luego reiniciar los valores de las variables del formulario
                console.log('Formulario enviado');
                this.nombre = '';
                this.apellido = '';
                this.rut = '';
                this.correo = '';
                this.direccion = '';
            }
        }
    });
</script>
@endsection