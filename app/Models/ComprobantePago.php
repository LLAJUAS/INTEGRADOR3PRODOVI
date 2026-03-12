<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComprobantePago extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comprobantes_pago'; // <-- AÑADE ESTA LÍNEA

    protected $fillable = [
        'pago_id',
        'ruta_pdf',
    ];

    /**
     * Obtiene el pago asociado a este comprobante.
     */
    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }

    /**
     * Accesor para formatear el número del comprobante con ceros a la izquierda.
     * Ej: 1 -> 00001
     */
    public function getNumeroFormateadoAttribute()
    {
        return str_pad($this->id, 5, '0', STR_PAD_LEFT);
    }
}