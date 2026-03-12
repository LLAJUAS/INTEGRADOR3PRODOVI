<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'plan';

    protected $fillable = [
        'nombre',
        'subtitulo',
        'precio',
        'moneda',
        'periodo_facturacion',
        'orden',
        'activo',
        'descripcion'
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    /**
     * Obtiene las características del plan.
     * Relación Muchos a Muchos con tabla pivote personalizada.
     */
    public function caracteristicas()
    {
        return $this->belongsToMany(Caracteristica::class, 'plan_caracteristica', 'plan_id', 'caracteristica_id')
            ->withPivot('cantidad', 'frecuencia', 'orden', 'es_destacado') // Carga los datos extra de la tabla pivote
            ->orderBy('pivot_orden'); // Ordena por la columna 'orden' de la tabla pivote
    }

    // Relación con la tabla pivote (útil si necesitas acceder a ella directamente)
    public function planCaracteristicas()
    {
        return $this->hasMany(PlanCaracteristica::class, 'plan_id')
                    ->orderBy('orden');
    }

    // Relación con las suscripciones
    public function suscripciones()
    {
        return $this->hasMany(Suscripcion::class, 'plan_id');
    }
}