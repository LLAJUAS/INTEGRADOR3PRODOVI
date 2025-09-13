<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComentarioArchivo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'comentario_id',
        'nombre_original',
        'ruta_archivo',
        'extension',
        'mime_type',
        'tamanio',
        'descripcion'
    ];

    public function comentario()
    {
        return $this->belongsTo(TareaComentario::class, 'comentario_id');
    }
}