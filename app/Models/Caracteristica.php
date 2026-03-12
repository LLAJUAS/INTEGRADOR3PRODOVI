<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caracteristica extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'caracteristica';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    // Relación con los planes a través de la tabla intermedia
    public function planCaracteristicas()
    {
        return $this->hasMany(PlanCaracteristica::class, 'caracteristica_id');
    }
     public function planes()
    {
        return $this->belongsToMany(Plan::class, 'plan_caracteristica', 'caracteristica_id', 'plan_id')
            ->withPivot('cantidad', 'frecuencia', 'orden', 'es_destacado');
    }
}