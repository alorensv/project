@extends('plantilla')

@section('slide')
<section class="portafolio py-4" style="margin-top: 20px;">
        <!-- START THE FEATURETTES --> 
        <div class="container"> 
          <div class="row featurette">
            <div class="col-md-6">
              <h2 class="featurette-heading">Nuestro trabajo <span class="text-muted"> nos valida.</span></h2>
              <p class="lead">Nos especializamos en diseño de páginas web y sistemas web fáciles de usar y accesibles que generan rentabilidad, mejora en procesos y muchisimos datos para tomar las mejores decisiones en su negocio..</p>

              <h2 class="featurette-heading">Revisa nuestro <span class="text-muted"><br> Portafolio<i class="bi bi-chevron-down"></i></span></h2>
            </div>
            <div class="col-md-6 py-4">


              <!--<img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image">-->
              <div class="owl-carousel owl-theme">
                <div class="item"><img src="img/trabajos/transportesbulnes.jpg"></div>
                <div class="item"><img src="img/trabajos/decoraciones.jpg"></div>
                <div class="item"><img src="img/trabajos/holmanortiz.jpg"></div>
                <div class="item"><img src="img/trabajos/pypconsulting.jpg"></div>
                <div class="item"><img src="img/trabajos/seguros.jpg"></div>
                <div class="item"><img src="img/trabajos/amagi.jpg"></div>
              </div>


            </div>
          </div>
        </div> 
        <!-- /END THE FEATURETTES -->
      </section>
@endsection

@section('content')
<section class="container py-4">
        <div class="row">

          <div class="col-md-4 py-2">
              <div class="card">
                <img src="img/portafolio/fullmedical.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">FULLMEDICAL</h5>
                  <p class="card-text">Diseño web estático tipo catálogo para presentar sus productos y servicios.</p>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Referencia: Mauricio Hidalgo</li>
                </ul>
                <div class="card-body">
                  Web: <a href="https://fullmedical.cl" class="card-link" target="_blank">www.fullmedical.cl</a>
                </div>
              </div>
          </div>


          <div class="col-md-4 py-2">
              <div class="card">
                <img src="img/portafolio/tbl.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">TRANSPORTES BULNES</h5>
                  <p class="card-text">Diseño web estático tipo catálogo para presentar sus servicios.</p>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Referencia: Eduardo Pincheira</li>
                </ul>
                <div class="card-body">
                  Web: <a href="https://transportesbulnes.cl" class="card-link" target="_blank">www.transportesbulnes.cl</a>
                </div>
              </div>
          </div>


          <div class="col-md-4 py-2">
              <div class="card">
                <img src="img/portafolio/holman.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">HOLMAN ORTIZ</h5>
                  <p class="card-text">Diseño web con sistema de corretaje para auto-administrar propiedades.</p>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Referencia: Holman Ortiz</li>
                </ul>
                <div class="card-body">
                  Web: <a href="https://holmanortiz.cl" class="card-link" target="_blank">www.holmanortiz.cl</a>
                </div>
              </div>
          </div>

          <div class="col-md-4 py-2">
              <div class="card">
                <img src="img/portafolio/segurosncs.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">SEGUROS NCS</h5>
                  <p class="card-text">Landing Page para Corredora de Seguros Natalia Caballero ofreciendo seguros generales y de vida.</p>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Referencia: Natalia Caballero</li>
                </ul>
                <div class="card-body">
                  Web: <a href="https://segurosncs.cl" class="card-link" target="_blank">www.segurosncs.cl</a>
                </div>
              </div>
          </div>

          <div class="col-md-4 py-2">
              <div class="card">
                <img src="img/portafolio/pyp.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">PYP CONSULTING</h5>
                  <p class="card-text">Landing Page para Consultora de informática ofreciendo sus servicios TI, control de procesos y analytics services.</p>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Referencia: Paola Paredes</li>
                </ul>
                <div class="card-body">
                  Web: <a href="https://pypconsulting.cl" class="card-link" target="_blank">www.pypconsulting.cl</a>
                </div>
              </div>
          </div>

          <div class="col-md-4 py-2">
              <div class="card">
                <img src="img/portafolio/decoraciones.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">DECORACIONES VIÑA</h5>
                  <p class="card-text">Diseño web auto-administrable con sistema de fácil uso para agregar productos y servicios.</p>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Referencia: Felipe Casas</li>
                </ul>
                <div class="card-body">
                  Web: <a href="https://decoracionesvina.cl" class="card-link" target="_blank">www.decoracionesvina.cl</a>
                </div>
              </div>
          </div>

          <div class="col-md-4 py-2">
              <div class="card">
                <img src="img/portafolio/tyc.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">TYC AUTOMOTRIZ</h5>
                  <p class="card-text">Landing Page de taller automotriz TYC ofreciendo sus servicios de mecánica y electricidad.</p>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Referencia: Carlos Soto</li>
                </ul>
                <div class="card-body">
                  Web: <a href="https://tycautomotriz.cl" class="card-link" target="_blank">www.tycautomotriz.cl</a>
                </div>
              </div>
          </div>



        </div>
      </section>


      <hr class="featurette-divider">

<div class="container" style="padding-bottom: 40px;">
<div class="row featurette"> 
  <div class="col-md-12">
    <div class="texto-cotiza">
      <h2 class="featurette-heading">Cotiza tu proyecto <span class="text-muted">con Nosotros</span><i class="bi bi-chevron-right"></i></h2>
    </div>
  </div> 
</div>

<div class="row"> 
  <div class="col-md-7">
    <div class="form-group">
      <label>Nombre *</label>
      <input type="text" id="name"  name="name" class="form-control" required="required" placeholder="Nombre">
    </div>
    <div class="form-group">
      <label>Email *</label>
      <input type="email" id="email" name="email" class="form-control" required="required" placeholder="Correo">
    </div>
    <div class="form-group">
      <label>Teléfono</label>
      <input type="number" id="fono" name="fono" class="form-control" placeholder="Teléfono">
    </div>
  </div><!--col 7-->
  <div class="col-md-5">
    <div class="form-group">
      <label>Consulta *</label>
      <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Consultas"></textarea>
    </div>                        
    <div class="form-group">
      <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required" onClick="enviarmail()">Enviar</button>
    </div>
  </div><!--col 5-->   
</div> <!--row-->

</div>
@endsection