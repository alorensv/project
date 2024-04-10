@extends('plantilla')

@section('content')
<style>
    .market-body {
        height: 100%;
    }

    .productDiv {
        flex-basis: 100%;
        flex-basis: 31.3868613139%;
        margin-right: 2.9197080292%;
        margin-top: 2.9197080292%;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 1px 8px rgba(0, 0, 0, .1);
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
        text-align: left;
        transition: translate .18s, box-shadow .18s;
    }
</style>
<section class="container py-4" style="margin-top: 20px;">
    <div class="row market-body ">
        <div class="col-3">

            <form method="POST">
                @csrf

                <label>Subcategorías:</label>
                @foreach ($datos['categorias'] as $categoria)
                <h5>{{ $categoria['nombre'] }}</h5>
                @foreach ($categoria['subcategorias'] as $subcategoria)
                <label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1" name="subcategorias[]" value="{{ $subcategoria['id'] }}">
                        <label class="form-check-label" for="gridCheck1">
                            {{ $subcategoria['nombre'] }}
                        </label>
                    </div>
                </label>
                @endforeach
                @endforeach
                <br>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>


        </div>
        <div class="col-9">
            <div class="row">

                @foreach ($datos['categorias'] as $categoria)
                    @foreach ($categoria['subcategorias'] as $subcategoria)
                    @foreach ($subcategoria['productos'] as $producto)

                    <div class="col-4">
                        <div class="productDiv">
                            <div class="card">
                                <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_18ec3f96031%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_18ec3f96031%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.1953125%22%20y%3D%2296.3%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $producto['nombre'] }}</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="{{ route('detalle', ['id' => $producto['id']]) }}" class="btn btn-primary">ID: {{ $producto['id'] }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    @endforeach
                @endforeach

            </div>
        </div>
    </div>
</section>
@endsection
