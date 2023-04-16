<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\UpdateUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest as UserUpdateUserRequest;
use App\Models\User;
use App\Services\Contracts\UserServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse;
    public function index(UserServiceInterface $service)
    {
        return $this->success($service->filter());
    }

    public function getById($id, UserServiceInterface $service)
    {
        $user = $service->getById($id);
        if (!$user) {
            return $this->error("User not found", 404);
        }
        return $this->success($user);
    }

    public function store(StoreUserRequest $request, UserServiceInterface $service)
    {
        return $this->success($service->customStore($request));
    }

    public function update($id, UserUpdateUserRequest $request, UserServiceInterface $service)
    {
        return $this->success($service->customUpdate($id, $request));
    }

    public function delete($id)
    {
        User::destroy($id);
        return $this->success();
    }
}
