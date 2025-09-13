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

    // Relación con las características a través de la tabla intermedia
    public function planCaracteristicas()
    {
        return $this->hasMany(PlanCaracteristica::class, 'plan_id')
                    ->orderBy('orden');
    }

    // Accesor para obtener las características relacionadas
    public function getCaracteristicasAttribute()
    {
        return $this->planCaracteristicas->map(function ($pc) {
            return [
                'caracteristica' => $pc->caracteristica,
                'cantidad' => $pc->cantidad,
                'frecuencia' => $pc->frecuencia,
                'orden' => $pc->orden,
                'es_destacado' => $pc->es_destacado
            ];
        });
    }
}