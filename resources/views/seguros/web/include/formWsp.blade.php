<form @submit.prevent="enviarMensaje">
    <div class="form-group">
        <label for="comentarios">Mensaje:</label>
        <textarea class="form-control" v-model="contacto.comentarios" placeholder="Hablemos por Whatsapp..." required maxlength="255" rows="4" id="comentarios"></textarea>
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-success">Enviar</button>
    </div>
</form>