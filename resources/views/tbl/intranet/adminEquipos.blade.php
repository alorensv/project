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
            <table id="equiposTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Equipo</th>
                        <th>Año</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Patente</th>
                        <th>Color</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Ficha</th>
                        <th>Doc</th>
                        <th>Imagen</th>                        
                        <th>QR</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="equipo in equipos.data" :key="equipo.id">
                        <td>@{{ equipo.id }}</td>
                        <td>@{{ equipo.nombreTipo }}</td>
                        <td>@{{ equipo.anio }}</td>
                        <td>@{{ equipo.marca }}</td>
                        <td>@{{ equipo.modelo }}</td>
                        <td>@{{ equipo.patente }}/@{{ equipo.num_verificador }}</td>
                        <td>@{{ equipo.color }}</td>
                        <td>@{{ equipo.nombreSubtipo }}</td>
                        <td class="text-center align-middle">
                            <template v-if="equipo.active">
                                <span class="badge badge-success" @click="confirmAction(equipo, 'habilitar', true)">Activo</span>
                            </template>
                            <template v-else>
                                <span class="badge badge-danger" @click="confirmAction(equipo, 'habilitar', true)">Inactivo</span>
                                <!-- <span class="badge badge-danger">Inactivo</span> -->
                            </template>

                        </td>
                        <td class="text-center align-middle">
                            <template v-if="equipo.link_ficha_tecnica">
                                <a :href="equipo.link_ficha_tecnica" target="_blank" title="Descargar ficha técnica">
                                    <i class="material-icons">download</i>
                                </a>
                            </template>
                        </td>
                        <td class="text-center align-middle">
                            <template v-if="equipo.full_documentation">
                                <a :href="equipo.full_documentation" target="_blank" title="Descargar documentación completa">
                                    <i class="material-icons">download</i>
                                </a>
                            </template>
                        </td>
                        <td class="text-center align-middle">
                            <template v-if="equipo.img">
                                <a :href="equipo.img" target="_blank" title="Descargar imagen">
                                    <i class="material-icons">visibility</i>
                                    <!-- <img :src="equipo.img" alt="Imagen del equipo" style="width: 50px; height: auto;"> -->
                                </a>
                            </template>
                        </td>
                        <td class="cursorPointer" @click="showOrGenerateQR(equipo)">
                            <div>
                                <i class="material-icons">qr_code_2</i>
                            </div>
                        </td>
                        <td class="text-center align-middle"> <!-- Nueva celda para editar -->
                            <i class="material-icons cursorPointer" @click="editEquipo(equipo)">edit</i>
                        </td>
                    </tr>
                </tbody>
            </table>


            <div class="col-md-12 text-center" style="width: 100%;">
                <span>
                    @{{ equipos.from }}-@{{ equipos.to }} de @{{ equipos.total }} Resultados
                </span>
            </div>

            <div class="col-md-12 text-center paginate mt-3 mb-3">
                <button class="btn" style="border: none;" :class="{ 'disabled': !equipos.prev_page_url }" @click="prevPage">&lt;&lt;</button>

                <!-- Botones de paginación -->
                <template v-for="(page, index) in pageNumbers">
                    <button v-if="page === '...'" :key="index" class="btn disabled">
                        @{{ page }}
                    </button>
                    <button v-else :key="page" class="btn" :class="{ 'selected': page === equipos.current_page }" @click="goToPage(page)">
                        @{{ page }}
                    </button>
                </template>

                <button class="btn" style="border: none;" :class="{ 'disabled': !equipos.next_page_url }" @click="nextPage">&gt;&gt;</button>
            </div>

        </div>
    </section>

    @include('tbl.intranet.modals.addEditEquipo')
    @include('tbl.intranet.modals.showQR')
    @include('tbl.intranet.modals.confirmarAccion')
</div>
<!-- Material Icons -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

