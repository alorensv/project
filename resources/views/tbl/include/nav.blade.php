<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light shadow-sm">
            <div class="container">
                <div class="col-md-3 bg-light py-1">
                    
                    <a class="navbar-brand" href="{{ route('inicio') }}">
                        <img src="/img/tbl/logo_tbl.png" class="mx-auto d-block img-fluid">
                    </a>
                </div>

                <div class="col-lg-6 bg-light py-1">
                    <div class="col-lg-12 bg-light py-1">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">

                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                    <li class="nav-item px-2 pt-1">
                                        <a class="nav-link {{request()->routeIs('inicio') ? 'active' : ''}}" href="{{ route('inicio') }}">{{ __('Inicio') }}</a>
                                    </li>
                                   
                                    <li class="nav-item pl-2 pr-3 pt-1">
                                        <a class="nav-link {{request()->routeIs('portafolio') ? 'active' : ''}}" href="{{ route('portafolio') }}">{{ __('Servicios') }}</a>
                                    </li>

                                    <li class="nav-item pl-2 pr-3 pt-1">
                                        <a class="nav-link {{request()->routeIs('portafolio') ? 'active' : ''}}" href="{{ route('portafolio') }}">{{ __('Nuestros equipos') }}</a>
                                    </li>

                                    <li class="nav-item pl-2 pr-3 pt-1">
                                        <a class="nav-link {{request()->routeIs('portafolio') ? 'active' : ''}}" href="{{ route('portafolio') }}">{{ __('Sobre nosotros') }}</a>
                                    </li>
                                @endguest
                            </ul>


                        </div>
                    </div>
                </div>

                <div class="col-lg-3 bg-light py-1">
                    <div class="bg-light py-1">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">

                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                    <li class="nav-item pl-2">
                                        <a class="btn btn-outline-secondary d-flex align-items-center" href="{{ route('contacto') }}">
                                            {{ __('Iniciar sesión') }}
                                        </a>
                                    </li>
                                    <li class="nav-item pl-2">
                                        <a class="btn btn-primary d-flex align-items-center" href="{{ route('contacto') }}">
                                            {{ __('Contáctenos') }}
                                        </a>
                                    </li>
                                @else
                                    <li class="nav-item dropdown">

                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
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


                        </div>
                    </div>
                </div>
                
            </div>
        </nav>

        <style>


        </style>