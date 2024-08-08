@extends('tbl.intranet.plantilla')

@section('content')
<div id="vueAdminempleados">



    <section id="divadminEmpleados" class="adminDiv">
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
                    <button class="btn btn-primary d-flex align-items-center" @click="addFormEmpleado()">
                        <span class="material-icons mr-2">add</span>
                        Agregar Empleado
                    </button>
                </div>

            </div>

            <h1>Listado de Equipos</h1>
            <table id="equiposTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th></th>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>QR</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="empleado in empleados.data" :key="empleado.id">
                        <td>@{{ empleado.id }}</td>
                        <td>
                            <img v-if="empleado.img_url" img :src="empleado.img_url" alt="" style="max-width: 75px;border-radius: 25px;">
                            <img v-else src="/img/iconos/user.png" alt="Imagen por defecto" style="max-width: 75px; border-radius: 25px;">
                        </td>
                        <td style="vertical-align: middle;">@{{ empleado.rut }}</td>
                        <td style="vertical-align: middle;">@{{ empleado.nombres }}</td>
                        <td style="vertical-align: middle;">@{{ empleado.apellidos }}</td>
                        <td style="vertical-align: middle;">@{{ empleado.telefono }}</td>
                        <td style="vertical-align: middle;">@{{ empleado.email }}</td>
                        <td class="cursorPointer" @click="showOrGenerateQR(empleado)" style="vertical-align: middle;">
                            <div>
                                <i class="material-icons">qr_code_2</i>
                            </div>
                        </td>
                        <td class="text-center align-middle"> <!-- Nueva celda para editar -->
                            <i class="material-icons cursorPointer" @click="editEquipo(empleado)">edit</i>
                        </td>
                    </tr>
                </tbody>
            </table>


            <div class="col-md-12 text-center" style="width: 100%;">
                <span>
                    @{{ empleados.from }}-@{{ empleados.to }} de @{{ empleados.total }} Resultados
                </span>
            </div>

            <div class="col-md-12 text-center paginate mt-3 mb-3">
                <button class="btn" style="border: none;" :class="{ 'disabled': !empleados.prev_page_url }" @click="prevPage">&lt;&lt;</button>

                <!-- Botones de paginación -->
                <template v-for="(page, index) in pageNumbers">
                    <button v-if="page === '...'" :key="index" class="btn disabled">
                        @{{ page }}
                    </button>
                    <button v-else :key="page" class="btn" :class="{ 'selected': page === empleados.current_page }" @click="goToPage(page)">
                        @{{ page }}
                    </button>
                </template>

                <button class="btn" style="border: none;" :class="{ 'disabled': !empleados.next_page_url }" @click="nextPage">&gt;&gt;</button>
            </div>

        </div>
    </section>

    @include('tbl.intranet.modals.addEditEmpleado')
    @include('tbl.intranet.modals.showQR')
    @include('tbl.intranet.modals.confirmarAccion')
</div>
<!-- Material Icons -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

<script>
    let vueAdminempleados = new Vue({
        el: '#vueAdminempleados',
        data: {
            empleados: {
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
            empleado: {
                rut: '',
                nombre: '',
                apellido: '',
            },
            totalPages: 0,
            action: '',
            uploadedFile: null,
        },
        watch: {
            searchTerm() {
                this.searchEmpleados();
            }
        },
        created() {
            this.getEmpleados();
        },
        computed: {
            pageNumbers() {
                const pages = [];
                const currentPage = this.empleados.current_page;
                const totalPages = this.empleados.last_page;

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
            getEmpleados(page = 1) {
                axios.get(`/getEmpleadosPerPage`, {
                        params: {
                            page: page,
                            search: this.searchTerm,
                        }
                    })
                    .then(response => {
                        this.empleados = response.data.empleados;
                        console.log(this.empleados);
                    })
                    .catch(error => {
                        console.error('Error al obtener empleados:', error);
                    });
            },
            searchEmpleados() {
                this.getEmpleados(1); // Reinicia la búsqueda desde la primera página
            },
            addFormEmpleado() {
                this.empleado = {
                    rut: '',
                    nombres: '',
                    apellidos: ''
                };
                this.uploadedFile = null;
                $("#addEditEmpleado").modal('show');
            },
            editEmpleado(empleado) {
                this.empleado = {
                    ...empleado
                };
                $("#addEditEmpleado").modal('show');
            },
            showOrGenerateQR(empleado) {
                let empleadoId = empleado.id;
                var logo = new Image();
                logo.src = '/img/tbl/TBL.png';

                logo.onload = () => {
                    console.log("Logo loaded successfully");
                    var url = 'https://tbl.transportesbulnes.cl/presentacionEquipo?id=' + empleadoId;
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
                if (this.empleados.next_page_url) {
                    this.getEmpleados(this.empleados.current_page + 1);
                }
            },
            prevPage() {
                if (this.empleados.prev_page_url) {
                    this.getEmpleados(this.empleados.current_page - 1);
                }
            },
            goToPage(page) {
                if (page >= 1 && page <= this.empleados.last_page) {
                    this.getEmpleados(page);
                }
            },
            habilitarEquipo(id) {
                axios.post('/activarEquipo', {
                        id: id
                    })
                    .then(response => {
                        console.log('Respuesta del servidor:', response.data);
                        $("#confirmAction").modal('hide');
                        this.getEmpleados();
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
            handleFileUpload(event, type) {

                if (type == 'img') {
                    this.uploadedFile = event.target.files[0];
                }

            },
            removeFile(type) {
                if ('img') {
                    this.uploadedFile = null;
                }
                this.$refs.fileInput.value = null; // Reset the file input
            },
            agregarEmpleado() {

                const formData = new FormData();
                Object.keys(this.empleado).forEach(key => {
                    formData.append(key, this.empleado[key]);
                });

                if (this.uploadedFile) {
                    formData.append('img', this.uploadedFile);
                } else {
                    formData.delete('img'); // Eliminar la clave si existe
                    formData.append('img', ''); // Añadirla vacía
                }

                const url = '/agregarEmpleado'; // Usa la misma ruta para ambas operaciones
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
                        $("#addEditEmpleado").modal('hide');
                        this.getEmpleados();
                        this.removeFile();
                    })
                    .catch(error => {
                        console.error('Hubo un error al enviar el formulario', error);
                    });
            },


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