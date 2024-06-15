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
        <img src="{{ asset('/img/tbl/logo2.png') }}" >
        <!-- <div class="spinner"></div> -->
    </div>

    <div id="app">
        @include('tbl.include.nav')
        <div class="div_cotiza">
        <section class="shadow-lg" style=" background-color: white;color: #060737;" id="contacto">
            <form action="{{route('enviarEmail')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                <div class="text-center pb-4">
                    <h4 style="font-size: 1.8rem;font-weight: 600;">Cotiza con nosotros</h4>
                </div>

                @if (session('info'))
                <div class="status alert alert-success">{{session('info')}}</div>
                @endif

                <div class="form-group">
                    <label for="Nombre">Nombre</label>
                    <input type="text" id="name" name="name" class="form-control" required="required" placeholder="Nombre">
                </div>
                @error('name')
                <p class="">{{$message}}</p>
                @enderror
                <div class="form-group">
                    <label for="emai">Correo</label>
                    <input type="email" id="email" name="email" class="form-control" required="required" placeholder="Correo">
                </div>
                @error('email')
                <p class="">{{$message}}</p>
                @enderror
                <div class="form-group">
                    <label for="Teléfono">Teléfono</label>
                    <input type="number" id="fono" name="fono" class="form-control" placeholder="Teléfono">
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha posible del servicio</label>
                    <input type="number" id="fono" name="fono" class="form-control" placeholder="Fecha posible del servicio">
                </div>

            </div><!--/.col-md-12-->
            <div class="col-6">
                <div class="form-group">
                    <label for="fecha">Origen</label>
                    <input type="number" id="fono" name="fono" class="form-control" placeholder="Fecha posible del servicio">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="fecha">Destino</label>
                    <input type="number" id="fono" name="fono" class="form-control" placeholder="Fecha posible del servicio">
                </div>
            </div>
            <div class="col-12">

                <div class="form-group">
                    <label for="mensaje">Comentarios</label>
                    <textarea name="message" id="message" required="required" class="form-control" rows="4" placeholder="Consultas"></textarea>
                </div>
                @error('message')
                <p class="">{{$message}}</p>
                @enderror
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-light btn-lg" required="required" onClick="enviarmail()">Enviar</button>
                </div>

                

            </div><!--/.row-->
            </form>
        </section>
        </div>

        <div>
            @yield('slide')
        </div>        
        <main>
            @yield('content')
        </main>


    <!-- @include('include.footer') -->
    <script>
        // JavaScript to hide the preloader after 2 seconds
        window.addEventListener('load', function() {
            setTimeout(function() {
                const preloader = document.getElementById('preloader');
                preloader.style.display = 'none';
            }, 800); // 2000 ms = 2 seconds
        });
    </script>
</body>
</html>
