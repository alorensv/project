@extends('tbl.intranet.plantilla')

@section('content')

<style>
    .faq-container {
            display: flex;
            align-items: center;
        }
        .faq-icon {
            background-color: #d64078;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }
        .faq-text {
            background-color: #d64078;
            color: white;
            border-radius: 20px;
            padding: 5px 15px;
            margin-left: -10px;
            z-index: -1;
        }
</style>
<div id="vueHome">
    <section id="divadminEquipos" class="adminDiv">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div>
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        {{ __('Bienvenido ') }}{{ Auth::user()->name }}
                    </div>
                </div>
            </div>
            <div class="row py-5">
                <div class="col-4">
                    <div class="productDiv">
                        <div class="card mb-3" style="border-radius: 20px;">
                            <div class="card-header pt-4">
                                <h5 class="card-title">Generar token de acceso a equipos</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form @submit.prevent="generarToken">
                                            @csrf
                                            <div class="form-group">
                                                <label for="correo">Correo</label>
                                                <input type="email" class="form-control" v-model="email" placeholder="Acá tu correo" maxlength="255" id="email">
                                            </div>
                                            <div v-if="token">
                                                <p>Tu token es: </p>
                                                <p>@{{ token }}</p>
                                                <button type="button" @click="copiarToken" class="btn btn-secondary"><span class="material-icons">content_copy</span></button>
                                            </div>
                                            <button type="submit" class="w-100 btn btn-primary">Generar</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="row">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    new Vue({
        el: '#vueHome',
        data: {
            token: null,
            moduleId: 1,
            email: ''
        },
        methods: {
            generarToken() {
                axios.post('/tokens/create', {
                        module_id: this.moduleId,
                        email: this.email
                    })
                    .then(response => {
                        this.token = response.data.token;
                    })
                    .catch(error => {
                        console.error('Hubo un error al enviar el formulario', error);
                    });
            },
            copiarToken() {
                if (this.token) {
                    navigator.clipboard.writeText(this.token).then(() => {
                        alert('Token copiado al portapapeles');
                    }).catch(err => {
                        console.error('Hubo un error al copiar el token', err);
                    });
                } else {
                    alert('No hay token para copiar');
                }
            }
        }
    });
</script>
@endsection