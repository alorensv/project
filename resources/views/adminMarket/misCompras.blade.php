@extends('tiny.tinyTemplate')

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

    <div class="row market-body mt-5 pt-5">
        <!-- Columna de categorías 
        <div class="col-md-3">
            <div class="h-100 bg-white pl-4 pr-4 pt-2 pb-2">
                <p class="pt-1">Filtros</p><span class="material-icons">search</span>


            </div>

        </div>-->
        <!-- Columna de productos -->
        <div class="col-md-12">
            <div class="row pb-3">
                <div class="col-12">
                    <div class="w-100" v-if="compras.length > 0" id="cart-items">


                        <div v-for="compra in compras" :key="compra.id">
                            <div class="order-item" v-for="producto in compra.productos" :key="producto.id">
                                <div class="order-item-header" style="border-width: 1px;">
                                    <div class="order-item-header-status" data-pl="order_item_header_status">
                                        <span class="order-item-header-status-text">Esperando entrega</span>
                                    </div>
                                    <div class="order-item-header-right">
                                        <div class="order-item-header-right-info" data-pl="order_item_header_info">
                                            <div>Fecha compra: @{{ compra.fecha_transaccion }}</div>
                                            <div style="display: flex; align-items: center;">Orden ID: @{{ compra.id }}
                                                <span class="order-item-header-right-copy">Copy</span>
                                            </div>
                                        </div>
                                        <span class="order-item-header-line"></span>
                                        <a href="#" target="_blank" class="btn-link" style="font-weight: bold;">
                                            <span>Detalles</span>
                                            <span class="comet-icon comet-icon-arrowright ">
                                                <span class="material-icons">keyboard_arrow_right</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="order-item-store">
                                    <span class="order-item-store-name" data-pl="order_item_store_name">

                                        <span>@{{ producto.producto.nombre }}</span>
                                        <span class="comet-icon comet-icon-arrowright ">
                                            <span class="material-icons">keyboard_arrow_right</span>
                                        </span>

                                    </span>
                                </div>
                                <div class="order-item-content">
                                    <div class="order-item-content-body">
                                        <div class="order-item-content-img pr-4" style="max-width: 32%;">
                                            <img :src="producto.producto.imagen" alt="Imagen del producto" style="width: 100%;">
                                        </div>
                                        <div class="order-item-content-info">
                                            <div class="order-item-content-info-name" data-pl="order_item_content_info_name">
                                                <span title="@{{ producto.producto.descripcion }}">@{{ producto.producto.descripcion.substring(0, 210) }}...</span>
                                            </div>
                                            <div class="order-item-content-info-sku">-</div>
                                            <!-- <div class="order-item-content-info-tag"><span class="order-item-tag">
                                                    <font color="#009966">Delivery guarantee</font>
                                                </span>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="order-item-content-opt">
                                        <div class="order-item-content-opt-price">
                                            <span class="order-item-content-opt-price-total" data-pl="order_item_content_price_total">
                                                <span class="float-left pr-2">Total:</span>
                                                <span>CLP</span><span>$@{{ parseInt(producto.monto).toLocaleString('es-CL') }}</span>
                                            </span>
                                        </div>
                                        <div class="order-item-btns-wrap">
                                            <div class="order-item-btns">
                                                <!-- <button type="button" class="btn btn-primary comet-btn-block order-item-btn">
                                                    <span>Confirmar recepción</span>
                                                </button> -->
                                                <!-- <a href="#" class="btn btn-secondary comet-btn-block order-item-btn">
                                                    <span>Track order</span>
                                                </a> -->
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
</section>
@include('tiny.footer')

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    new Vue({
        el: '#app',
        data: {
            compras: [],
        },
        mounted() {
            this.misCompras();
        },
        methods: {
            misCompras() {
                // Llamar a la ruta para obtener los productos filtrados por subcategorías seleccionadas
                axios.get('/getMisCompras', {})
                    .then(response => {
                        // Actualizar la lista de productos con la respuesta del servidor
                        this.compras = response.data;
                    })
                    .catch(error => {
                        console.error('Error al obtener productos:', error);
                    });
            }
        }
    });
</script><!-- Primer modal -->


@endsection