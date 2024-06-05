@extends('plantilla')

@section('slide')
<style>
  .file-drop-area {
    position: relative;
    display: flex;
    align-items: center;
    width: 335px;
    max-width: 100%;
    padding: 25px;
    border: 1px dashed rgb(147 147 147 / 40%);
    background-color: #edeced;
    border-radius: 3px;
    transition: 0.2s;

    &.is-active {
      background-color: #f2f2f2;
    }
  }

  .fake-btn {
    flex-shrink: 0;
    background-color: #3490dc;
    border: 1px solid #a7a4a7;
    border-radius: 3px;
    padding: 8px 15px;
    margin-right: 10px;
    font-size: 12px;
    text-transform: uppercase;
    color: #ffff;
  }

  .file-msg {
    color: #020202;
    font-size: small;
    font-weight: 300;
    line-height: 1.4;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .file-input {
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    cursor: pointer;
    opacity: 0;

    &:focus {
      outline: none;
    }
  }

  /*color input*/
  #swatch {
    background: white;
    box-shadow: 0em 1em 12.1px rgba(0, 0, 0, 0.4);
    display: flex;
    flex-direction: column;
    width: 50px;
  }

  input[type="color"] {
    appearance: none;
    -moz-appearance: none;
    -webkit-appearance: none;
    background: none;
    border: 0;
    cursor: pointer;
    height: 50px;
    padding: 0;
    width: 50px;
  }

  *:focus {
    border-radius: 0;
    outline: none;
  }

  ::-webkit-color-swatch-wrapper {
    padding: 0;
  }

  ::-webkit-color-swatch {
    border: 0;
    border-radius: 0;
  }

  ::-moz-color-swatch,
  ::-moz-focus-inner {
    border: 0;
  }

  ::-moz-focus-inner {
    padding: 0;
  }
</style>

<section class="portafolio py-4" style="margin-top: 20px;">
  <!-- START THE FEATURETTES -->
  <div class="container">
    <div class="row featurette">
      <div class="col-md-6">
        <h2 class="featurette-heading">Generar código <span class="text-muted"> QR.</span></h2>
        <p class="lead">En 3 pasos muy simples, genera 100% gratis tu código QR personalizado con tu logo y color institucional</p>

        <div id="qr-container" class="mt-5"></div>
      </div>
      <div class="col-md-6 py-4">

        <div class="row">
          <div class="col-12">
            <h2 class="titles-heading mt-5">Paso 1 <span class="text-muted"><br> Sube tu favicon o logo</span></h2>
          </div>

          <div class="col-12 file-drop-area mt-4 ml-4">
            <span class="fake-btn">Elegir imagen</span>
            <span class="file-msg">o arrastra y suelta la imagen aquí</span>
            <input class="file-input" type="file" id="logo" name="logo" onchange="updateQr()" accept=".png, .ico, .jpeg, .jpg">
          </div>

        </div>
        <div class="row" style="padding-left: 15px;">
          <h2 class="titles-heading mt-5">Paso 2 <span class="text-muted">
              <br> Seleccionar tu color institucional</span></h2>
          <div class="mt-4 ml-4">

            <div id="swatch" class="mt-3">
              <input type="color" id="color" name="color" value="#FF0000" onchange="updateQr()">
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-12">
            <h2 class="titles-heading mt-3">Paso 3 <span class="text-muted">
                <br> Agrega una dirección web</span></h2>
          </div>
          <div class="col-12 mt-4 ml-4" style="width: 50%;">
            <input type="text" class="form-control" id="link" name="link" placeholder="Ej: https://lineasdecodigo.cl" value="https://" onchange="updateQr()" />
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <h2 class="titles-heading" style="margin-top: 3rem!important;">


              Descargar código QR
              <i class="material-icons" style="vertical-align: middle;font-size: 2rem;">download</i>

            </h2>
          </div>
        </div>




      </div>
    </div>
  </div>
  <!-- /END THE FEATURETTES -->
</section>



<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

<style>

</style>

<script>
  var $fileInput = $('.file-input');
  var $droparea = $('.file-drop-area');

  // highlight drag area
  $fileInput.on('dragenter focus click', function() {
    $droparea.addClass('is-active');
  });

  // back to normal state
  $fileInput.on('dragleave blur drop', function() {
    $droparea.removeClass('is-active');
  });

  // change inner text
  $fileInput.on('change', function() {
    var filesCount = $(this)[0].files.length;
    var $textContainer = $(this).prev();

    if (filesCount === 1) {
      // if single file is selected, show file name
      var fileName = $(this).val().split('\\').pop();
      $textContainer.text(fileName);
    } else {
      // otherwise show number of files
      $textContainer.text(filesCount + ' files selected');
    }
  });

  document.addEventListener('DOMContentLoaded', function() {
    updateQr();
  });

  function handleImageChange(input) {
    // Verificar si se proporciona un elemento de entrada, de lo contrario, utilizar el valor predeterminado
    input = input || document.getElementById('logo');

    var filesCount = input.files.length;
    var $textContainer = $(input).prev();

    if (filesCount === 1) {
      var fileName = input.files[0].name;
      $textContainer.text(fileName);

      // Actualizar el valor de la variable logo con la nueva imagen seleccionada
      var logo = new Image();
      logo.src = URL.createObjectURL(input.files[0]);
      return logo;
    } else {
      $textContainer.text(filesCount + ' archivos seleccionados');
      var logo = new Image();
      logo.src = '/img/tbl/TBL.png'; 
      return logo;
    }
  }



  function updateQr(logo = false) {
        
    document.getElementById("qr-container").innerHTML = '';

    var urlInput = document.getElementById('link').value;
    var colorInput = document.getElementById('color').value;
    var logoInput = document.getElementById('logo');
    var logo = handleImageChange(logoInput);
    alert(logo)


    var url = (!urlInput || urlInput === undefined) ? 'https://lineasdecodigo.cl/' : urlInput;

    var colorQr = (!colorInput || colorInput === undefined) ? '#000' : colorInput;

    // Crea una instancia de QRCode.js
    var qrcode = new QRCode(document.getElementById("qr-container"), {
      text: url,
      width: 250, // Ancho del código QR
      height: 250, // Alto del código QR
      colorDark: colorQr, // Color de los elementos oscuros del código QR
      colorLight: "#ffffff", // Color de los elementos claros del código QR
    });

    var canvas = document.querySelector("canvas"); // Obtiene el elemento canvas del código QR
    var context = canvas.getContext("2d");
    var logoSize = 100; // Tamaño en píxeles
    var x = (canvas.width - logoSize) / 2; // Posición en X
    var y = (canvas.height - logoSize) / 2; // Posición en Y

    console.log(logo)
    // Dibuja el código QR en el canvas
    qrcode._oDrawing.makeImage();
    context.drawImage(qrcode._oDrawing._elImage, 0, 0, canvas.width, canvas.height);
   
    // Dibuja el logo en el centro del código QR
    context.drawImage(logo, x, y, logoSize, logoSize);
    console.log(context)

  }
</script>
@endsection