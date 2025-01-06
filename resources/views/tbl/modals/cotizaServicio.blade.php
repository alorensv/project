<div class="modal fade" id="cotizarServicio" tabindex="-1" aria-labelledby="cotizarServicioLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="text-center">
          <h4 class="modal-title" id="cotizarServicioLabel">¡Cuéntanos cuándo necesitas el servicio!</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-5">
        <form @submit.prevent="guardarCotizacionServicio">
          <div class="form-group">
            <label for="equipoNombre">Estas cotizando el servicio <strong>@{{cotizaServ.servicioSeleccionado}}</strong></label>
          </div>
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" v-model="cotizaServ.nombre" placeholder="Acá tu nombre" maxlength="255" id="nombre" required>
          </div>
          <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" v-model="cotizaServ.telefono" placeholder="Recuerda ingresar el +569 " maxlength="255" id="telefono">
          </div>
          <div class="form-group">
            <label for="email">Correo</label>
            <input type="email" class="form-control" v-model="cotizaServ.email" placeholder="Acá tu correo" maxlength="255" id="email" required>
          </div>
          <div class="form-group">
            <label for="fecha_servicio">Fecha posible del servicio</label>
            <input type="date" v-model="cotizaServ.fecha_servicio" min="{{ date('Y-m-d') }}" id="fecha_servicio" class="form-control">
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="origen">Origen</label>
                <input type="text" v-model="cotizaServ.origen" id="origen" class="form-control" placeholder="Origen">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="destino">Destino</label>
                <input type="text" v-model="cotizaServ.destino" id="destino" class="form-control" placeholder="Destino">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <label for="Dimensiones"><strong>Dimensiones</strong></label>
            </div>
          </div>
          <div class="row">            
            <div class="col-3 col3Padding">
              <div class="form-group">
                <label for="largo">Largo</label>
                <input type="text" v-model="cotizaServ.largo" id="largo" class="form-control" placeholder="Largo">
              </div>
            </div>
            <div class="col-3 col3Padding">
              <div class="form-group">
                <label for="ancho">Ancho</label>
                <input type="text" v-model="cotizaServ.ancho" id="ancho" class="form-control" placeholder="Ancho">
              </div>
            </div>
            <div class="col-3 col3Padding">
              <div class="form-group">
                <label for="alto">Alto</label>
                <input type="text" v-model="cotizaServ.alto" id="alto" class="form-control" placeholder="Alto">
              </div>
            </div>
            <div class="col-3 col3Padding">
              <div class="form-group">
                <label for="peso">Peso</label>
                <input type="number" v-model="cotizaServ.peso" id="peso" class="form-control" placeholder="Peso">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="comentarios">Mensaje:</label>
            <textarea class="form-control" placeholder="Haznos saber tus dudas o consultas" v-model="cotizaServ.comentarios" id="comentarios" rows="4" required></textarea>
          </div>
          <button type="submit" class="w-100 btn btn-primary">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>
