<?php

namespace App\Services\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    public function create(array $data)
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

            $token = JWTAuth::fromUser($user);

            return [
                'token' => 'Bearer ' . $token,
                "user" => [
                    'id' => $user->id,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'name' => $user->name,
                    'lastname' => $user->lastname,
                    'image' => $user->image,
                    'notification_token' => $user->notification_token,
                    'roles' => $user->roles->map(function ($role) {
                        return [
                            'id' => $role->id,
                            'name' => $role->name,
                            'route' => $role->route,
                            'image' => $role->image,
                        ];
                    })
                ]
            ];
        });
    }

    public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new HttpException(404, "El usuario no existe o la contraseña es incorecta");
        }

        $token = JWTAuth::fromUser($user);

        return [
            "token" => 'Bearer ' . $token,
            "user" => [
                'id' => $user->id,
                'email' => $user->email,
                'phone' => $user->phone,
                'name' => $user->name,
                'lastname' => $user->lastname,
                'image' => $user->image,
                'notification_token' => $user->notification_token,
                'roles' => $user->roles->map(function ($role) {
                    return [
                        'id' => $role->id,
                        'name' => $role->name,
                        'route' => $role->route,
                        'image' => $role->image,
                    ];
                })
            ]
        ];
    }

    public function findById(int $id): ?User
    {
        return User::with('roles')->findOrFail($id);
    }
}
