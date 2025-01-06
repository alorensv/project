<div class="d-flex justify-content-center pt-3">
    <div class="text-center mx-3">
        <div class="perfil-container" @click="hablemos()" style="cursor: pointer;">
            <div class="perfil-icon" style="background-color: #495ab4;">
                <i class="fas fa-comments"></i> <!-- Ícono de conversación -->
            </div>
            <div class="perfil-text">¡Hablemos!</div>
        </div>
    </div>

    <div class="text-center mx-3">
        <div class="perfil-container" @click="escribeme()" style="cursor: pointer;">
            <div class="perfil-icon" style="background-color: darkcyan;">
                <i class="fas fa-envelope"></i> <!-- Ícono de correo -->
            </div>
            <div class="perfil-text">¡Escríbeme!</div>
        </div>
    </div>

    <div class="text-center mx-3">
        <div class="perfil-container" style="cursor: pointer;">
            <div class="perfil-icon" style="background-color: darkorchid;">
                <i class="fas fa-user-plus"></i> <!-- Ícono de seguir -->
            </div>
            <div class="perfil-text">¡Sígueme!</div>
        </div>
    </div>
</div>