<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="contactModalLabel">¡Contáctanos y hablemos!</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-5">
        <form @submit.prevent="guardarCotizacion">
          @csrf

          <button type="submit" class="w-100 btn btn-primary">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal de contacto -->
<div class="modal fade" id="successContact"  tabindex="-1" aria-labelledby="successContactLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-body">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <div class=" p-5">
      <div class="text-center">
        <div class="icon-check pb-3">
            <i class="material-icons" style="color: #8bb06f;font-size: 60px;">check_circle</i>
          </div>
          <p>¡Hemos recibido tu mensaje con éxito, te contactaremos lo más luego posible!</p>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>