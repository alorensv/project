@extends('lex.plantilla')

@section('content')

<div id="vueHome">
    <section class="adminDiv">
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
                <div class="col-6">
                    <h4>Pendientes firmas</h4>
                    <table id="documentosPendientesTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Documento</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="doc in documentosPendientes.data" :key="documentosPendientes.id">
                                <td>@{{ doc.idRedaccion }}</td>
                                <th>@{{ doc.nombreDoc }}</th>
                                <td class="text-center align-middle">
                                    <template v-if="doc.firmasPendientes">
                                        <span class="badge badge-success" @click="firmardocumento(doc.idRedaccion)">Firmar</span>
                                    </template>

                                </td>
                                <td class="text-center align-middle">
                                    <template v-if="doc.ruta">
                                        <a :href="doc.ruta" target="_blank" title="Previsualización del documento">
                                            <i class="material-icons">download</i>
                                        </a>
                                    </template>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    <div class="col-md-12 text-center" style="width: 100%;">
                        <span>
                            @{{ documentosPendientes.from }}-@{{ documentosPendientes.to }} de @{{ documentosPendientes.total }} Resultados
                        </span>
                    </div>

                    <div class="col-md-12 text-center paginate mt-3 mb-3">
                        <button class="btn" style="border: none;" :class="{ 'disabled': !documentosPendientes.prev_page_url }" @click="prevPage">&lt;&lt;</button>

                        <!-- Botones de paginación -->
                        <template v-for="(page, index) in pageNumbers">
                            <button v-if="page === '...'" :key="index" class="btn disabled">
                                @{{ page }}
                            </button>
                            <button v-else :key="page" class="btn" :class="{ 'selected': page === documentosPendientes.current_page }" @click="goToPage(page)">
                                @{{ page }}
                            </button>
                        </template>

                        <button class="btn" style="border: none;" :class="{ 'disabled': !documentosPendientes.next_page_url }" @click="nextPage">&gt;&gt;</button>
                    </div>
                </div>
                <div class="col-6">
                    <h4>Documento disponible</h4>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    new Vue({
        el: '#vueHome',
        data: {
            documentosPendientes: {
                data: [],
                current_page: 1,
                prev_page_url: null,
                next_page_url: null,
                last_page: 1,
                from: 1,
                to: 1,
                total: 0
            },
            searchTerm: '',
            totalPages: 0,
        },
        watch: {
            searchTerm() {
                this.searchPendingDocs();
            }
        },
        created() {
            this.getPendingDocs();
        },
        computed: {
            pageNumbers() {
                const pages = [];
                const currentPage = this.documentosPendientes.current_page;
                const totalPages = this.documentosPendientes.last_page;
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
            nextPage() {
                if (this.equipos.next_page_url) {
                    this.getEquipos(this.equipos.current_page + 1);
                }
            },
            prevPage() {
                if (this.equipos.prev_page_url) {
                    this.getEquipos(this.equipos.current_page - 1);
                }
            },
            goToPage(page) {
                if (page >= 1 && page <= this.equipos.last_page) {
                    this.getEquipos(page);
                }
            },
            toggleLoading(show) {
                const loading = document.getElementById('loading');
                if (show) {
                    loading.style.visibility = 'visible';
                } else {
                    loading.style.visibility = 'hidden';
                }
            },
            getPendingDocs(page = 1) {
                axios.get(`/getDocumentosPendientesPagadoPerPage`, {
                        params: {
                            page: page,
                            search: this.searchTerm,
                        }
                    })
                    .then(response => {
                        this.documentosPendientes = response.data.documentos;
                        console.log(this.equipos);
                    })
                    .catch(error => {
                        console.error('Error al obtener productos:', error);
                    });
            },
            searchPendingDocs() {
                this.toggleLoading(true);
                this.getPendingDocs(1); // Reinicia la búsqueda desde la primera página
                this.toggleLoading(false);
            },
            firmardocumento(idRedaccion) {
                axios.post('/auth', {
                    idRedaccion: idRedaccion
                })
                .then(response => {        
                                        
                    if(response.data.urlRedirect) {
                        console.log(JSON.stringify(response.data));
                        alert(JSON.stringify(response.data))
                        window.location.href = response.data.urlRedirect;
                    } else {
                        // Si no hay URL, mostrar el error o un mensaje
                        alert('No se pudo obtener la URL de redirección.');
                    }
            
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