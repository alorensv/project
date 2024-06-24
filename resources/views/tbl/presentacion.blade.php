<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Transportes Bulnes</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/67b6e8d4c0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Styles -->
    <link href="{{ asset('assets/css/tbl/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/tbl/carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/tbl/style_tbl.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!--owl carousel-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        body {
            padding-top: 3rem;
            color: #5a5a5a;
            background-color: #060737;
            font-family: "Urbanist", sans-serif;
            font-style: normal;
        }
        .centered-div {
            width: 50%;
            border: 2px solid rgba(255, 255, 255, 0.7); /* Borde blanco difuminado */
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.5); /* Sombra blanca difuminada */
        }
        .headerTJ{
            background-color: #060737;
            max-height: 280px;
        }

        .topTJ{
            position: absolute;
            width: 355px;
            padding: 2%;
        }
        .fotoPerfil{
            right: 0;
            left: 50%;
            position: relative;
            width: 318px;
            margin-top: 59px;
        }
        .personalData{
            background-color: white;
            max-height: 350px;
            color: #060737;
        }
        .datos{
            position: relative;
            margin-top: 40px;
            text-align: right;
            right: 0;
        }
        .telefono{
            background-color: #e6e6e6;
            max-height: 315px;
            color: #060737;
        }
        .telefono p{
            font-size: 22px;
            margin-bottom: 0.3rem!important;
        }
        .principal{
            font-weight: 600;
        }
        .iconTJ{
            font-size: 33px;
            padding-left: 25px;

        }
        .bigIcon{
            font-size: 55px;
        }
        .correo{
            background-color: #060737;
            max-height: 315px;
            color: white;
        }
        .correo p{
            font-size: 22px;
            margin-bottom: 0.3rem!important;
        }
        .descargarPresentacion{
            background-color: white;
            max-height: 315px;
            color: #060737;
        }
        .descargarPresentacion p{
            font-size: 22px;
            margin-bottom: 0.3rem!important;
        }
    </style>

</head>

<body>

 

<div class="container">
        <div class="row justify-content-center mb-5">
            <div class="centered-div">


                <section class="headerTJ p-3">
                    <div class="row">
                        <div class="topTJ">
                            <img class="card-img-top" src="/img/tbl/logo2.png" >
                        </div>
                        <div class="p-5 text-center fotoPerfil">
                            <img class="card-img-top rounded-circle" src="{{ $foto }}" >
                        </div>
                    </div>
                </section>

                <section class="personalData p-5">
                    <div class="datos">
                        <h3><strong>{{ $nombre }}</strong></h3>
                        <h3>{{ $cargo }}</h3>
                        <p>{{ $empresa }}</p>
                        <p>{{ $empresa2 }}</p>
                        <p>{{ $funciones }}</p>
                    </div>
                </section>

                <section class="telefono p-5">
                    <div class="row">
                        <div class="col-3 py-3">
                            <i class="material-icons iconTJ">phone</i>
                        </div>
                        <div class="col-9">
                            <p class="principal">{{ $telefono }}</p>
                            <p>¿Hablemos?</p>
                        </div>
                    </div>
                </section>

                <section class="correo p-5">
                    <div class="row">
                        <div class="col-3 py-3">
                            <i class="material-icons iconTJ">mail</i>
                        </div>
                        <div class="col-9">
                            <p class="principal">{{ $correo  }}</p>
                            <p>¡Escribeme!</p>
                        </div>
                    </div>
                </section>

                <section class="telefono p-5">
                    <div class="row">
                        <div class="col-3 py-3">
                            <i class="material-icons iconTJ">location_on</i>
                        </div>
                        <div class="col-9">
                            <p class="principal">Lautaro 740, Concepción, Región del Bío Bío, CHILE</p>
                            <p>¡Visitame!</p>
                        </div>
                    </div>
                </section>

                <section class="descargarPresentacion p-5">
                    <div class="text-center">
                        <p class="principal">Descargar presentación</p>
                    </div>
                    <div class="text-center">
                    <i class="material-icons bigIcon">cloud_download</i>
                    </div>
                    <div class="row justify-content-center">
                        <img class="card-img-top" src="/img/tbl/logo_tbl.png" style="width: 75%;">
                    </div>
                </section>


            </div>
        </div>
    </div>

</body>

</html>