<template>
    <div class="bgInfo">
        <div class="container">
            <div class="pt-4 pb-5 text-center">
                <h2 class="text-primary">¿Cómo funciona?</h2>
                <hr class="divider">
                <div class="steps-container">
                    <!-- Paso 1 -->
                    <div class="step">
                        <div class="circle">1</div>
                        <span class="material-icons icon">description</span>
                        <h4>Elige y completa tu documento</h4>
                    </div>

                    <!-- Línea que conecta los pasos -->
                    <div class="line"></div>

                    <!-- Paso 2 -->
                    <div class="step">
                        <div class="circle">2</div>
                        <span class="material-icons icon">group_add</span>
                        <h4>Añade los firmantes</h4>
                    </div>

                    <!-- Línea que conecta los pasos -->
                    <div class="line"></div>

                    <!-- Paso 3 -->
                    <div class="step">
                        <div class="circle">3</div>
                        <span class="material-icons icon">credit_card</span>
                        <h4>Realiza el pago con Transbank</h4>
                    </div>

                    <!-- Línea que conecta los pasos -->
                    <div class="line"></div>

                    <!-- Paso 4 -->
                    <div class="step">
                        <div class="circle">4</div>
                        <span class="material-icons icon">edit_note</span>
                        <h4>Firma tu documento online</h4>
                    </div>
                </div>

                <p class="final-text">¡Todo listo para descargar y usar!</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {};
        },
        mounted() {
            this.initStepAnimation();
        },
        methods: {
            initStepAnimation() {
        const steps = document.querySelectorAll('.step');
        const observer = new IntersectionObserver((entries) => {
          let delay = 0;
          let visibleCount = 0; // Contador para llevar un seguimiento de los pasos visibles

          entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
              // Mostrar inmediatamente el primer elemento
              setTimeout(() => {
                  entry.target.classList.add('visible');
                  visibleCount++; // Contar este paso como visible
                  // Verificar si todos los pasos han sido visibles
                  if (visibleCount === steps.length) {
                    document.querySelector('.final-text').style.fontSize = '34px'; // Aumentar el tamaño del texto
                  }
                }, delay);
                delay += 200; 
            } else {
              entry.target.classList.remove('visible');
              document.querySelector('.final-text').style.fontSize = '1.4rem'; 
            }
          });
        }, { threshold: 1 });

        steps.forEach(step => observer.observe(step));
      }
        }
    };
</script>