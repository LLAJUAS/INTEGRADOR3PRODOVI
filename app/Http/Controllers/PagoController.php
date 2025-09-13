<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Suscripcion;
use App\Models\Pago;
use App\Models\CodigoPago;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    public function procesarPago(Request $request, $planSlug)
    {
        $plan = Plan::where('nombre', str_replace('-', ' ', $planSlug))->firstOrFail();
        $user = Auth::user();

        // Crear suscripción
        $suscripcion = Suscripcion::create([
            'usuario_id' => $user->id,
            'plan_id' => $plan->id,
            'estado' => 'pendiente',
            'fecha_inicio' => now(),
            'fecha_fin' => $this->calcularFechaFin($plan->periodo_facturacion),
            'metodo_pago' => $request->metodo_pago,
        ]);

        // Crear pago
        $pago = Pago::create([
            'usuario_id' => $user->id,
            'suscripcion_id' => $suscripcion->id,
            'plan_id' => $plan->id,
            'monto' => $plan->precio,
            'moneda' => $plan->moneda,
            'metodo' => $request->metodo_pago,
            'estado' => $request->metodo_pago == 'qr' ? 'completado' : 'pendiente',
            'fecha_pago' => $request->metodo_pago == 'qr' ? now() : null,
        ]);

        // Generar código para pago físico
        if ($request->metodo_pago == 'fisico') {
            $codigo = CodigoPago::generarCodigoUnico();
            
            CodigoPago::create([
                'codigo' => $codigo,
                'usuario_id' => $user->id,
                'pago_id' => $pago->id,
            ]);
        }

        // Activar suscripción si es pago QR
        if ($request->metodo_pago == 'qr') {
            $suscripcion->update(['estado' => 'activa']);
        }

        return redirect()->route('clientes.dashboard')->with('success', 'Pago procesado correctamente');
    }

    private function calcularFechaFin($periodo)
    {
        return match ($periodo) {
            'mes' => now()->addMonth(),
            'trimestre' => now()->addMonths(3),
            'semestre' => now()->addMonths(6),
            'año' => now()->addYear(),
            default => now()->addMonth(),
        };
    }
}