<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\RespuestaCuestionario;
use App\Models\TemaCuestionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CuestionarioController extends Controller
{
    /**
     * Mostrar formulario del cuestionario para una empresa
     */
    public function show($empresaId)
    {
        $empresa = Empresa::where('usuario_id', Auth::id())->findOrFail($empresaId);
        $temas = TemaCuestionario::with('preguntas')->orderBy('orden')->get();
        
        // Obtener respuestas existentes si las hay
        $respuestasExistentes = RespuestaCuestionario::where('empresa_id', $empresaId)
            ->pluck('respuesta', 'pregunta_id')
            ->toArray();
        
        return view('clientes.cuestionario.show', compact('empresa', 'temas', 'respuestasExistentes'));
    }

    /**
     * Guardar respuestas del cuestionario
     */
    public function store(Request $request, $empresaId)
    {
        $empresa = Empresa::where('usuario_id', Auth::id())->findOrFail($empresaId);
        
        // Validar que se hayan respondido todas las preguntas requeridas
        $preguntasRequeridas = DB::table('preguntas_cuestionario')
            ->where('requerido', true)
            ->pluck('id')
            ->toArray();
        
        foreach ($preguntasRequeridas as $preguntaId) {
            if (!$request->has("respuesta_{$preguntaId}") || empty($request->input("respuesta_{$preguntaId}"))) {
                return redirect()->back()
                    ->with('error', 'Por favor responde todas las preguntas requeridas.')
                    ->withInput();
            }
        }
        
        // Guardar respuestas
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'respuesta_') === 0) {
                $preguntaId = substr($key, 10); // Eliminar "respuesta_" del inicio
                
                RespuestaCuestionario::updateOrCreate(
                    [
                        'empresa_id' => $empresaId,
                        'pregunta_id' => $preguntaId,
                    ],
                    [
                        'respuesta' => $value,
                    ]
                );
            }
        }
        
        // Marcar el cuestionario como completado
        $empresa->cuestionario_completado = true;
        $empresa->save();
        
        return redirect()->route('empresas.show', $empresaId)
            ->with('success', 'Cuestionario completado correctamente.');
    }
}