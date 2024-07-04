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

            <div>
                <button class="btn btn-primary d-flex align-items-center" @click="addFormEquipo()">
                    <span class="material-icons mr-2">add</span>
                    Agregar Equipo
                </button>
            </div>

        </div>

        <h1>Listado de Equipos</h1>
        <table id="equiposTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Tipo ID</th>
                    <th>Nombre</th>
                    <th>Año</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Patente</th>
                    <th>Color</th>
                    <th>Subtipo ID</th>
                    <th>Link Ficha Técnica</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="equipo in filteredEquipos" :key="equipo.id">
                    <td>@{{ equipo.tipo_id }}</td>
                    <td>@{{ equipo.nombre }}</td>
                    <td>@{{ equipo.anio }}</td>
                    <td>@{{ equipo.marca }}</td>
                    <td>@{{ equipo.modelo }}</td>
                    <td>@{{ equipo.patente }}</td>
                    <td>@{{ equipo.color }}</td>
                    <td>@{{ equipo.subtipo_id }}</td>
                    <td><a :href="equipo.link_ficha_tecnica" target="_blank">Ficha Técnica</a></td>
                    <td><img :src="equipo.img" alt="Imagen del equipo" style="width: 50px; height: auto;"></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

@include('tbl.intranet.modals.addEditEquipo')
</div>
<!-- Material Icons -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<script>
    let vueAdminEquipos = new Vue({
        el: '#vueAdminEquipos',
        data: {
            equipos: [],
            tipos: [],
            searchTerm: '',
            equipoSeleccionado: {},
            equipo: {
                tipo_id: '',
                nombre: '',
                anio: '',
                marca: '',
                modelo: '',
                patente: '',
                color: '',
                subtipo_id: '',
                link_ficha_tecnica: '',
            }
        },
        created() {
            this.getTiposEquipos();
            this.getEquipos();            
        },
        computed: {
            filteredEquipos() {
                return this.equipos.filter(equipo => 
                    equipo.nombre.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                    equipo.marca.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                    equipo.modelo.toLowerCase().includes(this.searchTerm.toLowerCase())
                );
            }
        },
        methods: {
            getTiposEquipos() {
                axios.get('/tiposEquipos')
                    .then(response => {
                        this.tipos = response.data.datos;
                    })
                    .catch(error => {
                        console.error('Error al obtener categorías:', error);
                    });
            },
            getEquipos() {
                axios.get('/getEquipos', {
                        params: {
                            subcategorias: this.subcategoriasSeleccionadas
                        }
                    })
                    .then(response => {
                        this.equipos = response.data.equipos;
                    })
                    .catch(error => {
                        console.error('Error al obtener productos:', error);
                    });
            },
            addFormEquipo(){
                $("#addEditEquipo").modal('show');    
            },
            agregarEquipo() {
                axios.post('/agregarEquipo', this.equipo)
                .then(response => {
                    console.log('Respuesta del servidor:', response.data);
                    //$("#addEditEquipo").modal('hide'); 
                            
                })
                .catch(error => {
                    // Manejar el error
                    console.error('Hubo un error al enviar el formulario', error);
                });
            },
        }
    });
</script>

@endsection
