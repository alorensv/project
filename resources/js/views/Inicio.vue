<template>
    <div id="vueInicio">
        <section class="welcome">
            <div>
                <div class="container section-phone-padding">
                    <div class="row">
                        <div class="col-lg-6 padding-title-presentation-large titleOne titlePrincipal">
                            <h4>Seguro, online y con validez legal </h4>
                            <h2>¿Necesitas un documento legal con firma avanzada en minutos?</h2>
                            <p>Crea documentos que no requieren de redacción de abogado ni de cumplir con solemnidades especiales, ya que puede ser extendido por las partes firmantes del documento</p>
                            <p>Podrás encontrar <strong>declaraciones, contratos, cartas poder y muchos más documentos</strong>.</p>
                            <p><br></p>
                            <p>
                                <a href="/#" class="btn btn-lex-secondary d-flex align-items-center" style="width: 180px;">¡Conócenos más!</a>
                            </p>
                        </div>
                        <div class="col-6">

                            <Carousel v-bind="config">

                                <Slide v-for="item in carouselItems" :key="item">
                                    <div class="carousel__item"><img class="second-slide imgCaruselPrincipal" :src="item.image" alt="Second slide"></div>
                                </Slide>

                                <template #addons>
                                    <navigation />
                                    <pagination />
                                </template>
                            </carousel>

                        </div>
                    </div>
                </div>
            </div>

            <steps></steps>

            <div class="container py-5">
                <div class="mb-5">
                    <div class="pb-4">
                        <h4><i class="material-icons" style="vertical-align: middle;">double_arrow</i>Documentos disponibles</h4>
                    </div>

                    <carusel-documentos></carusel-documentos>
                </div>
            </div>
        </section>
        <footer>
            <!-- Footer content here -->
        </footer>
    </div>
</template>

<script>
    import 'vue3-carousel/dist/carousel.css'
    import {
        Carousel,
        Slide,
        Pagination,
        Navigation
    } from 'vue3-carousel'

    
    import Steps from '../components/Steps.vue';
    import CaruselDocumentos from '../components/CaruselDocumentos.vue';


    const config = {
        itemsToShow: 3.95,
        wrapAround: true,
        transition: 500,
    };

    export default {
        components: {
            Carousel,
            Slide,
            Pagination,
            Navigation,
            Steps,
            CaruselDocumentos,
        },
        data() {
            return {
                carouselItems: [{
                        image: 'img/lex/bg1.png',
                        alt: 'Documento privado con firma avanzada',
                        title: 'Paso 1',
                        sub1: 'Selecciona y completa los datos del documento',
                        sub2: 'Agrega a los FIRMANTES que participarán.'
                    },
                    {
                        image: 'img/lex/bg1.png',
                        alt: 'Documento privado con firma avanzada',
                        title: 'Paso 2',
                        sub1: 'Paga segur@ con Transbank',
                        sub2: 'TODOS los documentos y firmas que necesites.'
                    },
                    {
                        image: 'img/lex/bg1.png',
                        alt: 'Documento privado con firma avanzada',
                        title: 'Paso 2',
                        sub1: 'Paga segur@ con Transbank',
                        sub2: 'TODOS los documentos y firmas que necesites.'
                    },
                    {
                        image: 'img/lex/bg1.png',
                        alt: 'Documento privado con firma avanzada',
                        title: 'Paso 2',
                        sub1: 'Paga segur@ con Transbank',
                        sub2: 'TODOS los documentos y firmas que necesites.'
                    }
                ],
                categoriasDocumentos: []
            };
        },
        methods: {
            // Puedes agregar tus métodos aquí si es necesario
        }
    };
</script>

<style scoped>
    @keyframes showTopText {
        0% {
            transform: translate3d(0, 100%, 0);
        }

        40%,
        60% {
            transform: translate3d(0, 50%, 0);
        }

        100% {
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes showBottomText {
        0% {
            transform: translate3d(0, -100%, 0);
        }

        100% {
            transform: translate3d(0, 0, 0);
        }
    }

    .animated-title {
        line-height: normal;
        color: #222;
        height: 134vmin;
        left: 70%;
        position: absolute;
        top: 21%;
        transform: translate(-64%, -54%);
        width: 72vmin;
    }

    .animated-title>div {
        height: 49.6%;
        overflow: hidden;
        position: absolute;
        width: 100%;
    }

    .animated-title>div div {
        font-size: 2.6vmin;
        padding: 3.4vmin 0;
        position: absolute;
    }

    .animated-title>div div span {
        display: block;
    }

    .animated-title>div.text-top {
        border-bottom: 0.5vmin solid #ee6076;
        top: 0;
    }

    .animated-title>div.text-top div {
        animation: showTopText 1s forwards;
        animation-delay: 0.5s;
        bottom: 0;
        transform: translate(0, 100%);
    }

    .animated-title>div.text-top div span:first-child {
        color: #767676;
    }

    .animated-title>div.text-bottom {
        bottom: 0;
    }

    .animated-title>div.text-bottom div {
        animation: showBottomText 0.5s forwards;
        animation-delay: 1.75s;
        top: 0;
        transform: translate(0, -100%);
    }

    .animated-title {
        z-index: 10;
    }

    .animated-title p {
        font-size: 19px !important;
    }

    .titleOne h4 {
        animation-duration: 3s;
        animation-name: slidein;
    }

    .titlePrincipal h2 {
        animation-duration: 2s;
        animation-name: slidein;
    }

    .titlePrincipal p {
        animation-duration: 2s;
        animation-name: slidein;
    }

    @keyframes slidein {
        from {
            margin-left: 100%;
            width: 100%;
        }

        to {
            margin-left: 0%;
            width: 100%;
        }
    }
    
    .carousel__slide {
        padding: 5;
    }

    .carousel__viewport {
        perspective: 2000px;
    }

    .carousel__track {
        transform-style: preserve-3d;
    }

    .carousel__slide--sliding {
        transition: 0.5s;
    }

    .carousel__slide {
        opacity: 0.9;
        transform: rotateY(-20deg) scale(0.9);
    }

    .carousel__slide--active~.carousel__slide {
        transform: rotateY(20deg) scale(0.9);
    }

    .carousel__slide--prev {
        opacity: 1;
        transform: rotateY(-10deg) scale(0.95);
    }

    .carousel__slide.carousel__slide--next {
        opacity: 1;
        transform: rotateY(10deg) scale(0.95);
    }

    .carousel__slide--active {
        opacity: 1;
        transform: rotateY(0) scale(1);
    }
</style>