<!-- Modal de agregar/editar equipo -->
<div class="modal fade" id="addEditEquipo" tabindex="-1" aria-labelledby="addEditEquipoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEditEquipoLabel">Agregar/Editar Equipo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form @submit.prevent="agregarEquipo">
          @csrf


          <div class="form-group">
            <label for="tipo_id">Tipo Equipo</label>
            <select class="form-control" v-model="equipo.tipo_id" id="tipo_id" @change="actualizarSubcategorias" required>
                <option value="" disabled>Selecciona un tipo de equipo</option>
                <option v-for="tipo in tipos" :key="tipo.id" :value="tipo.id">
                    @{{ tipo.nombre }}
                </option>
            </select>
          </div>

          <div class="form-group">
            <label for="subtipo_id">Subtipo de Equipo</label>
            <select class="form-control" v-model="equipo.subtipo_id" id="subtipo_id" required>
              <option value="" disabled>Selecciona un subtipo de equipo</option>
              <option v-for="subtipo in subtipos" :key="subtipo.id" :value="subtipo.id">
                @{{ subtipo.nombre }}
              </option>
            </select>
          </div>  


          <div class="form-group">
            <label for="anio">Año</label>
            <input type="number" class="form-control" v-model="equipo.anio" id="anio" required>
          </div>

          <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" class="form-control" v-model="equipo.marca" id="marca" required>
          </div>

          <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" class="form-control" v-model="equipo.modelo" id="modelo" required>
          </div>

          <div class="form-group">
            <label for="patente">Patente</label>
            <input type="text" class="form-control" v-model="equipo.patente" id="patente" required>
          </div>

          <div class="form-group">
            <label for="color">Color</label>
            <select class="form-control" v-model="equipo.color" id="color" required>
                <option value="" disabled>Selecciona un color</option>
                <option value="#fff" style="background-color: #fff; color: #000;">Blanco</option>
                <option value="#000" style="background-color: #000; color: #fff;">Negro</option>
                <option value="#ff0000" style="background-color: #ff0000; color: #fff;">Rojo</option>
                <option value="#00ff00" style="background-color: #00ff00; color: #000;">Verde</option>
                <option value="#0000ff" style="background-color: #0000ff; color: #fff;">Azul</option>
                <!-- Agrega más colores si es necesario -->
            </select>
        </div>

        

        <!-- <label for="tipo_id" class="font-weight-bold mt-2">Agregar Tipo</label>
          <button type="button" class="btn btn-link" @click="mostrarFormularioTipo = true">Agregar Nuevo Tipo</button>
          
          Formulario para agregar tipo
          <div v-if="mostrarFormularioTipo" class="mt-3">
              <form @submit.prevent="agregarTipoEquipo">
                  <div class="form-group">
                      <label for="nuevoTipoNombre">Nombre del Nuevo Tipo</label>
                      <input type="text" class="form-control" v-model="nuevoTipo.nombre" id="nuevoTipoNombre" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Guardar Tipo</button>
                  <button type="button" class="btn btn-secondary ml-2" @click="mostrarFormularioTipo = false">Cancelar</button>
              </form>
          </div> -->

          <div class="form-group">
            <label for="link_ficha_tecnica">Link Ficha Técnica</label>
            <input type="url" class="form-control" v-model="equipo.link_ficha_tecnica" id="link_ficha_tecnica">
          </div>


          <!-- <div class="form-group">
            <label for="file_upload" class="d-flex align-items-center">
              <span class="material-icons me-2">upload</span>
              Subir Archivo
            </label>
            <input type="file" class="form-control" id="file_upload" @change="handleFileUpload">
          </div> -->

          <!-- <div class="form-group">
            <label for="img">Imagen</label>
            <input type="file" class="form-control" @change="handleFileUpload" id="img">
          </div> -->

          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
