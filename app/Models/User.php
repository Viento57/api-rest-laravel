<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    // para proteger de las envios masivos
    // solo recevira estos propiedades que vienen
    // desde front los demas va ignorar
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'phone',
        'password',
    ];

    // dato que no sera incluido cuando devolvemos desde la base de datos
    protected $hidden = ['password'];

    // protected $guarded = ['is_admin'];
    // Con eso le dices a Laravel: “todos los campos son asignables, excepto estos”.

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_has_roles', 'id_user', 'id_rol');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
