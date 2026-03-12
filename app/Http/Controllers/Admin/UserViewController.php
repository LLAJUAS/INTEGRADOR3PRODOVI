<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Suscripcion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserViewController extends Controller
{
    /**
     * Muestra los detalles de un usuario específico
     */
    public function show($id)
    {
        // Cargar el usuario con sus relaciones.
        // Usamos 'with' para optimizar la consulta y evitar N+1 problems.
        $user = User::with(['roles', 'suscripciones.plan.caracteristicas', 'empresas'])->findOrFail($id);
        
        // Obtener la suscripción activa si existe
        $suscripcionActiva = $user->suscripciones()
            ->with('plan.caracteristicas') // Aseguramos que las características se carguen
            ->where('estado', 'activa')
            ->where('fecha_fin', '>', now())
            ->first();

        // Calcular días restantes si hay suscripción activa
        $diasRestantes = 0;
        $porcentajeRestante = 0;

        if ($suscripcionActiva) {
            $fechaFin = Carbon::parse($suscripcionActiva->fecha_fin);
            $diasRestantes = now()->diffInDays($fechaFin, false);
            $diasTotales = $suscripcionActiva->fecha_inicio->diffInDays($fechaFin);
            $porcentajeRestante = $diasRestantes > 0 ? round(($diasRestantes / $diasTotales) * 100) : 0;
        }

        // Obtener todas las empresas del usuario
        $empresas = $user->empresas;

        return view('administrador.usuarios.show', compact(
            'user',
            'suscripcionActiva',
            'diasRestantes',
            'porcentajeRestante',
            'empresas'
        ));
    }
}