<script>
    let vueAdminEquipos = new Vue({
        el: '#vueAdminEquipos',
        data: {
            equipos: {
                data: [],
                current_page: 1,
                prev_page_url: null,
                next_page_url: null,
                last_page: 1,
                from: 1,
                to: 1,
                total: 0
            },
            tipos: [],
            subtipos: [],
            searchTerm: '',
            equipoSeleccionado: {},
            equipo: {
                tipo_id: '',
                nombre: '',
                anio: '',
                marca: '',
                modelo: '',
                patente: '',
                num_verificador: '',
                color: '',
                subtipo_id: '',
                link_ficha_tecnica: '',
                full_documentation: '',
                img: '',
                active: '',
            },
            totalPages: 0,
            action: '',
            uploadedFile: null,
            full_documentation: null,
            imagen: null,
        },
        watch: {
            searchTerm() {
                this.searchEquipos();
            }
        },
        created() {
            this.getTiposEquipos();
            this.getEquipos();
        },
        computed: {
            pageNumbers() {
                const pages = [];
                const currentPage = this.equipos.current_page;
                const totalPages = this.equipos.last_page;

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
            getTiposEquipos() {
                axios.get('/tiposEquipos')
                    .then(response => {
                        this.tipos = response.data.datos;
                    })
                    .catch(error => {
                        console.error('Error al obtener categorías:', error);
                    });
            },
            getEquipos(page = 1) {
                axios.get(`/getEquiposPerPage`, {
                        params: {
                            page: page,
                            search: this.searchTerm, // Agrega el término de búsqueda aquí
                            subcategorias: this.subcategoriasSeleccionadas
                        }
                    })
                    .then(response => {
                        this.equipos = response.data.equipos;
                        console.log(this.equipos);
                    })
                    .catch(error => {
                        console.error('Error al obtener productos:', error);
                    });
            },
            searchEquipos() {
                this.getEquipos(1); // Reinicia la búsqueda desde la primera página
            },
            addFormEquipo() {
                this.equipo = {
                    tipo_id: '',
                    nombre: '',
                    anio: '',
                    marca: '',
                    modelo: '',
                    patente: '',
                    num_verificador: '',
                    color: '',
                    subtipo_id: '',
                    link_ficha_tecnica: '',
                    full_documentation: '',
                    img: '',
                    active: '',
                };
                this.uploadedFile = null;
                $("#addEditEquipo").modal('show');
            },
            editEquipo(equipo) {



                console.log(equipo)
                this.equipo = {
                    ...equipo
                };
                console.log(equipo)
                this.actualizarSubcategoriasEdit();

                this.uploadedFile = null;
                this.full_documentation = null;
                this.imagen = null;

                $("#addEditEquipo").modal('show');
            },
            showOrGenerateQR(equipo) {
                let equipoId = equipo.id;
                var logo = new Image();
                logo.src = '/img/tbl/TBL.png';

                logo.onload = () => {
                    console.log("Logo loaded successfully");
                    var url = 'https://tbl.transportesbulnes.cl/presentacionEquipo?id=' + equipoId;
                    var colorQr = '#060737';

                    // Limpia el contenedor del QR antes de generar uno nuevo
                    document.getElementById("qr-container").innerHTML = '';

                    var qrcode = new QRCode(document.getElementById("qr-container"), {
                        text: url,
                        width: 400,
                        height: 400,
                        colorDark: colorQr,
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H // Añadir este parámetro para mejor corrección de errores
                    });

                    // Usar MutationObserver para detectar cuando el QR se haya generado
                    const observer = new MutationObserver((mutationsList, observer) => {
                        for (const mutation of mutationsList) {
                            if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                                var canvas = document.querySelector("#qr-container canvas");
                                if (canvas) {
                                    var context = canvas.getContext("2d");
                                    var logoSize = 150;
                                    var x = (canvas.width - logoSize) / 2;
                                    var y = (canvas.height - logoSize) / 2;

                                    console.log("Drawing logo on QR code");
                                    context.drawImage(logo, x, y, logoSize, logoSize);

                                    // Mostrar el modal después de dibujar el logo
                                    $("#showQR").modal('show');

                                    // Dejar de observar
                                    observer.disconnect();
                                }
                            }
                        }
                    });

                    // Configurar el observer
                    observer.observe(document.getElementById("qr-container"), {
                        childList: true
                    });
                };

                logo.onerror = () => {
                    console.error("Error loading logo");
                };
            },
            closeShowQR() {
                $("#showQR").modal('hide');
            },
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
            habilitarEquipo(id) {
                axios.post('/activarEquipo', {
                        id: id
                    })
                    .then(response => {
                        console.log('Respuesta del servidor:', response.data);
                        $("#confirmAction").modal('hide');
                        this.getEquipos();
                    })
                    .catch(error => {
                        // Manejar el error
                        console.error('Hubo un error al enviar el formulario', error);
                    });
            },
            confirmAction(equipo, action, confirmar) {
                this.action = action;
                if (this.action == 'habilitar') {
                    this.equipoSeleccionado = equipo;
                    if (confirmar) {
                        $("#confirmAction").modal('show');
                    } else {
                        this.habilitarEquipo(this.equipoSeleccionado.id)
                    }
                }
            },
            formatearNombreEquipo(nombre) {
                return nombre.charAt(0).toUpperCase() + nombre.slice(1).toLowerCase();
            },
            actualizarSubcategorias() {
                const tipoSeleccionado = this.tipos.find(tipo => tipo.id === this.equipo.tipo_id);
                this.equipo.nombre = this.formatearNombreEquipo(tipoSeleccionado.nombre);
                this.subtipos = tipoSeleccionado ? tipoSeleccionado.caracteristicas : [];
                this.equipo.subtipo_id = '';
            },
            actualizarSubcategoriasEdit() {
                const tipoSeleccionado = this.tipos.find(tipo => tipo.id === this.equipo.tipo_id);
                this.equipo.nombre = this.formatearNombreEquipo(tipoSeleccionado.nombre);
                this.subtipos = tipoSeleccionado ? tipoSeleccionado.caracteristicas : [];
            },
            agregarEquipo() {

                const formData = new FormData();
                    Object.keys(this.equipo).forEach(key => {
                        formData.append(key, this.equipo[key]);
                    });

                    /* const formDataObj = {};
                    formData.forEach((value, key) => {
                        formDataObj[key] = value;
                    });
                    // Pausar ejecución y depurar formData
                    console.log('Contenido de formData:', formDataObj);
                    debugger; */

                    if (this.imagen) {
                        formData.append('img', this.imagen);
                    }else{
                        formData.delete('img'); // Eliminar la clave si existe
                        formData.append('img', ''); // Añadirla vacía
                    }

                    if (this.uploadedFile) {
                        formData.append('link_ficha_tecnica', this.uploadedFile);
                    }else{
                        formData.delete('link_ficha_tecnica'); // Eliminar la clave si existe
                        formData.append('link_ficha_tecnica', ''); // Añadirla vacía
                    }

                    if(this.full_documentation){
                        formData.append('full_documentation', this.full_documentation);
                    }else{
                        formData.delete('full_documentation'); // Eliminar la clave si existe
                        formData.append('full_documentation', ''); // Añadirla vacía
                    }

                const url = '/agregarEquipo'; // Usa la misma ruta para ambas operaciones
                const method = 'post'; // Método HTTP POST

                axios({
                        method,
                        url,
                        data: formData,
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(response => {
                        console.log('Respuesta del servidor:', response.data);
                        $("#addEditEquipo").modal('hide');
                        this.getEquipos();
                        this.removeFile();
                    })
                    .catch(error => {
                        console.error('Hubo un error al enviar el formulario', error);
                    });
            },
            handleFileUpload(event, type) {

                if(type == 'imagen'){
                    this.imagen = event.target.files[0];
                }

                if(type == 'ficha'){
                    this.uploadedFile = event.target.files[0];
                }
                
                if(type == 'docu'){
                    this.full_documentation = event.target.files[0];
                }
                
            },
            removeFile(type) {
                if('ficha'){
                    this.uploadedFile = null;
                }               

                if('docu'){
                    this.full_documentation = null;
                }

                if('imagen'){
                    this.imagen = null;
                }
                this.$refs.fileInput.value = null; // Reset the file input
            }


        },

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