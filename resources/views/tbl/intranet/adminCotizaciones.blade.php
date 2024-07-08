@extends('tbl.intranet.plantilla')

@section('content')
<div id="vueAdminEquipos">

    <section id="divadminEquipos" class="adminDiv">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- Campo de búsqueda -->
                <div>
                    <div class="input-group custom-rounded">
                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar..." v-model="searchTerm">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="material-icons">search</i>
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            <h1>Listado de Cotizaciones</h1>
            <table id="equiposTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Comentarios</th>
                        <th>Fecha servicio</th>
                        <th>Fecha término</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Cliente</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="cotizacion in filteredCotizaciones" :key="cotizacion.id">
                        <td>
                            <span v-if="cotizacion.equipo_id">@{{ cotizacion.equipo_id }}</span>
                            <span v-else-if="cotizacion.servicio_id">@{{ cotizacion.servicio_id }}</span>
                            <span v-else>General</span>
                        </td>
                        <td>@{{ cotizacion.comentarios }}</td>
                        <td>@{{ cotizacion.fecha_servicio }}</td>
                        <td>@{{ cotizacion.fecha_termino }}</td>
                        <td>@{{ cotizacion.origen }}</td>
                        <td>@{{ cotizacion.destino }}</td>
                        <td>@{{ cotizacion.nombre }}</td>
                        <td>@{{ cotizacion.email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>

<!-- Material Icons -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

<script>
    let vueAdminEquipos = new Vue({
        el: '#vueAdminEquipos',
        data: {
            cotizaciones: [],
            searchTerm: '',
        },
        created() {
            this.getCotizaciones();
        },
        computed: {
            filteredCotizaciones() {
                return this.cotizaciones.filter(cotizacion =>
                    cotizacion.nombre.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                    cotizacion.email.toLowerCase().includes(this.searchTerm.toLowerCase())
                );
            },
        },        
        methods: {
            getCotizaciones() {
                axios.get('/getCotizaciones')
                    .then(response => {
                        this.cotizaciones = response.data.cotizaciones; // Asignar correctamente los datos
                        console.log(this.cotizaciones);
                    })
                    .catch(error => {
                        console.error('Error al obtener cotizaciones:', error);
                    });
            },
            addFormEquipo() {
                $("#addEditEquipo").modal('show');
            },
        }
    });
</script>

@endsection
