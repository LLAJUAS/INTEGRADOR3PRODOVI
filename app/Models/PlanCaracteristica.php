<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanCaracteristica extends Model
{
    use HasFactory;
    
    protected $table = 'plan_caracteristica';

    protected $fillable = [
        'plan_id',
        'caracteristica_id',
        'cantidad',
        'frecuencia',
        'orden',
        'es_destacado'
    ];

    protected $casts = [
        'es_destacado' => 'boolean',
    ];

    // Relación con Plan
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    // Relación con Caracteristica
    public function caracteristica()
    {
        return $this->belongsTo(Caracteristica::class, 'caracteristica_id');
    }
}