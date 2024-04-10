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

    .subcategoriaDiv {
        border: 1px solid #ccc;
        background-color: #f8f9fa;
        padding: 10px;
        margin-bottom: 10px;
    }
</style>
<section class="container py-4" style="margin-top: 20px;">
    <div class="row market-body ">
        <div class="col-3">
            <div class="subcategoriaDiv" v-for="subcategoria in subcategorias" :key="subcategoria.id">
                <input type="checkbox" :id="'subcategoria_' + subcategoria.id" v-model="subcategoriasSeleccionadas" :value="subcategoria.id" @change="listarProductos">
                <label :for="'subcategoria_' + subcategoria.id">@{{ subcategoria.nombre }}</label>
            </div>
        </div>
        <div class="col-9">
            <div class="row">
                <div v-for="producto in productos" :key="producto.id" class="col-4">
                    <div class="productDiv">
                        <div class="card">
                            <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_18ec3f96031%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_18ec3f96031%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.1953125%22%20y%3D%2296.3%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Card image cap">
                                
                            <!-- <img class="card-img-top" :src="producto.imagen" :alt="producto.nombre"> -->
                            <div class="card-body">
                                <h5 class="card-title">@{{ producto.nombre }}</h5>
                                <p class="card-text">@{{ producto.id }}</p>
                                <a :href="'/detalle/' + producto.id" class="btn btn-primary">ID: @{{ producto.id }}</a>
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
            subcategorias: [],
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
                // Llamar a la ruta para obtener las subcategorias
                axios.get('/getCategorias')
                    .then(response => {
                        // Actualizar la lista de subcategorias con la respuesta del servidor
                        this.subcategorias = response.data.subcategorias;
                    })
                    .catch(error => {
                        console.error('Error al obtener subcategorias:', error);
                    });
            },
            listarProductos() {
                // Llamar a la ruta filtrar.productos
                axios.get('/getProductos', {
                        params: {
                            subcategorias: this.subcategoriasSeleccionadas // Pasar las subcategorías seleccionadas como parámetros de la solicitud
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
