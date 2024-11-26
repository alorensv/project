<template>
<loader :loader="loaderActive"></loader>
    <section class="adminDiv">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 pl-5 pr-5">
                    <div>
                        <div v-if="statusMessage" class="alert alert-success" role="alert">
                            {{ statusMessage }}
                        </div>
                        <h5>Bienvenido {{ userName }}</h5>
                        <p>
                            Acá podrás encontrar todos los documentos que creaste, documentos que requieren tu firma
                            electrónica avanzada y todos aquellos documentos disponibles para descargar donde tú
                            seas uno de los firmantes.
                        </p>
                    </div>
                </div>
                <div class="w-100 py-3">
                    <div class="col-12">
                    <tabs-home @toggle-loader="toggleLoader"></tabs-home>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>


<script>
    import Loader from "../components/Loader.vue";
    import TabsHome from "../components/TabsHome.vue";
    

    export default {
        components: {
            Loader,
            TabsHome,
        },
        props: {
            userName: {
                type: String,
                required: true,
            },
            statusMessage: {
                type: String,
                default: null,
            },
        },
        data() {
            return {
                loaderActive: false,
            };
        },
        methods: {
            toggleLoader(state) {
                this.loaderActive = state;
            },
        },
    };
</script>

<style scoped>
    /* Tus estilos personalizados */
</style>