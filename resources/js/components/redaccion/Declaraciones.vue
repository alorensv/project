<template>
    <div>
        <h4 class="card-title titleFormDoc">Datos generales</h4>

        <div v-for="(input, index) in inputs" :key="index" class="mb-3">
            <h4 v-if="input.name === 'nombre' && input.documento_id === 1">Declarante(s)</h4>
            <h4 v-if="input.name === 'declaracion'">Declaración</h4>

            <label :for="input.name" class="form-label">@{{ input.label }}</label>

            <!-- Input tipo textarea -->
            <textarea v-if="input.field_type === 'textarea'"
                :id="input.name"
                v-model="input.value"
                :placeholder="input.placeholder"
                :class="{'is-invalid': errors[input.name]}"
                @focus="focusField(input.name)"
                @blur="blurField(input.name)"
                class="form-control"></textarea>

            <!-- Input tipo select para región/comuna -->
            <select v-else-if="input.field_type === 'select' && (input.name === 'region' || input.name === 'region_domicilio')"
                :id="input.name"
                v-model="input.value"
                :class="{'is-invalid': errors[input.name]}"
                @focus="focusField(input.name)"
                @blur="blurField(input.name)"
                @change="fetchComunas(input.value)"
                class="form-control">
                <option disabled value selected>@{{ input.placeholder || 'Seleccione una región' }}</option>
                <option v-for="region in regiones" :key="region.id" :value="region.nombre">@{{ region.nombre }}</option>
            </select>

            <select v-else-if="input.field_type === 'select' && (input.name === 'comuna' || input.name === 'comuna_domicilio')"
                :id="input.name"
                v-model="input.value"
                :placeholder="input.placeholder"
                :class="{'is-invalid': errors[input.name]}"
                @focus="focusField(input.name)"
                @blur="blurField(input.name)"
                class="form-control">
                <option disabled value selected>@{{ input.placeholder || 'Seleccione una comuna' }}</option>
                <option v-for="comuna in comunas" :key="comuna.id" :value="comuna.nombre">@{{ comuna.nombre }}</option>
            </select>

            <!-- Input tipo texto o número (RUT) -->
            <input v-else-if="input.name === 'rut'"
                :type="input.field_type"
                :id="input.name"
                v-model="input.value"
                :placeholder="input.placeholder"
                :class="{'is-invalid': errors[input.name]}"
                @focus="focusField(input.name)"
                @blur="blurField(input.name)"
                @input="completeRut(input.name, input.value)"
                class="form-control" />

            <!-- Otros inputs estándar -->
            <input v-else
                :type="input.field_type"
                :id="input.name"
                v-model="input.value"
                :placeholder="input.placeholder"
                :class="{'is-invalid': errors[input.name]}"
                @focus="focusField(input.name)"
                @blur="blurField(input.name)"
                class="form-control" />

            <!-- Mensajes de error -->
            <div v-if="errors[input.name]" class="invalid-feedback">@{{ errors[input.name] }}</div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        inputs: {
            type: Array,
            required: true,
        },
        regiones: {
            type: Array,
            required: true,
        },
        comunas: {
            type: Array,
            required: true,
        },
        errors: {
            type: Object,
            default: () => ({}),
        }
    },
    data() {
        return {
            // Si necesitas más lógica, la añades aquí
        };
    },
    methods: {
        focusField(fieldName) {
            // Lógica para manejar cuando el campo obtiene el foco
        },
        blurField(fieldName) {
            // Lógica para manejar cuando el campo pierde el foco
        },
        fetchComunas(region) {
            // Lógica para obtener las comunas según la región
        },
        completeRut(name, value) {
            // Lógica para completar el RUT en formato chileno
            if (value) {
                this.$set(this.inputs.find(input => input.name === name), 'value', this.formatearRut(value));
            }
        },
        formatearRut(rut) {
            // Función que formatea el RUT
            rut = rut.replace(/[^\dKk]/g, ''); // Elimina caracteres no numéricos
            if (rut.length > 1) {
                let rutFormateado = rut.slice(0, -1);
                const dv = rut[rut.length - 1];
                return `${rutFormateado.slice(0, -3)}.${rutFormateado.slice(-3, -1)}.${rutFormateado.slice(-1)}-${dv}`;
            }
            return rut;
        },
    }
}
</script>
