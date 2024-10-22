<?php

namespace App\Http\Controllers;

use App\Models\eCert;
use App\Models\LexCategoria;
use App\Models\LexDocumento;
use App\Models\LexFirmanteRedaccionDocumento;
use App\Models\LexInputsDocumento;
use App\Models\UserRedactaDocumento;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use PDF;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class LexWebController extends Controller
{
    
    public function index()
    {
        $categoriasDocumentos = LexCategoria::categoriasDocumentos();
        return view('lex.inicio', ['categoriasDocumentos' => $categoriasDocumentos]);
    }

    public function redactar($id) {
        $inputs = LexInputsDocumento::where('documento_id', $id)
                            ->orderBy('orden', 'asc')
                            ->get();

        $documento = LexDocumento::find($id);  

        //dd($inputs);
        return view('lex.redactar', ['inputs' => $inputs, 'documento' => $documento]);
    }

    public function carroCompras(){

        //$certificado = new eCert(1, null);
        //dd($certificado);

        return view('lex/market/carro');
    }

    public function guardarRedaccion(Request $request)
    {
        $instId = 1; 
        $userId = 1; 

        // Validar los datos de entrada
        $request->validate([
            'ruta' => 'nullable|string|max:255',
        ]);

        // Verificar si el usuario está autenticado o es un invitado
        $user_id = auth()->check() ? auth()->id() : null;
        $guest_id = null;

        if (!$user_id) {
            if (!session()->has('guest_id')) {
                $guest_id = uniqid('guest_', true); // Crear un identificador único
                session(['guest_id' => $guest_id]);
            }
            $guest_id = session('guest_id');
        }        

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
        $firmasHtml = '<div class="firmas-container" style="display: flex; flex-wrap: wrap;">';
        foreach ($firmantes as $firmante) {
            if($firmante['rut'] == $rutDeclarante) continue;
            $firmasHtml .= '
                <div id="firmas" class="col-6 mb-3" style="text-align: center; margin-right: 20px;">
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
        

        // Generar el contenido del PDF
        $pdf = FacadePdf::loadHTML($htmlFinal);

        // Crear la ruta personalizada donde se guardará el archivo (ruta privada)
        $directory = storage_path('app/private/lex/documentos/' . ($user_id ?? $guest_id));

        // Crear la carpeta si no existe
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Definir el nombre del archivo
        $filename = 'documento_' . time() . '.pdf';

        // Guardar el PDF en la ruta privada
        $pdf->save($directory . '/' . $filename);  
        // Guardar la ruta relativa en la base de datos
        $ruta = 'private/lex/documentos/' . ($user_id ?? $guest_id) . '/' . $filename;

        // Actualizar o crear el registro en la base de datos
        if ($request->filled('id')) {
            $documento = UserRedactaDocumento::find($request->input('id'));
            if ($documento) {
                $documento->update([
                    'institucion_id' => $instId,
                    'redaccion' => $redaccion, // Guardar los inputs como JSON
                    'estado' => 1,
                    'ruta' => $ruta,
                    'redaccion_final' => $htmlFinal // Guardar el HTML final con inputs
                ]);
            }
        } else {
            $documento = UserRedactaDocumento::create([
                'user_id' => $user_id,
                'guest_id' => $guest_id ?? null,
                'documento_id' => $request->input('documento_id'),
                'institucion_id' => $instId,
                'redaccion' => $redaccion,
                'estado' => 1,
                'ruta' => $ruta,
                'redaccion_final' => $htmlFinal
            ]);
        }

        // Guardar los firmantes
        foreach ($request->input('firmantes') as $firmante) {
            LexFirmanteRedaccionDocumento::create([
                'lex_redaccion_id' => $documento->id, // Relacionar al documento redacción
                'nombres' => $firmante['nombre'],
                'apellidos' => $firmante['apellido'] ?? '', // Suponiendo que tienes apellido
                'correo' => $firmante['correo'],
                'dni' => $firmante['rut'], // Usando 'rut' como 'dni'
                'estado' => 0 // Asignar el estado adecuado
            ]);
        }

        // Responder con el documento creado o actualizado
        return response()->json(['documento' => $documento], 201);
    }

 

    public function getRedaccionesPorPagar(Request $request)
    {  
        $page   = $request->get('page', 1);
        $search = $request->get('search', '');
        $perPage = 10;
        

        $redacciones = UserRedactaDocumento::redaccionesPorPagarPerPage($page, $perPage, $search);
        return response()->json(['message' => 'redacciones disponibles', 'redacciones' => $redacciones]);
    }

    public function getPDFUrl(Request $request)
    {
        $path = $request->input('ruta');

        // Verificar que el archivo existe antes de generar la URL
        if (!Storage::exists($path)) {
            return response()->json(['error' => 'Archivo no encontrado.'], 404);
        }

        // Generar una URL temporal válida por 30 minutos
        $temporaryUrl = Storage::temporaryUrl($path, Carbon::now()->addMinutes(30));

        return response()->json($temporaryUrl);
    }

    public function lexregiones()
    {
        $rutaArchivo = resource_path('data/regiones.json');
        $regiones = json_decode(File::get($rutaArchivo), true);

        return $regiones;
    }

    public function lexcomunas($region)
    {
        $response = Http::get("https://apis.digital.gob.cl/dpa/regiones/{$region}/comunas");

        return $response->json();
    }

    public function lexcategorias($id = null)
    {
        $categoria = LexCategoria::categoriasDocumentos();

        return response()->json(['message' => 'request', 'categoria' => $categoria]);
    }


}
