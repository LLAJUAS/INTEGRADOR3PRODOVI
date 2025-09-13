<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ClienteAnaliticasController extends Controller
{
    public function index()
    {
        return view('clientes.analiticas');
    }

    public function loadView(Request $request)
    {
        $view = $request->input('view');
        
        // Validar que la vista solicitada existe
        $validViews = ['last7days', 'last30days', 'thisyear'];
        
        if (!in_array($view, $validViews)) {
            $view = 'last30days';
        }
        
        return view("clientes.analiticas.partials.{$view}");
    }

   public function exportarPDF(Request $request)
{
    $periodo = $request->input('periodo', '30dias');

    $data = [
        'fecha_generacion' => now()->format('d/m/Y H:i'),
        'periodo' => $periodo === '7dias' ? 'Últimos 7 días' : 'Últimos 30 días',
    ];

    $view = $periodo === '7dias' ? 'pdf.analiticas_7dias' : 'pdf.analiticas_30dias';

    $pdf = Pdf::loadView($view, $data);
    $pdf->setPaper('A4', 'portrait');
    $pdf->setOption('isHtml5ParserEnabled', true);
    $pdf->setOption('isRemoteEnabled', true);

    $nombreArchivo = $periodo === '7dias' ? 'informe_analiticas_7dias.pdf' : 'informe_analiticas_30dias.pdf';

    return $pdf->download($nombreArchivo);
}

}