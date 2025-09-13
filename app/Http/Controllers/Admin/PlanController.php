<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanCaracteristica;
use App\Models\Caracteristica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function index()
    {
        $planes = Plan::with(['planCaracteristicas.caracteristica'])
                    ->orderBy('orden', 'asc')
                    ->get();

        return view('administrador.planes.index', compact('planes'));
    }

    public function create()
    {
        $caracteristicas = Caracteristica::orderBy('nombre')->get();
        return view('administrador.planes.create', compact('caracteristicas'));
    }

    public function store(Request $request)
    {
        // Validación corregida
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'subtitulo' => 'nullable|string|max:255',
            'precio' => 'required|numeric|min:0',
            'moneda' => 'required|in:BS,USD',
            'periodo_facturacion' => 'required|in:mes,trimestre,semestre,año',
            'orden' => 'nullable|integer',
            'activo' => 'nullable|boolean',
            'descripcion' => 'nullable|string',
            'caracteristicas' => 'required|array|min:1',
            'caracteristicas.*.id' => 'required|exists:caracteristica,id',
            'caracteristicas.*.cantidad' => 'nullable|integer|min:1',
            'caracteristicas.*.frecuencia' => 'nullable|string|max:255',
            'caracteristicas.*.orden' => 'nullable|integer',
            'caracteristicas.*.es_destacado' => 'nullable|boolean',
        ]);

        try {
            DB::beginTransaction();

            // Crear el plan con todos los campos necesarios
            $plan = Plan::create([
                'nombre' => $validated['nombre'],
                'subtitulo' => $validated['subtitulo'] ?? null,
                'precio' => $validated['precio'],
                'moneda' => $validated['moneda'],
                'periodo_facturacion' => $validated['periodo_facturacion'],
                'orden' => $validated['orden'] ?? 0,
                'activo' => $validated['activo'] ?? true,
                'descripcion' => $validated['descripcion'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Asociar características
            foreach ($validated['caracteristicas'] as $caracteristica) {
                PlanCaracteristica::create([
                    'plan_id' => $plan->id,
                    'caracteristica_id' => $caracteristica['id'],
                    'cantidad' => $caracteristica['cantidad'] ?? 1,
                    'frecuencia' => $caracteristica['frecuencia'] ?? null,
                    'orden' => $caracteristica['orden'] ?? 0,
                    'es_destacado' => $caracteristica['es_destacado'] ?? false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            return redirect()->route('administrador.planes.index')
                             ->with('success', 'Plan creado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                         ->with('error', 'Error al crear el plan: ' . $e->getMessage())
                         ->withErrors(['exception' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            // Primero eliminamos las características asociadas
            PlanCaracteristica::where('plan_id', $id)->delete();
            
            // Luego eliminamos el plan
            $plan = Plan::findOrFail($id);
            $plan->delete();
            
            return redirect()->route('administrador.planes.index')
                            ->with('success', 'Plan eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('administrador.planes.index')
                            ->with('error', 'Error al eliminar el plan: ' . $e->getMessage());
        }
    }

    public function edit($id)
{
    $plan = Plan::with('planCaracteristicas')->findOrFail($id);
    $caracteristicas = Caracteristica::orderBy('nombre')->get();
    
    return view('administrador.planes.edit', compact('plan', 'caracteristicas'));
}

public function update(Request $request, $id)
{
    // Validación (similar a store)
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'subtitulo' => 'nullable|string|max:255',
        'precio' => 'required|numeric|min:0',
        'moneda' => 'required|in:BS,USD',
        'periodo_facturacion' => 'required|in:mes,trimestre,semestre,año',
        'orden' => 'nullable|integer',
        'activo' => 'nullable|boolean',
        'descripcion' => 'nullable|string',
        'caracteristicas' => 'required|array|min:1',
        'caracteristicas.*.id' => 'required|exists:caracteristica,id',
        'caracteristicas.*.cantidad' => 'nullable|integer|min:1',
        'caracteristicas.*.frecuencia' => 'nullable|string|max:255',
        'caracteristicas.*.orden' => 'nullable|integer',
        'caracteristicas.*.es_destacado' => 'nullable|boolean',
    ]);

    try {
        DB::beginTransaction();

        // Actualizar el plan
        $plan = Plan::findOrFail($id);
        $plan->update([
            'nombre' => $validated['nombre'],
            'subtitulo' => $validated['subtitulo'] ?? null,
            'precio' => $validated['precio'],
            'moneda' => $validated['moneda'],
            'periodo_facturacion' => $validated['periodo_facturacion'],
            'orden' => $validated['orden'] ?? 0,
            'activo' => $validated['activo'] ?? true,
            'descripcion' => $validated['descripcion'] ?? null,
            'updated_at' => now(),
        ]);

        // Eliminar características antiguas
        PlanCaracteristica::where('plan_id', $plan->id)->delete();

        // Asociar nuevas características
        foreach ($validated['caracteristicas'] as $caracteristica) {
            PlanCaracteristica::create([
                'plan_id' => $plan->id,
                'caracteristica_id' => $caracteristica['id'],
                'cantidad' => $caracteristica['cantidad'] ?? 1,
                'frecuencia' => $caracteristica['frecuencia'] ?? null,
                'orden' => $caracteristica['orden'] ?? 0,
                'es_destacado' => $caracteristica['es_destacado'] ?? false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::commit();

        return redirect()->route('administrador.planes.index')
                         ->with('success', 'Plan actualizado exitosamente');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withInput()
                     ->with('error', 'Error al actualizar el plan: ' . $e->getMessage())
                     ->withErrors(['exception' => $e->getMessage()]);
    }
}
}