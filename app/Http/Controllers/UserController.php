<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(private UserService $userService) {}

    // este metodo create ya no vamos utilizar porque ya tenemos register
    // dentro del controlador AuthController
    public function create(CreateUserRequest $request)
    {
        $user = $this->userService->create(data: $request->validated());
        return response()->json(data: $user, status: 201);
    }

    public function findById(int $id)
    {
        $user = $this->userService->findById($id);
        return response()->json(data: $user, status: 200);
    }
}
