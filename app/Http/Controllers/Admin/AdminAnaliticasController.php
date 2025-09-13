<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminAnaliticasController extends Controller
{
    public function index()
    {
        return view('administrador.analiticas.analiticas');
    }

    public function loadView(Request $request)
    {
        $view = $request->input('view');
        
        // Validar que la vista solicitada existe
        $validViews = ['last7days', 'last30days', 'thisyear'];
        
        if (!in_array($view, $validViews)) {
            $view = 'last30days';
        }
        
        return view("administrador.analiticas.partials.{$view}");
    }
public function generarReporteCampanas()
{
    $data = [
        'fecha_generacion' => now()->format('d/m/Y H:i'),
        // Puedes agregar más datos dinámicos aquí si los necesitas
    ];

    $pdf = Pdf::loadView('pdf.admincampañas', $data);
    $pdf->setPaper('A4', 'portrait');
    $pdf->setOption('isHtml5ParserEnabled', true);
    $pdf->setOption('isRemoteEnabled', true);

    return $pdf->download('reporte_campanas.pdf');
}

}