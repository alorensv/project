<!-- Modal register-->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submitRegister">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" v-model="nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="correo">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="correo" v-model="correo" required>
                        </div>
                        <div class="form-group">
                            <label for="clave">Contraseña:</label>
                            <input type="password" class="form-control" id="clave" v-model="clave" required minlength="6">
                            <small class="form-text text-muted">La contraseña debe tener al menos 6 caracteres.</small>
                        </div>

                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-primary">Continuar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>