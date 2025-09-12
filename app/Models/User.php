<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
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
}
