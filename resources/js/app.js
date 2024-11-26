require('./bootstrap');

import 'bootstrap/dist/css/bootstrap.min.css'; // Estilos de Bootstrap
import bootstrap from 'bootstrap'; // JavaScript de Bootstrap


import { createApp } from 'vue';  // Asegúrate de importar createApp desde Vue 3
//Views
import Inicio from './views/Inicio.vue';
import Redactar from './views/Redactar.vue';
import Home from './views/Home.vue'; 
//Components
import ProgressBar from './components/ProgressBar.vue';
import Contacto from './components/Contacto.vue';
import TabsHome from './components/TabsHome.vue';
import FirmantesModal from './components/FirmantesModal.vue';
import VerDocumentoModal from './components/VerDocumentoModal.vue';
import Loader from './components/Loader.vue';
import Steps from './components/Steps.vue';
import CaruselDocumentos from './components/CaruselDocumentos.vue';
import Declaraciones from './components/redaccion/Declaraciones.vue';
import Poderes from './components/redaccion/Poderes.vue';
import Previsualizacion from './components/redaccion/Previsualizacion.vue';

const app = createApp({
  components: {
    Inicio,
    Redactar,
    Home,

    ProgressBar,
    Contacto,
    TabsHome,
    VerDocumentoModal,
    FirmantesModal,
    Loader,
    Steps,
    CaruselDocumentos,

    Declaraciones,
    Poderes,
    Previsualizacion,
  },
});

app.mount('#app');  // Monta tu aplicación en el contenedor con id "app"


