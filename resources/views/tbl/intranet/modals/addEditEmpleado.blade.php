<!-- Modal de agregar/editar empleado -->
<div class="modal fade" id="addEditEmpleado" tabindex="-1" aria-labelledby="addEditEmpleadoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEditEmpleadoLabel">
          @{{ empleado.id ? 'Editar Empleado' : 'Agregar Empleado' }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form @submit.prevent="agregarEmpleado">
          @csrf

          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="rut">RUT</label>
                <input type="text" class="form-control" v-model="empleado.rut" id="rut" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="nombres">Nombres</label>
                <input type="text" class="form-control" v-model="empleado.nombres" id="nombres" required>
              </div>

            </div>
            <div class="col-6">

              <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" v-model="empleado.apellidos" id="apellidos" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" v-model="empleado.telefono" id="telefono" required>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" class="form-control" v-model="empleado.email" id="email" required>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="img">Imagen</label>
            <input type="file" class="form-control" id="img" name="img" @change="handleFileUpload($event, 'img')" ref="imgInput">
          </div>

          <ul v-if="uploadedFile">
            <li>
              @{{ uploadedFile.name }} <button @click="removeFile('img')">x</button>
            </li>
          </ul>

          <button type="submit" class="btn btn-primary">
            @{{ empleado.id ? 'Actualizar' : 'Guardar' }}
          </button>
        </form>
      </div>
    </div>
  </div>
</div>