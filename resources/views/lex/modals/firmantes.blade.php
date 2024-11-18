<!-- Modal para visualizar el PDF -->
<div class="modal fade" id="firmantesModal" tabindex="-1" role="dialog" aria-labelledby="firmantesModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #7e7e7e!important;color: #ffffff!important;">
                <h5 class="modal-title" id="firmantesModal">Firmantes pendientes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <table class="table table-striped" style="width:100%">
                    <tr v-for="firmante in firmantes" :key="firmante.id">
                        <td>
                        <div class="user-icon mr-3">
                                <span class="material-icons">person</span>
                            </div>
                        </td>
                        <td>
                            @{{firmante.nombres}} @{{firmante.apellido_paterno}} @{{firmante.apellido_materno}}
                        </td>
                        <td>
                            <span class="badge badge-primary" @click="notificarFirmaPendiente(firmante.id)">Notificar</span>
                        </td>
                    </tr>
                </table>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
