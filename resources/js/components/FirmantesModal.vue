<template>
  <div class="modal fade" id="firmantesModal" tabindex="-1" aria-labelledby="firmantesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="firmantesModalLabel">Firmantes Pendientes</h5>
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
          <button type="button" class="btn btn-secondary" @click="closeModal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Modal } from 'bootstrap';

export default {
  props: ['firmantes'],
  methods: {
    closeModal() {
        $('#firmantesModal').modal('hide'); 
    }
  },
};
</script>



<style scoped>
.modal {
    position: absolute!important;
}
</style>
