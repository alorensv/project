<div class="modal fade" id="verMas" tabindex="-1" aria-labelledby="verMasModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <!-- Encabezado del modal -->
         <div class="modal-header pt-1 pb-1 border-0">
            <h4 class="modal-title" id="verMasModalLabel"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>



         <div>

            <div class="pt-5 text-center">
               <img src="/img/seguros/perfil.png" class="img-fluid rounded-circle mb-4" alt="Descripción de la imagen" style="max-width: 180px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);">
               <h4 class="mt-3">Natalia Caballero</h4>
               <h5>Corredora de seguros, CMF</h5>
               <h5>Administradora pública, Universidad de Concepción</h5>

               <div class="d-flex justify-content-center pt-3">
                  <div class="text-center mx-3">
                     <div class="perfil-container" @click="cotizar('vehiculo')" style="cursor: pointer;">
                        <div class="perfil-icon" style="background-color: #495ab4;">
                           <i class="fas fa-comments"></i> <!-- Ícono de conversación -->
                        </div>
                        <div class="perfil-text">¡Hablemos!</div>
                     </div>
                  </div>

                  <div class="text-center mx-3">
                     <div class="perfil-container" style="cursor: pointer;">
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
            </div>


            <div class="bg-white pl-5 pr-5">

               <!-- Cuerpo del modal con contenido -->
               <div class="modal-body p-5 position-relative">

                  <p>👋 ¡Hola! Soy Natalia Caballero Pérez, corredora de propiedades miembro de la Comisión para el Mercado Financiero (CMF) con más de 7 años de experiencia en el rubro.</p>
                  <p>
                     Me especializo en ofrecer un servicio integral y gratuito de asesoramiento, con un enfoque particular en seguros generales y de vehículos.
                  </p>
                  <p>
                     Mi objetivo es ayudarte a tomar las mejores decisiones para tu inversión, con la tranquilidad de estar en manos expertas.
                  </p>

                  
               </div>

            </div>

         </div>


      </div>
   </div>
</div>