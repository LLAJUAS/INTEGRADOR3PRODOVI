<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pago;
use App\Models\Suscripcion;
use App\Models\ComprobantePago;
use App\Models\Plan;
use App\Models\User;
use App\Exports\PagosExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\PDF;

class PagoAdminController extends Controller
{
    // Pagos realizados (todos los completados)

    public function pagosRealizados(Request $request)
    {
        $search = $request->input('search');
        $planId = $request->input('plan');

        // Obtener todos los planes para el select
        $planes = Plan::all();

        $query = Pago::with(['usuario', 'plan', 'suscripcion'])
            ->where('estado', 'completado')
            ->orderBy('fecha_pago', 'desc');

        // Filtro por nombre de usuario
        if ($search) {
            $query->whereHas('usuario', function ($userQuery) use ($search) {
                $userQuery->where('name', 'like', "%{$search}%");
            });
        }

        // Filtro por plan seleccionado
        if ($planId) {
            $query->whereHas('plan', function ($planQuery) use ($planId) {
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
            $query->where(function ($q) use ($search) {
                $q->whereHas('usuario', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })
                    ->orWhereHas('codigoPago', function ($codigoQuery) use ($search) {
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
            ->whereHas('suscripcion', function ($query) {
                $query->whereIn('estado', ['finalizada', 'cancelada']);
            })
            ->where('estado', 'completado')
            ->orderBy('fecha_pago', 'desc');

        // Aplicar filtro de búsqueda si existe
        if ($search) {
            $query->whereHas('usuario', function ($userQuery) use ($search) {
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
        DB::beginTransaction();
        try {
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

            ComprobantePago::create([
                'pago_id' => $pago->id,
            ]);

            DB::commit();

            return back()->with('success', 'Pago aprobado y comprobante generado correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al aprobar pago físico: ' . $e->getMessage());

            return back()->with('error', 'Ocurrió un error al aprobar el pago. Por favor, inténtelo de nuevo.');
        }
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

        // Obtener todos los planes para el filtro
        $planes = Plan::where('activo', true)->get();

        return view('administrador.pagos.index', compact('countActivos', 'countPendientes', 'countFinalizados', 'planes'));
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

    /**
     * Obtiene los pagos filtrados para reportes (método reutilizable)
     */
    private function getFilteredPaymentsForReport(Request $request)
    {
        $filters = [
            'clientName' => $request->input('clientName'),
            'plan' => $request->input('plan'),
            'subscriptionStatus' => $request->input('subscriptionStatus'),
            'startDate' => $request->input('startDate'),
            'endDate' => $request->input('endDate')
        ];

        $query = Pago::with(['usuario', 'plan', 'suscripcion']);

        if ($filters['clientName']) {
            $query->whereHas('usuario', function ($userQuery) use ($filters) {
                $userQuery->where('name', 'like', "%{$filters['clientName']}%");
            });
        }

        if ($filters['plan']) {
            $query->where('plan_id', $filters['plan']);
        }

        if ($filters['subscriptionStatus']) {
            switch ($filters['subscriptionStatus']) {
                case 'active':
                    $query->whereHas('suscripcion', function ($susQuery) {
                        $susQuery->where('estado', 'activa');
                    });
                    break;
                case 'completed':
                    $query->whereHas('suscripcion', function ($susQuery) {
                        $susQuery->where('estado', 'finalizada');
                    });
                    break;
                case 'cancelled':
                    $query->whereHas('suscripcion', function ($susQuery) {
                        $susQuery->where('estado', 'cancelada');
                    });
                    break;
            }
        }

        if ($filters['startDate']) {
            $query->whereHas('suscripcion', function ($susQuery) use ($filters) {
                $susQuery->whereDate('fecha_inicio', '>=', $filters['startDate']);
            });
        }

        if ($filters['endDate']) {
            $query->whereHas('suscripcion', function ($susQuery) use ($filters) {
                $susQuery->whereDate('fecha_fin', '<=', $filters['endDate']);
            });
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    /**
     * Buscar pagos con métricas y datos para gráficos
     */
    public function buscarPagos(Request $request)
    {
        try {
            $clientName = $request->input('clientName');
            $planId = $request->input('plan');
            $subscriptionStatus = $request->input('subscriptionStatus');
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');
            $page = $request->input('page', 1);
            $perPage = 10;

            $query = Pago::with(['usuario', 'plan', 'suscripcion']);

            if ($clientName) {
                $query->whereHas('usuario', function ($userQuery) use ($clientName) {
                    $userQuery->where('name', 'like', "%{$clientName}%");
                });
            }

            if ($planId) {
                $query->where('plan_id', $planId);
            }

            if ($subscriptionStatus) {
                switch ($subscriptionStatus) {
                    case 'active':
                        $query->whereHas('suscripcion', function ($susQuery) {
                            $susQuery->where('estado', 'activa');
                        });
                        break;
                    case 'completed':
                        $query->whereHas('suscripcion', function ($susQuery) {
                            $susQuery->where('estado', 'finalizada');
                        });
                        break;
                    case 'cancelled':
                        $query->whereHas('suscripcion', function ($susQuery) {
                            $susQuery->where('estado', 'cancelada');
                        });
                        break;
                }
            }

            if ($startDate) {
                $query->whereHas('suscripcion', function ($susQuery) use ($startDate) {
                    $susQuery->whereDate('fecha_inicio', '>=', $startDate);
                });
            }

            if ($endDate) {
                $query->whereHas('suscripcion', function ($susQuery) use ($endDate) {
                    $susQuery->whereDate('fecha_fin', '<=', $endDate);
                });
            }

            $allPagos = $query->get();

            // --- CÁLCULO DE MÉTRICAS ---
            $totalIncome = $allPagos->where('estado', 'completado')->sum('monto');
            $moneda = $allPagos->first()->moneda ?? 'BS';

            $planCounts = $allPagos->map(function ($pago) {
                return $pago->plan ? $pago->plan->nombre : 'N/A';
            })->countBy()->sortDesc();
            $mostHiredPlan = $planCounts->isNotEmpty() ? $planCounts->keys()->first() : 'N/A';
            $mostHiredPlanCount = $planCounts->isNotEmpty() ? $planCounts->first() : 0;

            $statusDistribution = $allPagos->map(function ($pago) {
                return $pago->suscripcion ? $pago->suscripcion->estado : 'N/A';
            })->countBy()->all();

            $planDistribution = $allPagos->map(function ($pago) {
                return $pago->plan ? $pago->plan->nombre : 'N/A';
            })->countBy()->all();

            $monthlyIncome = $allPagos->where('estado', 'completado')
                ->groupBy(function ($pago) {
                    return $pago->fecha_pago ? $pago->fecha_pago->format('Y-m') : null;
                })
                ->map(function ($monthPayments) {
                    return $monthPayments->sum('monto');
                })
                ->sortKeys()
                ->all();
            // --- FIN DE MÉTRICAS ---

            $total = $allPagos->count();
            $totalPages = ceil($total / $perPage);
            $offset = ($page - 1) * $perPage;

            $paginatedResults = $allPagos->slice($offset, $perPage)->values();

            $results = $paginatedResults->map(function ($pago) {
                return [
                    'id' => $pago->id,
                    'usuario' => $pago->usuario ? $pago->usuario->name : 'N/A',
                    'plan' => $pago->plan ? $pago->plan->nombre : 'N/A',
                    'monto' => $pago->monto . ' ' . $pago->moneda,
                    'fecha_inicio' => $pago->suscripcion ? $pago->suscripcion->fecha_inicio->format('d/m/Y') : 'N/A',
                    'fecha_fin' => $pago->suscripcion ? $pago->suscripcion->fecha_fin->format('d/m/Y') : 'N/A',
                    'estado' => $pago->suscripcion ? $pago->suscripcion->estado : 'N/A',
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $results,
                'summary' => [
                    'total_income' => number_format($totalIncome, 2, ',', '.') . ' ' . $moneda,
                    'most_hired_plan' => $mostHiredPlan,
                    'most_hired_plan_count' => $mostHiredPlanCount,
                    'total_records' => $total,
                ],
                'charts' => [
                    'status_distribution' => $statusDistribution,
                    'plan_distribution' => $planDistribution,
                    'monthly_income' => $monthlyIncome,
                ],
                'pagination' => [
                    'current_page' => (int) $page,
                    'total_pages' => $totalPages,
                    'total' => $total,
                    'per_page' => $perPage
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Error en buscarPagos: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la búsqueda: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Descargar PDF con resumen
     */
    public function descargarPDF(Request $request)
    {
        try {
            $pagos = $this->getFilteredPaymentsForReport($request);
            $filters = $request->all();

            $totalIncome = $pagos->where('estado', 'completado')->sum('monto');
            $moneda = $pagos->first()->moneda ?? 'BS';
            $planCounts = $pagos->map(function ($pago) {
                return $pago->plan ? $pago->plan->nombre : 'N/A';
            })->countBy()->sortDesc();
            $mostHiredPlan = $planCounts->isNotEmpty() ? $planCounts->keys()->first() : 'N/A';
            $mostHiredPlanCount = $planCounts->isNotEmpty() ? $planCounts->first() : 0;

            $summary = [
                'total_income' => number_format($totalIncome, 2, ',', '.') . ' ' . $moneda,
                'most_hired_plan' => $mostHiredPlan,
                'most_hired_plan_count' => $mostHiredPlanCount,
                'total_records' => $pagos->count(),
            ];

            $pdf = PDF::loadView('administrador.pagos.pdf', compact('pagos', 'filters', 'summary'));
            return $pdf->download('reporte_pagos_' . date('d_m_Y_H_i_s') . '.pdf');

        } catch (\Exception $e) {
            \Log::error('Error al generar PDF: ' . $e->getMessage());
            return back()->with('error', 'Error al generar el PDF: ' . $e->getMessage());
        }
    }

    /**
     * Descargar Excel con resumen
     */
    public function descargarExcel(Request $request)
    {
        try {
            $pagos = $this->getFilteredPaymentsForReport($request);
            $filters = $request->all();

            $totalIncome = $pagos->where('estado', 'completado')->sum('monto');
            $moneda = $pagos->first()->moneda ?? 'BS';
            $planCounts = $pagos->map(function ($pago) {
                return $pago->plan ? $pago->plan->nombre : 'N/A';
            })->countBy()->sortDesc();
            $mostHiredPlan = $planCounts->isNotEmpty() ? $planCounts->keys()->first() : 'N/A';
            $mostHiredPlanCount = $planCounts->isNotEmpty() ? $planCounts->first() : 0;

            $summary = [
                'total_income' => number_format($totalIncome, 2, ',', '.') . ' ' . $moneda,
                'most_hired_plan' => $mostHiredPlan,
                'most_hired_plan_count' => $mostHiredPlanCount,
                'total_records' => $pagos->count(),
            ];

            return Excel::download(new PagosExport($pagos, $filters, $summary), 'reporte_pagos_' . date('d_m_Y_H_i_s') . '.xlsx');

        } catch (\Exception $e) {
            \Log::error('Error al generar Excel: ' . $e->getMessage());
            return back()->with('error', 'Error al generar el Excel: ' . $e->getMessage());
        }
    }


    /**
     * Obtiene los pagos del mes actual para reportes
     */
    private function getMonthlyPaymentsForReport()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        return Pago::with(['usuario', 'plan', 'suscripcion'])
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Descargar PDF mensual
     */
    public function descargarPDFMensual()
    {
        try {
            $pagos = $this->getMonthlyPaymentsForReport();
            $filters = ['monthly_report' => true];

            // Calcular métricas
            $totalIncome = $pagos->where('estado', 'completado')->sum('monto');
            $moneda = $pagos->first()->moneda ?? 'BS';
            $planCounts = $pagos->map(function ($pago) {
                return $pago->plan ? $pago->plan->nombre : 'N/A';
            })->countBy()->sortDesc();
            $mostHiredPlan = $planCounts->isNotEmpty() ? $planCounts->keys()->first() : 'N/A';
            $mostHiredPlanCount = $planCounts->isNotEmpty() ? $planCounts->first() : 0;

            $summary = [
                'total_income' => number_format($totalIncome, 2, ',', '.') . ' ' . $moneda,
                'most_hired_plan' => $mostHiredPlan,
                'most_hired_plan_count' => $mostHiredPlanCount,
                'total_records' => $pagos->count(),
                'monthly_report' => Carbon::now()->format('F Y'),
            ];

            $pdf = PDF::loadView('administrador.pagos.pdf', compact('pagos', 'filters', 'summary'));
            return $pdf->download('reporte_mensual_pagos_' . date('d_m_Y_H_i_s') . '.pdf');

        } catch (\Exception $e) {
            \Log::error('Error al generar PDF mensual: ' . $e->getMessage());
            return back()->with('error', 'Error al generar el PDF mensual: ' . $e->getMessage());
        }
    }

    /**
     * Descargar Excel mensual
     */
    public function descargarExcelMensual()
    {
        try {
            $pagos = $this->getMonthlyPaymentsForReport();
            $filters = ['monthly_report' => true];

            // Calcular métricas
            $totalIncome = $pagos->where('estado', 'completado')->sum('monto');
            $moneda = $pagos->first()->moneda ?? 'BS';
            $planCounts = $pagos->map(function ($pago) {
                return $pago->plan ? $pago->plan->nombre : 'N/A';
            })->countBy()->sortDesc();
            $mostHiredPlan = $planCounts->isNotEmpty() ? $planCounts->keys()->first() : 'N/A';
            $mostHiredPlanCount = $planCounts->isNotEmpty() ? $planCounts->first() : 0;

            $summary = [
                'total_income' => number_format($totalIncome, 2, ',', '.') . ' ' . $moneda,
                'most_hired_plan' => $mostHiredPlan,
                'most_hired_plan_count' => $mostHiredPlanCount,
                'total_records' => $pagos->count(),
                'monthly_report' => Carbon::now()->format('F Y'),
            ];

            return Excel::download(new PagosExport($pagos, $filters, $summary), 'reporte_mensual_pagos_' . date('d_m_Y_H_i_s') . '.xlsx');

        } catch (\Exception $e) {
            \Log::error('Error al generar Excel mensual: ' . $e->getMessage());
            return back()->with('error', 'Error al generar el Excel mensual: ' . $e->getMessage());
        }
    }

}