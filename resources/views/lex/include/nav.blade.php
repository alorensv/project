<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light shadow-sm">
    <div class="container">
        <div class="col-md-2 bg-light py-1 centerCel">

            <a class="navbar-brand" href="{{ route('inicio') }}">
                <img src="/img/lex/logov3.png" class="mx-auto d-block img-fluid logoWeb">
            </a>
        </div>

        <div class="col-lg-7 bg-light py-1">
            <div class="col-lg-12 bg-light py-1">
                <div class="d-flex">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="d-flex ms-auto celDisplay">
                    
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="btn btn-outline-secondary d-flex align-items-center" href="{{ route('login') }}">
                                {{ __('Iniciar sesión') }}
                            </a>
                        </li>
                        <li class="nav-item">
                        <a class="btn btn-outline-secondary d-flex align-items-center" href="/carroCompras">
                                <span class="material-icons">shopping_cart</span>
                         </a>
                        </li>
                    </ul>
                </div> 

                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                       
                        <!-- <li class="nav-item px-2 pt-1">
                            <a class="nav-link {{request()->routeIs('inicio') ? 'active' : ''}}" href="{{ route('inicio') }}">{{ __('Inicio') }}</a>
                        </li>

                        <li class="nav-item dropdown px-2 pt-1">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Lista de documentos privados') }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{ request()->is('redactar/1') ? 'active' : '' }}" href="{{ url('redactar/1') }}">
                                {{ __('Redactar') }}
                            </a>


                              <a class="dropdown-item {{request()->routeIs('servicio_cargas_especiales') ? 'active' : ''}}" href="{{ route('servicio_cargas_especiales') }}">{{ __('Transporte de cargas especiales') }}
                                </a>

                                <a class="dropdown-item {{request()->routeIs('transporte_equipos_forestales') ? 'active' : ''}}" href="{{ route('transporte_equipos_forestales') }}">{{ __('Transportes de equipos forestales') }}
                                </a>

                                <a class="dropdown-item {{request()->routeIs('rescate_equipos_siniestrados') ? 'active' : ''}}" href="{{ route('rescate_equipos_siniestrados') }}">{{ __('Transporte y rescate equipos siniestrados') }}
                                </a>

                                <a class="dropdown-item {{request()->routeIs('transporte_maquinaria') ? 'active' : ''}}" href="{{ route('transporte_maquinaria') }}">{{ __('Transporte de maquinaria') }}
                                </a>

                                <a class="dropdown-item {{request()->routeIs('servicios_izajes') ? 'active' : ''}}" href="{{ route('servicios_izajes') }}">{{ __('Servicios de Izaje') }}
                                </a>

                                <a class="dropdown-item {{request()->routeIs('venta_combustible') ? 'active' : ''}}" href="{{ route('venta_combustible') }}">{{ __('Venta de combustible') }}
                                </a>

                                
                                
                            </div>

                        </li> -->

                        <li class="nav-item pl-2 pr-3 pt-1">
                            <a class="nav-link {{request()->routeIs('validezLegal') ? 'active' : ''}}" href="/validezLegal">{{ __('Validez legal') }}</a>
                        </li>

                        <li class="nav-item pl-2 pr-3 pt-1">
                            <a class="nav-link" href="https://swap-lex.cl/asesorias/" target="_blank">{{ __('Asesoría') }}</a>
                        </li>

                        <li class="nav-item pl-2 pr-3 pt-1">
                            <a class="nav-link {{request()->routeIs('ayuda') ? 'active' : ''}}" href="/ayuda">{{ __('Ayuda') }}</a>
                        </li>

                        
                        <!-- <li class="nav-item pl-2">
                            <a class="btn btn-primary  d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#contactModal">
                                Ayuda
                            </a>
                        </li> -->

                        

                        @guest
                        
                        @else

                        <li class="nav-item pl-2 pr-3 pt-1">
                            <a class="nav-link {{request()->routeIs('home') ? 'active' : ''}}" href="{{ route('home') }}">{{ __('Gestor de documentos') }}</a>
                        </li>
                            
                        @endguest
                    </ul>


                </div>
            </div>
        </div>

        <div class="col-lg-3 bg-light py-1 displayNoneCel">
            <div class="bg-light py-1">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                     


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item pl-2">
                            <a class="btn btn-outline-secondary d-flex align-items-center" href="{{ route('login') }}">
                                {{ __('Iniciar sesión') }}
                            </a>
                        </li>

                        @else

                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>

                    <ul class="navbar-nav mr-auto">
                        <a class="nav-link {{request()->routeIs('carroCompras') ? 'active' : ''}}" href="/carroCompras">
                                <span class="pt-1 material-icons">shopping_cart</span>
                         </a>
                    </ul>  

                </div>
            </div>
        </div>

    </div>
</nav>