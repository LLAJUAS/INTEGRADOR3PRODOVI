<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TareaComentario extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'comentable_id',
        'comentable_type',
        'user_id',
        'contenido'
    ];

    public function comentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function archivos()
    {
        return $this->hasMany(ComentarioArchivo::class, 'comentario_id');
    }
}