<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Plan;
use App\Models\Suscripcion;
use App\Models\Pago;
use App\Models\Campania;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener el número de campañas activas
        $activeCampaigns = Campania::where('estado', 'activa')->count();
        
        // Obtener el total de usuarios registrados
        $totalUsers = User::count();
        
        // Obtener el total de empresas
        $totalCompanies = Empresa::count();
        
        // Obtener ingresos mensuales
        $currentMonthIncome = Pago::whereMonth('fecha_pago', now()->month)
                                  ->whereYear('fecha_pago', now()->year)
                                  ->where('estado', 'completado')
                                  ->sum('monto');
        
        $previousMonthIncome = Pago::whereMonth('fecha_pago', now()->subMonth()->month)
                                   ->whereYear('fecha_pago', now()->subMonth()->year)
                                   ->where('estado', 'completado')
                                   ->sum('monto');

        // Calcular el porcentaje de cambio de forma segura
        $monthlyIncomeChangePercentage = null;
        if ($previousMonthIncome > 0) {
            $monthlyIncomeChangePercentage = (($currentMonthIncome - $previousMonthIncome) / $previousMonthIncome) * 100;
        }                        
        
        // Obtener el plan más contratado
        $mostContractedPlan = Plan::withCount('suscripciones')
                                  ->orderBy('suscripciones_count', 'desc')
                                  ->first();
        
        // Contar suscripciones por estado
        $countActivos = Pago::where('estado', 'completado')->count();
        $countPendientes = Pago::where('estado', 'pendiente')->count();
        $countFinalizados = Pago::where('estado', 'rechazado')->count();
        
        // Obtener datos para el gráfico mensual (últimos 6 meses)
        $monthlyIncome = Pago::select(
                                DB::raw('MONTH(fecha_pago) as month'),
                                DB::raw('YEAR(fecha_pago) as year'),
                                DB::raw('SUM(monto) as total')
                            )
                            ->where('estado', 'completado')
                            ->whereNotNull('fecha_pago')
                            ->where('fecha_pago', '>=', now()->subMonths(6))
                            ->groupBy('year', 'month')
                            ->orderBy('year', 'asc')
                            ->orderBy('month', 'asc')
                            ->get();
        
        // Obtener datos para el gráfico anual (últimos 5 años)
        $yearlyIncome = Pago::select(
                               DB::raw('YEAR(fecha_pago) as year'),
                               DB::raw('SUM(monto) as total')
                           )
                           ->where('estado', 'completado')
                           ->whereNotNull('fecha_pago')
                           ->where('fecha_pago', '>=', now()->subYears(5))
                           ->groupBy('year')
                           ->orderBy('year', 'asc')
                           ->get();
        
        return view('administrador.dashboard', compact(
            'activeCampaigns',
            'totalUsers',
            'totalCompanies',
            'currentMonthIncome',
            'monthlyIncomeChangePercentage',
            'mostContractedPlan',
            'countActivos',
            'countPendientes',
            'countFinalizados',
            'monthlyIncome',
            'yearlyIncome'
        ));
    }
}