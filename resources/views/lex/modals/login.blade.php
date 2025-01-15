<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Iniciar sesión</h5>
                    <button type="button" class="close" data-dismiss="modal" @click="closeModal('login')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submitLogin">
                        <div class="form-group">
                            <label for="correo">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="correo" v-model="correo" required>
                        </div>
                        <div class="form-group">
                            <label for="clave">Contraseña:</label>
                            <input type="password" class="form-control" id="clave" v-model="clave" required minlength="8">
                        </div>

                        @if (Route::has('password.request'))
                        <a class="btn btn-secondary" href="{{ route('password.request') }}">
                            {{ __('¿Olvistaste tu contraseña?') }}
                        </a>
                        @endif

                        <div v-if="loginError" class="alert alert-danger mt-3 d-flex justify-content-between align-items-center">
                            <span>@{{ loginError }}</span>
                            <button type="button" class="btn-close" aria-label="Close" @click="closeLoginError"></button>
                        </div>

                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>