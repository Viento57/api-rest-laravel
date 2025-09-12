<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(CreateUserRequest $request, UserService $service)
    {
        $user = $service->create(data: $request->validated());
        return response()->json(data: $user, status: 201);
    }
}
