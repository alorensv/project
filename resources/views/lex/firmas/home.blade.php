@extends('lex.plantilla')

@section('content')


<div id="vueHome">
    
    @include('lex.modals.verDocumento')

    <section class="adminDiv">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 pl-5 pr-5">

                    <div>
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <h5>{{ __('Bienvenido ') }}{{ Auth::user()->name }}</h5>
                        <p>Acá podrás encontrar todos los documentos que creaste, documentos que requieren tu firma electrónica avanzada y todos aquellos documentos disponibles para descargar donde tu seas uno de los firmantes.</p>
                    </div>
                </div>

                <div class="w-100 py-3">
                    <div class="col-12">
                        <tabs-home>
                        </tabs-home>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

@endsection