<!-- Modal de contacto -->
<div class="modal fade" id="cotizarGeneral" tabindex="-1"  aria-labelledby="cotizarGeneralLabel" aria-hidden="true">
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
              <label for="origen">Fecha posible del servicio</label>
              <input type="date" v-model="cotizaGeneral.fecha_servicio" id="origen" name="origen" class="form-control">
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

<div id="cotiza" class="div_cotizaguardarCotizacionCelular">
    <section class="shadow-lg guardarCotizacionCelularestiloCotiza" id="guardarCotizacionCelularcontacto">
      <form @submit.prevent="guardarCotizacionCelular">

        <div class="row">
          <div class="col-md-12">
            <div class="text-center pb-4">
              <h4 style="font-size: 1.8rem; font-weight: 600;">¡Cotiza y trabajemos juntos!</h4>
            </div>

            <!-- Aquí puedes colocar tu formulario de contacto -->
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" v-model="cotizaGeneral.nombre" placeholder="Acá tu nombre" maxlength="255" name="cotizaGeneral.nombre" id="nombre">
            </div>

            <div class="form-group">
              <label for="telefono">Teléfono</label>
              <input type="text" class="form-control" v-model="cotizaGeneral.telefono" placeholder="Recuerda ingresar el +569 " maxlength="255" name="cotizaGeneral.telefono" id="telefono">
            </div>

            <div class="form-group">
              <label for="email">Correo</label>
              <input type="email" class="form-control" v-model="cotizaGeneral.email" placeholder="Acá tu correo" maxlength="255" name="cotizaGeneral.email" id="email">
            </div>

            <div class="form-group">
              <label for="fecha">Fecha posible del servicio</label>
              <input type="date" v-model="cotizaGeneral.fecha_servicio" id="fecha" name="fecha" class="form-control" placeholder="Fecha posible del servicio">
            </div>

          </div>

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

          <div class="col-12">
            <div class="form-group">
              <label for="comentarios">Mensaje:</label>
              <textarea class="form-control" placeholder="Haznos saber tus dudas o consultas" v-model="cotizaGeneral.comentarios" id="comentarios" name="cotizaGeneral.comentarios" maxlength="255" rows="4"></textarea>
            </div>
            <button type="submit" class="w-100 btn btn-primary">Enviar</button>
          </div>
        </div>
      </form>
    </section>
  </div>