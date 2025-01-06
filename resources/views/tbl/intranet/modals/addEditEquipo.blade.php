<!-- Modal de agregar/editar equipo -->
<div class="modal fade" id="addEditEquipo" tabindex="-1" aria-labelledby="addEditEquipoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEditEquipoLabel">
          @{{ equipo.id ? 'Editar Equipo' : 'Agregar Equipo' }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form @submit.prevent="agregarEquipo">
          @csrf


          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="tipo_id">Tipo Equipo</label>
                <select class="form-control" v-model="equipo.tipo_id" id="tipo_id" @change="actualizarSubcategorias" required>
                  <option value="" disabled>Selecciona un tipo de equipo</option>
                  <option v-for="tipo in tipos" :key="tipo.id" :value="tipo.id">
                    @{{ tipo.nombre }}
                  </option>
                </select>
              </div>


            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="subtipo_id">Subtipo de Equipo</label>

                <select class="form-control" v-model="equipo.subtipo_id" id="subtipo_id" required>
                  <option value="" disabled>Selecciona un subtipo de equipo</option>
                  <option v-for="subtipo in subtipos" :key="subtipo.id" :value="subtipo.id">
                    @{{ subtipo.nombre }}
                  </option>
                </select>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="anio">Año</label>
                <input type="number" class="form-control" v-model="equipo.anio" id="anio" required>
              </div>


            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" class="form-control" v-model="equipo.marca" id="marca" required>
              </div>


            </div>

            <div class="col-md-5">
              <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" class="form-control" v-model="equipo.modelo" id="modelo" required>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="patente">Patente</label>
                <input type="text" class="form-control" v-model="equipo.patente" id="patente" required placeholder="ABCD-88">
              </div>


            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label for="num_verificador">N.V.</label>
                <input type="text" class="form-control" v-model="equipo.num_verificador" id="num_verificador" required placeholder="K">
              </div>


            </div>

            <div class="col-md-5">
              <div class="form-group">
                <label for="color">Color</label>
                <select class="form-control" v-model="equipo.color" id="color" required>
                  <option value="" disabled>Selecciona un color</option>
                  <option value="NEGRO">NEGRO</option>
                  <option value="BLANCO">BLANCO</option>
                  <option value="AZUL">AZUL</option>
                  <option value="VERDE">VERDE</option>
                  <option value="ROJO">ROJO</option>
                  <option value="PLATEADO">PLATEADO</option>
                  <option value="GRIS">GRIS</option>
                  <option value="AMARILLO">AMARILLO</option>
                  <!-- Agrega más colores si es necesario -->
                </select>
              </div>
            </div>
          </div>


          <div class="row pt-2 pb-2" style="background-color: #eeeeee;">
            <div class="col-12">
              <div class="form-group">
                <label for="color">Imagen</label>
                <label for="img" class="custom-file-title d-flex align-items-center">
                  <div class="row w-100">
                    <div class="col-6 pt-1">Imagen</div>
                    <div class="col-6 text-right pt-2">
                      <span class="material-icons me-2">upload</span>
                    </div>
                  </div>
                </label>
                <input type="file" class="form-control custom-file-input" id="img" name="img" @change="handleFileUpload($event, 'img')" ref="imgInput">
              </div>

              <ul v-if="imagen">
                <li>
                  @{{ imagen.name }} <button @click="removeFile('img')">x</button>
                </li>
              </ul>
            </div>
          </div>

          <div class="row pt-2 pb-2">
            <div class="col-12">
              <div class="form-group">
                <label for="color">Ficha Técnica</label>
                <label for="link_ficha_tecnica" class="custom-file-title d-flex align-items-center">
                  <div class="row w-100">
                    <div class="col-6 pt-1">Ficha Técnica</div>
                    <div class="col-6 text-right pt-2">
                      <span class="material-icons me-2">upload</span>
                    </div>
                  </div>
                </label>
                <input type="file" class="form-control custom-file-input" id="link_ficha_tecnica" name="link_ficha_tecnica" @change="handleFileUpload($event, 'ficha')" ref="fichaInput">
              </div>

              <ul v-if="uploadedFile">
                <li>
                  @{{ uploadedFile.name }} <button @click="removeFile('ficha')">x</button>
                </li>
              </ul>
            </div>
          </div>

          <div class="row pt-2 pb-2 mb-3" style="background-color: #eeeeee;">
            <div class="col-12">
              <div class="form-group">
                <label for="color">Documentación completa</label>
                <label for="full_documentation" class="custom-file-title d-flex align-items-center">
                  <div class="row w-100">
                    <div class="col-6 pt-1">Documentación</div>
                    <div class="col-6 text-right pt-2">
                      <span class="material-icons me-2">upload</span>
                    </div>
                  </div>
                </label>
                <input type="file" class="form-control custom-file-input" id="full_documentation" name="full_documentation" @change="handleFileUpload($event, 'docu')" ref="docuInput">
              </div>

              <ul v-if="full_documentation">
                <li>
                  @{{ full_documentation.name }} <button @click="removeFile('docu')">x</button>
                </li>
              </ul>
            </div>
          </div>






          <button type="submit" class="btn btn-primary">
            @{{ equipo.id ? 'Actualizar' : 'Guardar' }}
          </button>
        </form>
      </div>
    </div>
  </div>
</div>