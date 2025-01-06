<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/logo.png" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Transportes Bulnes') }}</title>

    <!-- Incluir Vue.js desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('assets/js/consultas.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
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
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/assets/owl.theme.default.min.css') }}">
    <script src="{{ asset('assets/vendors/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/owlcarousel/owl.carousel.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/js/swiffy-slider.min.js" crossorigin="anonymous" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/css/swiffy-slider.min.css" rel="stylesheet" crossorigin="anonymous">

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
            text-align: center;
            /* Asegura que el contenido esté centrado horizontalmente */
        }

        .text-center img {
            display: inline-block;
            /* Asegura que la imagen se comporte como un elemento en línea para el centrado */
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
            overflow-x: hidden;
            /* Para ocultar cualquier desbordamiento horizontal */
        }

        .centered-div {
            width: 50%;
            border: 2px solid rgba(255, 255, 255, 0.7);
            /* Borde blanco difuminado */
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
            /* Sombra blanca difuminada */
        }

        .headerTJ {
            background-color: #060737;
            max-height: 280px;
            min-height: 240px;
            display: flex;
            justify-content: center;
            /* Centra el contenido horizontalmente */
            align-items: center;
            /* Centra el contenido verticalmente */
        }

        .topTJ {
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
            max-height: 630px !important;
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
            margin-bottom: 0.3rem !important;
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
            margin-bottom: 0.3rem !important;
        }

        .correo a:hover {
            font-size: 22px;
            color: #c9c9d8;
            text-decoration: none;
            background-color: transparent;
        }

        .descargarPresentacion {
            background-color: white;
            color: #060737;
        }

        .descargarPresentacion p {
            font-size: 22px;
            margin-bottom: 0.3rem !important;
        }

        .personalData p {
            margin-top: 0;
            margin-bottom: 0.3rem;
        }

        @media (max-width: 990px) {
            body {
                padding-top: 0rem !important;
            }

            .container,
            .container-fluid,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl {
                width: 100%;
                padding-right: 0px;
                padding-left: 0px;
                margin: 0;
                /* Eliminar márgenes */
            }

            .centered-div {
                width: 100% !important;
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
                width: 325px !important;
                padding: 7% !important;
            }

            .personalData {
                max-height: 480px !important;
            }

            .iconTJ {
                font-size: 33px;
                padding-left: 15px !important;
            }

            .marginPhone {
                margin-left: -20px;
            }

        }

        @media (max-width: 480px) {
            body {
                padding-top: 0rem !important;
            }

            .container,
            .container-fluid,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl {
                width: 100%;
                padding-right: 0px;
                padding-left: 0px;
                margin: 0;
                /* Eliminar márgenes */
            }

            .centered-div {
                width: 100% !important;
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
                width: 298px !important;
                padding: 11% !important;
            }

            .personalData {
                max-height: 480px !important;
            }

            .iconTJ {
                font-size: 33px;
                padding-left: 15px !important;
            }

            .marginPhone {
                margin-left: -20px;
            }
        }
    </style>
</head>

<body>
    <div class="container" id="presentacionEquipo">
        <div class="row justify-content-center mb-5">
            <div class="centered-div">
                <section class="headerTJ p-3 pt-5 pb-5">
                    <div class="row">
                        <div class="topTJ text-center">
                            <img class="card-img-top" src="/img/tbl/logo2.png">
                        </div>

                    </div>
                </section>

                @if($img)
                <section style="display: flex;justify-content: center;align-items: center;">
                    <div class="w-100">
                        <img class="w-100" src="{{ $img }}">
                    </div>
                </section>
                @endif

                <section class="personalData p-5">
                    <div class="datos animated-section">
                        <h3 style="font-size: 45px;"><strong>{{ $nombre }}</strong></h3>
                        <h3 class="pb-3">{{ $marca }} {{ $modelo }}</h3>
                        <h3><strong>Patente:</strong> {{ $patente }}-{{ $num_verificador }}</h3>
                        <h3><strong>Año:</strong> {{ $anio }}</h3>
                        <hr>
                        <h4>Revisón técnica: <span class="material-icons" style="font-size: 35px; color: green;vertical-align: middle;">check</span></h4>
                        <h4>Permiso de circulación: <span class="material-icons" style="font-size: 35px; color: green;vertical-align: middle;">check</span></h4>
                        <h4>Seguro obligatorio: <span class="material-icons" style="font-size: 35px; color: green;vertical-align: middle;">check</span></h4>
                        <h4>Seguro propio : <span class="material-icons" style="font-size: 35px; color: green;vertical-align: middle;">check</span></h4>
                    </div>
                </section>

  

                <section class="correo p-5">
                    <a href="{{ $link_ficha_tecnica }}" target="_blank">
                        <div class="row">
                            <div class="col-3 py-3 animated-section">
                                <span class="material-icons" style="font-size:40px;">info</span>
                            </div>
                            <div class="col-9 marginPhone animated-section py-3">
                                <p class="principal">Ficha técnica</p>
                            </div>
                        </div>
                    </a>
                </section>


                <section class="telefono p-5">
                    <a target="_blank">
                        <div class="row">
                            <div class="col-3 py-3 animated-section">
                                <span class="material-icons" style="font-size:40px;">description</span>
                            </div>
                            <div class="col-9 marginPhone animated-section py-3" @click="accesoPrivado()">
                                <p class="principal">Documentación</p>
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

        
        <div class="modal fade" id="loginIntranet" tabindex="-1" aria-labelledby="loginIntranetLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="loginIntranetLabel">¡Acceso con autorización!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-5">
                    <form @submit.prevent="submitLogin">
                        <div class="form-group">
                            <label for="clave">Token:</label>
                            <input type="password" class="form-control" id="clave" v-model="clave" required minlength="6">
                        </div>

                        <div class="col-12 text-right">
                            <button type="submit" class="w-100 btn btn-primary">Ver documentación</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    </div>


    

    <script>
        new Vue({
            el: '#presentacionEquipo',
            data: {
                correo: '',
                clave: '',
                equipoId:  '<?= isset($id) ? $id : null ?>', 
                baseUrl: window.location.origin
            },
            created() {},
            methods: {
                accesoPrivado() {
                    $("#loginIntranet").modal('show');
                },
                loginEquipos() {
                    alert("ahora soi")
                },
                _submitLogin() {
                    var claveEncriptada = this.clave;
                    var equipoId = this.equipoId; // Obtener el ID del equipo
                    
                    axios.post('/tokens/validate', {
                            token: claveEncriptada,
                            module_id: 1,
                        })
                        .then(response => {
                            if (response.data.success == true) {
                                var redirectUrl = `${this.baseUrl}/equipos/documentation/${equipoId}?token=${encodeURIComponent(claveEncriptada)}`; // Construir la URL con el token
                                window.open(redirectUrl, '_blank');
                            } else {
                                alert(response.data.message);
                            }
                        })
                        .catch(error => {
                            alert("Usuario sin permisos");
                            console.error('Error al enviar el formulario:', error);
                        });
                },
                submitLogin() {
                    this._submitLogin();
                },
            }
        });
    </script>

</body>

</html>