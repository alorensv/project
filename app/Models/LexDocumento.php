<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LexDocumento extends Model
{
    use HasFactory;

    protected $table = 'lex_documentos';

    protected $fillable = ['nombre', 'descripcion', 'default_text', 'imagen', 'estado','lex_categoria_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(LexCategoria::class, 'lex_categoria_id');
    }

    public static function formatearDocumento($request){
        $defaultText = LexDocumento::find($request->input('documento_id'))->default_text;

        // Obtener los inputs asociados al documento
        $inputs = LexInputsDocumento::where('documento_id', $request->input('documento_id'))
                        ->orderBy('orden', 'asc')
                        ->get();
        
        
        // Crear un array con los valores de los inputs
        $inputValues = [];
        $rutDeclarante = '';
        foreach ($inputs as $input) {
            // Asignar los valores de los inputs desde el request o un valor por defecto
            if( $input->name == 'rut'){
                $rutDeclarante = $request->input($input->name);
            }
            $inputValues[$input->name] = $request->input($input->name) ?? 'espaciosRelleno';
        }
        $redaccion = json_encode($inputValues);
        
        // Crear las variables de búsqueda y reemplazo para el HTML
        $search = [];
        $replace = [];

        foreach ($inputValues as $key => $value) {
            // Agregar las versiones buscadas en el HTML predeterminado
            $search[] = "{{ getInputValue('$key') || espaciosRelleno }}";
            // Agregar el valor correspondiente o 'espaciosRelleno' si no está
            $replace[] = $value;
        }

        // Reemplazar las variables en el HTML predeterminado
        $htmlFinal = str_replace($search, $replace, $defaultText);
        
        $firmantes = $request->input('firmantes', []);

        // Generar el bloque HTML de firmantes
        $firmantesHtml = '';
        $firmasHtml = '<div class="firmas-container" style="display: flex; flex-wrap: wrap; justify-content: center;">';
        foreach ($firmantes as $firmante) {
            if($firmante['rut'] == $rutDeclarante) continue;

            // Concatenar los firmantes al estilo de la lógica en JavaScript
            $firmantesHtml .= ', ' 
            . htmlspecialchars($firmante['nombre']) 
            . ' R.U.N. ' . htmlspecialchars($firmante['rut']) 
            . ' con domicilio para estos efectos en '; // . htmlspecialchars($firmante['direccion'])

            $firmasHtml .= '
                <div id="firmas" class="col-6 mb-3" style="text-align: center; margin-right: 20px;font-size: 20px;">
                    <p>
                        <span>' . htmlspecialchars($firmante['nombre']) . '</span><br>
                        <span>' . htmlspecialchars($firmante['rut']) . '</span>
                    </p>
                </div>
            ';
        }
        $firmasHtml .= '</div>';

        // Concatenar el HTML de firmantes al final del contenido del documento
        $htmlFinal .= $firmasHtml;

        $htmlFinal = str_replace('<span id="posiblesFirmantes"></span>', $firmantesHtml, $htmlFinal);

        return [$htmlFinal, $redaccion];

    }
    
}
