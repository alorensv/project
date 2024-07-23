<!-- Modal de contacto -->
<div class="modal fade" id="cotizarGeneral" style="text-align: left;" tabindex="-1"  aria-labelledby="cotizarGeneralLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="text-center">
          <h4 class="modal-title" id="cotizarGeneralLabel">¡Cuéntanos qué necesitas! </h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-5">
        <!-- Contenido del formulario de contacto -->
        <form @submit.prevent="guardarCotizacionGeneral">
          @csrf
          <!-- Aquí puedes colocar tu formulario de contacto -->
          
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" v-model="cotizaGeneral.nombre" placeholder="Acá tu nombre" v-validate="{required: true, max: 255}" maxlength="255" name="cotizaGeneral.nombre" id="nombre">
          </div>

          <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" v-model="cotizaGeneral.telefono" placeholder="Recuerda ingresar el +569 " v-validate="{required: true, max: 255}" maxlength="255" name="cotizaGeneral.telefono" id="telefono">
          </div>

          <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" v-model="cotizaGeneral.email" placeholder="Acá tu correo" v-validate="{required: true, max: 255}" maxlength="255" name="cotizaGeneral.email" id="email">
          </div>

          <div class="form-group">
              <label for="fecha_servicio">Fecha posible del servicio</label>
              <input type="date" v-model="cotizaGeneral.fecha_servicio" min="{{ date('Y-m-d') }}" id="fecha_servicio" name="fecha_servicio" class="form-control">
            </div>

          <div class="row">

          <div class="col-6">
            <div class="form-group">
              <label for="origen">Origen</label>
              <input type="text" v-model="cotizaGeneral.origen" id="origen" name="origen" class="form-control" placeholder="Origen">
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="destino">Destino</label>
              <input type="text" v-model="cotizaGeneral.destino" id="destino" name="destino" class="form-control" placeholder="Destino">
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
                <input type="text" v-model="cotizaGeneral.largo" id="largo" class="form-control" placeholder="Largo">
              </div>
            </div>
            <div class="col-3 col3Padding">
              <div class="form-group">
                <label for="ancho">Ancho</label>
                <input type="text" v-model="cotizaGeneral.ancho" id="ancho" class="form-control" placeholder="Ancho">
              </div>
            </div>
            <div class="col-3 col3Padding">
              <div class="form-group">
                <label for="alto">Alto</label>
                <input type="text" v-model="cotizaGeneral.alto" id="alto" class="form-control" placeholder="Alto">
              </div>
            </div>
            <div class="col-3 col3Padding">
              <div class="form-group">
                <label for="peso">Peso</label>
                <input type="number" v-model="cotizaGeneral.peso" id="peso" class="form-control" placeholder="Peso">
              </div>
            </div>
          </div>


          <div class="form-group">
            <label for="comentarios">Mensaje:</label>
            <textarea class="form-control" placeholder="Haznos saber tus dudas o consultas" v-model="cotizaGeneral.comentarios" id="comentarios" name="cotizaGeneral.comentarios" v-validate="{required: true, max: 255}" rows="4"></textarea>
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