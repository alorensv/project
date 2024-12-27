<?php

namespace App\Models;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LexDocumento extends Model
{
    use HasFactory;

    protected $table = 'lex_documentos';

    protected $fillable = ['nombre', 'descripcion', 'default_text', 'cantidad_firmantes', 'imagen', 'estado','lex_categoria_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(LexCategoria::class, 'lex_categoria_id');
    }

    public static function formatearDocumento($request){

        $firmantes = $request->input('firmantes', []);
        $documento = LexDocumento::find($request->input('documento_id'));
        if ($documento) {
            $defaultText = count($firmantes) > 1 ? $documento->default_text_plural : $documento->default_text;
        } else {
            $defaultText = null; 
        }
        // Obtener los inputs asociados al documento
        $inputs = LexInputsDocumento::where('documento_id', $request->input('documento_id'))
                        ->orderBy('orden', 'asc')
                        ->get();
        
        
        // Crear un array con los valores de los inputs
        $inputValues = [];
        $rutDeclarante = '';

        foreach ($inputs as $input) {
            // Asignar los valores de los inputs desde el request o un valor por defecto
            $inputValue = $request->input($input->name); // Obtén el valor del input

            if ($input->name == 'rut') {
                $rutDeclarante = $inputValue; // Asigna el valor del RUT
            }

            // Verificar si el campo es de tipo fecha
            if ($input->field_type === 'date' && !empty($inputValue)) {
                $date = new DateTime($inputValue);
                
                    // Ajustar la zona horaria a la local (por ejemplo, América/Santiago)
                    $date->setTimezone(new DateTimeZone('America/Santiago'));

                    // Establecer la localización para español Latinoamericano
                    setlocale(LC_TIME, 'es_CL.UTF-8');  // Español (Chile)

                    // Formatear la fecha en el formato deseado (día de la semana, día, mes, año)
                    $formattedDate = strftime('%A, %d de %B de %Y', $date->getTimestamp());

                    // Asignar el valor formateado
                    $inputValue = $formattedDate;
            }

            // Asignar el valor (formateado o no) al array de inputs
            $inputValues[$input->name] = $inputValue ?? 'espaciosRelleno'; // Usa 'espaciosRelleno' si el valor es nulo o no está presente
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
        
        

        // Generar el bloque HTML de firmantes
        $firmantesHtml = ''; // Limpiar contenido previo
        $firmasHtml = '<div class="firmas-container" style="display: flex; flex-wrap: wrap; justify-content: center;">';
        
        foreach ($firmantes as $index => $firmante) {
            if ($firmante['rut'] == $rutDeclarante) continue;
        
            // Verificar si es el único firmante
            if (count($firmantes) === 1) {
                $firmantesHtml .= ' y ' 
                . htmlspecialchars($firmante['nombre']) . ' ' . htmlspecialchars($firmante['apellido_paterno']) . ' ' . htmlspecialchars($firmante['apellido_materno']) 
                . ' cédula de identidad ' . htmlspecialchars($firmante['rut']) . ' de nacionalidad ' . htmlspecialchars($firmante['nacionalidad']) . ', ' 
                . htmlspecialchars($firmante['estado_civil']) . ', ' . htmlspecialchars($firmante['profesion_oficio']) . ', con domicilio en ' 
                . htmlspecialchars($firmante['domicilio']) . ', comuna ' . htmlspecialchars($firmante['comuna']) . ', ' . htmlspecialchars($firmante['region']);
            } 
            // Verificar si es el último firmante
            else if ($index === count($firmantes) - 1) {
                $firmantesHtml .= ' y ' 
                . htmlspecialchars($firmante['nombre']) . ' ' . htmlspecialchars($firmante['apellido_paterno']) . ' ' . htmlspecialchars($firmante['apellido_materno']) 
                . ' cédula de identidad ' . htmlspecialchars($firmante['rut']) . ' de nacionalidad ' . htmlspecialchars($firmante['nacionalidad']) . ', ' 
                . htmlspecialchars($firmante['estado_civil']) . ', ' . htmlspecialchars($firmante['profesion_oficio']) . ', con domicilio en ' 
                . htmlspecialchars($firmante['domicilio']) . ', comuna ' . htmlspecialchars($firmante['comuna']) . ', ' . htmlspecialchars($firmante['region']);
            } 
            // Para cualquier otro firmante
            else {
                $firmantesHtml .= ', ' 
                . htmlspecialchars($firmante['nombre']) . ' ' . htmlspecialchars($firmante['apellido_paterno']) . ' ' . htmlspecialchars($firmante['apellido_materno']) 
                . ' cédula de identidad ' . htmlspecialchars($firmante['rut']) . ' de nacionalidad ' . htmlspecialchars($firmante['nacionalidad']) . ', ' 
                . htmlspecialchars($firmante['estado_civil']) . ', ' . htmlspecialchars($firmante['profesion_oficio']) . ', con domicilio en ' 
                . htmlspecialchars($firmante['domicilio']) . ', comuna ' . htmlspecialchars($firmante['comuna']) . ', ' . htmlspecialchars($firmante['region']);
            }
        
            // Agregar al bloque HTML para la firma
            $firmasHtml .= '
                <div id="firmas" class="col-6 mb-3" style="text-align: center; margin-right: 20px; font-size: 20px;">
                    <p>
                        <span>' . htmlspecialchars($firmante['nombre']) . '</span><br>
                        <span>' . htmlspecialchars($firmante['rut']) . '</span>
                    </p>
                </div>';
        }
        
        $firmasHtml .= '</div>';
        

        // Concatenar el HTML de firmantes al final del contenido del documento
        $htmlFinal .= $firmasHtml;

        $htmlFinal = str_replace('<span id="posiblesFirmantes"></span>', $firmantesHtml, $htmlFinal);

        return [$htmlFinal, $redaccion];

    }
    
}
