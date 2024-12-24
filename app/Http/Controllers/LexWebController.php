<?php

namespace App\Http\Controllers;

use App\Models\eCert;
use App\Models\EstadoCivil;
use App\Models\LexCategoria;
use App\Models\LexDocumento;
use App\Models\LexFirmanteRedaccionDocumento;
use App\Models\LexInputsDocumento;
use App\Models\Nacionalidad;
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

    public function categoriasDoc(){
        $categoriasDocumentos = LexCategoria::categoriasDocumentos();
        
        return response()->json(['message' => 'documentos disponibles', 'categoriasDocumentos' => $categoriasDocumentos]);
    }

    public function redactar($id)
    {

        $inputs = LexInputsDocumento::where('documento_id', $id)
            ->orderBy('orden', 'asc')
            ->get();

        $documento = LexDocumento::find($id);

        //dd($inputs);
        return view('lex.redactar', ['inputs' => $inputs, 'documento' => $documento]);
    }

    public function carroCompras()
    {

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

        $htmlFinal = LexDocumento::formatearDocumento($request);
        // Generar el contenido del PDF
        $pdf = FacadePdf::loadHTML($htmlFinal[0]);
        $pdfContent = $pdf->output(); // Contenido binario del PDF
        $pdfBase64 = base64_encode($pdfContent); // Convertir a base64
        // Crear la ruta personalizada donde se guardará el archivo (ruta privada)
        $directory = storage_path('app/private/lex/documentos/' . ($user_id ?? $guest_id));
        // Crear la carpeta si no existe
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        // Definir el nombre del archivo
        $filename = 'documento_' . time() . '.pdf';
        $pdf->save($directory . '/' . $filename);
        // Guardar la ruta relativa en la base de datos
        $ruta = 'private/lex/documentos/' . ($user_id ?? $guest_id) . '/' . $filename;

        // Actualizar o crear el registro en la base de datos
        if ($request->filled('id')) {
            $documento = UserRedactaDocumento::find($request->input('id'));
            if ($documento) {
                $documento->update([
                    'institucion_id' => $instId,
                    'redaccion' => $htmlFinal[1], // Guardar los inputs como JSON
                    'estado' => 1,
                    'ruta' => $ruta,
                    'redaccion_final' => $htmlFinal[0],
                    'base64' => $pdfBase64,
                ]);
            }
        } else {
            $documento = UserRedactaDocumento::create([
                'user_id' => $user_id,
                'guest_id' => $guest_id ?? null,
                'documento_id' => $request->input('documento_id'),
                'institucion_id' => $instId,
                'redaccion' => $htmlFinal[1],
                'estado' => 1,
                'ruta' => $ruta,
                'redaccion_final' => $htmlFinal[0],
                'base64' => $pdfBase64,
            ]);
        }

        //guardar firmantes
        $firmantes = LexFirmanteRedaccionDocumento::guardarFirmantesDoc($request->input('firmantes'), $documento);

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

    public function nacionalidades(Request $request){
        $sexo = $request->get('sexo', 'femenino'); 
        $nacionalidades = Nacionalidad::where('sexo', $sexo)->get(); 
        return response()->json(['message' => 'lista de nacionalidades', 'nacionalidades' => $nacionalidades]);
    }

    public function estados_civiles(Request $request){
        $sexo = $request->get('sexo', 'femenino'); 
        $estados_civiles = EstadoCivil::where('sexo', $sexo)->get(); 
        return response()->json(['message' => 'lista de estados civiles', 'estados_civiles' => $estados_civiles]);
    }

    public function buscarDocumento($idRedaccion)
    {
        $documento = UserRedactaDocumento::find($idRedaccion);

        // Validar que el documento exista
        if (!$documento || !$documento->final_base64) {
            return response()->json(['error' => 'Documento no encontrado o no disponible para descarga'], 404);
        }

        // Decodificar base64 a binario
        $fileContent = base64_decode($documento->final_base64);

        // Crear una respuesta para la descarga del archivo
        return response($fileContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="documento_' . $idRedaccion . '.pdf"');
    }
}
