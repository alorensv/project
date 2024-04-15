@extends('plantilla')

@section('content')
<style>
    .market-body {
        height: 100%;
    }

    .productDiv {
        flex-basis: 100%;
        flex-basis: 31.3868613139%;
        margin-right: 2.9197080292%;
        margin-top: 2.9197080292%;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 1px 8px rgba(0, 0, 0, .1);
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
        text-align: left;
        transition: translate .18s, box-shadow .18s;
    }

    .quantity-input {
        display: inline-flex;
        align-items: center;
    }

    .quantity-input button {
        border: 1px solid #ced4da;
        padding: 3px 9px 0px 9px;
        cursor: pointer;
        background-color: #d7d8d9;
    }

    .quantity-input button:hover {
        background-color: #e9ecef;
    }

    .quantity-input input {
        border: 1px solid #ffffff;
        text-align: center;
        width: 60px;
    }

    .carrito_vacio {
        font-family: "Segoe UI Emoji", "Segoe UI Symbol";
        font-weight: 700;
        font-size: 20px;
        line-height: 1.33;
        color: #333333;
    }
</style>
<section class="container bg-white py-4" style="margin-top: 20px;">

    <div class="row">
        <div class="col-12 pl-3">
            <nav aria-label="breadcrumb">
                <ol class="bg-white breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('market') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('carro') }}">Categorías</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Productos</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row market-body ">
        <div class="col-8">
            <div class="row">
                <h1>{{ $producto['nombre'] }}</h1>
            </div>
            <div class="row">
                <div class="col-6">
                    <img class="card-img-top" src="{{ $producto['imagen'] }}" alt="Imagen del producto">
                </div>
                <div class="col-6 pl-2 pr-4">
                    <div class="row p-4">
                        <span v-if="mostrarDescripcionCompleta" v-html="producto.descripcion"></span>
                        <span v-else>@{{ descripcionCorta }}</span>
                        <button v-if="!mostrarDescripcionCompleta" @click="mostrarDescripcionCompleta = true">
                            <i class="material-icons">add</i> <!-- Icono de + para expandir -->
                        </button>
                        <button v-else @click="mostrarDescripcionCompleta = false">
                            <i class="material-icons">remove</i> <!-- Icono de - para reducir -->
                        </button>
                    </div>

                    <hr>
                    <div class="pr-3">
                        <div class="row justify-content-end">
                            <div class="quantity-input">
                                <button id="minus-btn" @click="decrementQuantity"><i class="fas fa-minus"></i></button>
                                <input type="number" id="quantity" v-model="producto.cantidad" min="1" style="width: 61px;">
                                <button id="plus-btn" @click="incrementQuantity"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="row justify-content-end pt-2">
                            <button class="btn btn-primary" id="add-to-cart-btn" @click="addToCart" data-product-id="{{ $producto['id'] }}">Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="productoDetalle py-4">
                </div>
            </div>
        </div>
        <div class="col-4 bg-white border border-ligh pt-5 pl-5 pr-5">
            <div class="row">
                <div class="col-12">
                    <div class="row pb-3" style="text-align: center;">
                        <a href="/carro" class="w-100 btn btn-primary"><i class="material-icons">shopping_cart</i>Mi Carrito</a>
                    </div>
                    <div class="row w-100">
                        <div class="w-100" v-if="cart.length > 0" id="cart-items">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Producto</th>
                                        <th scope="col text-center">N°</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div v-for="item in cart" :key="item.id">

                                        <tr v-for="(item, index) in cart" :key="index">
                                            <td>@{{ item.nombre }}</td>
                                            <td class="text-center">@{{ item.cantidad }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-danger" id="deleteFromCart" @click="deleteFromCart(item.id)">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </div>

                                </tbody>
                            </table>
                        </div>
                        <div v-else class="w-100" style="display: flex; align-items: center; justify-content: center;">
                            <img src="../img/iconos/carrito.svg" alt="" style="width: 25px;">
                            <p class="carrito_vacio" style="margin-left: 13px; align-self: center; padding-top: 17px;">Tu Carro está vacío</p>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <!-- Tarjetas de productos -->
                <div class="bg-white p-4 carousel-item active">
                    <div class="row">
                        <div v-for="producto in productos" :key="producto.id" class="col-md-3">
                            <div class="productDiv">
                                <div class="card">
                                    <img class="card-img-top" :src="producto.imagen" alt="Imagen del producto"><!-- Imagen del producto -->
                                    <div class="card-body">
                                        <h5 class="card-title">@{{ producto.nombre }}</h5><!-- Nombre del producto -->
                                        <p class="card-text" style="font-size: 13px!important;">@{{ producto.descripcion.substring(0, 150) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
    </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    new Vue({
        el: '#app',
        data: {
            mostrarDescripcionCompleta: false,
            producto: {
                id: '{{ $producto->id }}',
                descripcion: "{{ $producto['descripcion'] }}",
                cantidad: 1
            },
            cart: [],
            productos: [],
        },
        mounted() {
            this.getCart();
            this.listarProductos();
        },
        computed: {
            descripcionCorta: function() {
                return this.producto.descripcion.substring(0, 426);
            }
        },
        methods: {
            incrementQuantity: function() {
                this.producto.cantidad++;
            },
            decrementQuantity: function() {
                if (this.producto.cantidad > 1) {
                    this.producto.cantidad--;
                }
            },
            addToCart: function() {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                axios.post('/add-to-cart', {
                        _token: csrfToken,
                        product_id: this.producto.id,
                        quantity: this.producto.cantidad
                    })
                    .then((response) => {
                        this.getCart();
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
            getCart: function() {
                axios.get('/get-cart')
                    .then((response) => {
                        this.cart = response.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
            listarProductos() {
                // Llamar a la ruta para obtener los productos filtrados por subcategorías seleccionadas
                axios.get('/getProductos', {})
                    .then(response => {
                        // Actualizar la lista de productos con la respuesta del servidor
                        this.productos = response.data.productos;
                    })
                    .catch(error => {
                        console.error('Error al obtener productos:', error);
                    });
            },
            deleteFromCart: function(itemId) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                axios.post('/deleteCart/' + itemId, {
                        _token: csrfToken
                    })
                    .then((response) => {
                        this.getCart();
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }

        }
    });
</script>
@endsection