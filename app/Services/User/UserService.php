<?php

namespace App\Services\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function create(array $data): User
    {
        // transaction = ejecuta varias operaciones en la base de datos
        // pero como una sola operacion
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
            ]);

            $clientRole = Role::find('CLIENT');
            if (!$clientRole) {
                throw new \Exception('El rol del cliente no existe');
            }

            //agrega un rol por defecto con el metodo attach
            $user->roles()->attach($clientRole->id);

            return $user;
        });
    }
}
