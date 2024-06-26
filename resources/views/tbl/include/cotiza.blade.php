<div class="div_cotiza">
    <section class="shadow-lg" style=" background-color: white;color: #060737;" id="contacto">
        <form action="{{route('enviarEmail')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center pb-4 ">
                        <h4 style="font-size: 1.8rem;font-weight: 600;">¡Cotiza y trabajemos juntos!</h4>
                    </div>

                    @if (session('info'))
                    <div class="status alert alert-success">{{session('info')}}</div>
                    @endif

                    <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input type="text" id="name" name="name" class="form-control" required="required" placeholder="Nombre">
                    </div>
                    @error('name')
                    <p class="">{{$message}}</p>
                    @enderror
                    <div class="form-group">
                        <label for="emai">Correo</label>
                        <input type="email" id="email" name="email" class="form-control" required="required" placeholder="Correo">
                    </div>
                    @error('email')
                    <p class="">{{$message}}</p>
                    @enderror
                    <div class="form-group">
                        <label for="Teléfono">Teléfono</label>
                        <input type="number" id="fono" name="fono" class="form-control" placeholder="Teléfono">
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha posible del servicio</label>
                        <input type="number" id="fono" name="fono" class="form-control" placeholder="Fecha posible del servicio">
                    </div>

                </div><!--/.col-md-12-->
                <div class="col-6">
                    <div class="form-group">
                        <label for="fecha">Origen</label>
                        <input type="number" id="fono" name="fono" class="form-control" placeholder="Fecha posible del servicio">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="fecha">Destino</label>
                        <input type="number" id="fono" name="fono" class="form-control" placeholder="Fecha posible del servicio">
                    </div>
                </div>
                <div class="col-12">

                    <div class="form-group">
                        <label for="mensaje">Comentarios</label>
                        <textarea name="message" id="message" required="required" class="form-control" rows="4" placeholder="¿Qué es lo que quieres transportar?"></textarea>
                    </div>
                    @error('message')
                    <p class="">{{$message}}</p>
                    @enderror
                    <div class="form-group w-100">
                        <button type="submit" name="submit" class="w-100 btn btn-primary btn-lg" required="required" onClick="enviarmail()">Enviar</button>
                    </div>



                </div><!--/.row-->
        </form>
    </section>
</div>