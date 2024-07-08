<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

        @keyframes slideInFromLeft {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes scaleUp {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .text-center {
            text-align: center; /* Asegura que el contenido esté centrado horizontalmente */
        }

        .text-center img {
            display: inline-block; /* Asegura que la imagen se comporte como un elemento en línea para el centrado */
        }



        .animated-section {
            animation: slideInFromLeft 0.5s ease-out forwards;
        }

        .topTJ {
            animation: scaleUp 0.5s ease-out forwards;
        }

        body {
            padding-top: 3rem;
            color: #5a5a5a;
            background-color: #060737;
            font-family: "Urbanist", sans-serif;
            font-style: normal;
            overflow-x: hidden; /* Para ocultar cualquier desbordamiento horizontal */
        }
        .centered-div {
            width: 50%;
            border: 2px solid rgba(255, 255, 255, 0.7); /* Borde blanco difuminado */
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.5); /* Sombra blanca difuminada */
        }
        .headerTJ {
            background-color: #060737;
            max-height: 280px;
            min-height: 240px;
        }
        .topTJ {
            position: absolute;
            width: 355px;
            padding: 2%;
        }
        .fotoPerfil {
            right: 0;
            left: 56%;
            position: relative;
            width: 213px;
            margin-top: 128px;
        }
        .personalData {
            background-color: white;
            max-height: 630px!important;
            color: #060737;
        }
        .datos {
            position: relative;
            margin-top: 15px;
            text-align: right;
            right: 0;
        }
        .telefono {
            background-color: #10ab4d;
            max-height: 315px;
            color: white;
        }
        .telefono p {
            font-size: 22px;
            margin-bottom: 0.3rem!important;
            color: white;
        }

        .telefono a {
            color: white;
        }


        .principal {
            font-weight: 600;
        }

        a {
            font-size: 22px;
            color: #060737;
            text-decoration: none;
            background-color: transparent;
        }

        a:hover {
            font-size: 22px;
            color: #c9c9d8;
            text-decoration: none;
            background-color: transparent;
        }
        .iconTJ {
            font-size: 33px;
            padding-left: 25px;
        }
        .bigIcon {
            font-size: 55px;
        }
        .correo {
            background-color: #060737;
            max-height: 315px;
            color: white;
        }

        .correo a {
            font-size: 22px;
            color: white;
            text-decoration: none;
            background-color: transparent;
        }
        .correo p {
            font-size: 22px;
            margin-bottom: 0.3rem!important;
        }

        .correo a:hover {
            font-size: 22px;
            color: #c9c9d8;
            text-decoration: none;
            background-color: transparent;
        }

        .descargarPresentacion {
            background-color: white;
            max-height: 315px;
            color: #060737;
        }
        .descargarPresentacion p {
            font-size: 22px;
            margin-bottom: 0.3rem!important;
        }

        .personalData p {
                margin-top: 0;
                margin-bottom: 0.3rem;
            }


            


        @media (max-width: 990px) {
            body {
                padding-top: 0rem!important;
            }
            .container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl {
                width: 100%;
                padding-right: 0px;
                padding-left: 0px;
                margin: 0; /* Eliminar márgenes */
            }
            .centered-div {
                width: 100%!important;
                border: none;
                box-shadow: none;
            }
            .fotoPerfil {
                left: 58% !important;
                position: relative !important;
                width: 175px !important;
                margin-top: 164px !important;
            }
            .topTJ {
                position: absolute !important;
                width: 325px !important;
                padding: 7% !important;
            }
            .personalData {
                max-height: 420px!important;
            }

            .iconTJ {
                font-size: 33px;
                padding-left: 15px!important;
            }

            .marginPhone{
                margin-left: -20px;
            }

            
        }

        @media (max-width: 480px) {
            body {
                padding-top: 0rem!important;
            }
            .container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl {
                width: 100%;
                padding-right: 0px;
                padding-left: 0px;
                margin: 0; /* Eliminar márgenes */
            }
            .centered-div {
                width: 100%!important;
                border: none;
                box-shadow: none;
            }
            .fotoPerfil {
                left: 48% !important;
                position: relative !important;
                width: 175px !important;
                margin-top: 164px !important;
            }
            .topTJ {
                position: absolute !important;
                width: 298px !important;
                padding: 7% !important;
                left: 78px;
            }
            .personalData {
                max-height: 630px!important;
            }
            .iconTJ {
                font-size: 33px;
                padding-left: 0px!important;
            }
            .marginPhone {
                margin-left: 5px;
                margin-top: 18px;
            }
            
        }

    </style>

</head>

<body>
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="centered-div">
                <section class="headerTJ p-3 ">
                    <div class="row">
                        <div class="topTJ text-center">
                            <img class="card-img-top" src="/img/tbl/logo2.png">
                        </div>
                        <div class="text-center fotoPerfil animated-section">
                            <img class="card-img-top rounded-circle" src="{{ $img }}">
                        </div>
                    </div>
                </section>

                <section class="personalData p-5">
                    <div class="datos animated-section">
                        <h3 style="font-size: 45px;"><strong>{{ $nombre }}</strong></h3>
                        <h3 class="pb-3">{{ $marca }} {{ $modelo }}</h3>
                        <h3><strong>Patente:</strong> {{ $patente }}</h3>
                        <h3><strong>Año:</strong> {{ $anio }}</h3>
                        <hr>
                        <h4>Revisón técnica: <span class="material-icons" style="font-size: 35px; color: green;vertical-align: middle;">check</span></h4>
                        <h4>Permiso de circulación: <span class="material-icons" style="font-size: 35px; color: green;vertical-align: middle;">check</span></h4>
                        <h4>Seguro obligatorio: <span class="material-icons" style="font-size: 35px; color: green;vertical-align: middle;">check</span></h4>
                        <h4>Seguro vehicular: <span class="material-icons" style="font-size: 35px; color: green;vertical-align: middle;">check</span></h4>
                        <hr class="pb-3">
                        <h4><strong>Conductor asignado:</strong></h4>
                        <h4>Alejandro Lorens</h4>
                    </div>
                </section>

                <section class="correo p-5">
                    <a target="_blank" href="">
                    <div class="row animated-section">
                        <div class="col-3 py-3">
                            <span class="material-icons" style="font-size:40px;">info</span>
                        </div>
                        <div class="col-9 marginPhone animated-section">
                            <a href="{{ $link_ficha_tecnica }}">
                            <p class="principal">Ficha técnica</p>
                            </a>                            
                        </div>
                    </div>
                    </a>
                </section>

                <section class="telefono p-5">
                    <a target="_blank" >
                    <div class="row">
                        <div class="col-3 py-3 animated-section">
                            <span class="material-icons" style="font-size:40px;">description</span>

                        </div>
                        <div class="col-9 marginPhone animated-section">
                            <a href="{{ $link_ficha_tecnica }}">
                            <p class="principal">Revisión técnica</p>
                            </a>
                        </div>
                    </div>
                    </a>
                </section>

                <section class="descargarPresentacion p-5 ">
                    <a href="https://transportesbulnes.cl/PRESENTACION_TBL.pdf">
                    <div class="text-center animated-section">
                        <p class="principal">¡Revisa nuestros trabajos y trabajemos juntos!</p>
                    </div>
                    <div class="text-center">
                        <i class="material-icons bigIcon">cloud_download</i>
                    </div>
                    </a>
                    <div class="row justify-content-center">
                        <img class="card-img-top" src="/img/tbl/logo_tbl.png" style="width: 75%;">
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
