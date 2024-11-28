@extends('lex.plantilla')

@section('content')

<div id="vueHome">

    <div v-bind:class="{ 'loader': loading }" v-cloak></div>


    @include('lex.modals.firmantes')
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
            </div>
            <div class="row py-3">
                <div class="col-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="documentTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pendientes-tab" data-bs-toggle="tab" href="#pendientes" role="tab" aria-controls="pendientes" aria-selected="true">Documentos con Firmas Pendientes</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="completados-tab" data-bs-toggle="tab" href="#completados" role="tab" aria-controls="completados" aria-selected="false">Documentos Disponibles</a>
                        </li>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content" id="documentTabsContent">
                        <!-- Documentos Pendientes Tab -->
                        <div class="tab-pane fade show active" id="pendientes" role="tabpanel" aria-labelledby="pendientes-tab">
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
                                            <th style="width: 30%;">Firmas pendientes</th>
                                            <th style="width: 5%;"></th>
                                            <th style="width: 5%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="doc in documentosPendientes.data" :key="doc.idRedaccion">
                                            <td>@{{ doc.idRedaccion }}</td>
                                            <td>@{{ doc.nombreDoc }}</td>
                                            <td>@{{ doc.fecha_creacion }}</td>
                                            <td class="text-center align-middle">
                                                <div class="d-flex">
                                                    <div class="col-6">
                                                    <div class="progress">
                                                        <div
                                                            class="progress-bar bg-advanced"
                                                            role="progressbar"
                                                            :style="{ width: progress + '%' }"
                                                            :aria-valuenow="progress"
                                                            aria-valuemin="0"
                                                            aria-valuemax="100"
                                                        >@{{ progress }}%</div>
                                                    </div>

                                                    
                                                    
                                                    </div>
                                                    <div class="col-6">
                                                    <span class="badge badge-primary fontBadge" @click="verFirmantes(doc.idRedaccion)">@{{ doc.firmasPendientes }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span v-if="doc.pormi > 0" class="badge badge-success" @click="firmardocumento(doc.idRedaccion)">Firmar</span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span v-if="doc.base64" class="material-icons materialIconIntranet" @click="verDocumento(doc.base64)">plagiarism</span>
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

                        <!-- Documentos Completados Tab -->
                        <div class="tab-pane fade" id="completados" role="tabpanel" aria-labelledby="completados-tab">
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
                                            <td>@{{ doc.fecha_creacion }}</td>
                                            <td>@{{ doc.fecha_actualizacion }}</td>
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
            </div>


        </div>
    </section>
</div>

<script>

    let homeVue = new Vue({
        el: '#vueHome',
        data: {
            loading: false,
            progress: 45,
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
            documentoBase: '',
            firmantes: {},
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
                this.loading = true; 
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
            verDocumento(base64) {
                this.loading = true;
                this.closeModal('verPDFModal');
                // Asegúrate de esperar que se cierre completamente antes de continuar
                setTimeout(() => {
                    this.documentoBase = ""; // Limpia la variable para forzar la actualización
                    this.$nextTick(() => {
                        this.documentoBase = base64; // Asigna el nuevo valor
                        const modal = new bootstrap.Modal(document.getElementById('verPDFModal'));
                        modal.show();
                        this.loading = false; // Desactiva el indicador de carga
                    });
                }, 300); // Espera 300 ms antes de reabrir el modal
            },
            verFirmantes(idRedaccion) {
                this.loading = true; 
                axios.get(`/firmantes/${idRedaccion}`, {}).then(response => {
                    console.log(response);
                    this.firmantes = response.data.firmantes
                }).catch(error => {
                    console.error('Error al consultar los firmantes pendientes:', error);
                }).finally(() => {                        
                    this.loading = false; 
                    const modal = new bootstrap.Modal(document.getElementById('firmantesModal'));
                    modal.show();
                });
            },
            closeModal(id) {
                const modalElement = document.getElementById(id);
                if (modalElement) {
                    const modalInstance = bootstrap.Modal.getInstance(modalElement);
                    if (!modalInstance) {
                        const newModalInstance = new bootstrap.Modal(modalElement);
                        newModalInstance.hide();
                    } else {
                        modalInstance.hide();
                    }
                } else {
                    console.error(`Modal con ID ${id} no encontrado.`);
                }
            },
            firmardocumento(idRedaccion) {
                this.loading = true;
                axios.get(`/getMiToken/${idRedaccion}`)
                    .then(response => {
                        if (response.data.token) {
                            let token = response.data.token; // Asignar el token recibido
                            window.location.href = `/firmarDocumento/${token}`; // Redirección correcta
                        } else {
                            console.error('No se recibió un token válido:', response.data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error al obtener el token:', error);
                    })
                    .finally(() => {
                        this.loading = false; // Finalizar el estado de carga
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
            notificarFirmaPendiente(idFirmante) {
                axios.get(`/enviarCorreo/${idFirmante}`, {}).then(response => {
                    alert(JSON.stringify(response.data.status));
                }).catch(error => {
                    console.error('Error al enviar notificación:', error);
                });
                //
            }
        }
    });
</script>
@endsection