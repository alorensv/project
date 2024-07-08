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
                        <th>Equipo</th>
                        <th>Año</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Patente</th>
                        <th>Color</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Ficha</th>
                        <th>Imagen</th>
                        <th>QR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="equipo in filteredEquipos" :key="equipo.id">
                        <td>@{{ equipo.nombreTipo }}</td>
                        <td>@{{ equipo.anio }}</td>
                        <td>@{{ equipo.marca }}</td>
                        <td>@{{ equipo.modelo }}</td>
                        <td>@{{ equipo.patente }}</td>
                        <td>@{{ equipo.color }}</td>
                        <td>@{{ equipo.nombreSubtipo }}</td>
                        <td class="text-center align-middle">
                            <template v-if="equipo.link_ficha_tecnica">
                                <a :href="equipo.link_ficha_tecnica" target="_blank" title="Descargar ficha técnica">
                                    <span class="badge badge-success">Activo</span>
                                </a>
                            </template>
                            <template v-else>
                                <span class="badge badge-success">Activo</span>
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
                            <template v-if="equipo.img">
                                <a :href="equipo.img" target="_blank" title="Descargar ficha técnica">
                                    <i class="material-icons">visibility</i>
                                    <!-- <img :src="equipo.img" alt="Imagen del equipo" style="width: 50px; height: auto;"> -->
                                </a>
                            </template>
                        </td>
                        <td  class="cursorPointer" @click="showOrGenerateQR(equipo)">
                            <div>
                                <i class="material-icons">qr_code_2</i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    @include('tbl.intranet.modals.addEditEquipo')
    @include('tbl.intranet.modals.showQR')
</div>
<!-- Material Icons -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

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
                    equipo.modelo.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                    equipo.patente.toLowerCase().includes(this.searchTerm.toLowerCase())
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
            addFormEquipo() {
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
            showOrGenerateQR(equipo) {
                let equipoId = equipo.id;
                var logo = new Image();
                logo.src = '/img/tbl/TBL.png';

                logo.onload = () => {
                    console.log("Logo loaded successfully");
                    var url = 'https://tbl.transportesbulnes.cl/presentacionEquipo?id='+equipoId;
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
            closeShowQR(){
                $("#showQR").modal('hide');
            }



        }
    });
</script>

@endsection