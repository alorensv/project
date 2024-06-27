<div id="cotiza" class="div_cotiza" style="display: none;">
    <section class="shadow-lg" style="background-color: white; color: #060737;" id="contacto">
        <form @submit.prevent="guardarCotizacion">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center pb-4">
                        <h4 style="font-size: 1.8rem; font-weight: 600;">¡Cotiza y trabajemos juntos!</h4>
                    </div>

                    <!-- Mostrar mensaje de éxito -->
                    <div class="alert alert-success" v-if="successMessage">
                    </div>

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" v-model="contacto.nombre" id="name" name="name" class="form-control" required placeholder="Nombre">

                    </div>

                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="email" v-model="contacto.correo" id="email" name="email" class="form-control" required placeholder="Correo">
                    </div>

                    <div class="form-group">
                        <label for="fono">Teléfono</label>
                        <input type="text" v-model="contacto.telefono" id="fono" name="fono" class="form-control" placeholder="Teléfono">
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha posible del servicio</label>
                        <input type="date" v-model="contacto.fecha_servicio" id="fecha" name="fecha" class="form-control" placeholder="Fecha posible del servicio">
                    </div>
                </div><!--/.col-md-12-->

                <div class="col-6">
                    <div class="form-group">
                        <label for="origen">Origen</label>
                        <input type="text" v-model="contacto.origen" id="origen" name="origen" class="form-control" placeholder="Origen">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="destino">Destino</label>
                        <input type="text" v-model="contacto.destino" id="destino" name="destino" class="form-control" placeholder="Destino">
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="message">Comentarios</label>
                        <textarea v-model="contacto.comentarios" id="message" name="message" class="form-control" rows="4" placeholder="¿Qué es lo que quieres transportar?"></textarea>
                        <span v-if="errors.message" class="text-danger">@{{ errors.message }}</span>
                    </div>

                    <div class="form-group w-100">
                    <button type="submit" class="w-100 btn btn-primary">Enviar</button>
                    </div>
                </div><!--/.col-12-->
            </div><!--/.row-->
        </form>
    </section>
</div>


<!-- Modal de contacto -->
<div class="modal fade" id="successContact" tabindex="-1" aria-labelledby="successContactLabel" aria-hidden="true">
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
<script>

  let contactModal = new Vue({
    el: '#contactModal',
    data: {
      cotizacion: {
        nombre: '',
                correo: '',
                telefono: '',
                fecha_servicio: '',
                origen: '',
                destino: '',
                comentarios: '',
      },
    },
    methods: {
        guardarCotizacion() {
        axios.post('/guardarCotizacion', this.cotizacion)
          .then(response => {
 
            // Manejar la respuesta exitosa
            if (response.data.status === 'ok') {
              $("#successContact").modal('show');    
              setTimeout(() => {
                $("#successContact").modal('hide'); 
              }, 4000); 
            }
                    
          })
          .catch(error => {
            // Manejar el error
            console.error('Hubo un error al enviar el formulario', error);
          });
      },
    },
  });
</script>
