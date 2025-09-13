<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tarea;
use Illuminate\Http\Request;

class PublicacionController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el ID de la tarea desde la URL (si viene de vertareassubidas.blade.php)
        $tareaId = $request->input('tarea_id');
        
        // Si no hay tarea_id en la solicitud, redirigir o manejar el caso
        if (!$tareaId) {
            return redirect()->back()->with('error', 'No se especificó una tarea para publicar');
        }
        
        // Obtener la tarea con sus archivos aprobados
        $tarea = Tarea::with(['archivos' => function($query) {
            $query->where('estado', 'aprobado');
        }])->findOrFail($tareaId);
        
        return view('administrador.publicacion.publicar', compact('tarea'));
    }
}