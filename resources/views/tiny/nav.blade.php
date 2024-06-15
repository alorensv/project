<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light shadow-sm">
            <div class="container">
                <div class="col-md-3 bg-light py-1">
                    
                    <a class="navbar-brand" href="{{ route('inicio') }}">
                        <img src="{{ env('PRE_HOST') . '/img/tiny/tiny_logo.png' }}" class="mx-auto d-block img-fluid">
                    </a>
                </div>

                <div class="col-lg-9 bg-light py-1">
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
                                    <li class="nav-item  px-2 pt-1">
                                        <a class="nav-link {{request()->routeIs('market') ? 'active' : ''}}" href="{{ route('market') }}">{{ __('Market Place') }}</a>
                                    </li>
                                    <!--
                                    <li class="nav-item">
                                        <a class="nav-link {{request()->routeIs('desarrollo') ? 'active' : ''}}" href="{{ route('desarrollo') }}">{{ __('Desarrollo de Software') }}</a>
                                    </li> -->
                                    
                                    <!-- <li class="nav-item pl-2 pr-3 pt-1">
                                        <a class="nav-link {{request()->routeIs('portafolio') ? 'active' : ''}}" href="{{ route('portafolio') }}">{{ __('Portafolio') }}</a>
                                    </li> -->
                                    <li class="nav-item pl-2 contactoMenu">
                                        <a class="nav-link d-flex align-items-center" style="color: white!important;" href="{{ route('contacto') }}">
                                            {{ __('Contacto') }}
                                            <i style="color: white; font-size: 35px!important; margin-left: 5px;" class="material-icons">arrow_forward</i>
                                        </a>
                                    </li>

                                    <!--
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif-->
                                @else
                                    <li class="nav-item dropdown">

                                        <!--<li class="nav-item">
                                            <a class="nav-link {{request()->routeIs('inicio') ? 'active' : ''}}" href="{{ route('inicio') }}">{{ __('Inicio') }}</a>
                                        </li>-->
                                        <li class="nav-item">
                                            <a class="nav-link {{request()->routeIs('market') ? 'active' : ''}}" href="{{ route('market') }}">{{ __('Market Place') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('misCompras') }}">Mis Compras</a>
                                        </li>

                                        @if(Auth::check() && Auth::user()->rol > 0)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('productos') }}">Productos</a>
                                        </li> 
                                        @endif  

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