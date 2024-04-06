<footer>
<div class="container">
    <div class="row">
        <div class="col-md-5 logo-footer">
            <img src="img/logo.png" alt="LINEAS DE CODIGO">
            <span>© 2015-2023 LINEAS DE CODIGO SPA. Todos los derechos reservados.</span>
        </div>
        <div class="col-md-4 menu-footer">
            <h3>Qué hacemos</h3>
            <ul>
                <li><a href="{{route('web')}}">Sitios web</a></li>
                <li><a href="{{route('desarrollo')}}">Sistemas web</a></li>                
                <li><a href="#">Administración Web</a></li>
                <li><a href="#">Administración de Redes Sociales</a></li>
                <li><a href="#">Desarrollo de software</a></li>
                <li><a href="{{route('portafolio')}}">Nuestros trabajos</a></li>    
            </ul>
        </div>
        <div class="col-md-3 social-media">
            <h3>Encuentranos en:</h3>
            <a href="https://www.facebook.com/L%C3%ADneas-de-C%C3%B3digo-SPA-334915964097846" target="_blank"><i class="bi bi-facebook"></i></a>
            <!--<a href="https://twitter.com/aeurus/" target="_blank"><i class="bi bi-twitter"></i></a>-->
            <a href="https://www.instagram.com/lineasdecodigocl/" target="_blank"><i class="bi bi-instagram"></i></a>
            <a href="https://www.linkedin.com/company/79925476/admin/" target="_blank"><i class="bi bi-linkedin"></i></a>
        </div>
    </div>

</div>
</footer>

<div id="lineas" style="font-family: 'Roboto', sans-serif;font-size: 14px;background-color: #333;"> 
    <a href="https://www.lineasdecodigo.cl/" title="Diseño Web - Posicionamiento Web - Sistema Web">
    <img width="142" height="22" src="img/logo.png" alt="Diseño Web - Posicionamiento Web - Sistema Web"></a>
</div>
    
    <script>
        $('.owl-carousel-clientes').owlCarousel({
          margin: 10,
          loop: true,
          autoplay:true,
            responsive: {
              0: {
                items: 1
              },
              400: {
                items: 2
              },
              600: {
                items: 3
              },
              800: {
                items: 4
              },
              1000: {
                items: 5
              }
            }
          })
    </script>

    <script>
        $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        autoplay:true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            }
        }
    });
    </script>