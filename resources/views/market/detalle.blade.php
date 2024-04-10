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

        font-family:"Segoe UI Emoji", "Segoe UI Symbol";
        font-weight: 700;
        font-size: 20px;
        line-height: 1.33;
        color: #333333;

    }
</style>
<section class="container py-4" style="margin-top: 20px;">
    <div class="row market-body ">
        <div class="col-8">
            <div class="row">
                <h1>{{ $id }}</h1>
            </div>
            <div class="row">
                <div class="col-6">
                    <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_18ec3f96031%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_18ec3f96031%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.1953125%22%20y%3D%2296.3%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Card image cap">
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="quantity-input">
                            <button id="minus-btn"><i class="fas fa-minus"></i></button>
                            <input type="number" id="quantity" value="1" min="1">
                            <button id="plus-btn"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary" id="add-to-cart-btn" data-product-id="{{ $id }}">Añadir al carrito</button>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="productoDetalle">
                    Hurst: la plantilla de muebles de comercio electrónico es un diseño limpio y elegante, adecuado para vender flores, cocina, accesorios, moda, alta costura, accesorios, digitales, para niños, relojes, joyas, zapatos, niños, muebles, deportes... Tiene un ancho totalmente responsivo que se ajusta automáticamente a cualquier tamaño o resolución de pantalla.

                    Hemos incluido 2 diseños definidos para la página de inicio para ofrecerle las mejores opciones de personalización. Puedes mezclar todos los diseños de la página de inicio para obtener un diseño diferente para tu propio sitio web. La página de inicio tiene un diseño llamativo con una gran presentación de diapositivas arriba y debajo del Mega Menu. La presentación de diapositivas es excelente con transiciones suaves de textos e imágenes bonitas.

            </div>
        </div>
        <div class="col-4">
            <div class="row">
                Mi Carrito
                <img src="https://www.flaticon.es/icono-gratis/carrito-de-compras_3144456" alt="">
            </div>
            <div class="row">

                @if(isset($cart) && !empty($cart))
                <div id="cart-items">
                    @foreach($cart as $productId => $quantity)
                    <p>Producto ID: {{ $productId }}, Cantidad: {{ $quantity }}
                        <i class="fas fa-trash-alt delete-icon"></i>
                    </p>
                    @endforeach
                </div>
                @else
                <section>
                    <img src="../img/iconos/carrito.svg" alt="">
                    <p class="carrito_vacio">Tu Carro esta vació</p>
                </section>
                @endif


            </div>

            <div class="row">

            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script>
    $(document).ready(function() {
        $('#plus-btn').click(function() {
            $('#quantity').val(parseInt($('#quantity').val()) + 1);
        });
        $('#minus-btn').click(function() {
            var currentValue = parseInt($('#quantity').val());
            if (currentValue > 1) {
                $('#quantity').val(currentValue - 1);
            }
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updateCart() {
        $.ajax({
            url: '/get-cart',
            type: 'GET',
            success: function(response) {
                // Limpiar el contenido actual del carrito
                $('#cart-items').empty();

                // Actualizar el contenido del carrito con la respuesta JSON
                $.each(response, function(productId, quantity) {
                    // Construir el HTML completo como una cadena

                    var deleteIcon = '<i class="fas fa-trash-alt delete-icon"></i>';
                    var htmlContent = '<p>Producto ID: ' + productId + ', Cantidad: ' + quantity;
                    htmlContent += deleteIcon + '</p>';

                    // Agregar el HTML al elemento #cart-items
                    $('#cart-items').append(htmlContent);


                });

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Llamar a la función de actualización del carrito al cargar la página
    $(document).ready(function() {
        updateCart();

        $('.delete-icon').click(function() {
            // Mostrar el alert
            alert('Eliminar producto ID: ' + productId);
        });
    });

    // Llamar a la función de actualización del carrito cada vez que se agrega un elemento
    $('#add-to-cart-btn').click(function() {
        var productId = $(this).data('product-id');
        var cantidad = $('#quantity').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/add-to-cart',
            type: 'POST',
            data: {
                _token: csrfToken,
                product_id: productId,
                quantity: cantidad
            },
            success: function(response) {
                // Actualizar el contenido del carrito después de agregar un elemento
                updateCart();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
</script>

@endsection