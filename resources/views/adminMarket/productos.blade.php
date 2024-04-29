@extends('plantilla')

@section('content')
<style>
    /* Estilos personalizados para la página */
    .market-body {
        min-height: 100vh;
        padding-top: 20px;
    }

    .categoria-title {
        background-color: #f8f9fa;
        /* Fondo gris claro para el título de la categoría */
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .subcategoriaDiv {
        border: 1px solid #ccc;
        background-color: #f8f9fa;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .productDiv {
        margin-bottom: 20px;
    }
</style>
<section class="container">

    @include('adminMarket.modals.agregarProducto')

    <div class="row market-body mt-5 pt-5">
        <!-- Columna de categorías -->
        <div class="col-md-3">
            <div class="h-100 bg-white pl-4 pr-4 pt-2 pb-2">
                <p class="pt-1">Filtros</p><span class="material-icons">search</span>

                <div v-for="categoria in categorias" :key="categoria.id">
                    <div class="categoria-title">
                        <hr>
                        <h5>@{{ categoria.nombre }}</h5> <!-- Título de la categoría -->
                        <hr>
                    </div>
                    <!-- Lista de subcategorías -->
                    <div v-for="subcategoria in categoria.subcategorias" :key="subcategoria.id">
                        <div class="subcategoriaDiv">
                            <input type="checkbox" :id="'subcategoria_' + subcategoria.id" v-model="subcategoriasSeleccionadas" :value="subcategoria.id" @change="listarProductos">
                            <label :for="'subcategoria_' + subcategoria.id">@{{ subcategoria.nombre }}</label> <!-- Nombre de la subcategoría -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Columna de productos -->
        <div class="col-md-9">
            <div class="row pb-3">
                <div class="col-12">
                    <div id="accordionCarrito">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center" id="headingCart">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseCart" aria-expanded="false" aria-controls="collapseCart">
                                        Mi carrito <i class="fas fa-chevron-down"></i>
                                    </button>
                                </h5>

                                <div>
                                    <button class="btn btn-sm btn-primary" id="agregarProductoModal" @click="agregarProductoModal()">
                                        <i class="material-icons">add_circle</i> Agregar
                                    </button>
                                </div>
                            </div>


                            <div id="collapseCart" class="collapse show" aria-labelledby="headingCart" data-parent="#accordionCarrito">
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 5%;">ID</th>
                                                <th scope="col">Producto</th>
                                                <th scope="col text-center">Descripción</th>
                                                <th scope="col text-center" style="width: 5%;">Costo</th>
                                                <th scope="col text-center" style="width: 5%;">Cantidad</th>
                                                <th scope="col" style="width: 26%;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="producto in productos" :key="producto.id">
                                                <td>@{{ producto.id }}</td>
                                                <td>@{{ producto.nombre }}</td>
                                                <td>@{{ producto.descripcion.substring(0, 150) }}...</td>
                                                <td class="text-center">$@{{ parseInt(producto.costo).toLocaleString('es-CL') }}</td>
                                                <td>@{{ producto.cantidad }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-alert" id="deleteFromCart" @click="deleteFromCart(item.id)">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" id="deleteFromCart" @click="deleteFromCart(item.id)">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    new Vue({
        el: '#app',
        data: {
            productos: [],
            categorias: [],
            subcategorias: [],
            subcategoriasSeleccionadas: [],
            subcategoriaSeleccionada: null,
            producto: {
                categoria: '', // Variable para la categoría
                subcategoria: '', // Variable para la subcategoría
                nombre: '', // Variable para el nombre
                descripcion: '', // Variable para la descripción
                cantidad: 0, // Variable para la cantidad (inicializada a 0)
                costo: 0, // Variable para el costo (inicializada a 0)
                imagen: null
            }
        },
        mounted() {
            // Llamar a getCategorias al montar el componente
            this.getCategorias();
            // Llamar a listarProductos al montar el componente
            this.listarProductos();
        },
        methods: {
            getCategorias() {
                // Llamar a la ruta para obtener las categorías y subcategorías
                axios.get('/getCategorias')
                    .then(response => {
                        // Actualizar la lista de categorías con la respuesta del servidor
                        console.log(response.data.datos)
                        this.categorias = response.data.datos;
                    })
                    .catch(error => {
                        console.error('Error al obtener categorías:', error);
                    });
            },
            listarProductos() {
                // Llamar a la ruta para obtener los productos filtrados por subcategorías seleccionadas
                axios.get('/getProductos', {
                        params: {
                            subcategorias: this.subcategoriasSeleccionadas
                        }
                    })
                    .then(response => {
                        // Actualizar la lista de productos con la respuesta del servidor
                        this.productos = response.data.productos;
                    })
                    .catch(error => {
                        console.error('Error al obtener productos:', error);
                    });
            },
            agregarProductoModal() {
                $('#agregarProducto').modal('show');
            },
            getSubcategorias(idCategoria) {
                if (idCategoria) {
                    axios.get('/getSubcategorias/' + idCategoria)
                        .then(response => {
                            this.subcategorias = response.data; // Actualizar la lista de subcategorías
                        })
                        .catch(error => {
                            console.error('Error al obtener subcategorías:', error);
                        });
                }
            },
            agregarProducto() {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                axios.post('/agregarProducto', {
                        _token: csrfToken,
                        nombre: this.producto.nombre,
                        descripcion: this.producto.descripcion,
                        imagen: this.producto.imagen,
                        cantidad: this.producto.cantidad,
                        costo: this.producto.costo,
                        categoria: this.producto.categoria,
                        subcategoria: this.producto.subcategoria,
                        
                    })
                    .then((response) => {
                        this.listarProductos();
                    })
                    .catch((error) => {
                        console.error(error);
                    });

                console.log('Formulario enviado');
                
                this.direccion = '';
            }
        }
    });
</script><!-- Primer modal -->


@endsection