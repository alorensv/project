<div>
    <h4 class="card-title titleFormDoc">Datos generales</h4>

    <div v-for="(input, index) in inputs" :key="index" class="mb-3">
        <h4 class="card-title titleFormDoc pt-2 pb-2" v-if="input.name === 'nombre'">Mandante</h4>
        <label :for="input.name" class="form-label">@{{ input.label }}</label>

        <!-- Condicional para textarea -->
        <textarea v-if="input.field_type === 'textarea'"
            :id="input.name"
            v-model="input.value"
            :placeholder="input.placeholder"
            :class="{'is-invalid': errors[input.name]}"
            @focus="focusField(input.name)"
            @blur="blurField(input.name)"
            class="form-control">
                  </textarea>

        <!-- Select de región -->
        <select v-else-if="input.field_type === 'select' && ( input.name === 'region' || input.name === 'region_domicilio' )"
            :id="input.name"
            v-model="input.value"
            :class="{'is-invalid': errors[input.name]}"
            @focus="focusField(input.name)"
            @blur="blurField(input.name)"
            @change="fetchComunas(input.value)"
            class="form-control">
            <option disabled value selected>
                @{{ input.placeholder || 'Seleccione una región' }} <!-- Muestra el placeholder o un texto por defecto -->
            </option>
            <option v-for="region in regiones" :key="region.id" :value="region.nombre">@{{ region.nombre }}</option>
        </select>

        <!-- Select de comuna -->
        <select v-else-if="input.field_type === 'select' && ( input.name === 'comuna' || input.name === 'comuna_domicilio' ) "
            :id="input.name"
            v-model="input.value"
            :placeholder="input.placeholder"
            :class="{'is-invalid': errors[input.name]}"
            @focus="focusField(input.name)"
            @blur="blurField(input.name)"
            class="form-control">
            <option disabled value selected>
                @{{ input.placeholder || 'Seleccione una comuna' }} <!-- Muestra el placeholder o un texto por defecto -->
            </option>
            <option v-for="comuna in comunas" :key="comuna.id" :value="comuna.nombre">@{{ comuna.nombre }}</option>
        </select>


        <!-- Select de estado civil -->
        <select v-else-if="input.field_type === 'select' && input.name === 'estado_civil'  "
            :id="input.name"
            v-model="input.value"
            :class="{'is-invalid': errors[input.name]}"
            @focus="focusField(input.name)"
            @blur="blurField(input.name)"
            class="form-control">
            <option value="Soltero" selected>Soltero</option>
            <option value="Casado">Casado</option>
            <option value="Divorciado/a">Divorciado/a</option>
        </select>

        <!-- text rut -->
        <input
            v-else-if="input.name === 'rut'"
            :type="input.field_type"
            :id="input.name"
            v-model="input.value"
            :placeholder="input.placeholder"
            :class="{'is-invalid': errors[input.name]}"
            @focus="focusField(input.name)"
            @blur="blurField(input.name)"
            @input="completeRut(input.name, input.value)"
            class="form-control" />



        <!-- Condicional para otros tipos de input -->
        <input v-else
            :type="input.field_type"
            :id="input.name"
            v-model="input.value"
            :placeholder="input.placeholder"
            :class="{'is-invalid': errors[input.name]}"
            @focus="focusField(input.name)"
            @blur="blurField(input.name)"
            class="form-control">

        <div v-if="errors[input.name]" class="invalid-feedback">
            @{{ errors[input.name] }}
        </div>


    </div>

    <div class="mb-3">
        <button class="btn btn-primary w-100" @click="mostrarFormularioFirmante = !mostrarFormularioFirmante" style="display: inline-flex;align-items: center;justify-content: center;">
            Agregar Autorizados <span class="material-icons icon pl-2 pr-3">group_add</span> (+$3.000)
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
            <input type="text" id="rutFirmante" v-model="nuevoFirmante.rut" class="form-control" placeholder="RUT del firmante">
        </div>
        <div class="mb-3">
            <label for="correoFirmante" class="form-label">Correo</label>
            <input type="email" id="correoFirmante" v-model="nuevoFirmante.correo" class="form-control" placeholder="Correo del firmante">
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
                <option v-for="region in regiones" :key="region.id" :value="region.nombre" >
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

    </div>


    <div class="card">
        <div class="card-header" id="headingCart">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseCart" aria-expanded="true" aria-controls="collapseCart">
                    Autorizados <i class="fas fa-chevron-down"></i>
                </button>
            </h5>
        </div>

        <div id="collapseCart" class="collapse" aria-labelledby="headingCart">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Participantes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Firmante 1 (predefinido) -->
                        <tr>
                            <td>@{{ getInputValue('nombre') }} @{{ getInputValue('apellido_paterno') }} @{{ getInputValue('apellido_materno') }}
                                <br>@{{ getInputValue('rut') }}
                                <br>@{{ getInputValue('correo') }}
                                <br>@{{ getInputValue('domicilio') }}
                                <br>@{{ getInputValue('comuna') }}
                                <br>@{{ getInputValue('region') }}
                            </td>
                        </tr>

                        <!-- Lista de otros firmantes -->
                        <tr v-for="(firmante, index) in firmantes" :key="index">
                            <td>@{{ firmante.nombre }} @{{ firmante.apellido_paterno }} @{{ firmante.apellido_materno }}
                                <br>@{{ firmante.rut }}
                                <br>@{{ firmante.correo }}
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


    <div v-if="generalError" class="alert alert-danger mt-3">
        @{{ generalError }}
    </div>
</div>