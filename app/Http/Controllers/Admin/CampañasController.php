<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campania;
use App\Models\User;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CampañasController extends Controller
{
    public function index()
{
    // 1. Obtener usuarios con suscripción activa que no tienen campaña activa
    $clientesSinCampania = Pago::with(['usuario', 'suscripcion', 'plan'])
        ->where('estado', 'completado')
        ->whereHas('suscripcion', function($query) {
            $query->where('estado', 'activa')
                  ->where('fecha_fin', '>', now());
        })
        ->whereDoesntHave('usuario.campaniasCliente', function($query) {
            $query->where('fecha_fin', '>', now())
                  ->whereIn('estado', ['activa', 'pausada']);
        })
        ->get()
        ->map(function($pago) {
            return [
                'id' => $pago->usuario->id,
                'nombre' => $pago->usuario->name,
                'email' => $pago->usuario->email,
                'plan' => $pago->plan->nombre ?? 'Sin plan',
                'fecha_fin_suscripcion' => optional($pago->suscripcion)->fecha_fin ? $pago->suscripcion->fecha_fin->format('d/m/Y') : 'Sin fecha',
            ];
        });

    // 2. Obtener campañas activas
    $campaniasActivas = Campania::with(['cliente', 'communityManager'])
        ->where('fecha_fin', '>', now())
        ->whereIn('estado', ['activa', 'pausada'])
        ->get();

    // 3. Obtener campañas finalizadas
    $campaniasFinalizadas = Campania::with(['cliente', 'communityManager'])
        ->where(function($query) {
            $query->where('fecha_fin', '<=', now())
                  ->orWhere('estado', 'finalizada');
        })
        ->orderBy('fecha_fin', 'desc')
        ->get();

    // 4. Obtener community managers para el formulario
    $communityManagers = User::whereHas('roles', function($query) {
        $query->where('nombre_rol', 'community_manager');
    })->get();

    return view('administrador.campañas.index', [
        'clientesSinCampania' => $clientesSinCampania,
        'campaniasActivas' => $campaniasActivas,
        'campaniasFinalizadas' => $campaniasFinalizadas,
        'communityManagers' => $communityManagers,
        'adminActual' => Auth::user()
    ]);
}
    public function guardar(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'usuario_cliente_id' => 'required|exists:users,id',
            'community_manager_id' => 'required|exists:users,id',
        ]);

        // Obtener la suscripción del cliente para las fechas
        $pago = Pago::with('suscripcion')
            ->where('usuario_id', $request->usuario_cliente_id)
            ->where('estado', 'completado')
            ->whereHas('suscripcion', function($query) {
                $query->where('estado', 'activa')
                      ->where('fecha_fin', '>', now());
            })
            ->firstOrFail();

        if (!$pago->suscripcion) {
            return redirect()->back()
                ->with('error', 'El cliente no tiene una suscripción activa válida');
        }

        // Crear la campaña
        Campania::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => now(),
            'fecha_fin' => $pago->suscripcion->fecha_fin,
            'usuario_creador_id' => Auth::id(),
            'community_manager_id' => $request->community_manager_id,
            'usuario_cliente_id' => $request->usuario_cliente_id,
            'estado' => 'activa'
        ]);

        return redirect()->route('administrador.campañas.index')
            ->with('success', 'Campaña creada exitosamente');
    }

    public function activar(Campania $campania)
{
    // Verificar que el cliente tenga suscripción activa
    $tieneSuscripcionActiva = $campania->cliente->suscripciones()
        ->where('estado', 'activa')
        ->where('fecha_fin', '>', now())
        ->exists();

    if (!$tieneSuscripcionActiva) {
        return redirect()->back()
            ->with('error', 'El cliente no tiene una suscripción activa para reactivar la campaña');
    }

    // Actualizar la campaña
    $campania->update([
        'estado' => 'activa',
        'fecha_fin' => $campania->cliente->suscripciones()->where('estado', 'activa')->first()->fecha_fin
    ]);

    return redirect()->back()
        ->with('success', 'Campaña reactivada exitosamente');
}
    // Mostrar detalles de una campaña
    public function show(Campania $campania)
    {
        return view('administrador.campañas.show', compact('campania'));
    }

    // Mostrar formulario de edición
    public function edit(Campania $campania)
    {
        $communityManagers = User::whereHas('roles', function($query) {
            $query->where('nombre_rol', 'community_manager');
        })->get();

        return view('administrador.campañas.edit', [
            'campania' => $campania,
            'communityManagers' => $communityManagers
        ]);
    }

    // Actualizar campaña
    public function update(Request $request, Campania $campania)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'community_manager_id' => 'required|exists:users,id',
            'estado' => 'required|in:activa,pausada,finalizada',
            'fecha_fin' => 'required|date'
        ]);

        $campania->update($validated);

        return redirect()->route('administrador.campañas.index')
            ->with('success', 'Campaña actualizada exitosamente');
    }
}