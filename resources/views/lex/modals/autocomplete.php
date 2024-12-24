<!-- Modal para visualizar el PDF -->
<div id="matchModal" class="modal fade" tabindex="-1" role="dialog"> 
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body divTablas">
                
            <div class="row">
              <h4>¡Hemos encontrado coincidencia en firmas anteriores con el RUT ingresado!</h4>
            </div>

            <div class="row">
              <p>¿Deseas autocompletar los datos con la información encontrada?</p>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="closeModal('matchModal')">Rechazar</button>
          <button type="button" class="btn btn-primary" @click="acceptAutoComplete">Aceptar</button>
        </div>
    </div>
</div>