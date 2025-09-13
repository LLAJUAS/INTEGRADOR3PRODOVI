<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pago;
use App\Models\Suscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PagoAdminController extends Controller
{
    // Pagos realizados (todos los completados)
    // Pagos realizados (todos los completados)
// Pagos realizados (todos los completados)
public function pagosRealizados(Request $request)
{
    $search = $request->input('search');
    $planId = $request->input('plan');
    
    // Obtener todos los planes para el select
    $planes = \App\Models\Plan::all();
    
    $query = Pago::with(['usuario', 'plan', 'suscripcion'])
        ->where('estado', 'completado')
        ->orderBy('fecha_pago', 'desc');
    
    // Filtro por nombre de usuario
    if ($search) {
        $query->whereHas('usuario', function($userQuery) use ($search) {
            $userQuery->where('name', 'like', "%{$search}%");
        });
    }
    
    // Filtro por plan seleccionado
    if ($planId) {
        $query->whereHas('plan', function($planQuery) use ($planId) {
            $planQuery->where('id', $planId);
        });
    }
    
    $pagos = $query->paginate(10)->through(function ($pago) {
        return [
            'id' => $pago->id,
            'usuario' => $pago->usuario->name,
            'tipo_pago' => $pago->metodo,
            'plan' => $pago->plan->nombre,
            'monto' => $pago->monto . ' ' . $pago->moneda,
            'fecha_inicio' => $pago->suscripcion->fecha_inicio->format('d/m/Y'),
            'fecha_fin' => $pago->suscripcion->fecha_fin->format('d/m/Y'),
            'estado' => $pago->suscripcion->estado,
        ];
    });

    // Si es una petición AJAX, devolver solo la tabla
    if ($request->ajax()) {
        return view('administrador.pagos._results', compact('pagos'))->render();
    }

    return view('administrador.pagos.realizados', compact('pagos', 'planes'));
}

    // Pagos pendientes físicos
   // Pagos pendientes físicos
public function pagosPendientesFisicos(Request $request)
{
    $search = $request->input('search');
    
    $query = Pago::with(['usuario', 'plan', 'codigoPago'])
        ->where('estado', 'pendiente')
        ->where('metodo', 'fisico')
        ->orderBy('created_at', 'desc');
    
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->whereHas('usuario', function($userQuery) use ($search) {
                $userQuery->where('name', 'like', "%{$search}%");
            })
            ->orWhereHas('codigoPago', function($codigoQuery) use ($search) {
                $codigoQuery->where('codigo', 'like', "%{$search}%");
            });
        });
    }
    
    $pagos = $query->paginate(10); // Paginación con 10 elementos por página
    
    return view('administrador.pagos.pendientes-fisicos', compact('pagos'));
}

    // Pagos finalizados sin renovación
public function pagosFinalizadosSinRenovacion(Request $request)
{
    // Actualizar cualquier suscripción vencida
    Suscripcion::where('estado', 'activa')
        ->where('fecha_fin', '<', now())
        ->update([
            'estado' => 'finalizada',
            'fecha_cancelacion' => now()
        ]);

    $search = $request->input('search');

    $query = Pago::with(['usuario', 'plan', 'suscripcion'])
        ->whereHas('suscripcion', function($query) {
            $query->whereIn('estado', ['finalizada', 'cancelada']);
        })
        ->where('estado', 'completado')
        ->orderBy('fecha_pago', 'desc');

    // Aplicar filtro de búsqueda si existe
    if ($search) {
        $query->whereHas('usuario', function($userQuery) use ($search) {
            $userQuery->where('name', 'like', "%{$search}%");
        });
    }

    $pagos = $query->get()
        ->map(function ($pago) {
            return [
                'id' => $pago->id,
                'usuario' => $pago->usuario->name,
                'tipo_pago' => $pago->metodo,
                'plan' => $pago->plan->nombre,
                'monto' => $pago->monto . ' ' . $pago->moneda,
                'fecha_inicio' => $pago->suscripcion->fecha_inicio->format('d/m/Y'),
                'fecha_fin' => $pago->suscripcion->fecha_fin->format('d/m/Y'),
                'fecha_cancelacion' => $pago->suscripcion->fecha_cancelacion ? 
                    $pago->suscripcion->fecha_cancelacion->format('d/m/Y H:i') : null,
                'estado' => $pago->suscripcion->estado,
            ];
        });

    // Si es una petición AJAX, devolver solo la tabla
    if ($request->ajax()) {
        return view('administrador.pagos._finalizados_results', compact('pagos'))->render();
    }

    return view('administrador.pagos.finalizados-sin-renovacion', compact('pagos'));
}
    // Aprobar pago físico
    public function aprobarPagoFisico($pagoId)
    {
        $pago = Pago::findOrFail($pagoId);
        
        $pago->update([
            'estado' => 'completado',
            'aprobado_por' => optional(Auth::user())->id,
            'fecha_aprobacion' => now(),
            'fecha_pago' => now(),
        ]);

        $pago->suscripcion->update(['estado' => 'activa']);

        if ($pago->codigoPago) {
            $pago->codigoPago->update([
                'utilizado' => true,
                'fecha_utilizacion' => now()
            ]);
        }

        return back()->with('success', 'Pago aprobado correctamente');
    }

public function index()
{
    // Suscripciones activas (estado 'activa' y fecha_fin en el futuro)
    $countActivos = Suscripcion::where('estado', 'activa')
                        ->where('fecha_fin', '>', now())
                        ->count();

    // Pagos pendientes físicos
    $countPendientes = Pago::where('estado', 'pendiente')
                        ->where('metodo', 'fisico')
                        ->count();

    // Suscripciones finalizadas o canceladas
    $countFinalizados = Suscripcion::whereIn('estado', ['finalizada', 'cancelada'])
                        ->count();

    return view('administrador.pagos.index', compact('countActivos', 'countPendientes', 'countFinalizados'));
}
        
    public function cancelarSuscripcion($pagoId)
    {
        $pago = Pago::findOrFail($pagoId);
        
        $pago->suscripcion->update([
            'estado' => 'cancelada', // Cambiado a 'cancelada' para mejor tracking
            'fecha_fin' => now(),
            'fecha_cancelacion' => now()
        ]);

        return back()->with('success', 'Suscripción cancelada correctamente');
    }
    public function reactivarSuscripcion($pagoId)
    {
        $pago = Pago::findOrFail($pagoId);
        
        $pago->suscripcion->update([
            'estado' => 'activa',
            'fecha_inicio' => now(),
            'fecha_fin' => now()->addMonth(), // Un mes desde ahora
            'fecha_cancelacion' => null // Limpia la fecha de cancelación al reactivar
        ]);

        return back()->with('success', 'Suscripción reactivada correctamente');
    }
}