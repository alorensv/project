<!-- Modal de contacto -->
<div class="modal fade" id="arriendoEquipo" tabindex="-1"  aria-labelledby="arriendoEquipoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="text-center">
          <h4 class="modal-title" id="arriendoEquipoLabel">¡Cuéntanos cuándo necesitas el equipo! </h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-5">
        <!-- Contenido del formulario de contacto -->
        <form @submit.prevent="guardarCotizacionEquipo">
          @csrf
          <!-- Aquí puedes colocar tu formulario de contacto -->

          <div class="form-group">
            <label for="equipoNombre">Estas cotizando el equipo <strong>@{{equipoSeleccionado.nombre}} @{{equipoSeleccionado.marca}} @{{equipoSeleccionado.modelo}}</strong></label>
          </div>

          
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" v-model="cotiza.nombre" placeholder="Acá tu nombre" v-validate="{required: true, max: 255}" maxlength="255" name="cotiza.nombre" id="nombre" required>
          </div>

          <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" v-model="cotiza.telefono" placeholder="Recuerda ingresar el +569 " v-validate="{required: true, max: 255}" maxlength="255" name="cotiza.telefono" id="telefono">
          </div>

          <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" v-model="cotiza.email" placeholder="Acá tu correo" v-validate="{required: true, max: 255}" maxlength="255" name="cotiza.email" id="email" required>
          </div>

          <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="fecha_servicio">Fecha de arriendo</label>
              <input type="date" v-model="cotiza.fecha_servicio" id="fecha_servicio" min="{{ date('Y-m-d') }}" name="fecha_servicio" class="form-control">
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="destino">Fecha de devolución</label>
              <input type="date" v-model="cotiza.fecha_termino" id="fecha_termino" min="{{ date('Y-m-d') }}" name="fecha_termino" class="form-control" >
            </div>
          </div>
          </div>

          <div class="form-group">
              <label for="fecha">Lugar de faena</label>
              <input type="text" v-model="cotiza.destino" id="destino" name="destino" class="form-control" placeholder="">
            </div>

          <div class="form-group">
            <label for="comentarios">Mensaje:</label>
            <textarea class="form-control" placeholder="Haznos saber tus dudas o consultas" v-model="cotiza.comentarios" id="comentarios" name="cotiza.comentarios" v-validate="{required: true, max: 255}" rows="4" required></textarea>
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