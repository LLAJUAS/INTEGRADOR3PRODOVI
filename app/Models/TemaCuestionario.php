<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemaCuestionario extends Model
{
    use HasFactory, SoftDeletes;

    // Agrega esta línea para especificar el nombre correcto de la tabla
    protected $table = 'temas_cuestionario';

    protected $fillable = [
        'nombre_tema',
        'descripcion_tema',
        'orden',
    ];

    /**
     * Obtener las preguntas del tema
     */
    public function preguntas()
    {
        return $this->hasMany(PreguntaCuestionario::class, 'tema_id')
            ->orderBy('orden');
    }
}