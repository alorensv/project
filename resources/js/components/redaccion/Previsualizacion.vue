<template>
    <div>
        <!-- Usar v-html para renderizar el contenido HTML -->
        <div v-html="defaultText"></div>
        
        <!-- El resto de tu formulario o lógica -->
    </div>
</template>

<script>
export default {
    props: {
        inputs: {
            type: Array,
            required: true,
        },
        documento: {
            type: Object,
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
        defaultText: {
            type: String,
            required: true,
        }
    },
    data() {
        return {
            // Aquí puedes manejar otros datos si es necesario
        };
    },
    methods: {
        // Aquí puedes agregar los métodos que necesitas
    }
}
</script>
