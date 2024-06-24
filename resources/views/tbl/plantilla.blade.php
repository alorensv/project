<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/logo.png" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Transportes Bulnes') }}</title>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('assets/js/consultas.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/67b6e8d4c0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Styles -->
    <link href="{{ asset('assets/css/tbl/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/tbl/carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/tbl/style_tbl.css') }}" rel="stylesheet">

    <!--owl carousel-->
    <link rel="stylesheet" href="assets/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/owlcarousel/assets/owl.theme.default.min.css">
    <script src="assets/vendors/jquery.min.js"></script>
    <script src="assets/owlcarousel/owl.carousel.js"></script>

    <style>

    </style>
</head>

<body>

    <!-- Preloader -->
    <div id="preloader">
        <img src="{{ asset('/img/tbl/logo2.png') }}">
        <!-- <div class="spinner"></div> -->
    </div>

    <div id="app">
        @include('tbl.include.nav')

        <div>
            @yield('slide')
        </div>
        <main>
            @yield('content')
        </main>


        @include('tbl.include.footer')
        <script>
            // JavaScript to hide the preloader after 2 seconds
            window.addEventListener('load', function() {
                setTimeout(function() {
                    const preloader = document.getElementById('preloader');
                    preloader.style.display = 'none';
                }, 800); // 2000 ms = 2 seconds
            });


            document.addEventListener("DOMContentLoaded", function() {

                 // Función para remover la clase después de 4 segundos
                 function removerClase() {
                    miDiv.classList.remove("presentacionServicio");
                }

                var miDiv = document.getElementById("welcomeTitle");

                // Función para agregar la clase después de 2 segundos
                function agregarClase() {
                    miDiv.classList.add("ceroR");
                    miDiv.classList.add("animate");
                    let elements = document.querySelectorAll('.ceroR');
                }

                // Llamar a removerClase después de 4 segundos
                setTimeout(removerClase, 5000);

                // Llamar a agregarClase después de 2 segundos
                setTimeout(agregarClase, 5500);

                setTimeout(function() {
                    miDiv.classList.add("ceroR");
                }, 5500); // 2000 ms = 2 seconds

                

            });



            document.addEventListener('DOMContentLoaded', () => {

                // Animación de números en .indicator .value
                const indicators = document.querySelectorAll('.indicator .value');

                indicators.forEach(indicator => {
                    const startValue = parseInt(indicator.getAttribute('data-start'), 10);
                    const endValue = parseInt(indicator.getAttribute('data-end'), 10);
                    const duration = 2000; // Duración del efecto en milisegundos

                    const increment = (endValue - startValue) / (duration / 50);

                    let currentValue = startValue;
                    const interval = setInterval(() => {
                        currentValue += increment;
                        if ((increment > 0 && currentValue >= endValue) || (increment < 0 && currentValue <= endValue)) {
                            currentValue = endValue;
                            clearInterval(interval);
                        }
                        indicator.textContent = Math.round(currentValue);
                    }, 50);
                });

                // Animación de elementos .ceroR en el footer
                let elements = document.querySelectorAll('.ceroR');
                const animationTriggered = {};

                function checkAnimation(element) {
                    const rect = element.getBoundingClientRect();
                    const windowHeight = window.innerHeight || document.documentElement.clientHeight;

                    if (rect.top <= windowHeight && rect.bottom >= 0) {
                        if (!animationTriggered[element]) {
                            element.classList.add('animate');
                            animationTriggered[element] = true;
                        }
                    } else {
                        animationTriggered[element] = false;
                        element.classList.remove('animate');
                    }
                }

                function handleScroll() {
                    elements.forEach(element => {
                        checkAnimation(element);
                    });
                }

                // Llamar a checkAnimation para cada elemento al cargar la página
                elements.forEach(element => {
                    checkAnimation(element);
                });

                // Escuchar el evento de desplazamiento (scroll)
                window.addEventListener('scroll', handleScroll);

            });
        </script>
</body>

</html>