@extends('lex.plantilla')

@section('content')

<div id="vueHome">

    <div v-bind:class="{ 'loader': loading }" v-cloak></div>


    @include('lex.modals.firmantes')

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
                <!-- Documentos Pendientes -->
                <div class="col-6">
                    <div class="divTablas"> 
                    <div class="pt-3 pb-3">
                    <h4 style="font-weight: 800;">Documentos con firmas pendientes</h4>
                    </div>


                        <table id="documentosPendientesTable" class="table table-striped" style="width:100%">
                            <thead>
                                <tr style="background-color: #737373;color: white;">
                                    <th>ID</th>
                                    <th>Documento</th>
                                    <th>Fecha creación</th>
                                    <th>Firmas pendientes</th>
                                    
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="doc in documentosPendientes.data" :key="doc.idRedaccion">
                                    <td>@{{ doc.idRedaccion }}</td>
                                    <td>@{{ doc.nombreDoc }}</td>
                                    <td>30/10/2024</td>
                                    <td class="text-center align-middle" >
                                        <span class="badge badge-primary fontBadge" @click="verFirmantes()">@{{ doc.firmasPendientes}}</span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <span class="badge badge-success" @click="firmardocumento(doc.idRedaccion)">Firmar</span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <a :href="doc.ruta" target="_blank" title="Previsualización del documento">
                                            <i class="material-icons">download</i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-md-12 text-center">
                            <span>@{{ documentosPendientes.from }}-@{{ documentosPendientes.to }} de @{{ documentosPendientes.total }} Resultados</span>
                        </div>
                        <div class="col-md-12 text-center paginate mt-3 mb-3">
                            <button class="btn" :class="{ 'disabled': !documentosPendientes.prev_page_url }" @click="prevPagePendientes">&lt;&lt;</button>
                            <template v-for="(page, index) in pageNumbersPendientes">
                                <button v-if="page === '...'" :key="index" class="btn disabled">@{{ page }}</button>
                                <button v-else :key="page" class="btn" :class="{ 'selected': page === documentosPendientes.current_page }" @click="goToPage(page)">
                                    @{{ page }}
                                </button>
                            </template>
                            <button class="btn" :class="{ 'disabled': !documentosPendientes.next_page_url }" @click="nextPagePendientes">&gt;&gt;</button>
                        </div>
                    </div>
                </div>

                <!-- Firmas Completadas -->
                <div class="col-6">
                    <div class="divTablasSuccess">
                    <div class="pt-3 pb-3">
                    <h4 style="font-weight: 800;">Documentos disponibles</h4>
                    </div>
                    <table id="documentosCompletadosTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr style="background-color: #719d75;color: white;">
                                <th>ID</th>
                                <th>Documento</th>
                                <th>Fecha creación</th>
                                <th>Fecha última firma</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="doc in documentosFirmasCompletadas.data" :key="doc.idRedaccion">
                                <td>@{{ doc.idRedaccion }}</td>
                                <th>@{{ doc.nombreDoc }}</th>
                                <td>30/10/2024</td>
                                <td>30/10/2024</td>
                                <td></td>
                                <td class="text-center align-middle">
                                    <span class="material-icons" @click="descargarDocumento(doc.idRedaccion)">download</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-md-12 text-center">
                        <span>@{{ documentosFirmasCompletadas.from }}-@{{ documentosFirmasCompletadas.to }} de @{{ documentosFirmasCompletadas.total }} Resultados</span>
                    </div>
                    <div class="col-md-12 text-center paginate mt-3 mb-3">
                        <button class="btn" :class="{ 'disabled': !documentosFirmasCompletadas.prev_page_url }" @click="prevPageFirmasCompletadas">&lt;&lt;</button>
                        <template v-for="(page, index) in pageNumbersFirmasCompletadas">
                            <button v-if="page === '...'" :key="index" class="btn disabled">@{{ page }}</button>
                            <button v-else :key="page" class="btn" :class="{ 'selected': page === documentosFirmasCompletadas.current_page }" @click="goToPage(page)">
                                @{{ page }}
                            </button>
                        </template>
                        <button class="btn" :class="{ 'disabled': !documentosFirmasCompletadas.next_page_url }" @click="nextPageFirmasCompletadas">&gt;&gt;</button>
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
            loading: false,
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
            documentosFirmasCompletadas: {
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
            pageNumbersPendientes() {
                return this.generatePageNumbers(this.documentosPendientes);
            },
            pageNumbersFirmasCompletadas() {
                return this.generatePageNumbers(this.documentosFirmasCompletadas);
            }
        },
        methods: {
            generatePageNumbers(documentList) {
                const pages = [];
                const currentPage = documentList.current_page;
                const totalPages = documentList.last_page;
                const range = 2;
                if (totalPages > 1) {
                    pages.push(1);
                }

                for (let i = Math.max(2, currentPage - range); i <= Math.min(totalPages - 1, currentPage + range); i++) {
                    pages.push(i);
                }

                if (currentPage - range > 2) {
                    pages.splice(1, 0, '...');
                }
                if (currentPage + range < totalPages - 1) {
                    pages.splice(pages.length - 1, 0, '...');
                }

                if (totalPages > 1 && !pages.includes(totalPages)) {
                    pages.push(totalPages);
                }

                return [...new Set(pages)];
            },
            nextPagePendientes() {
                if (this.documentosPendientes.next_page_url) {
                    this.getPendingDocs(this.documentosPendientes.current_page + 1);
                }
            },
            prevPagePendientes() {
                if (this.documentosPendientes.prev_page_url) {
                    this.getPendingDocs(this.documentosPendientes.current_page - 1);
                }
            },
            nextPageFirmasCompletadas() {
                if (this.documentosFirmasCompletadas.next_page_url) {
                    this.getPendingDocs(this.documentosFirmasCompletadas.current_page + 1);
                }
            },
            prevPageFirmasCompletadas() {
                if (this.documentosFirmasCompletadas.prev_page_url) {
                    this.getPendingDocs(this.documentosFirmasCompletadas.current_page - 1);
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
                        const documentos = response.data.documentos.data;

                        // Dividir los documentos en dos listas: pendientes y completadas
                        this.documentosPendientes.data = documentos.filter(doc => doc.firmasPendientes > 0);
                        this.documentosFirmasCompletadas.data = documentos.filter(doc => doc.firmasPendientes === 0 && doc.firmasOk > 0);

                        // Ajustar la información de paginación para ambas listas
                        this.documentosPendientes.total = this.documentosPendientes.data.length;
                        this.documentosFirmasCompletadas.total = this.documentosFirmasCompletadas.data.length;
                        this.loading = false;
                    })
                    .catch(error => {
                        console.error('Error al obtener documentos:', error);
                    });
            },
            searchPendingDocs() {
                this.toggleLoading(true);
                this.getPendingDocs(1); // Reinicia la búsqueda desde la primera página
                this.toggleLoading(false);
            },
            verFirmantes(){
                $('#firmantesModal').modal('show');
            },
            firmardocumento(idRedaccion) {
                this.loading = true;
                axios.post('/auth', {
                        idRedaccion: idRedaccion
                    })
                    .then(response => {

                        if (response.data.urlRedirect) {
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
            descargarDocumento(idRedaccion) {
                axios.get(`/documento/descargar/${idRedaccion}`, {
                    responseType: 'blob' // Importante para obtener el archivo en formato binario
                }).then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data], {
                        type: 'application/pdf'
                    }));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', `documento_${idRedaccion}.pdf`);
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }).catch(error => {
                    console.error('Error al descargar el documento:', error);
                    alert('No se pudo descargar el documento.');
                });
            },
        }
    });
</script>
@endsection