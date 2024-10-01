<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        // Recibir datos desde el request
        $comuna = $request->input('comuna');
        // otros datos...

        // Generar el contenido del PDF
        $pdf = FacadePdf::loadView('lex.documento', compact('comuna'));

        // Guardar el PDF en public/private/lex
        $filename = 'documento_' . time() . '.pdf';
        Storage::put('public/lex/' . $filename, $pdf->output());

        // Devolver el nombre del archivo generado
        return response()->json(['filename' => $filename]);
    }
}
