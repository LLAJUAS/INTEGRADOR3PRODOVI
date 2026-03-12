<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Pago;
use App\Models\Suscripcion;
use App\Models\CodigoPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\ComprobantePago;

class PagoClienteController extends Controller
{
    public function show($plan)
    {
        $planSlug = strtolower($plan);
        $planNombre = str_replace('-', ' ', $planSlug);
        $planModel = Plan::where('nombre', $planNombre)->firstOrFail();

        return view('clientes.pago', [
            'plan' => $planSlug,
            'planPrecio' => $planModel->precio,
            'planMoneda' => $planModel->moneda,
            'planPeriodo' => $planModel->periodo,
            'planNombre' => $planModel->nombre
        ]);
    }

    public function procesarPago(Request $request, $plan)
    {
        $request->validate([
            'metodo_pago' => 'required|in:qr,fisico'
        ]);

        $planNombre = str_replace('-', ' ', $plan);
        $planModel = Plan::where('nombre', $planNombre)->firstOrFail();
        $usuario = Auth::user();

        DB::beginTransaction();

        try {
            // Obtener fecha y hora exacta actual
            $fechaInicio = Carbon::now();

            // Calcular fecha fin (siempre 1 mes después de la fecha inicio)
            $fechaFin = $fechaInicio->copy()->addMonth();

            // 1. Crear la suscripción con fechas exactas
            $suscripcion = Suscripcion::create([
                'usuario_id' => $usuario->id,
                'plan_id' => $planModel->id,
                'estado' => 'pendiente',
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
                'metodo_pago' => $request->metodo_pago
            ]);

            // 2. Procesar según el método de pago
            if ($request->metodo_pago === 'qr') {
                // Pago QR (fake)
                $pago = Pago::create([
                    'usuario_id' => $usuario->id,
                    'suscripcion_id' => $suscripcion->id,
                    'plan_id' => $planModel->id,
                    'monto' => $planModel->precio,
                    'moneda' => $planModel->moneda,
                    'metodo' => 'qr',
                    'estado' => 'completado',
                    'fecha_pago' => $fechaInicio
                ]);

                // Actualizar estado de la suscripción
                $suscripcion->update(['estado' => 'activa']);

                // *** NUEVO: Crear el comprobante inmediatamente ***
                ComprobantePago::create([
                    'pago_id' => $pago->id,
                ]);

                DB::commit();

                return response()->json([
                    'success' => true,
                    'metodo' => 'qr',
                    'message' => 'Pago procesado exitosamente'
                ]);

            } else {
                // Pago físico
                $codigo = CodigoPago::generarCodigoUnico();

                // Crear el pago pendiente
                $pago = Pago::create([
                    'usuario_id' => $usuario->id,
                    'suscripcion_id' => $suscripcion->id,
                    'plan_id' => $planModel->id,
                    'codigo_pago' => $codigo,
                    'monto' => $planModel->precio,
                    'moneda' => $planModel->moneda,
                    'metodo' => 'fisico',
                    'estado' => 'pendiente'
                ]);

                // Crear y asociar el código de pago
                CodigoPago::create([
                    'codigo' => $codigo,
                    'usuario_id' => $usuario->id,
                    'pago_id' => $pago->id
                ]);

                DB::commit();

                return response()->json([
                    'success' => true,
                    'metodo' => 'fisico',
                    'codigo' => $codigo,
                    'message' => 'Código de pago generado'
                ]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al procesar pago:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'usuario' => $usuario->id ?? null,
                'plan' => $plan
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al procesar el pago: ' . $e->getMessage()
            ], 500);
        }
    }

    // app/Http/Controllers/Cliente/PagoClienteController.php

    public function estadoPago()
    {
        $user = Auth::user();

        // Obtener la última suscripción pendiente del usuario
        $suscripcionPendiente = Suscripcion::with(['pagos.codigoPago', 'plan'])
            ->where('usuario_id', $user->id)
            ->where('estado', 'pendiente')
            ->latest()
            ->first();

        if (!$suscripcionPendiente) {
            return redirect()->route('clientes.home')->with('error', 'No tienes pagos pendientes');
        }

        return view('clientes.estado-pago', [
            'suscripcion' => $suscripcionPendiente,
            'codigoPago' => $suscripcionPendiente->pagos->first()->codigoPago ?? null
        ]);
    }

    /**
     * Muestra el historial de pagos del usuario
     */
    public function historialPagos()
    {
        $user = Auth::user();

        // Obtener todos los pagos del usuario con sus relaciones, incluyendo 'comprobantePago'
        $pagos = Pago::with(['plan', 'suscripcion', 'comprobantePago'])
            ->where('usuario_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('clientes.historialpagos', compact('pagos'));
    }
    /**
     * Muestra el comprobante de pago en formato HTML (para el modal)
     */
    public function verComprobante($id)
    {
        $user = Auth::user();
        // Carga el pago y su relación con 'comprobantePago'
        $pago = Pago::with(['plan', 'suscripcion', 'usuario', 'comprobantePago'])
            ->where('id', $id)
            ->where('usuario_id', $user->id)
            ->firstOrFail();

        // Generar el HTML del comprobante
        $html = view('clientes.comprobante-pago', compact('pago'))->render();

        return response()->json(['html' => $html]);
    }

    /**
     * Descarga el comprobante de pago en PDF.
     * El comprobante ya debe existir.
     */
    public function descargarComprobante($id)
    {
        $user = Auth::user();
        $pago = Pago::with(['plan', 'suscripcion', 'usuario', 'comprobantePago'])
            ->where('id', $id)
            ->where('usuario_id', $user->id)
            ->firstOrFail();

        // 1. Obtener el comprobante. Debe existir.
        $comprobante = $pago->comprobantePago;
        if (!$comprobante) {
            // Esto no debería pasar si la lógica es correcta, pero es una buena práctica.
            abort(404, 'Comprobante no encontrado para este pago.');
        }

        // 2. Definir la ruta relativa del archivo
        $rutaRelativa = 'comprobantes_pago/comprobante-' . $comprobante->numero_formateado . '.pdf';

        // 3. Verificar si el archivo físico existe. Si no, regenerarlo por seguridad.
        if (!\Storage::disk('public')->exists($rutaRelativa)) {
            $pdf = PDF::loadView('clientes.comprobante-pago-pdf', compact('pago', 'comprobante'));
            \Storage::disk('public')->put($rutaRelativa, $pdf->output());
        }

        // 4. Enviar el archivo al usuario para su descarga.
        $rutaCompletaParaDescarga = \Storage::disk('public')->path($rutaRelativa);
        $nombreDescarga = 'comprobante-' . $comprobante->numero_formateado . '.pdf';

        return response()->download($rutaCompletaParaDescarga, $nombreDescarga);
    }
}