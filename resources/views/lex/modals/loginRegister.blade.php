<style>
    hr {
    border-top: 1px solid rgb(0 0 0 / 80%)!important;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="loginRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro / Iniciar sesión</h5>
                <button type="button" class="close" data-dismiss="modal" @click="closeModal('loginRegister')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <h4>¡Te recomendamos registrarte!</h4>
                    <ul>
                        <li>Podrás realizar seguimientos de las firmas en las que participas</li>
                        <li>Notificar nuevamente a los firmantes</li>
                        <li>Consultar <strong>siempre</strong> los documentos</li>
                    </ul>
                </div>
                <form @submit.prevent="consultarCorreo">
                    <div class="form-group">
                        <label for="correo">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="correo" v-model="correo" required>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Continuar</button>
                    </div>
                </form>
                <hr>
                <div class="text-center">
                <button type="button" @click="continuarInvitado" class="btn btn-secondary">Continuar como invitado</button>
                </div>
            </div>
        </div>
    </div>
</div>