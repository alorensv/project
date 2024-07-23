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
            <table id="equiposTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Fecha cotización</th>
                        <th>Tipo</th>
                        <th>Comentarios</th>
                        <th>Fecha servicio</th>
                        <th>Fecha término</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Cliente</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="cotizacion in filteredCotizaciones.data" :key="cotizacion.id">
                        <td>@{{ formatDate(cotizacion.created_at) }}</td>
                        <td>
                            <span v-if="cotizacion.equipo_id">@{{ cotizacion.nombreEquipo }} @{{ cotizacion.patente }}</span>
                            <span v-else-if="cotizacion.servicio_id">@{{ cotizacion.nombreServicio }}</span>
                            <span v-else>General</span>
                        </td>
                        <td>@{{ truncateText(cotizacion.comentarios, 100) }}</td>
                        <td>@{{ formatDate(cotizacion.fecha_servicio) }}</td>
                        <td v-if="cotizacion.fecha_termino">@{{ formatDate(cotizacion.fecha_termino) }}</td>
                        <td v-else></td>
                        <td>@{{ cotizacion.origen }}</td>
                        <td>@{{ cotizacion.destino }}</td>
                        <td>@{{ cotizacion.nombre }}</td>
                        <td><span class="badge badge-success" @click="showMore(cotizacion)">Ver más</span></td>
                    </tr>
                </tbody>
            </table>

            <div class="col-md-12 text-center" style="width: 100%;">
                <span>
                    @{{ cotizaciones.from }}-@{{ cotizaciones.to }} de @{{ cotizaciones.total }} Resultados
                </span>
            </div>

            <div class="col-md-12 text-center paginate mt-3 mb-3">
                <button class="btn" style="border: none;"  :class="{ 'disabled': !cotizaciones.prev_page_url }" @click="prevPage">&lt;&lt;</button>

                <!-- Botones de paginación -->
                <template v-for="(page, index) in pageNumbers">
                    <button
                        v-if="page === '...'"
                        :key="index"
                        class="btn disabled"
                    >
                        @{{ page }}
                    </button>
                    <button
                        v-else
                        :key="page"
                        class="btn"
                        :class="{ 'selected': page === cotizaciones.current_page }"
                        @click="goToPage(page)"
                    >
                        @{{ page }}
                    </button>
                </template>

                <button class="btn" style="border: none;" :class="{ 'disabled': !cotizaciones.next_page_url }" @click="nextPage">&gt;&gt;</button>
            </div>

        </div>
    </section>

    <!-- Popup Modal -->
    <div class="modal fade" id="showMoreCotizaciones" tabindex="-1" role="dialog" aria-labelledby="showMoreCotizacionesLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showMoreCotizacionesLabel">Detalles de Cotización</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Cotización:</strong>
                        <span v-if="selectedCotizacion.equipo_id">Equipo</span>
                        <span v-else-if="selectedCotizacion.servicio_id">Servicio</span>
                        <span v-else>General</span>
                    </p>
                    <p>
                        <span v-if="selectedCotizacion.equipo_id">
                            @{{ selectedCotizacion.nombreEquipo }} <br>
                            <strong>Marca:</strong>@{{selectedCotizacion.marcaEquipo}} <br>
                            <strong>Modelo:</strong>@{{selectedCotizacion.modeloEquipo}} <br>
                            <strong>Patente:</strong> @{{ selectedCotizacion.patente }}
                        </span>
                        <span v-else-if="selectedCotizacion.servicio_id">@{{ selectedCotizacion.nombreServicio }}</span>
                        <span v-else></span>
                    </p>
                    <p><strong>Fecha cotización:</strong> @{{ formatDate(selectedCotizacion.created_at) }}</p>
                    <p><strong>Comentarios:</strong> @{{ selectedCotizacion.comentarios }}</p>
                    <p><strong>Fecha servicio:</strong> @{{ formatDate(selectedCotizacion.fecha_servicio) }}</p>
                    <p><strong>Fecha término:</strong> @{{ formatDate(selectedCotizacion.fecha_termino) }}</p>
                    <p><strong>Origen:</strong> @{{ selectedCotizacion.origen }}</p>
                    <p><strong>Destino:</strong> @{{ selectedCotizacion.destino }}</p>
                    <p><strong>Largo:</strong> @{{ selectedCotizacion.largo }}</p>
                    <p><strong>Ancho:</strong> @{{ selectedCotizacion.ancho }}</p>
                    <p><strong>Alto:</strong> @{{ selectedCotizacion.alto }}</p>
                    <p><strong>Peso:</strong> @{{ selectedCotizacion.peso }}</p>
                    <p><strong>Cliente:</strong> @{{ selectedCotizacion.nombre }}</p>
                    <p><strong>Email:</strong> @{{ selectedCotizacion.email }}</p>
                    <p><strong>Teléfono:</strong> @{{ selectedCotizacion.telefono }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Material Icons -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

<script>
    new Vue({
        el: '#vueAdminEquipos',
        data: {
            cotizaciones: {},
            searchTerm: '',
            selectedCotizacion: {},
            totalPages: 0,
        },
        created() {
            this.getCotizaciones();
        },
        computed: {
            filteredCotizaciones() {
                if (this.searchTerm) {
                    return {
                        ...this.cotizaciones,
                        data: this.cotizaciones.data.filter(cotizacion =>
                            cotizacion.nombre.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                            cotizacion.email.toLowerCase().includes(this.searchTerm.toLowerCase())
                        )
                    };
                }
                return this.cotizaciones;
            },
            pageNumbers() {
                const pages = [];
                const currentPage = this.cotizaciones.current_page;
                const totalPages = this.cotizaciones.last_page;

                // Define el rango de páginas alrededor de la página actual
                const range = 2;

                // Mostrar la primera página
                if (totalPages > 1) {
                    pages.push(1);
                }

                // Mostrar las páginas alrededor de la página actual
                for (let i = Math.max(2, currentPage - range); i <= Math.min(totalPages - 1, currentPage + range); i++) {
                    pages.push(i);
                }

                // Agregar puntos suspensivos si hay un salto en las páginas
                if (currentPage - range > 2) {
                    pages.splice(1, 0, '...');
                }
                if (currentPage + range < totalPages - 1) {
                    pages.splice(pages.length - 1, 0, '...');
                }

                // Mostrar la última página
                if (totalPages > 1 && !pages.includes(totalPages)) {
                    pages.push(totalPages);
                }

                return [...new Set(pages)]; // Eliminar duplicados
            }
        },
        methods: {
            getCotizaciones(page = 1) {
                axios.get(`/getCotizaciones?page=${page}`)
                    .then(response => {
                        this.cotizaciones = response.data.cotizaciones;
                        this.totalPages = this.cotizaciones.last_page; // Total de páginas
                    })
                    .catch(error => {
                        console.error('Error al obtener cotizaciones:', error);
                    });
            },
            formatDate(date) {
                let options = {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                };
                return new Date(date).toLocaleDateString('es-ES', options);
            },
            truncateText(text, length) {
                return text.length > length ? text.substring(0, length) + '...' : text;
            },
            showMore(cotizacion) {
                this.selectedCotizacion = cotizacion;
                $('#showMoreCotizaciones').modal('show');
            },
            nextPage() {
                if (this.cotizaciones.next_page_url) {
                    this.getCotizaciones(this.cotizaciones.current_page + 1);
                }
            },
            prevPage() {
                if (this.cotizaciones.prev_page_url) {
                    this.getCotizaciones(this.cotizaciones.current_page - 1);
                }
            },
            goToPage(page) {
                if (page >= 1 && page <= this.totalPages) {
                    this.getCotizaciones(page);
                }
            }
        }
    });
</script>

<style>
    .text-center {
        text-align: center;
    }

    .btn {
        border: 1px solid #060737;
        background-color: #fff;
        color: #060737;
        margin: 0 2px;
        padding: 12px 12px;
        cursor: pointer;
    }

    .btn.selected {
        background-color: #060737;
        color: #fff;
    }

    .btn.disabled {
        background-color: #e9ecef;
        color: #6c757d;
        cursor: not-allowed;
    }

    .btn:hover {
        background-color: #060636;
        color: #fff;
    }

    .paginate {
        display: flex;
        justify-content: center;
    }
</style>

@endsection
