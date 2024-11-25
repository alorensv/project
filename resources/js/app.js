require('./bootstrap');

import { createApp } from 'vue';  // Asegúrate de importar createApp desde Vue 3
import ProgressBar from './components/ProgressBar.vue';
import Contacto from './components/Contacto.vue';
import TabsHome from './components/TabsHome.vue';
import FirmantesModal from './components/FirmantesModal.vue';

const app = createApp({
  components: {
    ProgressBar,
    Contacto,
    TabsHome,
    FirmantesModal,
  },
});

app.mount('#app');  // Monta tu aplicación en el contenedor con id "app"


