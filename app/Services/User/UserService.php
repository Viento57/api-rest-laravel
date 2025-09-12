<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
  public function create(array $data): User 
  {
    return User::create([
      'name' => $data['name'],
      'lastname' => $data['lastname'],
      'email' => $data['email'],
      'phone' => $data['phone'],
      'password' => Hash::make($data['password']) 
    ]);
  }
}