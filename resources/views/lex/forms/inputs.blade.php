<div v-for="(group, groupName) in groupedInputs" :key="groupName" class="card mb-3" style="box-shadow: rgba(168, 166, 168, 0.89) 10px 10px 15px -6px;">
    <div class="card-body">


        <div class="accordion-header" @click="toggleAccordion(groupName)" :class="{ 'open': accordionState[groupName] }">
            <h4 class="d-flex justify-content-between align-items-center">
                <div>
                    <span v-if="isGroupComplete(group)" class="badge badge-success" style="float: left;margin-right: 4px;">
                        <i class="material-icons" style="font-size: 15px;">check</i>
                    </span>

                    <span style="float: left;">@{{ groupName }}</span>
                    <div class="checksForm" :class="{
                        'text-danger': groupCompletionStatus[groupName].filled !== groupCompletionStatus[groupName].total,
                        'text-success': groupCompletionStatus[groupName].filled === groupCompletionStatus[groupName].total
                    }">
                        @{{ groupCompletionStatus[groupName].filled }} / @{{ groupCompletionStatus[groupName].total }}
                    </div>

                </div>
                <i class="material-icons">keyboard_arrow_down</i>
            </h4>
        </div>

        <div class="accordion-body" v-show="accordionState[groupName]">
            <div v-for="(input, index) in group" :key="index" class="mb-3">

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
                <select v-else-if="input.field_type === 'select' && ( input.name === 'region' || input.name === 'region_domicilio' || input.name === 'region_propiedad' || input.name === 'region_autorizado' || input.name === 'region_acuerdo' )"
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
                <select v-else-if="input.field_type === 'select' && ( input.name === 'comuna' || input.name === 'comuna_domicilio'  || input.name === 'comuna_propiedad' || input.name === 'comuna_autorizado' || input.name === 'comuna_acuerdo' ) "
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
                <select v-else-if="input.field_type === 'select' && ( input.name === 'nacionalidad'  ||  input.name === 'nacionalidad_autorizado'  )"
                    :id="input.name"
                    v-model="input.value"
                    :class="{'is-invalid': errors[input.name]}"
                    @focus="focusField(input.name)"
                    @blur="blurField(input.name)"
                    class="form-control">
                    <option disabled value selected>
                        @{{ input.placeholder || 'Seleccione su nacionalidad' }} <!-- Muestra el placeholder o un texto por defecto -->
                    </option>
                    <option v-for="nacionalidad in nacionalidades" :key="nacionalidad.id" :value="nacionalidad.nombre">@{{ nacionalidad.nombre }}</option>
                </select>

                <!-- Dentro del v-for -->
                <div v-else-if="input.field_type === 'radio' && ( input.name === 'sexo' || input.name === 'sexo_autorizado' )" class="d-flex">
                    <!-- Opción Femenino -->
                    <div class="col-4">
                        <div class="form-check">
                            <input
                                type="radio"
                                :id="`${input.name}-femenino`"
                                :name="input.name"
                                value="femenino"
                                v-model="input.value"
                                @change="fetchInputs(input.value)"
                                class="form-check-input" />
                            <label :for="`${input.name}-femenino`" class="form-check-label">Femenino</label>
                        </div>
                    </div>

                    <!-- Opción Masculino -->
                    <div class="col-4">
                        <div class="form-check">
                            <input
                                type="radio"
                                :id="`${input.name}-masculino`"
                                :name="input.name"
                                value="masculino"
                                v-model="input.value"
                                @change="fetchInputs(input.value)"
                                class="form-check-input" />
                            <label :for="`${input.name}-masculino`" class="form-check-label">Masculino</label>
                        </div>
                    </div>
                </div>


                <!-- Select de estado civil -->
                <select v-else-if="input.field_type === 'select' && ( input.name === 'estado_civil' || input.name === 'estado_civil_autorizado' || input.name === 'estadoCivilTestigoUno' ) "
                    :id="input.name"
                    v-model="input.value"
                    :class="{'is-invalid': errors[input.name]}"
                    @focus="focusField(input.name)"
                    @blur="blurField(input.name)"
                    class="form-control">
                    <option disabled value selected>
                        @{{ input.placeholder || 'Seleccione su estado civil' }} <!-- Muestra el placeholder o un texto por defecto -->
                    </option>
                    <option v-for="estado_civil in estados_civiles" :key="estado_civil.id" :value="estado_civil.nombre">@{{ estado_civil.nombre }}</option>
                </select>

                <select v-else-if="input.field_type === 'select' && input.name === 'tipo_reunion' "
                    :id="input.name"
                    v-model="input.value"
                    :class="{'is-invalid': errors[input.name]}"
                    @focus="focusField(input.name)"
                    @blur="blurField(input.name)"
                    class="form-control">
                    <option disabled value selected>
                        @{{ input.placeholder || 'Seleccione tipo de reunión' }} <!-- Muestra el placeholder o un texto por defecto -->
                    </option>
                    <option v-for="tipo in tipo_reuniones" :key="tipo.id" :value="tipo.nombre">@{{ tipo.nombre }}</option>
                </select>  

                <!-- Select uso del inmubeble -->
                <select v-else-if="input.field_type === 'select' && input.name === 'uso_propiedad' "
                    :id="input.name"
                    v-model="input.value"
                    :class="{'is-invalid': errors[input.name]}"
                    @focus="focusField(input.name)"
                    @blur="blurField(input.name)"
                    class="form-control">
                    <option disabled value selected>
                        @{{ input.placeholder || 'Seleccione tipo de uso del inmueble' }} <!-- Muestra el placeholder o un texto por defecto -->
                    </option>
                    <option v-for="uso in tipos_usos" :key="uso.id" :value="uso.nombre">@{{ uso.nombre }}</option>
                </select> 

                <!-- text rut -->
                <input
                    v-else-if="input.name === 'rut' || input.name === 'rut_autorizado' || input.name === 'rut_cuenta_bancaria'"
                    :type="input.field_type"
                    :id="input.name"
                    v-model="input.value"
                    :placeholder="input.placeholder"
                    :class="{'is-invalid': errors[input.name]}"
                    @focus="focusField(input.name)"
                    @blur="blurField(input.name)"
                    @input="completeRut(input.name, input.value, 'input')"
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

                <label v-if="input.help_label" :for="input.name" class="form-label text-muted" style="font-size: 12px;">
                @{{ input.help_label }}
                </label>

                <div v-if="errors[input.name]" class="invalid-feedback">
                    @{{ errors[input.name] }}
                </div>

            </div>
        </div>

    </div>
</div>