<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AccessLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_id',
        'url',
        'method',
        'status_code',
        'response_time_ms',
        'user_agent'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
