// resources/js/components/ProgressBar.vue
<template>
    <div class="progress">
        <div
            class="progress-bar bg-advanced"
            role="progressbar"
            :style="{ width: progress + '%' }"
            :aria-valuenow="progress"
            aria-valuemin="0"
            aria-valuemax="100"
        >
            {{ progress }}%
        </div>
    </div>
</template>

<script>
export default {
    props: {
        progress: {
            type: Number,
            required: true
        }
    }
};
</script>

<style scoped>
/* Estilos específicos para la barra de progreso */
.progress-bar {
    transition: width 0.5s ease-in-out;
}
</style>
