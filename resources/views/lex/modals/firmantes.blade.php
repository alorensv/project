<!-- Modal para visualizar el PDF -->
<div id="firmantesModal" class="modal fade" tabindex="-1" role="dialog"> 
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #7e7e7e!important;color: #ffffff!important;">
                <h5 class="modal-title" id="firmantesModal">Firmantes pendientes</h5>
                <button type="button" class="close" data-dismiss="modal"  @click="closeModal('firmantesModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body divTablas">
                <table class="table table-striped mt-3" style="width:100%">
                    <tr v-for="firmante in firmantes" :key="firmante.id">
                        <td style="width: 10%;">
                            <div class="user-icon">
                                <span class="material-icons">person</span>
                            </div>
                        </td>
                        <td>
                            @{{firmante.nombres}} @{{firmante.apellido_paterno}} @{{firmante.apellido_materno}}
                        </td>
                        <td>
                            @{{firmante.correo}}
                        </td>

                        @if(Auth::check())
                        <td  v-if="firmante.compra">
                            <div v-if="firmante.estado == 0">
                                <span class="badge badge-warning">Pendiente</span>
                                <span class="badge badge-primary" @click="notificarFirmaPendiente(firmante.id)">Notificar</span>
                            </div>
                            <div v-else-if="firmante.estado == 3">
                                <span class="badge badge-danger">Rechazado</span>
                                <p style="font-size: 12px;">Rechazó el @{{ firmante.formatted_date }}</p>
                            </div>
                            <div v-else-if="firmante.estado == 1">
                                <span class="badge badge-primary">En proceso</span>
                            </div>
                            <div v-else-if="firmante.estado == 1">
                                <span class="badge badge-success">Firmado</span>
                                <p style="font-size: 12px;">Firmó el @{{ firmante.formatted_date }}</p>
                            </div>
                            <div v-else>
                                <span class="badge badge-danger">Error, estado fallido</span>
                            </div>
                        </td>
                        @endif


                        
                    </tr>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="closeModal('firmantesModal')">Cerrar</button>
            </div>
        </div>
    </div>
</div>