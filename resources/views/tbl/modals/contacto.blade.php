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
        <form @submit.prevent="guardarContacto">
          @csrf
          <!-- Formulario de contacto -->
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" v-model="contacto.nombre" placeholder="Acá tu nombre" required maxlength="255" id="nombre">
          </div>
          <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" v-model="contacto.telefono" placeholder="Recuerda ingresar el +569 " required maxlength="255" id="telefono">
          </div>
          <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" v-model="contacto.correo" placeholder="Acá tu correo" required maxlength="255" id="correo">
          </div>
          <div class="form-group">
            <label for="comentarios">Mensaje:</label>
            <textarea class="form-control" v-model="contacto.comentarios" placeholder="Haznos saber tus dudas o consultas" required maxlength="255" rows="4" id="comentarios"></textarea>
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


<script>

  let contactModal = new Vue({
    el: '#contactModal',
    data: {
      contacto: {
        nombre: '',
        telefono: '',
        correo: '',
        comentarios: '',
      },
    },
    methods: {
      guardarContacto() {
        axios.post('/guardarContacto', this.contacto)
          .then(response => {
            $("#contactModal").modal('hide'); 
            // Manejar la respuesta exitosa
            if (response.data.status === 'ok') {
              $("#successContact").modal('show');    
              setTimeout(() => {
                $("#successContact").modal('hide'); 
              }, 4000); 

              this.limpiarContacto();
            }
                    
          })
          .catch(error => {
            // Manejar el error
            console.error('Hubo un error al enviar el formulario', error);
          });
      },
      limpiarContacto(){
        this.contacto.nombre = '';
        this.contacto.telefono = '';
        this.contacto.correo = '';
        this.contacto.comentarios = '';
      }


    },
  });
</script>