@include('lex.forms.inputs')

<div v-if="cantidadFirmantes > 1" class="card mt-2" style="box-shadow: rgba(168, 166, 168, 0.89) 10px 10px 15px -6px;">
    <div class="card-body">
        <div class="mb-3">
            <button class="btn btn-primary w-100" @click="mostrarFormularioFirmante = !mostrarFormularioFirmante" style="display: inline-flex;align-items: center;justify-content: center;">
                Agregar autorizado <span class="material-icons icon pl-2 pr-3">group_add</span> (+$5.000)
            </button>

        </div>

        <div v-if="mostrarFormularioFirmante" class="mt-3">
            <div class="mb-3">
                <label for="nombreFirmante" class="form-label">Nombre</label>
                <input type="text" id="nombreFirmante" v-model="nuevoFirmante.nombre" class="form-control" placeholder="Nombre del firmante">
            </div>
            <div class="mb-3">
                <label for="apellidoPaternoFirmante" class="form-label">Apellido Paterno</label>
                <input type="text" id="apellidoPaternoFirmante" v-model="nuevoFirmante.apellido_paterno" class="form-control" placeholder="Apellido paterno del firmante">
            </div>
            <div class="mb-3">
                <label for="apellidoMaternoFirmante" class="form-label">Apellido Materno</label>
                <input type="text" id="apellidoMaternoFirmante" v-model="nuevoFirmante.apellido_materno" class="form-control" placeholder="Apellido materno del firmante">
            </div>
            <div class="mb-3">
                <label for="rutFirmante" class="form-label">RUT</label>
                <input type="text" id="rutFirmante" @input="completeRut('rut', nuevoFirmante.rut, 'firmantes')" v-model="nuevoFirmante.rut" class="form-control" placeholder="RUT del firmante">
            </div>
            <div class="mb-3">
                <label for="correoFirmante" class="form-label">Correo</label>
                <input type="email" id="correoFirmante" v-model="nuevoFirmante.correo" class="form-control" placeholder="Correo del firmante">
            </div>

            <div class="mb-3">
                <label class="form-label">Sexo</label>
                <div class="d-flex">
                    <div class="col-6">
                        <input type="radio" id="sexoFemenino" value="femenino" v-model="nuevoFirmante.sexo" @change="fetchInputs(nuevoFirmante.sexo)">
                        <label for="sexoFemenino">Femenino</label>
                    </div>
                    <div class="col-6">
                        <input type="radio" id="sexoMasculino" value="masculino" v-model="nuevoFirmante.sexo" @change="fetchInputs(nuevoFirmante.sexo)">
                        <label for="sexoMasculino">Masculino</label>
                    </div>
                </div>
            </div>


            <div class="mb-3">
                <label for="nacionalidadFirmante" class="form-label">Nacionalidad</label>
                <select id="nacionalidadFirmante" v-model="nuevoFirmante.nacionalidad" class="form-control">
                    <option disabled value selected>
                        Seleccione su nacionalidad
                    </option>
                    <option v-for="nacionalidad in nacionalidades" :key="nacionalidad.id" :value="nacionalidad.nombre">@{{ nacionalidad.nombre }}</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="estadoCivilFirmante" class="form-label">Estado Civil</label>
                <select id="estadoCivilFirmante" v-model="nuevoFirmante.estado_civil" class="form-control">
                    <option disabled value selected>
                        @{{'Seleccione su estado civil' }} <!-- Muestra el placeholder o un texto por defecto -->
                    </option>
                    <option v-for="estado_civil in estados_civiles" :key="estado_civil.id" :value="estado_civil.nombre">@{{ estado_civil.nombre }}</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="profesionOficioFirmante" class="form-label">Profesión u Oficio</label>
                <input type="email" id="profesionOficioFirmante" v-model="nuevoFirmante.profesion_oficio" class="form-control" placeholder="Profesión u Oficio">
            </div>
            <div class="mb-3">
                <label for="domicilioFirmante" class="form-label">Domicilio</label>
                <input type="text" id="domicilioFirmante" v-model="nuevoFirmante.domicilio" class="form-control" placeholder="Ej: Calle Arturo Prat 110, departamente 56b">
            </div>
            <div class="mb-3">
                <label for="regionFirmante" class="form-label">Región</label>
                <select id="regionFirmante" @change="fetchComunas($event.target.value)" class="form-control" v-model="nuevoFirmante.region">
                    <option disabled value selected>
                        Seleccione una región
                    </option>
                    <option v-for="region in regiones" :key="region.id" :value="region.nombre">
                        @{{ region.nombre }}
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label for="comunaFirmante" class="form-label">Comuna</label>
                <select id="comunaFirmante" class="form-control" v-model="nuevoFirmante.comuna">
                    <option disabled value selected>
                        Seleccione una comuna
                    </option>
                    <option v-for="comuna in comunas" :key="comuna.id" :value="comuna.nombre">@{{ comuna.nombre }}</option>
                </select>
            </div>

            <div class="mb-3">
                <button class="btn btn-success w-100" @click="agregarFirmante" style="display: inline-flex;align-items: center;justify-content: center;">Guardar Firmante
                    <span class="material-icons icon pl-2">save_as</span>
                </button>
            </div>

            <div v-if="firmantesError" class="alert alert-danger mt-3">
                @{{ firmantesError }}
            </div>


        </div>


        <div class="card">
            <div class="card-header" id="headingCart">
                <h5 class="mb-0">
                    <button
                        class="btn btn-link"
                        :class="{ collapsed: !isAccordionOpen }"
                        @click="toggleAccordionFirmantes"
                        aria-expanded="true"
                        data-target="#collapseCart"
                        aria-controls="collapseCart">
                        Firmantes <i class="fas fa-chevron-down"></i>
                    </button>
                </h5>
            </div>

            <div
                id="collapseCart"
                :class="{ collapse: true, show: isAccordionOpen }"
                aria-labelledby="headingCart">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Firmantes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Firmante 1 (predefinido) -->
                            <tr>
                                <td>@{{ getInputValue('nombre') }} @{{ getInputValue('apellido_paterno') }} @{{ getInputValue('apellido_materno') }}
                                    <br>@{{ getInputValue('rut') }}
                                    <br>@{{ getInputValue('correo') }}
                                    <br>@{{ getInputValue('nacionalidad') }}
                                    <br>@{{ getInputValue('estado_civil') }}
                                    <br>@{{ getInputValue('profesion_oficio') }}
                                    <br>@{{ getInputValue('direccion') }}
                                    <br>@{{ getInputValue('comuna') }}
                                    <br>@{{ getInputValue('region') }}
                                </td>
                            </tr>

                            <!-- Lista de otros firmantes -->
                            <tr v-for="(firmante, index) in firmantes" :key="index">
                                <td>@{{ firmante.nombre }} @{{ firmante.apellido_paterno }} @{{ firmante.apellido_materno }}
                                    <br>@{{ firmante.rut }}
                                    <br>@{{ firmante.correo }}
                                    <br>@{{ firmante.nacionalidad }}
                                    <br>@{{ firmante.estado_civil }}
                                    <br>@{{ firmante.profesion_oficio }}
                                    <br>@{{ firmante.domicilio }}
                                    <br>@{{ firmante.comuna }}
                                    <br>@{{ firmante.region }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>