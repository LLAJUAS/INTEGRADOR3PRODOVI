<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    static $rules = [
        'nombre_rol' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_rol'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    /**
     * Define la relación muchos a muchos con los usuarios.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    /**
     * Define la relación uno a muchos con los roles de usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roleUsers()
    {
        return $this->hasMany('App\Models\RoleUser', 'role_id', 'id');
    }
}
