<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RespuestaCuestionario extends Model
{
    use HasFactory, SoftDeletes;

    // Agrega esta línea
    protected $table = 'respuestas_cuestionario';

    protected $fillable = [
        'empresa_id',
        'pregunta_id',
        'respuesta',
    ];

    /**
     * Obtener la empresa de la respuesta
     */
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    /**
     * Obtener la pregunta respondida
     */
    public function pregunta()
    {
        return $this->belongsTo(PreguntaCuestionario::class, 'pregunta_id');
    }
}