@extends('layouts.app')

@section('content')
<style>
    body {
        margin: 0;
        font-family: "Nunito", sans-serif;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.6;
        color: #060737;
        text-align: left;
        background-color: #fff;
    }
    .bg-image-vertical {
        position: relative;
        overflow: hidden;
        background-repeat: no-repeat;
        background-position: right center;
        background-size: auto 100%;
    }

    .navbar-expand-md {
        display: none !important;
    }

    .py-4 {
        padding-top: 0rem !important;
        padding-bottom: 0rem !important;
    }
    .centerAll{
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 232px;
    }
    @media (min-width: 1200px) {
    .mt-xl-n5, .my-xl-n5 {
            margin-top: 0rem !important;
        }
    }
</style>
<section class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 text-black mt-5">

                <div class="px-5 ms-xl-4 mt-5 centerAll">
                    <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                    <span class="h1 fw-bold mb-0" style="width: 204px;">
                        <img class="w-100" src="/img/lex/logov2.png" alt="">
                    </span>
                </div>

                <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5 centerAll">

         
                    <form method="POST" action="{{ route('login') }}" style="width: 23rem;"style="width: 23rem;">
                        @csrf

                        

                        <div class="form-outline mb-4">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                            <label class="form-label" for="form2Example18">{{ __('Correo') }}</label>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-outline mb-4">
                            <input  id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                            <label class="form-label" for="form2Example28">{{ __('Clave') }}</label>
                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

               
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                
                            </div>
                        </div>

                        <p class="small mb-1 pb-lg-2">
                        <button type="submit" class="btn btn-primary">
                                    {{ __('Ingresar') }}
                                </button>
                        </p>

                        <p class="small mb-3 pb-lg-2">
                        <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordar') }}
                                    </label>
                                </div>
                        </p>

                        <p class="small pb-lg-2">
                            <a class="text-muted" href="#!">
                            @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('¿Olvistaste tu clave?') }}
                                    </a>
                                @endif
                            </a>
                        </p>
                        <!-- <p>Don't have an account? <a href="#!" class="link-info">Register here</a></p> -->

                    </form>

                </div>

            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="/img/lex/login.png" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
            </div>
        </div>
    </div>
</section>
@endsection