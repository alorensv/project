 <!-- Modal para visualizar el PDF -->
<div class="modal fade" id="verPDFModal" tabindex="-1" role="dialog" aria-labelledby="verPDFLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verPDFLabel">Previsualización del documento</h5>
                <button type="button" class="close" data-dismiss="modal"  @click="closeModal('verPDFModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="min-height: 50vh;">
                <!-- El data del PDF se carga desde Vue.js -->
                <object v-if="documentoBase" 
                        :data="'data:application/pdf;base64,' + documentoBase + '#toolbar=0'" 
                        type="application/pdf" 
                        width="100%" 
                        height="500" 
                        style="border: none;">
                </object>
                <!-- Si no hay PDF, mostrar un mensaje -->
                <p v-else>El documento no está disponible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  @click="closeModal('verPDFModal')">Cerrar</button>
            </div>
        </div>
    </div>
</div>
