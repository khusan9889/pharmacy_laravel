<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\UserServiceInterface;
use App\Traits\Crud;

class UserService implements UserServiceInterface
{
    use Crud;

    public $modelClass = User::class;

    public function filter()
    {
        $order = request('order', 'desc');
        return $this->modelClass::where(function ($query) {
            $query->where('username', 'LIKE', '%' . request('like') . '%');
        })
            ->orderBy('id', $order)
            ->get();
    }

    public function getById($userid)
    {
        return User::find($userid);
    }

    public function customStore($request)
    {

        // Create new user
        $user = new User();
        $user->email = $request->input('email');
        $user->vendor_id = $request->input('vendor_id');
        $user->role_id = $request->input('role_id');
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->patronymic = $request->input('patronymic');
        $user->phone_number = $request->input('phone_number');
        $user->save();

        return $user;
    }

    public function customUpdate($id, $request)
    {
        return $this->update($id, $request);
    }

    public function remove($id)
    {
        $model = $this->modelClass::where('id', $id)->first();
        $model->save();
    }
}
