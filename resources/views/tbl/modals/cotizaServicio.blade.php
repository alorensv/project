<!-- Modal de contacto -->
<div class="modal fade" id="cotizarServicio" tabindex="-1"  aria-labelledby="cotizarServicioLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="text-center">
          <h4 class="modal-title" id="cotizarServicioLabel">¡Cuéntanos cuándo necesitas el servicio! </h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-5">
        <!-- Contenido del formulario de contacto -->
        <form @submit.prevent="guardarCotizacionServicio">
          @csrf
          <!-- Aquí puedes colocar tu formulario de contacto -->

          <div class="form-group">
            <label for="equipoNombre">Estas cotizando el servicio <strong>@{{cotizaServ.nombre}}</strong></label>
          </div>

          
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" v-model="cotizaServ.nombre" placeholder="Acá tu nombre" v-validate="{required: true, max: 255}" maxlength="255" name="cotizaServ.nombre" id="nombre">
          </div>

          <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" v-model="cotizaServ.telefono" placeholder="Recuerda ingresar el +569 " v-validate="{required: true, max: 255}" maxlength="255" name="cotizaServ.telefono" id="telefono">
          </div>

          <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" v-model="cotizaServ.email" placeholder="Acá tu correo" v-validate="{required: true, max: 255}" maxlength="255" name="cotizaServ.email" id="email">
          </div>

          <div class="form-group">
              <label for="origen">Fecha posible del servicio</label>
              <input type="date" v-model="cotizaServ.fecha_servicio" id="origen" name="origen" class="form-control">
            </div>

          <div class="row">

          <div class="col-6">
            <div class="form-group">
              <label for="origen">Origen</label>
              <input type="text" v-model="cotizaServ.origen" id="origen" name="origen" class="form-control" placeholder="Origen">
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="destino">Destino</label>
              <input type="text" v-model="cotizaServ.destino" id="destino" name="destino" class="form-control" placeholder="Destino">
            </div>
          </div>
          </div>

          <div class="form-group">
            <label for="comentarios">Mensaje:</label>
            <textarea class="form-control" placeholder="Haznos saber tus dudas o consultas" v-model="cotizaServ.comentarios" id="comentarios" name="cotizaServ.comentarios" v-validate="{required: true, max: 255}" rows="4"></textarea>
          </div>          

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