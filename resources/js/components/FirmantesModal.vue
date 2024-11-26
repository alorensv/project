<template>
  <div class="modal fade" id="firmantesModal" tabindex="-1" role="dialog" aria-labelledby="firmantesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="firmantesModalLabel">Firmantes Pendientes</h5>
          <!-- Asegúrate de que se llame a cerrarModal() al hacer clic en el botón -->
          <button type="button" class="btn-close" @click="cerrarModal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-striped mt-3" style="width:100%">
            <tr v-for="firmante in firmantes" :key="firmante.id">
              <td style="width: 10%;">
                <div class="user-icon">
                  <span class="material-icons">person</span>
                </div>
              </td>
              <td>{{firmante.nombres}} {{firmante.apellido_paterno}} {{firmante.apellido_materno}}</td>
              <td>{{firmante.correo}}</td>
              <td>
                <div v-if="firmante.estado == 0">
                  <span class="badge badge-warning">Pendiente</span>
                  <span class="badge badge-primary" @click="notificarFirmaPendiente(firmante.id)">Notificar</span>
                </div>
                <div v-else-if="firmante.estado == 3">
                  <span class="badge badge-danger">Rechazado</span>
                  <p style="font-size: 12px;">Rechazó el {{ firmante.formatted_date }}</p>
                </div>
                <div v-else>
                  <span class="badge badge-success">Firmado</span>
                  <p style="font-size: 12px;">Firmó el {{ firmante.formatted_date }}</p>
                </div>
              </td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <!-- Aquí usamos el atributo de Bootstrap para cerrar el modal -->
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="cerrarModal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import {
    Modal
  } from 'bootstrap';

  export default {
    props: ['firmantes'],
    data() {
      return {
        modal: null // Aquí almacenaremos la instancia del modal
      };
    },
    emits: ["toggle-loader"],
    methods: {
      cerrarModal() {
        if (this.modal) {
          this.modal.hide(); // Cerrar el modal utilizando la instancia guardada
        }
      }
    },
    watch: {
      // Observamos cualquier cambio en los firmantes para reactivar el modal cuando se abra
      firmantes() {
        this.inicializarModal();
      }
    },
    mounted() {
      // Inicializamos la instancia del modal solo una vez
      this.inicializarModal();
    },
    beforeDestroy() {
      // Asegúrate de destruir la instancia del modal cuando el componente se destruya
      if (this.modal) {
        this.modal.dispose();
      }
    },
    methods: {
      inicializarModal() {
        const modalElement = document.getElementById('firmantesModal');

        // Si la instancia de modal ya existe, la destruimos y la volvemos a crear
        if (this.modal) {
          this.modal.dispose();
        }

        // Creamos una nueva instancia de modal
        this.modal = new Modal(modalElement);
      },
      abrirModal() {
        this.modal.show();
      },
      cerrarModal() {
        if (this.modal) {
          this.modal.hide();
        }
      },
      notificarFirmaPendiente(idFirmante) {
        this.$emit("toggle-loader", true);
        axios.get(`/enviarCorreo/${idFirmante}`, {}).then(response => {
          alert(JSON.stringify(response.data.status));
        }).catch(error => {
          console.error('Error al enviar notificación:', error);
        }).finally(() => {
          this.$emit("toggle-loader", false);
        });
        //
      },
    }
  };
</script>