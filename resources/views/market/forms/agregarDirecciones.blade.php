<form @submit.prevent="submitForm">
    <div class="row">

        <div class="col-6">
            <div class="form-group">
                <label for="nombre_contacto">Nombre Contacto</label>
                <input type="text"  class="form-control" id="nombre_contacto" v-model="nombre_contacto" required>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="fono_contacto">Teléfono móvil</label>
                <input type="text"  class="form-control" id="fono_contacto" v-model="fono_contacto" required>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="direccion">Región</label>
                <select v-model="selectedRegion" id="selectedRegion" class="form-control" @change="fetchComunas">
                    <option value="" disabled selected>Selecciona una región</option>
                    <option v-for="region in regiones" :key="region.codigo" :value="region.codigo">@{{ region.nombre }}</option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="comuna">Comuna</label>
                <select v-model="selectedComuna" id="selectedComuna" class="form-control">
                    <option value="" disabled selected>Selecciona una comuna</option>
                    <option v-for="comuna in comunas" :key="comuna.codigo" :value="comuna.nombre">@{{ comuna.nombre }}</option>
                </select>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="codigo_postal">Código postal</label>
                <input type="text"  class="form-control" id="codigo_postal" v-model="codigo_postal" required>
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text"  class="form-control" id="direccion" v-model="direccion" required>
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="is_default" v-model="is_default">
                    <label class="form-check-label" for="is_default">Seleccionar dirección por defecto</label>
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-12 text-right">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

</form>