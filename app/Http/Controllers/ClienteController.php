<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Suscripcion;
use Carbon\Carbon;
class ClienteController extends Controller
{
// app/Http/Controllers/ClienteController.php

public function home()
{
    $user = Auth::user();
    $planes = Plan::all();
    
    $data = [
        'planes' => $planes,
        'tieneSuscripcionActiva' => false,
        'tieneSuscripcionPendiente' => false,
        'suscripcionPendiente' => null
    ];
    
    if ($user) {
        $data['tieneSuscripcionActiva'] = Suscripcion::where('usuario_id', $user->id)
            ->where('estado', 'activa')
            ->where('fecha_fin', '>', now())
            ->exists();
            
        $data['tieneSuscripcionPendiente'] = Suscripcion::where('usuario_id', $user->id)
            ->where('estado', 'pendiente')
            ->exists();
            
        if ($data['tieneSuscripcionPendiente']) {
            $data['suscripcionPendiente'] = Suscripcion::with(['pagos.codigoPago', 'plan'])
                ->where('usuario_id', $user->id)
                ->where('estado', 'pendiente')
                ->latest()
                ->first();
        }
    }
    
    return view('clientes.home', $data);
}
    public function dashboard()
    {
        $user = Auth::user();
        
        $suscripcionActiva = Suscripcion::with('plan')
            ->where('usuario_id', $user->id)
            ->where('estado', 'activa')
            ->where('fecha_fin', '>', now())
            ->firstOrFail();
            
        $fechaFin = Carbon::parse($suscripcionActiva->fecha_fin);
        $diasRestantes = now()->diffInDays($fechaFin, false);
        $diasTotales = $suscripcionActiva->fecha_inicio->diffInDays($fechaFin);
        $porcentajeRestante = $diasRestantes > 0 ? round(($diasRestantes / $diasTotales) * 100) : 0;
        
        return view('clientes.dashboard', compact(
            'user',
            'suscripcionActiva',
            'diasRestantes',
            'porcentajeRestante'
        ));
    }

    
    public function brief()
{
    return view('clientes.brief');
}

public function analiticas()
{
    return view('clientes.analiticas');
}
public function miCuenta()
{
    $user = Auth::user();
    
    // Obtener la suscripción activa si existe
    $suscripcionActiva = Suscripcion::with('plan')
        ->where('usuario_id', $user->id)
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
    
    return view('clientes.micuenta', compact(
        'user',
        'suscripcionActiva',
        'diasRestantes',
        'porcentajeRestante'
    ));
}

}