@extends('plantilla')

@section('content')
<style>
    /* Estilos personalizados para la página */
    .market-body {
        min-height: 100vh;
        padding-top: 20px;
    }

    .categoria-title {
        background-color: #f8f9fa; /* Fondo gris claro para el título de la categoría */
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

    .card {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra suave para las tarjetas de productos */
    }

    .card-img-top {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        height: 200px; /* Altura fija para las imágenes de los productos */
        object-fit: cover; /* Ajustar la imagen dentro del contenedor */
    }

    .card-title {
        font-size: 1.2rem;
        margin-top: 10px;
    }

    .card-text {
        font-size: 1rem;
    }

    .btn-primary {
        background-color: #007bff; /* Color azul brillante para los botones */
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Cambio de color al pasar el ratón */
        border-color: #0056b3;
    }
    .card-text {
        text-align: center; /* Centra el texto */
    }

    .card-text::before {
        content: "\0024"; /* Agrega el símbolo de dólar */
        font-weight: bold;
        padding-right: 3px; /* Espacio entre el símbolo y el número */
    }
</style>
<section class="container">
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
            <div class="row">
                <!-- Tarjetas de productos -->
                <div v-for="producto in productos" :key="producto.id" class="col-md-4">
                    <div class="productDiv">
                        <div class="card">
                            
                            
                             <img class="card-img-top" :src="producto.imagen" alt="Imagen del producto"><!-- Imagen del producto -->
                             <div class="card-body">
                                <h5 class="card-title">@{{ producto.nombre }}</h5>
                                <!-- Nombre del producto -->
                                <p class="card-text">@{{ producto.descripcion.substring(0, 150) }}...</p>
                                <!-- Descripción del producto -->
                                <div class="row">
                                    <div class="col-4 d-flex align-items-center">
                                        <p class="card-text">$@{{ parseInt(producto.costo).toLocaleString('es-CL') }}</p>
                                        <!-- Costo del producto -->
                                    </div>
                                    <div class="col-8 text-center">
                                        <a :href="'/detalle/' + producto.id" class="btn btn-primary"><span class="material-icons" style="font-size: 11px !important;">shopping_cart</span> Comprar</a>
                                        <!-- Botón de detalles -->
                          
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
            subcategoriasSeleccionadas: []
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
            }
        }
    });
</script>
@endsection
