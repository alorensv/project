@extends('plantilla')

@section('slide')

@endsection

@section('content')
<div class="container">
  <div class="row featurette"> 
    <div class="col-md-12">
      <div class="texto-cotiza">
        <h2 class="featurette-heading">Cotiza tu proyecto <span class="text-muted">con Nosotros</span><i class="bi bi-chevron-right"></i></h2>
      </div>
    </div> 
  </div>
  @if (session('info'))
    <div class="status alert alert-success">{{session('info')}}</div>
  @endif
  
  <form action="{{route('enviarEmail')}}" method="POST" >
  <div class="row">            
    
      @csrf 
      <div class="col-md-7">
        <div class="form-group">
          <label>Nombre *</label>
          <input type="text" id="name"  name="name" class="form-control" required="required" placeholder="Nombre">
        </div>
        @error('name')
            <p class="">{{$message}}</p>
        @enderror
        <div class="form-group">
          <label>Email *</label>
          <input type="email" id="email" name="email" class="form-control" required="required" placeholder="Correo">
        </div>
        @error('email')
            <p class="">{{$message}}</p>
        @enderror
        <div class="form-group">
          <label>Teléfono</label>
          <input type="number" id="fono" name="fono" class="form-control" placeholder="Teléfono">
        </div>
        <div class="form-group">
          <label>Consulta *</label>
          <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Consultas"></textarea>
        </div>     
        @error('message')
            <p class="">{{$message}}</p>
        @enderror                   
        <div class="form-group">
          <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required" onClick="enviarmail()">Enviar</button>
        </div>
      </div>
      <div class="col-md-5" style="text-align: right;">
        <h4 class="featurette">Información de <span class="text-muted">Contacto</span><i class="bi bi-chevron-right"></i></h4>
          <p class="lead">Correos</p>
          <p><i style="margin-right: 10px;" class="bi bi-envelope-fill"></i>ventas@lineasdecodigo.cl</p>
          <p><i style="margin-right: 10px;" class="bi bi-envelope-fill"></i>contacto@lineasdecodigo.cl</p>

          <p class="lead">Fono</p>
          <p><i style="margin-right: 10px;" class="bi bi-whatsapp"></i>+569 89523359</p>

          <p class="lead">Redes Sociales</p>
          <p><i style="margin-right: 10px;" class="bi bi-facebook"></i>Lineas de código</p>
          <p><i style="margin-right: 10px;" class="bi bi-instagram"></i>@lineasdecodigocl</p>  

      </div>  
    
  </div>    
  </form>   
</div>

@include('include.convenioMarco')
      

@endsection