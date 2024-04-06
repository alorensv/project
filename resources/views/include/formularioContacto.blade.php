<section>

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
        @error('name')
            <p class="">{{$message}}</p>
        @enderror
      </div>
      <div class="form-group">
        <label>Email *</label>
        <input type="email" id="email" name="email" class="form-control" required="required" placeholder="Correo">
        @error('email')
            <p class="">{{$message}}</p>
        @enderror
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
        @error('message')
            <p class="">{{$message}}</p>
        @enderror
      </div>                        
      <div class="form-group">
        <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required" onClick="enviarmail()">Enviar</button>
      </div>
    </div><!--col 5-->   
  
  </div> <!--row-->

</form>
</section>