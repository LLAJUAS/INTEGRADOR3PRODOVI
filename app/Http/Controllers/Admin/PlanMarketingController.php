<?php

namespace App\Http\Controllers\Admin; // <-- NAMESPACE ACTUALIZADO

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\PlanMarketing;
use App\Models\Suscripcion;
use App\Services\MarketingPlanService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class PlanMarketingController extends Controller
{
    protected $marketingPlanService;

    /**
     * Inyecta el servicio de planes de marketing.
     *
     * @param MarketingPlanService $marketingPlanService
     */
    public function __construct(MarketingPlanService $marketingPlanService)
    {
        $this->marketingPlanService = $marketingPlanService;
    }

    /**
     * Muestra el formulario para crear un nuevo plan de marketing para una empresa.
     *
     * @param Empresa $empresa
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Empresa $empresa)
    {
        // Verificar si la empresa tiene un resumen ejecutivo
        if (!$empresa->resumen_ejecutivo) {
            return back()->with('error', 'No se puede crear un plan de marketing sin un resumen ejecutivo generado primero.');
        }

        // Buscar una suscripción activa para esta empresa
        $suscripcionActiva = $empresa->usuario->suscripciones()->where('estado', 'activa')->first();

        if (!$suscripcionActiva) {
            return back()->with('error', 'El usuario no tiene una suscripción activa para generar un plan de marketing.');
        }

        // Verificar si ya existe un plan para esta suscripción
        // Usamos el método has() para verificar la existencia de una relación sin cargarla
        if ($suscripcionActiva->planMarketing()->exists()) {
            return back()->with('error', 'Ya existe un plan de marketing para la suscripción actual.');
        }

        // Obtener las características del plan asociado a la suscripción
        $caracteristicasPlan = $suscripcionActiva->plan->caracteristicas;

        return view('administrador.empresas.crear-plan', compact('empresa', 'suscripcionActiva', 'caracteristicasPlan'));
    }

    /**
     * Almacena un nuevo plan de marketing en la base de datos.
     *
     * @param Request $request
     * @param Empresa $empresa
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Empresa $empresa)
    {
        $request->validate([
            'suscripcion_id' => 'required|exists:suscripciones,id',
        ]);

        $suscripcion = Suscripcion::findOrFail($request->suscripcion_id);

        // Doble verificación de seguridad
        if ($suscripcion->usuario_id !== $empresa->usuario_id || $suscripcion->estado !== 'activa') {
            return back()->with('error', 'Suscripción no válida para esta empresa.');
        }

        if ($suscripcion->planMarketing()->exists()) {
            return back()->with('error', 'Ya existe un plan para esta suscripción.');
        }

        // Obtener las características del plan para el prompt
        $caracteristicas = $suscripcion->plan->caracteristicas->map(function ($caracteristica) {
            return [
                'nombre' => $caracteristica->nombre,
                'frecuencia' => $caracteristica->pivot->frecuencia,
            ];
        })->toArray();

        $contenidoPlan = $this->marketingPlanService->generateMarketingPlan(
            $empresa->nombre_empresa,
            $empresa->resumen_ejecutivo,
            $caracteristicas
        );

        if (!$contenidoPlan || str_contains($contenidoPlan, 'Hubo un error')) {
            return back()->with('error', 'No se pudo generar el contenido del plan de marketing. Inténtelo de nuevo.');
        }

        $planMarketing = PlanMarketing::create([
            'empresa_id' => $empresa->id,
            'suscripcion_id' => $suscripcion->id,
            'contenido' => $contenidoPlan,
            'estado' => 'activo',
        ]);

        return redirect()->route('administrador.empresas.show', $empresa->id)
            ->with('success', '¡Plan de marketing creado y guardado con éxito!');
    }
    
    /**
     * Muestra un plan de marketing específico.
     *
     * @param PlanMarketing $planMarketing
     * @return \Illuminate\View\View
     */
    public function show(PlanMarketing $planMarketing)
    {
        // Cargar relaciones para la vista
        $planMarketing->load(['empresa', 'suscripcion.plan']);
        
        return view('administrador.planes-marketing.show', compact('planMarketing'));
    }
     public function edit(PlanMarketing $planMarketing)
    {
        // Cargar las relaciones para mostrar información en la vista
        $planMarketing->load(['empresa', 'suscripcion.plan']);
        
        return view('administrador.planes-marketing.edit', compact('planMarketing'));
    }
     public function update(Request $request, PlanMarketing $planMarketing)
    {
        $request->validate([
            'contenido' => 'required|string',
        ]);

        $planMarketing->contenido = $request->input('contenido');
        $planMarketing->save();

        return redirect()->route('administrador.empresas.planes-marketing.show', $planMarketing->id)
            ->with('success', '¡Plan de marketing actualizado con éxito!');
    }
     public function downloadPDF(PlanMarketing $planMarketing)
    {
        // Cargar las relaciones necesarias
        $planMarketing->load(['empresa', 'suscripcion.plan']);

        // Parsear el contenido para la vista PDF (usamos la misma lógica que en la vista show)
        $contenidoCompleto = $planMarketing->contenido;
        $partes = preg_split('/^##\s+(.+)$/m', $contenidoCompleto, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        $seccionesParseadas = [];
        for ($i = 0; $i < count($partes); $i += 2) {
            if (isset($partes[$i+1])) {
                $titulo = trim($partes[$i]);
                $contenido = trim($partes[$i+1]);
                $seccionesParseadas[] = ['titulo' => $titulo, 'contenido' => $contenido];
            }
        }

        // Generar el PDF a partir de una vista
        $pdf = Pdf::loadView('administrador.planes-marketing.pdf', compact('planMarketing', 'seccionesParseadas'))
            ->setPaper('a4', 'portrait')
            ->setOption('defaultFont', 'sans-serif');

        // Descargar el PDF con un nombre de archivo específico
        return $pdf->download('plan-marketing-' . $planMarketing->empresa->nombre_empresa . '.pdf');
    }
     public function downloadWord(PlanMarketing $planMarketing)
    {
        // Cargar las relaciones necesarias
        $planMarketing->load(['empresa', 'suscripcion.plan']);

        // Crear un nuevo objeto PhpWord
        $phpWord = new PhpWord();
        
        // Añadir una sección
        $section = $phpWord->addSection();
        
        // Añadir el título y la información de la empresa
        $section->addTitle('Plan de Marketing', 1);
        $section->addTextBreak(2);
        $section->addText('Empresa: ' . $planMarketing->empresa->nombre_empresa);
        $section->addText('Plan de Suscripción: ' . $planMarketing->suscripcion->plan->nombre);
        $section->addText('Fecha de generación: ' . $planMarketing->created_at->format('d/m/Y H:i'));
        $section->addTextBreak(2);

        // Añadir el contenido del plan (texto plano para simplicidad)
        $contenidoLimpio = strip_tags($planMarketing->contenido);
        $section->addText($contenidoLimpio);

        // Crear el escritor de archivos
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

        // Devolver la respuesta para descargar el archivo
        return response()->stream(
            function () use ($objWriter) {
                echo $objWriter->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'Content-Disposition' => 'attachment; filename="plan-marketing-' . $planMarketing->empresa->nombre_empresa . '.docx"',
            ]
        );
    }

    /**
     * Elimina el plan de marketing de la empresa.
     */
    public function destroy(PlanMarketing $planMarketing)
    {
        // Eliminar el plan de marketing
        $planMarketing->delete();

        return redirect()->route('administrador.empresas.show', $planMarketing->empresa_id)
            ->with('success', '¡Plan de marketing eliminado con éxito!');
    }
}